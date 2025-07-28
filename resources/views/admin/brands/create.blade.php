@extends('layouts.app.admin')
@section('title', 'Create Brand')

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
                        <h3 class="nk-block-title page-title">Create Brand</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-inner">
                        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-validate is-alter">
                            @csrf

                            <!-- Brand Information -->
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Brand Name <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control @error('name') error @enderror"
                                                id="name" name="name" value="{{ old('name') }}" required>
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
                                                id="brand_type_id" name="brand_type_id" required
                                                data-placeholder="Select Brand Type">
                                                <option value="">Select Brand Type</option>
                                                @foreach ($brandTypes as $brandType)
                                                    <option value="{{ $brandType->id }}"
                                                        {{ old('brand_type_id') == $brandType->id ? 'selected' : '' }}>
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
                                                id="website" name="website" value="{{ old('website') }}"
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
                                                <label class="custom-file-label" for="logo">Choose logo</label>
                                            </div>
                                            <span class="form-note">Upload brand logo (JPG, PNG, GIF, SVG - Max: 2MB)</span>
                                            @error('logo')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Logo Preview -->
                                        <div class="form-group mt-3">
                                            <div class="user-avatar sq brand-image-container" id="logoPreview"
                                                style="width: 80px; height: 80px; border-radius: 8px; position: relative; overflow: hidden;">
                                                <!-- Skeleton loading placeholder -->
                                                <div class="brand-skeleton" id="logoSkeleton"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; display: none;">
                                                </div>

                                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}"
                                                    alt="Brand Logo Preview" id="logoImage"
                                                    style="width: 100%; height: 100%; object-fit: contain; background: #f8f9fa; border-radius: 6px;"
                                                    onload="document.getElementById('logoSkeleton').style.display='none';"
                                                    onerror="this.src='{{ asset('assets/imgs/template/logo_only.png') }}'; this.style.filter='grayscale(100%)'; document.getElementById('logoSkeleton').style.display='none';" />
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
                                            <textarea class="form-control @error('description') error @enderror" id="description" name="description" rows="3"
                                                placeholder="Brief description about the brand">{{ old('description') }}</textarea>
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
                                                        {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
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
                                                data-placeholder="Select top brand categories" disabled>
                                                @foreach ($categories->whereNull('parent_id') as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, old('top_brand_categories', [])) ? 'selected' : '' }}>
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
                            <div class="row g-gs" id="priority-settings" style="display: none;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Priority Settings</label>
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div id="priority-inputs">
                                                    <!-- Priority inputs will be dynamically generated here -->
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
                                    <span class="btn-text">Create Brand</span>
                                </button>
                                <a href="{{ route('admin.brands.index') }}" class="btn btn-lg btn-light">Cancel</a>
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

                if (selectedCategories && selectedCategories.length > 0) {
                    // Enable top brand categories dropdown
                    topBrandSelect.prop('disabled', false);

                    // Update top brand categories options to only show selected categories
                    topBrandSelect.empty();
                    selectedCategories.forEach(function(categoryId) {
                        const categoryText = $('#categories option[value="' + categoryId + '"]')
                            .text();
                        topBrandSelect.append(new Option(categoryText, categoryId, false, false));
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
                        const priorityInput = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <span class="form-label">${categoryText}</span>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control form-control-sm" 
                                   name="priorities[${categoryId}]" 
                                   value="1" min="1" max="100" 
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
                } else {
                    // Reset to default state
                    logoImage.attr('src', '{{ asset('assets/imgs/template/logo_only.png') }}');
                    logoImage.css({
                        'opacity': '1',
                        'filter': 'none'
                    });
                    logoSkeleton.hide();
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
                $submitBtn.find('.btn-text').text('Creating...');
                return true;
            });

            // Remove error class on input change
            $('.form-control, .form-select').on('change input', function() {
                $(this).removeClass('error');
            });

            // Initialize state for existing values (for edit mode)
            const initialCategories = $('#categories').val();
            if (initialCategories && initialCategories.length > 0) {
                $('#categories').trigger('change');
            }

            const initialTopBrands = $('#top_brand_categories').val();
            if (initialTopBrands && initialTopBrands.length > 0) {
                $('#top_brand_categories').trigger('change');
            }
        });
    </script>
@endsection
