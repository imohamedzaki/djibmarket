<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderStatusChangeEmail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $pageTitle = 'Order Management';
        $pageDescription = 'Use the table below to view, edit, and manage customer orders.';
        
        $query = Order::with(['user', 'orderItems.product.seller', 'shippingAddress'])
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
            $pageDescription = 'View and manage all customer orders regardless of status.';
        }
        
        $orders = $query->latest()->get();
            
        // Add total_quantity attribute to each order
        $orders->each(function ($order) {
            $order->total_quantity = $order->order_items_sum_quantity ?? 0;
        });
            
        return view('admin.orders.index', compact('orders', 'pageTitle', 'pageDescription', 'status'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
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
        
        // Calculate total quantity
        $order->total_quantity = $order->orderItems->sum('quantity');
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Fetch data needed for the edit modal.
     */
    public function getEditData(Order $order)
    {
        try {
            $order->loadMissing(['user', 'user.addresses', 'shippingAddress', 'orderItems.product']);
            
            return response()->json([
                'success' => true,
                'order' => $order,
                'userAddresses' => $order->user ? $order->user->addresses : [],
                'statusOptions' => [
                    'pending' => 'Pending',
                    'accepted' => 'Accepted',
                    'processing' => 'Processing',
                    'shipped' => 'Shipped',
                    'delivered' => 'Delivered',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                    'refunded' => 'Refunded'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch order data'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,processing,shipped,delivered,completed,cancelled,refunded',
            'shipping_address_id' => 'required|exists:user_addresses,id',
            'notes' => 'nullable|string|max:1000'
        ]);

        try {
            $oldShippingAddressId = $order->shipping_address_id;
            $oldStatus = $order->status;
            
            $order->update([
                'status' => $request->status,
                'shipping_address_id' => $request->shipping_address_id,
                'notes' => $request->notes,
            ]);

            // Send email notification if status changed
            if ($oldStatus !== $request->status) {
                SendOrderStatusChangeEmail::dispatch($order, $oldStatus, $request->status);
            }

            // Log address change if shipping address was changed
            if ($oldShippingAddressId != $request->shipping_address_id) {
                $order->loadMissing('shippingAddress');
                $addressTitle = $order->shippingAddress ? $order->shippingAddress->title : 'Address';
                $addressFull = $order->shippingAddress ? $order->shippingAddress->full_address : 'Unknown address';
                
                OrderStatusLog::create([
                    'order_id' => $order->id,
                    'status' => $order->status,
                    'message' => "Delivery address changed to: {$addressTitle} ({$addressFull})",
                    'estimated_delivery_time' => null
                ]);
            }

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update order. Please try again.');
        }
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, Order $order)
    {
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
                'message' => $statusMessages[$newStatus] ?? "Order status changed from {$oldStatus} to {$newStatus}.",
                'estimated_delivery_time' => $newStatus === 'shipped' ? now()->addDays(3) : null
            ]);

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update order status. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            // Only allow deletion of cancelled orders
            if ($order->status !== 'cancelled') {
                return redirect()->back()
                    ->with('error', 'Only cancelled orders can be deleted.');
            }

            $order->delete();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete order. Please try again.');
        }
    }
}