<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                    srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo">
                <img class="logo-dark logo-img" src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                    srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                    srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo-small">
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Dashboard','link' => ''.e(route('admin.dashboard')).'','icon' => 'ni-dashboard-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard','link' => ''.e(route('admin.dashboard')).'','icon' => 'ni-dashboard-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Business Activities','link' => ''.e(route('admin.business_activities.index')).'','icon' => 'ni-building']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Business Activities','link' => ''.e(route('admin.business_activities.index')).'','icon' => 'ni-building']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Categories','link' => ''.e(route('admin.categories.index')).'','icon' => 'ni-list-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Categories','link' => ''.e(route('admin.categories.index')).'','icon' => 'ni-list-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Brand Management','link' => ''.e(route('admin.brands.index')).'','icon' => 'ni-img-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Brand Management','link' => ''.e(route('admin.brands.index')).'','icon' => 'ni-img-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Category Ads','link' => ''.e(route('admin.category-ads.index')).'','icon' => 'ni-img-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Category Ads','link' => ''.e(route('admin.category-ads.index')).'','icon' => 'ni-img-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Profile','link' => ''.e(route('admin.profile.show')).'','icon' => 'ni-user-alt-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profile','link' => ''.e(route('admin.profile.show')).'','icon' => 'ni-user-alt-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Sellers management','link' => ''.e(route('admin.sellers.index')).'','icon' => 'ni-briefcase']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Sellers management','link' => ''.e(route('admin.sellers.index')).'','icon' => 'ni-briefcase']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Buyers','link' => ''.e(route('admin.buyers.index')).'','icon' => 'ni-users-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Buyers','link' => ''.e(route('admin.buyers.index')).'','icon' => 'ni-users-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Order Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-cart-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-cart-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Pending orders','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-list-check']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pending orders','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-list-check']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Delivered orders','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-check-circle-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Delivered orders','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-check-circle-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Order Deliveries','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-truck']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Order Deliveries','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-truck']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Return requests','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-reload']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Return requests','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-reload']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Campaigns Management','link' => ''.e(route('admin.campaigns.index')).'','icon' => 'ni-flag']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Campaigns Management','link' => ''.e(route('admin.campaigns.index')).'','icon' => 'ni-flag']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Promotions Management','link' => ''.e(route('admin.promotions.index')).'','icon' => 'ni-tag-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Promotions Management','link' => ''.e(route('admin.promotions.index')).'','icon' => 'ni-tag-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Coupons Management','link' => '#','icon' => 'ni-ticket-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Coupons Management','link' => '#','icon' => 'ni-ticket-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Flash Sales','link' => ''.e(route('admin.flash-sales.index')).'','icon' => 'ni-hot-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Flash Sales','link' => ''.e(route('admin.flash-sales.index')).'','icon' => 'ni-hot-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Ads Companies Management','link' => ''.e(route('admin.ads-companies.index')).'','icon' => 'ni-card-view']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ads Companies Management','link' => ''.e(route('admin.ads-companies.index')).'','icon' => 'ni-card-view']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Seller Advertisements','link' => ''.e(route('admin.ads.index')).'','icon' => 'ni-monitor']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Seller Advertisements','link' => ''.e(route('admin.ads.index')).'','icon' => 'ni-monitor']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Notification Bars','link' => ''.e(route('admin.notification-bars.index')).'','icon' => 'ni-bell']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Notification Bars','link' => ''.e(route('admin.notification-bars.index')).'','icon' => 'ni-bell']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Drivers Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Drivers Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-users']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Product Reviews Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-star-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Product Reviews Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-star-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Payment Methods Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-wallet-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Payment Methods Management','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-wallet-fill']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Email Management','link' => ''.e(route('admin.emails.dashboard')).'','icon' => 'ni-emails']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Email Management','link' => ''.e(route('admin.emails.dashboard')).'','icon' => 'ni-emails']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar.single','data' => ['title' => 'Analytics','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-growth-fill']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar.single'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Analytics','link' => ''.e(route('admin.coming-soon')).'','icon' => 'ni-growth-fill']); ?>
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
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/admin/sidebar.blade.php ENDPATH**/ ?>