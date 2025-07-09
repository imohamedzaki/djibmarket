<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
    <div class="box-slider-product">
        <div class="head-slider">
            <div class="row">
                <div class="col-lg-7">
                    <h5>Top Rated</h5>
                </div>
                <div class="col-lg-5">
                    <div class="box-button-slider-2">
                        <div class="swiper-button-prev swiper-button-prev-style-top swiper-button-prev-toprated">
                        </div>
                        <div class="swiper-button-next swiper-button-next-style-top swiper-button-next-toprated">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-products">
            @if ($topRatedProducts->count() > 0)
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3-toprated">
                        <div class="swiper-wrapper">
                            @foreach ($topRatedProducts as $product)
                                <div class="swiper-slide">
                                    <div class="card-product-small">
                                        <div class="card-image" style="position: relative;">
                                            @if (isset($product->average_rating) && $product->average_rating >= 4.5)
                                                <div class="top-rated-badge"
                                                    style="position: absolute; top: 10px; left: 10px; background: #ffc107; color: #212529; padding: 5px 8px; border-radius: 15px; font-size: 12px; font-weight: bold; z-index: 2;">
                                                    ⭐ TOP RATED
                                                </div>
                                            @endif
                                            <a href="#"
                                                style="display: block; width: 100%; height: 200px; overflow: hidden;">
                                                <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage9/sp13.png') }}"
                                                    alt="{{ $product->title }}"
                                                    style="width: 100%; height: 100%; object-fit: contain; object-position: center;">
                                            </a>
                                        </div>
                                        <div class="card-info">
                                            <h6 class="product-title"
                                                style="font-size: 14px; margin-bottom: 8px; height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                {{ $product->title }}
                                            </h6>
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
                                                <span class="font-xs color-gray-500">({{ $reviewCount }})</span>
                                            </div>
                                            <div class="box-prices">
                                                @if (
                                                    $product->price_discounted &&
                                                        $product->price_discounted > 0 &&
                                                        $product->price_discounted < $product->price_regular)
                                                    <div class="price-bold color-brand-3">
                                                        {{ number_format($product->price_discounted, 0) }}
                                                        DJF
                                                    </div>
                                                    <div class="price-line text-end color-gray-500">
                                                        {{ number_format($product->price_regular, 0) }} DJF
                                                    </div>
                                                @else
                                                    <div class="price-bold color-brand-3">
                                                        {{ number_format($product->price_regular, 0) }} DJF
                                                    </div>
                                                @endif
                                            </div>
                                            @if (isset($product->average_rating) && $product->average_rating > 0)
                                                <div style="font-size: 12px; color: #ffc107; margin-top: 5px;">
                                                    ⭐ {{ number_format($product->average_rating, 1) }}
                                                    average rating
                                                </div>
                                            @endif
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
                            <path
                                d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                                stroke="#6c757d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h5 style="color: #495057; margin-bottom: 12px; font-weight: 600; font-size: 18px;">No
                        Top Rated Products</h5>
                    <p style="color: #6c757d; font-size: 14px; margin-bottom: 0; line-height: 1.5;">
                        No top rated products<br>
                        available at the moment.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
