<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the cart page
     */
    public function index(): View
    {
        $cartItems = $this->cartService->getCartItems();
        $cartTotal = $this->cartService->getCartTotal();
        $cartCount = $this->cartService->getCartCount();

        return view('buyer.cart.index', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $result = $this->cartService->addToCart(
            $request->product_id,
            $request->quantity ?? 1
        );

        return response()->json($result);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $result = $this->cartService->removeFromCart($request->product_id);

        return response()->json($result);
    }

    /**
     * Update item quantity in cart
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $result = $this->cartService->updateQuantity(
            $request->product_id,
            $request->quantity
        );

        return response()->json($result);
    }

    /**
     * Get cart data (for AJAX requests)
     */
    public function getData(): JsonResponse
    {
        return response()->json([
            'items' => $this->cartService->getCartItems(),
            'count' => $this->cartService->getCartCount(),
            'total' => $this->cartService->getCartTotal()
        ]);
    }

    /**
     * Get cart HTML for AJAX updates
     */
    public function getCartHtml(): JsonResponse
    {
        $cartItems = $this->cartService->getCartItems();
        $cartTotal = $this->cartService->getCartTotal();
        $cartCount = $this->cartService->getCartCount();

        $html = view('layouts.app.partials.buyer.cart-content', compact('cartItems', 'cartTotal', 'cartCount'))->render();

        return response()->json([
            'html' => $html,
            'count' => $cartCount,
            'total' => $cartTotal
        ]);
    }

    /**
     * Clear cart
     */
    public function clear(): JsonResponse
    {
        $this->cartService->clearCart();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully',
            'cart_count' => 0,
            'cart_total' => 0
        ]);
    }
}
