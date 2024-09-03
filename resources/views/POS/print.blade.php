<!DOCTYPE html>
<html>
<head>
    <title>Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 300px; /* Adjusted for POS bill size */
            margin: 0 auto;
            padding: 10px;
        }

        h1, h2, h3, h4, h5, h6 {
            margin: 5px 0;
            text-align: center;
        }

        p, table {
            font-size: 14px;
            line-height: 1.2em;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid #000;
            margin-top:10px;
        }

        table th, table td {
            text-align: left;
            padding: 8px 3px 3px 3px;
        }

        table th {
            border-bottom: 1px solid #000;

        }

        .text-right {
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
        }

        .footer p {
            font-size: 13px;
            margin: 3px 0;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 120px;
            height:30px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        .total-section {
            border-top: 1px dashed #000;
            padding-top: 5px;
        }

        .total-section p {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }

        .total-section .text-right {
            text-align: right;
            flex: 1;
        }
        .ppid{
            padding-top:10px;
            border-top: 1px dashed #000;
        }
        .ppd{
            padding-bottom:5px;
        }

    </style>
</head>
<body>

    <div class="logo">
        <img src="/images/logos/1723184027.png" alt="Logo"> <!-- Add your logo path -->
    </div>

    <div class="header">
        <p>{{ $companyDetail->address ?? 'RagamaGuru' }}</p>
        <p>Date: {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
    </div>

    <h3>Order Bill</h3>
    <p><strong>Order No: </strong> {{ $order->order_code }}</p>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-right">Total (LKR)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->item_name }} x {{ $item->quantity }}</td>
                    <td class="text-right"> {{ number_format($item->total_cost, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
    <p><strong>Sub - Total Amount</strong> <span class="text-right"> {{ number_format($order->total_cost_payment, 2) }}</span></p>
    <p>Vat(%) <span class="text-right"> {{ number_format($order->vat, 2) }}</span></p>
    <p class="ppd">Discount <span class="text-right"> {{ number_format($order->discount, 2) }}</span></p>
    <p class="ppid">Paid Amount <span class="text-right"> {{ number_format($order->paid_amount, 2) }}</span></p>
    <p>Change Due <span class="text-right"> {{ number_format($order->change, 2) }}</span></p>
    <p><strong>Total Payment</strong> <span class="text-right"> {{ number_format($order->total_cost_payment, 2) }}</span></p>
    </div>


    <div class="footer">
        <p>Billing To: {{ $order->payment_type }}</p>
        <p>Bill By: E Support</p>
        <p><strong>Thank you very much</strong></p>
    </div>

    <script>
        window.print();  // Automatically trigger print dialog

        // After printing, redirect to the appointments list
        window.onafterprint = function() {
            window.location.href = "{{ route('pospage') }}";
        };
    </script>

</body>
</html>
