

<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header">
        <h1>Order Tracking</h1>
        <p>Track the status and delivery progress of your orders.</p>
    </div>

    <?php if($orders->count() > 0): ?>
        <div class="tracking-container">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tracking-card">
                    <div class="tracking-header">
                        <div class="tracking-order-info">
                            <div class="order-details">
                                <h3 class="order-number">Order #<?php echo e($order->order_number ?? 'ORD-' . $order->id); ?></h3>
                                <p class="order-date"><?php echo e($order->created_at->format('M d, Y')); ?></p>
                            </div>
                            <div class="order-status">
                                <span
                                    class="status-badge status-<?php echo e($order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : ($order->status == 'canceled' ? 'danger' : 'info'))); ?>">
                                    <span class="status-dot"></span>
                                    <?php echo e(ucfirst($order->status)); ?>

                                </span>
                            </div>
                            <div class="tracking-info">
                                <p class="tracking-label">Tracking Number</p>
                                <p class="tracking-number"><?php echo e($order->tracking_number); ?></p>
                            </div>
                            <div class="tracking-actions">
                                <a href="<?php echo e(route('buyer.dashboard.orders.show', $order)); ?>"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-progress">
                        <!-- Progress Timeline -->
                        <div class="progress-timeline">
                            <div class="timeline-progress"
                                style="width: <?php echo e($order->status === 'pending' ? '25%' : ($order->status === 'processing' ? '50%' : ($order->status === 'shipped' ? '75%' : '100%'))); ?>;">
                            </div>
                        </div>

                        <!-- Progress Steps -->
                        <div class="progress-steps">
                            <div
                                class="progress-step <?php echo e(in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : ''); ?>">
                                <div class="step-circle">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="step-content">
                                    <h4 class="step-title">Order Placed</h4>
                                    <p class="step-subtitle">Your order has been received</p>
                                </div>
                            </div>

                            <div
                                class="progress-step <?php echo e($order->status === 'processing' ? 'current' : (in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '')); ?>">
                                <div class="step-circle">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="step-content">
                                    <h4 class="step-title">Processing</h4>
                                    <p class="step-subtitle">Preparing your order</p>
                                </div>
                            </div>

                            <div
                                class="progress-step <?php echo e($order->status === 'shipped' ? 'current' : ($order->status === 'delivered' ? 'completed' : '')); ?>">
                                <div class="step-circle">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="step-content">
                                    <h4 class="step-title">Shipped</h4>
                                    <p class="step-subtitle">On the way to you</p>
                                </div>
                            </div>

                            <div class="progress-step <?php echo e($order->status === 'delivered' ? 'completed current' : ''); ?>">
                                <div class="step-circle">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="step-content">
                                    <h4 class="step-title">Delivered</h4>
                                    <p class="step-subtitle">Order completed</p>
                                </div>
                            </div>
                        </div>

                        <!-- Latest Status Update -->
                        <?php if($order->statusLogs->first()): ?>
                            <div class="latest-update">
                                <h4 class="update-title">Latest Update</h4>
                                <p class="update-message"><?php echo e($order->statusLogs->first()->message ?? 'Status updated'); ?>

                                </p>
                                <p class="update-time">
                                    <?php echo e($order->statusLogs->first()->created_at->format('M d, Y \a\t g:i A')); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="order-summary">
                        <div class="summary-grid">
                            <div class="summary-item">
                                <span class="summary-label">Items</span>
                                <span class="summary-value"><?php echo e($order->orderItems->count()); ?> item(s)</span>
                            </div>
                            <?php if($order->shipped_at): ?>
                                <div class="summary-item">
                                    <span class="summary-label">Shipped</span>
                                    <span class="summary-value"><?php echo e($order->shipped_at->format('M d, Y')); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="summary-item">
                                <span class="summary-label">Total</span>
                                <span class="summary-value summary-total"><?php echo e(number_format($order->final_price, 0)); ?>

                                    DJF</span>
                            </div>
                            <?php if($order->status === 'shipped' && $order->statusLogs->where('status', 'shipped')->first()): ?>
                                <div class="summary-item">
                                    <span class="summary-label">Est. Delivery</span>
                                    <span class="summary-value summary-highlight">
                                        <?php echo e($order->statusLogs->where('status', 'shipped')->first()->estimated_delivery_time
                                            ? $order->statusLogs->where('status', 'shipped')->first()->estimated_delivery_time->format('M d, Y')
                                            : 'TBD'); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Pagination -->
            <div class="pagination-container">
                <?php echo e($orders->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="empty-state-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="empty-state-title">No trackable orders found</h3>
                <p class="empty-state-text">Orders with tracking numbers will appear here once they are shipped.</p>
                <a href="<?php echo e(route('buyer.dashboard.orders')); ?>" class="btn btn-primary">
                    <i class="fas fa-package me-1"></i>
                    View All Orders
                </a>
            </div>
        </div>
    <?php endif; ?>

    <style>
        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-sm) var(--spacing-md);
            font-size: 14px;
            font-weight: 500;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-700);
            border-color: var(--primary-700);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-primary {
            background: transparent;
            border-color: var(--primary-600);
            color: var(--primary-600);
        }

        .btn-outline-primary:hover {
            background: var(--primary-600);
            color: var(--white);
            text-decoration: none;
        }

        .btn-sm {
            padding: var(--spacing-xs) var(--spacing-sm);
            font-size: 12px;
        }

        /* Tracking Container */
        .tracking-container {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        .tracking-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .tracking-card:hover {
            box-shadow: var(--shadow-md);
        }

        /* Tracking Header */
        .tracking-header {
            padding: var(--spacing-lg);
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        .tracking-order-info {
            display: grid;
            grid-template-columns: 1fr auto auto auto;
            gap: var(--spacing-lg);
            align-items: center;
        }

        .order-details {
            min-width: 0;
        }

        .order-number {
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
        }

        .order-date {
            font-size: 12px;
            color: var(--gray-600);
            margin: 0;
        }

        .order-status {
            flex-shrink: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-badge.status-success {
            background: var(--green-100);
            color: var(--green-800);
        }

        .status-badge.status-success .status-dot {
            background: var(--green-600);
        }

        .status-badge.status-warning {
            background: var(--yellow-100);
            color: var(--yellow-800);
        }

        .status-badge.status-warning .status-dot {
            background: var(--orange-600);
        }

        .status-badge.status-info {
            background: var(--primary-50);
            color: var(--primary-700);
        }

        .status-badge.status-info .status-dot {
            background: var(--primary-600);
        }

        .status-badge.status-danger {
            background: #fef2f2;
            color: #991b1b;
        }

        .status-badge.status-danger .status-dot {
            background: #ef4444;
        }

        .tracking-info {
            text-align: center;
        }

        .tracking-label {
            font-size: 12px;
            color: var(--gray-600);
            margin: 0 0 var(--spacing-xs) 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .tracking-number {
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .tracking-actions {
            flex-shrink: 0;
        }

        /* Progress Timeline */
        .tracking-progress {
            padding: var(--spacing-xl) var(--spacing-lg) var(--spacing-lg);
        }

        .progress-timeline {
            position: relative;
            height: 2px;
            background: var(--gray-200);
            border-radius: 1px;
            margin-bottom: var(--spacing-xl);
        }

        .timeline-progress {
            height: 100%;
            background: var(--primary-600);
            border-radius: 1px;
            transition: width 0.5s ease;
        }

        .progress-steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .step-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            font-size: 16px;
            margin-bottom: var(--spacing-sm);
            transition: all 0.3s ease;
            border: 3px solid var(--white);
            box-shadow: var(--shadow-sm);
        }

        .progress-step.completed .step-circle {
            background: var(--green-600);
            color: var(--white);
        }

        .progress-step.current .step-circle {
            background: var(--primary-600);
            color: var(--white);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }

        .step-content {
            width: 100%;
        }

        .step-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
        }

        .progress-step.completed .step-title {
            color: var(--green-600);
        }

        .progress-step.current .step-title {
            color: var(--primary-600);
        }

        .step-subtitle {
            font-size: 12px;
            color: var(--gray-600);
            margin: 0;
        }

        /* Latest Update */
        .latest-update {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            padding: var(--spacing-md);
            margin-top: var(--spacing-lg);
        }

        .update-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
        }

        .update-message {
            font-size: 14px;
            color: var(--gray-700);
            margin: 0 0 var(--spacing-xs) 0;
        }

        .update-time {
            font-size: 12px;
            color: var(--gray-600);
            margin: 0;
            font-style: italic;
        }

        /* Order Summary */
        .order-summary {
            padding: var(--spacing-lg);
            border-top: 1px solid var(--gray-200);
            background: var(--white);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: var(--spacing-md);
        }

        .summary-item {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        .summary-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .summary-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-900);
        }

        .summary-total {
            font-weight: 700;
            color: var(--primary-600);
        }

        .summary-highlight {
            color: var(--primary-600);
            font-weight: 600;
        }

        /* Empty State */
        .empty-state-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
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
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--gray-600);
        }

        .empty-state-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-sm) 0;
        }

        .empty-state-text {
            color: var(--gray-600);
            margin: 0 0 2rem 0;
            font-size: 14px;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: var(--spacing-lg);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .tracking-order-info {
                grid-template-columns: 1fr auto;
                gap: var(--spacing-md);
            }

            .tracking-info,
            .tracking-actions {
                grid-column: 1 / -1;
                margin-top: var(--spacing-md);
            }

            .tracking-info {
                text-align: left;
            }

            .progress-steps {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-md);
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {

            .tracking-header,
            .tracking-progress,
            .order-summary {
                padding: var(--spacing-md);
            }

            .tracking-order-info {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }

            .progress-steps {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }

            .progress-step {
                flex-direction: row;
                text-align: left;
                align-items: center;
            }

            .step-circle {
                margin-bottom: 0;
                margin-right: var(--spacing-sm);
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/tracking.blade.php ENDPATH**/ ?>