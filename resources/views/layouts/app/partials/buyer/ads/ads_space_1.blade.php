@php
    use App\Models\SellerAd;

    $mainBannerAds = SellerAd::active()->forSlot('ads_space_1_main_banner')->latest()->get();

    $weeklyDealAds = SellerAd::active()->forSlot('ads_space_1_weekly_deal')->latest()->get();

    $techProductsAds = SellerAd::active()->forSlot('ads_space_1_tech_products')->latest()->get();
@endphp

<section class="section-box bg-home9">
    <div class="banner-hero banner-home9">
        <div class="container">
            <div class="row">
                {{-- Main Banner Slider --}}
                <div class="col-xl-6 col-lg-5 mb-20">
                    @if ($mainBannerAds->count() > 0)
                        <div class="box-swiper">
                            <div class="swiper-container swiper-group-1-custom home-9">
                                <div class="swiper-wrapper">
                                    @foreach ($mainBannerAds as $ad)
                                        @php
                                            $colors = json_decode($ad->custom_colors, true);
                                        @endphp
                                        <div class="swiper-slide">
                                            <div
                                                class="banner-big-home9 {{ $colors['background_class'] ?? 'bg-soft-blue' }}">
                                                <div class="info-banner">
                                                    <span
                                                        class="font-sm text-uppercase {{ $colors['label_class'] ?? 'label-green' }}">{{ $colors['label_text'] ?? 'new arrival' }}</span>
                                                    <h4 class="mt-10 color-gray-1000">{{ $ad->headline }}</h4>
                                                    @if ($ad->sub_headline)
                                                        <p class="font-nd color-brand-1">{{ $ad->sub_headline }}</p>
                                                    @endif
                                                    <div class="mt-30">
                                                        <a class="btn btn-brand-2 btn-arrow-right"
                                                            href="{{ $ad->call_to_action_url ?? '#' }}"
                                                            onclick="trackAdClick({{ $ad->id }})">
                                                            {{ $ad->call_to_action_text }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="box-img-banner">
                                                    <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}"
                                                        onload="trackAdView({{ $ad->id }})">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination swiper-pagination-1"></div>
                            </div>
                        </div>
                    @else
                        {{-- Empty Ad Space for Main Banner --}}
                        <div class="empty-ad-space main-banner-empty">
                            <div class="empty-ad-content">
                                <div class="empty-ad-icon">
                                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                        class="empty-ad-logo">
                                </div>
                                <h4 class="empty-ad-title">Ad Space Available</h4>
                                <p class="empty-ad-subtitle">Premium advertising space available for display</p>
                                <small class="empty-ad-note">Contact us to advertise here</small>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Weekly Deal Slider --}}
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-20">
                    @if ($weeklyDealAds->count() > 0)
                        <div class="box-swiper banner-slider-container">
                            <div class="swiper-container swiper-group-2-custom home-9">
                                <div class="swiper-wrapper">
                                    @foreach ($weeklyDealAds as $ad)
                                        @php
                                            $colors = json_decode($ad->custom_colors, true);
                                        @endphp
                                        <div class="swiper-slide">
                                            <div
                                                class="banner-small {{ $colors['background_class'] ?? 'bg-soft-lavender' }} text-center">
                                                <span
                                                    class="color-brand-3 font-sm">{{ $colors['label_text'] ?? 'New Arrivals' }}</span>
                                                <h4 class="mb-5 mt-5 color-gray-1000">{{ $ad->headline }}</h4>
                                                @if ($ad->sub_headline)
                                                    <span class="color-brand-1 font-md">{{ $ad->sub_headline }}</span>
                                                @endif
                                                <div class="mt-20">
                                                    <a class="btn btn-brand-3 btn-arrow-right"
                                                        href="{{ $ad->call_to_action_url ?? '#' }}"
                                                        onclick="trackAdClick({{ $ad->id }})">
                                                        {{ $ad->call_to_action_text }}
                                                    </a>
                                                </div>
                                                <div class="mt-30">
                                                    <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}"
                                                        onload="trackAdView({{ $ad->id }})">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination swiper-pagination-2"></div>
                            </div>
                        </div>
                    @else
                        {{-- Empty Ad Space for Weekly Deals --}}
                        <div class="empty-ad-space weekly-deals-empty">
                            <div class="empty-ad-content text-center">
                                <div class="empty-ad-icon">
                                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                        class="empty-ad-logo-small">
                                </div>
                                <h5 class="empty-ad-title-small">Ad Space</h5>
                                <p class="empty-ad-subtitle-small">Available</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Tech Products Slider --}}
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-20">
                    @if ($techProductsAds->count() > 0)
                        <div class="box-swiper banner-slider-container">
                            <div class="swiper-container swiper-group-3-custom home-9">
                                <div class="swiper-wrapper">
                                    @foreach ($techProductsAds as $ad)
                                        @php
                                            $colors = json_decode($ad->custom_colors, true);
                                        @endphp
                                        <div class="swiper-slide">
                                            <div
                                                class="banner-small {{ $colors['background_class'] ?? 'bg-soft-cream' }} text-center">
                                                <span
                                                    class="color-brand-3 font-sm">{{ $colors['label_text'] ?? 'New Arrivals' }}</span>
                                                <h4 class="mt-5 mb-10 color-gray-1000">{{ $ad->headline }}</h4>
                                                <div class="mt-15">
                                                    <a class="btn btn-brand-2 btn-arrow-right"
                                                        href="{{ $ad->call_to_action_url ?? '#' }}"
                                                        onclick="trackAdClick({{ $ad->id }})">
                                                        {{ $ad->call_to_action_text }}
                                                    </a>
                                                </div>
                                                <div class="mt-10">
                                                    <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}"
                                                        onload="trackAdView({{ $ad->id }})">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination swiper-pagination-3"></div>
                            </div>
                        </div>
                    @else
                        {{-- Empty Ad Space for Tech Products --}}
                        <div class="empty-ad-space tech-products-empty">
                            <div class="empty-ad-content text-center">
                                <div class="empty-ad-icon">
                                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                        class="empty-ad-logo-small">
                                </div>
                                <h5 class="empty-ad-title-small">Ad Space</h5>
                                <p class="empty-ad-subtitle-small">Available</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const initSwiper = (selector, paginationClass) => {
            if (document.querySelector(selector)) {
                const swiperSlides = document.querySelectorAll(selector + ' .swiper-slide');
                new Swiper(selector, {
                    slidesPerView: 1,
                    loop: swiperSlides.length > 1,
                    observer: true,
                    observeParents: true,
                    pagination: {
                        el: paginationClass,
                        clickable: true,
                    },
                    autoplay: {
                        delay: 5000 + Math.random() * 1000,
                        disableOnInteraction: false
                    },
                });
            }
        };

        initSwiper('.swiper-group-1-custom', '.swiper-pagination-1');
        initSwiper('.swiper-group-2-custom', '.swiper-pagination-2');
        initSwiper('.swiper-group-3-custom', '.swiper-pagination-3');
    });
</script>

{{-- JavaScript for tracking ad views and clicks --}}
<script>
    function trackAdView(adId) {
        fetch('{{ route('ad.track.view') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                seller_ad_id: adId
            })
        }).catch(error => console.log('Ad view tracking failed:', error));
    }

    function trackAdClick(adId) {
        fetch('{{ route('ad.track.click') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                seller_ad_id: adId
            })
        }).catch(error => console.log('Ad click tracking failed:', error));
    }
</script>

<style>
    /* Empty Ad Space Styles */
    .empty-ad-space {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        min-height: 314px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .empty-ad-space:hover {
        border-color: #adb5bd;
        background: linear-gradient(135deg, #f1f3f4 0%, #e2e6ea 100%);
    }

    .empty-ad-space::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23000" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23000" opacity="0.02"/><circle cx="50" cy="10" r="1" fill="%23000" opacity="0.02"/><circle cx="10" cy="90" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }

    .empty-ad-content {
        position: relative;
        z-index: 1;
    }

    .empty-ad-icon {
        margin-bottom: 15px;
    }

    .empty-ad-logo {
        max-width: 80px;
        height: auto;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    .empty-ad-logo-small {
        max-width: 50px;
        height: auto;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    .empty-ad-title {
        color: #6c757d;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 8px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-title-small {
        color: #6c757d;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-subtitle {
        color: #adb5bd;
        font-size: 14px;
        margin-bottom: 10px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-subtitle-small {
        color: #adb5bd;
        font-size: 12px;
        margin-bottom: 5px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-note {
        color: #adb5bd;
        font-size: 11px;
        font-style: italic;
        font-family: 'Arial', sans-serif;
    }

    /* Enhanced hover effect for empty ad spaces */
    .empty-ad-space:hover::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        transition: background-color 0.5s ease;
    }

    .empty-ad-space:hover .empty-ad-content {
        transform: scale(1.02);
        transition: transform 0.5s ease;
    }

    /* Responsive adjustments for empty ad spaces */
    @media (max-width: 768px) {
        .empty-ad-space {
            min-height: 280px;
            padding: 25px 15px;
        }

        .empty-ad-title {
            font-size: 18px;
        }

        .empty-ad-logo {
            max-width: 60px;
        }

        .empty-ad-logo-small {
            max-width: 40px;
        }
    }

    @media (max-width: 576px) {
        .empty-ad-space {
            min-height: 250px;
            padding: 20px 10px;
        }

        .empty-ad-title {
            font-size: 16px;
        }

        .empty-ad-title-small {
            font-size: 14px;
        }
    }

    /* Overlay effect on hover for main banner ads */
    .banner-big-home9 {
        position: relative;
        overflow: hidden;
        transition: transform 0.5s ease;
    }

    .banner-big-home9::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0);
        transition: background-color 0.5s ease;
        pointer-events: none;
        z-index: 1;
        border-radius: 12px;
    }

    .banner-big-home9:hover::before {
        background: rgba(0, 0, 0, 0.4);
    }

    .banner-big-home9:hover {
        transform: translateY(-3px);
    }

    /* Ensure content stays above overlay for main banner */
    .banner-big-home9>* {
        position: relative;
        z-index: 2;
    }

    /* Improve text contrast on hover for main banner */
    .banner-big-home9:hover .info-banner span,
    .banner-big-home9:hover .info-banner h4,
    .banner-big-home9:hover .info-banner p {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        transition: color 0.5s ease, text-shadow 0.5s ease;
    }

    /* Overlay effect for smaller banner ads */
    .banner-small {
        position: relative;
        overflow: hidden;
        transition: transform 0.5s ease;
    }

    .banner-small::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0);
        transition: background-color 0.5s ease;
        pointer-events: none;
        z-index: 1;
        border-radius: 12px;
    }

    .banner-small:hover::before {
        background: rgba(0, 0, 0, 0.4);
    }

    .banner-small:hover {
        transform: translateY(-3px);
    }

    /* Ensure content stays above overlay for small banners */
    .banner-small>* {
        position: relative;
        z-index: 2;
    }

    /* Improve text contrast on hover for small banners */
    .banner-small:hover span,
    .banner-small:hover h4,
    .banner-small:hover p,
    .banner-small:hover strong,
    .banner-small:hover div {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        transition: color 0.5s ease, text-shadow 0.5s ease;
    }

    /* Soft and calm background colors */
    .bg-soft-blue {
        background: linear-gradient(135deg, #e8f4f8 0%, #d1ecf1 100%);
    }

    .bg-soft-purple {
        background: linear-gradient(135deg, #f0e6ff 0%, #e0ccff 100%);
    }

    .bg-soft-green {
        background: linear-gradient(135deg, #e8f5e8 0%, #d4f1d4 100%);
    }

    .bg-soft-coral {
        background: linear-gradient(135deg, #ffe4e6 0%, #ffc8cc 100%);
    }

    .bg-soft-lavender {
        background: linear-gradient(135deg, #f5f0ff 0%, #ede0ff 100%);
    }

    .bg-soft-mint {
        background: linear-gradient(135deg, #e6fff0 0%, #ccffdd 100%);
    }

    .bg-soft-peach {
        background: linear-gradient(135deg, #fff5f0 0%, #ffe6d9 100%);
    }

    .bg-soft-sky {
        background: linear-gradient(135deg, #e6f7ff 0%, #cceeff 100%);
    }

    .bg-soft-cream {
        background: linear-gradient(135deg, #fffaf5 0%, #fff0e6 100%);
    }

    .bg-soft-rose {
        background: linear-gradient(135deg, #fff0f5 0%, #ffe6ee 100%);
    }

    .bg-soft-sage {
        background: linear-gradient(135deg, #f0f5f0 0%, #e6ebe6 100%);
    }

    .bg-soft-powder {
        background: linear-gradient(135deg, #f8f8ff 0%, #f0f0ff 100%);
    }

    /* Fix for proper slider container height and overflow */
    .banner-slider-container {
        height: 400px;
        overflow: hidden;
        position: relative;
    }

    .banner-slider-container .swiper-container {
        height: 100%;
        width: 100%;
    }

    .banner-slider-container .swiper-wrapper {
        height: 100%;
    }

    .banner-slider-container .swiper-slide {
        height: 100%;
        width: 100%;
        display: flex;
        align-items: stretch;
    }

    /* Ensure proper banner sizing */
    .banner-small {
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 25px 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }

    .banner-small:hover {
        transform: translateY(-5px);
    }

    /* Custom pagination styles for individual sliders */
    .swiper-pagination-1 {
        bottom: 20px !important;
        left: 25px !important;
        text-align: left !important;
        width: auto !important;
    }

    .swiper-pagination-2 {
        bottom: 15px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        text-align: center !important;
        width: auto !important;
    }

    .swiper-pagination-3 {
        bottom: 15px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        text-align: center !important;
        width: auto !important;
    }

    /* Enhanced pagination bullets */
    .swiper-pagination .swiper-pagination-bullet {
        width: 8px;
        height: 8px;
        /* background: rgba(0, 0, 0, 0.3); */
        background: rgb(255 255 255 / 70%);
        opacity: 1;
        margin: 0 4px;
        transition: all 0.3s ease;
        border: 1px solid #ffffff33;
    }

    .swiper-pagination .swiper-pagination-bullet-active {
        width: 24px;
        border-radius: 12px;
        background: #0ba9ed;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .banner-slider-container {
            height: 350px;
        }

        .banner-small {
            padding: 20px 15px;
        }
    }

    @media (max-width: 576px) {
        .banner-slider-container {
            height: 320px;
        }

        .banner-small h4 {
            font-size: 16px;
            line-height: 1.3;
        }
    }

    .banner-home9 .banner-big-home9 {
        min-height: 314px;
    }
</style>
