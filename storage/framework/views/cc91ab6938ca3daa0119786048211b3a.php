<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
            <div class="mobile-logo"><a class="d-flex" href="<?php echo e(route('buyer.home')); ?>"><img alt="DjibMarket"
                        src="<?php echo e(asset('assets/imgs/template/mini_logo2.png')); ?>"></a></div>
            <div class="perfect-scroll">

                <div class="box-header-search">
                    <form class="form-search" method="get" action="<?php echo e(route('search.results')); ?>"
                        id="mobile-search-form">
                        <div class="box-keysearch">
                            <input class="form-control font-xs" type="text" value=""
                                placeholder="Search for items" id="mobile_search_input" name="query"
                                autocomplete="off">
                        </div>
                    </form>
                </div>

                <div class="mobile-menu-wrap mobile-header-border">
                    <nav class="mt-15">
                        <ul class="mobile-menu font-heading">
                            <li><a class="active" href="<?php echo e(route('buyer.home')); ?>">Home</a></li>
                            <?php $__currentLoopData = $megaMenuCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li <?php if($category->children && $category->children->isNotEmpty()): ?> class="has-children" <?php endif; ?>>
                                    <a
                                        href="<?php echo e(route('categories.show', ['category' => $category->slug])); ?>"><?php echo e($category->name); ?></a>
                                    <?php if($category->children && $category->children->isNotEmpty()): ?>
                                        <ul class="sub-menu">
                                            <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li <?php if($child->children && $child->children->isNotEmpty()): ?> class="has-children" <?php endif; ?>>
                                                    <a
                                                        href="<?php echo e(route('categories.show', ['category' => $child->slug])); ?>"><?php echo e($child->name); ?></a>
                                                    <?php if($child->children && $child->children->isNotEmpty()): ?>
                                                        <ul class="sub-menu">
                                                            <?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li><a
                                                                        href="<?php echo e(route('categories.show', ['category' => $grandChild->slug])); ?>"><?php echo e($grandChild->name); ?></a>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </nav>
                </div>
                <div class="mobile-account">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="mobile-header-top">
                            <div class="user-account">
                                <a href="<?php echo e(route('buyer.dashboard.profile')); ?>">
                                    <div class="user-avatar"
                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        <?php if(Auth::user()->avatar ?? false): ?>
                                            <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        <?php else: ?>
                                            <span
                                                style="font-size: 16px; font-weight: bold; color: #333;"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <div class="content">
                                    <h6 class="user-name">Hello<span class="text-brand">
                                            <?php echo e(explode(' ', Auth::user()->name)[0]); ?> !</span></h6>
                                    <p class="font-xs text-muted">Welcome Back</p>
                                </div>
                            </div>
                        </div>
                        <ul class="mobile-menu">
                            <li><a href="<?php echo e(route('buyer.dashboard.index')); ?>">My Account</a></li>
                            <li><a href="<?php echo e(route('buyer.dashboard.orders')); ?>">Order Tracking</a></li>
                            <li><a href="<?php echo e(route('buyer.dashboard.my_orders')); ?>">My Orders</a></li>
                            <li><a href="<?php echo e(route('buyer.dashboard.wishlist')); ?>">My Wishlist</a></li>
                            <li><a href="<?php echo e(route('buyer.dashboard.profile')); ?>">Setting</a></li>
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <a href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <?php echo e(__('Sign out')); ?>

                                    </a>
                                </form>
                            </li>
                        </ul>
                    <?php else: ?>
                        <ul class="mobile-menu">
                            <li><a href="<?php echo e(route('login')); ?>">Log In</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Sign Up</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="site-copyright color-gray-400 mt-30">Copyright 2024 &copy; DjibMarket.
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/mobile-header.blade.php ENDPATH**/ ?>