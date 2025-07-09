@extends('buyer.dashboard.layout')

<style>
    .tracking-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .tracking-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .tracking-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .tracking-header {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        background: #f8f9fa;
    }

    .tracking-number {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .tracking-status {
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

    .tracking-progress {
        padding: 20px;
    }

    .progress-bar-container {
        position: relative;
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        margin: 20px 0;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #007bff, #28a745);
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-top: 10px;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        position: relative;
    }

    .step-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 12px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .step-icon.completed {
        background: #28a745;
        color: white;
    }

    .step-icon.current {
        background: #007bff;
        color: white;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
        }
    }

    .step-label {
        font-size: 11px;
        color: #666;
        text-align: center;
        line-height: 1.2;
    }

    .step-label.completed {
        color: #28a745;
        font-weight: 500;
    }

    .step-label.current {
        color: #007bff;
        font-weight: 600;
    }

    .order-summary {
        padding: 15px 20px;
        background: #f8f9fa;
        border-top: 1px solid #f0f0f0;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .summary-item:last-child {
        margin-bottom: 0;
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
        .tracking-header .row {
            text-align: center;
        }

        .progress-steps {
            flex-wrap: wrap;
            gap: 10px;
        }

        .progress-step {
            flex: 0 0 calc(50% - 5px);
        }

        .step-label {
            font-size: 10px;
        }
    }
</style>

@section('dashboard-content')
    <div class="dashboard-header">
        <h1>Order Tracking</h1>
        <p>Track the status and delivery progress of your orders.</p>
    </div>

    @if ($orders->count() > 0)
        <div class="tracking-container">
            @foreach ($orders as $order)
                <div class="tracking-card">
                    <div class="tracking-header">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6 class="tracking-number">Order #{{ $order->order_number ?? 'ORD-' . $order->id }}</h6>
                                <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="col-md-3">
                                <span class="tracking-status badge badge-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <strong>Tracking: {{ $order->tracking_number }}</strong>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="{{ route('buyer.dashboard.orders.show', $order) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-progress">
                        <!-- Progress Bar -->
                        <div class="progress-bar-container">
                            <div class="progress-bar"
                                style="width: {{ $order->status === 'pending' ? '25%' : ($order->status === 'processing' ? '50%' : ($order->status === 'shipped' ? '75%' : '100%')) }};">
                            </div>
                        </div>

                        <!-- Progress Steps -->
                        <div class="progress-steps">
                            <div class="progress-step">
                                <div
                                    class="step-icon {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div
                                    class="step-label {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                    Order<br>Placed
                                </div>
                            </div>
                            <div class="progress-step">
                                <div
                                    class="step-icon {{ $order->status === 'processing' ? 'current' : (in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '') }}">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div
                                    class="step-label {{ $order->status === 'processing' ? 'current' : (in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '') }}">
                                    Processing
                                </div>
                            </div>
                            <div class="progress-step">
                                <div
                                    class="step-icon {{ $order->status === 'shipped' ? 'current' : ($order->status === 'delivered' ? 'completed' : '') }}">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div
                                    class="step-label {{ $order->status === 'shipped' ? 'current' : ($order->status === 'delivered' ? 'completed' : '') }}">
                                    Shipped
                                </div>
                            </div>
                            <div class="progress-step">
                                <div class="step-icon {{ $order->status === 'delivered' ? 'current completed' : '' }}">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="step-label {{ $order->status === 'delivered' ? 'current completed' : '' }}">
                                    Delivered
                                </div>
                            </div>
                        </div>

                        <!-- Latest Status Update -->
                        @if ($order->statusLogs->first())
                            <div class="mt-3">
                                <small class="text-muted">
                                    <strong>Latest Update:</strong>
                                    {{ $order->statusLogs->first()->message ?? 'Status updated' }}
                                    <br>
                                    <em>{{ $order->statusLogs->first()->created_at->format('M d, Y \a\t g:i A') }}</em>
                                </small>
                            </div>
                        @endif
                    </div>

                    <div class="order-summary">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <span>Items:</span>
                                    <strong>{{ $order->orderItems->count() }} item(s)</strong>
                                </div>
                                @if ($order->shipped_at)
                                    <div class="summary-item">
                                        <span>Shipped:</span>
                                        <strong>{{ $order->shipped_at->format('M d, Y') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="summary-item">
                                    <span>Total:</span>
                                    <strong>{{ number_format($order->final_price, 0) }} DJF</strong>
                                </div>
                                @if ($order->status === 'shipped' && $order->statusLogs->where('status', 'shipped')->first())
                                    <div class="summary-item">
                                        <span>Est. Delivery:</span>
                                        <strong class="text-info">
                                            {{ $order->statusLogs->where('status', 'shipped')->first()->estimated_delivery_time
                                                ? $order->statusLogs->where('status', 'shipped')->first()->estimated_delivery_time->format('M d, Y')
                                                : 'TBD' }}
                                        </strong>
                                    </div>
                                @endif
                            </div>
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
            <i class="fas fa-truck fa-3x text-muted mb-3"></i>
            <h5>No trackable orders found</h5>
            <p class="text-muted">Orders with tracking numbers will appear here once they are shipped.</p>
            <a href="{{ route('buyer.dashboard.orders') }}" class="btn btn-primary">View All Orders</a>
        </div>
    @endif
@endsection
