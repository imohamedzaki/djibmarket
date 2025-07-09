@extends('layouts.app.seller')
@section('title', 'Categories')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Categories</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Categories</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Pending Status Alert --}}
            @include('includes.seller-pending-alert')

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Categories</h4>
                        <div class="nk-block-des">
                            <p>Browse through the available product categories.</p>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Description</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Parent Category</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Products</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($categories as $category)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($category->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $category->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ Str::limit($category->description, 80) }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            @if ($category->parent)
                                                <span
                                                    class="badge badge-dot bg-primary">{{ $category->parent->name }}</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Category</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="badge badge-dim bg-primary">{{ $category->products_count }}</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <a href="{{ route('seller.categories.products', $category->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="View Products">
                                                        {{-- <em class="icon ni ni-package"></em> View Products --}}
                                                        <em class="icon ni ni-package"></em>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @empty
                                    <!-- Empty state handled in tfoot -->
                                @endforelse
                            </tbody>
                            @if ($categories->count() == 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-center p-4">
                                            <div class="py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-folder"
                                                        style="font-size: 3rem; color: #c4c4c4;"></em>
                                                </div>
                                                <h6 class="text-muted">No categories found</h6>
                                                <p class="text-muted small">Browse through the available product categories
                                                    or contact support.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div> <!-- nk-block -->
        </div>
    </div>
@endsection
@section('css')
    <style>
        .dataTables_empty {
            padding: 1rem;
        }
    </style>
@endsection
