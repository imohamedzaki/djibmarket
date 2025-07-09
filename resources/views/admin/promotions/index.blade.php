@extends('layouts.app.admin')

@section('title', 'Promotions Management')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Promotions Management</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Manage all promotions across the platform</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li><a href="{{ route('admin.promotions.create') }}"
                                                    class="btn btn-white btn-outline-light"><em
                                                        class="icon ni ni-plus"></em><span>Add Promotion</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block">
                        <div class="card card-bordered card-stretch">
                            <div class="card-inner-group">
                                <div class="card-inner position-relative card-tools-toggle">
                                    <div class="card-title-group">
                                        <div class="card-tools">
                                            <div class="form-inline flex-nowrap gx-3">
                                                <div class="form-wrap w-150px">
                                                    <select class="form-select js-select2" data-search="off"
                                                        data-placeholder="Bulk Action">
                                                        <option value="">Bulk Action</option>
                                                        <option value="activate">Activate</option>
                                                        <option value="deactivate">Deactivate</option>
                                                    </select>
                                                </div>
                                                <div class="btn-wrap">
                                                    <span class="d-none d-md-block"><button
                                                            class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                    <span class="d-md-none"><button
                                                            class="btn btn-dim btn-outline-light btn-icon disabled"><em
                                                                class="icon ni ni-arrow-right"></em></button></span>
                                                </div>
                                            </div><!-- .form-inline -->
                                        </div><!-- .card-tools -->
                                        <div class="card-tools me-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <a href="#" class="btn btn-icon search-toggle toggle-search"
                                                        data-target="search"><em class="icon ni ni-search"></em></a>
                                                </li><!-- li -->
                                                <li class="btn-toolbar-sep"></li><!-- li -->
                                                <li>
                                                    <div class="toggle-wrap">
                                                        <a href="#" class="btn btn-icon btn-trigger toggle"
                                                            data-target="cardTools"><em
                                                                class="icon ni ni-menu-right"></em></a>
                                                        <div class="toggle-content" data-content="cardTools">
                                                            <ul class="btn-toolbar gx-1">
                                                                <li class="toggle-close">
                                                                    <a href="#"
                                                                        class="btn btn-icon btn-trigger toggle"
                                                                        data-target="cardTools"><em
                                                                            class="icon ni ni-arrow-left"></em></a>
                                                                </li>
                                                                <li>
                                                                    <div class="dropdown">
                                                                        <a href="#"
                                                                            class="btn btn-trigger btn-icon dropdown-toggle"
                                                                            data-bs-toggle="dropdown">
                                                                            <em class="icon ni ni-setting"></em>
                                                                        </a>
                                                                        <div
                                                                            class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                            <ul class="link-check">
                                                                                <li><span>Show</span></li>
                                                                                <li class="active"><a href="#">10</a>
                                                                                </li>
                                                                                <li><a href="#">20</a></li>
                                                                                <li><a href="#">50</a></li>
                                                                            </ul>
                                                                            <ul class="link-check">
                                                                                <li><span>Order</span></li>
                                                                                <li class="active"><a
                                                                                        href="#">DESC</a></li>
                                                                                <li><a href="#">ASC</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .card-title-group -->
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search"
                                                    data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input type="text"
                                                    class="form-control border-transparent form-focus-none"
                                                    placeholder="Search by title or reference">
                                                <button class="search-submit btn btn-icon"><em
                                                        class="icon ni ni-search"></em></button>
                                            </div>
                                        </div>
                                    </div><!-- .card-search -->
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col"><span class="sub-text">Promotion</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Campaign</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Created By</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Start Date</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">End Date</span></div>
                                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                <div class="dropdown">
                                                    <a href="#"
                                                        class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" data-offset="0,5"><em
                                                            class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                        <ul class="link-tidy sm">
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        checked="" id="col-id">
                                                                    <label class="custom-control-label"
                                                                        for="col-id">ID</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        checked="" id="col-type">
                                                                    <label class="custom-control-label"
                                                                        for="col-type">Type</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        checked="" id="col-campaign">
                                                                    <label class="custom-control-label"
                                                                        for="col-campaign">Campaign</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        @forelse ($promotions as $promotion)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="promotion-{{ $promotion->id }}">
                                                        <label class="custom-control-label"
                                                            for="promotion-{{ $promotion->id }}"></label>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead">
                                                                <a
                                                                    href="{{ route('admin.promotions.show', $promotion) }}">{{ $promotion->title }}</a>
                                                                <span class="dot dot-success d-md-none ms-1"></span>
                                                            </span>
                                                            <span class="tb-sub">{{ $promotion->ref }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-mb">
                                                    <span
                                                        class="tb-amount">{{ $promotion->promotion_type->label() }}</span>
                                                    @if ($promotion->discount_value)
                                                        <span class="tb-amount-sm">
                                                            {{ $promotion->discount_value }}
                                                            @if ($promotion->promotion_type->value === 'percentage_discount')
                                                                %
                                                            @else
                                                                DJF
                                                            @endif
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    @if ($promotion->campaign)
                                                        <span class="tb-sub">
                                                            <a
                                                                href="{{ route('admin.campaigns.show', $promotion->campaign->slug) }}">
                                                                {{ $promotion->campaign->name }}
                                                            </a>
                                                        </span>
                                                    @else
                                                        <span class="tb-sub text-muted">No Campaign</span>
                                                    @endif
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    @if ($promotion->admin)
                                                        <span class="tb-sub">Admin: {{ $promotion->admin->name }}</span>
                                                    @elseif ($promotion->seller)
                                                        <span class="tb-sub">Seller:
                                                            {{ $promotion->seller->business_name }}</span>
                                                    @else
                                                        <span class="tb-sub text-muted">Unknown</span>
                                                    @endif
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span
                                                        class="tb-sub">{{ $promotion->start_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub">{{ $promotion->end_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-mb">
                                                    @if ($promotion->is_active && $promotion->end_at > now())
                                                        <span class="tb-status text-success">Active</span>
                                                    @elseif ($promotion->end_at < now())
                                                        <span class="tb-status text-warning">Expired</span>
                                                    @else
                                                        <span class="tb-status text-danger">Inactive</span>
                                                    @endif
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#"
                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-bs-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a
                                                                                href="{{ route('admin.promotions.show', $promotion) }}"><em
                                                                                    class="icon ni ni-eye"></em><span>View
                                                                                    Details</span></a></li>
                                                                        @if ($promotion->admin_id === auth()->guard('admin')->id())
                                                                            <li><a href="#" class="edit-promotion"
                                                                                    data-promotion-id="{{ $promotion->id }}"><em
                                                                                        class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                            </li>
                                                                            <li>
                                                                                <form
                                                                                    action="{{ route('admin.promotions.destroy', $promotion) }}"
                                                                                    method="POST" class="d-inline"
                                                                                    onsubmit="return confirm('Are you sure you want to delete this promotion?')">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="btn-link link-list-opt-item text-danger">
                                                                                        <em
                                                                                            class="icon ni ni-trash"></em><span>Delete</span>
                                                                                    </button>
                                                                                </form>
                                                                            </li>
                                                                        @else
                                                                            <li><span
                                                                                    class="link-list-opt-item text-muted"><em
                                                                                        class="icon ni ni-lock"></em><span>Read
                                                                                        Only</span></span></li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                        @empty
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <div class="text-center py-4">
                                                        <em class="icon ni ni-tag-fill"
                                                            style="font-size: 48px; opacity: 0.3;"></em>
                                                        <h5 class="mt-2">No Promotions Found</h5>
                                                        <p class="text-muted">There are no promotions created yet.</p>
                                                        <a href="{{ route('admin.promotions.create') }}"
                                                            class="btn btn-primary">
                                                            <em class="icon ni ni-plus"></em>
                                                            <span>Create First Promotion</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                                @if ($promotions->hasPages())
                                    <div class="card-inner">
                                        <div class="nk-block-between-md g-3">
                                            <div class="g">
                                                {{ $promotions->links() }}
                                            </div>
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .card-inner -->
                                @endif
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Promotion Modal -->
    <div class="modal fade" id="editPromotionModal" tabindex="-1" aria-labelledby="editPromotionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPromotionModalLabel">Edit Promotion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPromotionForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit_title">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_title" name="title" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit_description">Description</label>
                                    <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit_start_at">Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="edit_start_at" name="start_at"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit_end_at">End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="edit_end_at" name="end_at"
                                        required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="edit_is_active"
                                            name="is_active" value="1">
                                        <label class="custom-control-label" for="edit_is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="editPromotionForm" class="btn btn-primary">Update Promotion</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Edit promotion functionality
            $('.edit-promotion').on('click', function(e) {
                e.preventDefault();

                const promotionId = $(this).data('promotion-id');

                // Fetch promotion data
                $.get(`/admin/promotions/${promotionId}/edit-data`)
                    .done(function(data) {
                        // Populate the modal form
                        $('#edit_title').val(data.title);
                        $('#edit_description').val(data.description);
                        $('#edit_start_at').val(data.start_at.replace(' ', 'T').substring(0, 16));
                        $('#edit_end_at').val(data.end_at.replace(' ', 'T').substring(0, 16));
                        $('#edit_is_active').prop('checked', data.is_active);

                        // Set form action
                        $('#editPromotionForm').attr('action', `/admin/promotions/${promotionId}`);

                        // Show modal
                        $('#editPromotionModal').modal('show');
                    })
                    .fail(function(xhr) {
                        if (xhr.status === 403) {
                            alert('You can only edit promotions that you created.');
                        } else {
                            alert('Error loading promotion data.');
                        }
                    });
            });
        });
    </script>
@endpush
