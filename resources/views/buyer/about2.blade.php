<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- SEO Meta Tags -->
    <title>About DjibMarket - Premier Digital Marketplace in Djibouti</title>
    <meta name="description"
        content="Discover DjibMarket - Djibouti's premier digital marketplace connecting buyers and sellers through innovative technology and exceptional service.">
    <meta name="keywords" content="DjibMarket, Djibouti marketplace, e-commerce, digital commerce, online shopping">
    <meta name="author" content="DjibMarket Team">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="About DjibMarket - Premier Digital Marketplace">
    <meta property="og:description"
        content="Revolutionary e-commerce platform in Djibouti connecting buyers and sellers.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('assets/imgs/about-us/digital-marketplace.jpeg') }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="About DjibMarket - Premier Digital Marketplace">
    <meta name="twitter:description" content="Revolutionary e-commerce platform in Djibouti.">

    <!-- Preload Critical Resources -->
    <link rel="preload" href="{{ asset('assets/imgs/about-us/digital-marketplace.jpeg') }}" as="image">
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        as="style">

    <!-- External Resources -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/template/favicon.png') }}" sizes="32x26">


    <style>
        /* CSS Variables for theming */
        :root {
            --primary-color: #4ecdc4;
            --secondary-color: #6bb6ff;
            --accent-color: #45b7d1;
            --white: #ffffff;
            --black: #000000;
            --background-light: #f0fdfa;
            --background-gradient: linear-gradient(135deg, #e3fff6 0%, #c6dbff 100%);
            --text-dark: #0f172a;
            --text-light: #64748b;
            --text-medium: #334155;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
            --info-color: #3b82f6;
            --border-radius: 8px;
            --border-radius-lg: 16px;
            --border-radius-xl: 24px;
            --shadow-sm: rgba(0, 0, 0, 0.05);
            --shadow-medium: rgba(0, 0, 0, 0.1);
            --shadow-lg: rgba(0, 0, 0, 0.15);
            --max-width: 1200px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            /* CTA Section Variables */
            --cta-background: linear-gradient(135deg, #e3fff6 0%, #c6dbff 100%);
            --cta-text-color: var(--text-dark);
            --cta-description-color: var(--text-light);
        }

        [data-theme="dark"] {
            --white: #1e293b;
            --black: #ffffff;
            --background-light: #334155;
            --background-gradient: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            --text-dark: #f8fafc;
            --text-light: #cbd5e0;
            --text-medium: #94a3b8;
            --shadow-sm: rgba(255, 255, 255, 0.05);
            --shadow-medium: rgba(255, 255, 255, 0.1);
            --shadow-lg: rgba(255, 255, 255, 0.15);

            /* CTA Section Variables for Dark Mode */
            --cta-background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            --cta-text-color: var(--text-dark);
            --cta-description-color: var(--text-light);
        }

        /* Font classes */
        .font-inter {
            font-family: 'Inter', sans-serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        .font-light {
            font-weight: 300;
        }

        .font-normal {
            font-weight: 400;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-extrabold {
            font-weight: 800;
        }

        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--white);
            overflow-x: hidden;
        }

        /* Page Loader */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #e3fff6 0%, #c6dbff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: opacity 0.5s ease;
        }

        .page-loader.loaded {
            opacity: 0;
            pointer-events: none;
        }

        .loader-content {
            text-align: center;
            color: var(--white);
        }

        .loader-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        .loader-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 1.1rem;
            animation: fadeInOut 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        /* Navigation */
        .main-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: var(--transition);
        }

        .main-nav.scrolled {
            padding: 0.5rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px var(--shadow-medium);
        }

        [data-theme="dark"] .main-nav {
            background: rgba(26, 32, 44, 0.95);
            border-bottom-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .main-nav.scrolled {
            background: rgba(26, 32, 44, 0.98);
        }

        .nav-container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 1.5rem;
            font-weight: 700;
            transition: var(--transition);
        }

        .nav-brand:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color);
            text-decoration: none;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .theme-toggle {
            background: none;
            border: 2px solid var(--text-light);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
            margin-left: 1rem;
        }

        .theme-toggle:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: scale(1.1);
        }

        /* Sections */
        .section-fullscreen {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 6rem 0;
        }

        .section-hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--background-gradient);
            padding: 8rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 2rem;
            width: 100%;
        }

        /* Typography */
        .hero-subtitle {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 4rem);
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            color: white;
            padding: 0.2em 0.5em;
            border-radius: 8px;
            position: relative;
            display: inline-block;
            transform: skew(-8deg);
            margin: 0 0.2em;
            box-shadow: 0 4px 15px rgba(107, 182, 255, 0.3);
            animation: skewFloat 6s ease-in-out infinite;
        }

        .hero-title .highlight::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
            animation: underlineExpand 2s ease-out 1s forwards;
        }

        @keyframes underlineExpand {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes skewFloat {

            0%,
            100% {
                transform: skew(-8deg) translateY(0px) scale(1);
                box-shadow: 0 4px 15px rgba(107, 182, 255, 0.3);
            }

            25% {
                transform: skew(-6deg) translateY(-2px) scale(1.02);
                box-shadow: 0 6px 20px rgba(107, 182, 255, 0.4);
            }

            50% {
                transform: skew(-10deg) translateY(0px) scale(1);
                box-shadow: 0 4px 15px rgba(107, 182, 255, 0.3);
            }

            75% {
                transform: skew(-6deg) translateY(-1px) scale(1.01);
                box-shadow: 0 5px 18px rgba(107, 182, 255, 0.35);
            }
        }

        .hero-description {
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 600px;
            line-height: 1.8;
        }

        .section-subtitle {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: clamp(2rem, 4vw, 3rem);
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .section-description {
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 700px;
            line-height: 1.7;
        }

        /* Buttons */
        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: var(--white);
            text-decoration: none;
            border-radius: var(--border-radius-lg);
            font-weight: 600;
            font-size: 1rem;
            transition: var(--transition);
            margin-right: 1rem;
            margin-bottom: 1rem;
            border: 2px solid var(--primary-color);
        }

        .btn-cta:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--white);
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(78, 205, 196, 0.3);
        }

        .btn-cta-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-cta-outline:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        .btn-cta-white {
            background: var(--white);
            color: var(--primary-color);
            border-color: var(--white);
        }

        .btn-cta-white:hover {
            background: var(--background-light);
            color: var(--primary-color);
            border-color: var(--background-light);
        }

        /* Cards */
        .stats-card {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: var(--border-radius-xl);
            text-align: center;
            box-shadow: 0 10px 40px var(--shadow-medium);
            transition: var(--transition);
            border: 1px solid rgba(78, 205, 196, 0.1);
            width: 100%;
            max-width: 280px;
        }

        .stats-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px var(--shadow-lg);
        }

        .stats-number {
            display: block;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--text-light);
            font-size: 1rem;
            margin: 0;
        }

        .feature-card {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: var(--border-radius-xl);
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(78, 205, 196, 0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px var(--shadow-lg);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .team-card {
            background: var(--white);
            padding: 2.5rem 2rem;
            border-radius: var(--border-radius-xl);
            text-align: center;
            transition: var(--transition);
            border: 1px solid rgba(78, 205, 196, 0.1);
            max-width: 350px;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .team-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px var(--shadow-lg);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            overflow: hidden;
            border: 4px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            background: var(--background-light);
            transition: var(--transition);
        }

        .team-card:hover .team-avatar {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }

        .team-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .team-title {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .team-description {
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            color: var(--text-light);
            line-height: 1.6;
            flex-grow: 1;
        }

        /* Images */
        .image-container {
            position: relative;
            overflow: hidden;
        }

        .image-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--background-light);
        }

        .placeholder-gradient {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(58, 169, 192, 0.1) 50%, transparent 70%);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .lazy-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.8s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-description {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .btn-cta {
                display: block;
                text-align: center;
                margin-bottom: 1rem;
                margin-right: 0;
            }

            .stats-card,
            .feature-card,
            .team-card {
                margin-bottom: 2rem;
            }

            .nav-container {
                padding: 0 1rem;
            }

            .hero-content,
            .section-fullscreen>div {
                padding: 0 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }

            .section-fullscreen {
                padding: 4rem 0;
            }

            .section-hero {
                padding: 6rem 0 2rem;
            }
        }

        /* Dark theme adjustments */
        [data-theme="dark"] .stats-card,
        [data-theme="dark"] .feature-card,
        [data-theme="dark"] .team-card {
            background: var(--white);
            border-color: rgba(255, 255, 255, 0.1);
        }

        [data-theme="dark"] .image-placeholder {
            background: var(--background-light);
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Focus states for accessibility */
        .nav-link:focus,
        .btn-cta:focus,
        .theme-toggle:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --shadow-sm: rgba(0, 0, 0, 0.3);
                --shadow-medium: rgba(0, 0, 0, 0.4);
                --shadow-lg: rgba(0, 0, 0, 0.5);
            }
        }
    </style>

</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <img class="loader-logo" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                alt="DjibMarket Loader Logo" />
            <div class="loader-text">Loading Amazing Experience...</div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="nav-container">
            <a href="{{ route('buyer.home') }}" class="nav-brand">
                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket Logo"
                    style="height: 40px; margin-right: 10px;">
                <span class="font-poppins font-bold">DjibMarket</span>
            </a>

            <div style="display: flex; align-items: center;">
                <ul class="nav-menu">
                    <li><a href="#hero" class="nav-link active">About</a></li>
                    <li><a href="{{ route('buyer.home') }}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('vendors.index') }}" class="nav-link">Vendors</a></li>
                    <li><a href="#stats" class="nav-link">Stats</a></li>
                    <li><a href="#mission" class="nav-link">Mission</a></li>
                    <li><a href="#features" class="nav-link">Features</a></li>
                    <li><a href="#team" class="nav-link">Team</a></li>
                </ul>

                <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="section-hero">
        <div class="hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="hero-subtitle gsap-slide-down">Discover DjibMarket</h2>
                    <h1 class="hero-title gsap-fade-up">The Future of <span class="highlight">Digital Commerce</span>
                        in
                        Djibouti</h1>
                    <p class="hero-description gsap-fade-up">
                        Experience the revolution in e-commerce with DjibMarket. We connect passionate buyers with
                        verified sellers through cutting-edge technology, creating a trusted marketplace that empowers
                        local businesses and transforms how Djibouti shops online.
                    </p>
                    <div class="gsap-scale-in">
                        <a href="{{ route('buyer.home') }}" class="btn-cta">
                            <span>Visit Marketplace</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('vendors.index') }}" class="btn-cta btn-cta-outline">
                            <span>Browse Vendors</span>
                            <i class="fas fa-store"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center gsap-fade-right">
                        <div class="image-container"
                            style="width: 100%; height: 500px; border-radius: var(--border-radius-lg); box-shadow: 0 20px 60px var(--shadow-medium);">
                            <div class="image-placeholder">
                                <div class="placeholder-gradient"></div>
                                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket Logo"
                                    style="width: 120px; height: auto; opacity: 0.6;">
                            </div>
                            <img data-src="{{ asset('assets/imgs/about-us/digital-marketplace.jpeg') }}"
                                alt="DjibMarket digital marketplace" class="lazy-image" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="section-fullscreen" style="background: var(--white);">
        <div style="max-width: var(--max-width); margin: 0 auto; padding: 0 2rem;">
            <div class="text-center mb-5">
                <h3 class="section-subtitle scroll-animate">Our Success Story</h3>
                <h2 class="section-title scroll-animate">Numbers That Speak Volumes</h2>
                <p class="section-description scroll-animate mx-auto">Our growth reflects the trust and satisfaction of
                    our community</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card scroll-animate-scale">
                        <span class="stats-number" data-count="50000">0</span>
                        <p class="stats-label">Active Users</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card scroll-animate-scale">
                        <span class="stats-number" data-count="15000">0</span>
                        <p class="stats-label">Products Listed</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card scroll-animate-scale">
                        <span class="stats-number" data-count="500">0</span>
                        <p class="stats-label">Verified Sellers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-5 d-flex justify-content-center">
                    <div class="stats-card scroll-animate-scale">
                        <span class="stats-number" data-count="99">0</span>
                        <p class="stats-label">Customer Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section id="mission" class="section-fullscreen" style="background: var(--background-light);">
        <div style="max-width: var(--max-width); margin: 0 auto; padding: 0 2rem;">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="mb-5 scroll-animate">
                        <h3 class="section-subtitle">Our Mission</h3>
                        <h2 class="section-title">Empowering Digital Commerce</h2>
                        <p class="section-description" style="max-width: 550px;">
                            At DjibMarket, we're committed to creating an inclusive digital marketplace that empowers
                            local businesses and provides customers with access to quality products and services.
                        </p>
                        <ul class="list-unstyled mt-4" style="color: var(--text-light);">
                            <li class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle me-3 mt-1" style="color: var(--success-color);"></i>
                                <div>
                                    <strong style="color: var(--text-dark);">Innovation:</strong> Continuously
                                    improving
                                    our platform with latest technologies.
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle me-3 mt-1" style="color: var(--success-color);"></i>
                                <div>
                                    <strong style="color: var(--text-dark);">Trust:</strong> Building secure and
                                    reliable marketplace experiences.
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <i class="fas fa-check-circle me-3 mt-1" style="color: var(--success-color);"></i>
                                <div>
                                    <strong style="color: var(--text-dark);">Growth:</strong> Supporting local
                                    businesses to reach new heights.
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-check-circle me-3 mt-1" style="color: var(--success-color);"></i>
                                <div>
                                    <strong style="color: var(--text-dark);">Community:</strong> Fostering connections
                                    between buyers and sellers.
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center scroll-animate">
                        <div class="image-container"
                            style="width: 100%; height: 450px; border-radius: var(--border-radius-lg); box-shadow: 0 20px 60px var(--shadow-medium);">
                            <div class="image-placeholder">
                                <div class="placeholder-gradient"></div>
                            </div>
                            <img data-src="{{ asset('assets/imgs/about-us/digital-commerce-3.jpg') }}"
                                alt="Empowering Digital Commerce" class="lazy-image" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-fullscreen" style="background: var(--background-light);">
        <div style="max-width: var(--max-width); margin: 0 auto; padding: 0 2rem;">
            <div class="text-center mb-5">
                <h3 class="section-subtitle scroll-animate">Why Choose DjibMarket</h3>
                <h2 class="section-title scroll-animate">Built for Modern Commerce</h2>
                <p class="section-description scroll-animate mx-auto">
                    We combine cutting-edge technology with local expertise to deliver an unmatched shopping experience.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card scroll-animate">
                        <div class="feature-icon">🚀</div>
                        <h4 class="font-poppins font-semibold" style="color: var(--text-dark); margin-bottom: 1rem;">
                            Lightning Fast</h4>
                        <p class="font-inter font-light" style="color: var(--text-light);">Experience blazing-fast
                            loading times and seamless navigation. Our optimized platform ensures you find what you need
                            quickly.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card scroll-animate">
                        <div class="feature-icon">🔒</div>
                        <h4 class="font-poppins font-semibold" style="color: var(--text-dark); margin-bottom: 1rem;">
                            Secure Payments</h4>
                        <p class="font-inter font-light" style="color: var(--text-light);">Shop with confidence using
                            our advanced security measures. Your transactions are protected with bank-level encryption.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card scroll-animate">
                        <div class="feature-icon">🌟</div>
                        <h4 class="font-poppins font-semibold" style="color: var(--text-dark); margin-bottom: 1rem;">
                            Quality Guaranteed</h4>
                        <p class="font-inter font-light" style="color: var(--text-light);">Every seller is verified
                            and every product is quality-checked. We maintain the highest standards for your peace of
                            mind.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card scroll-animate">
                        <div class="feature-icon">📱</div>
                        <h4 class="font-poppins font-semibold" style="color: var(--text-dark); margin-bottom: 1rem;">
                            Mobile Optimized</h4>
                        <p class="font-inter font-light" style="color: var(--text-light);">Shop anywhere, anytime with
                            our fully responsive design. Perfect experience across all devices and screen sizes.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card scroll-animate">
                        <div class="feature-icon">🎯</div>
                        <h4 class="font-poppins font-semibold" style="color: var(--text-dark); margin-bottom: 1rem;">
                            Local Focus</h4>
                        <p class="font-inter font-light" style="color: var(--text-light);">Built specifically for
                            Djibouti market needs. We understand local preferences and business requirements.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card scroll-animate">
                        <div class="feature-icon">💬</div>
                        <h4 class="font-poppins font-semibold" style="color: var(--text-dark); margin-bottom: 1rem;">
                            24/7 Support</h4>
                        <p class="font-inter font-light" style="color: var(--text-light);">Our dedicated support team
                            is always ready to help. Get assistance whenever you need it, in your preferred language.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="section-fullscreen" style="background: var(--white); padding-top: 10rem;">
        <div style="max-width: var(--max-width); margin: 0 auto; padding: 0 2rem;">
            <div class="text-center mb-5">
                <h3 class="section-subtitle scroll-animate">Our Team</h3>
                <h2 class="section-title scroll-animate">Meet the Innovators</h2>
                <p class="section-description scroll-animate mx-auto">
                    Our diverse team of experts is passionate about transforming e-commerce in Djibouti. Together, we're
                    building the future of digital commerce.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center align-items-stretch">
                    <div class="team-card scroll-animate">
                        <div class="team-avatar">
                            👨‍💼
                        </div>
                        <h4 class="team-name">Mohamed Zaki</h4>
                        <p class="team-title">Chief Executive Officer</p>
                        <p class="team-description">
                            Visionary leader with 15+ years in e-commerce, driving DjibMarket's mission to revolutionize
                            digital commerce in the region.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center align-items-stretch">
                    <div class="team-card scroll-animate">
                        <div class="team-avatar">
                            👩‍💻
                        </div>
                        <h4 class="team-name">Neima Saleh</h4>
                        <p class="team-title">Chief Technology Officer</p>
                        <p class="team-description">
                            Tech innovator ensuring our platform stays at the cutting edge of e-commerce technology and
                            user experience.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center align-items-stretch">
                    <div class="team-card scroll-animate">
                        <div class="team-avatar">
                            👨‍🎨
                        </div>
                        <h4 class="team-name">Saba Nabil</h4>
                        <p class="team-title">Head of Operations</p>
                        <p class="team-description">
                            Operations expert streamlining processes to ensure smooth transactions and exceptional
                            customer experiences.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-fullscreen"
        style="background: var(--cta-background); color: var(--cta-text-color); position: relative; overflow: hidden;">
        <div style="max-width: var(--max-width); margin: 0 auto; padding: 0 2rem; text-align: center;">
            <!-- Background Pattern -->
            <div
                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;50&quot; cy=&quot;50&quot; r=&quot;2&quot; fill=&quot;currentColor&quot;/></svg>') repeat; animation: float 30s linear infinite;">
            </div>

            <h2 class="section-title scroll-animate font-poppins font-extrabold"
                style="color: var(--cta-text-color);">
                Ready to Join DjibMarket?
            </h2>
            <p class="section-description scroll-animate mx-auto mb-4 font-inter font-light"
                style="color: var(--cta-description-color);">
                Whether you're looking to buy quality products or grow your business by selling online, DjibMarket is
                your gateway to digital commerce success.
            </p>
            <div class="scroll-animate">
                <a href="{{ route('buyer.home') }}" class="btn-cta">
                    <span>Start Shopping</span>
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="{{ route('vendors.index') }}" class="btn-cta btn-cta-outline">
                    <span>Become a Seller</span>
                    <i class="fas fa-rocket"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    {{-- 
        Note: The included footer might have styling issues as this page is standalone 
        and does not inherit the main app's CSS. Custom styling might be needed.
    --}}
    @include('layouts.app.partials.buyer.footer')

    <!-- GSAP and Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollToPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Performance optimization
            const isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // Page Loader
            const pageLoader = document.getElementById('pageLoader');
            window.addEventListener('load', () => {
                setTimeout(() => {
                    pageLoader.classList.add('loaded');
                    setTimeout(() => pageLoader.style.display = 'none', 500);
                }, 800);
            });

            // GSAP Configuration
            gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

            // Navigation
            const mainNav = document.getElementById('mainNav');
            ScrollTrigger.create({
                start: "top -80",
                end: 99999,
                toggleClass: {
                    className: "scrolled",
                    targets: mainNav
                }
            });

            // Theme Toggle
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const savedTheme = localStorage.getItem('theme') || 'light';

            document.documentElement.setAttribute('data-theme', savedTheme);
            themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            });

            // Enhanced Lazy Loading
            const lazyImages = document.querySelectorAll('img.lazy-image');
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.onload = () => {
                                gsap.to(img, {
                                    opacity: 1,
                                    duration: 0.8
                                });
                                const placeholder = img.parentNode.querySelector(
                                    '.image-placeholder');
                                if (placeholder) {
                                    gsap.to(placeholder, {
                                        opacity: 0,
                                        duration: 0.5
                                    });
                                }
                            };
                            img.src = img.dataset.src;
                            imageObserver.unobserve(img);
                        }
                    });
                });
                lazyImages.forEach(img => imageObserver.observe(img));
            }

            // GSAP Animations (only if motion is not reduced)
            if (!isReducedMotion) {
                // Hero Section Animations
                gsap.timeline({
                        delay: 1
                    })
                    .from('.gsap-slide-down', {
                        y: -30,
                        opacity: 0,
                        duration: 0.8,
                        ease: "back.out(1.7)"
                    })
                    .from('.gsap-fade-up', {
                        y: 50,
                        opacity: 0,
                        duration: 1,
                        stagger: 0.3,
                        ease: "power2.out"
                    }, '-=0.6')
                    .from('.gsap-scale-in', {
                        scale: 0.8,
                        opacity: 0,
                        duration: 0.6,
                        ease: "back.out(1.7)"
                    }, '-=0.3')
                    .from('.gsap-fade-right', {
                        x: 100,
                        opacity: 0,
                        duration: 1.2,
                        ease: "power2.out"
                    }, '-=1');

                // Scroll-triggered animations
                gsap.utils.toArray('.scroll-animate').forEach((element) => {
                    gsap.fromTo(element, {
                        y: 50,
                        opacity: 0
                    }, {
                        y: 0,
                        opacity: 1,
                        duration: 0.8,
                        ease: "power2.out",
                        scrollTrigger: {
                            trigger: element,
                            start: "top 80%",
                            end: "bottom 20%",
                            toggleActions: "play none none reverse"
                        }
                    });
                });

                gsap.utils.toArray('.scroll-animate-scale').forEach((element) => {
                    gsap.fromTo(element, {
                        scale: 0.8,
                        opacity: 0
                    }, {
                        scale: 1,
                        opacity: 1,
                        duration: 0.6,
                        ease: "back.out(1.7)",
                        scrollTrigger: {
                            trigger: element,
                            start: "top 80%",
                            toggleActions: "play none none reverse"
                        }
                    });
                });

                // Feature Cards Hover
                document.querySelectorAll('.feature-card, .stats-card').forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        gsap.to(card, {
                            y: -8,
                            scale: 1.02,
                            duration: 0.3,
                            ease: "power2.out"
                        });
                    });
                    card.addEventListener('mouseleave', () => {
                        gsap.to(card, {
                            y: 0,
                            scale: 1,
                            duration: 0.3,
                            ease: "power2.out"
                        });
                    });
                });
            }

            // Animated Counters
            const animateCounters = () => {
                const counters = document.querySelectorAll('[data-count]');
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    const isPercentage = counter.closest('.stats-card')?.querySelector('.stats-label')
                        ?.textContent?.includes('Satisfaction');

                    const counterAnimation = {
                        value: 0
                    };

                    const counterObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                gsap.to(counterAnimation, {
                                    value: target,
                                    duration: 2,
                                    ease: "power2.out",
                                    onUpdate: () => {
                                        const currentValue = Math.floor(
                                            counterAnimation.value);
                                        counter.textContent = currentValue
                                            .toLocaleString() + (
                                                isPercentage ? '%' : '');
                                    }
                                });
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

            // Smooth scrolling for nav links
            document.querySelectorAll('.nav-link[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const target = document.querySelector(targetId);
                    if (target) {
                        gsap.to(window, {
                            duration: 1.2,
                            scrollTo: {
                                y: target,
                                offsetY: 80
                            },
                            ease: "power2.inOut"
                        });

                        // Update active nav link
                        document.querySelectorAll('.nav-link').forEach(link => {
                            link.classList.remove('active');
                        });
                        this.classList.add('active');
                    }
                });
            });

            // Navigation active state based on scroll position
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link[href^="#"]');

            const observeNavigation = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const currentSection = entry.target.getAttribute('id');
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href') === `#${currentSection}`) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, {
                threshold: 0.3,
                rootMargin: '-80px 0px -60% 0px'
            });

            sections.forEach(section => {
                observeNavigation.observe(section);
            });

            // Performance monitoring
            if ('PerformanceObserver' in window) {
                const perfObserver = new PerformanceObserver((list) => {
                    list.getEntries().forEach((entry) => {
                        if (entry.entryType === 'largest-contentful-paint') {
                            console.log('LCP:', entry.startTime);
                        }
                    });
                });

                perfObserver.observe({
                    entryTypes: ['largest-contentful-paint']
                });
            }
        });
    </script>
</body>

</html>
