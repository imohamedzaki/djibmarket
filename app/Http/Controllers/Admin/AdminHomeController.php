<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminHomeController extends Controller
{
    public function index()
    {
        // Get top selling categories based on order count
        $topCategories = Category::select('categories.id', 'categories.name')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 'cancelled')
            ->groupBy('categories.id', 'categories.name')
            ->selectRaw('COUNT(DISTINCT orders.id) as orders_count')
            ->orderBy('orders_count', 'desc')
            ->limit(7)
            ->get();

        // Get latest orders with user, seller info and items count
        $latestOrders = Order::with(['user', 'orderItems.product.seller'])
            ->withCount('orderItems as order_items_count')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Calculate total sales
        $totalSales = Order::where('status', '!=', 'cancelled')
            ->sum('final_price');

        // Calculate weekly sales (last 7 days)
        $weeklySales = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', now()->subDays(7))
            ->sum('final_price');

        // Get top selling products
        $topProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 'cancelled')
            ->groupBy('products.id', 'products.title', 'products.price_regular')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        // Get top selling sellers
        $topSellers = Seller::select('sellers.*')
            ->join('products', 'sellers.id', '=', 'products.seller_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 'cancelled')
            ->groupBy('sellers.id', 'sellers.name', 'sellers.email')
            ->selectRaw('SUM(order_items.price * order_items.quantity) as total_sales')
            ->selectRaw('COUNT(DISTINCT orders.id) as total_orders')
            ->selectRaw('COUNT(DISTINCT products.id) as products_count')
            ->orderBy('total_sales', 'desc')
            ->limit(4)
            ->get();

        // Customer registration metrics
        $monthlyCustomers = User::where('created_at', '>=', now()->subDays(30))->count();
        $weeklyCustomers = User::where('created_at', '>=', now()->subDays(7))->count();
        
        // Previous period for comparison
        $prevMonthlyCustomers = User::where('created_at', '>=', now()->subDays(60))
            ->where('created_at', '<', now()->subDays(30))->count();
        $prevWeeklyCustomers = User::where('created_at', '>=', now()->subDays(14))
            ->where('created_at', '<', now()->subDays(7))->count();
            
        $monthlyCustomersChange = $prevMonthlyCustomers > 0 
            ? (($monthlyCustomers - $prevMonthlyCustomers) / $prevMonthlyCustomers) * 100 
            : 0;
        $weeklyCustomersChange = $prevWeeklyCustomers > 0 
            ? (($weeklyCustomers - $prevWeeklyCustomers) / $prevWeeklyCustomers) * 100 
            : 0;

        // Customer activity metrics
        $monthlyActiveCustomers = User::whereHas('orders', function($query) {
            $query->where('created_at', '>=', now()->subDays(30))
                  ->where('status', '!=', 'cancelled');
        })->count();
        
        $weeklyActiveCustomers = User::whereHas('orders', function($query) {
            $query->where('created_at', '>=', now()->subDays(7))
                  ->where('status', '!=', 'cancelled');
        })->count();
        
        $dailyActiveCustomers = User::whereHas('orders', function($query) {
            $query->where('created_at', '>=', now()->subDay())
                  ->where('status', '!=', 'cancelled');
        })->count();

        // Order source metrics (mock data for now - can be enhanced with actual tracking)
        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $mobileOrders = max(1, intval($totalOrders * 0.42)); // 42% mobile
        $websiteOrders = max(1, intval($totalOrders * 0.33)); // 33% website
        $socialOrders = max(1, intval($totalOrders * 0.17)); // 17% social
        $directOrders = max(1, $totalOrders - $mobileOrders - $websiteOrders - $socialOrders);

        // Payment method usage (mock data - can be enhanced with actual payment tracking)
        $totalPaymentOrders = max(1, $totalOrders);
        $cacPayOrders = max(1, intval($totalPaymentOrders * 0.423)); // 42.3% CAC Pay
        $waafiOrders = max(1, intval($totalPaymentOrders * 0.287)); // 28.7% Waafi
        $dmoneyOrders = max(1, intval($totalPaymentOrders * 0.196)); // 19.6% D Money
        $otherPaymentOrders = max(1, $totalPaymentOrders - $cacPayOrders - $waafiOrders - $dmoneyOrders); // Others

        return view('admin.dashboard', [
            'topCategories' => $topCategories,
            'latestOrders' => $latestOrders,
            'totalSales' => $totalSales,
            'weeklySales' => $weeklySales,
            'topProducts' => $topProducts,
            'topSellers' => $topSellers,
            
            // Customer registration metrics
            'monthlyCustomers' => $monthlyCustomers,
            'weeklyCustomers' => $weeklyCustomers,
            'monthlyCustomersChange' => round($monthlyCustomersChange, 1),
            'weeklyCustomersChange' => round($weeklyCustomersChange, 1),
            
            // Customer activity metrics
            'monthlyActiveCustomers' => $monthlyActiveCustomers,
            'weeklyActiveCustomers' => $weeklyActiveCustomers,
            'dailyActiveCustomers' => $dailyActiveCustomers,
            'monthlyActiveCustomersChange' => 4.6, // Mock data - can be calculated
            'weeklyActiveCustomersChange' => -1.9, // Mock data - can be calculated
            'dailyActiveCustomersChange' => 3.4, // Mock data - can be calculated
            
            // Order source metrics
            'mobileOrders' => $mobileOrders,
            'websiteOrders' => $websiteOrders,
            'socialOrders' => $socialOrders,
            'directOrders' => $directOrders,
            
            // Payment method metrics
            'cacPayOrders' => $cacPayOrders,
            'waafiOrders' => $waafiOrders,
            'dmoneyOrders' => $dmoneyOrders,
            'otherPaymentOrders' => $otherPaymentOrders,
        ]);
    }
}