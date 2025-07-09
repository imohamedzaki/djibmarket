@extends('layouts.app.buyer')

@section('title', 'About Us - DjibMarket')

@section('css')
    <style>
        /* Lazy Loading styles inspired by product-card-home */
        .about-image-container {
            position: relative;
            background-color: #f8f9fa;
            /* Fallback color */
        }

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
            transition: opacity 0.5s ease;
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
            width: 80px;
            height: auto;
            opacity: 0.4;
            z-index: 6;
            position: relative;
            filter: grayscale(1);
        }

        .lazy-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.5s ease;
            opacity: 0;
        }

        .lazy-image.loaded {
            opacity: 1;
        }

        .buyer-breadcrumb-section {
            margin-bottom: 0 !important;
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation classes */
        .animate-fade-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fade-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        .animate-fade-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }

        .animate-scale-in {
            animation: scaleIn 0.6s ease-out forwards;
        }

        .animate-slide-down {
            animation: slideInDown 0.8s ease-out forwards;
        }

        /* Intersection Observer animations */
        .fade-in-section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero section */
        .hero-about {
            background: linear-gradient(135deg, #e3fff7 0%, #c6dbff 100%);
            min-height: 60vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-about::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateX(0%) translateY(0%);
            }

            100% {
                transform: translateX(-100%) translateY(-100%);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Stats section */
        .stats-card {
            background: linear-gradient(135deg, #e3fff7 0%, #d9e7ff 100%);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            width: 200px;
            height: 200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            border: 4px solid transparent;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            background-clip: padding-box;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #a8e6cf52, #87ceeb4f, #a8e6cf52, #87ceeb63, #a8e6cf52);
            z-index: -1;
            animation: rotate-border 3s linear infinite;
        }

        .stats-card::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #7dd3fc, #93c5fd, #7dd3fc, #93c5fd, #7dd3fc);
            z-index: -1;
            opacity: 0;
            animation: rotate-border-hover 3s linear infinite;
            transition: opacity 0.3s ease;
        }

        @keyframes rotate-border {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes rotate-border-hover {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .stats-card:hover::after {
            opacity: 1;
        }

        .stats-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 60px rgba(125, 211, 252, 0.15);
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: bold;
            color: #0ba9ed;
            display: block;
            line-height: 1;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stats-label {
            color: #425a8b;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stats-card:hover .stats-number {
            color: #fff;
            text-shadow: 0 2px 8px rgba(125, 211, 252, 0.2);
        }

        .stats-card:hover .stats-label {
            color: #425a8b;
        }

        /* Feature cards */
        .feature-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #f0f3f8;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(11, 169, 237, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(11, 169, 237, 0.15);
            border-color: #0ba9ed;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #e3fff7 0%, #d9e7ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #0ba9ed;
            transition: all 0.3s ease;
            border: 2px solid rgba(11, 169, 237, 0.2);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, #0ba9ed, #425a8b);
            color: white;
            border-color: #fff;
        }

        /* Team section */
        .team-member {
            background: #ffffff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #f0f3f8;
            height: 100%;
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #e3fff7 0%, #d9e7ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #425a8b;
            transition: all 0.3s ease;
            border: 4px solid transparent;
            background-clip: padding-box;
        }

        .team-member:hover .team-avatar {
            border-color: #0ba9ed;
            transform: scale(1.05);
        }

        /* Section spacing */
        .section-padding {
            padding: 5rem 0;
        }

        .section-padding-sm {
            padding: 3rem 0;
        }

        /* Custom buttons */
        .btn-custom {
            background: linear-gradient(135deg, #e3fff7 0%, #d9e7ff 100%);
            color: #0ba9ed;
            border: 2px solid #0ba9ed;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            /* background: linear-gradient(135deg, #0ba9ed, #425a8b); */
            transition: left 0.3s ease;
        }

        .btn-custom:hover::before {
            left: 0;
        }

        .btn-custom span {
            position: relative;
            z-index: 2;
        }

        .btn-custom:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(11, 169, 237, 0.3);
            border-color: transparent;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-about {
                min-height: 50vh;
                padding: 2rem 0;
            }

            .stats-card {
                width: 160px;
                height: 160px;
                margin-bottom: 2rem;
            }

            .stats-number {
                font-size: 1.8rem;
            }

            .stats-label {
                font-size: 0.7rem;
            }

            .feature-card,
            .team-member {
                margin-bottom: 2rem;
            }

            .section-padding {
                padding: 3rem 0;
            }
        }

        @media (max-width: 480px) {
            .stats-card {
                width: 140px;
                height: 140px;
            }

            .stats-number {
                font-size: 1.6rem;
            }

            .stats-label {
                font-size: 0.65rem;
            }
        }

        /* Breadcrumb styling */
        .breadcrumb-custom {
            background: #fff;
            padding: 1rem 0;
        }

        .breadcrumb-custom .breadcrumb {
            background: none;
            margin: 0;
            padding: 0;
        }

        .breadcrumb-custom .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #8c9ec5;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: #425a8b;
            text-decoration: none;
        }

        .breadcrumb-custom .breadcrumb-item a:hover {
            color: #0ba9ed;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #8c9ec5;
        }
    </style>
@endsection

@section('content')
    @php
        $breadcrumbs_items = [['text' => 'Home', 'url' => route('buyer.home')], ['text' => 'About Us', 'url' => '#']];
    @endphp
    <x-buyer.breadcrumb :items="$breadcrumbs_items" />

    <!-- Hero Section -->
    <section class="hero-about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h5 class="color-brand-1 mb-3 animate-slide-down" style="animation-delay: 0.2s;">About DjibMarket
                        </h5>
                        <h1 class="color-gray-1000 mb-4 animate-fade-up" style="animation-delay: 0.4s;">Your Premier Digital
                            Marketplace</h1>
                        <p class="color-gray-700 mb-4 animate-fade-up"
                            style="animation-delay: 0.6s; font-size: 1.1rem; line-height: 1.6;">
                            DjibMarket is revolutionizing e-commerce in Djibouti, connecting buyers and sellers through
                            innovative technology and exceptional service. We're building the future of digital commerce,
                            one transaction at a time.
                        </p>
                        <a href="#features" class="btn-custom animate-fade-up" style="animation-delay: 0.8s;">
                            <span>Learn More</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center animate-fade-right" style="animation-delay: 1s;">
                        <div class="about-image-container"
                            style="width: 100%; height: 400px; border-radius: 20px; overflow: hidden;">
                            <div class="image-placeholder">
                                <div class="placeholder-gradient"></div>
                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Loading"
                                    class="placeholder-logo">
                            </div>
                            <img data-src="{{ asset('assets/imgs/about-us/digital-marketplace.jpeg') }}" alt="Mission"
                                class="lazy-image" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section-padding-sm" style="margin-top: 20px; position: relative; z-index: 3; padding-top: 4rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card fade-in-section">
                        <span class="stats-number" data-count="50000">0</span>
                        <p class="stats-label">Active Users</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card fade-in-section">
                        <span class="stats-number" data-count="15000">0</span>
                        <p class="stats-label">Products Listed</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card fade-in-section">
                        <span class="stats-number" data-count="500">0</span>
                        <p class="stats-label">Verified Sellers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card fade-in-section">
                        <span class="stats-number" data-count="99">0</span>
                        <p class="stats-label">Customer Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-padding background-gray-50">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h5 class="color-brand-1 mb-3 fade-in-section">Why Choose DjibMarket</h5>
                    <h2 class="color-gray-1000 mb-4 fade-in-section">Built for Modern Commerce</h2>
                    <p class="color-gray-700 fade-in-section" style="font-size: 1.1rem;">
                        We combine cutting-edge technology with local expertise to deliver an unmatched shopping experience
                        for buyers and sellers across Djibouti.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in-section">
                        <div class="feature-icon">🚀</div>
                        <h4 class="color-gray-1000 mb-3">Lightning Fast</h4>
                        <p class="color-gray-700">Experience blazing-fast loading times and seamless navigation. Our
                            optimized platform ensures you find what you need quickly.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in-section">
                        <div class="feature-icon">🔒</div>
                        <h4 class="color-gray-1000 mb-3">Secure Payments</h4>
                        <p class="color-gray-700">Shop with confidence using our advanced security measures. Your
                            transactions are protected with bank-level encryption.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in-section">
                        <div class="feature-icon">🌟</div>
                        <h4 class="color-gray-1000 mb-3">Quality Guaranteed</h4>
                        <p class="color-gray-700">Every seller is verified and every product is quality-checked. We maintain
                            the highest standards for your peace of mind.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in-section">
                        <div class="feature-icon">📱</div>
                        <h4 class="color-gray-1000 mb-3">Mobile Optimized</h4>
                        <p class="color-gray-700">Shop anywhere, anytime with our fully responsive design. Perfect
                            experience across all devices and screen sizes.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in-section">
                        <div class="feature-icon">🎯</div>
                        <h4 class="color-gray-1000 mb-3">Local Focus</h4>
                        <p class="color-gray-700">Built specifically for Djibouti market needs. We understand local
                            preferences and business requirements.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card fade-in-section">
                        <div class="feature-icon">💬</div>
                        <h4 class="color-gray-1000 mb-3">24/7 Support</h4>
                        <p class="color-gray-700">Our dedicated support team is always ready to help. Get assistance
                            whenever you need it, in your preferred language.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h5 class="color-brand-1 mb-3 fade-in-section">Our Team</h5>
                    <h2 class="color-gray-1000 mb-4 fade-in-section">Meet the Innovators</h2>
                    <p class="color-gray-700 fade-in-section" style="font-size: 1.1rem;">
                        Our diverse team of experts is passionate about transforming e-commerce in Djibouti. Together, we're
                        building the future of digital commerce.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-member fade-in-section">
                        <div class="team-avatar">👨‍💼</div>
                        <h4 class="color-gray-1000 mb-2">Mohamed Zaki</h4>
                        <p class="color-brand-1 mb-3">Chief Executive Officer</p>
                        <p class="color-gray-700">Visionary leader with 15+ years in e-commerce, driving DjibMarket's
                            mission to revolutionize digital commerce in the region.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-member fade-in-section">
                        <div class="team-avatar">👩‍💻</div>
                        <h4 class="color-gray-1000 mb-2">Neima Saleh</h4>
                        <p class="color-brand-1 mb-3">Chief Technology Officer</p>
                        <p class="color-gray-700">Tech innovator ensuring our platform stays at the cutting edge of
                            e-commerce technology and user experience.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="team-member fade-in-section">
                        <div class="team-avatar">👨‍🎨</div>
                        <h4 class="color-gray-1000 mb-2">Saba Nabil</h4>
                        <p class="color-brand-1 mb-3">Head of Operations</p>
                        <p class="color-gray-700">Operations expert streamlining processes to ensure smooth transactions
                            and exceptional customer experiences.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="section-padding" style="background: linear-gradient(90deg, #e3fff7 0%, #d9e7ff 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="fade-in-section">
                        <h5 class="color-brand-1 mb-3">Our Mission</h5>
                        <h2 class="color-gray-1000 mb-4">Empowering Digital Commerce</h2>
                        <p class="color-gray-700 mb-4" style="font-size: 1.1rem; line-height: 1.6;">
                            At DjibMarket, we're committed to creating an inclusive digital marketplace that empowers local
                            businesses and provides customers with access to quality products and services.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-3 color-gray-700">
                                <i class="fas fa-check color-success me-2"></i>
                                <strong>Innovation:</strong> Continuously improving our platform with latest technologies
                            </li>
                            <li class="mb-3 color-gray-700">
                                <i class="fas fa-check color-success me-2"></i>
                                <strong>Trust:</strong> Building secure and reliable marketplace experiences
                            </li>
                            <li class="mb-3 color-gray-700">
                                <i class="fas fa-check color-success me-2"></i>
                                <strong>Growth:</strong> Supporting local businesses to reach new heights
                            </li>
                            <li class="mb-3 color-gray-700">
                                <i class="fas fa-check color-success me-2"></i>
                                <strong>Community:</strong> Fostering connections between buyers and sellers
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center fade-in-section">
                        <div class="about-image-container"
                            style="width: 100%; height: 400px; border-radius: 20px; overflow: hidden; background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%); border: 1px solid rgba(11, 169, 237, 0.2);">
                            <div class="image-placeholder">
                                <div class="placeholder-gradient"></div>
                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Loading"
                                    class="placeholder-logo">
                            </div>
                            <img data-src="{{ asset('assets/imgs/about-us/digital-commerce-1.jpg') }}" alt="Mission"
                                class="lazy-image" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding" style="background: linear-gradient(45deg, #0ba9ed 0%, #425a8b 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="color-white mb-4 fade-in-section">Ready to Join DjibMarket?</h2>
                    <p class="color-white mb-4 fade-in-section" style="font-size: 1.2rem;">
                        Whether you're looking to buy quality products or grow your business by selling online, DjibMarket
                        is your gateway to digital commerce success.
                    </p>
                    <div class="fade-in-section">
                        <a href="{{ route('vendors.index') }}" class="btn btn-light me-3 mb-3">
                            Browse Sellers
                        </a>
                        <a href="#" class="btn btn-outline-light mb-3">
                            Start Selling
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lazy loading for images using the product card method
            const lazyImages = document.querySelectorAll('img.lazy-image');
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            const container = img.closest('.about-image-container');
                            const placeholder = container ? container.querySelector(
                                '.image-placeholder') : null;

                            img.onload = () => {
                                img.classList.add('loaded');
                                if (placeholder) {
                                    placeholder.classList.add('loaded');
                                }
                            };

                            img.src = img.dataset.src;
                            observer.unobserve(img);
                        }
                    });
                });
                lazyImages.forEach(img => {
                    imageObserver.observe(img);
                });
            } else {
                // Fallback for browsers without IntersectionObserver
                lazyImages.forEach(img => {
                    const container = img.closest('.about-image-container');
                    const placeholder = container ? container.querySelector(
                        '.image-placeholder') : null;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    if (placeholder) {
                        placeholder.classList.add('loaded');
                    }
                });
            }

            // Intersection Observer for fade-in animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, observerOptions);

            // Observe all fade-in sections
            document.querySelectorAll('.fade-in-section').forEach(section => {
                observer.observe(section);
            });

            // Animated counters
            const animateCounters = () => {
                const counters = document.querySelectorAll('[data-count]');

                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    const duration = 2000; // 2 seconds
                    const step = target / (duration / 16); // 60fps
                    let current = 0;

                    const updateCounter = () => {
                        current += step;
                        if (current < target) {
                            counter.textContent = Math.floor(current).toLocaleString();
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target.toLocaleString() + (counter.closest(
                                    '.stats-card').querySelector('.stats-label').textContent
                                .includes('Satisfaction') ? '%' : '');
                        }
                    };

                    // Start animation when element is visible
                    const counterObserver = new IntersectionObserver(function(entries) {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                updateCounter();
                                counterObserver.unobserve(entry.target);
                            }
                        });
                    }, {
                        threshold: 0.5
                    });

                    counterObserver.observe(counter.closest('.stats-card'));
                });
            };

            animateCounters();

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endsection
