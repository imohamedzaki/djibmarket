<style>
    .dropdown-cart {
        max-height: 400px;
        overflow-y: auto;
    }

    .cart-empty {
        text-align: center;
        padding: 40px 20px;
        color: #666;
    }

    .cart-empty-icon {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 15px;
    }

    .item-cart {
        position: relative;
        padding-right: 30px;
    }

    .cart-remove {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.2s;
    }

    .cart-remove:hover {
        background: #c82333;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 5px;
    }

    .quantity-btn {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        width: 25px;
        height: 25px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background: #e9ecef;
    }

    .quantity-input {
        width: 40px;
        height: 25px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        font-size: 12px;
    }

    .cart-loading {
        opacity: 0.6;
        pointer-events: none;
    }

    .no-image-placeholder {
        width: 100%;
        height: 60px;
        background: #f8f9fa;
        border: 1px dashed #dee2e6;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 12px;
    }

    .cart-image img {
        max-height: 5rem;
        object-fit: contain;
        border: 2px solid #6c757d29;
        border-radius: .5rem;
    }
</style>

<div class="dropdown-cart" id="cart-dropdown">
    @php
        $cartService = app(\App\Services\CartService::class);
        $cartItems = $cartService->getCartItems();
        $cartTotal = $cartService->getCartTotal();
        $cartCount = $cartService->getCartCount();
    @endphp

    @include('layouts.app.partials.buyer.cart-content', compact('cartItems', 'cartTotal', 'cartCount'))
</div>

<script>
    // Cart functionality
    function addToCart(productId, quantity = 1) {
        const cartDropdown = document.getElementById('cart-dropdown');
        cartDropdown.classList.add('cart-loading');

        fetch('{{ route('cart.add') }}', {
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
                    updateCartUI();
                    showNotification(data.message, 'success');
                    // Update wishlist count to ensure accuracy
                    if (typeof window.updateWishlistCount === 'function') {
                        window.updateWishlistCount();
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
                cartDropdown.classList.remove('cart-loading');
            });
    }

    function removeFromCart(productId) {
        const cartDropdown = document.getElementById('cart-dropdown');
        cartDropdown.classList.add('cart-loading');

        fetch('{{ route('cart.remove') }}', {
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
                    updateCartUI();
                    showNotification(data.message, 'success');
                    // Update wishlist count to ensure accuracy
                    if (typeof window.updateWishlistCount === 'function') {
                        window.updateWishlistCount();
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
                cartDropdown.classList.remove('cart-loading');
            });
    }

    function updateQuantity(productId, quantity) {
        if (quantity < 0) return;

        const cartDropdown = document.getElementById('cart-dropdown');
        cartDropdown.classList.add('cart-loading');

        fetch('{{ route('cart.update') }}', {
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
                    updateCartUI();
                    if (data.message !== 'Cart updated') {
                        showNotification(data.message, 'success');
                    }
                    // Update wishlist count to ensure accuracy
                    if (typeof window.updateWishlistCount === 'function') {
                        window.updateWishlistCount();
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
                cartDropdown.classList.remove('cart-loading');
            });
    }

    function updateCartUI() {
        // Get updated cart HTML content
        fetch('{{ route('cart.html') }}', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update cart count in header
                const cartCountElements = document.querySelectorAll('.number-item');
                cartCountElements.forEach(element => {
                    element.textContent = data.count;
                });

                // Update cart dropdown content
                const cartDropdown = document.getElementById('cart-dropdown');
                if (cartDropdown) {
                    cartDropdown.innerHTML = data.html;
                }
            })
            .catch(error => {
                console.error('Error updating cart UI:', error);
                // Fallback to page reload if AJAX fails
                location.reload();
            });
    }

    function showNotification(message, type = 'info') {
        // Create notification element
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

        // Auto remove after 3 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 3000);
    }

    // Make functions globally available
    window.addToCart = addToCart;
    window.removeFromCart = removeFromCart;
    window.updateQuantity = updateQuantity;
    window.updateCartUI = updateCartUI;
</script>
