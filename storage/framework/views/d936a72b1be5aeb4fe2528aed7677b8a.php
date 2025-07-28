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
    <title>DjibMarket</title>
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

        /* Password requirement styles */
        .password-requirements {
            margin-top: 0.5rem;
            padding: 1rem;
            border-radius: 4px;
            background-color: #f5f6fa;
            transition: all 0.3s ease;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.8rem;
            color: #8094ae;
            transition: all 0.3s ease;
        }

        .requirement-item.met {
            color: #1ee0ac;
        }

        .requirement-icon {
            margin-right: 0.5rem;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #e5e9f2;
            transition: all 0.3s ease;
        }

        .requirement-item.met .requirement-icon {
            background-color: #1ee0ac;
        }

        .requirement-icon i {
            font-size: 8px;
            color: white;
        }

        .password-strength-bar {
            height: 4px;
            background-color: #e5e9f2;
            margin-top: 0.5rem;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .strength-progress {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 2px;
            background-color: #f4bd0e;
        }

        .strength-progress.weak {
            background-color: #e85347;
            width: 25%;
        }

        .strength-progress.fair {
            background-color: #f4bd0e;
            width: 50%;
        }

        .strength-progress.good {
            background-color: #09c2de;
            width: 75%;
        }

        .strength-progress.strong {
            background-color: #1ee0ac;
            width: 100%;
        }

        .strength-label {
            font-size: 0.75rem;
            margin-top: 0.25rem;
            text-align: right;
            font-weight: 500;
            color: #8094ae;
            transition: all 0.3s ease;
        }

        .strength-label.weak {
            color: #e85347;
        }

        .strength-label.fair {
            color: #f4bd0e;
        }

        .strength-label.good {
            color: #09c2de;
        }

        .strength-label.strong {
            color: #1ee0ac;
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
                    <div class="nk-block nk-block-middle nk-auth-body wide-sm">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
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
                                <span>Admin</span>
                            </p>
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register</h4>
                                        <div class="nk-block-des">
                                            <p>Create New DjibMarket Admin Account</p>
                                        </div>
                                    </div>
                                </div>

                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="<?php echo e(route('admin.register')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="name">Name</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control form-control-lg"
                                                        id="name" name="name" placeholder="Enter your name"
                                                        required autofocus autocomplete="name"
                                                        value="<?php echo e(old('name')); ?>">
                                                </div>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('name'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('name')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="email">Email</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control form-control-lg"
                                                        id="email" name="email"
                                                        placeholder="Enter your email address" required
                                                        autocomplete="username" value="<?php echo e(old('email')); ?>">
                                                </div>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('email'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <a href="#"
                                                        class="form-icon form-icon-right passcode-switch lg"
                                                        data-target="password">
                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                    </a>
                                                    <input type="password" class="form-control form-control-lg"
                                                        id="password" name="password"
                                                        placeholder="Enter your passcode" required
                                                        autocomplete="new-password">
                                                </div>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label" for="password_confirmation">Confirm
                                                        Passcode</label>
                                                </div>
                                                <div class="form-control-wrap">
                                                    <a href="#"
                                                        class="form-icon form-icon-right passcode-switch lg"
                                                        data-target="password_confirmation">
                                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                    </a>
                                                    <input type="password" class="form-control form-control-lg"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Confirm your passcode" required
                                                        autocomplete="new-password">
                                                </div>
                                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password_confirmation'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password_confirmation')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="password-requirements">
                                                <div class="password-strength-bar">
                                                    <div class="strength-progress"></div>
                                                </div>
                                                <div class="strength-label">Password Strength</div>
                                                <div class="requirement-list mt-2">
                                                    <div class="requirement-item" data-requirement="length">
                                                        <span class="requirement-icon"><i
                                                                class="ni ni-check"></i></span>
                                                        <span>At least 8 characters</span>
                                                    </div>
                                                    <div class="requirement-item" data-requirement="lowercase">
                                                        <span class="requirement-icon"><i
                                                                class="ni ni-check"></i></span>
                                                        <span>At least 1 lowercase letter</span>
                                                    </div>
                                                    <div class="requirement-item" data-requirement="uppercase">
                                                        <span class="requirement-icon"><i
                                                                class="ni ni-check"></i></span>
                                                        <span>At least 1 uppercase letter</span>
                                                    </div>
                                                    <div class="requirement-item" data-requirement="number">
                                                        <span class="requirement-icon"><i
                                                                class="ni ni-check"></i></span>
                                                        <span>At least 1 number</span>
                                                    </div>
                                                    <div class="requirement-item" data-requirement="special">
                                                        <span class="requirement-icon"><i
                                                                class="ni ni-check"></i></span>
                                                        <span>At least 1 special character</span>
                                                    </div>
                                                    <div class="requirement-item" data-requirement="match">
                                                        <span class="requirement-icon"><i
                                                                class="ni ni-check"></i></span>
                                                        <span>Passwords match</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <button id="submitButton"
                                            class="submitButton btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center">
                                            <span class="button-text">Register</span>
                                            <div id="loadingSpinner"
                                                class="loadingSpinner spinner-border spinner-border-sm text-light ms-2 d-none"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4">Already have an account? <a
                                        href="<?php echo e(route('admin.login')); ?>"><strong>Sign in
                                            instead</strong></a>
                                </div>
                                <div class="text-center mt-4">
                                    <p class="text-soft">By signing up, you agree to our <a href="#">Terms of
                                            Service</a> and <a href="#">Privacy Policy</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <p class="text-soft">&copy; <?php echo e(date('Y')); ?> DjibMarket. All Rights
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
    <script src="<?php echo e(asset('assets/shared')); ?>/js/bundle.js?ver=3.2.2"></script>
    <script src="<?php echo e(asset('assets/shared')); ?>/js/scripts.js?ver=3.2.2"></script>
    <script>
        // Disable submit button on form submit
        $('form').on('submit', function(e) {
            var submitButton = $('.submitButton');

            // Disable the button
            submitButton.prop('disabled', true);

            // Show the loading spinner
            $('.loadingSpinner').removeClass('d-none');
        });

        // Password strength checker
        $(document).ready(function() {
            const passwordInput = $('#password');
            const confirmPasswordInput = $('#password_confirmation');
            const strengthProgress = $('.strength-progress');
            const strengthLabel = $('.strength-label');
            const requirementItems = $('.requirement-item');

            // Initialize default state
            strengthProgress.removeClass('weak fair good strong');
            strengthLabel.removeClass('weak fair good strong').text('Password Strength');
            requirementItems.removeClass('met');

            function updatePasswordStrength(password, confirmPassword) {
                // If password is empty, reset to default state
                if (!password || password.length === 0) {
                    strengthProgress.removeClass('weak fair good strong');
                    strengthLabel.removeClass('weak fair good strong').text('Password Strength');
                    requirementItems.removeClass('met');
                    return;
                }

                // Reset requirements
                requirementItems.removeClass('met');

                // Check each requirement
                const requirements = {
                    length: password.length >= 8,
                    lowercase: /[a-z]/.test(password),
                    uppercase: /[A-Z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[^A-Za-z0-9]/.test(password),
                    match: password === confirmPassword && password !== ''
                };

                // Update requirement items
                Object.keys(requirements).forEach(req => {
                    if (requirements[req]) {
                        $(`.requirement-item[data-requirement="${req}"]`).addClass('met');
                    }
                });

                // Calculate strength
                let metCount = Object.values(requirements).filter(Boolean).length;
                let strengthClass = '';
                let strengthText = '';

                // Update strength bar and label
                switch (metCount) {
                    case 0:
                    case 1:
                        strengthClass = 'weak';
                        strengthText = 'Weak';
                        break;
                    case 2:
                    case 3:
                        strengthClass = 'fair';
                        strengthText = 'Fair';
                        break;
                    case 4:
                    case 5:
                        strengthClass = 'good';
                        strengthText = 'Good';
                        break;
                    case 6:
                        strengthClass = 'strong';
                        strengthText = 'Strong';
                        break;
                }

                // Remove all classes and add the relevant one
                strengthProgress.removeClass('weak fair good strong').addClass(strengthClass);
                strengthLabel.removeClass('weak fair good strong').addClass(strengthClass).text(strengthText);
            }

            // Check password on input
            passwordInput.on('input', function() {
                const password = $(this).val();
                const confirmPassword = confirmPasswordInput.val();
                updatePasswordStrength(password, confirmPassword);
            });

            // Check confirm password on input
            confirmPasswordInput.on('input', function() {
                const password = passwordInput.val();
                const confirmPassword = $(this).val();
                updatePasswordStrength(password, confirmPassword);
            });

            // Also check for password clear via backspace/delete
            passwordInput.on('keyup', function(e) {
                const password = $(this).val();
                const confirmPassword = confirmPasswordInput.val();
                if (!password || password.length === 0) {
                    updatePasswordStrength('', confirmPassword);
                }
            });

            confirmPasswordInput.on('keyup', function(e) {
                const password = passwordInput.val();
                const confirmPassword = $(this).val();
                if (!confirmPassword || confirmPassword.length === 0) {
                    updatePasswordStrength(password, '');
                }
            });
        });
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/admin/auth/register.blade.php ENDPATH**/ ?>