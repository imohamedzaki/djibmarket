@if (empty($cartItems))
    <div class="cart-empty">
        <div class="cart-empty-icon">🛒</div>
        <p class="font-sm color-brand-3">Your cart is empty</p>
        <p class="font-xs color-gray-500">Add some products to get started</p>
    </div>
@else
    <div class="cart-items">
        @foreach ($cartItems as $item)
            <div class="item-cart mb-20" data-product-id="{{ $item['product_id'] }}">
                <button class="cart-remove" onclick="removeFromCart({{ $item['product_id'] }})" title="Remove item">
                    ×
                </button>
                <div class="cart-image">
                    @if ($item['product_image'])
                        <img src="{{ $item['product_image'] }}" alt="{{ $item['product_title'] }}">
                    @else
                        <div class="no-image-placeholder">
                            <span>No Image</span>
                        </div>
                    @endif
                </div>
                <div class="cart-info">
                    <a class="font-sm-bold color-brand-3" href="{{ $item['product_url'] }}">
                        {{ Str::limit($item['product_title'], 50) }}
                    </a>
                    <div class="quantity-controls">
                        <button class="quantity-btn"
                            onclick="updateQuantity({{ $item['product_id'] }}, {{ $item['quantity'] - 1 }})">-</button>
                        <input type="number" class="quantity-input" value="{{ $item['quantity'] }}" min="1"
                            max="{{ $item['product']->stock_quantity }}"
                            onchange="updateQuantity({{ $item['product_id'] }}, this.value)">
                        <button class="quantity-btn"
                            onclick="updateQuantity({{ $item['product_id'] }}, {{ $item['quantity'] + 1 }})">+</button>
                    </div>
                    <p><span class="color-brand-2 font-sm-bold">{{ $item['quantity'] }} x
                            {{ number_format($item['unit_price'], 0) }} DJF</span></p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border-bottom pt-0 mb-15"></div>
    <div class="cart-total">
        <div class="row">
            <div class="col-6 text-start">
                <span class="font-md-bold color-brand-3">Total</span>
            </div>
            <div class="col-6">
                <span class="font-md-bold color-brand-1" id="cart-total">{{ number_format($cartTotal, 0) }}
                    DJF</span>
            </div>
        </div>
        <div class="row mt-15">
            <div class="col-6 text-start">
                <a class="btn btn-cart w-auto" href="{{ route('cart.index') }}">View cart</a>
            </div>
            <div class="col-6">
                <a class="btn btn-buy w-auto" href="{{ route('checkout.index') ?? '#' }}">Checkout</a>
            </div>
        </div>
    </div>
@endif
