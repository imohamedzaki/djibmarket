<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\SellerAd;
use App\Models\SellerAdStat;
use Carbon\Carbon;

class SellerAnalyticsController extends Controller
{
    /**
     * Display the seller analytics dashboard.
     */
    public function index(): View
    {
        $seller = Auth::guard('seller')->user();

        // Time periods for analytics
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $thisYear = Carbon::now()->startOfYear();

        // Revenue Analytics
        $revenueAnalytics = $this->getRevenueAnalytics($seller->id);
        
        // Sales Analytics
        $salesAnalytics = $this->getSalesAnalytics($seller->id);
        
        // Product Performance
        $productPerformance = $this->getProductPerformance($seller->id);
        
        // Category Performance
        $categoryPerformance = $this->getCategoryPerformance($seller->id);
        
        // Ad Performance (if seller has ads)
        $adPerformance = $this->getAdPerformance($seller->id);
        
        // Customer Analytics
        $customerAnalytics = $this->getCustomerAnalytics($seller->id);
        
        // Monthly Revenue Chart Data
        $monthlyRevenueChart = $this->getMonthlyRevenueChart($seller->id);
        
        // Daily Sales Chart Data (last 30 days)
        $dailySalesChart = $this->getDailySalesChart($seller->id);

        return view('seller.analytics.index', compact(
            'revenueAnalytics',
            'salesAnalytics',
            'productPerformance',
            'categoryPerformance',
            'adPerformance',
            'customerAnalytics',
            'monthlyRevenueChart',
            'dailySalesChart'
        ));
    }

    private function getRevenueAnalytics($sellerId)
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth();

        return [
            'today' => $this->getRevenueForPeriod($sellerId, $today, $today->copy()->endOfDay()),
            'this_week' => $this->getRevenueForPeriod($sellerId, $thisWeek, Carbon::now()),
            'this_month' => $this->getRevenueForPeriod($sellerId, $thisMonth, Carbon::now()),
            'last_month' => $this->getRevenueForPeriod($sellerId, $lastMonth->startOfMonth(), $lastMonth->endOfMonth()),
            'total' => $this->getTotalRevenue($sellerId),
        ];
    }

    private function getSalesAnalytics($sellerId)
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        return [
            'today' => $this->getSalesForPeriod($sellerId, $today, $today->copy()->endOfDay()),
            'this_week' => $this->getSalesForPeriod($sellerId, $thisWeek, Carbon::now()),
            'this_month' => $this->getSalesForPeriod($sellerId, $thisMonth, Carbon::now()),
            'total' => $this->getTotalSales($sellerId),
        ];
    }

    private function getProductPerformance($sellerId)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'products.title',
                'products.id',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue')
            )
            ->groupBy('products.id', 'products.title')
            ->orderBy('total_revenue', 'desc')
            ->limit(10)
            ->get();
    }

    private function getCategoryPerformance($sellerId)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->select(
                'categories.name',
                'categories.id',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'),
                DB::raw('COUNT(DISTINCT products.id) as products_count')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_revenue', 'desc')
            ->get();
    }

    private function getAdPerformance($sellerId)
    {
        $ads = SellerAd::where('seller_id', $sellerId)->get();
        
        if ($ads->isEmpty()) {
            return null;
        }

        $adStats = [];
        foreach ($ads as $ad) {
            $stats = SellerAdStat::where('seller_ad_id', $ad->id)
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->get();

            $views = $stats->where('event_type', 'view')->count();
            $clicks = $stats->where('event_type', 'click')->count();
            $ctr = $views > 0 ? ($clicks / $views) * 100 : 0;

            $adStats[] = [
                'title' => $ad->title,
                'views' => $views,
                'clicks' => $clicks,
                'ctr' => round($ctr, 2),
                'budget_used' => $ad->budget_used,
                'total_budget' => $ad->total_budget,
            ];
        }

        return $adStats;
    }

    private function getCustomerAnalytics($sellerId)
    {
        $orders = Order::whereHas('items.product', function($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->where('status', '!=', 'cancelled');

        return [
            'total_customers' => $orders->distinct('user_id')->count('user_id'),
            'repeat_customers' => $orders->select('user_id')
                ->groupBy('user_id')
                ->havingRaw('COUNT(*) > 1')
                ->get()
                ->count(),
            'average_order_value' => $orders->avg('total_amount') ?: 0,
        ];
    }

    private function getMonthlyRevenueChart($sellerId)
    {
        $months = [];
        $revenues = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();
            
            $revenue = $this->getRevenueForPeriod($sellerId, $startOfMonth, $endOfMonth);
            
            $months[] = $date->format('M Y');
            $revenues[] = $revenue;
        }

        return [
            'labels' => $months,
            'data' => $revenues,
        ];
    }

    private function getDailySalesChart($sellerId)
    {
        $days = [];
        $sales = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $startOfDay = $date->copy()->startOfDay();
            $endOfDay = $date->copy()->endOfDay();
            
            $salesCount = $this->getSalesForPeriod($sellerId, $startOfDay, $endOfDay);
            
            $days[] = $date->format('M j');
            $sales[] = $salesCount;
        }

        return [
            'labels' => $days,
            'data' => $sales,
        ];
    }

    private function getRevenueForPeriod($sellerId, $startDate, $endDate)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->sum(DB::raw('order_items.quantity * order_items.price')) ?: 0;
    }

    private function getSalesForPeriod($sellerId, $startDate, $endDate)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->sum('order_items.quantity') ?: 0;
    }

    private function getTotalRevenue($sellerId)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->sum(DB::raw('order_items.quantity * order_items.price')) ?: 0;
    }

    private function getTotalSales($sellerId)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->sum('order_items.quantity') ?: 0;
    }
}