<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
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
                                    <div class="card-product-small">
                                        <div class="card-image" style="position: relative;">
                                            <div class="flash-sale-badge">
                                                @if ($product->flash_sale_discount_type === 'percentage')
                                                    {{ $product->flash_sale_discount_value }}% OFF
                                                @else
                                                    {{ number_format($product->flash_sale_discount_value, 0) }}
                                                    DJF OFF
                                                @endif
                                            </div>
                                            <a href="#"
                                                style="display: block; width: 100%; height: 200px; overflow: hidden;">
                                                <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage9/sp7.png') }}"
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
                                                <div class="price-bold color-brand-3">
                                                    {{ number_format($product->flash_sale_discounted_price, 0) }}
                                                    DJF
                                                </div>
                                                <div class="price-line text-end color-gray-500">
                                                    {{ number_format($product->price_regular, 0) }} DJF
                                                </div>
                                            </div>
                                            <div class="flash-sale-timer">
                                                Ends: {{ $product->flash_sale_end_at->format('M d, H:i') }}
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
