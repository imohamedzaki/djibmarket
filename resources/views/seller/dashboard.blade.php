@extends('layouts.app.seller')
@section('title', 'Seller Dashboard')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <style>
        /* Auto-resize large numbers */
        .amount.fw-normal {
            font-size: 1.75rem;
        }

        .amount.fw-normal:has-text {
            font-size: 1.5rem;
        }

        /* For very large numbers (over 1,000,000) */
        .large-number {
            font-size: 1.4rem !important;
            line-height: 1.2;
        }

        /* For medium numbers (over 100,000) */
        .medium-number {
            font-size: 1.6rem !important;
            line-height: 1.2;
        }
    </style>

    {{-- breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Home" type="first" link="{{ route('seller.dashboard') }}" />
        <x-breadcrumb.single title="Dashboard" />
    </x-breadcrumb.wrapper>

    {{-- Pending Status Alert --}}
    @include('includes.seller-pending-alert')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to your Seller Dashboard - Track your sales, products, and performance.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                        data-bs-toggle="dropdown">
                                        <em class="d-none d-sm-inline icon ni ni-calender-date"></em>
                                        <span><span class="d-none d-md-inline">Last</span>
                                            30 Days</span>
                                        <em class="dd-indc icon ni ni-chevron-right"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 30
                                                        Days</span></a></li>
                                            <li><a href="#"><span>Last 6
                                                        Months</span></a></li>
                                            <li><a href="#"><span>Last 1
                                                        Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt">
                                @if (Auth::guard('seller')->user()->status === 'pending')
                                    <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Product creation is only available when your seller application has been accepted">
                                        <button class="btn btn-primary" disabled>
                                            <em class="icon ni ni-lock"></em><span>Add Product (Locked)</span>
                                        </button>
                                    </span>
                                @else
                                    <a href="{{ route('seller.products.index') }}" class="btn btn-primary">
                                        <em class="icon ni ni-plus"></em><span>Add Product</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-6">
                <div class="row g-gs">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-2">
                                    <div class="card-title">
                                        <h6 class="title">Sales Revenue</h6>
                                        <p>Revenue from completed orders in last 30 days</p>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Total Revenue from Sales"></em>
                                    </div>
                                </div>
                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ number_format($stats['monthly_revenue'] ?? 0) }} DJF
                                                <span class="change up text-success">
                                                    <em class="icon ni ni-arrow-long-up"></em>
                                                    {{ $stats['monthly_revenue'] > 0 ? '↗' : '0%' }}
                                                </span>
                                            </span>
                                            <span class="sub-title">This Month</span>
                                        </div>
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ number_format($stats['weekly_revenue'] ?? 0) }} DJF
                                                <span class="change up text-success">
                                                    <em class="icon ni ni-arrow-long-up"></em>
                                                    {{ $stats['weekly_revenue'] > 0 ? '↗' : '0%' }}
                                                </span>
                                            </span>
                                            <span class="sub-title">This Week</span>
                                        </div>
                                    </div>
                                    <div class="nk-sales-ck sales-revenue">
                                        <canvas class="student-enrole" id="enrolement"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Sales</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount fw-normal">{{ number_format($stats['total_sales'] ?? 0) }}
                                            </div>
                                            <div class="info text-end">
                                                <span class="change up text-success">
                                                    <em class="icon ni ni-arrow-long-up"></em>Products Sold
                                                </span><br>
                                                <span>all time</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="courseSells" id="totalSells"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Revenue</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div
                                                class="amount fw-normal {{ ($stats['total_revenue'] ?? 0) >= 1000000 ? 'large-number' : (($stats['total_revenue'] ?? 0) >= 100000 ? 'medium-number' : '') }}">
                                                {{ number_format($stats['total_revenue'] ?? 0) }}
                                                DJF</div>
                                            <div class="info text-end">
                                                <span class="change up text-success">
                                                    <em class="icon ni ni-arrow-long-up"></em>Lifetime Earnings
                                                </span><br>
                                                <span>from all sales</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="courseSells" id="weeklySells"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .col -->
            <div class="col-lg-6">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-4">
                            <div class="card-title">
                                <h6 class="title mb-1">Top Product Categories</h6>
                                <p>Best performing categories by sales volume.</p>
                            </div>
                            <div class="card-tools">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                        data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#" class="active"><span>By Sales</span></a></li>
                                            <li><a href="#"><span>By Revenue</span></a></li>
                                            <li><a href="#"><span>By Products</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-title-group -->
                        <div class="d-flex">
                            <div class="h-250px mt-n2 flex-grow-1">
                                <canvas class="course-progress-chart" id="courseProgress"></canvas>
                            </div>
                            <ul class="flex-shrink-0 gy-2">
                                @if (isset($topCategories) && $topCategories->count() > 0)
                                    @foreach ($topCategories as $index => $category)
                                        <li class="align-center">
                                            <span class="dot dot-lg sq me-1"
                                                data-bg="{{ ['#f98c45', '#9cabff', '#8feac5', '#6b79c8', '#79f1dc', '#FF65B6', '#6A29FF'][$index % 7] }}"></span>
                                            <span>{{ $category->name ?? 'Uncategorized' }}
                                                ({{ $category->total_sold ?? 0 }} sold)
                                            </span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="align-center">
                                        <span class="dot dot-lg sq me-1" data-bg="#f98c45"></span>
                                        <span>No categories with sales yet</span>
                                    </li>
                                    <li class="align-center">
                                        <span class="dot dot-lg sq me-1" data-bg="#9cabff"></span>
                                        <span>Add products to see data</span>
                                    </li>
                                @endif
                            </ul>
                        </div><!-- .nk-coin-ovwg -->
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Top Products</h6>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                        data-bs-toggle="dropdown">By Sales</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#" class="active"><span>By Sales</span></a></li>
                                            <li><a href="#"><span>By Revenue</span></a></li>
                                            <li><a href="#"><span>By Views</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nk-top-products">
                            @if (isset($topProducts) && $topProducts->count() > 0)
                                @foreach ($topProducts as $product)
                                    <li class="item">
                                        <div class="user-avatar sq bg-primary-dim me-3">
                                            <span>{{ strtoupper(substr($product->title, 0, 2)) }}</span>
                                        </div>
                                        <div class="info">
                                            <div class="title">{{ Str::limit($product->title, 25) }}</div>
                                            <div class="price">{{ number_format($product->price_regular) }} DJF</div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">{{ number_format($product->total_revenue ?? 0) }} DJF
                                            </div>
                                            <div class="count">{{ $product->total_sold ?? 0 }} Sold</div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="item">
                                    <div class="user-avatar sq bg-light me-3">
                                        <span>--</span>
                                    </div>
                                    <div class="info">
                                        <div class="title">No products yet</div>
                                        <div class="price">Start selling</div>
                                    </div>
                                    <div class="total">
                                        <div class="amount">0 DJF</div>
                                        <div class="count">0 Sold</div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card card-full">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Recent Orders</h6>
                                </div>
                                <div class="card-tools">
                                    <a href="{{ route('seller.products.index') }}" class="link">View All Orders</a>
                                </div>
                            </div>
                        </div>
                        @if (isset($recentOrders) && $recentOrders->count() > 0)
                            @foreach ($recentOrders as $orderItem)
                                <div class="card-inner card-inner-md">
                                    <div class="review-item d-flex justify-content-between">
                                        <div class="user-card">
                                            <div class="user-avatar bg-primary-dim">
                                                <span>{{ strtoupper(substr($orderItem->order->user->name ?? 'U', 0, 2)) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span
                                                    class="lead-text">{{ $orderItem->order->user->name ?? 'Customer' }}</span>
                                                <span
                                                    class="sub-text">{{ $orderItem->product->title ?? 'Product' }}</span>
                                            </div>
                                        </div>
                                        <div class="review-status">
                                            <div class="amount">
                                                {{ number_format($orderItem->price * $orderItem->quantity) }} DJF</div>
                                            <div class="count">Qty: {{ $orderItem->quantity }}</div>
                                            <div class="status">
                                                <span
                                                    class="badge badge-{{ $orderItem->order->status == 'pending' ? 'warning' : 'success' }}">
                                                    {{ ucfirst($orderItem->order->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card-inner card-inner-md">
                                <div class="text-center py-4">
                                    <em class="icon ni ni-bag text-muted" style="font-size: 3rem;"></em>
                                    <h6 class="mt-2">No Orders Yet</h6>
                                    <p class="text-muted">Start selling products to see orders here</p>
                                    @if (Auth::guard('seller')->user()->status === 'pending')
                                        <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Product creation is only available when your seller application has been accepted">
                                            <button class="btn btn-primary btn-sm" disabled>
                                                <em class="icon ni ni-lock"></em> Add Product (Locked)
                                            </button>
                                        </span>
                                    @else
                                        <a href="{{ route('seller.products.index') }}" class="btn btn-primary btn-sm">
                                            <em class="icon ni ni-plus"></em> Add Product
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-4">
                <div class="card h-100">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Delivered Orders</h6>
                            </div>
                            <div class="card-tools">
                                <a href="{{ route('seller.products.index') }}" class="link">All Orders</a>
                            </div>
                        </div>
                    </div>
                    <ul class="nk-support">
                        @if (isset($deliveredOrders) && $deliveredOrders->count() > 0)
                            @foreach ($deliveredOrders->take(3) as $orderItem)
                                <li class="nk-support-item">
                                    <div class="user-avatar bg-success-dim">
                                        <span>{{ strtoupper(substr($orderItem->order->user->name ?? 'C', 0, 2)) }}</span>
                                    </div>
                                    <div class="nk-support-content">
                                        <div class="title">
                                            <span>{{ $orderItem->order->user->name ?? 'Customer' }}</span>
                                            <div class="status delivered">
                                                <em class="icon ni ni-check-circle-fill"></em>
                                            </div>
                                        </div>
                                        <p>{{ Str::limit($orderItem->product->title ?? 'Product', 40) }} - Qty:
                                            {{ $orderItem->quantity }}</p>
                                        <span class="time">{{ $orderItem->created_at->diffForHumans() }}</span>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="nk-support-item">
                                <div class="user-avatar bg-light">
                                    <em class="icon ni ni-package"></em>
                                </div>
                                <div class="nk-support-content">
                                    <div class="title">
                                        <span>No Delivered Orders</span>
                                        <div class="status unread">
                                            <em class="icon ni ni-info"></em>
                                        </div>
                                    </div>
                                    <p>You haven't delivered any orders yet. Keep selling!</p>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-8">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Monthly Orders Activity</h6>
                                <p>Track your orders performance over time.</p>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Orders of this month"></em>
                            </div>
                        </div>
                        <div class="analytic-au">
                            <div class="analytic-data-group analytic-au-group g-3">
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Monthly</div>
                                    <div class="amount">{{ number_format($monthlyOrdersStats['monthly'] ?? 0) }}</div>
                                    <div class="change up">
                                        <em class="icon ni ni-arrow-long-up"></em>
                                        {{ ($monthlyOrdersStats['monthly'] ?? 0) > 0 ? 'Active' : 'No Orders' }}
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Weekly</div>
                                    <div class="amount">{{ number_format($monthlyOrdersStats['weekly'] ?? 0) }}</div>
                                    <div class="change {{ ($monthlyOrdersStats['weekly'] ?? 0) > 0 ? 'up' : 'down' }}">
                                        <em
                                            class="icon ni ni-arrow-long-{{ ($monthlyOrdersStats['weekly'] ?? 0) > 0 ? 'up' : 'down' }}"></em>
                                        {{ ($monthlyOrdersStats['weekly'] ?? 0) > 0 ? 'Growing' : 'No Orders' }}
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Daily (Avg)</div>
                                    <div class="amount">{{ number_format($monthlyOrdersStats['daily_avg'] ?? 0, 1) }}
                                    </div>
                                    <div class="change up">
                                        <em class="icon ni ni-arrow-long-up"></em>
                                        Average
                                    </div>
                                </div>
                            </div>
                            <div class="analytic-au-ck">
                                <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                            </div>
                            <div class="chart-label-group">
                                <div class="chart-label">{{ now()->startOfMonth()->format('d M, Y') }}</div>
                                <div class="chart-label">{{ now()->endOfMonth()->format('d M, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card card-full overflow-hidden">
                    <div class="nk-ecwg nk-ecwg4 h-100">
                        <div class="card-inner flex-grow-1">
                            <div class="card-title-group mb-4">
                                <div class="card-title">
                                    <h6 class="title">Category Performance</h6>
                                </div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <a href="#"
                                            class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                            data-bs-toggle="dropdown">30 Days</a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><span>15
                                                            Days</span></a></li>
                                                <li><a href="#" class="active"><span>30
                                                            Days</span></a></li>
                                                <li><a href="#"><span>3
                                                            Months</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="data-group">
                                <div class="nk-ecwg4-ck">
                                    <canvas class="lms-doughnut-s1" id="trafficSources"></canvas>
                                </div>
                                <ul class="nk-ecwg4-legends">
                                    @if (isset($categorySalesStats) && $categorySalesStats->count() > 0)
                                        @foreach ($categorySalesStats as $index => $category)
                                            <li>
                                                <div class="title">
                                                    <span class="dot dot-lg sq"
                                                        data-bg="{{ ['#9cabff', '#ffa9ce', '#b8acff', '#f9db7b'][$index % 4] }}"></span>
                                                    <span>{{ $category->name ?? 'Uncategorized' }}</span>
                                                </div>
                                                <div class="amount amount-xs">
                                                    {{ number_format($category->total_sales ?? 0) }}</div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#9cabff"></span>
                                                <span>No Categories</span>
                                            </div>
                                            <div class="amount amount-xs">0</div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#ffa9ce"></span>
                                                <span>Add Products</span>
                                            </div>
                                            <div class="amount amount-xs">0</div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#b8acff"></span>
                                                <span>Start Selling</span>
                                            </div>
                                            <div class="amount amount-xs">0</div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="card-inner card-inner-md bg-light">
                            <div class="card-note">
                                <em class="icon ni ni-info-fill"></em>
                                <span>Product categories that have generated the most
                                    sales over the past month.</span>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
        </div>
    </div>

@endsection
@section('js')

    <!-- Include Chart Scripts -->
    <script>
        "use strict";

        ! function(NioApp, $) {
            "use strict";

            // Get data from Blade
            const revenueData = @json($revenueData ?? []);
            const salesData = @json($salesData ?? []);
            const categorySalesStats = @json($categorySalesStats ?? []);
            const currentMonthSalesData = @json($currentMonthSalesData ?? []);

            // Format data for charts
            const salesRevenueChartData = {
                labels: revenueData.map(item => new Date(item.date).toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                })),
                dataUnit: 'DJF',
                stacked: true,
                datasets: [{
                    label: "Sales Revenue",
                    color: NioApp.hexRGB("#6576ff", .2),
                    data: revenueData.map(item => item.revenue)
                }]
            };

            const topCategoriesChartData = {
                labels: categorySalesStats.map(item => item.name),
                dataUnit: 'Sales',
                stacked: true,
                datasets: [{
                    label: "Total Sold",
                    backgroundColor: ["#f98c45", "#9cabff", "#8feac5", "#6b79c8", "#79f1dc", "#FF65B6",
                        "#6A29FF"
                    ],
                    data: categorySalesStats.map(item => item.total_sales)
                }]
            };

            const monthlyOrdersActivityChartData = {
                labels: currentMonthSalesData.map(item => new Date(item.date).toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                })),
                dataUnit: 'Orders',
                lineTension: .1,
                datasets: [{
                    label: "Daily Orders",
                    color: "#9cabff",
                    background: "#9cabff",
                    data: currentMonthSalesData.map(item => item.sales)
                }]
            };

            const totalSalesChartData = {
                labels: salesData.map(item => new Date(item.date).toLocaleDateString('en-US', {
                    day: 'numeric'
                })),
                dataUnit: 'Sales',
                lineTension: .3,
                datasets: [{
                    label: "Sales",
                    color: "#6A29FF",
                    background: NioApp.hexRGB('#6A29FF', .25),
                    data: salesData.map(item => item.sales)
                }]
            };

            const totalRevenueChartData = {
                labels: revenueData.map(item => new Date(item.date).toLocaleDateString('en-US', {
                    day: 'numeric'
                })),
                dataUnit: 'DJF',
                lineTension: .3,
                datasets: [{
                    label: "Revenue",
                    color: "#4258FF",
                    background: NioApp.hexRGB('#4258FF', .25),
                    data: revenueData.map(item => item.revenue)
                }]
            };

            const categoryPerformanceDoughnutData = {
                labels: categorySalesStats.map(item => item.name),
                dataUnit: 'Sales',
                legend: false,
                datasets: [{
                    borderColor: "#fff",
                    backgroundColor: ["#9cabff", "#ffa9ce", "#b8acff", "#f9db7b"],
                    data: categorySalesStats.map(item => item.total_sales)
                }]
            };

            // Chart-drawing functions
            function salesRevenueBarChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.sales-bar-chart');
                $selector.each(function() {
                    var chart = new Chart($(this)[0].getContext("2d"), {
                        type: 'bar',
                        data: set_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true,
                                    rtl: NioApp.State.isRTL,
                                    callbacks: {
                                        title: () => false,
                                        label: (context) => `${context.parsed.y} ${set_data.dataUnit}`
                                    },
                                    backgroundColor: '#eff6ff',
                                    titleFont: {
                                        size: 11
                                    },
                                    titleColor: '#6783b8',
                                    titleMarginBottom: 4,
                                    bodyColor: '#9eaecf',
                                    bodyFont: {
                                        size: 10
                                    },
                                    bodySpacing: 3,
                                    padding: 8,
                                    footerMarginTop: 0,
                                    displayColors: false
                                }
                            },
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    display: false,
                                    stacked: true,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                },
                                x: {
                                    display: false,
                                    stacked: true
                                }
                            }
                        }
                    });
                });
            }

            function categoryBarChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.category-chart');
                $selector.each(function() {
                    var chart = new Chart($(this)[0].getContext("2d"), {
                        type: 'bar',
                        data: set_data,
                        options: {
                            indexAxis: 'y',
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true,
                                    rtl: NioApp.State.isRTL,
                                    callbacks: {
                                        label: (context) =>
                                            `${context.parsed.x} ${set_data.dataUnit}`
                                    },
                                    backgroundColor: '#eff6ff',
                                    titleFont: {
                                        size: 13
                                    },
                                    titleColor: '#6783b8',
                                    bodyColor: '#9eaecf',
                                    bodyFont: {
                                        size: 12
                                    },
                                    padding: 10,
                                    displayColors: false
                                }
                            },
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    display: false,
                                    stacked: true,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                },
                                x: {
                                    display: false,
                                    stacked: true
                                }
                            }
                        }
                    });
                });
            }

            function ordersActivityBarChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.analytics-au-chart');
                $selector.each(function() {
                    var chart = new Chart($(this)[0].getContext("2d"), {
                        type: 'bar',
                        data: set_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true,
                                    rtl: NioApp.State.isRTL,
                                    callbacks: {
                                        title: () => false,
                                        label: (context) => `${context.parsed.y} ${set_data.dataUnit}`
                                    },
                                    backgroundColor: '#eff6ff',
                                    titleFont: {
                                        size: 11
                                    },
                                    titleColor: '#6783b8',
                                    bodyColor: '#9eaecf',
                                    bodyFont: {
                                        size: 9
                                    },
                                    padding: 6,
                                    displayColors: false
                                }
                            },
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    display: false,
                                    ticks: {
                                        beginAtZero: false,
                                        stepSize: 300
                                    }
                                },
                                x: {
                                    display: false
                                }
                            }
                        }
                    });
                });
            }

            function lineChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.revenue-chart, .product-sales');
                $selector.each(function() {
                    var $self = $(this),
                        _self_id = $self.attr('id');
                    var chart = new Chart(document.getElementById(_self_id).getContext("2d"), {
                        type: 'line',
                        data: set_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true,
                                    rtl: NioApp.State.isRTL,
                                    callbacks: {
                                        label: (context) => `${context.parsed.y} ${set_data.dataUnit}`
                                    },
                                    backgroundColor: '#1c2b46',
                                    titleFont: {
                                        size: 10
                                    },
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    bodyFont: {
                                        size: 10
                                    },
                                    padding: 6,
                                    displayColors: false
                                }
                            },
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    display: false,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                },
                                x: {
                                    display: false,
                                    ticks: {
                                        reverse: NioApp.State.isRTL
                                    }
                                }
                            }
                        }
                    });
                });
            }

            function categoryDoughnutChart(selector, set_data) {
                var $selector = selector ? $(selector) : $('.lms-doughnut-s1');
                $selector.each(function() {
                    var chart = new Chart($(this)[0].getContext("2d"), {
                        type: 'doughnut',
                        data: set_data,
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true,
                                    rtl: NioApp.State.isRTL,
                                    callbacks: {
                                        label: (context) => `${context.parsed} ${set_data.dataUnit}`
                                    },
                                    backgroundColor: '#1c2b46',
                                    titleFont: {
                                        size: 13
                                    },
                                    titleColor: '#fff',
                                    bodyColor: '#fff',
                                    bodyFont: {
                                        size: 12
                                    },
                                    padding: 10,
                                    displayColors: false
                                }
                            },
                            rotation: -1.5,
                            cutout: '70%',
                            maintainAspectRatio: false
                        }
                    });
                });
            }

            // Initialize charts
            NioApp.coms.docReady.push(function() {
                salesRevenueBarChart('#enrolement', salesRevenueChartData);
                lineChart('#totalSells', totalSalesChartData);
                lineChart('#weeklySells', totalRevenueChartData);
                categoryBarChart('#courseProgress', topCategoriesChartData);
                ordersActivityBarChart('#analyticAuData', monthlyOrdersActivityChartData);
                categoryDoughnutChart('#trafficSources', categoryPerformanceDoughnutData);
            });

        }(NioApp, jQuery);
    </script>
@endsection
