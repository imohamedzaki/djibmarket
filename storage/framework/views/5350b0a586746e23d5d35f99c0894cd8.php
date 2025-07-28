<style>
    /* Custom styles for the navbar and mega menu with mm prefix */

    /* Reset and base styles */
    * {
        box-sizing: border-box;
    }

    /* Utility classes - Layout */
    .mm-relative {
        position: relative;
    }

    .mm-absolute {
        position: absolute;
    }

    .mm-sticky {
        position: sticky;
    }

    .mm-left-0 {
        left: 0;
    }

    .mm-right-0 {
        right: 0;
    }

    .mm-top-0 {
        top: 0;
    }

    .mm-h-full {
        height: 100%;
    }

    /* Utility classes - Display and Flexbox */
    .mm-flex {
        display: flex;
    }

    .mm-items-center {
        align-items: center;
    }

    .mm-hidden {
        display: none;
    }

    /* Utility classes - Spacing */
    .mm-px-2 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .mm-px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .mm-py-3 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .mm-py-8 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .mm-pt-6 {
        padding-top: 1.5rem;
    }

    .mm-pb-4 {
        padding-bottom: 1rem;
    }

    .mm-mb-4 {
        margin-bottom: 1rem;
    }

    .mm-mt-8 {
        margin-top: 2rem;
    }

    .mm-mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    .mm-space-x-1>*+* {
        margin-left: 0.25rem;
    }

    /* Utility classes - Sizing and Max Width */
    .mm-max-w-7xl {
        max-width: 80rem;
    }

    /* Utility classes - Colors */
    .mm-bg-white {
        background-color: #ffffff;
    }

    .mm-text-gray-600 {
        color: #4b5563;
    }

    .mm-text-gray-700 {
        color: #374151;
    }

    .mm-text-gray-900 {
        color: #111827;
    }

    .mm-text-blue-600 {
        color: #2563eb;
    }

    .mm-text-yellow-600 {
        color: #d97706;
    }

    .mm-border-gray-100 {
        border-color: #f3f4f6;
    }

    .mm-border-gray-200 {
        border-color: #e5e7eb;
    }

    .mm-border-yellow-400 {
        border-color: #fbbf24;
    }

    .mm-bg-yellow-50 {
        background-color: #fefce8;
    }

    .mm-bg-yellow-100 {
        background-color: #fef3c7;
    }

    /* Utility classes - Borders */
    .mm-border-b {
        border-bottom-width: 1px;
    }

    .mm-border-t {
        border-top-width: 1px;
    }

    /* Utility classes - Shadows */
    .mm-shadow-lg {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
            0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Utility classes - Z-index */
    .mm-z-10 {
        z-index: 10;
    }

    .mm-z-40 {
        z-index: 40;
    }

    .mm-z-50 {
        z-index: 50;
    }

    /* Utility classes - Overflow */
    .mm-overflow-x-auto {
        overflow-x: auto;
    }

    /* Utility classes - Scroll behavior */
    .mm-scroll-smooth {
        scroll-behavior: smooth;
    }

    /* Utility classes - Gradients */
    .mm-bg-gradient-to-r {
        background-image: linear-gradient(to right, var(--tw-gradient-stops));
    }

    .mm-bg-gradient-to-l {
        background-image: linear-gradient(to left, var(--tw-gradient-stops));
    }

    .mm-from-white {
        --tw-gradient-from: #ffffff;
        --tw-gradient-stops: var(--tw-gradient-from),
            var(--tw-gradient-to, rgba(255, 255, 255, 0));
    }

    .mm-via-white {
        --tw-gradient-via: #ffffff;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-via),
            var(--tw-gradient-to, rgba(255, 255, 255, 0));
    }

    .mm-to-transparent {
        --tw-gradient-to: transparent;
    }

    /* Grid utilities */
    .mm-grid {
        display: grid;
    }

    .mm-grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    .mm-gap-8 {
        gap: 2rem;
    }

    /* Typography utilities */
    .mm-text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    .mm-font-semibold {
        font-weight: 600;
    }

    .mm-uppercase {
        text-transform: uppercase;
    }

    .mm-tracking-wider {
        letter-spacing: 0.05em;
    }

    /* List utilities */
    .mm-space-y-3>*+* {
        margin-top: 0.75rem;
    }

    /* Responsive utilities - Medium screens (768px+) */
    @media (min-width: 768px) {
        .mm-md-px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .mm-md-space-x-6>*+* {
            margin-left: 1.5rem;
        }

        .mm-md-col-span-3 {
            grid-column: span 3 / span 3;
        }

        .mm-md-col-span-9 {
            grid-column: span 9 / span 9;
        }

        .mm-md-grid-cols-12 {
            grid-template-columns: repeat(12, minmax(0, 1fr));
        }

        .mm-md-grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    /* Responsive utilities - Small screens (640px+) */
    @media (min-width: 640px) {
        .mm-sm-grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* Responsive utilities - Large screens (1024px+) */
    @media (min-width: 1024px) {
        .mm-lg-grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    /* Scrollbar hiding styles */
    .mm-scrollbar-hide {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }

    .mm-scrollbar-hide::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari and Opera */
    }

    /* Font family */
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
            Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    }

    /* Navigation category hover effects */
    .mm-nav-category {
        position: relative;
        white-space: nowrap;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
        transition: color 0.15s ease-in-out;
        color: #374151;
        /* text-gray-700 */
    }

    .mm-nav-category:hover,
    .mm-nav-category.mm-active {
        color: #2563eb;
        /* text-blue-600 */
    }

    .mm-nav-category.mm-active::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #2563eb;
        /* bg-blue-600 */
        animation: fadeIn 0.15s ease-in-out;
    }

    /* Mega menu animations */
    .mm-mega-menu {
        animation: fadeIn 0.15s ease-in-out;
    }

    .mm-mega-menu.mm-hidden {
        display: none;
    }

    .mm-mega-menu.mm-show {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Brand hover effects */
    .mm-brand-item {
        transition: all 0.15s ease-in-out;
    }

    .mm-brand-item:hover .mm-brand-container {
        border-color: #93c5fd;
        /* border-blue-300 */
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    /* Category group link hover effects */
    .mm-category-link {
        color: #4b5563;
        /* text-gray-600 */
        transition: color 0.15s ease-in-out;
        display: block;
    }

    .mm-category-link:hover {
        color: #2563eb;
        /* text-blue-600 */
    }

    /* Try Free button styles */
    .mm-try-free-btn {
        color: #d97706;
        /* text-yellow-600 */
        font-weight: 500;
        white-space: nowrap;
        border: 1px solid #fbbf24;
        /* border-yellow-400 */
        border-radius: 9999px;
        padding: 0.25rem 1rem;
        font-size: 0.875rem;
        background-color: #fefce8;
        /* bg-yellow-50 */
        transition: background-color 0.15s ease-in-out;
        cursor: pointer;
    }

    .mm-try-free-btn:hover {
        background-color: #fef3c7;
        /* bg-yellow-100 */
    }

    /* Scroll button styles */
    .mm-scroll-btn {
        height: 100%;
        padding: 0 0.5rem;
        transition: opacity 0.15s ease-in-out;
    }

    .mm-scroll-btn.mm-show {
        display: block;
    }

    .mm-scroll-btn.mm-hide {
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .mm-nav-category {
            padding: 0.5rem 0.75rem;
        }

        #mm-categories-container {
            gap: 0.25rem;
        }
    }

    /* Ensure proper z-index layering */
    .mm-navbar-container {
        position: relative;
        z-index: 110;
    }

    .mm-mega-menu {
        z-index: 40;
    }

    /* Smooth scrolling for categories container */
    #mm-categories-container {
        scroll-behavior: smooth;
    }

    /* Promo image container */
    .mm-promo-container {
        position: relative;
        height: 300px;
        /* Fixed height for consistent sizing */
        min-height: 300px;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    @media (min-width: 768px) {
        .mm-promo-container {
            height: 400px;
            min-height: 400px;
        }
    }

    .mm-promo-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mm-promo-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        padding: 1.5rem;
    }

    .mm-promo-title {
        color: white;
        font-weight: bold;
        font-size: 2rem;
        line-height: 1.25;
        letter-spacing: -0.025em;
    }

    /* Slider styles */
    .mm-slider {
        position: relative;
    }

    .mm-slides-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .mm-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        pointer-events: none;
        /* Disable clicks on inactive slides */
    }

    .mm-slide-active {
        opacity: 1;
        pointer-events: auto;
        /* Enable clicks only on active slide */
    }

    .mm-slide-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1;
    }

    .mm-slider-controls {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }

    .mm-dots {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .mm-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .mm-dot:hover {
        background-color: rgba(255, 255, 255, 0.8);
    }

    .mm-dot-active {
        background-color: rgba(255, 255, 255, 1);
    }

    /* Skeleton loading effects */
    .mm-skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: mm-skeleton-loading 1.5s infinite;
    }

    @keyframes mm-skeleton-loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    .mm-image-container {
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .mm-image-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        transition: opacity 0.3s ease;
    }

    .mm-image-placeholder.mm-hidden {
        opacity: 0;
        pointer-events: none;
    }

    .mm-image-error {
        filter: grayscale(100%);
        opacity: 0.6;
    }

    .mm-brand-image {
        width: 100%;
        height: 2rem;
        object-fit: contain;
        margin-bottom: 0.5rem;
        transition: opacity 0.3s ease;
    }

    .mm-brand-image.mm-loading {
        opacity: 0;
    }

    .mm-promo-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease;
    }

    .mm-promo-image.mm-loading {
        opacity: 0;
    }

    /* Brand grid layout adjustments */
    .mm-brands-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    @media (min-width: 640px) {
        .mm-brands-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (min-width: 768px) {
        .mm-brands-grid {
            grid-template-columns: repeat(6, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .mm-brands-grid {
            grid-template-columns: repeat(8, 1fr);
        }
    }

    .mm-brand-container {
        padding: 0.75rem;
        border: 1px solid #e5e7eb;
        /* border-gray-200 */
        border-radius: 0.5rem;
        background-color: #ffffff;
        text-align: center;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }



    .mm-brand-name {
        font-size: 0.75rem;
        color: #6b7280;
        /* text-gray-500 */
        font-weight: 500;
    }

    .mm-no-brand-container {
        padding: 0.75rem;
        border: 1px dashed #d1d5db;
        /* border-gray-300 */
        border-radius: 0.5rem;
        background-color: #ffffff;
        text-align: center;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        /* text-gray-400 */
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Scroll Button Styles */
    #mm-scroll-left-btn,
    #mm-scroll-right-btn {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: none;
        outline: none;
        transition: all 0.3s ease;
    }

    #mm-scroll-left-btn:hover,
    #mm-scroll-right-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
    }

    #mm-scroll-left-btn:focus,
    #mm-scroll-right-btn:focus {
        outline: none;
        box-shadow: none;
    }

    #mm-scroll-left-btn {
        /* background: linear-gradient(90deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px); */
    }

    #mm-scroll-right-btn {
        /* background: linear-gradient(270deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px); */
    }
</style>

<!-- Menu Data in HTML Format -->
<div id="mm-menu-data" style="display: none">
    <?php
        $fallbackLogo = asset('assets/imgs/template/logo_only.png');
    ?>

    <?php if(isset($megaMenuCategories)): ?>
        <?php $__currentLoopData = $megaMenuCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mm-category" data-id="<?php echo e($parentCategory->slug); ?>" data-name="<?php echo e($parentCategory->name); ?>"
                data-link="<?php echo e(route('categories.show', $parentCategory)); ?>" data-fallback-logo="<?php echo e($fallbackLogo); ?>">

                <?php $__currentLoopData = $parentCategory->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mm-group" data-title="<?php echo e($childCategory->name); ?>">
                        <?php if($childCategory->children->isNotEmpty()): ?>
                            <?php $__currentLoopData = $childCategory->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandChildCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mm-item" data-name="<?php echo e($grandChildCategory->name); ?>"
                                    data-link="<?php echo e(route('categories.show', $grandChildCategory)); ?>"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $parentCategory->topBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mm-brand" data-name="<?php echo e($brand->name); ?>" data-image="<?php echo e($brand->logo_url); ?>"
                        data-link="<?php echo e($brand->website); ?>"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $parentCategory->ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mm-ad" data-image="<?php echo e($ad->image_url); ?>" data-link="<?php echo e($ad->link_url); ?>"
                        data-position="<?php echo e($ad->position); ?>"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<!-- Navigation & Mega Menu Container -->
<div class="mm-relative mm-navbar-container" style="margin-top: 54px">
    <!-- Navigation Bar -->
    <nav class="mm-border-b mm-border-gray-200 mm-bg-white mm-sticky mm-top-0 mm-z-50"
        style="border-style: solid; background:linear-gradient(90deg, #e3fff7 0%, #d9e7ff 100%)">
        <div class="mm-max-w-7xl mm-mx-auto mm-px-4 mm-md-px-8 mm-relative">
            <div class="mm-flex mm-items-center" style="width:100%">
                <!-- Left Scroll Button -->
                <button id="mm-scroll-left-btn"
                    class="mm-absolute mm-left-0 mm-z-10 mm-h-full mm-px-2 mm-bg-gradient-to-r mm-from-white mm-via-white mm-to-transparent mm-hidden">
                    <i class="ti ti-chevron-left mm-text-gray-600" style="font-size: 24px;"></i>
                </button>

                <!-- Categories Container -->
                <div id="mm-categories-container"
                    class="mm-flex mm-items-center mm-space-x-1 mm-md-space-x-6 mm-overflow-x-auto mm-scrollbar-hide mm-py-3 mm-scroll-smooth">
                    <!-- Categories will be inserted here by JavaScript -->
                </div>

                <!-- Right Scroll Button -->
                <button id="mm-scroll-right-btn"
                    class="mm-absolute mm-right-0 mm-z-10 mm-h-full mm-px-2 mm-bg-gradient-to-l mm-from-white mm-via-white mm-to-transparent mm-hidden">
                    <i class="ti ti-chevron-right mm-text-gray-600" style="font-size: 24px;"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mega Menu -->
    <div id="mm-mega-menu"
        class="mm-absolute mm-left-0 mm-right-0 mm-bg-white mm-shadow-lg mm-z-40 mm-border-t mm-border-gray-200 mm-mega-menu mm-hidden">
        <!-- Mega menu content will be inserted here by JavaScript -->
    </div>
</div>

<script>
    // Navbar and Mega Menu JavaScript
    class NavbarMegaMenu {
        constructor() {
            this.activeCategory = null;
            this.hoverTimeout = null;
            this.categoriesContainer = document.getElementById(
                "mm-categories-container"
            );
            this.megaMenu = document.getElementById("mm-mega-menu");
            this.scrollLeftBtn = document.getElementById("mm-scroll-left-btn");
            this.scrollRightBtn = document.getElementById("mm-scroll-right-btn");
            this.navbarContainer = document.querySelector(".mm-navbar-container");
            this.menuData = this.loadMenuData();

            // Make instance globally available for slider controls
            window.megaMenuInstance = this;

            this.init();
        }

        // Load menu data from HTML
        loadMenuData() {
            const menuDataContainer = document.getElementById("mm-menu-data");
            const categories = [];

            const categoryElements =
                menuDataContainer.querySelectorAll(".mm-category");

            categoryElements.forEach((categoryEl) => {
                const category = {
                    id: categoryEl.dataset.id,
                    name: categoryEl.dataset.name,
                    link: categoryEl.dataset.link,
                    fallbackLogo: categoryEl.dataset.fallbackLogo,
                    groups: [],
                    brands: [],
                    ads: [],
                };

                // Load groups
                const groupElements = categoryEl.querySelectorAll(".mm-group");
                groupElements.forEach((groupEl) => {
                    const group = {
                        title: groupEl.dataset.title,
                        items: [],
                    };

                    const itemElements = groupEl.querySelectorAll(".mm-item");
                    itemElements.forEach((itemEl) => {
                        group.items.push({
                            name: itemEl.dataset.name,
                            link: itemEl.dataset.link,
                        });
                    });

                    category.groups.push(group);
                });

                // Load brands
                const brandElements = categoryEl.querySelectorAll(".mm-brand");
                brandElements.forEach((brandEl) => {
                    category.brands.push({
                        name: brandEl.dataset.name,
                        image: brandEl.dataset.image,
                        link: brandEl.dataset.link,
                    });
                });

                // Load ads
                const adElements = categoryEl.querySelectorAll(".mm-ad");
                adElements.forEach((adEl) => {
                    category.ads.push({
                        image: adEl.dataset.image,
                        link: adEl.dataset.link,
                        position: parseInt(adEl.dataset.position),
                    });
                });

                categories.push(category);
            });

            return categories;
        }

        init() {
            this.renderCategories();
            this.setupEventListeners();
            this.checkScroll();
            this.initializeLucideIcons();
        }

        // Initialize Lucide icons
        initializeLucideIcons() {
            if (typeof lucide !== "undefined") {
                lucide.createIcons();
            }
        }

        // Render navigation categories
        renderCategories() {
            const categoriesHTML = this.menuData
                .map(
                    (category) => `
                  <div class="mm-nav-category" data-category-id="${category.id}">
                      ${category.name}
                  </div>
              `
                )
                .join("");

            // Add the TRY FREE button
            const tryFreeButton = `
                  <div class="mm-try-free-btn">
                      TRY FREE
                  </div>
              `;

            this.categoriesContainer.innerHTML = categoriesHTML + tryFreeButton;
        }

        // Setup all event listeners
        setupEventListeners() {
            // Category hover events
            const categoryElements =
                this.categoriesContainer.querySelectorAll(".mm-nav-category");
            categoryElements.forEach((categoryElement) => {
                categoryElement.addEventListener("mouseenter", (e) => {
                    const categoryId = e.target.getAttribute("data-category-id");
                    this.handleCategoryMouseEnter(categoryId);
                });
            });

            // Navbar container mouse leave
            this.navbarContainer.addEventListener("mouseleave", () => {
                this.handleMouseLeave();
            });

            // Mega menu mouse enter to keep it open
            this.megaMenu.addEventListener("mouseenter", () => {
                // Keep the current active category when hovering over mega menu
            });

            // Scroll buttons
            this.scrollLeftBtn.addEventListener("click", () => {
                this.scroll("left");
            });

            this.scrollRightBtn.addEventListener("click", () => {
                this.scroll("right");
            });

            // Check scroll on categories container scroll
            this.categoriesContainer.addEventListener("scroll", () => {
                this.checkScroll();
            });

            // Check scroll on window resize
            window.addEventListener("resize", () => {
                this.checkScroll();
            });
        }

        // Handle category mouse enter
        handleCategoryMouseEnter(categoryId) {
            // Clear any existing timeout
            if (this.hoverTimeout) {
                clearTimeout(this.hoverTimeout);
            }

            // Set timeout for 500ms delay
            this.hoverTimeout = setTimeout(() => {
                this.setActiveCategory(categoryId);
                const category = this.menuData.find((cat) => cat.id === categoryId);
                if (category) {
                    this.showMegaMenu(category);
                }
            }, 150);
        }

        // Handle mouse leave from navbar container
        handleMouseLeave() {
            // Clear any pending timeout
            if (this.hoverTimeout) {
                clearTimeout(this.hoverTimeout);
                this.hoverTimeout = null;
            }

            this.setActiveCategory(null);
            this.hideMegaMenu();
        }

        // Set active category and update visual state
        setActiveCategory(categoryId) {
            this.activeCategory = categoryId;

            // Update visual state of category items
            const categoryElements =
                this.categoriesContainer.querySelectorAll(".mm-nav-category");
            categoryElements.forEach((element) => {
                const elementCategoryId = element.getAttribute("data-category-id");
                if (elementCategoryId === categoryId) {
                    element.classList.add("mm-active");
                } else {
                    element.classList.remove("mm-active");
                }
            });
        }

        // Show mega menu with category data
        showMegaMenu(category) {
            this.megaMenu.innerHTML = this.generateMegaMenuHTML(category);
            this.megaMenu.classList.remove("mm-hidden");
            this.megaMenu.classList.add("mm-show");

            // Re-initialize Lucide icons for any new content
            this.initializeLucideIcons();

            // Initialize sliders for ads
            this.initializeSliders();
        }

        // Hide mega menu
        hideMegaMenu() {
            // Clear any auto-slide intervals
            const sliders = this.megaMenu.querySelectorAll('.mm-slider');
            sliders.forEach(slider => {
                if (slider.autoSlideInterval) {
                    clearInterval(slider.autoSlideInterval);
                    slider.autoSlideInterval = null;
                }
            });

            this.megaMenu.classList.add("mm-hidden");
            this.megaMenu.classList.remove("mm-show");
        }

        // Generate mega menu HTML
        generateMegaMenuHTML(category) {
            const groupsHTML = category.groups
                .map(
                    (group) => `
                  <div>
                      <h3 class="mm-text-sm mm-font-semibold mm-text-gray-900 mm-mb-4 mm-uppercase mm-tracking-wider">
                          ${group.title}
                      </h3>
                      <ul class="mm-space-y-3">
                          ${group.items
                            .map(
                              (item) => `
                                 <li>
                                     <a href="${item.link}" class="mm-category-link mm-text-sm">
                                         ${item.name}
                                     </a>
                                 </li>
                             `
                            )
                            .join("")}
                      </ul>
                  </div>
              `
                )
                .join("");

            let brandsHTML = "";
            if (category.brands && category.brands.length > 0) {
                brandsHTML = category.brands
                    .map(
                        (brand, index) => `
                  <a href="${brand.link}" class="mm-brand-item" target="_blank">
                      <div class="mm-brand-container">
                          <div class="mm-image-container">
                              <div class="mm-image-placeholder mm-skeleton" id="mm-brand-placeholder-${category.id}-${index}">
                                  <img src="${category.fallbackLogo}" alt="Loading..." style="height: 2rem; opacity: 0.3;" />
                              </div>
                              <img src="${brand.image}" 
                                   alt="${brand.name}" 
                                   class="mm-brand-image mm-loading" 
                                   data-fallback="${category.fallbackLogo}"
                                   data-placeholder-id="mm-brand-placeholder-${category.id}-${index}"
                                   onload="this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');"
                                   onerror="this.src=this.dataset.fallback; this.classList.add('mm-image-error'); this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');" />
                          </div>
                      </div>
                      <span class="mm-brand-name">${brand.name}</span>
                  </a>
              `
                    )
                    .join("");
            } else {
                let placeholders = '';
                for (let i = 0; i < 8; i++) { // Generate 8 placeholders
                    placeholders += `
                        <div class="mm-brand-item">
                            <div class="mm-no-brand-container">
                                <span>No Brand</span>
                            </div>
                        </div>
                    `;
                }
                brandsHTML = placeholders;
            }

            // Generate ads HTML - either single image or slider for multiple ads
            let adsHTML = "";
            if (category.ads && category.ads.length > 0) {
                if (category.ads.length === 1) {
                    // Single ad
                    const ad = category.ads[0];
                    const adId = `mm-ad-${category.id}-0`;
                    adsHTML = `
                        <div class="mm-promo-container mm-image-container">
                            <div class="mm-image-placeholder mm-skeleton" id="${adId}-placeholder">
                                <img src="${category.fallbackLogo}" alt="Loading..." style="height: 60px; opacity: 0.3;" />
                            </div>
                            <a href="${ad.link}">
                                <img src="${ad.image}" 
                                     alt="${category.name}" 
                                     class="mm-promo-image mm-loading"
                                     data-fallback="${category.fallbackLogo}"
                                     data-placeholder-id="${adId}-placeholder"
                                     onload="this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');"
                                     onerror="this.src=this.dataset.fallback; this.classList.add('mm-image-error'); this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');" />
                            </a>
                            <div class="mm-promo-overlay">
                                <h2 class="mm-promo-title">${category.name}</h2>
                            </div>
                        </div>
                    `;
                } else {
                    // Multiple ads - create slider
                    const sliderId = `mm-ads-slider-${category.id}`;
                    const adsSlides = category.ads
                        .map(
                            (ad, index) => {
                                const adId = `mm-ad-${category.id}-${index}`;
                                return `
                        <div class="mm-slide ${index === 0 ? 'mm-slide-active' : ''}" data-slide="${index}" data-ad-link="${ad.link}">
                            <div class="mm-image-container">
                                <div class="mm-image-placeholder mm-skeleton" id="${adId}-placeholder">
                                    <img src="${category.fallbackLogo}" alt="Loading..." style="height: 60px; opacity: 0.3;" />
                                </div>
                                <a href="${ad.link}" class="mm-slide-link">
                                    <img src="${ad.image}" 
                                         alt="${category.name}" 
                                         class="mm-promo-image mm-loading"
                                         data-fallback="${category.fallbackLogo}"
                                         data-placeholder-id="${adId}-placeholder"
                                         onload="this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');"
                                         onerror="this.src=this.dataset.fallback; this.classList.add('mm-image-error'); this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');" />
                                </a>
                            </div>
                            <div class="mm-promo-overlay">
                                <h2 class="mm-promo-title">${category.name}</h2>
                            </div>
                        </div>
                    `;
                            }
                        )
                        .join("");

                    const dotsHTML = category.ads
                        .map(
                            (_, index) => `
                        <button class="mm-dot ${index === 0 ? 'mm-dot-active' : ''}" 
                                onclick="window.megaMenuInstance && window.megaMenuInstance.goToSlide('${sliderId}', ${index})">
                        </button>
                    `
                        )
                        .join("");

                    adsHTML = `
                        <div class="mm-promo-container mm-slider" id="${sliderId}" data-current-slide="0">
                            <div class="mm-slides-container">
                                ${adsSlides}
                            </div>
                            <div class="mm-slider-controls">
                                <div class="mm-dots">
                                    ${dotsHTML}
                                </div>
                            </div>
                        </div>
                    `;
                }
            } else {
                // Fallback to default logo
                adsHTML = `
                    <div class="mm-promo-container mm-image-container">
                        <div class="mm-image-placeholder mm-skeleton" id="mm-fallback-${category.id}-placeholder">
                            <img src="${category.fallbackLogo}" alt="Loading..." style="height: 60px; opacity: 0.3;" />
                        </div>
                        <img src="${category.fallbackLogo}" 
                             alt="${category.name}" 
                             class="mm-promo-image mm-loading mm-image-error"
                             data-placeholder-id="mm-fallback-${category.id}-placeholder"
                             onload="this.classList.remove('mm-loading'); document.getElementById(this.dataset.placeholderId).classList.add('mm-hidden');" />
                        <div class="mm-promo-overlay">
                            <h2 class="mm-promo-title">${category.name}</h2>
                        </div>
                    </div>
                `;
            }

            return `
                  <div class="mm-max-w-7xl mm-mx-auto mm-px-4 mm-md-px-8 mm-py-8">
                      <div class="mm-grid mm-grid-cols-1 mm-md-grid-cols-12 mm-gap-8">
                          <div class="mm-md-col-span-9">
                              <div class="mm-grid mm-grid-cols-1 mm-sm-grid-cols-2 mm-md-grid-cols-3 mm-lg-grid-cols-4 mm-gap-8">
                                  ${groupsHTML}
                              </div>
                              
                              <div class="mm-mt-8 mm-pt-6 mm-border-t mm-border-gray-100">
                                  <h3 class="mm-text-sm mm-font-semibold mm-text-gray-900 mm-mb-4 mm-uppercase mm-tracking-wider">
                                      Top Brands
                                  </h3>
                                  <div class="mm-brands-grid">
                                      ${brandsHTML}
                                  </div>
                              </div>
                          </div>
                          
                          <div class="mm-md-col-span-3">
                              ${adsHTML}
                          </div>
                      </div>
                  </div>
              `;
        }

        // Initialize sliders for ads
        initializeSliders() {
            const sliders = this.megaMenu.querySelectorAll('.mm-slider');

            sliders.forEach(slider => {
                const slides = slider.querySelectorAll('.mm-slide');
                if (slides.length <= 1) return; // No need for auto-slide if only one slide

                // Create closure to maintain currentSlide state
                let currentSlide = parseInt(slider.getAttribute('data-current-slide')) || 0;
                const totalSlides = slides.length;

                // Auto-slide every 4 seconds
                const autoSlide = setInterval(() => {
                    // Remove active classes
                    const activeSlide = slider.querySelector('.mm-slide-active');
                    const activeDot = slider.querySelector('.mm-dot-active');

                    if (activeSlide) activeSlide.classList.remove('mm-slide-active');
                    if (activeDot) activeDot.classList.remove('mm-dot-active');

                    // Move to next slide
                    currentSlide = (currentSlide + 1) % totalSlides;

                    // Add active classes
                    const nextSlide = slides[currentSlide];
                    const nextDot = slider.querySelectorAll('.mm-dot')[currentSlide];

                    if (nextSlide) nextSlide.classList.add('mm-slide-active');
                    if (nextDot) nextDot.classList.add('mm-dot-active');

                    // Update slider data attribute
                    slider.setAttribute('data-current-slide', currentSlide);
                }, 4000);

                // Store interval reference to clear it when menu is hidden
                slider.autoSlideInterval = autoSlide;
            });
        }

        // Go to specific slide in slider
        goToSlide(sliderId, slideIndex) {
            const slider = document.getElementById(sliderId);
            if (!slider) return;

            const slides = slider.querySelectorAll('.mm-slide');
            const dots = slider.querySelectorAll('.mm-dot');

            if (slides.length === 0 || slideIndex >= slides.length) return;

            // Remove active classes from current slide and dot
            const currentSlide = slider.querySelector('.mm-slide-active');
            const currentDot = slider.querySelector('.mm-dot-active');

            if (currentSlide) currentSlide.classList.remove('mm-slide-active');
            if (currentDot) currentDot.classList.remove('mm-dot-active');

            // Add active classes to target slide and dot
            slides[slideIndex].classList.add('mm-slide-active');
            dots[slideIndex].classList.add('mm-dot-active');

            // Update slider data attribute
            slider.setAttribute('data-current-slide', slideIndex);

            // Clear and restart auto-slide interval if it exists
            if (slider.autoSlideInterval) {
                clearInterval(slider.autoSlideInterval);

                // Restart auto-slide from current position
                let currentSlide = slideIndex;
                const totalSlides = slides.length;

                slider.autoSlideInterval = setInterval(() => {
                    // Remove active classes
                    slides[currentSlide].classList.remove('mm-slide-active');
                    const currentDot = slider.querySelector('.mm-dot-active');
                    if (currentDot) currentDot.classList.remove('mm-dot-active');

                    // Move to next slide
                    currentSlide = (currentSlide + 1) % totalSlides;

                    // Add active classes
                    slides[currentSlide].classList.add('mm-slide-active');
                    const nextDot = slider.querySelectorAll('.mm-dot')[currentSlide];
                    if (nextDot) nextDot.classList.add('mm-dot-active');

                    // Update slider data attribute
                    slider.setAttribute('data-current-slide', currentSlide);
                }, 4000);
            }
        }

        // Check if scrolling is needed and show/hide scroll buttons
        checkScroll() {
            const container = this.categoriesContainer;
            const isScrollable = container.scrollWidth > container.clientWidth;

            if (isScrollable) {
                const atStart = container.scrollLeft <= 0;
                const atEnd =
                    container.scrollLeft >=
                    container.scrollWidth - container.clientWidth;

                this.toggleScrollButton(this.scrollLeftBtn, !atStart);
                this.toggleScrollButton(this.scrollRightBtn, !atEnd);
            } else {
                this.toggleScrollButton(this.scrollLeftBtn, false);
                this.toggleScrollButton(this.scrollRightBtn, false);
            }
        }

        // Toggle scroll button visibility
        toggleScrollButton(button, show) {
            if (show) {
                button.classList.remove("mm-hidden");
                button.classList.add("mm-show");
            } else {
                button.classList.add("mm-hidden");
                button.classList.remove("mm-show");
            }
        }

        // Scroll the categories container
        scroll(direction) {
            const container = this.categoriesContainer;
            const scrollAmount = 200;

            if (direction === "left") {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: "smooth",
                });
            } else {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: "smooth",
                });
            }
        }
    }

    // Handle click events for links (you can customize this)
    function handleLinkClick(url) {
        // console.log("Navigate to:", url);
        // You can implement your navigation logic here
        // For example: window.location.href = url;
        window.location.href = url;
    }

    // Initialize the navbar when DOM is loaded
    document.addEventListener("DOMContentLoaded", () => {
        new NavbarMegaMenu();
    });

    // Global click handler for category links and brand links
    document.addEventListener("click", (e) => {
        if (
            e.target.closest(".mm-category-link") ||
            e.target.closest(".mm-brand-item")
        ) {
            e.preventDefault();
            const link = e.target.closest("a");
            if (link) {
                handleLinkClick(link.href);
            }
        }
    });

    // Additional utility functions can be added here
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
</script>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/mega_menu.blade.php ENDPATH**/ ?>