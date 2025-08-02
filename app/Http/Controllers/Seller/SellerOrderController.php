<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderStatusChangeEmail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $seller = Auth::guard('seller')->user();
        $status = $request->get('status');
        $pageTitle = 'Order Management';
        $pageDescription = 'Use the table below to view, edit, and manage your orders.';
        
        // Only get orders that contain products from this seller
        $query = Order::with(['user', 'orderItems.product.seller', 'shippingAddress'])
            ->whereHas('orderItems.product', function ($q) use ($seller) {
                $q->where('seller_id', $seller->id);
            })
            ->withCount('orderItems')
            ->withSum('orderItems', 'quantity');
            
        // Filter by status if provided
        if ($status && $status !== 'all') {
            if ($status === 'processing') {
                $query->whereIn('status', ['accepted', 'processing']);
                $pageTitle = 'Processing Orders';
                $pageDescription = 'View and manage orders that are being processed.';
            } elseif ($status === 'delivered') {
                $query->whereIn('status', ['delivered', 'completed']);
                $pageTitle = 'Delivered Orders';
                $pageDescription = 'View orders that have been delivered to customers.';
            } elseif ($status === 'pending') {
                $query->where('status', 'pending');
                $pageTitle = 'Pending Orders';
                $pageDescription = 'View orders that are awaiting review and processing.';
            } elseif ($status === 'shipped') {
                $query->whereIn('status', ['shipped', 'delivered']);
                $pageTitle = 'Order Deliveries';
                $pageDescription = 'View and manage orders that have been shipped or delivered to customers.';
            } else {
                $query->where('status', $status);
                $pageTitle = ucfirst($status) . ' Orders';
                $pageDescription = "View orders with {$status} status.";
            }
        } elseif ($status === 'all') {
            $pageTitle = 'All Orders';
            $pageDescription = 'View and manage all your orders regardless of status.';
        }
        
        $orders = $query->latest()->get();
            
        // Add total_quantity attribute to each order and filter items by seller
        $orders->each(function ($order) use ($seller) {
            // Filter order items to only show this seller's products
            $sellerOrderItems = $order->orderItems->where('product.seller_id', $seller->id);
            $order->total_quantity = $sellerOrderItems->sum('quantity');
            $order->seller_items_count = $sellerOrderItems->count();
            
            // Calculate seller-specific final price
            $order->seller_final_price = $sellerOrderItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        });
            
        return view('seller.orders.index', compact('orders', 'pageTitle', 'pageDescription', 'status'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $seller = Auth::guard('seller')->user();
        
        // Check if this order contains products from the authenticated seller
        $hasSellerProducts = $order->orderItems()->whereHas('product', function ($q) use ($seller) {
            $q->where('seller_id', $seller->id);
        })->exists();
        
        if (!$hasSellerProducts) {
            abort(403, 'You do not have permission to view this order.');
        }
        
        $order->loadMissing([
            'user', 
            'user.addresses',
            'shippingAddress',
            'orderItems.product.seller', 
            'orderItems.product.category',
            'statusLogs' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ]);
        
        // Filter order items to only show this seller's products
        $sellerOrderItems = $order->orderItems->where('product.seller_id', $seller->id);
        
        // Calculate total quantity for seller's items only
        $order->seller_total_quantity = $sellerOrderItems->sum('quantity');
        $order->seller_final_price = $sellerOrderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
        return view('seller.orders.show', compact('order', 'sellerOrderItems'));
    }


    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $seller = Auth::guard('seller')->user();
        
        // Check if this order contains products from the authenticated seller
        $hasSellerProducts = $order->orderItems()->whereHas('product', function ($q) use ($seller) {
            $q->where('seller_id', $seller->id);
        })->exists();
        
        if (!$hasSellerProducts) {
            return redirect()->back()->with('error', 'You do not have permission to modify this order.');
        }
        
        $request->validate([
            'status' => 'required|in:pending,accepted,processing,shipped,delivered,completed,cancelled,refunded'
        ]);

        try {
            $oldStatus = $order->status;
            $newStatus = $request->status;
            
            // Update order status
            $order->update(['status' => $newStatus]);

            // Send email notification
            SendOrderStatusChangeEmail::dispatch($order, $oldStatus, $newStatus);

            // Create status log entry
            $statusMessages = [
                'pending' => 'Order is pending review and processing.',
                'accepted' => 'Order has been accepted and will be processed soon.',
                'processing' => 'Order is being processed and prepared for shipping.',
                'shipped' => 'Order has been shipped and is on its way to the destination.',
                'delivered' => 'Order has been successfully delivered to the customer.',
                'completed' => 'Order is completed. Thank you for your purchase!',
                'cancelled' => 'Order has been cancelled.',
                'refunded' => 'Order has been refunded. Amount will be credited back.'
            ];

            OrderStatusLog::create([
                'order_id' => $order->id,
                'status' => $newStatus,
                'message' => $statusMessages[$newStatus] ?? "Order status changed from {$oldStatus} to {$newStatus} by seller: {$seller->name}.",
                'estimated_delivery_time' => $newStatus === 'shipped' ? now()->addDays(3) : null
            ]);

            return redirect()->route('seller.orders.index')
                ->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update order status. Please try again.');
        }
    }
}