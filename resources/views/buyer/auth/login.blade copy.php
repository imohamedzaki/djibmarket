<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="DjibMarket - Your premier online marketplace for buying and selling products in Djibouti">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/imgs/template') }}/favicon.png" sizes="32x26">
    <!-- Page Title  -->
    <title>DjibMarket</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/shared') }}/css/dashlite.css?ver=3.2.2">

    <style>
    body {
        background: linear-gradient(90deg, #e3fff7 0%, #d9e7ff 100%) !important;
    }

    .card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(10px) !important;
        border: none !important;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.05) !important;
        border-radius: 12px !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    }

    .card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.08) !important;
    }

    .card-inner {
        border-radius: 0 0 12px 12px !important;
    }

    .custom_guard {
        position: relative;
        background: linear-gradient(45deg, #61e4bc 0%, #7cbeff 100%) !important;
        color: #ffffff !important;
        padding: .6rem !important;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        margin: 0;
        border-bottom: none !important;
        border-radius: 12px 12px 0 0 !important;
        box-shadow: 0 3px 10px rgba(100, 200, 255, 0.2) !important;
    }

    .custom_guard::before {
        display: block;
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='100%25' width='100%25'%3E%3Cdefs%3E%3Cpattern id='doodad' width='30' height='30' viewBox='0 0 40 40' patternUnits='userSpaceOnUse' patternTransform='rotate(135)'%3E%3Crect width='100%25' height='100%25' fill='rgba(65, 153, 225,0)'/%3E%3Ccircle cx='-15' cy='15' r='1' fill='rgba(255, 255, 255,0.6)'/%3E%3Ccircle cx='-5' cy='25' r='1' fill='rgba(255, 255, 255,0.6)'/%3E%3Ccircle cx='5' cy='15' r='1' fill='rgba(255, 255, 255,0.6)'/%3E%3Ccircle cx='25' cy='15' r='1' fill='rgba(255, 255, 255,0.6)'/%3E%3Ccircle cx='15' cy='25' r='1' fill='rgba(255, 255, 255,0.6)'/%3E%3Ccircle cx='35' cy='25' r='1' fill='rgba(255, 255, 255,0.6)'/%3E%3Ccircle cx='15' cy='15' r='1' fill='rgba(255, 255, 255,1)'/%3E%3Ccircle cx='35' cy='15' r='1' fill='rgba(255, 255, 255,1)'/%3E%3Ccircle cx='5' cy='25' r='1' fill='rgba(255, 255, 255,1)'/%3E%3Ccircle cx='25' cy='25' r='1' fill='rgba(255, 255, 255,1)'/%3E%3C/pattern%3E%3C/defs%3E%3Crect fill='url(%23doodad)' height='200%25' width='200%25'/%3E%3C/svg%3E ");
        background-size: cover;
        opacity: .3;
        border-radius: 12px 12px 0 0 !important;
    }

    .custom_guard span {
        position: relative;
        letter-spacing: 5px;
    }

    .btn-primary {
        background: linear-gradient(45deg, #4ad4a5 0%, #56a8ff 100%) !important;
        border: none !important;
        box-shadow: 0 5px 15px rgba(86, 168, 255, 0.3) !important;
    }

    .btn-primary:hover {
        box-shadow: 0 8px 20px rgba(86, 168, 255, 0.5) !important;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.8) !important;
        border: 1px solid rgba(94, 116, 143, 0.3) !important;
    }

    .form-control:focus {
        border-color: rgba(86, 168, 255, 0.5) !important;
        box-shadow: 0 0 0 3px rgba(86, 168, 255, 0.1) !important;
    }

    a {
        color: #4BB8D5 !important;
        transition: color 0.3s ease !important;
    }

    a:hover {
        color: #56a8ff !important;
    }

    .nk-footer {
        background: rgba(255, 255, 255, 0.6) !important;
        backdrop-filter: blur(5px) !important;
        margin-top: 30px;
        border-top: 1px solid rgba(94, 116, 143, 0.3) !important;
    }

    .nav-link {
        color: #5C93B1 !important;
        transition: color 0.3s ease !important;
    }

    .nav-link:hover {
        color: #56a8ff !important;
    }

    .text-soft {
        color: #71A6D1 !important;
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
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="{{ route('buyer.home') }}" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg"
                                    src="{{ asset('assets/imgs/template/logo_only.png') }}"
                                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg"
                                    src="{{ asset('assets/imgs/template/logo_only.png') }}"
                                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered" style="overflow: hidden">
                            <p class="custom_guard">
                                <span>Buyer</span>
                            </p>
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>Access the DjibMarket panel using your email and passcode.</p>
                                        </div>
                                    </div>
                                </div>
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="email"
                                                name="email" placeholder="Enter your email address">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Passcode</label>
                                            <a class="link link-primary link-sm"
                                                href="{{ route('password.request') }}">Forgot Code?</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                                data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password"
                                                placeholder="Enter your passcode" name="password">
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <button id="submitButton"
                                            class="submitButton btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center">
                                            <span class="button-text">Sign in</span>
                                            <div id="loadingSpinner"
                                                class="loadingSpinner spinner-border spinner-border-sm text-light ms-2 d-none"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> New on our platform? <a
                                        href="{{ route('register') }}">Create an account</a>
                                </div>
                                {{-- <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                                </div>
                                <ul class="nav justify-center gx-4">
                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link"
                                                data-bs-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/english.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/spanish.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/french.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="./images/flags/turkey.png" alt=""
                                                                class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; {{ date('Y') }} DjibMarket. All Rights
                                            Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->

    {{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
    <script src="{{ asset('assets/shared') }}/js/scripts.js?ver=3.2.2"></script>
    <script>
    // Disable submit button on form submit
    $('form').on('submit', function(e) {
        var submitButton = $('.submitButton');

        // Disable the button
        submitButton.prop('disabled', true);

        // Change the button text
        // submitButton.find('.button-text').text('Submitting...');

        // Show the loading spinner
        $('.loadingSpinner').removeClass('d-none');
    });
    </script>

    <!-- select region modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="region">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title mb-4">Select Your Country</h5>
                    <div class="nk-country-region">
                        <ul class="country-list text-center gy-2">
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/arg.png" alt="" class="country-flag">
                                    <span class="country-name">Argentina</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/aus.png" alt="" class="country-flag">
                                    <span class="country-name">Australia</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/bangladesh.png" alt="" class="country-flag">
                                    <span class="country-name">Bangladesh</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/canada.png" alt="" class="country-flag">
                                    <span class="country-name">Canada <small>(English)</small></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">Centrafricaine</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">China</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/french.png" alt="" class="country-flag">
                                    <span class="country-name">France</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/germany.png" alt="" class="country-flag">
                                    <span class="country-name">Germany</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/iran.png" alt="" class="country-flag">
                                    <span class="country-name">Iran</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/italy.png" alt="" class="country-flag">
                                    <span class="country-name">Italy</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/mexico.png" alt="" class="country-flag">
                                    <span class="country-name">México</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/philipine.png" alt="" class="country-flag">
                                    <span class="country-name">Philippines</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/portugal.png" alt="" class="country-flag">
                                    <span class="country-name">Portugal</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/s-africa.png" alt="" class="country-flag">
                                    <span class="country-name">South Africa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/spanish.png" alt="" class="country-flag">
                                    <span class="country-name">Spain</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/switzerland.png" alt="" class="country-flag">
                                    <span class="country-name">Switzerland</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/uk.png" alt="" class="country-flag">
                                    <span class="country-name">United Kingdom</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/english.png" alt="" class="country-flag">
                                    <span class="country-name">United State</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->


</html>