@extends('layouts.app.seller')
@section('title', 'Flash Sale Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Flash Sale Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.flash-sales.index') }}">Flash Sales</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $flashSale->title }}</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <a href="{{ route('seller.flash-sales.edit', $flashSale->slug) }}"
                                            class="btn btn-outline-primary">
                                            <em class="icon ni ni-edit"></em><span>Edit Flash Sale</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('seller.flash-sales.index') }}" class="btn btn-secondary">
                                            <em class="icon ni ni-arrow-left"></em><span>Back to List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Session Success/Error Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />

            <div class="nk-block nk-block-lg">
                <div class="row g-gs">
                    <!-- Flash Sale Details Card -->
                    <div class="col-lg-8">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">{{ $flashSale->title }}</h4>
                                            <div class="nk-block-des">
                                                <span class="text-soft">Flash Sale Information</span>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <span class="badge badge-lg badge-dot bg-{{ $flashSale->getStatusColor() }}">
                                                {{ $flashSale->getStatusLabel() }}
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Flash Sale ID</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="#{{ str_pad($flashSale->id, 4, '0', STR_PAD_LEFT) }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Slug</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="{{ $flashSale->slug }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="{{ $flashSale->title }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Discount Type</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $flashSale->getDiscountTypeLabel() }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Discount Value</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="{{ $flashSale->discount_value }}" readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            {{ $flashSale->discount_type === 'percentage' ? '%' : 'DJF' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Total Stock Available</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $flashSale->getTotalStock() }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Start Date & Time</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $flashSale->start_at->format('M d, Y H:i') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">End Date & Time</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $flashSale->end_at->format('M d, Y H:i') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Usage Limit Per User</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $flashSale->usage_limit_per_user ? number_format($flashSale->usage_limit_per_user) : 'Unlimited' }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Created Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $flashSale->created_at->format('M d, Y H:i') }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Information & Additional Details -->
                    <div class="col-lg-4">
                        <!-- Product Information Card -->
                        <div class="card card-bordered mb-3">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Products Information</h5>
                                    </div>
                                </div>
                                @if ($flashSale->products && $flashSale->products->count() > 0)
                                    @foreach ($flashSale->products as $product)
                                        <div
                                            class="user-card @if (!$loop->last) border-bottom pb-3 mb-3 @endif">
                                            <div class="user-avatar bg-primary-dim">
                                                @if ($product->thumbnail)
                                                    <img src="{{ Storage::disk('public')->url($product->thumbnail) }}"
                                                        alt="{{ $product->title }}">
                                                @else
                                                    <span>{{ strtoupper(substr($product->title, 0, 2)) }}</span>
                                                @endif
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text">{{ $product->title }}</span>
                                                <span class="sub-text">{{ $product->sku ?? 'No SKU' }}</span>
                                            </div>
                                        </div>
                                        <div class="row g-3 @if (!$loop->last) mb-3 @endif">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Regular Price</label>
                                                    <div class="form-control-wrap">
                                                        <span
                                                            class="form-text text-decoration-line-through">{{ number_format($product->price_regular, 2) }} DJF</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Flash Price</label>
                                                    <div class="form-control-wrap">
                                                        <span
                                                            class="form-text text-success fw-bold">{{ number_format($flashSale->getDiscountedPrice($product), 2) }} DJF</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Stock Available</label>
                                                    <div class="form-control-wrap">
                                                        <span class="form-text">{{ $product->stock_quantity }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Category</label>
                                                    <div class="form-control-wrap">
                                                        <span
                                                            class="form-text">{{ $product->category ? $product->category->name : 'No Category' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Discount Amount</label>
                                                    <div class="form-control-wrap">
                                                        <span class="form-text text-success">
                                                            {{ number_format($flashSale->getDiscountAmount($product), 2) }} DJF
                                                            ({{ number_format(($flashSale->getDiscountAmount($product) / $product->price_regular) * 100, 1) }}%
                                                            off)
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('seller.products.show', $product->slug) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                <em class="icon ni ni-eye"></em><span>View Product</span>
                                            </a>
                                        </div>
                                        @if (!$loop->last)
                                            <hr class="my-4">
                                        @endif
                                    @endforeach
                                    <div class="mt-3">
                                        <a href="{{ route('seller.products.index') }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <em class="icon ni ni-list"></em><span>View All Products</span>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <em class="icon ni ni-alert-circle text-danger" style="font-size: 2rem;"></em>
                                        <p class="mt-2 text-soft">No products found or they have been deleted.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status & Statistics Card -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Statistics & Status</h5>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Current Status</label>
                                            <div class="form-control-wrap">
                                                <span class="badge badge-dot bg-{{ $flashSale->getStatusColor() }}">
                                                    {{ $flashSale->getStatusLabel() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Time Status</label>
                                            @php
                                                $now = now();
                                                $start = $flashSale->start_at;
                                                $end = $flashSale->end_at;
                                                $timeLeft = '';
                                                $badgeClass = '';
                                                
                                                if ($now < $start) {
                                                    // Flash sale hasn't started yet
                                                    $diff = $start->diff($now);
                                                    $timeLeft = 'Starts in ';
                                                    $badgeClass = 'badge badge-info';
                                                } elseif ($now >= $start && $now < $end) {
                                                    // Flash sale is active
                                                    $diff = $end->diff($now);
                                                    $timeLeft = 'Ends in ';
                                                    $badgeClass = 'badge badge-success';
                                                } else {
                                                    // Flash sale has ended
                                                    $timeLeft = 'Ended';
                                                    $badgeClass = 'badge badge-danger';
                                                }
                                                
                                                if (isset($diff)) {
                                                    if ($diff->days > 0) {
                                                        $timeLeft .= $diff->days . ' day' . ($diff->days > 1 ? 's' : '') . ' ';
                                                    }
                                                    if ($diff->h > 0) {
                                                        $timeLeft .= $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ';
                                                    }
                                                    if ($diff->i > 0) {
                                                        $timeLeft .= $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ';
                                                    }
                                                    if ($diff->s > 0) {
                                                        $timeLeft .= $diff->s . ' second' . ($diff->s > 1 ? 's' : '');
                                                    }
                                                    if ($diff->days == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s == 0) {
                                                        $timeLeft .= 'less than 1 second';
                                                    }
                                                }
                                            @endphp
                                            <div class="form-control-wrap">
                                                <span class="badge {{ $badgeClass }}" id="timeStatusBadge" 
                                                    data-start="{{ $flashSale->start_at->toISOString() }}" 
                                                    data-end="{{ $flashSale->end_at->toISOString() }}">{{ $timeLeft }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Duration</label>
                                            <div class="form-control-wrap">
                                                <span
                                                    class="form-text">{{ $flashSale->start_at->diffForHumans($flashSale->end_at, true) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1.5px solid #ddd;
        }

        .form-text {
            display: block;
            padding: 0.4375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: #3c4d62;
            background-color: #f5f6fa;
            border: 1px solid #e5e9f2;
            border-radius: 0.375rem;
        }

        .badge-info {
            background-color: #17a2b8;
            color: #ffffff;
        }

        .badge-success {
            background-color: #28a745;
            color: #ffffff;
        }

        .badge-danger {
            background-color: #dc3545;
            color: #ffffff;
        }
    </style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        function updateTimeStatus() {
            const badge = $('#timeStatusBadge');
            const startTime = new Date(badge.data('start'));
            const endTime = new Date(badge.data('end'));
            const now = new Date();
            
            let timeLeft = '';
            let badgeClass = '';
            
            if (now < startTime) {
                // Flash sale hasn't started yet
                const diff = Math.abs(startTime - now);
                timeLeft = 'Starts in ';
                badgeClass = 'badge badge-info';
                timeLeft += formatTimeDifference(diff);
            } else if (now >= startTime && now < endTime) {
                // Flash sale is active
                const diff = Math.abs(endTime - now);
                timeLeft = 'Ends in ';
                badgeClass = 'badge badge-success';
                timeLeft += formatTimeDifference(diff);
            } else {
                // Flash sale has ended
                timeLeft = 'Ended';
                badgeClass = 'badge badge-danger';
            }
            
            badge.text(timeLeft);
            badge.attr('class', badgeClass);
        }
        
        function formatTimeDifference(diff) {
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            let result = '';
            
            if (days > 0) {
                result += days + ' day' + (days > 1 ? 's' : '') + ' ';
            }
            if (hours > 0) {
                result += hours + ' hour' + (hours > 1 ? 's' : '') + ' ';
            }
            if (minutes > 0) {
                result += minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ';
            }
            if (seconds > 0) {
                result += seconds + ' second' + (seconds > 1 ? 's' : '');
            }
            if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                result = 'less than 1 second';
            }
            
            return result.trim();
        }
        
        // Update immediately
        updateTimeStatus();
        
        // Update every second
        setInterval(updateTimeStatus, 1000);
    });
</script>
@endsection
