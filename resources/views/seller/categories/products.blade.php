@extends('layouts.app.seller')
@section('title', $category->name . ' Products')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{ $category->name }} Products</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.categories.index') }}">Categories</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $category->name }}</li>
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addProductModal">
                                            <em class="icon ni ni-plus"></em><span>Add Product</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Products in {{ $category->name }}</h4>
                        <div class="nk-block-des">
                            <p>View and manage your products in this category.</p>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid-all">
                                            <label class="custom-control-label" for="uid-all"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Product</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">SKU</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Price</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Stock</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="product-check-{{ $product->id }}">
                                                <label class="custom-control-label"
                                                    for="product-check-{{ $product->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar bg-dim-primary d-none d-sm-flex">
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
                                                class="tb-amount {{ $product->price_discounted ? 'text-decoration-line-through' : '' }}">{{ number_format($product->price_regular, 2) }}</span>
                                            @if ($product->price_discounted)
                                                <span
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
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden"> <a
                                                        href="{{ route('seller.products.show', $product->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="View Details"> <em
                                                            class="icon ni ni-eye"></em> </a> </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty <!-- Empty state handled by DataTables language settings -->
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div> <!-- nk-block -->
        </div>
    </div>

    {{-- Add Product Modal --}}
    <div class="modal fade" id="addProductModal">
        <div class="modal-dialog modal-lg" role="document">
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
                        id="addProductForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="product-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('status', 'store') is-invalid @enderror"
                                            id="product-status" name="status" required>
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Add custom language settings to DataTables defaults
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    emptyTable: "No products found in this category."
                }
            });

            // Initialize Select2 for dropdowns
            if ($.fn.select2) {
                $('#product-status').select2({
                    dropdownParent: $('#addProductModal'),
                    placeholder: "Select Status",
                    width: '100%'
                });
            }

            // Maximum file size validation (1.5MB)
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
            $('#product-image').after('<div class="file-error mt-2" style="display:none;"></div>');
            $('#product-gallery-images').after('<div class="file-error mt-2" style="display:none;"></div>');

            // Validate on file selection
            $('#product-image').on('change', function() {
                const errorContainer = $(this).siblings('.file-error');
                if (!validateFileSize($(this), errorContainer)) {
                    $(this).val(''); // Clear the input if validation fails
                }
            });

            $('#product-gallery-images').on('change', function() {
                const errorContainer = $(this).siblings('.file-error');
                if (!validateFileSize($(this), errorContainer)) {
                    $(this).val(''); // Clear the input if validation fails
                    $(this).next('.form-file-label').html('Choose multiple files');
                }
            });

            // Form submission handling
            $('#addProductForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Saving...');
                return true;
            });
        });
    </script>
@endsection
@section('css')
    <style>
        .dataTables_empty {
            padding: 1rem;
        }
    </style>
@endsection
