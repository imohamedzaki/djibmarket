
<?php $__env->startSection('title', 'Checkout'); ?>

<!-- Leaflet CSS and JS for map functionality -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<?php $__env->startSection('dashboard-content'); ?>
    <!-- Breadcrumb -->
    <?php if (isset($component)) { $__componentOriginal8f244c6f5098027f3325f8df162e270b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8f244c6f5098027f3325f8df162e270b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.buyer.breadcrumb','data' => ['items' => [
        ['text' => 'Home', 'url' => route('buyer.home')],
        ['text' => 'Checkout', 'url' => route('checkout.index')],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('buyer.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['text' => 'Home', 'url' => route('buyer.home')],
        ['text' => 'Checkout', 'url' => route('checkout.index')],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8f244c6f5098027f3325f8df162e270b)): ?>
<?php $attributes = $__attributesOriginal8f244c6f5098027f3325f8df162e270b; ?>
<?php unset($__attributesOriginal8f244c6f5098027f3325f8df162e270b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8f244c6f5098027f3325f8df162e270b)): ?>
<?php $component = $__componentOriginal8f244c6f5098027f3325f8df162e270b; ?>
<?php unset($__componentOriginal8f244c6f5098027f3325f8df162e270b); ?>
<?php endif; ?>

    <div class="checkout-container">
        <div class="checkout-wrapper">
            <!-- Checkout Header -->
            <div class="checkout-header">
                <div class="checkout-header-content">
                    <div>
                        <h1>Checkout</h1>
                        <p>Complete your order and get your items delivered.</p>
                    </div>
                    <div class="checkout-stats">
                        <?php if($cartItems && count($cartItems) > 0): ?>
                            <span class="item-count"><?php echo e(count($cartItems)); ?>

                                <?php echo e(Str::plural('item', count($cartItems))); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <form action="<?php echo e(route('checkout.store')); ?>" method="POST" id="checkout-form">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <i class="ti ti-alert-circle alert-icon"></i>
                        <div>
                            <h6>Please fix the following errors:</h6>
                            <ul style="margin: 0; padding-left: 16px;">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="checkout-layout">
                    <!-- Main Checkout Content -->
                    <div class="checkout-main-section">
                        <!-- Contact Information Card -->
                        <div class="checkout-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="ti ti-mail me-2"></i>
                                    Contact Information
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <?php if(auth()->guard()->check()): ?>
                                        <label class="form-label">Email Address</label>
                                        <input class="form-control" type="email" name="email"
                                            value="<?php echo e(Auth::user()->email); ?>" readonly>
                                        <small class="form-text">
                                            <i class="ti ti-info-circle me-1"></i>
                                            Using your account email. To change this, please update your profile.
                                        </small>
                                    <?php else: ?>
                                        <label class="form-label">Email Address *</label>
                                        <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email"
                                            name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter your email address"
                                            required>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="form-checkbox">
                                        <input type="checkbox" name="newsletter" id="newsletter">
                                        <span class="checkmark"></span>
                                        Keep me up to date on news and exclusive offers
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address Card -->
                        <div class="checkout-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="ti ti-truck me-2"></i>
                                    Shipping Address
                                </h3>
                            </div>
                            <div class="card-body">
                                <?php if(Auth::check() && $addresses->count() > 0): ?>
                                    <div class="address-selection">
                                        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="address-option">
                                                <label class="address-radio-label">
                                                    <input type="radio" name="shipping_address_id"
                                                        value="<?php echo e($address->id); ?>"
                                                        <?php echo e(($defaultAddress && $defaultAddress->id == $address->id) || $loop->first ? 'checked' : ''); ?>

                                                        onchange="toggleAddressForm()">
                                                    <div class="address-card">
                                                        <div class="address-header">
                                                            <div class="address-title">
                                                                <strong><?php echo e($address->title); ?></strong>
                                                                <?php if($address->is_default): ?>
                                                                    <span class="badge badge-primary">Default</span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="address-details">
                                                            <div class="address-name">
                                                                <?php echo e($address->full_name); ?></div>
                                                            <div class="address-info">
                                                                <?php echo e($address->full_address); ?></div>
                                                            <div class="address-phone"><?php echo e($address->phone); ?>

                                                            </div>
                                                            <?php if($address->hasCoordinates()): ?>
                                                                <div class="address-coords">
                                                                    <i class="ti ti-map-pin me-1"></i>
                                                                    <?php echo e($address->coordinates); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Add New Address Option -->
                                        <div class="address-option">
                                            <div class="address-card new-address-card" onclick="openNewAddressModal()">
                                                <div class="new-address-content">
                                                    <i class="ti ti-plus-circle me-2"></i>
                                                    <div>
                                                        <strong>Use New Address</strong>
                                                        <p>Add a new shipping address with map selection</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Manual Address Form -->
                                    <div class="address-form" id="address-form">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">First Name *</label>
                                                <input class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="text" name="first_name"
                                                    value="<?php echo e(old('first_name', Auth::user()->name ?? '')); ?>"
                                                    placeholder="Enter your first name" required>
                                                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Last Name *</label>
                                                <input class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="text" name="last_name" value="<?php echo e(old('last_name')); ?>"
                                                    placeholder="Enter your last name" required>
                                                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Address Line 1 *</label>
                                            <input class="form-control <?php $__errorArgs = ['address_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="address_1" value="<?php echo e(old('address_1')); ?>"
                                                placeholder="Street address, P.O. box, company name" required>
                                            <?php $__errorArgs = ['address_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Address Line 2</label>
                                            <input class="form-control" type="text" name="address_2"
                                                value="<?php echo e(old('address_2')); ?>"
                                                placeholder="Apartment, suite, unit, building, floor, etc.">
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">Country *</label>
                                                <select class="form-control" name="country">
                                                    <option value="Djibouti" selected>Djibouti</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">City *</label>
                                                <input class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="text" name="city" value="<?php echo e(old('city')); ?>"
                                                    placeholder="Enter your city" required>
                                                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group">
                                                <label class="form-label">PostCode / ZIP *</label>
                                                <input class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="text" name="postal_code" value="<?php echo e(old('postal_code')); ?>"
                                                    placeholder="Enter postal code" required>
                                                <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Phone Number *</label>
                                                <input class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    type="text" name="phone"
                                                    value="<?php echo e(old('phone', Auth::user()->phone ?? '')); ?>"
                                                    placeholder="Enter your phone number" required>
                                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Company Name</label>
                                            <input class="form-control" type="text" name="company_name"
                                                value="<?php echo e(old('company_name')); ?>"
                                                placeholder="Enter company name (optional)">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Additional Information</label>
                                            <textarea class="form-control" name="additional_info" rows="3"
                                                placeholder="Any special delivery instructions..."><?php echo e(old('additional_info')); ?></textarea>
                                        </div>

                                        <!-- Hidden coordinates fields -->
                                        <input type="hidden" name="latitude" id="new_latitude" value="">
                                        <input type="hidden" name="longitude" id="new_longitude" value="">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="checkout-navigation">
                            <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-outline-secondary">
                                <i class="ti ti-arrow-left me-2"></i>
                                Return to Cart
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg" id="place-order-btn"
                                onclick="handleOrderSubmit(event, this)">
                                <i class="ti ti-credit-card me-2"></i>
                                <span class="btn-text">Place Order</span>
                            </button>
                        </div>
                    </div>

                    <!-- Order Summary Section -->
                    <div class="checkout-summary-section">
                        <div class="checkout-summary-card">
                            <div class="summary-header">
                                <h3 class="section-title">
                                    <i class="ti ti-shopping-cart me-2"></i>
                                    Order Summary
                                </h3>
                            </div>

                            <div class="summary-content">
                                <!-- Order Items -->
                                <div class="order-items">
                                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="order-item">
                                            <div class="item-image">
                                                <?php if($item['product_image']): ?>
                                                    <img src="<?php echo e($item['product_image']); ?>"
                                                        alt="<?php echo e($item['product_title']); ?>"
                                                        onerror="this.src='<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>'">
                                                <?php else: ?>
                                                    <div class="image-placeholder">
                                                        <i class="ti ti-photo"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="item-details">
                                                <h4 class="item-title">
                                                    <a
                                                        href="<?php echo e($item['product_url']); ?>"><?php echo e(Str::limit($item['product_title'], 40)); ?></a>
                                                </h4>
                                                <div class="item-meta">
                                                    <span
                                                        class="item-category"><?php echo e($item['product']->category->name ?? 'Product'); ?></span>
                                                    <span class="item-quantity">Qty:
                                                        <?php echo e($item['quantity']); ?></span>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <?php echo e(number_format($item['total_price'], 0)); ?> DJF
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <!-- Coupon Section -->
                                <div class="coupon-section">
                                    <div class="coupon-input-group">
                                        <input class="form-control" name="coupon_code" placeholder="Enter coupon code">
                                        <button type="button" class="btn btn-outline-primary" onclick="applyCoupon()">
                                            Apply
                                        </button>
                                    </div>
                                </div>

                                <!-- Order Totals -->
                                <div class="order-totals">
                                    <div class="total-row">
                                        <span class="total-label">Subtotal</span>
                                        <span class="total-value"><?php echo e(number_format($subtotal, 0)); ?> DJF</span>
                                    </div>
                                    <div class="total-row">
                                        <span class="total-label">Shipping</span>
                                        <span class="total-value"><?php echo e(number_format($shippingCost, 0)); ?>

                                            DJF</span>
                                    </div>
                                    <?php if($taxAmount > 0): ?>
                                        <div class="total-row">
                                            <span class="total-label">Tax</span>
                                            <span class="total-value"><?php echo e(number_format($taxAmount, 0)); ?>

                                                DJF</span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="total-divider"></div>
                                    <div class="total-row total-final">
                                        <span class="total-label">Total</span>
                                        <span class="total-value" id="order-total"><?php echo e(number_format($finalTotal, 0)); ?>

                                            DJF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- New Address Modal -->
    <?php if(auth()->guard()->check()): ?>
        <div class="modal fade" id="newAddressModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?php echo e(route('buyer.dashboard.addresses.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <!-- Map Selection Section -->
                            <div class="map-section">
                                <h6 class="section-title"><i class="fas fa-map-marker-alt me-2"></i>Select Location on Map
                                </h6>
                                <div class="map-controls">
                                    <div class="map-search-container">
                                        <i class="fas fa-search map-search-icon"></i>
                                        <input type="text" id="add-map-search" class="map-search-input"
                                            placeholder="Search for locations within Djibouti only...">
                                    </div>
                                    <button type="button" class="btn btn-outline-primary" id="add-current-location-btn">
                                        <i class="fas fa-crosshairs me-1"></i> My Location
                                    </button>
                                </div>
                                <div id="add-map" class="map-container"></div>
                                <div id="add-location-info" class="location-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>Location Information</h6>
                                    <div class="location-details"></div>
                                    <div class="coordinates-info">
                                        <small class="coordinates-display">Click on map to see coordinates</small>
                                    </div>
                                </div>
                                <small class="map-help-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    You can search for a location, click on the map, drag the marker, or use "My Location" to
                                    detect your current position.
                                </small>
                            </div>

                            <div class="form-divider"></div>

                            <!-- Manual Address Entry -->
                            <h6 class="section-title"><i class="fas fa-edit me-2"></i>Address Details</h6>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="type" class="form-label">Address Type *</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="home">Home</option>
                                        <option value="work">Work</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="form-label">Address Title *</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="e.g., Home, Office" required>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="address_line_1" class="form-label">Address Line 1 *</label>
                                <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                                    placeholder="Street address, P.O. box, company name" required>
                            </div>

                            <div class="form-group">
                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                                    placeholder="Apartment, suite, unit, building, floor, etc.">
                            </div>

                            <div class="form-grid form-grid-3">
                                <div class="form-group">
                                    <label for="city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                                <div class="form-group">
                                    <label for="state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                                <div class="form-group">
                                    <label for="postal_code" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country" class="form-label">Country *</label>
                                <input type="text" class="form-control" id="country" name="country" value="Djibouti"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="notes" class="form-label">Delivery Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"
                                    placeholder="Any special delivery instructions..."></textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-checkbox">
                                    <input class="checkbox-input" type="checkbox" id="is_default" name="is_default"
                                        value="1">
                                    <label class="checkbox-label" for="is_default">Set as default address</label>
                                </div>
                            </div>

                            <!-- Hidden fields for coordinates -->
                            <input type="hidden" id="latitude" name="latitude" value="">
                            <input type="hidden" id="longitude" name="longitude" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <style>
        :root {
            /* Colors from cart page */
            --primary-50: #eff6ff;
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --primary-700: #1d4ed8;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-900: #111827;
            --green-50: #f0fdf4;
            --green-600: #16a34a;
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 16px;
            --spacing-lg: 24px;
            --spacing-xl: 32px;
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.5;
        }

        .checkout-container {
            min-height: 100vh;
            background: var(--gray-50);
        }

        .checkout-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-xl);
        }

        /* Header */
        .checkout-header {
            margin-bottom: var(--spacing-xl);
        }

        .checkout-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }

        .checkout-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
            line-height: 1.2;
        }

        .checkout-header p {
            color: var(--gray-600);
            margin: 0;
            font-size: 14px;
        }

        .checkout-stats {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .item-count {
            background: var(--gray-100);
            color: var(--gray-600);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Layout */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
        }

        /* Cards */
        .checkout-card,
        .checkout-summary-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: var(--spacing-lg);
            overflow: hidden;
        }

        .checkout-card:hover,
        .checkout-summary-card:hover {
            box-shadow: var(--shadow-md);
            transition: box-shadow 0.2s ease;
        }

        .card-header,
        .summary-header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: var(--spacing-lg);
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
            display: flex;
            align-items: center;
        }

        .card-body,
        .summary-content {
            padding: var(--spacing-lg);
        }

        /* Forms */
        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-md);
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: var(--spacing-sm);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: var(--white);
            color: var(--gray-900);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-600);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: var(--spacing-xs);
        }

        .form-text {
            font-size: 0.75rem;
            color: var(--gray-600);
            margin-top: var(--spacing-xs);
            display: block;
        }

        /* Custom Checkbox */
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            font-size: 0.875rem;
            color: var(--gray-700);
            cursor: pointer;
            margin: 0;
        }

        .form-checkbox input[type="checkbox"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid var(--gray-300);
            border-radius: var(--radius-sm);
            background: var(--white);
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .form-checkbox input[type="checkbox"]:checked {
            background: var(--primary-600);
            border-color: var(--primary-600);
        }

        .form-checkbox input[type="checkbox"]:checked::before {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        /* Address Selection */
        .address-selection {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
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

        .address-card {
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            padding: var(--spacing-md);
            transition: all 0.3s ease;
            background: var(--white);
        }

        .address-radio-label input[type="radio"]:checked+.address-card {
            border-color: var(--primary-600);
            background: var(--primary-50);
        }

        .address-card:hover {
            border-color: var(--primary-600);
            box-shadow: var(--shadow-sm);
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-sm);
        }

        .address-title {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: var(--radius-sm);
            font-weight: 500;
        }

        .badge-primary {
            background-color: var(--primary-600);
            color: white;
        }

        .address-details {
            font-size: 0.875rem;
            color: var(--gray-600);
            line-height: 1.4;
        }

        .address-name {
            font-weight: 500;
            color: var(--gray-900);
            margin-bottom: 2px;
        }

        .address-info,
        .address-phone {
            margin-bottom: 2px;
        }

        .address-coords {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-top: var(--spacing-xs);
        }

        /* New Address Card */
        .new-address-card {
            border-style: dashed;
            background: var(--gray-50);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-lg);
        }

        .new-address-card:hover {
            background: var(--primary-50);
            border-color: var(--primary-600);
            transform: translateY(-1px);
        }

        .new-address-content {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .new-address-content i {
            font-size: 1.25rem;
            color: var(--primary-600);
        }

        .new-address-content strong {
            color: var(--gray-900);
            font-size: 0.875rem;
        }

        .new-address-content p {
            color: var(--gray-600);
            font-size: 0.75rem;
            margin: 2px 0 0 0;
        }

        /* Order Summary */
        .order-items {
            margin-bottom: var(--spacing-lg);
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            padding: var(--spacing-md) 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            overflow: hidden;
            background: var(--gray-100);
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            font-size: 1.5rem;
        }

        .item-details {
            flex: 1;
            min-width: 0;
        }

        .item-title {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-900);
            margin: 0 0 4px 0;
            line-height: 1.3;
        }

        .item-title a {
            color: var(--gray-900);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .item-title a:hover {
            color: var(--primary-700);
            text-decoration: none;
        }

        .item-meta {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .item-category,
        .item-quantity {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .item-price {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            text-align: right;
        }

        /* Coupon Section */
        .coupon-section {
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-lg);
            border-bottom: 1px solid var(--gray-200);
        }

        .coupon-input-group {
            display: flex;
            gap: var(--spacing-sm);
        }

        .coupon-input-group .form-control {
            flex: 1;
        }

        /* Order Totals */
        .order-totals {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-sm);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .total-value {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .total-divider {
            height: 1px;
            background: var(--gray-200);
            margin: var(--spacing-sm) 0;
        }

        .total-final {
            margin-top: var(--spacing-sm);
            padding-top: var(--spacing-sm);
            border-top: 1px solid var(--gray-200);
        }

        .total-final .total-label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .total-final .total-value {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-600);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-sm);
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            cursor: pointer;
            line-height: 1;
        }

        .btn-primary {
            background: var(--primary-600);
            color: var(--white);
            border-color: var(--primary-600);
        }

        .btn-primary:hover {
            background: var(--primary-700);
            border-color: var(--primary-700);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-primary {
            background: transparent;
            color: var(--primary-600);
            border-color: var(--primary-600);
        }

        .btn-outline-primary:hover {
            background: var(--primary-600);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--gray-600);
            border-color: var(--gray-300);
        }

        .btn-outline-secondary:hover {
            background: var(--gray-100);
            color: var(--gray-700);
            text-decoration: none;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        /* Navigation */
        .checkout-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: var(--spacing-lg);
            border-top: 1px solid var(--gray-200);
        }

        /* Alert */
        .alert {
            border-radius: var(--radius-md);
            border: 1px solid;
            padding: var(--spacing-md) var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-sm);
        }

        .alert-danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .alert-icon {
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            border-bottom: 1px solid var(--gray-200);
            padding: var(--spacing-lg);
        }

        .modal-body {
            padding: var(--spacing-lg);
        }

        .modal-footer {
            border-top: 1px solid var(--gray-200);
            padding: var(--spacing-lg);
        }

        .section-subtitle {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: var(--spacing-md);
            display: flex;
            align-items: center;
        }

        .modal-form .form-row {
            margin-bottom: var(--spacing-md);
        }

        .modal-form .form-group {
            margin-bottom: var(--spacing-md);
        }

        /* Map Section */
        .map-section {
            margin-bottom: var(--spacing-lg);
        }

        .map-controls {
            display: flex;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
        }

        .map-search-container {
            position: relative;
            flex: 1;
        }

        .map-search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
        }

        .map-search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
        }

        .map-container {
            height: 300px;
            width: 100%;
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-300);
            margin-bottom: var(--spacing-md);
        }

        .location-info {
            background: var(--gray-50);
            border-radius: var(--radius-md);
            padding: var(--spacing-md);
            display: none;
        }

        .location-info.show {
            display: block;
        }

        .location-info h6 {
            margin-bottom: var(--spacing-sm);
            color: var(--gray-900);
            font-weight: 600;
            font-size: 0.875rem;
        }

        .location-details {
            color: var(--gray-700);
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .coordinates-info {
            margin-top: var(--spacing-sm);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-md);
        }

        .form-grid-3 {
            grid-template-columns: 1fr 1fr 1fr;
        }

        .form-divider {
            height: 1px;
            background: var(--gray-200);
            margin: var(--spacing-xl) 0;
        }

        .checkbox-input {
            width: 16px;
            height: 16px;
            border-radius: var(--radius-sm);
        }

        .checkbox-label {
            font-size: 14px;
            color: var(--gray-700);
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .checkout-layout {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
            }

            .checkout-wrapper {
                padding: var(--spacing-lg);
            }

            .checkout-header-content {
                flex-direction: column;
                align-items: stretch;
                gap: var(--spacing-md);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-grid-3 {
                grid-template-columns: 1fr;
            }

            .map-controls {
                flex-direction: column;
            }
        }

        @media (max-width: 640px) {
            .checkout-wrapper {
                padding: var(--spacing-md);
            }

            .checkout-header h1 {
                font-size: 20px;
            }

            .card-body,
            .summary-content {
                padding: var(--spacing-md);
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }

            .checkout-navigation {
                flex-direction: column-reverse;
                gap: var(--spacing-md);
                align-items: stretch;
            }

            .checkout-navigation .btn {
                width: 100%;
            }

            .coupon-input-group {
                flex-direction: column;
            }

            .modal-body,
            .modal-header,
            .modal-footer {
                padding: var(--spacing-md);
            }

            .map-container {
                height: 300px;
            }
        }

        /* Loading spinner animation */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        function handleOrderSubmit(event, button) {
            // Prevent default action temporarily
            event.preventDefault();

            // Add loading state
            const icon = button.querySelector('i');
            const textSpan = button.querySelector('.btn-text');

            // Change to loading state
            icon.className = 'ti ti-loader-2 me-2';
            icon.style.animation = 'spin 1s linear infinite';
            textSpan.textContent = 'Processing your order...';
            button.style.pointerEvents = 'none';
            button.style.opacity = '0.8';

            // Submit the form after a brief delay
            setTimeout(() => {
                document.getElementById('checkout-form').submit();
            }, 500);
        }

        function toggleAddressForm() {
            // This function can be used if needed for address form toggling
        }

        function openNewAddressModal() {
            const modal = new bootstrap.Modal(document.getElementById('newAddressModal'));
            modal.show();
        }

        function applyCoupon() {
            const couponCode = document.querySelector('input[name="coupon_code"]').value;
            if (!couponCode) {
                showNotification('Please enter a coupon code', 'error');
                return;
            }
            showNotification('Coupon functionality will be implemented soon', 'info');
        }

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
                box-shadow: var(--shadow-lg);
            `;
            notification.innerHTML = `
                <i class="ti ti-${type === 'error' ? 'alert-circle' : type === 'success' ? 'check' : 'info-circle'} me-2"></i>
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

        // Map functionality
        let map;
        let marker;
        let geocoder;
        let selectedPlace = null;
        let currentModal = null;

        function initializeMapInModal(modalId) {
            const mapElement = document.getElementById(modalId === 'newAddressModal' ? 'add-map' : 'edit-map');
            const searchInput = document.getElementById(modalId === 'newAddressModal' ? 'add-map-search' :
                'edit-map-search');
            const currentLocationBtn = document.getElementById(modalId === 'newAddressModal' ? 'add-current-location-btn' :
                'edit-current-location-btn');

            if (!mapElement) return;

            // Clear any existing map
            if (map) {
                map.remove();
            }

            // Default location: Djibouti City, Djibouti
            let djiboutiLocation = [11.5721, 43.1456];

            // Define Djibouti's geographic bounds
            const djiboutiBounds = L.latLngBounds(
                L.latLng(10.9, 41.75), // Southwest corner
                L.latLng(12.8, 43.65) // Northeast corner
            );

            // Create map with OpenStreetMap tiles, restricted to Djibouti
            map = L.map(mapElement, {
                center: djiboutiLocation,
                zoom: 13,
                minZoom: 8,
                maxZoom: 18,
                maxBounds: djiboutiBounds,
                maxBoundsViscosity: 1.0
            });

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                bounds: djiboutiBounds
            }).addTo(map);

            // Create draggable marker
            marker = L.marker(djiboutiLocation, {
                draggable: true,
                title: 'Selected Location'
            }).addTo(map);

            // Initialize geocoder for search - restricted to Djibouti only
            geocoder = L.Control.Geocoder.nominatim({
                geocodingQueryParams: {
                    countrycodes: 'dj',
                    bounded: 1,
                    viewbox: '41.75,10.9,43.65,12.8',
                    limit: 10
                }
            });

            // Handle search input
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        searchLocation(this.value, modalId);
                    }
                });
            }

            // Handle current location button
            if (currentLocationBtn) {
                currentLocationBtn.addEventListener('click', function() {
                    getCurrentLocation(modalId);
                });
            }

            // Listen for marker drag - ensure it stays within Djibouti
            marker.on('dragend', function(e) {
                const position = e.target.getLatLng();
                const lat = position.lat;
                const lng = position.lng;

                if (lat >= 10.9 && lat <= 12.8 && lng >= 41.75 && lng <= 43.65) {
                    updateCoordinates(position, modalId);
                    reverseGeocode(position, modalId);
                } else {
                    marker.setLatLng(djiboutiLocation);
                    updateCoordinates({
                        lat: djiboutiLocation[0],
                        lng: djiboutiLocation[1]
                    }, modalId);
                    alert('Marker must stay within Djibouti borders.');
                }
            });

            // Listen for map clicks - restrict to Djibouti bounds
            map.on('click', function(e) {
                const position = e.latlng;
                const lat = position.lat;
                const lng = position.lng;

                if (lat >= 10.9 && lat <= 12.8 && lng >= 41.75 && lng <= 43.65) {
                    marker.setLatLng(position);
                    updateCoordinates(position, modalId);
                    reverseGeocode(position, modalId);
                }
            });

            // Update coordinates display initially
            updateCoordinates({
                lat: djiboutiLocation[0],
                lng: djiboutiLocation[1]
            }, modalId);

            currentModal = modalId;

            // Invalidate size to ensure proper rendering
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        }

        function getCurrentLocation(modalId) {
            const btn = document.getElementById(modalId === 'newAddressModal' ? 'add-current-location-btn' :
                'edit-current-location-btn');
            const originalText = btn.innerHTML;

            if (!navigator.geolocation) {
                alert('Geolocation is not supported by this browser.');
                return;
            }

            btn.innerHTML = '<i class="fas fa-loader spin me-1"></i> Detecting...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    if (lat >= 10.9 && lat <= 12.8 && lng >= 41.75 && lng <= 43.65) {
                        const latlng = L.latLng(lat, lng);
                        map.setView(latlng, 15);
                        marker.setLatLng(latlng);
                        updateCoordinates(latlng, modalId);
                        reverseGeocode(latlng, modalId);
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    } else {
                        alert(
                            'Your current location is outside Djibouti. Please manually select a location within Djibouti.');
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                },
                function(error) {
                    console.error('Geolocation error:', error);
                    alert('Unable to detect location. Please try again or search manually.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            );
        }

        function searchLocation(query, modalId) {
            if (!query.trim()) return;

            fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=dj&bounded=1&viewbox=41.75,10.9,43.65,12.8&limit=10&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const validResults = data.filter(result => {
                            const lat = parseFloat(result.lat);
                            const lon = parseFloat(result.lon);
                            return lat >= 10.9 && lat <= 12.8 && lon >= 41.75 && lon <= 43.65;
                        });

                        if (validResults.length > 0) {
                            const result = validResults[0];
                            const latlng = L.latLng(parseFloat(result.lat), parseFloat(result.lon));

                            map.setView(latlng, 15);
                            marker.setLatLng(latlng);

                            selectedPlace = {
                                name: result.display_name,
                                formatted_address: result.display_name,
                                geometry: {
                                    location: latlng
                                }
                            };

                            updateCoordinates(latlng, modalId);
                            reverseGeocode(latlng, modalId);
                        } else {
                            alert('Location not found in Djibouti. Please search for a location within Djibouti.');
                        }
                    } else {
                        alert('Location not found in Djibouti. Please try a different search term.');
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    alert('Search failed. Please try again.');
                });
        }

        function updateCoordinates(latlng, modalId) {
            const lat = latlng.lat || latlng[0];
            const lng = latlng.lng || latlng[1];

            const latInput = document.getElementById(modalId === 'newAddressModal' ? 'latitude' : 'edit_latitude');
            const lngInput = document.getElementById(modalId === 'newAddressModal' ? 'longitude' : 'edit_longitude');

            if (latInput) latInput.value = lat.toFixed(8);
            if (lngInput) lngInput.value = lng.toFixed(8);

            const coordsDisplay = document.querySelector(
                `#${modalId === 'newAddressModal' ? 'add' : 'edit'}-location-info .coordinates-display`);
            if (coordsDisplay) {
                coordsDisplay.innerHTML = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }
        }

        function reverseGeocode(latlng, modalId) {
            const lat = latlng.lat || latlng[0];
            const lng = latlng.lng || latlng[1];

            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        const place = {
                            formatted_address: data.display_name,
                            address_components: parseNominatimAddress(data.address)
                        };

                        selectedPlace = place;
                        fillAddressFields(place, modalId);

                        const searchInput = document.getElementById(modalId === 'newAddressModal' ? 'add-map-search' :
                            'edit-map-search');
                        if (searchInput) {
                            searchInput.value = data.display_name;
                        }
                    }
                })
                .catch(error => {
                    console.error('Reverse geocoding error:', error);
                });
        }

        function parseNominatimAddress(nominatimAddress) {
            const components = {};

            if (nominatimAddress.house_number) components.street_number = nominatimAddress.house_number;
            if (nominatimAddress.road) components.route = nominatimAddress.road;
            if (nominatimAddress.city || nominatimAddress.town || nominatimAddress.village) {
                components.city = nominatimAddress.city || nominatimAddress.town || nominatimAddress.village;
            }
            if (nominatimAddress.state || nominatimAddress.region) {
                components.state = nominatimAddress.state || nominatimAddress.region;
            }
            if (nominatimAddress.country) components.country = nominatimAddress.country;
            if (nominatimAddress.postcode) components.postal_code = nominatimAddress.postcode;

            return components;
        }

        function fillAddressFields(place, modalId) {
            if (!place || !place.address_components) return;

            const components = place.address_components;

            let addressLine1 = '';
            if (components.street_number) addressLine1 += components.street_number + ' ';
            if (components.route) addressLine1 += components.route;

            if (addressLine1.trim()) {
                const addressField = document.querySelector('input[name="address_line_1"]');
                if (addressField) addressField.value = addressLine1.trim();
            }

            if (components.city) {
                const cityField = document.querySelector('input[name="city"]');
                if (cityField) cityField.value = components.city;
            }

            if (components.state) {
                const stateField = document.querySelector('input[name="state"]');
                if (stateField) stateField.value = components.state;
            }

            if (components.country) {
                const countryField = document.querySelector('input[name="country"]');
                if (countryField) countryField.value = components.country;
            }

            if (components.postal_code) {
                const postalField = document.querySelector('input[name="postal_code"]');
                if (postalField) postalField.value = components.postal_code;
            }

            showLocationInfo(place, modalId);
        }

        function showLocationInfo(place, modalId) {
            const infoElement = document.getElementById(modalId === 'newAddressModal' ? 'add-location-info' :
                'edit-location-info');
            if (!infoElement) return;

            const detailsElement = infoElement.querySelector('.location-details');
            if (detailsElement && place.formatted_address) {
                detailsElement.innerHTML = `<strong>Selected Location:</strong><br>${place.formatted_address}`;
                infoElement.classList.add('show');
            }
        }

        // Initialize map when modal is shown
        document.addEventListener('DOMContentLoaded', function() {
            const newModal = document.getElementById('newAddressModal');
            if (newModal) {
                newModal.addEventListener('shown.bs.modal', function() {
                    setTimeout(() => {
                        initializeMapInModal('newAddressModal');
                    }, 250);
                });
            }

            // Handle form submission with AJAX for better UX
            const newAddressForm = newModal ? newModal.querySelector('form') : null;
            if (newAddressForm) {
                newAddressForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Saving...';
                    submitBtn.disabled = true;

                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                const contentType = response.headers.get('content-type');
                                if (contentType && contentType.includes('application/json')) {
                                    return response.json();
                                } else {
                                    return {
                                        success: true
                                    };
                                }
                            } else {
                                throw new Error('Save failed');
                            }
                        })
                        .then(data => {
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                'newAddressModal'));
                            modal.hide();
                            showNotification(
                                'Address saved successfully! You can now proceed with checkout.',
                                'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while saving the address. Please try again.');
                        })
                        .finally(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        });
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/checkout.blade.php ENDPATH**/ ?>