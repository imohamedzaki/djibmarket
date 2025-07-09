@php
    // Get ads from database for different slots in ads_space_3
    $latestBooksAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_3_latest_books')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $bestCollectionAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_3_best_collection')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $professionalBooksAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_3_professional_books')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

<section class="section-box">
    <div class="container">
        <div class="row">
            {{-- Latest Books Section --}}
            <div class="col-lg-4 mb-20">
                @if ($latestBooksAds->count() > 0)
                    @php
                        $ad = $latestBooksAds->first();
                        $colors = json_decode($ad->custom_colors, true);
                    @endphp
                    <div class="block-sale-2 {{ $colors['background_class'] ?? 'circle-1' }} ads-space-3-item"
                        style="@if (isset($colors['background_color'])) background-color: {{ $colors['background_color'] }}; @endif @if (isset($colors['background_image'])) background-image: url({{ asset($colors['background_image']) }}); background-repeat: no-repeat; background-position: bottom right; @endif">
                        <div class="row height-100">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale">
                                    <span
                                        class="font-sm color-brand-3">{{ $colors['label_text'] ?? 'Latest Books' }}</span>
                                    <h4 class="mt-5 mb-10">{{ $ad->headline }}</h4>
                                    <p class="color-brand-3 font-sm mb-5">{!! nl2br($ad->sub_headline) !!}</p>
                                    <a class="btn btn-arrow" href="{{ $ad->call_to_action_url ?? '#' }}"
                                        onclick="trackAdClick({{ $ad->id }})">
                                        {{ $ad->call_to_action_text }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-12 height-100 align-items-end d-flex">
                                <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}"
                                    onload="trackAdView({{ $ad->id }})">
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Empty Ad Space for Latest Books --}}
                    <div class="empty-ad-space-3 latest-books-empty">
                        <div class="empty-ad-content-3">
                            <div class="empty-ad-icon-3">
                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                    class="empty-ad-logo-3">
                            </div>
                            <h4 class="empty-ad-title-3">Ad Space Available</h4>
                            <p class="empty-ad-subtitle-3">Latest books advertising space available</p>
                            <small class="empty-ad-note-3">Contact us to advertise here</small>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Best Collection Section --}}
            <div class="col-lg-4 mb-20">
                @if ($bestCollectionAds->count() > 0)
                    @php
                        $ad = $bestCollectionAds->first();
                        $colors = json_decode($ad->custom_colors, true);
                    @endphp
                    <div class="block-sale-2 {{ $colors['background_class'] ?? 'bg-4 circle-2' }} ads-space-3-item"
                        style="@if (isset($colors['background_color'])) background-color: {{ $colors['background_color'] }}; @endif @if (isset($colors['background_image'])) background-image: url({{ asset($colors['background_image']) }}); background-repeat: no-repeat; background-position: bottom right; @endif">
                        <div class="row height-100">
                            <div class="col-lg-6 col-md-7 col-sm-7 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale">
                                    <span
                                        class="font-sm color-brand-3">{{ $colors['label_text'] ?? 'Best collection' }}</span>
                                    <h4 class="mt-5 mb-10">{{ $ad->headline }}</h4>
                                    <p class="color-brand-3 font-sm mb-5">{{ $ad->sub_headline }}</p>
                                    <a class="btn btn-arrow" href="{{ $ad->call_to_action_url ?? '#' }}"
                                        onclick="trackAdClick({{ $ad->id }})">
                                        {{ $ad->call_to_action_text }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5 col-sm-5 col-12 height-100 align-items-end d-flex">
                                <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}"
                                    onload="trackAdView({{ $ad->id }})">
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Empty Ad Space for Best Collection --}}
                    <div class="empty-ad-space-3 best-collection-empty">
                        <div class="empty-ad-content-3">
                            <div class="empty-ad-icon-3">
                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                    class="empty-ad-logo-3">
                            </div>
                            <h4 class="empty-ad-title-3">Ad Space Available</h4>
                            <p class="empty-ad-subtitle-3">Best collection advertising space available</p>
                            <small class="empty-ad-note-3">Contact us to advertise here</small>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Professional Books Section --}}
            <div class="col-lg-4 mb-20">
                @if ($professionalBooksAds->count() > 0)
                    @php
                        $ad = $professionalBooksAds->first();
                        $colors = json_decode($ad->custom_colors, true);
                    @endphp
                    <div class="block-sale-2 {{ $colors['background_class'] ?? 'bg-10 circle-3' }} ads-space-3-item"
                        style="@if (isset($colors['background_color'])) background-color: {{ $colors['background_color'] }}; @endif @if (isset($colors['background_image'])) background-image: url({{ asset($colors['background_image']) }}); background-repeat: no-repeat; background-position: bottom right; @endif">
                        <div class="row height-100">
                            <div class="col-lg-6 col-md-7 col-sm-7 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale">
                                    <span
                                        class="font-sm color-brand-3">{{ $colors['label_text'] ?? 'Off the month' }}</span>
                                    <h4 class="mt-5 mb-10">{{ $ad->headline }}</h4>
                                    <p class="color-brand-3 font-sm mb-5">{{ $ad->sub_headline }}</p>
                                    <a class="btn btn-arrow" href="{{ $ad->call_to_action_url ?? '#' }}"
                                        onclick="trackAdClick({{ $ad->id }})">
                                        {{ $ad->call_to_action_text }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5 col-sm-5 col-12 height-100 align-items-end d-flex">
                                <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}"
                                    onload="trackAdView({{ $ad->id }})">
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Empty Ad Space for Professional Books --}}
                    <div class="empty-ad-space-3 professional-books-empty">
                        <div class="empty-ad-content-3">
                            <div class="empty-ad-icon-3">
                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                                    class="empty-ad-logo-3">
                            </div>
                            <h4 class="empty-ad-title-3">Ad Space Available</h4>
                            <p class="empty-ad-subtitle-3">Professional books advertising space available</p>
                            <small class="empty-ad-note-3">Contact us to advertise here</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

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
    /* Overlay effect on hover for better text readability */
    .block-sale-2.ads-space-3-item {
        position: relative;
        overflow: hidden;
        transition: transform 0.5s ease;
    }

    .block-sale-2.ads-space-3-item::before {
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

    .block-sale-2.ads-space-3-item:hover::before {
        background: rgba(0, 0, 0, 0.4);
    }

    .block-sale-2.ads-space-3-item:hover {
        transform: translateY(-3px);
    }

    /* Ensure content stays above overlay */
    .block-sale-2.ads-space-3-item>* {
        position: relative;
        z-index: 2;
    }

    /* Improve text contrast on hover */
    .block-sale-2.ads-space-3-item:hover span,
    .block-sale-2.ads-space-3-item:hover h4,
    .block-sale-2.ads-space-3-item:hover p {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        transition: color 0.5s ease, text-shadow 0.5s ease;
    }

    /* Empty Ad Space Styles for ads_space_3 */
    .empty-ad-space-3 {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .empty-ad-space-3:hover {
        border-color: #adb5bd;
        background: linear-gradient(135deg, #f1f3f4 0%, #e2e6ea 100%);
    }

    .empty-ad-space-3::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain3" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23000" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23000" opacity="0.02"/><circle cx="50" cy="10" r="1" fill="%23000" opacity="0.02"/><circle cx="10" cy="90" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain3)"/></svg>');
        pointer-events: none;
    }

    .empty-ad-content-3 {
        position: relative;
        z-index: 1;
    }

    .empty-ad-icon-3 {
        margin-bottom: 15px;
    }

    .empty-ad-logo-3 {
        max-width: 60px;
        height: auto;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    .empty-ad-title-3 {
        color: #6c757d;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-subtitle-3 {
        color: #adb5bd;
        font-size: 13px;
        margin-bottom: 8px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-note-3 {
        color: #adb5bd;
        font-size: 11px;
        font-style: italic;
        font-family: 'Arial', sans-serif;
    }

    /* Enhanced hover effect for empty ad spaces */
    .empty-ad-space-3:hover::after {
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

    .empty-ad-space-3:hover .empty-ad-content-3 {
        transform: scale(1.02);
        transition: transform 0.5s ease;
    }

    /* Responsive adjustments for empty ad spaces */
    @media (max-width: 768px) {
        .empty-ad-space-3 {
            min-height: 180px;
            padding: 25px 15px;
        }

        .empty-ad-title-3 {
            font-size: 16px;
        }

        .empty-ad-logo-3 {
            max-width: 50px;
        }
    }

    @media (max-width: 576px) {
        .empty-ad-space-3 {
            min-height: 160px;
            padding: 20px 10px;
        }

        .empty-ad-title-3 {
            font-size: 14px;
        }

        .empty-ad-subtitle-3 {
            font-size: 12px;
        }
    }
</style>
