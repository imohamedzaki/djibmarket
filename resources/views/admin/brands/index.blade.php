@extends('layouts.app.admin')
@section('title', 'Brand Management')

@section('style')
    <style>
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endsection
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Brand Management</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Brands</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <a href="{{ route('admin.brands.create') }}"
                            class="btn btn-outline-primary d-none d-sm-inline-flex">
                            <em class="icon ni ni-plus"></em><span>Add Brand</span>
                        </a>
                        <a href="{{ route('admin.brands.create') }}"
                            class="btn btn-icon btn-outline-primary d-inline-flex d-sm-none">
                            <em class="icon ni ni-plus"></em>
                        </a>
                    </div>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Brands</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage brands.</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card card-bordered">
                    <div class="card-inner border-bottom">
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <input type="text" class="form-control" id="searchInput"
                                            placeholder="Search brands..." value="{{ request('search') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select class="form-select js-select2" id="brandTypeFilter"
                                        data-placeholder="All Types">
                                        <option value="">All Brand Types</option>
                                        @foreach ($brandTypes as $brandType)
                                            <option value="{{ $brandType->id }}"
                                                {{ request('brand_type_id') == $brandType->id ? 'selected' : '' }}>
                                                {{ $brandType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select class="form-select" id="sortBy">
                                        <option value="created_at"
                                            {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name
                                        </option>
                                        <option value="updated_at"
                                            {{ request('sort_by') == 'updated_at' ? 'selected' : '' }}>Last Updated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select class="form-select" id="sortDirection">
                                        <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>
                                            Descending</option>
                                        <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>
                                            Ascending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" id="applyFilters">
                                        <em class="icon ni ni-filter-alt"></em>&nbsp;Apply Filters
                                    </button>
                                    <button type="button" class="btn btn-light" id="clearFilters">
                                        <em class="icon ni ni-cross"></em>&nbsp;Clear
                                    </button>
                                </div>
                            </div>
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
                                    <th class="nk-tb-col"><span class="sub-text">Brand</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Type</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Categories</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Website</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Created</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($brands as $brand)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="brand-{{ $brand->id }}">
                                                <label class="custom-control-label"
                                                    for="brand-{{ $brand->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar brand-image-container"
                                                    style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; flex-shrink: 0; position: relative;">
                                                    <!-- Skeleton loading placeholder -->
                                                    <div class="brand-skeleton"
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite;">
                                                    </div>

                                                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}"
                                                        class="brand-image"
                                                        style="width: 100%; height: 100%; object-fit: contain; background: #f8f9fa; opacity: 0; transition: opacity 0.3s ease;"
                                                        loading="lazy"
                                                        onload="this.style.opacity='1'; this.parentElement.querySelector('.brand-skeleton').style.display='none';"
                                                        onerror="this.src='{{ asset('assets/imgs/template/logo_only.png') }}'; this.style.opacity='1'; this.style.filter='grayscale(100%)'; this.parentElement.querySelector('.brand-skeleton').style.display='none';" />
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $brand->name }}</span>
                                                    <span class="tb-sub">{{ $brand->slug }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            @if ($brand->type)
                                                <span class="badge badge-dot bg-info">{{ $brand->type->name }}</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Type</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($brand->categories->count() > 0)
                                                <div class="tb-lead-sub">
                                                    @foreach ($brand->categories->take(2) as $category)
                                                        <span
                                                            class="badge badge-sm badge-dot badge-{{ $category->pivot->is_top_brand ? 'success' : 'light' }}">
                                                            {{ $category->name }}
                                                            @if ($category->pivot->is_top_brand)
                                                                <small>(Top)</small>
                                                            @endif
                                                        </span>
                                                    @endforeach
                                                    @if ($brand->categories->count() > 2)
                                                        <span
                                                            class="badge badge-dim">+{{ $brand->categories->count() - 2 }}
                                                            more</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="tb-sub">No categories</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            @if ($brand->website)
                                                <a href="{{ $brand->website }}" target="_blank"
                                                    class="link link-primary">
                                                    <em class="icon ni ni-external"></em>&nbsp;Visit
                                                </a>
                                            @else
                                                <span class="tb-sub">No website</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{ $brand->created_at->format('M d, Y') }}</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.brands.show', $brand) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-brand-button"
                                                        data-bs-toggle="modal" data-id="{{ $brand->id }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger remove-brand-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteBrandModal"
                                                        data-id="{{ $brand->id }}" data-name="{{ $brand->name }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check"></td>
                                        <td class="nk-tb-col text-center" colspan="6">
                                            <span class="text-soft">No brands found.</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools"></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->

                @if ($brands->count() > 0)
                    <div class="card card-bordered">
                        <div class="card-inner text-center">
                            <span class="text-soft">Total: {{ $brands->count() }} brands</span>
                        </div>
                    </div>
                @endif
            </div> <!-- nk-block -->
        </div>
    </div>

    <!-- Delete Brand Modal -->
    <div class="modal fade" id="deleteBrandModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Brand</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the brand <strong id="deleteBrandName"></strong>?</p>
                    <p class="text-soft">This action cannot be undone and will also remove all category associations.</p>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteBrandForm" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger submit-btn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Delete Brand</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Apply filters
            $('#applyFilters').on('click', function() {
                const search = $('#searchInput').val();
                const brandTypeId = $('#brandTypeFilter').val();
                const sortBy = $('#sortBy').val();
                const sortDirection = $('#sortDirection').val();

                const params = new URLSearchParams();
                if (search) params.append('search', search);
                if (brandTypeId) params.append('brand_type_id', brandTypeId);
                if (sortBy) params.append('sort_by', sortBy);
                if (sortDirection) params.append('sort_direction', sortDirection);

                window.location.href = '{{ route('admin.brands.index') }}?' + params.toString();
            });

            // Clear filters
            $('#clearFilters').on('click', function() {
                window.location.href = '{{ route('admin.brands.index') }}';
            });

            // Search on enter key
            $('#searchInput').on('keypress', function(e) {
                if (e.key === 'Enter') {
                    $('#applyFilters').click();
                }
            });

            // Edit brand button click
            $(document).on('click', '.edit-brand-button', function() {
                var brandId = $(this).data('id');
                // Redirect to edit page
                window.location.href = `/admin/brands/${brandId}/edit`;
            });

            // Delete brand button click
            $(document).on('click', '.remove-brand-button', function() {
                var brandId = $(this).data('id');
                var brandName = $(this).data('name');

                $('#deleteBrandName').text(brandName);
                $('#deleteBrandForm').attr('action', `/admin/brands/${brandId}`);
            });

            // Form submission with loading state
            $('#deleteBrandForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Deleting...');
                return true;
            });

            // Reset delete modal when closed
            $('#deleteBrandModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#deleteBrandForm .submit-btn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Delete Brand');
            });
        });
    </script>
@endsection
