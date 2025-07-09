@extends('layouts.app.admin')
@section('title', 'Seller Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Seller Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.sellers.index') }}">Sellers</a></li>
                                <li class="breadcrumb-item active">{{ $seller->name }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="{{ route('admin.sellers.index') }}"
                            class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                            <em class="icon ni ni-arrow-left"></em><span>Back</span>
                        </a>
                        <a href="{{ route('admin.sellers.index') }}"
                            class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none">
                            <em class="icon ni ni-arrow-left"></em>
                        </a>
                    </div>
                </div>
            </div>

            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-content">
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Personal Information</h5>
                                        <p>Basic info about the seller.</p>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Full Name</span>
                                                <span class="profile-ud-value">{{ $seller->name }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email</span>
                                                <span class="profile-ud-value">{{ $seller->email }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Phone Number</span>
                                                <span class="profile-ud-value">{{ $seller->phone ?? 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Address</span>
                                                <span
                                                    class="profile-ud-value">{{ $seller->address ?? 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Business Activity</span>
                                                <span class="profile-ud-value">
                                                    @if ($seller->businessActivity)
                                                        {{ $seller->businessActivity->name }}
                                                    @else
                                                        <em class="text-soft">No business activity assigned</em>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Status</span>
                                                <span class="profile-ud-value">
                                                    @if ($seller->status === 'active')
                                                        <span class="badge badge-dot bg-success">Active</span>
                                                    @elseif ($seller->status === 'pending')
                                                        <span class="badge badge-dot bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-dot bg-danger">Banned</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Joined</span>
                                                <span
                                                    class="profile-ud-value">{{ $seller->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email Verified</span>
                                                <span class="profile-ud-value">
                                                    @if ($seller->email_verified_at)
                                                        <span class="badge badge-dot bg-success">Verified</span>
                                                    @else
                                                        <span class="badge badge-dot bg-warning">Not Verified</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($seller->documents && $seller->documents->count() > 0)
                                    <div class="nk-divider divider md"></div>
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Documents</h5>
                                            <p>Uploaded documents by the seller.</p>
                                        </div>
                                        <div class="row gy-3">
                                            @foreach ($seller->documents as $document)
                                                <div class="col-lg-6">
                                                    <div class="card card-bordered">
                                                        <div class="card-inner">
                                                            <div class="project">
                                                                <div class="project-head">
                                                                    <div class="project-title">
                                                                        <h6 class="title">{{ $document->document_type }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="project-details">
                                                                    <p>Path: {{ $document->document_path }}</p>
                                                                    @if ($document->expiry_date)
                                                                        <p>Expires:
                                                                            {{ \Carbon\Carbon::parse($document->expiry_date)->format('d M Y') }}
                                                                        </p>
                                                                    @endif
                                                                    <p>Uploaded:
                                                                        {{ $document->created_at->format('d M Y') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($seller->products && $seller->products->count() > 0)
                                    <div class="nk-divider divider md"></div>
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Products</h5>
                                            <p>Products listed by this seller ({{ $seller->products->count() }} total).</p>
                                        </div>
                                        <div class="row gy-3">
                                            @foreach ($seller->products->take(6) as $product)
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="card card-bordered">
                                                        <div class="card-inner">
                                                            <div class="project">
                                                                <div class="project-head">
                                                                    <div class="project-title">
                                                                        <h6 class="title">
                                                                            {{ Str::limit($product->title, 30) }}</h6>
                                                                        @if ($product->category)
                                                                            <span
                                                                                class="badge badge-dim bg-light">{{ $product->category->name }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="project-details">
                                                                    <p>SKU: {{ $product->sku }}</p>
                                                                    <p>Price: ${{ number_format($product->price, 2) }}</p>
                                                                    <p>Stock: {{ $product->stock_quantity }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($seller->products->count() > 6)
                                            <div class="text-center mt-3">
                                                <span class="text-soft">And {{ $seller->products->count() - 6 }} more
                                                    products...</span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-lg"
                            data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true"
                            data-toggle-body="true">
                            <div class="card-inner-group" data-simplebar>
                                <div class="card-inner">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                            <span>{{ strtoupper(substr($seller->name, 0, 2)) }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ $seller->name }}</span>
                                            <span class="sub-text">{{ $seller->email }}</span>
                                        </div>
                                        <div class="user-action">
                                            <button type="button"
                                                class="btn btn-icon btn-trigger me-n2 edit-seller-button"
                                                data-id="{{ $seller->id }}" data-bs-toggle="tooltip"
                                                title="Edit Seller">
                                                <em class="icon ni ni-edit"></em>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="profile-stats">
                                                <span class="amount">{{ $seller->products->count() }}</span>
                                                <span class="sub-text">Products</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="profile-stats">
                                                <span class="amount">{{ $seller->documents->count() }}</span>
                                                <span class="sub-text">Documents</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="profile-stats">
                                                <span class="amount">{{ $seller->created_at->diffInDays() }}</span>
                                                <span class="sub-text">Days</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <h6 class="overline-title mb-2">Quick Actions</h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <button type="button"
                                                class="btn btn-white btn-dim btn-sm btn-block edit-seller-button"
                                                data-id="{{ $seller->id }}">
                                                <em class="icon ni ni-edit"></em>
                                                <span>Edit</span>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button"
                                                class="btn btn-white btn-dim btn-sm btn-block status-seller-button"
                                                data-bs-toggle="modal" data-bs-target="#statusSellerModal"
                                                data-id="{{ $seller->id }}" data-name="{{ $seller->name }}"
                                                data-current-status="{{ $seller->status }}"
                                                data-status-url="{{ route('admin.sellers.updateStatus', $seller->id) }}">
                                                <em class="icon ni ni-setting"></em>
                                                <span>Status</span>
                                            </button>
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

    <!-- Edit Seller Modal -->
    <div class="modal fade" id="editSellerModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Seller</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editSellerForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="edit-seller-name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-seller-name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-seller-email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="edit-seller-email" name="email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-seller-phone">Phone</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-seller-phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-seller-address">Address</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="edit-seller-address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-seller-business-activity">Business Activity</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="edit-seller-business-activity"
                                    name="business_activity_id">
                                    <option value="">No Business Activity</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-seller-status">Status</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="edit-seller-status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateSellerBtn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Seller</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the seller.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="statusSellerModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Change Seller Status</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change the status of <strong id="status-seller-name"></strong>?</p>
                    <p>Current status: <span id="current-status-display"></span></p>

                    <form action="" method="POST" id="statusSellerForm">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-label" for="new-status">New Status</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="new-status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-warning submit-btn" id="confirmStatusSellerBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Change Status</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Edit seller button click
            $(document).on('click', '.edit-seller-button', function() {
                var sellerId = $(this).data('id');
                var editModal = $('#editSellerModal');
                var editForm = $('#editSellerForm');
                var businessActivitySelect = $('#edit-seller-business-activity');

                editModal.find('.modal-body').addClass('loading');

                $.ajax({
                    url: `/admin/sellers/${sellerId}/edit-data`,
                    method: 'GET',
                    success: function(response) {
                        console.log('Edit data fetched:', response);
                        if (response.success) {
                            var seller = response.seller;
                            var businessActivities = response.businessActivities;

                            editForm.find('#edit-seller-name').val(seller.name);
                            editForm.find('#edit-seller-email').val(seller.email);
                            editForm.find('#edit-seller-phone').val(seller.phone);
                            editForm.find('#edit-seller-address').val(seller.address);
                            editForm.find('#edit-seller-status').val(seller.status);
                            editForm.attr('action', `/admin/sellers/${seller.id}`);

                            businessActivitySelect.empty().append(
                                '<option value="">No Business Activity</option>');
                            businessActivities.forEach(function(activity) {
                                const selected = activity.id == seller
                                    .business_activity_id ? ' selected' : '';
                                businessActivitySelect.append(
                                    `<option value="${activity.id}"${selected}>${activity.name}</option>`
                                );
                            });
                            businessActivitySelect.val(seller.business_activity_id || '');
                            businessActivitySelect.trigger('change');

                            editModal.find('.modal-body').removeClass('loading');
                            editModal.modal('show');
                        } else {
                            console.error('Error fetching seller data:', response.message);
                            alert('Could not load seller details. Please try again.');
                            editModal.find('.modal-body').removeClass('loading');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        alert('An error occurred while fetching seller data.');
                        editModal.find('.modal-body').removeClass('loading');
                    }
                });
            });

            // Status change button click
            $(document).on('click', '.status-seller-button', function() {
                console.log('Status seller button clicked');
                var sellerId = $(this).data('id');
                var name = $(this).data('name');
                var currentStatus = $(this).data('current-status');
                var statusUrl = $(this).data('status-url');

                console.log('Status data:', sellerId, name, currentStatus, statusUrl);

                $('#status-seller-name').text(name);
                $('#current-status-display').text(currentStatus.charAt(0).toUpperCase() + currentStatus
                    .slice(1));
                $('#statusSellerForm').attr('action', statusUrl);

                // Set the current status as selected and enable all options first
                var newStatusSelect = $('#new-status');
                newStatusSelect.find('option').prop('disabled', false);
                newStatusSelect.val(currentStatus);
            });

            // Confirm status change
            $('#confirmStatusSellerBtn').on('click', function() {
                var $this = $(this);
                var form = $('#statusSellerForm');

                console.log('Form action:', form.attr('action'));
                console.log('Form data:', form.serialize());

                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Changing...');

                form.submit();
            });

            // Form submissions
            $('#editSellerForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });

            // Reset status modal when closed
            $('#statusSellerModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#confirmStatusSellerBtn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Change Status');
                $('#statusSellerForm')[0].reset();
            });

            // Reset edit modal when closed
            $('#editSellerModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#updateSellerBtn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Update Seller');
                $('#editSellerForm')[0].reset();
                $(this).find('.modal-body').removeClass('loading');
            });
        });
    </script>
@endsection
