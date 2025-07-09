@extends('layouts.app.admin')
@section('title', 'List of Buyers')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Buyers Management</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Buyers</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Buyers</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage buyers.</p>
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
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Orders</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Reviews</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($buyers as $buyer)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="buyer-{{ $buyer->id }}">
                                                <label class="custom-control-label" for="buyer-{{ $buyer->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($buyer->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $buyer->name }}</span>
                                                    <span class="tb-sub">ID: {{ $buyer->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ $buyer->email }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span>{{ $buyer->phone ?? 'N/A' }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-dot bg-info">{{ $buyer->orders_count }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-dot bg-warning">{{ $buyer->reviews_count }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if (($buyer->status ?? 'active') === 'active')
                                                <span class="badge badge-dot bg-success">Active</span>
                                            @elseif ($buyer->status === 'suspended')
                                                <span class="badge badge-dot bg-warning">Suspended</span>
                                            @else
                                                <span class="badge badge-dot bg-danger">Banned</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.buyers.show', $buyer->id) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-buyer-button"
                                                        data-bs-toggle="modal" data-id="{{ $buyer->id }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-warning status-buyer-button"
                                                        data-bs-toggle="modal" data-bs-target="#statusBuyerModal"
                                                        data-id="{{ $buyer->id }}" data-name="{{ $buyer->name }}"
                                                        data-current-status="{{ $buyer->status ?? 'active' }}"
                                                        data-status-url="{{ route('admin.buyers.updateStatus', $buyer->id) }}"
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
                                        <td class="nk-tb-col text-center" colspan="6">
                                            <span class="text-soft">No buyers found.</span>
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
