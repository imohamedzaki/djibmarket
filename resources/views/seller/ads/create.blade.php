@extends('layouts.app.seller')
@section('title', 'Create Advertisement')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Create Advertisement</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.ads.index') }}">Advertisements</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            {{-- Session Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Advertisement Details</h5>
                    </div>
                    <div class="card-inner">
                        <form action="{{ route('seller.ads.store') }}" method="POST" enctype="multipart/form-data"
                            id="ad-form">
                            @csrf

                            <!-- Basic Information -->
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="Enter advertisement title" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="ad_slot">Ad Slot <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="ad_slot" name="ad_slot" required>
                                            <option value="">Select Ad Slot</option>
                                            @foreach (\App\Models\SellerAd::AD_SLOTS as $slot => $displayName)
                                                <option value="{{ $slot }}"
                                                    {{ old('ad_slot') == $slot ? 'selected' : '' }}>
                                                    {{ $displayName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            placeholder="Describe your advertisement...">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Duration and Pricing -->
                            <div class="row g-4 mt-3">
                                <div class="col-12">
                                    <h6>Duration & Pricing</h6>
                                    <div class="form-group">
                                        <label class="form-label">Duration Type <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="duration_date"
                                                        name="duration_type" value="date_range"
                                                        {{ old('duration_type') == 'date_range' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="duration_date">Specific
                                                        Dates</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="duration_days"
                                                        name="duration_type" value="duration_days"
                                                        {{ old('duration_type', 'duration_days') == 'duration_days' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="duration_days">Number of
                                                        Days</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="duration_views"
                                                        name="duration_type" value="views_based"
                                                        {{ old('duration_type') == 'views_based' ? 'checked' : '' }}>
                                                    <label class="custom-control-label"
                                                        for="duration_views">View-Based</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Range Fields -->
                            <div class="row g-4 duration-fields" id="date-range-fields" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="start_date">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="end_date">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ old('end_date') }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="daily_budget">Daily Budget (DJF)</label>
                                        <input type="number" class="form-control" id="daily_budget" name="daily_budget"
                                            value="{{ old('daily_budget', 5000) }}" placeholder="5000" step="500"
                                            min="1000">
                                        <div class="form-note">Default: 5,000 DJF per day</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Duration Days Fields -->
                            <div class="row g-4 duration-fields" id="duration-days-fields">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="duration_days_input">Number of Days</label>
                                        <input type="number" class="form-control" id="duration_days_input"
                                            name="duration_days" value="{{ old('duration_days', 7) }}" placeholder="7"
                                            min="1" max="365">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="daily_budget_days">Daily Budget (DJF)</label>
                                        <input type="number" class="form-control" id="daily_budget_days"
                                            name="daily_budget" value="{{ old('daily_budget', 5000) }}"
                                            placeholder="5000" step="500" min="1000">
                                        <div class="form-note">Default: 5,000 DJF per day</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Views Based Fields -->
                            <div class="row g-4 duration-fields" id="views-based-fields" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="max_views">Maximum Views</label>
                                        <input type="number" class="form-control" id="max_views" name="max_views"
                                            value="{{ old('max_views') }}" placeholder="1000" min="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="cost_per_view">Cost per View (DJF)</label>
                                        <input type="number" class="form-control" id="cost_per_view"
                                            name="cost_per_view" value="{{ old('cost_per_view', 2.5) }}"
                                            placeholder="2.5" step="0.5" min="1">
                                        <div class="form-note">Default: 2.5 DJF per view</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Settings -->
                            <div class="row g-4 mt-3">
                                <div class="col-12">
                                    <h6>Additional Settings</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="max_clicks">Maximum Clicks (Optional)</label>
                                        <input type="number" class="form-control" id="max_clicks" name="max_clicks"
                                            value="{{ old('max_clicks') }}" placeholder="Leave empty for unlimited">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="target_url">Target URL (Optional)</label>
                                        <input type="url" class="form-control" id="target_url" name="target_url"
                                            value="{{ old('target_url') }}" placeholder="https://example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="button_text">Button Text (Optional)</label>
                                        <input type="text" class="form-control" id="button_text" name="button_text"
                                            value="{{ old('button_text') }}" placeholder="Learn More">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="image">Advertisement Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            accept="image/*">
                                        <div class="form-note">JPEG, PNG, GIF up to 2MB</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customization -->
                            <div class="row g-4 mt-3">
                                <div class="col-12">
                                    <h6>Color Customization</h6>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="primary_color">Primary Color</label>
                                        <input type="color" class="form-control" id="primary_color"
                                            name="primary_color" value="{{ old('primary_color', '#007bff') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="secondary_color">Secondary Color</label>
                                        <input type="color" class="form-control" id="secondary_color"
                                            name="secondary_color" value="{{ old('secondary_color', '#6c757d') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="text_color">Text Color</label>
                                        <input type="color" class="form-control" id="text_color" name="text_color"
                                            value="{{ old('text_color', '#ffffff') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="background_color">Background Color</label>
                                        <input type="color" class="form-control" id="background_color"
                                            name="background_color" value="{{ old('background_color', '#f8f9fa') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Estimated Cost -->
                            <div class="row g-4 mt-3">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h6>Estimated Cost: <span id="estimated-cost">35,000</span> DJF</h6>
                                        <p class="mb-0">This is an estimate based on your selected duration and pricing
                                            model. Final cost may vary based on actual performance.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                                        id="submit-spinner" style="display: none;"></span>
                                    <em class="icon ni ni-check" id="submit-icon"></em>
                                    <span id="submit-text">Submit for Review</span>
                                </button>
                                <a href="{{ route('seller.ads.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em><span>Cancel</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const durationRadios = document.querySelectorAll('input[name="duration_type"]');
                const durationFields = document.querySelectorAll('.duration-fields');
                const form = document.getElementById('ad-form');
                const submitBtn = document.getElementById('submit-btn');
                const submitSpinner = document.getElementById('submit-spinner');
                const submitIcon = document.getElementById('submit-icon');
                const submitText = document.getElementById('submit-text');

                function updateDurationFields() {
                    // Hide all duration fields
                    durationFields.forEach(field => field.style.display = 'none');

                    // Show relevant fields based on selection
                    const selectedType = document.querySelector('input[name="duration_type"]:checked');
                    if (selectedType) {
                        let fieldId;
                        if (selectedType.value === 'date_range') {
                            fieldId = 'date-range-fields';
                        } else if (selectedType.value === 'duration_days') {
                            fieldId = 'duration-days-fields';
                        } else if (selectedType.value === 'views_based') {
                            fieldId = 'views-based-fields';
                        }

                        if (fieldId) {
                            const targetField = document.getElementById(fieldId);
                            if (targetField) {
                                targetField.style.display = 'block';
                            }
                        }
                    }

                    updateEstimatedCost();
                }

                function updateEstimatedCost() {
                    const selectedType = document.querySelector('input[name="duration_type"]:checked');
                    let cost = 0;

                    if (selectedType) {
                        if (selectedType.value === 'date_range') {
                            const startDate = document.getElementById('start_date').value;
                            const endDate = document.getElementById('end_date').value;
                            const dailyBudget = parseFloat(document.getElementById('daily_budget').value) || 5000;

                            if (startDate && endDate) {
                                const start = new Date(startDate);
                                const end = new Date(endDate);
                                const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                                cost = days * dailyBudget;
                            }
                        } else if (selectedType.value === 'duration_days') {
                            const days = parseInt(document.getElementById('duration_days_input').value) || 7;
                            const dailyBudget = parseFloat(document.getElementById('daily_budget_days').value) || 5000;
                            cost = days * dailyBudget;
                        } else if (selectedType.value === 'views_based') {
                            const maxViews = parseInt(document.getElementById('max_views').value) || 1000;
                            const costPerView = parseFloat(document.getElementById('cost_per_view').value) || 2.5;
                            cost = maxViews * costPerView;
                        }
                    }

                    document.getElementById('estimated-cost').textContent = cost.toLocaleString();
                }

                // Event listeners for duration type changes
                durationRadios.forEach(radio => {
                    radio.addEventListener('change', updateDurationFields);
                });

                // Cost calculation listeners
                ['start_date', 'end_date', 'daily_budget', 'duration_days_input', 'daily_budget_days', 'max_views',
                    'cost_per_view'
                ].forEach(id => {
                    const element = document.getElementById(id);
                    if (element) {
                        element.addEventListener('input', updateEstimatedCost);
                    }
                });

                // Form submission with loading state
                form.addEventListener('submit', function(e) {
                    // Disable submit button and show spinner
                    submitBtn.disabled = true;
                    submitSpinner.style.display = 'inline-block';
                    submitIcon.style.display = 'none';
                    submitText.textContent = 'Submitting...';

                    // Remove required attributes to prevent HTML5 validation errors
                    const requiredFields = form.querySelectorAll('[required]');
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            field.removeAttribute('required');
                        }
                    });
                });

                // Initialize on page load
                updateDurationFields();
            });
        </script>
    @endpush
@endsection
