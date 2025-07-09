<div class="modal fade" id="ModalQuickview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content quickview-modal">
            <!-- Close Button -->
            <button type="button" class="btn-close-modern" data-bs-dismiss="modal" aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Loading State -->
            <div id="quickview-loading" class="quickview-loading">
                <div class="loading-content">
                    <div class="loading-spinner">
                        <div class="spinner-ring"></div>
                        <div class="spinner-ring"></div>
                        <div class="spinner-ring"></div>
                    </div>
                    <h4>Loading Product Details</h4>
                    <p>Please wait while we fetch the latest information...</p>
                </div>
            </div>

            <!-- Error State -->
            <div id="quickview-error" class="quickview-error" style="display: none;">
                <div class="error-content">
                    <div class="error-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <h4>Oops! Something went wrong</h4>
                    <p id="quickview-error-message">Unable to load product details. Please try again.</p>
                    <button type="button" class="btn-retry" onclick="retryQuickview()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="23,4 23,10 17,10"></polyline>
                            <path d="M20.49,15a9,9,0,1,1-2.12-9.36L23,10"></path>
                        </svg>
                        Try Again
                    </button>
                </div>
            </div>

            <!-- Main Content -->
            <div id="quickview-content" class="quickview-content" style="display: none;">
                <div class="row g-0">
                    <!-- Image Gallery -->
                    <div class="col-lg-6">
                        <div class="product-gallery">
                            <!-- Discount Badge -->
                            <div id="quickview-discount-badge" class="discount-badge" style="display: none;">
                                <span id="quickview-discount-text">-20%</span>
                            </div>

                            <!-- Stock Status Badge -->
                            <div id="quickview-stock-badge" class="stock-badge">
                                <span id="quickview-stock-text">In Stock</span>
                            </div>

                            <!-- Stock Quantity Display -->
                            <div id="quickview-stock-quantity" class="stock-quantity-badge">
                                <span id="quickview-stock-count">0</span> left
                            </div>

                            <!-- Main Image Display -->
                            <div class="main-image-container">
                                <img id="quickview-main-image" src="" alt="" class="main-image">

                                <!-- Image Navigation -->
                                <button type="button" class="image-nav prev-image" id="quickview-prev-image">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="15,18 9,12 15,6"></polyline>
                                    </svg>
                                </button>
                                <button type="button" class="image-nav next-image" id="quickview-next-image">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <polyline points="9,18 15,12 9,6"></polyline>
                                    </svg>
                                </button>
                            </div>

                            <!-- Image Thumbnails -->
                            <div class="image-thumbnails" id="quickview-thumbnails"
                                style="display: flex; overflow-x: auto; padding: 10px 0; gap: 10px;">
                                <!-- Thumbnails will be generated here -->
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="col-lg-6">
                        <div class="product-details">
                            <!-- Category & Seller -->
                            <div class="product-meta">
                                <a href="#" id="quickview-category-link" class="category-link">
                                    <span id="quickview-category">Category</span>
                                </a>
                                <span class="meta-separator">•</span>
                                <a href="#" id="quickview-seller-link" class="seller-link">
                                    <span id="quickview-seller">Seller</span>
                                </a>
                            </div>

                            <!-- Product Title -->
                            <h1 id="quickview-title" class="product-title">Product Title</h1>

                            <!-- Rating & Reviews -->
                            <div class="product-rating">
                                <div class="stars" id="quickview-stars">
                                    <!-- Stars will be generated here -->
                                </div>
                                <span class="rating-text">
                                    <span id="quickview-rating-value">0</span>
                                    (<span id="quickview-reviews-count">0</span> reviews)
                                </span>
                            </div>

                            <!-- Price -->
                            <div class="product-pricing">
                                <div class="price-container">
                                    <span id="quickview-current-price" class="current-price">$0.00</span>
                                    <span id="quickview-original-price" class="original-price"
                                        style="display: none;">$0.00</span>
                                </div>
                                <div id="quickview-savings" class="savings-info" style="display: none;">
                                    You save <span id="quickview-savings-amount">$0.00</span>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="product-description">
                                <p id="quickview-description">Product description goes here...</p>
                            </div>

                            <!-- Quantity & Actions -->
                            <div class="product-actions">
                                <div class="quantity-selector">
                                    <label>Quantity:</label>
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn minus" onclick="updateQuantity(-1)"
                                            id="qty-minus-btn">−</button>
                                        <input type="number" id="quickview-quantity" value="1" min="1"
                                            max="1">
                                        <button type="button" class="qty-btn plus" onclick="updateQuantity(1)"
                                            id="qty-plus-btn">+</button>
                                    </div>
                                    <small class="quantity-note text-muted">
                                        Maximum: <span id="max-quantity">1</span> items
                                    </small>
                                </div>

                                <div class="action-buttons">
                                    <button type="button" id="quickview-add-to-cart" class="btn-add-cart">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path d="m1 1 4 4 16 6L7 16H3L1 1z"></path>
                                        </svg>
                                        <span class="btn-text">Add to Cart</span>
                                        <span class="btn-loading">
                                            <div class="btn-spinner"></div>
                                        </span>
                                    </button>

                                    <a href="#" id="quickview-buy-now" class="btn-buy-now">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M19 7H5l-1 9h16l-1-9z"></path>
                                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        Buy Now
                                    </a>
                                </div>
                            </div>

                            <!-- Additional Actions -->
                            <div class="additional-actions">
                                <button type="button" class="action-link" id="quickview-wishlist-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" id="wishlist-icon">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <span id="wishlist-text">Add to Wishlist</span>
                                </button>
                                <button type="button" class="action-link" id="quickview-compare-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M18 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2z">
                                        </path>
                                        <path d="M6 6V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    Compare
                                </button>
                                <div class="share-container">
                                    <button type="button" class="action-link" id="share-btn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="18" cy="5" r="3"></circle>
                                            <circle cx="6" cy="12" r="3"></circle>
                                            <circle cx="18" cy="19" r="3"></circle>
                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49">
                                            </line>
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49">
                                            </line>
                                        </svg>
                                        Share
                                    </button>
                                    <div class="share-tooltip" id="share-tooltip">
                                        <div class="share-tooltip-arrow"></div>
                                        <div class="share-content">
                                            <label class="share-label">Product Link:</label>
                                            <div class="share-input-group">
                                                <input type="text" id="product-link" class="share-input" readonly>
                                                <button type="button" class="copy-btn" id="copy-btn">
                                                    <svg width="16" height="16" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect x="9" y="9" width="13" height="13"
                                                            rx="2" ry="2"></rect>
                                                        <path
                                                            d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Quick View Modal Styles */
    .quickview-modal {
        border: none;
        border-radius: 20px;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        position: relative;
        background: #fff;
    }

    .quickview-modal .modal-dialog {
        max-width: 1200px;
        margin: 2rem auto;
    }

    /* Close Button */
    .btn-close-modern {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1060;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .btn-close-modern:hover {
        background: rgba(255, 255, 255, 1);
        color: #374151;
        transform: scale(1.1);
    }

    /* Loading State */
    .quickview-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .loading-content {
        text-align: center;
        max-width: 300px;
    }

    .loading-spinner {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-bottom: 2rem;
    }

    .spinner-ring {
        width: 16px;
        height: 16px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top: 3px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .spinner-ring:nth-child(2) {
        animation-delay: 0.2s;
    }

    .spinner-ring:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loading-content h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .loading-content p {
        margin: 0;
        opacity: 0.8;
        font-size: 0.95rem;
    }

    /* Error State */
    .quickview-error {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
        background: #f8fafc;
    }

    .error-content {
        text-align: center;
        max-width: 400px;
        padding: 2rem;
    }

    .error-icon {
        color: #ef4444;
        margin-bottom: 1.5rem;
    }

    .error-content h4 {
        color: #374151;
        margin: 0 0 0.5rem 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .error-content p {
        color: #6b7280;
        margin: 0 0 2rem 0;
    }

    .btn-retry {
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 1rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 auto;
        transition: all 0.3s ease;
    }

    .btn-retry:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    /* Main Content */
    .quickview-content {
        min-height: 500px;
    }

    /* Product Gallery */
    .product-gallery {
        position: relative;
        padding: 2rem;
        background: #f8fafc;
        height: 100%;
    }

    .discount-badge {
        position: absolute;
        top: 2rem;
        left: 2rem;
        z-index: 10;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .stock-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        z-index: 10;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stock-badge.out-of-stock {
        background: linear-gradient(135deg, #6b7280, #4b5563);
    }

    .stock-quantity-badge {
        position: absolute;
        bottom: 2rem;
        left: 2rem;
        z-index: 10;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }

    .main-image-container {
        position: relative;
        margin-bottom: 1.5rem;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .main-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .main-image:hover {
        transform: scale(1.05);
    }

    .image-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #374151;
        transition: all 0.3s ease;
        opacity: 0;
        backdrop-filter: blur(10px);
    }

    .main-image-container:hover .image-nav {
        opacity: 1;
    }

    .image-nav:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .prev-image {
        left: 20px;
    }

    .next-image {
        right: 20px;
    }

    .image-thumbnails {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding: 8px 0;
        /* scrollbar-width: none;
        -ms-overflow-style: none; */
    }

    .image-thumbnails::-webkit-scrollbar {
        /* display: none; */
    }

    .thumbnail-item {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        background: white;
    }

    .thumbnail-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .thumbnail-item.active {
        border-color: #3b82f6;
        transform: translateY(-4px);
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Product Details */
    .product-details {
        padding: 2.5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .category-link,
    .seller-link {
        color: #6b7280;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .category-link:hover,
    .seller-link:hover {
        color: #3b82f6;
    }

    .meta-separator {
        color: #d1d5db;
    }

    .product-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 1.5rem 0;
        line-height: 1.3;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 2rem;
        width: 14.8%;
    }

    .stars {
        display: flex;
        gap: 2px;
    }

    .star {
        width: 18px;
        height: 18px;
        fill: #fbbf24;
        color: #fbbf24;
    }

    .star.empty {
        fill: #e5e7eb;
        color: #e5e7eb;
    }

    .rating-text {
        font-size: 0.875rem;
        color: #6b7280;
        width: 100%;
    }

    .product-pricing {
        margin-bottom: 2rem;
    }

    .price-container {
        display: flex;
        align-items: baseline;
        gap: 12px;
        margin-bottom: 8px;
    }

    .current-price {
        font-size: 2.5rem;
        font-weight: 800;
        color: #059669;
    }

    .original-price {
        font-size: 1.5rem;
        color: #9ca3af;
        text-decoration: line-through;
    }

    .savings-info {
        color: #dc2626;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .product-description {
        margin-bottom: 2rem;
        flex-grow: 1;
    }

    .product-description p {
        color: #4b5563;
        line-height: 1.7;
        margin: 0;
    }

    .product-actions {
        margin-bottom: 2rem;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 1.5rem;
    }

    .quantity-selector label {
        font-weight: 500;
        color: #374151;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }

    .qty-btn {
        background: #f9fafb;
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }

    .qty-btn:hover {
        background: #f3f4f6;
        color: #374151;
    }

    #quickview-quantity {
        border: none;
        width: 60px;
        height: 40px;
        text-align: center;
        font-weight: 500;
        outline: none;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
    }

    .btn-add-cart,
    .btn-buy-now {
        flex: 1;
        padding: 16px 24px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }

    .btn-add-cart {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
    }

    .btn-add-cart:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }

    .btn-buy-now {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
    }

    .btn-buy-now:hover {
        background: linear-gradient(135deg, #047857, #065f46);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4);
        color: white;
    }

    .btn-loading {
        position: absolute;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-add-cart.loading .btn-text {
        opacity: 0;
    }

    .btn-add-cart.loading .btn-loading {
        opacity: 1;
    }

    .btn-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .additional-actions {
        display: flex;
        gap: 24px;
    }

    .action-link {
        background: none;
        border: none;
        color: #6b7280;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: color 0.3s ease;
        cursor: pointer;
    }

    .action-link:hover {
        color: #3b82f6;
    }

    .quantity-note {
        margin-top: 8px;
        font-size: 0.8rem;
    }

    /* Wishlist styles */
    .action-link.in-wishlist #wishlist-icon {
        fill: #ef4444;
        stroke: #ef4444;
    }

    .action-link.in-wishlist {
        color: #ef4444;
    }

    .action-link.in-wishlist:hover {
        color: #dc2626;
    }

    /* Share Container & Tooltip Styles */
    .share-container {
        position: relative;
        display: inline-block;
    }

    .share-tooltip {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        min-width: 280px;
        margin-bottom: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateX(-50%) translateY(10px);
        transition: all 0.3s ease;
    }

    .share-tooltip.show {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .share-tooltip-arrow {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid white;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .share-content {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .share-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin: 0;
    }

    .share-input-group {
        display: flex;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        overflow: hidden;
        background: #f9fafb;
    }

    .share-input {
        flex: 1;
        padding: 10px 12px;
        border: none;
        background: transparent;
        font-size: 0.875rem;
        color: #4b5563;
        outline: none;
    }

    .copy-btn {
        background: #3b82f6;
        border: none;
        padding: 10px 12px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .copy-btn:hover {
        background: #2563eb;
    }

    .copy-btn.copied {
        background: #10b981;
        animation: copied-pulse 0.6s ease;
    }

    @keyframes copied-pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Disabled quantity button styles */
    .qty-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f3f4f6;
        color: #9ca3af;
    }

    .qty-btn:disabled:hover {
        background: #f3f4f6;
        color: #9ca3af;
        transform: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .quickview-modal .modal-dialog {
            margin: 1rem;
            max-width: none;
        }

        .product-gallery,
        .product-details {
            padding: 1.5rem;
        }

        .main-image {
            height: 300px;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .current-price {
            font-size: 2rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .additional-actions {
            justify-content: center;
            flex-wrap: wrap;
        }
    }

    /* Animation for modal entry */
    .modal.fade .modal-dialog {
        transform: translate(0, -100px) scale(0.95);
        transition: transform 0.3s ease-out;
    }

    .modal.show .modal-dialog {
        transform: translate(0, 0) scale(1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // --- GLOBAL HELPER FUNCTIONS ---
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className =
                `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
            notification.style.cssText = `
                position: fixed; top: 20px; right: 20px; z-index: 1060;
                min-width: 300px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);`;
            notification.innerHTML =
                `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 4000);
        }

        function updateGlobalCartCount() {
            fetch('<?php echo e(route('cart.data')); ?>')
                .then(response => response.json())
                .then(data => {
                    if (data && data.cart_count !== undefined) {
                        document.querySelectorAll('.number-item').forEach(el => el.textContent = data
                            .cart_count);
                    }
                });
        }

        // --- PRODUCT CARD LOGIC (RUNS ONCE) ---
        function initProductCards() {
            // Generic Lazy Loader for all product cards
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const container = img.closest(
                            '.image-lazy-container, .image-container');
                        if (container) {
                            const placeholder = container.querySelector(
                                '.image-loading-placeholder, .image-placeholder');
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                            }
                            img.onload = () => {
                                img.style.opacity = '1';
                                if (placeholder) {
                                    placeholder.classList.add(
                                        'loaded'); // For product-card-home
                                    placeholder.classList.add('hidden'); // For product-card
                                }
                            };
                            img.onerror = () => {
                                if (placeholder) {
                                    placeholder.classList.add('loaded');
                                    placeholder.classList.add('hidden');
                                }
                            };
                            observer.unobserve(img);
                        }
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '100px'
            });
            document.querySelectorAll('.lazy-image').forEach(img => imageObserver.observe(img));

            // Gallery for '.card-grid-style-3'
            document.querySelectorAll('.card-grid-style-3 .product-image-container').forEach(container => {
                const galleryNav = container.querySelector('.image-gallery-nav');
                if (!galleryNav) return;
                const productImage = container.querySelector('.product-image');
                const dots = container.querySelectorAll('.gallery-dot');
                const prevBtn = container.querySelector('.gallery-arrow-prev');
                const nextBtn = container.querySelector('.gallery-arrow-next');
                const galleryDataScript = container.querySelector('.gallery-data');
                if (!productImage || !galleryDataScript) return;
                const images = JSON.parse(galleryDataScript.textContent);
                if (images.length <= 1) return;
                let currentIndex = 0;
                let autoSlideInterval;

                function updateImage(index) {
                    currentIndex = index;
                    productImage.style.opacity = '0.7';
                    setTimeout(() => {
                        productImage.src = images[currentIndex];
                        productImage.style.opacity = '1';
                    }, 150);
                    dots.forEach((dot, i) => dot.classList.toggle('active', i === currentIndex));
                }
                if (prevBtn) prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    updateImage((currentIndex - 1 + images.length) % images.length);
                });
                if (nextBtn) nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    updateImage((currentIndex + 1) % images.length);
                });
                container.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = setInterval(() => updateImage((currentIndex + 1) %
                        images.length), 1200);
                });
                container.addEventListener('mouseleave', () => {
                    clearInterval(autoSlideInterval);
                    setTimeout(() => updateImage(0), 300);
                });
            });

            // Gallery for '.product-card-home'
            document.querySelectorAll('.product-card-home').forEach(card => {
                const gallery = card.querySelector('.image-gallery');
                if (!gallery) return;

                const mainImage = card.querySelector('.product-main-image');
                const indicators = gallery.querySelectorAll('.indicator');
                const prevBtn = gallery.querySelector('.gallery-prev');
                const nextBtn = gallery.querySelector('.gallery-next');
                const galleryDataScript = gallery.querySelector('.gallery-data');

                if (!mainImage || !galleryDataScript || !prevBtn || !nextBtn) return;

                const images = JSON.parse(galleryDataScript.textContent);
                if (images.length <= 1) return;

                let currentIndex = 0;
                let autoSlideInterval;

                function updateImage(index) {
                    if (index < 0 || index >= images.length) return;
                    currentIndex = index;
                    mainImage.style.transition = 'opacity 0.3s ease';
                    mainImage.style.opacity = '0.7';
                    setTimeout(() => {
                        mainImage.src = images[currentIndex];
                        mainImage.style.opacity = '1';
                    }, 150);
                    if (indicators.length > 0) {
                        indicators.forEach((indicator, i) => indicator.classList.toggle('active', i ===
                            currentIndex));
                    }
                }

                function nextImage() {
                    updateImage((currentIndex + 1) % images.length);
                }

                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    nextImage();
                });
                prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    updateImage((currentIndex - 1 + images.length) % images.length);
                });

                card.addEventListener('mouseenter', () => {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = setInterval(nextImage, 1000);
                });

                card.addEventListener('mouseleave', () => {
                    clearInterval(autoSlideInterval);
                    setTimeout(() => updateImage(0), 300);
                });
            });
        }
        initProductCards();

        // --- GLOBAL ACTIONS (USED BY CARDS AND QUICKVIEW) ---
        window.addToCart = function(productId, quantity = 1, buttonElement) {
            buttonElement.classList.add('loading');
            buttonElement.disabled = true;
            fetch('<?php echo e(route('cart.add')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    updateGlobalCartCount();
                    const btnText = buttonElement.querySelector('.btn-text');
                    if (btnText) {
                        const originalText = btnText.textContent;
                        btnText.textContent = 'Added!';
                        setTimeout(() => {
                            btnText.textContent = originalText;
                        }, 2000);
                    }
                } else {
                    showNotification(data.message || 'Failed to add to cart.', 'error');
                }
            }).catch(() => showNotification('An error occurred.', 'error')).finally(() => {
                buttonElement.classList.remove('loading');
                buttonElement.disabled = false;
            });
        };
        window.toggleWishlist = function(event, productId, buttonElement) {
            event.preventDefault();
            event.stopPropagation();
            <?php if(auth()->guard()->guest()): ?>
            showNotification('Please login to use the wishlist.', 'error');
            return;
        <?php endif; ?>
        const isCurrentlyInWishlist = buttonElement.classList.contains('in-wishlist');
        const url = isCurrentlyInWishlist ? '<?php echo e(route('buyer.dashboard.wishlist.remove-product')); ?>' :
            '<?php echo e(route('buyer.dashboard.wishlist.add')); ?>';
        buttonElement.style.pointerEvents = 'none';
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                product_id: productId
            })
        }).then(res => res.json()).then(data => {
            if (data.success) {
                buttonElement.classList.toggle('in-wishlist');
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message, 'error');
            }
        }).catch(() => showNotification('An error occurred.', 'error')).finally(() => buttonElement.style
            .pointerEvents = 'auto');
    };

    // --- QUICK VIEW MODAL LOGIC (RUNS ONCE) ---
    const quickviewModal = document.getElementById('ModalQuickview');
    if (quickviewModal) {
        let currentProductData = null,
            currentImageIndex = 0,
            retryProductId = null;
        const getElement = id => document.getElementById(id);
        const showElement = (el, display = 'block') => el && (el.style.display = display);
        const hideElement = el => el && (el.style.display = 'none');
        const showLoading = () => {
            showElement(getElement('quickview-loading'), 'flex');
            hideElement(getElement('quickview-content'));
            hideElement(getElement('quickview-error'));
        };
        const showContent = () => {
            hideElement(getElement('quickview-loading'));
            showElement(getElement('quickview-content'));
            hideElement(getElement('quickview-error'));
        };
        const showError = msg => {
            hideElement(getElement('quickview-loading'));
            hideElement(getElement('quickview-content'));
            showElement(getElement('quickview-error'), 'flex');
            const errEl = getElement('quickview-error-message');
            if (errEl) errEl.textContent = msg;
        };

        quickviewModal.addEventListener('show.bs.modal', e => {
            const button = e.relatedTarget;
            if (!button) return;
            retryProductId = button.getAttribute('data-product-id');
            if (retryProductId) loadProductQuickview(retryProductId);
        });

        function loadProductQuickview(productId) {
            showLoading();
            fetch(`/products/${productId}/quickview`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.ok ? res.json() : Promise.reject('Network error'))
                .then(data => {
                    if (data.success && data.product) {
                        currentProductData = data.product;
                        currentImageIndex = 0;
                        populateModal(data.product);
                        showContent();
                    } else {
                        throw new Error(data.message || 'Failed to load product');
                    }
                })
                .catch(error => showError(error.toString()));
        }

        function populateModal(product) {
            getElement('quickview-title').textContent = product.title;
            getElement('quickview-category').textContent = product.category.name;
            getElement('quickview-category-link').href = product.category.url;
            getElement('quickview-seller').textContent = product.seller.name;
            getElement('quickview-seller-link').href = product.seller.url;
            getElement('quickview-description').textContent = product.shortDescription || product.description ||
                'No description available.';
            getElement('quickview-buy-now').href = product.urls.view;
            getElement('product-link').value = product.urls.view;
            populatePrice(product.price);
            populateStockAndQuantity(product.stock);
            populateRating(product.rating);
            populateImages(product.images);
            updateWishlistStatus(product.wishlist.isInWishlist);
            getElement('quickview-add-to-cart').onclick = () => {
                if (!product.stock.inStock) return;
                const quantity = parseInt(getElement('quickview-quantity').value) || 1;
                window.addToCart(product.id, quantity, getElement('quickview-add-to-cart'));
            };
            getElement('quickview-wishlist-btn').onclick = e => {
                window.toggleWishlist(e, product.id, e.currentTarget);
            };

            const shareBtn = getElement('share-btn');
            const shareTooltip = getElement('share-tooltip');
            const copyBtn = getElement('copy-btn');

            if (shareBtn && shareTooltip && copyBtn) {
                shareBtn.onclick = (e) => {
                    e.stopPropagation();
                    shareTooltip.classList.toggle('show');
                };

                copyBtn.onclick = () => {
                    const productLinkInput = getElement('product-link');
                    const linkToCopy = productLinkInput.value;

                    // Modern clipboard API (requires secure context - HTTPS or localhost)
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(linkToCopy)
                            .then(() => {
                                showNotification('Product link copied to clipboard!', 'success');
                                copyBtn.classList.add('copied');
                                setTimeout(() => copyBtn.classList.remove('copied'), 2000);
                            })
                            .catch(err => {
                                console.error('Clipboard API failed:', err);
                                showNotification('Failed to copy link.', 'error');
                            });
                    } else {
                        // Fallback for older browsers or non-secure contexts
                        productLinkInput.select();
                        try {
                            const successful = document.execCommand('copy');
                            if (successful) {
                                showNotification('Product link copied to clipboard!', 'success');
                                copyBtn.classList.add('copied');
                                setTimeout(() => copyBtn.classList.remove('copied'), 2000);
                            } else {
                                showNotification('Could not copy link.', 'error');
                            }
                        } catch (err) {
                            console.error('Fallback copy failed:', err);
                            showNotification('Failed to copy link.', 'error');
                        }
                        // Deselect the text
                        if (window.getSelection) {
                            window.getSelection().removeAllRanges();
                        }
                    }
                };
            }
        }

        function populatePrice(price) {
            getElement('quickview-current-price').textContent = price.finalFormatted;
            const originalPriceEl = getElement('quickview-original-price'),
                savingsEl = getElement('quickview-savings'),
                discountBadgeEl = getElement('quickview-discount-badge');
            if (price.hasDiscount) {
                originalPriceEl.textContent = price.regularFormatted;
                getElement('quickview-savings-amount').textContent =
                    `${(price.regular - price.discounted).toFixed(0)} DJF`;
                getElement('quickview-discount-text').textContent = `-${price.discountPercentage}%`;
                showElement(originalPriceEl, 'inline');
                showElement(savingsEl);
                showElement(discountBadgeEl);
            } else {
                hideElement(originalPriceEl);
                hideElement(savingsEl);
                hideElement(discountBadgeEl);
            }
        }

        function updateQuantityButtons() {
            const qInput = getElement('quickview-quantity');
            if (!qInput) return;
            const currentVal = parseInt(qInput.value) || 1,
                maxVal = parseInt(qInput.max) || 1;
            getElement('qty-minus-btn').disabled = currentVal <= 1;
            getElement('qty-plus-btn').disabled = currentVal >= maxVal;
        }

        function populateStockAndQuantity(stock) {
            const addToCartBtn = getElement('quickview-add-to-cart'),
                qInput = getElement('quickview-quantity'),
                plusBtn = getElement('qty-plus-btn'),
                minusBtn = getElement('qty-minus-btn');
            if (stock.inStock) {
                getElement('quickview-stock-text').textContent = 'In Stock';
                getElement('quickview-stock-badge').classList.remove('out-of-stock');
                getElement('quickview-stock-count').textContent = stock.quantity;
                showElement(getElement('quickview-stock-quantity'));
                addToCartBtn.disabled = false;
                addToCartBtn.querySelector('.btn-text').textContent = 'Add to Cart';
            } else {
                getElement('quickview-stock-text').textContent = 'Out of Stock';
                getElement('quickview-stock-badge').classList.add('out-of-stock');
                hideElement(getElement('quickview-stock-quantity'));
                addToCartBtn.disabled = true;
                addToCartBtn.querySelector('.btn-text').textContent = 'Out of Stock';
            }
            qInput.max = stock.quantity > 0 ? stock.quantity : 1;
            qInput.disabled = !stock.inStock;
            qInput.value = 1;
            plusBtn.onclick = () => {
                qInput.stepUp();
                updateQuantityButtons();
            };
            minusBtn.onclick = () => {
                qInput.stepDown();
                updateQuantityButtons();
            };
            qInput.oninput = updateQuantityButtons;
            updateQuantityButtons();
        }

        function populateRating(rating) {
            const starsContainer = getElement('quickview-stars');
            starsContainer.innerHTML = '';
            rating.stars.forEach(star => {
                const starEl = document.createElement('svg');
                starEl.setAttribute('width', '18');
                starEl.setAttribute('height', '18');
                starEl.setAttribute('viewBox', '0 0 24 24');
                starEl.setAttribute('fill', star.filled ? '#fbbf24' : '#e5e7eb');
                starEl.setAttribute('stroke', star.filled ? '#fbbf24' : '#e5e7eb');
                starEl.innerHTML =
                    '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>';
                starsContainer.appendChild(starEl);
            });
            getElement('quickview-rating-value').textContent = rating.average;
            getElement('quickview-reviews-count').textContent = rating.count;
        }

        function populateImages(images) {
            const mainImageEl = getElement('quickview-main-image'),
                thumbnailsContainer = getElement('quickview-thumbnails');
            thumbnailsContainer.innerHTML = '';
            if (!images || images.length === 0) {
                hideElement(getElement('quickview-prev-image'));
                hideElement(getElement('quickview-next-image'));
                return;
            }
            mainImageEl.src = images[0].url;
            mainImageEl.alt = images[0].alt;
            images.forEach((image, index) => {
                const thumb = document.createElement('div');
                thumb.className = 'thumbnail-item';
                if (index === 0) thumb.classList.add('active');
                thumb.innerHTML = `<img src="${image.url}" alt="${image.alt}">`;
                thumb.addEventListener('click', () => switchToImage(index));
                thumbnailsContainer.appendChild(thumb);
            });
            const showNav = images.length > 1;
            showElement(getElement('quickview-prev-image'), showNav ? 'flex' : 'none');
            showElement(getElement('quickview-next-image'), showNav ? 'flex' : 'none');
        }

        function switchToImage(index) {
            if (!currentProductData || index < 0 || index >= currentProductData.images.length) return;
            currentImageIndex = index;
            getElement('quickview-main-image').src = currentProductData.images[index].url;
            document.querySelectorAll('#quickview-thumbnails .thumbnail-item').forEach((item, i) => item
                .classList.toggle('active', i === index));
            scrollThumbnailIntoView();
        }
        getElement('quickview-prev-image').addEventListener('click', () => navigateImage(-1));
        getElement('quickview-next-image').addEventListener('click', () => navigateImage(1));

        function navigateImage(direction) {
            if (!currentProductData) return;
            const imageCount = currentProductData.images.length;
            let newIndex = (currentImageIndex + direction + imageCount) % imageCount;
            switchToImage(newIndex);
        }

        function scrollThumbnailIntoView() {
            const tc = getElement('quickview-thumbnails'),
                at = tc?.querySelector('.thumbnail-item.active');
            if (!tc || !at) return;
            const scrollLeft = at.offsetLeft + at.offsetWidth / 2 - tc.offsetWidth / 2;
            tc.scrollTo({
                left: scrollLeft,
                behavior: 'smooth'
            });
        }

        function updateWishlistStatus(isInWishlist) {
            const wb = getElement('quickview-wishlist-btn');
            wb.classList.toggle('in-wishlist', isInWishlist);
            getElement('wishlist-text').textContent = isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist';
        }

        const retryBtn = getElement('btn-retry');
        if (retryBtn) retryBtn.addEventListener('click', () => {
            if (retryProductId) loadProductQuickview(retryProductId);
        });

        const shareTooltip = getElement('share-tooltip');
        const shareBtn = getElement('share-btn');
        document.addEventListener('click', e => {
            if (shareTooltip && shareBtn && !shareTooltip.contains(e.target) && !shareBtn.contains(e
                    .target)) {
                shareTooltip.classList.remove('show');
            }
        });

        const compareBtn = getElement('quickview-compare-btn');
        if (compareBtn) {
            compareBtn.addEventListener('click', () => {
                showNotification('Compare feature coming soon!', 'info');
            });
        }
    }
    });
</script>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/ModalQuickview.blade.php ENDPATH**/ ?>