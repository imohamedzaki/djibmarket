

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('css'); ?>
    <style>
        :root {
            /* Primary Colors */
            --primary-50: #eff6ff;
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --primary-700: #1d4ed8;

            /* Neutral Colors */
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-900: #111827;

            /* Accent Colors */
            --green-50: #f0fdf4;
            --green-100: #dcfce7;
            --green-600: #16a34a;
            --green-800: #166534;
            --purple-50: #faf5ff;
            --purple-600: #9333ea;
            --orange-50: #fff7ed;
            --orange-600: #ea580c;
            --yellow-100: #fef3c7;
            --yellow-800: #92400e;

            /* Spacing */
            --spacing-xs: 4px;
            --spacing-sm: 8px;
            --spacing-md: 16px;
            --spacing-lg: 24px;
            --spacing-xl: 32px;

            /* Border radius */
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-900);
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .dashboard-container {
            min-height: 100vh;
            background: var(--gray-50);
        }

        /* Dashboard Layout */
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
            border-bottom: 1px solid var(--gray-200);
        }

        /* Sidebar */
        .dashboard-sidebar {
            width: 256px;
            background: var(--white);
            border-right: 1px solid var(--gray-200);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: var(--spacing-lg);
            border-bottom: 1px solid var(--gray-200);
            /* background: var(--primary-600); */
            background: linear-gradient(90deg, #2e3ca563 0%, #81a7ff 100% 100%);
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-lg);
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 600;
            color: white;
            overflow: hidden;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-email {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: var(--spacing-lg) 0;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-sm);
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0 var(--spacing-md);
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            padding: 12px var(--spacing-md);
            color: var(--gray-600);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar-menu a:hover {
            background: var(--gray-100);
            color: var(--gray-700);
        }

        .sidebar-menu a.active {
            background: var(--primary-50);
            color: var(--primary-700);
            border-right: 3px solid var(--primary-600);
        }

        .sidebar-menu a i {
            width: 24px;
            font-size: 20px;
            font-weight: bold;
            flex-shrink: 0;
            text-align: center;
        }

        /* Main Content Area */
        .dashboard-main {
            flex: 1;
            padding: var(--spacing-xl);
            overflow-y: auto;
        }

        .dashboard-content-inner {
            max-width: 95%;
            margin: 0 auto;
        }

        /* Dashboard Header */
        .dashboard-header {
            margin-bottom: var(--spacing-xl);
        }

        .dashboard-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
            line-height: 1.2;
        }

        .dashboard-header p {
            color: var(--gray-600);
            margin: 0;
            font-size: 14px;
        }

        /* Cards */
        .card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: var(--spacing-lg);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transition: box-shadow 0.2s ease;
        }

        .card-header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: var(--spacing-lg);
            font-weight: 600;
            color: var(--gray-900);
        }

        .card-body {
            padding: var(--spacing-lg);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: var(--spacing-lg);
            box-shadow: var(--shadow-sm);
            transition: all 0.2s ease;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .stat-card .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: var(--spacing-md);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--white);
        }

        .stat-card.orders .stat-icon {
            background: var(--primary-600);
        }

        .stat-card.pending .stat-icon {
            background: var(--orange-600);
        }

        .stat-card.completed .stat-icon {
            background: var(--green-600);
        }

        .stat-card.wishlist .stat-icon {
            background: var(--purple-600);
        }

        .stat-card .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            margin: 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Alerts */
        .alert {
            border-radius: var(--radius-md);
            border: 1px solid;
            padding: var(--spacing-md) var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-sm);
        }

        .alert-success {
            background: var(--green-50);
            border-color: var(--green-100);
            color: var(--green-800);
        }

        .alert-danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .alert-icon {
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-wrapper {
                flex-direction: column;
            }

            .dashboard-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--gray-200);
                padding: var(--spacing-md);
            }

            .sidebar-menu {
                flex-direction: row;
                overflow-x: auto;
                gap: var(--spacing-xs);
                padding-bottom: var(--spacing-sm);
            }

            .sidebar-menu li {
                flex-shrink: 0;
            }

            .sidebar-menu a {
                white-space: nowrap;
                padding: var(--spacing-sm) var(--spacing-md);
            }

            .dashboard-main {
                padding: var(--spacing-lg);
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: var(--spacing-md);
            }
        }

        @media (max-width: 640px) {
            .dashboard-main {
                padding: var(--spacing-md);
            }

            .dashboard-header h1 {
                font-size: 20px;
            }

            .card-header,
            .card-body {
                padding: var(--spacing-md);
            }

            .stat-card {
                padding: var(--spacing-md);
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
            }
        }

        /* Custom Scrollbar */
        .dashboard-main::-webkit-scrollbar,
        .dashboard-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .dashboard-main::-webkit-scrollbar-track,
        .dashboard-sidebar::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        .dashboard-main::-webkit-scrollbar-thumb,
        .dashboard-sidebar::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 3px;
        }

        .dashboard-main::-webkit-scrollbar-thumb:hover,
        .dashboard-sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--gray-600);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-container">
        <div class="dashboard-wrapper">
            <!-- Modern Sidebar -->
            <div class="dashboard-sidebar">
                <div class="sidebar-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            <?php if(Auth::user()->avatar): ?>
                                <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                                    onerror="this.style.display='none'; this.parentNode.innerHTML='<?php echo e(Auth::user()->initials); ?>';">
                            <?php else: ?>
                                <?php echo e(Auth::user()->initials); ?>

                            <?php endif; ?>
                        </div>
                        <div class="user-details">
                            <h4 class="user-name"><?php echo e(Auth::user()->name); ?></h4>
                            <p class="user-email"><?php echo e(Auth::user()->email); ?></p>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.index')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.index') ? 'active' : ''); ?>">
                            <i class="ti ti-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.profile')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.profile') ? 'active' : ''); ?>">
                            <i class="ti ti-user"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.orders')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.orders*') ? 'active' : ''); ?>">
                            <i class="ti ti-package"></i>
                            <span>My Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.addresses')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.addresses') ? 'active' : ''); ?>">
                            <i class="ti ti-map-pin"></i>
                            <span>Addresses</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.wishlist')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.wishlist') ? 'active' : ''); ?>">
                            <i class="ti ti-heart"></i>
                            <span>Wishlist</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.tracking')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.tracking') ? 'active' : ''); ?>">
                            <i class="ti ti-truck"></i>
                            <span>Order Tracking</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.return-requests')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.return-requests') ? 'active' : ''); ?>">
                            <i class="ti ti-rotate-clockwise-2"></i>
                            <span>Return Requests</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.browsing-history')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.browsing-history') ? 'active' : ''); ?>">
                            <i class="ti ti-history"></i>
                            <span>Browsing History</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('buyer.dashboard.cart')); ?>"
                            class="<?php echo e(request()->routeIs('buyer.dashboard.cart') ? 'active' : ''); ?>">
                            <i class="ti ti-shopping-cart"></i>
                            <span>My Cart</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content Area -->
            <div class="dashboard-main">
                <div class="dashboard-content-inner">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <i class="ti ti-check alert-icon"></i>
                            <div><?php echo e(session('success')); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <i class="ti ti-alert-circle alert-icon"></i>
                            <div>
                                <ul style="margin: 0; padding-left: 16px;">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->yieldContent('dashboard-content'); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app.buyer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/layout.blade.php ENDPATH**/ ?>