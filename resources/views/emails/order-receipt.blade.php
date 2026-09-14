<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyBuy Receipt & Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAF6EE;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #191917;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border: 1px solid #E0D3C1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #191917;
            padding: 24px 32px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #FAF6EE;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -0.5px;
        }
        .header .badge {
            display: inline-block;
            margin-top: 8px;
            background-color: #FFD000;
            color: #191917;
            font-size: 11px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 32px;
        }
        .status-box {
            background-color: #F4FBF5;
            border: 1px solid #C8E8CE;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            text-align: center;
        }
        .status-box h2 {
            margin: 0 0 4px 0;
            color: #1B5E20;
            font-size: 16px;
            font-weight: 700;
        }
        .status-box p {
            margin: 0;
            color: #557755;
            font-size: 13px;
        }
        .order-meta {
            width: 100%;
            margin-bottom: 24px;
            border-collapse: collapse;
        }
        .order-meta td {
            padding: 6px 0;
            font-size: 13px;
        }
        .order-meta .label {
            color: #7A7365;
            font-weight: 600;
            width: 40%;
        }
        .order-meta .value {
            color: #191917;
            font-weight: 700;
            text-align: right;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        .items-table th {
            background-color: #F7F3EB;
            padding: 10px 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5C5549;
            text-align: left;
            border-top: 1px solid #E0D3C1;
            border-bottom: 1px solid #E0D3C1;
        }
        .items-table td {
            padding: 12px;
            font-size: 13px;
            border-bottom: 1px solid #F0E8DC;
            color: #191917;
        }
        .items-table .text-right {
            text-align: right;
        }
        .totals-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
        }
        .totals-table td {
            padding: 6px 12px;
            font-size: 13px;
        }
        .totals-table .total-row td {
            padding: 14px 12px;
            background-color: #191917;
            color: #FAF6EE;
            font-size: 16px;
            font-weight: 800;
            border-radius: 8px;
        }
        .totals-table .total-row .total-amount {
            color: #FFD000;
            text-align: right;
        }
        .address-box {
            background-color: #FAF6EE;
            border: 1px solid #E0D3C1;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 28px;
            font-size: 13px;
        }
        .address-box h3 {
            margin: 0 0 8px 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #7A7365;
        }
        .cta-btn {
            display: block;
            width: 100%;
            box-sizing: border-box;
            background-color: #FFD000;
            color: #191917;
            text-align: center;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
        }
        .footer {
            background-color: #F7F3EB;
            padding: 24px;
            text-align: center;
            font-size: 11px;
            color: #8A857A;
            border-top: 1px solid #E0D3C1;
        }
        .footer a {
            color: #191917;
            text-decoration: underline;
        }
    </style>
</head>
<body style="padding: 24px 12px; background-color: #FAF6EE;">
    <div class="container">
        <!-- Brand Header -->
        <div class="header">
            <h1>EASYBUY</h1>
            <div class="badge">Official Procurement Receipt</div>
        </div>

        <div class="content">
            <!-- Payment Success Box -->
            <div class="status-box">
                <h2>✓ Payment Confirmed & Order Placed</h2>
                <p>Thank you for your order! Your single consolidated invoice is ready.</p>
            </div>

            <!-- Order Metadata Table -->
            <table class="order-meta">
                <tr>
                    <td class="label">Order Number:</td>
                    <td class="value">{{ $order->order_number }}</td>
                </tr>
                <tr>
                    <td class="label">Invoice Reference:</td>
                    <td class="value">{{ $order->single_invoice_ref ?? 'EB-INV-' . $order->id }}</td>
                </tr>
                <tr>
                    <td class="label">Order Date:</td>
                    <td class="value">{{ $order->created_at->format('M d, Y • h:i A') }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Method:</td>
                    <td class="value">{{ strtoupper($order->payment->payment_method ?? ($order->payment_status === 'paid' ? 'Paystack Card' : $order->payment_status)) }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Status:</td>
                    <td class="value" style="color: #2E7D32;">● {{ strtoupper($order->payment_status) }}</td>
                </tr>
            </table>

            <!-- Itemized Products -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->product_name }}</strong>
                                <br>
                                <span style="color: #7A7365; font-size: 11px;">SKU: {{ $item->product_sku }}</span>
                            </td>
                            <td class="text-right">{{ $item->quantity }}</td>
                            <td class="text-right">₦{{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-right" style="font-weight: 700;">₦{{ number_format($item->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals Breakdown -->
            <table class="totals-table">
                <tr>
                    <td style="color: #7A7365;">Subtotal</td>
                    <td class="text-right" style="font-weight: 600;">₦{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td style="color: #7A7365;">Consolidated Freight (5% with ₦1,000 min floor)</td>
                    <td class="text-right" style="font-weight: 600;">₦{{ number_format($order->shipping_amount, 2) }}</td>
                </tr>
                <tr>
                    <td style="color: #7A7365;">Statutory VAT (7.5%)</td>
                    <td class="text-right" style="font-weight: 600;">₦{{ number_format($order->tax_amount, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td>Total Amount Settled</td>
                    <td class="total-amount">₦{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </table>

            <!-- Consignee Shipping Address -->
            <div class="address-box">
                <h3>Delivery & Consignee Destination</h3>
                <p style="margin: 0 0 4px 0; font-weight: 700; color: #191917;">
                    {{ $order->shipping_address['company'] ?? 'EasyBuy Technologies Nigeria Ltd' }}
                </p>
                <p style="margin: 0 0 4px 0; color: #5C5549;">
                    Attn: {{ $order->shipping_address['contact_name'] ?? ($order->user->username ?? 'Procurement Officer') }} • Phone: {{ $order->shipping_address['phone'] ?? 'N/A' }}
                </p>
                <p style="margin: 0; color: #7A7365;">
                    {{ $order->shipping_address['address'] ?? '' }}, {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? 'Lagos' }}, {{ $order->shipping_address['country'] ?? 'Nigeria' }}
                </p>
            </div>

            <!-- View Online / Download Invoice CTA Button -->
            <a href="{{ url('/order/invoice/' . $order->order_number) }}" class="cta-btn">
                View & Download Official Invoice (PDF) &rarr;
            </a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 6px 0;">
                EasyBuy Technologies Nigeria Ltd • Unified B2B Sourcing & Single-Invoice Dispatch
            </p>
            <p style="margin: 0; color: #9C9283;">
                Questions about your shipment or procurement dispatch? Contact our procurement desk at <a href="mailto:support@easybuy.ng">support@easybuy.ng</a>
            </p>
        </div>
    </div>
</body>
</html>
