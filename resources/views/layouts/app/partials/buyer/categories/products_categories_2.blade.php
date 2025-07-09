@if (isset($homeApplicationCategoryData) && $homeApplicationCategoryData)
    <section class="section-box pt-50 bg-home9">
        <div class="container">
            <!-- Progress Bar -->
            <div class="category-progress-container">
                <div class="progress" style="height: 4px; background-color: #e9ecef;">
                    <div class="progress-bar bg-success" role="progressbar"
                        style="width: 0%; transition: width 0.1s linear;" id="homeApplicationProgressBar"></div>
                </div>
                <div class="progress-text text-center mt-2">
                    <small class="text-muted">Switching to next category in <span id="homeApplicationCountdown">8</span>
                        seconds</small>
                </div>
            </div>

            <div class="box-product-category">
                <div class="d-flex">
                    <div class="box-category-left">
                        <div class="box-menu-category bg-white">
                            <h5 class="title-border-bottom mb-20">
                                {{ $homeApplicationCategoryData['parentCategory']->name }}</h5>
                            <ul class="list-nav-arrow" id="home-application-category-list">
                                @foreach ($homeApplicationCategoryData['subcategories'] as $index => $subcategory)
                                    <li>
                                        <a href="#"
                                            class="home-application-category-link {{ $index === 0 ? 'active' : '' }}"
                                            data-category-index="{{ $index }}"
                                            data-category-id="{{ $subcategory->id }}">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="box-category-right">
                        <div class="row" id="home-application-products-container">
                            @foreach ($homeApplicationCategoryData['subcategories'] as $categoryIndex => $subcategory)
                                <div class="home-application-category-products"
                                    data-category-index="{{ $categoryIndex }}"
                                    style="{{ $categoryIndex === 0 ? 'display: block;' : 'display: none;' }}">

                                    @if ($subcategory->products->count() > 0)
                                        <div class="row">
                                            @foreach ($subcategory->products as $product)
                                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                                    <div class="card-grid-style-3 product-card-equal-height">
                                                        <div class="card-grid-inner">
                                                            <div class="tools">
                                                                <a class="btn btn-trend btn-tooltip mb-10"
                                                                    href="#" aria-label="Trend"></a>
                                                                <a class="btn btn-wishlist btn-tooltip mb-10"
                                                                    href="shop-wishlist.html"
                                                                    aria-label="Add To Wishlist"></a>
                                                                <a class="btn btn-compare btn-tooltip mb-10"
                                                                    href="shop-compare.html" aria-label="Compare"></a>
                                                                <a class="btn btn-quickview btn-tooltip"
                                                                    aria-label="Quick view" href="#ModalQuickview"
                                                                    data-bs-toggle="modal"></a>
                                                            </div>
                                                            <div class="image-box">
                                                                @if (
                                                                    $product->price_discounted &&
                                                                        $product->price_discounted > 0 &&
                                                                        $product->price_discounted < $product->price_regular)
                                                                    @php
                                                                        $discountPercentage = round(
                                                                            (($product->price_regular -
                                                                                $product->price_discounted) /
                                                                                $product->price_regular) *
                                                                                100,
                                                                        );
                                                                    @endphp
                                                                    <span
                                                                        class="label bg-success">-{{ $discountPercentage }}%</span>
                                                                @endif
                                                                <a
                                                                    href="{{ route('buyer.product.show', $product->slug) }}">
                                                                    @if ($product->thumbnail)
                                                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                            alt="{{ $product->title }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/imgs/page/homepage1/imgsp7.png') }}"
                                                                            alt="{{ $product->title }}">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="info-right">
                                                                <div class="product-meta">
                                                                    <span
                                                                        class="font-xs color-gray-500">{{ $product->category->name }}</span>
                                                                </div>
                                                                <div class="product-title">
                                                                    <a class="color-brand-3 font-sm-bold"
                                                                        href="{{ route('buyer.product.show', $product->slug) }}">
                                                                        {{ Str::limit($product->title, 50) }}
                                                                    </a>
                                                                </div>
                                                                <!-- Star Rating Section -->
                                                                <div class="rating">
                                                                    @if ($product->reviews && $product->reviews->count() > 0)
                                                                        @php
                                                                            $averageRating = $product->reviews->avg(
                                                                                'rating',
                                                                            );
                                                                            $fullStars = floor($averageRating);
                                                                            $hasHalfStar =
                                                                                $averageRating - $fullStars >= 0.5;
                                                                            $reviewCount = $product->reviews->count();
                                                                        @endphp
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $fullStars)
                                                                                <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                                                    alt="Star" class="star-icon">
                                                                            @elseif($i == $fullStars + 1 && $hasHalfStar)
                                                                                <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                                                    alt="Half Star" class="star-icon"
                                                                                    style="opacity: 0.5;">
                                                                            @else
                                                                                <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                                                    alt="Empty Star"
                                                                                    class="star-icon star-gray">
                                                                            @endif
                                                                        @endfor
                                                                        <span
                                                                            class="font-xs color-gray-500">({{ $reviewCount }})</span>
                                                                    @else
                                                                        {{-- Default 5 gray stars with 0 reviews --}}
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            <img src="{{ asset('assets/imgs/template/icons/star.svg') }}"
                                                                                alt="Star"
                                                                                class="star-icon star-gray">
                                                                        @endfor
                                                                        <span class="font-xs color-gray-500">(0)</span>
                                                                    @endif
                                                                </div>
                                                                <div class="price-info">
                                                                    @if (
                                                                        $product->price_discounted &&
                                                                            $product->price_discounted > 0 &&
                                                                            $product->price_discounted < $product->price_regular)
                                                                        <strong
                                                                            class="font-lg-bold color-brand-3 price-main">{{ number_format($product->price_discounted, 0, ',', ' ') }}
                                                                            DJF</strong>
                                                                        <span
                                                                            class="color-gray-500 price-line">{{ number_format($product->price_regular, 0, ',', ' ') }}
                                                                            DJF</span>
                                                                    @else
                                                                        <strong
                                                                            class="font-lg-bold color-brand-3 price-main">{{ number_format($product->price_regular, 0, ',', ' ') }}
                                                                            DJF</strong>
                                                                    @endif
                                                                </div>
                                                                @if ($product->description)
                                                                    <div class="product-features">
                                                                        <ul class="list-features">
                                                                            @php
                                                                                $features = explode(
                                                                                    "\n",
                                                                                    strip_tags($product->description),
                                                                                );
                                                                                $features = array_filter(
                                                                                    array_map('trim', $features),
                                                                                );
                                                                                $features = array_slice(
                                                                                    $features,
                                                                                    0,
                                                                                    3,
                                                                                );
                                                                            @endphp
                                                                            @foreach ($features as $feature)
                                                                                @if (!empty($feature))
                                                                                    <li>{{ Str::limit($feature, 60) }}
                                                                                    </li>
                                                                                @endif
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <div class="text-center py-5">
                                                <p class="color-gray-500">No products found in this category.</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Progress Bar Styles for Home Application */
        .category-progress-container {
            position: relative;
            padding: .5rem;
            border: 1px solid #d5dfe4;
            border-bottom: 0;
            border-top-left-radius: .5rem;
            border-top-right-radius: .5rem;
        }

        .progress {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 0.1s linear;
        }

        .bg-success {
            background: linear-gradient(90deg, #28a745 0%, #20692e 100%) !important;
        }

        .progress-text {
            margin-top: 8px;
        }

        /* Category Link Styles */
        .home-application-category-link {
            transition: all 0.3s ease;
            padding: 8px 12px;
            border-radius: 4px;
            display: block;
        }

        .home-application-category-link.active {
            background-color: #f8f9fa;
            color: #28a745;
            font-weight: 600;
        }

        .home-application-category-link:hover {
            background-color: #e9ecef;
            text-decoration: none;
        }

        /* Product Container Styles */
        .home-application-category-products {
            width: 100%;
        }

        /* Equal Height Product Cards */
        .product-card-equal-height {
            background: white;
            /* border: 1px solid #e9ecef; */
            border-radius: 8px;
            /* overflow: hidden; */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); */
            height: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .product-card-equal-height:hover {
            transform: translateY(-3px);
            /* box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); */
        }

        .product-card-equal-height .card-grid-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card-equal-height .image-box {
            flex-shrink: 0;
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            position: relative;
        }

        .product-card-equal-height .image-box img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .product-card-equal-height .info-right {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 15px;
            justify-content: space-between;
        }

        .product-card-equal-height .product-meta {
            margin-bottom: 8px;
        }

        .product-card-equal-height .product-title {
            margin-bottom: 10px;
            min-height: 45px;
            display: flex;
            align-items: flex-start;
        }

        .product-card-equal-height .product-title a {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .product-card-equal-height .rating {
            margin-bottom: 10px;
            min-height: 20px;
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .rating .star-icon {
            width: 14px;
            height: 14px;
            display: inline-block;
        }

        .rating .star-gray {
            filter: grayscale(100%) brightness(0.7);
            opacity: 0.4;
        }

        .product-card-equal-height .price-info {
            margin-bottom: 15px;
            margin-top: auto;
        }

        .product-card-equal-height .product-features {
            margin-top: auto;
        }

        .product-card-equal-height .list-features {
            margin: 0;
            padding: 0;
            list-style: none;
            max-height: 90px;
            overflow: hidden;
        }

        .product-card-equal-height .list-features li {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .price-line {
            text-decoration: line-through;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category switching for home application section
            const homeApplicationCategoryLinks = document.querySelectorAll('.home-application-category-link');
            const homeApplicationCategoryProducts = document.querySelectorAll(
                '.home-application-category-products');
            const homeApplicationProgressBar = document.getElementById('homeApplicationProgressBar');
            const homeApplicationCountdownElement = document.getElementById('homeApplicationCountdown');

            // Timing state management for home application
            let homeApplicationCurrentCategoryIndex = 0;
            let homeApplicationMainTimer = null;
            let homeApplicationProgressTimer = null;
            let homeApplicationIsActive = false;
            let homeApplicationIsPaused = false;
            let homeApplicationIsManuallyControlled = false;

            const HOME_APPLICATION_TOTAL_TIME = 8000; // 8 seconds in milliseconds
            const HOME_APPLICATION_PROGRESS_UPDATE_INTERVAL = 50; // Update every 50ms

            // Core functions for home application
            function showHomeApplicationCategory(index) {
                // Hide all categories
                homeApplicationCategoryProducts.forEach(product => {
                    product.style.display = 'none';
                });

                // Remove active class from all links
                homeApplicationCategoryLinks.forEach(link => {
                    link.classList.remove('active');
                });

                // Show selected category and highlight link
                if (homeApplicationCategoryProducts[index]) {
                    homeApplicationCategoryProducts[index].style.display = 'block';
                    homeApplicationCategoryLinks[index].classList.add('active');
                }

                homeApplicationCurrentCategoryIndex = index;
            }

            function nextHomeApplicationCategory() {
                const nextIndex = (homeApplicationCurrentCategoryIndex + 1) % homeApplicationCategoryLinks.length;
                showHomeApplicationCategory(nextIndex);
            }

            function updateHomeApplicationDisplay(remainingMs) {
                const progressPercentage = ((HOME_APPLICATION_TOTAL_TIME - remainingMs) /
                    HOME_APPLICATION_TOTAL_TIME) * 100;
                const secondsLeft = Math.max(1, Math.ceil(remainingMs / 1000));

                if (homeApplicationProgressBar) {
                    homeApplicationProgressBar.style.width = progressPercentage + '%';
                }

                if (homeApplicationCountdownElement) {
                    homeApplicationCountdownElement.textContent = secondsLeft;
                }
            }

            function resetHomeApplicationDisplay() {
                if (homeApplicationProgressBar) {
                    homeApplicationProgressBar.style.width = '0%';
                }
                if (homeApplicationCountdownElement) {
                    homeApplicationCountdownElement.textContent = '8';
                }
            }

            function showHomeApplicationPauseIndicator() {
                if (homeApplicationCountdownElement) {
                    homeApplicationCountdownElement.textContent = '⏸';
                }
            }

            function destroyAllHomeApplicationTimers() {
                if (homeApplicationMainTimer) {
                    clearTimeout(homeApplicationMainTimer);
                    homeApplicationMainTimer = null;
                }
                if (homeApplicationProgressTimer) {
                    clearInterval(homeApplicationProgressTimer);
                    homeApplicationProgressTimer = null;
                }
                homeApplicationIsActive = false;
                homeApplicationIsPaused = false;
            }

            function startHomeApplicationCycle() {
                if (homeApplicationIsActive || homeApplicationCategoryLinks.length <= 1) {
                    return;
                }

                homeApplicationIsActive = true;
                homeApplicationIsPaused = false;
                homeApplicationIsManuallyControlled = false;

                resetHomeApplicationDisplay();

                let remainingTime = HOME_APPLICATION_TOTAL_TIME;

                homeApplicationProgressTimer = setInterval(() => {
                    if (!homeApplicationIsPaused && homeApplicationIsActive) {
                        remainingTime -= HOME_APPLICATION_PROGRESS_UPDATE_INTERVAL;

                        if (remainingTime <= 0) {
                            clearInterval(homeApplicationProgressTimer);
                            homeApplicationProgressTimer = null;
                            homeApplicationIsActive = false;

                            nextHomeApplicationCategory();

                            setTimeout(() => {
                                if (!homeApplicationIsManuallyControlled) {
                                    startHomeApplicationCycle();
                                }
                            }, 100);
                        } else {
                            updateHomeApplicationDisplay(remainingTime);
                        }
                    }
                }, HOME_APPLICATION_PROGRESS_UPDATE_INTERVAL);

                homeApplicationMainTimer = setTimeout(() => {
                    if (homeApplicationIsActive && !homeApplicationIsPaused) {
                        destroyAllHomeApplicationTimers();
                        nextHomeApplicationCategory();
                        setTimeout(() => {
                            if (!homeApplicationIsManuallyControlled) {
                                startHomeApplicationCycle();
                            }
                        }, 100);
                    }
                }, HOME_APPLICATION_TOTAL_TIME + 100);
            }

            function pauseHomeApplicationCycle() {
                if (homeApplicationIsActive && !homeApplicationIsPaused) {
                    homeApplicationIsPaused = true;
                    showHomeApplicationPauseIndicator();
                }
            }

            function resumeHomeApplicationCycle() {
                if (homeApplicationIsActive && homeApplicationIsPaused && !homeApplicationIsManuallyControlled) {
                    homeApplicationIsPaused = false;
                }
            }

            function stopHomeApplicationCycle() {
                destroyAllHomeApplicationTimers();
                resetHomeApplicationDisplay();
                homeApplicationIsManuallyControlled = true;
            }

            function forceRestartHomeApplication() {
                destroyAllHomeApplicationTimers();
                homeApplicationIsManuallyControlled = false;

                setTimeout(() => {
                    startHomeApplicationCycle();
                }, 50);
            }

            // Event handlers for home application
            homeApplicationCategoryLinks.forEach((link, index) => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    showHomeApplicationCategory(index);
                    stopHomeApplicationCycle();
                    forceRestartHomeApplication();
                });
            });

            // Hover controls for home application
            const homeApplicationSectionElement = document.querySelector('#home-application-products-container')
                .closest('.box-product-category');
            if (homeApplicationSectionElement) {
                homeApplicationSectionElement.addEventListener('mouseenter', () => {
                    if (homeApplicationIsActive && !homeApplicationIsManuallyControlled) {
                        pauseHomeApplicationCycle();
                    }
                });

                homeApplicationSectionElement.addEventListener('mouseleave', () => {
                    if (homeApplicationIsActive && !homeApplicationIsManuallyControlled) {
                        resumeHomeApplicationCycle();
                    }
                });
            }

            // Initialize home application
            if (homeApplicationCategoryLinks.length > 1) {
                startHomeApplicationCycle();
            }
        });
    </script>
@else
    <section class="section-box pt-50 bg-home9">
        <div class="container">
            <div class="box-product-category">
                <div class="d-flex">
                    <div class="box-category-left">
                        <div class="box-menu-category bg-white">
                            <h5 class="title-border-bottom mb-20">Home Application</h5>
                            <p class="color-gray-500">Please add categories and products to display content here.</p>
                        </div>
                    </div>
                    <div class="box-category-right">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <p class="color-gray-500">No categories or products found.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
