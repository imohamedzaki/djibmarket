<link rel="stylesheet" href="<?php echo e(asset('assets/css/fonts.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/normalize.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/uicons-regular-rounded.css')); ?>">


<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/swiper/swiper-bundle.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/select2/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/slick/slick.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/animate/animate.min.css')); ?>">


<link href="<?php echo e(asset('assets/css/v1/reset.css')); ?>" rel="stylesheet">


<link href="<?php echo e(asset('assets/css/app.css?v=3.0.0')); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
<?php echo $__env->make('includes.slickSlider.slickslider_css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('includes.z_alert.contentCSS', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<link href="<?php echo e(asset('assets/css/tabler-icons.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/tabler-icons-filled.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/tabler-icons-outline.min.css')); ?>" rel="stylesheet">


<link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
<style>
    /* NProgress Custom Styling */
    #nprogress .bar {
        background: #3182ce !important;
        height: 3px !important;
    }

    #nprogress .peg {
        display: block;
        position: absolute;
        right: 0px;
        width: 100px;
        height: 100%;
        box-shadow: 0 0 10px #3182ce, 0 0 5px #3182ce;
        opacity: 1.0;
        transform: rotate(3deg) translate(0px, -4px);
    }

    #nprogress .spinner {
        display: block;
        position: fixed;
        z-index: 1031;
        top: 15px;
        right: 15px;
    }

    #nprogress .spinner-icon {
        width: 18px;
        height: 18px;
        box-sizing: border-box;
        border: solid 2px transparent;
        border-top: solid 2px #3182ce;
        border-left: solid 2px #3182ce;
        border-radius: 50%;
        animation: nprogress-spinner 400ms linear infinite;
    }

    @keyframes nprogress-spinner {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 1199.98px) {
        .topbar {
            display: flex;
        }

        .mm-navbar-container {
            display: none;
        }

        .topbar .container-topbar {
            flex-wrap: wrap;
        }

        .topbar .container-topbar .menu-topbar-left {
            width: 100%;
        }

        .topbar .container-topbar .menu-topbar-left .nav-small {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .topbar .container-topbar .info-topbar {
            width: 100%;
            padding: .3rem;
            margin: .3rem 0;
        }

        .topbar .container-topbar .menu-topbar-right {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
    }
</style>

<?php echo $__env->yieldContent('css'); ?>
<?php echo $__env->yieldContent('styles'); ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/includes/buyer/styles.blade.php ENDPATH**/ ?>