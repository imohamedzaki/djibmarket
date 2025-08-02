@extends('layouts.app.seller')
@section('title', 'Analytics Dashboard')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Analytics Dashboard</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Analytics</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Business Analytics</h4>
                        <div class="nk-block-des">
                            <p>Comprehensive insights into your sales performance, customer behavior, and business growth in
                                Djibouti market.</p>
                        </div>
                    </div>
                </div>

                <!-- Revenue Stats Cards -->
                <div class="row g-3 mb-3">
                    <!-- Today's Revenue -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-primary bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-calendar text-primary fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-primary">
                                        <em class="icon ni ni-trending-up"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">{{ number_format($revenueAnalytics['today'], 0) }}
                                        DJF</h3>
                                    <p class="stat-label text-muted mb-2">
                                        Today's Revenue
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total revenue earned from all sales made today. This includes all completed orders from midnight to now.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary me-2">
                                            <em class="icon ni ni-coin"></em>
                                            Today
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- This Week Revenue -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-info bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-growth text-info fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-info">
                                        <em class="icon ni ni-arrow-up"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">
                                        {{ number_format($revenueAnalytics['this_week'], 0) }} DJF</h3>
                                    <p class="stat-label text-muted mb-2">
                                        This Week
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total revenue earned from all sales made in the current week (last 7 days). This helps you track weekly performance trends.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            <em class="icon ni ni-calendar-alt"></em>
                                            7 Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- This Month Revenue -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-success bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-bar-chart text-success fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-success">
                                        <em class="icon ni ni-trending-up"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">
                                        {{ number_format($revenueAnalytics['this_month'], 0) }} DJF</h3>
                                    <p class="stat-label text-muted mb-2">
                                        This Month
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total revenue earned from all sales made in the current month. This shows your monthly performance and helps with financial planning.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <em class="icon ni ni-check"></em>
                                            Current Month
                                        </span>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-success rounded" role="progressbar"
                                            style="width: {{ $revenueAnalytics['this_month'] > 0 ? min(($revenueAnalytics['this_month'] / max($revenueAnalytics['total'], 1)) * 100, 100) : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Revenue -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-warning bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-coin text-warning fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-warning">
                                        <em class="icon ni ni-money"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">{{ number_format($revenueAnalytics['total'], 0) }}
                                        DJF</h3>
                                    <p class="stat-label text-muted mb-2">
                                        Total Revenue
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total revenue earned from all sales since you started selling on the platform. This represents your complete earnings history.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-warning bg-opacity-10 text-warning">
                                            <em class="icon ni ni-trophy"></em>
                                            All Time
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales Stats Cards -->
                <div class="row g-3 mb-3">
                    <!-- Today's Sales -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-primary bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-package text-primary fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-primary">
                                        <em class="icon ni ni-arrow-up"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">{{ number_format($salesAnalytics['today']) }}</h3>
                                    <p class="stat-label text-muted mb-2">
                                        Today's Sales
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Number of individual items sold today. Each product unit sold counts as one sale, regardless of order quantity.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            <em class="icon ni ni-box"></em>
                                            Units Sold
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Sales -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-info bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-cart text-info fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-info">
                                        <em class="icon ni ni-trending-up"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">{{ number_format($salesAnalytics['this_week']) }}
                                    </h3>
                                    <p class="stat-label text-muted mb-2">
                                        This Week Sales
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total number of individual items sold in the current week (last 7 days). This helps track your weekly sales volume.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            <em class="icon ni ni-bag"></em>
                                            7 Days
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Sales -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-success bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-growth text-success fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-success">
                                        <em class="icon ni ni-arrow-up"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">{{ number_format($salesAnalytics['this_month']) }}
                                    </h3>
                                    <p class="stat-label text-muted mb-2">
                                        This Month Sales
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total number of individual items sold in the current month. This metric helps you understand monthly sales volume and inventory turnover.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <em class="icon ni ni-check"></em>
                                            Current Month
                                        </span>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-success rounded" role="progressbar"
                                            style="width: {{ $salesAnalytics['this_month'] > 0 ? min(($salesAnalytics['this_month'] / max($salesAnalytics['total'], 1)) * 100, 100) : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Sales -->
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-warning bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-trophy text-warning fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-warning">
                                        <em class="icon ni ni-star"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">{{ number_format($salesAnalytics['total']) }}
                                    </h3>
                                    <p class="stat-label text-muted mb-2">
                                        Total Sales
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total number of individual items sold since you started selling. This represents your complete sales volume across all time.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-warning bg-opacity-10 text-warning">
                                            <em class="icon ni ni-award"></em>
                                            All Time
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Analytics -->
                <div class="row g-3 mb-4">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-primary bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-users text-primary fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-primary">
                                        <em class="icon ni ni-user-add"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">
                                        {{ number_format($customerAnalytics['total_customers']) }}</h3>
                                    <p class="stat-label text-muted mb-2">
                                        Total Customers
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Total number of unique customers who have purchased from your store. Each customer is counted once, regardless of how many orders they placed.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            <em class="icon ni ni-user"></em>
                                            Customer Base
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-success bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-user-check text-success fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-success">
                                        <em class="icon ni ni-heart"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">
                                        {{ number_format($customerAnalytics['repeat_customers']) }}</h3>
                                    <p class="stat-label text-muted mb-2">
                                        Repeat Customers
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Number of customers who have made more than one purchase from your store. High repeat customer rate indicates customer satisfaction and loyalty.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <em class="icon ni ni-reload"></em>
                                            Returning
                                        </span>
                                    </div>
                                    @php
                                        $repeatRate =
                                            $customerAnalytics['total_customers'] > 0
                                                ? ($customerAnalytics['repeat_customers'] /
                                                        $customerAnalytics['total_customers']) *
                                                    100
                                                : 0;
                                    @endphp
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-success rounded" role="progressbar"
                                            style="width: {{ $repeatRate }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card stat-card border-0 shadow-sm h-100">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div class="stat-icon bg-info bg-opacity-10 p-2 rounded-3">
                                        <em class="icon ni ni-money text-info fs-5"></em>
                                    </div>
                                    <div class="stat-trend text-info">
                                        <em class="icon ni ni-coin"></em>
                                    </div>
                                </div>
                                <div class="stat-content">
                                    <h3 class="stat-number mb-1 fw-bold">
                                        {{ number_format($customerAnalytics['average_order_value'], 0) }} DJF</h3>
                                    <p class="stat-label text-muted mb-2">
                                        Avg Order Value
                                        <span class="help-icon ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Average amount spent per order by customers. This metric helps you understand customer spending patterns and optimize pricing strategies.">
                                            <em class="icon ni ni-help"></em>
                                        </span>
                                    </p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            <em class="icon ni ni-bar-chart"></em>
                                            Per Order
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Tables Section -->
                <div class="row g-gs">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Performance Overview</h6>
                                    </div>
                                    <div class="card-tools">
                                        <button class="btn btn-outline-primary btn-sm" onclick="refreshCharts()">
                                            <em class="icon ni ni-reload"></em>
                                            <span>Refresh</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Charts -->
                            <div class="card-inner">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="chart-container">
                                            <h6 class="mb-3">Monthly Revenue Trend</h6>
                                            <canvas id="monthlyRevenueChart" height="300"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="chart-container">
                                            <h6 class="mb-3">Daily Sales (Last 30 Days)</h6>
                                            <canvas id="dailySalesChart" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance Tables -->
                <div class="row g-gs mt-4">
                    <!-- Top Products -->
                    <div class="col-lg-6">
                        <div class="card card-bordered">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Top Performing Products</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-end">Units Sold</th>
                                                <th class="text-end">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($productPerformance as $product)
                                                <tr>
                                                    <td>
                                                        <div class="user-info">
                                                            <span
                                                                class="tb-lead">{{ Str::limit($product->title, 35) }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="fw-medium">{{ number_format($product->total_sold) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge bg-success">{{ number_format($product->total_revenue, 0) }}
                                                            DJF</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <em class="icon ni ni-box" style="font-size: 2rem;"></em>
                                                            <p class="mt-2">No sales data available yet.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Performance -->
                    <div class="col-lg-6">
                        <div class="card card-bordered">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Category Performance</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Category</th>
                                                <th class="text-end">Products</th>
                                                <th class="text-end">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categoryPerformance as $category)
                                                <tr>
                                                    <td>
                                                        <div class="user-info">
                                                            <span class="tb-lead">{{ $category->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="fw-medium">{{ number_format($category->products_count) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge bg-primary">{{ number_format($category->total_revenue, 0) }}
                                                            DJF</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <em class="icon ni ni-list" style="font-size: 2rem;"></em>
                                                            <p class="mt-2">No category data available yet.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ad Performance (if available) -->
                @if ($adPerformance)
                    <div class="row g-gs mt-4">
                        <div class="col-12">
                            <div class="card card-bordered">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Advertisement Performance (Last 30 Days)</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Ad Title</th>
                                                    <th class="text-end">Views</th>
                                                    <th class="text-end">Clicks</th>
                                                    <th class="text-end">CTR (%)</th>
                                                    <th class="text-end">Budget Used</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($adPerformance as $ad)
                                                    <tr>
                                                        <td>
                                                            <div class="user-info">
                                                                <span
                                                                    class="tb-lead">{{ Str::limit($ad['title'], 30) }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">{{ number_format($ad['views']) }}</td>
                                                        <td class="text-end">{{ number_format($ad['clicks']) }}</td>
                                                        <td class="text-end">
                                                            <span
                                                                class="badge {{ $ad['ctr'] > 2 ? 'bg-success' : ($ad['ctr'] > 1 ? 'bg-warning' : 'bg-danger') }}">
                                                                {{ $ad['ctr'] }}%
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span
                                                                class="small">{{ number_format($ad['budget_used'], 0) }}
                                                                / {{ number_format($ad['total_budget'], 0) }} DJF</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .stat-card {
            transition: all 0.3s ease;
            border-radius: 10px !important;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .stat-icon {
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.05);
        }

        .stat-number {
            font-size: 2rem;
            line-height: 1;
            font-weight: 700 !important;
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .stat-trend {
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-trend {
            opacity: 1;
        }

        .progress {
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.05);
        }

        .progress-bar {
            border-radius: 8px;
            transition: width 0.6s ease;
        }

        .badge {
            font-size: 0.7rem;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
            font-weight: 500;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        .help-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
            font-size: 10px;
            cursor: help;
            transition: all 0.2s ease;
        }

        .help-icon:hover {
            background: rgba(108, 117, 125, 0.2);
            color: #495057;
            transform: scale(1.1);
        }

        .help-icon em {
            font-size: .8rem;
        }

        @media (max-width: 768px) {
            .stat-number {
                font-size: 1.8rem;
            }

            .stat-card {
                margin-bottom: 0.75rem;
            }
        }

        /* Animation for loading */
        .stat-card .card-body {
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for each card */
        .stat-card:nth-child(1) .card-body {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) .card-body {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) .card-body {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) .card-body {
            animation-delay: 0.4s;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Revenue Chart
        const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        new Chart(monthlyRevenueCtx, {
            type: 'line',
            data: {
                labels: @json($monthlyRevenueChart['labels']),
                datasets: [{
                    label: 'Revenue (DJF)',
                    data: @json($monthlyRevenueChart['data']),
                    borderColor: '#5ce0aa',
                    backgroundColor: 'rgba(92, 224, 170, 0.1)',
                    tension: 0.3,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: '#5ce0aa',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' DJF';
                            }
                        }
                    }
                }
            }
        });

        // Daily Sales Chart
        const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
        new Chart(dailySalesCtx, {
            type: 'bar',
            data: {
                labels: @json($dailySalesChart['labels']),
                datasets: [{
                    label: 'Sales',
                    data: @json($dailySalesChart['data']),
                    backgroundColor: 'rgba(101, 118, 255, 0.8)',
                    borderColor: '#6576ff',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Refresh charts function
        function refreshCharts() {
            location.reload();
        }

        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover focus',
                    delay: {
                        show: 200,
                        hide: 100
                    }
                });
            });
        });
    </script>
@endsection
