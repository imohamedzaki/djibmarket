@php
    // Get ads from database for ads_space_5
    $kitchenAppliancesAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_5_kitchen_appliances')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();
@endphp

@if ($kitchenAppliancesAds->count() > 0)
    @php
        $ad = $kitchenAppliancesAds->first();
        $colors = json_decode($ad->custom_colors, true);
    @endphp
    <section class="section-box mt-30">
        <div class="container">
            <div class="{{ $colors['background_class'] ?? 'banner-ads' }} text-center ads-space-5-item"
                style="
                    @if (isset($colors['background_color'])) background-color: {{ $colors['background_color'] }}; @endif
                    @if (isset($colors['background_image_main'])) background-image: url('{{ asset($colors['background_image_main']) }}'); background-repeat: no-repeat; background-position: 0px 0px; @endif
                "
                data-bg-before="{{ $colors['background_image_before'] ?? '' }}"
                data-bg-after="{{ $colors['background_image_after'] ?? '' }}">
                <h2
                    class="{{ $colors['title_color'] ?? 'color-brand-2' }} {{ $colors['title_size'] ?? 'font-46' }} mb-5">
                    {{ $ad->headline }}</h2>
                <p class="font-bold font-17 {{ $colors['text_color'] ?? 'color-white' }}">{!! nl2br($ad->sub_headline) !!}</p>
                <div class="mt-20">
                    <a class="btn btn-brand-2 btn-arrow-right" href="{{ $ad->call_to_action_url ?? '#' }}"
                        onclick="trackAdClick({{ $ad->id }})">
                        {{ $ad->call_to_action_text }}
                    </a>
                </div>
                @if ($ad->ad_image)
                    <img src="{{ asset($ad->ad_image) }}" alt="{{ $ad->title }}" style="display: none;"
                        onload="trackAdView({{ $ad->id }})">
                @endif
            </div>
        </div>
    </section>
@else
    {{-- Empty Ad Space for Kitchen Appliances --}}
    <section class="section-box mt-30">
        <div class="container">
            <div class="empty-ad-space-5 kitchen-appliances-empty">
                <div class="empty-ad-content-5">
                    <div class="empty-ad-icon-5">
                        <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                            class="empty-ad-logo-5">
                    </div>
                    <h2 class="empty-ad-title-5">Ad Space Available</h2>
                    <p class="empty-ad-subtitle-5">Category advertising space available for display</p>
                    <small class="empty-ad-note-5">Contact us to advertise here</small>
                </div>
            </div>
        </div>
    </section>
@endif

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

    // Apply dynamic background images
    document.addEventListener('DOMContentLoaded', function() {
        const adItem = document.querySelector('.ads-space-5-item');
        if (adItem) {
            const bgBeforeUrl = adItem.getAttribute('data-bg-before');
            const bgAfterUrl = adItem.getAttribute('data-bg-after');

            const bgImages = [];
            const bgPositions = [];
            const bgSizes = [];
            const bgRepeats = [];

            if (bgBeforeUrl) {
                bgImages.push(`url('{{ asset('') }}${bgBeforeUrl}')`);
                bgPositions.push('left bottom');
                bgSizes.push('auto 55%'); // Adjust size as needed, e.g., auto 50% of height
                bgRepeats.push('no-repeat');
            }

            if (bgAfterUrl) {
                bgImages.push(`url('{{ asset('') }}${bgAfterUrl}')`);
                bgPositions.push('right bottom');
                bgSizes.push('auto 55%'); // Adjust size as needed
                bgRepeats.push('no-repeat');
            }

            if (bgImages.length > 0) {
                const style = document.createElement('style');
                style.textContent = `
                    .ads-space-5-item::before {
                        content: '' !important;
                        position: absolute !important;
                        top: 0 !important;
                        left: 0 !important;
                        width: 100% !important;
                        height: 100% !important;
                        background-image: ${bgImages.join(', ')} !important;
                        background-position: ${bgPositions.join(', ')} !important;
                        background-size: ${bgSizes.join(', ')} !important;
                        background-repeat: ${bgRepeats.join(', ')} !important;
                        z-index: 0 !important;
                        pointer-events: none !important;
                    }
                `;
                document.head.appendChild(style);
            }
        }
    });
</script>

<style>
    /* Overlay effect on hover for ads_space_5 */
    .ads-space-5-item {
        position: relative;
        overflow: hidden;
        transition: transform 0.5s ease;
        border-radius: 12px;
        padding: 60px 20px;
    }

    /* This is now for the background images, managed by JS */
    .ads-space-5-item::before {
        content: none;
    }

    /* This is now for the hover overlay */
    .ads-space-5-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0);
        transition: background-color 0.5s ease;
        pointer-events: none;
        z-index: 1;
        /* Overlay is between background images and content */
        border-radius: 12px;
    }

    .ads-space-5-item:hover::after {
        background-color: rgba(0, 0, 0, 0.4);
    }

    .ads-space-5-item:hover {
        transform: translateY(-3px);
        z-index: 2;
    }

    /* Ensure content stays above overlay */
    .ads-space-5-item>* {
        position: relative;
        z-index: 2;
    }

    /* Improve text contrast on hover */
    .ads-space-5-item:hover h2,
    .ads-space-5-item:hover p {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        transition: color 0.5s ease, text-shadow 0.5s ease;
    }

    /* Empty Ad Space Styles for ads_space_5 */
    .empty-ad-space-5 {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 60px 20px;
        text-align: center;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .empty-ad-space-5:hover {
        border-color: #adb5bd;
        background: linear-gradient(135deg, #f1f3f4 0%, #e2e6ea 100%);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .empty-ad-space-5::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle fill="%23d1d1d1" cx="25" cy="25" r=".5"/><circle fill="%23d1d1d1" cx="75" cy="25" r=".5"/><circle fill="%23d1d1d1" cx="25" cy="75" r=".5"/><circle fill="%23d1d1d1" cx="75" cy="75" r=".5"/></svg>');
        opacity: 0.3;
        pointer-events: none;
    }

    .empty-ad-content-5 {
        position: relative;
        z-index: 1;
        transition: transform 0.5s ease;
    }

    .empty-ad-space-5:hover .empty-ad-content-5 {
        transform: scale(1.03);
    }

    .empty-ad-icon-5 {
        margin-bottom: 20px;
    }

    .empty-ad-logo-5 {
        max-width: 80px;
        height: auto;
        opacity: 0.5;
        filter: grayscale(100%);
    }

    .empty-ad-title-5 {
        color: #495057;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-ad-subtitle-5 {
        color: #6c757d;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .empty-ad-note-5 {
        color: #adb5bd;
        font-size: 12px;
        font-style: italic;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .ads-space-5-item {
            padding: 40px 15px;
        }

        .empty-ad-space-5 {
            padding: 40px 15px;
            min-height: 180px;
        }

        .empty-ad-title-5 {
            font-size: 20px;
        }

        .empty-ad-subtitle-5 {
            font-size: 14px;
        }

        .empty-ad-logo-5 {
            max-width: 60px;
        }
    }

    @media (max-width: 576px) {
        .ads-space-5-item {
            padding: 30px 10px;
        }

        .empty-ad-space-5 {
            padding: 30px 10px;
            min-height: 160px;
        }

        .empty-ad-title-5 {
            font-size: 18px;
        }

        .empty-ad-subtitle-5 {
            font-size: 13px;
        }

        .ads-space-5-item h2 {
            font-size: 28px !important;
        }

        .ads-space-5-item p {
            font-size: 14px !important;
        }
    }
</style>
