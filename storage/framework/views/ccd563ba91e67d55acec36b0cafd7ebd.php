<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="An educational platform personalized for the students">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/imgs/template')); ?>/favicon.png"> <!-- Page Title  -->
    <title>Admin <?php echo $__env->yieldContent('title', 'DjibMarket'); ?></title>
    <?php echo $__env->make('layouts.app.includes.admin.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <script src="<?php echo e(asset('assets/shared/js/jquery.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/admin/head.blade.php ENDPATH**/ ?>