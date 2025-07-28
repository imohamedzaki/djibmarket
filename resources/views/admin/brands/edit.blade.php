@extends('layouts.app.admin')
@section('title', 'Edit Brand')

@section('style')
    <style>
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .brand-image-container {
            transition: all 0.3s ease;
        }

        .brand-image-container:hover {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Edit Brand</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.brands.show', $brand) }}">{{ $brand->name }}</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-inner">
                        <form action="{{ route('admin.brands.update', $brand) }}" method="POST"
                            enctype="multipart/form-data" class="form-validate is-alter">
                            @csrf
                            @method('PUT')

                            <!-- Brand Information -->
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Brand Name <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control @error('name') error @enderror"
                                                id="name" name="name" value="{{ old('name', $brand->name) }}"
                                                required>
                                            @error('name')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="brand_type_id">Brand Type <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 @error('brand_type_id') error @enderror"
                                                id="brand_type_id" name="brand_type_id" required>
                                                <option value="">Select Brand Type</option>
                                                @foreach ($brandTypes as $brandType)
                                                    <option value="{{ $brandType->id }}"
                                                        {{ old('brand_type_id', $brand->brand_type_id) == $brandType->id ? 'selected' : '' }}>
                                                        {{ $brandType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand_type_id')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="website">Website URL</label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-globe"></em>
                                            </div>
                                            <input type="url" class="form-control @error('website') error @enderror"
                                                id="website" name="website" value="{{ old('website', $brand->website) }}"
                                                placeholder="https://example.com">
                                            @error('website')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="logo">Brand Logo</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('logo') error @enderror" id="logo"
                                                    name="logo" accept="image/*">
                                                <label class="custom-file-label" for="logo">Choose new logo</label>
                                            </div>
                                            <span class="form-note">Upload new brand logo (JPG, PNG, GIF, SVG - Max: 2MB).
                                                Leave empty to keep current logo.</span>
                                            @error('logo')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Logo Preview -->
                                        <div class="form-group mt-3">
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar sq brand-image-container" id="logoPreview"
                                                    style="width: 80px; height: 80px; border-radius: 8px; position: relative; overflow: hidden;">
                                                    <!-- Skeleton loading placeholder -->
                                                    <div class="brand-skeleton" id="logoSkeleton"
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; display: none;">
                                                    </div>

                                                    <img src="{{ $brand->logo_url }}" alt="Brand Logo Preview"
                                                        id="logoImage"
                                                        style="width: 100%; height: 100%; object-fit: contain; background: #f8f9fa; border-radius: 6px;"
                                                        onload="document.getElementById('logoSkeleton').style.display='none';"
                                                        onerror="this.src='{{ asset('assets/imgs/template/logo_only.png') }}'; this.style.filter='grayscale(100%)'; document.getElementById('logoSkeleton').style.display='none';" />
                                                </div>

                                                <div class="flex-grow-1">
                                                    <div class="small text-soft">Current Logo</div>
                                                    <div class="small">
                                                        @if ($brand->isLocalLogo())
                                                            <span class="badge badge-success">Local File</span>
                                                        @elseif($brand->logo)
                                                            <span class="badge badge-info">External URL</span>
                                                        @else
                                                            <span class="badge badge-light">Default Image</span>
                                                        @endif
                                                    </div>
                                                    @if ($brand->logo && $brand->isLocalLogo())
                                                        <div class="mt-1">
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                id="deleteLogoBtn">
                                                                <em class="icon ni ni-trash"></em> Remove Logo
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-gs">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="description">Description</label>
                                        <div class="form-control-wrap">
                                            <textarea class="form-control @error('description') error @enderror" id="description" name="description"
                                                rows="3" placeholder="Brief description about the brand">{{ old('description', $brand->description) }}</textarea>
                                            @error('description')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Associations -->
                            <div class="nk-divider divider md"></div>
                            <h5 class="title">Category Associations</h5>
                            <p class="text-soft">Select super categories (main categories) for this brand</p>

                            <div class="row g-gs">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-label" for="categories">Categories</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 @error('categories') error @enderror"
                                                id="categories" name="categories[]" multiple
                                                data-placeholder="Select categories for this brand">
                                                @foreach ($categories->whereNull('parent_id') as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, old('categories', $brand->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="form-note">Select one or more super categories where this brand
                                                will be featured</span>
                                            @error('categories')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="top_brand_categories">Top Brand Categories</label>
                                        <div class="form-control-wrap">
                                            <select
                                                class="form-select js-select2 @error('top_brand_categories') error @enderror"
                                                id="top_brand_categories" name="top_brand_categories[]" multiple
                                                data-placeholder="Select top brand categories">
                                                @foreach ($categories->whereNull('parent_id') as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, old('top_brand_categories', $brand->categories->where('pivot.is_top_brand', true)->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="form-note text-success">
                                                <em class="icon ni ni-star-fill"></em> Categories where this brand will be
                                                featured as top brand
                                            </span>
                                            @error('top_brand_categories')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Priority Settings for Top Brand Categories -->
                            <div class="row g-gs" id="priority-settings"
                                style="{{ old('top_brand_categories', $brand->categories->where('pivot.is_top_brand', true)) ? '' : 'display: none;' }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Priority Settings</label>
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div id="priority-inputs">
                                                    @foreach ($brand->categories->where('pivot.is_top_brand', true) as $category)
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <span class="form-label">{{ $category->name }}</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="number" class="form-control form-control-sm"
                                                                    name="priorities[{{ $category->id }}]"
                                                                    value="{{ old('priorities.' . $category->id, $category->pivot->priority) }}"
                                                                    min="1" max="100"
                                                                    placeholder="Priority (1-100)">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-lg btn-primary submit-btn">
                                    <span class="spinner d-none"><em
                                            class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                    <span class="btn-text">Update Brand</span>
                                </button>
                                <a href="{{ route('admin.brands.show', $brand) }}"
                                    class="btn btn-lg btn-light">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#brand_type_id').select2({
                placeholder: 'Select Brand Type',
                allowClear: true
            });

            $('#categories').select2({
                placeholder: 'Select categories for this brand',
                allowClear: true
            });

            $('#top_brand_categories').select2({
                placeholder: 'Select top brand categories',
                allowClear: true
            });

            // Handle categories selection change
            $('#categories').on('change', function() {
                const selectedCategories = $(this).val();
                const topBrandSelect = $('#top_brand_categories');
                const currentTopBrands = topBrandSelect.val();

                if (selectedCategories && selectedCategories.length > 0) {
                    // Enable top brand categories dropdown
                    topBrandSelect.prop('disabled', false);

                    // Update top brand categories options to only show selected categories
                    topBrandSelect.empty();
                    selectedCategories.forEach(function(categoryId) {
                        const categoryText = $('#categories option[value="' + categoryId + '"]')
                            .text();
                        const isSelected = currentTopBrands && currentTopBrands.includes(
                            categoryId);
                        topBrandSelect.append(new Option(categoryText, categoryId, false,
                            isSelected));
                    });
                    topBrandSelect.trigger('change');
                } else {
                    // Disable and clear top brand categories
                    topBrandSelect.prop('disabled', true).val(null).trigger('change');
                    $('#priority-settings').hide();
                    $('#priority-inputs').empty();
                }
            });

            // Handle top brand categories selection change
            $('#top_brand_categories').on('change', function() {
                const selectedTopBrands = $(this).val();
                const prioritySettings = $('#priority-settings');
                const priorityInputs = $('#priority-inputs');

                if (selectedTopBrands && selectedTopBrands.length > 0) {
                    prioritySettings.show();
                    priorityInputs.empty();

                    // Generate priority inputs for each selected top brand category
                    selectedTopBrands.forEach(function(categoryId) {
                        const categoryText = $('#top_brand_categories option[value="' + categoryId +
                            '"]').text();

                        // Get existing priority value if available
                        const existingPriority = $('input[name="priorities[' + categoryId + ']"]')
                            .val() || '1';

                        const priorityInput = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <span class="form-label">${categoryText}</span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control form-control-sm" 
                                   name="priorities[${categoryId}]" 
                                   value="${existingPriority}" min="1" max="100" 
                                   placeholder="Priority (1-100)">
                        </div>
                    </div>
                `;
                        priorityInputs.append(priorityInput);
                    });
                } else {
                    prioritySettings.hide();
                    priorityInputs.empty();
                }
            });

            // Handle logo file input change with skeleton loading
            $('#logo').on('change', function(e) {
                const file = e.target.files[0];
                const logoImage = $('#logoImage');
                const logoSkeleton = $('#logoSkeleton');

                if (file) {
                    // Show skeleton loading
                    logoSkeleton.show();
                    logoImage.css('opacity', '0');

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoImage.attr('src', e.target.result);
                        logoImage.css({
                            'opacity': '1',
                            'filter': 'none'
                        });
                        logoSkeleton.hide();
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle delete logo button
            $('#deleteLogoBtn').on('click', function() {
                if (confirm('Are you sure you want to delete the current logo?')) {
                    $.ajax({
                        url: '{{ route('admin.brands.deleteLogo', $brand) }}',
                        method: 'DELETE',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#logoImage').attr('src',
                                    '{{ asset('assets/imgs/template/logo_only.png') }}');
                                $('#deleteLogoBtn').hide();
                                alert('Logo deleted successfully!');
                            } else {
                                alert('Failed to delete logo: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the logo.');
                        }
                    });
                }
            });

            // Form validation and submission
            $('form').on('submit', function(e) {
                var $form = $(this);
                var $submitBtn = $('.submit-btn');
                var hasErrors = false;

                // Check for validation errors
                $('.form-control.error, .form-select.error').each(function() {
                    hasErrors = true;
                });

                // Check required fields
                $('[required]').each(function() {
                    if (!$(this).val()) {
                        hasErrors = true;
                        $(this).addClass('error');
                    }
                });

                if (hasErrors) {
                    // Don't show loading state if there are validation errors
                    e.preventDefault();
                    return false;
                }

                // Show loading state only if no errors
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });

            // Remove error class on input change
            $('.form-control, .form-select').on('change input', function() {
                $(this).removeClass('error');
            });

            // Initialize existing categories and top brands on page load
            const initialCategories = $('#categories').val();
            if (initialCategories && initialCategories.length > 0) {
                $('#categories').trigger('change');
            }
        });
    </script>
@endsection
