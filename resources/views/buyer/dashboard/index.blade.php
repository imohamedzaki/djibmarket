@extends('buyer.dashboard.layout')

<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 20px;
        border-radius: 12px 12px 0 0 !important;
    }

    .card-body {
        padding: 20px;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .table td {
        vertical-align: middle;
        font-size: 14px;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

@section('dashboard-content')
    <div class="dashboard-header">
        <h1>Welcome back, {{ Auth::user()->name }}!</h1>
        <p>Here's what's happening with your account today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card orders">
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h3 class="stat-number">{{ $stats['total_orders'] }}</h3>
            <p class="stat-label">Total Orders</p>
        </div>

        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="stat-number">{{ $stats['pending_orders'] }}</h3>
            <p class="stat-label">Pending Orders</p>
        </div>

        <div class="stat-card completed">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="stat-number">{{ $stats['completed_orders'] }}</h3>
            <p class="stat-label">Completed Orders</p>
        </div>

        <div class="stat-card wishlist">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h3 class="stat-number">{{ $stats['wishlist_items'] }}</h3>
            <p class="stat-label">Wishlist Items</p>
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Orders</h5>
                    <a href="{{ route('buyer.dashboard.orders') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if ($recent_orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_orders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('buyer.dashboard.orders.show', $order) }}"
                                                    class="text-decoration-none">
                                                    #{{ $order->order_number ?? 'ORD-' . $order->id }}
                                                </a>
                                            </td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>{{ $order->orderItems->count() }} items</td>
                                            <td>{{ number_format($order->final_price, 0) }} DJF</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                            <h5>No orders yet</h5>
                            <p class="text-muted">Start shopping to see your orders here!</p>
                            <a href="{{ route('buyer.home') }}" class="btn btn-primary">Start Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recently Viewed -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recently Viewed</h5>
                    <a href="{{ route('buyer.dashboard.browsing-history') }}" class="btn btn-sm btn-outline-primary">View
                        All</a>
                </div>
                <div class="card-body">
                    @if ($recent_browsing->count() > 0)
                        @foreach ($recent_browsing as $history)
                            <div class="d-flex align-items-center mb-3">
                                <div class="product-image me-3">
                                    @if ($history->product)
                                        <img src="{{ $history->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                            alt="{{ $history->product->title }}"
                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;"
                                            onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                    @else
                                        <div
                                            style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    @if ($history->product)
                                        <h6 class="mb-1">
                                            <a href="{{ route('buyer.product.show', $history->product) }}"
                                                class="text-decoration-none">
                                                {{ Str::limit($history->product->title, 30) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ $history->viewed_at->diffForHumans() }}</small>
                                    @else
                                        <h6 class="mb-1 text-muted">Product no longer available</h6>
                                        <small class="text-muted">{{ $history->viewed_at->diffForHumans() }}</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-history fa-2x text-muted mb-3"></i>
                            <p class="text-muted">No browsing history yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
