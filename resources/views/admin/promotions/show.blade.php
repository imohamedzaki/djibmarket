@extends('layouts.app.admin')

@section('title', 'Promotion Details')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ $promotion->title }} <strong
                                        class="text-primary small">{{ $promotion->ref }}</strong></h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Created: <span
                                                class="text-base">{{ $promotion->created_at->format('M d, Y h:i A') }}</span>
                                        </li>
                                        <li>Updated: <span
                                                class="text-base">{{ $promotion->updated_at->format('M d, Y h:i A') }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('admin.promotions.index') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                <a href="{{ route('admin.promotions.index') }}"
                                    class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                        class="icon ni ni-arrow-left"></em></a>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->

                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-lg-8">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="nk-block">
                                            <div class="nk-block-head">
                                                <h5 class="title">Promotion Information</h5>
                                                <p>Details about this promotion.</p>
                                            </div>
                                            <div class="profile-ud-list">
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Title</span>
                                                        <span class="profile-ud-value">{{ $promotion->title }}</span>
                                                    </div>
                                                </div>
                                                @if ($promotion->description)
                                                    <div class="profile-ud-item">
                                                        <div class="profile-ud wider">
                                                            <span class="profile-ud-label">Description</span>
                                                            <span
                                                                class="profile-ud-value">{{ $promotion->description }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Reference</span>
                                                        <span class="profile-ud-value">{{ $promotion->ref }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Promotion Type</span>
                                                        <span
                                                            class="profile-ud-value">{{ $promotion->promotion_type->label() }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Start Date</span>
                                                        <span
                                                            class="profile-ud-value">{{ $promotion->start_at->format('M d, Y h:i A') }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">End Date</span>
                                                        <span
                                                            class="profile-ud-value">{{ $promotion->end_at->format('M d, Y h:i A') }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Status</span>
                                                        <span class="profile-ud-value">
                                                            @if ($promotion->is_active && $promotion->end_at > now())
                                                                <span class="badge badge-success">Active</span>
                                                            @elseif ($promotion->end_at < now())
                                                                <span class="badge badge-warning">Expired</span>
                                                            @else
                                                                <span class="badge badge-danger">Inactive</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Campaign Information -->
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Campaign</span>
                                                        <span class="profile-ud-value">
                                                            @if ($promotion->campaign)
                                                                <a href="{{ route('admin.campaigns.show', $promotion->campaign->slug) }}"
                                                                    class="text-primary">
                                                                    {{ $promotion->campaign->name }}
                                                                </a>
                                                                <span
                                                                    class="text-muted">({{ $promotion->campaign->ref }})</span>
                                                            @else
                                                                <span class="text-muted">No Campaign Associated</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Creator Information -->
                                                <div class="profile-ud-item">
                                                    <div class="profile-ud wider">
                                                        <span class="profile-ud-label">Created By</span>
                                                        <span class="profile-ud-value">
                                                            @if ($promotion->admin)
                                                                <span class="text-primary">Admin:
                                                                    {{ $promotion->admin->name }}</span>
                                                            @elseif ($promotion->seller)
                                                                <span class="text-info">Seller:
                                                                    {{ $promotion->seller->business_name }}</span>
                                                            @else
                                                                <span class="text-muted">Unknown</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Promotion Type Specific Fields -->
                                                @if (in_array($promotion->promotion_type->value, ['percentage_discount', 'fixed_amount_discount']))
                                                    @if ($promotion->discount_value)
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Discount Value</span>
                                                                <span class="profile-ud-value">
                                                                    {{ $promotion->discount_value }}
                                                                    @if ($promotion->promotion_type->value === 'percentage_discount')
                                                                        %
                                                                    @else
                                                                        DJF
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif

                                                @if ($promotion->min_purchase_amount)
                                                    <div class="profile-ud-item">
                                                        <div class="profile-ud wider">
                                                            <span class="profile-ud-label">Minimum Purchase</span>
                                                            <span
                                                                class="profile-ud-value">{{ number_format($promotion->min_purchase_amount, 0) }}
                                                                DJF</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($promotion->promotion_type->value === 'buy_x_get_y_free')
                                                    @if ($promotion->required_quantity)
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Required Quantity</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $promotion->required_quantity }}</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($promotion->free_quantity)
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Free Quantity</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $promotion->free_quantity }}</span>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($promotion->freeProduct)
                                                        <div class="profile-ud-item">
                                                            <div class="profile-ud wider">
                                                                <span class="profile-ud-label">Free Product</span>
                                                                <span
                                                                    class="profile-ud-value">{{ $promotion->freeProduct->name }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif

                                                @if ($promotion->usage_limit)
                                                    <div class="profile-ud-item">
                                                        <div class="profile-ud wider">
                                                            <span class="profile-ud-label">Usage Limit</span>
                                                            <span
                                                                class="profile-ud-value">{{ $promotion->usage_limit }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div><!-- .profile-ud-list -->
                                        </div><!-- .nk-block -->

                                        <!-- Products Section -->
                                        @if ($promotion->products->count() > 0)
                                            <div class="nk-block">
                                                <div class="nk-block-head">
                                                    <h5 class="title">Products in this Promotion
                                                        ({{ $promotion->products->count() }})</h5>
                                                    <p>Products that are part of this promotion.</p>
                                                </div>
                                                <div class="nk-tb-list">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span class="sub-text">Product</span></div>
                                                        <div class="nk-tb-col tb-col-sm"><span
                                                                class="sub-text">Seller</span></div>
                                                        <div class="nk-tb-col tb-col-sm"><span
                                                                class="sub-text">Price</span></div>
                                                        <div class="nk-tb-col tb-col-mb"><span
                                                                class="sub-text">Status</span></div>
                                                    </div>
                                                    @foreach ($promotion->products as $product)
                                                        <div class="nk-tb-item">
                                                            <div class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-avatar bg-primary">
                                                                        @if ($product->images->first())
                                                                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                                                alt="{{ $product->name }}">
                                                                        @else
                                                                            <span>{{ substr($product->name, 0, 2) }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead">{{ $product->name }}</span>
                                                                        <span class="tb-sub">{{ $product->sku }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-sm">
                                                                <span
                                                                    class="tb-sub">{{ $product->seller->business_name }}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-sm">
                                                                <span
                                                                    class="tb-amount">{{ number_format($product->price, 0) }}
                                                                    DJF</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-mb">
                                                                @if ($product->is_active)
                                                                    <span class="tb-status text-success">Active</span>
                                                                @else
                                                                    <span class="tb-status text-danger">Inactive</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div><!-- .card-inner -->
                                </div><!-- .card -->
                            </div><!-- .col -->

                            <div class="col-lg-4">
                                <div class="card card-bordered">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="user-card user-card-s2">
                                                @if ($promotion->banner_image)
                                                    <div class="user-avatar lg bg-primary">
                                                        <img src="{{ asset('storage/' . $promotion->banner_image) }}"
                                                            alt="Promotion Banner">
                                                    </div>
                                                @else
                                                    <div class="user-avatar lg bg-primary">
                                                        <span>{{ substr($promotion->title, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                                <div class="user-info">
                                                    <h5>{{ $promotion->title }}</h5>
                                                    <span
                                                        class="sub-text">{{ $promotion->promotion_type->label() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner card-inner-sm">
                                            <ul class="btn-toolbar justify-center gx-1">
                                                @if ($promotion->admin_id === auth()->guard('admin')->id())
                                                    <li><a href="#" class="btn btn-trigger btn-icon edit-promotion"
                                                            data-promotion-id="{{ $promotion->id }}"><em
                                                                class="icon ni ni-edit"></em></a></li>
                                                    <li>
                                                        <form action="{{ route('admin.promotions.destroy', $promotion) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this promotion?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-trigger btn-icon text-danger"><em
                                                                    class="icon ni ni-trash"></em></button>
                                                        </form>
                                                    </li>
                                                @else
                                                    <li><span class="text-muted"><em class="icon ni ni-lock"></em> Read
                                                            Only</span></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .card -->

                                <!-- Stats Card -->
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Quick Stats</h6>
                                            </div>
                                        </div>
                                        <ul class="nk-store-statistics">
                                            <li class="item">
                                                <div class="info">
                                                    <div class="title">Products</div>
                                                    <div class="count">{{ $promotion->products->count() }}</div>
                                                </div>
                                                <em class="icon ni ni-bag"></em>
                                            </li>
                                            <li class="item">
                                                <div class="info">
                                                    <div class="title">Duration</div>
                                                    <div class="count">
                                                        {{ $promotion->start_at->diffInDays($promotion->end_at) }} days
                                                    </div>
                                                </div>
                                                <em class="icon ni ni-calendar"></em>
                                            </li>
                                            @if ($promotion->usage_limit)
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Usage Limit</div>
                                                        <div class="count">{{ $promotion->usage_limit }}</div>
                                                    </div>
                                                    <em class="icon ni ni-users"></em>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .col -->
                        </div><!-- .row -->
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
