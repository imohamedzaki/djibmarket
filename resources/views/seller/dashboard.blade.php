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
                                <h6 class="title mb-1">Top Selling Categories</h6>
                                <p>Categories ranked by total number of orders.</p>
                            </div>
                            <div class="card-tools">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                        data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#" class="active"><span>15 Days</span></a></li>
                                            <li><a href="#"><span>30 Days</span></a></li>
                                            <li><a href="#"><span>3 Months</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-title-group -->
                        @if (isset($topCategories) && count($topCategories) > 0)
                            <div class="d-flex">
                                <div class="h-250px mt-n2 flex-grow-1">
                                    <canvas class="course-progress-chart" id="courseProgress"></canvas>
                                </div>
                                <ul class="flex-shrink-0 gy-2">
                                    @foreach ($topCategories as $index => $category)
                                        <li class="align-center">
                                            <span class="dot dot-lg sq me-1"
                                                data-bg="{{ ['#f98c45', '#9cabff', '#8feac5', '#6b79c8', '#79f1dc', '#FF65B6', '#6A29FF'][$index % 7] }}"></span>
                                            <span>{{ $category->name }} ({{ $category->orders_count }} orders)</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- .nk-coin-ovwg -->
                        @else
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <em class="icon ni ni-pie-chart" style="font-size: 3rem; color: #526484;"></em>
                                </div>
                                <h6 class="text-muted mb-2">No Category Data</h6>
                                <p class="text-soft small">Category sales data will appear here<br>once orders are placed.
                                </p>
                            </div>
                        @endif
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

            <!-- Top Buyers Section -->
            <div class="col-md-6 col-xxl-4">
                <div class="card card-full">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Top Buyers</h6>
                                </div>
                                <div class="card-tools">
                                    <a href="#" class="link">View All</a>
                                </div>
                            </div>
                        </div>
                        @if (isset($topBuyers) && count($topBuyers) > 0)
                            @foreach ($topBuyers as $buyer)
                                <div class="card-inner card-inner-md">
                                    <div class="review-item d-flex justify-content-between">
                                        <div class="user-card">
                                            <div
                                                class="user-avatar bg-{{ ['primary', 'info', 'warning', 'pink'][$loop->index % 4] }}-dim">
                                                <span>{{ strtoupper(substr($buyer->name ?? 'BU', 0, 2)) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text">{{ $buyer->name ?? 'Unknown Buyer' }}</span>
                                                <span class="sub-text">{{ $buyer->email ?? 'No email' }}</span>
                                            </div>
                                        </div>
                                        <div class="review-status">
                                            <div class="buyer-stats text-end">
                                                <div class="spent-amount text-success fw-bold">
                                                    {{ number_format(($buyer->total_spent ?? 0) + 0) }} DJF</div>
                                                <div class="orders-count text-muted">{{ $buyer->total_orders ?? 0 }}
                                                    Orders</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card-inner card-inner-md">
                                <div class="text-center text-muted">
                                    <p>No buyer data available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->


            <div class="col-md-6 col-xxl-8">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Monthly Orders Activity</h6>
                                <p>Track your orders and total items sold over time.</p>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Orders count with total items quantity"></em>
                            </div>
                        </div>
                        <div class="analytic-au">
                            <div class="analytic-data-group analytic-au-group g-3">
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Monthly</div>
                                    <div class="sub-title text-soft small">[{{ now()->startOfMonth()->format('M d') }} - {{ now()->endOfMonth()->format('M d, Y') }}]</div>
                                    <div class="amount">{{ number_format($monthlyOrdersStats['monthly'] ?? 0) }} 
                                        <span class="small text-muted">({{ number_format($monthlyOrdersStats['monthly_items'] ?? 0) }} items)</span>
                                    </div>
                                    <div class="change up">
                                        <em class="icon ni ni-arrow-long-up"></em>
                                        {{ ($monthlyOrdersStats['monthly'] ?? 0) > 0 ? 'Active' : 'No Orders' }}
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Weekly</div>
                                    <div class="sub-title text-soft small">[{{ now()->startOfWeek()->format('M d') }} - {{ now()->endOfWeek()->format('M d, Y') }}]</div>
                                    <div class="amount">{{ number_format($monthlyOrdersStats['weekly'] ?? 0) }} 
                                        <span class="small text-muted">({{ number_format($monthlyOrdersStats['weekly_items'] ?? 0) }} items)</span>
                                    </div>
                                    <div class="change {{ ($monthlyOrdersStats['weekly'] ?? 0) > 0 ? 'up' : 'down' }}">
                                        <em
                                            class="icon ni ni-arrow-long-{{ ($monthlyOrdersStats['weekly'] ?? 0) > 0 ? 'up' : 'down' }}"></em>
                                        {{ ($monthlyOrdersStats['weekly'] ?? 0) > 0 ? 'Growing' : 'No Orders' }}
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Daily (Avg)</div>
                                    <div class="sub-title text-soft small">[{{ now()->format('M d, Y') }}]</div>
                                    <div class="amount">{{ number_format(($monthlyOrdersStats['daily_avg'] ?? 0) + 0) }}
                                        <span class="small text-muted">orders</span>
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

            <!-- Popular Payment Methods Section -->
            <div class="col-md-6 col-xxl-4">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Popular Payment Methods</h6>
                                <p class="text-soft small">Most used payment methods by your customers</p>
                            </div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                        data-bs-toggle="dropdown">Last 30 Days</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 7 Days</span></a></li>
                                            <li><a href="#" class="active"><span>Last 30 Days</span></a></li>
                                            <li><a href="#"><span>Last 90 Days</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-methods-list">
                            <div
                                class="payment-method-item d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/imgs/template/cacpay.png') }}" alt="CAC Pay"
                                        style="max-height: 32px; margin-right: 12px;">
                                    <div>
                                        <div class="fw-medium">CAC Pay</div>
                                        <div class="text-soft small">Digital wallet</div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-success fw-bold">{{ $paymentMethodsStats['cacPayOrders'] ?? 0 }}
                                        orders</div>
                                    <div class="text-soft small">42.3%</div>
                                </div>
                            </div>
                            <div
                                class="payment-method-item d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/imgs/template/waafi.png') }}" alt="Waafi"
                                        style="max-height: 32px; margin-right: 12px;">
                                    <div>
                                        <div class="fw-medium">Waafi</div>
                                        <div class="text-soft small">Mobile money</div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-success fw-bold">{{ $paymentMethodsStats['waafiOrders'] ?? 0 }}
                                        orders</div>
                                    <div class="text-soft small">28.7%</div>
                                </div>
                            </div>
                            <div
                                class="payment-method-item d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/imgs/template/dmoney.png') }}" alt="D Money"
                                        style="max-height: 32px; margin-right: 12px;">
                                    <div>
                                        <div class="fw-medium">D Money</div>
                                        <div class="text-soft small">Mobile payment</div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-success fw-bold">{{ $paymentMethodsStats['dmoneyOrders'] ?? 0 }}
                                        orders</div>
                                    <div class="text-soft small">19.6%</div>
                                </div>
                            </div>
                            <div
                                class="payment-method-item d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/imgs/template/SabaPay.jpg') }}" alt="Saba Pay"
                                        style="max-height: 32px; margin-right: 12px;">
                                    <div>
                                        <div class="fw-medium">Other Methods</div>
                                        <div class="text-soft small">Saba Pay, BCI Pay, etc.</div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-success fw-bold">
                                        {{ $paymentMethodsStats['otherPaymentOrders'] ?? 0 }} orders</div>
                                    <div class="text-soft small">9.4%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->



            <!-- Latest Orders Section -->
            <div class="col-md-6 col-xxl-8">
                <div class="card">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Latest Orders</h6>
                                <p>Recent orders from your customers</p>
                            </div>
                            <div class="card-tools">
                                <a href="#" class="link">View All Orders</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($latestOrders) && count($latestOrders) > 0)
                                        @foreach ($latestOrders as $order)
                                            <tr>
                                                <td><strong>#{{ $order->order_number }}</strong></td>
                                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                                <td>{{ $order->order_items_count ?? 0 }} items</td>
                                                <td>{{ number_format(($order->final_price ?? 0) + 0) }} DJF</td>
                                                <td>
                                                    @switch($order->status)
                                                        @case('completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @break

                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @break

                                                        @case('cancelled')
                                                            <span class="badge bg-danger">Cancelled</span>
                                                        @break

                                                        @case('processing')
                                                            <span class="badge bg-info">Processing</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                                    @endswitch
                                                </td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No orders found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                labels: @json($topCategories->pluck('name') ?? []),
                dataUnit: 'Orders',
                datasets: [{
                    label: "Orders Count",
                    backgroundColor: ["#f98c45", "#9cabff", "#8feac5", "#6b79c8", "#79f1dc", "#FF65B6",
                        "#6A29FF"
                    ],
                    data: @json($topCategories->pluck('orders_count') ?? []),
                    borderWidth: 0
                }]
            };

            // Ensure we have data, create default if empty
            const monthlyOrdersActivityChartData = {
                labels: currentMonthSalesData.length > 0 ? 
                    currentMonthSalesData.map(item => new Date(item.date).toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric'
                    })) : ['No Data'],
                dataUnit: 'Orders',
                lineTension: .1,
                datasets: [{
                    label: "Daily Orders",
                    color: "#9cabff",
                    background: "#9cabff",
                    data: currentMonthSalesData.length > 0 ? 
                        currentMonthSalesData.map(item => item.sales) : [0]
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

            function categoryDoughnutChartForCategories(selector, set_data) {
                var $selector = selector ? $(selector) : $('.course-progress-chart');
                $selector.each(function() {
                    var chart = new Chart($(this)[0].getContext("2d"), {
                        type: 'doughnut',
                        data: set_data,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    enabled: true,
                                    rtl: NioApp.State.isRTL,
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            const label = set_data.labels[tooltipItem.dataIndex];
                                            const value = set_data.datasets[0].data[tooltipItem
                                                .dataIndex];
                                            return label + ': ' + value + ' ' + set_data.dataUnit;
                                        }
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
                            cutout: '70%'
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

                // Top Categories Chart - only initialize if there's data
                @if (isset($topCategories) && count($topCategories) > 0)
                    categoryDoughnutChartForCategories('#courseProgress', topCategoriesChartData);
                @endif

                ordersActivityBarChart('#analyticAuData', monthlyOrdersActivityChartData);
                categoryDoughnutChart('#trafficSources', categoryPerformanceDoughnutData);
            });

        }(NioApp, jQuery);
    </script>
@endsection
