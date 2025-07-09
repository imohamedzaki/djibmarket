@extends('layouts.app.admin')
@section('title', 'List of Sellers')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Sellers Management</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Sellers</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Sellers</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage sellers.</p>
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
                                    <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Email</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Business Activity</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($sellers as $seller)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="seller-{{ $seller->id }}">
                                                <label class="custom-control-label"
                                                    for="seller-{{ $seller->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($seller->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $seller->name }}</span>
                                                    <span class="tb-sub">ID: {{ $seller->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $seller->email }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $seller->phone ?? 'N/A' }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            @if ($seller->businessActivity)
                                                <span
                                                    class="badge badge-dot bg-primary">{{ $seller->businessActivity->name }}</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Activity</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($seller->status === 'active')
                                                <span class="badge badge-dot bg-success">Active</span>
                                            @elseif ($seller->status === 'pending')
                                                <span class="badge badge-dot bg-warning">Pending</span>
                                            @else
                                                <span class="badge badge-dot bg-danger">Banned</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.sellers.show', $seller->id) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-seller-button"
                                                        data-bs-toggle="modal" data-id="{{ $seller->id }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-warning status-seller-button"
                                                        data-bs-toggle="modal" data-bs-target="#statusSellerModal"
                                                        data-id="{{ $seller->id }}" data-name="{{ $seller->name }}"
                                                        data-current-status="{{ $seller->status }}"
                                                        data-status-url="{{ route('admin.sellers.updateStatus', $seller->id) }}"
                                                        data-bs-placement="top" title="Change Status">
                                                        <em class="icon ni ni-setting"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @empty
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check"></td>
                                        <td class="nk-tb-col text-center" colspan="5">
                                            <span class="text-soft">No sellers found.</span>
                                        </td>
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
