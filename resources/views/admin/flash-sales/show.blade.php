@extends('layouts.app.admin')

@section('title', 'Flash Sale Details - ' . $flashSale->title)

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Flash Sale Details</h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Flash Sale ID: <span
                                                class="text-base">#{{ str_pad($flashSale->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </li>
                                        <li>Created: <span
                                                class="text-base">{{ $flashSale->created_at->format('M d, Y H:i') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('admin.flash-sales.index') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('admin.flash-sales.index') }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->

                    <div class="nk-block">
                        <div class="row g-gs">
                            <!-- Main Content -->
                            <div class="col-lg-8">
                                <!-- Flash Sale Information -->
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <h5 class="card-title">Flash Sale Information</h5>
                                            <div class="card-opt">
                                                <span
                                                    class="badge badge-lg badge-dot bg-{{ $flashSale->getStatusColor() }}">
                                                    {{ $flashSale->getStatusLabel() }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Flash Sale ID</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="#{{ str_pad($flashSale->id, 4, '0', STR_PAD_LEFT) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Slug</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="{{ $flashSale->slug }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Title</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="{{ $flashSale->title }}" readonly>
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
                                                        <div class="form-control-wrap has-suffix">
                                                            <input type="text" class="form-control"
                                                                value="{{ $flashSale->discount_value }}" readonly>
                                                            <div class="form-control-suffix">
                                                                {{ $flashSale->discount_type === 'percentage' ? '%' : 'DJF' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Total Stock</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="{{ $flashSale->getTotalStock() }}" readonly>
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
                                                    <label class="form-label">Start Date & Time</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="{{ $flashSale->start_at->format('M d, Y H:i') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">End Date & Time</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="{{ $flashSale->end_at->format('M d, Y H:i') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Created Date</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="{{ $flashSale->created_at->format('M d, Y H:i') }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products Information -->
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <h5 class="card-title">Products in Flash Sale</h5>
                                            <div class="card-opt">
                                                <span class="badge badge-gray">{{ $flashSale->products->count() }}
                                                    Product(s)</span>
                                            </div>
                                        </div>

                                        @if ($flashSale->products && $flashSale->products->count() > 0)
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span class="sub-text">Product</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Seller</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md"><span
                                                            class="sub-text">Category</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Original
                                                            Price</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span class="sub-text">Sale
                                                            Price</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Stock</span>
                                                    </div>
                                                </div>

                                                @foreach ($flashSale->products as $product)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-avatar sq">
                                                                    @if ($product->images->first())
                                                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                                            alt="{{ $product->title }}">
                                                                    @else
                                                                        <span>{{ substr($product->title, 0, 2) }}</span>
                                                                    @endif
                                                                </div>
                                                                <div class="user-info">
                                                                    <span class="tb-lead">{{ $product->title }}</span>
                                                                    <span
                                                                        class="fs-12px text-soft">{{ $product->sku }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span
                                                                class="tb-lead">{{ $product->seller->business_name }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span
                                                                class="tb-lead">{{ $product->category->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span
                                                                class="amount">{{ number_format($product->price_regular, 0) }}
                                                                DJF</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span
                                                                class="amount text-success fw-bold">{{ number_format($flashSale->getDiscountedPrice($product), 0) }}
                                                                DJF</span>
                                                            <div class="text-soft fs-12px">
                                                                Save:
                                                                {{ number_format($flashSale->getDiscountAmount($product), 0) }}
                                                                DJF
                                                                ({{ number_format(($flashSale->getDiscountAmount($product) / $product->price_regular) * 100, 1) }}%
                                                                off)
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span class="tb-lead">{{ $product->stock_quantity }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center p-4">
                                                <em class="icon ni ni-package"
                                                    style="font-size: 3rem; opacity: 0.3;"></em>
                                                <h6 class="text-muted">No Products</h6>
                                                <p class="text-muted">This flash sale has no products assigned.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Products by Seller -->
                                @if ($productsBySeller->count() > 1)
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-head">
                                                <h5 class="card-title">Products by Seller</h5>
                                            </div>

                                            @foreach ($productsBySeller as $sellerName => $products)
                                                <div class="nk-block-head-xs">
                                                    <div class="nk-block-between g-2">
                                                        <div class="nk-block-head-content">
                                                            <h6 class="nk-block-title">{{ $sellerName }}</h6>
                                                            <div class="nk-block-des">
                                                                <p>{{ $products->count() }} product(s)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-3 mb-4">
                                                    @foreach ($products as $product)
                                                        <div class="col-sm-6 col-lg-4">
                                                            <div class="card card-bordered product-card">
                                                                <div class="card-inner p-3">
                                                                    <div class="product-thumb">
                                                                        @if ($product->images->first())
                                                                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                                                alt="{{ $product->title }}"
                                                                                class="img-thumbnail">
                                                                        @else
                                                                            <div class="product-thumb-placeholder">
                                                                                <em class="icon ni ni-img"></em>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h6 class="product-title">{{ $product->title }}
                                                                        </h6>
                                                                        <div class="product-price">
                                                                            <span
                                                                                class="price-now">{{ number_format($flashSale->getDiscountedPrice($product), 0) }}
                                                                                DJF</span>
                                                                            <span
                                                                                class="price-old">{{ number_format($product->price_regular, 0) }}
                                                                                DJF</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Sidebar -->
                            <div class="col-lg-4">
                                <!-- Statistics -->
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <h6 class="card-title">Flash Sale Statistics</h6>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="nk-wg-stats">
                                                    <div class="nk-wg-stats-info">
                                                        <div class="count">{{ $stats['total_products'] }}</div>
                                                        <div class="title">Products</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="nk-wg-stats">
                                                    <div class="nk-wg-stats-info">
                                                        <div class="count">{{ $stats['total_sellers'] }}</div>
                                                        <div class="title">Sellers</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="nk-wg-stats">
                                                    <div class="nk-wg-stats-info">
                                                        <div class="count">{{ $stats['total_stock'] }}</div>
                                                        <div class="title">Total Stock</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="nk-wg-stats">
                                                    <div class="nk-wg-stats-info">
                                                        <div class="count">
                                                            {{ number_format($stats['avg_discount_amount'], 0) }}</div>
                                                        <div class="title">Avg. Discount (DJF)</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="nk-tb-list mt-3">
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Original Value</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span
                                                        class="amount">{{ number_format($stats['total_original_value'], 0) }}
                                                        DJF</span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Sale Value</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span
                                                        class="amount text-success">{{ number_format($stats['total_discounted_value'], 0) }}
                                                        DJF</span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Total Savings</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span
                                                        class="amount text-danger">{{ number_format($stats['total_original_value'] - $stats['total_discounted_value'], 0) }}
                                                        DJF</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Information -->
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-head">
                                            <h6 class="card-title">Status Information</h6>
                                        </div>
                                        <div class="nk-tb-list">
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Current Status</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span class="badge badge-dot bg-{{ $flashSale->getStatusColor() }}">
                                                        {{ $flashSale->getStatusLabel() }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Flash Sale ID</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span
                                                        class="sub-text">#{{ str_pad($flashSale->id, 4, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Slug</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span class="sub-text">{{ $flashSale->slug }}</span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="sub-text">Created</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-end">
                                                    <span
                                                        class="sub-text">{{ $flashSale->created_at->format('M d, Y H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Timeline Information -->
                                        <div class="mt-4">
                                            <h6 class="title">Timeline</h6>
                                            <div class="timeline">
                                                @if (now() < $flashSale->start_at)
                                                    <div class="timeline-item">
                                                        <div class="timeline-marker bg-warning"></div>
                                                        <div class="timeline-content">
                                                            <p class="timeline-title">Upcoming</p>
                                                            <p class="timeline-text">Starts in
                                                                {{ $flashSale->start_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                @elseif (now() >= $flashSale->start_at && now() <= $flashSale->end_at)
                                                    <div class="timeline-item">
                                                        <div class="timeline-marker bg-success"></div>
                                                        <div class="timeline-content">
                                                            <p class="timeline-title">Active Now</p>
                                                            <p class="timeline-text">Ends in
                                                                {{ $flashSale->end_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="timeline-item">
                                                        <div class="timeline-marker bg-gray"></div>
                                                        <div class="timeline-content">
                                                            <p class="timeline-title">Ended</p>
                                                            <p class="timeline-text">
                                                                {{ $flashSale->end_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="timeline-item">
                                                    <div class="timeline-marker bg-light"></div>
                                                    <div class="timeline-content">
                                                        <p class="timeline-title">Duration</p>
                                                        <p class="timeline-text">
                                                            {{ $flashSale->start_at->diffForHumans($flashSale->end_at, true) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .product-card {
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
        }

        .product-thumb {
            position: relative;
            padding-bottom: 75%;
            overflow: hidden;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .product-thumb img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-thumb-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #f5f6fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c4c8d1;
        }

        .product-thumb-placeholder .icon {
            font-size: 2rem;
        }

        .product-title {
            font-size: 0.875rem;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price .price-now {
            font-weight: 600;
            color: #22c55e;
        }

        .product-price .price-old {
            font-size: 0.75rem;
            color: #64748b;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .timeline {
            position: relative;
        }

        .timeline-item {
            position: relative;
            padding-left: 25px;
            margin-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: 0;
            top: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .timeline-title {
            font-weight: 600;
            margin-bottom: 4px;
            font-size: 0.875rem;
        }

        .timeline-text {
            font-size: 0.75rem;
            color: #64748b;
            margin: 0;
        }
    </style>
@endsection
