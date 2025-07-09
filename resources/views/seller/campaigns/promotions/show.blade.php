@extends('layouts.app.seller')

@section('title', $promotion->title)

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Promotion: {{ $promotion->title }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>View your campaign promotion details</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <a href="{{ route('seller.campaigns.promotions.edit', $promotion) }}"
                                                    class="btn btn-outline-primary">
                                                    <em class="icon ni ni-edit"></em>
                                                    <span>Edit Promotion</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('seller.campaigns.show', $campaign) }}"
                                                    class="btn btn-outline-light">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>Back to Campaign</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alert for success message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                @if ($promotion->banner_image)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $promotion->banner_image) }}" class="w-100 rounded"
                                            alt="{{ $promotion->title }}">
                                    </div>
                                @endif

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Promotion Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="{{ $promotion->title }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="form-control-wrap">
                                                @if ($promotion->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Campaign</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="{{ $campaign->name }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Promotion Type</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion->promotion_type->label() }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion->start_at->format('M d, Y') }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $promotion->end_at->format('M d, Y') }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Display fields based on promotion type -->
                                @if (
                                    $promotion->promotion_type->value === 'percentage_discount' ||
                                        $promotion->promotion_type->value === 'fixed_amount_discount')
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Discount Value</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $promotion->promotion_type->value === 'percentage_discount'
                                                            ? $promotion->discount_value . '%'
                                                            : '$' . number_format($promotion->discount_value, 2) }}"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($promotion->min_purchase_amount)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Minimum Purchase</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            value="${{ number_format($promotion->min_purchase_amount, 2) }}"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @elseif($promotion->promotion_type->value === 'buy_x_get_y_free')
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Buy Quantity (X)</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $promotion->required_quantity }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Free Quantity (Y)</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $promotion->free_quantity }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($promotion->usage_limit)
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Usage Limit</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        value="{{ $promotion->usage_limit }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row g-3 mb-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" disabled rows="4">{{ $promotion->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="nk-divider divider md"></div>

                                <div class="mt-4">
                                    <h5>Products in this Promotion</h5>

                                    @if ($products->count() > 0)
                                        <div class="card card-bordered mt-3">
                                            <table class="table table-ulogs">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="tb-col-os">Image</th>
                                                        <th class="tb-col-ip">Product Name</th>
                                                        <th class="tb-col-time">Price</th>
                                                        <th class="tb-col-time">Stock</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td class="tb-col-os">
                                                                @if ($product->thumbnail)
                                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                        class="img-fluid rounded"
                                                                        style="max-height: 50px; max-width: 50px;"
                                                                        alt="{{ $product->title }}">
                                                                @else
                                                                    <div class="bg-light rounded text-center"
                                                                        style="height: 50px; width: 50px; line-height: 50px;">
                                                                        <em class="icon ni ni-image"></em>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td class="tb-col-ip">
                                                                <a href="{{ route('seller.products.show', $product) }}"
                                                                    class="fw-medium">
                                                                    {{ $product->title }}
                                                                </a>
                                                            </td>
                                                            <td class="tb-col-time">
                                                                <span
                                                                    class="badge bg-light text-dark">${{ number_format($product->price_regular, 2) }}</span>
                                                            </td>
                                                            <td class="tb-col-time">
                                                                <span
                                                                    class="badge bg-light text-dark">{{ $product->stock_quantity }}</span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <p>No products associated with this promotion.</p>
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
@endsection
