@extends('layouts.app.buyer')

@section('title', 'Dashboard')

@section('css')
    <style>
        .dashboard-container {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 20px 0;
        }

        .dashboard-sidebar {
            background: white;
            border-radius: 0.3rem;
            /* box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
            padding: 0;
            height: fit-content;
            position: sticky;
            top: 20px;
            border: 1px solid #eee;
        }

        .dashboard-sidebar .sidebar-header {
            padding: 25px;
            border-bottom: 1px solid #eee;
            text-align: center;
        }

        .dashboard-sidebar .user-info {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .dashboard-sidebar .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .dashboard-sidebar .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dashboard-sidebar .user-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .dashboard-sidebar .user-email {
            font-size: 14px;
            color: #666;
            margin: 5px 0 0 0;
        }

        .dashboard-sidebar .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .dashboard-sidebar .sidebar-menu li {
            border-bottom: 1px solid #f0f0f0;
        }

        .dashboard-sidebar .sidebar-menu li:last-child {
            border-bottom: none;
        }

        .dashboard-sidebar .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .dashboard-sidebar .sidebar-menu a:hover,
        .dashboard-sidebar .sidebar-menu a.active {
            background-color: #f8f9fa;
            color: #007bff;
            text-decoration: none;
        }

        .dashboard-sidebar .sidebar-menu a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .dashboard-content {
            background: white;
            border-radius: 0.3rem;
            /* box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
            padding: 30px;
            margin-left: 20px;
            border: 1px solid #eee;
        }

        .dashboard-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .dashboard-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .dashboard-header p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 0.3rem;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 20px;
            color: white;
        }

        .stat-card.orders .stat-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-card.pending .stat-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card.completed .stat-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card.wishlist .stat-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-card .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .stat-card .stat-label {
            font-size: 14px;
            color: #666;
            margin: 5px 0 0 0;
        }

        .alert {
            border-radius: 0.3rem;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .dashboard-content {
                margin-left: 0;
                margin-top: 20px;
            }

            .dashboard-sidebar {
                position: relative;
                top: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-container">
        <div class="container" style="max-width: 95%;">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 col-md-4">
                    <div class="dashboard-sidebar">
                        <div class="sidebar-header">
                            <div class="user-info">
                                <div class="user-avatar">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                            onerror="this.style.display='none'; this.parentNode.innerHTML='{{ Auth::user()->initials }}';">
                                    @else
                                        {{ Auth::user()->initials }}
                                    @endif
                                </div>
                                <h4 class="user-name">{{ Auth::user()->name }}</h4>
                                <p class="user-email">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <ul class="sidebar-menu">
                            <li>
                                <a href="{{ route('buyer.dashboard.index') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.index') ? 'active' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.profile') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.profile') ? 'active' : '' }}">
                                    <i class="fas fa-user"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.orders') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.orders*') ? 'active' : '' }}">
                                    <i class="fas fa-shopping-bag"></i>
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.addresses') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.addresses') ? 'active' : '' }}">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Addresses
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.wishlist') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.wishlist') ? 'active' : '' }}">
                                    <i class="fas fa-heart"></i>
                                    Wishlist
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.tracking') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.tracking') ? 'active' : '' }}">
                                    <i class="fas fa-truck"></i>
                                    Order Tracking
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.return-requests') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.return-requests') ? 'active' : '' }}">
                                    <i class="fas fa-undo"></i>
                                    Return Requests
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.browsing-history') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.browsing-history') ? 'active' : '' }}">
                                    <i class="fas fa-history"></i>
                                    Browsing History
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buyer.dashboard.cart') }}"
                                    class="{{ request()->routeIs('buyer.dashboard.cart') ? 'active' : '' }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    My Cart
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-content">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @yield('dashboard-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
