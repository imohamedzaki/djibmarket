@extends('layouts.app.buyer')

@section('title', 'Checkout')

@section('content')
    <div class="section-box">
        <div class="breadcrumbs-div">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a class="font-xs color-gray-1000" href="{{ route('buyer.home') }}">Home</a></li>
                    <li><a class="font-xs color-gray-500" href="#">Shop</a></li>
                    <li><a class="font-xs color-gray-500" href="#">Checkout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="section-box shop-template">
        <div class="container">
            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <h6>Please fix the following errors:</h6>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-border">
                            <div class="box-payment">
                                <a class="btn btn-gpay"><img src="{{ asset('assets/imgs/page/checkout/gpay.svg') }}"
                                        alt="Ecom"></a>
                                <a class="btn btn-paypal"><img src="{{ asset('assets/imgs/page/checkout/paypal.svg') }}"
                                        alt="Ecom"></a>
                                <a class="btn btn-amazon"><img src="{{ asset('assets/imgs/page/checkout/amazon.svg') }}"
                                        alt="Ecom"></a>
                            </div>
                            <div class="border-bottom-4 text-center mb-20">
                                <div class="text-or font-md color-gray-500">Or</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 mb-20">
                                    <h5 class="font-md-bold color-brand-3 text-sm-start text-center">Contact information
                                    </h5>
                                </div>
                                <div class="col-lg-6 col-sm-6 mb-20 text-sm-end text-center">
                                    {{-- <span class="font-sm color-brand-3">Already have an account?</span> --}}
                                    {{-- <a class="font-sm color-brand-1" href="{{ route('login') }}"> Login</a> --}}
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control font-sm @error('email') is-invalid @enderror"
                                            type="email" name="email"
                                            value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="Email*"
                                            required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="font-sm color-brand-3" for="checkboxOffers">
                                            <input class="checkboxOffer" id="checkboxOffers" type="checkbox"
                                                name="newsletter">
                                            Keep me up to date on news and exclusive offers
                                        </label>
                                    </div>
                                </div>

                                <!-- Shipping Address Selection -->
                                @if (Auth::check() && $addresses->count() > 0)
                                    <div class="col-lg-12">
                                        <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Select Shipping Address</h5>
                                        <div class="address-selection mb-20">
                                            @foreach ($addresses as $address)
                                                <div class="address-option">
                                                    <label class="address-radio-label">
                                                        <input type="radio" name="shipping_address_id"
                                                            value="{{ $address->id }}"
                                                            {{ ($defaultAddress && $defaultAddress->id == $address->id) || $loop->first ? 'checked' : '' }}
                                                            onchange="toggleAddressForm()">
                                                        <div class="address-card-mini">
                                                            <div class="address-header">
                                                                <strong>{{ $address->title }}</strong>
                                                                @if ($address->is_default)
                                                                    <span class="badge badge-primary">Default</span>
                                                                @endif
                                                            </div>
                                                            <div class="address-details">
                                                                {{ $address->full_name }}<br>
                                                                {{ $address->full_address }}<br>
                                                                {{ $address->phone }}
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            @endforeach

                                            <!-- Option to use new address -->
                                            <div class="address-option">
                                                <label class="address-radio-label">
                                                    <input type="radio" name="shipping_address_id" value=""
                                                        onchange="toggleAddressForm()">
                                                    <div class="address-card-mini new-address">
                                                        <div class="address-header">
                                                            <strong>Use New Address</strong>
                                                        </div>
                                                        <div class="address-details">
                                                            Enter a new shipping address below
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-12" id="address-form"
                                    style="{{ Auth::check() && $addresses->count() > 0 ? 'display: none;' : '' }}">
                                    <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Shipping address</h5>
                                </div>
                                <div class="address-form-fields" id="address-form-fields"
                                    style="{{ Auth::check() && $addresses->count() > 0 ? 'display: none;' : '' }}">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm @error('first_name') is-invalid @enderror"
                                                type="text" name="first_name"
                                                value="{{ old('first_name', Auth::user()->name ?? '') }}"
                                                placeholder="First name*" required data-required="true">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm @error('last_name') is-invalid @enderror"
                                                type="text" name="last_name" value="{{ old('last_name') }}"
                                                placeholder="Last name*" required data-required="true">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control font-sm @error('address_1') is-invalid @enderror"
                                                type="text" name="address_1" value="{{ old('address_1') }}"
                                                placeholder="Address 1*" required data-required="true">
                                            @error('address_1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control font-sm" type="text" name="address_2"
                                                value="{{ old('address_2') }}" placeholder="Address 2">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control font-sm select-style1 color-gray-700"
                                                name="country">
                                                <option value="Djibouti" selected>Djibouti</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="Eritrea">Eritrea</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm @error('city') is-invalid @enderror"
                                                type="text" name="city" value="{{ old('city') }}"
                                                placeholder="City*" required data-required="true">
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control font-sm @error('postal_code') is-invalid @enderror"
                                                type="text" name="postal_code" value="{{ old('postal_code') }}"
                                                placeholder="PostCode / ZIP*" required data-required="true">
                                            @error('postal_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm" type="text" name="company_name"
                                                value="{{ old('company_name') }}" placeholder="Company name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm @error('phone') is-invalid @enderror"
                                                type="text" name="phone"
                                                value="{{ old('phone', Auth::user()->phone ?? '') }}"
                                                placeholder="Phone*" required data-required="true">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-0">
                                            <textarea class="form-control font-sm" name="additional_info" placeholder="Additional Information" rows="5">{{ old('additional_info') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-lg-6 col-5 mb-20">
                                <a class="btn font-sm-bold color-brand-1 arrow-back-1"
                                    href="{{ route('cart.index') }}">Return to Cart</a>
                            </div>
                            <div class="col-lg-6 col-7 mb-20 text-end">
                                <button type="submit" class="btn btn-buy w-auto arrow-next" id="place-order-btn">
                                    Place an Order
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="box-border">
                            <h5 class="font-md-bold mb-20">Your Order</h5>
                            <div class="listCheckout">
                                @foreach ($cartItems as $item)
                                    <div class="item-wishlist">
                                        <div class="wishlist-product">
                                            <div class="product-wishlist">
                                                <div class="product-image">
                                                    <a href="{{ $item['product_url'] }}">
                                                        @if ($item['product_image'])
                                                            <img src="{{ $item['product_image'] }}"
                                                                alt="{{ $item['product_title'] }}">
                                                        @else
                                                            <div class="no-image-placeholder"
                                                                style="width: 80px; height: 80px; background: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 10px;">
                                                                No Image
                                                            </div>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <a href="{{ $item['product_url'] }}">
                                                        <h6 class="color-brand-3">
                                                            {{ Str::limit($item['product_title'], 50) }}</h6>
                                                    </a>
                                                    <div class="rating">
                                                        <span
                                                            class="font-xs color-gray-500">{{ $item['product']->category->name ?? 'Product' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wishlist-status">
                                            <h5 class="color-gray-500">x{{ $item['quantity'] }}</h5>
                                        </div>
                                        <div class="wishlist-price">
                                            <h4 class="color-brand-3 font-lg-bold">
                                                {{ number_format($item['total_price'], 0) }} DJF</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group d-flex mt-15">
                                <input class="form-control mr-15" name="coupon_code" placeholder="Enter Your Coupon">
                                <button type="button" class="btn btn-buy w-auto" onclick="applyCoupon()">Apply</button>
                            </div>
                            <div class="form-group mb-0">
                                <div class="row mb-10">
                                    <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Subtotal</span>
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <span class="font-lg-bold color-brand-3">{{ number_format($subtotal, 0) }}
                                            DJF</span>
                                    </div>
                                </div>
                                <div class="border-bottom mb-10 pb-5">
                                    <div class="row">
                                        <div class="col-lg-6 col-6"><span
                                                class="font-md-bold color-brand-3">Shipping</span></div>
                                        <div class="col-lg-6 col-6 text-end">
                                            <span class="font-lg-bold color-brand-3">{{ number_format($shippingCost, 0) }}
                                                DJF</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($taxAmount > 0)
                                    <div class="border-bottom mb-10 pb-5">
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><span
                                                    class="font-md-bold color-brand-3">Tax</span></div>
                                            <div class="col-lg-6 col-6 text-end">
                                                <span
                                                    class="font-lg-bold color-brand-3">{{ number_format($taxAmount, 0) }}
                                                    DJF</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Total</span>
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <span class="font-lg-bold color-brand-3"
                                            id="order-total">{{ number_format($finalTotal, 0) }} DJF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <style>
        .box-border {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .box-payment {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: center;
        }

        .box-payment .btn {
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            transition: all 0.3s;
        }

        .box-payment .btn:hover {
            border-color: #007bff;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.2);
        }

        .border-bottom-4 {
            position: relative;
            margin: 20px 0;
        }

        .border-bottom-4::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e0e0e0;
        }

        .text-or {
            background: white;
            padding: 0 15px;
            position: relative;
            z-index: 1;
        }

        .form-group {
            margin-bottom: 20px;
        }



        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .checkboxOffer {
            margin-right: 8px;
        }

        /* Address Selection Styles */
        .address-selection {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .address-option {
            position: relative;
        }

        .address-radio-label {
            display: block;
            cursor: pointer;
            margin: 0;
        }

        .address-radio-label input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .address-card-mini {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            transition: all 0.3s ease;
            background: white;
        }

        .address-card-mini.new-address {
            border-style: dashed;
            background: #f8f9fa;
        }

        .address-radio-label input[type="radio"]:checked+.address-card-mini {
            border-color: #007bff;
            background: #f0f8ff;
        }

        .address-card-mini:hover {
            border-color: #007bff;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.15);
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .address-details {
            font-size: 14px;
            color: #666;
            line-height: 1.4;
        }

        .badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .badge-primary {
            background-color: #007bff;
            color: white;
        }

        .listCheckout .item-wishlist {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .listCheckout .item-wishlist:last-child {
            border-bottom: none;
        }

        .listCheckout .product-image {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        .listCheckout .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .listCheckout .wishlist-product {
            flex: 1;
        }

        .listCheckout .wishlist-status {
            margin: 0 15px;
        }

        .listCheckout .wishlist-price {
            min-width: 100px;
            text-align: right;
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

        @media (max-width: 768px) {
            .address-selection {
                gap: 10px;
            }

            .address-card-mini {
                padding: 12px;
            }
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

        function toggleAddressForm() {
            const selectedAddress = document.querySelector('input[name="shipping_address_id"]:checked');
            const addressForm = document.getElementById('address-form');
            const addressFormFields = document.getElementById('address-form-fields');

            if (selectedAddress && selectedAddress.value === '') {
                // Show address form for new address
                addressForm.style.display = 'block';
                addressFormFields.style.display = 'block';

                // Make form fields required for HTML5 validation
                const requiredFields = addressFormFields.querySelectorAll('input[data-required="true"]');
                requiredFields.forEach(field => field.required = true);
            } else {
                // Hide address form when existing address is selected
                addressForm.style.display = 'none';
                addressFormFields.style.display = 'none';

                // Remove required attribute for HTML5 validation since server-side handles this
                const requiredFields = addressFormFields.querySelectorAll('input[required]');
                requiredFields.forEach(field => {
                    field.setAttribute('data-required', 'true'); // Store original required state
                    field.required = false;
                });
            }
        }

        function applyCoupon() {
            const couponCode = document.querySelector('input[name="coupon_code"]').value;
            if (!couponCode) {
                showNotification('Please enter a coupon code', 'error');
                return;
            }

            // Here you would implement coupon validation
            showNotification('Coupon functionality will be implemented soon', 'info');
        }

        // Form submission handling
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            console.log('Form submission started');

            // Check if cart is empty
            const cartItems = document.querySelectorAll('.listCheckout .item-wishlist');
            if (cartItems.length === 0) {
                e.preventDefault();
                showNotification('Your cart is empty. Please add some items before checkout.', 'error');
                return false;
            }

            // Check if an address is selected when addresses are available
            const addressRadios = document.querySelectorAll('input[name="shipping_address_id"]');
            if (addressRadios.length > 0) {
                const selectedAddress = document.querySelector('input[name="shipping_address_id"]:checked');
                if (!selectedAddress) {
                    e.preventDefault();
                    showNotification('Please select a shipping address', 'error');
                    return false;
                }

                // If "Use New Address" is selected, validate required fields
                if (selectedAddress.value === '') {
                    const requiredFields = document.querySelectorAll(
                        '#address-form-fields input[data-required="true"]');
                    let hasErrors = false;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            hasErrors = true;
                            field.classList.add('is-invalid');
                        } else {
                            field.classList.remove('is-invalid');
                        }
                    });

                    if (hasErrors) {
                        e.preventDefault();
                        showNotification('Please fill in all required address fields', 'error');
                        return false;
                    }
                }
            }

            const submitBtn = document.getElementById('place-order-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Processing...';
            showLoading();
        });

        // Show notification for flash messages
        @if (session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if (session('error'))
            showNotification('{{ session('error') }}', 'error');
            // Reset button state if there's an error
            const submitBtn = document.getElementById('place-order-btn');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Place Order';
            }
            hideLoading();
        @endif

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className =
                `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} alert-dismissible fade show`;
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

        // Initialize address form visibility on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleAddressForm();
        });
    </script>
@endsection
