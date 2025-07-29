<?php if(empty($cartItems)): ?>
    <div class="cart-empty">
        <div class="cart-empty-icon">🛒</div>
        <p class="font-sm color-brand-3">Your cart is empty</p>
        <p class="font-xs color-gray-500">Add some products to get started</p>
    </div>
<?php else: ?>
    <div class="cart-items">
        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item-cart mb-20" data-product-id="<?php echo e($item['product_id']); ?>">
                <button class="cart-remove" onclick="removeFromCart(<?php echo e($item['product_id']); ?>)" title="Remove item">
                    ×
                </button>
                <div class="cart-image">
                    <?php if($item['product_image']): ?>
                        <img src="<?php echo e($item['product_image']); ?>" alt="<?php echo e($item['product_title']); ?>">
                    <?php else: ?>
                        <div class="no-image-placeholder">
                            <span>No Image</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="cart-info">
                    <a class="font-sm-bold color-brand-3" href="<?php echo e($item['product_url']); ?>">
                        <?php echo e(Str::limit($item['product_title'], 50)); ?>

                    </a>
                    <div class="quantity-controls">
                        <button class="quantity-btn"
                            onclick="updateQuantity(<?php echo e($item['product_id']); ?>, <?php echo e($item['quantity'] - 1); ?>)">-</button>
                        <input type="number" class="quantity-input" value="<?php echo e($item['quantity']); ?>" min="1"
                            max="<?php echo e($item['product']->stock_quantity); ?>"
                            onchange="updateQuantity(<?php echo e($item['product_id']); ?>, this.value)">
                        <button class="quantity-btn"
                            onclick="updateQuantity(<?php echo e($item['product_id']); ?>, <?php echo e($item['quantity'] + 1); ?>)">+</button>
                    </div>
                    <p><span class="color-brand-2 font-sm-bold"><?php echo e($item['quantity']); ?> x
                            <?php echo e(number_format($item['unit_price'], 0)); ?> DJF</span></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="border-bottom pt-0 mb-15"></div>
    <div class="cart-total">
        <div class="row">
            <div class="col-6 text-start">
                <span class="font-md-bold color-brand-3">Total</span>
            </div>
            <div class="col-6">
                <span class="font-md-bold color-brand-1" id="cart-total"><?php echo e(number_format($cartTotal, 0)); ?>

                    DJF</span>
            </div>
        </div>
        <div class="row mt-15">
            <div class="col-6 text-start">
                <a class="btn btn-cart w-auto" href="<?php echo e(route('buyer.dashboard.cart')); ?>">View cart</a>
            </div>
            <div class="col-6">
                <a class="btn btn-buy w-auto" href="<?php echo e(route('checkout.index') ?? '#'); ?>">Checkout</a>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/cart-content.blade.php ENDPATH**/ ?>