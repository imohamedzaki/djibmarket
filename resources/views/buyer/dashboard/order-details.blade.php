@extends('buyer.dashboard.layout')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 20px;
        border-radius: 12px 12px 0 0 !important;
    }

    .card-body {
        padding: 20px;
    }

    .order-item {
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
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

    .item-title {
        font-size: 16px;
        font-weight: 500;
        margin: 0 0 5px 0;
    }

    .item-title a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .item-title a:hover {
        color: #007bff;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        border-top: 1px solid #eee;
        padding-top: 10px;
        margin-top: 10px;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-block {
        width: 100%;
        margin-bottom: 10px;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
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

    .modal-footer {
        border-top: 1px solid #eee;
        padding: 20px;
    }

    /* Clean Timeline Tracking Styles */
    .tracking-timeline {
        position: relative;
        padding: 20px 0;
        max-width: 100%;
        /* margin-left: 3rem; */
    }

    .tracking-step {
        position: relative;
        display: flex;
        align-items: flex-start;
        margin-bottom: 32px;
        padding-left: 90px;
        min-height: 60px;
    }

    .tracking-step:last-child {
        margin-bottom: 0;
    }

    .tracking-step::before {
        content: '';
        position: absolute;
        left: 31px;
        top: 40px;
        bottom: -32px;
        width: 2px;
        background: #e5e7eb;
        z-index: 1;
    }

    .tracking-step:last-child::before {
        display: none;
    }

    .tracking-time {
        position: absolute;
        right: 0;
        top: 8px;
        width: 60px;
        text-align: center;
    }

    .tracking-time .time {
        font-size: 16px;
        font-weight: 700;
        color: #374151;
        line-height: 1.2;
        margin-bottom: 2px;
    }

    .tracking-time .date {
        font-size: 10px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tracking-icon {
        position: absolute;
        left: 16px;
        top: 8px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: white;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .tracking-step.pending .tracking-icon {
        background: #f59e0b;
    }

    .tracking-step.processing .tracking-icon {
        background: #3b82f6;
    }

    .tracking-step.shipped .tracking-icon {
        background: #8b5cf6;
    }

    .tracking-step.delivered .tracking-icon {
        background: #10b981;
    }

    .tracking-step.canceled .tracking-icon {
        background: #10b981;
    }

    .tracking-content {
        flex: 1;
        padding-top: 8px;
    }

    .tracking-content h6 {
        margin: 0 0 4px 0;
        font-weight: 600;
        color: #374151;
        font-size: 16px;
    }

    .tracking-content p {
        margin: 0;
        color: #9ca3af;
        font-size: 14px;
        line-height: 1.4;
    }

    .tracking-content .estimated-delivery {
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 6px;
        padding: 6px 10px;
        margin-top: 6px;
        font-size: 12px;
        color: #1d4ed8;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .tracking-step {
            padding-left: 80px;
        }

        .tracking-time {
            width: 50px;
        }

        .tracking-time .time {
            font-size: 14px;
        }

        .tracking-icon {
            left: 14px;
            width: 28px;
            height: 28px;
            font-size: 12px;
        }

        .tracking-step::before {
            left: 27px;
        }
    }

    .address-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
    }

    .tracking-step.inactive .tracking-icon {
        background: #e5e7eb;
        /* gray-200 */
    }

    .tracking-step.inactive .tracking-icon i {
        color: #9ca3af;
        /* gray-400 */
    }

    .tracking-step.inactive .tracking-content h6,
    .tracking-step.inactive .tracking-content p {
        color: #9ca3af;
        /* gray-400 */
    }

    /* Processing Sub-steps Styles */
    .processing-substeps {
        margin-top: 15px;
        padding-left: 20px;
        border-left: 2px solid #e5e7eb;
    }

    .processing-substep {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
        padding: 8px 12px;
        background: #f8f9fa;
        border-radius: 6px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .processing-substep:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .processing-substep.completed {
        background: #d1fae5;
        border-color: #10b981;
    }

    .processing-substep.completed .substep-icon {
        background: #10b981;
        color: white;
    }

    .processing-substep.pending {
        background: #fef3c7;
        border-color: #f59e0b;
    }

    .processing-substep.pending .substep-icon {
        background: #f59e0b;
        color: white;
    }

    .substep-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        margin-right: 10px;
        background: #6c757d;
        color: white;
    }

    .substep-content {
        flex: 1;
    }

    .substep-title {
        font-size: 13px;
        font-weight: 500;
        margin: 0;
        color: #374151;
    }

    .substep-description {
        font-size: 11px;
        color: #6b7280;
        margin: 0;
    }

    /* Enhanced Order Actions Styles */
    .order-actions-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .order-actions-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgb(221 221 221 / 51%);
        padding: 20px;
    }

    .order-actions-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
    }

    .order-actions-body {
        padding: 20px;
        background: rgba(255, 255, 255, 0.95);
    }

    .action-button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 15px 20px;
        margin-bottom: 12px;
        border: none;
        border-radius: 10px;
        font-weight: 500;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .action-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .action-button:hover::before {
        left: 100%;
    }

    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .action-button.btn-danger {
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
    }

    .action-button.btn-warning {
        background: linear-gradient(135deg, #ffa726, #ff9800);
        color: white;
    }

    .action-button.btn-info {
        background: linear-gradient(135deg, #4fc3f7, #29b6f6);
        color: white;
    }

    .action-button.btn-secondary {
        background: linear-gradient(135deg, #9e9e9e, #757575);
        color: white;
    }

    .action-button.btn-success {
        background: linear-gradient(135deg, #66bb6a, #4caf50);
        color: white;
    }

    .action-button .btn-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
        margin-right: 15px;
    }

    .action-button .btn-content {
        flex: 1;
        text-align: left;
    }

    .action-button .btn-title {
        font-weight: 600;
        margin-bottom: 2px;
    }

    .action-button .btn-description {
        font-size: 12px;
        opacity: 0.9;
    }

    .action-button .btn-arrow {
        font-size: 18px;
        opacity: 0.7;
        transition: transform 0.3s ease;
    }

    .action-button:hover .btn-arrow {
        transform: translateX(5px);
    }

    @media (max-width: 768px) {
        .order-item .row {
            text-align: center;
        }

        .order-item .col-md-2:last-child {
            margin-top: 10px;
        }

        .tracking-timeline {
            padding-left: 20px;
        }

        .tracking-step {
            padding-left: 15px;
        }

        .action-button {
            padding: 12px 15px;
        }

        .action-button .btn-icon {
            width: 35px;
            height: 35px;
            margin-right: 12px;
        }
    }
</style>
<script>
    function submitReturnRequest() {
        const form = document.getElementById('returnRequestForm');
        const formData = new FormData(form);

        // Basic validation
        const selectedItems = form.querySelectorAll('input[name="items[]"]:checked');
        if (selectedItems.length === 0) {
            showNotification('Please select at least one item to return.', 'error');
            return;
        }

        const reason = form.querySelector('#return_reason').value;
        const description = form.querySelector('#return_description').value;

        if (!reason || !description) {
            showNotification('Please fill in all required fields.', 'error');
            return;
        }

        // Here you would typically make an AJAX request to submit the return request
        // For now, we'll just show a success message
        showNotification('Return request submitted successfully! We will review your request and get back to you soon.',
            'success');

        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('returnRequestModal'));
        modal.hide();
    }

    function showCancelOrderDialog() {
        showCustomDialog({
            title: 'Cancel Order',
            message: 'Are you sure you want to cancel this order? This action cannot be undone and your payment will be refunded.',
            confirmText: 'Yes, Cancel Order',
            cancelText: 'Keep Order',
            type: 'danger',
            onConfirm: function() {
                performCancelOrder();
            }
        });
    }

    function showWhatsAppDialog() {
        showCustomDialog({
            title: 'Contact Support',
            message: 'You will be redirected to a WhatsApp chat for support. Our team will assist you with your order and any questions you may have.',
            confirmText: 'Open WhatsApp',
            cancelText: 'Cancel',
            type: 'warning',
            onConfirm: function() {
                window.open('https://wa.me/25377608558', '_blank');
            }
        });
    }

    function showOrderStatusDialog() {
        const processingSteps = [{
                title: 'Item Pickup',
                description: 'Taking the item from the seller',
                status: 'completed',
                icon: 'fas fa-hand-holding-box'
            },
            {
                title: 'Stock Management',
                description: 'Putting the item in stock',
                status: 'completed',
                icon: 'fas fa-boxes'
            },
            {
                title: 'Packaging',
                description: 'Putting them in appropriate packaging',
                status: 'pending',
                icon: 'fas fa-box-open'
            },
            {
                title: 'Quality Check',
                description: 'Final quality inspection',
                status: 'pending',
                icon: 'fas fa-search'
            }
        ];

        let stepsHtml = '';
        processingSteps.forEach((step, index) => {
            const statusClass = step.status === 'completed' ? 'completed' : 'pending';
            const statusIcon = step.status === 'completed' ? 'fas fa-check' : 'fas fa-clock';

            stepsHtml += `
                <div class="processing-substep ${statusClass}" style="margin-bottom: 15px;">
                    <div class="substep-icon">
                        <i class="${step.icon}"></i>
                    </div>
                    <div class="substep-content">
                        <div class="substep-title">${step.title}</div>
                        <div class="substep-description">${step.description}</div>
                    </div>
                    <div style="margin-left: auto;">
                        <i class="${statusIcon}" style="color: ${step.status === 'completed' ? '#10b981' : '#f59e0b'};"></i>
                    </div>
                </div>
            `;
        });

        showCustomDialog({
            title: 'Order Processing Status',
            message: `
                <div style="margin-bottom: 20px;">
                    <p style="margin-bottom: 15px; color: #374151;">Your order is currently being processed. Here are the detailed steps:</p>
                    ${stepsHtml}
                </div>
                <div style="background: #f3f4f6; padding: 15px; border-radius: 8px; margin-top: 20px;">
                    <p style="margin: 0; font-size: 14px; color: #6b7280;">
                        <i class="fas fa-info-circle me-2"></i>
                        We'll notify you when your order is ready for shipment.
                    </p>
                </div>
            `,
            confirmText: 'Got it',
            cancelText: 'Close',
            type: 'info',
            onConfirm: function() {
                // Dialog will close automatically
            }
        });
    }

    function performCancelOrder() {
        // Create and submit form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('buyer.dashboard.orders.cancel', $order) }}';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';

        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }

    function showCustomDialog(options) {
        const {
            title = 'Confirm',
                message = 'Are you sure?',
                confirmText = 'Confirm',
                cancelText = 'Cancel',
                type = 'info', // info, warning, danger, success
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

        // Get colors based on type
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

        // Create dialog content
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

        // Add hover effects
        const cancelBtn = dialog.querySelector('.dialog-cancel-btn');
        const confirmBtn = dialog.querySelector('.dialog-confirm-btn');

        cancelBtn.addEventListener('mouseenter', () => {
            cancelBtn.style.background = '#f3f4f6';
            cancelBtn.style.borderColor = '#9ca3af';
        });
        cancelBtn.addEventListener('mouseleave', () => {
            cancelBtn.style.background = 'white';
            cancelBtn.style.borderColor = '#d1d5db';
        });

        confirmBtn.addEventListener('mouseenter', () => {
            confirmBtn.style.transform = 'translateY(-1px)';
            confirmBtn.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        });
        confirmBtn.addEventListener('mouseleave', () => {
            confirmBtn.style.transform = 'translateY(0)';
            confirmBtn.style.boxShadow = 'none';
        });

        // Show dialog with animation
        setTimeout(() => {
            overlay.style.opacity = '1';
            dialog.style.transform = 'scale(1)';
        }, 10);

        // Handle clicks
        cancelBtn.addEventListener('click', () => {
            closeDialog();
            onCancel();
        });

        confirmBtn.addEventListener('click', () => {
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

        // Close on escape key
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
            setTimeout(() => {
                overlay.remove();
            }, 300);
        }
    }

    function showToast(message, type = 'info') {
        // Remove existing toasts
        document.querySelectorAll('.toast-notification').forEach(toast => toast.remove());

        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 16px 24px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
            color: white;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 320px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        `;

        toast.innerHTML = `
            <div style="display: flex; align-items: center; gap: 8px;">
                <span>${type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ'}</span>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(toast);

        // Trigger animation
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);

        // Auto remove
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    function showNotification(message, type = 'info') {
        showToast(message, type);
    }
</script>
@section('dashboard-content')
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h1>Order Details</h1>
            <p class="mb-1">Order #{{ $order->order_number ?? 'ORD-' . $order->id }}</p>
            <small class="text-muted">Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</small>
        </div>
        <a href="{{ route('buyer.dashboard.orders') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Orders
        </a>
    </div>

    <div class="row">
        <!-- Order Summary -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Order Date:</strong><br>
                            {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong><br>
                            <span class="badge badge-{{ $order->status_color }}">
                                {{ $order->status_label }}
                            </span>
                        </div>
                    </div>

                    @if ($order->tracking_number)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Tracking Number:</strong><br>
                                {{ $order->tracking_number }}
                            </div>
                            <div class="col-md-6">
                                <strong>Shipping Method:</strong><br>
                                {{ ucfirst($order->shipping_method ?? 'Standard') }}
                            </div>
                        </div>
                    @endif

                    @if ($order->notes)
                        <div class="row mb-3">
                            <div class="col-12">
                                <strong>Order Notes:</strong><br>
                                {{ $order->notes }}
                            </div>
                        </div>
                    @endif

                    <!-- Order Items -->
                    <h6 class="mt-4 mb-3">Items Ordered</h6>
                    @foreach ($order->orderItems as $item)
                        <div class="order-item">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="item-image">
                                        @if ($item->product)
                                            <img src="{{ $item->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                alt="{{ $item->product->title }}"
                                                onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                        @else
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="item-title">
                                        @if ($item->product)
                                            <a href="{{ route('buyer.product.show', $item->product) }}">
                                                {{ $item->product->title }}
                                            </a>
                                        @else
                                            Product no longer available
                                        @endif
                                    </h6>
                                    <p class="text-muted mb-0">
                                        @if ($item->product && $item->product->category)
                                            Category: {{ $item->product->category->name }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <strong>Qty: {{ $item->quantity }}</strong>
                                </div>
                                <div class="col-md-2 text-end">
                                    <strong>{{ number_format($item->price * $item->quantity, 0) }} DJF</strong>
                                    <br><small class="text-muted">{{ number_format($item->price, 0) }} DJF each</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Tracking -->
            @if ($order->statusLogs->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Order Tracking</h5>
                    </div>
                    <div class="card-body">
                        <div class="tracking-timeline">
                            @php
                                $statusIcons = [
                                    'pending' => 'fas fa-clock',
                                    'processing' => 'fas fa-cog',
                                    'shipped' => 'fas fa-truck',
                                    'delivered' => 'fas fa-check',
                                    'canceled' => 'fas fa-times',
                                ];
                                $defaultMessages = [
                                    'pending' => 'Order has been placed and is awaiting processing.',
                                    'processing' => 'Your order is being prepared for shipment.',
                                    'shipped' => 'Your order has been shipped and is on the way.',
                                    'delivered' => 'Your order has been successfully delivered.',
                                    'canceled' => 'The order has been canceled.',
                                ];

                                // Processing sub-steps
                                $processingSubsteps = [
                                    'pickup' => [
                                        'title' => 'Item Pickup',
                                        'description' => 'Taking the item from the seller',
                                        'icon' => 'fas fa-hand-holding-box',
                                        'status' => 'completed',
                                    ],
                                    'stock' => [
                                        'title' => 'Stock Management',
                                        'description' => 'Putting the item in stock',
                                        'icon' => 'fas fa-boxes',
                                        'status' => 'completed',
                                    ],
                                    'packaging' => [
                                        'title' => 'Packaging',
                                        'description' => 'Putting them in appropriate packaging',
                                        'icon' => 'fas fa-box-open',
                                        'status' => 'pending',
                                    ],
                                    'quality_check' => [
                                        'title' => 'Quality Check',
                                        'description' => 'Final quality inspection',
                                        'icon' => 'fas fa-search',
                                        'status' => 'pending',
                                    ],
                                ];
                            @endphp

                            @if ($order->status === 'canceled')
                                @foreach ($order->statusLogs->sortBy('created_at') as $log)
                                    @php $icon = $statusIcons[$log->status] ?? 'fas fa-info-circle'; @endphp
                                    <div class="tracking-step {{ $log->status }}">
                                        <div class="tracking-time">
                                            <div class="time">{{ $log->created_at->format('H:i') }}</div>
                                            <div class="date">{{ $log->created_at->format('M d') }}</div>
                                        </div>
                                        <div class="tracking-icon">
                                            <i class="{{ $icon }}"></i>
                                        </div>
                                        <div class="tracking-content">
                                            <h6>{{ ucfirst(str_replace('_', ' ', $log->status)) }}</h6>
                                            <p>{{ $log->message ?? ($defaultMessages[$log->status] ?? 'Order status updated.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @php
                                    $order_statuses = ['pending', 'processing', 'shipped', 'delivered'];
                                    $logs_by_status = $order->statusLogs->keyBy('status');
                                @endphp

                                @foreach ($order_statuses as $status)
                                    @php
                                        $log = $logs_by_status->get($status);
                                        $is_completed = $log != null;
                                        $icon = $statusIcons[$status] ?? 'fas fa-info-circle';
                                    @endphp
                                    <div class="tracking-step {{ $status }} {{ $is_completed ? '' : 'inactive' }}">
                                        @if ($is_completed)
                                            <div class="tracking-time">
                                                <div class="time">{{ $log->created_at->format('H:i') }}</div>
                                                <div class="date">{{ $log->created_at->format('M d') }}</div>
                                            </div>
                                        @endif
                                        <div class="tracking-icon">
                                            <i class="{{ $icon }}"></i>
                                        </div>
                                        <div class="tracking-content">
                                            <h6>{{ ucfirst(str_replace('_', ' ', $status)) }}</h6>
                                            @if ($is_completed)
                                                <p>{{ $log->message ?? ($defaultMessages[$status] ?? 'Order status updated.') }}
                                                </p>
                                                @if ($log->estimated_delivery_time)
                                                    <div class="estimated-delivery">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        Estimated delivery:
                                                        {{ $log->estimated_delivery_time->format('M d, Y') }}
                                                    </div>
                                                @endif

                                                @if ($status === 'processing')
                                                    <div class="processing-substeps">
                                                        @foreach ($processingSubsteps as $key => $substep)
                                                            <div class="processing-substep {{ $substep['status'] }}">
                                                                <div class="substep-icon">
                                                                    <i class="{{ $substep['icon'] }}"></i>
                                                                </div>
                                                                <div class="substep-content">
                                                                    <div class="substep-title">{{ $substep['title'] }}
                                                                    </div>
                                                                    <div class="substep-description">
                                                                        {{ $substep['description'] }}</div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @else
                                                <p>{{ $defaultMessages[$status] ?? 'Awaiting update.' }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Order Details Sidebar -->
        <div class="col-lg-4">
            <!-- Shipping Address -->
            @if ($order->shippingAddress)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        <div class="address-card">
                            <strong>{{ $order->shippingAddress->full_name }}</strong><br>
                            {{ $order->shippingAddress->full_address }}<br>
                            <i class="fas fa-phone"></i> {{ $order->shippingAddress->phone }}
                            @if ($order->shippingAddress->notes)
                                <br><small class="text-muted">{{ $order->shippingAddress->notes }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Order Total -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Order Total</h5>
                </div>
                <div class="card-body">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <strong>{{ number_format($order->total_price, 0) }} DJF</strong>
                    </div>
                    @if ($order->discount_amount > 0)
                        <div class="summary-row">
                            <span>Discount:</span>
                            <strong class="text-success">-{{ number_format($order->discount_amount, 0) }} DJF</strong>
                        </div>
                    @endif
                    @if ($order->shipping_cost > 0)
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <strong>{{ number_format($order->shipping_cost, 0) }} DJF</strong>
                        </div>
                    @endif
                    @if ($order->tax_amount > 0)
                        <div class="summary-row">
                            <span>Tax:</span>
                            <strong>{{ number_format($order->tax_amount, 0) }} DJF</strong>
                        </div>
                    @endif
                    <div class="summary-row total">
                        <span>Total:</span>
                        <strong>{{ number_format($order->final_price, 0) }} DJF</strong>
                    </div>
                </div>
            </div>

            <!-- Order Actions -->
            <div class="card order-actions-card">
                <div class="order-actions-header">
                    <h5 class="mb-0" style="color:#212529;">
                        <i class="fas fa-cogs me-2"></i>Order Actions
                    </h5>
                </div>
                <div class="order-actions-body">
                    @if ($order->canBeCanceled())
                        <button type="button" class="action-button btn-danger" onclick="showCancelOrderDialog()">
                            <div class="d-flex align-items-center">
                                <div class="btn-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="btn-content">
                                    <div class="btn-title">Cancel Order</div>
                                    <div class="btn-description">Cancel this order and request refund</div>
                                </div>
                            </div>
                            <div class="btn-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </button>
                    @endif

                    @if (in_array($order->status, ['delivered']))
                        <button class="action-button btn-warning" data-bs-toggle="modal"
                            data-bs-target="#returnRequestModal">
                            <div class="d-flex align-items-center">
                                <div class="btn-icon">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <div class="btn-content">
                                    <div class="btn-title">Request Return</div>
                                    <div class="btn-description">Return items and get refund</div>
                                </div>
                            </div>
                            <div class="btn-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </button>
                    @endif

                    <a href="{{ route('buyer.dashboard.orders.invoice', $order) }}" class="action-button btn-info">
                        <div class="d-flex align-items-center">
                            <div class="btn-icon">
                                <i class="fas fa-download"></i>
                            </div>
                            <div class="btn-content">
                                <div class="btn-title">Download Invoice</div>
                                <div class="btn-description">Get your order invoice PDF</div>
                            </div>
                        </div>
                        <div class="btn-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>

                    <button class="action-button btn-secondary" onclick="showWhatsAppDialog()">
                        <div class="d-flex align-items-center">
                            <div class="btn-icon">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="btn-content">
                                <div class="btn-title">Contact Support</div>
                                <div class="btn-description">Get help via WhatsApp</div>
                            </div>
                        </div>
                        <div class="btn-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </button>

                    @if (in_array($order->status, ['pending', 'processing']))
                        <button class="action-button btn-success" onclick="showOrderStatusDialog()">
                            <div class="d-flex align-items-center">
                                <div class="btn-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="btn-content">
                                    <div class="btn-title">Order Status</div>
                                    <div class="btn-description">Check detailed order progress</div>
                                </div>
                            </div>
                            <div class="btn-arrow">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Return Request Modal -->
    <div class="modal fade" id="returnRequestModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Return</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="returnRequestForm">
                    <div class="modal-body">
                        <h6>Select Items to Return</h6>
                        @foreach ($order->orderItems as $item)
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="items[]"
                                    value="{{ $item->id }}" id="item-{{ $item->id }}">
                                <label class="form-check-label" for="item-{{ $item->id }}">
                                    <div class="d-flex align-items-center">
                                        <div class="item-image me-3" style="width: 50px; height: 50px;">
                                            @if ($item->product)
                                                <img src="{{ $item->product->primary_image_url ?? asset('assets/imgs/template/product-placeholder.jpg') }}"
                                                    alt="{{ $item->product->title }}" class="img-fluid rounded"
                                                    onerror="this.src='{{ asset('assets/imgs/template/product-placeholder.jpg') }}'">
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <strong>{{ $item->product->title ?? 'Product no longer available' }}</strong><br>
                                            <small class="text-muted">Qty: {{ $item->quantity }} ×
                                                {{ number_format($item->price, 0) }} DJF</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach

                        <div class="form-group mt-4">
                            <label for="return_reason" class="form-label">Reason for Return *</label>
                            <select class="form-control" id="return_reason" name="reason" required>
                                <option value="">Select a reason</option>
                                <option value="defective">Defective Product</option>
                                <option value="wrong_item">Wrong Item Received</option>
                                <option value="not_as_described">Not as Described</option>
                                <option value="damaged">Damaged in Shipping</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="return_description" class="form-label">Description *</label>
                            <textarea class="form-control" id="return_description" name="description" rows="4"
                                placeholder="Please provide details about the issue..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitReturnRequest()">Submit Return
                            Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
