
<?php $__env->startSection('title', 'Edit Flash Sale'); ?>
<?php $__env->startSection('content'); ?>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Edit Flash Sale</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.flash-sales.index')); ?>">Flash Sales</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="<?php echo e(route('seller.flash-sales.show', $flashSale->slug)); ?>"><?php echo e($flashSale->title); ?></a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
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
                                        <a href="<?php echo e(route('seller.flash-sales.show', $flashSale->slug)); ?>"
                                            class="btn btn-outline-primary">
                                            <em class="icon ni ni-eye"></em><span>View Details</span>
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

            
            <?php if (isset($component)) { $__componentOriginal7f2dc8d54745489658314a5f3a6ced38 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7f2dc8d54745489658314a5f3a6ced38 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert-summary','data' => ['messages' => $errors->all(),'type' => 'danger','heading' => 'Please fix the following errors:']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->all()),'type' => 'danger','heading' => 'Please fix the following errors:']); ?>
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
                    <!-- Flash Sale Edit Form -->
                    <div class="col-lg-8">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Flash Sale Information</h4>
                                        <div class="nk-block-des">
                                            <span class="text-soft">Update the flash sale details below.</span>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->

                                <form action="<?php echo e(route('seller.flash-sales.update', $flashSale->slug)); ?>" method="POST"
                                    class="form-validate is-alter">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-title">Flash Sale Title <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="text"
                                                        class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="edit-title" name="title"
                                                        value="<?php echo e(old('title', $flashSale->title)); ?>" required>
                                                </div>
                                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Products <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <select
                                                        class="form-select js-select2-products <?php $__errorArgs = ['product_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        name="product_ids[]" data-placeholder="Select Products" multiple
                                                        required>
                                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($product->id); ?>"
                                                                data-price="<?php echo e($product->price_regular); ?>"
                                                                data-image="<?php echo e($product->featured_image_url); ?>"
                                                                data-title="<?php echo e($product->title); ?>"
                                                                data-stock="<?php echo e($product->stock_quantity); ?>"
                                                                <?php if(in_array($product->id, old('product_ids', $flashSale->products->pluck('id')->toArray()))): echo 'selected'; endif; ?>>
                                                                <?php echo e($product->title); ?>

                                                                (<?php echo e(number_format($product->price_regular, 2)); ?> DJF)
                                                                - Stock: <?php echo e($product->stock_quantity); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <?php $__errorArgs = ['product_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-discount-type">Discount Type <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <select
                                                        class="form-select js-select2 <?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="edit-discount-type" name="discount_type" required>
                                                        <?php $__currentLoopData = App\Models\FlashSale::getDiscountTypeOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value); ?>"
                                                                <?php if(old('discount_type', $flashSale->discount_type) == $value): echo 'selected'; endif; ?>>
                                                                <?php echo e($label); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <?php $__errorArgs = ['discount_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-discount-value">Discount Value <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <div class="input-group">
                                                        <input type="number"
                                                            class="form-control <?php $__errorArgs = ['discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            id="edit-discount-value" name="discount_value"
                                                            value="<?php echo e(old('discount_value', $flashSale->discount_value)); ?>"
                                                            required step="0.01" min="0"
                                                            placeholder="Enter discount value">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="edit-discount-unit">
                                                                <?php echo e($flashSale->discount_type === 'percentage' ? '%' : 'DJF'); ?>

                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-note" id="edit-discount-note">
                                                    <?php if($flashSale->discount_type === 'percentage'): ?>
                                                        Enter percentage value (0-100)
                                                    <?php else: ?>
                                                        Enter fixed discount amount
                                                    <?php endif; ?>
                                                </div>
                                                <?php $__errorArgs = ['discount_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-start-at">Start Date & Time <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="datetime-local"
                                                        class="form-control <?php $__errorArgs = ['start_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="edit-start-at" name="start_at"
                                                        value="<?php echo e(old('start_at', $flashSale->start_at->format('Y-m-d\TH:i'))); ?>"
                                                        required>
                                                </div>
                                                <?php $__errorArgs = ['start_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-end-at">End Date & Time <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <input type="datetime-local"
                                                        class="form-control <?php $__errorArgs = ['end_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="edit-end-at" name="end_at"
                                                        value="<?php echo e(old('end_at', $flashSale->end_at->format('Y-m-d\TH:i'))); ?>"
                                                        required>
                                                </div>
                                                <?php $__errorArgs = ['end_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-usage-limit">Usage Limit Per
                                                    User</label>
                                                <div class="form-control-wrap">
                                                    <input type="number"
                                                        class="form-control <?php $__errorArgs = ['usage_limit_per_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="edit-usage-limit" name="usage_limit_per_user"
                                                        value="<?php echo e(old('usage_limit_per_user', $flashSale->usage_limit_per_user)); ?>"
                                                        min="1" placeholder="Leave blank for unlimited">
                                                </div>
                                                <div class="form-note">Leave blank for unlimited usage per user.</div>
                                                <?php $__errorArgs = ['usage_limit_per_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="edit-status">Status <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-control-wrap">
                                                    <select
                                                        class="form-select js-select2 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        id="edit-status" name="status" required>
                                                        <?php $__currentLoopData = App\Models\FlashSale::getStatusOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value); ?>"
                                                                <?php if(old('status', $flashSale->status) == $value): echo 'selected'; endif; ?>>
                                                                <?php echo e($label); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateFlashSaleBtn">
                                                    <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                                    <em class="icon ni ni-save btn-icon"></em><span class="btn-text">Update Flash Sale</span>
                                                </button>
                                                <a href="<?php echo e(route('seller.flash-sales.show', $flashSale->slug)); ?>"
                                                    class="btn btn-outline-secondary ms-2">
                                                    <em class="icon ni ni-arrow-left"></em><span>Cancel</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Current Flash Sale Information -->
                    <div class="col-lg-4">
                        <!-- Current Information Card -->
                        <div class="card card-bordered mb-3">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Current Information</h5>
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
                                            <label class="form-label-sm">Flash Sale ID</label>
                                            <div class="form-control-wrap">
                                                <span
                                                    class="form-text">#<?php echo e(str_pad($flashSale->id, 4, '0', STR_PAD_LEFT)); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Slug</label>
                                            <div class="form-control-wrap">
                                                <span class="form-text"><?php echo e($flashSale->slug); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label-sm">Created Date</label>
                                            <div class="form-control-wrap">
                                                <span
                                                    class="form-text"><?php echo e($flashSale->created_at->format('M d, Y H:i')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Associated Products Card -->
                        <?php if($flashSale->products && $flashSale->products->count() > 0): ?>
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Current Products
                                                (<?php echo e($flashSale->products->count()); ?>)</h5>
                                        </div>
                                    </div>

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
                                                            class="form-text"><?php echo e(number_format($product->price_regular, 2)); ?> DJF</span>
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
                                                    <label class="form-label-sm">Discount Amount</label>
                                                    <div class="form-control-wrap">
                                                        <span class="form-text text-success">
                                                            <?php echo e(number_format($flashSale->getDiscountAmount($product), 2)); ?> DJF
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
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

        .submit-btn .spinner {
            display: inline-block;
        }

        .submit-btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // Custom template for product options with images
            function formatProductWithImage(product) {
                if (!product.id) {
                    return product.text;
                }

                var $product = $(
                    '<div class="d-flex align-items-center">' +
                    '<div class="me-2">' +
                    '<img src="' + ($(product.element).data('image') || '/assets/images/default-product.png') +
                    '" ' +
                    'alt="' + $(product.element).data('title') + '" ' +
                    'style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">' +
                    '</div>' +
                    '<div>' +
                    '<div class="fw-bold">' + $(product.element).data('title') + '</div>' +
                    '<small class="text-muted">' + parseFloat($(product.element).data('price')).toFixed(2) + ' DJF' +
                    ' | Stock: ' + $(product.element).data('stock') + '</small>' +
                    '</div>' +
                    '</div>'
                );
                return $product;
            }

            function formatProductSelection(product) {
                if (!product.id) {
                    return product.text;
                }
                return $(product.element).data('title') || product.text;
            }

            // Initialize Select2 with search functionality for dropdowns
            if ($.fn.select2) {
                $('.js-select2-products').select2({
                    placeholder: "Select Products",
                    allowClear: true,
                    width: '100%',
                    templateResult: formatProductWithImage,
                    templateSelection: formatProductSelection,
                    escapeMarkup: function(markup) {
                        return markup;
                    }
                });

                $('#edit-discount-type, #edit-status').select2({
                    width: '100%',
                    minimumResultsForSearch: -1 // Disable search for these
                });
            }

            // Update discount unit and note based on discount type
            function updateDiscountDisplay() {
                const discountType = $('#edit-discount-type').val();
                const $unit = $('#edit-discount-unit');
                const $note = $('#edit-discount-note');
                const $input = $('#edit-discount-value');

                if (discountType === 'percentage') {
                    $unit.text('%');
                    $note.text('Enter percentage value (0-100)');
                    $input.attr('max', '100');
                    $input.attr('placeholder', 'e.g., 20 for 20%');
                } else {
                    $unit.text('DJF');
                    $note.text('Enter fixed discount amount');
                    $input.removeAttr('max');
                    $input.attr('placeholder', 'e.g., 50 for 50 DJF off');
                }
            }

            // Initialize discount display
            updateDiscountDisplay();

            // Update discount display when type changes
            $('#edit-discount-type').on('change', function() {
                updateDiscountDisplay();
            });

            // Set minimum date/time for datetime-local inputs
            const now = new Date();
            const currentDateTime = now.toISOString().slice(0, 16);
            $('#edit-start-at, #edit-end-at').attr('min', currentDateTime);

            // Form validation and submit button handling
            $('form').on('submit', function(e) {
                const form = this;
                const discountType = $('#edit-discount-type').val();
                const discountValue = parseFloat($('#edit-discount-value').val());
                const selectedProducts = $('.js-select2-products').val();
                let validationPassed = true;

                // Check HTML5 form validation first
                if (!form.checkValidity()) {
                    validationPassed = false;
                    // Let HTML5 validation show its messages
                    return;
                }

                // Validate products selection
                if (!selectedProducts || selectedProducts.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one product.');
                    validationPassed = false;
                }

                // Validate discount value
                if (discountType === 'percentage' && discountValue > 100) {
                    e.preventDefault();
                    alert('Percentage discount cannot be more than 100%.');
                    validationPassed = false;
                }

                if (discountValue <= 0) {
                    e.preventDefault();
                    alert('Discount value must be greater than 0.');
                    validationPassed = false;
                }

                // Only show spinner and disable button if ALL validations pass
                if (validationPassed) {
                    const $submitBtn = $('#updateFlashSaleBtn');
                    $submitBtn.prop('disabled', true);
                    $submitBtn.find('.spinner').removeClass('d-none');
                    $submitBtn.find('.btn-icon').addClass('d-none');
                    $submitBtn.find('.btn-text').text('Updating...');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/seller/flash-sales/edit.blade.php ENDPATH**/ ?>