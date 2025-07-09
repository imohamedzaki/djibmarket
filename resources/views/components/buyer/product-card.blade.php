@props(['product', 'vendor' => null])

@php
    $isInWishlist = false;
    if (auth()->check()) {
        $isInWishlist = auth()->user()->wishlist()->where('product_id', $product->id)->exists();
    }
@endphp

<div class="card-grid-style-3">
    <div class="card-grid-inner">
        <div class="image-box product-image-container" data-product-id="{{ $product->id }}">
            <!-- Product Tools/Actions - Now Horizontal at Top -->
            <div class="product-tools">
                <a class="tool-btn tool-trend" href="#" aria-label="Trend" title="Trending"></a>
                <a class="tool-btn tool-wishlist {{ $isInWishlist ? 'in-wishlist' : '' }}" href="#"
                    aria-label="{{ $isInWishlist ? 'Remove from Wishlist' : 'Add To Wishlist' }}"
                    title="{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
                    data-product-id="{{ $product->id }}"
                    onclick="toggleProductWishlist(event, {{ $product->id }})"></a>
                <a class="tool-btn tool-compare" href="#" aria-label="Compare" title="Compare"></a>
                <a class="tool-btn tool-quickview" href="#" aria-label="Quick view" title="Quick View"
                    data-bs-toggle="modal" data-bs-target="#ModalQuickview" data-product-id="{{ $product->id }}"></a>
            </div>

            @if (
                $product->price_discounted &&
                    $product->price_discounted > 0 &&
                    $product->price_discounted < $product->price_regular)
                @php
                    $discountPercentage = round(
                        (($product->price_regular - $product->price_discounted) / $product->price_regular) * 100,
                    );
                @endphp
                <span class="label bg-brand-2">-{{ $discountPercentage }}%</span>
            @endif

            <!-- Lazy Loading Image Container -->
            <div class="image-lazy-container">
                <!-- Loading Placeholder -->
                <div class="image-loading-placeholder">
                    <div class="loading-gradient"></div>
                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Loading" class="loading-logo">
                </div>

                <!-- Main Product Image -->
                <a href="{{ route('buyer.product.show', $product->slug) }}" class="product-main-link"
                    onclick="navigateToProduct(event, '{{ route('buyer.product.show', $product->slug) }}')">
                    @php
                        $primaryImage = $product->primary_image_url;

                        $allImages = collect();
                        if ($product->thumbnail) {
                            $allImages->push(asset('storage/' . $product->thumbnail));
                        }
                        if ($product->images->count() > 0) {
                            $productImages = $product->images->map(function ($img) {
                                return asset('storage/' . $img->image_path);
                            });
                            $allImages = $allImages->merge($productImages);
                        }
                        if ($product->featured_image_path) {
                            $allImages->push(asset('storage/' . $product->featured_image_path));
                        }
                        $allImages = $allImages->unique()->filter();
                        $allImages = $allImages->unique();
                    @endphp

                    @if ($primaryImage)
                        <img class="product-image lazy-image" data-src="{{ $primaryImage }}"
                            alt="{{ $product->title }}"
                            onclick="navigateToProduct(event, '{{ route('buyer.product.show', $product->slug) }}')">
                    @else
                        <div class="no-product-image"
                            onclick="navigateToProduct(event, '{{ route('buyer.product.show', $product->slug) }}')"
                            style="width: 100%; height: 100%; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 14px; min-height: 200px; cursor: pointer;">
                            <span>No Image Available</span>
                        </div>
                    @endif
                </a>

                <!-- Image Gallery Navigation (shown on hover after 1 second) -->
                @if ($allImages->count() > 1 && $primaryImage)
                    <div class="image-gallery-nav">
                        <!-- Navigation Arrows -->
                        <button class="gallery-arrow gallery-arrow-prev" type="button">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="15,18 9,12 15,6"></polyline>
                            </svg>
                        </button>
                        <button class="gallery-arrow gallery-arrow-next" type="button">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="9,18 15,12 9,6"></polyline>
                            </svg>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="gallery-dots">
                            @foreach ($allImages as $index => $image)
                                <span class="gallery-dot {{ $index === 0 ? 'active' : '' }}"
                                    data-index="{{ $index }}"></span>
                            @endforeach
                        </div>

                        <!-- Hidden Images Data -->
                        <script type="application/json" class="gallery-data">
                            {!! json_encode($allImages->values()->toArray()) !!}
                        </script>
                    </div>
                @endif
            </div>
        </div>
        <div class="info-right">
            @if ($vendor)
                <a class="font-xs color-gray-500"
                    href="{{ route('sellers.show', $vendor->id) }}">{{ $vendor->name }}</a><br>
            @elseif ($product->seller)
                <a class="font-xs color-gray-500"
                    href="{{ route('sellers.show', $product->seller->id) }}">{{ $product->seller->name ?? 'Unknown Seller' }}</a><br>
            @endif
            <a class="color-brand-3 font-sm-bold"
                href="{{ route('buyer.product.show', $product->slug) }}">{{ Str::limit($product->title, 60) }}</a>

            @if ($product->reviews->count() > 0)
                <div class="rating">
                    @php $productRating = $product->reviews->avg('rating') ?? 0; @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <img src="{{ asset('assets/imgs/template/icons/' . ($i <= $productRating ? 'star.svg' : 'star-gray.svg')) }}"
                            alt="Star">
                    @endfor
                    <span class="font-xs color-gray-500">({{ $product->reviews->count() }})</span>
                </div>
            @endif

            <div class="price-info">
                @if (
                    $product->price_discounted &&
                        $product->price_discounted > 0 &&
                        $product->price_discounted < $product->price_regular)
                    <strong
                        class="font-lg-bold color-brand-3 price-main">{{ number_format($product->price_discounted, 2) }}
                        DJF</strong>
                    <span class="color-gray-500 price-line">{{ number_format($product->price_regular, 2) }}
                        DJF</span>
                @else
                    <strong
                        class="font-lg-bold color-brand-3 price-main">{{ number_format($product->price_regular, 2) }}
                        DJF</strong>
                @endif
            </div>

            <div class="mt-20 box-btn-cart">
                <button class="btn btn-cart" type="button" onclick="addToCartFromCard({{ $product->id }}, this)">
                    <span class="btn-text">Add To Cart</span>
                </button>
            </div>

            @if ($product->description)
                <ul class="list-features">
                    @php
                        $features = explode("\n", strip_tags($product->description));
                        $features = array_slice(array_filter($features), 0, 3);
                    @endphp
                    @foreach ($features as $feature)
                        <li>{{ Str::limit(trim($feature), 50) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<style>
    /* Product Image Lazy Loading & Gallery Styles */
    .product-image-container {
        position: relative;
        overflow: hidden;
    }

    .image-lazy-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .image-loading-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        transition: opacity 0.3s ease;
    }

    .loading-gradient {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: loading-shimmer 1.5s infinite;
    }

    @keyframes loading-shimmer {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    /* Product Tools - Horizontal Layout */
    .product-tools {
        position: absolute;
        top: 12px;
        left: 12px;
        right: 12px;
        z-index: 20;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 6px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        padding: 8px 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        pointer-events: none;
    }

    /* Show tools with partial transparency when hovering over the product image */
    .product-image-container:hover .product-tools {
        opacity: 0.5;
        visibility: visible;
        transform: translateY(0);
        pointer-events: all;
    }

    /* Full opacity when hovering over the tools themselves */
    .product-tools:hover {
        opacity: 1 !important;
    }

    .tool-btn {
        width: 32px;
        height: 32px;
        background: transparent;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #666;
        transition: all 0.3s ease;
        position: relative;
    }

    .tool-btn:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #3b82f6;
        transform: scale(1.15);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }

    .tool-trend::before {
        content: "🔥";
        font-size: 16px;
    }

    .tool-wishlist::before {
        content: "♡";
        font-size: 16px;
    }

    .tool-wishlist.in-wishlist::before {
        content: "♥";
        color: #ef4444 !important;
    }

    .tool-compare::before {
        content: "⚖";
        font-size: 16px;
    }

    .tool-quickview::before {
        content: "👁";
        font-size: 16px;
    }

    .loading-logo {
        width: 40px;
        height: auto;
        opacity: 0.3;
        z-index: 2;
        position: relative;
    }

    .product-main-link {
        display: block;
        position: relative;
        width: 100%;
        height: 100%;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .product-image.loaded {
        opacity: 1 !important;
    }

    .image-loading-placeholder.hidden {
        opacity: 0;
        pointer-events: none;
    }

    /* Image Gallery Navigation */
    .image-gallery-nav {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 10;
    }

    .product-image-container:hover .image-gallery-nav {
        opacity: 1;
        pointer-events: none;
        /* Keep pointer-events none for the overlay */
    }

    /* Only gallery controls should capture pointer events */
    .gallery-arrow,
    .gallery-dots,
    .gallery-dot {
        pointer-events: all !important;
    }

    .gallery-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        color: #333;
    }

    .gallery-arrow:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .gallery-arrow-prev {
        left: 8px;
    }

    .gallery-arrow-next {
        right: 8px;
    }

    .gallery-dots {
        position: absolute;
        bottom: 12px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
        padding: 6px 12px;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 20px;
    }

    .gallery-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .gallery-dot.active {
        background: white;
        transform: scale(1.2);
    }

    .gallery-dot:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.1);
    }

    /* Product card hover effects */
    .card-grid-style-3:hover .product-image {
        transform: scale(1.05);
    }

    .card-grid-style-3 {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-grid-style-3:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* Add to cart button loading state */
    .btn-cart.loading {
        position: relative;
        color: transparent;
        pointer-events: none;
    }

    .btn-cart.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 16px;
        height: 16px;
        border: 2px solid #ffffff;
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .gallery-arrow {
            width: 28px;
            height: 28px;
        }

        .gallery-dots {
            bottom: 8px;
            padding: 4px 8px;
        }

        .gallery-dot {
            width: 6px;
            height: 6px;
        }
    }
</style>
