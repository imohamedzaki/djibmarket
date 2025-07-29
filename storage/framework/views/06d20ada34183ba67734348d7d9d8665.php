<section class="section-box bg-home9">
    <div class="container">
        <div class="row">
            <?php echo $__env->make('layouts.app.partials.buyer.home.new_arrivals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.best_selling', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.flash_sales', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.campaigns', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.top_rated', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.top_discounts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.most_reviewed', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.app.partials.buyer.home.upcoming_deals', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/main_swiper.blade.php ENDPATH**/ ?>