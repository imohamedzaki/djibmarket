@extends('layouts.app.admin')

@section('title', 'Analytics Dashboard')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Analytics Dashboard</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Comprehensive analytics and insights for your marketplace</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <button class="btn btn-outline-primary btn-sm" onclick="refreshData()">
                                        <em class="icon ni ni-reload"></em>
                                        <span>Refresh</span>
                                    </button>
                                    <button class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal"
                                        data-bs-target="#exportModal">
                                        <em class="icon ni ni-download"></em>
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Metrics Cards -->
            <div class="row g-4 mb-4">
                <!-- Revenue Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="stat-icon bg-success bg-opacity-10 p-3 rounded-3">
                                    <em class="icon ni ni-coins text-success fs-4"></em>
                                </div>
                                <div class="stat-trend {{ $analytics['revenue']['change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <em class="icon ni ni-{{ $analytics['revenue']['change'] >= 0 ? 'trending-up' : 'trending-down' }}"></em>
                                </div>
                            </div>
                            <div class="stat-content">
                                <h2 class="stat-number mb-1 fw-bold text-success">{{ number_format($analytics['revenue']['total']) }} DJF</h2>
                                <p class="stat-label text-muted mb-2">Total Revenue</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge {{ $analytics['revenue']['change'] >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $analytics['revenue']['change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        <em class="icon ni ni-{{ $analytics['revenue']['change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></em>
                                        {{ abs($analytics['revenue']['change']) }}% vs previous period
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Avg Order: {{ number_format($analytics['revenue']['average_order_value']) }} DJF</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="stat-icon bg-primary bg-opacity-10 p-3 rounded-3">
                                    <em class="icon ni ni-cart text-primary fs-4"></em>
                                </div>
                                <div class="stat-trend {{ $analytics['orders']['change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <em class="icon ni ni-{{ $analytics['orders']['change'] >= 0 ? 'trending-up' : 'trending-down' }}"></em>
                                </div>
                            </div>
                            <div class="stat-content">
                                <h2 class="stat-number mb-1 fw-bold text-primary">{{ number_format($analytics['orders']['total']) }}</h2>
                                <p class="stat-label text-muted mb-2">Total Orders</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge {{ $analytics['orders']['change'] >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $analytics['orders']['change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        <em class="icon ni ni-{{ $analytics['orders']['change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></em>
                                        {{ abs($analytics['orders']['change']) }}% vs previous period
                                    </span>
                                </div>
                                <div class="progress mt-3" style="height: 6px;">
                                    <div class="progress-bar bg-primary rounded" role="progressbar"
                                        style="width: {{ $analytics['orders']['success_rate'] }}%">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Success Rate: {{ $analytics['orders']['success_rate'] }}%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="stat-icon bg-info bg-opacity-10 p-3 rounded-3">
                                    <em class="icon ni ni-users text-info fs-4"></em>
                                </div>
                                <div class="stat-trend {{ $analytics['users']['change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <em class="icon ni ni-{{ $analytics['users']['change'] >= 0 ? 'trending-up' : 'trending-down' }}"></em>
                                </div>
                            </div>
                            <div class="stat-content">
                                <h2 class="stat-number mb-1 fw-bold text-info">{{ number_format($analytics['users']['total']) }}</h2>
                                <p class="stat-label text-muted mb-2">Total Users</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge {{ $analytics['users']['change'] >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $analytics['users']['change'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        <em class="icon ni ni-{{ $analytics['users']['change'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></em>
                                        {{ abs($analytics['users']['change']) }}% new users
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">New: {{ number_format($analytics['users']['new']) }} | Active: {{ number_format($analytics['users']['active']) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conversion Rate Card -->
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="stat-icon bg-warning bg-opacity-10 p-3 rounded-3">
                                    <em class="icon ni ni-growth text-warning fs-4"></em>
                                </div>
                                <div class="stat-trend text-info">
                                    <em class="icon ni ni-trending-up"></em>
                                </div>
                            </div>
                            <div class="stat-content">
                                <h2 class="stat-number mb-1 fw-bold text-warning">{{ $analytics['performance']['conversion_rate'] }}%</h2>
                                <p class="stat-label text-muted mb-2">Conversion Rate</p>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-info bg-opacity-10 text-info">
                                        <em class="icon ni ni-target"></em>
                                        Orders per User
                                    </span>
                                </div>
                                <div class="progress mt-3" style="height: 6px;">
                                    <div class="progress-bar bg-warning rounded" role="progressbar"
                                        style="width: {{ min($analytics['performance']['conversion_rate'] * 10, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Analytics Section -->
            <div class="row g-4">
                <!-- Charts Column -->
                <div class="col-lg-8">
                    <!-- Revenue Chart -->
                    <div class="card card-bordered h-100">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Revenue & Orders Trend</h6>
                                </div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                                            <span id="chartPeriodLabel">Last 30 Days</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="updateChartPeriod('today', 'Today')">Today</a>
                                            <a class="dropdown-item" href="#" onclick="updateChartPeriod('week', 'This Week')">This Week</a>
                                            <a class="dropdown-item" href="#" onclick="updateChartPeriod('month', 'This Month')">This Month</a>
                                            <a class="dropdown-item" href="#" onclick="updateChartPeriod('30_days', 'Last 30 Days')">Last 30 Days</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner">
                            <div class="chart-container">
                                <canvas id="revenueChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Stats Column -->
                <div class="col-lg-4">
                    <!-- Order Status Breakdown -->
                    <div class="card card-bordered mb-4">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Order Status</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner">
                            @foreach(['completed' => 'success', 'delivered' => 'success', 'processing' => 'info', 'shipped' => 'primary', 'pending' => 'warning', 'cancelled' => 'danger'] as $status => $color)
                                @php
                                    $count = $analytics['orders']['status_breakdown'][$status] ?? 0;
                                    $percentage = $analytics['orders']['total'] > 0 ? round(($count / $analytics['orders']['total']) * 100, 1) : 0;
                                @endphp
                                <div class="d-flex justify-content-between align-items-center py-2">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-{{ $color }} bg-opacity-10 text-{{ $color }} me-2">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold">{{ number_format($count) }}</span>
                                        <small class="text-muted">({{ $percentage }}%)</small>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="my-1">
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Email Performance -->
                    <div class="card card-bordered">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Email Performance</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner">
                            <div class="row g-3">
                                <div class="col-6">
                                    <span class="sub-text">Total Sent</span>
                                    <span class="caption-text d-block fw-bold">{{ number_format($analytics['emails']['total']) }}</span>
                                </div>
                                <div class="col-6">
                                    <span class="sub-text">Success Rate</span>
                                    <span class="caption-text d-block fw-bold text-success">{{ $analytics['emails']['success_rate'] }}%</span>
                                </div>
                                <div class="col-6">
                                    <span class="sub-text">Delivered</span>
                                    <span class="caption-text d-block text-success">{{ number_format($analytics['emails']['sent']) }}</span>
                                </div>
                                <div class="col-6">
                                    <span class="sub-text">Failed</span>
                                    <span class="caption-text d-block text-danger">{{ number_format($analytics['emails']['failed']) }}</span>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height: 8px;">
                                <div class="progress-bar bg-success rounded" role="progressbar"
                                    style="width: {{ $analytics['emails']['success_rate'] }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Analytics Tables -->
            <div class="row g-4 mt-4">
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
                                <table class="table table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Orders</th>
                                            <th>Trend</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($analytics['performance']['top_products'] as $product)
                                            <tr>
                                                <td>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ Str::limit($product->title, 30) }}</span>
                                                        <span class="tb-sub">{{ $product->sku ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                                        {{ $product->order_items_count }} orders
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-success">
                                                        <em class="icon ni ni-trending-up"></em>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-3">
                                                    <span class="text-muted">No data available</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Sellers -->
                <div class="col-lg-6">
                    <div class="card card-bordered">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Top Performing Sellers</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner p-0">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Seller</th>
                                            <th>Orders</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($analytics['performance']['top_sellers'] as $seller)
                                            <tr>
                                                <td>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $seller->name }}</span>
                                                        <span class="tb-sub">{{ $seller->email }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success bg-opacity-10 text-success">
                                                        {{ $seller->order_items_count ?? 0 }} orders
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">Active</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-3">
                                                    <span class="text-muted">No data available</span>
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

            <!-- Quick Stats Grid -->
            <div class="row g-4 mt-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <em class="icon ni ni-briefcase" style="font-size: 2rem; color: #526484;"></em>
                            </div>
                            <h4 class="mb-1">{{ number_format($analytics['sellers']['total']) }}</h4>
                            <p class="text-muted mb-0">Total Sellers</p>
                            <small class="text-success">{{ number_format($analytics['sellers']['active']) }} active</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <em class="icon ni ni-package" style="font-size: 2rem; color: #526484;"></em>
                            </div>
                            <h4 class="mb-1">{{ number_format($analytics['products']['total']) }}</h4>
                            <p class="text-muted mb-0">Total Products</p>
                            <small class="text-info">{{ number_format($analytics['products']['published']) }} published</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <em class="icon ni ni-check-circle" style="font-size: 2rem; color: #526484;"></em>
                            </div>
                            <h4 class="mb-1">{{ number_format($analytics['orders']['successful']) }}</h4>
                            <p class="text-muted mb-0">Successful Orders</p>
                            <small class="text-success">{{ $analytics['orders']['success_rate'] }}% success rate</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <em class="icon ni ni-mail" style="font-size: 2rem; color: #526484;"></em>
                            </div>
                            <h4 class="mb-1">{{ number_format($analytics['emails']['sent']) }}</h4>
                            <p class="text-muted mb-0">Emails Delivered</p>
                            <small class="text-success">{{ $analytics['emails']['success_rate'] }}% delivery rate</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Export Modal -->
            <div class="modal fade" id="exportModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Analytics Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="GET" action="{{ route('admin.analytics.export') }}">
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">From Date</label>
                                        <input type="date" class="form-control" name="date_from" value="{{ $dateFrom }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">To Date</label>
                                        <input type="date" class="form-control" name="date_to" value="{{ $dateTo }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Export Format</label>
                                        <select class="form-select" name="type">
                                            <option value="csv">CSV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <em class="icon ni ni-download"></em>
                                    Export Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .stat-card {
            transition: all 0.3s ease;
            border-radius: 15px !important;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        
        .stat-icon {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.1);
        }
        
        .stat-number {
            font-size: 2.5rem;
            line-height: 1;
            font-weight: 700 !important;
        }
        
        .stat-label {
            font-size: 0.875rem;
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
            border-radius: 10px;
            background-color: rgba(0,0,0,0.05);
        }
        
        .progress-bar {
            border-radius: 10px;
            transition: width 0.6s ease;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .stat-number {
                font-size: 2rem;
            }
            
            .stat-card {
                margin-bottom: 1rem;
            }
        }
        
        .card-bordered {
            border-radius: 12px !important;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #526484;
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
        .stat-card:nth-child(1) .card-body { animation-delay: 0.1s; }
        .stat-card:nth-child(2) .card-body { animation-delay: 0.2s; }
        .stat-card:nth-child(3) .card-body { animation-delay: 0.3s; }
        .stat-card:nth-child(4) .card-body { animation-delay: 0.4s; }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let revenueChart;
        
        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
        });
        
        function initializeCharts() {
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            
            revenueChart = new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($analytics['charts']['revenue'], 'x')) !!},
                    datasets: [{
                        label: 'Revenue (DJF)',
                        data: {!! json_encode(array_column($analytics['charts']['revenue'], 'y')) !!},
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y'
                    }, {
                        label: 'Orders',
                        data: {!! json_encode(array_column($analytics['charts']['orders'], 'y')) !!},
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.dataset.label === 'Revenue (DJF)') {
                                        label += new Intl.NumberFormat().format(context.parsed.y) + ' DJF';
                                    } else {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            display: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat().format(value) + ' DJF';
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false,
                            },
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }
        
        // Real-time data refresh
        function refreshData() {
            fetch('{{ route('admin.analytics.real-time-data') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update stat cards
                        updateStatCards(data.data);
                        
                        // Update charts
                        updateCharts(data.data.charts);
                        
                        console.log('Analytics data refreshed successfully');
                    }
                })
                .catch(error => console.error('Error refreshing analytics data:', error));
        }
        
        function updateStatCards(data) {
            // Update revenue
            document.querySelector('.stat-card:nth-child(1) .stat-number').textContent = 
                new Intl.NumberFormat().format(data.revenue.total) + ' DJF';
            
            // Update orders
            document.querySelector('.stat-card:nth-child(2) .stat-number').textContent = 
                new Intl.NumberFormat().format(data.orders.total);
            
            // Update users
            document.querySelector('.stat-card:nth-child(3) .stat-number').textContent = 
                new Intl.NumberFormat().format(data.users.total);
            
            // Update conversion rate
            document.querySelector('.stat-card:nth-child(4) .stat-number').textContent = 
                data.performance.conversion_rate + '%';
        }
        
        function updateCharts(chartsData) {
            if (revenueChart && chartsData) {
                revenueChart.data.labels = chartsData.revenue.map(item => item.x);
                revenueChart.data.datasets[0].data = chartsData.revenue.map(item => item.y);
                revenueChart.data.datasets[1].data = chartsData.orders.map(item => item.y);
                revenueChart.update();
            }
        }
        
        function updateChartPeriod(period, label) {
            document.getElementById('chartPeriodLabel').textContent = label;
            
            fetch('{{ route('admin.analytics.real-time-data') }}?period=' + period)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCharts(data.data.charts);
                        updateStatCards(data.data);
                    }
                })
                .catch(error => console.error('Error updating chart period:', error));
        }
        
        // Auto refresh every 5 minutes
        setInterval(refreshData, 300000);
    </script>
@endsection