<!DOCTYPE html>
<html lang="en" class="light-mode">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="DjibMarket - Your premier online marketplace for buying and selling products in Djibouti">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images') }}/favicon.png">
    <!-- Page Title  -->
    <title>DjibMarket Admin</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/shared') }}/css/dashlite.css?ver=3.2.2">
    <link rel="stylesheet" href="{{ asset('assets/shared') }}/css/theme.css?ver=3.2.2">
    <style>
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
    </style>
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content">
                    @yield('content')
                </div>
                <!-- content @e -->
                <div class="nk-footer nk-auth-footer-full">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="col-lg-6 order-lg-last">
                                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Terms & Conditions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Help</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <div class="nk-block-content text-center text-lg-left">
                                    <p class="text-soft">&copy; {{ date('Y') }} DjibMarket. All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    <script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
    <script src="{{ asset('assets/shared') }}/js/scripts.js?ver=3.2.2"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submitButton');
            if (submitButton) {
                const buttonText = document.querySelector('.button-text');
                const loadingSpinner = document.getElementById('loadingSpinner');
                const form = submitButton.closest('form');

                form.addEventListener('submit', function() {
                    buttonText.textContent = 'Processing...';
                    loadingSpinner.classList.remove('d-none');
                    submitButton.disabled = true;
                });
            }
        });
    </script>
    @yield('page_scripts')
</body>

</html>
