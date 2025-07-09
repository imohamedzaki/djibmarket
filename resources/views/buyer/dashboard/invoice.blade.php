<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .invoice-title {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }

        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .invoice-info-left,
        .invoice-info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .invoice-info-right {
            text-align: right;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-title {
            font-weight: bold;
            font-size: 14px;
            color: #007bff;
            margin-bottom: 5px;
        }

        .info-content {
            font-size: 12px;
            line-height: 1.4;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background-color: #007bff;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
        }

        .items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }

        .items-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .totals-section {
            float: right;
            width: 300px;
            margin-top: 20px;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }

        .totals-table .total-row {
            font-weight: bold;
            font-size: 14px;
            background-color: #f8f9fa;
            border-top: 2px solid #007bff;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .status-processing {
            background-color: #17a2b8;
            color: white;
        }

        .status-shipped {
            background-color: #007bff;
            color: white;
        }

        .status-delivered {
            background-color: #28a745;
            color: white;
        }

        .status-canceled {
            background-color: #dc3545;
            color: white;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    <div class="header">
        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket Logo"
                style="height: 60px; margin-right: 15px;">
            <div>
                <div class="company-name">DjibMarket</div>
                <div style="font-size: 12px; color: #666;">Your Premier Online Marketplace</div>
            </div>
        </div>
        <div class="invoice-title">INVOICE</div>
    </div>

    <div class="invoice-info">
        <div class="invoice-info-left">
            <div class="info-section">
                <div class="info-title">Bill To:</div>
                <div class="info-content">
                    <strong>{{ $order->user->name }}</strong><br>
                    {{ $order->user->email }}<br>
                    @if ($order->user->phone)
                        {{ $order->user->phone }}<br>
                    @endif
                </div>
            </div>

            @if ($order->shippingAddress)
                <div class="info-section">
                    <div class="info-title">Ship To:</div>
                    <div class="info-content">
                        <strong>{{ $order->shippingAddress->full_name }}</strong><br>
                        {{ $order->shippingAddress->full_address }}<br>
                        {{ $order->shippingAddress->phone }}
                    </div>
                </div>
            @endif
        </div>

        <div class="invoice-info-right">
            <div class="info-section">
                <div class="info-title">Invoice Details:</div>
                <div class="info-content">
                    <strong>Invoice #:</strong> {{ $order->order_number }}<br>
                    <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}<br>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $order->status }}">{{ $order->status_label }}</span><br>
                    @if ($order->tracking_number)
                        <strong>Tracking #:</strong> {{ $order->tracking_number }}<br>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">Product</th>
                <th style="width: 15%;" class="text-center">Qty</th>
                <th style="width: 17.5%;" class="text-right">Unit Price</th>
                <th style="width: 17.5%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product->title ?? 'Product no longer available' }}</strong>
                        @if ($item->product && $item->product->category)
                            <br><small style="color: #666;">Category: {{ $item->product->category->name }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price, 0) }} DJF</td>
                    <td class="text-right">{{ number_format($item->price * $item->quantity, 0) }} DJF</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="clearfix">
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">{{ number_format($order->total_price, 0) }} DJF</td>
                </tr>
                @if ($order->discount_amount > 0)
                    <tr>
                        <td>Discount:</td>
                        <td class="text-right" style="color: #28a745;">-{{ number_format($order->discount_amount, 0) }}
                            DJF</td>
                    </tr>
                @endif
                @if ($order->shipping_cost > 0)
                    <tr>
                        <td>Shipping:</td>
                        <td class="text-right">{{ number_format($order->shipping_cost, 0) }} DJF</td>
                    </tr>
                @endif
                @if ($order->tax_amount > 0)
                    <tr>
                        <td>Tax:</td>
                        <td class="text-right">{{ number_format($order->tax_amount, 0) }} DJF</td>
                    </tr>
                @endif
                <tr class="total-row">
                    <td><strong>Total:</strong></td>
                    <td class="text-right"><strong>{{ number_format($order->final_price, 0) }} DJF</strong></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>DjibMarket - Your Premier Online Marketplace | Email: support@djibmarket.com</p>
        <p>This is a computer-generated invoice. No signature required.</p>
    </div>
</body>

</html>
