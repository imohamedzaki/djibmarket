<?php $__env->startSection('title', 'Checkout'); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .buyer-breadcrumb-section {
            margin-bottom: 1rem !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<!-- Leaflet CSS and JS for map functionality -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<?php $__env->startSection('content'); ?>
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

    <section class="section-box shop-template">
        <div class="container">
            <form action="<?php echo e(route('checkout.store')); ?>" method="POST" id="checkout-form">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger mb-4">
                        <h6>Please fix the following errors:</h6>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-border">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 mb-20">
                                    <h5 class="font-md-bold color-brand-3 text-sm-start text-center">Contact information
                                    </h5>
                                </div>
                                <div class="col-lg-6 col-sm-6 mb-20 text-sm-end text-center">
                                    <!-- Always show authenticated user's email -->
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <?php if(auth()->guard()->check()): ?>
                                            <!-- For authenticated users, show email as readonly -->
                                            <input class="form-control font-sm" type="email" name="email"
                                                value="<?php echo e(Auth::user()->email); ?>" readonly
                                                style="background-color: #f8f9fa; cursor: not-allowed;">
                                            <small class="text-muted mt-1 d-block">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Using your account email. To change this, please update your profile.
                                            </small>
                                        <?php else: ?>
                                            <!-- For guest users, allow email input -->
                                            <input class="form-control font-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email*"
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
                                <?php if(Auth::check() && $addresses->count() > 0): ?>
                                    <div class="col-lg-12">
                                        <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Select Shipping Address</h5>
                                        <div class="address-selection mb-20">
                                            <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="address-option">
                                                    <label class="address-radio-label">
                                                        <input type="radio" name="shipping_address_id"
                                                            value="<?php echo e($address->id); ?>"
                                                            <?php echo e(($defaultAddress && $defaultAddress->id == $address->id) || $loop->first ? 'checked' : ''); ?>

                                                            onchange="toggleAddressForm()">
                                                        <div class="address-card-mini">
                                                            <div class="address-header">
                                                                <strong><?php echo e($address->title); ?></strong>
                                                                <?php if($address->is_default): ?>
                                                                    <span class="badge badge-primary">Default</span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="address-details">
                                                                <?php echo e($address->full_name); ?><br>
                                                                <?php echo e($address->full_address); ?><br>
                                                                <?php echo e($address->phone); ?>

                                                                <?php if($address->hasCoordinates()): ?>
                                                                    <br><small class="text-muted">
                                                                        <i class="fas fa-map-pin me-1"></i>
                                                                        <?php echo e($address->coordinates); ?>

                                                                    </small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Option to use new address -->
                                            <div class="address-option">
                                                <label class="address-radio-label" style="cursor: pointer;">
                                                    <input type="radio" name="shipping_address_id" value=""
                                                        onchange="openNewAddressModal()" style="display: none;">
                                                    <div class="address-card-mini new-address"
                                                        onclick="openNewAddressModal()">
                                                        <div class="address-header">
                                                            <strong><i class="fas fa-plus-circle me-2"></i>Use New
                                                                Address</strong>
                                                        </div>
                                                        <div class="address-details">
                                                            Click here to create a new shipping address with map selection
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-lg-12" id="address-form"
                                    style="<?php echo e(Auth::check() && $addresses->count() > 0 ? 'display: none;' : ''); ?>">
                                    <h5 class="font-md-bold color-brand-3 mt-15 mb-20">Shipping address</h5>
                                </div>
                                <div class="address-form-fields" id="address-form-fields"
                                    style="<?php echo e(Auth::check() && $addresses->count() > 0 ? 'display: none;' : ''); ?>">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="first_name"
                                                value="<?php echo e(old('first_name', Auth::user()->name ?? '')); ?>"
                                                placeholder="First name*" required data-required="true">
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
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="last_name" value="<?php echo e(old('last_name')); ?>"
                                                placeholder="Last name*" required data-required="true">
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control font-sm <?php $__errorArgs = ['address_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="address_1" value="<?php echo e(old('address_1')); ?>"
                                                placeholder="Address 1*" required data-required="true">
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
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control font-sm" type="text" name="address_2"
                                                value="<?php echo e(old('address_2')); ?>" placeholder="Address 2">
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
                                            <input class="form-control font-sm <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="city" value="<?php echo e(old('city')); ?>"
                                                placeholder="City*" required data-required="true">
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input class="form-control font-sm <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="postal_code" value="<?php echo e(old('postal_code')); ?>"
                                                placeholder="PostCode / ZIP*" required data-required="true">
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
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm" type="text" name="company_name"
                                                value="<?php echo e(old('company_name')); ?>" placeholder="Company name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control font-sm <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                type="text" name="phone"
                                                value="<?php echo e(old('phone', Auth::user()->phone ?? '')); ?>"
                                                placeholder="Phone*" required data-required="true">
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
                                    <div class="col-lg-12">
                                        <div class="form-group mb-0">
                                            <textarea class="form-control font-sm" name="additional_info" placeholder="Additional Information" rows="5"><?php echo e(old('additional_info')); ?></textarea>
                                        </div>
                                    </div>
                                    <!-- Hidden coordinates fields for new address -->
                                    <input type="hidden" name="latitude" id="new_latitude" value="">
                                    <input type="hidden" name="longitude" id="new_longitude" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-lg-6 col-5 mb-20">
                                <a class="btn font-sm-bold color-brand-1 arrow-back-1"
                                    href="<?php echo e(route('cart.index')); ?>">Return to Cart</a>
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
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item-wishlist">
                                        <div class="wishlist-product">
                                            <div class="product-wishlist">
                                                <div class="product-image">
                                                    <a href="<?php echo e($item['product_url']); ?>">
                                                        <?php if($item['product_image']): ?>
                                                            <img src="<?php echo e($item['product_image']); ?>"
                                                                alt="<?php echo e($item['product_title']); ?>">
                                                        <?php else: ?>
                                                            <div class="no-image-placeholder"
                                                                style="width: 80px; height: 80px; background: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 10px;">
                                                                No Image
                                                            </div>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <a href="<?php echo e($item['product_url']); ?>">
                                                        <h6 class="color-brand-3">
                                                            <?php echo e(Str::limit($item['product_title'], 50)); ?></h6>
                                                    </a>
                                                    <div class="rating">
                                                        <span
                                                            class="font-xs color-gray-500"><?php echo e($item['product']->category->name ?? 'Product'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wishlist-status">
                                            <h5 class="color-gray-500">x<?php echo e($item['quantity']); ?></h5>
                                        </div>
                                        <div class="wishlist-price">
                                            <h4 class="color-brand-3 font-lg-bold">
                                                <?php echo e(number_format($item['total_price'], 0)); ?> DJF</h4>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <span class="font-lg-bold color-brand-3"><?php echo e(number_format($subtotal, 0)); ?>

                                            DJF</span>
                                    </div>
                                </div>
                                <div class="border-bottom mb-10 pb-5">
                                    <div class="row">
                                        <div class="col-lg-6 col-6"><span
                                                class="font-md-bold color-brand-3">Shipping</span></div>
                                        <div class="col-lg-6 col-6 text-end">
                                            <span class="font-lg-bold color-brand-3"><?php echo e(number_format($shippingCost, 0)); ?>

                                                DJF</span>
                                        </div>
                                    </div>
                                </div>
                                <?php if($taxAmount > 0): ?>
                                    <div class="border-bottom mb-10 pb-5">
                                        <div class="row">
                                            <div class="col-lg-6 col-6"><span
                                                    class="font-md-bold color-brand-3">Tax</span></div>
                                            <div class="col-lg-6 col-6 text-end">
                                                <span
                                                    class="font-lg-bold color-brand-3"><?php echo e(number_format($taxAmount, 0)); ?>

                                                    DJF</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-lg-6 col-6"><span class="font-md-bold color-brand-3">Total</span>
                                    </div>
                                    <div class="col-lg-6 col-6 text-end">
                                        <span class="font-lg-bold color-brand-3"
                                            id="order-total"><?php echo e(number_format($finalTotal, 0)); ?> DJF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- New Address Modal with Map Functionality -->
    <?php if(auth()->guard()->check()): ?>
        <div class="modal fade" id="newAddressModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Shipping Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?php echo e(route('buyer.dashboard.addresses.store')); ?>" method="POST" id="newAddressForm">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <!-- Map Selection Section -->
                            <div class="mb-4">
                                <h6 class="mb-3"><i class="fas fa-map-marker-alt me-2"></i>Select Location on Map</h6>
                                <div class="d-flex gap-2 mb-3">
                                    <div class="map-search-container flex-grow-1">
                                        <i class="fas fa-search map-search-icon"></i>
                                        <input type="text" id="new-map-search" class="map-search-input"
                                            placeholder="Search for locations within Djibouti only...">
                                    </div>
                                    <button type="button" class="btn btn-outline-primary" id="new-current-location-btn">
                                        <i class="fas fa-crosshairs me-1"></i> My Location
                                    </button>
                                </div>
                                <div id="new-map" class="map-container"></div>
                                <div id="new-location-info" class="location-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>Location Information</h6>
                                    <div class="location-details"></div>
                                    <div class="coordinates-info mt-2">
                                        <small class="text-muted">
                                            <strong>Coordinates:</strong> <span class="coordinates-display">Click on map to see
                                                coordinates</span>
                                        </small>
                                    </div>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    You can search for a location, click on the map, drag the marker, or use "My Location" to
                                    detect your current position.
                                </small>
                            </div>

                            <hr class="my-4">

                            <!-- Manual Address Entry -->
                            <h6 class="mb-3"><i class="fas fa-edit me-2"></i>Address Details</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="modal_type" class="form-label">Address Type *</label>
                                        <select class="form-control" id="modal_type" name="type" required>
                                            <option value="home">Home</option>
                                            <option value="work">Work</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="modal_title" class="form-label">Address Title *</label>
                                        <input type="text" class="form-control" id="modal_title" name="title"
                                            placeholder="e.g., Home, Office" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="modal_first_name" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="modal_first_name" name="first_name"
                                            value="<?php echo e(Auth::user()->name); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="modal_last_name" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="modal_last_name" name="last_name"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="modal_phone" class="form-label">Phone Number *</label>
                                <input type="text" class="form-control" id="modal_phone" name="phone"
                                    value="<?php echo e(Auth::user()->phone); ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="modal_address_line_1" class="form-label">Address Line 1 *</label>
                                <input type="text" class="form-control" id="modal_address_line_1" name="address_line_1"
                                    placeholder="Street address, P.O. box, company name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="modal_address_line_2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" id="modal_address_line_2" name="address_line_2"
                                    placeholder="Apartment, suite, unit, building, floor, etc.">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="modal_city" class="form-label">City *</label>
                                        <input type="text" class="form-control" id="modal_city" name="city" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="modal_state" class="form-label">State/Province</label>
                                        <input type="text" class="form-control" id="modal_state" name="state">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="modal_postal_code" class="form-label">Postal Code *</label>
                                        <input type="text" class="form-control" id="modal_postal_code" name="postal_code"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="modal_country" class="form-label">Country *</label>
                                <input type="text" class="form-control" id="modal_country" name="country"
                                    value="Djibouti" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="modal_notes" class="form-label">Delivery Notes</label>
                                <textarea class="form-control" id="modal_notes" name="notes" rows="2"
                                    placeholder="Any special delivery instructions..."></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="modal_is_default" name="is_default"
                                        value="1">
                                    <label class="form-check-label" for="modal_is_default">
                                        Set as default address
                                    </label>
                                </div>
                            </div>

                            <!-- Hidden fields for coordinates -->
                            <input type="hidden" id="modal_latitude" name="latitude" value="">
                            <input type="hidden" id="modal_longitude" name="longitude" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

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
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-card-mini.new-address:hover {
            background: #e9ecef;
            border-color: #007bff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
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

        /* Map Styles for Address Modal */
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 8px;
            border: 2px solid #ddd;
            margin-bottom: 15px;
        }

        .pac-container {
            z-index: 1051;
        }

        .map-search-container {
            position: relative;
            margin-bottom: 15px;
        }

        .map-search-input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        .map-search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .location-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            display: none;
        }

        .location-info.show {
            display: block;
        }

        .location-info h6 {
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
        }

        .location-details {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
        }

        .modal-header {
            border-bottom: 1px solid #eee;
            padding: 20px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: 1px solid #eee;
            padding: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
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

            // Always hide the inline address form since we're using modal for new addresses
            addressForm.style.display = 'none';
            addressFormFields.style.display = 'none';

            // Remove required attribute for HTML5 validation since we're using modal
            const requiredFields = addressFormFields.querySelectorAll('input[required]');
            requiredFields.forEach(field => {
                field.setAttribute('data-required', 'true'); // Store original required state
                field.required = false;
            });
        }

        function openNewAddressModal() {
            // Select the "new address" radio button
            const newAddressRadio = document.querySelector('input[name="shipping_address_id"][value=""]');
            if (newAddressRadio) {
                newAddressRadio.checked = true;
            }

            // Hide the inline form
            toggleAddressForm();

            // Open the modal
            const modal = new bootstrap.Modal(document.getElementById('newAddressModal'));
            modal.show();
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
        <?php if(session('success')): ?>
            showNotification('<?php echo e(session('success')); ?>', 'success');
        <?php endif; ?>

        <?php if(session('error')): ?>
            showNotification('<?php echo e(session('error')); ?>', 'error');
            // Reset button state if there's an error
            const submitBtn = document.getElementById('place-order-btn');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Place Order';
            }
            hideLoading();
        <?php endif; ?>

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

        // Map functionality for new address modal
        let map;
        let marker;
        let geocoder;
        let selectedPlace = null;

        function initializeMapInModal() {
            const mapElement = document.getElementById('new-map');
            const searchInput = document.getElementById('new-map-search');
            const currentLocationBtn = document.getElementById('new-current-location-btn');

            if (!mapElement) return;

            // Clear any existing map
            if (map) {
                map.remove();
            }

            // Default location: Djibouti City, Djibouti
            let djiboutiLocation = [11.5721, 43.1456];

            // Define Djibouti's geographic bounds
            const djiboutiBounds = L.latLngBounds(
                L.latLng(10.9, 41.75), // Southwest corner (minimum lat, minimum lng)
                L.latLng(12.8, 43.65) // Northeast corner (maximum lat, maximum lng)
            );

            // Create map with OpenStreetMap tiles, restricted to Djibouti
            map = L.map(mapElement, {
                center: djiboutiLocation,
                zoom: 13,
                minZoom: 8, // Prevent zooming out too far
                maxZoom: 18, // Allow detailed zoom
                maxBounds: djiboutiBounds, // Restrict panning to Djibouti bounds
                maxBoundsViscosity: 1.0 // Make bounds completely rigid
            });

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                bounds: djiboutiBounds // Restrict tiles to Djibouti area
            }).addTo(map);

            // Create draggable marker
            marker = L.marker(djiboutiLocation, {
                draggable: true,
                title: 'Selected Location'
            }).addTo(map);

            // Initialize geocoder for search - restricted to Djibouti only
            geocoder = L.Control.Geocoder.nominatim({
                geocodingQueryParams: {
                    countrycodes: 'dj', // Only Djibouti
                    bounded: 1, // Strict bounding
                    viewbox: '41.75,10.9,43.65,12.8', // Djibouti bounding box
                    limit: 10
                }
            });

            // Handle search input
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        searchLocation(this.value);
                    }
                });

                // Add search button functionality
                const searchContainer = searchInput.parentElement;
                if (!searchContainer.querySelector('.search-btn')) {
                    const searchBtn = document.createElement('button');
                    searchBtn.type = 'button';
                    searchBtn.className = 'btn btn-sm btn-outline-primary search-btn';
                    searchBtn.style.position = 'absolute';
                    searchBtn.style.right = '10px';
                    searchBtn.style.top = '50%';
                    searchBtn.style.transform = 'translateY(-50%)';
                    searchBtn.innerHTML = '<i class="fas fa-search"></i>';
                    searchBtn.onclick = () => searchLocation(searchInput.value);
                    searchContainer.style.position = 'relative';
                    searchContainer.appendChild(searchBtn);
                }
            }

            // Handle current location button
            if (currentLocationBtn) {
                currentLocationBtn.addEventListener('click', getCurrentLocation);
            }

            // Listen for marker drag - ensure it stays within Djibouti
            marker.on('dragend', function(e) {
                const position = e.target.getLatLng();
                const lat = position.lat;
                const lng = position.lng;

                // Check if dragged position is within Djibouti bounds
                if (lat >= 10.9 && lat <= 12.8 && lng >= 41.75 && lng <= 43.65) {
                    updateCoordinates(position);
                    reverseGeocode(position);
                } else {
                    // Snap back to previous valid position or center of Djibouti
                    marker.setLatLng(djiboutiLocation);
                    updateCoordinates({
                        lat: djiboutiLocation[0],
                        lng: djiboutiLocation[1]
                    });
                    showNotification('Marker must stay within Djibouti borders.', 'error');
                }
            });

            // Listen for map clicks - restrict to Djibouti bounds
            map.on('click', function(e) {
                const position = e.latlng;
                const lat = position.lat;
                const lng = position.lng;

                // Only allow clicks within Djibouti bounds
                if (lat >= 10.9 && lat <= 12.8 && lng >= 41.75 && lng <= 43.65) {
                    marker.setLatLng(position);
                    updateCoordinates(position);
                    reverseGeocode(position);
                } else {
                    // This shouldn't happen due to maxBounds, but just in case
                    showNotification('Please select a location within Djibouti only.', 'error');
                }
            });

            // Update coordinates display initially
            updateCoordinates({
                lat: djiboutiLocation[0],
                lng: djiboutiLocation[1]
            });

            // Invalidate size to ensure proper rendering
            setTimeout(() => {
                map.invalidateSize();
            }, 100);
        }

        function getCurrentLocation() {
            const btn = document.getElementById('new-current-location-btn');
            const originalText = btn.innerHTML;

            if (!navigator.geolocation) {
                alert('Geolocation is not supported by this browser.');
                return;
            }

            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Detecting...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Check if location is within Djibouti bounds
                    if (lat >= 10.9 && lat <= 12.8 && lng >= 41.75 && lng <= 43.65) {
                        const latlng = L.latLng(lat, lng);

                        map.setView(latlng, 15);
                        marker.setLatLng(latlng);

                        updateCoordinates(latlng);
                        reverseGeocode(latlng);

                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    } else {
                        alert(
                            'Your current location is outside Djibouti. Please manually select a location within Djibouti or search for an address.'
                        );
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                },
                function(error) {
                    console.error('Geolocation error:', error);
                    alert('Unable to detect location. Please try again or search manually.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 60000
                }
            );
        }

        function searchLocation(query) {
            if (!query.trim()) return;

            // Search only within Djibouti bounds
            fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=dj&bounded=1&viewbox=41.75,10.9,43.65,12.8&limit=10&addressdetails=1`
                )
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        // Filter results to ensure they're within Djibouti bounds
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

                            updateCoordinates(latlng);
                            reverseGeocode(latlng);
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

        function updateCoordinates(latlng) {
            const lat = latlng.lat || latlng[0];
            const lng = latlng.lng || latlng[1];

            document.getElementById('modal_latitude').value = lat.toFixed(8);
            document.getElementById('modal_longitude').value = lng.toFixed(8);

            const coordsDisplay = document.querySelector('#new-location-info .coordinates-display');
            if (coordsDisplay) {
                coordsDisplay.innerHTML = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }
        }

        function reverseGeocode(latlng) {
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
                        fillAddressFields(place);

                        const searchInput = document.getElementById('new-map-search');
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

            if (nominatimAddress.house_number) {
                components.street_number = nominatimAddress.house_number;
            }
            if (nominatimAddress.road) {
                components.route = nominatimAddress.road;
            }
            if (nominatimAddress.city || nominatimAddress.town || nominatimAddress.village) {
                components.city = nominatimAddress.city || nominatimAddress.town || nominatimAddress.village;
            }
            if (nominatimAddress.state || nominatimAddress.region) {
                components.state = nominatimAddress.state || nominatimAddress.region;
            }
            if (nominatimAddress.country) {
                components.country = nominatimAddress.country;
            }
            if (nominatimAddress.postcode) {
                components.postal_code = nominatimAddress.postcode;
            }

            return components;
        }

        function fillAddressFields(place) {
            if (!place || !place.address_components) return;

            const components = place.address_components;

            // Fill address line 1
            let addressLine1 = '';
            if (components.street_number) addressLine1 += components.street_number + ' ';
            if (components.route) addressLine1 += components.route;

            if (addressLine1.trim()) {
                const addressField = document.getElementById('modal_address_line_1');
                if (addressField) addressField.value = addressLine1.trim();
            }

            // Fill city
            if (components.city) {
                const cityField = document.getElementById('modal_city');
                if (cityField) cityField.value = components.city;
            }

            // Fill state
            if (components.state) {
                const stateField = document.getElementById('modal_state');
                if (stateField) stateField.value = components.state;
            }

            // Fill country
            if (components.country) {
                const countryField = document.getElementById('modal_country');
                if (countryField) countryField.value = components.country;
            }

            // Fill postal code
            if (components.postal_code) {
                const postalField = document.getElementById('modal_postal_code');
                if (postalField) postalField.value = components.postal_code;
            }

            // Show location info
            showLocationInfo(place);
        }

        function showLocationInfo(place) {
            const infoElement = document.getElementById('new-location-info');
            if (!infoElement) return;

            const detailsElement = infoElement.querySelector('.location-details');
            if (detailsElement && place.formatted_address) {
                detailsElement.innerHTML = `<strong>Selected Location:</strong><br>${place.formatted_address}`;
                infoElement.classList.add('show');
            }
        }

        // Handle modal events to initialize maps
        document.addEventListener('DOMContentLoaded', function() {
            const newModal = document.getElementById('newAddressModal');
            if (newModal) {
                newModal.addEventListener('shown.bs.modal', function() {
                    setTimeout(() => {
                        initializeMapInModal();
                    }, 250);
                });
            }

            // Handle form submission
            const newAddressForm = document.getElementById('newAddressForm');
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
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                // Handle both JSON and redirect responses
                                const contentType = response.headers.get('content-type');
                                if (contentType && contentType.includes('application/json')) {
                                    return response.json();
                                } else {
                                    // Controller returned a redirect (success)
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

                            // Show success message
                            showNotification(
                                'Address saved successfully! You can now proceed with checkout.',
                                'success');

                            // Reload page to show the new address in the list
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

<?php echo $__env->make('layouts.app.buyer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/checkout/index.blade.php ENDPATH**/ ?>