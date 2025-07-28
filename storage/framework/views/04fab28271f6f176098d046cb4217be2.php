<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                        srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo">
                    <img class="logo-dark logo-img" src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                        srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo-dark">
                </a>
            </div>
            <div class="nk-header-text d-none d-xl-block">
                <h4 class="text-muted">Interface Administrateur</h4>
            </div>
            <!-- .nk-header-brand -->
            

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <?php echo $__env->make('layouts.app.includes.admin.dropdownLanguage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('layouts.app.includes.admin.dropdownChats', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('layouts.app.includes.admin.dropdownNotification', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('layouts.app.includes.admin.dropdownUser', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </ul>
            </div>
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/admin/header.blade.php ENDPATH**/ ?>