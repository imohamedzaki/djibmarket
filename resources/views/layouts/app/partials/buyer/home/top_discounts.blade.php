<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
    <div class="box-slider-product">
        <div class="head-slider">
            <div class="row">
                <div class="col-lg-7">
                    <h5>Top Discounts</h5>
                </div>
                <div class="col-lg-5">
                    <div class="box-button-slider-2">
                        <div class="swiper-button-prev swiper-button-prev-style-top swiper-button-prev-topdiscounts">
                        </div>
                        <div class="swiper-button-next swiper-button-next-style-top swiper-button-next-topdiscounts">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-products">
            @if ($topDiscountsProducts->count() > 0)
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3-topdiscounts">
                        <div class="swiper-wrapper">
                            @foreach ($topDiscountsProducts as $product)
                                <div class="swiper-slide">
                                    <div class="card-product-small">
                                        <div class="card-image" style="position: relative;">
                                            @if (isset($product->discount_percentage) && $product->discount_percentage > 0)
                                                <div class="discount-badge"
                                                    style="position: absolute; top: 10px; left: 10px; background: #ff4757; color: white; padding: 5px 8px; border-radius: 15px; font-size: 12px; font-weight: bold; z-index: 2;">
                                                    {{ number_format($product->discount_percentage, 0) }}%
                                                    OFF
                                                </div>
                                            @endif
                                            <a href="#"
                                                style="display: block; width: 100%; height: 200px; overflow: hidden;">
                                                <img src="{{ $product->featured_image_url ?? asset('assets/imgs/page/homepage9/sp16.png') }}"
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
                                                    {{ number_format($product->price_discounted, 0) }} DJF
                                                </div>
                                                <div class="price-line text-end color-gray-500">
                                                    {{ number_format($product->price_regular, 0) }} DJF
                                                </div>
                                            </div>
                                            @if (isset($product->discount_amount) && $product->discount_amount > 0)
                                                <div style="font-size: 12px; color: #28a745; margin-top: 5px;">
                                                    Save {{ number_format($product->discount_amount, 0) }}
                                                    DJF
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
                            <path d="M9 12L11 14L15 10" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M20.59 13.41L13.42 20.58C13.2343 20.766 12.9949 20.8709 12.745 20.8709C12.4951 20.8709 12.2557 20.766 12.07 20.58L7.29 15.8C7.19996 15.7108 7.12991 15.6057 7.08329 15.4906C7.03666 15.3755 7.01428 15.2528 7.01428 15.129C7.01428 15.0052 7.03666 14.8825 7.08329 14.7674C7.12991 14.6523 7.19996 14.5472 7.29 14.458L14.46 7.288C14.6457 7.10233 14.8851 6.99742 15.135 6.99742C15.3849 6.99742 15.6243 7.10233 15.81 7.288L20.59 12.068C20.7763 12.2537 20.8812 12.4931 20.8812 12.743C20.8812 12.9929 20.7763 13.2323 20.59 13.418V13.41Z"
                                stroke="#6c757d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21 21H12L17 16" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h5 style="color: #495057; margin-bottom: 12px; font-weight: 600; font-size: 18px;">No
                        Discounted Products</h5>
                    <p style="color: #6c757d; font-size: 14px; margin-bottom: 0; line-height: 1.5;">
                        No discounted products<br>
                        available at the moment.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
