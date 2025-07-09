@extends('layouts.app.admin')

@section('title', 'Create Promotion')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Create Promotion</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Add a new promotion to the platform</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('admin.promotions.index') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('admin.promotions.index') }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('admin.promotions.store') }}" method="POST"
                                    enctype="multipart/form-data" id="promotionForm">
                                    @csrf

                                    <div class="row g-4">
                                        <!-- Basic Information -->
                                        <div class="col-lg-8">
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="card-head">
                                                        <h5 class="card-title">Promotion Information</h5>
                                                    </div>

                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="title">Title <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text"
                                                                        class="form-control @error('title') is-invalid @enderror"
                                                                        id="title" name="title"
                                                                        value="{{ old('title') }}" required>
                                                                    @error('title')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="description">Description</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                                        rows="4">{{ old('description') }}</textarea>
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
                                                                <label class="form-label" for="promotion_type">Promotion
                                                                    Type <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <select
                                                                        class="form-select js-select2 @error('promotion_type') is-invalid @enderror"
                                                                        id="promotion_type" name="promotion_type"
                                                                        data-placeholder="Select Type" required>
                                                                        <option value=""></option>
                                                                        @foreach ($promotionTypes as $type)
                                                                            <option value="{{ $type->value }}"
                                                                                {{ old('promotion_type') == $type->value ? 'selected' : '' }}>
                                                                                {{ $type->label() }}
                                                                            </option>
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
                                                                <label class="form-label" for="campaign_id">Campaign
                                                                    (Optional)</label>
                                                                <div class="form-control-wrap">
                                                                    <select
                                                                        class="form-select js-select2 @error('campaign_id') is-invalid @enderror"
                                                                        id="campaign_id" name="campaign_id"
                                                                        data-placeholder="Select Campaign">
                                                                        <option value=""></option>
                                                                        @foreach ($campaigns as $campaign)
                                                                            <option value="{{ $campaign->id }}"
                                                                                {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                                                                {{ $campaign->name }}
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

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="start_at">Start Date & Time
                                                                    <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="datetime-local"
                                                                        class="form-control @error('start_at') is-invalid @enderror"
                                                                        id="start_at" name="start_at"
                                                                        value="{{ old('start_at') }}" required>
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
                                                                <label class="form-label" for="end_at">End Date & Time
                                                                    <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="datetime-local"
                                                                        class="form-control @error('end_at') is-invalid @enderror"
                                                                        id="end_at" name="end_at"
                                                                        value="{{ old('end_at') }}" required>
                                                                    @error('end_at')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Discount Fields (shown conditionally) -->
                                                        <div class="col-md-6 discount-field d-none">
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount_value">Discount
                                                                    Value <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number"
                                                                        class="form-control @error('discount_value') is-invalid @enderror"
                                                                        id="discount_value" name="discount_value"
                                                                        value="{{ old('discount_value') }}"
                                                                        step="0.01" min="0">
                                                                    @error('discount_value')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label"
                                                                    for="min_purchase_amount">Minimum Purchase
                                                                    Amount</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number"
                                                                        class="form-control @error('min_purchase_amount') is-invalid @enderror"
                                                                        id="min_purchase_amount"
                                                                        name="min_purchase_amount"
                                                                        value="{{ old('min_purchase_amount') }}"
                                                                        step="0.01" min="0">
                                                                    @error('min_purchase_amount')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Buy X Get Y Free Fields (shown conditionally) -->
                                                        <div class="col-md-4 bxgy-field d-none">
                                                            <div class="form-group">
                                                                <label class="form-label" for="required_quantity">Required
                                                                    Quantity <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number"
                                                                        class="form-control @error('required_quantity') is-invalid @enderror"
                                                                        id="required_quantity" name="required_quantity"
                                                                        value="{{ old('required_quantity') }}"
                                                                        min="1">
                                                                    @error('required_quantity')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 bxgy-field d-none">
                                                            <div class="form-group">
                                                                <label class="form-label" for="free_quantity">Free
                                                                    Quantity <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number"
                                                                        class="form-control @error('free_quantity') is-invalid @enderror"
                                                                        id="free_quantity" name="free_quantity"
                                                                        value="{{ old('free_quantity') }}"
                                                                        min="1">
                                                                    @error('free_quantity')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 bxgy-field d-none">
                                                            <div class="form-group">
                                                                <label class="form-label" for="free_product_id">Free
                                                                    Product <span class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <select
                                                                        class="form-select js-select2-products @error('free_product_id') is-invalid @enderror"
                                                                        id="free_product_id" name="free_product_id"
                                                                        data-placeholder="Select Product">
                                                                        <option value=""></option>
                                                                        @foreach ($products as $product)
                                                                            <option value="{{ $product->id }}"
                                                                                data-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : '' }}"
                                                                                data-seller="{{ $product->seller->business_name }}"
                                                                                data-price="{{ number_format($product->price_regular, 0) }} DJF"
                                                                                {{ old('free_product_id') == $product->id ? 'selected' : '' }}>
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
                                                                <label class="form-label" for="usage_limit">Usage
                                                                    Limit</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number"
                                                                        class="form-control @error('usage_limit') is-invalid @enderror"
                                                                        id="usage_limit" name="usage_limit"
                                                                        value="{{ old('usage_limit') }}" min="1">
                                                                    @error('usage_limit')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="is_active" name="is_active" value="1"
                                                                        {{ old('is_active') ? 'checked' : '' }}>
                                                                    <label class="custom-control-label"
                                                                        for="is_active">Active</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Products Selection -->
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="products">Products <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="form-control-wrap">
                                                                    <select
                                                                        class="form-select js-select2-products @error('products') is-invalid @enderror"
                                                                        id="products" name="products[]"
                                                                        data-placeholder="Choose products" multiple
                                                                        required>
                                                                        @foreach ($products as $product)
                                                                            <option value="{{ $product->id }}"
                                                                                data-image="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_path) : '' }}"
                                                                                data-seller="{{ $product->seller->business_name }}"
                                                                                data-price="{{ number_format($product->price_regular, 0) }} DJF"
                                                                                {{ is_array(old('products')) && in_array($product->id, old('products')) ? 'selected' : '' }}>
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
                                                                <div class="form-note">Select one or more products for this
                                                                    promotion.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sidebar -->
                                        <div class="col-lg-4">
                                            <!-- Banner Image -->
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="card-head">
                                                        <h6 class="card-title">Banner Image</h6>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label" for="banner_image">Upload Image</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file"
                                                                    class="form-file-input @error('banner_image') is-invalid @enderror"
                                                                    id="banner_image" name="banner_image"
                                                                    accept="image/*">
                                                                <label class="form-file-label" for="banner_image">Choose
                                                                    file</label>
                                                            </div>
                                                            @error('banner_image')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-note">Max file size: 2MB. Accepted formats: JPG,
                                                            PNG, GIF.</div>
                                                    </div>
                                                    <div class="image-preview mt-2" id="imagePreview"
                                                        style="display: none;">
                                                        <img src="" alt="Preview" class="img-thumbnail"
                                                            style="max-width: 100%; height: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-lg btn-primary">Create Promotion</button>
                                        <a href="{{ route('admin.promotions.index') }}"
                                            class="btn btn-lg btn-outline-light">Cancel</a>
                                    </div>
                                </form>
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
        /* Custom styling for Select2 with images */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f8f9fa;
            border: 1px solid #e3e7fe;
            border-radius: 4px;
            padding: 4px 12px;
            margin: 3px;
            max-width: none;
            font-size: 13px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #6b7280;
            margin-right: 8px;
            font-size: 16px;
        }

        .select2-results__option {
            padding: 12px 16px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #f3f4f6;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            padding: 6px 8px;
            min-height: 60px;
        }

        .select2-dropdown {
            min-width: 500px !important;
        }

        /* Make the dropdown options wider for long product names */
        .select2-container .select2-dropdown .select2-results__options {
            max-height: 300px;
        }

        /* Better spacing for product selection area */
        .js-select2-products+.select2-container {
            width: 100% !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.js-select2').select2();

            // Initialize Select2 for products with custom template
            $('.js-select2-products').select2({
                templateResult: formatProduct,
                templateSelection: formatProductSelection,
                escapeMarkup: function(markup) {
                    return markup;
                },
                width: '100%',
                placeholder: 'Choose products',
                allowClear: true
            });

            // Custom template for product options
            function formatProduct(product) {
                if (!product.id) {
                    return product.text;
                }

                var $product = $(product.element);
                var imageUrl = $product.data('image');
                var seller = $product.data('seller');
                var price = $product.data('price');
                var productName = product.text || $product.text() || $product.html();

                if (!productName) {
                    productName = 'Unknown Product';
                }

                var $container = $(
                    '<div class="d-flex align-items-start" style="width: 100%;">' +
                    '<div class="me-3 flex-shrink-0">' +
                    (imageUrl ?
                        '<img src="' + imageUrl +
                        '" alt="Product" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;">' :
                        '<div style="width: 50px; height: 50px; background-color: #e3e7fe; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #6366f1; font-weight: bold; font-size: 16px;">' +
                        productName.charAt(0).toUpperCase() + '</div>'
                    ) +
                    '</div>' +
                    '<div class="flex-grow-1">' +
                    '<div style="font-weight: 600; color: #1f2937; font-size: 15px; line-height: 1.3; margin-bottom: 4px;">' +
                    productName + '</div>' +
                    '<div style="font-size: 13px; color: #6b7280; line-height: 1.2;">' +
                    '<span style="font-weight: 500;">' + seller + '</span>' +
                    '<span style="margin: 0 8px; color: #d1d5db;">•</span>' +
                    '<span style="font-weight: 600; color: #059669;">' + price + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );

                return $container;
            }

            // Custom template for selected products
            function formatProductSelection(product) {
                if (!product.id) {
                    return product.text;
                }

                var $product = $(product.element);
                var imageUrl = $product.data('image');
                var productName = product.text || $product.text() || $product.html();

                if (!productName) {
                    productName = 'Unknown Product';
                }

                // For multiple select, show compact version with image but readable text
                var $selection = $(
                    '<div class="d-flex align-items-center" style="max-width: 250px;">' +
                    '<div class="me-2 flex-shrink-0">' +
                    (imageUrl ?
                        '<img src="' + imageUrl +
                        '" alt="Product" style="width: 28px; height: 28px; object-fit: cover; border-radius: 4px;">' :
                        '<div style="width: 28px; height: 28px; background-color: #e3e7fe; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #6366f1; font-weight: bold; font-size: 11px;">' +
                        productName.charAt(0).toUpperCase() + '</div>'
                    ) +
                    '</div>' +
                    '<span style="font-size: 13px; color: #374151; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' +
                    productName + '</span>' +
                    '</div>'
                );

                return $selection;
            }

            // Handle promotion type change
            const promotionTypeSelect = $('#promotion_type');
            const discountFields = $('.discount-field');
            const bxgyFields = $('.bxgy-field');

            function toggleFields() {
                const selectedType = promotionTypeSelect.val();

                // Hide all conditional fields first
                discountFields.addClass('d-none');
                bxgyFields.addClass('d-none');

                // Show relevant fields based on promotion type
                if (selectedType === 'percentage_discount' || selectedType === 'fixed_amount_discount') {
                    discountFields.removeClass('d-none');
                } else if (selectedType === 'buy_x_get_y_free') {
                    bxgyFields.removeClass('d-none');
                }
            }

            // Initial toggle
            toggleFields();

            // Toggle on change
            promotionTypeSelect.on('change', toggleFields);

            // Image preview
            $('#banner_image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').show();
                        $('#imagePreview img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });

            // Form validation
            $('#promotionForm').on('submit', function(e) {
                const selectedProducts = $('#products').val();
                if (!selectedProducts || selectedProducts.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one product for this promotion.');
                    return false;
                }

                const promotionType = $('#promotion_type').val();
                if (promotionType === 'percentage_discount' || promotionType === 'fixed_amount_discount') {
                    const discountValue = $('#discount_value').val();
                    if (!discountValue || discountValue <= 0) {
                        e.preventDefault();
                        alert('Please enter a valid discount value.');
                        return false;
                    }

                    if (promotionType === 'percentage_discount' && discountValue > 100) {
                        e.preventDefault();
                        alert('Percentage discount cannot exceed 100%.');
                        return false;
                    }
                } else if (promotionType === 'buy_x_get_y_free') {
                    const requiredQty = $('#required_quantity').val();
                    const freeQty = $('#free_quantity').val();
                    const freeProduct = $('#free_product_id').val();

                    if (!requiredQty || requiredQty <= 0) {
                        e.preventDefault();
                        alert('Please enter a valid required quantity.');
                        return false;
                    }

                    if (!freeQty || freeQty <= 0) {
                        e.preventDefault();
                        alert('Please enter a valid free quantity.');
                        return false;
                    }

                    if (!freeProduct) {
                        e.preventDefault();
                        alert('Please select a free product.');
                        return false;
                    }
                }
            });
        });
    </script>
@endsection
