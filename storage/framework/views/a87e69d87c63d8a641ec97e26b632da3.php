<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="DjibMarket - Your premier online marketplace for buying and selling products in Djibouti">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/imgs/template')); ?>/favicon.png">
    <!-- Page Title  -->
    <title>419 Page Expired - DjibMarket</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/shared')); ?>/css/dashlite.css?ver=3.2.2">

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
            z-index: -1;
        }

        .custom_guard {
            position: relative;
            background: #e8534714;
            color: #e85347;
            padding: .4rem;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0;
            border-bottom: 2px solid #e8534729;
            overflow: hidden;
        }

        .custom_guard span {
            position: relative;
            letter-spacing: 5px;
        }

        /* Animated Background Shapes */
        .background-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -2;
        }

        .background-shapes span {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(67, 65, 144, 0.2);
            bottom: -150px;
            animation: floatUp 25s linear infinite;
            border-radius: 50%;
        }

        .background-shapes span:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
            background-color: rgba(236, 201, 75, 0.15);
        }

        .background-shapes span:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .background-shapes span:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
            background-color: rgba(232, 83, 71, 0.1);
        }

        .background-shapes span:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .background-shapes span:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
            background-color: rgba(236, 201, 75, 0.2);
        }

        .background-shapes span:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
            background-color: rgba(67, 65, 144, 0.1);
        }

        .background-shapes span:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
            background-color: rgba(232, 83, 71, 0.05);
        }

        .background-shapes span:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .background-shapes span:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
            background-color: rgba(236, 201, 75, 0.25);
        }

        .background-shapes span:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
            background-color: rgba(67, 65, 144, 0.15);
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(720deg);
                opacity: 0;
            }
        }

        .nk-auth-body.wide-xs {
            max-width: fit-content !important;
        }
    </style>
</head>

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- Animated Shapes -->
        <div class="background-shapes">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- main @s -->
        <div class="nk-main">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="<?php echo e(url('/')); ?>" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg"
                                    src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                                    srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg"
                                    src="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>"
                                    srcset="<?php echo e(asset('assets/imgs/template/logo_only.png')); ?>" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered" style="overflow: hidden">
                            <p class="custom_guard">
                                <span>Error 419</span>
                            </p>
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content text-center">
                                        <h4 class="nk-block-title">Page Expired</h4>
                                        <div class="nk-block-des">
                                            <p>Your session has expired or the CSRF token is invalid. This could happen
                                                if you left the page open for too long or if the form was submitted
                                                incorrectly.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <a href="<?php echo e(url('/')); ?>" class="btn btn-lg btn-primary">
                                        <em class="icon ni ni-home"></em>
                                        <span>Back to Home</span>
                                    </a>
                                    <?php if(Auth::guard('admin')->check()): ?>
                                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-lg btn-primary ms-2">
                                            <em class="icon ni ni-dashboard"></em>
                                            <span>Admin Dashboard</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if(Auth::guard('seller')->check()): ?>
                                        <a href="<?php echo e(route('seller.dashboard')); ?>"
                                            class="btn btn-lg btn-primary <?php if(Auth::guard('admin')->check()): ?> ms-2 <?php endif; ?>">
                                            <em class="icon ni ni-dashboard"></em>
                                            <span>Seller Dashboard</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if(Auth::guard('web')->check()): ?>
                                        <a href="<?php echo e(route('buyer.home')); ?>"
                                            class="btn btn-lg btn-primary <?php if(auth('admin')->check() || auth('seller')->check()): ?> ms-2 <?php endif; ?>">
                                            <em class="icon ni ni-dashboard"></em>
                                            <span>Dashboard</span>
                                        </a>
                                    <?php endif; ?>
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
    <script src="<?php echo e(asset('assets/shared')); ?>/js/bundle.js?ver=3.2.2"></script>
    <script src="<?php echo e(asset('assets/shared')); ?>/js/scripts.js?ver=3.2.2"></script>
</body>

</html>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/errors/419.blade.php ENDPATH**/ ?>