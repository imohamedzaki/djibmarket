<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="<?php echo e(route('seller.dashboard')); ?>" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="<?php echo e(asset('assets/imgs/template/mini_logo.png')); ?>"
                    srcset="<?php echo e(asset('assets/imgs/template/mini_logo.png')); ?>" alt="logo">
                <img class="logo-dark logo-img" src="<?php echo e(asset('assets/imgs/template/mini_logo.png')); ?>"
                    srcset="<?php echo e(asset('assets/imgs/template/mini_logo.png')); ?>" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="<?php echo e(asset('assets/imgs/template/mini_logo.png')); ?>"
                    srcset="<?php echo e(asset('assets/imgs/template/mini_logo.png')); ?>" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Dashboard','link' => ''.e(route('seller.dashboard')).'','icon' => 'ni-dashboard-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard','link' => ''.e(route('seller.dashboard')).'','icon' => 'ni-dashboard-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Profile','link' => ''.e(route('seller.profile')).'','icon' => 'ni-user-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profile','link' => ''.e(route('seller.profile')).'','icon' => 'ni-user-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Products','link' => ''.e(route('seller.products.index')).'','icon' => 'ni-package-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Products','link' => ''.e(route('seller.products.index')).'','icon' => 'ni-package-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Coupons','link' => ''.e(route('seller.coupons.index')).'','icon' => 'ni-ticket-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Coupons','link' => ''.e(route('seller.coupons.index')).'','icon' => 'ni-ticket-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Categories','link' => ''.e(route('seller.categories.index')).'','icon' => 'ni-list-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Categories','link' => ''.e(route('seller.categories.index')).'','icon' => 'ni-list-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Orders','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-cart-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Orders','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-cart-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Return Requests','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-reload']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Return Requests','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-reload']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Order Deliveries','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-truck']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Deliveries','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-truck']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Campaigns','link' => ''.e(route('seller.campaigns.index')).'','icon' => 'ni-flag']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Campaigns','link' => ''.e(route('seller.campaigns.index')).'','icon' => 'ni-flag']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Promotions','link' => ''.e(route('seller.promotions.index')).'','icon' => 'ni-percent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Promotions','link' => ''.e(route('seller.promotions.index')).'','icon' => 'ni-percent']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Flash Sales','link' => ''.e(route('seller.flash-sales.index')).'','icon' => 'ni-hot-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Flash Sales','link' => ''.e(route('seller.flash-sales.index')).'','icon' => 'ni-hot-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Advertisements','link' => ''.e(route('seller.ads.index')).'','icon' => 'ni-card-view']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Advertisements','link' => ''.e(route('seller.ads.index')).'','icon' => 'ni-card-view']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Reviews','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-star-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Reviews','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-star-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginal41201fd1961521c83a916a45ead87bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal41201fd1961521c83a916a45ead87bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Analytics','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-growth-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Analytics','link' => ''.e(route('seller.coming-soon')).'','icon' => 'ni-growth-fill']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $attributes = $__attributesOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__attributesOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41201fd1961521c83a916a45ead87bc0)): ?>
<?php $component = $__componentOriginal41201fd1961521c83a916a45ead87bc0; ?>
<?php unset($__componentOriginal41201fd1961521c83a916a45ead87bc0); ?>
<?php endif; ?>
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/seller/sidebar.blade.php ENDPATH**/ ?>