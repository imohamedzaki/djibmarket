
<?php $__env->startSection('title', 'Create Flash Sale'); ?>
<?php $__env->startSection('content'); ?>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Create New Flash Sale</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.flash-sales.index')); ?>">Flash Sales</a>
                                </li>
                                <li class="breadcrumb-item active">Create</li>
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
                    <!-- Flash Sale Create Form -->
                    <div class="col-lg-8">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Flash Sale Information</h4>
                                        <div class="nk-block-des">
                                            <span class="text-soft">Fill in the details for your new flash sale.</span>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->

                                <form action="<?php echo e(route('seller.flash-sales.store')); ?>" method="POST"
                                    class="form-validate is-alter">
                                    <?php echo csrf_field(); ?>

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="create-title">Flash Sale Title <span
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
                                                        id="create-title" name="title" value="<?php echo e(old('title')); ?>"
                                                        required
                                                        placeholder="Enter an attractive title for your flash sale">
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
                                                                <?php if(in_array($product->id, old('product_ids', []))): echo 'selected'; endif; ?>>
                                                                <?php echo e($product->title); ?>

                                                                ($<?php echo e(number_format($product->price_regular, 2)); ?>)
                                                                - Stock: <?php echo e($product->stock_quantity); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <?php if(count($products) == 0): ?>
                                                    <div class="form-note text-warning">
                                                        <em class="icon ni ni-alert-circle"></em>
                                                        You need to have published products before creating flash sales.
                                                        <a href="<?php echo e(route('seller.products.index')); ?>">Add products
                                                            first</a>.
                                                    </div>
                                                <?php endif; ?>
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
                                                <label class="form-label" for="create-discount-type">Discount Type <span
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
                                                        id="create-discount-type" name="discount_type" required>
                                                        <?php $__currentLoopData = App\Models\FlashSale::getDiscountTypeOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value); ?>"
                                                                <?php if(old('discount_type', 'percentage') == $value): echo 'selected'; endif; ?>>
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
                                                <label class="form-label" for="create-discount-value">Discount Value <span
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
                                                            id="create-discount-value" name="discount_value"
                                                            value="<?php echo e(old('discount_value')); ?>" required step="0.01"
                                                            min="0" placeholder="Enter discount value">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="discount-unit">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-note" id="discount-note">Enter percentage value (0-100)
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
                                                <label class="form-label" for="create-start-at">Start Date & Time <span
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
                                                        id="create-start-at" name="start_at"
                                                        value="<?php echo e(old('start_at')); ?>" required>
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
                                                <label class="form-label" for="create-end-at">End Date & Time <span
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
                                                        id="create-end-at" name="end_at" value="<?php echo e(old('end_at')); ?>"
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
                                                <label class="form-label" for="create-usage-limit">Usage Limit Per
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
                                                        id="create-usage-limit" name="usage_limit_per_user"
                                                        value="<?php echo e(old('usage_limit_per_user')); ?>" min="1"
                                                        placeholder="Leave blank for unlimited">
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
                                                <label class="form-label" for="create-status">Status <span
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
                                                        id="create-status" name="status" required>
                                                        <?php $__currentLoopData = App\Models\FlashSale::getStatusOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($value); ?>"
                                                                <?php if(old('status', App\Models\FlashSale::STATUS_INACTIVE) == $value): echo 'selected'; endif; ?>>
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
                                                <button type="submit" class="btn btn-lg btn-primary">
                                                    <em class="icon ni ni-save"></em><span>Create Flash Sale</span>
                                                </button>
                                                <a href="<?php echo e(route('seller.flash-sales.index')); ?>"
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

                    <!-- Help & Tips -->
                    <div class="col-lg-4">
                        <!-- Tips Card -->
                        <div class="card card-bordered mb-3">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">
                                            <em class="icon ni ni-bulb-fill text-warning me-1"></em>
                                            Flash Sale Tips
                                        </h5>
                                    </div>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        <strong>Attractive Title:</strong> Use compelling words like "Limited Time", "Flash
                                        Deal", or "Super Sale"
                                    </li>
                                    <li class="list-group-item px-0">
                                        <strong>Pricing:</strong> Offer significant discounts (20-50%) to create urgency
                                    </li>
                                    <li class="list-group-item px-0">
                                        <strong>Duration:</strong> Keep flash sales short (2-24 hours) to create urgency
                                    </li>
                                    <li class="list-group-item px-0">
                                        <strong>Stock Limit:</strong> Limited quantities increase perceived value
                                    </li>
                                    <li class="list-group-item px-0">
                                        <strong>Timing:</strong> Start sales during peak shopping hours
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Status Info Card -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">
                                            <em class="icon ni ni-info-fill text-info me-1"></em>
                                            Status Information
                                        </h5>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-dot bg-warning me-2"></span>
                                            <div>
                                                <strong>Inactive:</strong> Flash sale is saved but not visible to customers
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-dot bg-success me-2"></span>
                                            <div>
                                                <strong>Active:</strong> Flash sale is live and customers can purchase
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-dot bg-secondary me-2"></span>
                                            <div>
                                                <strong>Ended:</strong> Flash sale has finished and is no longer available
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
        .list-group-item {
            border-left: none;
            border-right: none;
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        .list-group-item:last-child {
            border-bottom: none;
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
                    '<small class="text-muted">$' + parseFloat($(product.element).data('price')).toFixed(2) +
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

                $('#create-discount-type, #create-status').select2({
                    width: '100%',
                    minimumResultsForSearch: -1 // Disable search for these
                });
            }

            // Update discount unit and note based on discount type
            function updateDiscountDisplay() {
                const discountType = $('#create-discount-type').val();
                const $unit = $('#discount-unit');
                const $note = $('#discount-note');
                const $input = $('#create-discount-value');

                if (discountType === 'percentage') {
                    $unit.text('%');
                    $note.text('Enter percentage value (0-100)');
                    $input.attr('max', '100');
                    $input.attr('placeholder', 'e.g., 20 for 20%');
                } else {
                    $unit.text('$');
                    $note.text('Enter fixed discount amount');
                    $input.removeAttr('max');
                    $input.attr('placeholder', 'e.g., 50 for $50 off');
                }
            }

            // Initialize discount display
            updateDiscountDisplay();

            // Update discount display when type changes
            $('#create-discount-type').on('change', function() {
                updateDiscountDisplay();
            });

            // Set minimum date/time for datetime-local inputs to current date/time
            const now = new Date();
            const currentDateTime = now.toISOString().slice(0, 16);
            $('#create-start-at, #create-end-at').attr('min', currentDateTime);

            // Auto-set end date when start date changes (add 24 hours by default)
            $('#create-start-at').on('change', function() {
                const startDate = new Date($(this).val());
                if (startDate) {
                    const endDate = new Date(startDate.getTime() + (24 * 60 * 60 * 1000)); // Add 24 hours
                    const endDateString = endDate.toISOString().slice(0, 16);
                    $('#create-end-at').val(endDateString);
                }
            });

            // Form validation
            $('form').on('submit', function(e) {
                const discountType = $('#create-discount-type').val();
                const discountValue = parseFloat($('#create-discount-value').val());
                const selectedProducts = $('.js-select2-products').val();

                // Validate products selection
                if (!selectedProducts || selectedProducts.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one product.');
                    return false;
                }

                // Validate discount value
                if (discountType === 'percentage' && discountValue > 100) {
                    e.preventDefault();
                    alert('Percentage discount cannot be more than 100%.');
                    return false;
                }

                if (discountValue <= 0) {
                    e.preventDefault();
                    alert('Discount value must be greater than 0.');
                    return false;
                }
            });

            // Disable form if no products available
            <?php if(count($products) == 0): ?>
                $('form input, form select, form button[type="submit"]').prop('disabled', true);
                $('.card-inner').prepend(
                    '<div class="alert alert-warning"><em class="icon ni ni-alert-circle"></em> You must have published products before creating flash sales. <a href="<?php echo e(route('seller.products.index')); ?>" class="alert-link">Add products first</a>.</div>'
                );
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/seller/flash-sales/create.blade.php ENDPATH**/ ?>