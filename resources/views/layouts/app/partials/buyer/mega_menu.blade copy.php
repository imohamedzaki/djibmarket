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
        height: 100%;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
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

    .mm-brand-image {
        width: 100%;
        height: 2rem;
        object-fit: contain;
        margin-bottom: 0.5rem;
    }

    .mm-brand-name {
        font-size: 0.75rem;
        color: #6b7280;
        /* text-gray-500 */
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
    <!-- Home & Kitchen Category -->
    <div class="mm-category" data-id="home-kitchen" data-name="Home & Kitchen" data-link="/home-kitchen"
        data-promo-image="https://images.pexels.com/photos/1080721/pexels-photo-1080721.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="HOME ESSENTIALS">
        <div class="mm-group" data-title="Kitchen Appliances">
            <div class="mm-item" data-name="Blenders" data-link="/home-kitchen/blenders"></div>
            <div class="mm-item" data-name="Coffee Makers" data-link="/home-kitchen/coffee-makers"></div>
            <div class="mm-item" data-name="Mixers" data-link="/home-kitchen/mixers"></div>
            <div class="mm-item" data-name="Toasters" data-link="/home-kitchen/toasters"></div>
            <div class="mm-item" data-name="Air Fryers" data-link="/home-kitchen/air-fryers"></div>
            <div class="mm-item" data-name="Microwaves" data-link="/home-kitchen/microwaves"></div>
        </div>

        <div class="mm-group" data-title="Home Decor">
            <div class="mm-item" data-name="Wall Art" data-link="/home-kitchen/wall-art"></div>
            <div class="mm-item" data-name="Candles" data-link="/home-kitchen/candles"></div>
            <div class="mm-item" data-name="Vases" data-link="/home-kitchen/vases"></div>
            <div class="mm-item" data-name="Photo Frames" data-link="/home-kitchen/photo-frames"></div>
            <div class="mm-item" data-name="Mirrors" data-link="/home-kitchen/mirrors"></div>
            <div class="mm-item" data-name="Cushions" data-link="/home-kitchen/cushions"></div>
        </div>

        <div class="mm-group" data-title="Bedroom">
            <div class="mm-item" data-name="Bedding Sets" data-link="/home-kitchen/bedding-sets"></div>
            <div class="mm-item" data-name="Pillows" data-link="/home-kitchen/pillows"></div>
            <div class="mm-item" data-name="Blankets" data-link="/home-kitchen/blankets"></div>
            <div class="mm-item" data-name="Mattresses" data-link="/home-kitchen/mattresses"></div>
            <div class="mm-item" data-name="Bed Frames" data-link="/home-kitchen/bed-frames"></div>
            <div class="mm-item" data-name="Storage" data-link="/home-kitchen/bedroom-storage"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="KitchenAid" data-image="https://via.placeholder.com/80x40?text=KitchenAid"
                data-link="/brands/kitchenaid"></div>
            <div class="mm-brand" data-name="Dyson" data-image="https://via.placeholder.com/80x40?text=Dyson"
                data-link="/brands/dyson"></div>
            <div class="mm-brand" data-name="Ikea" data-image="https://via.placeholder.com/80x40?text=Ikea"
                data-link="/brands/ikea"></div>
            <div class="mm-brand" data-name="Bosch" data-image="https://via.placeholder.com/80x40?text=Bosch"
                data-link="/brands/bosch"></div>
            <div class="mm-brand" data-name="Philips" data-image="https://via.placeholder.com/80x40?text=Philips"
                data-link="/brands/philips"></div>
        </div>
    </div>

    <!-- Beauty & Fragrance Category -->
    <div class="mm-category" data-id="beauty-fragrance" data-name="Beauty & Fragrance" data-link="/beauty-fragrance"
        data-promo-image="https://images.pexels.com/photos/3373739/pexels-photo-3373739.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="THE BEAUTY EDIT">
        <div class="mm-group" data-title="Makeup">
            <div class="mm-item" data-name="Mascaras" data-link="/beauty-fragrance/mascaras"></div>
            <div class="mm-item" data-name="Foundations" data-link="/beauty-fragrance/foundations"></div>
            <div class="mm-item" data-name="Blushers & bronzers" data-link="/beauty-fragrance/blushers-bronzers">
            </div>
            <div class="mm-item" data-name="Eye palettes" data-link="/beauty-fragrance/eye-palettes"></div>
            <div class="mm-item" data-name="Lip glosses" data-link="/beauty-fragrance/lip-glosses"></div>
            <div class="mm-item" data-name="Makeup brushes" data-link="/beauty-fragrance/makeup-brushes"></div>
            <div class="mm-item" data-name="Makeup bags" data-link="/beauty-fragrance/makeup-bags"></div>
        </div>

        <div class="mm-group" data-title="Skincare">
            <div class="mm-item" data-name="Moisturizers" data-link="/beauty-fragrance/moisturizers"></div>
            <div class="mm-item" data-name="Suncare" data-link="/beauty-fragrance/suncare"></div>
            <div class="mm-item" data-name="Cleansers" data-link="/beauty-fragrance/cleansers"></div>
            <div class="mm-item" data-name="Bath & body" data-link="/beauty-fragrance/bath-body-skincare"></div>
            <div class="mm-item" data-name="Treatments & serums" data-link="/beauty-fragrance/treatments-serums">
            </div>
            <div class="mm-item" data-name="Toners" data-link="/beauty-fragrance/toners"></div>
            <div class="mm-item" data-name="Giftsets" data-link="/beauty-fragrance/giftsets"></div>
        </div>

        <div class="mm-group" data-title="Haircare">
            <div class="mm-item" data-name="Shampoos" data-link="/beauty-fragrance/shampoos"></div>
            <div class="mm-item" data-name="Conditioners" data-link="/beauty-fragrance/conditioners"></div>
            <div class="mm-item" data-name="Hair masks" data-link="/beauty-fragrance/hair-masks"></div>
            <div class="mm-item" data-name="Hair oils & serums" data-link="/beauty-fragrance/hair-oils-serums">
            </div>
            <div class="mm-item" data-name="Hair color" data-link="/beauty-fragrance/hair-color"></div>
            <div class="mm-item" data-name="Hair loss products" data-link="/beauty-fragrance/hair-loss-products">
            </div>
            <div class="mm-item" data-name="Professional range" data-link="/beauty-fragrance/professional-range">
            </div>
        </div>

        <div class="mm-group" data-title="Fragrance">
            <div class="mm-item" data-name="Women's perfumes" data-link="/beauty-fragrance/womens-perfumes"></div>
            <div class="mm-item" data-name="Men's perfumes" data-link="/beauty-fragrance/mens-perfumes"></div>
            <div class="mm-item" data-name="Arabic perfumes" data-link="/beauty-fragrance/arabic-perfumes"></div>
            <div class="mm-item" data-name="Gift sets" data-link="/beauty-fragrance/fragrance-gift-sets"></div>
            <div class="mm-item" data-name="Luxe fragrances" data-link="/beauty-fragrance/luxe-fragrances"></div>
            <div class="mm-item" data-name="Body mists" data-link="/beauty-fragrance/body-mists"></div>
            <div class="mm-item" data-name="Bestsellers" data-link="/beauty-fragrance/fragrance-bestsellers">
            </div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="L'Oreal" data-image="https://via.placeholder.com/80x40?text=LOreal"
                data-link="/brands/loreal"></div>
            <div class="mm-brand" data-name="NYX" data-image="https://via.placeholder.com/80x40?text=NYX"
                data-link="/brands/nyx"></div>
            <div class="mm-brand" data-name="Roberto Cavalli"
                data-image="https://via.placeholder.com/80x40?text=Cavalli" data-link="/brands/roberto-cavalli">
            </div>
            <div class="mm-brand" data-name="Bourjois Paris"
                data-image="https://via.placeholder.com/80x40?text=Bourjois" data-link="/brands/bourjois"></div>
            <div class="mm-brand" data-name="Vichy" data-image="https://via.placeholder.com/80x40?text=Vichy"
                data-link="/brands/vichy"></div>
            <div class="mm-brand" data-name="Versace" data-image="https://via.placeholder.com/80x40?text=Versace"
                data-link="/brands/versace"></div>
            <div class="mm-brand" data-name="Philips" data-image="https://via.placeholder.com/80x40?text=Philips"
                data-link="/brands/philips"></div>
            <div class="mm-brand" data-name="Olaplex" data-image="https://via.placeholder.com/80x40?text=Olaplex"
                data-link="/brands/olaplex"></div>
        </div>
    </div>

    <!-- Baby Category -->
    <div class="mm-category" data-id="baby" data-name="Baby" data-link="/baby"
        data-promo-image="https://images.pexels.com/photos/235127/pexels-photo-235127.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="EVERYTHING YOUR KID NEEDS">
        <div class="mm-group" data-title="Baby essentials">
            <div class="mm-item" data-name="Bestsellers" data-link="/baby/bestsellers"></div>
            <div class="mm-item" data-name="Gifting store" data-link="/baby/gifting-store"></div>
            <div class="mm-item" data-name="Premium store" data-link="/baby/premium-store"></div>
            <div class="mm-item" data-name="Clearance" data-link="/baby/clearance"></div>
            <div class="mm-item" data-name="New arrivals" data-link="/baby/new-arrivals"></div>
            <div class="mm-item" data-name="Car seat buying guide" data-link="/baby/car-seat-buying-guide"></div>
            <div class="mm-item" data-name="Stroller buying guide" data-link="/baby/stroller-buying-guide"></div>
            <div class="mm-item" data-name="Hospital bag checklist" data-link="/baby/hospital-bag-checklist">
            </div>
        </div>

        <div class="mm-group" data-title="Feeding essentials">
            <div class="mm-item" data-name="Breast pumps" data-link="/baby/breast-pumps"></div>
            <div class="mm-item" data-name="Feeding bottles" data-link="/baby/feeding-bottles"></div>
            <div class="mm-item" data-name="Pacifiers & teethers" data-link="/baby/pacifiers-teethers"></div>
            <div class="mm-item" data-name="Food makers" data-link="/baby/food-makers"></div>
            <div class="mm-item" data-name="Highchairs & boosters" data-link="/baby/highchairs-boosters"></div>
            <div class="mm-item" data-name="Lunch boxes & bags" data-link="/baby/lunch-boxes-bags"></div>
            <div class="mm-item" data-name="Sterilizers & warmers" data-link="/baby/sterilizers-warmers"></div>
            <div class="mm-item" data-name="Bibs & burp cloths" data-link="/baby/bibs-burp-cloths"></div>
        </div>

        <div class="mm-group" data-title="Baby Care">
            <div class="mm-item" data-name="Diapers" data-link="/baby/diapers"></div>
            <div class="mm-item" data-name="Wipes" data-link="/baby/wipes"></div>
            <div class="mm-item" data-name="Bathing & skin care" data-link="/baby/bathing-skin-care"></div>
            <div class="mm-item" data-name="Baby food" data-link="/baby/baby-food"></div>
            <div class="mm-item" data-name="Grooming & health care" data-link="/baby/grooming-health-care"></div>
            <div class="mm-item" data-name="Potty training" data-link="/baby/potty-training"></div>
            <div class="mm-item" data-name="Bath tubs & seats" data-link="/baby/bath-tubs-seats"></div>
        </div>

        <div class="mm-group" data-title="Baby travel gear">
            <div class="mm-item" data-name="Strollers" data-link="/baby/strollers"></div>
            <div class="mm-item" data-name="Car seats" data-link="/baby/car-seats"></div>
            <div class="mm-item" data-name="Travel systems" data-link="/baby/travel-systems"></div>
            <div class="mm-item" data-name="Carrier and slings" data-link="/baby/carrier-and-slings"></div>
            <div class="mm-item" data-name="Twin strollers" data-link="/baby/twin-strollers"></div>
            <div class="mm-item" data-name="Diaper bags & organizers" data-link="/baby/diaper-bags-organizers">
            </div>
            <div class="mm-item" data-name="Stroller accessories" data-link="/baby/stroller-accessories"></div>
            <div class="mm-item" data-name="Car seat accessories" data-link="/baby/car-seat-accessories"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Pampers" data-image="https://via.placeholder.com/80x40?text=Pampers"
                data-link="/brands/pampers"></div>
            <div class="mm-brand" data-name="Moon" data-image="https://via.placeholder.com/80x40?text=Moon"
                data-link="/brands/moon"></div>
            <div class="mm-brand" data-name="Nurtur" data-image="https://via.placeholder.com/80x40?text=Nurtur"
                data-link="/brands/nurtur"></div>
            <div class="mm-brand" data-name="Momcozy" data-image="https://via.placeholder.com/80x40?text=Momcozy"
                data-link="/brands/momcozy"></div>
            <div class="mm-brand" data-name="Philips Avent"
                data-image="https://via.placeholder.com/80x40?text=Philips" data-link="/brands/philips-avent">
            </div>
            <div class="mm-brand" data-name="Tommee Tippee"
                data-image="https://via.placeholder.com/80x40?text=Tommee" data-link="/brands/tommee-tippee"></div>
            <div class="mm-brand" data-name="Sebamed" data-image="https://via.placeholder.com/80x40?text=Sebamed"
                data-link="/brands/sebamed"></div>
            <div class="mm-brand" data-name="DrBrowns" data-image="https://via.placeholder.com/80x40?text=DrBrowns"
                data-link="/brands/drbrowns"></div>
        </div>
    </div>

    <!-- Toys Category -->
    <div class="mm-category" data-id="toys" data-name="Toys" data-link="/toys"
        data-promo-image="https://images.pexels.com/photos/163772/boys-children-dolls-kids-163772.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="TOYS & GAMES">
        <div class="mm-group" data-title="By Age">
            <div class="mm-item" data-name="0-12 Months" data-link="/toys/0-12-months"></div>
            <div class="mm-item" data-name="1-3 Years" data-link="/toys/1-3-years"></div>
            <div class="mm-item" data-name="3-5 Years" data-link="/toys/3-5-years"></div>
            <div class="mm-item" data-name="5-8 Years" data-link="/toys/5-8-years"></div>
            <div class="mm-item" data-name="8-12 Years" data-link="/toys/8-12-years"></div>
            <div class="mm-item" data-name="12+ Years" data-link="/toys/12-plus-years"></div>
        </div>

        <div class="mm-group" data-title="Toy Categories">
            <div class="mm-item" data-name="Action Figures" data-link="/toys/action-figures"></div>
            <div class="mm-item" data-name="Dolls & Accessories" data-link="/toys/dolls-accessories"></div>
            <div class="mm-item" data-name="Building Blocks" data-link="/toys/building-blocks"></div>
            <div class="mm-item" data-name="Arts & Crafts" data-link="/toys/arts-crafts"></div>
            <div class="mm-item" data-name="Educational Toys" data-link="/toys/educational"></div>
            <div class="mm-item" data-name="Remote Control" data-link="/toys/remote-control"></div>
            <div class="mm-item" data-name="Board Games" data-link="/toys/board-games"></div>
            <div class="mm-item" data-name="Outdoor Toys" data-link="/toys/outdoor"></div>
        </div>

        <div class="mm-group" data-title="Popular Brands">
            <div class="mm-item" data-name="LEGO" data-link="/toys/lego"></div>
            <div class="mm-item" data-name="Barbie" data-link="/toys/barbie"></div>
            <div class="mm-item" data-name="Hot Wheels" data-link="/toys/hot-wheels"></div>
            <div class="mm-item" data-name="Fisher-Price" data-link="/toys/fisher-price"></div>
            <div class="mm-item" data-name="Playmobil" data-link="/toys/playmobil"></div>
            <div class="mm-item" data-name="Disney" data-link="/toys/disney"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="LEGO" data-image="https://via.placeholder.com/80x40?text=LEGO"
                data-link="/brands/lego"></div>
            <div class="mm-brand" data-name="Mattel" data-image="https://via.placeholder.com/80x40?text=Mattel"
                data-link="/brands/mattel"></div>
            <div class="mm-brand" data-name="Hasbro" data-image="https://via.placeholder.com/80x40?text=Hasbro"
                data-link="/brands/hasbro"></div>
            <div class="mm-brand" data-name="Fisher-Price"
                data-image="https://via.placeholder.com/80x40?text=FisherPrice" data-link="/brands/fisher-price">
            </div>
            <div class="mm-brand" data-name="Playmobil" data-image="https://via.placeholder.com/80x40?text=Playmobil"
                data-link="/brands/playmobil"></div>
        </div>
    </div>

    <!-- Sports & Outdoors Category -->
    <div class="mm-category" data-id="sports" data-name="Sports & Outdoors" data-link="/sports"
        data-promo-image="https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="ACTIVE LIFESTYLE">
        <div class="mm-group" data-title="Fitness Equipment">
            <div class="mm-item" data-name="Treadmills" data-link="/sports/treadmills"></div>
            <div class="mm-item" data-name="Exercise Bikes" data-link="/sports/exercise-bikes"></div>
            <div class="mm-item" data-name="Dumbbells" data-link="/sports/dumbbells"></div>
            <div class="mm-item" data-name="Yoga Mats" data-link="/sports/yoga-mats"></div>
            <div class="mm-item" data-name="Resistance Bands" data-link="/sports/resistance-bands"></div>
            <div class="mm-item" data-name="Home Gyms" data-link="/sports/home-gyms"></div>
        </div>

        <div class="mm-group" data-title="Outdoor Activities">
            <div class="mm-item" data-name="Camping Gear" data-link="/sports/camping-gear"></div>
            <div class="mm-item" data-name="Hiking Equipment" data-link="/sports/hiking-equipment"></div>
            <div class="mm-item" data-name="Cycling" data-link="/sports/cycling"></div>
            <div class="mm-item" data-name="Swimming" data-link="/sports/swimming"></div>
            <div class="mm-item" data-name="Running" data-link="/sports/running"></div>
            <div class="mm-item" data-name="Sports Apparel" data-link="/sports/sports-apparel"></div>
        </div>

        <div class="mm-group" data-title="Team Sports">
            <div class="mm-item" data-name="Football" data-link="/sports/football"></div>
            <div class="mm-item" data-name="Basketball" data-link="/sports/basketball"></div>
            <div class="mm-item" data-name="Soccer" data-link="/sports/soccer"></div>
            <div class="mm-item" data-name="Tennis" data-link="/sports/tennis"></div>
            <div class="mm-item" data-name="Baseball" data-link="/sports/baseball"></div>
            <div class="mm-item" data-name="Golf" data-link="/sports/golf"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Nike" data-image="https://via.placeholder.com/80x40?text=Nike"
                data-link="/brands/nike"></div>
            <div class="mm-brand" data-name="Adidas" data-image="https://via.placeholder.com/80x40?text=Adidas"
                data-link="/brands/adidas"></div>
            <div class="mm-brand" data-name="Under Armour"
                data-image="https://via.placeholder.com/80x40?text=UnderArmour" data-link="/brands/under-armour">
            </div>
            <div class="mm-brand" data-name="Puma" data-image="https://via.placeholder.com/80x40?text=Puma"
                data-link="/brands/puma"></div>
            <div class="mm-brand" data-name="Reebok" data-image="https://via.placeholder.com/80x40?text=Reebok"
                data-link="/brands/reebok"></div>
        </div>
    </div>

    <!-- Electronics Category -->
    <div class="mm-category" data-id="electronics" data-name="Electronics" data-link="/electronics"
        data-promo-image="https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="TECH ESSENTIALS">
        <div class="mm-group" data-title="Mobile & Accessories">
            <div class="mm-item" data-name="Smartphones" data-link="/electronics/smartphones"></div>
            <div class="mm-item" data-name="Phone Cases" data-link="/electronics/phone-cases"></div>
            <div class="mm-item" data-name="Screen Protectors" data-link="/electronics/screen-protectors"></div>
            <div class="mm-item" data-name="Chargers & Cables" data-link="/electronics/chargers-cables"></div>
            <div class="mm-item" data-name="Power Banks" data-link="/electronics/power-banks"></div>
            <div class="mm-item" data-name="Wireless Earbuds" data-link="/electronics/wireless-earbuds"></div>
        </div>

        <div class="mm-group" data-title="Computing">
            <div class="mm-item" data-name="Laptops" data-link="/electronics/laptops"></div>
            <div class="mm-item" data-name="Tablets" data-link="/electronics/tablets"></div>
            <div class="mm-item" data-name="Desktop Computers" data-link="/electronics/desktop-computers"></div>
            <div class="mm-item" data-name="Monitors" data-link="/electronics/monitors"></div>
            <div class="mm-item" data-name="Keyboards & Mice" data-link="/electronics/keyboards-mice"></div>
            <div class="mm-item" data-name="Storage Devices" data-link="/electronics/storage-devices"></div>
        </div>

        <div class="mm-group" data-title="Audio & Video">
            <div class="mm-item" data-name="Headphones" data-link="/electronics/headphones"></div>
            <div class="mm-item" data-name="Speakers" data-link="/electronics/speakers"></div>
            <div class="mm-item" data-name="Smart TVs" data-link="/electronics/smart-tvs"></div>
            <div class="mm-item" data-name="Streaming Devices" data-link="/electronics/streaming-devices"></div>
            <div class="mm-item" data-name="Sound Bars" data-link="/electronics/sound-bars"></div>
            <div class="mm-item" data-name="Home Theater" data-link="/electronics/home-theater"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Samsung" data-image="https://via.placeholder.com/80x40?text=Samsung"
                data-link="/brands/samsung"></div>
            <div class="mm-brand" data-name="Apple" data-image="https://via.placeholder.com/80x40?text=Apple"
                data-link="/brands/apple"></div>
            <div class="mm-brand" data-name="Sony" data-image="https://via.placeholder.com/80x40?text=Sony"
                data-link="/brands/sony"></div>
            <div class="mm-brand" data-name="LG" data-image="https://via.placeholder.com/80x40?text=LG"
                data-link="/brands/lg"></div>
            <div class="mm-brand" data-name="HP" data-image="https://via.placeholder.com/80x40?text=HP"
                data-link="/brands/hp"></div>
        </div>
    </div>

    <!-- Fashion & Clothing Category -->
    <div class="mm-category" data-id="fashion-clothing" data-name="Fashion & Clothing" data-link="/fashion-clothing"
        data-promo-image="https://images.pexels.com/photos/996329/pexels-photo-996329.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="LATEST FASHION TRENDS">
        <div class="mm-group" data-title="Women's Fashion">
            <div class="mm-item" data-name="Dresses" data-link="/fashion-clothing/womens-dresses"></div>
            <div class="mm-item" data-name="Tops & Blouses" data-link="/fashion-clothing/womens-tops"></div>
            <div class="mm-item" data-name="Jeans & Pants" data-link="/fashion-clothing/womens-jeans"></div>
            <div class="mm-item" data-name="Skirts" data-link="/fashion-clothing/womens-skirts"></div>
            <div class="mm-item" data-name="Lingerie" data-link="/fashion-clothing/womens-lingerie"></div>
            <div class="mm-item" data-name="Handbags" data-link="/fashion-clothing/womens-handbags"></div>
        </div>

        <div class="mm-group" data-title="Men's Fashion">
            <div class="mm-item" data-name="Shirts" data-link="/fashion-clothing/mens-shirts"></div>
            <div class="mm-item" data-name="T-Shirts" data-link="/fashion-clothing/mens-tshirts"></div>
            <div class="mm-item" data-name="Jeans & Pants" data-link="/fashion-clothing/mens-jeans"></div>
            <div class="mm-item" data-name="Suits" data-link="/fashion-clothing/mens-suits"></div>
            <div class="mm-item" data-name="Underwear" data-link="/fashion-clothing/mens-underwear"></div>
            <div class="mm-item" data-name="Accessories" data-link="/fashion-clothing/mens-accessories"></div>
        </div>

        <div class="mm-group" data-title="Shoes & Footwear">
            <div class="mm-item" data-name="Sneakers" data-link="/fashion-clothing/sneakers"></div>
            <div class="mm-item" data-name="Boots" data-link="/fashion-clothing/boots"></div>
            <div class="mm-item" data-name="Sandals" data-link="/fashion-clothing/sandals"></div>
            <div class="mm-item" data-name="Formal Shoes" data-link="/fashion-clothing/formal-shoes"></div>
            <div class="mm-item" data-name="Athletic Shoes" data-link="/fashion-clothing/athletic-shoes"></div>
            <div class="mm-item" data-name="Heels" data-link="/fashion-clothing/heels"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Zara" data-image="https://via.placeholder.com/80x40?text=Zara"
                data-link="/brands/zara"></div>
            <div class="mm-brand" data-name="H&M" data-image="https://via.placeholder.com/80x40?text=H&M"
                data-link="/brands/hm"></div>
            <div class="mm-brand" data-name="Gucci" data-image="https://via.placeholder.com/80x40?text=Gucci"
                data-link="/brands/gucci"></div>
            <div class="mm-brand" data-name="Nike" data-image="https://via.placeholder.com/80x40?text=Nike"
                data-link="/brands/nike"></div>
            <div class="mm-brand" data-name="Adidas" data-image="https://via.placeholder.com/80x40?text=Adidas"
                data-link="/brands/adidas"></div>
        </div>
    </div>

    <!-- Automotive Category -->
    <div class="mm-category" data-id="automotive" data-name="Automotive" data-link="/automotive"
        data-promo-image="https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="AUTO ESSENTIALS">
        <div class="mm-group" data-title="Car Accessories">
            <div class="mm-item" data-name="Car Chargers" data-link="/automotive/car-chargers"></div>
            <div class="mm-item" data-name="Phone Mounts" data-link="/automotive/phone-mounts"></div>
            <div class="mm-item" data-name="Seat Covers" data-link="/automotive/seat-covers"></div>
            <div class="mm-item" data-name="Floor Mats" data-link="/automotive/floor-mats"></div>
            <div class="mm-item" data-name="Dashboard Cameras" data-link="/automotive/dashboard-cameras"></div>
            <div class="mm-item" data-name="Air Fresheners" data-link="/automotive/air-fresheners"></div>
        </div>

        <div class="mm-group" data-title="Car Care">
            <div class="mm-item" data-name="Car Wash" data-link="/automotive/car-wash"></div>
            <div class="mm-item" data-name="Car Wax" data-link="/automotive/car-wax"></div>
            <div class="mm-item" data-name="Tire Care" data-link="/automotive/tire-care"></div>
            <div class="mm-item" data-name="Engine Oil" data-link="/automotive/engine-oil"></div>
            <div class="mm-item" data-name="Brake Fluid" data-link="/automotive/brake-fluid"></div>
            <div class="mm-item" data-name="Cleaning Tools" data-link="/automotive/cleaning-tools"></div>
        </div>

        <div class="mm-group" data-title="Car Parts">
            <div class="mm-item" data-name="Brake Pads" data-link="/automotive/brake-pads"></div>
            <div class="mm-item" data-name="Air Filters" data-link="/automotive/air-filters"></div>
            <div class="mm-item" data-name="Spark Plugs" data-link="/automotive/spark-plugs"></div>
            <div class="mm-item" data-name="Batteries" data-link="/automotive/batteries"></div>
            <div class="mm-item" data-name="Headlights" data-link="/automotive/headlights"></div>
            <div class="mm-item" data-name="Wipers" data-link="/automotive/wipers"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Bosch" data-image="https://via.placeholder.com/80x40?text=Bosch"
                data-link="/brands/bosch"></div>
            <div class="mm-brand" data-name="Castrol" data-image="https://via.placeholder.com/80x40?text=Castrol"
                data-link="/brands/castrol"></div>
            <div class="mm-brand" data-name="Michelin" data-image="https://via.placeholder.com/80x40?text=Michelin"
                data-link="/brands/michelin"></div>
            <div class="mm-brand" data-name="Shell" data-image="https://via.placeholder.com/80x40?text=Shell"
                data-link="/brands/shell"></div>
            <div class="mm-brand" data-name="3M" data-image="https://via.placeholder.com/80x40?text=3M"
                data-link="/brands/3m"></div>
        </div>
    </div>

    <!-- Sports & Fitness Category -->
    <div class="mm-category" data-id="sports-fitness" data-name="Sports & Fitness" data-link="/sports-fitness"
        data-promo-image="https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="FITNESS GOALS">
        <div class="mm-group" data-title="Fitness Equipment">
            <div class="mm-item" data-name="Dumbbells" data-link="/sports-fitness/dumbbells"></div>
            <div class="mm-item" data-name="Resistance Bands" data-link="/sports-fitness/resistance-bands"></div>
            <div class="mm-item" data-name="Yoga Mats" data-link="/sports-fitness/yoga-mats"></div>
            <div class="mm-item" data-name="Treadmills" data-link="/sports-fitness/treadmills"></div>
            <div class="mm-item" data-name="Exercise Bikes" data-link="/sports-fitness/exercise-bikes"></div>
            <div class="mm-item" data-name="Kettlebells" data-link="/sports-fitness/kettlebells"></div>
        </div>

        <div class="mm-group" data-title="Sports Gear">
            <div class="mm-item" data-name="Basketball" data-link="/sports-fitness/basketball"></div>
            <div class="mm-item" data-name="Football" data-link="/sports-fitness/football"></div>
            <div class="mm-item" data-name="Tennis" data-link="/sports-fitness/tennis"></div>
            <div class="mm-item" data-name="Swimming" data-link="/sports-fitness/swimming"></div>
            <div class="mm-item" data-name="Cycling" data-link="/sports-fitness/cycling"></div>
            <div class="mm-item" data-name="Running" data-link="/sports-fitness/running"></div>
        </div>

        <div class="mm-group" data-title="Activewear">
            <div class="mm-item" data-name="Athletic Shirts" data-link="/sports-fitness/athletic-shirts"></div>
            <div class="mm-item" data-name="Sports Bras" data-link="/sports-fitness/sports-bras"></div>
            <div class="mm-item" data-name="Leggings" data-link="/sports-fitness/leggings"></div>
            <div class="mm-item" data-name="Shorts" data-link="/sports-fitness/shorts"></div>
            <div class="mm-item" data-name="Hoodies" data-link="/sports-fitness/hoodies"></div>
            <div class="mm-item" data-name="Track Suits" data-link="/sports-fitness/track-suits"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Nike" data-image="https://via.placeholder.com/80x40?text=Nike"
                data-link="/brands/nike"></div>
            <div class="mm-brand" data-name="Adidas" data-image="https://via.placeholder.com/80x40?text=Adidas"
                data-link="/brands/adidas"></div>
            <div class="mm-brand" data-name="Under Armour"
                data-image="https://via.placeholder.com/80x40?text=UnderArmour" data-link="/brands/under-armour">
            </div>
            <div class="mm-brand" data-name="Puma" data-image="https://via.placeholder.com/80x40?text=Puma"
                data-link="/brands/puma"></div>
            <div class="mm-brand" data-name="Reebok" data-image="https://via.placeholder.com/80x40?text=Reebok"
                data-link="/brands/reebok"></div>
        </div>
    </div>

    <!-- Books & Media Category -->
    <div class="mm-category" data-id="books-media" data-name="Books & Media" data-link="/books-media"
        data-promo-image="https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="KNOWLEDGE IS POWER">
        <div class="mm-group" data-title="Books">
            <div class="mm-item" data-name="Fiction" data-link="/books-media/fiction"></div>
            <div class="mm-item" data-name="Non-Fiction" data-link="/books-media/non-fiction"></div>
            <div class="mm-item" data-name="Self-Help" data-link="/books-media/self-help"></div>
            <div class="mm-item" data-name="Business" data-link="/books-media/business"></div>
            <div class="mm-item" data-name="Science" data-link="/books-media/science"></div>
            <div class="mm-item" data-name="Children's Books" data-link="/books-media/childrens-books"></div>
        </div>

        <div class="mm-group" data-title="Digital Media">
            <div class="mm-item" data-name="E-Books" data-link="/books-media/ebooks"></div>
            <div class="mm-item" data-name="Audiobooks" data-link="/books-media/audiobooks"></div>
            <div class="mm-item" data-name="Music Downloads" data-link="/books-media/music-downloads"></div>
            <div class="mm-item" data-name="Movies & TV" data-link="/books-media/movies-tv"></div>
            <div class="mm-item" data-name="Games" data-link="/books-media/games"></div>
            <div class="mm-item" data-name="Software" data-link="/books-media/software"></div>
        </div>

        <div class="mm-group" data-title="Educational">
            <div class="mm-item" data-name="Textbooks" data-link="/books-media/textbooks"></div>
            <div class="mm-item" data-name="Online Courses" data-link="/books-media/online-courses"></div>
            <div class="mm-item" data-name="Language Learning" data-link="/books-media/language-learning"></div>
            <div class="mm-item" data-name="Programming" data-link="/books-media/programming"></div>
            <div class="mm-item" data-name="Art & Design" data-link="/books-media/art-design"></div>
            <div class="mm-item" data-name="Music Theory" data-link="/books-media/music-theory"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Penguin" data-image="https://via.placeholder.com/80x40?text=Penguin"
                data-link="/brands/penguin"></div>
            <div class="mm-brand" data-name="Harper Collins"
                data-image="https://via.placeholder.com/80x40?text=Harper" data-link="/brands/harper-collins"></div>
            <div class="mm-brand" data-name="National Geographic"
                data-image="https://via.placeholder.com/80x40?text=NatGeo" data-link="/brands/national-geographic">
            </div>
            <div class="mm-brand" data-name="Audible" data-image="https://via.placeholder.com/80x40?text=Audible"
                data-link="/brands/audible"></div>
            <div class="mm-brand" data-name="Kindle" data-image="https://via.placeholder.com/80x40?text=Kindle"
                data-link="/brands/kindle"></div>
        </div>
    </div>

    <!-- Garden & Outdoor Category -->
    <div class="mm-category" data-id="garden-outdoor" data-name="Garden & Outdoor" data-link="/garden-outdoor"
        data-promo-image="https://images.pexels.com/photos/416978/pexels-photo-416978.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="OUTDOOR LIVING">
        <div class="mm-group" data-title="Gardening">
            <div class="mm-item" data-name="Seeds & Plants" data-link="/garden-outdoor/seeds-plants"></div>
            <div class="mm-item" data-name="Garden Tools" data-link="/garden-outdoor/garden-tools"></div>
            <div class="mm-item" data-name="Fertilizers" data-link="/garden-outdoor/fertilizers"></div>
            <div class="mm-item" data-name="Pots & Planters" data-link="/garden-outdoor/pots-planters"></div>
            <div class="mm-item" data-name="Watering Equipment" data-link="/garden-outdoor/watering-equipment"></div>
            <div class="mm-item" data-name="Lawn Care" data-link="/garden-outdoor/lawn-care"></div>
        </div>

        <div class="mm-group" data-title="Outdoor Furniture">
            <div class="mm-item" data-name="Patio Sets" data-link="/garden-outdoor/patio-sets"></div>
            <div class="mm-item" data-name="Outdoor Chairs" data-link="/garden-outdoor/outdoor-chairs"></div>
            <div class="mm-item" data-name="Umbrellas" data-link="/garden-outdoor/umbrellas"></div>
            <div class="mm-item" data-name="Fire Pits" data-link="/garden-outdoor/fire-pits"></div>
            <div class="mm-item" data-name="Gazebos" data-link="/garden-outdoor/gazebos"></div>
            <div class="mm-item" data-name="Outdoor Storage" data-link="/garden-outdoor/outdoor-storage"></div>
        </div>

        <div class="mm-group" data-title="BBQ & Grilling">
            <div class="mm-item" data-name="Gas Grills" data-link="/garden-outdoor/gas-grills"></div>
            <div class="mm-item" data-name="Charcoal Grills" data-link="/garden-outdoor/charcoal-grills"></div>
            <div class="mm-item" data-name="BBQ Tools" data-link="/garden-outdoor/bbq-tools"></div>
            <div class="mm-item" data-name="Outdoor Cooking" data-link="/garden-outdoor/outdoor-cooking"></div>
            <div class="mm-item" data-name="Smokers" data-link="/garden-outdoor/smokers"></div>
            <div class="mm-item" data-name="Grill Covers" data-link="/garden-outdoor/grill-covers"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Weber" data-image="https://via.placeholder.com/80x40?text=Weber"
                data-link="/brands/weber"></div>
            <div class="mm-brand" data-name="Scotts" data-image="https://via.placeholder.com/80x40?text=Scotts"
                data-link="/brands/scotts"></div>
            <div class="mm-brand" data-name="Coleman" data-image="https://via.placeholder.com/80x40?text=Coleman"
                data-link="/brands/coleman"></div>
            <div class="mm-brand" data-name="Keter" data-image="https://via.placeholder.com/80x40?text=Keter"
                data-link="/brands/keter"></div>
            <div class="mm-brand" data-name="Black & Decker"
                data-image="https://via.placeholder.com/80x40?text=BlackDecker" data-link="/brands/black-decker">
            </div>
        </div>
    </div>

    <!-- Health & Wellness Category -->
    <div class="mm-category" data-id="health-wellness" data-name="Health & Wellness"
        data-link="/health-wellness"
        data-promo-image="https://images.pexels.com/photos/4047146/pexels-photo-4047146.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="WELLNESS JOURNEY">
        <div class="mm-group" data-title="Supplements">
            <div class="mm-item" data-name="Vitamins" data-link="/health-wellness/vitamins"></div>
            <div class="mm-item" data-name="Protein Powder" data-link="/health-wellness/protein-powder"></div>
            <div class="mm-item" data-name="Omega-3" data-link="/health-wellness/omega-3"></div>
            <div class="mm-item" data-name="Probiotics" data-link="/health-wellness/probiotics"></div>
            <div class="mm-item" data-name="Minerals" data-link="/health-wellness/minerals"></div>
            <div class="mm-item" data-name="Herbal Supplements" data-link="/health-wellness/herbal-supplements">
            </div>
        </div>

        <div class="mm-group" data-title="Medical Devices">
            <div class="mm-item" data-name="Blood Pressure Monitors" data-link="/health-wellness/blood-pressure">
            </div>
            <div class="mm-item" data-name="Thermometers" data-link="/health-wellness/thermometers"></div>
            <div class="mm-item" data-name="Pulse Oximeters" data-link="/health-wellness/pulse-oximeters"></div>
            <div class="mm-item" data-name="Nebulizers" data-link="/health-wellness/nebulizers"></div>
            <div class="mm-item" data-name="First Aid Kits" data-link="/health-wellness/first-aid"></div>
            <div class="mm-item" data-name="Mobility Aids" data-link="/health-wellness/mobility-aids"></div>
        </div>

        <div class="mm-group" data-title="Personal Care">
            <div class="mm-item" data-name="Oral Care" data-link="/health-wellness/oral-care"></div>
            <div class="mm-item" data-name="Hand Sanitizers" data-link="/health-wellness/hand-sanitizers"></div>
            <div class="mm-item" data-name="Face Masks" data-link="/health-wellness/face-masks"></div>
            <div class="mm-item" data-name="Massage Tools" data-link="/health-wellness/massage-tools"></div>
            <div class="mm-item" data-name="Sleep Aids" data-link="/health-wellness/sleep-aids"></div>
            <div class="mm-item" data-name="Pain Relief" data-link="/health-wellness/pain-relief"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Johnson & Johnson"
                data-image="https://via.placeholder.com/80x40?text=JnJ" data-link="/brands/johnson-johnson"></div>
            <div class="mm-brand" data-name="Nature's Way"
                data-image="https://via.placeholder.com/80x40?text=NaturesWay" data-link="/brands/natures-way">
            </div>
            <div class="mm-brand" data-name="Omron" data-image="https://via.placeholder.com/80x40?text=Omron"
                data-link="/brands/omron"></div>
            <div class="mm-brand" data-name="Braun" data-image="https://via.placeholder.com/80x40?text=Braun"
                data-link="/brands/braun"></div>
            <div class="mm-brand" data-name="Optimum" data-image="https://via.placeholder.com/80x40?text=Optimum"
                data-link="/brands/optimum"></div>
        </div>
    </div>

    <!-- Pet Supplies Category -->
    <div class="mm-category" data-id="pet-supplies" data-name="Pet Supplies" data-link="/pet-supplies"
        data-promo-image="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="HAPPY PETS">
        <div class="mm-group" data-title="Dog Supplies">
            <div class="mm-item" data-name="Dog Food" data-link="/pet-supplies/dog-food"></div>
            <div class="mm-item" data-name="Dog Toys" data-link="/pet-supplies/dog-toys"></div>
            <div class="mm-item" data-name="Dog Beds" data-link="/pet-supplies/dog-beds"></div>
            <div class="mm-item" data-name="Dog Collars" data-link="/pet-supplies/dog-collars"></div>
            <div class="mm-item" data-name="Dog Treats" data-link="/pet-supplies/dog-treats"></div>
            <div class="mm-item" data-name="Dog Grooming" data-link="/pet-supplies/dog-grooming"></div>
        </div>

        <div class="mm-group" data-title="Cat Supplies">
            <div class="mm-item" data-name="Cat Food" data-link="/pet-supplies/cat-food"></div>
            <div class="mm-item" data-name="Cat Litter" data-link="/pet-supplies/cat-litter"></div>
            <div class="mm-item" data-name="Cat Toys" data-link="/pet-supplies/cat-toys"></div>
            <div class="mm-item" data-name="Scratching Posts" data-link="/pet-supplies/scratching-posts"></div>
            <div class="mm-item" data-name="Cat Treats" data-link="/pet-supplies/cat-treats"></div>
            <div class="mm-item" data-name="Cat Carriers" data-link="/pet-supplies/cat-carriers"></div>
        </div>

        <div class="mm-group" data-title="Small Pets">
            <div class="mm-item" data-name="Bird Supplies" data-link="/pet-supplies/bird-supplies"></div>
            <div class="mm-item" data-name="Fish & Aquarium" data-link="/pet-supplies/fish-aquarium"></div>
            <div class="mm-item" data-name="Hamster Supplies" data-link="/pet-supplies/hamster-supplies"></div>
            <div class="mm-item" data-name="Rabbit Supplies" data-link="/pet-supplies/rabbit-supplies"></div>
            <div class="mm-item" data-name="Reptile Supplies" data-link="/pet-supplies/reptile-supplies"></div>
            <div class="mm-item" data-name="Cages & Habitats" data-link="/pet-supplies/cages-habitats"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Purina" data-image="https://via.placeholder.com/80x40?text=Purina"
                data-link="/brands/purina"></div>
            <div class="mm-brand" data-name="Royal Canin"
                data-image="https://via.placeholder.com/80x40?text=RoyalCanin" data-link="/brands/royal-canin">
            </div>
            <div class="mm-brand" data-name="Hill's" data-image="https://via.placeholder.com/80x40?text=Hills"
                data-link="/brands/hills"></div>
            <div class="mm-brand" data-name="Kong" data-image="https://via.placeholder.com/80x40?text=Kong"
                data-link="/brands/kong"></div>
            <div class="mm-brand" data-name="Whiskas" data-image="https://via.placeholder.com/80x40?text=Whiskas"
                data-link="/brands/whiskas"></div>
        </div>
    </div>

    <!-- Office & Stationery Category -->
    <div class="mm-category" data-id="office-stationery" data-name="Office & Stationery"
        data-link="/office-stationery"
        data-promo-image="https://images.pexels.com/photos/6238050/pexels-photo-6238050.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="WORKSPACE ESSENTIALS">
        <div class="mm-group" data-title="Office Supplies">
            <div class="mm-item" data-name="Pens & Pencils" data-link="/office-stationery/pens-pencils"></div>
            <div class="mm-item" data-name="Notebooks" data-link="/office-stationery/notebooks"></div>
            <div class="mm-item" data-name="Binders & Folders" data-link="/office-stationery/binders-folders">
            </div>
            <div class="mm-item" data-name="Staplers" data-link="/office-stationery/staplers"></div>
            <div class="mm-item" data-name="Paper" data-link="/office-stationery/paper"></div>
            <div class="mm-item" data-name="Calculators" data-link="/office-stationery/calculators"></div>
        </div>

        <div class="mm-group" data-title="Office Furniture">
            <div class="mm-item" data-name="Office Chairs" data-link="/office-stationery/office-chairs"></div>
            <div class="mm-item" data-name="Desks" data-link="/office-stationery/desks"></div>
            <div class="mm-item" data-name="Filing Cabinets" data-link="/office-stationery/filing-cabinets"></div>
            <div class="mm-item" data-name="Bookcases" data-link="/office-stationery/bookcases"></div>
            <div class="mm-item" data-name="Desk Lamps" data-link="/office-stationery/desk-lamps"></div>
            <div class="mm-item" data-name="Office Storage" data-link="/office-stationery/office-storage"></div>
        </div>

        <div class="mm-group" data-title="Technology">
            <div class="mm-item" data-name="Printers" data-link="/office-stationery/printers"></div>
            <div class="mm-item" data-name="Scanners" data-link="/office-stationery/scanners"></div>
            <div class="mm-item" data-name="Shredders" data-link="/office-stationery/shredders"></div>
            <div class="mm-item" data-name="Label Makers" data-link="/office-stationery/label-makers"></div>
            <div class="mm-item" data-name="Projectors" data-link="/office-stationery/projectors"></div>
            <div class="mm-item" data-name="Whiteboards" data-link="/office-stationery/whiteboards"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Staples" data-image="https://via.placeholder.com/80x40?text=Staples"
                data-link="/brands/staples"></div>
            <div class="mm-brand" data-name="Pilot" data-image="https://via.placeholder.com/80x40?text=Pilot"
                data-link="/brands/pilot"></div>
            <div class="mm-brand" data-name="Canon" data-image="https://via.placeholder.com/80x40?text=Canon"
                data-link="/brands/canon"></div>
            <div class="mm-brand" data-name="Herman Miller"
                data-image="https://via.placeholder.com/80x40?text=Herman" data-link="/brands/herman-miller"></div>
            <div class="mm-brand" data-name="Post-it" data-image="https://via.placeholder.com/80x40?text=PostIt"
                data-link="/brands/post-it"></div>
        </div>
    </div>

    <!-- Jewelry & Watches Category -->
    <div class="mm-category" data-id="jewelry-watches" data-name="Jewelry & Watches"
        data-link="/jewelry-watches"
        data-promo-image="https://images.pexels.com/photos/1457847/pexels-photo-1457847.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        data-promo-title="LUXURY COLLECTION">
        <div class="mm-group" data-title="Jewelry">
            <div class="mm-item" data-name="Necklaces" data-link="/jewelry-watches/necklaces"></div>
            <div class="mm-item" data-name="Earrings" data-link="/jewelry-watches/earrings"></div>
            <div class="mm-item" data-name="Rings" data-link="/jewelry-watches/rings"></div>
            <div class="mm-item" data-name="Bracelets" data-link="/jewelry-watches/bracelets"></div>
            <div class="mm-item" data-name="Brooches" data-link="/jewelry-watches/brooches"></div>
            <div class="mm-item" data-name="Jewelry Sets" data-link="/jewelry-watches/jewelry-sets"></div>
        </div>

        <div class="mm-group" data-title="Watches">
            <div class="mm-item" data-name="Men's Watches" data-link="/jewelry-watches/mens-watches"></div>
            <div class="mm-item" data-name="Women's Watches" data-link="/jewelry-watches/womens-watches"></div>
            <div class="mm-item" data-name="Smart Watches" data-link="/jewelry-watches/smart-watches"></div>
            <div class="mm-item" data-name="Luxury Watches" data-link="/jewelry-watches/luxury-watches"></div>
            <div class="mm-item" data-name="Sports Watches" data-link="/jewelry-watches/sports-watches"></div>
            <div class="mm-item" data-name="Watch Accessories" data-link="/jewelry-watches/watch-accessories">
            </div>
        </div>

        <div class="mm-group" data-title="Precious Metals">
            <div class="mm-item" data-name="Gold Jewelry" data-link="/jewelry-watches/gold-jewelry"></div>
            <div class="mm-item" data-name="Silver Jewelry" data-link="/jewelry-watches/silver-jewelry"></div>
            <div class="mm-item" data-name="Platinum Jewelry" data-link="/jewelry-watches/platinum-jewelry"></div>
            <div class="mm-item" data-name="Diamond Jewelry" data-link="/jewelry-watches/diamond-jewelry"></div>
            <div class="mm-item" data-name="Gemstone Jewelry" data-link="/jewelry-watches/gemstone-jewelry"></div>
            <div class="mm-item" data-name="Pearl Jewelry" data-link="/jewelry-watches/pearl-jewelry"></div>
        </div>

        <div class="mm-brands">
            <div class="mm-brand" data-name="Rolex" data-image="https://via.placeholder.com/80x40?text=Rolex"
                data-link="/brands/rolex"></div>
            <div class="mm-brand" data-name="Tiffany & Co"
                data-image="https://via.placeholder.com/80x40?text=Tiffany" data-link="/brands/tiffany"></div>
            <div class="mm-brand" data-name="Cartier" data-image="https://via.placeholder.com/80x40?text=Cartier"
                data-link="/brands/cartier"></div>
            <div class="mm-brand" data-name="Pandora" data-image="https://via.placeholder.com/80x40?text=Pandora"
                data-link="/brands/pandora"></div>
            <div class="mm-brand" data-name="Casio" data-image="https://via.placeholder.com/80x40?text=Casio"
                data-link="/brands/casio"></div>
        </div>
    </div>
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
            this.categoriesContainer = document.getElementById(
                "mm-categories-container"
            );
            this.megaMenu = document.getElementById("mm-mega-menu");
            this.scrollLeftBtn = document.getElementById("mm-scroll-left-btn");
            this.scrollRightBtn = document.getElementById("mm-scroll-right-btn");
            this.navbarContainer = document.querySelector(".mm-navbar-container");
            this.menuData = this.loadMenuData();

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
                    promoImage: categoryEl.dataset.promoImage,
                    promoTitle: categoryEl.dataset.promoTitle,
                    groups: [],
                    brands: [],
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
            this.setActiveCategory(categoryId);
            const category = this.menuData.find((cat) => cat.id === categoryId);
            if (category) {
                this.showMegaMenu(category);
            }
        }

        // Handle mouse leave from navbar container
        handleMouseLeave() {
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
        }

        // Hide mega menu
        hideMegaMenu() {
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

            const brandsHTML = category.brands
                .map(
                    (brand) => `
                  <a href="${brand.link}" class="mm-brand-item mm-group">
                      <div class="mm-brand-container">
                          <img src="${brand.image}" alt="${brand.name}" class="mm-brand-image" />
                      </div>
                      <span class="mm-brand-name">${brand.name}</span>
                  </a>
              `
                )
                .join("");

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
                              <div class="mm-promo-container">
                                  <img src="${category.promoImage}" alt="${category.name}" class="mm-promo-image" />
                                  <div class="mm-promo-overlay">
                                      <h2 class="mm-promo-title">${category.promoTitle}</h2>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              `;
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
        console.log("Navigate to:", url);
        // You can implement your navigation logic here
        // For example: window.location.href = url;
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
