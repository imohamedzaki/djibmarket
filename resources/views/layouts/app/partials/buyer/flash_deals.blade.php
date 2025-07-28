<section class="section-box pt-50">
    <div class="container">
        <div class="head-main bd-gray-200">
            <div class="row">
                <div class="col-xl-6 col-lg-5">
                    <h3 class="mb-5">Flash Deals</h3>
                    <p class="font-base color-gray-500">Special products with limited time offers.</p>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <ul class="nav nav-tabs nav-tabs-underline text-uppercase" role="tablist">
                        <li><a class="active" href="#tab-flash-all" data-bs-toggle="tab" data-index="1" role="tab"
                                aria-controls="tab-flash-all" aria-selected="true">All Products</a></li>
                        <li><a href="#tab-flash-highest" data-bs-toggle="tab" data-index="2" role="tab"
                                aria-controls="tab-flash-highest" aria-selected="true">Highest Discounts</a></li>
                        <li><a href="#tab-flash-lowest" data-bs-toggle="tab" data-index="3" role="tab"
                                aria-controls="tab-flash-lowest" aria-selected="true">Lowest Discounts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="tab-flash-all" role="tabpanel" aria-labelledby="tab-all">
                @if (isset($flashSalesProducts) && $flashSalesProducts->count() > 0)
                    {{-- Debug: Show count of products found --}}
                    {{-- Found {{ $flashSalesProducts->count() }} flash sale products --}}
                    <div class="row">
                        @foreach ($flashSalesProducts as $index => $product)
                            @if ($index == 0)
                                {{-- First product - Large card style --}}
                                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-grid-style-3 hover-show top-deals">
                                        <div class="card-grid-inner">
                                            <span class="label">
                                                <span class="font-sm color-white">
                                                    @if ($product->flash_sale_discount_type === 'percentage')
                                                        {{ $product->flash_sale_discount_value }}%<br>OFF
                                                    @else
                                                        {{ number_format($product->flash_sale_discount_value, 0) }}<br>DJF
                                                        OFF
                                                    @endif
                                                </span>
                                            </span>
                                            <div class="box-top-deals">
                                                <div class="top-deals-left">
                                                    <div class="image-box">
                                                        <div class="box-swiper">
                                                            <div class="swiper-container swiper-tab" data-index="1">
                                                                <div class="swiper-wrapper pt-5">
                                                                    <div class="swiper-slide">
                                                                        <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/screen.png') }}"
                                                                            alt="{{ $product->title }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-count box-count-square">
                                                        <div class="deals-countdown"
                                                            data-countdown="{{ $product->flash_sale_end_at->format('Y/m/d H:i:s') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="top-deals-right">
                                                    <div class="info-right"></div>
                                                    <span
                                                        class="font-xs color-gray-500">{{ $product->category->name ?? 'No Category' }}</span><br>
                                                    <a class="color-brand-3 font-sm-bold"
                                                        href="{{ route('buyer.product.show', $product->slug) }}">
                                                        <h5>{{ $product->title }}</h5>
                                                    </a>
                                                    <div class="rating">
                                                        @php
                                                            $averageRating = $product->reviews->avg('rating') ?? 0;
                                                            $reviewCount = $product->reviews->count();
                                                        @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                                alt="Star"
                                                                style="opacity: {{ $i <= $averageRating ? '1' : '0.3' }};">
                                                        @endfor
                                                        <span
                                                            class="font-xs color-gray-500">({{ $reviewCount }})</span>
                                                    </div>
                                                    <div class="price-info">
                                                        <h3 class="color-brand-3 price-main d-inline-block">
                                                            {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                            DJF
                                                        </h3>
                                                        <span class="color-gray-500 price-line">
                                                            {{ number_format($product->price_regular, 0) }} DJF
                                                        </span>
                                                    </div>
                                                    <div class="box-progress">
                                                        <div class="progress-bar">
                                                            <div class="progress-bar-inner"
                                                                style="width: {{ $product->stock_quantity > 0 ? ($product->stock_quantity / ($product->stock_quantity + 50)) * 100 : 0 }}%">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <span class="font-xs color-gray-500">Available: </span>
                                                                <span
                                                                    class="font-xs-bold color-gray-900">{{ $product->stock_quantity }}</span>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end">
                                                                <span class="font-xs color-gray-500">Discount: </span>
                                                                <span class="font-xs-bold color-gray-900">
                                                                    {{ number_format($product->price_regular - $product->flash_sale_discounted_price, 0) }}
                                                                    DJF
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-features">
                                                        <li>Flash Sale Price</li>
                                                        <li>Limited Time Offer</li>
                                                        <li>{{ $product->flash_sale_title }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($index == 1)
                                {{-- Second product - Large card style --}}
                                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card-grid-style-3 hover-show top-deals">
                                        <div class="card-grid-inner">
                                            <span class="label">
                                                <span class="font-sm color-white">
                                                    @if ($product->flash_sale_discount_type === 'percentage')
                                                        {{ $product->flash_sale_discount_value }}%<br>OFF
                                                    @else
                                                        {{ number_format($product->flash_sale_discount_value, 0) }}<br>DJF
                                                        OFF
                                                    @endif
                                                </span>
                                            </span>
                                            <div class="box-top-deals">
                                                <div class="top-deals-left">
                                                    <div class="image-box">
                                                        <div class="box-swiper">
                                                            <div class="swiper-container swiper-tab" data-index="1">
                                                                <div class="swiper-wrapper pt-5">
                                                                    <div class="swiper-slide">
                                                                        <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/screen-2.png') }}"
                                                                            alt="{{ $product->title }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-count box-count-square">
                                                        <div class="deals-countdown"
                                                            data-countdown="{{ $product->flash_sale_end_at->format('Y/m/d H:i:s') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="top-deals-right">
                                                    <div class="info-right"></div>
                                                    <span
                                                        class="font-xs color-gray-500">{{ $product->category->name ?? 'No Category' }}</span><br>
                                                    <a class="color-brand-3 font-sm-bold"
                                                        href="{{ route('buyer.product.show', $product->slug) }}">
                                                        <h5>{{ $product->title }}</h5>
                                                    </a>
                                                    <div class="rating">
                                                        @php
                                                            $averageRating = $product->reviews->avg('rating') ?? 0;
                                                            $reviewCount = $product->reviews->count();
                                                        @endphp
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                                alt="Star"
                                                                style="opacity: {{ $i <= $averageRating ? '1' : '0.3' }};">
                                                        @endfor
                                                        <span
                                                            class="font-xs color-gray-500">({{ $reviewCount }})</span>
                                                    </div>
                                                    <div class="price-info">
                                                        <h3 class="color-brand-3 price-main d-inline-block">
                                                            {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                            DJF
                                                        </h3>
                                                        <span class="color-gray-500 price-line">
                                                            {{ number_format($product->price_regular, 0) }} DJF
                                                        </span>
                                                    </div>
                                                    <div class="box-progress">
                                                        <div class="progress-bar">
                                                            <div class="progress-bar-inner"
                                                                style="width: {{ $product->stock_quantity > 0 ? ($product->stock_quantity / ($product->stock_quantity + 50)) * 100 : 0 }}%">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <span class="font-xs color-gray-500">Available: </span>
                                                                <span
                                                                    class="font-xs-bold color-gray-900">{{ $product->stock_quantity }}</span>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end">
                                                                <span class="font-xs color-gray-500">Discount: </span>
                                                                <span class="font-xs-bold color-gray-900">
                                                                    {{ number_format($product->price_regular - $product->flash_sale_discounted_price, 0) }}
                                                                    DJF
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-features">
                                                        <li>Flash Sale Price</li>
                                                        <li>Limited Time Offer</li>
                                                        <li>{{ $product->flash_sale_title }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($index == 2)
                                {{-- Banner column --}}
                                <div class="col-lg-2 col-md-6 d-none d-xl-block col-sm-12">
                                    <div class="grid-banner-height">
                                        <span class="lbl-new-arrival color-brand-3">Flash</span>
                                        <h4 class="font-24 mt-10 mb-5">Deals</h4>
                                        <p class="font-16">Limited Time</p>
                                    </div>
                                </div>
                            @else
                                {{-- Additional products - Small card style --}}
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card-grid-style-3 hover-show hover-hide-show-cart">
                                        <div class="card-grid-inner">
                                            <div class="tools">
                                                <a class="btn btn-wishlist btn-tooltip mb-10" href="#"
                                                    aria-label="Add To Wishlist"></a>
                                                <a class="btn btn-compare btn-tooltip mb-10" href="#"
                                                    aria-label="Compare"></a>
                                                <a class="btn btn-quickview btn-tooltip" aria-label="Quick view"
                                                    href="#ModalQuickview" data-bs-toggle="modal"></a>
                                            </div>
                                            <div class="image-box">
                                                <span class="label bg-brand-2">
                                                    @if ($product->flash_sale_discount_type === 'percentage')
                                                        -{{ $product->flash_sale_discount_value }}%
                                                    @else
                                                        -{{ number_format($product->flash_sale_discount_value, 0) }}
                                                        DJF
                                                    @endif
                                                </span>
                                                <a href="{{ route('buyer.product.show', $product->slug) }}">
                                                    <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/imgsp1.png') }}"
                                                        alt="{{ $product->title }}">
                                                </a>
                                            </div>
                                            <div class="box-count">
                                                <div class="deals-countdown"
                                                    data-countdown="{{ $product->flash_sale_end_at->format('Y/m/d H:i:s') }}">
                                                </div>
                                            </div>
                                            <div class="info-right">
                                                <span
                                                    class="font-xs color-gray-500">{{ $product->category->name ?? 'No Category' }}</span><br>
                                                <a class="color-brand-3 font-sm-bold"
                                                    href="{{ route('buyer.product.show', $product->slug) }}">
                                                    {{ Str::limit($product->title, 50) }}
                                                </a>
                                                <div class="rating">
                                                    @php
                                                        $averageRating = $product->reviews->avg('rating') ?? 0;
                                                        $reviewCount = $product->reviews->count();
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                            alt="Star"
                                                            style="opacity: {{ $i <= $averageRating ? '1' : '0.3' }};">
                                                    @endfor
                                                    <span class="font-xs color-gray-500"> ({{ $reviewCount }})</span>
                                                </div>
                                                <div class="price-info">
                                                    <strong class="font-lg-bold color-brand-3 price-main">
                                                        {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                        DJF
                                                    </strong>
                                                    <span class="color-gray-500 price-line">
                                                        {{ number_format($product->price_regular, 0) }} DJF
                                                    </span>
                                                </div>
                                                <div class="box-progress box-progress-small">
                                                    <div class="progress-bar">
                                                        <div class="progress-bar-inner"
                                                            style="width: {{ $product->stock_quantity > 0 ? ($product->stock_quantity / ($product->stock_quantity + 30)) * 100 : 0 }}%">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                            <span class="font-xs color-gray-500">Available:</span>
                                                            <span
                                                                class="font-xs-bold color-gray-900">{{ $product->stock_quantity }}</span>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end">
                                                            <span class="font-xs color-gray-500">Sold:</span>
                                                            <span
                                                                class="font-xs-bold color-gray-900">{{ rand(10, 50) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-20 box-add-cart">
                                                    <a class="btn btn-cart" href="#">Add To Cart</a>
                                                </div>
                                                <ul class="list-features">
                                                    <li>Flash Sale until
                                                        {{ $product->flash_sale_end_at->format('M d, Y') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    {{-- No Flash Sales Available --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="opacity: 0.4;">
                                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="#ff4757" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="12" cy="12" r="1" fill="#ff4757" />
                                    </svg>
                                </div>
                                <h4 class="color-gray-500 mb-3">No Flash Deals Available</h4>
                                <p class="color-gray-500">Check back later for exciting flash deals and special offers!
                                </p>
                                {{-- Debug info --}}
                                {{-- @if (config('app.debug'))
                                    <small class="text-muted">
                                        Debug: flashSalesProducts =
                                        {{ isset($flashSalesProducts) ? $flashSalesProducts->count() : 'not set' }}
                                        products
                                    </small>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Highest Discounts Tab --}}
            <div class="tab-pane fade" id="tab-flash-highest" role="tabpanel">
                @if (isset($flashSalesProducts) && $flashSalesProducts->count() > 0)
                    <div class="row">
                        @php
                            // Sort by highest discount percentage
                            $highestDiscountProducts = $flashSalesProducts->sortByDesc(function ($product) {
                                if ($product->flash_sale_discount_type === 'percentage') {
                                    return $product->flash_sale_discount_value;
                                } else {
                                    // Calculate percentage for fixed amount discounts
                                    return ($product->flash_sale_discount_value / $product->price_regular) * 100;
                                }
                            });
                        @endphp
                        @foreach ($highestDiscountProducts as $index => $product)
                            @if ($index < 8)
                                {{-- Limit to 8 products --}}
                                @if ($index < 2)
                                    {{-- Large cards for first 2 products --}}
                                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                        {{-- Same large card structure as in "All Products" tab --}}
                                        <div class="card-grid-style-3 hover-show top-deals">
                                            <div class="card-grid-inner">
                                                <span class="label">
                                                    <span class="font-sm color-white">
                                                        @if ($product->flash_sale_discount_type === 'percentage')
                                                            {{ $product->flash_sale_discount_value }}%<br>OFF
                                                        @else
                                                            {{ number_format($product->flash_sale_discount_value, 0) }}<br>DJF
                                                            OFF
                                                        @endif
                                                    </span>
                                                </span>
                                                {{-- Rest of large card content --}}
                                                <div class="box-top-deals">
                                                    <div class="top-deals-left">
                                                        <div class="image-box">
                                                            <div class="box-swiper">
                                                                <div class="swiper-container swiper-tab"
                                                                    data-index="2">
                                                                    <div class="swiper-wrapper pt-5">
                                                                        <div class="swiper-slide">
                                                                            <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/screen.png') }}"
                                                                                alt="{{ $product->title }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="box-count box-count-square">
                                                            <div class="deals-countdown"
                                                                data-countdown="{{ $product->flash_sale_end_at->format('Y/m/d H:i:s') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top-deals-right">
                                                        <div class="info-right"></div>
                                                        <span
                                                            class="font-xs color-gray-500">{{ $product->category->name ?? 'No Category' }}</span><br>
                                                        <a class="color-brand-3 font-sm-bold"
                                                            href="{{ route('buyer.product.show', $product->slug) }}">
                                                            <h5>{{ $product->title }}</h5>
                                                        </a>
                                                        <div class="price-info">
                                                            <h3 class="color-brand-3 price-main d-inline-block">
                                                                {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                                DJF
                                                            </h3>
                                                            <span class="color-gray-500 price-line">
                                                                {{ number_format($product->price_regular, 0) }} DJF
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($index == 2)
                                    {{-- Banner column --}}
                                    <div class="col-lg-2 col-md-6 d-none d-xl-block col-sm-12">
                                        <div class="grid-banner-height">
                                            <span class="lbl-new-arrival color-brand-3">Best</span>
                                            <h4 class="font-24 mt-10 mb-5">Discounts</h4>
                                            <p class="font-16">Highest Savings</p>
                                        </div>
                                    </div>
                                @else
                                    {{-- Small cards for remaining products --}}
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card-grid-style-3 hover-show hover-hide-show-cart">
                                            <div class="card-grid-inner">
                                                <div class="image-box">
                                                    <span class="label bg-brand-2">
                                                        @if ($product->flash_sale_discount_type === 'percentage')
                                                            -{{ $product->flash_sale_discount_value }}%
                                                        @else
                                                            -{{ number_format($product->flash_sale_discount_value, 0) }}
                                                            DJF
                                                        @endif
                                                    </span>
                                                    <a href="{{ route('buyer.product.show', $product->slug) }}">
                                                        <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/imgsp1.png') }}"
                                                            alt="{{ $product->title }}">
                                                    </a>
                                                </div>
                                                <div class="info-right">
                                                    <a class="color-brand-3 font-sm-bold"
                                                        href="{{ route('buyer.product.show', $product->slug) }}">
                                                        {{ Str::limit($product->title, 50) }}
                                                    </a>
                                                    <div class="price-info">
                                                        <strong class="font-lg-bold color-brand-3 price-main">
                                                            {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                            DJF
                                                        </strong>
                                                        <span class="color-gray-500 price-line">
                                                            {{ number_format($product->price_regular, 0) }} DJF
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="opacity: 0.4;">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="#ff4757" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="1" fill="#ff4757" />
                            </svg>
                        </div>
                        <h4 class="color-gray-500 mb-3">No Flash Deals Available</h4>
                        <p class="color-gray-500">Check back later for exciting flash deals with highest discounts!</p>
                    </div>
                @endif
            </div>

            {{-- Lowest Discounts Tab --}}
            <div class="tab-pane fade" id="tab-flash-lowest" role="tabpanel">
                @if (isset($flashSalesProducts) && $flashSalesProducts->count() > 0)
                    <div class="row">
                        @php
                            // Sort by lowest discount percentage
                            $lowestDiscountProducts = $flashSalesProducts->sortBy(function ($product) {
                                if ($product->flash_sale_discount_type === 'percentage') {
                                    return $product->flash_sale_discount_value;
                                } else {
                                    // Calculate percentage for fixed amount discounts
                                    return ($product->flash_sale_discount_value / $product->price_regular) * 100;
                                }
                            });
                        @endphp
                        @foreach ($lowestDiscountProducts as $index => $product)
                            @if ($index < 8)
                                {{-- Limit to 8 products --}}
                                @if ($index < 2)
                                    {{-- Large cards for first 2 products --}}
                                    <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-grid-style-3 hover-show top-deals">
                                            <div class="card-grid-inner">
                                                <span class="label">
                                                    <span class="font-sm color-white">
                                                        @if ($product->flash_sale_discount_type === 'percentage')
                                                            {{ $product->flash_sale_discount_value }}%<br>OFF
                                                        @else
                                                            {{ number_format($product->flash_sale_discount_value, 0) }}<br>DJF
                                                            OFF
                                                        @endif
                                                    </span>
                                                </span>
                                                <div class="box-top-deals">
                                                    <div class="top-deals-left">
                                                        <div class="image-box">
                                                            <div class="box-swiper">
                                                                <div class="swiper-container swiper-tab"
                                                                    data-index="3">
                                                                    <div class="swiper-wrapper pt-5">
                                                                        <div class="swiper-slide">
                                                                            <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/screen.png') }}"
                                                                                alt="{{ $product->title }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="box-count box-count-square">
                                                            <div class="deals-countdown"
                                                                data-countdown="{{ $product->flash_sale_end_at->format('Y/m/d H:i:s') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="top-deals-right">
                                                        <div class="info-right"></div>
                                                        <span
                                                            class="font-xs color-gray-500">{{ $product->category->name ?? 'No Category' }}</span><br>
                                                        <a class="color-brand-3 font-sm-bold"
                                                            href="{{ route('buyer.product.show', $product->slug) }}">
                                                            <h5>{{ $product->title }}</h5>
                                                        </a>
                                                        <div class="price-info">
                                                            <h3 class="color-brand-3 price-main d-inline-block">
                                                                {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                                DJF
                                                            </h3>
                                                            <span class="color-gray-500 price-line">
                                                                {{ number_format($product->price_regular, 0) }} DJF
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($index == 2)
                                    {{-- Banner column --}}
                                    <div class="col-lg-2 col-md-6 d-none d-xl-block col-sm-12">
                                        <div class="grid-banner-height">
                                            <span class="lbl-new-arrival color-brand-3">Great</span>
                                            <h4 class="font-24 mt-10 mb-5">Values</h4>
                                            <p class="font-16">Still Discounted</p>
                                        </div>
                                    </div>
                                @else
                                    {{-- Small cards for remaining products --}}
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="card-grid-style-3 hover-show hover-hide-show-cart">
                                            <div class="card-grid-inner">
                                                <div class="image-box">
                                                    <span class="label bg-brand-2">
                                                        @if ($product->flash_sale_discount_type === 'percentage')
                                                            -{{ $product->flash_sale_discount_value }}%
                                                        @else
                                                            -{{ number_format($product->flash_sale_discount_value, 0) }}
                                                            DJF
                                                        @endif
                                                    </span>
                                                    <a href="{{ route('buyer.product.show', $product->slug) }}">
                                                        <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage1/imgsp1.png') }}"
                                                            alt="{{ $product->title }}">
                                                    </a>
                                                </div>
                                                <div class="info-right">
                                                    <a class="color-brand-3 font-sm-bold"
                                                        href="{{ route('buyer.product.show', $product->slug) }}">
                                                        {{ Str::limit($product->title, 50) }}
                                                    </a>
                                                    <div class="price-info">
                                                        <strong class="font-lg-bold color-brand-3 price-main">
                                                            {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                            DJF
                                                        </strong>
                                                        <span class="color-gray-500 price-line">
                                                            {{ number_format($product->price_regular, 0) }} DJF
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" style="opacity: 0.4;">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="#ff4757" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="1" fill="#ff4757" />
                            </svg>
                        </div>
                        <h4 class="color-gray-500 mb-3">No Flash Deals Available</h4>
                        <p class="color-gray-500">Check back later for exciting flash deals with great values!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
