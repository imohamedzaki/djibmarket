<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\CartService;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserAddress;
use App\Models\Product;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems();
        $cartTotal = $this->cartService->getCartTotal();
        $cartCount = $this->cartService->getCartCount();

        // Redirect to cart if empty
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add some items before checkout.');
        }

        // Get user's addresses if authenticated
        $addresses = [];
        $defaultAddress = null;
        if (Auth::check()) {
            $addresses = Auth::user()->addresses()->get();
            $defaultAddress = Auth::user()->defaultAddress();
        }

        // Calculate totals
        $subtotal = $cartTotal;
        $shippingCost = 1000; // Fixed shipping cost of 1000 DJF
        $taxAmount = 0; // No tax for now
        $finalTotal = $subtotal + $shippingCost + $taxAmount;

        return view('buyer.dashboard.checkout', compact(
            'cartItems',
            'cartTotal',
            'cartCount',
            'addresses',
            'defaultAddress',
            'subtotal',
            'shippingCost',
            'taxAmount',
            'finalTotal'
        ));
    }

    public function store(Request $request)
    {
        Log::info('Checkout store method called', [
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);

        // Base validation rules
        $rules = [
            'email' => 'required|email',
            'shipping_address_id' => 'nullable|exists:user_addresses,id',
        ];

        // If no existing address is selected, require address fields
        if (!$request->shipping_address_id) {
            $rules = array_merge($rules, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address_1' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'phone' => 'required|string|max:20',
            ]);
        }

        Log::info('Validation rules', ['rules' => $rules]);
        $request->validate($rules);

        $cartItems = $this->cartService->getCartItems();
        $cartTotal = $this->cartService->getCartTotal();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = $cartTotal;
            $shippingCost = 1000; // Fixed shipping cost of 1000 DJF
            $taxAmount = 0; // No tax for now
            $finalTotal = $subtotal + $shippingCost + $taxAmount;

            // Handle shipping address
            $shippingAddressId = null;
            if (Auth::check()) {
                if ($request->shipping_address_id) {
                    // Use selected address
                    $shippingAddressId = $request->shipping_address_id;
                } else {
                    // Create new address from form data
                    $address = UserAddress::create([
                        'user_id' => Auth::id(),
                        'type' => 'other',
                        'title' => 'Checkout Address',
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone,
                        'address_line_1' => $request->address_1,
                        'address_line_2' => $request->address_2,
                        'city' => $request->city,
                        'state' => $request->state,
                        'postal_code' => $request->postal_code,
                        'country' => $request->country ?? 'Djibouti',
                        'notes' => $request->additional_info,
                    ]);
                    $shippingAddressId = $address->id;
                }
            }

            // Create order with temporary order number
            $order = Order::create([
                'order_number' => 'TEMP-' . time() . '-' . rand(1000, 9999), // Temporary unique number
                'user_id' => Auth::id(),
                'shipping_address_id' => $shippingAddressId,
                'total_price' => $subtotal,
                'discount_amount' => 0,
                'shipping_cost' => $shippingCost,
                'tax_amount' => $taxAmount,
                'final_price' => $finalTotal,
                'status' => 'pending',
                'shipping_method' => 'standard',
                'notes' => $request->additional_info,
            ]);

            // Generate proper order number
            $order->update([
                'order_number' => $order->generateOrderNumber()
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price_discounted > 0 ? $product->price_discounted : $product->price_regular,
                        'discount_amount' => 0,
                    ]);

                    // Update product stock
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            // Add initial status log
            $order->addStatusLog('pending', 'Order has been placed and is awaiting processing.');

            // Clear the cart
            $this->cartService->clearCart();

            DB::commit();

            Log::info('Order created successfully', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('buyer.dashboard.orders.show', $order)
                ->with('success', 'Order placed successfully! Your order number is: ' . $order->order_number);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'cart_items' => $cartItems,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Failed to place order. Please try again. Error: ' . $e->getMessage());
        }
    }
}
