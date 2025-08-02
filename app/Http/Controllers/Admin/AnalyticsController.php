<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\EmailLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index(Request $request)
    {
        // Get date range from request or default to last 30 days
        $dateFrom = $request->get('date_from', Carbon::now()->subDays(30)->toDateString());
        $dateTo = $request->get('date_to', Carbon::now()->toDateString());
        $period = $request->get('period', '30_days');

        // Get comprehensive analytics data
        $analytics = $this->getAnalyticsData($dateFrom, $dateTo, $period);

        return view('admin.analytics.dashboard', compact('analytics', 'dateFrom', 'dateTo', 'period'));
    }

    /**
     * Get real-time analytics data for AJAX requests.
     */
    public function realTimeData(Request $request)
    {
        $period = $request->get('period', 'today');
        
        switch ($period) {
            case 'today':
                $dateFrom = Carbon::today();
                $dateTo = Carbon::now();
                break;
            case 'week':
                $dateFrom = Carbon::now()->startOfWeek();
                $dateTo = Carbon::now();
                break;
            case 'month':
                $dateFrom = Carbon::now()->startOfMonth();
                $dateTo = Carbon::now();
                break;
            default:
                $dateFrom = Carbon::today();
                $dateTo = Carbon::now();
        }

        $data = $this->getAnalyticsData($dateFrom->toDateString(), $dateTo->toDateString(), $period);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Export analytics data.
     */
    public function export(Request $request)
    {
        $dateFrom = $request->get('date_from', Carbon::now()->subDays(30)->toDateString());
        $dateTo = $request->get('date_to', Carbon::now()->toDateString());
        $type = $request->get('type', 'csv');

        $analytics = $this->getAnalyticsData($dateFrom, $dateTo, 'custom');

        $filename = 'analytics_export_' . $dateFrom . '_to_' . $dateTo . '.' . $type;

        // For CSV export
        if ($type === 'csv') {
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($analytics) {
                $file = fopen('php://output', 'w');
                
                // Headers
                fputcsv($file, ['Metric', 'Value', 'Change', 'Period']);
                
                // Sales data
                fputcsv($file, ['Total Revenue', number_format($analytics['revenue']['total']), $analytics['revenue']['change'] . '%', 'Period']);
                fputcsv($file, ['Total Orders', $analytics['orders']['total'], $analytics['orders']['change'] . '%', 'Period']);
                fputcsv($file, ['Average Order Value', number_format($analytics['revenue']['average_order_value']), '', 'Period']);
                
                // User data
                fputcsv($file, ['Total Users', $analytics['users']['total'], $analytics['users']['change'] . '%', 'Period']);
                fputcsv($file, ['New Users', $analytics['users']['new'], '', 'Period']);
                fputcsv($file, ['Active Sellers', $analytics['sellers']['active'], '', 'Period']);
                
                // Product data
                fputcsv($file, ['Total Products', $analytics['products']['total'], $analytics['products']['change'] . '%', 'Period']);
                fputcsv($file, ['Published Products', $analytics['products']['published'], '', 'Period']);
                
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        return back()->with('error', 'Export type not supported');
    }

    /**
     * Get comprehensive analytics data.
     */
    private function getAnalyticsData($dateFrom, $dateTo, $period)
    {
        $currentStart = Carbon::parse($dateFrom);
        $currentEnd = Carbon::parse($dateTo);
        
        // Calculate previous period for comparison
        $daysDiff = $currentStart->diffInDays($currentEnd);
        $previousStart = $currentStart->copy()->subDays($daysDiff + 1);
        $previousEnd = $currentStart->copy()->subDay();

        return [
            // Revenue Analytics
            'revenue' => $this->getRevenueAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd),
            
            // Order Analytics
            'orders' => $this->getOrderAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd),
            
            // User Analytics
            'users' => $this->getUserAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd),
            
            // Seller Analytics
            'sellers' => $this->getSellerAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd),
            
            // Product Analytics
            'products' => $this->getProductAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd),
            
            // Email Analytics
            'emails' => $this->getEmailAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd),
            
            // Performance Metrics
            'performance' => $this->getPerformanceMetrics($currentStart, $currentEnd),
            
            // Charts Data
            'charts' => $this->getChartsData($currentStart, $currentEnd, $period)
        ];
    }

    private function getRevenueAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd)
    {
        // Current period revenue
        $currentRevenue = Order::whereBetween('created_at', [$currentStart, $currentEnd])
            ->whereIn('status', ['completed', 'delivered'])
            ->sum('final_price');

        // Previous period revenue
        $previousRevenue = Order::whereBetween('created_at', [$previousStart, $previousEnd])
            ->whereIn('status', ['completed', 'delivered'])
            ->sum('final_price');

        // Calculate change percentage
        $revenueChange = $previousRevenue > 0 ? 
            round((($currentRevenue - $previousRevenue) / $previousRevenue) * 100, 1) : 0;

        // Average order value
        $orderCount = Order::whereBetween('created_at', [$currentStart, $currentEnd])
            ->whereIn('status', ['completed', 'delivered'])
            ->count();
        
        $averageOrderValue = $orderCount > 0 ? $currentRevenue / $orderCount : 0;

        return [
            'total' => $currentRevenue,
            'previous' => $previousRevenue,
            'change' => $revenueChange,
            'average_order_value' => $averageOrderValue
        ];
    }

    private function getOrderAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd)
    {
        // Current period orders
        $currentOrders = Order::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        $previousOrders = Order::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        $ordersChange = $previousOrders > 0 ? 
            round((($currentOrders - $previousOrders) / $previousOrders) * 100, 1) : 0;

        // Order status breakdown
        $statusBreakdown = Order::whereBetween('created_at', [$currentStart, $currentEnd])
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Success rate (completed + delivered orders)
        $successfulOrders = ($statusBreakdown['completed'] ?? 0) + ($statusBreakdown['delivered'] ?? 0);
        $successRate = $currentOrders > 0 ? round(($successfulOrders / $currentOrders) * 100, 1) : 0;

        return [
            'total' => $currentOrders,
            'previous' => $previousOrders,
            'change' => $ordersChange,
            'status_breakdown' => $statusBreakdown,
            'success_rate' => $successRate,
            'successful' => $successfulOrders
        ];
    }

    private function getUserAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd)
    {
        // Total users
        $totalUsers = User::count();
        $previousTotalUsers = User::where('created_at', '<', $currentStart)->count();
        
        // New users in current period
        $newUsers = User::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        $previousNewUsers = User::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        $userChange = $previousNewUsers > 0 ? 
            round((($newUsers - $previousNewUsers) / $previousNewUsers) * 100, 1) : 0;

        // Active users (users who placed orders in the period)
        $activeUsers = User::whereHas('orders', function($query) use ($currentStart, $currentEnd) {
            $query->whereBetween('created_at', [$currentStart, $currentEnd]);
        })->count();

        return [
            'total' => $totalUsers,
            'new' => $newUsers,
            'previous_new' => $previousNewUsers,
            'change' => $userChange,
            'active' => $activeUsers
        ];
    }

    private function getSellerAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd)
    {
        // Total sellers
        $totalSellers = Seller::count();
        
        // New sellers
        $newSellers = Seller::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        $previousNewSellers = Seller::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        $sellerChange = $previousNewSellers > 0 ? 
            round((($newSellers - $previousNewSellers) / $previousNewSellers) * 100, 1) : 0;

        // Active sellers (sellers with orders in the period)
        $activeSellers = Seller::whereHas('products', function($query) use ($currentStart, $currentEnd) {
            $query->whereHas('orderItems', function($q) use ($currentStart, $currentEnd) {
                $q->whereHas('order', function($order) use ($currentStart, $currentEnd) {
                    $order->whereBetween('created_at', [$currentStart, $currentEnd]);
                });
            });
        })->count();

        // Verified sellers
        $verifiedSellers = Seller::where('email_verified_at', '!=', null)->count();

        return [
            'total' => $totalSellers,
            'new' => $newSellers,
            'previous_new' => $previousNewSellers,
            'change' => $sellerChange,
            'active' => $activeSellers,
            'verified' => $verifiedSellers
        ];
    }

    private function getProductAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd)
    {
        // Total products
        $totalProducts = Product::count();
        
        // New products
        $newProducts = Product::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        $previousNewProducts = Product::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        $productChange = $previousNewProducts > 0 ? 
            round((($newProducts - $previousNewProducts) / $previousNewProducts) * 100, 1) : 0;

        // Published products
        $publishedProducts = Product::where('status', 'published')->count();

        return [
            'total' => $totalProducts,
            'new' => $newProducts,
            'previous_new' => $previousNewProducts,
            'change' => $productChange,
            'published' => $publishedProducts
        ];
    }

    private function getEmailAnalytics($currentStart, $currentEnd, $previousStart, $previousEnd)
    {
        // Current period emails
        $currentEmails = EmailLog::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        $previousEmails = EmailLog::whereBetween('created_at', [$previousStart, $previousEnd])->count();

        $emailChange = $previousEmails > 0 ? 
            round((($currentEmails - $previousEmails) / $previousEmails) * 100, 1) : 0;

        // Email success rate
        $sentEmails = EmailLog::whereBetween('created_at', [$currentStart, $currentEnd])
            ->where('status', 'sent')->count();
        
        $successRate = $currentEmails > 0 ? round(($sentEmails / $currentEmails) * 100, 1) : 0;

        // Failed emails
        $failedEmails = EmailLog::whereBetween('created_at', [$currentStart, $currentEnd])
            ->where('status', 'failed')->count();

        return [
            'total' => $currentEmails,
            'previous' => $previousEmails,
            'change' => $emailChange,
            'sent' => $sentEmails,
            'failed' => $failedEmails,
            'success_rate' => $successRate
        ];
    }

    private function getPerformanceMetrics($currentStart, $currentEnd)
    {
        // Conversion rate (orders / users)
        $totalUsers = User::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        $totalOrders = Order::whereBetween('created_at', [$currentStart, $currentEnd])->count();
        
        $conversionRate = $totalUsers > 0 ? round(($totalOrders / $totalUsers) * 100, 2) : 0;

        // Top performing products
        $topProducts = Product::withCount(['orderItems' => function($query) use ($currentStart, $currentEnd) {
                $query->whereHas('order', function($q) use ($currentStart, $currentEnd) {
                    $q->whereBetween('created_at', [$currentStart, $currentEnd]);
                });
            }])
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        // Top performing sellers
        $topSellers = Seller::select('sellers.*')
            ->selectSub(function($query) use ($currentStart, $currentEnd) {
                $query->selectRaw('COUNT(*)')
                    ->from('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->whereColumn('products.seller_id', 'sellers.id')
                    ->whereBetween('orders.created_at', [$currentStart, $currentEnd]);
            }, 'order_items_count')
            ->having('order_items_count', '>', 0)
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();

        return [
            'conversion_rate' => $conversionRate,
            'top_products' => $topProducts,
            'top_sellers' => $topSellers
        ];
    }

    private function getChartsData($currentStart, $currentEnd, $period)
    {
        // Daily revenue chart
        $revenueChart = [];
        $ordersChart = [];
        $usersChart = [];

        // Generate data points based on period
        if ($period === 'today') {
            // Hourly data for today
            for ($i = 0; $i < 24; $i++) {
                $hour = Carbon::today()->addHours($i);
                $nextHour = $hour->copy()->addHour();
                
                $revenue = Order::whereBetween('created_at', [$hour, $nextHour])
                    ->whereIn('status', ['completed', 'delivered'])
                    ->sum('final_price');
                
                $orders = Order::whereBetween('created_at', [$hour, $nextHour])->count();
                $users = User::whereBetween('created_at', [$hour, $nextHour])->count();
                
                $revenueChart[] = ['x' => $hour->format('H:00'), 'y' => $revenue];
                $ordersChart[] = ['x' => $hour->format('H:00'), 'y' => $orders];
                $usersChart[] = ['x' => $hour->format('H:00'), 'y' => $users];
            }
        } else {
            // Daily data for longer periods
            $days = $currentStart->diffInDays($currentEnd) + 1;
            
            for ($i = 0; $i < $days; $i++) {
                $date = $currentStart->copy()->addDays($i);
                $nextDate = $date->copy()->addDay();
                
                $revenue = Order::whereBetween('created_at', [$date, $nextDate])
                    ->whereIn('status', ['completed', 'delivered'])
                    ->sum('final_price');
                
                $orders = Order::whereBetween('created_at', [$date, $nextDate])->count();
                $users = User::whereBetween('created_at', [$date, $nextDate])->count();
                
                $revenueChart[] = ['x' => $date->format('M d'), 'y' => $revenue];
                $ordersChart[] = ['x' => $date->format('M d'), 'y' => $orders];
                $usersChart[] = ['x' => $date->format('M d'), 'y' => $users];
            }
        }

        return [
            'revenue' => $revenueChart,
            'orders' => $ordersChart,
            'users' => $usersChart
        ];
    }
}