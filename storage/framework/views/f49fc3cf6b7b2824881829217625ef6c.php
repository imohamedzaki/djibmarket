<?php
    // Get ads from database for different slots in ads_space_4
    $teddyBearAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_4_teddy_bear')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $woodenToysAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_4_wooden_toys')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $babyProductsAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_4_baby_products')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();
?>

<div class="bg-home9">
    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 mb-20">
                    <?php if($teddyBearAds->count() > 0): ?>
                        <?php
                            $ad = $teddyBearAds->first();
                            $colors = json_decode($ad->custom_colors, true);
                        ?>
                        <div class="<?php echo e($colors['background_class'] ?? 'block-sale-1'); ?> ads-space-4-item">
                            <div class="row">
                                <div class="col-lg-8 col-sm-8 col-8">
                                    <?php if(!empty($colors['discount_text'])): ?>
                                        <span
                                            class="font-sm <?php echo e($colors['discount_color'] ?? 'color-danger'); ?> text-uppercase"><?php echo e($colors['discount_text']); ?></span>
                                        <?php if(!empty($colors['discount_label'])): ?>
                                            <span
                                                class="font-sm text-uppercase <?php echo e($colors['label_color'] ?? 'color-brand-3'); ?>"><?php echo e($colors['discount_label']); ?></span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <h3 class="mb-10"><?php echo e($ad->headline); ?></h3>
                                    <a class="btn btn-brand-2 btn-arrow-right"
                                        href="<?php echo e($ad->call_to_action_url ?? '#'); ?>"
                                        onclick="trackAdClick(<?php echo e($ad->id); ?>)">
                                        <?php echo e($ad->call_to_action_text); ?>

                                    </a>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-4">
                                    <img src="<?php echo e(asset($ad->ad_image)); ?>" alt="<?php echo e($ad->title); ?>"
                                        onload="trackAdView(<?php echo e($ad->id); ?>)">
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        
                        <div class="empty-ad-space-4 teddy-bear-empty">
                            <div class="empty-ad-content-4">
                                <div class="empty-ad-icon-4">
                                    <img src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="DjibMarket"
                                        class="empty-ad-logo-4">
                                </div>
                                <h4 class="empty-ad-title-4">Ad Space Available</h4>
                                <p class="empty-ad-subtitle-4">Teddy bear advertising space available</p>
                                <small class="empty-ad-note-4">Contact us to advertise here</small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="col-lg-4 mb-20">
                    <?php if($woodenToysAds->count() > 0): ?>
                        <?php
                            $ad = $woodenToysAds->first();
                            $colors = json_decode($ad->custom_colors, true);
                        ?>
                        <div class="<?php echo e($colors['background_class'] ?? 'block-sale-1 bg-4'); ?> ads-space-4-item">
                            <div class="row">
                                <div class="col-lg-8 col-sm-8 col-8">
                                    <?php if(!empty($colors['discount_text'])): ?>
                                        <strong
                                            class="font-sm <?php echo e($colors['discount_color'] ?? 'color-danger font-bold'); ?> text-uppercase"><?php echo e($colors['discount_text']); ?></strong>
                                    <?php endif; ?>
                                    <h3 class="mb-10"><?php echo e($ad->headline); ?></h3>
                                    <a class="btn btn-brand-2 btn-arrow-right"
                                        href="<?php echo e($ad->call_to_action_url ?? '#'); ?>"
                                        onclick="trackAdClick(<?php echo e($ad->id); ?>)">
                                        <?php echo e($ad->call_to_action_text); ?>

                                    </a>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-4">
                                    <img src="<?php echo e(asset($ad->ad_image)); ?>" alt="<?php echo e($ad->title); ?>"
                                        onload="trackAdView(<?php echo e($ad->id); ?>)">
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        
                        <div class="empty-ad-space-4 wooden-toys-empty">
                            <div class="empty-ad-content-4">
                                <div class="empty-ad-icon-4">
                                    <img src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="DjibMarket"
                                        class="empty-ad-logo-4">
                                </div>
                                <h4 class="empty-ad-title-4">Ad Space Available</h4>
                                <p class="empty-ad-subtitle-4">Wooden toys advertising space available</p>
                                <small class="empty-ad-note-4">Contact us to advertise here</small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="col-lg-4 mb-20">
                    <?php if($babyProductsAds->count() > 0): ?>
                        <?php
                            $ad = $babyProductsAds->first();
                            $colors = json_decode($ad->custom_colors, true);
                        ?>
                        <div class="<?php echo e($colors['background_class'] ?? 'block-sale-1 bg-10'); ?> ads-space-4-item">
                            <div class="row">
                                <div class="col-lg-8 col-sm-8 col-8">
                                    <?php if(!empty($colors['discount_text'])): ?>
                                        <strong
                                            class="font-sm <?php echo e($colors['discount_color'] ?? 'color-danger font-bold'); ?> text-uppercase"><?php echo e($colors['discount_text']); ?></strong>
                                    <?php endif; ?>
                                    <h3 class="mb-10"><?php echo e($ad->headline); ?></h3>
                                    <a class="btn btn-brand-2 btn-arrow-right"
                                        href="<?php echo e($ad->call_to_action_url ?? '#'); ?>"
                                        onclick="trackAdClick(<?php echo e($ad->id); ?>)">
                                        <?php echo e($ad->call_to_action_text); ?>

                                    </a>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-4">
                                    <img src="<?php echo e(asset($ad->ad_image)); ?>" alt="<?php echo e($ad->title); ?>"
                                        onload="trackAdView(<?php echo e($ad->id); ?>)">
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        
                        <div class="empty-ad-space-4 baby-products-empty">
                            <div class="empty-ad-content-4">
                                <div class="empty-ad-icon-4">
                                    <img src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="DjibMarket"
                                        class="empty-ad-logo-4">
                                </div>
                                <h4 class="empty-ad-title-4">Ad Space Available</h4>
                                <p class="empty-ad-subtitle-4">Baby products advertising space available</p>
                                <small class="empty-ad-note-4">Contact us to advertise here</small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    function trackAdView(adId) {
        fetch('<?php echo e(route('ad.track.view')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                seller_ad_id: adId
            })
        }).catch(error => console.log('Ad view tracking failed:', error));
    }

    function trackAdClick(adId) {
        fetch('<?php echo e(route('ad.track.click')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({
                seller_ad_id: adId
            })
        }).catch(error => console.log('Ad click tracking failed:', error));
    }
</script>

<style>
    /* Overlay effect on hover for ads_space_4 */
    .ads-space-4-item {
        position: relative;
        overflow: hidden;
        transition: transform 0.5s ease;
    }

    .ads-space-4-item::before {
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

    .ads-space-4-item:hover::before {
        background: rgba(0, 0, 0, 0.4);
    }

    .ads-space-4-item:hover {
        transform: translateY(-3px);
    }

    /* Ensure content stays above overlay */
    .ads-space-4-item>* {
        position: relative;
        z-index: 2;
    }

    /* Improve text contrast on hover */
    .ads-space-4-item:hover span,
    .ads-space-4-item:hover strong,
    .ads-space-4-item:hover h3 {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        transition: color 0.5s ease, text-shadow 0.5s ease;
    }

    /* Empty Ad Space Styles for ads_space_4 */
    .empty-ad-space-4 {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .empty-ad-space-4:hover {
        border-color: #adb5bd;
        background: linear-gradient(135deg, #f1f3f4 0%, #e2e6ea 100%);
    }

    .empty-ad-space-4::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain4" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23000" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23000" opacity="0.02"/><circle cx="50" cy="10" r="1" fill="%23000" opacity="0.02"/><circle cx="10" cy="90" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain4)"/></svg>');
        pointer-events: none;
    }

    .empty-ad-content-4 {
        position: relative;
        z-index: 1;
    }

    .empty-ad-icon-4 {
        margin-bottom: 10px;
    }

    .empty-ad-logo-4 {
        max-width: 50px;
        height: auto;
        opacity: 0.6;
        filter: grayscale(100%);
    }

    .empty-ad-title-4 {
        color: #6c757d;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-subtitle-4 {
        color: #adb5bd;
        font-size: 12px;
        margin-bottom: 5px;
        font-family: 'Arial', sans-serif;
    }

    .empty-ad-note-4 {
        color: #adb5bd;
        font-size: 10px;
        font-style: italic;
        font-family: 'Arial', sans-serif;
    }

    /* Enhanced hover effect for empty ad spaces */
    .empty-ad-space-4:hover::after {
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

    .empty-ad-space-4:hover .empty-ad-content-4 {
        transform: scale(1.02);
        transition: transform 0.5s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .empty-ad-space-4 {
            min-height: 130px;
            padding: 15px;
        }

        .empty-ad-title-4 {
            font-size: 14px;
        }

        .empty-ad-logo-4 {
            max-width: 40px;
        }
    }

    @media (max-width: 576px) {
        .empty-ad-space-4 {
            min-height: 120px;
            padding: 10px;
        }

        .empty-ad-title-4 {
            font-size: 12px;
        }

        .empty-ad-subtitle-4 {
            font-size: 11px;
        }
    }
</style>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/ads/ads_space_4.blade.php ENDPATH**/ ?>