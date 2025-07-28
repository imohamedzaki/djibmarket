

<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header">
        <h1>Welcome back, <?php echo e(Auth::user()->name); ?>!</h1>
        <p>Here's what's happening with your account today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card orders">
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h3 class="stat-number"><?php echo e($stats['total_orders']); ?></h3>
            <p class="stat-label">Total Orders</p>
        </div>

        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h3 class="stat-number"><?php echo e($stats['pending_orders']); ?></h3>
            <p class="stat-label">Pending Orders</p>
        </div>

        <div class="stat-card completed">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="stat-number"><?php echo e($stats['completed_orders']); ?></h3>
            <p class="stat-label">Completed Orders</p>
        </div>

        <div class="stat-card wishlist">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <h3 class="stat-number"><?php echo e($stats['wishlist_items']); ?></h3>
            <p class="stat-label">Wishlist Items</p>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Recent Orders -->
        <div class="dashboard-grid-main">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-content">
                        <h5 class="card-title">Recent Orders</h5>
                        <a href="<?php echo e(route('buyer.dashboard.orders')); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i>
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($recent_orders->count() > 0): ?>
                        <div class="modern-table-container">
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="table-cell-content">
                                                    <a href="<?php echo e(route('buyer.dashboard.orders.show', $order)); ?>"
                                                        class="table-link">
                                                        <span
                                                            class="font-medium">#<?php echo e($order->order_number ?? 'ORD-' . $order->id); ?></span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-cell-content">
                                                    <span
                                                        class="text-sm text-gray-600"><?php echo e($order->created_at->format('M d, Y')); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-cell-content">
                                                    <span class="text-sm"><?php echo e($order->orderItems->count()); ?> items</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-cell-content">
                                                    <span class="font-medium"><?php echo e(number_format($order->final_price, 0)); ?>

                                                        DJF</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="table-cell-content">
                                                    <span
                                                        class="status-badge status-<?php echo e($order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info')); ?>">
                                                        <?php echo e(ucfirst($order->status)); ?>

                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <h3 class="empty-state-title">No orders yet</h3>
                            <p class="empty-state-text">Start shopping to see your orders here!</p>
                            <a href="<?php echo e(route('buyer.home')); ?>" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-1"></i>
                                Start Shopping
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recently Viewed -->
        <div class="dashboard-grid-sidebar">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-content">
                        <h5 class="card-title">Recently Viewed</h5>
                        <a href="<?php echo e(route('buyer.dashboard.browsing-history')); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i>
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($recent_browsing->count() > 0): ?>
                        <div class="recent-items-list">
                            <?php $__currentLoopData = $recent_browsing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="recent-item">
                                    <div class="recent-item-image">
                                        <?php if($history->product): ?>
                                            <img src="<?php echo e($history->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg')); ?>"
                                                alt="<?php echo e($history->product->title); ?>"
                                                onerror="this.src='<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>'">
                                        <?php else: ?>
                                            <div class="recent-item-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="recent-item-content">
                                        <?php if($history->product): ?>
                                            <h6 class="recent-item-title">
                                                <a href="<?php echo e(route('buyer.product.show', $history->product)); ?>">
                                                    <?php echo e(Str::limit($history->product->title, 30)); ?>

                                                </a>
                                            </h6>
                                            <span
                                                class="recent-item-time"><?php echo e($history->viewed_at->diffForHumans()); ?></span>
                                        <?php else: ?>
                                            <h6 class="recent-item-title recent-item-unavailable">Product no longer
                                                available</h6>
                                            <span
                                                class="recent-item-time"><?php echo e($history->viewed_at->diffForHumans()); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <p class="empty-state-text">No browsing history yet</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        .card-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .btn {
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

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            text-decoration: none;
        }

        .btn-outline-primary {
            background: transparent;
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        /* Modern Table Styles */
        .modern-table-container {
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table th {
            background: var(--light-color);
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
            text-align: left;
            border: none;

            first-child: {
                border-radius: var(--radius-md) 0 0 var(--radius-md);
            }

            last-child: {
                border-radius: 0 var(--radius-md) var(--radius-md) 0;
            }
        }

        .modern-table th:first-child {
            border-radius: var(--radius-md) 0 0 var(--radius-md);
        }

        .modern-table th:last-child {
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }

        .modern-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .modern-table tbody tr:hover {
            background: var(--light-color);
        }

        .modern-table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-cell-content {
            display: flex;
            align-items: center;
        }

        .table-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .table-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-600 {
            color: var(--text-secondary);
        }

        /* Status Badge Styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-badge.status-success {
            background: #ecfdf5;
            color: #065f46;
        }

        .status-badge.status-warning {
            background: #fffbeb;
            color: #92400e;
        }

        .status-badge.status-info {
            background: #eff6ff;
            color: #1e40af;
        }

        /* Empty State Styles */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--text-secondary);
        }

        .empty-state-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
        }

        .empty-state-text {
            color: var(--text-secondary);
            margin: 0 0 1.5rem 0;
        }

        /* Recent Items List */
        .recent-items-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .recent-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: var(--radius-md);
            transition: background-color 0.2s ease;
        }

        .recent-item:hover {
            background: var(--light-color);
        }

        .recent-item-image {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            overflow: hidden;
            flex-shrink: 0;
            background: var(--light-color);
        }

        .recent-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recent-item-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            font-size: 1.25rem;
        }

        .recent-item-content {
            flex: 1;
            min-width: 0;
        }

        .recent-item-title {
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0 0 0.25rem 0;
            line-height: 1.25;
        }

        .recent-item-title a {
            color: var(--text-primary);
            text-decoration: none;
        }

        .recent-item-title a:hover {
            color: var(--primary-color);
        }

        .recent-item-unavailable {
            color: var(--text-secondary);
        }

        .recent-item-time {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 640px) {
            .card-header-content {
                flex-direction: column;
                gap: 0.75rem;
                align-items: stretch;
            }

            .modern-table th,
            .modern-table td {
                padding: 0.5rem;
            }

            .recent-item {
                padding: 0.5rem;
            }

            .recent-item-image {
                width: 40px;
                height: 40px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/index.blade.php ENDPATH**/ ?>