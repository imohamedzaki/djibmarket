@extends('layouts.app.buyer')

@section('title', $category->name . ' - Products')

@section('content')
    <main class="main">
        @php
            $breadcrumbs_items = [['text' => 'Home', 'url' => route('buyer.home')]];
            $breadcrumbs_count = count($breadcrumbs);
            foreach ($breadcrumbs as $key => $breadcrumb) {
                if ($key == $breadcrumbs_count - 1) {
                    $breadcrumbs_items[] = ['text' => $breadcrumb->name, 'url' => '#'];
                } else {
                    $breadcrumbs_items[] = [
                        'text' => $breadcrumb->name,
                        'url' => route('categories.show', $breadcrumb->slug ?? $breadcrumb->id),
                    ];
                }
            }
        @endphp
        <x-buyer.breadcrumb :items="$breadcrumbs_items" />

        <div class="section-box shop-template mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-first order-lg-last">
                        <!-- Category Header -->
                        <div class="search-summary mb-30">
                            <h4 class="font-lg-bold color-gray-900">
                                {{ $category->name }}
                            </h4>
                            <p class="color-gray-500">{{ $products->total() }} products found</p>
                            @if ($category->description)
                                <p class="color-gray-500 mt-10">{{ $category->description }}</p>
                            @endif
                        </div>


                        <!-- Filters and Sorting -->
                        <div class="box-filters mt-0 pb-5 border-bottom">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 mb-10 text-lg-start text-center">
                                    <a class="btn btn-filter font-sm color-brand-3 font-medium" href="#ModalFiltersForm"
                                        data-bs-toggle="modal">All Filters</a>
                                </div>
                                <div class="col-xl-10 col-lg-9 mb-10 text-lg-end text-center">
                                    <span class="font-sm color-gray-900 font-medium border-1-right span">
                                        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of
                                        {{ $products->total() }} results
                                    </span>
                                    <div class="d-inline-block">
                                        <form method="GET"
                                            action="{{ route('categories.show', $category->slug ?? $category->id) }}"
                                            class="d-inline-block">
                                            @foreach (request()->except('sort') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <span class="font-sm color-gray-500 font-medium">Sort by:</span>
                                            <select name="sort" class="form-control d-inline-block w-auto"
                                                onchange="this.form.submit()"
                                                style="padding: 5px 10px; height: auto; font-size: 14px;">
                                                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>
                                                    Latest products</option>
                                                <option value="oldest"
                                                    {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest products
                                                </option>
                                                <option value="price_low"
                                                    {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to
                                                    High</option>
                                                <option value="price_high"
                                                    {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to
                                                    Low</option>
                                                <option value="name_asc"
                                                    {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name: A to Z
                                                </option>
                                                <option value="name_desc"
                                                    {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name: Z to A
                                                </option>
                                                <option value="popular"
                                                    {{ request('sort') === 'popular' ? 'selected' : '' }}>Popular products
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Products Grid -->
                        @if ($products->count() > 0)
                            <div class="row mt-20">
                                @foreach ($products as $product)
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
                                        <x-buyer.product-card :product="$product" />
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="pagination-wrapper">
                                {{ $products->appends(request()->query())->links('pagination.custom') }}
                            </div>
                        @else
                            <!-- No Results -->
                            <div class="text-center py-5">
                                <div class="no-results-content">
                                    <div class="mb-4">
                                        <img src="{{ asset('assets/imgs/template/search.svg') }}" alt="No Results"
                                            style="width: 80px; opacity: 0.5;">
                                    </div>
                                    <h4 class="font-lg-bold color-gray-900 mb-3">No products found</h4>
                                    <p class="color-gray-500 mb-4">
                                        Sorry, we couldn't find any products in this category matching your criteria.
                                    </p>
                                    @if (request()->query())
                                        <div class="mt-4">
                                            <a href="{{ route('categories.show', $category->slug ?? $category->id) }}"
                                                class="btn btn-border">Clear Filters</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3 order-last order-lg-first">
                        <!-- Subcategories -->
                        @if ($category->children->count() > 0)
                            <div class="sidebar-border mb-40">
                                <div class="sidebar-head">
                                    <h6 class="color-gray-900">Browse Subcategories</h6>
                                </div>
                                <div class="sidebar-content">
                                    <ul class="list-nav-arrow">
                                        @foreach ($category->children as $subcategory)
                                            <li>
                                                <a
                                                    href="{{ route('categories.show', $subcategory->slug ?? $subcategory->id) }}">
                                                    {{ $subcategory->name }}
                                                    <span
                                                        class="number">{{ $subcategory->products()->where('status', 'active')->count() }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <!-- Price Range Filter -->
                        @if ($filters['price_range']->min_price && $filters['price_range']->max_price)
                            <div class="sidebar-border mb-40">
                                <div class="sidebar-head">
                                    <h6 class="color-gray-900">Price Filter</h6>
                                </div>
                                <div class="sidebar-content">
                                    <form method="GET"
                                        action="{{ route('categories.show', $category->slug ?? $category->id) }}"
                                        class="price-filter-form">
                                        @foreach (request()->except(['min_price', 'max_price', 'page']) as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach
                                        <div class="price-inputs">
                                            <input type="number" name="min_price" class="form-control" placeholder="Min"
                                                value="{{ request('min_price') }}"
                                                min="{{ floor($filters['price_range']->min_price) }}">
                                            <span class="price-separator">-</span>
                                            <input type="number" name="max_price" class="form-control" placeholder="Max"
                                                value="{{ request('max_price') }}"
                                                max="{{ ceil($filters['price_range']->max_price) }}">
                                        </div>
                                        <button type="submit"
                                            class="btn btn-filter font-sm color-brand-3 font-medium mt-10">Apply</button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <!-- Sellers Filter -->
                        @if ($filters['sellers']->count() > 0)
                            <div class="sidebar-border mb-40">
                                <div class="sidebar-head">
                                    <h6 class="color-gray-900">Sellers</h6>
                                </div>
                                <div class="sidebar-content">
                                    <div class="sellers-list">
                                        @foreach ($filters['sellers'] as $seller)
                                            <a href="{{ route('categories.show', $category->slug ?? $category->id) }}?{{ http_build_query(array_merge(request()->except('seller_id', 'page'), ['seller_id' => $seller->id])) }}"
                                                class="seller-filter-link {{ request('seller_id') == $seller->id ? 'active' : '' }}">
                                                <div class="seller-info">
                                                    @if ($seller->avatar)
                                                        <img src="{{ asset('storage/' . $seller->avatar) }}"
                                                            alt="{{ $seller->name }}" class="seller-avatar">
                                                    @endif
                                                    <div class="seller-details">
                                                        <span class="seller-name">{{ $seller->name }}</span>
                                                        <span class="seller-product-count">{{ $seller->products_count }}
                                                            products</span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Clear Filters -->
                        @if (request()->query())
                            <div class="sidebar-border mb-40">
                                <div class="sidebar-content">
                                    <a href="{{ route('categories.show', $category->slug ?? $category->id) }}"
                                        class="btn btn-border w-100">Clear All
                                        Filters</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-buyer.filters-modal />
    </main>

@endsection


@section('css')
    <style>
        .price-inputs {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .price-separator {
            color: #718096;
        }

        .seller-filter-link {
            display: block;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-bottom: 5px;
        }

        .seller-filter-link:hover,
        .seller-filter-link.active {
            background-color: #edf2f7;
            text-decoration: none;
        }

        .seller-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .seller-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        .seller-name {
            font-weight: 500;
            color: #2d3748;
            display: block;
        }

        .seller-product-count {
            font-size: 0.8rem;
            color: #718096;
        }

        .search-summary h4 {
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .search-summary p {
            margin-bottom: 0;
        }

        .no-results-content {
            padding: 60px 20px;
        }

        .no-results-content h4 {
            margin-bottom: 1rem;
        }

        .sidebar-border {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            background: white;
        }

        .sidebar-head h6 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #2d3748;
        }

        .list-nav-arrow li a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .list-nav-arrow li a:hover,
        .list-nav-arrow li a.active {
            background-color: #f7fafc;
            color: #3182ce;
            font-weight: 600;
        }

        .list-nav-arrow li a .number {
            font-size: .875em;
            color: #718096;
        }

        .list-nav-arrow li a:hover .number {
            color: #3182ce;
        }

        .btn-filter {
            border: 1px solid #e2e8f0;
            background: white;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background-color: #f7fafc;
            border-color: #3182ce;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }
    </style>
@endsection
