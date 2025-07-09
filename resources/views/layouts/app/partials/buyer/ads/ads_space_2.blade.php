@php
    // Get ads from database for different slots in ads_space_2
    $powerBankAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_2_power_bank')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $gameControllerAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_2_game_controller')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $iphoneAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_2_iphone')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

<div class="bg-home9">
    <section class="section-box pt-50">
        <div class="container">
            <div class="row ads-space-2-container">
                {{-- Power Bank Section --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    @if ($powerBankAds->count() > 0)
                        @php
                            $ad = $powerBankAds->first();
                            $colors = json_decode($ad->custom_colors, true);
                        @endphp
                        <div class="{{ $colors['background_class'] ?? 'bg-4' }} block-charge ads-space-2-item">
                            <span class="color-brand-3 font-sm-lh32">{{ $colors['label_text'] ?? 'Power Bank' }}</span>
                            <h3 class="font-xl mb-10">{{ $ad->headline }}</h3>
                            <p class="font-base color-brand-3 mb-20">{!! nl2br($ad->sub_headline) !!}</p>
                            <a class="btn btn-brand-2 btn-arrow-right" href="{{ $ad->call_to_action_url ?? '#' }}"
                                onclick="trackAdClick({{ $ad->id }})">
                                {{ $ad->call_to_action_text }}
                            </a>
                            <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}" style="display: none;"
                                onload="trackAdView({{ $ad->id }})">
                        </div>
                    @else
                        {{-- Empty Ad Space for Power Bank --}}
                        <div class="empty-ad-space-2 power-bank-empty">
                            <div class="empty-ad-content-2">
                                <div class="empty-ad-icon-2">
                                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                        class="empty-ad-logo-2">
                                </div>
                                <h4 class="empty-ad-title-2">Ad Space Available</h4>
                                <p class="empty-ad-subtitle-2">Power Bank advertising space available</p>
                                <small class="empty-ad-note-2">Contact us to advertise here</small>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Game Controller Section --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    @if ($gameControllerAds->count() > 0)
                        @php
                            $ad = $gameControllerAds->first();
                            $colors = json_decode($ad->custom_colors, true);
                        @endphp
                        <div class="{{ $colors['background_class'] ?? 'bg-6' }} block-player ads-space-2-item">
                            <h3 class="font-33 mb-20">{{ $ad->headline }}</h3>
                            <div class="mb-30"><strong class="font-16">{{ $ad->sub_headline }}</strong></div>
                            <a class="btn btn-brand-3 btn-arrow-right" href="{{ $ad->call_to_action_url ?? '#' }}"
                                onclick="trackAdClick({{ $ad->id }})">
                                {{ $ad->call_to_action_text }}
                            </a>
                            <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}" style="display: none;"
                                onload="trackAdView({{ $ad->id }})">
                        </div>
                    @else
                        {{-- Empty Ad Space for Game Controller --}}
                        <div class="empty-ad-space-2 game-controller-empty">
                            <div class="empty-ad-content-2">
                                <div class="empty-ad-icon-2">
                                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                        class="empty-ad-logo-2">
                                </div>
                                <h4 class="empty-ad-title-2">Ad Space Available</h4>
                                <p class="empty-ad-subtitle-2">Gaming controller advertising space available</p>
                                <small class="empty-ad-note-2">Contact us to advertise here</small>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- iPhone Section --}}
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    @if ($iphoneAds->count() > 0)
                        @php
                            $ad = $iphoneAds->first();
                            $colors = json_decode($ad->custom_colors, true);
                        @endphp
                        <div class="{{ $colors['background_class'] ?? 'bg-5' }} block-iphone ads-space-2-item">
                            <span
                                class="color-brand-3 font-sm-lh32">{{ $colors['label_text'] ?? 'Starting from $899' }}</span>
                            <h3 class="font-xl mb-10">{{ $ad->headline }}</h3>
                            <p class="font-base color-brand-3 mb-10">{{ $ad->sub_headline }}</p>
                            <a class="btn btn-arrow" href="{{ $ad->call_to_action_url ?? '#' }}"
                                onclick="trackAdClick({{ $ad->id }})">
                                {{ $ad->call_to_action_text }}
                            </a>
                            <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}" style="display: none;"
                                onload="trackAdView({{ $ad->id }})">
                        </div>
                    @else
                        {{-- Empty Ad Space for iPhone --}}
                        <div class="empty-ad-space-2 iphone-empty">
                            <div class="empty-ad-content-2">
                                <div class="empty-ad-icon-2">
                                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                        class="empty-ad-logo-2">
                                </div>
                                <h4 class="empty-ad-title-2">Ad Space Available</h4>
                                <p class="empty-ad-subtitle-2">Mobile device advertising space available</p>
                                <small class="empty-ad-note-2">Contact us to advertise here</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

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
    /* Ads Space 2 Container - Equal Heights */
    .ads-space-2-container {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }

    .ads-space-2-container>[class*="col-"] {
        display: flex;
        flex-direction: column;
    }

    /* Equal sizing for all ad items */
    .ads-space-2-item {
        height: 280px !important;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 25px 20px;
        border-radius: 12px;
        position: relative;
        transition: transform 0.5s ease;
        overflow: hidden;
    }

    .ads-space-2-item:hover {
        transform: translateY(-3px);
    }

    /* Overlay effect on hover for better text readability */
    .ads-space-2-item::before {
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

    .ads-space-2-item:hover::before {
        background: rgba(0, 0, 0, 0.4);
    }

    /* Ensure content stays above overlay */
    .ads-space-2-item>* {
        position: relative;
        z-index: 2;
    }

    /* Improve text contrast on hover */
    .ads-space-2-item:hover span,
    .ads-space-2-item:hover h3,
    .ads-space-2-item:hover p,
    .ads-space-2-item:hover strong,
    .ads-space-2-item:hover div {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        transition: color 0.5s ease, text-shadow 0.5s ease;
    }



    /* Specific styling for each block type to ensure equal heights */
    .block-charge.ads-space-2-item,
    .block-player.ads-space-2-item,
    .block-iphone.ads-space-2-item {
        min-height: 280px;
        max-height: 280px;
    }

    /* Empty Ad Space Styles for ads_space_2 - Equal Heights */
    .empty-ad-space-2 {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        height: 280px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .empty-ad-space-2:hover {
        transform: translateY(-3px);
    }

    .empty-ad-space-2::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain2" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23000" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23000" opacity="0.02"/><circle cx="50" cy="10" r="1" fill="%23000" opacity="0.02"/><circle cx="10" cy="90" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain2)"/></svg>');
        pointer-events: none;
    }

    .empty-ad-content-2 {
        position: relative;
        z-index: 1;
    }

    .empty-ad-icon-2 {
        margin-bottom: 15px;
    }

    .empty-ad-logo-2 {
        max-width: 60px;
        height: auto;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    .empty-ad-title-2 {
        color: #6c757d;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-subtitle-2 {
        color: #adb5bd;
        font-size: 13px;
        margin-bottom: 8px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-note-2 {
        color: #adb5bd;
        font-size: 11px;
        font-style: italic;
        font-family: 'Arial', sans-serif;
    }

    /* Text sizing adjustments for equal height blocks */
    .ads-space-2-item h3 {
        font-size: 1.3rem;
        line-height: 1.4;
        margin-bottom: 15px;
    }

    .ads-space-2-item .font-33 {
        font-size: 1.4rem !important;
        line-height: 1.3;
    }

    .ads-space-2-item p,
    .ads-space-2-item .font-base {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    /* Button positioning */
    .ads-space-2-item .btn {
        margin-top: auto;
        align-self: flex-start;
    }

    /* Responsive adjustments */
    @media (max-width: 1199px) {
        .ads-space-2-item {
            height: 260px !important;
        }

        .empty-ad-space-2 {
            height: 260px !important;
        }
    }

    @media (max-width: 991px) {
        .ads-space-2-item {
            height: 240px !important;
        }

        .empty-ad-space-2 {
            height: 240px !important;
        }

        .ads-space-2-item h3,
        .ads-space-2-item .font-33 {
            font-size: 1.2rem !important;
        }
    }

    @media (max-width: 767px) {
        .ads-space-2-container {
            display: block;
        }

        .ads-space-2-item {
            height: 220px !important;
            margin-bottom: 20px;
        }

        .empty-ad-space-2 {
            height: 220px !important;
            margin-bottom: 20px;
        }

        .empty-ad-title-2 {
            font-size: 16px;
        }

        .empty-ad-logo-2 {
            max-width: 50px;
        }
    }

    @media (max-width: 575px) {
        .ads-space-2-item {
            height: 200px !important;
            padding: 20px 15px;
        }

        .empty-ad-space-2 {
            height: 200px !important;
            padding: 15px;
        }

        .empty-ad-title-2 {
            font-size: 14px;
        }

        .empty-ad-subtitle-2 {
            font-size: 12px;
        }

        .ads-space-2-item h3,
        .ads-space-2-item .font-33 {
            font-size: 1.1rem !important;
            margin-bottom: 10px;
        }

        .ads-space-2-item p,
        .ads-space-2-item .font-base {
            font-size: 0.85rem;
        }
    }

    /* Enhanced hover effect for empty ad spaces */
    .empty-ad-space-2:hover::after {
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

    .empty-ad-space-2:hover .empty-ad-content-2 {
        transform: scale(1.02);
        transition: transform 0.5s ease;
    }
</style>
