@extends('layouts.app.seller')

@section('title', 'Create Promotion')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}"> --}}
    <style>
        /* Product item with thumbnail styles */
        .select2-product-item {
            display: flex;
            align-items: center;
            padding: 5px 0;
        }

        .select2-product-thumb {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 4px;
            overflow: hidden;
            flex-shrink: 0;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .select2-product-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }

        .product-placeholder .icon {
            font-size: 1.5rem;
        }

        .select2-product-text {
            flex-grow: 1;
        }

        .select2-product-selected {
            /* display: inline-flex; */
            align-items: center;
        }

        .select2-product-thumb-small {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 5px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Create Promotion</h3>
                <div class="nk-block-des text-soft">
                    <p>Create a new promotion for your products.</p>
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
            <div class="card-inner">
                <form action="{{ route('seller.promotions.store') }}" method="POST" enctype="multipart/form-data"
                    class="form-validate">
                    @csrf

                    <div class="row g-gs">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="campaign_id">Campaign (Optional)</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 @error('campaign_id') is-invalid @enderror"
                                        id="campaign_id" name="campaign_id" data-placeholder="Select Campaign">
                                        <option value=""></option>
                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign->id }}"
                                                {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                                {{ $campaign->name }} ({{ $campaign->start_date->format('M d') }} -
                                                {{ $campaign->end_date->format('M d, Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('campaign_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="start_at">Start Date <span
                                        class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="datetime-local"
                                        class="form-control @error('start_at') is-invalid @enderror" id="start_at"
                                        name="start_at" value="{{ old('start_at') }}" required>
                                    @error('start_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="end_at">End Date <span class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="datetime-local" class="form-control @error('end_at') is-invalid @enderror"
                                        id="end_at" name="end_at" value="{{ old('end_at') }}" required>
                                    @error('end_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="promotion_type">Promotion Type <span
                                        class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 @error('promotion_type') is-invalid @enderror"
                                        id="promotion_type" name="promotion_type" data-placeholder="Select Type" required>
                                        <option value=""></option>
                                        @foreach ($promotionTypes as $type)
                                            <option value="{{ $type->value }}"
                                                {{ old('promotion_type') == $type->value ? 'selected' : '' }}>
                                                {{ $type->label() }}</option>
                                        @endforeach
                                    </select>
                                    @error('promotion_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="banner_image">Banner Image</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file"
                                            class="form-file-input @error('banner_image') is-invalid @enderror"
                                            id="banner_image" name="banner_image">
                                        <label class="form-file-label" for="banner_image">Choose file</label>
                                        @error('banner_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 discount-fields">
                            <div class="form-group">
                                <label class="form-label" for="discount_value">Discount Value <span
                                        class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number" step="0.01"
                                        class="form-control @error('discount_value') is-invalid @enderror"
                                        id="discount_value" name="discount_value" value="{{ old('discount_value') }}">
                                    @error('discount_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="text-muted">For percentage discount, enter a value between 1-100</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="min_purchase_amount">Minimum Purchase Amount</label>
                                <div class="form-control-wrap">
                                    <input type="number" step="0.01"
                                        class="form-control @error('min_purchase_amount') is-invalid @enderror"
                                        id="min_purchase_amount" name="min_purchase_amount"
                                        value="{{ old('min_purchase_amount') }}">
                                    @error('min_purchase_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 buy-x-get-y-fields d-none">
                            <div class="form-group">
                                <label class="form-label" for="required_quantity">Buy Quantity (X) <span
                                        class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number"
                                        class="form-control @error('required_quantity') is-invalid @enderror"
                                        id="required_quantity" name="required_quantity"
                                        value="{{ old('required_quantity') }}">
                                    @error('required_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 buy-x-get-y-fields d-none">
                            <div class="form-group">
                                <label class="form-label" for="free_quantity">Free Quantity (Y) <span
                                        class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <input type="number"
                                        class="form-control @error('free_quantity') is-invalid @enderror"
                                        id="free_quantity" name="free_quantity" value="{{ old('free_quantity') }}">
                                    @error('free_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 buy-x-get-y-fields d-none">
                            <div class="form-group">
                                <label class="form-label" for="free_product_id">Free Product <span
                                        class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 @error('free_product_id') is-invalid @enderror"
                                        id="free_product_id" name="free_product_id" data-placeholder="Select Product">
                                        <option value=""></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ old('free_product_id') == $product->id ? 'selected' : '' }}
                                                data-thumbnail="{{ $product->featured_image_url }}">
                                                {{ $product->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('free_product_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="usage_limit">Usage Limit</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control @error('usage_limit') is-invalid @enderror"
                                        id="usage_limit" name="usage_limit" value="{{ old('usage_limit') }}">
                                    @error('usage_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <small class="text-muted">Leave empty for unlimited usage</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Products <span class="text-danger">*</span></label>
                                <div class="form-control-wrap">
                                    <select multiple
                                        class="form-select js-select2 @error('products') is-invalid @enderror"
                                        id="products" name="products[]" data-placeholder="Select Products" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ is_array(old('products')) && in_array($product->id, old('products')) ? 'selected' : '' }}
                                                data-thumbnail="{{ $product->featured_image_url }}">
                                                {{ $product->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('products')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit-btn" id="createPromotionBtn">
                                    <span class="spinner d-none"><em
                                            class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                    <span class="btn-text">Create Promotion</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for regular dropdowns
            $('.js-select2:not(#products, #free_product_id)').select2({
                width: '100%',
                dropdownAutoWidth: true
            });

            // Initialize Select2 for products with thumbnails
            $('#products, #free_product_id').select2({
                width: '100%',
                dropdownAutoWidth: true,
                templateResult: formatProduct,
                templateSelection: formatProductSelection,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            // Format product items in dropdown
            function formatProduct(product) {
                if (!product.id) {
                    return product.text;
                }

                // Get data attributes from options
                const $option = $(product.element);
                const thumbnailUrl = $option.data('thumbnail');

                console.log("Product thumbnail URL:", thumbnailUrl); // Debug: log the URL

                const $result = $(
                    `<div class="select2-product-item">
                        <div class="select2-product-thumb">
                            ${thumbnailUrl 
                                ? `<img src="${thumbnailUrl}" onerror="this.onerror=null; this.parentNode.innerHTML='<em class=\'icon ni ni-img\'></em>'" alt="" />` 
                                : `<div class="product-placeholder"><em class="icon ni ni-img"></em></div>`
                            }
                        </div>
                        <div class="select2-product-text">
                            ${product.text}
                        </div>
                    </div>`
                );

                return $result;
            }

            // Format selected products
            function formatProductSelection(product) {
                if (!product.id) {
                    return product.text;
                }

                const $option = $(product.element);
                const thumbnailUrl = $option.data('thumbnail');

                // For selected items, just show a simple icon if no thumbnail
                return $(
                    `<span class="select2-product-selected">
                        ${thumbnailUrl ? `<img src="${thumbnailUrl}" class="select2-product-thumb-small" onerror="this.style.display='none'" />` : ''}
                        ${product.text}
                    </span>`
                );
            }

            // Handle file input display
            $('.form-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                if (fileName) {
                    $(this).next('.form-file-label').text(fileName);
                } else {
                    $(this).next('.form-file-label').text('Choose file');
                }
            });

            const promotionTypeSelect = document.getElementById('promotion_type');
            const discountFields = document.querySelectorAll('.discount-fields');
            const buyXGetYFields = document.querySelectorAll('.buy-x-get-y-fields');

            function toggleFields() {
                const selectedType = promotionTypeSelect.value;

                // Hide all conditional fields first
                discountFields.forEach(field => field.classList.add('d-none'));
                buyXGetYFields.forEach(field => field.classList.add('d-none'));

                // Show relevant fields based on promotion type
                if (selectedType === 'percentage_discount' || selectedType === 'fixed_amount_discount') {
                    discountFields.forEach(field => field.classList.remove('d-none'));
                } else if (selectedType === 'buy_x_get_y_free') {
                    buyXGetYFields.forEach(field => field.classList.remove('d-none'));
                }
            }

            // Initial toggle
            toggleFields();

            // Toggle on change
            promotionTypeSelect.addEventListener('change', toggleFields);

            // Also trigger change when Select2 changes
            $('#promotion_type').on('select2:select', toggleFields);
        });

        // Form validation and submit button state management
        function checkFormValidity() {
            const title = $('#title').val().trim();
            const startAt = $('#start_at').val();
            const endAt = $('#end_at').val();
            const promotionType = $('#promotion_type').val();
            const products = $('#products').val() || [];

            let isValid = title && startAt && endAt && promotionType && products.length > 0;

            // Additional validation based on promotion type
            if (promotionType === 'percentage_discount' || promotionType === 'fixed_amount_discount') {
                const discountValue = $('#discount_value').val();
                isValid = isValid && discountValue && parseFloat(discountValue) > 0;
            } else if (promotionType === 'buy_x_get_y_free') {
                const requiredQuantity = $('#required_quantity').val();
                const freeQuantity = $('#free_quantity').val();
                const freeProductId = $('#free_product_id').val();
                isValid = isValid && requiredQuantity && freeQuantity && freeProductId;
            }

            const $submitBtn = $('#createPromotionBtn');
            if (isValid) {
                $submitBtn.prop('disabled', false);
            } else {
                $submitBtn.prop('disabled', true);
            }
        }

        // Initially disable the submit button
        $('#createPromotionBtn').prop('disabled', true);

        // Bind validation to all required fields
        $('#title, #start_at, #end_at, #discount_value, #required_quantity, #free_quantity').on('input change',
            checkFormValidity);
        $('#promotion_type, #products, #free_product_id').on('change select2:select select2:unselect', checkFormValidity);

        // Form submission handling
        $('form').on('submit', function() {
            const $submitBtn = $(this).find('.submit-btn');
            $submitBtn.prop('disabled', true);
            $submitBtn.find('.spinner').removeClass('d-none');
            $submitBtn.find('.btn-text').text('Creating...');
            return true;
        });
    </script>
@endsection
