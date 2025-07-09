@extends('layouts.app.admin')
@section('title', 'Ads Company Details')

@section('css')
    <style>
        /* Logo preview styles can be added here if needed */
    </style>
@endsection

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Ads Company Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.ads-companies.index') }}">Ads
                                        Companies</a></li>
                                <li class="breadcrumb-item active">{{ $adsCompany->name }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="{{ route('admin.ads-companies.index') }}"
                            class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                            <em class="icon ni ni-arrow-left"></em><span>Back to List</span>
                        </a>
                        <a href="{{ route('admin.ads-companies.index') }}"
                            class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none">
                            <em class="icon ni ni-arrow-left"></em>
                        </a>
                    </div>
                </div>
            </div>

            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">{{ $adsCompany->name }}</h4>
                                        <div class="nk-block-des">
                                            <p>Company advertisement details and information.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                            data-target="userAside">
                                            <em class="icon ni ni-menu-alt-r"></em>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row gy-5">
                                <div class="col-lg-8">
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">General Information</h5>
                                        </div>
                                        <div class="profile-ud-list">
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Company Name</span>
                                                    <span class="profile-ud-value">{{ $adsCompany->name }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Company Link</span>
                                                    <span class="profile-ud-value">
                                                        @if ($adsCompany->link)
                                                            <a href="{{ $adsCompany->link }}" target="_blank"
                                                                class="text-primary">{{ $adsCompany->link }}</a>
                                                        @else
                                                            <span class="text-muted">No link provided</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Campaign Duration</span>
                                                    <span class="profile-ud-value">
                                                        {{ $adsCompany->start_date->format('M d, Y') }} -
                                                        {{ $adsCompany->end_date->format('M d, Y') }}
                                                        <span
                                                            class="text-muted">({{ $adsCompany->start_date->diffInDays($adsCompany->end_date) + 1 }}
                                                            days)</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Status</span>
                                                    <span class="profile-ud-value">
                                                        @if ($adsCompany->is_currently_active)
                                                            <span class="badge badge-dot bg-success">Active</span>
                                                        @elseif($adsCompany->is_active && now()->toDateString() < $adsCompany->start_date->toDateString())
                                                            <span class="badge badge-dot bg-warning">Scheduled</span>
                                                        @elseif($adsCompany->is_active && now()->toDateString() > $adsCompany->end_date->toDateString())
                                                            <span
                                                                class="badge badge-dim bg-outline-secondary">Expired</span>
                                                        @else
                                                            <span class="badge badge-dim bg-outline-danger">Inactive</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Associated Seller</span>
                                                    <span class="profile-ud-value">
                                                        @if ($adsCompany->seller)
                                                            <a href="{{ route('admin.sellers.show', $adsCompany->seller->id) }}"
                                                                class="text-primary">{{ $adsCompany->seller->name }}</a>
                                                        @else
                                                            <span class="text-muted">No seller associated</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Created Date</span>
                                                    <span
                                                        class="profile-ud-value">{{ $adsCompany->created_at->format('M d, Y \a\t h:i A') }}</span>
                                                </div>
                                            </div>
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Last Updated</span>
                                                    <span
                                                        class="profile-ud-value">{{ $adsCompany->updated_at->format('M d, Y \a\t h:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($adsCompany->logo)
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <h5 class="title">Company Logo</h5>
                                            </div>
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="text-center">
                                                        <img src="{{ asset('storage/' . $adsCompany->logo) }}"
                                                            alt="{{ $adsCompany->name }}" class="img-fluid"
                                                            style="max-width: 300px; max-height: 200px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-4">
                                    <div class="card card-bordered">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="user-card user-card-s2">
                                                    <div class="user-avatar lg bg-primary">
                                                        @if ($adsCompany->logo)
                                                            <img src="{{ asset('storage/' . $adsCompany->logo) }}"
                                                                alt="{{ $adsCompany->name }}">
                                                        @else
                                                            <span>{{ strtoupper(substr($adsCompany->name, 0, 2)) }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="user-info">
                                                        <h5>{{ $adsCompany->name }}</h5>
                                                        <span class="sub-text">Ads Company</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-inner card-inner-sm">
                                                <ul class="btn-toolbar justify-center gx-1">
                                                    <li>
                                                        <button type="button"
                                                            class="btn btn-trigger btn-icon edit-adscompany-button"
                                                            data-id="{{ $adsCompany->id }}" title="Edit Ads Company">
                                                            <em class="icon ni ni-edit"></em>
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button type="button"
                                                            class="btn btn-trigger btn-icon text-danger delete-adscompany-button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteAdsCompanyModal"
                                                            data-id="{{ $adsCompany->id }}"
                                                            data-name="{{ $adsCompany->name }}"
                                                            data-delete-url="{{ route('admin.ads-companies.destroy', $adsCompany->id) }}"
                                                            title="Delete Ads Company">
                                                            <em class="icon ni ni-trash"></em>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <h6 class="title">Quick Stats</h6>
                                            <ul class="list-status">
                                                <li>
                                                    <span
                                                        class="lead text-primary">{{ $adsCompany->start_date->diffInDays($adsCompany->end_date) + 1 }}</span>
                                                    <span class="sub-text">Total Campaign Days</span>
                                                </li>
                                                @if (now()->toDateString() >= $adsCompany->start_date->toDateString() &&
                                                        now()->toDateString() <= $adsCompany->end_date->toDateString())
                                                    <li>
                                                        <span
                                                            class="lead text-success">{{ now()->diffInDays($adsCompany->end_date) }}</span>
                                                        <span class="sub-text">Days Remaining</span>
                                                    </li>
                                                @elseif(now()->toDateString() < $adsCompany->start_date->toDateString())
                                                    <li>
                                                        <span
                                                            class="lead text-warning">{{ now()->diffInDays($adsCompany->start_date) }}</span>
                                                        <span class="sub-text">Days Until Start</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <span
                                                            class="lead text-secondary">{{ $adsCompany->end_date->diffInDays(now()) }}</span>
                                                        <span class="sub-text">Days Since Expired</span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Ads Company Modal (same as in index) -->
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

    <!-- Edit Ads Company Modal (simplified for show page) -->
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
                    <form action="{{ route('admin.ads-companies.update', $adsCompany->id) }}" method="POST"
                        id="editAdsCompanyForm" class="form-validate is-alter" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-name">Company Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="edit-company-name" name="name"
                                            value="{{ $adsCompany->name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-link">Company Link</label>
                                    <div class="form-control-wrap">
                                        <input type="url" class="form-control" id="edit-company-link" name="link"
                                            value="{{ $adsCompany->link }}" placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-start-date">Start Date</label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control" id="edit-company-start-date"
                                            name="start_date" value="{{ $adsCompany->start_date->format('Y-m-d') }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-company-end-date">End Date</label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control" id="edit-company-end-date"
                                            name="end_date" value="{{ $adsCompany->end_date->format('Y-m-d') }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-company-seller">Associated Seller</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="edit-company-seller" name="seller_id">
                                    <option value="">No Seller</option>
                                    @foreach (\App\Models\Seller::where('status', 'active')->orderBy('name')->get() as $seller)
                                        <option value="{{ $seller->id }}"
                                            {{ $adsCompany->seller_id == $seller->id ? 'selected' : '' }}>
                                            {{ $seller->name }}
                                        </option>
                                    @endforeach
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
                                @if ($adsCompany->logo)
                                    <div class="mt-2">
                                        <small class="text-muted">Current Logo:</small>
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            <img src="{{ asset('storage/' . $adsCompany->logo) }}" alt="Current Logo"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                            <span class="text-muted">Upload a new image to replace the current logo</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="edit-company-is-active"
                                    name="is_active" {{ $adsCompany->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="edit-company-is-active">Active</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateAdsCompanyBtn">
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Edit button click
            $('.edit-adscompany-button').on('click', function() {
                $('#editAdsCompanyModal').modal('show');
            });

            // Delete button click
            $('.delete-adscompany-button').on('click', function() {
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-adscompany-name').text(name);
                $('#deleteAdsCompanyForm').attr('action', deleteUrl);
            });

            // Confirm delete button
            $('#confirmDeleteAdsCompanyBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteAdsCompanyForm').submit();
            });

            // Form submit handler
            $('#editAdsCompanyForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });
        });
    </script>
@endsection
