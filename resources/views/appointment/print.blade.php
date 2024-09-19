<!DOCTYPE html>
<html>

<head>
    <title>Appointment</title>
    <style>
        @page {
            size: 80mm 200mm;
            /* Adjust size as needed */
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

        .header,
        .footer {
            text-align: center;
            font-size: 14px;
        }

        .content {
            margin: 2px 0;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content th,
        .content td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }

        

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 130px;
            height: 40px;
        }

        .appointment-details {
            text-align: center;
            font-size: 15px;
        
        }
        .appointment-date {
            font-size: 15px;
            font-weight: bold;
        }
        .appointment-number {
            font-size: 22px;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="/images/logos/1723184027.png" alt="Logo">
        </div>
        <div class="header">
            <p>{{ $companyDetail->address ?? 'RagamaGuru' }}</p>
            <p>Date: {{ $appointment->added_date }}</p>
            <h3>Appointment</h3>
        </div>

        <div class="content">
            <table>
                <tr>
                    <th>Name</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>{{ $customer->contact }}</td>
                </tr>
                <tr>
                    <th>Visit Day</th>
                    <?php
                    $visit = $appointment->visit_day;
                    $visitDay='null';
                    if ($visit==0){
                    $visitDay = 'Checking Visit';
                    }else if($visit==1){
                        $visitDay = 'First Visit';
                    }else if($visit==2){
                        $visitDay = 'Second Visit';
                    }else if($visit==3){
                        $visitDay = 'Third Visit';
                    }else{
                        $visitDay = 'Other Visit';
                    }
                    ?>
                    <td>{{ $visitDay }}</td>
                </tr>
            </table>

            <div class="appointment-details">
                <p>Appointment Date</p>
                <p class="appointment-date">{{ $appointment->date }}</p>
                <p>Appointment Number</p>
                <p class="appointment-number">{{ $apNumberRecord->number }}</p>
            </div>
        </div>
        <div class="footer">
            <p>Created By: user name</p>
            <p>Thank you for your appointment.</p>
        </div>
    </div>
    <script>
        window.print(); // Automatically trigger print dialog

        // After printing, redirect to the appointments list
        window.onafterprint = function() {
            window.location.href = "{{ route('allcustomers') }}";
        };
    </script>
</body>

</html>