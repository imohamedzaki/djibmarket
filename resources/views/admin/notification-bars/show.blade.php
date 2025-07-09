@extends('layouts.app.admin')
@section('title', 'Notification Bar Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Notification Bar Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.notification-bars.index') }}">Notification Bars</a></li>
                                <li class="breadcrumb-item active">{{ $notificationBar->name }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <button type="button" class="btn btn-outline-primary edit-notification-button"
                                            data-bs-toggle="modal" data-bs-target="#editNotificationBarModal"
                                            data-id="{{ $notificationBar->id }}">
                                            <em class="icon ni ni-edit"></em><span>Edit</span>
                                        </button>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.notification-bars.index') }}" class="btn btn-secondary">
                                            <em class="icon ni ni-arrow-left"></em><span>Back to List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="row g-4">
                    <!-- Basic Information -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-inner">
                                <h5 class="card-title">Basic Information</h5>
                                <div class="row gy-3">
                                    <div class="col-sm-6">
                                        <span class="sub-text">Name:</span>
                                        <span class="caption-text">{{ $notificationBar->name }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="sub-text">Columns:</span>
                                        <span class="caption-text">{{ $notificationBar->column_count }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="sub-text">Start Date:</span>
                                        <span
                                            class="caption-text">{{ $notificationBar->start_date->format('M d, Y') }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="sub-text">End Date:</span>
                                        <span class="caption-text">{{ $notificationBar->end_date->format('M d, Y') }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="sub-text">Status:</span>
                                        @php
                                            $statusClass = match ($notificationBar->status) {
                                                'active' => 'text-success',
                                                'scheduled' => 'text-info',
                                                'expired' => 'text-warning',
                                                'inactive' => 'text-danger',
                                                default => 'text-muted',
                                            };
                                        @endphp
                                        <span class="caption-text {{ $statusClass }}">
                                            {{ ucfirst($notificationBar->status) }}
                                        </span>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="sub-text">CSS Class:</span>
                                        <span class="caption-text">{{ $notificationBar->css_class ?: 'None' }}</span>
                                    </div>
                                    <div class="col-12">
                                        <span class="sub-text">Created:</span>
                                        <span
                                            class="caption-text">{{ $notificationBar->created_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                    <div class="col-12">
                                        <span class="sub-text">Last Updated:</span>
                                        <span
                                            class="caption-text">{{ $notificationBar->updated_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Control -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-inner">
                                <h5 class="card-title">Quick Actions</h5>
                                <div class="form-group">
                                    <label class="form-label">Active Status</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input status-toggle" id="status-toggle"
                                            data-id="{{ $notificationBar->id }}"
                                            {{ $notificationBar->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status-toggle">
                                            {{ $notificationBar->is_active ? 'Active' : 'Inactive' }}
                                        </label>
                                    </div>
                                    <div class="form-note">Toggle to activate or deactivate this notification bar.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preview -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-inner">
                                <h5 class="card-title">Live Preview</h5>
                                <div class="preview-container p-3" style="background: #f8f9fa; border-radius: 0.375rem;">
                                    <div class="box-notify {{ $notificationBar->css_class }}">
                                        <div class="container position-relative">
                                            <div class="row">
                                                @foreach ($notificationBar->columns->take($notificationBar->column_count) as $column)
                                                    @php
                                                        $colClass = 'col-lg-' . 12 / $notificationBar->column_count;
                                                    @endphp
                                                    <div class="{{ $colClass }}">
                                                        @if ($column->hasLink())
                                                            <a href="{{ $column->link_url }}"
                                                                target="{{ $column->link_target }}" class="notify-link">
                                                        @endif

                                                        @if ($column->hasImage())
                                                            <img src="{{ $column->image_url }}" alt="Notification"
                                                                class="notify-image me-2"
                                                                style="height: 20px; width: auto;">
                                                        @endif

                                                        <span
                                                            class="notify-text color-white">{{ $column->text_content }}</span>

                                                        @if ($column->hasLink())
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="btn btn-close"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columns Details -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-inner">
                                <h5 class="card-title">Columns Configuration</h5>
                                <div class="row g-3">
                                    @foreach ($notificationBar->columns as $column)
                                        <div class="col-md-6 col-xl-4">
                                            <div class="card border">
                                                <div class="card-inner">
                                                    <h6 class="card-title text-primary">Column {{ $column->column_order }}
                                                    </h6>

                                                    <div class="mb-3">
                                                        <span class="sub-text">Content:</span>
                                                        <p class="caption-text">{{ $column->text_content }}</p>
                                                    </div>

                                                    @if ($column->hasImage())
                                                        <div class="mb-3">
                                                            <span class="sub-text">Image:</span>
                                                            <div class="mt-1">
                                                                <img src="{{ $column->image_url }}" alt="Column Image"
                                                                    style="max-height: 60px; max-width: 120px; object-fit: cover; border-radius: 0.25rem;">
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($column->hasLink())
                                                        <div class="mb-3">
                                                            <span class="sub-text">Link:</span>
                                                            <p class="caption-text">
                                                                <a href="{{ $column->link_url }}"
                                                                    target="{{ $column->link_target }}"
                                                                    class="text-primary">
                                                                    {{ \Str::limit($column->link_url, 40) }}
                                                                </a>
                                                                <small
                                                                    class="text-muted">({{ $column->link_target }})</small>
                                                            </p>
                                                        </div>
                                                    @endif

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="sub-text">Status:</span>
                                                        <span
                                                            class="badge badge-{{ $column->is_active ? 'success' : 'danger' }} badge-dim">
                                                            {{ $column->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include edit modal --}}
    @include('admin.notification-bars.partials.edit-modal')
@endsection

@section('css')
    <style>
        .caption-text {
            font-weight: 500;
            color: #526484;
        }

        .preview-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .preview-container .notify-text {
            color: white !important;
        }

        .preview-container .btn-close {
            color: white;
            opacity: 0.8;
        }

        .preview-container .btn-close:hover {
            opacity: 1;
        }

        .card-title {
            margin-bottom: 1rem;
        }

        .row.gy-3>div {
            margin-bottom: 0.75rem;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Status toggle functionality
            $('.status-toggle').on('change', function() {
                const id = $(this).data('id');
                const isActive = $(this).prop('checked');
                const $toggle = $(this);
                const $label = $toggle.next('label');

                $.ajax({
                    url: `{{ route('admin.notification-bars.updateStatus', ':id') }}`.replace(
                        ':id', id),
                    method: 'PATCH',
                    data: {
                        is_active: isActive,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $label.text(isActive ? 'Active' : 'Inactive');

                            // Show success message
                            const message = isActive ? 'Notification bar activated' :
                                'Notification bar deactivated';
                            // You can add a toast notification here if needed
                        }
                    },
                    error: function() {
                        // Revert toggle if error
                        $toggle.prop('checked', !isActive);
                        alert('Failed to update status. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
