@extends('buyer.dashboard.layout')

@section('dashboard-content')
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <div>
                <h1>My Orders</h1>
                <p>Track and manage all your orders in one place.</p>
            </div>
            <div class="dashboard-header-actions">
                <a href="{{ route('buyer.home') }}" class="btn btn-outline-primary">
                    <i class="fas fa-shopping-bag me-1"></i>
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>

    @if ($orders->count() > 0)
        <!-- Filters Section -->
        <div class="filters-card">
            <div class="filters-content">
                <div class="filters-row">
                    <div class="filter-group">
                        <input type="text" class="filter-input" placeholder="Search orders..." id="search-input">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="status-filter">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="date-filter">
                            <option value="">All Time</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                    <div class="filter-actions">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearFilters()">
                            <i class="fas fa-times me-1"></i>
                            Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="orders-table-card">
            <div class="orders-table-header">
                <h3 class="table-title">Orders</h3>
                <div class="table-info">
                    Showing {{ $orders->count() }} of {{ $orders->total() }} orders
                </div>
            </div>

            <div class="modern-table-container">
                <table class="modern-table orders-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Tracking</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="order-row" data-status="{{ $order->status }}"
                                data-date="{{ $order->created_at->format('Y-m-d') }}">
                                <td>
                                    <div class="order-cell">
                                        <div class="order-number">
                                            #{{ $order->order_number ?? 'ORD-' . $order->id }}
                                        </div>
                                        <div class="order-subtitle">
                                            {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="date-cell">
                                        <span class="date-primary">{{ $order->created_at->format('M d, Y') }}</span>
                                        <span class="date-secondary">{{ $order->created_at->format('g:i A') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="status-badge status-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : ($order->status == 'canceled' ? 'danger' : 'info')) }}">
                                        <span class="status-dot"></span>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="items-cell">
                                        <div class="items-preview">
                                            @foreach ($order->orderItems->take(3) as $item)
                                                <div class="item-image">
                                                    @if ($item->product)
                                                        <img src="{{ $item->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                            alt="{{ $item->product->title }}"
                                                            onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                                    @else
                                                        <div class="item-placeholder">
                                                            <i class="fas fa-image"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                            @if ($order->orderItems->count() > 3)
                                                <div class="item-more">+{{ $order->orderItems->count() - 3 }}</div>
                                            @endif
                                        </div>
                                        <div class="items-count">{{ $order->orderItems->count() }} items</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="price-cell">
                                        <span class="price-main">{{ number_format($order->final_price, 0) }} DJF</span>
                                        @if ($order->shipping_cost > 0)
                                            <span class="price-sub">+{{ number_format($order->shipping_cost, 0) }}
                                                shipping</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if ($order->tracking_number)
                                        <div class="tracking-cell">
                                            <span class="tracking-number">{{ $order->tracking_number }}</span>
                                            <button class="btn-copy"
                                                onclick="copyTracking('{{ $order->tracking_number }}')">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-cell">
                                        <a href="{{ route('buyer.dashboard.orders.show', $order) }}"
                                            class="action-btn action-btn-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($order->tracking_number)
                                            <a href="{{ route('buyer.dashboard.tracking') }}"
                                                class="action-btn action-btn-secondary" title="Track Order">
                                                <i class="fas fa-truck"></i>
                                            </a>
                                        @endif
                                        <div class="action-dropdown">
                                            <button class="action-btn action-btn-menu" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('buyer.dashboard.orders.invoice', $order) }}"
                                                    class="dropdown-item">
                                                    <i class="fas fa-download me-2"></i>
                                                    Download Invoice
                                                </a>
                                                @if ($order->canBeCanceled())
                                                    <button onclick="cancelOrder({{ $order->id }})"
                                                        class="dropdown-item dropdown-item-danger">
                                                        <i class="fas fa-times me-2"></i>
                                                        Cancel Order
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="table-pagination">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <div class="empty-state-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="empty-state-title">No orders found</h3>
                <p class="empty-state-text">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                <a href="{{ route('buyer.home') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Start Shopping
                </a>
            </div>
        </div>
    @endif

    <style>
        .dashboard-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }

        .dashboard-header-actions {
            flex-shrink: 0;
        }

        .dashboard-main.btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid;
            cursor: pointer;
        }

        .dashboard-main.btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .dashboard-main.btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            text-decoration: none;
        }

        .dashboard-main.btn-outline-primary {
            background: transparent;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .dashboard-main.btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        .dashboard-main.btn-outline-secondary {
            background: transparent;
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        .dashboard-main.btn-outline-secondary:hover {
            background: var(--light-color);
            color: var(--text-primary);
            text-decoration: none;
        }

        .dashboard-main.btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        /* Filters Card */
        .filters-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        .filters-content {
            padding: 1.5rem;
        }

        .filters-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            min-width: 200px;
        }

        .filter-input,
        .filter-select {
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            background: var(--white);
            transition: all 0.2s ease;
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .filter-actions {
            display: flex;
            align-items: end;
            margin-left: auto;
        }

        /* Orders Table Card */
        .orders-table-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .orders-table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .table-info {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Modern Table */
        .modern-table-container {
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .orders-table th {
            background: var(--light-color);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem;
            text-align: left;
            border: none;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .orders-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .orders-table tbody tr:hover {
            background: var(--light-color);
        }

        .orders-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Table Cell Styles */
        .order-cell {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .order-number {
            font-weight: 600;
            color: var(--text-primary);
        }

        .order-subtitle {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .date-cell {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .date-primary {
            font-weight: 500;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .date-secondary {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-badge.status-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .status-badge.status-success .status-dot {
            background: #10b981;
        }

        .status-badge.status-warning {
            background: #fffbeb;
            color: #92400e;
        }

        .status-badge.status-warning .status-dot {
            background: #f59e0b;
        }

        .status-badge.status-info {
            background: #eff6ff;
            color: #1e40af;
        }

        .status-badge.status-info .status-dot {
            background: #3b82f6;
        }

        .status-badge.status-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .status-badge.status-danger .status-dot {
            background: #ef4444;
        }

        .items-cell {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .items-preview {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .item-image {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            background: var(--light-color);
            border: 1px solid var(--border-color);
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 0.75rem;
        }

        .item-more {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            background: var(--light-color);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6875rem;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .items-count {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .price-cell {
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .price-main {
            font-weight: 600;
            color: var(--text-primary);
        }

        .price-sub {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .tracking-cell {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tracking-number {
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.75rem;
            background: var(--light-color);
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-sm);
            color: var(--text-primary);
        }

        .btn-copy {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .btn-copy:hover {
            color: var(--primary-color);
            background: var(--light-color);
        }

        .actions-cell {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .action-btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .action-btn-primary:hover {
            background: var(--primary-dark);
            color: white;
            text-decoration: none;
        }

        .action-btn-secondary {
            background: var(--light-color);
            color: var(--text-secondary);
        }

        .action-btn-secondary:hover {
            background: var(--border-color);
            color: var(--text-primary);
            text-decoration: none;
        }

        .action-btn-menu {
            background: transparent;
            color: var(--text-secondary);
        }

        .action-btn-menu:hover {
            background: var(--light-color);
            color: var(--text-primary);
        }

        .action-dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: fixed;
            z-index: 1000;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            min-width: 160px;
            padding: 0.5rem 0;
            display: none;
            transform: translateY(0.25rem);
            opacity: 0;
            transition: all 0.2s ease;
            pointer-events: none;
        }

        .dropdown-menu.show {
            display: block;
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 0.875rem;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--light-color);
            color: var(--text-primary);
            text-decoration: none;
        }

        .dropdown-item-danger {
            color: var(--danger-color);
        }

        .dropdown-item-danger:hover {
            background: #fef2f2;
            color: var(--danger-color);
        }

        /* Pagination */
        .table-pagination {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: center;
        }

        /* Empty State */
        .empty-state-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--text-secondary);
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
        }

        .empty-state-text {
            color: var(--text-secondary);
            margin: 0 0 2rem 0;
            font-size: 1rem;
        }

        .text-muted {
            color: var(--text-secondary);
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .filters-row {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                min-width: auto;
            }

            .filter-actions {
                margin-left: 0;
                align-self: flex-start;
            }

            .orders-table th,
            .orders-table td {
                padding: 0.75rem;
            }

            .dashboard-header-content {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .dashboard-header-content {
                text-align: center;
            }

            .filters-content {
                padding: 1rem;
            }

            .orders-table-header {
                padding: 1rem;
                flex-direction: column;
                gap: 0.5rem;
                align-items: stretch;
            }

            .orders-table th,
            .orders-table td {
                padding: 0.5rem;
            }

            .items-preview {
                flex-wrap: wrap;
            }

            .actions-cell {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>

    <script>
        // Filter functionality
        function clearFilters() {
            document.getElementById('search-input').value = '';
            document.getElementById('status-filter').value = '';
            document.getElementById('date-filter').value = '';
            filterOrders();
        }

        function filterOrders() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value;
            const dateFilter = document.getElementById('date-filter').value;

            const rows = document.querySelectorAll('.order-row');

            rows.forEach(row => {
                let show = true;

                // Search filter
                if (searchTerm) {
                    const orderText = row.textContent.toLowerCase();
                    if (!orderText.includes(searchTerm)) {
                        show = false;
                    }
                }

                // Status filter
                if (statusFilter && row.dataset.status !== statusFilter) {
                    show = false;
                }

                // Date filter (simplified - you might want to implement proper date filtering)
                if (dateFilter) {
                    const orderDate = new Date(row.dataset.date);
                    const now = new Date();

                    switch (dateFilter) {
                        case 'today':
                            if (orderDate.toDateString() !== now.toDateString()) {
                                show = false;
                            }
                            break;
                        case 'week':
                            const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                            if (orderDate < weekAgo) {
                                show = false;
                            }
                            break;
                        case 'month':
                            if (orderDate.getMonth() !== now.getMonth() || orderDate.getFullYear() !== now
                                .getFullYear()) {
                                show = false;
                            }
                            break;
                        case 'year':
                            if (orderDate.getFullYear() !== now.getFullYear()) {
                                show = false;
                            }
                            break;
                    }
                }

                row.style.display = show ? '' : 'none';
            });
        }

        // Event listeners
        document.getElementById('search-input').addEventListener('input', filterOrders);
        document.getElementById('status-filter').addEventListener('change', filterOrders);
        document.getElementById('date-filter').addEventListener('change', filterOrders);

        // Dropdown functionality
        function toggleDropdown(button) {
            const dropdown = button.nextElementSibling;
            const isOpen = dropdown.classList.contains('show');

            // Close all dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });

            // Toggle current dropdown
            if (!isOpen) {
                positionDropdown(button, dropdown);
                dropdown.classList.add('show');
            }
        }

        function positionDropdown(button, dropdown) {
            const buttonRect = button.getBoundingClientRect();
            const dropdownRect = dropdown.getBoundingClientRect();
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;

            // Default position: below the button, aligned to the right
            let top = buttonRect.bottom + 4;
            let left = buttonRect.right - 160; // dropdown min-width is 160px

            // Check if it would go outside the right edge of the viewport
            if (left < 8) {
                left = buttonRect.left; // Align to left of button instead
            }

            // Check if it would go outside the left edge of the viewport
            if (left + 160 > viewportWidth - 8) {
                left = viewportWidth - 160 - 8; // Keep within viewport with 8px margin
            }

            // Check if it would go outside the bottom of the viewport
            if (top + 100 > viewportHeight - 8) { // Assuming max dropdown height of ~100px
                top = buttonRect.top - 100 - 4; // Position above the button instead
            }

            // Ensure it doesn't go above the viewport
            if (top < 8) {
                top = 8;
            }

            dropdown.style.top = `${top}px`;
            dropdown.style.left = `${left}px`;
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.action-dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });

        // Close dropdowns on scroll and resize to prevent positioning issues
        window.addEventListener('scroll', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });

        window.addEventListener('resize', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });

        // Copy tracking number
        function copyTracking(trackingNumber) {
            navigator.clipboard.writeText(trackingNumber).then(function() {
                // Show success feedback
                const button = event.target.closest('.btn-copy');
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.style.color = 'var(--success-color)';

                setTimeout(() => {
                    button.innerHTML = originalIcon;
                    button.style.color = '';
                }, 2000);
            });
        }

        // Custom Dialog Function
        function showCustomDialog(options) {
            const {
                title = 'Confirm',
                    message = 'Are you sure?',
                    confirmText = 'Confirm',
                    cancelText = 'Cancel',
                    type = 'info',
                    onConfirm = () => {},
                    onCancel = () => {}
            } = options;

            // Remove existing dialogs
            document.querySelectorAll('.custom-dialog-overlay').forEach(dialog => dialog.remove());

            // Create dialog overlay
            const overlay = document.createElement('div');
            overlay.className = 'custom-dialog-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            `;

            // Create dialog box
            const dialog = document.createElement('div');
            dialog.className = 'custom-dialog';
            dialog.style.cssText = `
                background: white;
                border-radius: 12px;
                padding: 0;
                max-width: 400px;
                width: 90%;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                transform: scale(0.9);
                transition: transform 0.3s ease;
                overflow: hidden;
            `;

            const colors = {
                info: {
                    bg: '#3b82f6',
                    light: '#dbeafe'
                },
                warning: {
                    bg: '#f59e0b',
                    light: '#fef3c7'
                },
                danger: {
                    bg: '#ef4444',
                    light: '#fee2e2'
                },
                success: {
                    bg: '#10b981',
                    light: '#d1fae5'
                }
            };

            const color = colors[type] || colors.info;

            dialog.innerHTML = `
                <div style="background: ${color.light}; padding: 20px; border-bottom: 1px solid #e5e7eb;">
                    <h3 style="margin: 0; color: ${color.bg}; font-size: 18px; font-weight: 600;">${title}</h3>
                </div>
                <div style="padding: 20px;">
                    <p style="margin: 0 0 20px 0; color: #374151; line-height: 1.5;">${message}</p>
                    <div style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button class="dialog-cancel-btn" style="
                            padding: 10px 20px;
                            border: 1px solid #d1d5db;
                            background: white;
                            color: #374151;
                            border-radius: 6px;
                            cursor: pointer;
                            font-weight: 500;
                            transition: all 0.2s ease;
                        ">${cancelText}</button>
                        <button class="dialog-confirm-btn" style="
                            padding: 10px 20px;
                            border: none;
                            background: ${color.bg};
                            color: white;
                            border-radius: 6px;
                            cursor: pointer;
                            font-weight: 500;
                            transition: all 0.2s ease;
                        ">${confirmText}</button>
                    </div>
                </div>
            `;

            overlay.appendChild(dialog);
            document.body.appendChild(overlay);

            // Show dialog with animation
            setTimeout(() => {
                overlay.style.opacity = '1';
                dialog.style.transform = 'scale(1)';
            }, 10);

            // Handle clicks
            dialog.querySelector('.dialog-cancel-btn').addEventListener('click', () => {
                closeDialog();
                onCancel();
            });

            dialog.querySelector('.dialog-confirm-btn').addEventListener('click', () => {
                closeDialog();
                onConfirm();
            });

            // Close on overlay click
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    closeDialog();
                    onCancel();
                }
            });

            // Close on Escape key
            const handleEscape = (e) => {
                if (e.key === 'Escape') {
                    closeDialog();
                    onCancel();
                    document.removeEventListener('keydown', handleEscape);
                }
            };
            document.addEventListener('keydown', handleEscape);

            function closeDialog() {
                overlay.style.opacity = '0';
                dialog.style.transform = 'scale(0.9)';
                setTimeout(() => overlay.remove(), 300);
                document.removeEventListener('keydown', handleEscape);
            }
        }

        // Cancel order functionality with custom dialog
        function cancelOrder(orderId) {
            showCustomDialog({
                title: 'Cancel Order',
                message: 'Are you sure you want to cancel this order? This action cannot be undone.',
                confirmText: 'Cancel Order',
                cancelText: 'Keep Order',
                type: 'danger',
                onConfirm: function() {
                    // Find the cancel button for this order
                    const cancelButton = document.querySelector(`button[onclick="cancelOrder(${orderId})"]`);
                    if (cancelButton) {
                        const originalText = cancelButton.innerHTML;
                        cancelButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Cancelling...';
                        cancelButton.disabled = true;
                    }

                    // Make AJAX request to cancel order
                    fetch(`/buyer/dashboard/orders/${orderId}/cancel`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Show success message
                                showCustomDialog({
                                    title: 'Order Cancelled',
                                    message: data.message ||
                                        'Your order has been successfully cancelled.',
                                    confirmText: 'OK',
                                    type: 'success',
                                    onConfirm: function() {
                                        location.reload();
                                    }
                                });
                            } else {
                                throw new Error(data.message || 'Failed to cancel order');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showCustomDialog({
                                title: 'Error',
                                message: 'Failed to cancel order. Please try again or contact support.',
                                confirmText: 'OK',
                                type: 'danger',
                                onConfirm: function() {
                                    if (cancelButton) {
                                        cancelButton.innerHTML = originalText;
                                        cancelButton.disabled = false;
                                    }
                                }
                            });
                        });
                }
            });
        }
    </script>
@endsection
