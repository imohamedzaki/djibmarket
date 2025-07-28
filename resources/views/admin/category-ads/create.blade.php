@extends('layouts.app.admin')
@section('title', 'Create Category Ad')

@section('css')
    <style>
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .ad-image-container {
            transition: all 0.3s ease;
        }

        .ad-image-container:hover {
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
                        <h3 class="nk-block-title page-title">Create Category Ad</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.category-ads.index') }}">Category
                                        Ads</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-inner">
                        <form action="{{ route('admin.category-ads.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-validate is-alter">
                            @csrf

                            <!-- Ad Information -->
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="category_id">Category <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <select class="form-select js-select2 @error('category_id') error @enderror"
                                                id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="position">Position <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control @error('position') error @enderror"
                                                id="position" name="position" value="{{ old('position', 1) }}"
                                                min="1" max="100" required>
                                            <span class="form-note">Position order for displaying the ad (1-100)</span>
                                            @error('position')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="link_url">Link URL <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-globe"></em>
                                            </div>
                                            <input type="url" class="form-control @error('link_url') error @enderror"
                                                id="link_url" name="link_url" value="{{ old('link_url') }}"
                                                placeholder="https://example.com" required>
                                            @error('link_url')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="image">Ad Image <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('image') error @enderror" id="image"
                                                    name="image" accept="image/*" required>
                                                <label class="custom-file-label" for="image">Choose ad image</label>
                                            </div>
                                            <span class="form-note">Upload ad image (JPG, PNG, GIF - Max: 2MB)</span>
                                            @error('image')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Image Preview -->
                                        <div class="form-group mt-3">
                                            <div class="user-avatar sq ad-image-container" id="imagePreview"
                                                style="width: 200px; height: 120px; border-radius: 8px; position: relative; overflow: hidden; margin: 0 auto;">
                                                <!-- Skeleton loading placeholder -->
                                                <div class="ad-skeleton" id="imageSkeleton"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; display: none;">
                                                </div>

                                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}"
                                                    alt="Ad Preview" id="adImage"
                                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px; filter: grayscale(100%); opacity: 0.7;"
                                                    onload="document.getElementById('imageSkeleton').style.display='none';"
                                                    onerror="this.src='{{ asset('assets/imgs/template/logo_only.png') }}'; this.style.filter='grayscale(100%)'; this.style.opacity='0.7'; document.getElementById('imageSkeleton').style.display='none';" />
                                            </div>
                                            <div class="text-center mt-2">
                                                <small class="text-soft">Preview will appear after selecting an
                                                    image</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Duration Settings -->
                            <div class="nk-divider divider md"></div>
                            <h5 class="title">Duration Settings</h5>
                            <p class="text-soft">Set the start and end dates for this ad</p>

                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="starts_at">Start Date <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-calendar"></em>
                                            </div>
                                            <input type="date" class="form-control @error('starts_at') error @enderror"
                                                id="starts_at" name="starts_at"
                                                value="{{ old('starts_at', date('Y-m-d')) }}" required>
                                            @error('starts_at')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="ends_at">End Date <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-calendar"></em>
                                            </div>
                                            <input type="date" class="form-control @error('ends_at') error @enderror"
                                                id="ends_at" name="ends_at"
                                                value="{{ old('ends_at', date('Y-m-d', strtotime('+3 months'))) }}"
                                                required>
                                            @error('ends_at')
                                                <span class="form-note text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Settings -->
                            <div class="row g-gs">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="active"
                                                name="active" value="1" {{ old('active', true) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="active">
                                                <span class="fw-medium">Active</span>
                                                <span class="form-note">Enable this ad to be displayed on the
                                                    website</span>
                                            </label>
                                        </div>
                                        @error('active')
                                            <span class="form-note text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-lg btn-primary submit-btn">
                                    <span class="spinner d-none"><em
                                            class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                    <span class="btn-text">Create Ad</span>
                                </button>
                                <a href="{{ route('admin.category-ads.index') }}" class="btn btn-lg btn-light">Cancel</a>
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
            $('#category_id').select2({
                placeholder: 'Select Category',
                allowClear: true
            });

            // Handle image file input change with skeleton loading
            $('#image').on('change', function(e) {
                const file = e.target.files[0];
                const adImage = $('#adImage');
                const imageSkeleton = $('#imageSkeleton');

                if (file) {
                    // Show skeleton loading
                    imageSkeleton.show();
                    adImage.css('opacity', '0');

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        adImage.attr('src', e.target.result);
                        adImage.css({
                            'opacity': '1',
                            'filter': 'none'
                        });
                        imageSkeleton.hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Reset to default placeholder
                    adImage.attr('src', '{{ asset('assets/imgs/template/logo_only.png') }}');
                    adImage.css({
                        'opacity': '0.7',
                        'filter': 'grayscale(100%)'
                    });
                }
            });

            // Date validation
            $('#starts_at, #ends_at').on('change', function() {
                const startDate = $('#starts_at').val();
                const endDate = $('#ends_at').val();

                if (startDate && endDate && new Date(startDate) >= new Date(endDate)) {
                    alert('End date must be after start date.');
                    if (this.id === 'ends_at') {
                        this.value = '';
                    }
                }
            });

            // Set minimum date for starts_at to today
            $('#starts_at').attr('min', new Date().toISOString().split('T')[0]);

            // Update ends_at minimum when starts_at changes
            $('#starts_at').on('change', function() {
                const startDate = $(this).val();
                if (startDate) {
                    $('#ends_at').attr('min', startDate);
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

                // Date validation
                const startDate = $('#starts_at').val();
                const endDate = $('#ends_at').val();
                if (startDate && endDate && new Date(startDate) >= new Date(endDate)) {
                    hasErrors = true;
                    $('#ends_at').addClass('error');
                    alert('End date must be after start date.');
                }

                // Check if image is selected
                if (!$('#image')[0].files.length) {
                    hasErrors = true;
                    $('#image').addClass('error');
                    alert('Please select an ad image.');
                }

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

            // Update file label when file is selected
            $('#image').on('change', function() {
                var fileName = $(this)[0].files.length > 0 ? $(this)[0].files[0].name : 'Choose ad image';
                $(this).next('.custom-file-label').text(fileName);
            });
        });
    </script>
@endsection
