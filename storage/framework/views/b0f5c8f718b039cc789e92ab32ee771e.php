<section class="djib-features-showcase">
    <div class="container">
        <div class="djib-features-header text-center mb-60">
            <h2 class="djib-features-title">Why Choose DjibMarket?</h2>
            <p class="djib-features-subtitle">Experience premium service with every purchase</p>
        </div>

        <div class="djib-swiper-container">
            <div class="djib-swiper-wrapper" id="djibFeaturesSwiper">
                <div class="djib-swiper-slide">
                    <div class="djib-feature-card djib-delivery-card">
                        <div class="djib-card-inner">
                            <div class="djib-feature-icon">
                                <div class="djib-icon-glow"></div>
                                <img src="<?php echo e(asset('assets/imgs/template/delivery.svg')); ?>" alt="Free Delivery">
                            </div>
                            <div class="djib-feature-content">
                                <h3 class="djib-feature-title">Free Delivery</h3>
                                <p class="djib-feature-description">Lightning-fast shipping on orders over $10</p>
                                <div class="djib-feature-badge">Fast & Free</div>
                            </div>
                        </div>
                        <div class="djib-card-background"></div>
                    </div>
                </div>

                <div class="djib-swiper-slide">
                    <div class="djib-feature-card djib-support-card">
                        <div class="djib-card-inner">
                            <div class="djib-feature-icon">
                                <div class="djib-icon-glow"></div>
                                <img src="<?php echo e(asset('assets/imgs/template/support.svg')); ?>" alt="24/7 Support">
                            </div>
                            <div class="djib-feature-content">
                                <h3 class="djib-feature-title">24/7 Expert Support</h3>
                                <p class="djib-feature-description">Professional assistance whenever you need it</p>
                                <div class="djib-feature-badge">Always Here</div>
                            </div>
                        </div>
                        <div class="djib-card-background"></div>
                    </div>
                </div>

                <div class="djib-swiper-slide">
                    <div class="djib-feature-card djib-voucher-card">
                        <div class="djib-card-inner">
                            <div class="djib-feature-icon">
                                <div class="djib-icon-glow"></div>
                                <img src="<?php echo e(asset('assets/imgs/template/voucher.svg')); ?>" alt="Gift Voucher">
                            </div>
                            <div class="djib-feature-content">
                                <h3 class="djib-feature-title">Reward Program</h3>
                                <p class="djib-feature-description">Earn points and get exclusive gift vouchers</p>
                                <div class="djib-feature-badge">Exclusive</div>
                            </div>
                        </div>
                        <div class="djib-card-background"></div>
                    </div>
                </div>

                <div class="djib-swiper-slide">
                    <div class="djib-feature-card djib-return-card">
                        <div class="djib-card-inner">
                            <div class="djib-feature-icon">
                                <div class="djib-icon-glow"></div>
                                <img src="<?php echo e(asset('assets/imgs/template/return.svg')); ?>" alt="Easy Returns">
                            </div>
                            <div class="djib-feature-content">
                                <h3 class="djib-feature-title">Easy Returns</h3>
                                <p class="djib-feature-description">Hassle-free returns on purchases over $200</p>
                                <div class="djib-feature-badge">No Hassle</div>
                            </div>
                        </div>
                        <div class="djib-card-background"></div>
                    </div>
                </div>

                <div class="djib-swiper-slide">
                    <div class="djib-feature-card djib-secure-card">
                        <div class="djib-card-inner">
                            <div class="djib-feature-icon">
                                <div class="djib-icon-glow"></div>
                                <img src="<?php echo e(asset('assets/imgs/template/secure.svg')); ?>" alt="Secure Payment">
                            </div>
                            <div class="djib-feature-content">
                                <h3 class="djib-feature-title">Bank-Level Security</h3>
                                <p class="djib-feature-description">Your payments are 100% protected & encrypted</p>
                                <div class="djib-feature-badge">Secured</div>
                            </div>
                        </div>
                        <div class="djib-card-background"></div>
                    </div>
                </div>
            </div>

            <!-- Navigation dots -->
            <div class="djib-swiper-pagination"></div>
        </div>
    </div>
</section>

<style>
    .djib-features-showcase {
        /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
        background: linear-gradient(135deg, #66ead9 0%, #4b6ba2 100%);
        padding: 3rem 0;
        position: relative;
        overflow: hidden;
    }

    .djib-features-showcase::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
        background-size: 50px 50px;
        animation: djib-float 20s infinite linear;
    }

    @keyframes djib-float {
        0% {
            transform: translateY(0px) translateX(0px);
        }

        100% {
            transform: translateY(-100px) translateX(-50px);
        }
    }

    .djib-features-header {
        position: relative;
        z-index: 2;
    }

    .djib-features-title {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(45deg, #fff, #f8f9ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 20px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .djib-features-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        font-weight: 300;
        max-width: 500px;
        margin: 0 auto;
    }

    /* Swiper Styles */
    .djib-swiper-container {
        width: 100%;
        position: relative;
        z-index: 2;
        overflow: hidden;
        padding: 2rem 2rem 3rem;
    }

    .djib-swiper-wrapper {
        display: flex;
        transition: transform 0.8s ease;
        will-change: transform;
    }

    .djib-swiper-slide {
        flex: 0 0 calc(33.333% - 20px);
        margin-right: 30px;
        opacity: 0.7;
        transform: scale(0.9);
        transition: all 0.8s ease;
    }

    .djib-swiper-slide.djib-active {
        opacity: 1;
        transform: scale(1);
    }

    .djib-swiper-slide:last-child {
        margin-right: 0;
    }

    .djib-feature-card {
        position: relative;
        height: 160px;
        width: 100%;
        border-radius: 20px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.4s ease;
        transform-style: preserve-3d;
    }

    .djib-feature-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .djib-card-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        transition: all 0.4s ease;
    }

    .djib-feature-card:hover .djib-card-background {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .djib-card-inner {
        position: relative;
        z-index: 2;
        padding: 25px;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .djib-feature-icon {
        position: relative;
        width: 50px;
        height: 50px;
        flex-shrink: 0;
    }

    .djib-icon-glow {
        position: absolute;
        top: -8px;
        left: -8px;
        right: -8px;
        bottom: -8px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .djib-feature-card:hover .djib-icon-glow {
        opacity: 1;
        animation: djib-pulse 2s infinite;
    }

    @keyframes djib-pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.3;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.6;
        }
    }

    .djib-feature-icon img {
        width: 50px;
        height: 50px;
        filter: brightness(0) invert(1);
        transition: transform 0.4s ease;
    }

    .djib-feature-card:hover .djib-feature-icon img {
        transform: scale(1.1) rotate(5deg);
    }

    .djib-feature-content {
        flex: 1;
        min-width: 0;
    }

    .djib-feature-title {
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .djib-feature-description {
        color: rgba(255, 255, 255, 0.85);
        /* font-size: 0.9rem; */
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .djib-feature-badge {
        display: inline-block;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        color: white;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .djib-feature-card:hover .djib-feature-badge {
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
        transform: translateX(5px);
    }

    /* Individual card hover effects */
    .djib-delivery-card:hover .djib-card-background {
        background: linear-gradient(135deg, rgba(74, 144, 226, 0.3), rgba(80, 170, 255, 0.2));
    }

    .djib-support-card:hover .djib-card-background {
        background: linear-gradient(135deg, rgba(129, 236, 236, 0.3), rgba(116, 235, 213, 0.2));
    }

    .djib-voucher-card:hover .djib-card-background {
        background: linear-gradient(135deg, rgba(255, 154, 158, 0.3), rgba(250, 208, 196, 0.2));
    }

    .djib-return-card:hover .djib-card-background {
        background: linear-gradient(135deg, rgba(168, 237, 234, 0.3), rgba(207, 250, 254, 0.2));
    }

    .djib-secure-card:hover .djib-card-background {
        background: linear-gradient(135deg, rgba(180, 255, 200, 0.3), rgba(150, 250, 180, 0.2));
    }

    /* Pagination dots */
    .djib-swiper-pagination {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }

    .djib-pagination-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .djib-pagination-dot.djib-active {
        background: white;
        transform: scale(1.2);
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .djib-swiper-slide {
            flex: 0 0 calc(50% - 15px);
            margin-right: 20px;
        }
    }

    @media (max-width: 768px) {
        .djib-features-showcase {
            padding: 60px 0;
        }

        .djib-features-title {
            font-size: 2rem;
        }

        .djib-swiper-slide {
            flex: 0 0 calc(100% - 10px);
            margin-right: 15px;
        }

        .djib-feature-card {
            height: 140px;
        }

        .djib-card-inner {
            padding: 20px;
            gap: 15px;
        }

        .djib-feature-icon {
            width: 40px;
            height: 40px;
        }

        .djib-feature-icon img {
            width: 40px;
            height: 40px;
        }

        .djib-feature-title {
            font-size: 1.1rem;
        }

        .djib-feature-description {
            font-size: 0.85rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const djibFeaturesWrapper = document.getElementById('djibFeaturesSwiper');

            if (!djibFeaturesWrapper) return;

            const djibSlides = djibFeaturesWrapper.querySelectorAll('.djib-swiper-slide');
            if (djibSlides.length === 0) return;

            const djibTotalSlides = djibSlides.length;
            const djibSlidesPerView = 3; // Number of slides visible at once
            const djibMaxIndex = Math.max(0, djibTotalSlides -
                djibSlidesPerView); // Maximum slide index
            let djibCurrentIndex = 0;
            let djibIsTransitioning = false;

            // Drag/Swipe variables
            let djibIsDragging = false;
            let djibStartX = 0;
            let djibCurrentX = 0;
            let djibInitialTransform = 0;
            let djibDragThreshold = 50;

            // Create pagination dots (one for each possible position)
            const djibPagination = document.querySelector('.djib-swiper-pagination');
            if (!djibPagination) return;

            djibPagination.innerHTML = '';

            // Create dots for each possible slide position
            const djibTotalDots = djibMaxIndex + 1;
            for (let i = 0; i <= djibMaxIndex; i++) {
                const djibDot = document.createElement('div');
                djibDot.className = 'djib-pagination-dot';
                djibDot.dataset.slideIndex = i;
                if (i === 0) djibDot.classList.add('djib-active');
                djibDot.addEventListener('click', (e) => {
                    e.preventDefault();
                    djibGoToSlide(i);
                });
                djibPagination.appendChild(djibDot);
            }

            const djibDots = djibPagination.querySelectorAll('.djib-pagination-dot');

            // Set initial active states
            djibUpdateActiveStates();

            function djibUpdateActiveStates() {
                // Update slide visual states
                djibSlides.forEach((slide, index) => {
                    slide.classList.remove('djib-active');
                    if (index >= djibCurrentIndex && index < djibCurrentIndex +
                        djibSlidesPerView) {
                        slide.classList.add('djib-active');
                    }
                });

                // Update pagination dots
                djibDots.forEach((dot, index) => {
                    dot.classList.remove('djib-active');
                    if (index === djibCurrentIndex) {
                        dot.classList.add('djib-active');
                    }
                });
            }

            function djibMoveSlider(withTransition = true) {
                if (djibIsTransitioning && withTransition) return;
                if (withTransition) djibIsTransitioning = true;

                // Ensure current index is within bounds
                djibCurrentIndex = Math.max(0, Math.min(djibCurrentIndex, djibMaxIndex));

                const djibSlideWidth = djibSlides[0].offsetWidth + 30;
                const djibTranslateX = -(djibCurrentIndex * djibSlideWidth);

                if (withTransition) {
                    djibFeaturesWrapper.style.transition = 'transform 0.8s ease';
                } else {
                    djibFeaturesWrapper.style.transition = 'none';
                }

                djibFeaturesWrapper.style.transform = `translateX(${djibTranslateX}px)`;
                djibUpdateActiveStates();

                if (withTransition) {
                    setTimeout(() => {
                        djibIsTransitioning = false;
                    }, 800);
                }
            }

            function djibNextSlide() {
                if (djibCurrentIndex < djibMaxIndex) {
                    djibCurrentIndex++;
                } else {
                    djibCurrentIndex = 0;
                }
                djibMoveSlider();
            }

            function djibPrevSlide() {
                if (djibCurrentIndex > 0) {
                    djibCurrentIndex--;
                } else {
                    djibCurrentIndex = djibMaxIndex;
                }
                djibMoveSlider();
            }

            function djibGoToSlide(index) {
                if (djibIsTransitioning) return;

                // Ensure index is within valid range
                const djibNewIndex = Math.max(0, Math.min(index, djibMaxIndex));

                if (djibNewIndex === djibCurrentIndex) return;

                djibCurrentIndex = djibNewIndex;
                djibMoveSlider();
                djibRestartAutoPlay();
            }

            // Drag/Swipe functionality
            function djibGetX(event) {
                return event.type.includes('mouse') ? event.clientX : event.touches[0].clientX;
            }

            function djibStartDrag(event) {
                if (djibIsTransitioning) return;

                djibIsDragging = true;
                djibStartX = djibGetX(event);
                djibCurrentX = djibStartX;

                const djibSlideWidth = djibSlides[0].offsetWidth + 30;
                djibInitialTransform = -(djibCurrentIndex * djibSlideWidth);

                djibFeaturesWrapper.style.transition = 'none';
                djibPauseAutoPlay();

                event.preventDefault();
            }

            function djibDuringDrag(event) {
                if (!djibIsDragging) return;

                djibCurrentX = djibGetX(event);
                const djibDiffX = djibCurrentX - djibStartX;
                const djibNewTransform = djibInitialTransform + djibDiffX;

                djibFeaturesWrapper.style.transform = `translateX(${djibNewTransform}px)`;

                event.preventDefault();
            }

            function djibEndDrag(event) {
                if (!djibIsDragging) return;

                djibIsDragging = false;
                const djibDiffX = djibCurrentX - djibStartX;

                djibFeaturesWrapper.style.transition = 'transform 0.8s ease';

                if (Math.abs(djibDiffX) > djibDragThreshold) {
                    if (djibDiffX > 0) {
                        djibPrevSlide();
                    } else {
                        djibNextSlide();
                    }
                } else {
                    djibMoveSlider();
                }

                djibRestartAutoPlay();
            }

            // Event listeners
            djibFeaturesWrapper.addEventListener('mousedown', djibStartDrag);
            document.addEventListener('mousemove', djibDuringDrag);
            document.addEventListener('mouseup', djibEndDrag);

            djibFeaturesWrapper.addEventListener('touchstart', djibStartDrag, {
                passive: false
            });
            document.addEventListener('touchmove', djibDuringDrag, {
                passive: false
            });
            document.addEventListener('touchend', djibEndDrag);

            djibFeaturesWrapper.addEventListener('contextmenu', (e) => e.preventDefault());

            // Auto-play functionality
            let djibAutoPlayInterval;

            function djibStartAutoPlay() {
                djibAutoPlayInterval = setInterval(djibNextSlide, 4000);
            }

            function djibPauseAutoPlay() {
                clearInterval(djibAutoPlayInterval);
            }

            function djibRestartAutoPlay() {
                djibPauseAutoPlay();
                setTimeout(djibStartAutoPlay, 1000);
            }

            djibStartAutoPlay();

            // Pause on hover
            const djibContainer = document.querySelector('.djib-swiper-container');
            if (djibContainer) {
                djibContainer.addEventListener('mouseenter', djibPauseAutoPlay);
                djibContainer.addEventListener('mouseleave', djibStartAutoPlay);
            }

            // Handle window resize
            let djibResizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(djibResizeTimeout);
                djibResizeTimeout = setTimeout(() => {
                    djibMoveSlider(false);
                }, 250);
            });

            // Cleanup function
            window.djibFeaturesCleanup = function() {
                djibPauseAutoPlay();
                clearTimeout(djibResizeTimeout);
            };

            // Force initial positioning
            setTimeout(() => {
                djibMoveSlider(false);
            }, 100);

        }, 100);
    });
</script>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/platform_features_bottom.blade.php ENDPATH**/ ?>