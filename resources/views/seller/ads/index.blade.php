@extends('layouts.app.seller')
@section('title', 'My Advertisements')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Advertisements</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Advertisements</li>
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
                                        @if (Auth::guard('seller')->user()->status === 'pending')
                                            <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Advertisement creation is only available when your seller application has been accepted">
                                                <button class="btn btn-primary" disabled>
                                                    <em class="icon ni ni-lock"></em><span>Create Advertisement
                                                        (Locked)</span>
                                                </button>
                                            </span>
                                        @else
                                            <a href="{{ route('seller.ads.create') }}" class="btn btn-primary">
                                                <em class="icon ni ni-plus"></em><span>Create Advertisement</span>
                                            </a>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="{{ route('seller.ads.analytics') }}" class="btn btn-outline-primary">
                                            <em class="icon ni ni-bar-chart"></em><span>Analytics</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Status Alert --}}
            @include('includes.seller-pending-alert')

            {{-- Session Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">My Advertisements</h4>
                        <div class="nk-block-des">
                            <p>Manage your advertisement campaigns and track their performance.</p>
                            @if ($ads->total() > 0)
                                <p class="text-muted small">
                                    Showing {{ $ads->firstItem() }} to {{ $ads->lastItem() }}
                                    of {{ $ads->total() }} advertisements
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card card-preview">
                    <div class="card-inner">
                        <!-- Filter Controls -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Filter by Status:</label>
                                    <select class="form-select" id="status-filter">
                                        <option value="">All Statuses</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                            Approved</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>
                                            Paused</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Filter by Slot:</label>
                                    <select class="form-select" id="slot-filter">
                                        <option value="">All Slots</option>
                                        @foreach (\App\Models\SellerAd::AD_SLOTS as $slot => $displayName)
                                            <option value="{{ $slot }}"
                                                {{ request('slot') == $slot ? 'selected' : '' }}>
                                                {{ $displayName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Search:</label>
                                    <input type="text" class="form-control" id="search-ads" placeholder="Search ads..."
                                        value="{{ request('search') }}">
                                </div>
                            </div>
                        </div>

                        <table class="nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Slot</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col tb-col-sm"><span class="sub-text">Budget</span></th>
                                    <th class="nk-tb-col tb-col-sm"><span class="sub-text">Duration</span></th>
                                    <th class="nk-tb-col tb-col-sm"><span class="sub-text">Views/Clicks</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ads as $ad)
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $ad->title }}</span>
                                                    <span
                                                        class="fs-12px text-soft">{{ Str::limit($ad->description, 60) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-outline-primary">
                                                {{ \App\Models\SellerAd::AD_SLOTS[$ad->ad_slot] }}
                                            </span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'approved' => 'info',
                                                    'active' => 'success',
                                                    'paused' => 'secondary',
                                                    'rejected' => 'danger',
                                                    'completed' => 'dark',
                                                ];
                                            @endphp
                                            <span class="tb-status text-{{ $statusColors[$ad->status] }}">
                                                {{ ucfirst($ad->status) }}
                                            </span>
                                        </td>
                                        <td class="nk-tb-col tb-col-sm">
                                            <span class="tb-amount">{{ number_format($ad->total_budget, 0) }} DJF</span>
                                            <div class="fs-12px text-soft">
                                                Spent: {{ number_format($ad->current_cost, 0) }} DJF
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-sm">
                                            @if ($ad->start_date && $ad->end_date)
                                                <span class="fs-12px">{{ $ad->start_date->format('M d') }} -
                                                    {{ $ad->end_date->format('M d') }}</span>
                                            @else
                                                <span class="fs-12px text-soft">Duration-based</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-sm">
                                            <div class="fs-12px">
                                                <div>Views: {{ number_format($ad->current_views) }}</div>
                                                <div>Clicks: {{ number_format($ad->current_clicks) }}</div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ route('seller.ads.show', $ad) }}">
                                                                        <em class="icon ni ni-eye"></em><span>View
                                                                            Details</span></a></li>

                                                                @if (in_array($ad->status, ['pending', 'approved', 'rejected']))
                                                                    <li><a href="{{ route('seller.ads.edit', $ad) }}">
                                                                            <em
                                                                                class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                    </li>
                                                                @endif

                                                                @if ($ad->status === 'active')
                                                                    <li>
                                                                        <button type="button"
                                                                            class="btn-link text-warning pause-ad-btn"
                                                                            style="background: none; border: none; padding: 0; width: 100%; text-align: left;"
                                                                            data-action="{{ route('seller.ads.pause', $ad) }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#confirmAdActionModal"
                                                                            data-type="pause">
                                                                            <em class="icon ni ni-pause-fill"></em><span>Pause
                                                                                Campaign</span>
                                                                        </button>
                                                                    </li>
                                                                @endif

                                                                @if ($ad->status === 'paused')
                                                                    <li>
                                                                        <button type="button"
                                                                            class="btn-link text-success resume-ad-btn"
                                                                            style="background: none; border: none; padding: 0; width: 100%; text-align: left;"
                                                                            data-action="{{ route('seller.ads.resume', $ad) }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#confirmAdActionModal"
                                                                            data-type="resume">
                                                                            <em class="icon ni ni-play-fill"></em><span>Resume
                                                                                Campaign</span>
                                                                        </button>
                                                                    </li>
                                                                @endif

                                                                @if (in_array($ad->status, ['pending', 'rejected', 'paused']))
                                                                    <li class="divider"></li>
                                                                    <li>
                                                                        <button type="button"
                                                                            class="btn-link text-danger delete-ad-btn"
                                                                            style="background: none; border: none; padding: 0; width: 100%; text-align: left;"
                                                                            data-action="{{ route('seller.ads.destroy', $ad) }}"
                                                                            data-title="{{ $ad->title }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deleteAdModal">
                                                                            <em
                                                                                class="icon ni ni-trash"></em><span>Delete</span>
                                                                        </button>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col" colspan="7">
                                            <div class="text-center py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-card-view"
                                                        style="font-size: 48px; opacity: 0.3;"></em>
                                                </div>
                                                <h6>No advertisements found</h6>
                                                <p class="text-soft">Create your first advertisement to start promoting
                                                    your business.</p>
                                                @if (Auth::guard('seller')->user()->status === 'pending')
                                                    <span class="d-inline-block" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Advertisement creation is only available when your seller application has been accepted">
                                                        <button class="btn btn-primary mt-2" disabled>
                                                            <em class="icon ni ni-lock"></em><span>Create Advertisement
                                                                (Locked)
                                                            </span>
                                                        </button>
                                                    </span>
                                                @else
                                                    <a href="{{ route('seller.ads.create') }}"
                                                        class="btn btn-primary mt-2">
                                                        <em class="icon ni ni-plus"></em><span>Create Advertisement</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($ads->hasPages())
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                        {{ $ads->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Ad Action Modal (Pause/Resume) -->
    <div class="modal fade" id="confirmAdActionModal" tabindex="-1" aria-labelledby="confirmAdActionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="confirmAdActionModalHeader">
                    <h5 class="modal-title" id="confirmAdActionModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="confirmAdActionModalBody">
                    <!-- Content set by JS -->
                </div>
                <div class="modal-footer bg-light">
                    <form id="confirmAdActionForm" method="POST" action="">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" id="confirmAdActionBtn">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Ad Confirmation Modal -->
    <div class="modal fade" id="deleteAdModal" tabindex="-1" aria-labelledby="deleteAdModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="deleteAdModalLabel">Delete Advertisement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the advertisement <strong id="deleteAdTitle"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                </div>
                <div class="modal-footer bg-light">
                    <form id="deleteAdForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Filter functionality
            document.getElementById('status-filter').addEventListener('change', function() {
                updateFilters();
            });

            document.getElementById('slot-filter').addEventListener('change', function() {
                updateFilters();
            });

            document.getElementById('search-ads').addEventListener('input', function() {
                clearTimeout(window.searchTimeout);
                window.searchTimeout = setTimeout(updateFilters, 500);
            });

            function updateFilters() {
                const status = document.getElementById('status-filter').value;
                const slot = document.getElementById('slot-filter').value;
                const search = document.getElementById('search-ads').value;

                const params = new URLSearchParams();
                if (status) params.append('status', status);
                if (slot) params.append('slot', slot);
                if (search) params.append('search', search);

                window.location.href = '{{ route('seller.ads.index') }}' + (params.toString() ? '?' + params.toString() : '');
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.pause-ad-btn, .resume-ad-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var action = this.getAttribute('data-action');
                        var type = this.getAttribute('data-type');
                        var modalBody = document.getElementById('confirmAdActionModalBody');
                        var modalTitle = document.getElementById('confirmAdActionModalLabel');
                        var confirmBtn = document.getElementById('confirmAdActionBtn');
                        var form = document.getElementById('confirmAdActionForm');
                        var modalHeader = document.getElementById('confirmAdActionModalHeader');
                        form.setAttribute('action', action);
                        // Reset classes
                        modalHeader.className = 'modal-header';
                        confirmBtn.className = 'btn';
                        if (type === 'pause') {
                            modalBody.innerHTML =
                                '<p>Are you sure you want to pause this advertisement?</p>';
                            modalTitle.textContent = 'Pause Advertisement';
                            modalHeader.classList.add('bg-warning');
                            confirmBtn.classList.add('btn-warning');
                            confirmBtn.textContent = 'Pause';
                        } else if (type === 'resume') {
                            modalBody.innerHTML =
                                '<p>Are you sure you want to resume this advertisement?</p>';
                            modalTitle.textContent = 'Resume Advertisement';
                            modalHeader.classList.add('bg-success');
                            confirmBtn.classList.add('btn-success');
                            confirmBtn.textContent = 'Resume';
                        }
                    });
                });
                // Delete modal logic
                document.querySelectorAll('.delete-ad-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var action = this.getAttribute('data-action');
                        var title = this.getAttribute('data-title');
                        document.getElementById('deleteAdForm').setAttribute('action', action);
                        document.getElementById('deleteAdTitle').textContent = title;
                    });
                });
            });
        </script>
    @endpush
@endsection
