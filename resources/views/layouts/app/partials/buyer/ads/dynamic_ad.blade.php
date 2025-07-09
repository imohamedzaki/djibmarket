@php
    $ad = $activeAds[$slot] ?? null;
@endphp

@if ($ad)
    {{-- Dynamic seller ad --}}
    <div class="seller-ad-container" data-ad-id="{{ $ad->id }}" data-slot="{{ $slot }}"
        style="@if ($ad->custom_colors) background-color: {{ $ad->custom_colors['background'] ?? '#ffffff' }}; @endif">

        @if ($layout === 'banner')
            {{-- Banner style layout --}}
            <div class="seller-ad-banner"
                style="@if ($ad->custom_colors) color: {{ $ad->custom_colors['text'] ?? '#000000' }}; @endif">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        @if ($ad->headline)
                            <h2 class="ad-headline"
                                style="@if ($ad->custom_colors) color: {{ $ad->custom_colors['heading'] ?? '#333333' }}; @endif">
                                {{ $ad->headline }}
                            </h2>
                        @endif

                        @if ($ad->sub_headline)
                            <p class="ad-subheadline">{{ $ad->sub_headline }}</p>
                        @endif

                        @if ($ad->description)
                            <p class="ad-description">{{ $ad->description }}</p>
                        @endif

                        @if ($ad->call_to_action_url)
                            <a href="{{ $ad->call_to_action_url }}" class="btn ad-cta-btn"
                                style="@if ($ad->custom_colors) background-color: {{ $ad->custom_colors['button_bg'] ?? '#007bff' }}; color: {{ $ad->custom_colors['button_text'] ?? '#ffffff' }}; border-color: {{ $ad->custom_colors['button_bg'] ?? '#007bff' }}; @endif"
                                onclick="trackAdClick({{ $ad->id }})" target="_blank">
                                {{ $ad->call_to_action_text }}
                            </a>
                        @endif
                    </div>

                    @if ($ad->ad_image)
                        <div class="col-md-4">
                            <img src="{{ $ad->ad_image_url }}" alt="{{ $ad->title }}" class="ad-image img-fluid">
                        </div>
                    @endif
                </div>
            </div>
        @elseif($layout === 'card')
            {{-- Card style layout --}}
            <div class="seller-ad-card h-100"
                style="@if ($ad->custom_colors) color: {{ $ad->custom_colors['text'] ?? '#000000' }}; @endif">
                @if ($ad->ad_image)
                    <div class="ad-image-container">
                        <img src="{{ $ad->ad_image_url }}" alt="{{ $ad->title }}" class="ad-image">
                    </div>
                @endif

                <div class="ad-content p-3">
                    @if ($ad->headline)
                        <h4 class="ad-headline"
                            style="@if ($ad->custom_colors) color: {{ $ad->custom_colors['heading'] ?? '#333333' }}; @endif">
                            {{ $ad->headline }}
                        </h4>
                    @endif

                    @if ($ad->sub_headline)
                        <p class="ad-subheadline">{{ $ad->sub_headline }}</p>
                    @endif

                    @if ($ad->description)
                        <p class="ad-description">{{ Str::limit($ad->description, 100) }}</p>
                    @endif

                    @if ($ad->call_to_action_url)
                        <a href="{{ $ad->call_to_action_url }}" class="btn ad-cta-btn"
                            style="@if ($ad->custom_colors) background-color: {{ $ad->custom_colors['button_bg'] ?? '#007bff' }}; color: {{ $ad->custom_colors['button_text'] ?? '#ffffff' }}; border-color: {{ $ad->custom_colors['button_bg'] ?? '#007bff' }}; @endif"
                            onclick="trackAdClick({{ $ad->id }})" target="_blank">
                            {{ $ad->call_to_action_text }}
                        </a>
                    @endif
                </div>
            </div>
        @elseif($layout === 'compact')
            {{-- Compact horizontal layout --}}
            <div class="seller-ad-compact d-flex align-items-center"
                style="@if ($ad->custom_colors) color: {{ $ad->custom_colors['text'] ?? '#000000' }}; @endif">
                @if ($ad->ad_image)
                    <div class="ad-image-small me-3">
                        <img src="{{ $ad->ad_image_url }}" alt="{{ $ad->title }}" class="ad-image"
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                    </div>
                @endif

                <div class="ad-content flex-grow-1">
                    @if ($ad->headline)
                        <h5 class="ad-headline mb-1"
                            style="@if ($ad->custom_colors) color: {{ $ad->custom_colors['heading'] ?? '#333333' }}; @endif">
                            {{ $ad->headline }}
                        </h5>
                    @endif

                    @if ($ad->sub_headline)
                        <p class="ad-subheadline mb-2 small">{{ $ad->sub_headline }}</p>
                    @endif
                </div>

                @if ($ad->call_to_action_url)
                    <div class="ad-cta ms-3">
                        <a href="{{ $ad->call_to_action_url }}" class="btn btn-sm ad-cta-btn"
                            style="@if ($ad->custom_colors) background-color: {{ $ad->custom_colors['button_bg'] ?? '#007bff' }}; color: {{ $ad->custom_colors['button_text'] ?? '#ffffff' }}; border-color: {{ $ad->custom_colors['button_bg'] ?? '#007bff' }}; @endif"
                            onclick="trackAdClick({{ $ad->id }})" target="_blank">
                            {{ $ad->call_to_action_text }}
                        </a>
                    </div>
                @endif
            </div>
        @endif

        {{-- Ad attribution --}}
        <div class="ad-attribution">
            <small class="text-muted">
                Sponsored by {{ $ad->seller->name }}
            </small>
        </div>
    </div>
@else
    {{-- Fallback to original static content --}}
    {{ $slot }}
@endif

@push('scripts')
    <script>
        function trackAdClick(adId) {
            fetch(`/ad-click/${adId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).catch(error => {
                console.log('Ad click tracking error:', error);
            });
        }
    </script>
@endpush

<style>
    .seller-ad-container {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: box-shadow 0.3s ease;
    }

    .seller-ad-container:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .seller-ad-banner {
        padding: 20px;
    }

    .ad-headline {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .ad-subheadline {
        font-weight: 500;
        opacity: 0.8;
        margin-bottom: 10px;
    }

    .ad-description {
        opacity: 0.7;
        margin-bottom: 15px;
    }

    .ad-cta-btn {
        border-radius: 6px;
        padding: 8px 20px;
        font-weight: 500;
        text-decoration: none;
        border: 1px solid;
        transition: all 0.3s ease;
    }

    .ad-cta-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .ad-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .seller-ad-card {
        border-radius: 8px;
        overflow: hidden;
        height: 100%;
    }

    .seller-ad-card .ad-image-container {
        height: 200px;
        overflow: hidden;
    }

    .seller-ad-card .ad-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .seller-ad-compact {
        padding: 15px;
        border-radius: 8px;
    }

    .ad-attribution {
        background: rgba(0, 0, 0, 0.05);
        padding: 5px 15px;
        text-align: center;
    }
</style>
