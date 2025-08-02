@extends('layouts.app.seller')
@section('title', $pageTitle ?? 'Order Management')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{ $pageTitle ?? 'Order Management' }}</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $status ? ucfirst($status) . ' Orders' : 'Orders' }}
                                </li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">{{ $status ? ucfirst($status) . ' Orders' : 'List of Orders' }}</h4>
                        <div class="nk-block-des">
                            <p>{{ $pageDescription ?? 'Use the table below to view, edit, and manage your orders.' }}
                            </p>
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
                                    <th class="nk-tb-col"><span class="sub-text">Order #</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Customer</span></th>
                                    @if ($status === 'shipped')
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Delivery Address</span></th>
                                    @endif
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Your Items</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Quantity</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Your Amount</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Date</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($orders as $order)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="order-{{ $order->id }}">
                                                <label class="custom-control-label"
                                                    for="order-{{ $order->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($order->order_number, -2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">#{{ $order->order_number }}</span>
                                                    <span class="tb-sub">ID: {{ $order->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <div class="user-info">
                                                <span class="tb-lead">{{ $order->user->name ?? 'Guest' }}</span>
                                                <span class="tb-sub">{{ $order->user->email ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        @if ($status === 'shipped')
                                            <td class="nk-tb-col tb-col-md">
                                                @if ($order->shippingAddress)
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $order->shippingAddress->title }}</span>
                                                        <span
                                                            class="tb-sub">{{ Str::limit($order->shippingAddress->full_address, 30) }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-soft">No address</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-dim bg-outline-info">{{ $order->seller_items_count ?? 0 }}
                                                items</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span
                                                class="badge badge-dim bg-outline-primary">{{ $order->total_quantity ?? 0 }}
                                                qty</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="tb-amount">{{ number_format(($order->seller_final_price ?? 0) + 0) }}
                                                <span class="currency">DJF</span></span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @switch($order->status)
                                                @case('pending')
                                                    <span class="badge badge-dot bg-warning">Pending</span>
                                                @break

                                                @case('accepted')
                                                    <span class="badge badge-dot bg-info">Accepted</span>
                                                @break

                                                @case('processing')
                                                    <span class="badge badge-dot bg-info">Processing</span>
                                                @break

                                                @case('shipped')
                                                    <span class="badge badge-dot bg-primary">Shipped</span>
                                                @break

                                                @case('delivered')
                                                    <span class="badge badge-dot bg-success">Delivered</span>
                                                @break

                                                @case('completed')
                                                    <span class="badge badge-dot bg-success">Completed</span>
                                                @break

                                                @case('cancelled')
                                                    <span class="badge badge-dot bg-danger">Cancelled</span>
                                                @break

                                                @case('refunded')
                                                    <span class="badge badge-dot bg-secondary">Refunded</span>
                                                @break

                                                @default
                                                    <span
                                                        class="badge badge-dot bg-secondary">{{ ucfirst($order->status) }}</span>
                                            @endswitch
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{ $order->created_at->format('M d, Y') }}</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('seller.orders.show', $order->order_number) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-warning status-order-button"
                                                        data-bs-toggle="modal" data-bs-target="#statusOrderModal"
                                                        data-order-number="{{ $order->order_number }}"
                                                        data-number="{{ $order->order_number }}"
                                                        data-current-status="{{ $order->status }}"
                                                        data-status-url="{{ route('seller.orders.updateStatus', $order->order_number) }}"
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
                                            <td class="nk-tb-col"></td>
                                            <td class="nk-tb-col"></td>
                                            @if ($status === 'shipped')
                                                <td class="nk-tb-col"></td>
                                            @endif
                                            <td class="nk-tb-col text-center">
                                                <span class="text-soft">No {{ $status ? $status . ' ' : '' }}orders found.</span>
                                            </td>
                                            <td class="nk-tb-col"></td>
                                            <td class="nk-tb-col"></td>
                                            <td class="nk-tb-col"></td>
                                            <td class="nk-tb-col"></td>
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

        <!-- Status Change Modal -->
        <div class="modal fade" id="statusOrderModal" data-bs-keyboard="true" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white">Change Order Status</h5>
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross text-white"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to change the status of order <strong id="status-order-number"></strong>?</p>
                        <p>Current status: <span id="current-status-display"></span></p>

                        <form action="" method="POST" id="statusOrderForm">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label class="form-label" for="new-status">New Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="new-status" name="status" required>
                                        <option value="pending">Pending</option>
                                        <option value="accepted">Accepted</option>
                                        <option value="processing">Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="d-flex justify-content-between w-100">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-warning submit-btn" id="confirmStatusOrderBtn">
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
                // Add status filter next to DataTable controls after DataTable is initialized
                setTimeout(function() {
                    // Create the status filter HTML
                    var statusFilterHtml = `
                        <div class="form-group mb-0 me-3">
                            <div class="form-control-wrap">
                                <select class="form-select" id="status-filter" style="width: 200px;">
                                    <option value="all" {{ $status === 'all' || !$status ? 'selected' : '' }}>All Orders</option>
                                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="accepted" {{ $status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                    <option value="processing" {{ $status === 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="refunded" {{ $status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                            </div>
                        </div>
                    `;

                    // Find the DataTable wrapper and add the filter to the top section
                    var dtWrapper = $('.dataTables_wrapper');
                    if (dtWrapper.length > 0) {
                        var topSection = dtWrapper.find('.dataTables_length').parent();
                        if (topSection.length > 0) {
                            topSection.prepend(statusFilterHtml);
                        }
                    }

                    // Set the correct selected value based on current status
                    var currentStatus = '{{ $status }}';
                    if (currentStatus) {
                        $('#status-filter').val(currentStatus);
                    } else {
                        $('#status-filter').val('all');
                    }

                    // Initialize Select2 for status filter
                    $('#status-filter').select2({
                        placeholder: 'Filter by Status',
                        allowClear: false,
                        width: '200px'
                    });

                    // Handle status filter change
                    $('#status-filter').on('change', function() {
                        var selectedStatus = $(this).val();
                        var currentUrl = new URL(window.location.href);

                        if (selectedStatus && selectedStatus !== 'all') {
                            currentUrl.searchParams.set('status', selectedStatus);
                        } else {
                            currentUrl.searchParams.delete('status');
                        }

                        // Reload the page with the new status parameter
                        window.location.href = currentUrl.toString();
                    });
                }, 1000); // Wait for DataTable to initialize
                
                // Status change button click
                $(document).on('click', '.status-order-button', function() {
                    console.log('Status order button clicked');
                    var orderNumber = $(this).data('order-number');
                    var orderDisplay = $(this).data('number');
                    var currentStatus = $(this).data('current-status');
                    var statusUrl = $(this).data('status-url');

                    console.log('Status data:', orderNumber, orderDisplay, currentStatus, statusUrl);

                    $('#status-order-number').text('#' + orderDisplay);
                    $('#current-status-display').text(currentStatus.charAt(0).toUpperCase() + currentStatus
                        .slice(1));
                    $('#statusOrderForm').attr('action', statusUrl);

                    // Set the current status as selected and enable all options first
                    var newStatusSelect = $('#new-status');
                    newStatusSelect.find('option').prop('disabled', false);
                    newStatusSelect.val(currentStatus);
                });

                // Confirm status change
                $('#confirmStatusOrderBtn').on('click', function() {
                    var $this = $(this);
                    var form = $('#statusOrderForm');

                    console.log('Form action:', form.attr('action'));
                    console.log('Form data:', form.serialize());

                    $this.prop('disabled', true);
                    $this.find('.spinner').removeClass('d-none');
                    $this.find('.btn-text').text('Changing...');

                    form.submit();
                });

                // Reset status modal when closed
                $('#statusOrderModal').on('hidden.bs.modal', function() {
                    var $submitBtn = $('#confirmStatusOrderBtn');
                    $submitBtn.prop('disabled', false);
                    $submitBtn.find('.spinner').addClass('d-none');
                    $submitBtn.find('.btn-text').text('Change Status');
                    $('#statusOrderForm')[0].reset();
                });
            });
        </script>
    @endsection