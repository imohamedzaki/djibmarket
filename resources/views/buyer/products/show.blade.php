@extends('layouts.app.buyer')

@section('title', $product->title)

@section('css')
    <style>
        .product-image-gallery {
            position: relative;
        }

        .image-sticky-container {
            position: sticky;
            top: 74px;
            z-index: 100;
        }

        .main-image {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            background: #f8f9fa;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            cursor: crosshair;
            transition: transform 0.1s ease;
        }

        .main-image-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: background 0.3s ease;
        }

        .main-image-nav:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .main-image-nav.prev {
            left: 10px;
        }

        .main-image-nav.next {
            right: 10px;
        }

        .image-zoom-lens {
            position: absolute;
            border: 2px solid #007bff;
            width: 60px;
            height: 60px;
            pointer-events: none;
            display: none;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .zoom-result {
            position: absolute;
            border: 1px solid #d4d4d4;
            width: 350px;
            height: 350px;
            top: 0;
            right: -370px;
            background-color: white;
            background-repeat: no-repeat;
            display: none;
            z-index: 1000;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .thumbnail-gallery {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            overflow-x: auto;
            padding: 5px 0;
        }

        .thumbnail-item {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid transparent;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .thumbnail-item.active {
            border-color: #007bff;
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .seller-info {
            color: #007bff;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .seller-name {
            color: #333;
            font-weight: 600;
        }

        .rating-section {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .rating-stars {
            color: #ffc107;
        }

        .rating-text {
            color: #666;
            font-size: 0.9rem;
        }

        .price-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .current-price {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .original-price {
            font-size: 1.2rem;
            color: #999;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .discount-badge {
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .stock-info {
            color: #28a745;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .stock-low {
            color: #ffc107;
        }

        .stock-out {
            color: #dc3545;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .quantity-btn:hover {
            background: #e9ecef;
        }

        .quantity-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .quantity-input {
            border: none;
            width: 60px;
            height: 40px;
            text-align: center;
            font-weight: 500;
        }

        .delivery-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .delivery-badge {
            background: #2196f3;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 8px;
        }

        .express-badge {
            background: #ffc107;
            color: #333;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.85rem;
            margin-bottom: 8px;
            display: inline-block;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn-add-cart {
            background: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            flex: 1;
            transition: background 0.3s ease;
        }

        .btn-add-cart:hover {
            background: #0056b3;
            color: white;
        }

        .btn-add-cart:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        .btn-wishlist {
            background: transparent;
            border: 2px solid #ddd;
            color: #666;
            padding: 12px 20px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-wishlist:hover {
            border-color: #007bff;
            color: #007bff;
        }

        .product-features {
            background: white;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .feature-item:last-child {
            border-bottom: none;
        }

        .feature-icon {
            width: 20px;
            height: 20px;
            color: #28a745;
        }

        .bestseller-badge {
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            margin-bottom: 15px;
            display: inline-block;
        }

        .payment-options {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
        }

        .product-section {
            margin-top: 40px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .zoom-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.95);
            z-index: 99999;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .zoom-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 60px 20px 120px 20px;
        }

        .zoom-content img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .close-zoom {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 2.5rem;
            cursor: pointer;
            z-index: 100001;
            background: rgba(0, 0, 0, 0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }

        .close-zoom:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .navigation-arrows {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.6);
            padding: 15px 20px;
            border-radius: 50%;
            transition: all 0.3s ease;
            z-index: 100001;
        }

        .navigation-arrows:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: translateY(-50%) scale(1.1);
        }

        .nav-prev {
            left: 30px;
        }

        .nav-next {
            right: 30px;
        }

        .zoom-thumbnails {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            background: rgba(0, 0, 0, 0.5);
            padding: 15px;
            border-radius: 25px;
            max-width: 90%;
            overflow-x: auto;
            z-index: 100001;
        }

        .zoom-thumbnail {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .zoom-thumbnail.active {
            border-color: #007bff;
            transform: scale(1.1);
        }

        .zoom-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .zoom-info {
            position: absolute;
            top: 20px;
            left: 30px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 14px;
            z-index: 100001;
        }

        /* Custom 5-column layout */
        @media (min-width: 992px) {
            .col-lg-2.product-grid-5 {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        /* Ensure product cards maintain good proportions */
        .card-grid-style-3 {
            height: 100%;
        }

        .card-grid-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .info-right {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .price-info {
            margin-top: auto;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .current-price {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .main-image {
                height: 300px;
            }

            .zoom-result {
                display: none !important;
            }

            .image-sticky-container {
                position: relative;
                top: auto;
            }

            .zoom-content {
                padding: 80px 10px 100px 10px;
            }

            .zoom-thumbnails {
                bottom: 10px;
                padding: 10px;
                max-width: 95%;
            }

            .zoom-thumbnail {
                width: 50px;
                height: 50px;
            }

            .navigation-arrows {
                padding: 12px 16px;
                font-size: 1.5rem;
            }

            .nav-prev {
                left: 15px;
            }

            .nav-next {
                right: 15px;
            }

            .close-zoom {
                top: 15px;
                right: 15px;
                width: 45px;
                height: 45px;
                font-size: 2rem;
            }

            .zoom-info {
                top: 15px;
                left: 15px;
                font-size: 12px;
                padding: 8px 12px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        @php
            $breadcrumbs_items = [
                ['text' => 'Home', 'url' => route('buyer.home')],
                [
                    'text' => $product->category->name,
                    'url' => route('categories.show', $product->category->slug ?? $product->category->id),
                ],
                ['text' => Str::limit($product->title, 30), 'url' => '#'],
            ];
        @endphp
        <x-buyer.breadcrumb :items="$breadcrumbs_items" />

        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="image-sticky-container">
                    <div class="product-image-gallery">
                        <div class="main-image" id="mainImageContainer">
                            @if ($product->primary_image_url)
                                <img src="{{ $product->primary_image_url }}" alt="{{ $product->title }}" id="currentImage"
                                    data-index="0">
                            @else
                                <div class="no-product-image"
                                    style="width: 100%; height: 400px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 18px;">
                                    <span>No Image Available</span>
                                </div>
                            @endif

                            <!-- Navigation Arrows -->
                            <button class="main-image-nav prev" id="mainPrevBtn">‹</button>
                            <button class="main-image-nav next" id="mainNextBtn">›</button>

                            <!-- Zoom lens and result -->
                            <div class="image-zoom-lens" id="zoomLens"></div>
                            <div class="zoom-result" id="zoomResult"></div>
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="thumbnail-gallery">
                            @if ($product->primary_image_url)
                                <div class="thumbnail-item active" data-index="0">
                                    <img src="{{ $product->primary_image_url }}" alt="{{ $product->title }}">
                                </div>
                            @endif

                            @if ($product->images && $product->images->count() > 0)
                                @foreach ($product->images as $index => $image)
                                    <div class="thumbnail-item" data-index="{{ $index + 1 }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->title }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6 col-md-6">
                <!-- Seller Info -->
                <div class="seller-info">
                    <i class="fas fa-store"></i> <span class="seller-name">{{ $product->seller->name }}</span>
                </div>

                <!-- Product Title -->
                <h1 class="product-title">{{ $product->title }}</h1>

                <!-- Rating -->
                @if ($product->reviews && $product->reviews->count() > 0)
                    <div class="rating-section">
                        @php
                            $averageRating = $product->reviews->avg('rating');
                            $fullStars = floor($averageRating);
                            $hasHalfStar = $averageRating - $fullStars >= 0.5;
                        @endphp
                        <div class="rating-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $fullStars)
                                    <i class="fas fa-star"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="rating-text">{{ number_format($averageRating, 1) }} ({{ $product->reviews->count() }}
                            {{ Str::plural('Rating', $product->reviews->count()) }})</span>
                    </div>
                @endif

                <!-- Stock Info -->
                <div class="stock-info">
                    @if ($product->stock_quantity > 10)
                        <i class="fas fa-check-circle"></i> In Stock ({{ $product->stock_quantity }} available)
                    @elseif($product->stock_quantity > 0)
                        <span class="stock-low"><i class="fas fa-exclamation-triangle"></i> Only
                            {{ $product->stock_quantity }} left in stock</span>
                    @else
                        <span class="stock-out"><i class="fas fa-times-circle"></i> Out of Stock</span>
                    @endif
                </div>

                <!-- Best Seller Badge -->
                <div class="bestseller-badge">
                    <i class="fas fa-medal"></i> Best Seller #33 in {{ $product->category->name }}
                </div>

                <!-- Price Section -->
                <div class="price-section">
                    @if (
                        $product->price_discounted &&
                            $product->price_discounted > 0 &&
                            $product->price_discounted < $product->price_regular)
                        <div class="current-price">
                            {{ number_format($product->price_discounted, 0, ',', ' ') }} DJF
                        </div>
                        <div>
                            <span class="original-price">{{ number_format($product->price_regular, 0, ',', ' ') }}
                                DJF</span>
                            @php
                                $discountPercentage = round(
                                    (($product->price_regular - $product->price_discounted) / $product->price_regular) *
                                        100,
                                );
                            @endphp
                            <span class="discount-badge">{{ $discountPercentage }}% Off</span>
                        </div>
                    @else
                        <div class="current-price">
                            {{ number_format($product->price_regular, 0, ',', ' ') }} DJF
                        </div>
                    @endif
                </div>

                <!-- Quantity Selector -->
                @if ($product->stock_quantity > 0)
                    <div class="quantity-selector">
                        <label for="quantity"><strong>Quantity:</strong></label>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn" id="decreaseQty">-</button>
                            <input type="number" id="quantity" class="quantity-input" value="1" min="1"
                                max="{{ $product->stock_quantity }}" readonly>
                            <button type="button" class="quantity-btn" id="increaseQty">+</button>
                        </div>
                        <small class="text-muted">Max: {{ $product->stock_quantity }}</small>
                    </div>
                @endif

                <!-- Delivery Info -->
                <div class="delivery-info">
                    <div class="delivery-badge">⚡ FASTER DELIVERY</div>
                    <div class="express-badge">express</div>
                    <div><strong>Get it Tomorrow</strong> | Order in 14h36m</div>
                </div>

                <!-- Product Features -->
                <div class="product-features">
                    <div class="feature-item">
                        <i class="fas fa-calendar-alt feature-icon"></i>
                        <span>1 year warranty</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-undo-alt feature-icon"></i>
                        <span>This item is eligible for free returns</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <span>Secure Payments</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn btn-add-cart" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}
                        onclick="addToCartFromProduct({{ $product->id }})">
                        {{ $product->stock_quantity > 0 ? 'ADD TO CART' : 'OUT OF STOCK' }}
                    </button>
                    <button class="btn btn-wishlist">
                        <i class="far fa-heart"></i>
                    </button>
                </div>

                <!-- Payment Options -->
                <div class="payment-options">
                    <h6 class="mb-3">PAYMENT DISCOUNT</h6>
                    <div class="payment-option">
                        <i class="fas fa-credit-card text-primary"></i>
                        <span>Pay in 4 simple, interest free payments of
                            {{ number_format(($product->price_discounted ?? $product->price_regular) / 4, 2) }} DJF</span>
                    </div>
                    <div class="payment-option">
                        <i class="fas fa-coins text-warning"></i>
                        <span>Earn 38.95 DJF CASHBACK with Credit Card. <a href="#" class="text-primary">Apply
                                now</a></span>
                    </div>
                </div>

                <!-- Product Meta -->
                @if ($product->sku)
                    <div class="text-muted small mb-2">
                        <strong>SKU:</strong> {{ $product->sku }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Description -->
        @if ($product->description)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Product Description</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ strip_tags($product->description) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- More from Seller -->
        @if ($moreFromSeller->count() > 0)
            <div class="product-section">
                <h4 class="section-title">More from {{ $product->seller->name }}</h4>
                <div class="row">
                    @foreach ($moreFromSeller as $sellerProduct)
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 mb-4 product-grid-5">
                            <x-buyer.product-card :product="$sellerProduct" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Customers Also Viewed -->
        @if ($customersAlsoViewed->count() > 0)
            <div class="product-section">
                <h4 class="section-title">Customers Also Viewed</h4>
                <div class="row">
                    @foreach ($customersAlsoViewed as $viewedProduct)
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 mb-4 product-grid-5">
                            <x-buyer.product-card :product="$viewedProduct" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Products Related to This -->
        @if ($relatedProducts->count() > 0)
            <div class="product-section">
                <h4 class="section-title">Products Related to This</h4>
                <div class="row">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6 mb-4 product-grid-5">
                            <x-buyer.product-card :product="$relatedProduct" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Zoom Overlay -->
    <div class="zoom-overlay" id="zoomOverlay">
        <span class="close-zoom" id="closeZoom">&times;</span>
        <div class="zoom-info" id="zoomInfo">1 / 1</div>
        <span class="navigation-arrows nav-prev" id="prevImage">&#8249;</span>
        <span class="navigation-arrows nav-next" id="nextImage">&#8250;</span>
        <div class="zoom-content">
            <img id="zoomImage" src="" alt="">
        </div>
        <div class="zoom-thumbnails" id="zoomThumbnails">
            <!-- Thumbnails will be populated by JavaScript -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Move zoom overlay to the body to fix stacking issues
            const zoomOverlay = document.getElementById('zoomOverlay');
            if (zoomOverlay) {
                document.body.appendChild(zoomOverlay);
            }

            // Image gallery functionality
            const thumbnails = document.querySelectorAll('.thumbnail-item');
            const mainImage = document.getElementById('currentImage');
            const mainContainer = document.getElementById('mainImageContainer');
            const zoomImage = document.getElementById('zoomImage');
            const closeZoom = document.getElementById('closeZoom');
            const prevImage = document.getElementById('prevImage');
            const nextImage = document.getElementById('nextImage');
            const mainPrevBtn = document.getElementById('mainPrevBtn');
            const mainNextBtn = document.getElementById('mainNextBtn');
            const zoomLens = document.getElementById('zoomLens');
            const zoomResult = document.getElementById('zoomResult');
            const zoomInfo = document.getElementById('zoomInfo');
            const zoomThumbnails = document.getElementById('zoomThumbnails');

            let currentImageIndex = 0;
            let images = [];

            // Collect all images
            thumbnails.forEach((thumb, index) => {
                const img = thumb.querySelector('img');
                images.push(img.src);

                thumb.addEventListener('click', function() {
                    changeImage(index);
                });
            });

            // Main image navigation
            mainPrevBtn.addEventListener('click', function() {
                currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : images.length - 1;
                changeImage(currentImageIndex);
            });

            mainNextBtn.addEventListener('click', function() {
                currentImageIndex = currentImageIndex < images.length - 1 ? currentImageIndex + 1 : 0;
                changeImage(currentImageIndex);
            });

            function changeImage(index) {
                // Remove active class from all thumbnails
                thumbnails.forEach(t => t.classList.remove('active'));
                // Add active class to current thumbnail
                thumbnails[index].classList.add('active');

                // Update main image
                mainImage.src = images[index];
                currentImageIndex = index;

                // Reinitialize zoom for new image
                if (zoomResult.style.display === 'block') {
                    cleanupZoom();
                    // Wait for image to load before reinitializing zoom
                    mainImage.onload = function() {
                        if (zoomResult.style.display === 'block') {
                            initializeZoom();
                        }
                    };
                }
            }

            // Hover zoom functionality
            let isZoomInitialized = false;
            let zoomEventListeners = [];

            function initializeZoom() {
                if (isZoomInitialized || window.innerWidth <= 768) return;

                const img = mainImage;
                const result = zoomResult;
                const lens = zoomLens;

                // Calculate the ratio between result DIV and lens
                const cx = result.offsetWidth / lens.offsetWidth;
                const cy = result.offsetHeight / lens.offsetHeight;

                // Set background properties for the result DIV
                result.style.backgroundImage = "url('" + img.src + "')";
                result.style.backgroundSize = (img.naturalWidth * cx) + "px " + (img.naturalHeight * cy) + "px";

                function moveLens(e) {
                    e.preventDefault();
                    const pos = getCursorPos(e, img);

                    // Calculate the position of the lens
                    let x = pos.x - (lens.offsetWidth / 2);
                    let y = pos.y - (lens.offsetHeight / 2);

                    // Get the actual image dimensions and position
                    const imgRect = img.getBoundingClientRect();
                    const imgDisplayWidth = imgRect.width;
                    const imgDisplayHeight = imgRect.height;

                    // Prevent the lens from being positioned outside the image
                    if (x > imgDisplayWidth - lens.offsetWidth) x = imgDisplayWidth - lens.offsetWidth;
                    if (x < 0) x = 0;
                    if (y > imgDisplayHeight - lens.offsetHeight) y = imgDisplayHeight - lens.offsetHeight;
                    if (y < 0) y = 0;

                    // Set the position of the lens
                    lens.style.left = x + "px";
                    lens.style.top = y + "px";

                    // Calculate zoom ratios
                    const zoomX = (x / imgDisplayWidth) * img.naturalWidth * cx;
                    const zoomY = (y / imgDisplayHeight) * img.naturalHeight * cy;

                    // Display what the lens "sees"
                    result.style.backgroundPosition = "-" + zoomX + "px -" + zoomY + "px";
                }

                function getCursorPos(e, img) {
                    const rect = img.getBoundingClientRect();
                    const x = (e.clientX || e.touches[0].clientX) - rect.left;
                    const y = (e.clientY || e.touches[0].clientY) - rect.top;
                    return {
                        x: x,
                        y: y
                    };
                }

                // Store event listeners for cleanup
                const mouseMoveHandler = (e) => moveLens(e);
                const touchMoveHandler = (e) => moveLens(e);

                img.addEventListener("mousemove", mouseMoveHandler);
                img.addEventListener("touchmove", touchMoveHandler);

                zoomEventListeners.push({
                    element: img,
                    event: "mousemove",
                    handler: mouseMoveHandler
                }, {
                    element: img,
                    event: "touchmove",
                    handler: touchMoveHandler
                });

                isZoomInitialized = true;
            }

            function cleanupZoom() {
                zoomEventListeners.forEach(({
                    element,
                    event,
                    handler
                }) => {
                    element.removeEventListener(event, handler);
                });
                zoomEventListeners = [];
                isZoomInitialized = false;
            }

            mainContainer.addEventListener('mouseenter', function() {
                if (window.innerWidth > 768) { // Only on desktop
                    const setupZoom = () => {
                        zoomLens.style.display = 'block';
                        zoomResult.style.display = 'block';
                        initializeZoom();
                    };

                    if (mainImage.complete) {
                        setupZoom();
                    } else {
                        mainImage.addEventListener('load', setupZoom, {
                            once: true
                        });
                    }
                }
            });

            mainContainer.addEventListener('mouseleave', function() {
                zoomLens.style.display = 'none';
                zoomResult.style.display = 'none';
                cleanupZoom();
            });

            // Full screen zoom functionality
            mainImage.addEventListener('click', function() {
                openZoomOverlay();
            });

            function openZoomOverlay() {
                zoomImage.src = images[currentImageIndex];
                updateZoomInfo();
                populateZoomThumbnails();
                zoomOverlay.style.display = 'flex';
                document.body.style.overflow = 'hidden';

                // Hide page elements that might interfere
                const topbar = document.querySelector('.header-top');
                const header = document.querySelector('.header');
                if (topbar) topbar.style.zIndex = '1';
                if (header) header.style.zIndex = '1';
            }

            function updateZoomInfo() {
                zoomInfo.textContent = `${currentImageIndex + 1} / ${images.length}`;
            }

            function populateZoomThumbnails() {
                zoomThumbnails.innerHTML = '';
                images.forEach((imgSrc, index) => {
                    const thumbDiv = document.createElement('div');
                    thumbDiv.className = `zoom-thumbnail ${index === currentImageIndex ? 'active' : ''}`;
                    thumbDiv.innerHTML = `<img src="${imgSrc}" alt="Thumbnail ${index + 1}">`;
                    thumbDiv.addEventListener('click', () => {
                        currentImageIndex = index;
                        zoomImage.src = images[currentImageIndex];
                        updateZoomInfo();
                        updateZoomThumbnails();
                        updateThumbnailActive();
                    });
                    zoomThumbnails.appendChild(thumbDiv);
                });
            }

            function updateZoomThumbnails() {
                const zoomThumbItems = document.querySelectorAll('.zoom-thumbnail');
                zoomThumbItems.forEach((thumb, index) => {
                    thumb.classList.toggle('active', index === currentImageIndex);
                });
            }

            closeZoom.addEventListener('click', function() {
                closeZoomOverlay();
            });

            function closeZoomOverlay() {
                zoomOverlay.style.display = 'none';
                document.body.style.overflow = 'auto';

                // Restore page elements z-index
                const topbar = document.querySelector('.header-top');
                const header = document.querySelector('.header');
                if (topbar) topbar.style.zIndex = '';
                if (header) header.style.zIndex = '';
            }

            // Navigation in zoom
            prevImage.addEventListener('click', function() {
                currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : images.length - 1;
                zoomImage.src = images[currentImageIndex];
                updateZoomInfo();
                updateZoomThumbnails();
                updateThumbnailActive();
            });

            nextImage.addEventListener('click', function() {
                currentImageIndex = currentImageIndex < images.length - 1 ? currentImageIndex + 1 : 0;
                zoomImage.src = images[currentImageIndex];
                updateZoomInfo();
                updateZoomThumbnails();
                updateThumbnailActive();
            });

            // Close zoom on overlay click
            zoomOverlay.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeZoomOverlay();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (zoomOverlay.style.display === 'flex') {
                    if (e.key === 'Escape') {
                        closeZoomOverlay();
                    } else if (e.key === 'ArrowLeft') {
                        prevImage.click();
                    } else if (e.key === 'ArrowRight') {
                        nextImage.click();
                    }
                }
            });

            function updateThumbnailActive() {
                thumbnails.forEach(t => t.classList.remove('active'));
                thumbnails[currentImageIndex].classList.add('active');
                mainImage.src = images[currentImageIndex];
            }

            // Quantity controls
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decreaseQty');
            const increaseBtn = document.getElementById('increaseQty');

            if (quantityInput && decreaseBtn && increaseBtn) {
                const maxQuantity = parseInt(quantityInput.getAttribute('max'));

                decreaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                    updateQuantityButtons();
                });

                increaseBtn.addEventListener('click', function() {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue < maxQuantity) {
                        quantityInput.value = currentValue + 1;
                    }
                    updateQuantityButtons();
                });

                function updateQuantityButtons() {
                    const currentValue = parseInt(quantityInput.value);
                    decreaseBtn.disabled = currentValue <= 1;
                    increaseBtn.disabled = currentValue >= maxQuantity;
                }

                // Initial button state
                updateQuantityButtons();
            }

            // Touch/swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            mainContainer.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            mainContainer.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            zoomOverlay.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            zoomOverlay.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                if (touchEndX < touchStartX - 50) {
                    // Swipe left - next image
                    currentImageIndex = currentImageIndex < images.length - 1 ? currentImageIndex + 1 : 0;
                    changeImage(currentImageIndex);
                    if (zoomOverlay.style.display === 'flex') {
                        zoomImage.src = images[currentImageIndex];
                    }
                }
                if (touchEndX > touchStartX + 50) {
                    // Swipe right - previous image
                    currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : images.length - 1;
                    changeImage(currentImageIndex);
                    if (zoomOverlay.style.display === 'flex') {
                        zoomImage.src = images[currentImageIndex];
                    }
                }
            }

            // Cart functionality
            window.addToCartFromProduct = function(productId) {
                const quantityInput = document.getElementById('quantity');
                const quantity = quantityInput ? parseInt(quantityInput.value) : 1;

                // Disable button temporarily
                const addToCartBtn = document.querySelector('.btn-add-cart');
                const originalText = addToCartBtn.textContent;
                addToCartBtn.disabled = true;
                addToCartBtn.textContent = 'Adding...';

                fetch('{{ route('cart.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update cart count in header
                            const cartCountElements = document.querySelectorAll('.number-item');
                            cartCountElements.forEach(element => {
                                element.textContent = data.cart_count;
                            });

                            // Show success message
                            showNotification(data.message, 'success');

                            // Reset quantity to 1
                            if (quantityInput) {
                                quantityInput.value = 1;
                                updateQuantityButtons();
                            }
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('An error occurred. Please try again.', 'error');
                    })
                    .finally(() => {
                        // Re-enable button
                        addToCartBtn.disabled = false;
                        addToCartBtn.textContent = originalText;
                    });
            };

            function showNotification(message, type = 'info') {
                // Create notification element
                const notification = document.createElement('div');
                notification.className =
                    `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 300px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                `;
                notification.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;

                document.body.appendChild(notification);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 3000);
            }
        });
    </script>
@endsection
