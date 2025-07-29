
<script>
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
</script>
<style>
    .return-requests-container {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .return-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .return-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .return-header {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        background: #f8f9fa;
    }

    .return-number {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .order-link {
        font-size: 14px;
        color: #007bff;
    }

    .order-link a {
        color: inherit;
        text-decoration: none;
    }

    .order-link a:hover {
        text-decoration: underline;
    }

    .return-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .refund-amount {
        font-size: 18px;
        color: #28a745;
    }

    .return-body {
        padding: 20px;
    }

    .return-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        width: 100%;
        height: 100%;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 24px;
    }

    .item-details {
        flex: 1;
    }

    .item-title {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin: 0 0 8px 0;
    }

    .item-info {
        font-size: 14px;
        color: #666;
        margin: 0 0 8px 0;
    }

    .return-reason {
        font-size: 14px;
        color: #333;
        margin: 0;
    }

    .return-timeline {
        position: relative;
        padding-left: 20px;
    }

    .return-timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e0e0e0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -24px;
        top: 2px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #e0e0e0;
        border: 3px solid white;
        box-shadow: 0 0 0 1px #e0e0e0;
    }

    .timeline-item.completed .timeline-dot {
        background: #28a745;
        box-shadow: 0 0 0 1px #28a745;
    }

    .timeline-item.rejected .timeline-dot {
        background: #dc3545;
        box-shadow: 0 0 0 1px #dc3545;
    }

    .timeline-content small {
        font-size: 12px;
        font-weight: 600;
        color: #333;
        display: block;
    }

    .timeline-content p {
        font-size: 11px;
        color: #666;
        margin: 2px 0 0 0;
    }

    .return-description {
        padding: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .return-description h6 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin: 0 0 8px 0;
    }

    .return-description p {
        font-size: 14px;
        color: #666;
        margin: 0;
        line-height: 1.5;
    }

    .admin-notes {
        margin-top: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }

    .return-images {
        padding: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .return-images h6 {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin: 0 0 15px 0;
    }

    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }

    .image-item {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .image-item:hover {
        transform: scale(1.05);
    }

    .image-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .modal-content {
        border-radius: 12px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid #eee;
        padding: 20px;
    }

    .modal-body {
        padding: 20px;
    }

    /* Pagination Styles */
    .pagination {
        justify-content: center;
    }

    .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #ddd;
        color: #333;
    }

    .page-link:hover {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    @media (max-width: 768px) {
        .return-header .row {
            text-align: center;
        }

        .return-body .row {
            flex-direction: column;
        }

        .return-timeline {
            margin-top: 20px;
            padding-left: 0;
        }

        .return-timeline::before {
            display: none;
        }

        .timeline-dot {
            position: relative;
            left: 0;
            display: inline-block;
            margin-right: 10px;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .images-grid {
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        }

        .image-item {
            width: 80px;
            height: 80px;
        }
    }
</style>
<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header">
        <h1>Return Requests</h1>
        <p>Track and manage your product return requests.</p>
    </div>

    <?php if($returnRequests->count() > 0): ?>
        <div class="return-requests-container">
            <?php $__currentLoopData = $returnRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $returnRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="return-card">
                    <div class="return-header">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6 class="return-number">Return #<?php echo e($returnRequest->return_number); ?></h6>
                                <small
                                    class="text-muted"><?php echo e($returnRequest->requested_at->format('M d, Y \a\t g:i A')); ?></small>
                            </div>
                            <div class="col-md-3">
                                <span class="order-link">
                                    <i class="fas fa-shopping-bag"></i>
                                    <a href="<?php echo e(route('buyer.dashboard.orders.show', $returnRequest->order)); ?>">
                                        Order
                                        #<?php echo e($returnRequest->order->order_number ?? 'ORD-' . $returnRequest->order->id); ?>

                                    </a>
                                </span>
                            </div>
                            <div class="col-md-3">
                                <span class="return-status badge badge-<?php echo e($returnRequest->status_color); ?>">
                                    <?php echo e(ucfirst($returnRequest->status)); ?>

                                </span>
                            </div>
                            <div class="col-md-3 text-end">
                                <?php if($returnRequest->refund_amount): ?>
                                    <strong class="refund-amount"><?php echo e(number_format($returnRequest->refund_amount, 2)); ?>

                                        DJF</strong>
                                    <br><small class="text-muted">Refund Amount</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="return-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="return-item">
                                    <div class="item-image">
                                        <?php if($returnRequest->orderItem->product): ?>
                                            <img src="<?php echo e(asset('assets/imgs/template/product-placeholder.jpg')); ?>"
                                                alt="<?php echo e($returnRequest->orderItem->product->title); ?>">
                                        <?php else: ?>
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="item-details">
                                        <h6 class="item-title">
                                            <?php if($returnRequest->orderItem->product): ?>
                                                <?php echo e($returnRequest->orderItem->product->title); ?>

                                            <?php else: ?>
                                                Product no longer available
                                            <?php endif; ?>
                                        </h6>
                                        <p class="item-info">
                                            Quantity: <?php echo e($returnRequest->orderItem->quantity); ?> ×
                                            <?php echo e(number_format($returnRequest->orderItem->price, 2)); ?> DJF
                                        </p>
                                        <p class="return-reason">
                                            <strong>Reason:</strong> <?php echo e($returnRequest->reason_text); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="return-timeline">
                                    <div
                                        class="timeline-item <?php echo e(in_array($returnRequest->status, ['pending', 'approved', 'rejected', 'processing', 'completed']) ? 'completed' : ''); ?>">
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content">
                                            <small>Request Submitted</small>
                                            <p><?php echo e($returnRequest->requested_at->format('M d, Y')); ?></p>
                                        </div>
                                    </div>

                                    <?php if($returnRequest->status != 'pending'): ?>
                                        <div
                                            class="timeline-item <?php echo e(in_array($returnRequest->status, ['approved', 'processing', 'completed']) ? 'completed' : ($returnRequest->status == 'rejected' ? 'rejected' : '')); ?>">
                                            <div class="timeline-dot"></div>
                                            <div class="timeline-content">
                                                <small>
                                                    <?php if($returnRequest->status == 'rejected'): ?>
                                                        Request Rejected
                                                    <?php else: ?>
                                                        Request Approved
                                                    <?php endif; ?>
                                                </small>
                                                <?php if($returnRequest->processed_at): ?>
                                                    <p><?php echo e($returnRequest->processed_at->format('M d, Y')); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(in_array($returnRequest->status, ['processing', 'completed'])): ?>
                                        <div
                                            class="timeline-item <?php echo e($returnRequest->status == 'completed' ? 'completed' : ''); ?>">
                                            <div class="timeline-dot"></div>
                                            <div class="timeline-content">
                                                <small>
                                                    <?php if($returnRequest->status == 'completed'): ?>
                                                        Refund Processed
                                                    <?php else: ?>
                                                        Processing Return
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="return-description">
                        <h6>Description:</h6>
                        <p><?php echo e($returnRequest->description); ?></p>

                        <?php if($returnRequest->admin_notes): ?>
                            <div class="admin-notes">
                                <h6>Admin Notes:</h6>
                                <p><?php echo e($returnRequest->admin_notes); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if($returnRequest->images && count($returnRequest->images) > 0): ?>
                        <div class="return-images">
                            <h6>Attached Images:</h6>
                            <div class="images-grid">
                                <?php $__currentLoopData = $returnRequest->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="image-item">
                                        <img src="<?php echo e(asset($image)); ?>" alt="Return request image"
                                            onclick="openImageModal('<?php echo e(asset($image)); ?>')">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($returnRequests->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-undo fa-3x text-muted mb-3"></i>
            <h5>No return requests</h5>
            <p class="text-muted">You haven't submitted any return requests yet.</p>
            <a href="<?php echo e(route('buyer.dashboard.orders')); ?>" class="btn btn-primary">View Your Orders</a>
        </div>
    <?php endif; ?>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Return Request Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Return request image" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/return-requests.blade.php ENDPATH**/ ?>