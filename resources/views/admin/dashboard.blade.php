@extends('layouts.app.admin')
@section('title', 'Dashboard')
@section('content')
    {{-- breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Home" type="first" link="{{ route('admin.dashboard') }}" />
        <x-breadcrumb.single title="Dashboard" />
    </x-breadcrumb.wrapper>

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to DjibMarket E-commerce Admin Dashboard.</p>
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
                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em
                                        class="icon ni ni-reports"></em><span>Reports</span></a>
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
                                        <h6 class="title">Customer Registration</h6>
                                        <p>New customer registrations in the last 30 days</p>
                                    </div>
                                    <div class="card-tools">
                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Customer Registration"></em>
                                    </div>
                                </div>
                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ $monthlyCustomers ?? 245 }} <span
                                                    class="change {{ ($monthlyCustomersChange ?? 0) >= 0 ? 'up text-success' : 'down text-danger' }}"><em
                                                        class="icon ni ni-arrow-long-{{ ($monthlyCustomersChange ?? 0) >= 0 ? 'up' : 'down' }}"></em>{{ abs($monthlyCustomersChange ?? 12.5) }}%</span></span>
                                            <span class="sub-title">This Month</span>
                                        </div>
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ $weeklyCustomers ?? 67 }}<span
                                                    class="change {{ ($weeklyCustomersChange ?? 0) >= 0 ? 'up text-success' : 'down text-danger' }}"><em
                                                        class="icon ni ni-arrow-long-{{ ($weeklyCustomersChange ?? 0) >= 0 ? 'up' : 'down' }}"></em>{{ abs($weeklyCustomersChange ?? 8.4) }}%</span></span>
                                            <span class="sub-title">This Week</span>
                                        </div>
                                    </div>
                                    <div class="nk-sales-ck sales-revenue">
                                        <canvas class="customer-registration" id="customerRegistration"></canvas>
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
                                            <div class="amount fw-normal" style="font-size: 1.1rem; word-break: break-all;">
                                                @if (($totalSales ?? 9495.2) >= 1000000)
                                                    {{ number_format(($totalSales ?? 9495.2) / 1000000, 1) }}M DJF
                                                @elseif(($totalSales ?? 9495.2) >= 1000)
                                                    {{ number_format(($totalSales ?? 9495.2) / 1000, 1) }}K DJF
                                                @else
                                                    {{ number_format($totalSales ?? 9495.2, 2) }} DJF
                                                @endif
                                            </div>
                                            <div class="info text-end">
                                                <span class="change up text-success"><em
                                                        class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs.
                                                    last month</span>
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
                                            <h6 class="title">This week so far</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount fw-normal" style="font-size: 1.1rem; word-break: break-all;">
                                                @if (($weeklySales ?? 2995.81) >= 1000000)
                                                    {{ number_format(($weeklySales ?? 2995.81) / 1000000, 1) }}M DJF
                                                @elseif(($weeklySales ?? 2995.81) >= 1000)
                                                    {{ number_format(($weeklySales ?? 2995.81) / 1000, 1) }}K DJF
                                                @else
                                                    {{ number_format($weeklySales ?? 2995.81, 2) }} DJF
                                                @endif
                                            </div>
                                            <div class="info text-end"><span class="change up text-success"><em
                                                        class="icon ni ni-arrow-long-up"></em>7.13%</span><br><span>vs.
                                                    last week</span></div>
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
                                            <li><a href="#" class="active"><span>15
                                                        Days</span></a></li>
                                            <li><a href="#"><span>30 Days</span></a>
                                            </li>
                                            <li><a href="#"><span>3 Months</span></a>
                                            </li>
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
                                        data-bs-toggle="dropdown">Weekly</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Daily</span></a>
                                            </li>
                                            <li><a href="#" class="active"><span>Weekly</span></a>
                                            </li>
                                            <li><a href="#"><span>Monthly</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nk-top-products">
                            @if (isset($topProducts) && count($topProducts) > 0)
                                @foreach ($topProducts->take(5) as $product)
                                    <li class="item">
                                        <div
                                            class="user-avatar sq bg-{{ ['success', 'warning', 'danger', 'primary', 'info'][$loop->index % 5] }}-dim me-3">
                                            <span>{{ strtoupper(substr($product->title ?? 'PR', 0, 2)) }}</span>
                                        </div>
                                        <div class="info">
                                            <div class="title">
                                                {{ strlen($product->title ?? 'Product Name') > 25 ? substr($product->title ?? 'Product Name', 0, 25) . '...' : $product->title ?? 'Product Name' }}
                                            </div>
                                            <div class="price">{{ number_format($product->price_regular ?? 0, 2) }} DJF
                                            </div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">
                                                {{ number_format(($product->price_regular ?? 0) * ($product->total_sold ?? 0), 2) }}
                                                DJF</div>
                                            <div class="count">{{ $product->total_sold ?? 0 }} Sold</div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="item">
                                    <div class="user-avatar sq bg-secondary-dim me-3">
                                        <span>--</span>
                                    </div>
                                    <div class="info">
                                        <div class="title">No products available</div>
                                        <div class="price">0.00 DJF</div>
                                    </div>
                                    <div class="total">
                                        <div class="amount">0.00 DJF</div>
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
                                    <h6 class="title">Top Sellers</h6>
                                </div>
                                <div class="card-tools">
                                    <a href="#" class="link">View All</a>
                                </div>
                            </div>
                        </div>
                        @if (isset($topSellers) && count($topSellers) > 0)
                            @foreach ($topSellers as $seller)
                                <div class="card-inner card-inner-md">
                                    <div class="review-item d-flex justify-content-between">
                                        <div class="user-card">
                                            <div
                                                class="user-avatar bg-{{ ['primary', 'info', 'warning', 'pink'][$loop->index % 4] }}-dim">
                                                <span>{{ strtoupper(substr($seller->name ?? 'SE', 0, 2)) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text">{{ $seller->name ?? 'Unknown Seller' }}</span>
                                                <span class="sub-text">{{ $seller->email ?? 'No email' }}</span>
                                            </div>
                                        </div>
                                        <div class="review-status">
                                            <div class="seller-stats text-end">
                                                <div class="sales-amount text-success fw-bold">
                                                    {{ number_format($seller->total_sales ?? 0, 2) }} DJF</div>
                                                <div class="sales-count text-muted">{{ $seller->total_orders ?? 0 }}
                                                    Orders</div>
                                                <div class="products-count text-soft small">
                                                    {{ $seller->products_count ?? 0 }} Products</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card-inner card-inner-md">
                                <div class="text-center text-muted">
                                    <p>No seller data available</p>
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
                                <h6 class="title">Support Requests</h6>
                            </div>
                            <div class="card-tools">
                                <a href="#" class="link">All Requests</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <em class="icon ni ni-construction" style="font-size: 3rem; color: #526484;"></em>
                        </div>
                        <h6 class="text-muted mb-2">Coming Soon</h6>
                        <p class="text-soft small">Support request system is under development.<br>This feature will be
                            available soon.</p>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-6 col-xxl-8">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start pb-3 g-2">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Customer Activity</h6>
                                <p>Customer engagement and activity over time.</p>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Users of this month"></em>
                            </div>
                        </div>
                        <div class="analytic-au">
                            <div class="analytic-data-group analytic-au-group g-3">
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Monthly</div>
                                    <div class="amount">{{ number_format($monthlyActiveCustomers ?? 1850) }}</div>
                                    <div
                                        class="change {{ ($monthlyActiveCustomersChange ?? 4.63) >= 0 ? 'up' : 'down' }}">
                                        <em
                                            class="icon ni ni-arrow-long-{{ ($monthlyActiveCustomersChange ?? 4.63) >= 0 ? 'up' : 'down' }}"></em>{{ abs($monthlyActiveCustomersChange ?? 4.63) }}%
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Weekly</div>
                                    <div class="amount">{{ number_format($weeklyActiveCustomers ?? 467) }}</div>
                                    <div
                                        class="change {{ ($weeklyActiveCustomersChange ?? -1.92) >= 0 ? 'up' : 'down' }}">
                                        <em
                                            class="icon ni ni-arrow-long-{{ ($weeklyActiveCustomersChange ?? -1.92) >= 0 ? 'up' : 'down' }}"></em>{{ abs($weeklyActiveCustomersChange ?? 1.92) }}%
                                    </div>
                                </div>
                                <div class="analytic-data analytic-au-data">
                                    <div class="title">Daily (Avg)</div>
                                    <div class="amount">{{ number_format($dailyActiveCustomers ?? 89) }}</div>
                                    <div class="change {{ ($dailyActiveCustomersChange ?? 3.45) >= 0 ? 'up' : 'down' }}">
                                        <em
                                            class="icon ni ni-arrow-long-{{ ($dailyActiveCustomersChange ?? 3.45) >= 0 ? 'up' : 'down' }}"></em>{{ abs($dailyActiveCustomersChange ?? 3.45) }}%
                                    </div>
                                </div>
                            </div>
                            @if (isset($monthlyActiveCustomers) && $monthlyActiveCustomers > 0)
                                <div class="analytic-au-ck">
                                    <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <em class="icon ni ni-activity" style="font-size: 2rem; color: #526484;"></em>
                                    <p class="text-soft small mt-2">Customer activity chart will show<br>when there's
                                        customer data</p>
                                </div>
                            @endif
                            <div class="chart-label-group">
                                <div class="chart-label">01 Jan, 2020</div>
                                <div class="chart-label">30 Jan, 2020</div>
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
                                    <h6 class="title">Order Sources</h6>
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
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#9cabff"></span>
                                            <span>Mobile App</span>
                                        </div>
                                        <div class="amount amount-xs">{{ $mobileOrders ?? 234 }}</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#ffa9ce"></span>
                                            <span>Website</span>
                                        </div>
                                        <div class="amount amount-xs">{{ $websiteOrders ?? 186 }}</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#b8acff"></span>
                                            <span>Social Media</span>
                                        </div>
                                        <div class="amount amount-xs">{{ $socialOrders ?? 97 }}</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <span class="dot dot-lg sq" data-bg="#f9db7b"></span>
                                            <span>Direct</span>
                                        </div>
                                        <div class="amount amount-xs">{{ $directOrders ?? 45 }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="card-inner card-inner-md bg-light">
                            <div class="card-note">
                                <em class="icon ni ni-info-fill"></em>
                                <span>Order sources showing where customers are placing orders from over the past 30
                                    days.</span>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            <!-- Payment Methods Usage Section -->
            <div class="col-md-6 col-xxl-4">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Popular Payment Methods</h6>
                                <p class="text-soft small">Most used payment methods by customers</p>
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
                                    <div class="text-success fw-bold">{{ $cacPayOrders ?? 145 }} orders</div>
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
                                    <div class="text-success fw-bold">{{ $waafiOrders ?? 98 }} orders</div>
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
                                    <div class="text-success fw-bold">{{ $dmoneyOrders ?? 67 }} orders</div>
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
                                    <div class="text-success fw-bold">{{ $otherPaymentOrders ?? 32 }} orders</div>
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
                                <p>Recent orders from customers</p>
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
                                        <th>Seller</th>
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
                                                <td>
                                                    @php
                                                        $sellers = $order->orderItems->pluck('product.seller.name')->filter()->unique();
                                                    @endphp
                                                    @if($sellers->count() > 1)
                                                        <span class="text-muted">Multiple Sellers</span>
                                                    @elseif($sellers->count() == 1)
                                                        {{ $sellers->first() }}
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->order_items_count ?? 0 }} items</td>
                                                <td>{{ number_format($order->final_price ?? 0, 2) }} DJF</td>
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
                                            <td colspan="7" class="text-center">No orders found</td>
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

@push('styles')
    <style>
        /* Fix footer positioning */
        html,
        body {
            height: 100%;
        }

        .nk-app-root {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .nk-main {
            display: flex;
            flex: 1;
        }

        .nk-wrap {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nk-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nk-footer {
            margin-top: auto;
        }

        /* Ensure dashboard content doesn't overflow */
        .container-fluid {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .nk-content-inner {
            flex: 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Top Categories Chart Data
            @if (isset($topCategories) && count($topCategories) > 0)
                const categoryData = @json($topCategories);
                const categoryLabels = categoryData.map(cat => cat.name);
                const categoryValues = categoryData.map(cat => cat.orders_count);
                const categoryColors = ['#f98c45', '#9cabff', '#8feac5', '#6b79c8', '#79f1dc', '#FF65B6',
                '#6A29FF'];

                // Initialize category chart if canvas exists
                const categoryCanvas = document.getElementById('courseProgress');
                if (categoryCanvas && categoryCanvas.getContext) {
                    const ctx = categoryCanvas.getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: categoryLabels,
                            datasets: [{
                                data: categoryValues,
                                backgroundColor: categoryColors.slice(0, categoryValues.length),
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        const label = data.labels[tooltipItem.index];
                                        const value = data.datasets[0].data[tooltipItem.index];
                                        return label + ': ' + value + ' orders';
                                    }
                                }
                            }
                        }
                    });
                }
            @endif

            // Customer Activity Chart Data
            @if (isset($monthlyActiveCustomers) && $monthlyActiveCustomers > 0)
                const activityCanvas = document.getElementById('analyticAuData');
                if (activityCanvas && activityCanvas.getContext) {
                    const ctx2 = activityCanvas.getContext('2d');
                    // Mock data for the chart - you can replace with actual time series data later
                    const activityData = {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        datasets: [{
                            label: 'Active Customers',
                            data: [{{ $weeklyActiveCustomers ?? 120 }},
                                {{ intval(($weeklyActiveCustomers ?? 120) * 1.1) }},
                                {{ intval(($weeklyActiveCustomers ?? 120) * 0.9) }},
                                {{ $weeklyActiveCustomers ?? 120 }}
                            ],
                            borderColor: '#6576ff',
                            backgroundColor: 'rgba(101, 118, 255, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    };

                    new Chart(ctx2, {
                        type: 'line',
                        data: activityData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                }
            @endif
        });
    </script>
@endpush
