@extends('layouts.app.admin')

@section('title', 'Email Management Dashboard')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <!-- Email Stats Cards -->
            <div class="row g-gs">
                <!-- Today Stats -->
                <div class="col-md-3">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Today's Emails</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-emails"></em>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <span class="amount">{{ $stats['today']['total'] }}</span>
                                    <span class="sub-title">
                                        <span class="change up text-success">
                                            <em class="icon ni ni-arrow-up"></em>
                                            {{ $stats['today']['sent'] }} sent
                                        </span>
                                    </span>
                                </div>
                                <div class="nk-sales-ck">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ $stats['today']['total'] > 0 ? ($stats['today']['sent'] / $stats['today']['total']) * 100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Queued Emails -->
                <div class="col-md-3">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Queued</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-clock"></em>
                                </div>
                            </div>
                            <div class="align-end">
                                <div class="nk-sale-data">
                                    <span class="amount text-warning" id="queued-count">{{ $queuedCount }}</span>
                                    <span class="sub-title">
                                        <span class="change text-info">
                                            <em class="icon ni ni-clock-fill"></em>
                                            Pending
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Failed Emails -->
                <div class="col-md-3">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Failed Today</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-cross-circle"></em>
                                </div>
                            </div>
                            <div class="align-end">
                                <div class="nk-sale-data">
                                    <span class="amount text-danger" id="failed-count">{{ $failedToday }}</span>
                                    @if ($failedToday > 0)
                                        <span class="sub-title">
                                            <span class="change down text-danger">
                                                <em class="icon ni ni-alert-circle"></em>
                                                Needs attention
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success Rate -->
                <div class="col-md-3">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Success Rate</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-check-circle"></em>
                                </div>
                            </div>
                            <div class="align-end">
                                <div class="nk-sale-data">
                                    @php
                                        $total = $stats['today']['total'];
                                        $sent = $stats['today']['sent'];
                                        $rate = $total > 0 ? round(($sent / $total) * 100, 1) : 0;
                                    @endphp
                                    <span
                                        class="amount {{ $rate >= 90 ? 'text-success' : ($rate >= 70 ? 'text-warning' : 'text-danger') }}">
                                        {{ $rate }}%
                                    </span>
                                    <span class="sub-title">
                                        <span class="change">
                                            Last 24 hours
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts for Failed Emails -->
            @if ($failedToday > 0)
                <div class="row g-gs mt-3">
                    <div class="col-12">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <div class="alert-cta flex-wrap flex-md-nowrap">
                                <div class="alert-text">
                                    <h6>⚠️ Email Delivery Issues Detected</h6>
                                    <p>{{ $failedToday }} emails failed to send today.
                                        <a href="#failed-emails-section" class="alert-link">Review failed emails</a>
                                        and take necessary action.
                                    </p>
                                </div>
                                <ul class="alert-actions gx-3 my-3">
                                    <li>
                                        <a href="{{ route('admin.emails.dashboard', ['status' => 'failed']) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            View Failed Emails
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <button class="close" type="button" data-bs-dismiss="alert" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Filters and Actions -->
            <div class="row g-gs mt-4">
                <div class="col-12">
                    <div class="card card-bordered">
                        <div class="card-inner border-bottom">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Email Logs</h6>
                                </div>
                                <div class="card-tools">
                                    <button class="btn btn-outline-primary btn-sm" onclick="refreshData()">
                                        <em class="icon ni ni-reload"></em>
                                        <span>Refresh</span>
                                    </button>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exportModal">
                                        <em class="icon ni ni-download"></em>
                                        <span>Export</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Filters Form -->
                        <div class="card-inner">
                            <form method="GET" action="{{ route('admin.emails.dashboard') }}" class="row g-3">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="">All Status</option>
                                            <option value="queued" {{ request('status') == 'queued' ? 'selected' : '' }}>
                                                Queued</option>
                                            <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>
                                                Sent</option>
                                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>
                                                Failed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <select class="form-select" name="type">
                                            <option value="">All Types</option>
                                            @foreach ($emailTypes as $type)
                                                <option value="{{ $type }}"
                                                    {{ request('type') == $type ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $type)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ request('email') }}" placeholder="Search email...">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">From Date</label>
                                        <input type="date" class="form-control" name="date_from"
                                            value="{{ request('date_from') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">To Date</label>
                                        <input type="date" class="form-control" name="date_to"
                                            value="{{ request('date_to') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                <em class="icon ni ni-search"></em>
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Email List -->
                        <div class="card-inner p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                                    <label class="custom-control-label" for="selectAll"></label>
                                                </div>
                                            </th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Queued At</th>
                                            <th>Sent At</th>
                                            <th>Processing Time</th>
                                            <th width="100">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($emails as $email)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input email-checkbox"
                                                            id="email-{{ $email->id }}" value="{{ $email->id }}">
                                                        <label class="custom-control-label"
                                                            for="email-{{ $email->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $email->to_email }}</span>
                                                        @if ($email->to_name)
                                                            <span
                                                                class="d-block small text-muted">{{ $email->to_name }}</span>
                                                        @endif
                                                        <span
                                                            class="d-block small text-muted">{{ Str::limit($email->subject, 40) }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ ucwords(str_replace('_', ' ', $email->email_type)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @switch($email->status)
                                                        @case('sent')
                                                            <span class="badge bg-success">
                                                                <em class="icon ni ni-check"></em> Sent
                                                            </span>
                                                        @break

                                                        @case('queued')
                                                            <span class="badge bg-warning">
                                                                <em class="icon ni ni-clock"></em> Queued
                                                            </span>
                                                        @break

                                                        @case('failed')
                                                            <span class="badge bg-danger">
                                                                <em class="icon ni ni-cross"></em> Failed
                                                            </span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <span class="small">
                                                        {{ $email->queued_at->format('M d, Y') }}<br>
                                                        <span
                                                            class="text-muted">{{ $email->queued_at->format('H:i:s') }}</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($email->sent_at)
                                                        <span class="small">
                                                            {{ $email->sent_at->format('M d, Y') }}<br>
                                                            <span
                                                                class="text-muted">{{ $email->sent_at->format('H:i:s') }}</span>
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($email->processing_time_human)
                                                        <span
                                                            class="small text-info">{{ $email->processing_time_human }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-sm btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li>
                                                                    <a href="{{ route('admin.emails.show', $email) }}">
                                                                        <em class="icon ni ni-eye"></em>
                                                                        <span>View Details</span>
                                                                    </a>
                                                                </li>
                                                                @if ($email->status === 'failed')
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('admin.emails.retry', $email) }}">
                                                                            <em class="icon ni ni-reload"></em>
                                                                            <span>Retry</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <em class="icon ni ni-inbox" style="font-size: 2rem;"></em>
                                                            <p class="mt-2">No emails found matching your criteria.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if ($emails->count() > 0)
                                <!-- Bulk Actions -->
                                <div class="card-inner border-top">
                                    <form id="bulkActionForm" method="POST"
                                        action="{{ route('admin.emails.bulk-action') }}">
                                        @csrf
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-3">
                                                <select class="form-select" name="action" id="bulkAction">
                                                    <option value="">Bulk Actions</option>
                                                    <option value="mark_sent">Mark as Sent</option>
                                                    <option value="retry">Retry Failed</option>
                                                    <option value="delete">Delete</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary" id="applyBulkAction" disabled>
                                                    Apply Action
                                                </button>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <span class="small text-muted">
                                                    <span id="selectedCount">0</span> emails selected
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Export Modal -->
            <div class="modal fade" id="exportModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Email Logs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="GET" action="{{ route('admin.emails.export') }}">
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">From Date</label>
                                        <input type="date" class="form-control" name="date_from">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">To Date</label>
                                        <input type="date" class="form-control" name="date_to">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option value="">All Status</option>
                                            <option value="sent">Sent</option>
                                            <option value="failed">Failed</option>
                                            <option value="queued">Queued</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Type</label>
                                        <select class="form-select" name="type">
                                            <option value="">All Types</option>
                                            @foreach ($emailTypes as $type)
                                                <option value="{{ $type }}">
                                                    {{ ucwords(str_replace('_', ' ', $type)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <em class="icon ni ni-download"></em>
                                    Export CSV
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection

    @section('css')
        <style>
            .card-bordered {
                height: 100%;
            }
        </style>
    @endsection

    @section('js')
        <script>
            // Real-time data refresh
            function refreshData() {
                fetch('{{ route('admin.emails.real-time-data') }}')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('queued-count').textContent = data.queued_count;
                        document.getElementById('failed-count').textContent = data.failed_today;

                        // Update alerts if needed
                        if (data.failed_today > 0 && !document.querySelector('.alert-warning')) {
                            location.reload(); // Reload to show alerts
                        }
                    })
                    .catch(error => console.error('Error refreshing data:', error));
            }

            // Auto refresh every 30 seconds
            setInterval(refreshData, 30000);

            // Checkbox selection
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.email-checkbox');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateSelectedCount();
                updateBulkActionButton();
            });

            document.querySelectorAll('.email-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedCount();
                    updateBulkActionButton();
                    updateSelectAllCheckbox();
                });
            });

            function updateSelectedCount() {
                const selected = document.querySelectorAll('.email-checkbox:checked').length;
                document.getElementById('selectedCount').textContent = selected;
            }

            function updateBulkActionButton() {
                const selected = document.querySelectorAll('.email-checkbox:checked').length;
                const bulkAction = document.getElementById('bulkAction').value;
                document.getElementById('applyBulkAction').disabled = selected === 0 || !bulkAction;
            }

            function updateSelectAllCheckbox() {
                const total = document.querySelectorAll('.email-checkbox').length;
                const selected = document.querySelectorAll('.email-checkbox:checked').length;
                const selectAllCheckbox = document.getElementById('selectAll');

                selectAllCheckbox.checked = selected === total && total > 0;
                selectAllCheckbox.indeterminate = selected > 0 && selected < total;
            }

            document.getElementById('bulkAction').addEventListener('change', updateBulkActionButton);

            // Bulk action form submission
            document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
                const selectedEmails = Array.from(document.querySelectorAll('.email-checkbox:checked'))
                    .map(checkbox => checkbox.value);

                if (selectedEmails.length === 0) {
                    e.preventDefault();
                    alert('Please select emails to perform bulk action.');
                    return;
                }

                // Add selected email IDs to form
                selectedEmails.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'email_ids[]';
                    input.value = id;
                    this.appendChild(input);
                });

                const action = document.getElementById('bulkAction').value;
                if (action === 'delete') {
                    if (!confirm(
                            'Are you sure you want to delete the selected emails? This action cannot be undone.')) {
                        e.preventDefault();
                    }
                }
            });
        </script>
    @endsection
