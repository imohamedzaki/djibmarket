@extends('layouts.app.seller')
@section('title', 'List of Products')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Products</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Products</li>
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
                                                title="Product creation is only available when your seller application has been accepted">
                                                <button class="btn btn-primary" disabled>
                                                    <em class="icon ni ni-lock"></em><span>Add Product (Locked)</span>
                                                </button>
                                            </span>
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addProductModal">
                                                <em class="icon ni ni-plus"></em><span>Add Product</span>
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

            {{-- Session Success/Error Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />

            {{-- Validation Error Summary --}}
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Products</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage products.</p>
                            @if ($products->total() > 0)
                                <p class="text-muted small">
                                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }}
                                    of {{ $products->total() }} products
                                    @if ($products->hasPages())
                                        (Page {{ $products->currentPage() }} of {{ $products->lastPage() }})
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        @if ($products->total() > 0)
                            <!-- Search and Filter Controls -->
                            <div class="search-filter-controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Show entries:</label>
                                            <select class="form-select" id="entries-per-page"
                                                style="width: auto; display: inline-block;">
                                                <option value="10"
                                                    {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25
                                                </option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                                </option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>
                                                    100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Search products:</label>
                                            <input type="text" class="form-control" id="search-products"
                                                placeholder="Search by name or SKU..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <table id="products-table" class="nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">SKU</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Price</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Stock</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Category</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($products as $product)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input product-checkbox"
                                                    id="product-{{ $product->id }}" value="{{ $product->id }}">
                                                <label class="custom-control-label"
                                                    for="product-{{ $product->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    @if ($product->thumbnail)
                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                            alt="{{ $product->title }}">
                                                    @else
                                                        <span>{{ strtoupper(substr($product->title, 0, 2)) }}</span>
                                                    @endif
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $product->title }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $product->sku ?? 'N/A' }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span
                                                class="tb-amount {{ $product->price_discounted ? 'text-decoration-line-through' : '' }}">
                                                {{ number_format($product->price_regular, 2) }}
                                            </span>
                                            @if ($product->price_discounted)
                                                <br><span
                                                    class="tb-amount text-success">{{ number_format($product->price_discounted, 2) }}</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $product->stock_quantity }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span
                                                class="tb-status text-{{ $product->status->color() }}">{{ $product->status->label() }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($product->category)
                                                <span
                                                    class="badge badge-dot bg-primary">{{ $product->category->name }}</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Category</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('seller.products.show', $product->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-product-button"
                                                        data-bs-toggle="modal" data-bs-target="#editProductModal"
                                                        data-id="{{ $product->id }}" data-slug="{{ $product->slug }}"
                                                        data-title="{{ $product->title }}"
                                                        data-description="{{ $product->description }}"
                                                        data-price="{{ $product->price_regular }}"
                                                        data-price-discounted="{{ $product->price_discounted }}"
                                                        data-stock="{{ $product->stock_quantity }}"
                                                        data-status="{{ $product->status->value }}"
                                                        data-category-id="{{ $product->category_id }}"
                                                        data-has-image="{{ $product->thumbnail ? 'true' : 'false' }}"
                                                        data-image-url="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-product-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                                                        data-slug="{{ $product->slug }}"
                                                        data-name="{{ $product->title }}"
                                                        data-delete-url="{{ route('seller.products.destroy', $product->slug) }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @empty
                                    <!-- Empty state handled in tfoot -->
                                @endforelse
                            </tbody>
                            @if ($products->count() == 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="text-center p-4">
                                            <div class="py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-package"
                                                        style="font-size: 3rem; color: #c4c4c4;"></em>
                                                </div>
                                                <h6 class="text-muted">No products found</h6>
                                                <p class="text-muted small">Start by adding your first product using the
                                                    "Add Product" button above.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div><!-- .card-preview -->

                @if ($products->hasPages())
                    <!-- Enhanced Pagination -->
                    <div class="mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="pagination-info">
                                    <span class="text-muted">
                                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }}
                                        of {{ $products->total() }} results
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end justify-content-center">
                                    {{ $products->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div> <!-- nk-block -->
        </div>
    </div>

    {{-- Add Product Modal --}}
    <div class="modal fade" id="addProductModal">
        <div class="modal-dialog modal-lg" role="document"> {{-- Made modal larger --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- Form submits to the product store route --}}
                    <form action="{{ route('seller.products.store') }}" method="POST" class="form-validate is-alter"
                        id="addProductForm" enctype="multipart/form-data"> {{-- Added enctype --}}
                        @csrf
                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Product Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control @error('title', 'store') is-invalid @enderror"
                                            id="product-title" name="title" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="product-price">Regular Price</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('price_regular', 'store') is-invalid @enderror"
                                            id="product-price" name="price_regular" value="{{ old('price_regular') }}"
                                            required step="0.01" min="10">
                                    </div>
                                    @error('price_regular', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Add Discounted Price Field --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="product-price-discounted">Discounted Price
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('price_discounted', 'store') is-invalid @enderror"
                                            id="product-price-discounted" name="price_discounted"
                                            value="{{ old('price_discounted') }}" step="0.01" min="0"
                                            placeholder="Leave blank if no discount">
                                    </div>
                                    @error('price_discounted', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- End Add Discounted Price Field --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="product-stock">Stock Quantity</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('stock_quantity', 'store') is-invalid @enderror"
                                            id="product-stock" name="stock_quantity" value="{{ old('stock_quantity') }}"
                                            required min="0">
                                    </div>
                                    @error('stock_quantity', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Category Selection --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="product-category">Category</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('category_id', 'store') is-invalid @enderror"
                                            id="product-category" name="category_id" data-placeholder="Select Category"
                                            required>
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-description">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control @error('description', 'store') is-invalid @enderror" id="product-description"
                                            name="description">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-image">Featured Image</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('featured_image', 'store') is-invalid @enderror"
                                                id="product-image" name="featured_image" accept="image/*">
                                            <label class="form-file-label" for="product-image">Choose file</label>
                                        </div>
                                    </div>
                                    @error('featured_image', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Product Gallery Images --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Product Gallery Images</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('gallery_images.*', 'store') is-invalid @enderror"
                                                id="product-gallery-images" name="gallery_images[]" accept="image/*"
                                                multiple>
                                            <label class="form-file-label" for="product-gallery-images">Choose multiple
                                                files</label>
                                        </div>
                                    </div>
                                    <div class="form-note mt-1">You can select multiple images for the product gallery.
                                    </div>
                                    @error('gallery_images.*', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('status', 'store') is-invalid @enderror"
                                            id="product-status" name="status" required>
                                            {{-- Assuming App\\Enums\\ProductStatus Enum --}}
                                            @foreach (App\Enums\ProductStatus::cases() as $status)
                                                <option value="{{ $status->value }}" @selected(old('status') == $status->value)>
                                                    {{ $status->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('status', 'store')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn" id="addProductBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Save Product</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Enter the details for the new product.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Product Modal --}}
    <div class="modal fade" id="editProductModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document"> {{-- Made modal larger --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- Form action will be set dynamically by JS --}}
                    <form action="" method="POST" id="editProductForm" class="form-validate is-alter"
                        enctype="multipart/form-data"> {{-- Added enctype --}}
                        @csrf
                        @method('PUT') {{-- Method for update --}}
                        <input type="hidden" name="id" id="edit-product-id"> {{-- Hidden field for ID --}}
                        <input type="hidden" name="redirect_to" value="index"> {{-- Hidden field to track origin --}}

                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-title">Product Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control @error('title', 'update') is-invalid @enderror"
                                            id="edit-product-title" name="title" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-price">Regular Price</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('price_regular', 'update') is-invalid @enderror"
                                            id="edit-product-price" name="price_regular"
                                            value="{{ old('price_regular') }}" required step="0.01" min="10">
                                    </div>
                                    @error('price_regular', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Add Discounted Price Field --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-price-discounted">Discounted Price
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('price_discounted', 'update') is-invalid @enderror"
                                            id="edit-product-price-discounted" name="price_discounted"
                                            value="{{ old('price_discounted') }}" step="0.01" min="0"
                                            placeholder="Leave blank if no discount">
                                    </div>
                                    @error('price_discounted', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- End Add Discounted Price Field --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-stock">Stock Quantity</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('stock_quantity', 'update') is-invalid @enderror"
                                            id="edit-product-stock" name="stock_quantity"
                                            value="{{ old('stock_quantity') }}" required min="0">
                                    </div>
                                    @error('stock_quantity', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Category Selection --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-category">Category</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('category_id', 'update') is-invalid @enderror"
                                            id="edit-product-category" name="category_id"
                                            data-placeholder="Select Category" required>
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-description">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control @error('description', 'update') is-invalid @enderror" id="edit-product-description"
                                            name="description">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Current Featured Image</label>
                                    <div class="mb-2">
                                        <img id="edit-product-current-image" src="" alt="Current Image"
                                            style="max-height: 100px; display: none;">
                                        <span id="edit-product-no-image" style="display: none;">No current image.</span>
                                    </div>
                                    <label class="form-label mt-2" for="edit-product-image">Change Featured Image
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('featured_image', 'update') is-invalid @enderror"
                                                id="edit-product-image" name="featured_image" accept="image/*">
                                            <label class="form-file-label" for="edit-product-image">Choose file</label>
                                        </div>
                                    </div>
                                    @error('featured_image', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Product Gallery Images --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Product Gallery Images</label>

                                    {{-- Current Gallery Images --}}
                                    <div id="current-gallery-images" class="mb-3">
                                        <div class="gallery-images-container d-flex flex-wrap gap-2"
                                            style="display: none;">
                                            {{-- Images will be loaded dynamically via AJAX --}}
                                        </div>
                                        <span id="no-gallery-images" style="display: none;">No gallery images.</span>
                                    </div>

                                    <label class="form-label mt-2">Add More Gallery Images (Optional)</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('gallery_images.*', 'update') is-invalid @enderror"
                                                id="edit-product-gallery-images" name="gallery_images[]" accept="image/*"
                                                multiple>
                                            <label class="form-file-label" for="edit-product-gallery-images">Choose
                                                multiple files</label>
                                        </div>
                                    </div>
                                    <div class="form-note mt-1">You can select multiple images to add to the product
                                        gallery.</div>
                                    @error('gallery_images.*', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('status', 'update') is-invalid @enderror"
                                            id="edit-product-status" name="status" required>
                                            {{-- Assuming App\\Enums\\ProductStatus Enum --}}
                                            @foreach (App\Enums\ProductStatus::cases() as $status)
                                                <option value="{{ $status->value }}" @selected(old('status') == $status->value)>
                                                    {{ $status->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('status', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                        id="updateProductBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Update Product</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the product.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Product Confirmation Modal --}}
    <div class="modal fade" id="deleteProductModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Product</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-product-title"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteProductForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteBtn">
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
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1.5px solid #ddd
        }

        .file-thumbnails {
            height: 100%;
        }

        #current-gallery-images {
            height: 100%;
        }

        .gallery-images-container {
            height: 100%;
        }

        .no-products-message {
            display: block;
            font-size: 16px;
            padding: 20px 0;
            text-align: center;
        }

        /* Search and filter controls styling */
        .search-filter-controls {
            background: #f8f9fa;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .search-filter-controls .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .search-filter-controls .form-select,
        .search-filter-controls .form-control {
            border: 1px solid #dbdfea;
            border-radius: 0.375rem;
        }

        .search-filter-controls .form-select:focus,
        .search-filter-controls .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* Pagination info styling */
        .pagination-info {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .pagination-info span {
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Enhanced pagination styling */
        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            border: 1px solid #dbdfea;
            color: #495057;
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 0.375rem;
            transition: all 0.15s ease-in-out;
        }

        .pagination .page-link:hover {
            background-color: #f8f9fa;
            border-color: #adb5bd;
            color: #495057;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            color: #6c757d;
        }

        /* Product count info styling */
        .product-count-info {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
            color: #1565c0;
        }

        /* Empty state improvements */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state .icon {
            font-size: 4rem;
            color: #c4c4c4;
            margin-bottom: 1rem;
        }

        .empty-state h6 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 0;
        }

        /* Checkbox improvements */
        .product-checkbox:indeterminate {
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Table improvements */
        .nk-tb-list {
            margin-bottom: 0;
        }

        .nk-tb-item td {
            vertical-align: middle;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .search-filter-controls {
                padding: 0.75rem;
            }

            .search-filter-controls .row>div {
                margin-bottom: 1rem;
            }

            .search-filter-controls .row>div:last-child {
                margin-bottom: 0;
            }

            .pagination-info {
                text-align: center;
                margin-bottom: 1rem;
            }

            .product-count-info {
                text-align: center;
            }
        }

        @media (max-width: 576px) {

            .search-filter-controls .form-select,
            .search-filter-controls .form-control {
                font-size: 0.875rem;
            }

            .pagination .page-link {
                padding: 0.375rem 0.5rem;
                font-size: 0.875rem;
            }
        }
    </style>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Handle search functionality
            let searchTimeout;
            $('#search-products').on('input', function() {
                clearTimeout(searchTimeout);
                const searchValue = $(this).val();

                searchTimeout = setTimeout(function() {
                    // Update URL with search parameter
                    const url = new URL(window.location);
                    if (searchValue.trim()) {
                        url.searchParams.set('search', searchValue);
                    } else {
                        url.searchParams.delete('search');
                    }
                    url.searchParams.delete('page'); // Reset to first page
                    window.location.href = url.toString();
                }, 500); // 500ms delay for better UX
            });

            // Handle per-page change
            $('#entries-per-page').on('change', function() {
                const perPage = $(this).val();
                const url = new URL(window.location);
                url.searchParams.set('per_page', perPage);
                url.searchParams.delete('page'); // Reset to first page
                window.location.href = url.toString();
            });

            // Handle "Select All" checkbox functionality
            $('#uid').on('change', function() {
                var isChecked = $(this).prop('checked');
                $('.product-checkbox').prop('checked', isChecked);
                updateSelectAllCheckbox();
            });

            // Handle individual checkbox clicks
            $(document).on('change', '.product-checkbox', function() {
                updateSelectAllCheckbox();
            });

            // Function to update "Select All" checkbox state
            function updateSelectAllCheckbox() {
                var totalCheckboxes = $('.product-checkbox').length;
                var checkedCheckboxes = $('.product-checkbox:checked').length;

                if (totalCheckboxes === 0) {
                    $('#uid').prop('indeterminate', false).prop('checked', false);
                } else if (totalCheckboxes === checkedCheckboxes) {
                    $('#uid').prop('indeterminate', false).prop('checked', true);
                } else if (checkedCheckboxes > 0) {
                    $('#uid').prop('indeterminate', true);
                } else {
                    $('#uid').prop('indeterminate', false).prop('checked', false);
                }
            }

            // Initialize Select2 with search functionality for category dropdowns
            if ($.fn.select2) {
                $('#product-category').select2({
                    dropdownParent: $('#addProductModal'),
                    placeholder: "Select Category",
                    allowClear: true,
                    width: '100%'
                });

                $('#edit-product-category').select2({
                    dropdownParent: $('#editProductModal'),
                    placeholder: "Select Category",
                    allowClear: true,
                    width: '100%'
                });
            }

            // Maximum file size in bytes (1.5MB = 1.5 * 1024 * 1024 bytes)
            const MAX_FILE_SIZE = 1.5 * 1024 * 1024;

            // File size validation function
            function validateFileSize(fileInput, errorContainer) {
                let valid = true;
                const files = fileInput[0].files;

                // Clear previous errors
                errorContainer.empty().hide();

                // Check each file
                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].size > MAX_FILE_SIZE) {
                            errorContainer.html(
                                '<div class="alert alert-danger">' +
                                'File "' + files[i].name + '" is too large. Maximum size is 1.5MB.' +
                                '</div>'
                            ).show();
                            valid = false;
                            break;
                        }
                    }
                }

                return valid;
            }

            // Add error containers after file inputs
            $('#product-image, #edit-product-image').after(
                '<div class="file-error mt-2" style="display:none;"></div>');
            $('#product-gallery-images, #edit-product-gallery-images').after(
                '<div class="file-error mt-2" style="display:none;"></div>');

            // Validate on file selection
            $('#product-image, #edit-product-image').on('change', function() {
                const errorContainer = $(this).siblings('.file-error');
                if (!validateFileSize($(this), errorContainer)) {
                    $(this).val(''); // Clear the input if validation fails
                }
            });

            $('#product-gallery-images, #edit-product-gallery-images').on('change', function() {
                const errorContainer = $(this).siblings('.file-error');
                if (!validateFileSize($(this), errorContainer)) {
                    $(this).val(''); // Clear the input if validation fails
                    // Reset the file label
                    $(this).next('.form-file-label').html('Choose multiple files');
                    // Remove thumbnails if any
                    $(this).closest('.form-group').find('.file-thumbnails').remove();
                }
            });

            // Form submission validation
            $('#addProductForm, #editProductForm').on('submit', function(e) {
                let formValid = true;

                // Check featured image
                const featuredImageInput = $(this).find('input[name="featured_image"]');
                if (featuredImageInput.val()) {
                    const errorContainer = featuredImageInput.siblings('.file-error');
                    if (!validateFileSize(featuredImageInput, errorContainer)) {
                        formValid = false;
                    }
                }

                // Check gallery images
                const galleryImagesInput = $(this).find('input[name="gallery_images[]"]');
                if (galleryImagesInput.val()) {
                    const errorContainer = galleryImagesInput.siblings('.file-error');
                    if (!validateFileSize(galleryImagesInput, errorContainer)) {
                        formValid = false;
                    }
                }

                if (!formValid) {
                    e.preventDefault();
                    return false;
                }
            });

            // --- Helper function to check form validity and toggle submit button ---
            function checkFormValidity(formType) {
                let priceInputId, categoryInputId, submitBtnId;
                if (formType === 'add') {
                    priceInputId = '#product-price';
                    categoryInputId = '#product-category';
                    submitBtnId = '#addProductBtn';
                } else if (formType === 'edit') {
                    priceInputId = '#edit-product-price';
                    categoryInputId = '#edit-product-category';
                    submitBtnId = '#updateProductBtn';
                } else {
                    return; // Invalid form type
                }

                const $priceInput = $(priceInputId);
                const $categoryInput = $(categoryInputId);
                const $submitBtn = $(submitBtnId);

                const priceValue = parseFloat($priceInput.val());
                const isPriceValid = !isNaN(priceValue) && priceValue >= 10;
                const isCategorySelected = $categoryInput.val() !== '' && $categoryInput.val() !== null;

                if (isPriceValid && isCategorySelected) {
                    $submitBtn.prop('disabled', false);
                } else {
                    $submitBtn.prop('disabled', true);
                }
            }

            // Initially disable the submit buttons
            $('#addProductBtn, #updateProductBtn').prop('disabled', true);

            // --- Event Listeners for Add Product Form ---
            $('#product-category, #product-price').on('change input', function() {
                checkFormValidity('add');
            });

            // --- Event Listeners for Edit Product Form ---
            $('#edit-product-category, #edit-product-price').on('change input', function() {
                checkFormValidity('edit');
            });

            // --- Custom file input handling for gallery images ---
            $('#product-gallery-images, #edit-product-gallery-images').on('change', function() {
                var fileInput = $(this);
                var fileLabel = fileInput.next('.form-file-label');
                var files = fileInput[0].files;
                var formGroup = fileInput.closest('.form-group');

                // Remove any existing thumbnails container
                formGroup.find('.file-thumbnails').remove();

                if (files.length > 0) {
                    // Update the label with file count
                    fileLabel.html(files.length + ' files selected');

                    // Find the form note text
                    var formNote = formGroup.find('.form-note');
                    var formNoteText = "You can select multiple images to add to the product gallery.";
                    if (formNote.length) {
                        formNoteText = formNote.text();
                        formNote.hide(); // Hide the original note as we'll place it above thumbnails
                    }

                    // Create a container for thumbnails and the info text
                    var container = $('<div class="selected-files-container mt-2"></div>');

                    // Add the info text above thumbnails
                    container.append('<div class="form-note mb-2">' + formNoteText + '</div>');

                    // Create thumbnails container
                    var thumbnailsContainer = $(
                        '<div class="file-thumbnails d-flex flex-wrap gap-2 mb-2"></div>');

                    // Add up to 5 thumbnails
                    var maxToShow = Math.min(files.length, 5);
                    for (var i = 0; i < maxToShow; i++) {
                        var fileItem = $(
                            '<div class="thumbnail-item" style="position:relative;width:70px;height:70px;border-radius:4px;overflow:hidden;"></div>'
                        );

                        var reader = new FileReader();
                        reader.onload = (function(item) {
                            return function(e) {
                                item.append('<img src="' + e.target.result +
                                    '" style="width:100%;height:100%;object-fit:cover;" />');
                            };
                        })(fileItem);

                        reader.readAsDataURL(files[i]);
                        thumbnailsContainer.append(fileItem);
                    }

                    // If more files than we're showing
                    if (files.length > maxToShow) {
                        thumbnailsContainer.append(
                            '<div class="more-files d-flex align-items-center justify-content-center" style="width:70px;height:70px;background:#b6bcd4;border-radius:4px;">+' +
                            (files.length - maxToShow) + '</div>');
                    }

                    // Add thumbnails to container
                    container.append(thumbnailsContainer);

                    // Insert the container after form-file
                    var formFile = fileInput.closest('.form-file');
                    formFile.after(container);
                } else {
                    // Reset the file input label
                    fileLabel.html('Choose multiple files');

                    // Show the original form note
                    formGroup.find('.form-note').show();
                }
            });

            // Delete product handling
            $(document).on('click', '.delete-product-button', function() {
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-product-title').text(name);
                $('#deleteProductForm').attr('action', deleteUrl);
            });

            $('#confirmDeleteBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteProductForm').submit();
            });

            // Set up the edit product form using data attributes (no AJAX)
            $(document).on('click', '.edit-product-button', function() {
                var $btn = $(this);
                var id = $btn.data('id');
                var slug = $btn.data('slug');
                var title = $btn.data('title');
                var description = $btn.data('description');
                var price = $btn.data('price');
                var stock = $btn.data('stock');
                var status = $btn.data('status');
                var categoryId = $btn.data('category-id');
                var hasImage = $btn.data('has-image');
                var imageUrl = $btn.data('image-url');

                // Set form action URL using the route provided in the data attribute
                var updateUrl = "{{ route('seller.products.update', ['product' => ':slug']) }}".replace(
                    ':slug', slug);
                $('#editProductForm').attr('action', updateUrl);

                // Fill form fields
                $('#edit-product-id').val(id);
                $('#edit-product-title').val(title);
                $('#edit-product-price').val(price);
                $('#edit-product-price-discounted').val($btn.data('price-discounted'));
                $('#edit-product-stock').val(stock);
                $('#edit-product-description').val(description);
                $('#edit-product-status').val(status).trigger('change');

                // Set category if provided
                if (categoryId) {
                    $('#edit-product-category').val(categoryId).trigger(
                        'change'); // Trigger change to re-evaluate button state
                } else {
                    $('#edit-product-category').val('').trigger(
                        'change'); // Trigger change to re-evaluate button state
                }

                // *** Check validity for edit form when modal opens ***
                checkFormValidity('edit');

                // Handle featured image display
                if (hasImage && imageUrl) {
                    $('#edit-product-current-image').attr('src', imageUrl).show();
                    $('#edit-product-no-image').hide();
                } else {
                    $('#edit-product-current-image').hide();
                    $('#edit-product-no-image').show();
                }

                // Since we can't use data attributes for gallery images (could be many),
                // we need to use AJAX to get them
                loadProductGalleryImages(slug);
            });

            // Load product gallery images for edit modal
            function loadProductGalleryImages(slug) {
                // Clear the container first
                var $container = $('#current-gallery-images .gallery-images-container');
                $container.empty().hide();
                $('#no-gallery-images').hide();

                // Show loading indicator
                $container.append(
                    '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $container.show();

                // Fetch the gallery images
                var editUrl = "{{ route('seller.products.edit', ['product' => ':slug']) }}".replace(':slug', slug);

                $.ajax({
                    url: editUrl,
                    method: 'GET',
                    success: function(response) {
                        // Remove loading indicator
                        $container.empty();

                        if (response.success && response.product.gallery_images && response.product
                            .gallery_images.length > 0) {
                            // Add each image to the container
                            response.product.gallery_images.forEach(function(image) {
                                var imageHtml = `
                                    <div class="gallery-image-item position-relative" style="width: 100px; margin-right: 10px; margin-bottom: 10px;">
                                        <img src="${image.url}" alt="Gallery Image" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-gallery-image" 
                                                data-image-id="${image.id}" style="padding: 0.1rem 0.3rem;">
                                            <em class="icon ni ni-trash"></em>
                                        </button>
                                    </div>
                                `;
                                $container.append(imageHtml);
                            });

                            $container.show();
                        } else {
                            $('#no-gallery-images').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Remove loading indicator
                        $container.empty();
                        $('#no-gallery-images').show();
                    }
                });
            }

            // Handle gallery image deletion
            $(document).on('click', '.delete-gallery-image', function(e) {
                e.preventDefault();

                var $btn = $(this);
                var imageId = $btn.data('image-id');

                if (confirm('Are you sure you want to delete this image?')) {
                    // Disable the button
                    $btn.prop('disabled', true);

                    // Send AJAX request to delete
                    var deleteUrl = "{{ route('seller.gallery-images.destroy', ['image' => ':id']) }}"
                        .replace(':id', imageId);

                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                // Remove the image from the UI
                                $btn.closest('.gallery-image-item').fadeOut(300, function() {
                                    $(this).remove();

                                    // Check if there are any remaining images
                                    if ($(
                                            '#current-gallery-images .gallery-images-container'
                                        )
                                        .children('.gallery-image-item').length === 0) {
                                        $('#no-gallery-images').show();
                                        $('#current-gallery-images .gallery-images-container')
                                            .hide();
                                    }
                                });
                            } else {
                                alert('Failed to delete image. Please try again.');
                                $btn.prop('disabled', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert(
                                'An error occurred while deleting the image. Please try again.'
                            );
                            $btn.prop('disabled', false);
                        }
                    });
                }
            });

            // Form submission handling
            $('#addProductForm, #editProductForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');

                var formId = $(this).attr('id');
                if (formId === 'addProductForm') {
                    $submitBtn.find('.btn-text').text('Saving...');
                } else if (formId === 'editProductForm') {
                    $submitBtn.find('.btn-text').text('Updating...');
                }

                return true;
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Update initial checkbox state
            updateSelectAllCheckbox();
        });
    </script>
@endsection
