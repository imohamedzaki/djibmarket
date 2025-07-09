@extends('layouts.app.seller')

@section('title', 'Manage Coupons')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Coupons</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Coupons</li>
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
                                        @if (Auth::guard('seller')->user()->status === 'pending')
                                            <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Coupon creation is only available when your seller application has been accepted">
                                                <button class="btn btn-primary" disabled>
                                                    <em class="icon ni ni-lock"></em><span>Add Coupon (Locked)</span>
                                                </button>
                                            </span>
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addCouponModal">
                                                <em class="icon ni ni-plus"></em><span>Add Coupon</span>
                                            </button>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Pending Status Alert --}}
            @include('includes.seller-pending-alert')

            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Coupons</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage coupons.</p>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table
                            class="datatable-init nk-tb-list nk-tb-ulist @if (count($coupons) == 0) no-datatable @endif"
                            data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text">Coupon Code</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Discount</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Validity</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Usage Limit</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($coupons as $coupon)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <span class="tb-lead">{{ $coupon->code }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $coupon->type->value == 'percentage' ? $coupon->amount . '%' : config('app.currency_symbol') . $coupon->amount }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $coupon->start_date->format('d M Y') }} -
                                                {{ $coupon->end_date->format('d M Y') }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $coupon->usage_limit ?? 'Unlimited' }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($coupon->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('seller.coupons.show', $coupon->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="View Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-coupon-button"
                                                        data-bs-toggle="modal" data-bs-target="#editCouponModal"
                                                        data-id="{{ $coupon->id }}" data-code="{{ $coupon->code }}"
                                                        data-type="{{ $coupon->type->value }}"
                                                        data-amount="{{ $coupon->amount }}"
                                                        data-min-purchase="{{ $coupon->min_purchase }}"
                                                        data-start-date="{{ $coupon->start_date->format('Y-m-d') }}"
                                                        data-end-date="{{ $coupon->end_date->format('Y-m-d') }}"
                                                        data-usage-limit="{{ $coupon->usage_limit }}"
                                                        data-is-active="{{ $coupon->is_active }}"
                                                        data-description="{{ $coupon->description }}"
                                                        data-applicability-type="{{ $coupon->applicability_type }}"
                                                        data-category-id="{{ $coupon->applicability_type === 'category' ? optional($coupon->applicableCategories->first())->id : '' }}"
                                                        data-applicable-products="{{ $coupon->applicability_type === 'products' && $coupon->applicableProducts->count() ? $coupon->applicableProducts->pluck('id')->implode(',') : '' }}"
                                                        data-applicable-categories="{{ $coupon->applicability_type === 'category' && $coupon->applicableCategories->count() ? $coupon->applicableCategories->pluck('id')->implode(',') : '' }}"
                                                        data-update-url="{{ route('seller.coupons.update', $coupon->id) }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-coupon-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCouponModal"
                                                        data-coupon-id="{{ $coupon->id }}"
                                                        data-coupon-code="{{ $coupon->code }}"
                                                        data-delete-url="{{ route('seller.coupons.destroy', $coupon->id) }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a
                                                                        href="{{ route('seller.coupons.show', $coupon->slug) }}"><em
                                                                            class="icon ni ni-eye"></em><span>View
                                                                            Details</span></a></li>
                                                                <li>
                                                                    <button type="button"
                                                                        class="dropdown-item edit-coupon-button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editCouponModal"
                                                                        data-id="{{ $coupon->id }}"
                                                                        data-code="{{ $coupon->code }}"
                                                                        data-type="{{ $coupon->type->value }}"
                                                                        data-amount="{{ $coupon->amount }}"
                                                                        data-min-purchase="{{ $coupon->min_purchase }}"
                                                                        data-start-date="{{ $coupon->start_date->format('Y-m-d') }}"
                                                                        data-end-date="{{ $coupon->end_date->format('Y-m-d') }}"
                                                                        data-usage-limit="{{ $coupon->usage_limit }}"
                                                                        data-is-active="{{ $coupon->is_active }}"
                                                                        data-description="{{ $coupon->description }}"
                                                                        data-applicability-type="{{ $coupon->applicability_type }}"
                                                                        data-category-id="{{ $coupon->applicability_type === 'category' ? optional($coupon->applicableCategories->first())->id : '' }}"
                                                                        data-applicable-products="{{ $coupon->applicability_type === 'products' && $coupon->applicableProducts->count() ? $coupon->applicableProducts->pluck('id')->implode(',') : '' }}"
                                                                        data-applicable-categories="{{ $coupon->applicability_type === 'category' && $coupon->applicableCategories->count() ? $coupon->applicableCategories->pluck('id')->implode(',') : '' }}"
                                                                        data-update-url="{{ route('seller.coupons.update', $coupon->id) }}">
                                                                        <em class="icon ni ni-edit"></em><span>Edit</span>
                                                                    </button>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <button type="button"
                                                                        class="dropdown-item delete-coupon-button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteCouponModal"
                                                                        data-coupon-id="{{ $coupon->id }}"
                                                                        data-coupon-code="{{ $coupon->code }}"
                                                                        data-delete-url="{{ route('seller.coupons.destroy', $coupon->id) }}">
                                                                        <em
                                                                            class="icon ni ni-trash"></em><span>Delete</span>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item -->
                                @empty
                                    <!-- Empty state handled in tfoot -->
                                @endforelse
                            </tbody>
                            @if ($coupons->count() == 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-center p-4">
                                            <div class="py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-ticket"
                                                        style="font-size: 3rem; color: #c4c4c4;"></em>
                                                </div>
                                                <h6 class="text-muted">No coupons found</h6>
                                                <p class="text-muted small">Start by adding your first coupon using the
                                                    "Add Coupon" button above.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div><!-- .card-preview -->

                <!-- Pagination Links -->
                <div class="mt-3">
                    {{ $coupons->links() }}
                </div>
            </div><!-- .nk-block -->
        </div>
    </div>

    <!-- Add Coupon Modal -->
    <div class="modal fade" id="addCouponModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Coupon</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('seller.coupons.store') }}" method="POST" class="form-validate is-alter"
                        id="addCouponForm">
                        @csrf
                        <input type="hidden" name="category_id" value="">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="coupon-code">Coupon Code</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            id="coupon-code" name="code" value="{{ old('code') }}" required>
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-discount-type">Discount Type</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2 @error('type') is-invalid @enderror"
                                            id="add-discount-type" name="type" data-placeholder="Select discount type"
                                            required>
                                            <option value=""></option>
                                            <option value="percentage" @selected(old('type') == 'percentage')>Percentage</option>
                                            <option value="fixed" @selected(old('type') == 'fixed')>Fixed Amount</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-discount-amount">Discount Amount</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right" id="add-discount-icon">
                                            <span id="add-discount-symbol">%</span>
                                        </div>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                            id="add-discount-amount" name="amount" value="{{ old('amount') }}"
                                            step="0.01" min="0" required>
                                    </div>
                                    <div class="form-note">For percentage, enter value between 1-100.</div>
                                    @error('amount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-usage-limit">Usage Limit (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('usage_limit') is-invalid @enderror"
                                            id="add-usage-limit" name="usage_limit" value="{{ old('usage_limit') }}"
                                            min="1">
                                    </div>
                                    @error('usage_limit')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-start-date">Start Date</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text"
                                            class="form-control date-picker @error('start_date') is-invalid @enderror"
                                            id="add-start-date" name="start_date" value="{{ old('start_date') }}"
                                            required placeholder="yyyy-mm-dd">
                                    </div>
                                    @error('start_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-end-date">End Date</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text"
                                            class="form-control date-picker @error('end_date') is-invalid @enderror"
                                            id="add-end-date" name="end_date" value="{{ old('end_date') }}" required
                                            placeholder="yyyy-mm-dd">
                                    </div>
                                    @error('end_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-min-purchase">Minimum Purchase (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('min_purchase') is-invalid @enderror"
                                            id="add-min-purchase" name="min_purchase" value="{{ old('min_purchase') }}"
                                            step="0.01" min="0">
                                    </div>
                                    @error('min_purchase')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-coupon-status">Status</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="add_is_active"
                                                name="is_active" value="1"
                                                {{ old('is_active', 1) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="add_is_active">Active</label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="add-applicability-type">Applicability Type</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('applicability_type') is-invalid @enderror"
                                            id="add-applicability-type" name="applicability_type"
                                            data-placeholder="Select Applicability" required>
                                            <option value=""></option>
                                            <option value="all" @selected(old('applicability_type') == 'all')>All Products</option>
                                            <option value="category" @selected(old('applicability_type') == 'category')>Specific Category
                                            </option>
                                            <option value="products" @selected(old('applicability_type') == 'products')>Specific Products
                                            </option>
                                        </select>
                                    </div>
                                    @error('applicability_type')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6" id="add-category-select-container" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="add-category-id">Select Category</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2 @error('category_id') is-invalid @enderror"
                                            id="add-category-id" name="category_id" data-placeholder="Select a category">
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12" id="add-specific-categories-container" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="add-specific-categories">Apply to Specific
                                        Categories</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('specific_categories', 'store') is-invalid @enderror"
                                            id="add-specific-categories" name="specific_categories[]" multiple
                                            data-placeholder="Select categories">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, (array) old('specific_categories', [])) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('specific_categories', 'store')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('specific_categories.*', 'store')
                                        {{-- For array validation errors --}}
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12" id="add-specific-products-container" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Apply to Specific Products</label>
                                    <div class="form-control-wrap product-selector-add">
                                        <input type="hidden" id="add-selected-products-input" name="specific_products"
                                            value="{{ old('specific_products') }}">
                                        <div class="row g-3 product-selector">
                                            @if ($products->count() > 0)
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
                                                                    <div class="placeholder-image"><em
                                                                            class="icon ni ni-img"></em></div>
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
                                                                            class="custom-control-input product-checkbox-add"
                                                                            id="add-product-{{ $product->id }}">
                                                                        <label class="custom-control-label"
                                                                            for="add-product-{{ $product->id }}">Select</label>
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
                                                            products to your store.</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @error('specific_products', 'store')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="coupon-description">Description (Optional)</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="coupon-description"
                                            name="description">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn" id="addCouponBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Save Coupon</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Enter the details for the new coupon.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Coupon Modal (Copied from show.blade.php) -->
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
                    <form action="" method="POST" id="editCouponForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-coupon-id">
                        <input type="hidden" name="redirect_to" value="index">
                        <input type="hidden" name="category_id" value="">

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-coupon-code">Coupon Code</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control @error('code', 'update') is-invalid @enderror"
                                            id="edit-coupon-code" name="code" value="" required>
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
                                            <option value="percentage">Percentage</option>
                                            <option value="fixed">Fixed Amount</option>
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
                                            id="edit-discount-amount" name="amount" value="" step="0.01"
                                            min="0" required>
                                    </div>
                                    <div class="form-note"></div>
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
                                            id="edit-usage-limit" name="usage_limit" value="" min="1">
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
                                            id="edit-start-date" name="start_date" value="" required>
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
                                            id="edit-end-date" name="end_date" value="" required>
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
                                            id="edit-min-purchase" name="min_purchase" value="" step="0.01"
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
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
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
                                            <option value="all"> All Products</option>
                                            <option value="category">Specific Category</option>
                                            <option value="products">Specific Products</option>
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
                                        <select
                                            class="form-select js-select2 @error('specific_categories', 'update') is-invalid @enderror @error('specific_categories.*', 'update') is-invalid @enderror"
                                            id="edit-specific-categories" name="specific_categories[]" multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('specific_categories', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('specific_categories.*', 'update')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12" id="edit-specific-products-container" style="display: none;">
                                <div class="form-group">
                                    <label class="form-label" for="edit-specific-products">Apply to Specific
                                        Products</label>
                                    <div class="form-control-wrap">
                                        <input type="hidden" id="edit-selected-products-input" name="specific_products"
                                            value="">
                                        <div class="row g-3 product-selector product-selector-edit">
                                            @if ($products->count() > 0)
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
                                                                    <div class="placeholder-image"><em
                                                                            class="icon ni ni-img"></em></div>
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
                                                                            class="custom-control-input product-checkbox-edit"
                                                                            id="edit-product-{{ $product->id }}">
                                                                        <label class="custom-control-label"
                                                                            for="edit-product-{{ $product->id }}">Select</label>
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
                                                            products.</p>
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
                                            name="description"></textarea>
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
                        <button type="button" class="btn btn-danger submit-btn" id="confirmCouponDeleteBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .dataTables_empty {
            padding: 1rem;
        }

        .no-products-message {
            display: block;
            font-size: 16px;
            padding: 20px 0;
            text-align: center;
        }

        /* Product selector styles (common for add and edit) */
        .product-selector {
            max-height: 300px;
            /* Adjust as needed */
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
            /* NioDash primary color */
            background-color: rgba(101, 118, 255, 0.05);
        }

        .product-thumb {
            height: 100px;
            /* Adjust as needed */
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

@section('js')
    <script>
        $(document).ready(function() {
            // ----- Common JS for Modals -----
            function initializeModalSelect2(modalId) {
                $(modalId + ' .js-select2').each(function() {
                    if (!$(this).data('select2')) {
                        $(this).select2({
                            dropdownParent: $(modalId),
                            placeholder: $(this).data('placeholder'),
                            minimumResultsForSearch: $(this).attr('id') ===
                                'edit-applicability-type' || $(this).attr('id') ===
                                'add-applicability-type' ? -1 : 0,
                            allowClear: $(this).attr('id') === 'edit-specific-categories' || $(this)
                                .attr('id') === 'add-specific-categories'
                        });
                    }
                });
            }

            function initializeModalDatePickers(modalId) {
                $(modalId + ' .date-picker').each(function() {
                    if (!$(this).data('datepicker')) {
                        $(this).datepicker({
                            format: 'yyyy-mm-dd',
                            autoclose: true,
                            todayHighlight: true,
                            orientation: 'bottom auto'
                        });
                    }
                });
            }

            // ----- ADD Coupon Modal JS -----
            initializeModalSelect2('#addCouponModal');
            initializeModalDatePickers('#addCouponModal');

            $('#add-discount-type').on('select2:select', function(e) {
                var type = e.params.data.id;
                const amountField = $('#add-discount-amount');
                const amountNote = amountField.closest('.form-group').find('.form-note');
                if (type === 'percentage') {
                    $('#add-discount-symbol').text('%');
                    amountField.attr('max', 100);
                    amountNote.text('For percentage, enter value between 1-100.');
                } else if (type === 'fixed') {
                    $('#add-discount-symbol').text('{{ config('app.currency_symbol', 'DJF') }}');
                    amountField.removeAttr('max');
                    amountNote.text('Enter fixed discount amount.');
                }
            }).trigger('change');

            $('#add-applicability-type').on('select2:select', function(e) {
                var applicabilityType = e.params.data.id;
                // const categoryContainer = $('#add-category-select-container'); // Keep for single select if used
                // const specificCategoriesContainer = $('#add-specific-categories-container');
                // const productsContainer = $('#add-specific-products-container');
                toggleApplicabilityFields('add', applicabilityType);
            }).trigger('change');

            $('#addCouponForm').on('submit', function(e) {
                updateSpecificCategoriesInput('add');
                updateSelectedProductsInput('add');
                if (this.checkValidity()) {
                    var $submitBtn = $('#addCouponBtn');
                    $submitBtn.prop('disabled', true);
                    $submitBtn.find('.spinner').removeClass('d-none');
                    $submitBtn.find('.btn-text').text('Saving...');
                }
                return true;
            });

            // Product Selector for ADD modal
            $(document).on('click', '.product-selector-add .product-item', function(e) {
                if (!$(e.target).is('input[type="checkbox"]') && !$(e.target).is('label')) {
                    const checkbox = $(this).find('.product-checkbox-add');
                    checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
                }
            });

            $(document).on('change', '.product-checkbox-add', function() {
                const card = $(this).closest('.product-item');
                if ($(this).is(':checked')) {
                    card.addClass('selected');
                } else {
                    card.removeClass('selected');
                }
                updateSelectedProductsInput('add');
            });

            $('#add-specific-categories').on('change', function() {
                updateSpecificCategoriesInput('add');
            });

            // ----- EDIT Coupon Modal JS (Copied and Adapted) -----
            // Auto-open modal if there are 'update' errors and the edited_coupon_id session exists
            @if (session('edited_coupon_id') && $errors->update->any())
                var couponIdToEdit = {{ session('edited_coupon_id') }};
                // Find the button in the table corresponding to this ID and click it to open modal & populate
                $('.edit-coupon-button[data-id="' + couponIdToEdit + '"]').first().click();
                // Clear the session variable after attempting to open modal
                @php session()->forget('edited_coupon_id'); @endphp
            @endif

            // Initialize Select2 & Datepickers for Edit Modal when it's shown
            $('#editCouponModal').on('shown.bs.modal', function() {
                $(this).find('.js-select2').each(function() {
                    if (!$(this).data('select2')) { // Initialize if not already
                        $(this).select2({
                            dropdownParent: $('#editCouponModal'),
                            placeholder: $(this).data('placeholder'),
                            minimumResultsForSearch: $(this).attr('id') ===
                                'edit-applicability-type' ? -1 :
                                0, // Example: disable search for some
                            allowClear: $(this).attr('id') ===
                                'edit-specific-categories' // Example: allow clear for multi-select
                        });
                    }
                });
                $(this).find('.date-picker').each(function() {
                    if (!$(this).data('datepicker')) { // Initialize if not already
                        $(this).datepicker({
                            format: 'yyyy-mm-dd',
                            autoclose: true,
                            todayHighlight: true,
                            orientation: 'bottom auto'
                        });
                    }
                });
                // After populating, ensure correct fields are visible
                var currentApplicabilityType = $('#edit-applicability-type').val();
                toggleApplicabilityFields('edit', currentApplicabilityType,
                    true); // Pass true for isInitialLoad if applicable
            });

            function updateEditDiscountFields(selectedType) {
                const amountField = $('#edit-discount-amount');
                const amountNote = amountField.closest('.form-group').find('.form-note');
                const discountSymbol = $('#edit-discount-symbol');
                if (selectedType === 'percentage') {
                    discountSymbol.text('%');
                    amountField.attr('max', 100);
                    amountNote.text('For percentage, enter value between 1-100.');
                } else {
                    discountSymbol.text('{{ config('app.currency_symbol', 'DJF') }}');
                    amountField.removeAttr('max');
                    amountNote.text('Enter fixed discount amount.');
                }
            }

            $(document).on('click', '.edit-coupon-button', function() {
                var $btn = $(this);
                var id = $btn.data('id');
                // Construct the form action URL dynamically
                var formAction = "{{ url('seller/coupons') }}/" + id;
                $('#editCouponForm').attr('action', formAction);

                // Populate form fields from data attributes
                $('#edit-coupon-id').val(id);
                $('#edit-coupon-code').val($btn.data('code'));
                $('#edit-discount-type').val($btn.data('type')).trigger('change.select2');
                $('#edit-discount-amount').val($btn.data('amount'));
                $('#edit-min-purchase').val($btn.data('min-purchase'));
                $('#edit-start-date').val($btn.data('start-date')).trigger(
                    'change'); // Trigger change for datepicker if needed
                $('#edit-end-date').val($btn.data('end-date')).trigger(
                    'change'); // Trigger change for datepicker if needed
                $('#edit-usage-limit').val($btn.data('usage-limit'));
                $('#edit-coupon-status').val($btn.data('is-active') ? '1' : '0').trigger('change.select2');
                $('#edit-coupon-description').val($btn.data('description'));
                $('#edit-applicability-type').val($btn.data('applicability-type')).trigger(
                    'change.select2');

                var applicabilityType = $btn.data('applicability-type');
                var applicableCategoriesData = $btn.data('applicable-categories');
                var applicableCategories = applicableCategoriesData ? String(applicableCategoriesData)
                    .split(',') : [];

                var applicableProductsData = $btn.data('applicable-products');
                var applicableProducts = applicableProductsData ? String(applicableProductsData).split(
                    ',') : [];

                // Reset and set selected categories for EDIT modal
                $('#edit-specific-categories').val(null).trigger(
                    'change.select2'); // Clear previous selections
                if (applicabilityType === 'category' && applicableCategories.length > 0) {
                    $('#edit-specific-categories').val(applicableCategories).trigger('change.select2');
                }
                updateSpecificCategoriesInput('edit'); // Create hidden inputs

                // Reset and set selected products for EDIT modal
                $('.product-checkbox-edit').prop('checked', false); // Uncheck all
                $('.product-selector-edit .product-item').removeClass('selected'); // Remove selected class
                if (applicabilityType === 'products' && applicableProducts.length > 0) {
                    applicableProducts.forEach(function(productId) {
                        $('#edit-product-' + productId).prop('checked', true).trigger('change');
                    });
                }
                updateSelectedProductsInput('edit'); // Update hidden input for products

                // Ensure fields are shown/hidden based on current applicability type after populating
                toggleApplicabilityFields('edit', applicabilityType, false); // isInitialLoad = false
                updateEditDiscountFields($btn.data('type'));
            });

            $('#edit-discount-type').on('select2:select', function(e) {
                var selectedType = e.params.data.id;
                updateEditDiscountFields(selectedType);
            });

            // Prefix can be 'add' or 'edit'
            function toggleApplicabilityFields(prefix, type, isInitialLoad = false) {
                const categoriesContainer = $('#' + prefix + '-specific-categories-container');
                const productsContainer = $('#' + prefix + '-specific-products-container');

                categoriesContainer.hide();
                productsContainer.hide();

                // Clear requirements only if not initial load or explicitly needed
                // $('#' + prefix + '-specific-categories').prop('required', false);

                if (type === 'category') {
                    categoriesContainer.show();
                    // if (!isInitialLoad) { // Or based on your form logic
                    //     $('#' + prefix + '-specific-categories').prop('required', true);
                    // }
                } else if (type === 'products') {
                    productsContainer.show();
                }
            }

            $('#edit-applicability-type').on('select2:select', function(e) {
                var selectedApplicability = e.params.data.id;
                toggleApplicabilityFields('edit', selectedApplicability);
            });

            // Function to create/update hidden inputs for specific_categories[]
            function updateSpecificCategoriesInput(prefix) {
                var formId = '#' + prefix + 'CouponForm';
                var selectId = '#' + prefix + '-specific-categories';
                var hiddenInputClass = prefix + '-specific-categories-hidden-input';

                var selectedCategories = $(selectId).val() || [];
                $('.' + hiddenInputClass).remove(); // Remove existing hidden inputs for this prefix

                if (selectedCategories.length > 0) {
                    var uniqueCategories = [...new Set(selectedCategories)];
                    uniqueCategories.forEach(function(categoryId) {
                        $(formId).append(
                            '<input type="hidden" class="' + hiddenInputClass +
                            '" name="specific_categories[]" value="' + categoryId + '">'
                        );
                    });
                }
            }

            $('#edit-specific-categories').on('change', function() {
                updateSpecificCategoriesInput('edit');
            });

            // Update hidden inputs on form submission for edit form
            $('#editCouponForm').on('submit', function() {
                updateSpecificCategoriesInput('edit');
                updateSelectedProductsInput('edit'); // Ensure products are also updated

                var $submitBtn = $('#updateCouponBtn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });

            // Product Selector for EDIT modal
            $(document).on('click', '.product-selector-edit .product-item', function(e) {
                if (!$(e.target).is('input[type="checkbox"]') && !$(e.target).is('label')) {
                    const checkbox = $(this).find('.product-checkbox-edit');
                    checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
                }
            });

            $(document).on('change', '.product-checkbox-edit', function() {
                const card = $(this).closest('.product-item');
                if ($(this).is(':checked')) {
                    card.addClass('selected');
                } else {
                    card.removeClass('selected');
                }
                updateSelectedProductsInput('edit');
            });

            // Common function to update selected products hidden input, now parameterized by prefix
            function updateSelectedProductsInput(prefix) {
                const selectedProductIds = [];
                $('.product-checkbox-' + prefix + ':checked').each(function() {
                    // Ensure ID attribute is like 'add-product-123' or 'edit-product-123'
                    const productId = $(this).attr('id').replace(prefix + '-product-', '');
                    selectedProductIds.push(productId);
                });
                $('#' + prefix + '-selected-products-input').val(selectedProductIds.join(','));
            }

            // Common: Validate end date is after start date for both modals
            $('#add-start-date, #add-end-date, #edit-start-date, #edit-end-date').on('change blur', function() {
                var modalPrefix = $(this).attr('id').startsWith('add-') ? 'add' : 'edit';
                var startDateVal = $('#' + modalPrefix + '-start-date').val();
                var endDateVal = $('#' + modalPrefix + '-end-date').val();
                if (startDateVal && endDateVal) {
                    var startDate = new Date(startDateVal);
                    var endDate = new Date(endDateVal);
                    if (endDate < startDate) {
                        alert('End date must be on or after start date.');
                        $('#' + modalPrefix + '-end-date').val('').focus();
                    }
                }
            });
        });
    </script>
@endsection
