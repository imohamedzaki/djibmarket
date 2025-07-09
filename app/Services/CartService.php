<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    const COOKIE_NAME = 'guest_cart';
    const COOKIE_DURATION = 60 * 24 * 30; // 30 days

    /**
     * Add item to cart (database for authenticated users, cookie for guests)
     */
    public function addToCart(int $productId, int $quantity = 1): array
    {
        if (Auth::check()) {
            return $this->addToUserCart($productId, $quantity);
        } else {
            return $this->addToGuestCart($productId, $quantity);
        }
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(int $productId): array
    {
        if (Auth::check()) {
            return $this->removeFromUserCart($productId);
        } else {
            return $this->removeFromGuestCart($productId);
        }
    }

    /**
     * Update item quantity in cart
     */
    public function updateQuantity(int $productId, int $quantity): array
    {
        if ($quantity <= 0) {
            return $this->removeFromCart($productId);
        }

        if (Auth::check()) {
            return $this->updateUserCartQuantity($productId, $quantity);
        } else {
            return $this->updateGuestCartQuantity($productId, $quantity);
        }
    }

    /**
     * Get cart items
     */
    public function getCartItems(): array
    {
        if (Auth::check()) {
            return $this->getUserCartItems();
        } else {
            return $this->getGuestCartItems();
        }
    }

    /**
     * Get cart count
     */
    public function getCartCount(): int
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            $cart = $this->getGuestCartFromCookie();
            return array_sum(array_column($cart, 'quantity'));
        }
    }

    /**
     * Get cart total
     */
    public function getCartTotal(): float
    {
        $items = $this->getCartItems();
        return array_sum(array_column($items, 'total_price'));
    }

    /**
     * Clear cart
     */
    public function clearCart(): void
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            Cookie::queue(Cookie::forget(self::COOKIE_NAME));
        }
    }

    /**
     * Transfer guest cart to user cart when user logs in
     */
    public function transferGuestCartToUser(User $user): void
    {
        $guestCart = $this->getGuestCartFromCookie();

        if (empty($guestCart)) {
            return;
        }

        foreach ($guestCart as $item) {
            $existingItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $item['product_id'])
                ->first();

            if ($existingItem) {
                // Update quantity if item already exists
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $item['quantity']
                ]);
            } else {
                // Create new cart item
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity']
                ]);
            }
        }

        // Clear guest cart cookie
        Cookie::queue(Cookie::forget(self::COOKIE_NAME));
    }

    /**
     * Add item to authenticated user's cart
     */
    private function addToUserCart(int $productId, int $quantity): array
    {
        $product = Product::find($productId);
        if (!$product) {
            return ['success' => false, 'message' => 'Product not found'];
        }

        if ($product->stock_quantity < $quantity) {
            return ['success' => false, 'message' => 'Insufficient stock'];
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($product->stock_quantity < $newQuantity) {
                return ['success' => false, 'message' => 'Insufficient stock'];
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return [
            'success' => true,
            'message' => 'Item added to cart',
            'cart_count' => $this->getCartCount()
        ];
    }

    /**
     * Add item to guest cart (cookie)
     */
    private function addToGuestCart(int $productId, int $quantity): array
    {
        $product = Product::find($productId);
        if (!$product) {
            return ['success' => false, 'message' => 'Product not found'];
        }

        if ($product->stock_quantity < $quantity) {
            return ['success' => false, 'message' => 'Insufficient stock'];
        }

        $cart = $this->getGuestCartFromCookie();
        $existingIndex = array_search($productId, array_column($cart, 'product_id'));

        if ($existingIndex !== false) {
            $newQuantity = $cart[$existingIndex]['quantity'] + $quantity;
            if ($product->stock_quantity < $newQuantity) {
                return ['success' => false, 'message' => 'Insufficient stock'];
            }
            $cart[$existingIndex]['quantity'] = $newQuantity;
        } else {
            $cart[] = [
                'product_id' => $productId,
                'quantity' => $quantity
            ];
        }

        $this->saveGuestCartToCookie($cart);

        return [
            'success' => true,
            'message' => 'Item added to cart',
            'cart_count' => $this->getCartCount()
        ];
    }

    /**
     * Remove item from user cart
     */
    private function removeFromUserCart(int $productId): array
    {
        CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return [
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ];
    }

    /**
     * Remove item from guest cart
     */
    private function removeFromGuestCart(int $productId): array
    {
        $cart = $this->getGuestCartFromCookie();
        $cart = array_filter($cart, function ($item) use ($productId) {
            return $item['product_id'] != $productId;
        });

        $this->saveGuestCartToCookie(array_values($cart));

        return [
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ];
    }

    /**
     * Update user cart quantity
     */
    private function updateUserCartQuantity(int $productId, int $quantity): array
    {
        $product = Product::find($productId);
        if (!$product) {
            return ['success' => false, 'message' => 'Product not found'];
        }

        if ($product->stock_quantity < $quantity) {
            return ['success' => false, 'message' => 'Insufficient stock'];
        }

        CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);

        // Get updated cart item details
        $cartItem = CartItem::with('product')->where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        $unitPrice = $cartItem->unit_price;
        $totalPrice = $unitPrice * $quantity;

        return [
            'success' => true,
            'message' => 'Cart updated',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal(),
            'cart_item' => [
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice
            ]
        ];
    }

    /**
     * Update guest cart quantity
     */
    private function updateGuestCartQuantity(int $productId, int $quantity): array
    {
        $product = Product::find($productId);
        if (!$product) {
            return ['success' => false, 'message' => 'Product not found'];
        }

        if ($product->stock_quantity < $quantity) {
            return ['success' => false, 'message' => 'Insufficient stock'];
        }

        $cart = $this->getGuestCartFromCookie();
        $existingIndex = array_search($productId, array_column($cart, 'product_id'));

        if ($existingIndex !== false) {
            $cart[$existingIndex]['quantity'] = $quantity;
            $this->saveGuestCartToCookie($cart);
        }

        $unitPrice = $product->price_discounted > 0 ? $product->price_discounted : $product->price_regular;
        $totalPrice = $unitPrice * $quantity;

        return [
            'success' => true,
            'message' => 'Cart updated',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal(),
            'cart_item' => [
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice
            ]
        ];
    }

    /**
     * Get user cart items with product details
     */
    private function getUserCartItems(): array
    {
        $cartItems = CartItem::with('product.images')
            ->where('user_id', Auth::id())
            ->get();

        return $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'product' => $item->product,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total_price' => $item->total_price,
                'product_title' => $item->product->title,
                'product_image' => $this->getProductImage($item->product),
                'product_url' => route('buyer.product.show', $item->product->slug),
            ];
        })->toArray();
    }

    /**
     * Get guest cart items with product details
     */
    private function getGuestCartItems(): array
    {
        $cart = $this->getGuestCartFromCookie();
        $items = [];

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $unitPrice = $product->price_discounted > 0 ? $product->price_discounted : $product->price_regular;
                $items[] = [
                    'id' => null,
                    'product_id' => $product->id,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'unit_price' => $unitPrice,
                    'total_price' => $unitPrice * $item['quantity'],
                    'product_title' => $product->title,
                    'product_image' => $this->getProductImage($product),
                    'product_url' => route('buyer.product.show', $product->slug),
                ];
            }
        }

        return $items;
    }

    /**
     * Get guest cart from cookie
     */
    private function getGuestCartFromCookie(): array
    {
        $cart = Cookie::get(self::COOKIE_NAME);
        return $cart ? json_decode($cart, true) : [];
    }

    /**
     * Save guest cart to cookie
     */
    private function saveGuestCartToCookie(array $cart): void
    {
        Cookie::queue(Cookie::make(
            self::COOKIE_NAME,
            json_encode($cart),
            self::COOKIE_DURATION
        ));
    }

    /**
     * Get the correct image path for a product
     */
    private function getProductImage(Product $product): string
    {
        // Use the product's primary image URL accessor
        return $product->primary_image_url;
    }
}
