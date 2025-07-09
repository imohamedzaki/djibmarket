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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
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

        /* Arabic Font Support */
        [lang="ar"] * {
            font-family: "Tajawal", "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        [lang="ar"] .content-header h1,
        [lang="ar"] .featured-service h3,
        [lang="ar"] .section-header h2,
        [lang="ar"] .card-content h3,
        [lang="ar"] .trust-content h4 {
            font-family: "Tajawal", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-weight: 700;
        }

        [lang="ar"] .service-info h3,
        [lang="ar"] .sidebar-header h2 {
            font-family: "Tajawal", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-weight: 600;
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

        /* Language Switcher */
        .language-switcher {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 60;
        }

        .language-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 8px 16px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
        }

        .language-btn:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.2);
            transform: translateY(-1px);
        }

        .language-btn #current-language {
            font-weight: 600;
            color: #1e293b;
            min-width: 24px;
            text-align: center;
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
        }

        .language-btn.open .dropdown-arrow {
            transform: rotate(180deg);
        }

        .language-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.98) 100%);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            padding: 8px;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-width: 180px;
        }

        .language-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .language-option {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border: none;
            border-radius: 10px;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            font-size: 14px;
            text-align: left;
        }

        .language-option:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .language-option.active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            color: #059669;
            font-weight: 600;
        }

        .language-option .flag {
            font-size: 18px;
            width: 24px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .language-option .lang-name {
            flex: 1;
            font-weight: 500;
        }

        .language-option .lang-code {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 600;
            opacity: 0.8;
        }

        .language-option.active .lang-code {
            color: #059669;
            opacity: 1;
        }

        /* RTL Support */
        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
        }

        [dir="rtl"] .main-content {
            margin-left: 0;
            margin-right: 400px;
        }

        [dir="rtl"] .language-switcher {
            right: auto;
            left: 20px;
        }

        [dir="rtl"] .language-dropdown {
            right: auto;
            left: 0;
        }

        [dir="rtl"] .featured-service {
            direction: rtl;
        }

        [dir="rtl"] .featured-highlights {
            justify-content: flex-end;
        }

        [dir="rtl"] .trust-item {
            text-align: right;
        }

        @media (max-width: 768px) {
            [dir="rtl"] .main-content {
                margin-right: 0;
            }

            [dir="rtl"] .language-switcher {
                left: 80px;
                right: auto;
            }
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
            margin-bottom: 48px;
            text-align: center;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 24px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .content-header h1 {
            font-size: 48px;
            font-weight: 900;
            background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            letter-spacing: -0.025em;
            line-height: 1.1;
        }

        .content-header p {
            color: #64748b;
            font-size: 20px;
            font-weight: 100;
            max-width: 700px;
            margin: 0 auto 40px auto;
            line-height: 1.6;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            max-width: 600px;
            margin: 0 auto;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 900;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
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

        /* Bottom Section */
        .bottom-section {
            margin-top: 64px;
        }

        .security-trust {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
            padding: 48px;
            background: rgba(248, 250, 252, 0.8);
            border-radius: 24px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            backdrop-filter: blur(10px);
        }

        .trust-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            text-align: left;
        }

        .trust-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .trust-content h4 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
            letter-spacing: -0.025em;
        }

        .trust-content p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
        }

        .coming-soon-text {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
            font-size: 18px;
            font-weight: 500;
        }

        /* Featured Service Section */
        .featured-service {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 24px;
            padding: 0;
            margin-bottom: 64px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            backdrop-filter: blur(10px);
        }

        .featured-content {
            flex: 1;
            padding: 40px;
        }

        .featured-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .featured-service h3 {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
            letter-spacing: -0.025em;
        }

        .featured-service p {
            color: #64748b;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .featured-highlights {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 32px;
        }

        .highlight {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .featured-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }

        .featured-btn:hover {
            background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(16, 185, 129, 0.5);
        }

        .featured-visual {
            width: 200px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .visual-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
        }

        /* All Services Section */
        .all-services-section {
            margin-bottom: 64px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-header h2 {
            font-size: 36px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
            letter-spacing: -0.025em;
        }

        .section-header p {
            color: #64748b;
            font-size: 18px;
            font-weight: 400;
        }

        /* New Services Grid */
        .services-grid-new {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 24px;
        }

        .service-card-new {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px -8px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 0;
            overflow: hidden;
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .service-card-new:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 48px -8px rgba(0, 0, 0, 0.15);
        }

        .service-card-new.available:hover {
            box-shadow: 0 20px 48px -8px rgba(16, 185, 129, 0.3);
        }

        .service-card-new.selected {
            transform: translateY(-8px);
            box-shadow: 0 20px 48px -8px rgba(16, 185, 129, 0.3);
            border-color: #10b981;
        }

        .card-status {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 2;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.available {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .status-badge.coming-soon {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .card-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            margin: 32px 32px 24px 32px;
            transition: all 0.3s ease;
        }

        .service-card-new.available .card-icon {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
        }

        .service-card-new.available:hover .card-icon {
            transform: scale(1.1);
        }

        .card-content {
            padding: 2rem;
            flex: 1;
        }

        .card-content h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            letter-spacing: -0.025em;
        }

        .card-content p {
            color: #64748b;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            color: #64748b;
            font-size: 14px;
            padding: 4px 0;
            position: relative;
            padding-left: 20px;
        }

        .feature-list li::before {
            content: '•';
            color: #10b981;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        .card-action {
            padding: 24px 32px 32px 32px;
            margin-top: auto;
        }

        .action-btn {
            width: 100%;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .action-btn.primary {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .action-btn.primary:hover {
            background: linear-gradient(135deg, #059669 0%, #0891b2 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.5);
        }

        .action-btn.secondary {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .action-btn.secondary:hover {
            background: #f1f5f9;
            color: #475569;
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

            .language-switcher {
                top: 20px;
                right: 80px;
            }

            .language-btn {
                padding: 6px 12px;
                font-size: 13px;
            }

            .language-dropdown {
                min-width: 160px;
            }

            .language-option {
                padding: 10px 12px;
                font-size: 13px;
            }

            .language-option .flag {
                font-size: 16px;
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
                padding: 24px 16px;
                width: 100%;
            }

            .content-header h1 {
                font-size: 36px;
            }

            .content-header p {
                font-size: 18px;
                margin-bottom: 32px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 24px;
                max-width: 300px;
            }

            .stat-number {
                font-size: 28px;
            }

            .featured-service {
                flex-direction: column;
                margin-bottom: 48px;
            }

            .featured-content {
                padding: 32px 24px;
            }

            .featured-service h3 {
                font-size: 28px;
            }

            .featured-service p {
                font-size: 16px;
            }

            .featured-highlights {
                gap: 12px;
            }

            .featured-visual {
                width: 100%;
                height: 120px;
                padding: 24px;
            }

            .visual-icon {
                width: 80px;
                height: 80px;
            }

            .section-header h2 {
                font-size: 32px;
            }

            .section-header p {
                font-size: 16px;
            }

            .services-grid-new {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .service-card-new {
                margin: 0 8px;
            }

            .card-icon {
                width: 70px;
                height: 70px;
                margin: 24px 24px 20px 24px;
            }

            .card-content {
                padding: 2rem;
            }

            .card-content h3 {
                font-size: 20px;
            }

            .card-content p {
                font-size: 15px;
            }

            .card-action {
                padding: 20px 24px 24px 24px;
            }

            .security-trust {
                grid-template-columns: 1fr;
                gap: 24px;
                padding: 32px 24px;
            }

            .trust-item {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }

            .trust-icon {
                width: 40px;
                height: 40px;
            }

            .service-card-new:hover {
                transform: translateY(-4px);
            }

            .service-card-new.selected {
                transform: translateY(-4px);
            }
        }

        @media (max-width: 480px) {
            .content-header h1 {
                font-size: 32px;
            }

            .content-header p {
                font-size: 16px;
            }

            .featured-service h3 {
                font-size: 24px;
            }

            .featured-btn {
                padding: 14px 24px;
                font-size: 15px;
            }

            .section-header h2 {
                font-size: 28px;
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

        <!-- Language Switcher -->
        <div class="language-switcher">
            <button class="language-btn" onclick="toggleLanguageDropdown()">
                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket"
                    style="width: 20px; height: 20px; object-fit: contain;">
                <span id="current-language">EN</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" class="dropdown-arrow">
                    <polyline points="6,9 12,15 18,9" />
                </svg>
            </button>
            <div class="language-dropdown" id="language-dropdown">
                <button class="language-option active" data-lang="en" data-dir="ltr">
                    <span class="flag">🇺🇸</span>
                    <span class="lang-name">English</span>
                    <span class="lang-code">EN</span>
                </button>
                <button class="language-option" data-lang="fr" data-dir="ltr">
                    <span class="flag">🇫🇷</span>
                    <span class="lang-name">Français</span>
                    <span class="lang-code">FR</span>
                </button>
                <button class="language-option" data-lang="ar" data-dir="rtl">
                    <span class="flag">🇩🇯</span>
                    <span class="lang-name">العربية</span>
                    <span class="lang-code">AR</span>
                </button>
            </div>
        </div>
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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="9" cy="21" r="1" />
                                <circle cx="20" cy="21" r="1" />
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                            </svg>
                        </div>
                        <div class="service-info">
                            <h3>Sell on DjibMarket.com</h3>
                            <p>Sell your products on DjibMarket online marketplace</p>
                        </div>
                    </button>

                    <button class="service-item" data-service="djibmarket-food">
                        <div class="service-indicator">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
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
                    <!-- Enhanced Header Section -->
                    <div class="content-header">
                        <div class="header-badge">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                <path d="M2 17l10 5 10-5" />
                                <path d="M2 12l10 5 10-5" />
                            </svg>
                            Partner With Us
                        </div>
                        <h1>Choose Your Perfect Service</h1>
                        <p>Join thousands of successful partners and grow your business with DjibMarket's comprehensive
                            ecosystem</p>

                        <!-- Stats Section -->
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-number">10K+</div>
                                <div class="stat-label">Active Partners</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">50K+</div>
                                <div class="stat-label">Monthly Orders</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">99.9%</div>
                                <div class="stat-label">Uptime</div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Service Highlight -->
                    <div class="featured-service">
                        <div class="featured-content">
                            <div class="featured-badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="20,6 9,17 4,12" />
                                </svg>
                                Most Popular
                            </div>
                            <h3>Start Selling on DjibMarket.com</h3>
                            <p>Join our flagship marketplace and reach customers across Djibouti with zero setup fees
                            </p>
                            <div class="featured-highlights">
                                <span class="highlight">✨ No setup costs</span>
                                <span class="highlight">📈 Built-in analytics</span>
                                <span class="highlight">🚀 Same-day approval</span>
                            </div>
                            <button class="featured-btn" onclick="startSelling()">
                                Get Started Now
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14" />
                                    <path d="M12 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        <div class="featured-visual">
                            <div class="visual-icon">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.5">
                                    <circle cx="9" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- All Services Section -->
                    <div class="all-services-section">
                        <div class="section-header">
                            <h2>All Services</h2>
                            <p>Explore all the ways you can partner with DjibMarket</p>
                        </div>

                        <!-- Services Grid -->
                        <div class="services-grid-new">
                            <!-- DjibMarket.com Card -->
                            <div class="service-card-new available" data-service="djibmarket-com">
                                <div class="card-status">
                                    <span class="status-badge available">Available Now</span>
                                </div>
                                <div class="card-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="9" cy="21" r="1" />
                                        <circle cx="20" cy="21" r="1" />
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                    </svg>
                                </div>
                                <div class="card-content">
                                    <h3>DjibMarket Marketplace</h3>
                                    <p>Sell your products to thousands of customers across Djibouti</p>
                                    <ul class="feature-list">
                                        <li>Access to customers across Djibouti</li>
                                        <li>Easy product listing process</li>
                                        <li>Secure payment processing</li>
                                        <li>Professional seller support</li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <button class="action-btn primary">Start Selling</button>
                                </div>
                            </div>

                            <!-- DjibMarket Food Card -->
                            <div class="service-card-new coming-soon" data-service="djibmarket-food">
                                <div class="card-status">
                                    <span class="status-badge coming-soon">Coming Soon</span>
                                </div>
                                <div class="card-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2" />
                                        <path d="M7 2v20" />
                                        <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
                                    </svg>
                                </div>
                                <div class="card-content">
                                    <h3>DjibMarket Food</h3>
                                    <p>Partner with our food delivery platform to reach hungry customers</p>
                                    <ul class="feature-list">
                                        <li>Real-time order management</li>
                                        <li>Fast delivery network</li>
                                        <li>Restaurant marketing tools</li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <button class="action-btn secondary">Coming Soon</button>
                                </div>
                            </div>

                            <!-- DjibMarket Ads Card -->
                            <div class="service-card-new coming-soon" data-service="djibmarket-ads">
                                <div class="card-status">
                                    <span class="status-badge coming-soon">Coming Soon</span>
                                </div>
                                <div class="card-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M7 7h.01" />
                                        <path d="M7 3h5c3 0 5 1 5 5v1" />
                                        <path d="M21 9.5l-5.5 5.5h-4" />
                                        <path d="M12 14l-6-6" />
                                    </svg>
                                </div>
                                <div class="card-content">
                                    <h3>DjibMarket Ads</h3>
                                    <p>Advertise your brand and boost visibility across our platform</p>
                                    <ul class="feature-list">
                                        <li>Targeted advertising campaigns</li>
                                        <li>Detailed performance analytics</li>
                                        <li>Professional brand promotion</li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <button class="action-btn secondary">Coming Soon</button>
                                </div>
                            </div>

                            <!-- DjibMarket Express Card -->
                            <div class="service-card-new coming-soon" data-service="djibmarket-express">
                                <div class="card-status">
                                    <span class="status-badge coming-soon">Coming Soon</span>
                                </div>
                                <div class="card-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12,6 12,12 16,14" />
                                    </svg>
                                </div>
                                <div class="card-content">
                                    <h3>DjibMarket Express</h3>
                                    <p>Deliver groceries and essentials with ultra-fast same-day delivery</p>
                                    <ul class="feature-list">
                                        <li>Ultra-fast same-day delivery</li>
                                        <li>Grocery and essentials focus</li>
                                        <li>High inventory turnover</li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <button class="action-btn secondary">Coming Soon</button>
                                </div>
                            </div>

                            <!-- DjibMarket Ambassadors Card -->
                            <div class="service-card-new coming-soon" data-service="djibmarket-ambassadors">
                                <div class="card-status">
                                    <span class="status-badge coming-soon">Coming Soon</span>
                                </div>
                                <div class="card-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    </svg>
                                </div>
                                <div class="card-content">
                                    <h3>Brand Ambassadors</h3>
                                    <p>Represent DjibMarket and earn rewards by growing our community</p>
                                    <ul class="feature-list">
                                        <li>Flexible earning opportunities</li>
                                        <li>Community building programs</li>
                                        <li>Performance-based rewards system</li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <button class="action-btn secondary">Coming Soon</button>
                                </div>
                            </div>

                            <!-- DjibMarket Wholesale Card -->
                            <div class="service-card-new coming-soon" data-service="djibmarket-wholesale">
                                <div class="card-status">
                                    <span class="status-badge coming-soon">Coming Soon</span>
                                </div>
                                <div class="card-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                        <line x1="3" y1="6" x2="21" y2="6" />
                                        <path d="M16 10a4 4 0 0 1-8 0" />
                                    </svg>
                                </div>
                                <div class="card-content">
                                    <h3>Wholesale Platform</h3>
                                    <p>Connect with businesses and retailers for bulk product sales</p>
                                    <ul class="feature-list">
                                        <li>B2B marketplace access</li>
                                        <li>Advanced bulk order management</li>
                                        <li>Business networking tools</li>
                                    </ul>
                                </div>
                                <div class="card-action">
                                    <button class="action-btn secondary">Coming Soon</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Service View -->
                    <div class="service-detail-card" id="service-detail-card" style="display: none;">
                        <!-- Dynamic detailed content will be inserted here -->
                    </div>

                    <!-- Enhanced Security & Support Section -->
                    <div class="bottom-section">
                        <div class="security-trust">
                            <div class="trust-item">
                                <div class="trust-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        <path d="M9 12l2 2 4-4" />
                                    </svg>
                                </div>
                                <div class="trust-content">
                                    <h4>Bank-Level Security</h4>
                                    <p>256-bit encryption protects all your data</p>
                                </div>
                            </div>
                            <div class="trust-item">
                                <div class="trust-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="3" />
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                                    </svg>
                                </div>
                                <div class="trust-content">
                                    <h4>24/7 Support</h4>
                                    <p>Our team is here to help you succeed</p>
                                </div>
                            </div>
                            <div class="trust-item">
                                <div class="trust-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                                    </svg>
                                </div>
                                <div class="trust-content">
                                    <h4>Fast Setup</h4>
                                    <p>Get started in minutes, not days</p>
                                </div>
                            </div>
                        </div>
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
            setupLanguageEventListeners();
            initializeLanguage();
            // No auto-selection of services
        }

        // Setup language event listeners
        function setupLanguageEventListeners() {
            // Language option clicks
            const languageOptions = document.querySelectorAll('.language-option');
            languageOptions.forEach(option => {
                option.addEventListener('click', () => {
                    const langCode = option.querySelector('.lang-code').textContent;
                    const direction = option.dataset.dir;
                    switchLanguage(langCode, '', direction);
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                const languageSwitcher = document.querySelector('.language-switcher');
                const dropdown = document.getElementById('language-dropdown');
                const btn = document.querySelector('.language-btn');

                if (!languageSwitcher.contains(e.target) && dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                    btn.classList.remove('open');
                }
            });
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
            const serviceCards = document.querySelectorAll(".service-card-new");
            serviceCards.forEach((card) => {
                card.addEventListener("click", () => {
                    const serviceId = card.getAttribute("data-service");
                    setActiveService(serviceId);
                    showServiceDetail(serviceId);
                });
            });

            // Service card button clicks
            const serviceCardBtns = document.querySelectorAll(".action-btn");
            serviceCardBtns.forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    e.stopPropagation(); // Prevent card click
                    if (btn.classList.contains('primary') || btn.textContent.includes('Start Selling')) {
                        startSelling();
                    } else if (btn.classList.contains('secondary')) {
                        // Handle "Coming Soon" action for coming soon services
                        notifyMe(btn);
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
            const serviceCards = document.querySelectorAll(".service-card-new");
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
                const activeCard = document.querySelector(`.service-card-new[data-service="${serviceId}"]`);
                if (activeCard) {
                    activeCard.classList.add("selected");
                }
            }

            // Update active service
            activeService = serviceId;
        }

        // Handle coming soon functionality
        function notifyMe(btn) {
            const currentLang = getCookie('selected-language') || 'en';
            const translations = {
                en: {
                    notified: 'Coming Soon',
                    notifyMe: 'Coming Soon'
                },
                fr: {
                    notified: 'Bientôt Disponible',
                    notifyMe: 'Bientôt Disponible'
                },
                ar: {
                    notified: 'قريباً',
                    notifyMe: 'قريباً'
                }
            };

            const content = translations[currentLang] || translations.en;

            // Since it's "Coming Soon", just keep the same text
            btn.textContent = content.notifyMe;
        }



        // Show service detail
        function showServiceDetail(serviceId) {
            const service = serviceData[serviceId];
            const detailCard = document.getElementById("service-detail-card");
            const currentLang = getCookie('selected-language') || 'en';
            const translations = {
                en: {
                    comingSoon: "Coming Soon",
                    comingSoonMessage: "This service is coming soon! Stay tuned for updates",
                    keyFeatures: "Key Features:",
                    startSelling: "Start Selling",
                    learnMore: "Learn More",
                    availableNow: "Available Now"
                },
                fr: {
                    comingSoon: "Bientôt Disponible",
                    comingSoonMessage: "Ce service arrive bientôt! Restez à l'écoute pour les mises à jour",
                    keyFeatures: "Caractéristiques Principales:",
                    startSelling: "Commencer à Vendre",
                    learnMore: "En Savoir Plus",
                    availableNow: "Disponible Maintenant"
                },
                ar: {
                    comingSoon: "قريباً",
                    comingSoonMessage: "هذه الخدمة قادمة قريباً! ابقوا متابعين للتحديثات",
                    keyFeatures: "الميزات الرئيسية:",
                    startSelling: "ابدأ البيع",
                    learnMore: "اعرف المزيد",
                    availableNow: "متاح الآن"
                }
            };
            const content = translations[currentLang] || translations.en;

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
                                ${content.comingSoon}
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <div class="coming-soon-text">
                            <p>${content.comingSoonMessage}</p>
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
                            ${content.availableNow}
                        </div>
                    </div>
                </div>
                
                <div class="card-content">
                    <div class="features-section">
                        <h4>${content.keyFeatures}</h4>
                        <div class="features-list">
                            ${featuresHTML}
                        </div>
                    </div>

                    <div class="button-group">
                        <button class="btn btn-primary ${service.color}" onclick="startSelling()">
                            ${content.startSelling}
                        </button>
                        <button class="btn btn-outline" onclick="learnMore()">
                            ${content.learnMore}
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

        // Cookie Management Functions
        function setCookie(name, value, days = 30) {
            const expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        // Language Switcher Functions
        function toggleLanguageDropdown() {
            const dropdown = document.getElementById('language-dropdown');
            const btn = document.querySelector('.language-btn');

            dropdown.classList.toggle('show');
            btn.classList.toggle('open');
        }

        function switchLanguage(langCode, langName, direction) {
            // Update current language display
            document.getElementById('current-language').textContent = langCode;

            // Update active state
            document.querySelectorAll('.language-option').forEach(option => {
                option.classList.remove('active');
            });
            document.querySelector(`[data-lang="${langCode.toLowerCase()}"]`).classList.add('active');

            // Close dropdown
            document.getElementById('language-dropdown').classList.remove('show');
            document.querySelector('.language-btn').classList.remove('open');

            // Set document direction for RTL languages
            document.documentElement.dir = direction;
            document.documentElement.lang = langCode.toLowerCase();

            // Store language preference in cookies
            setCookie('selected-language', langCode.toLowerCase(), 365);

            // Update page content
            updatePageContent(langCode.toLowerCase());
        }

        function updatePageContent(lang) {
            const translations = {
                en: {
                    // Header & Badges
                    headerBadge: "Partner With Us",
                    title: "Choose Your Perfect Service",
                    subtitle: "Join thousands of successful partners and grow your business with DjibMarket's comprehensive ecosystem",
                    partnersLabel: "Active Partners",
                    ordersLabel: "Monthly Orders",
                    uptimeLabel: "Uptime",

                    // Featured Section
                    featuredBadge: "Most Popular",
                    featuredTitle: "Start Selling on DjibMarket.com",
                    featuredDescription: "Join our flagship marketplace and reach customers across Djibouti with zero setup fees",
                    featuredBtn: "Get Started Now",
                    featuredHighlight1: "✨ No setup costs",
                    featuredHighlight2: "📈 Built-in analytics",
                    featuredHighlight3: "🚀 Same-day approval",

                    // All Services Section
                    allServicesTitle: "All Services",
                    allServicesSubtitle: "Explore all the ways you can partner with DjibMarket",

                    // Sidebar
                    sidebarTitle: "DjibMarket Partners",
                    backBtn: "Go back to DjibMarket",
                    helpLink: "Need help?",

                    // Service Names & Descriptions
                    marketplace: {
                        name: "DjibMarket Marketplace",
                        sidebarName: "Sell on DjibMarket.com",
                        description: "Sell your products to thousands of customers across Djibouti",
                        sidebarDesc: "Sell your products on DjibMarket online marketplace",
                        features: ["Access to customers across Djibouti", "Easy product listing process",
                            "Secure payment processing", "Professional seller support"
                        ]
                    },
                    food: {
                        name: "DjibMarket Food",
                        description: "Partner with our food delivery platform to reach hungry customers",
                        sidebarDesc: "Sell with DjibMarket Food delivery service",
                        features: ["Real-time order management", "Fast delivery network", "Restaurant marketing tools"]
                    },
                    ads: {
                        name: "DjibMarket Ads",
                        description: "Advertise your brand and boost visibility across our platform",
                        sidebarDesc: "Advertise your brand/products with DjibMarket",
                        features: ["Targeted advertising campaigns", "Detailed performance analytics",
                            "Professional brand promotion"
                        ]
                    },
                    express: {
                        name: "DjibMarket Express",
                        description: "Deliver groceries and essentials with ultra-fast same-day delivery",
                        sidebarDesc: "Sell groceries & essentials, delivered fast",
                        features: ["Ultra-fast same-day delivery", "Grocery and essentials focus",
                            "High inventory turnover"
                        ]
                    },
                    ambassadors: {
                        name: "Brand Ambassadors",
                        sidebarName: "DjibMarket Ambassadors",
                        description: "Represent DjibMarket and earn rewards by growing our community",
                        sidebarDesc: "Be an ambassador for DjibMarket",
                        features: ["Flexible earning opportunities", "Community building programs",
                            "Performance-based rewards system"
                        ]
                    },
                    wholesale: {
                        name: "Wholesale Platform",
                        sidebarName: "DjibMarket Wholesale",
                        description: "Connect with businesses and retailers for bulk product sales",
                        sidebarDesc: "Sell your products wholesale on DjibMarket",
                        features: ["B2B marketplace access", "Advanced bulk order management",
                            "Business networking tools"
                        ]
                    },

                    // Status & Buttons
                    availableNow: "Available Now",
                    comingSoon: "Coming Soon",
                    startSelling: "Start Selling",
                    notifyMe: "Coming Soon",
                    notified: "Coming Soon",

                    // Other Texts
                    keyFeatures: "Key Features:",
                    comingSoonMessage: "This service is coming soon! Stay tuned for updates",
                    learnMore: "Learn More",

                    // Trust Section
                    security: {
                        title: "Bank-Level Security",
                        description: "256-bit encryption protects all your data"
                    },
                    support: {
                        title: "24/7 Support",
                        description: "Our team is here to help you succeed"
                    },
                    setup: {
                        title: "Fast Setup",
                        description: "Get started in minutes, not days"
                    }
                },
                fr: {
                    // Header & Badges
                    headerBadge: "Partenariat Avec Nous",
                    title: "Choisissez Votre Service Parfait",
                    subtitle: "Rejoignez des milliers de partenaires prospères et développez votre entreprise avec l'écosystème complet de DjibMarket",
                    partnersLabel: "Partenaires Actifs",
                    ordersLabel: "Commandes Mensuelles",
                    uptimeLabel: "Disponibilité",

                    // Featured Section
                    featuredBadge: "Le Plus Populaire",
                    featuredTitle: "Commencez à Vendre sur DjibMarket.com",
                    featuredDescription: "Rejoignez notre marché phare et atteignez les clients à travers Djibouti sans frais d'installation",
                    featuredBtn: "Commencer Maintenant",
                    featuredHighlight1: "✨ Aucun frais d'installation",
                    featuredHighlight2: "📈 Analyses intégrées",
                    featuredHighlight3: "🚀 Approbation le jour même",

                    // All Services Section
                    allServicesTitle: "Tous les Services",
                    allServicesSubtitle: "Explorez toutes les façons de vous associer avec DjibMarket",

                    // Sidebar
                    sidebarTitle: "DjibMarket Partners",
                    backBtn: "Retour à DjibMarket",
                    helpLink: "Besoin d'aide?",

                    // Service Names & Descriptions
                    marketplace: {
                        name: "DjibMarket Marketplace",
                        sidebarName: "Vendre sur DjibMarket.com",
                        description: "Vendez vos produits à des milliers de clients à travers Djibouti",
                        sidebarDesc: "Vendez vos produits sur la place de marché en ligne DjibMarket",
                        features: ["Accès aux clients à travers Djibouti", "Processus de listing de produits facile",
                            "Traitement des paiements sécurisé", "Support professionnel pour vendeurs"
                        ]
                    },
                    food: {
                        name: "DjibMarket Food",
                        description: "Partenariat avec notre plateforme de livraison alimentaire",
                        sidebarDesc: "Vendez avec le service de livraison DjibMarket Food",
                        features: ["Gestion des commandes en temps réel", "Réseau de livraison rapide",
                            "Outils marketing pour restaurants"
                        ]
                    },
                    ads: {
                        name: "DjibMarket Ads",
                        description: "Faites la publicité de votre marque et augmentez la visibilité",
                        sidebarDesc: "Faites la publicité de votre marque/produits avec DjibMarket",
                        features: ["Campagnes publicitaires ciblées", "Analyses de performance détaillées",
                            "Promotion professionnelle de marque"
                        ]
                    },
                    express: {
                        name: "DjibMarket Express",
                        description: "Livrez épiceries et produits essentiels avec livraison ultra-rapide",
                        sidebarDesc: "Vendez épiceries et produits essentiels, livrés rapidement",
                        features: ["Livraison ultra-rapide le jour même", "Focus épicerie et produits essentiels",
                            "Rotation élevée des stocks"
                        ]
                    },
                    ambassadors: {
                        name: "Brand Ambassadors",
                        sidebarName: "DjibMarket Ambassadors",
                        description: "Représentez DjibMarket et gagnez des récompenses",
                        sidebarDesc: "Soyez ambassadeur pour DjibMarket",
                        features: ["Opportunités de gains flexibles", "Programmes de construction communautaire",
                            "Système de récompenses basé sur la performance"
                        ]
                    },
                    wholesale: {
                        name: "Wholesale Platform",
                        sidebarName: "DjibMarket Wholesale",
                        description: "Connectez-vous avec des entreprises et détaillants",
                        sidebarDesc: "Vendez vos produits en gros sur DjibMarket",
                        features: ["Accès au marché B2B", "Gestion avancée des commandes en vrac",
                            "Outils de réseautage d'affaires"
                        ]
                    },

                    // Status & Buttons
                    availableNow: "Disponible Maintenant",
                    comingSoon: "Bientôt Disponible",
                    startSelling: "Commencer à Vendre",
                    notifyMe: "Bientôt Disponible",
                    notified: "Bientôt Disponible",

                    // Other Texts
                    keyFeatures: "Caractéristiques Principales:",
                    comingSoonMessage: "Ce service arrive bientôt! Restez à l'écoute pour les mises à jour",
                    learnMore: "En Savoir Plus",

                    // Trust Section
                    security: {
                        title: "Sécurité Bancaire",
                        description: "Chiffrement 256 bits protège toutes vos données"
                    },
                    support: {
                        title: "Support 24/7",
                        description: "Notre équipe est là pour vous aider à réussir"
                    },
                    setup: {
                        title: "Configuration Rapide",
                        description: "Commencez en minutes, pas en jours"
                    }
                },
                ar: {
                    // Header & Badges
                    headerBadge: "شراكة معنا",
                    title: "اختر الخدمة المثالية لك",
                    subtitle: "انضم إلى آلاف الشركاء الناجحين وقم بتنمية عملك مع النظام البيئي الشامل لدجيب ماركت",
                    partnersLabel: "شركاء نشطون",
                    ordersLabel: "طلبات شهرية",
                    uptimeLabel: "وقت التشغيل",

                    // Featured Section
                    featuredBadge: "الأكثر شعبية",
                    featuredTitle: "ابدأ البيع على DjibMarket.com",
                    featuredDescription: "انضم إلى منصتنا الرائدة ووصل إلى العملاء في جميع أنحاء جيبوتي بدون رسوم إعداد",
                    featuredBtn: "ابدأ الآن",
                    featuredHighlight1: "✨ بدون تكاليف إعداد",
                    featuredHighlight2: "📈 تحليلات مدمجة",
                    featuredHighlight3: "🚀 موافقة في نفس اليوم",

                    // All Services Section
                    allServicesTitle: "جميع الخدمات",
                    allServicesSubtitle: "استكشف جميع الطرق للشراكة مع دجيب ماركت",

                    // Sidebar
                    sidebarTitle: "DjibMarket Partners",
                    backBtn: "العودة إلى DjibMarket",
                    helpLink: "تحتاج مساعدة؟",

                    // Service Names & Descriptions
                    marketplace: {
                        name: "DjibMarket Marketplace",
                        sidebarName: "البيع على DjibMarket.com",
                        description: "بيع منتجاتك لآلاف العملاء في جميع أنحاء جيبوتي",
                        sidebarDesc: "بيع منتجاتك على منصة DjibMarket الإلكترونية",
                        features: ["الوصول للعملاء في جميع أنحاء جيبوتي", "عملية سهلة لإدراج المنتجات",
                            "معالجة آمنة للمدفوعات", "دعم احترافي للبائعين"
                        ]
                    },
                    food: {
                        name: "DjibMarket Food",
                        description: "شراكة مع منصة توصيل الطعام للوصول للعملاء الجائعين",
                        sidebarDesc: "البيع مع خدمة توصيل DjibMarket Food",
                        features: ["إدارة الطلبات في الوقت الفعلي", "شبكة توصيل سريعة", "أدوات تسويق للمطاعم"]
                    },
                    ads: {
                        name: "DjibMarket Ads",
                        description: "أعلن عن علامتك التجارية وعزز الرؤية عبر منصتنا",
                        sidebarDesc: "أعلن عن علامتك التجارية/منتجاتك مع DjibMarket",
                        features: ["حملات إعلانية مستهدفة", "تحليلات أداء مفصلة", "ترويج احترافي للعلامة التجارية"]
                    },
                    express: {
                        name: "DjibMarket Express",
                        description: "توصيل البقالة والضروريات بتوصيل فائق السرعة في نفس اليوم",
                        sidebarDesc: "بيع البقالة والضروريات، توصيل سريع",
                        features: ["توصيل فائق السرعة في نفس اليوم", "تركيز على البقالة والضروريات",
                            "دوران عالي للمخزون"
                        ]
                    },
                    ambassadors: {
                        name: "Brand Ambassadors",
                        sidebarName: "DjibMarket Ambassadors",
                        description: "مثل DjibMarket واحصل على مكافآت من خلال تنمية مجتمعنا",
                        sidebarDesc: "كن سفيرًا لـ DjibMarket",
                        features: ["فرص كسب مرنة", "برامج بناء المجتمع", "نظام مكافآت قائم على الأداء"]
                    },
                    wholesale: {
                        name: "Wholesale Platform",
                        sidebarName: "DjibMarket Wholesale",
                        description: "اتصل مع الشركات وتجار التجزئة لمبيعات المنتجات بالجملة",
                        sidebarDesc: "بيع منتجاتك بالجملة على DjibMarket",
                        features: ["الوصول لسوق B2B", "إدارة متقدمة للطلبات بالجملة", "أدوات التواصل التجاري"]
                    },

                    // Status & Buttons
                    availableNow: "متاح الآن",
                    comingSoon: "قريباً",
                    startSelling: "ابدأ البيع",
                    notifyMe: "قريباً",
                    notified: "قريباً",

                    // Other Texts
                    keyFeatures: "الميزات الرئيسية:",
                    comingSoonMessage: "هذه الخدمة قادمة قريباً! ابقوا متابعين للتحديثات",
                    learnMore: "اعرف المزيد",

                    // Trust Section
                    security: {
                        title: "أمان مصرفي",
                        description: "تشفير 256 بت يحمي جميع بياناتك"
                    },
                    support: {
                        title: "دعم 24/7",
                        description: "فريقنا هنا لمساعدتك على النجاح"
                    },
                    setup: {
                        title: "إعداد سريع",
                        description: "ابدأ في دقائق، وليس أيام"
                    }
                }
            };

            const content = translations[lang] || translations.en;

            // Update header badge
            const headerBadge = document.querySelector('.header-badge');
            if (headerBadge) {
                headerBadge.childNodes[2].textContent = ' ' + content.headerBadge;
            }

            // Update main content
            const titleElement = document.querySelector('.content-header h1');
            const subtitleElement = document.querySelector('.content-header p');
            if (titleElement) titleElement.textContent = content.title;
            if (subtitleElement) subtitleElement.textContent = content.subtitle;

            // Update stats labels
            const statLabels = document.querySelectorAll('.stat-label');
            if (statLabels.length >= 3) {
                statLabels[0].textContent = content.partnersLabel;
                statLabels[1].textContent = content.ordersLabel;
                statLabels[2].textContent = content.uptimeLabel;
            }

            // Update featured section
            const featuredBadge = document.querySelector('.featured-badge');
            const featuredTitle = document.querySelector('.featured-service h3');
            const featuredDesc = document.querySelector('.featured-service p');
            const featuredBtn = document.querySelector('.featured-btn');
            const highlights = document.querySelectorAll('.highlight');

            if (featuredBadge) {
                featuredBadge.childNodes[2].textContent = ' ' + content.featuredBadge;
            }
            if (featuredTitle) featuredTitle.textContent = content.featuredTitle;
            if (featuredDesc) featuredDesc.textContent = content.featuredDescription;
            if (featuredBtn) {
                featuredBtn.childNodes[0].textContent = content.featuredBtn + ' ';
            }
            if (highlights.length >= 3) {
                highlights[0].textContent = content.featuredHighlight1;
                highlights[1].textContent = content.featuredHighlight2;
                highlights[2].textContent = content.featuredHighlight3;
            }

            // Update all services section
            const allServicesTitle = document.querySelector('.section-header h2');
            const allServicesSubtitle = document.querySelector('.section-header p');
            if (allServicesTitle) allServicesTitle.textContent = content.allServicesTitle;
            if (allServicesSubtitle) allServicesSubtitle.textContent = content.allServicesSubtitle;

            // Update sidebar
            const sidebarTitle = document.querySelector('.sidebar-header h2');
            const backBtn = document.querySelector('.back-button');
            const helpLink = document.querySelector('.help-link button');

            if (sidebarTitle) sidebarTitle.textContent = content.sidebarTitle;
            if (backBtn) {
                backBtn.childNodes[2].textContent = ' ' + content.backBtn;
            }
            if (helpLink) helpLink.textContent = content.helpLink;

            // Update sidebar service items
            updateSidebarServices(content);

            // Update service cards
            updateServiceCards(content);

            // Update trust section
            updateTrustSection(content);
        }

        function updateSidebarServices(content) {
            const services = [{
                    selector: '[data-service="djibmarket-com"]',
                    data: content.marketplace
                },
                {
                    selector: '[data-service="djibmarket-food"]',
                    data: content.food
                },
                {
                    selector: '[data-service="djibmarket-ads"]',
                    data: content.ads
                },
                {
                    selector: '[data-service="djibmarket-express"]',
                    data: content.express
                },
                {
                    selector: '[data-service="djibmarket-ambassadors"]',
                    data: content.ambassadors
                },
                {
                    selector: '[data-service="djibmarket-wholesale"]',
                    data: content.wholesale
                }
            ];

            services.forEach(service => {
                const element = document.querySelector('.sidebar ' + service.selector);
                if (element) {
                    const titleEl = element.querySelector('h3');
                    const descEl = element.querySelector('p');
                    if (titleEl) titleEl.textContent = service.data.sidebarName || service.data.name;
                    if (descEl) descEl.textContent = service.data.sidebarDesc;
                }
            });
        }

        function updateServiceCards(content) {
            const services = [{
                    selector: '[data-service="djibmarket-com"]',
                    data: content.marketplace
                },
                {
                    selector: '[data-service="djibmarket-food"]',
                    data: content.food
                },
                {
                    selector: '[data-service="djibmarket-ads"]',
                    data: content.ads
                },
                {
                    selector: '[data-service="djibmarket-express"]',
                    data: content.express
                },
                {
                    selector: '[data-service="djibmarket-ambassadors"]',
                    data: content.ambassadors
                },
                {
                    selector: '[data-service="djibmarket-wholesale"]',
                    data: content.wholesale
                }
            ];

            services.forEach(service => {
                const card = document.querySelector('.services-grid-new ' + service.selector);
                if (card) {
                    const titleEl = card.querySelector('h3');
                    const descEl = card.querySelector('.card-content p');
                    const featureList = card.querySelectorAll('.feature-list li');
                    const statusBadge = card.querySelector('.status-badge');
                    const actionBtn = card.querySelector('.action-btn');

                    if (titleEl) titleEl.textContent = service.data.name;
                    if (descEl) descEl.textContent = service.data.description;

                    if (featureList && service.data.features) {
                        featureList.forEach((li, index) => {
                            if (service.data.features[index]) {
                                li.textContent = service.data.features[index];
                            }
                        });
                    }

                    if (statusBadge) {
                        statusBadge.textContent = statusBadge.classList.contains('available') ? content
                            .availableNow : content.comingSoon;
                    }

                    if (actionBtn) {
                        if (actionBtn.classList.contains('primary')) {
                            actionBtn.textContent = content.startSelling;
                        } else {
                            actionBtn.textContent = content.comingSoon;
                        }
                    }
                }
            });
        }

        function updateTrustSection(content) {
            const trustItems = document.querySelectorAll('.trust-item');
            const trustData = [content.security, content.support, content.setup];

            trustItems.forEach((item, index) => {
                if (trustData[index]) {
                    const titleEl = item.querySelector('h4');
                    const descEl = item.querySelector('p');
                    if (titleEl) titleEl.textContent = trustData[index].title;
                    if (descEl) descEl.textContent = trustData[index].description;
                }
            });
        }

        // Initialize language from cookies
        function initializeLanguage() {
            const savedLang = getCookie('selected-language') || 'en';
            const langOption = document.querySelector(`[data-lang="${savedLang}"]`);

            if (langOption) {
                const langCode = langOption.querySelector('.lang-code').textContent;
                const direction = langOption.dataset.dir;
                switchLanguage(langCode, '', direction);
            }
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
