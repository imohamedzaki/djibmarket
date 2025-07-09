<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
    <div class="box-slider-product">
        <div class="head-slider">
            <div class="row">
                <div class="col-lg-7">
                    <h5>Upcoming Deals</h5>
                </div>
                <div class="col-lg-5">
                    <div class="box-button-slider-2">
                        <div class="swiper-button-prev swiper-button-prev-style-top swiper-button-prev-upcomingdeals">
                        </div>
                        <div class="swiper-button-next swiper-button-next-style-top swiper-button-next-upcomingdeals">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-products">
            <?php if($upcomingDealsProducts->count() > 0): ?>
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3-upcomingdeals">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $upcomingDealsProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <div class="card-product-small">
                                        <div class="card-image" style="position: relative;">
                                            <div class="upcoming-badge"
                                                style="position: absolute; top: 10px; left: 10px; background: #007bff; color: white; padding: 5px 8px; border-radius: 15px; font-size: 12px; font-weight: bold; z-index: 2;">
                                                COMING SOON
                                            </div>
                                            <a href="#"
                                                style="display: block; width: 100%; height: 200px; overflow: hidden;">
                                                <img src="<?php echo e($product->featured_image_url ?? asset('assets/imgs/page/homepage9/sp16.png')); ?>"
                                                    alt="<?php echo e($product->title); ?>"
                                                    style="width: 100%; height: 100%; object-fit: contain; object-position: center;">
                                            </a>
                                        </div>
                                        <div class="card-info">
                                            <h6 class="product-title"
                                                style="font-size: 14px; margin-bottom: 8px; height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                <?php echo e($product->title); ?>

                                            </h6>
                                            <div class="rating">
                                                <?php
                                                    $averageRating = $product->reviews->avg('rating') ?? 0;
                                                    $reviewCount = $product->reviews->count();
                                                ?>
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <img src="<?php echo e(asset('assets/imgs/template/icons/star.svg')); ?>"
                                                        alt="Star"
                                                        style="opacity: <?php echo e($i <= $averageRating ? '1' : '0.3'); ?>;">
                                                <?php endfor; ?>
                                                <span class="font-xs color-gray-500">(<?php echo e($reviewCount); ?>)</span>
                                            </div>
                                            <div class="box-prices">
                                                <?php if(
                                                    $product->price_discounted &&
                                                        $product->price_discounted > 0 &&
                                                        $product->price_discounted < $product->price_regular): ?>
                                                    <div class="price-bold color-brand-3">
                                                        <?php echo e(number_format($product->price_discounted, 0)); ?>

                                                        DJF
                                                    </div>
                                                    <div class="price-line text-end color-gray-500">
                                                        <?php echo e(number_format($product->price_regular, 0)); ?> DJF
                                                    </div>
                                                <?php else: ?>
                                                    <div class="price-bold color-brand-3">
                                                        <?php echo e(number_format($product->price_regular, 0)); ?> DJF
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(isset($product->upcoming_promotion_start_at)): ?>
                                                <div style="font-size: 12px; color: #007bff; margin-top: 5px;">
                                                    Starts:
                                                    <?php echo e($product->upcoming_promotion_start_at->format('M d, H:i')); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php if(isset($product->upcoming_promotion_title)): ?>
                                                <div style="font-size: 11px; color: #6c757d; margin-top: 3px;">
                                                    <?php echo e($product->upcoming_promotion_title); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="no-products-container">
                    <div class="no-products-icon" style="margin-bottom: 20px;">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="opacity: 0.4;">
                            <path d="M12 2V12L8 8" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 2V12L16 8" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <circle cx="12" cy="12" r="10" stroke="#6c757d" stroke-width="1.5" />
                            <path d="M8 16L12 12L16 16" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h5 style="color: #495057; margin-bottom: 12px; font-weight: 600; font-size: 18px;">No
                        Upcoming Deals</h5>
                    <p style="color: #6c757d; font-size: 14px; margin-bottom: 0; line-height: 1.5;">
                        No upcoming deals<br>
                        available at the moment.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/home/upcoming_deals.blade.php ENDPATH**/ ?>