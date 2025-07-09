@extends('layouts.app.admin')

@section('title', 'Flash Sales Management')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Flash Sales Management</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Manage and monitor all flash sales created by sellers</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->

                    <!-- Search and Filter -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form method="GET" action="{{ route('admin.flash-sales.index') }}" class="gy-3">
                                    <div class="row g-3 align-end">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="search">Search</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="search" name="search"
                                                        value="{{ request('search') }}"
                                                        placeholder="Search by title, slug, product, or seller...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label" for="status">Status</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" id="status" name="status">
                                                        <option value="">All Status</option>
                                                        @foreach ($statusOptions as $value => $label)
                                                            <option value="{{ $value }}"
                                                                {{ request('status') == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label" for="discount_type">Discount Type</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-select" id="discount_type" name="discount_type">
                                                        <option value="">All Types</option>
                                                        @foreach ($discountTypeOptions as $value => $label)
                                                            <option value="{{ $value }}"
                                                                {{ request('discount_type') == $value ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label" for="date_from">Start From</label>
                                                <div class="form-control-wrap">
                                                    <input type="date" class="form-control" id="date_from"
                                                        name="date_from" value="{{ request('date_from') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <em class="icon ni ni-search"></em>
                                                    <span>Filter</span>
                                                </button>
                                                <a href="{{ route('admin.flash-sales.index') }}"
                                                    class="btn btn-outline-light">
                                                    <em class="icon ni ni-reload"></em>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- .nk-block -->

                    <!-- Flash Sales List -->
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
                                                        <option value="export">Export Selected</option>
                                                    </select>
                                                </div>
                                                <div class="btn-wrap">
                                                    <span class="d-none d-md-block">
                                                        <button
                                                            class="btn btn-dim btn-outline-light disabled">Apply</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-tools me-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em
                                                                            class="icon ni ni-download-cloud"></em><span>Export
                                                                            All</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0">
                                    <div class="nk-tb-list nk-tb-ulist">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                                    <label class="custom-control-label" for="selectAll"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col"><span class="sub-text">Flash Sale</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Seller</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Products</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Discount</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Duration</span></div>
                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools text-end">
                                                <div class="dropdown">
                                                    <a href="#"
                                                        class="btn btn-xs btn-outline-light btn-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" data-offset="0,5"><em
                                                            class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                        <ul class="link-tidy sm no-bdr">
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="showSeller">
                                                                    <label class="custom-control-label"
                                                                        for="showSeller">Seller</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="showProducts" checked>
                                                                    <label class="custom-control-label"
                                                                        for="showProducts">Products</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div
                                                                    class="custom-control custom-control-sm custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="showDiscount" checked>
                                                                    <label class="custom-control-label"
                                                                        for="showDiscount">Discount</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .nk-tb-item -->

                                        @forelse ($flashSales as $flashSale)
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="flashsale-{{ $flashSale->id }}">
                                                        <label class="custom-control-label"
                                                            for="flashsale-{{ $flashSale->id }}"></label>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <a href="{{ route('admin.flash-sales.show', $flashSale->slug) }}">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead">{{ $flashSale->title }}
                                                                    <span class="dot dot-success d-md-none ms-1"></span>
                                                                </span>
                                                                <span
                                                                    class="text-soft">#{{ str_pad($flashSale->id, 4, '0', STR_PAD_LEFT) }}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    @if ($flashSale->products->isNotEmpty())
                                                        @php
                                                            $firstSeller = $flashSale->products->first()->seller;
                                                            $sellerCount = $flashSale->products
                                                                ->pluck('seller_id')
                                                                ->unique()
                                                                ->count();
                                                        @endphp
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span
                                                                    class="tb-lead">{{ $firstSeller->business_name }}</span>
                                                                @if ($sellerCount > 1)
                                                                    <span class="text-soft">+{{ $sellerCount - 1 }}
                                                                        more</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-soft">No products</span>
                                                    @endif
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    @if ($flashSale->products->count() > 0)
                                                        <div class="user-avatar-group">
                                                            @foreach ($flashSale->products->take(3) as $product)
                                                                <div class="user-avatar xs" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{ $product->title }}">
                                                                    @if ($product->images->first())
                                                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                                                            alt="{{ $product->title }}">
                                                                    @else
                                                                        <span>{{ substr($product->title, 0, 2) }}</span>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                            @if ($flashSale->products->count() > 3)
                                                                <div class="user-avatar xs">
                                                                    <span>+{{ $flashSale->products->count() - 3 }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <span class="text-soft">{{ $flashSale->products->count() }}
                                                            product(s)</span>
                                                    @else
                                                        <span class="text-soft">No products</span>
                                                    @endif
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <div class="text-end">
                                                        <span
                                                            class="fw-bold text-{{ $flashSale->discount_type === 'percentage' ? 'success' : 'info' }}">
                                                            @if ($flashSale->discount_type === 'percentage')
                                                                {{ $flashSale->discount_value }}%
                                                            @else
                                                                {{ number_format($flashSale->discount_value, 0) }} DJF
                                                            @endif
                                                        </span>
                                                        <small
                                                            class="text-soft d-block">{{ $flashSale->getDiscountTypeLabel() }}</small>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <div>
                                                        <small
                                                            class="text-soft">{{ $flashSale->start_at->format('M d, Y H:i') }}</small>
                                                        <small
                                                            class="text-soft d-block">{{ $flashSale->end_at->format('M d, Y H:i') }}</small>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span
                                                        class="tb-status text-{{ $flashSale->getStatusColor() }}">{{ $flashSale->getStatusLabel() }}</span>
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
                                                                                href="{{ route('admin.flash-sales.show', $flashSale->slug) }}"><em
                                                                                    class="icon ni ni-eye"></em><span>View
                                                                                    Details</span></a></li>
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
                                                    <div class="text-center p-4">
                                                        <div class="mb-3">
                                                            <em class="icon ni ni-hot"
                                                                style="font-size: 3rem; opacity: 0.3;"></em>
                                                        </div>
                                                        <h5 class="text-muted">No Flash Sales Found</h5>
                                                        <p class="text-muted">No flash sales match your current filters.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->

                                @if ($flashSales->hasPages())
                                    <div class="card-inner">
                                        <div class="nk-block-between-md g-3">
                                            <div class="g">
                                                {{ $flashSales->links() }}
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize select2
            $('.js-select2').select2();

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Select all functionality
            $('#selectAll').on('change', function() {
                $('input[type="checkbox"][id^="flashsale-"]').prop('checked', this.checked);
            });

            // Individual checkbox change
            $('input[type="checkbox"][id^="flashsale-"]').on('change', function() {
                var total = $('input[type="checkbox"][id^="flashsale-"]').length;
                var checked = $('input[type="checkbox"][id^="flashsale-"]:checked').length;

                $('#selectAll').prop('indeterminate', checked > 0 && checked < total);
                $('#selectAll').prop('checked', checked === total);
            });
        });
    </script>
@endsection
