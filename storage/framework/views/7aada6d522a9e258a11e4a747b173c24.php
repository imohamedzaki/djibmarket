<script src="<?php echo e(asset('assets/js/')); ?>/vendors/modernizr-3.6.0.min.js"></script>


<script src="<?php echo e(asset('assets/js/')); ?>/vendors/modernizr-3.6.0.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/jquery-3.6.0.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/jquery-migrate-3.3.0.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/waypoints.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/wow.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/magnific-popup.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/perfect-scrollbar.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/select2.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/isotope.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/scrollup.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/swiper-bundle.min.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/noUISlider.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/slider.js"></script>
<!-- Count down-->
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/counterup.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/jquery.countdown.min.js"></script>
<!-- Count down-->
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/jquery.elevatezoom.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/vendors/slick.js"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/main.js?v=3.0.0"></script>
<script src="<?php echo e(asset('assets/js/')); ?>/shop.js?v=1.2.1"></script>

<?php echo $__env->make('includes.slickSlider.slickslider_js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('includes.z_alert.contentJS', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
<script>
    // Configure NProgress
    NProgress.configure({
        showSpinner: true,
        speed: 300,
        minimum: 0.1,
        trickleSpeed: 200
    });

    // Start NProgress on page navigation
    document.addEventListener('DOMContentLoaded', function() {
        // Handle link clicks
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href &&
                !link.hasAttribute('data-bs-toggle') &&
                !link.href.startsWith('javascript:') &&
                !link.href.startsWith('#') &&
                link.target !== '_blank' &&
                link.hostname === window.location.hostname) {
                NProgress.start();
            }
        });

        // Handle form submissions
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form && form.method && form.method.toLowerCase() === 'get') {
                NProgress.start();
            }
        });

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function() {
            NProgress.start();
        });

        // Complete NProgress when page loads
        window.addEventListener('load', function() {
            NProgress.done();
        });

        // Handle AJAX requests if jQuery is available
        if (typeof $ !== 'undefined') {
            $(document).ajaxStart(function() {
                NProgress.start();
            });

            $(document).ajaxComplete(function() {
                NProgress.done();
            });
        }

        // Handle fetch requests
        const originalFetch = window.fetch;
        window.fetch = function(...args) {
            NProgress.start();
            return originalFetch.apply(this, args).finally(() => {
                NProgress.done();
            });
        };
    });
</script>

<?php echo $__env->yieldContent('js'); ?>
<?php echo $__env->yieldContent('scripts'); ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/includes/buyer/scripts.blade.php ENDPATH**/ ?>