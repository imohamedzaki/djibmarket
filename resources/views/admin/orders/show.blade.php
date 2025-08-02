@extends('layouts.app.admin')
@section('title', 'Order Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Order Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                                <li class="breadcrumb-item active">Order #{{ $order->order_number }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="{{ route('admin.orders.index') }}"
                            class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                            <em class="icon ni ni-arrow-left"></em><span>Back</span>
                        </a>
                        <a href="{{ route('admin.orders.index') }}"
                            class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none">
                            <em class="icon ni ni-arrow-left"></em>
                        </a>
                    </div>
                </div>
            </div>

            <div class="nk-block">
                <div class="row g-gs">
                    <!-- Order Overview -->
                    <div class="col-lg-8">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Order #{{ $order->order_number }}</h6>
                                        <p>Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                        <div class="mt-2">
                                            <span class="badge badge-dim bg-outline-info">{{ $order->orderItems->count() }}
                                                items</span>
                                            <span
                                                class="badge badge-dim bg-outline-primary ms-1">{{ $order->total_quantity }}
                                                total qty</span>
                                        </div>
                                    </div>
                                    <div class="card-tools">
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge badge-dot bg-warning">Pending</span>
                                            @break

                                            @case('accepted')
                                                <span class="badge badge-dot bg-info">Accepted</span>
                                            @break

                                            @case('processing')
                                                <span class="badge badge-dot bg-info">Processing</span>
                                            @break

                                            @case('shipped')
                                                <span class="badge badge-dot bg-primary">Shipped</span>
                                            @break

                                            @case('delivered')
                                                <span class="badge badge-dot bg-success">Delivered</span>
                                            @break

                                            @case('completed')
                                                <span class="badge badge-dot bg-success">Completed</span>
                                            @break

                                            @case('cancelled')
                                                <span class="badge badge-dot bg-danger">Cancelled</span>
                                            @break

                                            @case('refunded')
                                                <span class="badge badge-dot bg-secondary">Refunded</span>
                                            @break

                                            @default
                                                <span class="badge badge-dot bg-secondary">{{ ucfirst($order->status) }}</span>
                                        @endswitch
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th>Seller</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span
                                                                    class="tb-lead">{{ $item->product->title ?? 'Deleted Product' }}</span>
                                                                @if ($item->product && $item->product->sku)
                                                                    <span class="tb-sub">SKU:
                                                                        {{ $item->product->sku }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="tb-sub">{{ $item->product->seller->name ?? 'N/A' }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge badge-dim bg-outline-secondary">{{ $item->product->category->name ?? 'N/A' }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="tb-amount">{{ number_format(($item->price ?? 0) + 0) }}
                                                            DJF</span>
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold text-primary">{{ $item->quantity }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="tb-amount fw-bold">{{ number_format(($item->price ?? 0) * $item->quantity + 0) }}
                                                            DJF</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="table-light">
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                                <td colspan="3" style="text-align: right;">
                                                    <strong>{{ number_format(($order->sub_total ?? 0) + 0) }} DJF</strong>
                                                </td>
                                            </tr>
                                            @if ($order->discount_amount > 0)
                                                <tr>
                                                    <td colspan="3" class="text-end">Discount:</td>
                                                    <td colspan="3" class="text-danger" style="text-align: right;">
                                                        -{{ number_format(($order->discount_amount ?? 0) + 0) }} DJF</td>
                                                </tr>
                                            @endif
                                            @if ($order->delivery_fee > 0)
                                                <tr>
                                                    <td colspan="3" class="text-end">Delivery Fee:</td>
                                                    <td colspan="3" style="text-align: right;">
                                                        {{ number_format(($order->delivery_fee ?? 0) + 0) }}
                                                        DJF</td>
                                                </tr>
                                            @endif
                                            <tr class="border-top-2">
                                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                <td colspan="3" style="text-align: right;"><strong
                                                        class="text-primary fs-5">{{ number_format(($order->final_price ?? 0) + 0) }}
                                                        DJF</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Order Status History Timeline -->
                        @if ($order->statusLogs && $order->statusLogs->count() > 0)
                            <div class="card card-bordered mt-4">
                                <div class="card-inner">
                                    <div class="card-title-group mb-4">
                                        <div class="card-title">
                                            <h6 class="title">Order Status History</h6>
                                            <p>Track the progress of this order through its lifecycle</p>
                                        </div>
                                        <div class="card-tools">
                                            <span class="badge badge-outline-light">{{ $order->statusLogs->count() }}
                                                {{ Str::plural('Update', $order->statusLogs->count()) }}</span>
                                        </div>
                                    </div>

                                    <div class="timeline timeline-s2">
                                        @foreach ($order->statusLogs as $index => $log)
                                            <div class="timeline-item">
                                                <div class="timeline-item-marker-wrap">
                                                    <div class="timeline-item-marker rounded-circle d-flex align-items-center justify-content-center
                                                        @switch($log->status)
                                                            @case('completed')
                                                            @case('delivered') 
                                                                bg-success
                                                            @break
                                                            @case('shipped') 
                                                                bg-primary
                                                            @break
                                                            @case('accepted')
                                                            @case('processing') 
                                                                bg-info
                                                            @break
                                                            @case('cancelled') 
                                                                bg-danger
                                                            @break
                                                            @case('refunded') 
                                                                bg-secondary
                                                            @break
                                                            @case('pending')
                                                                bg-warning
                                                            @break
                                                            @default 
                                                                bg-light
                                                        @endswitch
                                                    "
                                                        style="width: 40px; height: 40px;">
                                                        @switch($log->status)
                                                            @case('completed')
                                                                <em class="icon ni ni-check-circle-fill text-white"></em>
                                                            @break

                                                            @case('delivered')
                                                                <em class="icon ni ni-truck text-white"></em>
                                                            @break

                                                            @case('shipped')
                                                                <em class="icon ni ni-send text-white"></em>
                                                            @break

                                                            @case('accepted')
                                                                <em class="icon ni ni-check-circle text-white"></em>
                                                            @break

                                                            @case('processing')
                                                                <em class="icon ni ni-loader text-white"></em>
                                                            @break

                                                            @case('cancelled')
                                                                <em class="icon ni ni-cross-circle-fill text-white"></em>
                                                            @break

                                                            @case('refunded')
                                                                <em class="icon ni ni-refund text-white"></em>
                                                            @break

                                                            @case('pending')
                                                                <em class="icon ni ni-clock text-white"></em>
                                                            @break

                                                            @default
                                                                <em class="icon ni ni-info text-dark"></em>
                                                        @endswitch
                                                    </div>
                                                </div>
                                                <div class="timeline-item-content">
                                                    <div class="timeline-item-head">
                                                        <h6 class="timeline-item-title text-base">
                                                            {{ ucfirst(str_replace('_', ' ', $log->status)) }}
                                                            @switch($log->status)
                                                                @case('completed')
                                                                    <span
                                                                        class="badge badge-sm badge-outline-success ms-1">Final</span>
                                                                @break

                                                                @case('delivered')
                                                                    <span
                                                                        class="badge badge-sm badge-outline-success ms-1">Success</span>
                                                                @break

                                                                @case('accepted')
                                                                    <span
                                                                        class="badge badge-sm badge-outline-info ms-1">Accepted</span>
                                                                @break

                                                                @case('cancelled')
                                                                    <span
                                                                        class="badge badge-sm badge-outline-danger ms-1">Cancelled</span>
                                                                @break

                                                                @case('refunded')
                                                                    <span
                                                                        class="badge badge-sm badge-outline-secondary ms-1">Refunded</span>
                                                                @break
                                                            @endswitch
                                                        </h6>
                                                        <div class="timeline-item-time">
                                                            <span
                                                                class="text-soft">{{ $log->created_at->format('M d, Y') }}</span>
                                                            <span
                                                                class="text-soft">{{ $log->created_at->format('h:i A') }}</span>
                                                            <span
                                                                class="text-muted ms-2">({{ $log->created_at->diffForHumans() }})</span>
                                                        </div>
                                                    </div>
                                                    @if ($log->message)
                                                        <div class="timeline-item-text">
                                                            <p class="text-base mb-2">{{ $log->message }}</p>
                                                        </div>
                                                    @endif
                                                    @if ($log->estimated_delivery_time)
                                                        <div class="timeline-item-text">
                                                            <div class="d-flex align-items-center text-primary">
                                                                <em class="icon ni ni-calendar me-1"></em>
                                                                <span class="text-sm">
                                                                    Estimated delivery:
                                                                    <strong>{{ \Carbon\Carbon::parse($log->estimated_delivery_time)->format('M d, Y') }}</strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card card-bordered mt-4">
                                <div class="card-inner text-center py-4">
                                    <div class="mb-3">
                                        <em class="icon ni ni-clock" style="font-size: 2rem; color: #526484;"></em>
                                    </div>
                                    <h6 class="text-muted mb-2">No Status History</h6>
                                    <p class="text-soft small">Order status changes will appear here as they occur.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Order Notes -->
                        @if ($order->notes)
                            <div class="card card-bordered mt-4">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Order Notes</h6>
                                        </div>
                                    </div>
                                    <p>{{ $order->notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Customer & Delivery Info -->
                    <div class="col-lg-4">
                        <!-- Customer Information -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Customer Information</h6>
                                    </div>
                                </div>
                                @if ($order->user)
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary-dim">
                                            <span>{{ strtoupper(substr($order->user->name, 0, 2)) }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $order->user->name }}</span>
                                            <span class="tb-sub">{{ $order->user->email }}</span>
                                            @if ($order->user->phone)
                                                <span class="tb-sub">{{ $order->user->phone }}</span>
                                            @endif
                                            <span class="tb-sub text-soft">Customer ID: {{ $order->user->id }}</span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row g-3 mt-2">
                                        <div class="col-6">
                                            <span class="sub-text">Join Date</span>
                                            <span
                                                class="caption-text">{{ $order->user->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="sub-text">Total Orders</span>
                                            <span class="caption-text">{{ $order->user->orders()->count() }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-soft">
                                        <p>Guest Customer</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="card card-bordered mt-4">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Shipping Address</h6>
                                        @if ($order->shippingAddress)
                                            <p class="text-soft small">Linked to saved address</p>
                                        @else
                                            <p class="text-soft small">Manual address entry</p>
                                        @endif
                                    </div>
                                    <div class="card-tools">
                                        @if ($order->shippingAddress)
                                            <span class="badge badge-outline-success text-dark">
                                                <em class="icon ni ni-map-pin text-success"></em>
                                                Saved Address
                                            </span>
                                        @else
                                            <span class="badge badge-outline-warning text-dark">
                                                <em class="icon ni ni-edit text-warning"></em>
                                                Manual Entry
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Show linked shipping address if available --}}
                                @if ($order->shippingAddress)
                                    <div class="shipping-address-card p-3 bg-light-alt rounded mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="me-3">
                                                <div class="icon-circle bg-primary-dim">
                                                    <em class="icon ni ni-map-pin"></em>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="address-header mb-2">
                                                    <h6 class="address-title mb-1">
                                                        {{ $order->shippingAddress->type ?? 'Shipping Address' }}
                                                        @if ($order->shippingAddress->is_default)
                                                            <span
                                                                class="badge badge-xs badge-outline-primary ms-1 text-dark">Default</span>
                                                        @endif
                                                    </h6>
                                                    @if ($order->shippingAddress->label)
                                                        <span
                                                            class="text-soft small">{{ $order->shippingAddress->label }}</span>
                                                    @endif
                                                </div>
                                                <address class="address-content mb-0">
                                                    @if ($order->shippingAddress->full_address)
                                                        {{ $order->shippingAddress->full_address }}
                                                    @else
                                                        @if ($order->shippingAddress->street_address)
                                                            {{ $order->shippingAddress->street_address }}<br>
                                                        @endif
                                                        @if ($order->shippingAddress->city || $order->shippingAddress->state)
                                                            {{ $order->shippingAddress->city }}@if ($order->shippingAddress->city && $order->shippingAddress->state)
                                                                ,
                                                            @endif
                                                            {{ $order->shippingAddress->state }}<br>
                                                        @endif
                                                        @if ($order->shippingAddress->postal_code || $order->shippingAddress->country)
                                                            {{ $order->shippingAddress->postal_code }}@if ($order->shippingAddress->postal_code && $order->shippingAddress->country)
                                                                ,
                                                            @endif
                                                            {{ $order->shippingAddress->country }}
                                                        @endif
                                                    @endif
                                                </address>
                                                @if ($order->shippingAddress->phone)
                                                    <div class="mt-2">
                                                        <span class="text-soft small">Phone: </span>
                                                        <span
                                                            class="fw-medium">{{ $order->shippingAddress->phone }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Show delivery address as fallback --}}
                                @if ($order->delivery_address && !$order->shippingAddress)
                                    <div class="shipping-address-card p-3 bg-warning-dim rounded mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="me-3">
                                                <div class="icon-circle bg-warning-dim">
                                                    <em class="icon ni ni-edit"></em>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="address-title mb-2">Manual Address Entry</h6>
                                                <address class="address-content mb-0">
                                                    {{ $order->delivery_address }}
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Show no address message --}}
                                @if (!$order->shippingAddress && !$order->delivery_address)
                                    <div class="text-center py-3">
                                        <div class="mb-2">
                                            <em class="icon ni ni-map-pin"
                                                style="font-size: 1.5rem; color: #526484;"></em>
                                        </div>
                                        <h6 class="text-muted mb-1">No Shipping Address</h6>
                                        <p class="text-soft small">No shipping address has been provided for this order.
                                        </p>
                                    </div>
                                @endif

                                {{-- Order contact phone --}}
                                @if ($order->phone)
                                    <div class="mt-3 pt-3 border-top">
                                        <div class="d-flex align-items-center">
                                            <em class="icon ni ni-call me-2 text-primary"></em>
                                            <div>
                                                <span class="sub-text d-block">Order Contact Phone:</span>
                                                <span class="fw-bold">{{ $order->phone }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Customer's other addresses --}}
                                @if ($order->user && $order->user->addresses->count() > 0)
                                    <hr>
                                    <div class="mt-3">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <span class="sub-text">Customer's Other Addresses</span>
                                            <span class="badge badge-outline-light">{{ $order->user->addresses->count() }}
                                                {{ Str::plural('Address', $order->user->addresses->count()) }}</span>
                                        </div>
                                        <div class="row g-2">
                                            @foreach ($order->user->addresses->take(3) as $address)
                                                <div class="col-12">
                                                    <div
                                                        class="p-2 bg-light rounded border-start border-3 {{ $order->shippingAddress && $order->shippingAddress->id === $address->id ? 'border-primary bg-primary-dim' : 'border-light' }}">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <small class="text-muted fw-medium">
                                                                    {{ $address->type ?? 'Address' }}
                                                                    @if ($address->is_default)
                                                                        <span
                                                                            class="badge badge-xs badge-outline-primary ms-1 text-dark">Default</span>
                                                                    @endif
                                                                    @if ($order->shippingAddress && $order->shippingAddress->id === $address->id)
                                                                        <span
                                                                            class="badge badge-xs badge-primary ms-1 text-dark ">Used
                                                                            for Order</span>
                                                                    @endif
                                                                </small>
                                                                <div class="text-sm">
                                                                    {{ Str::limit($address->full_address ?? $address->street_address, 60) }}
                                                                </div>
                                                            </div>
                                                            @if ($order->shippingAddress && $order->shippingAddress->id === $address->id)
                                                                <em class="icon ni ni-check-circle text-primary"></em>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($order->user->addresses->count() > 3)
                                                <div class="col-12">
                                                    <div class="text-center py-2">
                                                        <small class="text-muted">and
                                                            {{ $order->user->addresses->count() - 3 }} more
                                                            addresses...</small>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="card card-bordered mt-4">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Order Summary</h6>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <span class="sub-text">Order Date</span>
                                        <span
                                            class="caption-text d-block">{{ $order->created_at->format('M d, Y') }}</span>
                                        <span
                                            class="caption-text d-block text-soft">{{ $order->created_at->format('h:i A') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Payment Status</span>
                                        <span class="caption-text d-block">
                                            @if ($order->payment_status === 'paid')
                                                <span class="badge badge-dot bg-success">Paid</span>
                                            @elseif($order->payment_status === 'pending')
                                                <span class="badge badge-dot bg-warning">Pending</span>
                                            @else
                                                <span class="badge badge-dot bg-danger">Unpaid</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Items Count</span>
                                        <span class="caption-text">{{ $order->orderItems->count() }}</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="sub-text">Total Quantity</span>
                                        <span class="caption-text">{{ $order->total_quantity }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Actions -->
                        <div class="card card-bordered mt-4">
                            <div class="card-inner">
                                <div class="card-title-group mb-4">
                                    <div class="card-title">
                                        <h6 class="title">Order Actions</h6>
                                        <p class="text-soft small">Manage this order</p>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-warning btn-block edit-order-button"
                                            data-order-number="{{ $order->order_number }}" data-bs-toggle="modal">
                                            <em class="icon ni ni-edit"></em>
                                            <span>Edit Order Details</span>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-info btn-block status-order-button"
                                            data-bs-toggle="modal" data-bs-target="#statusOrderModal"
                                            data-order-number="{{ $order->order_number }}"
                                            data-number="{{ $order->order_number }}"
                                            data-current-status="{{ $order->status }}"
                                            data-status-url="{{ route('admin.orders.updateStatus', $order->order_number) }}">
                                            <em class="icon ni ni-setting"></em>
                                            <span>Update Status</span>
                                        </button>
                                    </div>
                                    @if ($order->status === 'cancelled')
                                        <div class="col-12">
                                            <div class="dropdown-divider my-2"></div>
                                            <form action="{{ route('admin.orders.destroy', $order->order_number) }}"
                                                method="POST" class="d-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-block"
                                                    onclick="return confirm('Are you sure you want to delete this cancelled order? This action cannot be undone.')">
                                                    <em class="icon ni ni-trash"></em>
                                                    <span>Delete Order</span>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include modals from index view -->
    @include('admin.orders.partials.modals')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Edit order button click
            $(document).on('click', '.edit-order-button', function() {
                var orderNumber = $(this).data('order-number');
                var editModal = $('#editOrderModal');
                var editForm = $('#editOrderForm');

                editModal.find('.modal-body').addClass('loading');

                $.ajax({
                    url: `/admin/orders/${orderNumber}/edit-data`,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            var order = response.order;

                            editForm.find('#edit-order-status').val(order.status);
                            editForm.find('#edit-order-customer').val(order.user ? order.user
                                .name + ' (' + order.user.email + ')' : 'Guest');
                            editForm.find('#edit-order-address').val(order.delivery_address ||
                                '');
                            editForm.find('#edit-order-notes').val(order.notes || '');
                            editForm.attr('action', `/admin/orders/${order.order_number}`);

                            editModal.find('.modal-body').removeClass('loading');
                            editModal.modal('show');
                        } else {
                            alert('Could not load order details. Please try again.');
                            editModal.find('.modal-body').removeClass('loading');
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching order data.');
                        editModal.find('.modal-body').removeClass('loading');
                    }
                });
            });

            // Status change button click
            $(document).on('click', '.status-order-button', function() {
                var orderNumber = $(this).data('order-number');
                var orderDisplay = $(this).data('number');
                var currentStatus = $(this).data('current-status');
                var statusUrl = $(this).data('status-url');

                $('#status-order-number').text('#' + orderDisplay);
                $('#current-status-display').text(currentStatus.charAt(0).toUpperCase() + currentStatus
                    .slice(1));
                $('#statusOrderForm').attr('action', statusUrl);

                var newStatusSelect = $('#new-status');
                newStatusSelect.find('option').prop('disabled', false);
                newStatusSelect.val(currentStatus);
            });

            // Confirm status change
            $('#confirmStatusOrderBtn').on('click', function() {
                var $this = $(this);
                var form = $('#statusOrderForm');

                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Changing...');

                form.submit();
            });

            // Form submissions
            $('#editOrderForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });

            // Reset modals when closed
            $('#statusOrderModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#confirmStatusOrderBtn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Change Status');
                $('#statusOrderForm')[0].reset();
            });

            $('#editOrderModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#updateOrderBtn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Update Order');
                $('#editOrderForm')[0].reset();
                $(this).find('.modal-body').removeClass('loading');
            });
        });
    </script>


@endsection

@section('css')
    <style>
        .timeline-item:not(:last-child):before {
            top: 24px;
            left: 1.2rem;
        }

        .timeline-item-marker-wrap {
            z-index: 2;
        }

        .timeline-item-content {
            margin-left: 1rem;
        }
    </style>
@endsection
