<div class="bg-home9">
    <div class="section-box">
        <div class="container">
            <div class="list-brands list-none-border">
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-10">
                        <div class="swiper-wrapper">
                            @php
                                $activeAdsCompanies = \App\Models\AdsCompany::activeAndCurrent()->with('seller')->get();
                            @endphp
                            @if ($activeAdsCompanies->count() > 0)
                                @foreach ($activeAdsCompanies as $adsCompany)
                                    <div class="swiper-slide">
                                        <a href="{{ $adsCompany->link ?: '#' }}"
                                            {{ $adsCompany->link ? 'target="_blank"' : '' }}>
                                            @if ($adsCompany->logo)
                                                <img src="{{ asset('storage/' . $adsCompany->logo) }}"
                                                    alt="{{ $adsCompany->name }}">
                                            @else
                                                <div class="placeholder-logo"
                                                    style="width: 120px; height: 60px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border: 1px solid #e9ecef; border-radius: 4px;">
                                                    <span
                                                        style="font-size: 12px; color: #6c757d;">{{ $adsCompany->name }}</span>
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div style="width:100%;" class="no-products-container text-center py-5">
                                    <div class="mb-3">
                                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="mx-auto" style="color: #ccc;">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                                stroke="currentColor" stroke-width="1.5" fill="none" />
                                            <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="1.5"
                                                fill="none" />
                                            <line x1="9" y1="13" x2="15" y2="13"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <line x1="9" y1="17" x2="13" y2="17"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                    </div>
                                    <h4 class="text-muted mb-2">No Ads Companies</h4>
                                    <p class="text-muted mb-0">No ads companies available at the moment.</p>
                                </div>
                                <!-- No ads companies message with full width -->
                        </div> <!-- Close swiper-wrapper -->
                        <div class="swiper-wrapper"> <!-- Reopen swiper-wrapper for proper structure -->
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
