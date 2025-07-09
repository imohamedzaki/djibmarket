@extends('layouts.app.buyer')

@section('title', 'Search Results' . ($query ? ' for "' . $query . '"' : ''))

@section('content')
    <main class="main">
        <x-buyer.breadcrumb :items="[['text' => 'Home', 'url' => route('buyer.home')], ['text' => 'Search Results', 'url' => '#']]" />

        <div class="section-box shop-template mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-first order-lg-last">
                        <!-- Search Summary -->
                        @if ($query)
                            <div class="search-summary mb-30">
                                <h4 class="font-lg-bold color-gray-900">
                                    Search Results for "{{ $query }}"
                                    @if ($selectedCategory)
                                        in {{ $selectedCategory->name }}
                                    @endif
                                </h4>
                                <p class="color-gray-500">{{ $products->total() }} products found</p>
                            </div>
                        @else
                            <div class="search-summary mb-30">
                                <h4 class="font-lg-bold color-gray-900">
                                    @if ($selectedCategory)
                                        {{ $selectedCategory->name }} Products
                                    @else
                                        All Products
                                    @endif
                                </h4>
                                <p class="color-gray-500">{{ $products->total() }} products found</p>
                            </div>
                        @endif

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
                                        <span class="font-sm color-gray-500 font-medium">Sort by:</span>
                                        <div class="dropdown dropdown-sort border-1-right">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                @switch($sort)
                                                    @case('price_low')
                                                        Price: Low to High
                                                    @break

                                                    @case('price_high')
                                                        Price: High to Low
                                                    @break

                                                    @case('oldest')
                                                        Oldest products
                                                    @break

                                                    @case('popular')
                                                        Popular products
                                                    @break

                                                    @default
                                                        Latest products
                                                @endswitch
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                                                <li><a class="dropdown-item {{ $sort == 'latest' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}">Latest
                                                        products</a></li>
                                                <li><a class="dropdown-item {{ $sort == 'oldest' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}">Oldest
                                                        products</a></li>
                                                <li><a class="dropdown-item {{ $sort == 'price_low' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}">Price:
                                                        Low to High</a></li>
                                                <li><a class="dropdown-item {{ $sort == 'price_high' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}">Price:
                                                        High to Low</a></li>
                                                <li><a class="dropdown-item {{ $sort == 'popular' ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">Popular
                                                        products</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <span class="font-sm color-gray-500 font-medium">Show</span>
                                        <div class="dropdown dropdown-sort border-1-right">
                                            <button class="btn dropdown-toggle font-sm color-gray-900 font-medium"
                                                id="dropdownSort2" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span>{{ $perPage }} items</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort2">
                                                <li><a class="dropdown-item {{ $perPage == 16 ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 16]) }}">16
                                                        items</a></li>
                                                <li><a class="dropdown-item {{ $perPage == 32 ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 32]) }}">32
                                                        items</a></li>
                                                <li><a class="dropdown-item {{ $perPage == 48 ? 'active' : '' }}"
                                                        href="{{ request()->fullUrlWithQuery(['per_page' => 48]) }}">48
                                                        items</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-inline-block">
                                        <a class="view-type-grid mr-5 active" href="#"></a>
                                        <a class="view-type-list" href="#"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Products Grid -->
                        @if ($products->count() > 0)
                            <div class="row mt-20">
                                @foreach ($products as $product)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-30">
                                        <x-buyer.product-card :product="$product" />
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            {{ $products->links('pagination.custom') }}
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
                                        @if ($query)
                                            Sorry, we couldn't find any products matching "{{ $query }}"
                                            @if ($selectedCategory)
                                                in {{ $selectedCategory->name }}
                                            @endif
                                        @else
                                            No products available in this category.
                                        @endif
                                    </p>
                                    <div class="mt-4">
                                        <a href="{{ route('buyer.home') }}" class="btn btn-brand-1 mr-3">Browse All
                                            Products</a>
                                        @if ($query || $categoryId)
                                            <a href="{{ route('search.results') }}" class="btn btn-border">Clear
                                                Filters</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3 order-last order-lg-first">
                        <div class="sidebar-border mb-40">
                            <div class="sidebar-head">
                                <h6 class="color-gray-900">Product Categories</h6>
                            </div>
                            <div class="sidebar-content">
                                <ul class="list-nav-arrow">
                                    @foreach ($categories->take(10) as $category)
                                        <li>
                                            <a href="{{ route('categories.show', $category->slug ?? $category->id) }}"
                                                class="{{ $selectedCategory && $selectedCategory->id == $category->id ? 'active' : '' }}">
                                                {{ $category->name }}
                                                <span class="number">{{ $category->products_count ?? 0 }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @if ($categories->count() > 10)
                                    <div>
                                        <div class="collapse" id="moreMenu">
                                            <ul class="list-nav-arrow">
                                                @foreach ($categories->skip(10) as $category)
                                                    <li>
                                                        <a
                                                            href="{{ route('categories.show', $category->slug ?? $category->id) }}">
                                                            {{ $category->name }}
                                                            <span
                                                                class="number">{{ $category->products_count ?? 0 }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <a class="link-see-more mt-5" data-bs-toggle="collapse" href="#moreMenu"
                                            role="button" aria-expanded="false" aria-controls="moreMenu">See More</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div class="sidebar-border mb-40">
                            <div class="sidebar-head">
                                <h6 class="color-gray-900">Price Filter</h6>
                            </div>
                            <div class="sidebar-content">
                                <form method="GET" action="{{ route('search.results') }}">
                                    <!-- Preserve existing filters -->
                                    @if ($query)
                                        <input type="hidden" name="query" value="{{ $query }}">
                                    @endif
                                    @if ($categoryId)
                                        <input type="hidden" name="category_id" value="{{ $categoryId }}">
                                    @endif
                                    @if ($sort != 'latest')
                                        <input type="hidden" name="sort" value="{{ $sort }}">
                                    @endif
                                    @if ($perPage != 16)
                                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                                    @endif

                                    <ul class="list-checkbox">
                                        <li>
                                            <label class="cb-container">
                                                <input type="radio" name="price_range" value="0-100"
                                                    {{ request('price_range') == '0-100' ? 'checked' : '' }}>
                                                <span class="text-small">0 - 100 DJF</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="radio" name="price_range" value="100-300"
                                                    {{ request('price_range') == '100-300' ? 'checked' : '' }}>
                                                <span class="text-small">100 - 300 DJF</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="radio" name="price_range" value="300-600"
                                                    {{ request('price_range') == '300-600' ? 'checked' : '' }}>
                                                <span class="text-small">300 - 600 DJF</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="radio" name="price_range" value="600-1000"
                                                    {{ request('price_range') == '600-1000' ? 'checked' : '' }}>
                                                <span class="text-small">600 - 1000 DJF</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="radio" name="price_range" value="1000+"
                                                    {{ request('price_range') == '1000+' ? 'checked' : '' }}>
                                                <span class="text-small">Over 1000 DJF</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <button type="submit"
                                        class="btn btn-filter font-sm color-brand-3 font-medium mt-10">Apply
                                        Filter</button>
                                </form>
                            </div>
                        </div>

                        <!-- Clear Filters -->
                        @if ($query || $categoryId || request('price_range'))
                            <div class="sidebar-border mb-40">
                                <div class="sidebar-content">
                                    <a href="{{ route('search.results') }}" class="btn btn-border w-100">Clear All
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

@section('js')
    <script>
        // Search page specific functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit price filter on change
            const priceInputs = document.querySelectorAll('input[name="price_range"]');
            priceInputs.forEach(input => {
                input.addEventListener('change', function() {
                    this.form.submit();
                });
            });
        });
    </script>
@endsection

@section('css')
    <style>
        /* Search Results Specific Styles */
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

        .list-nav-arrow li a.active {
            background-color: #f7fafc;
            color: #3182ce;
            font-weight: 600;
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

        /* Pagination styles */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }

        .page-link {
            color: #4a5568;
            border: 1px solid #e2e8f0;
            margin: 0 2px;
            border-radius: 6px;
        }

        .page-link:hover {
            background-color: #f7fafc;
            border-color: #3182ce;
            color: #3182ce;
        }

        .page-link.active {
            background-color: #3182ce;
            border-color: #3182ce;
            color: white;
        }

        /* Price filter radio buttons */
        .cb-container input[type="radio"] {
            margin-right: 8px;
        }

        /* Breadcrumb enhancements */
        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #a0aec0;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .col-lg-3 {
                margin-top: 30px;
            }

            .search-summary {
                text-align: center;
            }

            .box-filters .row {
                text-align: center;
            }

            .box-filters .col-xl-10>div {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
@endsection
