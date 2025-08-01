<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\SellerAd;
use App\Models\Coupon;
use App\Models\FlashSale;
use Carbon\Carbon;

class SellerDashboardController extends Controller
{
    /**
     * Display the seller dashboard.
     */
    public function index(): View
    {
        $seller = Auth::guard('seller')->user();

        // Basic Stats
        $stats = [
            'total_products' => $seller->products()->count(),
            'active_products' => $seller->products()->where('status', 'published')->count(),
            'total_sales' => $this->getTotalSales($seller->id),
            'total_revenue' => $this->getTotalRevenue($seller->id),
            'pending_orders' => $this->getPendingOrdersCount($seller->id),
            'completed_orders' => $this->getCompletedOrdersCount($seller->id),
            'monthly_revenue' => $this->getMonthlyRevenue($seller->id),
            'weekly_revenue' => $this->getWeeklyRevenue($seller->id),
        ];

        // Top Products
        $topProducts = $this->getTopProducts($seller->id, 5);

        // Top Categories by Sales
        $topCategories = $this->getTopCategories($seller->id);

        // Recent Orders
        $recentOrders = $this->getRecentOrders($seller->id, 5);

        // Delivered Orders for Support Requests section
        $deliveredOrders = $this->getDeliveredOrders($seller->id, 5);

        // Monthly Orders Stats for Active Students section
        $monthlyOrdersStats = $this->getMonthlyOrdersStats($seller->id);

        // Category Sales Stats for Traffic Sources section
        $categorySalesStats = $this->getCategorySalesStats($seller->id);

        // Revenue Chart Data (Last 30 days)
        $revenueData = $this->getRevenueChartData($seller->id);

        // Sales Chart Data (Last 30 days)
        $salesData = $this->getSalesChartData($seller->id);

        // Sales data for current month
        $currentMonthSalesData = $this->getCurrentMonthSalesChartData($seller->id);

        // Top Buyers - customers who ordered most from this seller
        $topBuyers = $this->getTopBuyers($seller->id, 5);

        // Payment methods usage for this seller's orders
        $paymentMethodsStats = $this->getPaymentMethodsStats($seller->id);

        // Latest Orders for this seller
        $latestOrders = $this->getLatestOrders($seller->id, 10);

        // Advertisement Stats (if available)
        $adStats = [
            'total_ads' => $seller->ads()->count(),
            'active_ads' => $seller->ads()->active()->count(),
            'total_views' => $seller->ads()->sum('current_views'),
            'total_clicks' => $seller->ads()->sum('current_clicks'),
        ];

        return view('seller.dashboard', compact(
            'stats',
            'topProducts',
            'topCategories',
            'recentOrders',
            'deliveredOrders',
            'monthlyOrdersStats',
            'categorySalesStats',
            'revenueData',
            'salesData',
            'currentMonthSalesData',
            'topBuyers',
            'paymentMethodsStats',
            'latestOrders',
            'adStats'
        ));
    }

    private function getTotalSales($sellerId)
    {
        return OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->whereIn('status', ['completed', 'delivered']);
        })->sum('quantity');
    }

    private function getTotalRevenue($sellerId)
    {
        return OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->whereIn('status', ['completed', 'delivered']);
        })->sum(DB::raw('quantity * price'));
    }

    private function getPendingOrdersCount($sellerId)
    {
        return OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->where('status', 'pending');
        })->count();
    }

    private function getCompletedOrdersCount($sellerId)
    {
        return OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->whereIn('status', ['completed', 'delivered']);
        })->count();
    }

    private function getMonthlyRevenue($sellerId)
    {
        return OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->whereIn('status', ['completed', 'delivered'])
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        })->sum(DB::raw('quantity * price'));
    }

    private function getWeeklyRevenue($sellerId)
    {
        return OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->whereIn('status', ['completed', 'delivered'])
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        })->sum(DB::raw('quantity * price'));
    }

    private function getTopProducts($sellerId, $limit = 5)
    {
        return Product::where('seller_id', $sellerId)
            ->withCount(['orderItems as total_sold' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereIn('status', ['completed', 'delivered']);
                });
            }])
            ->withSum(['orderItems as total_revenue' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->whereIn('status', ['completed', 'delivered']);
                });
            }], DB::raw('quantity * price'))
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();
    }

    private function getTopCategories($sellerId)
    {
        return Category::select('categories.*')
            ->selectRaw('COALESCE(COUNT(DISTINCT orders.id), 0) as orders_count')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->leftJoin('products', function ($join) use ($sellerId) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where('products.seller_id', $sellerId);
            })
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '!=', 'cancelled');
            })
            ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.created_at', 'categories.updated_at')
            ->having('orders_count', '>', 0)
            ->orderByDesc('orders_count')
            ->take(7)
            ->get();
    }

    private function getRecentOrders($sellerId, $limit = 5)
    {
        return OrderItem::with(['order.user', 'product'])
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->latest()
            ->take($limit)
            ->get();
    }

    private function getRevenueChartData($sellerId)
    {
        $data = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenue = OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })->whereHas('order', function ($query) use ($date) {
                $query->whereIn('status', ['completed', 'delivered'])
                    ->whereDate('created_at', $date);
            })->sum(DB::raw('quantity * price'));

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'revenue' => $revenue
            ];
        }
        return $data;
    }

    private function getSalesChartData($sellerId)
    {
        $data = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $sales = OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })->whereHas('order', function ($query) use ($date) {
                $query->whereIn('status', ['completed', 'delivered'])
                    ->whereDate('created_at', $date);
            })->sum('quantity');

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'sales' => $sales
            ];
        }
        return $data;
    }

    private function getDeliveredOrders($sellerId, $limit = 5)
    {
        return OrderItem::with(['order.user', 'product'])
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->whereHas('order', function ($query) {
                $query->whereIn('status', ['delivered', 'completed']);
            })
            ->latest()
            ->take($limit)
            ->get();
    }

    private function getMonthlyOrdersStats($sellerId)
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Count distinct orders (not order items) for monthly
        $monthlyOrders = Order::whereHas('orderItems.product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->distinct()
            ->count();

        // Sum total quantity of items for monthly
        $monthlyOrderItems = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        })->sum('quantity');

        $monthlyRevenue = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) use ($currentMonth, $currentYear) {
            $query->whereIn('status', ['completed', 'delivered'])
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        })->sum(DB::raw('quantity * price'));

        // Count distinct orders (not order items) for weekly
        $weeklyOrders = Order::whereHas('orderItems.product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->distinct()
            ->count();

        // Sum total quantity of items for weekly
        $weeklyOrderItems = OrderItem::whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->whereHas('order', function ($query) {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        })->sum('quantity');

        $dailyAverage = $monthlyOrders > 0 ? round($monthlyOrders / now()->day, 2) : 0;

        return [
            'monthly' => $monthlyOrders,
            'monthly_items' => $monthlyOrderItems,
            'weekly' => $weeklyOrders,
            'weekly_items' => $weeklyOrderItems,
            'daily_avg' => $dailyAverage,
            'monthly_revenue' => $monthlyRevenue
        ];
    }

    private function getCategorySalesStats($sellerId)
    {
        return Category::select('categories.*')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sales')
            ->selectRaw('COALESCE(COUNT(DISTINCT orders.id), 0) as order_count')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.status', ['completed', 'delivered']);
            })
            ->where('products.seller_id', $sellerId)
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByDesc('total_sales')
            ->take(4)
            ->get();
    }

    private function getCurrentMonthSalesChartData($sellerId)
    {
        $data = [];
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $currentDate = $startOfMonth->copy();

        while ($currentDate->lte($endOfMonth)) {
            // Include all orders except cancelled ones
            $sales = OrderItem::whereHas('product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })->whereHas('order', function ($query) use ($currentDate) {
                $query->where('status', '!=', 'cancelled')
                    ->whereDate('created_at', $currentDate->format('Y-m-d'));
            })->sum('quantity');

            $data[] = [
                'date' => $currentDate->format('Y-m-d'),
                'sales' => (int)$sales
            ];
            
            $currentDate->addDay();
        }
        return $data;
    }

    private function getTopBuyers($sellerId, $limit = 5)
    {
        return DB::table('users')
            ->select('users.*')
            ->selectRaw('COUNT(DISTINCT orders.id) as total_orders')
            ->selectRaw('SUM(order_items.quantity * order_items.price) as total_spent')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('products.seller_id', $sellerId)
            ->where('orders.status', '!=', 'cancelled')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at')
            ->orderByDesc('total_orders')
            ->limit($limit)
            ->get();
    }

    private function getPaymentMethodsStats($sellerId)
    {
        // Get total orders for this seller to calculate percentages
        $totalOrders = Order::whereHas('orderItems.product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->where('status', '!=', 'cancelled')->count();

        if ($totalOrders == 0) {
            return [
                'cacPayOrders' => 0,
                'waafiOrders' => 0,
                'dmoneyOrders' => 0,
                'otherPaymentOrders' => 0,
            ];
        }

        // Mock data based on proportions - in a real app, you'd have payment_method field in orders table
        return [
            'cacPayOrders' => max(1, intval($totalOrders * 0.423)),
            'waafiOrders' => max(1, intval($totalOrders * 0.287)),
            'dmoneyOrders' => max(1, intval($totalOrders * 0.196)),
            'otherPaymentOrders' => max(1, $totalOrders - intval($totalOrders * 0.906)),
        ];
    }

    private function getLatestOrders($sellerId, $limit = 10)
    {
        return Order::with(['user'])
            ->withCount('orderItems as order_items_count')
            ->whereHas('orderItems.product', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
