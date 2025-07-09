@extends('layouts.app.admin')
@section('title', 'Ads Companies Management')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Ads Companies Management</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Ads Companies</li>
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
                                            data-bs-target="#addAdsCompanyModal">
                                            <em class="icon ni ni-plus"></em><span>Add Ads Company</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Session Messages --}}
            @include('layouts.app.partials.admin.session-messages')

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Ads Companies</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage company advertisements.</p>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Company Name</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Logo</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Duration</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Seller</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end">
                                        <span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($adsCompanies as $adsCompany)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                        $isCurrentlyActive = $adsCompany->is_currently_active;
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="adscompany-{{ $adsCompany->id }}">
                                                <label class="custom-control-label"
                                                    for="adscompany-{{ $adsCompany->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($adsCompany->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $adsCompany->name }}</span>
                                                    @if ($adsCompany->link)
                                                        <span class="tb-sub"><a href="{{ $adsCompany->link }}"
                                                                target="_blank"
                                                                class="text-primary">{{ Str::limit($adsCompany->link, 30) }}</a></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($adsCompany->logo)
                                                <div class="user-avatar bg-light logo-preview-container"
                                                    data-logo-src="{{ asset('storage/' . $adsCompany->logo) }}">
                                                    <img src="{{ asset('storage/' . $adsCompany->logo) }}"
                                                        alt="{{ $adsCompany->name }}" class="logo-thumbnail"
                                                        style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;">
                                                </div>
                                            @else
                                                <span class="text-muted">No Logo</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead">{{ $adsCompany->start_date->format('M d, Y') }}</span>
                                            <span class="tb-sub text-muted">to
                                                {{ $adsCompany->end_date->format('M d, Y') }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            @if ($adsCompany->seller)
                                                <span
                                                    class="badge badge-dot bg-primary">{{ $adsCompany->seller->name }}</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Seller</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($isCurrentlyActive)
                                                <span class="badge badge-dot bg-success">Active</span>
                                            @elseif($adsCompany->is_active && now()->toDateString() < $adsCompany->start_date->toDateString())
                                                <span class="badge badge-dot bg-warning">Scheduled</span>
                                            @elseif($adsCompany->is_active && now()->toDateString() > $adsCompany->end_date->toDateString())
                                                <span class="badge badge-dim bg-outline-secondary">Expired</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.ads-companies.show', $adsCompany->id) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-adscompany-button"
                                                        data-bs-toggle="modal" data-id="{{ $adsCompany->id }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-adscompany-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteAdsCompanyModal"
                                                        data-id="{{ $adsCompany->id }}"
                                                        data-name="{{ $adsCompany->name }}"
                                                        data-delete-url="{{ route('admin.ads-companies.destroy', $adsCompany->id) }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @empty
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" disabled>
                                                <label class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col text-center">
                                            <span class="text-soft">No ads companies found.</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md"></td>
                                        <td class="nk-tb-col tb-col-lg"></td>
                                        <td class="nk-tb-col tb-col-lg"></td>
                                        <td class="nk-tb-col tb-col-md"></td>
                                        <td class="nk-tb-col nk-tb-col-tools"></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div> <!-- nk-block -->
        </div>
    </div>

    <!-- Add Ads Company Modal -->
    <div class="modal fade" id="addAdsCompanyModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Ads Company</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.ads-companies.store') }}" method="POST"
                        class="form-validate is-alter" id="addAdsCompanyForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="company-name">Company Name <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control required-field" id="company-name"
                                            name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="company-link">Company Link</label>
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="company-link" name="link"
                                            placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="company-start-date">Start Date <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control required-field" id="company-start-date"
                                            name="start_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="company-end-date">End Date <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control required-field" id="company-end-date"
                                            name="end_date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="add-company-seller">Associated Seller</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="add-company-seller" name="seller_id">
                                    <option value="">No Seller</option>
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="company-logo">Company Logo</label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="company-logo" name="logo"
                                        accept="image/*">
                                    <label class="form-file-label" for="company-logo">Choose Logo</label>
                                </div>
                                <small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, GIF, SVG (max
                                    2MB)</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="company-is-active"
                                    name="is_active" checked>
                                <label class="custom-control-label" for="company-is-active">Active</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="addAdsCompanyBtn"
                                disabled>
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Save Ads Company</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Enter the details for the new ads company.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Ads Company Modal -->
    <div class="modal fade" id="editAdsCompanyModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Ads Company</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editAdsCompanyForm" class="form-validate is-alter"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-name">Company Name <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control required-field" id="edit-company-name"
                                            name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-link">Company Link</label>
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="edit-company-link" name="link"
                                            placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-start-date">Start Date <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control required-field"
                                            id="edit-company-start-date" name="start_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-end-date">End Date <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control required-field"
                                            id="edit-company-end-date" name="end_date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-company-seller">Associated Seller</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="edit-company-seller" name="seller_id">
                                    <option value="">No Seller</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-company-logo">Company Logo</label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="edit-company-logo" name="logo"
                                        accept="image/*">
                                    <label class="form-file-label" for="edit-company-logo">Choose New Logo</label>
                                </div>
                                <small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, GIF, SVG (max
                                    2MB)</small>
                                <div id="current-logo-container" class="mt-2" style="display: none;">
                                    <small class="text-muted">Current Logo:</small>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <div class="logo-preview-container" data-logo-src="">
                                            <img id="current-logo-preview" src="" alt="Current Logo"
                                                class="logo-thumbnail"
                                                style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;">
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            id="delete-current-logo-btn">
                                            <em class="icon ni ni-trash"></em> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="edit-company-is-active"
                                    name="is_active">
                                <label class="custom-control-label" for="edit-company-is-active">Active</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateAdsCompanyBtn"
                                disabled>
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Ads Company</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the ads company.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Ads Company Modal -->
    <div class="modal fade" id="deleteAdsCompanyModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Ads Company</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-adscompany-name"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteAdsCompanyForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteAdsCompanyBtn">
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
        /* Logo Preview Styles */
        .logo-preview-container {
            position: relative;
            display: inline-block;
        }

        .logo-preview-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .logo-preview-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }

        .logo-preview-overlay.show .logo-preview-content {
            transform: scale(1);
        }

        .logo-preview-image {
            max-width: 100%;
            max-height: 70vh;
            object-fit: contain;
            border-radius: 4px;
        }

        .logo-preview-close {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .logo-preview-close:hover {
            background: #c0392b;
        }

        .logo-preview-info {
            margin-top: 15px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        /* Hover effect for thumbnails */
        .logo-thumbnail {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .logo-thumbnail:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let currentAdsCompanyId = null;

            // Logo Preview Functionality
            function initLogoPreview() {
                // Create overlay element if it doesn't exist
                if (!$('#logoPreviewOverlay').length) {
                    $('body').append(`
                        <div id="logoPreviewOverlay" class="logo-preview-overlay">
                            <div class="logo-preview-content" onclick="event.stopPropagation()">
                                <button class="logo-preview-close" onclick="closeLogoPreview()">&times;</button>
                                <img id="logoPreviewImage" class="logo-preview-image" src="" alt="Logo Preview">
                                <div class="logo-preview-info">
                                    <span id="logoPreviewName"></span>
                                </div>
                            </div>
                        </div>
                    `);
                }

                // Add click event to logo thumbnails
                $(document).on('click', '.logo-thumbnail', function() {
                    const container = $(this).closest('.logo-preview-container');
                    const logoSrc = container.data('logo-src');
                    const companyName = $(this).attr('alt');

                    showLogoPreview(logoSrc, companyName);
                });

                // Close overlay when clicking outside
                $(document).on('click', '#logoPreviewOverlay', function() {
                    closeLogoPreview();
                });

                // Close with Escape key
                $(document).on('keydown', function(e) {
                    if (e.key === 'Escape') {
                        closeLogoPreview();
                    }
                });
            }

            // Show logo preview
            window.showLogoPreview = function(logoSrc, companyName) {
                $('#logoPreviewImage').attr('src', logoSrc);
                $('#logoPreviewName').text(companyName + ' Logo');
                $('#logoPreviewOverlay').css('display', 'flex').addClass('show');
                $('body').css('overflow', 'hidden'); // Prevent background scrolling
            };

            // Close logo preview
            window.closeLogoPreview = function() {
                $('#logoPreviewOverlay').removeClass('show');
                setTimeout(() => {
                    $('#logoPreviewOverlay').css('display', 'none');
                    $('body').css('overflow', ''); // Restore scrolling
                }, 300);
            };

            // Initialize logo preview
            initLogoPreview();

            // Function to validate required fields and enable/disable submit button
            function validateForm(formId) {
                var form = $('#' + formId);
                var submitBtn = form.find('.submit-btn');
                var allValid = true;

                form.find('.required-field').each(function() {
                    if ($(this).val().trim() === '') {
                        allValid = false;
                        return false; // break out of each loop
                    }
                });

                // Additional date validation for end date >= start date
                var startDate = form.find('input[name="start_date"]').val();
                var endDate = form.find('input[name="end_date"]').val();

                if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
                    allValid = false;
                }

                submitBtn.prop('disabled', !allValid);
                return allValid;
            }

            // Validate forms on input change
            $(document).on('input change', '.required-field', function() {
                var formId = $(this).closest('form').attr('id');
                validateForm(formId);
            });

            // Validate date fields specifically
            $(document).on('change', 'input[name="start_date"], input[name="end_date"]', function() {
                var formId = $(this).closest('form').attr('id');
                validateForm(formId);

                // Show validation message for date range
                var form = $('#' + formId);
                var startDate = form.find('input[name="start_date"]').val();
                var endDate = form.find('input[name="end_date"]').val();

                if (startDate && endDate && new Date(endDate) < new Date(startDate)) {
                    $(this).addClass('is-invalid');
                    if (!$(this).next('.invalid-feedback').length) {
                        $(this).after(
                            '<div class="invalid-feedback">End date must be after start date</div>');
                    }
                } else {
                    form.find('input[name="start_date"], input[name="end_date"]').removeClass('is-invalid');
                    form.find('.invalid-feedback').remove();
                }
            });

            // Initialize form validation when modals are shown
            $('#addAdsCompanyModal').on('shown.bs.modal', function() {
                validateForm('addAdsCompanyForm');
            });

            $('#editAdsCompanyModal').on('shown.bs.modal', function() {
                validateForm('editAdsCompanyForm');
            });

            // Edit Ads Company Button Click
            $(document).on('click', '.edit-adscompany-button', function() {
                var adsCompanyId = $(this).data('id');
                currentAdsCompanyId = adsCompanyId;
                var editModal = $('#editAdsCompanyModal');
                var editForm = $('#editAdsCompanyForm');
                var sellerSelect = $('#edit-company-seller');

                editModal.find('.modal-body').addClass('loading');

                $.ajax({
                    url: `/admin/ads-companies/${adsCompanyId}/edit-data`,
                    method: 'GET',
                    success: function(response) {
                        console.log('Edit data fetched:', response);
                        if (response.success) {
                            var adsCompany = response.adsCompany;
                            var sellers = response.sellers;

                            editForm.find('#edit-company-name').val(adsCompany.name);
                            editForm.find('#edit-company-link').val(adsCompany.link);
                            editForm.find('#edit-company-start-date').val(adsCompany
                                .start_date);
                            editForm.find('#edit-company-end-date').val(adsCompany.end_date);
                            editForm.find('#edit-company-is-active').prop('checked', adsCompany
                                .is_active);
                            editForm.attr('action', `/admin/ads-companies/${adsCompany.id}`);

                            // Populate sellers dropdown
                            sellerSelect.empty().append('<option value="">No Seller</option>');
                            sellers.forEach(function(seller) {
                                const selected = seller.id == adsCompany.seller_id ?
                                    ' selected' : '';
                                sellerSelect.append(
                                    `<option value="${seller.id}"${selected}>${seller.name}</option>`
                                );
                            });
                            sellerSelect.val(adsCompany.seller_id || '');
                            sellerSelect.trigger('change');

                            // Handle current logo
                            var logoContainer = $('#current-logo-container');
                            var logoPreview = $('#current-logo-preview');
                            var logoPreviewContainer = logoContainer.find(
                                '.logo-preview-container');

                            if (adsCompany.logo) {
                                const logoUrl = `/storage/${adsCompany.logo}`;
                                logoPreview.attr('src', logoUrl);
                                logoPreviewContainer.attr('data-logo-src', logoUrl);
                                logoContainer.show();
                            } else {
                                logoContainer.hide();
                            }

                            editModal.find('.modal-body').removeClass('loading');

                            // Validate form after populating data
                            setTimeout(function() {
                                validateForm('editAdsCompanyForm');
                                editModal.modal('show');
                            }, 100);
                        } else {
                            console.error('Error fetching ads company data:', response.message);
                            alert('Could not load ads company details. Please try again.');
                            editModal.find('.modal-body').removeClass('loading');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        alert('An error occurred while fetching ads company data.');
                        editModal.find('.modal-body').removeClass('loading');
                    }
                });
            });

            // Delete Current Logo Button
            $(document).on('click', '#delete-current-logo-btn', function() {
                if (currentAdsCompanyId && confirm('Are you sure you want to delete the current logo?')) {
                    $.ajax({
                        url: `/admin/ads-companies/${currentAdsCompanyId}/delete-logo`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#current-logo-container').hide();
                                alert('Logo deleted successfully!');
                            }
                        },
                        error: function() {
                            alert('Error deleting logo.');
                        }
                    });
                }
            });

            // Delete Ads Company Button Click
            $(document).on('click', '.delete-adscompany-button', function() {
                console.log('Delete ads company button clicked');
                var adsCompanyId = $(this).data('id');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                console.log('Delete data:', adsCompanyId, name, deleteUrl);

                $('#delete-adscompany-name').text(name);
                $('#deleteAdsCompanyForm').attr('action', deleteUrl);
            });

            // Confirm Delete Button
            $('#confirmDeleteAdsCompanyBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteAdsCompanyForm').submit();
            });

            // Form Submit Handlers
            $('#addAdsCompanyForm, #editAdsCompanyForm').on('submit', function(e) {
                var formId = $(this).attr('id');
                if (!validateForm(formId)) {
                    e.preventDefault();
                    alert('Please fill in all required fields correctly.');
                    return false;
                }

                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');

                if (formId === 'addAdsCompanyForm') {
                    $submitBtn.find('.btn-text').text('Saving...');
                } else if (formId === 'editAdsCompanyForm') {
                    $submitBtn.find('.btn-text').text('Updating...');
                }
                return true;
            });
        });
    </script>
@endsection
