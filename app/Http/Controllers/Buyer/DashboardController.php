<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ReturnRequest;
use App\Models\UserAddress;
use App\Models\UserBrowsingHistory;
use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_orders' => $user->orders()->count(),
            'pending_orders' => $user->orders()->where('status', 'pending')->count(),
            'completed_orders' => $user->orders()->where('status', 'delivered')->count(),
            'wishlist_items' => $user->wishlist()->count(),
            'addresses' => $user->addresses()->count(),
            'return_requests' => $user->returnRequests()->count(),
        ];

        $recent_orders = $user->orders()
            ->with(['orderItems.product'])
            ->latest()
            ->take(5)
            ->get();

        $recent_browsing = $user->browsingHistory()
            ->with('product')
            ->take(8)
            ->get();

        return view('buyer.dashboard.index', compact('stats', 'recent_orders', 'recent_browsing'));
    }

    public function profile()
    {
        return view('buyer.dashboard.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'newsletter_subscription' => 'boolean',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['avatar', 'password', 'password_confirmation']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = 'storage/' . $avatarPath;

            // Ensure the public storage avatars directory exists and copy the file
            $publicAvatarsPath = public_path('storage/avatars');
            if (!file_exists($publicAvatarsPath)) {
                mkdir($publicAvatarsPath, 0755, true);
            }

            // Copy the file to public storage for web access
            $sourceFile = storage_path('app/public/' . $avatarPath);
            $destinationFile = $publicAvatarsPath . '/' . basename($avatarPath);
            if (file_exists($sourceFile)) {
                copy($sourceFile, $destinationFile);
            }
        }

        // Handle password update
        if ($request->filled('password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function addresses()
    {
        $addresses = Auth::user()->addresses()->latest()->get();
        return view('buyer.dashboard.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'type' => 'required|in:home,work,other',
            'title' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
            'notes' => 'nullable|string|max:500',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // If this is set as default, remove default from other addresses
        if ($request->is_default) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }

        UserAddress::create($data);

        return back()->with('success', 'Address added successfully!');
    }

    public function updateAddress(Request $request, UserAddress $address)
    {
        // Ensure user owns this address
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'type' => 'required|in:home,work,other',
            'title' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'boolean',
            'notes' => 'nullable|string|max:500',
        ]);

        // If this is set as default, remove default from other addresses
        if ($request->is_default) {
            Auth::user()->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $address->update($request->all());

        return back()->with('success', 'Address updated successfully!');
    }

    public function deleteAddress(UserAddress $address)
    {
        // Ensure user owns this address
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();

        return back()->with('success', 'Address deleted successfully!');
    }

    public function orders()
    {
        $orders = Auth::user()->orders()
            ->with(['orderItems.product', 'shippingAddress', 'statusLogs'])
            ->latest()
            ->paginate(10);

        return view('buyer.dashboard.orders', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load([
            'orderItems.product',
            'shippingAddress',
            'statusLogs' => function ($query) {
                $query->latest();
            },
            'coupon'
        ]);

        return view('buyer.dashboard.order-details', compact('order'));
    }

    public function wishlist()
    {
        $wishlistItems = Auth::user()->wishlist()
            ->with('product')
            ->latest()
            ->paginate(12);

        return view('buyer.dashboard.wishlist', compact('wishlistItems'));
    }

    public function removeFromWishlist(Wishlist $wishlist)
    {
        // Ensure user owns this wishlist item
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return back()->with('success', 'Item removed from wishlist!');
    }

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        // Check if item already exists in wishlist
        $existingItem = Auth::user()->wishlist()
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist!'
            ]);
        }

        // Add to wishlist
        Auth::user()->wishlist()->create([
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist!'
        ]);
    }

    public function removeFromWishlistByProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlistItem = Auth::user()->wishlist()
            ->where('product_id', $request->product_id)
            ->first();

        if (!$wishlistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist!'
            ]);
        }

        $wishlistItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from wishlist!'
        ]);
    }

    public function saveCartToWishlist()
    {
        $cartItems = $this->cartService->getCartItems();
        $savedCount = 0;

        foreach ($cartItems as $item) {
            if ($item['product']) {
                // Check if item already exists in wishlist
                $existingWishlistItem = Auth::user()->wishlist()
                    ->where('product_id', $item['product_id'])
                    ->first();

                if (!$existingWishlistItem) {
                    // Add to wishlist
                    Auth::user()->wishlist()->create([
                        'product_id' => $item['product_id']
                    ]);
                    $savedCount++;
                }
            }
        }

        // Clear the cart after saving to wishlist
        $this->cartService->clearCart();

        return response()->json([
            'success' => true,
            'message' => $savedCount > 0
                ? "Successfully saved {$savedCount} items to your wishlist and cleared your cart!"
                : 'All items were already in your wishlist. Cart has been cleared.',
            'saved_count' => $savedCount
        ]);
    }

    public function getWishlistCount()
    {
        return response()->json([
            'count' => Auth::user()->wishlist()->count()
        ]);
    }

    public function browsingHistory()
    {
        $history = Auth::user()->browsingHistory()
            ->with('product')
            ->paginate(20);

        return view('buyer.dashboard.browsing-history', compact('history'));
    }

    public function clearBrowsingHistory()
    {
        Auth::user()->browsingHistory()->delete();

        return back()->with('success', 'Browsing history cleared!');
    }

    public function returnRequests()
    {
        $returnRequests = Auth::user()->returnRequests()
            ->with(['order', 'orderItem.product'])
            ->latest()
            ->paginate(10);

        return view('buyer.dashboard.return-requests', compact('returnRequests'));
    }

    public function cart()
    {
        $cartItems = $this->cartService->getCartItems();
        $subtotal = $this->cartService->getCartTotal();

        // Calculate cart totals breakdown
        $shipping = 1000; // Fixed shipping cost of 1000 DJF
        $tax = 0; // No tax for now
        $total = $subtotal + $shipping + $tax;

        $cartTotal = [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total
        ];

        // Get recommended products (random products for now)
        $recommendedProducts = \App\Models\Product::where('status', 'active')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('buyer.dashboard.cart', compact('cartItems', 'cartTotal', 'recommendedProducts'));
    }

    public function tracking()
    {
        $orders = Auth::user()->orders()
            ->whereNotNull('tracking_number')
            ->with(['orderItems.product'])
            ->latest()
            ->paginate(10);

        return view('buyer.dashboard.tracking', compact('orders'));
    }

    public function cancelOrder(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$order->canBeCanceled()) {
            return back()->with('error', 'This order cannot be canceled.');
        }

        $order->cancel('Order canceled by customer');

        return back()->with('success', 'Order has been canceled successfully.');
    }

    public function downloadInvoice(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['orderItems.product', 'shippingAddress', 'user']);

        $pdf = Pdf::loadView('buyer.dashboard.invoice', compact('order'));

        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }
}
