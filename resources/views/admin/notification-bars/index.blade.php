@extends('layouts.app.admin')
@section('title', 'Notification Bars Management')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Notification Bars</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notification Bars</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addNotificationBarModal">
                                            <em class="icon ni ni-plus"></em><span>Add Notification Bar</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Session Success/Error Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Notification Bars Management</h4>
                        <div class="nk-block-des">
                            <p>Manage promotional notification bars displayed on your website.</p>
                            @if ($notificationBars->total() > 0)
                                <p class="text-muted small">
                                    Showing {{ $notificationBars->firstItem() }} to {{ $notificationBars->lastItem() }}
                                    of {{ $notificationBars->total() }} notification bars
                                    @if ($notificationBars->hasPages())
                                        (Page {{ $notificationBars->currentPage() }} of {{ $notificationBars->lastPage() }})
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        @if ($notificationBars->total() > 0)
                            <div class="search-filter-controls">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Show entries:</label>
                                            <select class="form-select" id="entries-per-page"
                                                style="width: auto; display: inline-block;">
                                                <option value="10"
                                                    {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25
                                                </option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Status:</label>
                                            <select class="form-select" id="status-filter">
                                                <option value="">All Status</option>
                                                <option value="active"
                                                    {{ request('status') == 'active' ? 'selected' : '' }}>
                                                    Currently Active</option>
                                                <option value="scheduled"
                                                    {{ request('status') == 'scheduled' ? 'selected' : '' }}>
                                                    Scheduled</option>
                                                <option value="expired"
                                                    {{ request('status') == 'expired' ? 'selected' : '' }}>
                                                    Expired</option>
                                                <option value="inactive"
                                                    {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Search:</label>
                                            <input type="text" class="form-control" id="search-notifications"
                                                placeholder="Search by name or content..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <table id="notifications-table" class="nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Columns</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Preview</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Period</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($notificationBars as $notificationBar)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                        $statusClass = match ($notificationBar->status) {
                                            'active' => 'text-success',
                                            'scheduled' => 'text-info',
                                            'expired' => 'text-warning',
                                            'inactive' => 'text-danger',
                                            default => 'text-muted',
                                        };
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input notification-checkbox"
                                                    id="notification-{{ $notificationBar->id }}"
                                                    value="{{ $notificationBar->id }}">
                                                <label class="custom-control-label"
                                                    for="notification-{{ $notificationBar->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($notificationBar->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $notificationBar->name }}</span>
                                                    <span class="sub-text">{{ $notificationBar->column_count }}
                                                        columns</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-dim bg-primary">{{ $notificationBar->column_count }}
                                                Columns</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <div class="notification-preview">
                                                @foreach ($notificationBar->columns->take(2) as $column)
                                                    <div class="preview-item small text-muted">
                                                        @if ($column->hasImage())
                                                            <em class="icon ni ni-img text-primary me-1"></em>
                                                        @endif
                                                        {{ \Str::limit($column->text_content, 40) }}
                                                        @if ($column->hasLink())
                                                            <em class="icon ni ni-link text-info ms-1"></em>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                @if ($notificationBar->columns->count() > 2)
                                                    <div class="small text-muted">
                                                        +{{ $notificationBar->columns->count() - 2 }} more...</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <div class="date-range">
                                                <div class="small"><strong>Start:</strong>
                                                    {{ $notificationBar->start_date->format('M d, Y') }}</div>
                                                <div class="small"><strong>End:</strong>
                                                    {{ $notificationBar->end_date->format('M d, Y') }}</div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="tb-status {{ $statusClass }}">
                                                {{ ucfirst($notificationBar->status) }}
                                            </span>

                                            <div class="custom-control custom-switch mt-1">
                                                <input type="checkbox" class="custom-control-input status-toggle"
                                                    id="status-{{ $notificationBar->id }}"
                                                    data-id="{{ $notificationBar->id }}"
                                                    {{ $notificationBar->is_active ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="status-{{ $notificationBar->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.notification-bars.show', $notificationBar) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="View Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-notification-button"
                                                        data-bs-toggle="modal" data-bs-target="#editNotificationBarModal"
                                                        data-id="{{ $notificationBar->id }}" data-bs-placement="top"
                                                        title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-notification-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteNotificationBarModal"
                                                        data-id="{{ $notificationBar->id }}"
                                                        data-name="{{ $notificationBar->name }}"
                                                        data-delete-url="{{ route('admin.notification-bars.destroy', $notificationBar) }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            @if ($notificationBars->count() == 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="7" class="text-center p-4">
                                            <div class="py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-bell"
                                                        style="font-size: 3rem; color: #c4c4c4;"></em>
                                                </div>
                                                <h6 class="text-muted">No notification bars found</h6>
                                                <p class="text-muted small">Start by creating your first notification bar
                                                    using the "Add Notification Bar" button above.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>

                @if ($notificationBars->hasPages())
                    <div class="mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="pagination-info">
                                    <span class="text-muted">
                                        Showing {{ $notificationBars->firstItem() }} to
                                        {{ $notificationBars->lastItem() }}
                                        of {{ $notificationBars->total() }} results
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-md-end justify-content-center">
                                    {{ $notificationBars->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Add Notification Bar Modal --}}
    @include('admin.notification-bars.partials.add-modal')

    {{-- Edit Notification Bar Modal --}}
    @include('admin.notification-bars.partials.edit-modal')

    {{-- Delete Notification Bar Modal --}}
    @include('admin.notification-bars.partials.delete-modal')
@endsection

@section('css')
    <style>
        .search-filter-controls {
            background: #f8f9fa;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .notification-preview .preview-item {
            margin-bottom: 2px;
            line-height: 1.2;
        }

        .date-range .small {
            line-height: 1.1;
            margin-bottom: 1px;
        }

        .column-item {
            border: 1px dashed #dbdfea;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background: #f8f9fa;
        }

        .column-item.active {
            border-color: #007bff;
            background: #f0f8ff;
        }

        .remove-column-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Search functionality
            let searchTimeout;
            $('#search-notifications').on('input', function() {
                clearTimeout(searchTimeout);
                const searchValue = $(this).val();

                searchTimeout = setTimeout(function() {
                    const url = new URL(window.location);
                    if (searchValue.trim()) {
                        url.searchParams.set('search', searchValue);
                    } else {
                        url.searchParams.delete('search');
                    }
                    url.searchParams.delete('page');
                    window.location.href = url.toString();
                }, 500);
            });

            // Status filter
            $('#status-filter').on('change', function() {
                const status = $(this).val();
                const url = new URL(window.location);
                if (status) {
                    url.searchParams.set('status', status);
                } else {
                    url.searchParams.delete('status');
                }
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            // Per page change
            $('#entries-per-page').on('change', function() {
                const perPage = $(this).val();
                const url = new URL(window.location);
                url.searchParams.set('per_page', perPage);
                url.searchParams.delete('page');
                window.location.href = url.toString();
            });

            // Status toggle - using event delegation for dynamic elements
            $(document).on('change', '.status-toggle', function() {
                const id = $(this).data('id');
                const isActive = $(this).prop('checked');
                const $toggle = $(this);

                console.log('Status toggle clicked:', {
                    id: id,
                    isActive: isActive,
                    hasDataId: $(this).data('id') !== undefined
                });

                if (!id) {
                    alert('Error: Missing notification bar ID');
                    $toggle.prop('checked', !isActive);
                    return;
                }

                $.ajax({
                    url: `{{ route('admin.notification-bars.updateStatus', ':id') }}`.replace(
                        ':id', id),
                    method: 'PATCH',
                    data: {
                        is_active: isActive ? 1 : 0,
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $toggle.prop('disabled', true);
                    },
                    success: function(response) {
                        console.log('AJAX Success:', response);
                        if (response.success) {
                            // Update status text in table if it exists
                            const $statusSpan = $toggle.closest('td').find('.tb-status');
                            if ($statusSpan.length) {
                                const statusClass = isActive ? 'text-success' : 'text-danger';
                                const statusText = isActive ? 'Active' : 'Inactive';

                                $statusSpan.removeClass(
                                        'text-success text-danger text-info text-warning')
                                    .addClass(statusClass)
                                    .text(statusText);
                            }

                            // Update label text in modal if it's in a modal
                            const $label = $toggle.next('label');
                            if ($label.length) {
                                // Check if there's a status-text span inside the label
                                const $statusSpan = $label.find('.status-text');
                                if ($statusSpan.length) {
                                    const statusText = isActive ? 'Active' : 'Inactive';
                                    $statusSpan.text(statusText);
                                }
                                // Don't update the label text directly to avoid duplicates
                            }

                            console.log('Status updated successfully');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error Details:', {
                            status: xhr.status,
                            statusText: xhr.statusText,
                            responseText: xhr.responseText,
                            error: error
                        });

                        // Revert toggle if error
                        $toggle.prop('checked', !isActive);

                        let errorMessage = 'Failed to update status. Please try again.';
                        if (xhr.status === 404) {
                            errorMessage =
                                'Error: Route not found. Please check the configuration.';
                        } else if (xhr.status === 422) {
                            errorMessage = 'Validation error. Please check the data.';
                        } else if (xhr.status === 500) {
                            errorMessage = 'Server error. Please try again later.';
                        }

                        alert(errorMessage);
                    },
                    complete: function() {
                        $toggle.prop('disabled', false);
                    }
                });
            });

            // Select all functionality
            $('#uid').on('change', function() {
                $('.notification-checkbox').prop('checked', $(this).prop('checked'));
            });

            $('.notification-checkbox').on('change', function() {
                const totalCheckboxes = $('.notification-checkbox').length;
                const checkedCheckboxes = $('.notification-checkbox:checked').length;

                if (totalCheckboxes === checkedCheckboxes) {
                    $('#uid').prop('indeterminate', false).prop('checked', true);
                } else if (checkedCheckboxes > 0) {
                    $('#uid').prop('indeterminate', true);
                } else {
                    $('#uid').prop('indeterminate', false).prop('checked', false);
                }
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
