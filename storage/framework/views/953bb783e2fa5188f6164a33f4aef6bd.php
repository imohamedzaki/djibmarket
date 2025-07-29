<?php
    // Get ads from database for ads_space_6
    $chairsAds = \App\Models\SellerAd::where('ad_slot', 'ads_space_6_chairs')
        ->where('status', 'active')
        ->where('start_date', '<=', now())
        ->where(function ($query) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', now());
        })
        ->orderBy('created_at', 'desc')
        ->get();
?>

<div class="bg-home9 pb-60">
    <section class="section-box mt-40">
        <div class="container">
            <?php if($chairsAds->count() > 0): ?>
                <?php
                    $ad = $chairsAds->first();
                    $colors = json_decode($ad->custom_colors, true);
                ?>
                <div class="<?php echo e($colors['background_class'] ?? 'banner-ads-3'); ?> ads-space-6-item"
                    style="
                        <?php if(isset($colors['background_color'])): ?> background-color: <?php echo e($colors['background_color']); ?>; <?php endif; ?>
                        <?php if($ad->ad_image): ?> background-image: url('<?php echo e(asset($ad->ad_image)); ?>');
                            <?php if(isset($colors['background_repeat'])): ?> background-repeat: <?php echo e($colors['background_repeat']); ?>; <?php endif; ?>
                            <?php if(isset($colors['background_position'])): ?> background-position: <?php echo e($colors['background_position']); ?>; <?php endif; ?>
                            <?php if(isset($colors['background_size'])): ?> background-size: <?php echo e($colors['background_size']); ?>; <?php endif; ?>
                        <?php endif; ?>
                    ">
                    <h5 class="mb-5 <?php echo e($colors['title_color'] ?? 'color-gray-900'); ?>"><?php echo e($ad->headline); ?></h5>
                    <p class="font-base <?php echo e($colors['text_color'] ?? 'color-gray-900'); ?> mb-10"><?php echo nl2br($ad->sub_headline); ?>

                    </p>
                    <a class="btn <?php echo e($colors['button_class'] ?? 'btn-brand-3'); ?>"
                        href="<?php echo e($ad->call_to_action_url ?? '#'); ?>" onclick="trackAdClick(<?php echo e($ad->id); ?>)">
                        <?php echo e($ad->call_to_action_text); ?>

                    </a>
                    <img src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="<?php echo e($ad->title); ?>"
                        style="display: none;" onload="trackAdView(<?php echo e($ad->id); ?>)">
                </div>
            <?php else: ?>
                
                <div class="empty-ad-space-6 chairs-empty">
                    <div class="empty-ad-content-6">
                        <div class="empty-ad-icon-6">
                            <img src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="DjibMarket"
                                class="empty-ad-logo-6">
                        </div>
                        <h2 class="empty-ad-title-6">Ad Space Available</h2>
                        <p class="empty-ad-subtitle-6">Advertising space available for display</p>
                        <small class="empty-ad-note-6">Contact us to advertise here</small>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>


<script>
    if (typeof trackAdView !== 'function') {
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
    }
    if (typeof trackAdClick !== 'function') {
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
    }
</script>

<style>
    /* Hover effect for ads_space_6 */
    .ads-space-6-item {
        position: relative;
        overflow: hidden;
        transition: transform 0.5s ease, box-shadow 0.5s ease;
        border-radius: 12px;
        padding: 20px;
    }

    .ads-space-6-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Empty Ad Space Styles for ads_space_6 */
    .empty-ad-space-6 {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        min-height: 150px;
        /* Adjusted height for this section */
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .empty-ad-space-6:hover {
        border-color: #adb5bd;
        background: linear-gradient(135deg, #f1f3f4 0%, #e2e6ea 100%);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .empty-ad-space-6::before {
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

    .empty-ad-content-6 {
        position: relative;
        z-index: 1;
        transition: transform 0.5s ease;
    }

    .empty-ad-space-6:hover .empty-ad-content-6 {
        transform: scale(1.03);
    }

    .empty-ad-logo-6 {
        max-width: 60px;
        opacity: 0.5;
        margin-bottom: 15px;
        filter: grayscale(100%);
    }

    .empty-ad-title-6 {
        font-size: 20px;
        color: #495057;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-ad-subtitle-6 {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .empty-ad-note-6 {
        font-size: 12px;
        color: #adb5bd;
        font-style: italic;
    }
</style>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/ads/ads_space_6.blade.php ENDPATH**/ ?>