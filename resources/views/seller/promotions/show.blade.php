@extends('layouts.app.seller')

@section('title', 'Promotion Details')

@section('css')
    <style>
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .user-avatar.sq {
            border-radius: 6px;
        }

        .bg-gray-dim {
            background-color: #e5e7eb;
            color: #6b7280;
        }
    </style>
@endsection

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Promotion Details</h3>
                <div class="nk-block-des text-soft">
                    <p>View promotion details and products.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                        <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('seller.promotions.edit', $promotion) }}" class="btn btn-primary">
                                    <em class="icon ni ni-edit"></em><span>Edit</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="{{ route('seller.promotions.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em><span>Back</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-aside-wrap">
                <div class="card-content">
                    <div class="card-inner">
                        <div class="nk-block">
                            <div class="nk-block-head">
                                <h5 class="title">Promotion Information</h5>
                                <p>Basic information about the promotion.</p>
                            </div>

                            @if ($promotion->banner_image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $promotion->banner_image) }}"
                                        alt="{{ $promotion->title }}" class="img-fluid" style="max-height: 200px;">
                                </div>
                            @endif

                            <div class="profile-ud-list">
                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Title</span>
                                        <span class="profile-ud-value">{{ $promotion->title }}</span>
                                    </div>
                                </div>

                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Status</span>
                                        <span class="profile-ud-value">
                                            @if ($promotion->is_active && $promotion->start_at <= now() && $promotion->end_at >= now())
                                                <span class="badge badge-sm badge-dot bg-success">Active</span>
                                            @elseif($promotion->start_at > now())
                                                <span class="badge badge-sm badge-dot bg-warning">Upcoming</span>
                                            @elseif($promotion->end_at < now())
                                                <span class="badge badge-sm badge-dot bg-secondary">Expired</span>
                                            @else
                                                <span class="badge badge-sm badge-dot bg-danger">Inactive</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Start Date</span>
                                        <span
                                            class="profile-ud-value">{{ $promotion->start_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                </div>

                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">End Date</span>
                                        <span
                                            class="profile-ud-value">{{ $promotion->end_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                </div>

                                <div class="profile-ud-item">
                                    <div class="profile-ud wider">
                                        <span class="profile-ud-label">Promotion Type</span>
                                        <span class="profile-ud-value">{{ $promotion->promotion_type->label() }}</span>
                                    </div>
                                </div>

                                @if ($promotion->campaign)
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Campaign</span>
                                            <span class="profile-ud-value">{{ $promotion->campaign->name }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if (
                                    $promotion->promotion_type->value === 'percentage_discount' ||
                                        $promotion->promotion_type->value === 'fixed_amount_discount')
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Discount Value</span>
                                            <span class="profile-ud-value">
                                                {{ $promotion->discount_value }}
                                                @if ($promotion->promotion_type->value === 'percentage_discount')
                                                    %
                                                @else
                                                    $
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @if ($promotion->min_purchase_amount)
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Min. Purchase</span>
                                            <span class="profile-ud-value">${{ $promotion->min_purchase_amount }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($promotion->promotion_type->value === 'buy_x_get_y_free')
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Buy Quantity</span>
                                            <span class="profile-ud-value">{{ $promotion->required_quantity }}</span>
                                        </div>
                                    </div>

                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Free Quantity</span>
                                            <span class="profile-ud-value">{{ $promotion->free_quantity }}</span>
                                        </div>
                                    </div>

                                    @if ($promotion->freeProduct)
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Free Product</span>
                                                <span class="profile-ud-value">{{ $promotion->freeProduct->title }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($promotion->usage_limit)
                                    <div class="profile-ud-item">
                                        <div class="profile-ud wider">
                                            <span class="profile-ud-label">Usage Limit</span>
                                            <span class="profile-ud-value">{{ $promotion->usage_limit }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($promotion->description)
                            <div class="nk-block">
                                <div class="nk-block-head">
                                    <h5 class="title">Description</h5>
                                </div>
                                <div class="card-text">
                                    <p>{{ $promotion->description }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="nk-block">
                            <div class="nk-block-head">
                                <h5 class="title">Products in Promotion</h5>
                            </div>
                            @if ($promotion->products->count() > 0)
                                <div class="nk-tb-list nk-tb-ulist">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span class="sub-text">Product</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">SKU</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Price</span></div>
                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Stock</span></div>
                                    </div>

                                    @foreach ($promotion->products as $product)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <div class="user-card">
                                                    @if ($product->thumbnail)
                                                        <div class="user-avatar sq">
                                                            <img src="{{ Storage::disk('public')->url($product->thumbnail) }}"
                                                                alt="{{ $product->title }}" style="border-radius: 6px;">
                                                        </div>
                                                    @else
                                                        <div class="user-avatar sq bg-gray-dim"
                                                            style="border-radius: 6px;">
                                                            <span>{{ strtoupper(substr($product->title, 0, 2)) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $product->title }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ $product->sku ?? 'N/A' }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span
                                                    class="tb-amount {{ $product->price_discounted ? 'text-decoration-line-through' : '' }}">${{ number_format($product->price_regular, 2) }}</span>
                                                @if ($product->price_discounted)
                                                    <span
                                                        class="tb-amount text-success">${{ number_format($product->price_discounted, 2) }}</span>
                                                @endif
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span>{{ $product->stock_quantity }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <em class="icon ni ni-alert-circle"></em> No products associated with this promotion.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
