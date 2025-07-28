<div class="col-xl-4 col-lg-8 col-md-8 col-sm-12">
    <div class="box-slider-product">
        <div class="head-slider">
            <div class="row">
                <div class="col-lg-7">
                    <h5>Flash Sales</h5>
                </div>
                <div class="col-lg-5">
                    <div class="box-button-slider-2">
                        <div class="swiper-button-prev swiper-button-prev-style-top swiper-button-prev-hotdeal">
                        </div>
                        <div class="swiper-button-next swiper-button-next-style-top swiper-button-next-hotdeal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-products">
            @if ($flashSalesProducts->count() > 0)
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3-hotdeal">
                        <div class="swiper-wrapper">
                            @foreach ($flashSalesProducts as $product)
                                <div class="swiper-slide">
                                    <div class="flash-sale-product-card">
                                        <x-buyer.product-card-home :product="$product" />

                                        <!-- Flash Sale Specific Elements Overlay -->
                                        <div class="flash-sale-overlay">
                                            <!-- Flash Sale Badge -->
                                            {{-- <div class="flash-sale-badge">
                                                @if ($product->flash_sale_discount_type === 'percentage')
                                                    {{ $product->flash_sale_discount_value }}% OFF
                                                @else
                                                    {{ number_format($product->flash_sale_discount_value, 0) }}
                                                    DJF OFF
                                                @endif
                                            </div> --}}

                                            <!-- Flash Sale Timer -->
                                            <div class="flash-sale-timer">
                                                <span class="timer-label">Ends:</span>
                                                <span
                                                    class="timer-value">{{ $product->flash_sale_end_at->format('M d, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="no-products-container">
                    <div class="no-products-icon" style="margin-bottom: 20px;">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="opacity: 0.4;">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="#ff4757" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="12" cy="12" r="1" fill="#ff4757" />
                        </svg>
                    </div>
                    <h5 style="color: #495057; margin-bottom: 12px; font-weight: 600; font-size: 18px;">No
                        Flash Sales Products</h5>
                    <p style="color: #6c757d; font-size: 14px; margin-bottom: 0; line-height: 1.5;">
                        No flash sales products<br>
                        available at the moment.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Flash Sales Section Styling */
    .swiper-group-3-hotdeal .swiper-slide {
        height: auto;
    }

    .flash-sale-product-card {
        position: relative;
        height: 100%;
        max-width: 100%;
        margin: 0;
    }

    .flash-sale-product-card .product-card-home {
        height: 100%;
    }

    /* Flash Sale Overlay for specific elements */
    .flash-sale-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 25;
        pointer-events: none;
    }

    /* Flash Sale Badge */
    .flash-sale-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(135deg, #ff4757, #ff3838);
        color: white;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 3px 12px rgba(255, 71, 87, 0.4);
        animation: pulse-flash 2s infinite;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    @keyframes pulse-flash {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 3px 12px rgba(255, 71, 87, 0.4);
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 5px 20px rgba(255, 71, 87, 0.6);
        }
    }

    /* Flash Sale Timer */
    .flash-sale-timer {
        position: absolute;
        bottom: 12px;
        left: 12px;
        right: 12px;
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 11px;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .timer-label {
        opacity: 0.8;
        margin-right: 4px;
    }

    .timer-value {
        font-weight: 600;
        color: #ffd700;
    }

    /* Adjust product card for flash sale slider context */
    .swiper-group-3-hotdeal .product-card-home .product-image-wrapper {
        aspect-ratio: 1;
        min-height: 200px;
    }

    .swiper-group-3-hotdeal .product-card-home .product-info {
        padding: 16px;
    }

    .swiper-group-3-hotdeal .product-card-home .product-title {
        font-size: 14px;
        line-height: 1.3;
    }

    .swiper-group-3-hotdeal .product-card-home .product-title a {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Update price to show flash sale discounted price */
    .flash-sale-product-card .product-price .price-current {
        color: #ff4757 !important;
        font-weight: 700;
        font-size: 16px;
    }

    .swiper-group-3-hotdeal .product-card-home .btn-add-cart {
        padding: 10px 20px;
        font-size: 13px;
        background: linear-gradient(135deg, #ff4757, #ff3838);
        border: none;
        color: white;
        font-weight: 600;
    }

    .swiper-group-3-hotdeal .product-card-home .btn-add-cart:hover {
        background: linear-gradient(135deg, #ff3838, #ff2b2b);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4);
    }

    /* Flash Sale Added Button State */
    .swiper-group-3-hotdeal .product-card-home .btn-add-cart.btn-in-cart {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .swiper-group-3-hotdeal .product-card-home .btn-add-cart.btn-in-cart:hover {
        background: linear-gradient(135deg, #10b981, #059669);
        transform: none;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    /* Hide product features in flash sale slider to save space */
    .swiper-group-3-hotdeal .product-card-home .product-features {
        display: none;
    }

    /* Ensure consistent spacing */
    .swiper-group-3-hotdeal .product-card-home .product-info {
        gap: 8px;
    }

    /* Responsive adjustments for flash sales slider */
    @media (max-width: 768px) {
        .swiper-group-3-hotdeal .product-card-home .product-image-wrapper {
            min-height: 160px;
        }

        .swiper-group-3-hotdeal .product-card-home .product-info {
            padding: 12px;
        }

        .swiper-group-3-hotdeal .product-card-home .product-title {
            font-size: 13px;
        }

        .flash-sale-badge {
            font-size: 10px;
            padding: 4px 8px;
        }

        .flash-sale-timer {
            font-size: 10px;
            padding: 6px 10px;
        }
    }
</style>
