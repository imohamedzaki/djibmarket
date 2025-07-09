<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
    <div class="box-slider-product">
        <div class="head-slider">
            <div class="row">
                <div class="col-lg-7">
                    <h5>New arrivals</h5>
                </div>
                <div class="col-lg-5">
                    <div class="box-button-slider-2">
                        <div class="swiper-button-prev swiper-button-prev-style-top swiper-button-prev-newarrival">
                        </div>
                        <div class="swiper-button-next swiper-button-next-style-top swiper-button-next-newarrival">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-products">
            @if ($newArrivals->count() > 0)
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3-newarrival">
                        <div class="swiper-wrapper">
                            @foreach ($newArrivals as $product)
                                <div class="swiper-slide">
                                    <x-buyer.product-card-home :product="$product" />
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
                            <path d="M4 7V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V7"
                                stroke="#6c757d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 7H21L20 4H4L3 7Z" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M10 11V13" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M14 11V13" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M8 4V2C8 1.44772 8.44772 1 9 1H15C15.5523 1 16 1.44772 16 2V4" stroke="#6c757d"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h5 style="color: #495057; margin-bottom: 12px; font-weight: 600; font-size: 18px;">No
                        New Arrivals Products</h5>
                    <p style="color: #6c757d; font-size: 14px; margin-bottom: 0; line-height: 1.5;">
                        No new arrivals products<br>
                        available at the moment.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* New Arrivals Section Styling */
    .swiper-group-3-newarrival .swiper-slide {
        height: auto;
    }

    .swiper-group-3-newarrival .product-card-home {
        height: 100%;
        max-width: 100%;
        margin: 0;
    }

    /* Adjust product card for slider context */
    .swiper-group-3-newarrival .product-card-home .product-image-wrapper {
        aspect-ratio: 1;
        min-height: 200px;
    }

    .swiper-group-3-newarrival .product-card-home .product-info {
        padding: 16px;
    }

    .swiper-group-3-newarrival .product-card-home .product-title {
        font-size: 14px;
        line-height: 1.3;
    }

    .swiper-group-3-newarrival .product-card-home .product-title a {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .swiper-group-3-newarrival .product-card-home .price-current {
        font-size: 16px;
    }

    .swiper-group-3-newarrival .product-card-home .btn-add-cart {
        padding: 10px 20px;
        font-size: 13px;
    }

    /* Hide product features in slider to save space */
    .swiper-group-3-newarrival .product-card-home .product-features {
        display: none;
    }

    /* Ensure consistent spacing */
    .swiper-group-3-newarrival .product-card-home .product-info {
        gap: 8px;
    }

    /* Responsive adjustments for new arrivals slider */
    @media (max-width: 768px) {
        .swiper-group-3-newarrival .product-card-home .product-image-wrapper {
            min-height: 160px;
        }

        .swiper-group-3-newarrival .product-card-home .product-info {
            padding: 12px;
        }

        .swiper-group-3-newarrival .product-card-home .product-title {
            font-size: 13px;
        }

        .swiper-group-3-newarrival .product-card-home .price-current {
            font-size: 15px;
        }
    }
</style>
