

<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <div>
                <h1>My Wishlist</h1>
                <p>Keep track of products you love and want to buy later.</p>
            </div>
            <div class="wishlist-stats">
                <span class="wishlist-count"><?php echo e($wishlistItems->count()); ?>

                    <?php echo e(Str::plural('item', $wishlistItems->count())); ?></span>
            </div>
        </div>
    </div>

    <?php if($wishlistItems->count() > 0): ?>
        <!-- Wishlist Actions Bar -->
        <div class="wishlist-actions-bar">
            <div class="actions-left">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="selectAll()">
                    <i class="fas fa-check-square me-1"></i>
                    Select All
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeSelected()"
                    id="remove-selected-btn" disabled>
                    <i class="fas fa-trash me-1"></i>
                    Remove Selected
                </button>
            </div>
            <div class="actions-right">
                <div class="view-toggle">
                    <button type="button" class="view-btn active" data-view="grid" onclick="switchView('grid')">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button type="button" class="view-btn" data-view="list" onclick="switchView('list')">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Wishlist Grid -->
        <div class="wishlist-container" id="wishlist-container">
            <div class="wishlist-grid" id="wishlist-grid">
                <?php $__currentLoopData = $wishlistItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlistItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="wishlist-card" data-wishlist-id="<?php echo e($wishlistItem->id); ?>">
                        <div class="wishlist-card-header">
                            <div class="card-checkbox">
                                <input type="checkbox" class="wishlist-checkbox" value="<?php echo e($wishlistItem->id); ?>"
                                    onchange="updateActions()">
                            </div>
                            <div class="card-actions">
                                <button type="button" class="action-btn action-btn-danger"
                                    onclick="removeFromWishlist(<?php echo e($wishlistItem->id); ?>, '<?php echo e($wishlistItem->product->title ?? 'this item'); ?>')"
                                    title="Remove from wishlist">
                                    <i class="fas fa-heart-broken"></i>
                                </button>
                            </div>
                        </div>

                        <div class="product-image-container">
                            <?php if($wishlistItem->product): ?>
                                <div class="product-image">
                                    <img src="<?php echo e($wishlistItem->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg')); ?>"
                                        alt="<?php echo e($wishlistItem->product->title); ?>"
                                        onerror="this.src='<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>'">
                                    <div class="product-overlay">
                                        <a href="<?php echo e(route('buyer.product.show', $wishlistItem->product)); ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i>
                                            View Product
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="product-image-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Product no longer available</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="product-content">
                            <?php if($wishlistItem->product): ?>
                                <h3 class="product-title">
                                    <a href="<?php echo e(route('buyer.product.show', $wishlistItem->product)); ?>">
                                        <?php echo e($wishlistItem->product->title); ?>

                                    </a>
                                </h3>

                                <div class="product-pricing">
                                    <?php if($wishlistItem->product->price_discounted > 0): ?>
                                        <div class="price-group">
                                            <span
                                                class="price-current"><?php echo e(number_format($wishlistItem->product->price_discounted, 0)); ?>

                                                DJF</span>
                                            <span
                                                class="price-original"><?php echo e(number_format($wishlistItem->product->price_regular, 0)); ?>

                                                DJF</span>
                                            <span class="price-discount">
                                                -<?php echo e(round((($wishlistItem->product->price_regular - $wishlistItem->product->price_discounted) / $wishlistItem->product->price_regular) * 100)); ?>%
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <div class="price-group">
                                            <span
                                                class="price-current"><?php echo e(number_format($wishlistItem->product->price_regular, 0)); ?>

                                                DJF</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if($wishlistItem->product->category): ?>
                                    <div class="product-category">
                                        <i class="fas fa-tag me-1"></i>
                                        <?php echo e($wishlistItem->product->category->name); ?>

                                    </div>
                                <?php endif; ?>

                                <div class="product-meta">
                                    <span class="added-date">
                                        <i class="fas fa-calendar-plus me-1"></i>
                                        Added <?php echo e($wishlistItem->created_at->diffForHumans()); ?>

                                    </span>
                                </div>
                            <?php else: ?>
                                <h3 class="product-title product-unavailable">Product no longer available</h3>
                                <div class="product-meta">
                                    <span class="added-date">
                                        <i class="fas fa-calendar-plus me-1"></i>
                                        Added <?php echo e($wishlistItem->created_at->diffForHumans()); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="product-actions">
                            <?php if($wishlistItem->product): ?>
                                <button type="button" class="btn btn-primary btn-sm add-to-cart-btn"
                                    data-product-id="<?php echo e($wishlistItem->product->id); ?>">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    Add to Cart
                                </button>
                                <a href="<?php echo e(route('buyer.product.show', $wishlistItem->product)); ?>"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    View
                                </a>
                            <?php else: ?>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="removeFromWishlist(<?php echo e($wishlistItem->id); ?>, 'this item')">
                                    <i class="fas fa-trash me-1"></i>
                                    Remove
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="wishlist-pagination">
                <?php echo e($wishlistItems->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="empty-state-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="empty-state-title">Your wishlist is empty</h3>
                <p class="empty-state-text">Save items you love to your wishlist and never lose track of them!</p>
                <a href="<?php echo e(route('buyer.home')); ?>" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Start Shopping
                </a>
            </div>
        </div>
    <?php endif; ?>

    <style>
        .dashboard-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }

        .wishlist-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .wishlist-count {
            background: var(--light-color);
            color: var(--text-secondary);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Actions Bar */
        .wishlist-actions-bar {
            background: var(--white-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
        }

        .actions-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .actions-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .view-toggle {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .view-btn {
            background: var(--white-color);
            border: none;
            padding: 0.5rem 0.75rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
            border-right: 1px solid var(--border-color);
        }

        .view-btn:last-child {
            border-right: none;
        }

        .view-btn:hover {
            background: var(--light-color);
            color: var(--text-primary);
        }

        .view-btn.active {
            background: var(--primary-color);
            color: white;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            text-decoration: none;
        }

        .btn-outline-primary {
            background: transparent;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        .btn-outline-secondary {
            background: transparent;
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        .btn-outline-secondary:hover {
            background: var(--light-color);
            color: var(--text-primary);
            text-decoration: none;
        }

        .btn-outline-danger {
            background: transparent;
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .btn-outline-danger:hover {
            background: var(--danger-color);
            color: white;
            text-decoration: none;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Wishlist Grid */
        .wishlist-container {
            background: var(--white-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .wishlist-grid.list-view {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .wishlist-card {
            background: var(--white-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
        }

        .wishlist-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .wishlist-card-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0.75rem;
        }

        .card-checkbox {
            background: rgba(255, 255, 255, 0.9);
            border-radius: var(--radius-sm);
            padding: 0.25rem;
            backdrop-filter: blur(4px);
        }

        .wishlist-checkbox {
            width: 16px;
            height: 16px;
            accent-color: var(--primary-color);
        }

        .card-actions {
            display: flex;
            gap: 0.25rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
        }

        .action-btn-danger {
            color: var(--danger-color);
        }

        .action-btn-danger:hover {
            background: var(--danger-color);
            color: white;
        }

        /* Product Image */
        .product-image-container {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .wishlist-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .wishlist-card:hover .product-overlay {
            opacity: 1;
        }

        .product-image-placeholder {
            width: 100%;
            height: 100%;
            background: var(--light-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-align: center;
        }

        .product-image-placeholder i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .product-image-placeholder p {
            margin: 0;
            font-size: 0.875rem;
        }

        /* Product Content */
        .product-content {
            padding: 1.25rem;
            flex: 1;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        .product-unavailable {
            color: var(--text-secondary);
        }

        .product-pricing {
            margin-bottom: 0.75rem;
        }

        .price-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .price-current {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .price-original {
            font-size: 0.875rem;
            color: var(--text-secondary);
            text-decoration: line-through;
        }

        .price-discount {
            background: var(--danger-color);
            color: white;
            padding: 0.125rem 0.375rem;
            border-radius: var(--radius-sm);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .product-category {
            color: var(--text-secondary);
            font-size: 0.75rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }

        .product-meta {
            margin-bottom: 1rem;
        }

        .added-date {
            color: var(--text-secondary);
            font-size: 0.75rem;
            display: flex;
            align-items: center;
        }

        /* Product Actions */
        .product-actions {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--border-color);
            background: var(--light-color);
            display: flex;
            gap: 0.5rem;
        }

        .product-actions .btn {
            flex: 1;
        }

        /* List View */
        .wishlist-grid.list-view .wishlist-card {
            display: flex;
            align-items: stretch;
        }

        .wishlist-grid.list-view .product-image-container {
            width: 200px;
            height: 150px;
            flex-shrink: 0;
        }

        .wishlist-grid.list-view .product-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .wishlist-grid.list-view .product-actions {
            width: 200px;
            flex-direction: column;
            justify-content: center;
            border-left: 1px solid var(--border-color);
            border-top: none;
            background: var(--white-color);
        }

        /* Pagination */
        .wishlist-pagination {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: center;
        }

        /* Empty State */
        .empty-state-card {
            background: var(--white-color);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
        }

        .empty-state-text {
            color: var(--text-secondary);
            margin: 0 0 2rem 0;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .wishlist-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
                padding: 1rem;
            }

            .dashboard-header-content {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .wishlist-actions-bar {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .actions-left,
            .actions-right {
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .wishlist-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1rem;
            }

            .wishlist-grid.list-view .wishlist-card {
                flex-direction: column;
            }

            .wishlist-grid.list-view .product-image-container {
                width: 100%;
                height: 200px;
            }

            .wishlist-grid.list-view .product-actions {
                width: 100%;
                flex-direction: row;
                border-left: none;
                border-top: 1px solid var(--border-color);
            }

            .product-actions {
                flex-direction: column;
            }

            .actions-left {
                flex-wrap: wrap;
            }
        }
    </style>

    <script>
        // View switching functionality
        function switchView(view) {
            const gridContainer = document.getElementById('wishlist-grid');
            const viewButtons = document.querySelectorAll('.view-btn');

            // Update active button
            viewButtons.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.view === view);
            });

            // Update grid class
            if (view === 'list') {
                gridContainer.classList.add('list-view');
            } else {
                gridContainer.classList.remove('list-view');
            }
        }

        // Selection functionality
        function selectAll() {
            const checkboxes = document.querySelectorAll('.wishlist-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);

            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });

            updateActions();
        }

        function updateActions() {
            const checkedBoxes = document.querySelectorAll('.wishlist-checkbox:checked');
            const removeBtn = document.getElementById('remove-selected-btn');

            removeBtn.disabled = checkedBoxes.length === 0;
            removeBtn.textContent = checkedBoxes.length > 0 ?
                `Remove Selected (${checkedBoxes.length})` :
                'Remove Selected';
        }

        function removeSelected() {
            const checkedBoxes = document.querySelectorAll('.wishlist-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            if (ids.length === 0) return;

            showCustomDialog({
                title: 'Remove Selected Items',
                message: `Are you sure you want to remove ${ids.length} item(s) from your wishlist?`,
                confirmText: 'Remove Items',
                cancelText: 'Cancel',
                type: 'warning',
                onConfirm: function() {
                    performBulkRemove(ids);
                }
            });
        }

        function performBulkRemove(ids) {
            // Here you would make AJAX requests to remove multiple items
            ids.forEach(id => {
                const card = document.querySelector(`[data-wishlist-id="${id}"]`);
                if (card) {
                    card.style.transform = 'scale(0.8)';
                    card.style.opacity = '0';
                    setTimeout(() => card.remove(), 300);
                }
            });

            updateActions();
            showToast(`Removed ${ids.length} item(s) from wishlist`, 'success');
        }

        // Add to cart functionality
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.productId;
                    const originalText = this.innerHTML;

                    // Disable button and show loading
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Adding...';

                    // Make AJAX request to add to cart
                    fetch('<?php echo e(route('cart.add')); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: 1
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.innerHTML = '<i class="fas fa-check me-1"></i>Added!';
                                this.classList.remove('btn-primary');
                                this.classList.add('btn-success');

                                showToast('Product added to cart successfully!', 'success');

                                setTimeout(() => {
                                    this.innerHTML = originalText;
                                    this.classList.remove('btn-success');
                                    this.classList.add('btn-primary');
                                    this.disabled = false;
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Failed to add to cart');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.innerHTML =
                                '<i class="fas fa-exclamation-triangle me-1"></i>Error';
                            this.classList.remove('btn-primary');
                            this.classList.add('btn-danger');

                            showToast('Failed to add product to cart. Please try again.',
                                'error');

                            setTimeout(() => {
                                this.innerHTML = originalText;
                                this.classList.remove('btn-danger');
                                this.classList.add('btn-primary');
                                this.disabled = false;
                            }, 2000);
                        });
                });
            });
        });

        // Remove from wishlist functionality
        function removeFromWishlist(wishlistId, productTitle) {
            showCustomDialog({
                title: 'Remove from Wishlist',
                message: `Are you sure you want to remove "${productTitle}" from your wishlist?`,
                confirmText: 'Remove',
                cancelText: 'Cancel',
                type: 'warning',
                onConfirm: function() {
                    performRemoveFromWishlist(wishlistId);
                }
            });
        }

        function performRemoveFromWishlist(wishlistId) {
            // Make AJAX request to remove from wishlist
            fetch(`/buyer/dashboard/wishlist/${wishlistId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showToast('Item removed from wishlist successfully!', 'success');

                        // Remove the wishlist card with animation
                        const wishlistCard = document.querySelector(`[data-wishlist-id="${wishlistId}"]`);
                        if (wishlistCard) {
                            wishlistCard.style.transform = 'scale(0.8)';
                            wishlistCard.style.opacity = '0';
                            setTimeout(() => {
                                wishlistCard.remove();
                                // Check if wishlist is empty and reload if needed
                                if (document.querySelectorAll('.wishlist-card').length === 0) {
                                    location.reload();
                                }
                            }, 300);
                        }
                    } else {
                        throw new Error(data.message || 'Failed to remove item from wishlist');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Failed to remove item from wishlist. Please try again.', 'error');
                });
        }

        function showCustomDialog(options) {
            const {
                title = 'Confirm',
                    message = 'Are you sure?',
                    confirmText = 'Confirm',
                    cancelText = 'Cancel',
                    type = 'info',
                    onConfirm = () => {},
                    onCancel = () => {}
            } = options;

            // Remove existing dialogs
            document.querySelectorAll('.custom-dialog-overlay').forEach(dialog => dialog.remove());

            // Create dialog overlay
            const overlay = document.createElement('div');
            overlay.className = 'custom-dialog-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;

            // Create dialog box
            const dialog = document.createElement('div');
            dialog.className = 'custom-dialog';
            dialog.style.cssText = `
                background: white;
                border-radius: 12px;
                padding: 0;
                max-width: 400px;
                width: 90%;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                transform: scale(0.9);
                transition: transform 0.3s ease;
                overflow: hidden;
            `;

            const colors = {
                info: {
                    bg: '#3b82f6',
                    light: '#dbeafe'
                },
                warning: {
                    bg: '#f59e0b',
                    light: '#fef3c7'
                },
                danger: {
                    bg: '#ef4444',
                    light: '#fee2e2'
                },
                success: {
                    bg: '#10b981',
                    light: '#d1fae5'
                }
            };

            const color = colors[type] || colors.info;

            dialog.innerHTML = `
                <div style="background: ${color.light}; padding: 20px; border-bottom: 1px solid #e5e7eb;">
                    <h3 style="margin: 0; color: ${color.bg}; font-size: 18px; font-weight: 600;">${title}</h3>
                </div>
                <div style="padding: 20px;">
                    <p style="margin: 0 0 20px 0; color: #374151; line-height: 1.5;">${message}</p>
                    <div style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button class="dialog-cancel-btn" style="
                            padding: 10px 20px;
                            border: 1px solid #d1d5db;
                            background: white;
                            color: #374151;
                            border-radius: 6px;
                            cursor: pointer;
                            font-weight: 500;
                            transition: all 0.2s ease;
                        ">${cancelText}</button>
                        <button class="dialog-confirm-btn" style="
                            padding: 10px 20px;
                            border: none;
                            background: ${color.bg};
                            color: white;
                            border-radius: 6px;
                            cursor: pointer;
                            font-weight: 500;
                            transition: all 0.2s ease;
                        ">${confirmText}</button>
                    </div>
                </div>
            `;

            overlay.appendChild(dialog);
            document.body.appendChild(overlay);

            // Show dialog with animation
            setTimeout(() => {
                overlay.style.opacity = '1';
                dialog.style.transform = 'scale(1)';
            }, 10);

            // Handle clicks
            dialog.querySelector('.dialog-cancel-btn').addEventListener('click', () => {
                closeDialog();
                onCancel();
            });

            dialog.querySelector('.dialog-confirm-btn').addEventListener('click', () => {
                closeDialog();
                onConfirm();
            });

            // Close on overlay click
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    closeDialog();
                    onCancel();
                }
            });

            function closeDialog() {
                overlay.style.opacity = '0';
                dialog.style.transform = 'scale(0.9)';
                setTimeout(() => overlay.remove(), 300);
            }
        }

        function showToast(message, type = 'info') {
            // Remove existing toasts
            document.querySelectorAll('.toast-notification').forEach(toast => toast.remove());

            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                padding: 16px 24px;
                background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
                color: white;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 500;
                box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                transform: translateX(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                max-width: 320px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            `;

            toast.innerHTML = `
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span>${type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ'}</span>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(toast);

            // Trigger animation
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);

            // Auto remove
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/wishlist.blade.php ENDPATH**/ ?>