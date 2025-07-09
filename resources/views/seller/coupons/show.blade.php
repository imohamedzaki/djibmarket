@extends('layouts.app.seller')
@section('title', 'Coupon: ' . $coupon->code)

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Coupon Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.coupons.index') }}">Coupons</a></li>
                                <li class="breadcrumb-item active">{{ $coupon->code }}</li>
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
                                        <button type="button" class="btn btn-primary edit-coupon-button"
                                            data-bs-toggle="modal" data-bs-target="#editCouponModal"
                                            data-id="{{ $coupon->id }}" data-code="{{ $coupon->code }}"
                                            data-type="{{ $coupon->type->value }}" data-amount="{{ $coupon->amount }}"
                                            data-min-purchase="{{ $coupon->min_purchase }}"
                                            data-start-date="{{ $coupon->start_date->format('Y-m-d') }}"
                                            data-end-date="{{ $coupon->end_date->format('Y-m-d') }}"
                                            data-usage-limit="{{ $coupon->usage_limit }}"
                                            data-is-active="{{ $coupon->is_active }}"
                                            data-description="{{ $coupon->description }}"
                                            data-applicability-type="{{ $coupon->applicability_type }}"
                                            data-category-id="{{ $coupon->applicability_type === 'category' ? $coupon->category_id : '' }}"
                                            data-applicable-products="{{ $coupon->applicability_type === 'products' && $coupon->applicableProducts->count() ? $coupon->applicableProducts->pluck('id')->implode(',') : '' }}"
                                            data-applicable-categories="{{ $coupon->applicability_type === 'category' && $coupon->applicableCategories->count() ? $coupon->applicableCategories->pluck('id')->implode(',') : '' }}"
                                            data-update-url="{{ route('seller.coupons.update', $coupon->id) }}">
                                            <em class="icon ni ni-edit"></em><span>Edit Coupon</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-danger delete-coupon-button"
                                            data-bs-toggle="modal" data-bs-target="#deleteCouponModal"
                                            data-id="{{ $coupon->id }}" data-code="{{ $coupon->code }}"
                                            data-delete-url="{{ route('seller.coupons.destroy', $coupon->id) }}">
                                            <em class="icon ni ni-trash"></em><span>Delete Coupon</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Session Success/Error Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />
            {{-- Validation Error Summary (for modal errors) --}}
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="row g-gs">
                            {{-- Coupon Code & Type --}}
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Coupon Code</div>
                                    <div class="profile-ud-value fw-bold fs-5">{{ $coupon->code }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Discount Type</div>
                                    <div class="profile-ud-value">{{ Str::ucfirst($coupon->type->value) }}</div>
                                </div>
                            </div>

                            {{-- Discount Amount & Min Purchase --}}
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Discount Amount</div>
                                    <div class="profile-ud-value">
                                        {{ $coupon->type->value == 'percentage' ? $coupon->amount . '%' : config('app.currency_symbol', 'DJF') . number_format($coupon->amount, 2) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Minimum Purchase</div>
                                    <div class="profile-ud-value">
                                        {{ $coupon->min_purchase ? config('app.currency_symbol', 'DJF') . number_format($coupon->min_purchase, 2) : 'None' }}
                                    </div>
                                </div>
                            </div>

                            {{-- Start & End Date --}}
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Start Date</div>
                                    <div class="profile-ud-value">{{ $coupon->start_date->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">End Date</div>
                                    <div class="profile-ud-value">{{ $coupon->end_date->format('d M Y') }}</div>
                                </div>
                            </div>

                            {{-- Usage Limit & Status --}}
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Usage Limit</div>
                                    <div class="profile-ud-value">{{ $coupon->usage_limit ?? 'Unlimited' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Status</div>
                                    <div class="profile-ud-value">
                                        @if ($coupon->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Applicability Type --}}
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Applicability Type</div>
                                    <div class="profile-ud-value">
                                        {{ Str::ucfirst(str_replace('_', ' ', $coupon->applicability_type ?? 'N/A')) }}
                                    </div>
                                </div>
                            </div>

                            @if ($coupon->applicability_type === 'category' && $coupon->applicableCategories->count() > 0)
                                <div class="col-md-6">
                                    <div class="profile-ud-item">
                                        <div class="profile-ud-label text-soft">Applicable Categories</div>
                                        <div class="profile-ud-value">
                                            @foreach ($coupon->applicableCategories as $category)
                                                <span class="badge bg-primary me-1 mb-1">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Description --}}
                            <div class="col-12">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Description</div>
                                    <div class="profile-ud-value">{!! nl2br(e($coupon->description ?? 'No description provided.')) !!}</div>
                                </div>
                            </div>

                            {{-- Timestamps --}}
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Created At</div>
                                    <div class="profile-ud-value">{{ $coupon->created_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-ud-item">
                                    <div class="profile-ud-label text-soft">Last Updated</div>
                                    <div class="profile-ud-value">{{ $coupon->updated_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        </div><!-- .row -->
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .nk-block -->

            @if ($coupon->applicability_type === 'products' && $coupon->applicableProducts->count() > 0)
                <div class="nk-block mt-5">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h5 class="card-title">Applicable Products</h5>
                            <div class="row g-gs mt-3">
                                @foreach ($coupon->applicableProducts as $product)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="product-card card h-100">
                                            <div class="product-thumb">
                                                @if ($product->thumbnail)
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                        class="card-img-top product-image" alt="{{ $product->title }}">
                                                @else
                                                    <div class="placeholder-image">
                                                        <em class="icon ni ni-img"></em>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-inner p-2">
                                                <h6 class="product-title">{{ $product->title }}</h6>
                                                <div class="product-price text-primary">
                                                    <span>{{ config('app.currency_symbol') }}{{ number_format($product->price_regular, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="nk-block-head nk-block-head-sm mt-4">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <a href="{{ route('seller.coupons.index') }}" class="btn btn-outline-secondary">
                            <em class="icon ni ni-arrow-left"></em><span>Back to Coupons List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Coupon Modal --}}
    <div class="modal fade" id="editCouponModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Coupon</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seller.coupons.update', $coupon->id) }}" method="POST" id="editCouponForm"
                        class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-coupon-id">
                        <input type="hidden" name="redirect_to" value="show"> {{-- Hidden field to track origin --}}
                        <input type="hidden" name="category_id" value="">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-coupon-code">Coupon Code</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control @error('code', 'update') is-invalid @enderror"
                                            id="edit-coupon-code" name="code"
                                            value="{{ old('code', $coupon->code) }}" required>
                                    </div>
                                    @error('code', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-discount-type">Discount Type</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('type', 'update') is-invalid @enderror"
                                            id="edit-discount-type" name="type" required>
                                            <option value="percentage"
                                                {{ old('type', $coupon->type->value) == 'percentage' ? 'selected' : '' }}>
                                                Percentage</option>
                                            <option value="fixed"
                                                {{ old('type', $coupon->type->value) == 'fixed' ? 'selected' : '' }}>Fixed
                                                Amount</option>
                                        </select>
                                    </div>
                                    @error('type', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-discount-amount">Discount Amount</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right" id="edit-discount-icon">
                                            <span id="edit-discount-symbol">%</span>
                                        </div>
                                        <input type="number"
                                            class="form-control @error('amount', 'update') is-invalid @enderror"
                                            id="edit-discount-amount" name="amount"
                                            value="{{ old('amount', $coupon->amount) }}" step="0.01" min="0"
                                            required>
                                    </div>
                                    <div class="form-note"></div> {{-- Note will be updated by JS --}}
                                    @error('amount', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-usage-limit">Usage Limit (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('usage_limit', 'update') is-invalid @enderror"
                                            id="edit-usage-limit" name="usage_limit"
                                            value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}" min="1">
                                    </div>
                                    @error('usage_limit', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-start-date">Start Date</label>
                                    <div class="form-control-wrap">
                                        <input type="date"
                                            class="form-control date-picker @error('start_date', 'update') is-invalid @enderror"
                                            id="edit-start-date" name="start_date"
                                            value="{{ old('start_date', $coupon->start_date ? $coupon->start_date->format('Y-m-d') : '') }}"
                                            required>
                                    </div>
                                    @error('start_date', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-end-date">End Date</label>
                                    <div class="form-control-wrap">
                                        <input type="date"
                                            class="form-control date-picker @error('end_date', 'update') is-invalid @enderror"
                                            id="edit-end-date" name="end_date"
                                            value="{{ old('end_date', $coupon->end_date ? $coupon->end_date->format('Y-m-d') : '') }}"
                                            required>
                                    </div>
                                    @error('end_date', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-min-purchase">Minimum Purchase (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('min_purchase', 'update') is-invalid @enderror"
                                            id="edit-min-purchase" name="min_purchase"
                                            value="{{ old('min_purchase', $coupon->min_purchase ?? '') }}" step="0.01"
                                            min="0">
                                    </div>
                                    @error('min_purchase', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-coupon-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('is_active', 'update') is-invalid @enderror"
                                            id="edit-coupon-status" name="is_active">
                                            <option value="1"
                                                {{ old('is_active', $coupon->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0"
                                                {{ old('is_active', $coupon->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                    @error('is_active', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-applicability-type">Applicability Type</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('applicability_type', 'update') is-invalid @enderror"
                                            id="edit-applicability-type" name="applicability_type"
                                            data-placeholder="Select Applicability" required>
                                            <option value="all"
                                                {{ old('applicability_type', $coupon->applicability_type) == 'all' ? 'selected' : '' }}>
                                                All Products</option>
                                            <option value="category"
                                                {{ old('applicability_type', $coupon->applicability_type) == 'category' ? 'selected' : '' }}>
                                                Specific Category</option>
                                            <option value="products"
                                                {{ old('applicability_type', $coupon->applicability_type) == 'products' ? 'selected' : '' }}>
                                                Specific Products</option>
                                        </select>
                                    </div>
                                    @error('applicability_type', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12" id="edit-specific-categories-container" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="edit-specific-categories">Apply to Specific
                                        Categories</label>
                                    <div class="form-control-wrap">
                                        @php
                                            $defaultSelectedCategories =
                                                $coupon->applicability_type === 'category' &&
                                                $coupon->applicableCategories
                                                    ? $coupon->applicableCategories->pluck('id')->all()
                                                    : [];
                                            $selectedCategoriesArray = old(
                                                'specific_categories',
                                                $defaultSelectedCategories,
                                            );
                                        @endphp
                                        <select
                                            class="form-select js-select2 @error('specific_categories', 'update') is-invalid @enderror"
                                            id="edit-specific-categories" name="specific_categories[]" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, (array) $selectedCategoriesArray) ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('specific_categories', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('specific_categories.*', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror {{-- For array validation errors --}}
                                </div>
                            </div>
                            <div class="col-12" id="edit-specific-products-container" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="edit-specific-products">Apply to Specific
                                        Products</label>
                                    <div class="form-control-wrap">
                                        @php
                                            $defaultSelectedProducts =
                                                $coupon->applicability_type === 'products' &&
                                                $coupon->applicableProducts
                                                    ? $coupon->applicableProducts->pluck('id')->all()
                                                    : [];
                                            $selectedProductsArray = old('specific_products', $defaultSelectedProducts);
                                        @endphp
                                        <input type="hidden" id="edit-selected-products-input" name="specific_products"
                                            value="{{ is_array($selectedProductsArray) ? implode(',', $selectedProductsArray) : $selectedProductsArray }}">

                                        <div class="row g-3 product-selector">
                                            @if (count($products) > 0)
                                                @foreach ($products as $product)
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <div class="product-item card h-100 {{ in_array($product->id, (array) $selectedProductsArray) ? 'selected' : '' }}"
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
                                                                        class="price">{{ config('app.currency_symbol') }}{{ number_format($product->price_regular, 2) }}</span>
                                                                </div>
                                                                <div class="product-select">
                                                                    <div
                                                                        class="custom-control custom-control-sm custom-checkbox mt-1">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input product-checkbox"
                                                                            id="product-{{ $product->id }}"
                                                                            {{ in_array($product->id, (array) $selectedProductsArray) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="product-{{ $product->id }}">Select</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        <p class="mb-0">You don't have any products yet. Please add
                                                            products to your store before creating product-specific coupons.
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @error('specific_products', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-coupon-description">Description (Optional)</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control @error('description', 'update') is-invalid @enderror" id="edit-coupon-description"
                                            name="description">{{ old('description', $coupon->description) }}</textarea>
                                    </div>
                                    @error('description', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                        id="updateCouponBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Update Coupon</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the coupon.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Coupon Confirmation Modal --}}
    <div class="modal fade" id="deleteCouponModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Coupon</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the coupon <strong id="delete-coupon-code"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                    <form action="" method="POST" id="deleteCouponForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteCouponBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Auto-open modal if there are 'update' errors
            @if ($errors->update->any())
                $('#editCouponModal').modal('show');
                // Ensure the form action is set correctly
                $('#editCouponForm').attr('action', '{{ route('seller.coupons.update', $coupon->id) }}');
            @endif

            // Initialize Select2 for modals if needed
            if ($.fn.select2) {
                $('#editCouponModal .js-select2').each(function() {
                    $(this).select2({
                        dropdownParent: $('#editCouponModal'),
                        minimumResultsForSearch: $(this).data('disable-search') ? -1 : 0
                    });
                });
            }

            // Initialize Select2 for applicability type and category selectors
            if ($.fn.select2) {
                $('#edit-applicability-type').select2({
                    dropdownParent: $('#editCouponModal'),
                    placeholder: "Select Applicability Type",
                    minimumResultsForSearch: -1
                });

                $('#edit-category-id').select2({
                    dropdownParent: $('#editCouponModal'),
                    placeholder: "Select Category"
                });

                if ($('#edit-specific-categories').length && !$('#edit-specific-categories').data('select2')) {
                    $('#edit-specific-categories').select2({
                        dropdownParent: $('#editCouponModal'),
                        placeholder: 'Select categories',
                        allowClear: true
                    });
                }
            }

            $('#editCouponModal').on('shown.bs.modal', function() {
                // Ensure all Select2 components in the modal are initialized
                $(this).find('.js-select2').each(function() {
                    if (!$(this).data('select2')) {
                        var dropdownParent = $(this).closest('.modal');
                        $(this).select2({
                            dropdownParent: dropdownParent.length ? dropdownParent : $(
                                'body'),
                            placeholder: $(this).data('placeholder')
                        });
                    }
                });

                // Set initial state of fields based on applicability type
                var currentApplicabilityType = $('#edit-applicability-type').val();
                toggleApplicabilityFields('edit', currentApplicabilityType);

                // If modal is shown automatically due to validation errors, make sure
                // category container is visible if applicability type is 'category'
                if (currentApplicabilityType === 'category') {
                    $('#edit-specific-categories-container').show();
                    $('#edit-category-id').prop('required', true);
                }
            });

            // Function to update symbol and related fields based on type (for edit modal)
            function updateEditDiscountFields(selectedType) {
                const amountField = $('#edit-discount-amount');
                const amountNote = amountField.closest('.form-group').find('.form-note');
                const discountSymbol = $('#edit-discount-symbol');

                if (selectedType === 'percentage') {
                    discountSymbol.text('%');
                    amountField.attr('max', 100);
                    amountNote.text('For percentage, enter value between 1-100.');
                } else {
                    discountSymbol.text('{{ config('app.currency_symbol', 'DJF') }}'); // Use config symbol
                    amountField.removeAttr('max');
                    amountNote.text('Enter fixed discount amount.');
                }
            }

            // Edit Coupon Modal - Populate and Handle
            $(document).on('click', '.edit-coupon-button', function() {
                var $btn = $(this);
                var id = $btn.data('id');
                var code = $btn.data('code');
                var type = $btn.data('type');
                var amount = $btn.data('amount');
                var minPurchase = $btn.data('min-purchase');
                var startDate = $btn.data('start-date');
                var endDate = $btn.data('end-date');
                var usageLimit = $btn.data('usage-limit');
                var isActive = $btn.data('is-active');
                var description = $btn.data('description');
                var applicabilityType = $btn.data('applicability-type');
                var categoryId = $btn.data('category-id');
                var applicableProducts = $btn.data('applicable-products') ? $btn.data('applicable-products')
                    .toString().split(',') : [];
                var applicableCategories = $btn.data('applicable-categories') ? $btn.data(
                        'applicable-categories')
                    .toString().split(',') : [];

                // Set form action
                $('#editCouponForm').attr('action', $btn.data('update-url'));

                // Populate form fields
                $('#edit-coupon-id').val(id);
                $('#edit-coupon-code').val(code);
                $('#edit-discount-type').val(type).trigger('change.select2'); // Trigger select2 change
                $('#edit-discount-amount').val(amount);
                $('#edit-min-purchase').val(minPurchase);
                $('#edit-start-date').val(startDate);
                $('#edit-end-date').val(endDate);
                $('#edit-usage-limit').val(usageLimit);
                $('#edit-coupon-status').val(isActive ? '1' : '0').trigger('change.select2');
                $('#edit-coupon-description').val(description);
                $('#edit-applicability-type').val(applicabilityType).trigger('change.select2');

                // Handle category selection
                if (applicabilityType === 'category' && applicableCategories.length > 0) {
                    $('#edit-specific-categories').val(applicableCategories).trigger('change.select2');
                    // Call our new function to ensure hidden inputs are created
                    updateSpecificCategoriesInput();
                }

                // Set selected products
                if (applicabilityType === 'products') {
                    // Reset all checkboxes
                    $('.product-checkbox').prop('checked', false);
                    $('.product-item').removeClass('selected');

                    // Check the appropriate checkboxes
                    applicableProducts.forEach(function(productId) {
                        $('#product-' + productId).prop('checked', true).trigger('change');
                    });

                    // Update hidden input
                    $('#edit-selected-products-input').val(applicableProducts.join(','));
                }

                // Handle applicability type specific fields visibility and pre-selection
                toggleApplicabilityFields('edit', applicabilityType);

                // Update discount fields based on the initial type
                updateEditDiscountFields(type);
            });

            // Handle discount type change in the edit modal (using Select2 event)
            $('#edit-discount-type').on('select2:select', function(e) {
                var data = e.params.data;
                var selectedType = data.id; // 'percentage' or 'fixed'
                updateEditDiscountFields(selectedType);
            });

            // Function to toggle applicability fields based on selected type
            function toggleApplicabilityFields(prefix, type) {
                const categoriesContainer = $('#' + prefix + '-specific-categories-container');
                const productsContainer = $('#' + prefix + '-specific-products-container');
                const categorySelectContainer = $('#' + prefix + '-category-select-container');

                categoriesContainer.hide();
                productsContainer.hide();
                categorySelectContainer.hide();

                if (type === 'category') {
                    categoriesContainer.show();
                    $('#' + prefix + '-category-id').prop('required', false);
                } else if (type === 'products') {
                    productsContainer.show();
                    $('#' + prefix + '-category-id').prop('required', false);
                } else {
                    $('#' + prefix + '-category-id').prop('required', false);
                }
            }

            // Handle applicability type change in the edit modal
            $('#edit-applicability-type').on('select2:select', function(e) {
                var selectedApplicability = e.params.data.id;
                toggleApplicabilityFields('edit', selectedApplicability);
            });

            // Add a function to ensure specific categories are submitted properly
            function updateSpecificCategoriesInput() {
                var selectedCategories = $('#edit-specific-categories').val() || [];

                // Remove any existing hidden inputs
                $('.specific-categories-hidden-input').remove();

                // Add a hidden input for each selected category
                if (selectedCategories.length > 0) {
                    // Use a Set to ensure unique values
                    var uniqueCategories = [...new Set(selectedCategories)];
                    uniqueCategories.forEach(function(categoryId) {
                        $('#editCouponForm').append(
                            '<input type="hidden" class="specific-categories-hidden-input" name="specific_categories[]" value="' +
                            categoryId + '">'
                        );
                    });
                }
            }

            // Update hidden inputs when categories are selected
            $('#edit-specific-categories').on('change', function() {
                updateSpecificCategoriesInput();
            });

            // Also update when form is submitted
            $('#editCouponForm').on('submit', function() {
                updateSpecificCategoriesInput();
            });

            // Edit Coupon Form Submission
            $('#editCouponForm').on('submit', function() {
                var $submitBtn = $('#updateCouponBtn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');

                // Debug - Log the form data
                console.log("Form applicability type:", $('#edit-applicability-type').val());
                console.log("Selected categories:", $('#edit-specific-categories').val());

                return true; // Allow submission
            });

            // Handle product selection
            $(document).on('click', '.product-item', function(e) {
                // Don't trigger if clicking directly on the checkbox
                if (!$(e.target).is('input[type="checkbox"]') && !$(e.target).is('label')) {
                    const checkbox = $(this).find('input[type="checkbox"]');
                    checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
                }
            });

            // Handle product checkbox change
            $(document).on('change', '.product-checkbox', function() {
                const card = $(this).closest('.product-item');
                if ($(this).is(':checked')) {
                    card.addClass('selected');
                } else {
                    card.removeClass('selected');
                }

                // Update the hidden input with selected product IDs
                updateSelectedProductsInput();
            });

            // Function to update the hidden input with selected product IDs
            function updateSelectedProductsInput() {
                const selectedProductIds = [];
                $('.product-checkbox:checked').each(function() {
                    const productId = $(this).attr('id').replace('product-', '');
                    selectedProductIds.push(productId);
                });
                $('#edit-selected-products-input').val(selectedProductIds.join(','));
            }

            // Delete Coupon Modal - Populate and Handle
            $(document).on('click', '.delete-coupon-button', function() {
                var code = $(this).data('code');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-coupon-code').text(code);
                $('#deleteCouponForm').attr('action', deleteUrl);
            });

            // Delete Coupon Confirmation
            $('#confirmDeleteCouponBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteCouponForm').submit();
            });

        });
    </script>
@endsection

@section('css')
    <style>
        /* Add any specific styles for the coupon show page here */
        .profile-ud-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #dbdfea;
            width: 100% !important;
        }

        .profile-ud-item:last-child {
            border-bottom: none;
        }

        .profile-ud-label {
            margin-bottom: 0.25rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .profile-ud-value {
            font-size: 1rem;
        }

        /* Product selector styles */
        .product-selector {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .product-item {
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #dbdfea;
        }

        .product-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-item.selected {
            border: 2px solid #6576ff;
            background-color: rgba(101, 118, 255, 0.05);
        }

        /* Product card styles for display */
        .product-card {
            transition: all 0.2s ease;
            border: 1px solid #dbdfea;
        }

        .product-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
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
            max-height: 120px;
            object-fit: contain;
        }

        .placeholder-image {
            width: 100%;
            height: 120px;
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
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
