

<?php $__env->startSection('title', 'Shopping Cart'); ?>

<?php $__env->startSection('content'); ?>
    <div class="section-box">
        <div class="breadcrumbs-div">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a class="font-xs color-gray-1000" href="<?php echo e(route('buyer.home')); ?>">Home</a></li>
                    <li><a class="font-xs color-gray-500" href="#">Shop</a></li>
                    <li><a class="font-xs color-gray-500" href="#">Cart</a></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="section-box shop-template">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?php if(empty($cartItems)): ?>
                        <div class="cart-empty text-center py-5">
                            <div class="cart-empty-icon">🛒</div>
                            <p class="font-sm color-brand-3">Your cart is empty</p>
                            <p class="font-xs color-gray-500">Add some products to get started</p>
                            <a href="<?php echo e(route('buyer.home')); ?>" class="btn btn-buy mt-3">Continue Shopping</a>
                        </div>
                    <?php else: ?>
                        <div class="box-carts">
                            <div class="head-wishlist">
                                <div class="item-wishlist">
                                    <div class="wishlist-cb">
                                        <input class="cb-layout cb-all" type="checkbox">
                                    </div>
                                    <div class="wishlist-product"><span class="font-md-bold color-brand-3">Product</span>
                                    </div>
                                    <div class="wishlist-price"><span class="font-md-bold color-brand-3">Unit Price</span>
                                    </div>
                                    <div class="wishlist-status"><span class="font-md-bold color-brand-3">Quantity</span>
                                    </div>
                                    <div class="wishlist-action"><span class="font-md-bold color-brand-3">Subtotal</span>
                                    </div>
                                    <div class="wishlist-remove"><span class="font-md-bold color-brand-3">Remove</span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-wishlist mb-20" id="cart-items">
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item-wishlist" data-product-id="<?php echo e($item['product_id']); ?>">
                                        <div class="wishlist-cb">
                                            <input class="cb-layout cb-select" type="checkbox">
                                        </div>
                                        <div class="wishlist-product">
                                            <div class="product-wishlist">
                                                <div class="product-image">
                                                    <a href="<?php echo e($item['product_url']); ?>">
                                                        <?php if($item['product_image']): ?>
                                                            <img src="<?php echo e($item['product_image']); ?>"
                                                                alt="<?php echo e($item['product_title']); ?>">
                                                        <?php else: ?>
                                                            <div class="no-image-placeholder"
                                                                style="width: 100%; height: 100px; background: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px;">
                                                                No Image
                                                            </div>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <a href="<?php echo e($item['product_url']); ?>">
                                                        <h6 class="color-brand-3">
                                                            <?php echo e(Str::limit($item['product_title'], 60)); ?></h6>
                                                    </a>
                                                    <?php if($item['product']->stock_quantity <= 5): ?>
                                                        <div class="rating">
                                                            <span class="font-xs color-gray-500">Only
                                                                <?php echo e($item['product']->stock_quantity); ?> left in stock</span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wishlist-price">
                                            <h4 class="color-brand-3"><?php echo e(number_format($item['unit_price'], 0)); ?> DJF</h4>
                                        </div>
                                        <div class="wishlist-status">
                                            <div class="box-quantity">
                                                <div class="input-quantity">
                                                    <input class="font-xl color-brand-3 quantity-input" type="text"
                                                        value="<?php echo e($item['quantity']); ?>" min="1"
                                                        max="<?php echo e($item['product']->stock_quantity); ?>"
                                                        data-product-id="<?php echo e($item['product_id']); ?>">
                                                    <span class="minus-cart"
                                                        onclick="updateQuantity(<?php echo e($item['product_id']); ?>, <?php echo e($item['quantity'] - 1); ?>)"></span>
                                                    <span class="plus-cart"
                                                        onclick="updateQuantity(<?php echo e($item['product_id']); ?>, <?php echo e($item['quantity'] + 1); ?>)"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wishlist-action">
                                            <h4 class="color-brand-3 item-subtotal">
                                                <?php echo e(number_format($item['total_price'], 0)); ?> DJF</h4>
                                        </div>
                                        <div class="wishlist-remove">
                                            <a class="btn btn-delete" href="#"
                                                onclick="removeFromCart(<?php echo e($item['product_id']); ?>); return false;"></a>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="row mb-40">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <a class="btn btn-buy w-auto arrow-back mb-10"
                                        href="<?php echo e(route('buyer.home')); ?>">Continue shopping</a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-md-end">
                                    <a class="btn btn-buy w-auto update-cart mb-10" href="#"
                                        onclick="clearCart(); return false;">Clear cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if(!empty($cartItems)): ?>
                    <div class="col-lg-3">
                        <div class="summary-cart">
                            <div class="border-bottom mb-10">
                                <div class="row">
                                    <div class="col-6"><span class="font-md-bold color-gray-500">Subtotal</span></div>
                                    <div class="col-6 text-end">
                                        <h4 id="cart-subtotal"><?php echo e(number_format($cartTotal, 0)); ?> DJF</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom mb-10">
                                <div class="row">
                                    <div class="col-6"><span class="font-md-bold color-gray-500">Shipping</span></div>
                                    <div class="col-6 text-end">
                                        <h4>Free</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom mb-10">
                                <div class="row">
                                    <div class="col-6"><span class="font-md-bold color-gray-500">Estimate for</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6>Djibouti</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-10">
                                <div class="row">
                                    <div class="col-6"><span class="font-md-bold color-gray-500">Total</span></div>
                                    <div class="col-6 text-end">
                                        <h4 id="cart-total"><?php echo e(number_format($cartTotal, 0)); ?> DJF</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="box-button">
                                <a class="btn btn-buy" href="<?php echo e(route('checkout.index') ?? '#'); ?>">Proceed To
                                    CheckOut</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <style>
        .cart-empty {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .cart-empty-icon {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .item-wishlist.updating {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>

    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <script>
        function showLoading() {
            document.getElementById('loading-overlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loading-overlay').style.display = 'none';
        }

        function updateQuantity(productId, quantity) {
            if (quantity < 0) return;

            const itemElement = document.querySelector(`[data-product-id="${productId}"]`);
            itemElement.classList.add('updating');

            fetch('<?php echo e(route('cart.update')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the quantity input
                        const quantityInput = itemElement.querySelector('.quantity-input');
                        quantityInput.value = data.cart_item.quantity;

                        // Update the item subtotal
                        const subtotalElement = itemElement.querySelector('.item-subtotal');
                        subtotalElement.textContent = new Intl.NumberFormat().format(data.cart_item.total_price) +
                            ' DJF';

                        // Update cart totals
                        document.getElementById('cart-subtotal').textContent = new Intl.NumberFormat().format(data
                            .cart_total) + ' DJF';
                        document.getElementById('cart-total').textContent = new Intl.NumberFormat().format(data
                            .cart_total) + ' DJF';

                        // Update cart count in header
                        const cartCountElements = document.querySelectorAll('.number-item');
                        cartCountElements.forEach(element => {
                            element.textContent = data.cart_count;
                        });

                        if (data.message && data.message !== 'Cart updated') {
                            showNotification(data.message, 'success');
                        }
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                })
                .finally(() => {
                    itemElement.classList.remove('updating');
                });
        }

        function removeFromCart(productId) {
            if (!confirm('Are you sure you want to remove this item from your cart?')) {
                return;
            }

            const itemElement = document.querySelector(`[data-product-id="${productId}"]`);
            itemElement.classList.add('updating');

            fetch('<?php echo e(route('cart.remove')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the item from DOM
                        itemElement.remove();

                        // Update cart totals
                        document.getElementById('cart-subtotal').textContent = new Intl.NumberFormat().format(data
                            .cart_total) + ' DJF';
                        document.getElementById('cart-total').textContent = new Intl.NumberFormat().format(data
                            .cart_total) + ' DJF';

                        // Update cart count in header
                        const cartCountElements = document.querySelectorAll('.number-item');
                        cartCountElements.forEach(element => {
                            element.textContent = data.cart_count;
                        });

                        // Check if cart is empty
                        if (data.cart_count === 0) {
                            location.reload(); // Reload to show empty cart state
                        }

                        showNotification(data.message, 'success');
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                })
                .finally(() => {
                    itemElement.classList.remove('updating');
                });
        }

        function clearCart() {
            if (!confirm('Are you sure you want to clear your entire cart?')) {
                return;
            }

            showLoading();

            fetch('<?php echo e(route('cart.clear')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload to show empty cart
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred. Please try again.', 'error');
                })
                .finally(() => {
                    hideLoading();
                });
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }

        // Handle quantity input changes
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.dataset.productId;
                    const quantity = parseInt(this.value);
                    if (quantity > 0) {
                        updateQuantity(productId, quantity);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.buyer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/cart/index.blade.php ENDPATH**/ ?>