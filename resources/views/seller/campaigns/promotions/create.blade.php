@extends('layouts.app.seller')

@section('title', 'Create Promotion')
@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Create Promotion</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Create a new promotion for the campaign: {{ $campaign->name }}</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('seller.campaigns.show', $campaign) }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Back to Campaign</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('seller.campaigns.promotions.store', $campaign) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Promotion Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="title" name="title" value="{{ old('title') }}" required>
                                                    <span class="text-danger client-validation-error"
                                                        id="title-error-client"></span>
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
                                                        rows="4">{{ old('description') }}</textarea>
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
                                                        value="{{ old('start_at', now()->format('Y-m-d')) }}"
                                                        min="{{ now()->format('Y-m-d') }}"
                                                        max="{{ $campaign->end_date->format('Y-m-d') }}" required>
                                                    <span class="text-danger client-validation-error"
                                                        id="start_at-error-client"></span>
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
                                                        value="{{ old('end_at', $campaign->end_date->format('Y-m-d')) }}"
                                                        min="{{ now()->format('Y-m-d') }}"
                                                        max="{{ $campaign->end_date->format('Y-m-d') }}" required>
                                                    <span class="text-danger client-validation-error"
                                                        id="end_at-error-client"></span>
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
                                                        <option value=""
                                                            {{ old('promotion_type') == '' ? 'selected' : '' }}>Select Type
                                                        </option>
                                                        <option value="percentage_discount"
                                                            {{ old('promotion_type') == 'percentage_discount' ? 'selected' : '' }}>
                                                            Percentage Discount
                                                        </option>
                                                        <option value="fixed_amount_discount"
                                                            {{ old('promotion_type') == 'fixed_amount_discount' ? 'selected' : '' }}>
                                                            Fixed Amount Discount
                                                        </option>
                                                        <option value="buy_x_get_y_free"
                                                            {{ old('promotion_type') == 'buy_x_get_y_free' ? 'selected' : '' }}>
                                                            Buy X Get Y Free
                                                        </option>
                                                        <option value="free_shipping"
                                                            {{ old('promotion_type') == 'free_shipping' ? 'selected' : '' }}>
                                                            Free Shipping
                                                        </option>
                                                        <option value="bundle_deal"
                                                            {{ old('promotion_type') == 'bundle_deal' ? 'selected' : '' }}>
                                                            Bundle Deal
                                                        </option>
                                                    </select>
                                                    <span class="text-danger client-validation-error"
                                                        id="promotion_type-error-client"></span>
                                                    @error('promotion_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 discount-value-group">
                                            <div class="form-group">
                                                <label class="form-label" for="discount_value">Discount Value <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('discount_value') is-invalid @enderror"
                                                        id="discount_value" name="discount_value"
                                                        value="{{ old('discount_value') }}" step="0.01"
                                                        min="0">
                                                    <span class="text-danger client-validation-error"
                                                        id="discount_value-error-client"></span>
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
                                                        value="{{ old('min_purchase_amount') }}" step="0.01"
                                                        min="0">
                                                    @error('min_purchase_amount')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 buy-x-group d-none">
                                            <div class="form-group">
                                                <label class="form-label" for="required_quantity">Buy Quantity (X) <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('required_quantity') is-invalid @enderror"
                                                        id="required_quantity" name="required_quantity"
                                                        value="{{ old('required_quantity') }}" min="1">
                                                    <span class="text-danger client-validation-error"
                                                        id="required_quantity-error-client"></span>
                                                    @error('required_quantity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 get-y-group d-none">
                                            <div class="form-group">
                                                <label class="form-label" for="free_quantity">Free Quantity (Y) <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control @error('free_quantity') is-invalid @enderror"
                                                        id="free_quantity" name="free_quantity"
                                                        value="{{ old('free_quantity') }}" min="1">
                                                    <span class="text-danger client-validation-error"
                                                        id="free_quantity-error-client"></span>
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
                                                        value="{{ old('usage_limit') }}" min="1">
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
                                                <div class="form-control-wrap">
                                                    <input type="file"
                                                        class="form-control @error('banner_image') is-invalid @enderror"
                                                        id="banner_image" name="banner_image" accept="image/*">
                                                    @error('banner_image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                                                                    class="price">{{ number_format($product->price_regular ?? $product->price_regular, 2) }}
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
                                                                                        {{ in_array($product->id, old('product_ids', [])) ? 'checked' : '' }}>
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
                                                        <span class="text-danger client-validation-error"
                                                            id="product_ids-error-client"></span>
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
                                            <button type="submit" class="btn btn-primary" id="createPromotionBtn"
                                                {{ $products->count() == 0 ? 'disabled' : '' }}>
                                                <span class="spinner d-none"><em
                                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                                <span class="btn-text">Create Promotion</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            const promotionTypeSelect = document.getElementById('promotion_type');
            const discountValueGroup = document.querySelector('.discount-value-group');
            const discountValueInput = document.getElementById('discount_value');
            const minPurchaseGroup = document.querySelector('.min-purchase-group');
            const buyXGroup = document.querySelector('.buy-x-group');
            const requiredQuantityInput = document.getElementById('required_quantity');
            const getYGroup = document.querySelector('.get-y-group');
            const freeQuantityInput = document.getElementById('free_quantity');

            const createPromotionForm = document.querySelector('form');
            const submitButton = document.getElementById('createPromotionBtn');
            const submitButtonSpinner = submitButton.querySelector('.spinner');
            const submitButtonText = submitButton.querySelector('.btn-text');

            function updateFormFields() {
                const selectedType = promotionTypeSelect.value;

                // Hide all conditional fields first
                discountValueGroup.classList.add('d-none');
                discountValueInput.removeAttribute('required');

                buyXGroup.classList.add('d-none');
                requiredQuantityInput.removeAttribute('required');

                getYGroup.classList.add('d-none');
                freeQuantityInput.removeAttribute('required');


                // Show fields based on selected promotion type
                if (selectedType === 'percentage_discount' || selectedType === 'fixed_amount_discount') {
                    discountValueGroup.classList.remove('d-none');
                    discountValueInput.setAttribute('required', 'required');
                } else if (selectedType === 'buy_x_get_y_free') {
                    buyXGroup.classList.remove('d-none');
                    requiredQuantityInput.setAttribute('required', 'required');
                    getYGroup.classList.remove('d-none');
                    freeQuantityInput.setAttribute('required', 'required');
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

            updateFormFields();
            promotionTypeSelect.addEventListener('change', updateFormFields);

            if (createPromotionForm) {
                createPromotionForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    let isValid = true;

                    // Clear previous client-side errors
                    document.querySelectorAll('.client-validation-error').forEach(el => el.textContent =
                        '');

                    // Title validation
                    const titleInput = document.getElementById('title');
                    if (!titleInput.value.trim()) {
                        document.getElementById('title-error-client').textContent =
                            'Promotion title is required.';
                        isValid = false;
                    }

                    // Start Date validation
                    const startDateInput = document.getElementById('start_at');
                    if (!startDateInput.value) {
                        document.getElementById('start_at-error-client').textContent =
                            'Start date is required.';
                        isValid = false;
                    }

                    // End Date validation
                    const endDateInput = document.getElementById('end_at');
                    if (!endDateInput.value) {
                        document.getElementById('end_at-error-client').textContent =
                            'End date is required.';
                        isValid = false;
                    } else if (startDateInput.value && endDateInput.value < startDateInput.value) {
                        document.getElementById('end_at-error-client').textContent =
                            'End date cannot be before start date.';
                        isValid = false;
                    }

                    const campaignEndDate = "{{ $campaign->end_date->format('Y-m-d') }}";
                    if (endDateInput.value > campaignEndDate) {
                        document.getElementById('end_at-error-client').textContent =
                            'End date cannot be later than campaign end date ({{ $campaign->end_date->format('M d, Y') }}).';
                        isValid = false;
                    }


                    // Promotion Type validation
                    if (!promotionTypeSelect.value) {
                        document.getElementById('promotion_type-error-client').textContent =
                            'Promotion type is required.';
                        isValid = false;
                    } else {
                        // Conditional validation based on promotion type
                        if (promotionTypeSelect.value === 'percentage_discount' || promotionTypeSelect
                            .value === 'fixed_amount_discount') {
                            if (!discountValueInput.value.trim()) {
                                document.getElementById('discount_value-error-client').textContent =
                                    'Discount value is required.';
                                isValid = false;
                            } else if (isNaN(parseFloat(discountValueInput.value)) || parseFloat(
                                    discountValueInput.value) < 0) {
                                document.getElementById('discount_value-error-client').textContent =
                                    'Discount value must be a non-negative number.';
                                isValid = false;
                            }
                        } else if (promotionTypeSelect.value === 'buy_x_get_y_free') {
                            if (!requiredQuantityInput.value.trim()) {
                                document.getElementById('required_quantity-error-client').textContent =
                                    'Buy quantity (X) is required.';
                                isValid = false;
                            } else if (!Number.isInteger(parseFloat(requiredQuantityInput.value)) ||
                                parseInt(requiredQuantityInput.value) < 1) {
                                document.getElementById('required_quantity-error-client').textContent =
                                    'Buy quantity must be an integer greater than 0.';
                                isValid = false;
                            }

                            if (!freeQuantityInput.value.trim()) {
                                document.getElementById('free_quantity-error-client').textContent =
                                    'Free quantity (Y) is required.';
                                isValid = false;
                            } else if (!Number.isInteger(parseFloat(freeQuantityInput.value)) || parseInt(
                                    freeQuantityInput.value) < 1) {
                                document.getElementById('free_quantity-error-client').textContent =
                                    'Free quantity must be an integer greater than 0.';
                                isValid = false;
                            }
                        }
                    }

                    // Product IDs validation
                    const selectedProducts = document.querySelectorAll(
                        'input[name="product_ids[]"]:checked');
                    if (selectedProducts.length === 0 && {{ $products->count() }} > 0) {
                        document.getElementById('product_ids-error-client').textContent =
                            'Please select at least one product for the promotion.';
                        isValid = false;
                    }

                    if ({{ $products->count() }} == 0) {
                        document.getElementById('product_ids-error-client').textContent =
                            'You must add products to your store before creating a promotion.';
                        isValid = false;
                    }


                    if (isValid) {
                        submitButton.disabled = true;
                        submitButtonSpinner.classList.remove('d-none');
                        submitButtonText.textContent = 'Creating Promotion...';
                        this.submit(); // Submit the form
                    } else {
                        // Scroll to the first error message if desired
                        const firstError = document.querySelector('.client-validation-error:not(:empty)');
                        if (firstError) {
                            firstError.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    }
                });
            }
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

        /* Ensure the form label for product selection has no text-decoration */
        .form-group>.form-label {
            text-decoration: none !important;
            font-weight: 500;
            color: #364a63;
        }
    </style>
@endsection
