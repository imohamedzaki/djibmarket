<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="An educational platform personalized for the students">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/imgs/template/favicon.png') }}">
    <!-- Page Title  -->
    <title>@yield('title', 'DjibMarket')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Core Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/v1/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    @include('layouts.guest.partials.buyer.styles')
    <!-- Theme Variables -->
    <style>
        :root {
            /* Light Mode Variables */
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --secondary-color: #3498db;
            --secondary-hover: #2980b9;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --success-color: #10b981;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        /* Dark Mode Variables */
        .dark-mode {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #3b82f6;
            --secondary-hover: #2563eb;
            --text-dark: #f1f5f9;
            --text-light: #94a3b8;
            --bg-light: #0f172a;
            --bg-card: #1e293b;
            --border-color: #334155;
            --error-color: #f87171;
            --success-color: #34d399;
            --shadow-color: rgba(0, 0, 0, 0.3);
        }

        .custom_guard::before {
            display: block;
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='100%25' width='100%25'%3E%3Cdefs%3E%3Cpattern id='doodad' width='30' height='30' viewBox='0 0 40 40' patternUnits='userSpaceOnUse' patternTransform='rotate(135)'%3E%3Crect width='100%25' height='100%25' fill='rgba(65, 153, 225,0)'/%3E%3Ccircle cx='-15' cy='15' r='1' fill='rgba(67, 65, 144,1)'/%3E%3Ccircle cx='-5' cy='25' r='1' fill='rgba(67, 65, 144,1)'/%3E%3Ccircle cx='5' cy='15' r='1' fill='rgba(67, 65, 144,1)'/%3E%3Ccircle cx='25' cy='15' r='1' fill='rgba(67, 65, 144,1)'/%3E%3Ccircle cx='15' cy='25' r='1' fill='rgba(67, 65, 144,1)'/%3E%3Ccircle cx='35' cy='25' r='1' fill='rgba(67, 65, 144,1)'/%3E%3Ccircle cx='15' cy='15' r='1' fill='rgba(236, 201, 75,1)'/%3E%3Ccircle cx='35' cy='15' r='1' fill='rgba(236, 201, 75,1)'/%3E%3Ccircle cx='5' cy='25' r='1' fill='rgba(236, 201, 75,1)'/%3E%3Ccircle cx='25' cy='25' r='1' fill='rgba(236, 201, 75,1)'/%3E%3C/pattern%3E%3C/defs%3E%3Crect fill='url(%23doodad)' height='200%25' width='200%25'/%3E%3C/svg%3E ");
            background-size: cover;
            opacity: .3;
        }

        .custom_guard {
            position: relative;
            background: #4960e314;
            color: #4960e3;
            padding: .4rem;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            border-bottom: 2px solid #4960e329;
        }

        .custom_guard span {
            position: relative;
            letter-spacing: 5px;
        }

        /* Common animation styles to be available across all pages */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {

            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%,
            80% {
                transform: translate3d(2px, 0, 0);
            }

            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }
        }
    </style>
    @yield('page_css')
    @includeIf('includes.z_alert.contentCSS')
</head>
