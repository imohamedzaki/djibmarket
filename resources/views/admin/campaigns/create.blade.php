@extends('layouts.app.admin')

@section('title', 'Create Campaign')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Create Campaign</h3>
                        <div class="nk-block-des text-soft">
                            <p>Create a new marketing campaign.</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-light">
                                            <em class="icon ni ni-arrow-left"></em><span>Back</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <!-- Validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-validate">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Campaign Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="is_active">Status</label>
                                        <div class="form-control-wrap">
                                            <select class="form-select" id="is_active" name="is_active">
                                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="start_date">Start Date</label>
                                        <div class="form-control-wrap">
                                            <input type="datetime-local" class="form-control" id="start_date"
                                                name="start_date" value="{{ old('start_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="end_date">End Date</label>
                                        <div class="form-control-wrap">
                                            <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                                value="{{ old('end_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="description">Description</label>
                                        <div class="form-control-wrap">
                                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="banner_image">Banner Image</label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" class="form-control" id="banner_image"
                                                    name="banner_image" accept="image/jpeg,image/png" required>
                                            </div>
                                            <div class="form-note text-muted mt-2">
                                                Max file size 2MB. Recommended size: 1200x300px. Allowed types: JPG, PNG.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary submit-btn">
                                            <span class="spinner d-none"><em
                                                    class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                            <span class="btn-text">Create Campaign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- .nk-block -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Define required fields and submit button
            const $submitBtn = $('.submit-btn');
            const $form = $('form.form-validate');
            const requiredFields = ['name', 'start_date', 'end_date', 'banner_image']; // Added banner_image

            function checkRequiredFields() {
                let allFilled = true;
                requiredFields.forEach(function(fieldId) {
                    const $field = $('#' + fieldId);
                    if (!$field.val() || ($field.attr('type') === 'file' && !$field[0].files.length)) {
                        allFilled = false;
                    }
                });

                if (allFilled) {
                    $submitBtn.prop('disabled', false);
                    $submitBtn.find('.btn-text').text('Create Campaign');
                } else {
                    $submitBtn.prop('disabled', true);
                    $submitBtn.find('.btn-text').text('Fill all required fields');
                }
            }

            // Initial check and disable button
            checkRequiredFields();

            // Check on input change for text/date fields
            $form.find('input[type="text"], input[type="datetime-local"], textarea').on('input change keyup',
                function() {
                    checkRequiredFields();
                });

            // Check on change for file input and select
            $form.find('input[type="file"], select').on('change', function() {
                checkRequiredFields();
            });

            // Image preview when file is selected
            $('#banner_image').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // If preview container doesn't exist, create it
                        if ($('#image-preview-container').length === 0) {
                            var previewHTML = '<div id="image-preview-container" class="mt-3">' +
                                '<label class="form-label">Image Preview</label>' +
                                '<div class="d-flex align-items-center">' +
                                '<img id="image-preview" src="' + e.target.result +
                                '" alt="Banner Preview" class="img-fluid rounded" style="max-height: 100px;">' +
                                '<button type="button" class="btn btn-icon btn-outline-danger ms-2" id="remove-image">' +
                                '<em class="icon ni ni-trash"></em>' +
                                '</button>' +
                                '</div></div>';
                            $('.form-group:has(#banner_image)').append(previewHTML);

                            // Add remove image functionality
                            $('#remove-image').on('click', function() {
                                $('#banner_image').val('');
                                $('#image-preview-container').remove();
                            });
                        } else {
                            // Just update the existing preview
                            $('#image-preview').attr('src', e.target.result);
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Set default dates (current date for start and 7 days later for end)
            if (!$('#start_date').val()) {
                var now = new Date();
                var startDateStr = now.toISOString().slice(0, 16);
                $('#start_date').val(startDateStr);

                var endDate = new Date();
                endDate.setDate(endDate.getDate() + 7);
                var endDateStr = endDate.toISOString().slice(0, 16);
                $('#end_date').val(endDateStr);
            }

            // Disable submit button on form submit and show spinner
            $('form.form-validate').on('submit', function(e) {
                var $submitBtn = $(this).find('.submit-btn');
                if ($submitBtn.prop('disabled')) { // Prevent submission if button is disabled by our logic
                    e.preventDefault();
                    return false;
                }
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Creating...');

                // Let the form submit normally
                return true;
            });
        });
    </script>
@endsection
