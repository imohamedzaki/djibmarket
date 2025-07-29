
<style>
    .history-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .history-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .history-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .history-card:hover .product-image img {
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

    .history-card:hover .product-overlay {
        opacity: 1;
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: #f0f0f0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #999;
    }

    .no-image i {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .product-info {
        padding: 20px;
        flex: 1;
    }

    .product-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0 0 10px 0;
        line-height: 1.4;
    }

    .product-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #007bff;
    }

    .product-price {
        font-size: 18px;
        font-weight: 700;
        color: #007bff;
        margin: 0 0 8px 0;
    }

    .product-discount {
        margin: 0 0 8px 0;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        font-size: 14px;
        margin-right: 8px;
    }

    .discount-price {
        color: #dc3545;
        font-weight: 600;
        font-size: 16px;
    }

    .product-category {
        font-size: 12px;
        color: #666;
        margin: 0 0 8px 0;
    }

    .product-category i {
        margin-right: 5px;
    }

    .viewed-date {
        font-size: 12px;
        color: #999;
        margin: 0;
    }

    .viewed-date i {
        margin-right: 5px;
    }

    .product-actions {
        padding: 15px 20px;
        border-top: 1px solid #f0f0f0;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .product-actions .btn {
        flex: 1;
        min-width: 120px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-outline-primary {
        background-color: transparent;
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-secondary {
        background-color: transparent;
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn-outline-danger {
        background-color: transparent;
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    /* Pagination Styles */
    .pagination {
        justify-content: center;
    }

    .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #ddd;
        color: #333;
    }

    .page-link:hover {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    @media (max-width: 768px) {
        .history-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .product-actions {
            flex-direction: column;
        }

        .product-actions .btn {
            min-width: auto;
        }

        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const originalText = this.innerHTML;

                // Disable button and show loading
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

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
                            // Show success message
                            this.innerHTML = '<i class="fas fa-check"></i> Added!';
                            this.classList.remove('btn-outline-primary');
                            this.classList.add('btn-success');

                            // Reset button after 2 seconds
                            setTimeout(() => {
                                this.innerHTML = originalText;
                                this.classList.remove('btn-success');
                                this.classList.add('btn-outline-primary');
                                this.disabled = false;
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Failed to add to cart');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.innerHTML =
                            '<i class="fas fa-exclamation-triangle"></i> Error';
                        this.classList.remove('btn-outline-primary');
                        this.classList.add('btn-danger');

                        showToast('Failed to add product to cart. Please try again.',
                            'error');

                        // Reset button after 2 seconds
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.classList.remove('btn-danger');
                            this.classList.add('btn-outline-primary');
                            this.disabled = false;
                        }, 2000);
                    });
            });
        });

        // Add to wishlist functionality
        document.querySelectorAll('.add-to-wishlist-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const originalText = this.innerHTML;

                // Disable button and show loading
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

                // For now, just show success (you would implement actual wishlist API)
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-heart"></i> Added!';
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-success');

                    // Reset button after 2 seconds
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-secondary');
                        this.disabled = false;
                    }, 2000);
                }, 500);
            });
        });
    });

    function clearBrowsingHistory() {
        showCustomDialog({
            title: 'Clear Browsing History',
            message: 'Are you sure you want to clear your entire browsing history? This action cannot be undone.',
            confirmText: 'Clear History',
            cancelText: 'Cancel',
            type: 'danger',
            onConfirm: function() {
                // Create and submit form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?php echo e(route('buyer.dashboard.browsing-history.clear')); ?>';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);

                form.submit();
            }
        });
    }

    function showCustomDialog(options) {
        const {
            title = 'Confirm',
                message = 'Are you sure?',
                confirmText = 'Confirm',
                cancelText = 'Cancel',
                type = 'info', // info, warning, danger, success
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

        // Get colors based on type
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

        // Create dialog content
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

        // Add hover effects
        const cancelBtn = dialog.querySelector('.dialog-cancel-btn');
        const confirmBtn = dialog.querySelector('.dialog-confirm-btn');

        cancelBtn.addEventListener('mouseenter', () => {
            cancelBtn.style.background = '#f3f4f6';
            cancelBtn.style.borderColor = '#9ca3af';
        });
        cancelBtn.addEventListener('mouseleave', () => {
            cancelBtn.style.background = 'white';
            cancelBtn.style.borderColor = '#d1d5db';
        });

        confirmBtn.addEventListener('mouseenter', () => {
            confirmBtn.style.transform = 'translateY(-1px)';
            confirmBtn.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        });
        confirmBtn.addEventListener('mouseleave', () => {
            confirmBtn.style.transform = 'translateY(0)';
            confirmBtn.style.boxShadow = 'none';
        });

        // Show dialog with animation
        setTimeout(() => {
            overlay.style.opacity = '1';
            dialog.style.transform = 'scale(1)';
        }, 10);

        // Handle clicks
        cancelBtn.addEventListener('click', () => {
            closeDialog();
            onCancel();
        });

        confirmBtn.addEventListener('click', () => {
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

        // Close on escape key
        const handleEscape = (e) => {
            if (e.key === 'Escape') {
                closeDialog();
                onCancel();
                document.removeEventListener('keydown', handleEscape);
            }
        };
        document.addEventListener('keydown', handleEscape);

        function closeDialog() {
            overlay.style.opacity = '0';
            dialog.style.transform = 'scale(0.9)';
            setTimeout(() => {
                overlay.remove();
            }, 300);
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
<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h1>Browsing History</h1>
            <p>Keep track of products you've recently viewed.</p>
        </div>
        <?php if($history->count() > 0): ?>
            <form action="<?php echo e(route('buyer.dashboard.browsing-history.clear')); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="button" class="btn btn-outline-danger" onclick="clearBrowsingHistory()">
                    <i class="fas fa-trash"></i> Clear History
                </button>
            </form>
        <?php endif; ?>
    </div>

    <?php if($history->count() > 0): ?>
        <div class="history-grid">
            <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="history-card">
                    <div class="product-image">
                        <?php if($item->product): ?>
                            <img src="<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>"
                                alt="<?php echo e($item->product->title); ?>">
                            <div class="product-overlay">
                                <a href="<?php echo e(route('buyer.product.show', $item->product)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="no-image">
                                <i class="fas fa-image"></i>
                                <p>Product no longer available</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="product-info">
                        <?php if($item->product): ?>
                            <h6 class="product-title">
                                <a href="<?php echo e(route('buyer.product.show', $item->product)); ?>">
                                    <?php echo e($item->product->title); ?>

                                </a>
                            </h6>
                            <p class="product-price">
                                <?php echo e(number_format($item->product->price_discounted > 0 ? $item->product->price_discounted : $item->product->price_regular, 2)); ?>

                                DJF</p>
                            <?php if($item->product->price_discounted > 0): ?>
                                <p class="product-discount">
                                    <span class="original-price"><?php echo e(number_format($item->product->price_regular, 2)); ?>

                                        DJF</span>
                                    <span class="discount-price"><?php echo e(number_format($item->product->price_discounted, 2)); ?>

                                        DJF</span>
                                </p>
                            <?php endif; ?>
                            <?php if($item->product->category): ?>
                                <p class="product-category">
                                    <i class="fas fa-tag"></i> <?php echo e($item->product->category->name); ?>

                                </p>
                            <?php endif; ?>
                        <?php else: ?>
                            <h6 class="product-title text-muted">Product no longer available</h6>
                        <?php endif; ?>
                        <p class="viewed-date">
                            <i class="fas fa-clock"></i> Viewed <?php echo e($item->viewed_at->diffForHumans()); ?>

                        </p>
                    </div>

                    <div class="product-actions">
                        <?php if($item->product): ?>
                            <button type="button" class="btn btn-sm btn-outline-primary add-to-cart-btn"
                                data-product-id="<?php echo e($item->product->id); ?>">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary add-to-wishlist-btn"
                                data-product-id="<?php echo e($item->product->id); ?>">
                                <i class="fas fa-heart"></i> Wishlist
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($history->links()); ?>

        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-history fa-3x text-muted mb-3"></i>
            <h5>No browsing history</h5>
            <p class="text-muted">Start browsing products to see your viewing history here!</p>
            <a href="<?php echo e(route('buyer.home')); ?>" class="btn btn-primary">Start Shopping</a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/browsing-history.blade.php ENDPATH**/ ?>