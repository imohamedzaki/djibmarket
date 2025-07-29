

<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <div>
                <h1>My Cart</h1>
                <p>Review and manage items in your shopping cart.</p>
            </div>
            <div class="cart-stats">
                <?php if($cartItems && count($cartItems) > 0): ?>
                    <span class="cart-count"><?php echo e(count($cartItems)); ?> <?php echo e(Str::plural('item', count($cartItems))); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if($cartItems && count($cartItems) > 0): ?>
        <div class="cart-layout">
            <!-- Cart Items -->
            <div class="cart-items-section">
                <div class="cart-items-card">
                    <div class="cart-items-header">
                        <h3 class="section-title">Shopping Cart</h3>
                        <div class="cart-actions-bar">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearCart()">
                                <i class="fas fa-trash me-1"></i>
                                Clear Cart
                            </button>
                        </div>
                    </div>

                    <div class="cart-items-list">
                        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="cart-item" data-item-id="<?php echo e($item['product_id']); ?>">
                                <div class="item-image-container">
                                    <?php if($item['product']): ?>
                                        <div class="item-image">
                                            <img src="<?php echo e($item['product']['primary_image_url'] ?? asset('assets/imgs/template/product-placeholder.jpg')); ?>"
                                                alt="<?php echo e($item['product']['title']); ?>"
                                                onerror="this.src='<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>'">
                                        </div>
                                    <?php else: ?>
                                        <div class="item-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="item-details">
                                    <h4 class="item-title">
                                        <?php if($item['product']): ?>
                                            <a href="<?php echo e(route('buyer.product.show', $item['product']['slug'])); ?>">
                                                <?php echo e($item['product']['title']); ?>

                                            </a>
                                        <?php else: ?>
                                            <span class="item-unavailable">Product no longer available</span>
                                        <?php endif; ?>
                                    </h4>

                                    <?php if($item['product'] && isset($item['product']['category'])): ?>
                                        <div class="item-category">
                                            <i class="fas fa-tag me-1"></i>
                                            <?php echo e($item['product']['category']['name'] ?? 'Uncategorized'); ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="item-price">
                                        <span class="price-amount"><?php echo e(number_format($item['unit_price'], 0)); ?> DJF</span>
                                        <span class="price-label">per item</span>
                                    </div>
                                </div>

                                <div class="item-quantity">
                                    <label class="quantity-label">Quantity</label>
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn quantity-decrease"
                                            onclick="updateQuantity(<?php echo e($item['product_id']); ?>, <?php echo e(max(1, $item['quantity'] - 1)); ?>)"
                                            <?php echo e($item['quantity'] <= 1 ? 'disabled' : ''); ?>>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" class="quantity-input" value="<?php echo e($item['quantity']); ?>"
                                            min="1" max="99"
                                            onchange="updateQuantity(<?php echo e($item['product_id']); ?>, this.value)">
                                        <button type="button" class="quantity-btn quantity-increase"
                                            onclick="updateQuantity(<?php echo e($item['product_id']); ?>, <?php echo e($item['quantity'] + 1); ?>)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="item-total">
                                    <div class="total-amount"><?php echo e(number_format($item['total_price'], 0)); ?> DJF</div>
                                    <div class="total-label">Total</div>
                                </div>

                                <div class="item-actions">
                                    <button type="button" class="action-btn action-btn-danger"
                                        onclick="removeItem(<?php echo e($item['product_id']); ?>)" title="Remove item">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="continue-shopping">
                        <a href="<?php echo e(route('buyer.home')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="cart-summary-section">
                <div class="cart-summary-card">
                    <div class="summary-header">
                        <h3 class="section-title">Order Summary</h3>
                    </div>

                    <div class="summary-content">
                        <div class="summary-row">
                            <span class="summary-label">Subtotal (<?php echo e(count($cartItems)); ?> items)</span>
                            <span class="summary-value"
                                id="cart-subtotal"><?php echo e(number_format($cartTotal['subtotal'] ?? 0, 0)); ?> DJF</span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">Shipping</span>
                            <span class="summary-value"
                                id="cart-shipping"><?php echo e(number_format($cartTotal['shipping'] ?? 1000, 0)); ?> DJF</span>
                        </div>

                        <?php if(($cartTotal['tax'] ?? 0) > 0): ?>
                            <div class="summary-row">
                                <span class="summary-label">Tax</span>
                                <span class="summary-value" id="cart-tax"><?php echo e(number_format($cartTotal['tax'] ?? 0, 0)); ?>

                                    DJF</span>
                            </div>
                        <?php endif; ?>

                        <div class="summary-divider"></div>

                        <div class="summary-row summary-total">
                            <span class="summary-label">Total</span>
                            <span class="summary-value" id="cart-total">
                                <?php echo e(number_format(($cartTotal['subtotal'] ?? 0) + ($cartTotal['shipping'] ?? 1000) + ($cartTotal['tax'] ?? 0), 0)); ?>

                                DJF
                            </span>
                        </div>
                    </div>

                    <div class="summary-actions">
                        <a id="checkout-btn" href="<?php echo e(route('checkout.index')); ?>" class="btn btn-primary btn-lg btn-block" onclick="handleCheckoutClick(event, this)">
                            <i class="fas fa-credit-card me-2"></i>
                            <span class="btn-text">Proceed to Checkout</span>
                        </a>
                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="saveForLater()">
                            <i class="fas fa-heart me-2"></i>
                            Save for Later
                        </button>
                    </div>
                </div>

                <!-- Recommended Products -->
                <?php if(isset($recommendedProducts) && $recommendedProducts->count() > 0): ?>
                    <div class="recommended-card">
                        <div class="recommended-header">
                            <h4 class="section-title">You might also like</h4>
                        </div>
                        <div class="recommended-content">
                            <?php $__currentLoopData = $recommendedProducts->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="recommended-item">
                                    <div class="recommended-image">
                                        <img src="<?php echo e($product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg')); ?>"
                                            alt="<?php echo e($product->title); ?>"
                                            onerror="this.src='<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>'">
                                    </div>
                                    <div class="recommended-details">
                                        <h5 class="recommended-title"><?php echo e(Str::limit($product->title, 25)); ?></h5>
                                        <div class="recommended-price">
                                            <?php echo e(number_format($product->price_discounted > 0 ? $product->price_discounted : $product->price_regular, 0)); ?>

                                            DJF
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-block"
                                            onclick="addToCartFromRecommended(<?php echo e($product->id); ?>, this)">
                                            <i class="fas fa-plus me-1"></i>
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="empty-cart-card">
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="empty-cart-title">Your cart is empty</h3>
                <p class="empty-cart-text">Add some products to your cart to get started!</p>
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

        .cart-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .cart-count {
            background: var(--gray-100);
            color: var(--gray-600);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
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
            justify-content: center;
        }

        .btn-primary {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-700);
            border-color: var(--primary-700);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-primary {
            background: transparent;
            border-color: var(--primary-600);
            color: var(--primary-600);
        }

        .btn-outline-primary:hover {
            background: var(--primary-600);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-secondary {
            background: transparent;
            border-color: var(--gray-300);
            color: var(--gray-600);
        }

        .btn-outline-secondary:hover {
            background: var(--gray-100);
            color: var(--gray-700);
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

        .btn-block {
            width: 100%;
            margin-bottom: 0.75rem;
        }

        .btn-block:last-child {
            margin-bottom: 0;
        }

        /* Cart Layout */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
        }

        /* Cart Items Section */
        .cart-items-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .cart-items-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .cart-actions-bar {
            display: flex;
            gap: 0.5rem;
        }

        .cart-items-list {
            padding: 0;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto auto auto;
            gap: 1.5rem;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            transition: background-color 0.2s ease;
        }

        .cart-item:hover {
            background: var(--gray-50);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image-container {
            position: relative;
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: var(--radius-md);
            overflow: hidden;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-image-placeholder {
            width: 100px;
            height: 100px;
            border-radius: var(--radius-md);
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            font-size: 1.5rem;
        }

        .item-details {
            min-width: 0;
        }

        .item-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 0.5rem 0;
            line-height: 1.4;
        }

        .item-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .item-title a:hover {
            color: var(--primary-600);
        }

        .item-unavailable {
            color: var(--gray-600);
        }

        .item-category {
            color: var(--gray-600);
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .item-price {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .price-amount {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-600);
        }

        .price-label {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .item-quantity {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: center;
        }

        .quantity-label {
            font-size: 0.75rem;
            color: var(--gray-600);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: var(--white);
            color: var(--gray-600);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.75rem;
        }

        .quantity-btn:hover:not(:disabled) {
            background: var(--gray-50);
            color: var(--gray-900);
        }

        .quantity-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .quantity-input {
            width: 50px;
            height: 32px;
            border: none;
            text-align: center;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-900);
            background: var(--white);
        }

        .quantity-input:focus {
            outline: none;
        }

        .item-total {
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .total-amount {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .total-label {
            font-size: 0.75rem;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .item-actions {
            display: flex;
            justify-content: center;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-btn-danger {
            background: var(--gray-50);
            color: #ef4444;
        }

        .action-btn-danger:hover {
            background: #ef4444;
            color: var(--white);
        }

        .continue-shopping {
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        /* Cart Summary Section */
        .cart-summary-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .summary-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .summary-content {
            padding: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .summary-value {
            font-weight: 600;
            color: var(--gray-900);
            font-size: 0.875rem;
        }

        .summary-divider {
            height: 1px;
            background: var(--gray-200);
            margin: 1rem 0;
        }

        .summary-total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .summary-total .summary-label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .summary-total .summary-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-600);
        }

        .summary-actions {
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        /* Recommended Products */
        .recommended-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .recommended-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .recommended-header .section-title {
            font-size: 1rem;
        }

        .recommended-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .recommended-item {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .recommended-image {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            flex-shrink: 0;
        }

        .recommended-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recommended-details {
            flex: 1;
            min-width: 0;
        }

        .recommended-title {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-900);
            margin: 0 0 0.25rem 0;
            line-height: 1.3;
        }

        .recommended-price {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--primary-600);
            margin-bottom: 0.5rem;
        }

        /* Empty Cart */
        .empty-cart-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-cart-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: var(--primary-600);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
        }

        .empty-cart-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 0.5rem 0;
        }

        .empty-cart-text {
            color: var(--gray-600);
            margin: 0 0 2rem 0;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .cart-layout {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .cart-item {
                padding: 1rem;
                gap: 0.75rem;
            }

            .item-image-container {
                grid-area: image;
            }

            .item-details {
                grid-area: details;
            }

            .item-quantity {
                grid-area: quantity;
                align-items: flex-start;
                margin-top: 0.5rem;
            }

            .item-total {
                grid-area: total;
                text-align: left;
                margin-top: 0.5rem;
            }

            .item-actions {
                grid-area: actions;
                justify-content: flex-end;
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid var(--gray-200);
            }

            .dashboard-header-content {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .cart-items-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .cart-item {
                padding: 1rem;
                gap: 0.75rem;
            }

            .item-image,
            .item-image-placeholder {
                width: 60px;
                height: 60px;
            }

            .quantity-controls {
                align-self: flex-start;
            }

            .recommended-content {
                padding: 0.75rem;
            }

            .recommended-item {
                gap: 0.5rem;
            }

            .recommended-image {
                width: 50px;
                height: 50px;
            }
        }
    </style>

    <!-- Include the JavaScript from the original file -->
    <script>
        function updateQuantity(itemId, newQuantity) {
            if (newQuantity < 1) {
                removeItem(itemId);
                return;
            }

            if (newQuantity > 99) {
                newQuantity = 99;
            }

            // Show loading state
            const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
            if (cartItem) {
                cartItem.style.opacity = '0.6';
            }

            // Make AJAX request to update quantity
            fetch('<?php echo e(route('cart.update')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: itemId,
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the UI
                        location.reload(); // Simple reload for now
                    } else {
                        throw new Error(data.message || 'Failed to update quantity');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Failed to update quantity. Please try again.', 'error');
                    if (cartItem) {
                        cartItem.style.opacity = '1';
                    }
                });
        }

        function removeItem(itemId) {
            showCustomDialog({
                title: 'Remove Item',
                message: 'Are you sure you want to remove this item from your cart?',
                confirmText: 'Remove',
                cancelText: 'Cancel',
                type: 'warning',
                onConfirm: function() {
                    performRemoveItem(itemId);
                }
            });
        }

        function performRemoveItem(itemId) {
            // Show loading state
            const cartItem = document.querySelector(`[data-item-id="${itemId}"]`);
            if (cartItem) {
                cartItem.style.opacity = '0.6';
                cartItem.style.pointerEvents = 'none';
            }

            // Make AJAX request to remove item
            fetch('<?php echo e(route('cart.remove')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: itemId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Animate removal
                        if (cartItem) {
                            cartItem.style.transform = 'translateX(-100%)';
                            cartItem.style.opacity = '0';

                            setTimeout(() => {
                                cartItem.remove();

                                // Check if cart is empty and reload
                                if (document.querySelectorAll('.cart-item').length === 0) {
                                    location.reload();
                                } else {
                                    // Update cart totals without full reload
                                    updateCartTotals();
                                }
                            }, 300);
                        }

                        // Show success message
                        showToast('Item removed from cart', 'success');
                    } else {
                        throw new Error(data.message || 'Failed to remove item');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Failed to remove item. Please try again.', 'error');
                    if (cartItem) {
                        cartItem.style.opacity = '1';
                        cartItem.style.pointerEvents = 'auto';
                        cartItem.style.transform = 'translateX(0)';
                    }
                });
        }

        function clearCart() {
            showCustomDialog({
                title: 'Clear Cart',
                message: 'Are you sure you want to clear your entire cart? This action cannot be undone.',
                confirmText: 'Clear Cart',
                cancelText: 'Cancel',
                type: 'danger',
                onConfirm: function() {
                    performClearCart();
                }
            });
        }

        function performClearCart() {
            // Show loading state on button
            const clearButton = document.querySelector('button[onclick="clearCart()"]');
            const originalText = clearButton.innerHTML;
            clearButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Clearing...';
            clearButton.disabled = true;

            // Make AJAX request to clear cart
            fetch('<?php echo e(route('cart.clear')); ?>', {
                    method: 'POST',
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
                        showToast('Cart cleared successfully', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        throw new Error(data.message || 'Failed to clear cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Failed to clear cart. Please try again.', 'error');
                    clearButton.innerHTML = originalText;
                    clearButton.disabled = false;
                });
        }

        function saveForLater() {
            showCustomDialog({
                title: 'Save Cart to Wishlist',
                message: 'Are you sure you want to save all cart items to your wishlist? This will clear your cart.',
                confirmText: 'Save to Wishlist',
                cancelText: 'Cancel',
                type: 'info',
                onConfirm: function() {
                    // Show loading state
                    const saveButton = document.querySelector('button[onclick="saveForLater()"]');
                    const originalText = saveButton.innerHTML;
                    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';
                    saveButton.disabled = true;

                    // Make AJAX request to save cart to wishlist
                    fetch('<?php echo e(route('buyer.dashboard.cart.save-to-wishlist')); ?>', {
                            method: 'POST',
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
                                showToast(data.message, 'success');
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Failed to save items to wishlist');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast('Failed to save items to wishlist. Please try again.', 'error');
                            saveButton.innerHTML = originalText;
                            saveButton.disabled = false;
                        });
                }
            });
        }

        function addToCartFromRecommended(productId, buttonElement) {
            // Add loading state
            const originalText = buttonElement.innerHTML;
            buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Adding...';
            buttonElement.disabled = true;

            // Make AJAX request to add to cart
            fetch('<?php echo e(route('cart.add')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
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
                        buttonElement.innerHTML = '<i class="fas fa-check me-1"></i> Added!';
                        buttonElement.classList.remove('btn-outline-primary');
                        buttonElement.classList.add('btn-success');

                        // Reload page to update cart
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        throw new Error(data.message || 'Failed to add to cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Failed to add to cart. Please try again.', 'error');
                    buttonElement.innerHTML = originalText;
                    buttonElement.disabled = false;
                });
        }

        function updateCartTotals() {
            // Fetch updated cart data
            fetch('<?php echo e(route('cart.data')); ?>', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update cart totals in the UI
                    const subtotal = data.total || 0;
                    const shipping = 1000;
                    const tax = 0;
                    const total = subtotal + shipping + tax;

                    document.getElementById('cart-subtotal').textContent = `${subtotal.toFixed(0)} DJF`;
                    document.getElementById('cart-shipping').textContent = `${shipping.toFixed(0)} DJF`;
                    if (document.getElementById('cart-tax')) {
                        document.getElementById('cart-tax').textContent = `${tax.toFixed(0)} DJF`;
                    }
                    document.getElementById('cart-total').textContent = `${total.toFixed(0)} DJF`;
                })
                .catch(error => {
                    console.error('Error updating totals:', error);
                });
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

        function handleCheckoutClick(event, button) {
            // Prevent default action temporarily
            event.preventDefault();
            
            // Add loading state
            const icon = button.querySelector('i');
            const textSpan = button.querySelector('.btn-text');
            
            // Store original content
            const originalIcon = icon.outerHTML;
            const originalText = textSpan.textContent;
            
            // Change to loading state
            icon.className = 'ti ti-loader-2 me-2';
            icon.style.animation = 'spin 1s linear infinite';
            textSpan.textContent = 'Processing your request...';
            button.style.pointerEvents = 'none';
            button.style.opacity = '0.8';
            
            // Add spinner animation CSS if not exists
            if (!document.querySelector('#spinner-style')) {
                const style = document.createElement('style');
                style.id = 'spinner-style';
                style.textContent = `
                    @keyframes spin {
                        from { transform: rotate(0deg); }
                        to { transform: rotate(360deg); }
                    }
                `;
                document.head.appendChild(style);
            }
            
            // Simulate processing delay (1.5 seconds) then redirect
            setTimeout(() => {
                window.location.href = button.href;
            }, 1500);
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/cart.blade.php ENDPATH**/ ?>