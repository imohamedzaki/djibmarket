@extends('buyer.dashboard.layout')

<style>
    .orders-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .order-header {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        background: #f8f9fa;
    }

    .order-number {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .order-status {
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

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    .order-total {
        font-size: 18px;
        color: #333;
    }

    .order-items {
        padding: 20px;
    }

    .order-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .item-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
    }

    .item-details {
        flex: 1;
        min-width: 0;
    }

    .item-title {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin: 0 0 4px 0;
        line-height: 1.3;
    }

    .item-info {
        font-size: 12px;
        color: #666;
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    /* Pagination Styles */
    .pagination {
        justify-content: center;
    }

    .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #ddd;
        color: #333;
    }

    .page-link:hover {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    @media (max-width: 768px) {
        .order-header .row {
            text-align: center;
        }

        .order-header .col-md-2:last-child {
            margin-top: 10px;
        }

        .order-item {
            flex-direction: column;
            text-align: center;
        }

        .item-image {
            width: 80px;
            height: 80px;
        }
    }
</style>
@section('dashboard-content')
    <div class="dashboard-header">
        <h1>My Orders</h1>
        <p>Track and manage all your orders in one place.</p>
    </div>

    @if ($orders->count() > 0)
        <div class="orders-container">
            @foreach ($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6 class="order-number">Order #{{ $order->order_number ?? 'ORD-' . $order->id }}</h6>
                                <small class="text-muted">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</small>
                            </div>
                            <div class="col-md-2">
                                <span class="order-status badge badge-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </div>
                            <div class="col-md-2">
                                <strong class="order-total">{{ number_format($order->total_price, 0) }} DJF</strong>
                                @if ($order->shipping_cost > 0)
                                    <br><small class="text-muted">+{{ number_format($order->shipping_cost, 0) }} DJF
                                        shipping</small>
                                @endif
                                <br><small class="text-success"><strong>Total: {{ number_format($order->final_price, 0) }}
                                        DJF</strong></small>
                            </div>
                            <div class="col-md-3">
                                @if ($order->tracking_number)
                                    <small class="text-muted">Tracking: {{ $order->tracking_number }}</small>
                                @endif
                            </div>
                            <div class="col-md-2 text-end">
                                <a href="{{ route('buyer.dashboard.orders.show', $order) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="row">
                            @foreach ($order->orderItems->take(3) as $item)
                                <div class="col-md-4">
                                    <div class="order-item">
                                        <div class="item-image">
                                            @if ($item->product)
                                                <img src="{{ $item->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                    alt="{{ $item->product->title }}"
                                                    onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item-details">
                                            <h6 class="item-title">
                                                @if ($item->product)
                                                    {{ Str::limit($item->product->title, 40) }}
                                                @else
                                                    Product no longer available
                                                @endif
                                            </h6>
                                            <p class="item-info">
                                                Qty: {{ $item->quantity }} × {{ number_format($item->price, 2) }} DJF
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if ($order->orderItems->count() > 3)
                                <div class="col-md-12">
                                    <small class="text-muted">
                                        +{{ $order->orderItems->count() - 3 }} more items
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
            <h5>No orders found</h5>
            <p class="text-muted">You haven't placed any orders yet. Start shopping to see your orders here!</p>
            <a href="{{ route('buyer.home') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @endif
@endsection
