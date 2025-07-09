
<?php $__env->startSection('title', 'Flash Sales'); ?>
<?php $__env->startSection('content'); ?>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Flash Sales</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Flash Sales</li>
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
                                        <?php if(Auth::guard('seller')->user()->status === 'pending'): ?>
                                            <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Flash sale creation is only available when your seller application has been accepted">
                                                <button class="btn btn-primary" disabled>
                                                    <em class="icon ni ni-lock"></em><span>Add Flash Sale (Locked)</span>
                                                </button>
                                            </span>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('seller.flash-sales.create')); ?>" class="btn btn-primary">
                                                <em class="icon ni ni-plus"></em><span>Add Flash Sale</span>
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            
            <?php echo $__env->make('includes.seller-pending-alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
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
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Flash Sales</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage flash sales.</p>
                        </div>
                    </div>
                </div>
                <div class="card card-preview">
                    <div class="card-inner">
                        <table
                            class="datatable-init nk-tb-list nk-tb-ulist <?php if(count($flashSales) == 0): ?> no-datatable <?php endif; ?>"
                            data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Products</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Discount</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Total Stock</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Time Status</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $flashSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flashSale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    ?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="flashsale-<?php echo e($flashSale->id); ?>">
                                                <label class="custom-control-label"
                                                    for="flashsale-<?php echo e($flashSale->id); ?>"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar <?php echo e($avatarClass); ?> d-none d-sm-flex">
                                                    <em class="icon ni ni-hot-fill"></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead"><?php echo e($flashSale->title); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <?php if($flashSale->products && $flashSale->products->count() > 0): ?>
                                                <?php $__currentLoopData = $flashSale->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $truncatedTitle = strlen($product->title) > 45 ? substr($product->title, 0, 45) . '...' : $product->title;
                                                    ?>
                                                    <span
                                                        class="badge badge-dot bg-primary me-1"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="<?php echo e($product->title); ?>"><?php echo e($truncatedTitle); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <span class="badge badge-dim bg-outline-secondary">No Products</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <?php if($flashSale->products && $flashSale->products->count() > 0): ?>
                                                <div class="d-flex flex-column">
                                                    <span
                                                        class="fw-bold text-<?php echo e($flashSale->discount_type === 'percentage' ? 'success' : 'info'); ?>">
                                                        <?php echo e($flashSale->getDiscountTypeLabel()); ?>:
                                                        <?php if($flashSale->discount_type === 'percentage'): ?>
                                                            <?php echo e($flashSale->discount_value); ?>%
                                                        <?php else: ?>
                                                            <?php echo e(number_format($flashSale->discount_value, 2)); ?> DJF
                                                        <?php endif; ?>
                                                    </span>
                                                    <small class="text-muted">Applied to all products</small>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <?php if($flashSale->products && $flashSale->products->count() > 0): ?>
                                                <span class="fw-bold"><?php echo e($flashSale->getTotalStock()); ?></span>
                                                <small class="text-muted d-block">Total from
                                                    <?php echo e($flashSale->products->count()); ?> product(s)</small>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <?php
                                                $now = now();
                                                $start = $flashSale->start_at;
                                                $end = $flashSale->end_at;
                                                $timeLeft = '';
                                                $timeColor = 'text-muted';
                                                
                                                if ($now < $start) {
                                                    // Flash sale hasn't started yet
                                                    $diff = $start->diff($now);
                                                    $timeLeft = 'Starts in ';
                                                    $timeColor = 'text-info';
                                                } elseif ($now >= $start && $now < $end) {
                                                    // Flash sale is active
                                                    $diff = $end->diff($now);
                                                    $timeLeft = 'Ends in ';
                                                    $timeColor = 'text-success';
                                                } else {
                                                    // Flash sale has ended
                                                    $timeLeft = 'Ended';
                                                    $timeColor = 'text-danger';
                                                }
                                                
                                                if (isset($diff)) {
                                                    if ($diff->days > 0) {
                                                        $timeLeft .= $diff->days . 'd ';
                                                    }
                                                    if ($diff->h > 0) {
                                                        $timeLeft .= $diff->h . 'h ';
                                                    }
                                                    if ($diff->i > 0) {
                                                        $timeLeft .= $diff->i . 'm';
                                                    }
                                                    if ($diff->days == 0 && $diff->h == 0 && $diff->i == 0) {
                                                        $timeLeft .= 'Less than 1m';
                                                    }
                                                }
                                            ?>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold <?php echo e($timeColor); ?>"><?php echo e($timeLeft); ?></span>
                                                <small class="text-muted"><?php echo e($flashSale->start_at->format('M d')); ?> - <?php echo e($flashSale->end_at->format('M d, Y')); ?></small>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span
                                                class="tb-status text-<?php echo e($flashSale->getStatusColor()); ?>"><?php echo e($flashSale->getStatusLabel()); ?></span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="<?php echo e(route('seller.flash-sales.show', $flashSale->slug)); ?>"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="<?php echo e(route('seller.flash-sales.edit', $flashSale->slug)); ?>"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-flashsale-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteFlashSaleModal"
                                                        data-slug="<?php echo e($flashSale->slug); ?>"
                                                        data-name="<?php echo e($flashSale->title); ?>"
                                                        data-delete-url="<?php echo e(route('seller.flash-sales.destroy', $flashSale->slug)); ?>"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <!-- Empty state handled in tfoot -->
                                <?php endif; ?>
                            </tbody>
                            <?php if($flashSales->count() == 0): ?>
                                <tfoot>
                                    <tr>
                                        <td colspan="8" class="text-center p-4">
                                            <div class="py-4">
                                                <div class="mb-3">
                                                    <em class="icon ni ni-hot-fill"
                                                        style="font-size: 3rem; color: #c4c4c4;"></em>
                                                </div>
                                                <h6 class="text-muted">No flash sales found</h6>
                                                <p class="text-muted small">Start by adding your first flash sale using the
                                                    "Add Flash Sale" button above.</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                    </div>
                </div><!-- .card-preview -->

                <!-- Pagination Links -->
                <div class="mt-3">
                    <?php echo e($flashSales->links()); ?>

                </div>
            </div> <!-- nk-block -->
        </div>
    </div>

    
    <div class="modal fade" id="editFlashSaleModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Flash Sale</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editFlashSaleForm" class="form-validate is-alter">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <input type="hidden" name="id" id="edit-flashsale-id">
                        <input type="hidden" name="redirect_to" value="index">

                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-flashsale-title">Flash Sale Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control <?php $__errorArgs = ['title', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-title" name="title" value="<?php echo e(old('title')); ?>"
                                            required>
                                    </div>
                                    <?php $__errorArgs = ['title', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-product">Product</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 <?php $__errorArgs = ['product_id', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-product" name="product_id"
                                            data-placeholder="Select Product" required>
                                            <option value=""></option>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($product->id); ?>"
                                                    data-price="<?php echo e($product->price_regular); ?>">
                                                    <?php echo e($product->title); ?> (<?php echo e($product->price_regular); ?> DJF)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['product_id', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-discount-price">Discount Price</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control <?php $__errorArgs = ['discount_price', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-discount-price" name="discount_price"
                                            value="<?php echo e(old('discount_price')); ?>" required step="0.01" min="0">
                                    </div>
                                    <div class="form-note">Must be less than the regular product price.</div>
                                    <?php $__errorArgs = ['discount_price', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-stock-limit">Stock Limit</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control <?php $__errorArgs = ['stock_limit', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-stock-limit" name="stock_limit"
                                            value="<?php echo e(old('stock_limit')); ?>" required min="1">
                                    </div>
                                    <?php $__errorArgs = ['stock_limit', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-start-at">Start Date & Time</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local"
                                            class="form-control <?php $__errorArgs = ['start_at', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-start-at" name="start_at" value="<?php echo e(old('start_at')); ?>"
                                            required>
                                    </div>
                                    <?php $__errorArgs = ['start_at', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-end-at">End Date & Time</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local"
                                            class="form-control <?php $__errorArgs = ['end_at', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-end-at" name="end_at" value="<?php echo e(old('end_at')); ?>"
                                            required>
                                    </div>
                                    <?php $__errorArgs = ['end_at', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-usage-limit">Usage Limit Per User
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control <?php $__errorArgs = ['usage_limit_per_user', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-usage-limit" name="usage_limit_per_user"
                                            value="<?php echo e(old('usage_limit_per_user')); ?>" min="1">
                                    </div>
                                    <div class="form-note">Leave blank for unlimited usage per user.</div>
                                    <?php $__errorArgs = ['usage_limit_per_user', 'update'];
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
                                    <label class="form-label" for="edit-flashsale-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 <?php $__errorArgs = ['status', 'update'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="edit-flashsale-status" name="status" required>
                                            <?php $__currentLoopData = App\Models\FlashSale::getStatusOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value); ?>" <?php if(old('status') == $value): echo 'selected'; endif; ?>>
                                                    <?php echo e($label); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['status', 'update'];
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
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                        id="updateFlashSaleBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Update Flash Sale</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the flash sale.</span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteFlashSaleModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Flash Sale</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-flashsale-title"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteFlashSaleForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .dataTables_empty {
            padding: 1rem;
        }

        .user-avatar em {
            font-size: 1.2rem;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Initialize Select2 dropdowns for edit modal
            if ($.fn.select2) {
                $('#edit-flashsale-status').select2({
                    width: '100%',
                    minimumResultsForSearch: -1 // Disable search for status
                });
            }

            // Delete flash sale handling
            $(document).on('click', '.delete-flashsale-button', function() {
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-flashsale-title').text(name);
                $('#deleteFlashSaleForm').attr('action', deleteUrl);
            });

            $('#confirmDeleteBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteFlashSaleForm').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/seller/flash-sales/index.blade.php ENDPATH**/ ?>