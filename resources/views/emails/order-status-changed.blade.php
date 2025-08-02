<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, #09c2de 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            margin: 5px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-accepted {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-refunded {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .order-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .order-info h3 {
            margin-top: 0;
            color: #495057;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: white;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            border: 2px solid #ddd;
            font-weight: 500;
        }

        .btn:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div style="margin-bottom: 20px;">
            <img src="https://i.ibb.co/pjs2v56w/mini-logo2.png" alt="DjibMarket Logo"
                style="width: 30%; display: block; margin: 0 auto; filter: brightness(0) invert(1);">
        </div>
        <div class="header">
            <h1 style="color: #fff; font-size: 24px; font-weight: bold; margin-bottom: 10px;">Order Status Update</h1>
            <p style="color: #fff; font-size: 16px; font-weight: bold;">Your order status has been updated</p>
        </div>

        <div class="content">
            <p>Hello {{ $order->user->name ?? 'Valued Customer' }},</p>

            <p>We wanted to let you know that your order status has been updated:</p>

            <div style="text-align: center; margin: 20px 0;">
                <span
                    class="status-badge status-{{ $oldStatus }}">{{ ucfirst(str_replace('_', ' ', $oldStatus)) }}</span>
                <span style="margin: 0 10px;">→</span>
                <span
                    class="status-badge status-{{ $newStatus }}">{{ ucfirst(str_replace('_', ' ', $newStatus)) }}</span>
            </div>

            <div class="order-info">
                <h3>Order Details</h3>
                <div class="info-row">
                    <strong>Order Number:</strong>
                    <span>#{{ $order->order_number }}</span>
                </div>
                <div class="info-row">
                    <strong>Order Date:</strong>
                    <span>{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="info-row">
                    <strong>Total Amount:</strong>
                    <span>{{ number_format($order->final_price ?? 0) }} DJF</span>
                </div>
                <div class="info-row">
                    <strong>Items:</strong>
                    <span>{{ $order->orderItems->count() }}
                        {{ Str::plural('item', $order->orderItems->count()) }}</span>
                </div>
            </div>

            @switch($newStatus)
                @case('accepted')
                    <p><strong>Great news!</strong> Your order has been accepted and will be processed soon.</p>
                @break

                @case('processing')
                    <p><strong>Good news!</strong> Your order is now being processed and prepared for shipment.</p>
                @break

                @case('shipped')
                    <p><strong>Exciting news!</strong> Your order has been shipped and is on its way to you.</p>
                @break

                @case('delivered')
                    <p><strong>Wonderful!</strong> Your order has been delivered successfully.</p>
                @break

                @case('completed')
                    <p><strong>Thank you!</strong> Your order is now complete. We hope you enjoy your purchase!</p>
                @break

                @case('cancelled')
                    <p>Unfortunately, your order has been cancelled. If you have any questions, please contact our support team.
                    </p>
                @break

                @case('refunded')
                    <p>Your order has been refunded. The amount will be credited back to your original payment method.</p>
                @break

                @default
                    <p>Your order status has been updated. Thank you for shopping with us!</p>
            @endswitch

            <div style="text-align: center;">
                <a href="{{ url('/buyer/dashboard/orders') }}" class="btn"
                    style="color: #fff; background-color: #007bff;">View Order Details</a>
            </div>

            <p>If you have any questions about your order, please don't hesitate to contact our customer support team.
            </p>

            <p>Thank you for choosing DjibMarket!</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} DjibMarket. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
