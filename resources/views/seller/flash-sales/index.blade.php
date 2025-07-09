@extends('layouts.app.seller')
@section('title', 'Flash Sales')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Flash Sales</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Flash Sales</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        @if (Auth::guard('seller')->user()->status === 'pending')
                                            <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Flash sale creation is only available when your seller application has been accepted">
                                                <button class="btn btn-primary" disabled>
                                                    <em class="icon ni ni-lock"></em><span>Add Flash Sale (Locked)</span>
                                                </button>
                                            </span>
                                        @else
                                            <a href="{{ route('seller.flash-sales.create') }}" class="btn btn-primary">
                                                <em class="icon ni ni-plus"></em><span>Add Flash Sale</span>
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Pending Status Alert --}}
            @include('includes.seller-pending-alert')

            {{-- Session Success/Error Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />

            {{-- Validation Error Summary --}}
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Flash Sales</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage flash sales.</p>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table
                            class="datatable-init nk-tb-list nk-tb-ulist @if (count($flashSales) == 0) no-datatable @endif"
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
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Products</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Discount</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Total Stock</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Time Status</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($flashSales as $flashSale)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="flashsale-{{ $flashSale->id }}">
                                                <label class="custom-control-label"
                                                    for="flashsale-{{ $flashSale->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <em class="icon ni ni-hot-fill"></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $flashSale->title }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($flashSale->products && $flashSale->products->count() > 0)
                                                @foreach ($flashSale->products as $product)
                                                    @php
                                                        $truncatedTitle = strlen($product->title) > 45 ? substr($product->title, 0, 45) . '...' : $product->title;
                                                    @endphp
                                                    <span
                                                        class="badge badge-dot bg-primary me-1"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{ $product->title }}">{{ $truncatedTitle }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Products</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($flashSale->products && $flashSale->products->count() > 0)
                                                <div class="d-flex flex-column">
                                                    <span
                                                        class="fw-bold text-{{ $flashSale->discount_type === 'percentage' ? 'success' : 'info' }}">
                                                        {{ $flashSale->getDiscountTypeLabel() }}:
                                                        @if ($flashSale->discount_type === 'percentage')
                                                            {{ $flashSale->discount_value }}%
                                                        @else
                                                            {{ number_format($flashSale->discount_value, 2) }} DJF
                                                        @endif
                                                    </span>
                                                    <small class="text-muted">Applied to all products</small>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @if ($flashSale->products && $flashSale->products->count() > 0)
                                                <span class="fw-bold">{{ $flashSale->getTotalStock() }}</span>
                                                <small class="text-muted d-block">Total from
                                                    {{ $flashSale->products->count() }} product(s)</small>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            @php
                                                $now = now();
                                                $start = $flashSale->start_at;
                                                $end = $flashSale->end_at;
                                                $timeLeft = '';
                                                $timeColor = 'text-muted';
                                                
                                                if ($now < $start) {
                                                    // Flash sale hasn't started yet
                                                    $diff = $start->diff($now);
                                                    $timeLeft = 'Starts in ';
                                                    $timeColor = 'text-info';
                                                } elseif ($now >= $start && $now < $end) {
                                                    // Flash sale is active
                                                    $diff = $end->diff($now);
                                                    $timeLeft = 'Ends in ';
                                                    $timeColor = 'text-success';
                                                } else {
                                                    // Flash sale has ended
                                                    $timeLeft = 'Ended';
                                                    $timeColor = 'text-danger';
                                                }
                                                
                                                if (isset($diff)) {
                                                    if ($diff->days > 0) {
                                                        $timeLeft .= $diff->days . 'd ';
                                                    }
                                                    if ($diff->h > 0) {
                                                        $timeLeft .= $diff->h . 'h ';
                                                    }
                                                    if ($diff->i > 0) {
                                                        $timeLeft .= $diff->i . 'm';
                                                    }
                                                    if ($diff->days == 0 && $diff->h == 0 && $diff->i == 0) {
                                                        $timeLeft .= 'Less than 1m';
                                                    }
                                                }
                                            @endphp
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold {{ $timeColor }}">{{ $timeLeft }}</span>
                                                <small class="text-muted">{{ $flashSale->start_at->format('M d') }} - {{ $flashSale->end_at->format('M d, Y') }}</small>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span
                                                class="tb-status text-{{ $flashSale->getStatusColor() }}">{{ $flashSale->getStatusLabel() }}</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('seller.flash-sales.show', $flashSale->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('seller.flash-sales.edit', $flashSale->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-flashsale-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteFlashSaleModal"
                                                        data-slug="{{ $flashSale->slug }}"
                                                        data-name="{{ $flashSale->title }}"
                                                        data-delete-url="{{ route('seller.flash-sales.destroy', $flashSale->slug) }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @empty
                                    <!-- Empty state handled in tfoot -->
                                @endforelse
                            </tbody>
                            @if ($flashSales->count() == 0)
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="text-center p-4">
                                            <div class="py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-hot-fill"
                                                        style="font-size: 3rem; color: #c4c4c4;"></em>
                                                </div>
                                                <h6 class="text-muted">No flash sales found</h6>
                                                <p class="text-muted small">Start by adding your first flash sale using the
                                                    "Add Flash Sale" button above.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div><!-- .card-preview -->

                <!-- Pagination Links -->
                <div class="mt-3">
                    {{ $flashSales->links() }}
                </div>
            </div> <!-- nk-block -->
        </div>
    </div>

    {{-- Edit Flash Sale Modal --}}
    <div class="modal fade" id="editFlashSaleModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Flash Sale</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editFlashSaleForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-flashsale-id">
                        <input type="hidden" name="redirect_to" value="index">

                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-title">Flash Sale Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control @error('title', 'update') is-invalid @enderror"
                                            id="edit-flashsale-title" name="title" value="{{ old('title') }}"
                                            required>
                                    </div>
                                    @error('title', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-product">Product</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('product_id', 'update') is-invalid @enderror"
                                            id="edit-flashsale-product" name="product_id"
                                            data-placeholder="Select Product" required>
                                            <option value=""></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    data-price="{{ $product->price_regular }}">
                                                    {{ $product->title }} ({{ $product->price_regular }} DJF)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('product_id', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-discount-price">Discount Price</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('discount_price', 'update') is-invalid @enderror"
                                            id="edit-flashsale-discount-price" name="discount_price"
                                            value="{{ old('discount_price') }}" required step="0.01" min="0">
                                    </div>
                                    <div class="form-note">Must be less than the regular product price.</div>
                                    @error('discount_price', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-stock-limit">Stock Limit</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('stock_limit', 'update') is-invalid @enderror"
                                            id="edit-flashsale-stock-limit" name="stock_limit"
                                            value="{{ old('stock_limit') }}" required min="1">
                                    </div>
                                    @error('stock_limit', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-start-at">Start Date & Time</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local"
                                            class="form-control @error('start_at', 'update') is-invalid @enderror"
                                            id="edit-flashsale-start-at" name="start_at" value="{{ old('start_at') }}"
                                            required>
                                    </div>
                                    @error('start_at', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-end-at">End Date & Time</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local"
                                            class="form-control @error('end_at', 'update') is-invalid @enderror"
                                            id="edit-flashsale-end-at" name="end_at" value="{{ old('end_at') }}"
                                            required>
                                    </div>
                                    @error('end_at', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-usage-limit">Usage Limit Per User
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('usage_limit_per_user', 'update') is-invalid @enderror"
                                            id="edit-flashsale-usage-limit" name="usage_limit_per_user"
                                            value="{{ old('usage_limit_per_user') }}" min="1">
                                    </div>
                                    <div class="form-note">Leave blank for unlimited usage per user.</div>
                                    @error('usage_limit_per_user', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('status', 'update') is-invalid @enderror"
                                            id="edit-flashsale-status" name="status" required>
                                            @foreach (App\Models\FlashSale::getStatusOptions() as $value => $label)
                                                <option value="{{ $value }}" @selected(old('status') == $value)>
                                                    {{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('status', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                        id="updateFlashSaleBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Update Flash Sale</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the flash sale.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Flash Sale Confirmation Modal --}}
    <div class="modal fade" id="deleteFlashSaleModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Flash Sale</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-flashsale-title"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteFlashSaleForm">
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

        .user-avatar em {
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Initialize Select2 dropdowns for edit modal
            if ($.fn.select2) {
                $('#edit-flashsale-status').select2({
                    width: '100%',
                    minimumResultsForSearch: -1 // Disable search for status
                });
            }

            // Delete flash sale handling
            $(document).on('click', '.delete-flashsale-button', function() {
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-flashsale-title').text(name);
                $('#deleteFlashSaleForm').attr('action', deleteUrl);
            });

            $('#confirmDeleteBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteFlashSaleForm').submit();
            });
        });
    </script>
@endsection
