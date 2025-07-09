@extends('layouts.app.buyer')

@section('title', 'Vendors Listing')

@section('content')
    <main class="main">
        <x-buyer.breadcrumb :items="[['text' => 'Home', 'url' => route('buyer.home')], ['text' => 'Vendor listing', 'url' => null]]" />

        <section class="section-box shop-template mt-0">
            <div class="container">
                <h2>Vendors Listing</h2>
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-30">
                        <p class="font-md color-gray-500">We have<span class="font-md-bold color-brand-3">
                                {{ $vendors->total() }}</span><span> vendors now</span></p>
                    </div>
                    <div class="col-lg-6 mb-30 text-end">
                        <a class="font-sm color-gray-900 mr-30" href="#">Support Ticket</a>
                        <a class="font-sm color-gray-900 mr-30" href="#">Become an Affiliate</a>
                        <a class="btn btn-buy w-auto font-sm-bold" href="{{ route('seller.register') }}">Open a Shop</a>
                    </div>
                </div>
                <div class="border-bottom pt-0 mb-30"></div>

                <div class="row">
                    <div class="col-lg-9 order-first order-lg-last">
                        <div class="box-filters mt-0 pb-5 border-bottom">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 mb-10 text-lg-start text-center">
                                    <a class="btn btn-filter font-sm color-brand-3 font-medium" href="#ModalFiltersForm"
                                        data-bs-toggle="modal">All Filters</a>
                                </div>
                                <div class="col-xl-10 col-lg-9 mb-10 text-lg-end text-center">
                                    <span class="font-sm color-gray-900 font-medium border-1-right span">Showing
                                        {{ $vendors->firstItem() }}–{{ $vendors->lastItem() }} of {{ $vendors->total() }}
                                        results</span>
                                    <div class="d-inline-block">
                                        <span class="font-sm color-gray-500 font-medium">Sort by:</span>
                                        <div class="dropdown dropdown-sort border-1-right">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                @switch(request('sort', 'latest'))
                                                    @case('oldest')
                                                        Oldest added
                                                    @break

                                                    @case('name_asc')
                                                        Name A-Z
                                                    @break

                                                    @case('name_desc')
                                                        Name Z-A
                                                    @break

                                                    @default
                                                        Latest added
                                                @endswitch
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                                                <li><a class="dropdown-item {{ request('sort') == 'latest' || !request('sort') ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">Latest
                                                        added</a></li>
                                                <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Oldest
                                                        added</a></li>
                                                <li><a class="dropdown-item {{ request('sort') == 'name_asc' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">Name
                                                        A-Z</a></li>
                                                <li><a class="dropdown-item {{ request('sort') == 'name_desc' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">Name
                                                        Z-A</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <span class="font-sm color-gray-500 font-medium">Show</span>
                                        <div class="dropdown dropdown-sort border-1-right">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort2" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span>{{ request('per_page', 30) }} items</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                                <li><a class="dropdown-item {{ request('per_page') == '30' || !request('per_page') ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 30]) }}">30
                                                        items</a></li>
                                                <li><a class="dropdown-item {{ request('per_page') == '50' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}">50
                                                        items</a></li>
                                                <li><a class="dropdown-item {{ request('per_page') == '100' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 100]) }}">100
                                                        items</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <a class="view-type-grid mr-5 active" href="{{ route('vendors.index') }}"></a>
                                        <a class="view-type-list" href="#"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-20">
                            @forelse($vendors as $vendor)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card-vendor">
                                        <div class="card-top-vendor">
                                            <div class="card-top-vendor-left">
                                                @if ($vendor->avatar)
                                                    <img src="{{ asset('storage/' . $vendor->avatar) }}"
                                                        alt="{{ $vendor->name }}">
                                                @else
                                                    @php
                                                        $nameParts = explode(' ', trim($vendor->name));
                                                        $initials =
                                                            count($nameParts) > 1
                                                                ? strtoupper(
                                                                    substr($nameParts[0], 0, 1) .
                                                                        substr(end($nameParts), 0, 1),
                                                                )
                                                                : strtoupper(substr($nameParts[0] ?? '', 0, 2));
                                                    @endphp
                                                    <div class="vendor-avatar-initials d-flex align-items-center justify-content-center"
                                                        style="
                                                            width: 60px; 
                                                            height: 60px; 
                                                            background-color: #e5e7eb; 
                                                            font-size: 1rem; 
                                                            font-weight: 600; 
                                                            border-radius: .2rem;
                                                            border: 2px solid #fff;
                                                            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                                        ">
                                                        {{ $initials }}
                                                    </div>
                                                @endif
                                                <div class="rating">
                                                    @php
                                                        $averageRating =
                                                            $vendor->products->flatMap->reviews->avg('rating') ?? 0;
                                                        $reviewsCount = $vendor->products->flatMap->reviews->count();
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <img src="{{ asset('assets/imgs/template/icons/' . ($i <= $averageRating ? 'star.svg' : 'star-gray.svg')) }}"
                                                            alt="Star">
                                                    @endfor
                                                    <span class="font-xs color-gray-500"> ({{ $reviewsCount }})</span>
                                                </div>
                                            </div>
                                            <div class="card-top-vendor-right">
                                                <a class="btn btn-gray"
                                                    href="{{ route('vendors.show', $vendor) }}">{{ $vendor->products->count() }}
                                                    Products</a>
                                                <p class="font-xs color-gray-500 mt-10">Member since
                                                    {{ $vendor->created_at->format('Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="card-bottom-vendor">
                                            <h6 class="vendor-name mb-5">{{ $vendor->name }}</h6>
                                            @if ($vendor->businessActivity)
                                                <p class="font-xs color-gray-500 mb-5">
                                                    {{ $vendor->businessActivity->name }}</p>
                                            @endif
                                            <p class="font-sm color-gray-500 location mb-10">
                                                {{ $vendor->address ?? 'Address not provided' }}</p>
                                            <p class="font-sm color-gray-500 phone">
                                                {{ $vendor->phone ?? 'Phone not provided' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <h5>No vendors found</h5>
                                        <p class="text-muted">Try adjusting your search criteria</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if ($vendors->hasPages())
                            <nav>
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($vendors->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link page-prev"></span></li>
                                    @else
                                        <li class="page-item"><a class="page-link page-prev"
                                                href="{{ $vendors->previousPageUrl() }}"></a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($vendors->getUrlRange(1, $vendors->lastPage()) as $page => $url)
                                        @if ($page == $vendors->currentPage())
                                            <li class="page-item"><a class="page-link active"
                                                    href="#">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($vendors->hasMorePages())
                                        <li class="page-item"><a class="page-link page-next"
                                                href="{{ $vendors->nextPageUrl() }}"></a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link page-next"></span></li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>

                    <div class="col-lg-3 order-last order-lg-first">
                        <div class="sidebar-border">
                            <div class="sidebar-head">
                                <h6 class="color-gray-900">Vendor by industry</h6>
                            </div>
                            <div class="sidebar-content">
                                <ul class="list-nav-arrow">
                                    @foreach ($businessActivities as $activity)
                                        @php
                                            $count = $vendorsByIndustry->get($activity->id)?->count ?? 0;
                                        @endphp
                                        @if ($count > 0)
                                            <li>
                                                <a
                                                    href="{{ request()->fullUrlWithQuery(['industry' => $activity->id]) }}">
                                                    {{ $activity->name }}
                                                    <span class="number">{{ $count }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="box-slider-item">
                            <div class="head pb-15 border-brand-2 mb-20">
                                <h5 class="color-gray-900">Make money with us</h5>
                            </div>
                            <div class="content-slider mb-50">
                                <div class="footer">
                                    <ul class="menu-footer">
                                        <li><a href="{{ route('seller.register') }}">Open shop on DjibMarket</a></li>
                                        <li><a href="javascript:void(0);" onclick="showWhatsAppDialog()">Sell Your
                                                Services on DjibMarket</a></li>
                                        <li><a href="javascript:void(0);" onclick="showWhatsAppDialog()">Sell on
                                                DjibMarket Business</a></li>
                                        <li><a href="javascript:void(0);" onclick="showWhatsAppDialog()">Sell Your Apps on
                                                DjibMarket</a></li>
                                        <li><a href="javascript:void(0);" onclick="showWhatsAppDialog()">Become an
                                                Affiliate</a></li>
                                        <li><a href="javascript:void(0);" onclick="showWhatsAppDialog()">Advertise Your
                                                Products</a></li>
                                        <li><a href="javascript:void(0);" onclick="showWhatsAppDialog()">Sell-Publish with
                                                Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script>
        function showWhatsAppDialog() {
            showCustomDialog({
                title: 'Contact Support',
                message: 'You will be redirected to a WhatsApp chat for support. Our team will assist you with your order and any questions you may have.',
                confirmText: 'Open WhatsApp',
                cancelText: 'Cancel',
                type: 'warning',
                onConfirm: function() {
                    window.open('https://wa.me/25377608558', '_blank');
                }
            });
        }

        function showCustomDialog(options) {
            const {
                title = 'Confirm',
                    message = 'Are you sure?',
                    confirmText = 'Confirm',
                    cancelText = 'Cancel',
                    type = 'info', // info, warning, danger, success
                    onConfirm = () => {},
                    onCancel = () => {}
            } = options;

            // Remove existing dialogs
            document.querySelectorAll('.custom-dialog-overlay').forEach(dialog => dialog.remove());

            // Create dialog overlay
            const overlay = document.createElement('div');
            overlay.className = 'custom-dialog-overlay';
            overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        `;

            // Create dialog box
            const dialog = document.createElement('div');
            dialog.className = 'custom-dialog';
            dialog.style.cssText = `
            background: white;
            border-radius: 12px;
            padding: 0;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            overflow: hidden;
        `;

            // Get colors based on type
            const colors = {
                info: {
                    bg: '#3b82f6',
                    light: '#dbeafe'
                },
                warning: {
                    bg: '#f59e0b',
                    light: '#fef3c7'
                },
                danger: {
                    bg: '#ef4444',
                    light: '#fee2e2'
                },
                success: {
                    bg: '#10b981',
                    light: '#d1fae5'
                }
            };

            const color = colors[type] || colors.info;

            // Create dialog content
            dialog.innerHTML = `
            <div style="background: ${color.light}; padding: 20px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; color: ${color.bg}; font-size: 18px; font-weight: 600;">${title}</h3>
            </div>
            <div style="padding: 20px;">
                <p style="margin: 0 0 20px 0; color: #374151; line-height: 1.5;">${message}</p>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button class="dialog-cancel-btn" style="
                        padding: 10px 20px;
                        border: 1px solid #d1d5db;
                        background: white;
                        color: #374151;
                        border-radius: 6px;
                        cursor: pointer;
                        font-weight: 500;
                        transition: all 0.2s ease;
                    ">${cancelText}</button>
                    <button class="dialog-confirm-btn" style="
                        padding: 10px 20px;
                        border: none;
                        background: ${color.bg};
                        color: white;
                        border-radius: 6px;
                        cursor: pointer;
                        font-weight: 500;
                        transition: all 0.2s ease;
                    ">${confirmText}</button>
                </div>
            </div>
        `;

            overlay.appendChild(dialog);
            document.body.appendChild(overlay);

            // Add hover effects
            const cancelBtn = dialog.querySelector('.dialog-cancel-btn');
            const confirmBtn = dialog.querySelector('.dialog-confirm-btn');

            cancelBtn.addEventListener('mouseenter', () => {
                cancelBtn.style.background = '#f3f4f6';
                cancelBtn.style.borderColor = '#9ca3af';
            });
            cancelBtn.addEventListener('mouseleave', () => {
                cancelBtn.style.background = 'white';
                cancelBtn.style.borderColor = '#d1d5db';
            });

            confirmBtn.addEventListener('mouseenter', () => {
                confirmBtn.style.transform = 'translateY(-1px)';
                confirmBtn.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
            });
            confirmBtn.addEventListener('mouseleave', () => {
                confirmBtn.style.transform = 'translateY(0)';
                confirmBtn.style.boxShadow = 'none';
            });

            // Show dialog with animation
            setTimeout(() => {
                overlay.style.opacity = '1';
                dialog.style.transform = 'scale(1)';
            }, 10);

            // Close function
            const closeDialog = () => {
                overlay.style.opacity = '0';
                dialog.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    overlay.remove();
                }, 300);
            };

            // Event listeners
            dialog.querySelector('.dialog-confirm-btn').addEventListener('click', () => {
                onConfirm();
                closeDialog();
            });

            dialog.querySelector('.dialog-cancel-btn').addEventListener('click', () => {
                onCancel();
                closeDialog();
            });

            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    onCancel();
                    closeDialog();
                }
            });
        }
    </script>
@endsection
