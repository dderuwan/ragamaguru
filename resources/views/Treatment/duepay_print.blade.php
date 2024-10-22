<!DOCTYPE html>
<html>
<head>
    <title>Due Payment Bill</title>
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
            margin-top: 10px;
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
            height: 30px;
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
        .ppid {
            padding-top: 10px;
            border-top: 1px dashed #000;
        }
        .ppd {
            padding-bottom: 5px;
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

    <h3>Due Payment Bill</h3>
    <p><strong>Bill for Treat No: {{ $treatId }}</strong></p>

    <table>
        <tr>
            <th>Amount to be paid</th>
            <td class="text-right">{{ number_format($tobepaid, 2) }} LKR</td>
        </tr>
        <tr>
            <th>Paid Amount</th>
            <td class="text-right">{{ number_format($pamount, 2) }} LKR</td>
        </tr>
        <tr>
            <th>Due Amount</th>
            <td class="text-right">{{ number_format($damount, 2) }} LKR</td>
        </tr>
        <tr>
            <th>Payment Type</th>
            <td class="text-right">{{ $ptypename }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Prepared By: {{ $user->firstname }} {{ $user->lastname }}</p>
        <p><strong>Thank you very much</strong></p>
    </div>

    <script>
        window.print();  // Automatically trigger print dialog

        // After printing, redirect to the appointments list
        window.onafterprint = function() {
            window.location.href = "{{ route('allcustomers') }}";
        };
    </script>

</body>
</html>
