@extends('layouts.app.admin')
@section('title', 'Advertisement Management')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Advertisement Management</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
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
                                        <a href="{{ route('admin.ads.create') }}" class="btn btn-primary">
                                            <em class="icon ni ni-plus"></em><span>Create Advertisement</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Session Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />

            <!-- Status Overview -->
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-sm-6 col-lg-2">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount">{{ $statusCounts['all'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Pending</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount text-warning">{{ $statusCounts['pending'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Active</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount text-success">{{ $statusCounts['active'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Approved</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount text-info">{{ $statusCounts['approved'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Paused</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount text-secondary">{{ $statusCounts['paused'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Rejected</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount text-danger">{{ $statusCounts['rejected'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Advertisement Requests</h4>
                        <div class="nk-block-des">
                            <p>Manage advertisement requests from sellers and create ads directly.</p>
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
                        @if ($ads->total() > 0)
                            <!-- Filter Controls -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Filter by Status:</label>
                                        <select class="form-select" id="status-filter">
                                            <option value="">All Statuses</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved"
                                                {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>
                                                Paused</option>
                                            <option value="rejected"
                                                {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            <option value="completed"
                                                {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
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
                                                    {{ request('ad_slot') == $slot ? 'selected' : '' }}>
                                                    {{ $displayName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Search:</label>
                                        <input type="text" class="form-control" id="search-ads"
                                            placeholder="Search ads or sellers..." value="{{ request('search') }}">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <table class="nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text">Advertisement</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Seller</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
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
                                                        class="fs-12px text-soft">{{ Str::limit($ad->description, 50) }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($ad->seller)
                                                <span class="tb-lead">{{ $ad->seller->name }}</span>
                                            @else
                                                <span class="text-soft">No seller</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-primary">{{ ucfirst($ad->status) }}</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <a href="{{ route('admin.ads.show', $ad) }}"
                                                        class="btn btn-trigger btn-icon">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col" colspan="4">
                                            <div class="text-center py-4">
                                                <h6>No advertisements found</h6>
                                                <p class="text-soft">Create your first advertisement for sellers.</p>
                                                <a href="{{ route('admin.ads.create') }}" class="btn btn-primary mt-2">
                                                    <em class="icon ni ni-plus"></em><span>Create Advertisement</span>
                                                </a>
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
                if (slot) params.append('ad_slot', slot);
                if (search) params.append('search', search);

                window.location.href = '{{ route('admin.ads.index') }}' + (params.toString() ? '?' + params.toString() : '');
            }
        </script>
    @endpush
@endsection
