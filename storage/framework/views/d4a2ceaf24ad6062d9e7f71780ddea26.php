<style>
    .header .main-header .header-left .header-search {
        width: 50%;
    }

    .header .main-header .header-left .header-nav {
        width: 35%;
    }

    /* User Avatar Styles */
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        margin-right: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Dropdown Arrow Animation */
    .dropdown-arrow {
        margin-left: 6px;
        transition: transform 0.3s ease;
        font-size: 10px;
    }

    .box-dropdown-cart.active .dropdown-arrow {
        transform: rotate(180deg);
    }

    /* User Account Dropdown */
    .box-dropdown-cart .dropdown-account {
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .box-dropdown-cart.active .dropdown-account {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    /* Search Autocomplete Styles */
    .box-header-search {
        position: relative;
    }

    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e0e0e0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
        display: none;
    }

    .search-results-dropdown.show {
        display: block;
    }

    .search-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: #666;
    }

    .search-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-right: 10px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .search-result-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        transition: background-color 0.2s ease;
        text-decoration: none;
        color: inherit;
    }

    .search-result-item:hover {
        background-color: #f8f9fa;
        text-decoration: none;
        color: inherit;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-image {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        overflow: hidden;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .search-result-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .search-result-info {
        flex: 1;
        min-width: 0;
    }

    .search-result-title {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin: 0 0 4px 0;
        line-height: 1.3;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .search-result-price {
        font-size: 13px;
        color: #666;
        margin: 0;
    }

    .search-no-results {
        padding: 20px;
        text-align: center;
        color: #666;
        font-size: 14px;
    }

    .form-search {
        position: relative;
    }

    /* User Info in Dropdown */
    .dropdown-user-info {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        margin-bottom: 0;
        direction: ltr;
        text-align: left;
    }

    .dropdown-user-info .user-avatar {
        width: 45px;
        height: 45px;
        margin-right: 15px;
        margin-left: 0;
        font-size: 16px;
        border-radius: 10px;
    }

    .dropdown-user-info .user-details {
        flex: 1;
        text-align: left;
    }

    .dropdown-user-info .user-details h6 {
        margin: 0 0 4px 0;
        font-size: 16px;
        font-weight: 600;
        color: #333;
        text-align: left;
    }

    .dropdown-user-info .user-details p {
        margin: 0;
        font-size: 13px;
        color: #666;
        text-align: left;
    }

    /* Dropdown List Animation */
    .dropdown-account ul {
        list-style: none;
        margin: 0;
        padding: 10px 0;
        padding-bottom: 0;
    }

    .dropdown-account ul li {
        padding: 0;
        margin: 0;
        opacity: 0;
        transform: translateX(-10px);
        animation: slideInLeft 0.3s ease forwards;
    }

    .dropdown-account ul li:nth-child(1) {
        animation-delay: 0.1s;
    }

    .dropdown-account ul li:nth-child(2) {
        animation-delay: 0.15s;
    }

    .dropdown-account ul li:nth-child(3) {
        animation-delay: 0.2s;
    }

    .dropdown-account ul li:nth-child(4) {
        animation-delay: 0.25s;
    }

    .dropdown-account ul li:nth-child(5) {
        animation-delay: 0.3s;
    }

    .dropdown-account ul li:nth-child(6) {
        animation-delay: 0.35s;
    }

    @keyframes slideInLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .dropdown-account ul li a {
        display: block;
        padding: 12px 20px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s ease;
        width: 100%;
        text-align: left;
    }

    .dropdown-account ul li a:hover {
        background-color: #f8f9fa;
        color: #333;
        text-decoration: none;
    }

    .dropdown-account ul li form {
        margin: 0;
        padding: 0;
        border-top: 1px solid #eee;
        width: 100%;
    }

    .dropdown-account ul li a,
    .dropdown-account ul li button[type="submit"] {
        padding: 12px 20px;
    }

    .dropdown-account ul li button[type="submit"] {
        color: #dc3545;
        font-weight: 600;
    }

    .dropdown-account ul li button[type="submit"]:hover {
        color: #8B0916FF !important;
        font-weight: 600;
    }

    .dropdown-account ul li form a {
        padding: 0;
        background: none;
        border: none;
    }

    .dropdown-account ul li form button {
        width: 100%;
        background: none;
        border: none;
        padding: 12px 20px;
        text-align: left;
        color: #555;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .dropdown-account ul li form button:hover {
        background-color: #f8f9fa;
        color: #333;
    }

    /* User Account Trigger Styles */
    .user-account-trigger {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        text-decoration: none;
        color: inherit;
        position: relative;
        direction: ltr;
    }

    .user-account-trigger:hover {
        background-color: transparent;
        text-decoration: none;
        color: inherit;
    }

    .user-account-trigger span {
        margin-right: 4px;
        margin-left: 4px;
    }

    .header .main-header .header-left .header-shop {
        width: 43%;
        display: flex;
        margin-left: auto;
        justify-content: end;
        align-items: center;
    }

    /* تحسين موضع الدروب داون */
    .user-dropdown {
        position: relative;
    }

    .user-dropdown .dropdown-account {
        position: absolute;
        top: 100%;
        /* right: 0; */
        left: 0;
        min-width: 280px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        margin-top: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        display: block;
    }

    .user-dropdown.active .dropdown-account {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        padding: 0;
    }

    .dropdown-account ul li form button[type="submit"]:hover {
        background-color: #dc354526;
    }

    @media (max-width: 991px) {

        .header.sticky-bar,
        .header .main-header {
            background-color: transparent !important;
        }

        .header .main-header .header-left {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .header .main-header .header-left .header-logo {
            width: auto;
            flex-grow: 0;
        }

        .header .main-header .header-left .header-nav {
            order: 1;
            /* burger icon */
        }

        .header .main-header .header-left .header-shop {
            order: 2;
            /* user icons */
            width: auto;
            flex-grow: 0;
            margin-left: 15px;
        }

        .header .main-header .header-left .header-search {
            order: 3;
            width: 100%;
            margin-top: 15px;
            padding: 0 5px;
        }

        .header .main-header .header-left .header-search .box-category {
            display: none;
        }

        .header .main-header .header-left .header-search .box-keysearch input {
            border-radius: 8px;
        }
    }
</style>
<header class="header sticky-bar">
    <div class="container">
        <div class="main-header">
            <div class="header-left">
                <div class="header-logo"><a class="d-flex" href="<?php echo e(route('buyer.home')); ?>"><img alt="DjibMarket"
                            src="<?php echo e(asset('assets/imgs/template/mini_logo2.png')); ?>"></a></div>
                <div class="header-search">
                    <div class="box-header-search">
                        <form class="form-search" method="get" action="<?php echo e(route('search.results')); ?>"
                            id="search-form">
                            <div class="box-category">
                                <select class="select-active select2-hidden-accessible" name="category_id"
                                    id="category_id">
                                    <option value="">All categories</option>
                                    <?php $__currentLoopData = $categories->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                            <div class="box-keysearch">
                                <input class="form-control font-xs" type="text" value=""
                                    placeholder="Search for items" id="search_input" name="query" autocomplete="off">
                            </div>
                        </form>
                        <div class="search-results-dropdown" id="search_results">
                            <!-- Search results will be populated here -->
                        </div>
                    </div>
                </div>
                <div class="header-nav">

                    <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span
                            class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
                </div>
                <div class="header-shop">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="d-inline-block box-dropdown-cart user-dropdown">
                            <div class="user-account-trigger">
                                
                                <div class="user-avatar">
                                    <?php if(Auth::user()->avatar ?? false): ?>
                                        <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                                    <?php else: ?>
                                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?><?php echo e(strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1))); ?>

                                    <?php endif; ?>
                                </div>
                                <span><?php echo e(Auth::user()->name); ?></span>
                                <i class="dropdown-arrow">▼</i>
                            </div>
                            <div class="dropdown-account">
                                
                                <div class="dropdown-user-info">
                                    <div class="user-avatar">
                                        <?php if(Auth::user()->avatar ?? false): ?>
                                            <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                                        <?php else: ?>
                                            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?><?php echo e(strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1))); ?>

                                        <?php endif; ?>
                                    </div>
                                    <div class="user-details">
                                        <h6><?php echo e(Auth::user()->name); ?></h6>
                                        <p><?php echo e(Auth::user()->email); ?></p>
                                    </div>
                                </div>
                                <ul>
                                    <li><a href="<?php echo e(route('buyer.dashboard.index')); ?>">Dashboard</a></li>
                                    <li><a href="<?php echo e(route('buyer.dashboard.profile')); ?>">My Profile</a></li>
                                    <li><a href="<?php echo e(route('buyer.dashboard.orders')); ?>">My Orders</a></li>
                                    <li><a href="<?php echo e(route('buyer.dashboard.wishlist')); ?>">My Wishlist</a></li>
                                    <li><a href="<?php echo e(route('buyer.dashboard.addresses')); ?>">My Addresses</a></li>
                                    <li><a href="<?php echo e(route('buyer.dashboard.tracking')); ?>">Order Tracking</a></li>
                                    <li>
                                        <form action="<?php echo e(route('logout')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit">Sign out</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="font-lg icon-list icon-account" href="<?php echo e(route('login')); ?>">
                            <span>Login</span>
                        </a>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a class="font-lg icon-list icon-wishlist" href="<?php echo e(route('buyer.dashboard.wishlist')); ?>">
                            <span>Wishlist</span>
                            <span class="number-item font-xs"
                                id="wishlist-count"><?php echo e(Auth::user()->wishlist()->count()); ?></span>
                        </a>
                    <?php endif; ?>
                    <div class="d-inline-block box-dropdown-cart"><span
                            class="font-lg icon-list icon-cart"><span>Cart</span><span
                                class="number-item font-xs"><?php echo e(app(\App\Services\CartService::class)->getCartCount()); ?></span></span>
                        
                        <?php echo $__env->make('layouts.app.partials.buyer.cart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User dropdown toggle functionality
        const userDropdown = document.querySelector('.user-dropdown');
        const userTrigger = document.querySelector('.user-account-trigger');

        if (userTrigger && userDropdown) {
            userTrigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                userDropdown.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('active');
                }
            });

            // Prevent dropdown from closing when clicking inside
            const dropdownAccount = userDropdown.querySelector('.dropdown-account');
            if (dropdownAccount) {
                dropdownAccount.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        }

        // Search functionality
        const searchInput = document.getElementById('search_input');
        const categorySelect = document.getElementById('category_id');
        const searchResults = document.getElementById('search_results');
        let searchTimeout;

        if (searchInput && searchResults) {
            // Search input event
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                // Clear previous timeout
                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    hideSearchResults();
                    return;
                }

                // Show loading spinner
                showLoading();

                // Delay search to avoid too many requests
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            });

            // Category change event
            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    const query = searchInput.value.trim();
                    if (query.length >= 2) {
                        showLoading();
                        setTimeout(() => {
                            performSearch(query);
                        }, 100);
                    }
                });
            }

            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.closest('.box-header-search').contains(e.target)) {
                    hideSearchResults();
                }
            });

            // Prevent hiding when clicking on search results
            searchResults.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        function performSearch(query) {
            const categoryId = categorySelect ? categorySelect.value : '';

            // Create CSRF token meta tag if it doesn't exist
            let csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                csrfToken = document.createElement('meta');
                csrfToken.name = 'csrf-token';
                csrfToken.content = '<?php echo e(csrf_token()); ?>';
                document.head.appendChild(csrfToken);
            }

            fetch('<?php echo e(route('search.products')); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        query: query,
                        category_id: categoryId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    displaySearchResults(data.products || []);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    hideSearchResults();
                });
        }

        function showLoading() {
            searchResults.innerHTML = `
                <div class="search-loading">
                    <div class="search-spinner"></div>
                    <span>Searching...</span>
                </div>
            `;
            searchResults.classList.add('show');
        }

        function displaySearchResults(products) {
            if (products.length === 0) {
                searchResults.innerHTML = `
                    <div class="search-no-results">
                        No products found for your search.
                    </div>
                `;
            } else {
                const resultsHtml = products.map(product => `
                    <a href="${product.url}" class="search-result-item">
                        <div class="search-result-image">
                            <img src="${product.image}" alt="${product.title}" style="display: ${product.image ? 'block' : 'none'}">
                            ${!product.image ? '<div class="no-image-placeholder">No Image</div>' : ''}
                        </div>
                        <div class="search-result-info">
                            <h6 class="search-result-title">${product.title}</h6>
                            ${product.price ? `<p class="search-result-price">${product.price}</p>` : ''}
                        </div>
                    </a>
                `).join('');

                searchResults.innerHTML = resultsHtml;
            }
            searchResults.classList.add('show');
        }

        function hideSearchResults() {
            searchResults.classList.remove('show');
            searchResults.innerHTML = '';
        }

        // Function to update wishlist count
        function updateWishlistCount() {
            <?php if(auth()->guard()->check()): ?>
            fetch('<?php echo e(route('buyer.dashboard.wishlist.count')); ?>', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const wishlistCountElement = document.getElementById('wishlist-count');
                    if (wishlistCountElement) {
                        wishlistCountElement.textContent = data.count;
                    }
                })
                .catch(error => {
                    console.error('Error updating wishlist count:', error);
                });
        <?php endif; ?>
    }

    // Make function globally available
    window.updateWishlistCount = updateWishlistCount;
    });
</script>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/header.blade.php ENDPATH**/ ?>