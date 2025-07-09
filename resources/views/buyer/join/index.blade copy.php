<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Join DjibMarket Partners</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/template/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .join-container {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 0;
            min-height: 100vh;
            position: relative;
        }

        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 60;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 12px;
            padding: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .flex {
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 400px;
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: white;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .sidebar-header {
            padding: 32px 24px;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
            background: rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .logo-container h2 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.025em;
            background: linear-gradient(135deg, #ffffff 0%, #e2e8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-content {
            flex: 1;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .service-item {
            width: 100%;
            text-align: left;
            padding: 18px 16px;
            border-radius: 12px;
            background: transparent;
            border: none;
            color: #cbd5e1;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin: 4px 0;
            position: relative;
            overflow: hidden;
        }

        .service-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 12px;
        }

        .service-item:hover {
            background: rgba(71, 85, 105, 0.3);
            color: white;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .service-item:hover::before {
            opacity: 1;
        }

        .service-item.active {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            transform: translateX(6px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .service-item.active::before {
            opacity: 0;
        }

        .service-indicator {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2px;
            background: rgba(255, 255, 255, 0.15);
            flex-shrink: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .service-item:hover .service-indicator {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
        }

        .service-item.active .service-indicator {
            background: rgba(255, 255, 255, 0.95);
            color: #10b981;
            transform: scale(1.15);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .service-info {
            flex: 1;
        }

        .service-info h3 {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 6px;
            transition: all 0.3s ease;
        }

        .service-info p {
            font-size: 13px;
            opacity: 0.75;
            line-height: 1.5;
            transition: all 0.3s ease;
        }

        .service-item:hover .service-info h3 {
            font-weight: 700;
        }

        .service-item:hover .service-info p {
            opacity: 0.9;
        }

        .service-item.active .service-info h3 {
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .service-item.active .service-info p {
            opacity: 0.95;
            color: rgba(255, 255, 255, 0.95);
        }

        .sidebar-footer {
            padding: 24px;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
        }

        .back-button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            padding: 12px 16px;
            background: transparent;
            border: none;
            color: #cbd5e1;
            cursor: pointer;
            border-radius: 6px;
            transition: all 0.2s;
            font-family: inherit;
        }

        .back-button:hover {
            background: #475569;
            color: white;
        }

        .help-link {
            margin-top: 16px;
            text-align: center;
        }

        .help-link button {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 14px;
            cursor: pointer;
            font-family: inherit;
        }

        .help-link button:hover {
            color: #cbd5e1;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 400px;
            padding: 40px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            position: relative;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23f1f5f9" fill-opacity="0.4"><circle cx="30" cy="30" r="1.5"/></g></svg>');
            pointer-events: none;
        }

        .content-container {
            /* max-width: 900px; */
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .content-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .content-header h1 {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            letter-spacing: -0.025em;
            line-height: 1.2;
        }

        .content-header p {
            color: #64748b;
            font-size: 18px;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Service Card Styles */
        .service-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.5);
            border: none;
            padding: 0;
            overflow: hidden;
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .service-card.zoom-effect {
            transform: scale(1.02);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.8);
        }

        .card-header {
            padding: 32px 32px 20px 32px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
        }

        .card-header-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .card-title-section h2 {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            letter-spacing: -0.025em;
        }

        .card-title-section p {
            color: #64748b;
            font-size: 17px;
            line-height: 1.6;
            font-weight: 400;
        }

        .availability-badge {
            background: #d1fae5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .coming-soon-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .card-content {
            padding: 0 32px 32px 32px;
        }

        .features-section {
            margin-bottom: 24px;
        }

        .features-section h4 {
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .feature-item span {
            color: #374151;
            font-size: 16px;
        }

        .button-group {
            display: flex;
            gap: 16px;
            padding-top: 16px;
        }

        .btn {
            padding: 8px 32px;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            font-size: 14px;
            border: none;
        }

        .btn-primary {
            color: white;
            background: #3b82f6;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-primary.green {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-primary.green:hover {
            background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.5);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
            color: #111827;
        }

        .btn-disabled {
            background: #9ca3af;
            color: white;
            cursor: not-allowed;
        }

        .btn-disabled:hover {
            background: #9ca3af;
        }

        /* Security Notice */
        .security-notice {
            margin-top: 40px;
            padding: 20px 24px;
            background: rgba(239, 246, 255, 0.8);
            border-radius: 16px;
            border: 1px solid rgba(219, 234, 254, 0.6);
            display: flex;
            align-items: center;
            gap: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .security-icon {
            width: 16px;
            height: 16px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .security-dot {
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .security-notice p {
            color: #1e40af;
            font-size: 14px;
        }

        .coming-soon-text {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
            font-size: 18px;
            font-weight: 500;
        }

        /* Services Grid Styles */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .service-card-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: .8rem;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.5);
            border: none;
            padding: 0;
            overflow: hidden;
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }

        .service-card-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.8);
        }

        .service-card-item.selected {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -5px rgba(16, 185, 129, 0.3),
                0 0 0 2px #10b981;
        }

        .service-card-header {
            padding: 24px 24px 16px 24px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .service-card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .service-card-item:hover .service-card-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
        }

        .service-card-item.selected .service-card-icon {
            transform: scale(1.1);
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
        }

        .service-card-content {
            padding: 0 24px 24px 24px;
        }

        .service-card-content h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            letter-spacing: -0.025em;
        }

        .service-card-content p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .service-card-btn {
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .service-card-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.5);
        }

        .service-card-btn.disabled {
            background: #9ca3af;
            cursor: not-allowed;
            box-shadow: none;
        }

        .service-card-btn.disabled:hover {
            background: #9ca3af;
            transform: none;
            box-shadow: none;
        }

        .service-detail-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.5);
            border: none;
            padding: 0;
            overflow: hidden;
            backdrop-filter: blur(20px);
            margin-bottom: 40px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                width: 100%;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
                width: 100%;
            }

            .content-header h1 {
                font-size: 32px;
            }

            .content-header p {
                font-size: 16px;
            }

            .card-header {
                padding: 24px 20px 16px 20px;
            }

            .card-content {
                padding: 0 20px 24px 20px;
            }

            .card-title-section h2 {
                font-size: 24px;
            }

            .card-header-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .service-card.zoom-effect {
                transform: scale(1.01);
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .service-card-item:hover {
                transform: translateY(-4px) scale(1.01);
            }

            .service-card-item.selected {
                transform: translateY(-4px) scale(1.01);
            }
        }
    </style>
</head>

<body>
    <div class="join-container">
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
        <div class="flex">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-header">
                    <div class="logo-container">
                        <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket Logo"
                            class="logo-img">
                        <h2>DjibMarket Partners</h2>
                    </div>
                </div>

                <div class="sidebar-content">
                    <button class="service-item" data-service="djibmarket-com">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <rect x="9" y="9" width="6" height="6" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>Sell on DjibMarket.com</h3>
                            <p>Sell your products on DjibMarket online marketplace</p>
                        </div>
                    </button>

                    <button class="service-item" data-service="djibmarket-food">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2" />
                                <path d="M7 2v20" />
                                <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>DjibMarket Food</h3>
                            <p>Sell with DjibMarket Food delivery service</p>
                        </div>
                    </button>

                    <button class="service-item" data-service="djibmarket-ads">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M7 7h.01" />
                                <path d="M7 3h5c3 0 5 1 5 5v1" />
                                <path d="M21 9.5l-5.5 5.5h-4" />
                                <path d="M12 14l-6-6" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>DjibMarket Ads</h3>
                            <p>Advertise your brand/products with DjibMarket</p>
                        </div>
                    </button>

                    <button class="service-item" data-service="djibmarket-express">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12,6 12,12 16,14" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>DjibMarket Express</h3>
                            <p>Sell groceries & essentials, delivered fast</p>
                        </div>
                    </button>

                    <button class="service-item" data-service="djibmarket-ambassadors">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>DjibMarket Ambassadors</h3>
                            <p>Be an ambassador for DjibMarket</p>
                        </div>
                    </button>

                    <button class="service-item" data-service="djibmarket-wholesale">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <path d="M16 10a4 4 0 0 1-8 0" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>DjibMarket Wholesale</h3>
                            <p>Sell your products wholesale on DjibMarket</p>
                        </div>
                    </button>
                </div>

                <div class="sidebar-footer">
                    <button class="back-button" onclick="window.location.href='{{ route('buyer.home') }}'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M19 12H5" />
                            <path d="M12 19l-7-7 7-7" />
                        </svg>
                        Go back to DjibMarket
                    </button>
                    <div class="help-link">
                        <button onclick="window.location.href='{{ route('buyer.contact') }}'">Need help?</button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="content-container">
                    <div class="content-header">
                        <h1>Choose Your Service</h1>
                        <p>Select the DjibMarket service that best fits your business needs</p>
                    </div>

                    <!-- Services Grid -->
                    <div class="services-grid">
                        <!-- DjibMarket.com Card -->
                        <div class="service-card-item" data-service="djibmarket-com">
                            <div class="service-card-header">
                                <div class="service-card-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2"
                                            ry="2" />
                                        <rect x="9" y="9" width="6" height="6" />
                                    </svg>
                                </div>
                                <div class="availability-badge">Available Now</div>
                            </div>
                            <div class="service-card-content">
                                <h3>Sell on DjibMarket.com</h3>
                                <p>Sell your products on DjibMarket online marketplace</p>
                                <button class="service-card-btn">Start Selling</button>
                            </div>
                        </div>

                        <!-- DjibMarket Food Card -->
                        <div class="service-card-item" data-service="djibmarket-food">
                            <div class="service-card-header">
                                <div class="service-card-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2" />
                                        <path d="M7 2v20" />
                                        <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
                                    </svg>
                                </div>
                                <div class="coming-soon-badge">Coming Soon</div>
                            </div>
                            <div class="service-card-content">
                                <h3>DjibMarket Food</h3>
                                <p>Sell with DjibMarket Food delivery service</p>
                                <button class="service-card-btn disabled">Coming Soon</button>
                            </div>
                        </div>

                        <!-- DjibMarket Ads Card -->
                        <div class="service-card-item" data-service="djibmarket-ads">
                            <div class="service-card-header">
                                <div class="service-card-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M7 7h.01" />
                                        <path d="M7 3h5c3 0 5 1 5 5v1" />
                                        <path d="M21 9.5l-5.5 5.5h-4" />
                                        <path d="M12 14l-6-6" />
                                    </svg>
                                </div>
                                <div class="coming-soon-badge">Coming Soon</div>
                            </div>
                            <div class="service-card-content">
                                <h3>DjibMarket Ads</h3>
                                <p>Advertise your brand/products with DjibMarket</p>
                                <button class="service-card-btn disabled">Coming Soon</button>
                            </div>
                        </div>

                        <!-- DjibMarket Express Card -->
                        <div class="service-card-item" data-service="djibmarket-express">
                            <div class="service-card-header">
                                <div class="service-card-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12,6 12,12 16,14" />
                                    </svg>
                                </div>
                                <div class="coming-soon-badge">Coming Soon</div>
                            </div>
                            <div class="service-card-content">
                                <h3>DjibMarket Express</h3>
                                <p>Sell groceries & essentials, delivered fast</p>
                                <button class="service-card-btn disabled">Coming Soon</button>
                            </div>
                        </div>

                        <!-- DjibMarket Ambassadors Card -->
                        <div class="service-card-item" data-service="djibmarket-ambassadors">
                            <div class="service-card-header">
                                <div class="service-card-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <div class="coming-soon-badge">Coming Soon</div>
                            </div>
                            <div class="service-card-content">
                                <h3>DjibMarket Ambassadors</h3>
                                <p>Be an ambassador for DjibMarket</p>
                                <button class="service-card-btn disabled">Coming Soon</button>
                            </div>
                        </div>

                        <!-- DjibMarket Wholesale Card -->
                        <div class="service-card-item" data-service="djibmarket-wholesale">
                            <div class="service-card-header">
                                <div class="service-card-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                        <line x1="3" y1="6" x2="21" y2="6" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                </div>
                                <div class="coming-soon-badge">Coming Soon</div>
                            </div>
                            <div class="service-card-content">
                                <h3>DjibMarket Wholesale</h3>
                                <p>Sell your products wholesale on DjibMarket</p>
                                <button class="service-card-btn disabled">Coming Soon</button>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Service View -->
                    <div class="service-detail-card" id="service-detail-card" style="display: none;">
                        <!-- Dynamic detailed content will be inserted here -->
                    </div>

                    <div class="security-notice">
                        <div class="security-icon">
                            <div class="security-dot"></div>
                        </div>
                        <p>We use bank-level, 256-bit encryption to keep your data safe.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Service data
        const serviceData = {
            "djibmarket-com": {
                title: "Sell on DjibMarket.com",
                description: "Start selling your products on DjibMarket's online marketplace and reach thousands of customers across Djibouti.",
                features: [
                    "Access to customers across Djibouti",
                    "Easy product listing process",
                    "Secure payment processing",
                    "Professional seller support",
                ],
                buttonText: "Start Selling",
                color: "green",
                available: true,
            },
            "djibmarket-food": {
                title: "DjibMarket Food",
                description: "Partner with DjibMarket Food to deliver delicious meals to customers in Djibouti.",
                features: [
                    "Food delivery platform",
                    "Restaurant partnership program",
                    "Real-time order management",
                    "Marketing support",
                ],
                buttonText: "Start Selling",
                color: "green",
                available: false,
            },
            "djibmarket-ads": {
                title: "DjibMarket Ads",
                description: "Advertise your brand and products with DjibMarket's advertising platform to boost visibility.",
                features: [
                    "Targeted advertising campaigns",
                    "Performance analytics",
                    "Brand promotion tools",
                    "Sponsored product listings",
                ],
                buttonText: "Advertise",
                color: "green",
                available: false,
            },
            "djibmarket-express": {
                title: "DjibMarket Express",
                description: "Sell groceries and essentials with ultra-fast delivery in Djibouti City.",
                features: [
                    "Same-day delivery service",
                    "Grocery and essentials focus",
                    "Available in Djibouti City",
                    "Quick inventory turnover",
                ],
                buttonText: "Start Selling",
                color: "green",
                available: false,
            },
            "djibmarket-ambassadors": {
                title: "DjibMarket Ambassadors",
                description: "Become a DjibMarket ambassador and earn rewards by promoting DjibMarket services.",
                features: [
                    "Flexible earning opportunities",
                    "Community building",
                    "Brand representation",
                    "Performance-based rewards",
                ],
                buttonText: "Start Promoting",
                color: "green",
                available: false,
            },
            "djibmarket-wholesale": {
                title: "DjibMarket Wholesale",
                description: "Join DjibMarket's wholesale marketplace and sell your products to businesses and retailers.",
                features: [
                    "B2B marketplace access",
                    "Bulk order management",
                    "Business customer base",
                    "Wholesale pricing tools",
                ],
                buttonText: "Start Selling",
                color: "green",
                available: false,
            },
        };

        // Current active service
        let activeService = null;

        // Initialize the application
        function init() {
            setupEventListeners();
            // No auto-selection of services
        }

        // Setup event listeners
        function setupEventListeners() {
            // Service item clicks (sidebar)
            const serviceItems = document.querySelectorAll(".service-item");
            serviceItems.forEach((item) => {
                item.addEventListener("click", () => {
                    const serviceId = item.getAttribute("data-service");
                    setActiveService(serviceId);
                    showServiceDetail(serviceId);
                });
            });

            // Service card clicks (main content)
            const serviceCards = document.querySelectorAll(".service-card-item");
            serviceCards.forEach((card) => {
                card.addEventListener("click", () => {
                    const serviceId = card.getAttribute("data-service");
                    setActiveService(serviceId);
                    showServiceDetail(serviceId);
                });
            });

            // Service card button clicks
            const serviceCardBtns = document.querySelectorAll(".service-card-btn");
            serviceCardBtns.forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    e.stopPropagation(); // Prevent card click
                    if (!btn.classList.contains('disabled')) {
                        startSelling();
                    }
                });
            });
        }

        // Set active service
        function setActiveService(serviceId) {
            // Remove active class from all sidebar items
            const serviceItems = document.querySelectorAll(".service-item");
            serviceItems.forEach((item) => {
                item.classList.remove("active");
            });

            // Remove selected class from all service cards
            const serviceCards = document.querySelectorAll(".service-card-item");
            serviceCards.forEach((card) => {
                card.classList.remove("selected");
            });

            if (serviceId) {
                // Add active class to selected sidebar item
                const activeItem = document.querySelector(`.service-item[data-service="${serviceId}"]`);
                if (activeItem) {
                    activeItem.classList.add("active");
                }

                // Add selected class to selected service card
                const activeCard = document.querySelector(`.service-card-item[data-service="${serviceId}"]`);
                if (activeCard) {
                    activeCard.classList.add("selected");
                }
            }

            // Update active service
            activeService = serviceId;
        }



        // Show service detail
        function showServiceDetail(serviceId) {
            const service = serviceData[serviceId];
            const detailCard = document.getElementById("service-detail-card");

            if (!service) {
                detailCard.style.display = "none";
                return;
            }

            if (!service.available) {
                const cardHTML = `
                    <div class="card-header">
                        <div class="card-header-content">
                            <div class="card-title-section">
                                <h2>${service.title}</h2>
                                <p>${service.description}</p>
                            </div>
                            <div class="coming-soon-badge">
                                Coming Soon
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="coming-soon-text">
                            <p>This service is coming soon! Stay tuned for updates.</p>
                        </div>
                    </div>
                `;
                detailCard.innerHTML = cardHTML;
                detailCard.style.display = "block";
                return;
            }

            const featuresHTML = service.features
                .map(
                    (feature) =>
                    `<div class="feature-item">
                        <div class="feature-dot"></div>
                        <span>${feature}</span>
                    </div>`
                )
                .join("");

            const cardHTML = `
                <div class="card-header">
                    <div class="card-header-content">
                        <div class="card-title-section">
                            <h2>${service.title}</h2>
                            <p>${service.description}</p>
                        </div>
                        <div class="availability-badge">
                            Available Now
                        </div>
                    </div>
                </div>
                
                <div class="card-content">
                    <div class="features-section">
                        <h4>Key Features:</h4>
                        <div class="features-list">
                            ${featuresHTML}
                        </div>
                    </div>

                    <div class="button-group">
                        <button class="btn btn-primary ${service.color}" onclick="startSelling()">
                            ${service.buttonText}
                        </button>
                        <button class="btn btn-outline" onclick="learnMore()">
                            Learn More
                        </button>
                    </div>
                </div>
            `;

            detailCard.innerHTML = cardHTML;
            detailCard.style.display = "block";

            // Scroll to detail card
            detailCard.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Action functions
        function startSelling() {
            window.location.href = '{{ route('seller.register') }}';
        }

        function learnMore() {
            window.location.href = '{{ route('buyer.about') }}';
        }

        // Initialize when DOM is loaded
        document.addEventListener("DOMContentLoaded", init);

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.classList.toggle("open");
        }

        // Handle window resize for responsive design
        window.addEventListener("resize", () => {
            if (window.innerWidth > 768) {
                const sidebar = document.querySelector(".sidebar");
                sidebar.classList.remove("open");
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector(".sidebar");
            const mobileBtn = document.querySelector(".mobile-menu-btn");

            if (window.innerWidth <= 768 &&
                sidebar.classList.contains('open') &&
                !sidebar.contains(event.target) &&
                !mobileBtn.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>
</body>

</html>
