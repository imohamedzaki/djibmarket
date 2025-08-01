@php
    // Get ads from database for ads_space_7
    $leftAd = \App\Models\SellerAd::where('ad_slot', 'ads_space_7_left')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->inRandomOrder()
        ->first();

    $rightAd = \App\Models\SellerAd::where('ad_slot', 'ads_space_7_right')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->inRandomOrder()
        ->first();
@endphp

<section class="section-box mt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-20">
                @if ($leftAd)
                    @php($leftAdColors = json_decode($leftAd->custom_colors, true))
                    <div class="{{ $leftAdColors['background_class'] ?? 'block-sale-3' }} ads-space-7-item">
                        <div class="row height-100">
                            <div class="col-lg-5 col-md-6 col-sm-6 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale">
                                    <span class="font-sm color-brand-3">{{ $leftAdColors['label_text'] ?? '' }}</span>
                                    <h4 class="mt-5 mb-5">{{ $leftAd->headline }}</h4>
                                    <p class="color-brand-3 font-sm mb-5">{!! nl2br($leftAd->sub_headline) !!}</p>
                                    <a class="btn btn-arrow" href="{{ $leftAd->call_to_action_url ?? '#' }}"
                                        onclick="trackAdClick({{ $leftAd->id }})">{{ $leftAd->call_to_action_text }}</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-sm-6 col-12 height-100 align-items-end d-flex">
                                <img src="{{ asset($leftAd->ad_image) }}" alt="{{ $leftAd->title }}"
                                    onload="trackAdView({{ $leftAd->id }})">
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Empty Ad Space for Left Ad --}}
                    <div class="empty-ad-space-7 left-empty">
                        <div class="empty-ad-content-7">
                            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket">
                            <h2>Ad Space</h2>
                            <p>Contact us to advertise here</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 mb-20">
                @if ($rightAd)
                    @php($rightAdColors = json_decode($rightAd->custom_colors, true))
                    <div class="{{ $rightAdColors['background_class'] ?? 'block-sale-3' }} ads-space-7-item">
                        <div class="row height-100">
                            <div class="col-lg-5 col-md-6 col-sm-6 col-12 height-100 align-items-center d-flex">
                                <div class="box-sale">
                                    <span class="font-sm color-brand-3">{{ $rightAdColors['label_text'] ?? '' }}</span>
                                    <h4 class="mt-5 mb-10">{{ $rightAd->headline }}</h4>
                                    <p class="color-brand-3 font-sm mb-5">{!! nl2br($rightAd->sub_headline) !!}</p>
                                    <a class="btn btn-arrow" href="{{ $rightAd->call_to_action_url ?? '#' }}"
                                        onclick="trackAdClick({{ $rightAd->id }})">{{ $rightAd->call_to_action_text }}</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-sm-6 col-12 height-100 align-items-end d-flex">
                                <img src="{{ asset($rightAd->ad_image) }}" alt="{{ $rightAd->title }}"
                                    onload="trackAdView({{ $rightAd->id }})">
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Empty Ad Space for Right Ad --}}
                    <div class="empty-ad-space-7 right-empty">
                        <div class="empty-ad-content-7">
                            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket">
                            <h2>Ad Space</h2>
                            <p>Contact us to advertise here</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- JavaScript and CSS --}}
<script>
    if (typeof trackAdView !== 'function') {
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
            }).catch(err => console.error(err));
        }
    }
    if (typeof trackAdClick !== 'function') {
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
            }).catch(err => console.error(err));
        }
    }
</script>

<style>
    .ads-space-7-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
    }

    .ads-space-7-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .empty-ad-space-7 {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        width: 100%;
        height: 100%;
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        transition: all 0.3s ease;
    }

    .empty-ad-space-7:hover {
        border-color: #adb5bd;
    }

    .empty-ad-content-7 img {
        max-width: 60px;
        opacity: 0.5;
        margin-bottom: 15px;
        filter: grayscale(100%);
    }

    .empty-ad-content-7 h2 {
        font-size: 20px;
        color: #495057;
        font-weight: 600;
    }

    .empty-ad-content-7 p {
        font-size: 14px;
        color: #6c757d;
    }
</style>
