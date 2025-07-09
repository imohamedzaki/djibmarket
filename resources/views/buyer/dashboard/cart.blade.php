@extends('buyer.dashboard.layout')

@section('dashboard-content')
    <div class="dashboard-header">
        <h1>My Cart</h1>
        <p>Review and manage items in your shopping cart.</p>
    </div>

    @if ($cartItems && count($cartItems) > 0)
        <div class="cart-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-items mb-4">
                        @foreach ($cartItems as $item)
                            <div class="cart-item" data-item-id="{{ $item['product_id'] }}">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="item-image">
                                            @if ($item['product'])
                                                <img src="{{ $item['product']['primary_image_url'] ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                    alt="{{ $item['product']['title'] }}"
                                                    onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="item-details">
                                            <h6 class="item-title">
                                                @if ($item['product'])
                                                    <a href="{{ route('buyer.product.show', $item['product']['slug']) }}">
                                                        {{ $item['product']['title'] }}
                                                    </a>
                                                @else
                                                    Product no longer available
                                                @endif
                                            </h6>
                                            @if ($item['product'] && isset($item['product']['category']))
                                                <small
                                                    class="text-muted">{{ $item['product']['category']['name'] ?? 'Uncategorized' }}</small>
                                            @endif
                                            <p class="item-price">{{ number_format($item['unit_price'], 2) }} DJF</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quantity-controls">
                                            <button type="button" class="btn btn-sm btn-outline-secondary quantity-btn"
                                                onclick="updateQuantity({{ $item['product_id'] }}, {{ $item['quantity'] - 1 }})">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" class="form-control quantity-input"
                                                style="width: 70px !important;" value="{{ $item['quantity'] }}"
                                                min="1" max="99"
                                                onchange="updateQuantity({{ $item['product_id'] }}, this.value)">
                                            <button type="button" class="btn btn-sm btn-outline-secondary quantity-btn"
                                                onclick="updateQuantity({{ $item['product_id'] }}, {{ $item['quantity'] + 1 }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <strong class="item-total">{{ number_format($item['total_price'], 2) }}
                                            DJF</strong>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-btn"
                                            onclick="removeItem({{ $item['product_id'] }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-actions">
                        <button type="button" class="btn btn-outline-secondary" onclick="clearCart()">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                        <a href="{{ route('buyer.home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                    </div>

                    <!-- Order Summary moved to bottom -->
                    <div class="col-lg-12 mx-auto mt-4">
                        <div class="cart-summary">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Order Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="summary-row">
                                        <span>Subtotal ({{ count($cartItems) }} items):</span>
                                        <strong id="cart-subtotal">{{ number_format($cartTotal['subtotal'] ?? 0, 0) }}
                                            DJF</strong>
                                    </div>
                                    <div class="summary-row">
                                        <span>Shipping:</span>
                                        <strong id="cart-shipping">{{ number_format($cartTotal['shipping'] ?? 1000, 0) }}
                                            DJF</strong>
                                    </div>
                                    @if (($cartTotal['tax'] ?? 0) > 0)
                                        <div class="summary-row">
                                            <span>Tax:</span>
                                            <strong id="cart-tax">{{ number_format($cartTotal['tax'] ?? 0, 0) }}
                                                DJF</strong>
                                        </div>
                                    @endif
                                    <hr>
                                    <div class="summary-row total">
                                        <span>Total:</span>
                                        <strong
                                            id="cart-total">{{ number_format(($cartTotal['subtotal'] ?? 0) + ($cartTotal['shipping'] ?? 1000) + ($cartTotal['tax'] ?? 0), 0) }}
                                            DJF</strong>
                                    </div>

                                    <div class="checkout-actions">
                                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block">
                                            <i class="fas fa-credit-card"></i> Proceed to Checkout
                                        </a>
                                        <button type="button" class="btn btn-outline-secondary btn-block"
                                            onclick="saveForLater()">
                                            <i class="fas fa-heart"></i> Save for Later
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Recommended Products -->
                            @if (isset($recommendedProducts) && $recommendedProducts->count() > 0)
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">You might also like</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="recommended-products">
                                            @foreach ($recommendedProducts->take(3) as $product)
                                                <div class="recommended-item">
                                                    <div class="item-image">
                                                        <img src="{{ $product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                            alt="{{ $product->title }}"
                                                            onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                                    </div>
                                                    <div class="item-info">
                                                        <h6>{{ Str::limit($product->title, 30) }}</h6>
                                                        <p>{{ number_format($product->price_discounted > 0 ? $product->price_discounted : $product->price_regular, 2) }}
                                                            DJF</p>
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            onclick="addToCartFromRecommended({{ $product->id }}, this)">
                                                            <i class="fas fa-plus"></i> Add
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h5>Your cart is empty</h5>
                <p class="text-muted">Add some products to your cart to get started!</p>
                <a href="{{ route('buyer.home') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i> Start Shopping
                </a>
            </div>
    @endif
@endsection

<style>
    .cart-container {
        margin-bottom: 30px;
    }

    .cart-items {
        background: transparent;
        padding: 0;
        margin-bottom: 20px;
    }

    .cart-item {
        padding: 20px;
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        margin-bottom: 15px;
        background: #fff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transform: translateX(0);
    }

    .cart-item:last-child {
        margin-bottom: 0;
    }

    .cart-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
        border-color: #e0e0e0;
    }

    .item-image {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #f0f0f0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 24px;
    }

    .item-details {
        padding-left: 15px;
    }

    .item-title {
        font-size: 16px;
        font-weight: 500;
        margin: 0 0 5px 0;
    }

    .item-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .item-title a:hover {
        color: #007bff;
    }

    .item-price {
        font-size: 18px;
        font-weight: 600;
        color: #007bff;
        margin: 5px 0 0 0;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 5px;
        justify-content: center;
    }

    .quantity-input {
        width: 70px !important;
        height: 40px;
        text-align: center;
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        background: #fff;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        font-size: 16px;
        font-weight: bold;
    }

    .item-total {
        font-size: 18px;
        color: #333;
        text-align: center;
        display: block;
    }

    .remove-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .cart-actions {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        gap: 15px;
        justify-content: space-between;
    }

    .cart-summary .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 20px;
        border-radius: 12px 12px 0 0 !important;
    }

    .card-body {
        padding: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .checkout-actions {
        margin-top: 20px;
    }

    .btn-block {
        width: 100%;
        margin-bottom: 10px;
    }

    .recommended-products {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .recommended-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .recommended-item:hover {
        background-color: #f8f9fa;
    }

    .item-image img {
        width: 5rem;
        object-fit: contain;
    }

    .recommended-item .item-image {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
    }

    .recommended-item .item-info {
        flex: 1;
    }

    .recommended-item .item-info h6 {
        font-size: 14px;
        font-weight: 500;
        margin: 0 0 2px 0;
    }

    .recommended-item .item-info p {
        font-size: 13px;
        color: #007bff;
        font-weight: 600;
        margin: 0 0 5px 0;
    }

    .empty-cart {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    @media (max-width: 768px) {
        .cart-item .row {
            text-align: center;
        }

        .cart-item .col-md-1,
        .cart-item .col-md-2:last-child {
            margin-top: 15px;
        }

        .cart-actions {
            flex-direction: column;
        }

        .quantity-controls {
            justify-content: center;
            margin: 10px 0;
        }

        .item-details {
            padding-left: 0;
            margin-top: 10px;
        }
    }

    /* Toast Notifications */
    .toast-notification {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .toast-notification:hover {
        transform: translateX(-5px) !important;
    }
</style>

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
        fetch('{{ route('cart.update') }}', {
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
        fetch('{{ route('cart.remove') }}', {
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

                    // Update wishlist count to ensure accuracy
                    if (typeof window.updateWishlistCount === 'function') {
                        window.updateWishlistCount();
                    }
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
        clearButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Clearing...';
        clearButton.disabled = true;

        // Make AJAX request to clear cart
        fetch('{{ route('cart.clear') }}', {
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

    function updateCartTotals() {
        // Fetch updated cart data
        fetch('{{ route('cart.data') }}', {
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
                const shipping = 0;
                const tax = subtotal * 0.1;
                const total = subtotal + shipping + tax;

                document.getElementById('cart-subtotal').textContent = `${subtotal.toFixed(2)} DJF`;
                document.getElementById('cart-shipping').textContent = `${shipping.toFixed(2)} DJF`;
                document.getElementById('cart-tax').textContent = `${tax.toFixed(2)} DJF`;
                document.getElementById('cart-total').textContent = `${total.toFixed(2)} DJF`;
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
                saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                saveButton.disabled = true;

                // Make AJAX request to save cart to wishlist
                fetch('{{ route('buyer.dashboard.cart.save-to-wishlist') }}', {
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
        buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        buttonElement.disabled = true;

        // Make AJAX request to add to cart
        fetch('{{ route('cart.add') }}', {
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
                    buttonElement.innerHTML = '<i class="fas fa-check"></i> Added!';
                    buttonElement.classList.remove('btn-outline-primary');
                    buttonElement.classList.add('btn-success');

                    // Update wishlist count to ensure accuracy
                    if (typeof window.updateWishlistCount === 'function') {
                        window.updateWishlistCount();
                    }

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
</script>
