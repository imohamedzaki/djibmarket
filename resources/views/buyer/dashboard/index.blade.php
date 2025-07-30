@extends('buyer.dashboard.layout')

@section('dashboard-content')
    <!-- Modern Dashboard Header -->
    <div class="modern-dashboard-header">
        <div class="dashboard-welcome">
            <div class="welcome-text">
                <h1 class="welcome-title">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="welcome-subtitle">Here's your account overview and recent activity</p>
            </div>
            <div class="welcome-date">
                <div class="date-badge">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ date('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Stats Grid -->
    <div class="modern-stats-grid">
        <div class="modern-stat-card orders-card">
            <div class="stat-card-content">
                <div class="stat-header">
                    <div class="stat-icon-container orders-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-number">{{ $stats['total_orders'] }}</h3>
                    <p class="stat-label">Total Orders</p>
                    <span class="stat-change">+12% from last month</span>
                </div>
            </div>
            <div class="stat-card-footer">
                <a href="{{ route('buyer.dashboard.orders') }}" class="stat-link">
                    <span>View Orders</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="modern-stat-card pending-card">
            <div class="stat-card-content">
                <div class="stat-header">
                    <div class="stat-icon-container pending-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-trend neutral">
                        <i class="fas fa-minus"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-number">{{ $stats['pending_orders'] }}</h3>
                    <p class="stat-label">Pending Orders</p>
                    <span class="stat-change">Awaiting processing</span>
                </div>
            </div>
            <div class="stat-card-footer">
                <a href="{{ route('buyer.dashboard.orders') }}?status=pending" class="stat-link">
                    <span>View Pending</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="modern-stat-card completed-card">
            <div class="stat-card-content">
                <div class="stat-header">
                    <div class="stat-icon-container completed-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-number">{{ $stats['completed_orders'] }}</h3>
                    <p class="stat-label">Completed Orders</p>
                    <span class="stat-change">+8% this month</span>
                </div>
            </div>
            <div class="stat-card-footer">
                <a href="{{ route('buyer.dashboard.orders') }}?status=delivered" class="stat-link">
                    <span>View Completed</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="modern-stat-card wishlist-card">
            <div class="stat-card-content">
                <div class="stat-header">
                    <div class="stat-icon-container wishlist-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-trend positive">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-body">
                    <h3 class="stat-number">{{ $stats['wishlist_items'] }}</h3>
                    <p class="stat-label">Wishlist Items</p>
                    <span
                        class="stat-change">{{ $stats['wishlist_items'] > 0 ? 'Ready to purchase' : 'Start saving favorites' }}</span>
                </div>
            </div>
            <div class="stat-card-footer">
                <a href="{{ route('buyer.dashboard.wishlist') }}" class="stat-link">
                    <span>View Wishlist</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Modern Content Grid -->
    <div class="modern-dashboard-grid">
        <!-- Recent Orders Section -->
        <div class="dashboard-main-content">
            <div class="modern-card orders-section">
                <div class="modern-card-header">
                    <div class="card-header-content">
                        <div class="section-title-group">
                            <h5 class="section-title">Recent Orders</h5>
                            <span class="section-subtitle">Your latest purchases and their status</span>
                        </div>
                        <a href="{{ route('buyer.dashboard.orders') }}" class="modern-btn btn-primary">
                            <span>View All Orders</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="modern-card-body">
                    @if ($recent_orders->count() > 0)
                        <div class="modern-orders-list">
                            @foreach ($recent_orders as $order)
                                <div class="order-item">
                                    <div class="order-item-header">
                                        <div class="order-info">
                                            <a href="{{ route('buyer.dashboard.orders.show', $order) }}"
                                                class="order-number">
                                                #{{ $order->order_number ?? 'ORD-' . $order->id }}
                                            </a>
                                            <span
                                                class="order-date">{{ $order->created_at->format('M d, Y \a\t g:i A') }}</span>
                                        </div>
                                        <div class="order-status">
                                            <span
                                                class="modern-status-badge status-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : ($order->status == 'canceled' ? 'danger' : 'info')) }}">
                                                <span class="status-dot"></span>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="order-item-body">
                                        <div class="order-products">
                                            @foreach ($order->orderItems->take(2) as $item)
                                                @if ($item->product)
                                                    <div class="product-thumb">
                                                        <img src="{{ $item->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                            alt="{{ $item->product->title }}"
                                                            onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if ($order->orderItems->count() > 2)
                                                <div class="product-more">+{{ $order->orderItems->count() - 2 }}</div>
                                            @endif
                                        </div>
                                        <div class="order-details">
                                            <span class="order-items">{{ $order->orderItems->count() }}
                                                {{ Str::plural('item', $order->orderItems->count()) }}</span>
                                            <span class="order-total">{{ number_format($order->final_price, 0) }}
                                                DJF</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="modern-empty-state">
                            <div class="empty-state-illustration">
                                <div class="empty-icon-wrapper">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <div class="empty-state-content">
                                <h3 class="empty-title">No orders yet</h3>
                                <p class="empty-description">When you place your first order, it will appear here. Start
                                    browsing our amazing products!</p>
                                <a href="{{ route('buyer.home') }}" class="modern-btn btn-primary">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>Start Shopping</span>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recently Viewed Sidebar -->
        <div class="dashboard-sidebar-content">
            <div class="modern-card browsing-section">
                <div class="modern-card-header">
                    <div class="card-header-content">
                        <div class="section-title-group">
                            <h5 class="section-title">Recently Viewed</h5>
                            <span class="section-subtitle">Products you've browsed</span>
                        </div>
                        <a href="{{ route('buyer.dashboard.browsing-history') }}"
                            class="modern-btn btn-secondary btn-sm">
                            <span>View All</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="modern-card-body">
                    @if ($recent_browsing->count() > 0)
                        <div class="modern-browsing-list">
                            @foreach ($recent_browsing as $history)
                                <div class="browsing-item">
                                    <div class="browsing-item-image">
                                        @if ($history->product)
                                            <img src="{{ $history->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                alt="{{ $history->product->title }}"
                                                onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                        @else
                                            <div class="browsing-item-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="browsing-item-content">
                                        @if ($history->product)
                                            <h6 class="browsing-item-title">
                                                <a href="{{ route('buyer.product.show', $history->product) }}">
                                                    {{ Str::limit($history->product->title, 35) }}
                                                </a>
                                            </h6>
                                            <div class="browsing-item-meta">
                                                @if ($history->product->price)
                                                    <span
                                                        class="product-price">{{ number_format($history->product->price, 0) }}
                                                        DJF</span>
                                                @endif
                                                <span
                                                    class="browsing-time">{{ $history->viewed_at->diffForHumans() }}</span>
                                            </div>
                                        @else
                                            <h6 class="browsing-item-title unavailable">Product no longer available</h6>
                                            <div class="browsing-item-meta">
                                                <span
                                                    class="browsing-time">{{ $history->viewed_at->diffForHumans() }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="modern-empty-state compact">
                            <div class="empty-state-illustration">
                                <div class="empty-icon-wrapper">
                                    <i class="fas fa-history"></i>
                                </div>
                            </div>
                            <div class="empty-state-content">
                                <h4 class="empty-title">No history yet</h4>
                                <p class="empty-description">Start browsing products to see your viewing history here</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="modern-card quick-actions-section mt-4">
                <div class="modern-card-header">
                    <div class="section-title-group">
                        <h5 class="section-title">Quick Actions</h5>
                        <span class="section-subtitle">Frequently used features</span>
                    </div>
                </div>
                <div class="modern-card-body">
                    <div class="quick-actions-grid">
                        <a href="{{ route('buyer.dashboard.addresses') }}" class="quick-action-item">
                            <div class="quick-action-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="quick-action-content">
                                <span class="quick-action-title">Addresses</span>
                                <span class="quick-action-count">{{ $stats['addresses'] }} saved</span>
                            </div>
                        </a>

                        <a href="{{ route('buyer.dashboard.return-requests') }}" class="quick-action-item">
                            <div class="quick-action-icon">
                                <i class="fas fa-undo-alt"></i>
                            </div>
                            <div class="quick-action-content">
                                <span class="quick-action-title">Returns</span>
                                <span class="quick-action-count">{{ $stats['return_requests'] }} requests</span>
                            </div>
                        </a>

                        <a href="{{ route('buyer.dashboard.tracking') }}" class="quick-action-item">
                            <div class="quick-action-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="quick-action-content">
                                <span class="quick-action-title">Track Orders</span>
                                <span class="quick-action-count">Live tracking</span>
                            </div>
                        </a>

                        <a href="{{ route('checkout.index') }}" class="quick-action-item">
                            <div class="quick-action-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="quick-action-content">
                                <span class="quick-action-title">Checkout</span>
                                <span class="quick-action-count">Complete purchase</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Modern Dashboard Variables */
        :root {
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-success: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-warning: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-info: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Modern Dashboard Header */
        .modern-dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-welcome {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            border-radius: 16px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .dashboard-welcome::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 40%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: rotate(15deg);
        }

        .welcome-text {
            position: relative;
            z-index: 2;
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            line-height: 1.2;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 400;
        }

        .welcome-date {
            position: relative;
            z-index: 2;
        }

        .date-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.75rem 1rem;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            font-weight: 500;
        }

        /* Modern Stats Grid */
        .modern-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .modern-stat-card {
            background: white;
            border-radius: 16px;
            padding: 0;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .modern-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .stat-card-content {
            padding: 1.5rem;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-icon-container {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .orders-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .pending-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .completed-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .wishlist-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-trend {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .stat-trend.positive {
            background: #ecfdf5;
            color: #065f46;
        }

        .stat-trend.neutral {
            background: #f3f4f6;
            color: #6b7280;
        }

        .stat-body {
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 0.25rem 0;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
            margin: 0 0 0.5rem 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-change {
            font-size: 0.8125rem;
            color: #9ca3af;
            font-weight: 400;
        }

        .stat-card-footer {
            background: #f9fafb;
            padding: 1rem 1.5rem;
            border-top: 1px solid #f3f4f6;
        }

        .stat-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }

        .stat-link:hover {
            color: #667eea;
            text-decoration: none;
        }

        /* Modern Dashboard Grid */
        .modern-dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Modern Cards */
        .modern-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .modern-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .modern-card-header {
            padding: 1.5rem 1.5rem 0;
            border-bottom: 1px solid #f3f4f6;
            margin-bottom: 1.5rem;
        }

        .card-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .section-title-group {
            flex: 1;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 0.25rem 0;
        }

        .section-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin: 0;
        }

        .modern-card-body {
            padding: 0 1.5rem 1.5rem;
        }

        /* Modern Buttons */
        .modern-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .modern-btn.btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .modern-btn.btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            text-decoration: none;
            color: white;
        }

        .modern-btn.btn-secondary {
            background: #f9fafb;
            color: #374151;
            border-color: #e5e7eb;
        }

        .modern-btn.btn-secondary:hover {
            background: #f3f4f6;
            color: #1f2937;
            text-decoration: none;
        }

        .modern-btn.btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
        }

        /* Modern Orders List */
        .modern-orders-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .order-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
            transition: all 0.2s ease;
        }

        .order-item:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .order-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .order-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .order-number {
            font-weight: 600;
            color: #667eea;
            text-decoration: none;
            font-size: 1rem;
        }

        .order-number:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .order-date {
            font-size: 0.8125rem;
            color: #6b7280;
        }

        .modern-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .modern-status-badge.status-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .modern-status-badge.status-success .status-dot {
            background: #10b981;
        }

        .modern-status-badge.status-warning {
            background: #fffbeb;
            color: #92400e;
        }

        .modern-status-badge.status-warning .status-dot {
            background: #f59e0b;
        }

        .modern-status-badge.status-info {
            background: #eff6ff;
            color: #1e40af;
        }

        .modern-status-badge.status-info .status-dot {
            background: #3b82f6;
        }

        .modern-status-badge.status-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .modern-status-badge.status-danger .status-dot {
            background: #ef4444;
        }

        .order-item-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-products {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .product-thumb {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .product-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-more {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
        }

        .order-details {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.25rem;
        }

        .order-items {
            font-size: 0.8125rem;
            color: #6b7280;
        }

        .order-total {
            font-weight: 600;
            color: #1f2937;
            font-size: 1rem;
        }

        /* Modern Browsing List */
        .modern-browsing-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .browsing-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 8px;
            transition: background-color 0.2s ease;
            border: 1px solid transparent;
        }

        .browsing-item:hover {
            background: #f8fafc;
            border-color: #e2e8f0;
        }

        .browsing-item-image {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .browsing-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .browsing-item-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 1.5rem;
        }

        .browsing-item-content {
            flex: 1;
            min-width: 0;
        }

        .browsing-item-title {
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0 0 0.5rem 0;
            line-height: 1.3;
        }

        .browsing-item-title a {
            color: #1f2937;
            text-decoration: none;
        }

        .browsing-item-title a:hover {
            color: #667eea;
        }

        .browsing-item-title.unavailable {
            color: #9ca3af;
        }

        .browsing-item-meta {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .product-price {
            font-weight: 600;
            color: #667eea;
            font-size: 0.875rem;
        }

        .browsing-time {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        /* Quick Actions */
        .quick-actions-grid {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .quick-action-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem;
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .quick-action-item:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            text-decoration: none;
            transform: translateX(4px);
        }

        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .quick-action-content {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .quick-action-title {
            font-weight: 500;
            color: #1f2937;
            font-size: 0.875rem;
        }

        .quick-action-count {
            font-size: 0.75rem;
            color: #6b7280;
        }

        /* Modern Empty States */
        .modern-empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .modern-empty-state.compact {
            padding: 2rem 1rem;
        }

        .empty-state-illustration {
            margin-bottom: 1.5rem;
        }

        .empty-icon-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #9ca3af;
        }

        .modern-empty-state.compact .empty-icon-wrapper {
            width: 64px;
            height: 64px;
            font-size: 1.5rem;
        }

        .empty-state-content h3,
        .empty-state-content h4 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 0.5rem 0;
        }

        .empty-state-content .empty-title {
            font-size: 1rem;
            font-weight: 600;
            color: #374151;
            margin: 0 0 0.5rem 0;
        }

        .empty-state-content .empty-description {
            color: #6b7280;
            margin: 0 0 1.5rem 0;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .modern-dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .modern-stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 1rem;
            }

            .dashboard-welcome {
                padding: 1.5rem;
            }

            .welcome-title {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 768px) {
            .dashboard-welcome {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .dashboard-welcome::before {
                display: none;
            }

            .modern-stats-grid {
                grid-template-columns: 1fr;
            }

            .card-header-content {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .order-item-header {
                flex-direction: column;
                gap: 0.5rem;
                align-items: stretch;
            }

            .order-item-body {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .order-details {
                align-items: flex-start;
                flex-direction: row;
                justify-content: space-between;
            }
        }

        @media (max-width: 640px) {

            .modern-dashboard-header,
            .modern-stats-grid,
            .modern-dashboard-grid {
                margin-bottom: 1rem;
            }

            .modern-card-header,
            .modern-card-body {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .stat-card-content {
                padding: 1rem;
            }

            .stat-card-footer {
                padding: 0.75rem 1rem;
            }
        }
    </style>
@endsection
