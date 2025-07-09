@extends('layouts.app.seller')

@section('title', 'Promotions')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Promotions</h3>
                <div class="nk-block-des text-soft">
                    <p>You have {{ $promotions->total() }} promotions in total.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                        <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                @if (Auth::guard('seller')->user()->status === 'pending')
                                    <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Promotion creation is only available when your seller application has been accepted">
                                        <button class="btn btn-primary" disabled>
                                            <em class="icon ni ni-lock"></em><span>Add Promotion (Locked)</span>
                                        </button>
                                    </span>
                                @else
                                    <a href="{{ route('seller.promotions.create') }}" class="btn btn-primary">
                                        <em class="icon ni ni-plus"></em><span>Add Promotion</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending Status Alert --}}
    @include('includes.seller-pending-alert')

    <div class="nk-block">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif

        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">List of Promotions</h4>
                    <div class="nk-block-des">
                        <p>Use the table below to view, edit, and manage promotions.</p>
                    </div>
                </div>
            </div>
            <div class="card card-preview">
                <div class="card-inner">
                    <table
                        class="datatable-init nk-tb-list nk-tb-ulist @if (count($promotions) == 0) no-datatable @endif"
                        data-auto-responsive="false">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </th>
                                <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Start Date</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">End Date</span></th>
                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($promotions as $promotion)
                                <tr class="nk-tb-item">
                                    <td class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input"
                                                id="promotion-{{ $promotion->id }}">
                                            <label class="custom-control-label"
                                                for="promotion-{{ $promotion->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col">
                                        <div class="user-card">
                                            <div class="user-info">
                                                <span class="tb-lead">
                                                    <a
                                                        href="{{ route('seller.promotions.show', $promotion) }}">{{ $promotion->title }}</a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <span>{{ $promotion->promotion_type->label() }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $promotion->start_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        <span>{{ $promotion->end_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="nk-tb-col tb-col-md">
                                        @if ($promotion->is_active && $promotion->start_at <= now() && $promotion->end_at >= now())
                                            <span class="badge badge-sm badge-dot bg-success">Active</span>
                                        @elseif($promotion->start_at > now())
                                            <span class="badge badge-sm badge-dot bg-warning">Upcoming</span>
                                        @elseif($promotion->end_at < now())
                                            <span class="badge badge-sm badge-dot bg-secondary">Expired</span>
                                        @else
                                            <span class="badge badge-sm badge-dot bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1">
                                            <li class="nk-tb-action-hidden">
                                                <a href="{{ route('seller.promotions.show', $promotion) }}"
                                                    class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="View Details">
                                                    <em class="icon ni ni-eye"></em>
                                                </a>
                                            </li>
                                            <li class="nk-tb-action-hidden">
                                                <a href="{{ route('seller.promotions.edit', $promotion) }}"
                                                    class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit">
                                                    <em class="icon ni ni-edit"></em>
                                                </a>
                                            </li>
                                            <li class="nk-tb-action-hidden">
                                                <button type="button"
                                                    class="btn btn-trigger btn-icon text-danger delete-promotion-button"
                                                    data-bs-toggle="modal" data-bs-target="#deletePromotionModal"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                    data-id="{{ $promotion->id }}" data-title="{{ $promotion->title }}"
                                                    data-delete-url="{{ route('seller.promotions.destroy', $promotion) }}">
                                                    <em class="icon ni ni-trash"></em>
                                                </button>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <!-- Empty state handled in tfoot -->
                            @endforelse
                        </tbody>
                        @if ($promotions->count() == 0)
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-center p-4">
                                        <div class="py-4">
                                            <div class="mb-3">
                                                <em class="icon ni ni-offer"
                                                    style="font-size: 3rem; color: #c4c4c4;"></em>
                                            </div>
                                            <h6 class="text-muted">No promotions found</h6>
                                            <p class="text-muted small">Start by adding your first promotion using the
                                                "Add Promotion" button above.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $promotions->links() }}
            </div>
        </div>
    </div>

    {{-- Delete Promotion Confirmation Modal --}}
    <div class="modal fade" id="deletePromotionModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Promotion</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-promotion-title"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deletePromotionForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
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

@section('js')
    <script>
        $(document).ready(function() {
            // Delete promotion handling
            $(document).on('click', '.delete-promotion-button', function() {
                var id = $(this).data('id');
                var title = $(this).data('title');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-promotion-title').text(title);
                $('#deletePromotionForm').attr('action', deleteUrl);
            });

            $('#confirmDeleteBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deletePromotionForm').submit();
            });
        });
    </script>
@endsection
