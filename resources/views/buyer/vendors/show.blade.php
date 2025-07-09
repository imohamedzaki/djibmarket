@extends('layouts.app.buyer')

@section('title', $vendor->name . ' - Vendor')

@section('content')
    <main class="main">
        <x-buyer.breadcrumb :items="[
            ['text' => 'Home', 'url' => route('buyer.home')],
            ['text' => 'Vendors', 'url' => route('vendors.index')],
            ['text' => $vendor->name, 'url' => null],
        ]" />

        <section class="section-box shop-template mt-30">
            <div class="container">
                <div class="d-flex box-banner-vendor">
                    <div class="vendor-left">
                        <div class="banner-vendor">
                            @if ($vendor->cover_image)
                                <img src="{{ asset('storage/' . $vendor->cover_image) }}" alt="{{ $vendor->name }}">
                            @else
                                <div
                                    style="
                                    width: 100%;
                                    height: 300px;
                                    background-color: #f0f2f5;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    color: #6b7280;
                                    font-size: 1.2rem;
                                    font-weight: 500;
                                ">
                                    {{ $vendor->name }} Store
                                </div>
                            @endif
                            <div class="d-flex box-info-vendor">
                                <div class="avarta">
                                    @if ($vendor->avatar)
                                        <img class="mb-5" src="{{ asset('storage/' . $vendor->avatar) }}"
                                            alt="{{ $vendor->name }}">
                                    @else
                                        @php
                                            $nameParts = explode(' ', trim($vendor->name));
                                            $initials =
                                                count($nameParts) > 1
                                                    ? strtoupper(
                                                        substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1),
                                                    )
                                                    : strtoupper(substr($nameParts[0] ?? '', 0, 2));
                                        @endphp
                                        <div class="mb-5 d-flex align-items-center justify-content-center"
                                            style="
                                                width: 90px; 
                                                height: 90px; 
                                                margin: 0 auto;
                                                background-color: #e5e7eb; 
                                                color: #4b5563; 
                                                font-size: 1.25rem; 
                                                font-weight: 600; 
                                                border-radius: 50%;
                                                border: 2px solid #fff;
                                                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                            ">
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <a class="btn btn-buy font-xs" href="#products-section">{{ $totalProducts }}
                                        Products</a>
                                </div>
                                <div class="info-vendor">
                                    <h4 class="mb-5">{{ $vendor->name }}</h4>
                                    <span class="font-xs color-gray-500 mr-20">Member since
                                        {{ $vendor->created_at->format('Y') }}</span>
                                    <div class="rating d-inline-block">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <img src="{{ asset('assets/imgs/template/icons/' . ($i <= $averageRating ? 'star.svg' : 'star-gray.svg')) }}"
                                                alt="Star">
                                        @endfor
                                        <span class="font-xs color-gray-500"> ({{ $totalReviews }})</span>
                                    </div>
                                </div>
                                <div class="vendor-contact">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-12">
                                            <div class="d-inline-block font-md color-gray-500 location mb-10">
                                                {{ $vendor->address ?? 'Address not provided' }}
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-12">
                                            <div class="d-inline-block font-md color-gray-500 phone">
                                                {{ $vendor->phone ?? 'Phone not provided' }}
                                                @if ($vendor->email)
                                                    <br>{{ $vendor->email }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vendor-right">
                        <div class="box-featured-product">
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('assets/imgs/page/product/delivery.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info">
                                    <span class="font-sm-bold color-gray-1000">Free Delivery</span>
                                    <p class="font-sm color-gray-500 font-medium">From all orders over 5,000 Fdj</p>
                                </div>
                            </div>
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('assets/imgs/page/product/support.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info">
                                    <span class="font-sm-bold color-gray-1000">Support 24/7</span>
                                    <p class="font-sm color-gray-500 font-medium">Shop with an expert</p>
                                </div>
                            </div>
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('assets/imgs/page/product/return.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info">
                                    <span class="font-sm-bold color-gray-1000">Return & Refund</span>
                                    <p class="font-sm color-gray-500 font-medium">Free return over 10,000 Fdj</p>
                                </div>
                            </div>
                            <div class="item-featured">
                                <div class="featured-icon"><img src="{{ asset('assets/imgs/page/product/payment.svg') }}"
                                        alt="Ecom"></div>
                                <div class="featured-info">
                                    <span class="font-sm-bold color-gray-1000">Secure payment</span>
                                    <p class="font-sm color-gray-500 font-medium">100% Protected</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-bottom mb-20 border-vendor"></div>

                <div class="row" id="products-section">
                    <div class="col-lg-12">
                        <div class="box-filters mt-0 pb-5 border-bottom">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 mb-10 text-lg-start text-center">
                                    <span class="font-md-bold color-brand-3">{{ $vendor->name }} Products</span>
                                </div>
                                <div class="col-xl-10 col-lg-9 mb-10 text-lg-end text-center">
                                    <span class="font-sm color-gray-900 font-medium border-1-right span">
                                        Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of
                                        {{ $products->total() }} results
                                    </span>
                                    <div class="d-inline-block">
                                        <span class="font-sm color-gray-500 font-medium">Sort by:</span>
                                        <div class="dropdown dropdown-sort border-1-right">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                @switch(request('sort', 'latest'))
                                                    @case('oldest')
                                                        Oldest products
                                                    @break

                                                    @case('price_low')
                                                        Price: Low to High
                                                    @break

                                                    @case('price_high')
                                                        Price: High to Low
                                                    @break

                                                    @case('name_asc')
                                                        Name A-Z
                                                    @break

                                                    @case('name_desc')
                                                        Name Z-A
                                                    @break

                                                    @default
                                                        Latest products
                                                @endswitch
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                                                <li><a class="dropdown-item {{ request('sort') == 'latest' || !request('sort') ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">Latest
                                                        products</a></li>
                                                <li><a class="dropdown-item {{ request('sort') == 'oldest' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Oldest
                                                        products</a></li>
                                                <li><a class="dropdown-item {{ request('sort') == 'price_low' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}">Price:
                                                        Low to High</a></li>
                                                <li><a class="dropdown-item {{ request('sort') == 'price_high' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}">Price:
                                                        High to Low</a></li>
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
                                                <span>{{ request('per_page', 12) }} items</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                                <li><a class="dropdown-item {{ request('per_page') == '12' || !request('per_page') ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 12]) }}">12
                                                        items</a></li>
                                                <li><a class="dropdown-item {{ request('per_page') == '24' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 24]) }}">24
                                                        items</a></li>
                                                <li><a class="dropdown-item {{ request('per_page') == '48' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 48]) }}">48
                                                        items</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <a class="view-type-grid mr-5 active" href="{{ request()->fullUrl() }}"></a>
                                        <a class="view-type-list" href="#"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="list-products-5 mt-20">
                            @forelse($products as $product)
                                <x-buyer.product-card :product="$product" :vendor="$vendor" />
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <h5>No products found</h5>
                                        <p class="text-muted">This vendor doesn't have any products yet</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if ($products->hasPages())
                            <nav>
                                <ul class="pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link page-prev"></span></li>
                                    @else
                                        <li class="page-item"><a class="page-link page-prev"
                                                href="{{ $products->previousPageUrl() }}"></a></li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        @if ($page == $products->currentPage())
                                            <li class="page-item"><a class="page-link active"
                                                    href="#">{{ $page }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($products->hasMorePages())
                                        <li class="page-item"><a class="page-link page-next"
                                                href="{{ $products->nextPageUrl() }}"></a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link page-next"></span></li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        .box-featured-product {
            margin-bottom: 5rem !important;
        }

        .box-info-vendor .avarta {
            width: 150px;
        }
    </style>
@endsection
