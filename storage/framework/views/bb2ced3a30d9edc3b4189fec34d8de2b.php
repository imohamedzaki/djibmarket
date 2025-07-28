
<?php $__env->startSection('title', 'Category Ad Details'); ?>

<?php $__env->startSection('style'); ?>
    <style>
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .ad-image-container {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .ad-image-container:hover {
            transform: scale(1.02);
        }

        .ad-info-card {
            transition: box-shadow 0.3s ease;
        }

        .ad-info-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Category Ad Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.category-ads.index')); ?>">Category
                                        Ads</a></li>
                                <li class="breadcrumb-item active"><?php echo e($categoryAd->category->name); ?></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="<?php echo e(route('admin.category-ads.edit', $categoryAd)); ?>"
                            class="btn btn-outline-primary d-none d-sm-inline-flex">
                            <em class="icon ni ni-edit"></em><span>Edit Ad</span>
                        </a>
                        <a href="<?php echo e(route('admin.category-ads.edit', $categoryAd)); ?>"
                            class="btn btn-icon btn-outline-primary d-inline-flex d-sm-none">
                            <em class="icon ni ni-edit"></em>
                        </a>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="row g-gs">
                    <!-- Ad Information -->
                    <div class="col-xxl-8">
                        <div class="card card-bordered ad-info-card">
                            <div class="card-inner">
                                <div class="row g-5">
                                    <div class="col-lg-5">
                                        <div class="ad-image-container">
                                            <div class="user-avatar sq"
                                                style="width: 100%; min-height: 300px; border-radius: 12px; position: relative; margin: 0 auto;">
                                                <!-- Skeleton loading placeholder -->
                                                <div class="ad-skeleton" id="imageSkeleton"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; border-radius: 12px;">
                                                </div>

                                                <?php if($categoryAd->image_path): ?>
                                                    <img src="<?php echo e($categoryAd->image_path); ?>"
                                                        alt="<?php echo e($categoryAd->category->name); ?> Ad" id="adImage"
                                                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px; border: 1px solid #e5e9f2;"
                                                        onload="document.getElementById('imageSkeleton').style.display='none';"
                                                        onerror="this.src='<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>'; this.style.filter='grayscale(100%)'; document.getElementById('imageSkeleton').style.display='none';" />
                                                <?php else: ?>
                                                    <div
                                                        style="width: 100%; height: 100%; border: 2px dashed #dee2e6; border-radius: 12px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                                        <div class="text-center">
                                                            <em class="icon ni ni-img"
                                                                style="color: #8392a5; font-size: 48px;"></em>
                                                            <p class="text-soft mt-2">No image uploaded</p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <?php if($categoryAd->link_url): ?>
                                                <div class="text-center mt-3">
                                                    <a href="<?php echo e($categoryAd->link_url); ?>" target="_blank"
                                                        class="btn btn-outline-primary">
                                                        <em class="icon ni ni-external"></em>&nbsp;Visit Link
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="ad-details">
                                            <h4 class="title"><?php echo e($categoryAd->category->name); ?> Ad</h4>
                                            <p class="text-soft">Position <?php echo e($categoryAd->position); ?></p>

                                            <div class="row g-3 mt-4">
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Category</span>
                                                    <div class="mt-1">
                                                        <span
                                                            class="badge badge-dim bg-primary"><?php echo e($categoryAd->category->name); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Position</span>
                                                    <div class="mt-1">
                                                        <span class="lead-text"><?php echo e($categoryAd->position); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Status</span>
                                                    <div class="mt-1">
                                                        <?php
                                                            $isActive =
                                                                $categoryAd->active &&
                                                                $categoryAd->starts_at <= now() &&
                                                                $categoryAd->ends_at >= now();
                                                        ?>
                                                        <span
                                                            class="badge badge-dot bg-<?php echo e($isActive ? 'success' : 'danger'); ?>">
                                                            <?php echo e($isActive ? 'Active' : 'Inactive'); ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Created Date</span>
                                                    <div class="mt-1">
                                                        <span
                                                            class="sub-text"><?php echo e($categoryAd->created_at->format('M d, Y')); ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <span class="sub-text">Duration</span>
                                                <div class="mt-2">
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <div class="badge badge-outline-primary">
                                                                <strong>Start:</strong>
                                                                <?php echo e($categoryAd->starts_at->format('M d, Y')); ?>

                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="badge badge-outline-danger">
                                                                <strong>End:</strong>
                                                                <?php echo e($categoryAd->ends_at->format('M d, Y')); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if($categoryAd->link_url): ?>
                                                <div class="mt-4">
                                                    <span class="sub-text">Link URL</span>
                                                    <p class="mt-2">
                                                        <a href="<?php echo e($categoryAd->link_url); ?>" target="_blank"
                                                            class="link link-primary text-break">
                                                            <?php echo e($categoryAd->link_url); ?>

                                                        </a>
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions & Information -->
                    <div class="col-xxl-4">
                        <!-- Actions Card -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h6 class="title">Actions</h6>
                                <div class="d-flex flex-column mt-3" style="gap: .6rem;">
                                    <a href="<?php echo e(route('admin.category-ads.edit', $categoryAd)); ?>"
                                        class="btn btn-outline-primary">
                                        <em class="icon ni ni-edit"></em>&nbsp;Edit Ad
                                    </a>

                                    <?php if($categoryAd->link_url): ?>
                                        <a href="<?php echo e($categoryAd->link_url); ?>" target="_blank" class="btn btn-outline-info">
                                            <em class="icon ni ni-external"></em>&nbsp;Visit Link
                                        </a>
                                    <?php endif; ?>

                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteAdModal">
                                        <em class="icon ni ni-trash"></em>&nbsp;Delete Ad
                                    </button>

                                    <a href="<?php echo e(route('admin.category-ads.index')); ?>" class="btn btn-light">
                                        <em class="icon ni ni-arrow-left"></em>&nbsp;Back to List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Status Card -->
                        <div class="card card-bordered mt-3">
                            <div class="card-inner">
                                <h6 class="title">Status Information</h6>
                                <div class="mt-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <span class="sub-text">Current Status</span>
                                            <div class="mt-1">
                                                <?php
                                                    $isActive =
                                                        $categoryAd->active &&
                                                        $categoryAd->starts_at <= now() &&
                                                        $categoryAd->ends_at >= now();
                                                ?>
                                                <span class="badge badge-<?php echo e($isActive ? 'success' : 'danger'); ?>">
                                                    <?php echo e($isActive ? 'Active' : 'Inactive'); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="sub-text">Database Status</span>
                                            <div class="mt-1">
                                                <span class="badge badge-<?php echo e($categoryAd->active ? 'info' : 'light'); ?>">
                                                    <?php echo e($categoryAd->active ? 'Enabled' : 'Disabled'); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <span class="sub-text">Days Remaining</span>
                                            <div class="mt-1">
                                                <?php
                                                    $daysRemaining = $categoryAd->ends_at->diffInDays(now());
                                                    $badgeClass =
                                                        $daysRemaining > 7
                                                            ? 'success'
                                                            : ($daysRemaining > 3
                                                                ? 'warning'
                                                                : 'danger');
                                                ?>
                                                <span class="badge badge-<?php echo e($badgeClass); ?>">
                                                    <?php echo e($daysRemaining); ?> days
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image Information -->
                        <div class="card card-bordered mt-3">
                            <div class="card-inner">
                                <h6 class="title">Image Information</h6>
                                <div class="mt-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <span class="sub-text">Image Source</span>
                                            <div class="mt-1">
                                                <?php if($categoryAd->image_path): ?>
                                                    <?php if(filter_var($categoryAd->image_path, FILTER_VALIDATE_URL)): ?>
                                                        <span class="badge badge-info">External URL</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-success">Local File</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="badge badge-light">No Image</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if($categoryAd->image_path): ?>
                                            <div class="col-12">
                                                <span class="sub-text">Image Path</span>
                                                <div class="mt-1">
                                                    <small class="text-break"><?php echo e($categoryAd->image_path); ?></small>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Ad Modal -->
    <div class="modal fade" id="deleteAdModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Category Ad</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this ad for <strong><?php echo e($categoryAd->category->name); ?></strong>?</p>
                    <p class="text-soft">This action cannot be undone and will also remove the ad image from storage.</p>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="<?php echo e(route('admin.category-ads.destroy', $categoryAd)); ?>" method="POST"
                            style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger submit-btn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Delete Ad</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // Form submission with loading state
            $('.submit-btn').on('click', function() {
                var $submitBtn = $(this);
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Deleting...');
                return true;
            });

            // Reset modal when closed
            $('#deleteAdModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('.submit-btn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Delete Ad');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/admin/category-ads/show.blade.php ENDPATH**/ ?>