@extends('layouts.app.admin')
@section('title', 'Buyer Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Buyer Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.buyers.index') }}">Buyers</a></li>
                                <li class="breadcrumb-item active">{{ $buyer->name }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="{{ route('admin.buyers.index') }}"
                            class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                            <em class="icon ni ni-arrow-left"></em><span>Back</span>
                        </a>
                        <a href="{{ route('admin.buyers.index') }}"
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
                                        <p>Basic info about the buyer.</p>
                                    </div>
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Full Name</span>
                                                <span class="profile-ud-value">{{ $buyer->name }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email</span>
                                                <span class="profile-ud-value">{{ $buyer->email }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Phone Number</span>
                                                <span class="profile-ud-value">{{ $buyer->phone ?? 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Address</span>
                                                <span
                                                    class="profile-ud-value">{{ $buyer->address ?? 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Status</span>
                                                <span class="profile-ud-value">
                                                    @if (($buyer->status ?? 'active') === 'active')
                                                        <span class="badge badge-dot bg-success">Active</span>
                                                    @elseif ($buyer->status === 'suspended')
                                                        <span class="badge badge-dot bg-warning">Suspended</span>
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
                                                    class="profile-ud-value">{{ $buyer->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email Verified</span>
                                                <span class="profile-ud-value">
                                                    @if ($buyer->email_verified_at)
                                                        <span class="badge badge-dot bg-success">Verified</span>
                                                    @else
                                                        <span class="badge badge-dot bg-warning">Not Verified</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($buyer->orders && $buyer->orders->count() > 0)
                                    <div class="nk-divider divider md"></div>
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Recent Orders</h5>
                                            <p>Orders placed by this buyer ({{ $buyer->orders->count() }} total).</p>
                                        </div>
                                        <div class="row gy-3">
                                            @foreach ($buyer->orders->take(6) as $order)
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="card card-bordered">
                                                        <div class="card-inner">
                                                            <div class="project">
                                                                <div class="project-head">
                                                                    <div class="project-title">
                                                                        <h6 class="title">Order #{{ $order->id }}</h6>
                                                                        <span
                                                                            class="badge badge-dot bg-info">{{ $order->status }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="project-details">
                                                                    <p>Total: ${{ number_format($order->final_price, 2) }}
                                                                    </p>
                                                                    <p>Date: {{ $order->created_at->format('d M Y') }}</p>
                                                                    @if ($order->coupon)
                                                                        <p>Coupon: {{ $order->coupon->code }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($buyer->orders->count() > 6)
                                            <div class="text-center mt-3">
                                                <span class="text-soft">And {{ $buyer->orders->count() - 6 }} more
                                                    orders...</span>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if ($buyer->reviews && $buyer->reviews->count() > 0)
                                    <div class="nk-divider divider md"></div>
                                    <div class="nk-block">
                                        <div class="nk-block-head">
                                            <h5 class="title">Product Reviews</h5>
                                            <p>Reviews written by this buyer ({{ $buyer->reviews->count() }} total).</p>
                                        </div>
                                        <div class="row gy-3">
                                            @foreach ($buyer->reviews->take(6) as $review)
                                                <div class="col-lg-6">
                                                    <div class="card card-bordered">
                                                        <div class="card-inner">
                                                            <div class="project">
                                                                <div class="project-head">
                                                                    <div class="project-title">
                                                                        <h6 class="title">
                                                                            {{ Str::limit($review->product->title ?? 'Product', 30) }}
                                                                        </h6>
                                                                        <div class="rating">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($i <= $review->rating)
                                                                                    <span class="text-warning">★</span>
                                                                                @else
                                                                                    <span class="text-muted">☆</span>
                                                                                @endif
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="project-details">
                                                                    <p>{{ Str::limit($review->comment, 100) }}</p>
                                                                    <p class="text-muted small">
                                                                        {{ $review->created_at->format('d M Y') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($buyer->reviews->count() > 6)
                                            <div class="text-center mt-3">
                                                <span class="text-soft">And {{ $buyer->reviews->count() - 6 }} more
                                                    reviews...</span>
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
                                            <span>{{ strtoupper(substr($buyer->name, 0, 2)) }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ $buyer->name }}</span>
                                            <span class="sub-text">{{ $buyer->email }}</span>
                                        </div>
                                        <div class="user-action">
                                            <button type="button"
                                                class="btn btn-icon btn-trigger me-n2 edit-buyer-button"
                                                data-id="{{ $buyer->id }}" data-bs-toggle="tooltip"
                                                title="Edit Buyer">
                                                <em class="icon ni ni-edit"></em>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="profile-stats">
                                                <span class="amount">{{ $buyer->orders->count() }}</span>
                                                <span class="sub-text">Orders</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="profile-stats">
                                                <span class="amount">{{ $buyer->reviews->count() }}</span>
                                                <span class="sub-text">Reviews</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="profile-stats">
                                                <span class="amount">{{ $buyer->created_at->diffInDays() }}</span>
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
                                                class="btn btn-white btn-dim btn-sm btn-block edit-buyer-button"
                                                data-id="{{ $buyer->id }}">
                                                <em class="icon ni ni-edit"></em>
                                                <span>Edit</span>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button"
                                                class="btn btn-white btn-dim btn-sm btn-block status-buyer-button"
                                                data-bs-toggle="modal" data-bs-target="#statusBuyerModal"
                                                data-id="{{ $buyer->id }}" data-name="{{ $buyer->name }}"
                                                data-current-status="{{ $buyer->status ?? 'active' }}"
                                                data-status-url="{{ route('admin.buyers.updateStatus', $buyer->id) }}">
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

    <!-- Edit Buyer Modal -->
    <div class="modal fade" id="editBuyerModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Buyer</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editBuyerForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label" for="edit-buyer-name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-buyer-name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-buyer-email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="edit-buyer-email" name="email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-buyer-phone">Phone</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-buyer-phone" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-buyer-address">Address</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="edit-buyer-address" name="address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-buyer-status">Status</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="edit-buyer-status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="suspended">Suspended</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateBuyerBtn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Buyer</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the buyer.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="statusBuyerModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Change Buyer Status</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change the status of <strong id="status-buyer-name"></strong>?</p>
                    <p>Current status: <span id="current-status-display"></span></p>

                    <form action="" method="POST" id="statusBuyerForm">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label class="form-label" for="new-status">New Status</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="new-status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="suspended">Suspended</option>
                                    <option value="banned">Banned</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-warning submit-btn" id="confirmStatusBuyerBtn">
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
            // Edit buyer button click
            $(document).on('click', '.edit-buyer-button', function() {
                var buyerId = $(this).data('id');
                var editModal = $('#editBuyerModal');
                var editForm = $('#editBuyerForm');

                editModal.find('.modal-body').addClass('loading');

                $.ajax({
                    url: `/admin/buyers/${buyerId}/edit-data`,
                    method: 'GET',
                    success: function(response) {
                        console.log('Edit data fetched:', response);
                        if (response.success) {
                            var buyer = response.buyer;

                            editForm.find('#edit-buyer-name').val(buyer.name);
                            editForm.find('#edit-buyer-email').val(buyer.email);
                            editForm.find('#edit-buyer-phone').val(buyer.phone);
                            editForm.find('#edit-buyer-address').val(buyer.address);
                            editForm.find('#edit-buyer-status').val(buyer.status || 'active');
                            editForm.attr('action', `/admin/buyers/${buyer.id}`);

                            editModal.find('.modal-body').removeClass('loading');
                            editModal.modal('show');
                        } else {
                            console.error('Error fetching buyer data:', response.message);
                            alert('Could not load buyer details. Please try again.');
                            editModal.find('.modal-body').removeClass('loading');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        alert('An error occurred while fetching buyer data.');
                        editModal.find('.modal-body').removeClass('loading');
                    }
                });
            });

            // Status change button click
            $(document).on('click', '.status-buyer-button', function() {
                console.log('Status buyer button clicked');
                var buyerId = $(this).data('id');
                var name = $(this).data('name');
                var currentStatus = $(this).data('current-status');
                var statusUrl = $(this).data('status-url');

                console.log('Status data:', buyerId, name, currentStatus, statusUrl);

                $('#status-buyer-name').text(name);
                $('#current-status-display').text(currentStatus.charAt(0).toUpperCase() + currentStatus
                    .slice(1));
                $('#statusBuyerForm').attr('action', statusUrl);

                // Set the current status as selected and enable all options first
                var newStatusSelect = $('#new-status');
                newStatusSelect.find('option').prop('disabled', false);
                newStatusSelect.val(currentStatus);
            });

            // Confirm status change
            $('#confirmStatusBuyerBtn').on('click', function() {
                var $this = $(this);
                var form = $('#statusBuyerForm');

                console.log('Form action:', form.attr('action'));
                console.log('Form data:', form.serialize());

                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Changing...');

                form.submit();
            });

            // Form submissions
            $('#editBuyerForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });

            // Reset status modal when closed
            $('#statusBuyerModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#confirmStatusBuyerBtn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Change Status');
                $('#statusBuyerForm')[0].reset();
            });

            // Reset edit modal when closed
            $('#editBuyerModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#updateBuyerBtn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Update Buyer');
                $('#editBuyerForm')[0].reset();
                $(this).find('.modal-body').removeClass('loading');
            });
        });
    </script>
@endsection
