<!DOCTYPE html>
<html>
<head>
    <title>Print Appointment</title>
    <style>
        @page {
            size: 80mm 200mm; /* Adjust size as needed */
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 80mm;
            overflow: hidden;
        }
        .container {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin: 10px 0;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th, .content td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .content th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Appointment Details</h2>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>{{ $customer->contact }}</td>
                </tr>
                <tr>
                    <th>Appointment Number</th>
                    <td>{{ $apNumberRecord->number }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $appointment->date }}</td>
                </tr>  
                <tr>
                    <th>Visit Day</th>
                    <td>{{ $appointment->visit_day }}</td>
                </tr>
                <tr>
                    <th>Added Date</th>
                    <td>{{ $appointment->added_date }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Thank you for your appointment.</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 1000); // Adjust the delay if needed
        };
    </script>
</body>
</html>
