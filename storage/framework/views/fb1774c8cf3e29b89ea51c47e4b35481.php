
<?php $__env->startSection('title', 'Category Ads Management'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .ad-image {
            border-radius: .3rem !important;
            background: none !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Category Ads Management</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Category Ads</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <a href="<?php echo e(route('admin.category-ads.create')); ?>"
                            class="btn btn-outline-primary d-none d-sm-inline-flex">
                            <em class="icon ni ni-plus"></em><span>Add Ad</span>
                        </a>
                        <a href="<?php echo e(route('admin.category-ads.create')); ?>"
                            class="btn btn-icon btn-outline-primary d-inline-flex d-sm-none">
                            <em class="icon ni ni-plus"></em>
                        </a>
                    </div>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Category Ads</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage category advertisements.</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card card-bordered">
                    <div class="card-inner border-bottom">
                        <div class="row g-3">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <input type="text" class="form-control" id="searchInput"
                                            placeholder="Search ads..." value="<?php echo e(request('search')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select class="form-select js-select2" id="categoryFilter"
                                        data-placeholder="All Categories">
                                        <option value="">All Categories</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"
                                                <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                                <?php echo e($category->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select class="form-select" id="statusFilter">
                                        <option value="">All Status</option>
                                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active
                                        </option>
                                        <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select class="form-select" id="sortBy">
                                        <option value="created_at"
                                            <?php echo e(request('sort_by') == 'created_at' ? 'selected' : ''); ?>>Date Created</option>
                                        <option value="position" <?php echo e(request('sort_by') == 'position' ? 'selected' : ''); ?>>
                                            Position</option>
                                        <option value="starts_at"
                                            <?php echo e(request('sort_by') == 'starts_at' ? 'selected' : ''); ?>>Start Date</option>
                                        <option value="ends_at" <?php echo e(request('sort_by') == 'ends_at' ? 'selected' : ''); ?>>End
                                            Date</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" id="applyFilters">
                                        <em class="icon ni ni-filter-alt"></em>&nbsp;Apply Filters
                                    </button>
                                    <button type="button" class="btn btn-light" id="clearFilters">
                                        <em class="icon ni ni-cross"></em>&nbsp;Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Category Ad</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Position</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Duration</span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Created</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $categoryAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                        $isActive = $ad->active && $ad->starts_at <= now() && $ad->ends_at >= now();
                                    ?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="ad-<?php echo e($ad->id); ?>">
                                                <label class="custom-control-label" for="ad-<?php echo e($ad->id); ?>"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar ad-image-container"
                                                    style="width: 60px; height: 40px; border-radius: 8px; overflow: hidden; flex-shrink: 0; position: relative;">
                                                    <!-- Skeleton loading placeholder -->
                                                    <div class="ad-skeleton"
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite;">
                                                    </div>

                                                    <?php if($ad->image_path): ?>
                                                        <img src="<?php echo e($ad->image_url); ?>" alt="Category Ad"
                                                            class="ad-image"
                                                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 0.3s ease;"
                                                            loading="lazy"
                                                            onload="this.style.opacity='1'; this.parentElement.querySelector('.ad-skeleton').style.display='none';"
                                                            onerror="this.src='<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>'; this.style.opacity='1'; this.style.filter='grayscale(100%)'; this.parentElement.querySelector('.ad-skeleton').style.display='none';" />
                                                    <?php else: ?>
                                                        <div
                                                            style="width: 100%; height: 100%; border: 2px dashed #dee2e6; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                                            <em class="icon ni ni-img"
                                                                style="color: #8392a5; font-size: 16px;"></em>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead"><?php echo e($ad->category->name); ?></span>
                                                    <span class="tb-sub"><?php echo e($ad->category->slug); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span class="badge badge-dot bg-primary">Position <?php echo e($ad->position); ?></span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <div class="custom-control custom-control-sm custom-switch">
                                                <input type="checkbox" class="custom-control-input status-toggle"
                                                    id="status-<?php echo e($ad->id); ?>" data-ad-id="<?php echo e($ad->id); ?>"
                                                    <?php echo e($isActive ? 'checked' : ''); ?>>
                                                <label class="custom-control-label" for="status-<?php echo e($ad->id); ?>">
                                                    <span
                                                        class="badge badge-dot bg-<?php echo e($isActive ? 'success' : 'danger'); ?>">
                                                        <?php echo e($isActive ? 'Active' : 'Inactive'); ?>

                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <div class="tb-lead-sub">
                                                <?php if($ad->starts_at): ?>
                                                    <div class="badge badge-sm badge-outline-primary"
                                                        style="color:inherit">
                                                        <strong>Start:</strong> <?php echo e($ad->starts_at->format('M d, Y')); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <?php if($ad->ends_at): ?>
                                                    <div class="badge badge-sm badge-outline-danger"
                                                        style="color:inherit">
                                                        <strong>End:</strong> <?php echo e($ad->ends_at->format('M d, Y')); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!$ad->starts_at && !$ad->ends_at): ?>
                                                    <span class="text-soft">No dates set</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span class="tb-sub"><?php echo e($ad->created_at->format('M d, Y')); ?></span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="<?php echo e(route('admin.category-ads.show', $ad)); ?>"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="<?php echo e(route('admin.category-ads.edit', $ad)); ?>"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <a href="<?php echo e($ad->link_url); ?>" target="_blank"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Visit Link">
                                                        <em class="icon ni ni-external"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger remove-ad-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteAdModal"
                                                        data-id="<?php echo e($ad->id); ?>"
                                                        data-name="<?php echo e($ad->category->name); ?>" data-bs-placement="top"
                                                        title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check"></td>
                                        <td class="nk-tb-col text-center" colspan="6">
                                            <span class="text-soft">No category ads found.</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools"></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->

                <?php if($categoryAds->count() > 0): ?>
                    <div class="card card-bordered">
                        <div class="card-inner text-center">
                            <span class="text-soft">Total: <?php echo e($categoryAds->count()); ?> category ads</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>

    <!-- Delete Category Ad Modal -->
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
                    <p>Are you sure you want to delete this ad for <strong id="deleteAdCategory"></strong>?</p>
                    <p class="text-soft">This action cannot be undone and will remove the ad image from storage.</p>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteAdForm" method="POST" style="display: inline;">
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
            // Apply filters
            $('#applyFilters').on('click', function() {
                const search = $('#searchInput').val();
                const categoryId = $('#categoryFilter').val();
                const status = $('#statusFilter').val();
                const sortBy = $('#sortBy').val();

                const params = new URLSearchParams();
                if (search) params.append('search', search);
                if (categoryId) params.append('category_id', categoryId);
                if (status) params.append('status', status);
                if (sortBy) params.append('sort_by', sortBy);

                window.location.href = '<?php echo e(route('admin.category-ads.index')); ?>?' + params.toString();
            });

            // Clear filters
            $('#clearFilters').on('click', function() {
                window.location.href = '<?php echo e(route('admin.category-ads.index')); ?>';
            });

            // Search on enter key
            $('#searchInput').on('keypress', function(e) {
                if (e.key === 'Enter') {
                    $('#applyFilters').click();
                }
            });

            // Status toggle
            $('.status-toggle').on('change', function() {
                const adId = $(this).data('ad-id');
                const active = $(this).is(':checked');
                const $toggle = $(this);
                const $badge = $(this).parent().find('.badge');

                $.ajax({
                    url: `<?php echo e(route('admin.category-ads.index')); ?>/${adId}/status`,
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    data: JSON.stringify({
                        'active': active
                    }),
                    success: function(response) {
                        if (response.success) {
                            $badge.removeClass('bg-success bg-danger')
                                .addClass(active ? 'bg-success' : 'bg-danger')
                                .text(active ? 'Active' : 'Inactive');

                            console.log('Status updated successfully');
                        } else {
                            // Revert toggle
                            $toggle.prop('checked', !active);
                            alert('Failed to update status: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Revert toggle
                        $toggle.prop('checked', !active);
                        console.error('AJAX Error:', xhr.responseText);
                        alert('An error occurred while updating status.');
                    }
                });
            });

            // Delete ad button click
            $(document).on('click', '.remove-ad-button', function() {
                var adId = $(this).data('id');
                var categoryName = $(this).data('name');

                $('#deleteAdCategory').text(categoryName);
                $('#deleteAdForm').attr('action', `/admin/category-ads/${adId}`);
            });

            // Form submission with loading state
            $('#deleteAdForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Deleting...');
                return true;
            });

            // Reset delete modal when closed
            $('#deleteAdModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('#deleteAdForm .submit-btn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Delete Ad');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/admin/category-ads/index.blade.php ENDPATH**/ ?>