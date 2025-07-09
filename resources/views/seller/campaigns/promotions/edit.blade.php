@extends('layouts.app.seller')

@section('title', 'Edit Promotion')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Edit Promotion</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Edit your promotion for the campaign: {{ $campaign->name }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <a href="{{ route('seller.campaigns.promotions.show', $promotion) }}"
                                                    class="btn btn-outline-light">
                                                    <em class="icon ni ni-eye"></em>
                                                    <span>View Promotion</span>
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

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('seller.campaigns.promotions.update', $promotion) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Promotion Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="title" name="title"
                                                        value="{{ old('title', $promotion->title) }}" required>
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="description">Description</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                        rows="4">{{ old('description', $promotion->description) }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="start_at">Start Date <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="date"
                                                        class="form-control @error('start_at') is-invalid @enderror"
                                                        id="start_at" name="start_at"
                                                        value="{{ old('start_at', $promotion->start_at->format('Y-m-d')) }}"
                                                        min="{{ now()->format('Y-m-d') }}"
                                                        max="{{ $campaign->end_date->format('Y-m-d') }}" required>
                                                    @error('start_at')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="end_at">End Date <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="date"
                                                        class="form-control @error('end_at') is-invalid @enderror"
                                                        id="end_at" name="end_at"
                                                        value="{{ old('end_at', $promotion->end_at->format('Y-m-d')) }}"
                                                        min="{{ now()->format('Y-m-d') }}"
                                                        max="{{ $campaign->end_date->format('Y-m-d') }}" required>
                                                    @error('end_at')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-note">Cannot be later than campaign end date
                                                        ({{ $campaign->end_date->format('M d, Y') }})</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="promotion_type">Promotion Type <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <select
                                                        class="form-select @error('promotion_type') is-invalid @enderror"
                                                        id="promotion_type" name="promotion_type" required>
                                                        <option value="percentage_discount"
                                                            {{ old('promotion_type', $promotion->promotion_type->value) == 'percentage_discount' ? 'selected' : '' }}>
                                                            Percentage Discount
                                                        </option>
                                                        <option value="fixed_amount_discount"
                                                            {{ old('promotion_type', $promotion->promotion_type->value) == 'fixed_amount_discount' ? 'selected' : '' }}>
                                                            Fixed Amount Discount
                                                        </option>
                                                        <option value="buy_x_get_y_free"
                                                            {{ old('promotion_type', $promotion->promotion_type->value) == 'buy_x_get_y_free' ? 'selected' : '' }}>
                                                            Buy X Get Y Free
                                                        </option>
                                                        <option value="free_shipping"
                                                            {{ old('promotion_type', $promotion->promotion_type->value) == 'free_shipping' ? 'selected' : '' }}>
                                                            Free Shipping
                                                        </option>
                                                        <option value="bundle_deal"
                                                            {{ old('promotion_type', $promotion->promotion_type->value) == 'bundle_deal' ? 'selected' : '' }}>
                                                            Bundle Deal
                                                        </option>
                                                    </select>
                                                    @error('promotion_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-md-6 discount-value-group {{ !in_array($promotion->promotion_type->value, ['percentage_discount', 'fixed_amount_discount']) ? 'd-none' : '' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="discount_value">Discount Value <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('discount_value') is-invalid @enderror"
                                                        id="discount_value" name="discount_value"
                                                        value="{{ old('discount_value', $promotion->discount_value) }}"
                                                        step="0.01" min="0">
                                                    @error('discount_value')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 min-purchase-group">
                                            <div class="form-group">
                                                <label class="form-label" for="min_purchase_amount">Minimum Purchase
                                                    Amount</label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('min_purchase_amount') is-invalid @enderror"
                                                        id="min_purchase_amount" name="min_purchase_amount"
                                                        value="{{ old('min_purchase_amount', $promotion->min_purchase_amount) }}"
                                                        step="0.01" min="0">
                                                    @error('min_purchase_amount')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-md-6 buy-x-group {{ $promotion->promotion_type->value !== 'buy_x_get_y_free' ? 'd-none' : '' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="required_quantity">Buy Quantity (X) <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('required_quantity') is-invalid @enderror"
                                                        id="required_quantity" name="required_quantity"
                                                        value="{{ old('required_quantity', $promotion->required_quantity) }}"
                                                        min="1">
                                                    @error('required_quantity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-md-6 get-y-group {{ $promotion->promotion_type->value !== 'buy_x_get_y_free' ? 'd-none' : '' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="free_quantity">Free Quantity (Y) <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('free_quantity') is-invalid @enderror"
                                                        id="free_quantity" name="free_quantity"
                                                        value="{{ old('free_quantity', $promotion->free_quantity) }}"
                                                        min="1">
                                                    @error('free_quantity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="usage_limit">Usage Limit</label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('usage_limit') is-invalid @enderror"
                                                        id="usage_limit" name="usage_limit"
                                                        value="{{ old('usage_limit', $promotion->usage_limit) }}"
                                                        min="1">
                                                    @error('usage_limit')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-note">Leave empty for unlimited usage</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="banner_image">Banner Image</label>
                                                @if ($promotion->banner_image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $promotion->banner_image) }}"
                                                            class="img-fluid rounded" style="max-height: 150px;"
                                                            alt="{{ $promotion->title }}">
                                                        <p class="text-muted small">Current banner image</p>
                                                    </div>
                                                @endif
                                                <div class="form-control-wrap">
                                                    <input type="file"
                                                        class="form-control @error('banner_image') is-invalid @enderror"
                                                        id="banner_image" name="banner_image" accept="image/*">
                                                    @error('banner_image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    <div class="form-note">Upload a new image to replace the current one
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Select Products for Promotion <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    @if ($products->count() > 0)
                                                        <div class="row g-3 product-selector">
                                                            @foreach ($products as $product)
                                                                <div class="col-lg-3 col-md-4 col-sm-6">
                                                                    <div class="product-item card h-100"
                                                                        data-id="{{ $product->id }}">
                                                                        <div class="product-thumb">
                                                                            @if ($product->thumbnail)
                                                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                                    class="card-img-top product-image"
                                                                                    alt="{{ $product->title }}">
                                                                            @else
                                                                                <div class="placeholder-image">
                                                                                    <em class="icon ni ni-img"></em>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="card-body p-3">
                                                                            <h6 class="product-title card-title mb-1">
                                                                                {{ $product->title }}</h6>
                                                                            <div class="product-price">
                                                                                <span
                                                                                    class="price">{{ number_format($product->price_regular, 2) }}
                                                                                    {{ config('app.currency_symbol', 'Fdj') }}</span>
                                                                            </div>
                                                                            <div class="product-select">
                                                                                <div
                                                                                    class="custom-control custom-control-sm custom-checkbox mt-1">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input product-checkbox"
                                                                                        id="product_{{ $product->id }}"
                                                                                        name="product_ids[]"
                                                                                        value="{{ $product->id }}"
                                                                                        {{ in_array($product->id, old('product_ids', $selectedProductIds)) ? 'checked' : '' }}>
                                                                                    <label class="custom-control-label"
                                                                                        for="product_{{ $product->id }}">
                                                                                        Select
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @error('product_ids')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    @else
                                                        <div class="alert alert-warning">
                                                            You don't have any products to add to this promotion.
                                                            <a href="{{ route('seller.products.create') }}">Create a
                                                                product first</a>.
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary" id="updatePromotionBtn"
                                                {{ $products->count() == 0 ? 'disabled' : '' }}>
                                                <span class="spinner d-none"><em
                                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                                <span class="btn-text">Update Promotion</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const promotionTypeSelect = $('#promotion_type');
            const discountValueGroup = $('.discount-value-group');
            const minPurchaseGroup = $('.min-purchase-group');
            const buyXGroup = $('.buy-x-group');
            const getYGroup = $('.get-y-group');

            function updateFormFields() {
                const selectedType = promotionTypeSelect.val();

                // Hide all conditional fields first
                discountValueGroup.addClass('d-none');
                buyXGroup.addClass('d-none');
                getYGroup.addClass('d-none');

                // Show fields based on selected promotion type
                if (selectedType === 'percentage_discount' || selectedType === 'fixed_amount_discount') {
                    discountValueGroup.removeClass('d-none');
                } else if (selectedType === 'buy_x_get_y_free') {
                    buyXGroup.removeClass('d-none');
                    getYGroup.removeClass('d-none');
                }
            }

            // Initialize product selection
            $(document).on('click', '.product-item', function(e) {
                if (!$(e.target).is('input[type="checkbox"]') && !$(e.target).is('label')) {
                    const checkbox = $(this).find('.product-checkbox');
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    if (checkbox.prop('checked')) {
                        $(this).addClass('selected');
                    } else {
                        $(this).removeClass('selected');
                    }
                }
            });

            $(document).on('change', '.product-checkbox', function() {
                const card = $(this).closest('.product-item');
                if ($(this).is(':checked')) {
                    card.addClass('selected');
                } else {
                    card.removeClass('selected');
                }
            });

            $('.product-checkbox:checked').each(function() {
                $(this).closest('.product-item').addClass('selected');
            });

            // Form submission handling
            const $updatePromotionForm = $('form');
            const $submitButton = $('#updatePromotionBtn');
            const $submitButtonSpinner = $submitButton.find('.spinner');
            const $submitButtonText = $submitButton.find('.btn-text');

            if ($updatePromotionForm.length) {
                $updatePromotionForm.on('submit', function(event) {
                    $submitButton.prop('disabled', true);
                    $submitButtonSpinner.removeClass('d-none');
                    $submitButtonText.text('Updating Promotion...');
                });
            }

            // Initial update and event listener
            updateFormFields();
            promotionTypeSelect.on('change', updateFormFields);
        });
    </script>
@endsection

@section('css')
    <style>
        /* Product selector styles */
        .product-selector {
            max-height: 500px;
            overflow-y: auto;
            border: 1px solid #dbdfea;
            padding: 10px;
            border-radius: 4px;
        }

        .product-item {
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #e5e9f2;
            margin-bottom: 10px;
        }

        .product-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-item.selected {
            border: 2px solid #6576ff;
            background-color: rgba(101, 118, 255, 0.05);
        }

        .product-thumb {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #f5f6fa;
        }

        .product-image {
            max-height: 100%;
            object-fit: contain;
        }

        .placeholder-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dbdfea;
            font-size: 2rem;
        }

        .product-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }
    </style>
@endsection
