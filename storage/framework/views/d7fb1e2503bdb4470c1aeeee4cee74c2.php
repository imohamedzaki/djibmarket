<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product', 'vendor' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['product', 'vendor' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $isInWishlist = false;
    if (auth()->check()) {
        $isInWishlist = auth()->user()->wishlist()->where('product_id', $product->id)->exists();
    }
?>

<div class="product-card-home" data-product-id="<?php echo e($product->id); ?>">
    <div class="product-card-inner">
        <!-- Product Tools/Actions -->
        <div class="product-tools">
            <a class="tool-btn tool-trend" href="#" aria-label="Trend" title="Trending"></a>
            <a class="tool-btn tool-wishlist <?php echo e($isInWishlist ? 'in-wishlist' : ''); ?>" href="#"
                aria-label="<?php echo e($isInWishlist ? 'Remove from Wishlist' : 'Add To Wishlist'); ?>"
                title="<?php echo e($isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist'); ?>"
                data-product-id="<?php echo e($product->id); ?>"
                onclick="window.toggleWishlist(event, <?php echo e($product->id); ?>, this)"></a>
            <a class="tool-btn tool-compare" href="#" aria-label="Compare" title="Compare"></a>
            <a class="tool-btn tool-quickview" href="#" aria-label="Quick view" title="Quick View"
                data-bs-toggle="modal" data-bs-target="#ModalQuickview" data-product-id="<?php echo e($product->id); ?>"></a>
        </div>

        <!-- Product Image Container -->
        <div class="product-image-wrapper">
            <?php if(
                $product->price_discounted &&
                    $product->price_discounted > 0 &&
                    $product->price_discounted < $product->price_regular): ?>
                <?php
                    $discountPercentage = round(
                        (($product->price_regular - $product->price_discounted) / $product->price_regular) * 100,
                    );
                ?>
                <span class="discount-badge">-<?php echo e($discountPercentage); ?>%</span>
            <?php endif; ?>

            <!-- Lazy Loading Image Container -->
            <div class="image-container">
                <!-- Loading Placeholder with Logo and Gradient Animation -->
                <div class="image-placeholder">
                    <div class="placeholder-gradient"></div>
                    <img src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="Loading"
                        class="placeholder-logo">
                </div>

                <!-- Main Product Image -->
                <a href="<?php echo e(route('buyer.product.show', $product->slug)); ?>" class="product-link">
                    <?php
                        $primaryImage = $product->primary_image_url;

                        $allImages = collect();
                        if ($product->thumbnail) {
                            $allImages->push(asset('storage/' . $product->thumbnail));
                        }
                        if ($product->images->count() > 0) {
                            $productImages = $product->images->map(function ($img) {
                                return asset('storage/' . $img->image_path);
                            });
                            $allImages = $allImages->merge($productImages);
                        }
                        if ($product->featured_image_path) {
                            $allImages->push(asset('storage/' . $product->featured_image_path));
                        }
                        $allImages = $allImages->unique()->filter(); // Remove empty values
                    ?>

                    <?php if($primaryImage): ?>
                        <img class="product-main-image lazy-image" data-src="<?php echo e($primaryImage); ?>"
                            alt="<?php echo e($product->title); ?>" loading="lazy">
                    <?php else: ?>
                        <div class="no-product-image">
                            <span>No Image Available</span>
                        </div>
                    <?php endif; ?>
                </a>

                <!-- Image Gallery (shown on hover) -->
                <?php if($allImages->count() > 1 && $primaryImage): ?>
                    <div class="image-gallery">
                        <!-- Navigation Arrows -->
                        <button class="gallery-nav gallery-prev" type="button" aria-label="Previous image">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="15,18 9,12 15,6"></polyline>
                            </svg>
                        </button>
                        <button class="gallery-nav gallery-next" type="button" aria-label="Next image">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="9,18 15,12 9,6"></polyline>
                            </svg>
                        </button>

                        <!-- Image Indicators -->
                        <div class="gallery-indicators">
                            <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="indicator <?php echo e($index === 0 ? 'active' : ''); ?>"
                                    data-index="<?php echo e($index); ?>"></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Hidden Images Data -->
                        <script type="application/json" class="gallery-data">
                            <?php echo json_encode($allImages->values()->toArray()); ?>

                        </script>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Information -->
        <div class="product-info">
            <!-- Vendor/Seller Info -->
            <?php if($vendor): ?>
                <a class="vendor-link" href="<?php echo e(route('sellers.show', $vendor->id)); ?>"><?php echo e($vendor->name); ?></a>
            <?php elseif($product->seller): ?>
                <a class="vendor-link" href="<?php echo e(route('sellers.show', $product->seller->id)); ?>">
                    <?php echo e($product->seller->name ?? 'Unknown Seller'); ?>

                </a>
            <?php endif; ?>

            <!-- Product Title -->
            <h3 class="product-title">
                <a href="<?php echo e(route('buyer.product.show', $product->slug)); ?>">
                    <?php echo e(Str::limit($product->title, 60)); ?>

                </a>
            </h3>

            <!-- Product Rating -->
            <?php if($product->reviews->count() > 0): ?>
                <div class="product-rating">
                    <?php $productRating = $product->reviews->avg('rating') ?? 0; ?>
                    <div class="stars">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <img src="<?php echo e(asset('assets/imgs/template/icons/' . ($i <= $productRating ? 'star.svg' : 'star-gray.svg'))); ?>"
                                alt="Star" class="star">
                        <?php endfor; ?>
                    </div>
                    <span class="review-count">(<?php echo e($product->reviews->count()); ?>)</span>
                </div>
            <?php endif; ?>

            <!-- Product Price -->
            <div class="product-price">
                <?php if(
                    $product->price_discounted &&
                        $product->price_discounted > 0 &&
                        $product->price_discounted < $product->price_regular): ?>
                    <span class="price-current"><?php echo e(number_format($product->price_discounted, 2)); ?> DJF</span>
                    <span class="price-original"><?php echo e(number_format($product->price_regular, 2)); ?> DJF</span>
                <?php else: ?>
                    <span class="price-current"><?php echo e(number_format($product->price_regular, 2)); ?> DJF</span>
                <?php endif; ?>
            </div>

            <!-- Add to Cart Button -->
            <div class="product-actions">
                <?php if(isset($product->is_in_cart) && $product->is_in_cart): ?>
                    <button class="btn-add-cart btn-in-cart" type="button" disabled>
                        <span class="btn-text">✓ Added</span>
                    </button>
                <?php else: ?>
                    <button class="btn-add-cart" onclick="window.addToCart(<?php echo e($product->id); ?>, 1, this)"
                        type="button">
                        <span class="btn-text">Add To Cart</span>
                        <span class="btn-loading">
                            <svg class="spinner" width="16" height="16" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-dasharray="31.416" stroke-dashoffset="31.416"></circle>
                            </svg>
                        </span>
                    </button>
                <?php endif; ?>
            </div>

            <!-- Product Features -->
            <?php if($product->description): ?>
                <ul class="product-features">
                    <?php
                        $features = explode("\n", strip_tags($product->description));
                        $features = array_slice(array_filter($features), 0, 3);
                    ?>
                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e(Str::limit(trim($feature), 50)); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .product-card-home {
        position: relative;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card-home:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    .product-card-inner {
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Product Tools */
    .product-tools {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 20;
        display: flex;
        flex-direction: row;
        gap: 6px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        padding: 4px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        justify-content: space-between;
        width: 88%;
        pointer-events: none;
    }

    /* Show tools with partial transparency when hovering over the entire product card */
    .product-card-home:hover .product-tools {
        opacity: 0.5;
        visibility: visible;
        transform: translateY(0);
        pointer-events: all;
    }

    /* Full opacity when hovering over the tools themselves */
    .product-tools:hover {
        opacity: 1 !important;
    }

    .tool-btn {
        width: 32px;
        height: 32px;
        background: transparent;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #666;
        transition: all 0.3s ease;
        position: relative;
    }

    .tool-btn:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #3b82f6;
        transform: scale(1.15);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }

    .tool-trend::before {
        content: "🔥";
        font-size: 17px !important;
    }

    .tool-wishlist::before {
        content: "♡";
        font-size: 17px !important;
    }

    .tool-wishlist.in-wishlist::before {
        content: "♥";
        color: #ef4444 !important;
    }

    .tool-compare::before {
        content: "⚖";
        font-size: 17px !important;
    }

    .tool-quickview::before {
        content: "👁";
        font-size: 17px !important;
    }

    /* Product Image Wrapper */
    .product-image-wrapper {
        position: relative;
        aspect-ratio: 1;
        overflow: hidden;
        background: #f8f9fa;
    }

    .discount-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        z-index: 15;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    /* Image Container */
    .image-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    /* Loading Placeholder */
    .image-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
        transition: opacity 0.4s ease;
    }

    .image-placeholder.loaded {
        opacity: 0;
        pointer-events: none;
    }

    .placeholder-gradient {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.6),
                transparent);
        animation: shimmer 2s infinite ease-in-out;
    }

    @keyframes shimmer {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    .placeholder-logo {
        width: 48px;
        height: auto;
        opacity: 0.4;
        z-index: 6;
        position: relative;
        filter: grayscale(1);
    }

    /* Product Image */
    .product-link {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
        cursor: pointer;
        position: relative;
        z-index: 5;
    }

    .product-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        cursor: pointer;
    }

    .product-main-image.loaded {
        opacity: 1;
    }

    .product-card-home:hover .product-main-image {
        transform: scale(1.08);
    }

    .no-product-image {
        width: 100%;
        height: 100%;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        min-height: 200px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .no-product-image:hover {
        background: #e9ecef;
        border-color: #adb5bd;
        color: #495057;
    }

    /* Image Gallery */
    .image-gallery {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 10;
    }

    .product-card-home:hover .image-gallery {
        opacity: 1;
        pointer-events: none;
        /* Keep pointer-events none for the overlay */
    }

    /* Only gallery controls should capture pointer events */
    .gallery-nav,
    .gallery-indicators,
    .indicator {
        pointer-events: all !important;
    }

    .gallery-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.95);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #374151;
        backdrop-filter: blur(10px);
        z-index: 15;
    }

    .gallery-nav:hover {
        background: #fff;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: #3b82f6;
    }

    .gallery-prev {
        left: 12px;
    }

    .gallery-next {
        left: 82%;
    }

    .gallery-indicators {
        position: absolute;
        bottom: 16px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
        padding: 8px 12px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    .indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .indicator.active {
        background: #fff;
        transform: scale(1.25);
    }

    .indicator:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.1);
    }

    /* Product Info */
    .product-info {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .vendor-link {
        font-size: 12px;
        color: #6b7280;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .vendor-link:hover {
        color: #3b82f6;
    }

    .product-title {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.4;
    }

    .product-title a {
        color: #1f2937;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #3b82f6;
    }

    /* Product Rating */
    .product-rating {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stars {
        display: flex;
        gap: 2px;
    }

    .star {
        width: 14px;
        height: 14px;
    }

    .review-count {
        font-size: 12px;
        color: #6b7280;
    }

    /* Product Price */
    .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .price-current {
        font-size: 18px;
        font-weight: 700;
        color: #3b82f6;
    }

    .price-original {
        font-size: 14px;
        color: #9ca3af;
        text-decoration: line-through;
    }

    /* Add to Cart Button */
    .product-actions {
        margin-top: auto;
    }

    .btn-add-cart {
        width: 100%;
        padding: 12px 24px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-add-cart:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }

    .btn-add-cart:active {
        transform: translateY(0);
    }

    .btn-add-cart.loading .btn-text {
        opacity: 0;
    }

    .btn-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-add-cart.loading .btn-loading {
        opacity: 1;
    }

    /* Added to Cart Button State */
    .btn-add-cart.btn-in-cart {
        background: linear-gradient(135deg, #10b981, #059669);
        cursor: default;
    }

    .btn-add-cart.btn-in-cart:hover {
        background: linear-gradient(135deg, #10b981, #059669);
        transform: none;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .spinner {
        animation: spin 1s linear infinite;
    }

    .spinner circle {
        animation: loading 1.5s ease-in-out infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            stroke-dashoffset: 31.416;
        }

        50% {
            stroke-dashoffset: 7.854;
        }

        100% {
            stroke-dashoffset: 31.416;
        }
    }

    /* Product Features */
    .product-features {
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 12px;
        color: #6b7280;
    }

    .product-features li {
        position: relative;
        padding-left: 16px;
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .product-features li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #10b981;
        font-weight: bold;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-tools {
            top: 8px;
            right: 8px;
            padding: 3px;
            gap: 4px;
        }

        .tool-btn {
            width: 28px;
            height: 28px;
        }

        .tool-trend::before,
        .tool-compare::before,
        .tool-quickview::before {
            font-size: 10px;
        }

        .tool-wishlist::before {
            font-size: 12px;
        }

        .gallery-nav {
            width: 36px;
            height: 36px;
        }

        .gallery-indicators {
            bottom: 12px;
            padding: 6px 10px;
        }

        .indicator {
            width: 6px;
            height: 6px;
        }

        .product-info {
            padding: 16px;
            gap: 10px;
        }

        .product-title {
            font-size: 14px;
        }

        .price-current {
            font-size: 16px;
        }
    }

    /* Hide gallery data script */
    .gallery-data {
        display: none;
    }
</style>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/components/buyer/product-card-home.blade.php ENDPATH**/ ?>