<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
    <div class="box-slider-product">
        <div class="head-slider">
            <div class="row">
                <div class="col-lg-7">
                    <h5>Campaigns</h5>
                </div>
                <div class="col-lg-5">
                    <div class="box-button-slider-2">
                        <div class="swiper-button-prev swiper-button-prev-style-top swiper-button-prev-campaigns">
                        </div>
                        <div class="swiper-button-next swiper-button-next-style-top swiper-button-next-campaigns">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-products">
            <?php if($campaignsProducts->count() > 0): ?>
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3-campaigns">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $campaignsProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <div class="card-product-small">
                                        <div class="card-image">
                                            <a href="#"
                                                style="display: block; width: 100%; height: 200px; overflow: hidden;">
                                                <img src="<?php echo e($product->featured_image_url ?? asset('assets/imgs/page/homepage9/sp10.png')); ?>"
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
                                            <?php if(isset($product->campaign_promotion_title)): ?>
                                                <div style="font-size: 12px; color: #007bff; margin-top: 5px;">
                                                    <?php echo e($product->campaign_promotion_title); ?>

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
                            <path d="M15 3H9V1C9 0.447715 9.44772 0 10 0H14C14.5523 0 15 0.447715 15 1V3Z"
                                stroke="#6c757d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3 5H21L20 19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19L3 5Z"
                                stroke="#6c757d" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 9V17" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M15 9V17" stroke="#6c757d" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h5 style="color: #495057; margin-bottom: 12px; font-weight: 600; font-size: 18px;">No
                        Campaigns Available</h5>
                    <p style="color: #6c757d; font-size: 14px; margin-bottom: 0; line-height: 1.5;">
                        No active campaigns<br>
                        available at the moment.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/home/campaigns.blade.php ENDPATH**/ ?>