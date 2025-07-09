
<?php $__env->startSection('title', 'Flash Sale Details'); ?>
<?php $__env->startSection('content'); ?>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Flash Sale Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.flash-sales.index')); ?>">Flash Sales</a>
                                </li>
                                <li class="breadcrumb-item active"><?php echo e($flashSale->title); ?></li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <a href="<?php echo e(route('seller.flash-sales.edit', $flashSale->slug)); ?>"
                                            class="btn btn-outline-primary">
                                            <em class="icon ni ni-edit"></em><span>Edit Flash Sale</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('seller.flash-sales.index')); ?>" class="btn btn-secondary">
                                            <em class="icon ni ni-arrow-left"></em><span>Back to List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            
            <?php if (isset($component)) { $__componentOriginal7f2dc8d54745489658314a5f3a6ced38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f2dc8d54745489658314a5f3a6ced38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-summary','data' => ['messages' => session('success'),'type' => 'success']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('success')),'type' => 'success']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f2dc8d54745489658314a5f3a6ced38)): ?>
<?php $attributes = $__attributesOriginal7f2dc8d54745489658314a5f3a6ced38; ?>
<?php unset($__attributesOriginal7f2dc8d54745489658314a5f3a6ced38); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f2dc8d54745489658314a5f3a6ced38)): ?>
<?php $component = $__componentOriginal7f2dc8d54745489658314a5f3a6ced38; ?>
<?php unset($__componentOriginal7f2dc8d54745489658314a5f3a6ced38); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal7f2dc8d54745489658314a5f3a6ced38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f2dc8d54745489658314a5f3a6ced38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-summary','data' => ['messages' => session('error'),'type' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('error')),'type' => 'danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7f2dc8d54745489658314a5f3a6ced38)): ?>
<?php $attributes = $__attributesOriginal7f2dc8d54745489658314a5f3a6ced38; ?>
<?php unset($__attributesOriginal7f2dc8d54745489658314a5f3a6ced38); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7f2dc8d54745489658314a5f3a6ced38)): ?>
<?php $component = $__componentOriginal7f2dc8d54745489658314a5f3a6ced38; ?>
<?php unset($__componentOriginal7f2dc8d54745489658314a5f3a6ced38); ?>
<?php endif; ?>

            <div class="nk-block nk-block-lg">
                <div class="row g-gs">
                    <!-- Flash Sale Details Card -->
                    <div class="col-lg-8">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title"><?php echo e($flashSale->title); ?></h4>
                                            <div class="nk-block-des">
                                                <span class="text-soft">Flash Sale Information</span>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content">
                                            <span class="badge badge-lg badge-dot bg-<?php echo e($flashSale->getStatusColor()); ?>">
                                                <?php echo e($flashSale->getStatusLabel()); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Flash Sale ID</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="#<?php echo e(str_pad($flashSale->id, 4, '0', STR_PAD_LEFT)); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Slug</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?php echo e($flashSale->slug); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?php echo e($flashSale->title); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Discount Type</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="<?php echo e($flashSale->getDiscountTypeLabel()); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Discount Value</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo e($flashSale->discount_value); ?>" readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <?php echo e($flashSale->discount_type === 'percentage' ? '%' : 'DJF'); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Total Stock Available</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="<?php echo e($flashSale->getTotalStock()); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Start Date & Time</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="<?php echo e($flashSale->start_at->format('M d, Y H:i')); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">End Date & Time</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="<?php echo e($flashSale->end_at->format('M d, Y H:i')); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Usage Limit Per User</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="<?php echo e($flashSale->usage_limit_per_user ? number_format($flashSale->usage_limit_per_user) : 'Unlimited'); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Created Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="<?php echo e($flashSale->created_at->format('M d, Y H:i')); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Information & Additional Details -->
                    <div class="col-lg-4">
                        <!-- Product Information Card -->
                        <div class="card card-bordered mb-3">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Products Information</h5>
                                    </div>
                                </div>
                                <?php if($flashSale->products && $flashSale->products->count() > 0): ?>
                                    <?php $__currentLoopData = $flashSale->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="user-card <?php if(!$loop->last): ?> border-bottom pb-3 mb-3 <?php endif; ?>">
                                            <div class="user-avatar bg-primary-dim">
                                                <?php if($product->thumbnail): ?>
                                                    <img src="<?php echo e(Storage::disk('public')->url($product->thumbnail)); ?>"
                                                        alt="<?php echo e($product->title); ?>">
                                                <?php else: ?>
                                                    <span><?php echo e(strtoupper(substr($product->title, 0, 2))); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text"><?php echo e($product->title); ?></span>
                                                <span class="sub-text"><?php echo e($product->sku ?? 'No SKU'); ?></span>
                                            </div>
                                        </div>
                                        <div class="row g-3 <?php if(!$loop->last): ?> mb-3 <?php endif; ?>">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Regular Price</label>
                                                    <div class="form-control-wrap">
                                                        <span
                                                            class="form-text text-decoration-line-through"><?php echo e(number_format($product->price_regular, 2)); ?> DJF</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Flash Price</label>
                                                    <div class="form-control-wrap">
                                                        <span
                                                            class="form-text text-success fw-bold"><?php echo e(number_format($flashSale->getDiscountedPrice($product), 2)); ?> DJF</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Stock Available</label>
                                                    <div class="form-control-wrap">
                                                        <span class="form-text"><?php echo e($product->stock_quantity); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Category</label>
                                                    <div class="form-control-wrap">
                                                        <span
                                                            class="form-text"><?php echo e($product->category ? $product->category->name : 'No Category'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label-sm">Discount Amount</label>
                                                    <div class="form-control-wrap">
                                                        <span class="form-text text-success">
                                                            <?php echo e(number_format($flashSale->getDiscountAmount($product), 2)); ?> DJF
                                                            (<?php echo e(number_format(($flashSale->getDiscountAmount($product) / $product->price_regular) * 100, 1)); ?>%
                                                            off)
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="<?php echo e(route('seller.products.show', $product->slug)); ?>"
                                                class="btn btn-outline-primary btn-sm">
                                                <em class="icon ni ni-eye"></em><span>View Product</span>
                                            </a>
                                        </div>
                                        <?php if(!$loop->last): ?>
                                            <hr class="my-4">
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mt-3">
                                        <a href="<?php echo e(route('seller.products.index')); ?>"
                                            class="btn btn-outline-primary btn-sm">
                                            <em class="icon ni ni-list"></em><span>View All Products</span>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-3">
                                        <em class="icon ni ni-alert-circle text-danger" style="font-size: 2rem;"></em>
                                        <p class="mt-2 text-soft">No products found or they have been deleted.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Status & Statistics Card -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Statistics & Status</h5>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Current Status</label>
                                            <div class="form-control-wrap">
                                                <span class="badge badge-dot bg-<?php echo e($flashSale->getStatusColor()); ?>">
                                                    <?php echo e($flashSale->getStatusLabel()); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Time Status</label>
                                            <?php
                                                $now = now();
                                                $start = $flashSale->start_at;
                                                $end = $flashSale->end_at;
                                                $timeLeft = '';
                                                $badgeClass = '';
                                                
                                                if ($now < $start) {
                                                    // Flash sale hasn't started yet
                                                    $diff = $start->diff($now);
                                                    $timeLeft = 'Starts in ';
                                                    $badgeClass = 'badge badge-info';
                                                } elseif ($now >= $start && $now < $end) {
                                                    // Flash sale is active
                                                    $diff = $end->diff($now);
                                                    $timeLeft = 'Ends in ';
                                                    $badgeClass = 'badge badge-success';
                                                } else {
                                                    // Flash sale has ended
                                                    $timeLeft = 'Ended';
                                                    $badgeClass = 'badge badge-danger';
                                                }
                                                
                                                if (isset($diff)) {
                                                    if ($diff->days > 0) {
                                                        $timeLeft .= $diff->days . ' day' . ($diff->days > 1 ? 's' : '') . ' ';
                                                    }
                                                    if ($diff->h > 0) {
                                                        $timeLeft .= $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ';
                                                    }
                                                    if ($diff->i > 0) {
                                                        $timeLeft .= $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ';
                                                    }
                                                    if ($diff->s > 0) {
                                                        $timeLeft .= $diff->s . ' second' . ($diff->s > 1 ? 's' : '');
                                                    }
                                                    if ($diff->days == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s == 0) {
                                                        $timeLeft .= 'less than 1 second';
                                                    }
                                                }
                                            ?>
                                            <div class="form-control-wrap">
                                                <span class="badge <?php echo e($badgeClass); ?>" id="timeStatusBadge" 
                                                    data-start="<?php echo e($flashSale->start_at->toISOString()); ?>" 
                                                    data-end="<?php echo e($flashSale->end_at->toISOString()); ?>"><?php echo e($timeLeft); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Duration</label>
                                            <div class="form-control-wrap">
                                                <span
                                                    class="form-text"><?php echo e($flashSale->start_at->diffForHumans($flashSale->end_at, true)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1.5px solid #ddd;
        }

        .form-text {
            display: block;
            padding: 0.4375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: #3c4d62;
            background-color: #f5f6fa;
            border: 1px solid #e5e9f2;
            border-radius: 0.375rem;
        }

        .badge-info {
            background-color: #17a2b8;
            color: #ffffff;
        }

        .badge-success {
            background-color: #28a745;
            color: #ffffff;
        }

        .badge-danger {
            background-color: #dc3545;
            color: #ffffff;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function() {
        function updateTimeStatus() {
            const badge = $('#timeStatusBadge');
            const startTime = new Date(badge.data('start'));
            const endTime = new Date(badge.data('end'));
            const now = new Date();
            
            let timeLeft = '';
            let badgeClass = '';
            
            if (now < startTime) {
                // Flash sale hasn't started yet
                const diff = Math.abs(startTime - now);
                timeLeft = 'Starts in ';
                badgeClass = 'badge badge-info';
                timeLeft += formatTimeDifference(diff);
            } else if (now >= startTime && now < endTime) {
                // Flash sale is active
                const diff = Math.abs(endTime - now);
                timeLeft = 'Ends in ';
                badgeClass = 'badge badge-success';
                timeLeft += formatTimeDifference(diff);
            } else {
                // Flash sale has ended
                timeLeft = 'Ended';
                badgeClass = 'badge badge-danger';
            }
            
            badge.text(timeLeft);
            badge.attr('class', badgeClass);
        }
        
        function formatTimeDifference(diff) {
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            let result = '';
            
            if (days > 0) {
                result += days + ' day' + (days > 1 ? 's' : '') + ' ';
            }
            if (hours > 0) {
                result += hours + ' hour' + (hours > 1 ? 's' : '') + ' ';
            }
            if (minutes > 0) {
                result += minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ';
            }
            if (seconds > 0) {
                result += seconds + ' second' + (seconds > 1 ? 's' : '');
            }
            if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                result = 'less than 1 second';
            }
            
            return result.trim();
        }
        
        // Update immediately
        updateTimeStatus();
        
        // Update every second
        setInterval(updateTimeStatus, 1000);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/seller/flash-sales/show.blade.php ENDPATH**/ ?>