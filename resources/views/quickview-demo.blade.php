<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quick View Demo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .product-demo-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .product-demo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #28a745;
        }

        .quick-view-btn {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quick-view-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5">Quick View Demo</h1>
                <p class="text-center text-muted mb-5">Click the "Quick View" button on any product to test the
                    functionality</p>
            </div>
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="product-demo-card">
                        <div class="product-image mb-3">
                            @if ($product->primary_image_url)
                                <img src="{{ $product->primary_image_url }}" alt="{{ $product->title }}"
                                    class="product-image">
                            @else
                                <span>No Image</span>
                            @endif
                        </div>

                        <h5 class="card-title">{{ Str::limit($product->title, 50) }}</h5>

                        <div class="mb-2">
                            <small class="text-muted">
                                Seller: {{ $product->seller->name ?? 'Unknown' }}
                            </small>
                        </div>

                        <div class="mb-2">
                            <small class="text-muted">
                                Category: {{ $product->category->name ?? 'Uncategorized' }}
                            </small>
                        </div>

                        <div class="price mb-3">
                            @if ($product->price_discounted && $product->price_discounted < $product->price_regular)
                                <span
                                    class="text-decoration-line-through text-muted small">{{ number_format($product->price_regular, 0) }}
                                    DJF</span>
                                <span class="text-success">{{ number_format($product->price_discounted, 0) }} DJF</span>
                            @else
                                <span>{{ number_format($product->price_regular, 0) }} DJF</span>
                            @endif
                        </div>

                        <button type="button" class="quick-view-btn btn w-100" data-bs-toggle="modal"
                            data-bs-target="#ModalQuickview" data-product-id="{{ $product->id }}">
                            👁 Quick View
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>No Products Found</h4>
                        <p>Please create some test products first:</p>
                        <a href="/create-enhanced-product" class="btn btn-primary">Create Test Product</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Include the Quick View Modal -->
    @include('layouts.app.partials.buyer.ModalQuickview')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Quick View JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quickviewModal = document.getElementById('ModalQuickview');
            if (quickviewModal) {
                // Make currentProductData globally accessible
                window.currentProductData = null;
                let currentImageIndex = 0;
                let retryProductId = null;

                quickviewModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const productId = button.getAttribute('data-product-id');
                    retryProductId = productId;

                    console.log('Opening quickview for product ID:', productId);

                    if (!productId) {
                        console.error('No product ID found');
                        showError('Error: No product ID specified');
                        return;
                    }

                    loadProductQuickview(productId);
                });

                function loadProductQuickview(productId) {
                    showLoading();

                    const quickviewUrl = `/products/${productId}/quickview`;
                    console.log('Fetching from URL:', quickviewUrl);

                    fetch(quickviewUrl, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            console.log('Response status:', response.status);

                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw new Error(errorData.message ||
                                        `HTTP error! status: ${response.status}`);
                                }).catch(() => {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Quickview data received:', data);

                            if (!data.success) {
                                throw new Error(data.message || 'Failed to load product details');
                            }

                            window.currentProductData = data.product;
                            currentImageIndex = 0;
                            populateModal(data.product);
                            showContent();
                        })
                        .catch(error => {
                            console.error('Error fetching quickview data:', error);
                            showError(error.message);
                        });
                }

                function showLoading() {
                    document.getElementById('quickview-loading').style.display = 'flex';
                    document.getElementById('quickview-content').style.display = 'none';
                    document.getElementById('quickview-error').style.display = 'none';
                }

                function showContent() {
                    document.getElementById('quickview-loading').style.display = 'none';
                    document.getElementById('quickview-content').style.display = 'block';
                    document.getElementById('quickview-error').style.display = 'none';
                }

                function showError(message) {
                    document.getElementById('quickview-loading').style.display = 'none';
                    document.getElementById('quickview-content').style.display = 'none';
                    document.getElementById('quickview-error').style.display = 'flex';
                    document.getElementById('quickview-error-message').textContent = message;
                }

                function populateModal(product) {
                    // Basic info
                    document.getElementById('quickview-title').textContent = product.title;
                    document.getElementById('quickview-category').textContent = product.category.name;
                    document.getElementById('quickview-category-link').href = product.category.url;
                    document.getElementById('quickview-seller').textContent = product.seller.name;
                    document.getElementById('quickview-seller-link').href = product.seller.url;

                    // Description
                    document.getElementById('quickview-description').textContent = product.shortDescription ||
                        product.description || 'No description available';

                    // Pricing
                    const currentPriceEl = document.getElementById('quickview-current-price');
                    const originalPriceEl = document.getElementById('quickview-original-price');
                    const savingsEl = document.getElementById('quickview-savings');
                    const discountBadgeEl = document.getElementById('quickview-discount-badge');
                    const discountTextEl = document.getElementById('quickview-discount-text');

                    currentPriceEl.textContent = product.price.hasDiscount ? product.price.discountedFormatted :
                        product.price.regularFormatted;

                    if (product.price.hasDiscount) {
                        originalPriceEl.textContent = product.price.regularFormatted;
                        originalPriceEl.style.display = 'inline';

                        const savings = product.price.regular - product.price.discounted;
                        document.getElementById('quickview-savings-amount').textContent =
                            `${savings.toFixed(0)} DJF`;
                        savingsEl.style.display = 'block';

                        discountTextEl.textContent = `-${product.price.discountPercentage}%`;
                        discountBadgeEl.style.display = 'block';
                    } else {
                        originalPriceEl.style.display = 'none';
                        savingsEl.style.display = 'none';
                        discountBadgeEl.style.display = 'none';
                    }

                    // Stock status
                    const stockBadgeEl = document.getElementById('quickview-stock-badge');
                    const stockTextEl = document.getElementById('quickview-stock-text');
                    if (product.stock.inStock) {
                        stockTextEl.textContent = 'In Stock';
                        stockBadgeEl.classList.remove('out-of-stock');
                    } else {
                        stockTextEl.textContent = 'Out of Stock';
                        stockBadgeEl.classList.add('out-of-stock');
                    }

                    // Rating
                    populateRating(product.rating);

                    // Images
                    populateImages(product.images);

                    // Action buttons
                    setupActionButtons(product);
                }

                function populateRating(rating) {
                    const starsContainer = document.getElementById('quickview-stars');
                    starsContainer.innerHTML = '';

                    rating.stars.forEach(star => {
                        const starEl = document.createElement('svg');
                        starEl.setAttribute('width', '18');
                        starEl.setAttribute('height', '18');
                        starEl.setAttribute('viewBox', '0 0 24 24');
                        starEl.setAttribute('fill', star.filled ? '#fbbf24' : '#e5e7eb');
                        starEl.setAttribute('stroke', star.filled ? '#fbbf24' : '#e5e7eb');
                        starEl.setAttribute('stroke-width', '2');
                        starEl.classList.add('star');
                        if (!star.filled) starEl.classList.add('empty');

                        const path = document.createElement('path');
                        path.setAttribute('d',
                            'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z'
                        );
                        starEl.appendChild(path);

                        starsContainer.appendChild(starEl);
                    });

                    document.getElementById('quickview-rating-value').textContent = rating.average;
                    document.getElementById('quickview-reviews-count').textContent = rating.count;
                }

                function populateImages(images) {
                    const mainImageEl = document.getElementById('quickview-main-image');
                    const thumbnailsContainer = document.getElementById('quickview-thumbnails');
                    const prevBtn = document.getElementById('quickview-prev-image');
                    const nextBtn = document.getElementById('quickview-next-image');

                    if (images.length > 0) {
                        // Set main image
                        mainImageEl.src = images[0].url;
                        mainImageEl.alt = images[0].alt;

                        // Generate thumbnails
                        thumbnailsContainer.innerHTML = '';
                        images.forEach((image, index) => {
                            const thumbnailItem = document.createElement('div');
                            thumbnailItem.className = `thumbnail-item ${index === 0 ? 'active' : ''}`;
                            thumbnailItem.onclick = () => switchToImage(index);

                            const img = document.createElement('img');
                            img.src = image.url;
                            img.alt = image.alt;
                            thumbnailItem.appendChild(img);

                            thumbnailsContainer.appendChild(thumbnailItem);
                        });

                        // Navigation buttons
                        if (images.length > 1) {
                            prevBtn.style.display = 'flex';
                            nextBtn.style.display = 'flex';
                            prevBtn.onclick = () => navigateImage(-1);
                            nextBtn.onclick = () => navigateImage(1);
                        } else {
                            prevBtn.style.display = 'none';
                            nextBtn.style.display = 'none';
                        }
                    }
                }

                function switchToImage(index) {
                    if (!currentProductData || index < 0 || index >= currentProductData.images.length) return;

                    currentImageIndex = index;
                    const image = currentProductData.images[index];

                    document.getElementById('quickview-main-image').src = image.url;
                    document.getElementById('quickview-main-image').alt = image.alt;

                    // Update active thumbnail
                    document.querySelectorAll('.thumbnail-item').forEach((item, i) => {
                        item.classList.toggle('active', i === index);
                    });
                }

                function navigateImage(direction) {
                    if (!currentProductData) return;

                    const newIndex = currentImageIndex + direction;
                    if (newIndex < 0) {
                        switchToImage(currentProductData.images.length - 1);
                    } else if (newIndex >= currentProductData.images.length) {
                        switchToImage(0);
                    } else {
                        switchToImage(newIndex);
                    }
                }

                function setupActionButtons(product) {
                    const addToCartBtn = document.getElementById('quickview-add-to-cart');
                    const buyNowBtn = document.getElementById('quickview-buy-now');

                    // Add to cart
                    addToCartBtn.onclick = (e) => {
                        e.preventDefault();
                        if (!product.stock.inStock) {
                            alert('This product is currently out of stock.');
                            return;
                        }

                        alert('Add to cart functionality would be implemented here!');
                    };

                    // Buy now
                    buyNowBtn.href = product.urls.view;

                    // Disable if out of stock
                    if (!product.stock.inStock) {
                        addToCartBtn.disabled = true;
                        addToCartBtn.querySelector('.btn-text').textContent = 'Out of Stock';
                        addToCartBtn.style.background = '#6b7280';
                    }
                }

                // Quantity controls
                window.updateQuantity = function(change) {
                    const quantityInput = document.getElementById('quickview-quantity');
                    const currentValue = parseInt(quantityInput.value) || 1;
                    const newValue = Math.max(1, Math.min(10, currentValue + change));
                    quantityInput.value = newValue;
                };

                // Retry function
                window.retryQuickview = function() {
                    if (retryProductId) {
                        loadProductQuickview(retryProductId);
                    }
                };
            }
        });
    </script>
</body>

</html>
