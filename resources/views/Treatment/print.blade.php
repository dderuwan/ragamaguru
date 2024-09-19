<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable Treatment Bill</title>
    <style>
         
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 10;
            padding: 0;
        }
        .bill-container {
            width: 210mm;
            height: 297mm;
            padding: 25mm;
            box-sizing: border-box;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header .logo {
            width: 100px;
        }

        .header .company-info {
            text-align: right;
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 18px;
        }

        .header .company-info p {
            margin: 3px 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 10px;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section table, .section table th, .section table td {
            border: 1px solid #000;
        }

        .section table th, .section table td {
            padding: 10px;
            text-align: left;
        }

        .section .label {
            font-weight: bold;
        }

        .section .checkbox {
            text-align: center;
        }

        .section .checkbox input {
            margin: 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
        }

        .footer .prepared-by {
            margin-top: 20px;
            font-weight: bold;
            text-align: left;
        }

        @media print {
            .bill-container {
                border: none;
                padding: 0;
                margin: 0;
                width: 100%;
                height: auto;
            }

            .header {
                border-bottom: 2px solid #000;
            }
        }
    </style>
</head>
<body>

<div class="bill-container">
    <!-- Header Section -->
    <div class="header">
        <div class="logo">
            <img src="https://via.placeholder.com/120" alt="Company Logo">
        </div>
        <div class="company-info">
            <h1>Company Name</h1>
            <p>1234 Company Address, City, Country</p>
            <p>Phone: +123 456 789 | Email: contact@company.com</p>
        </div>
    </div>

    <!-- Date and Bill Number -->
    <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
    <p><span class="label">Date & Time:</span> 2024-09-18 14:30:00</p>
    <p><span class="label">Bill No:</span> INV-00123</p>
</div>


    <!-- Section 1: Customer Details -->
    <div class="section">
        <h2>Personal Details</h2>
        <table>
            <tr>
                <td class="label">Name:</td>
                <td>John Doe</td>
                <td class="label">Contact:</td>
                <td>+123 456 789</td>
            </tr>
            <tr>
                <td class="label">Country Type:</td>
                <td>Local</td>
                <td class="label">Country:</td>
                <td>USA</td>
            </tr>
        </table>
    </div>

    <!-- Section 2: Appointment Details -->
    <div class="section">
        <h2>Appointment Details</h2>
        <table>
            <tr>
                <td class="label">Visit Day:</td>
                <td>Wednesday</td>
                <td class="label">Visit Date:</td>
                <td>2024-09-18</td>
                <td class="label">Appointment No:</td>
                <td>APT-20240918</td>
            </tr>
        </table>
    </div>

    <!-- Section 3: Comments and Things to Bring -->
    <div class="section">
        <h2>Comments</h2>
        <table>
            <tr>
                <td class="label">Comments:</td>
                <td>No specific comments.</td>
            </tr>
            <tr>
                <td class="label">Things to Bring:</td>
                <td>Towel, Water Bottle</td>
            </tr>
            <tr>
                <td class="label">Next Visit Date:</td>
                <td>2024-05-05</td>
            </tr>
        </table>
    </div>

    <!-- Section 4: Treatments and Amounts -->
    <div class="section">
        <h2>Treatments & Amounts</h2>
        <table>
            <thead>
                <tr>
                    <th class="checkbox">Selected</th>
                    <th>Treatment Name</th>
                    <th>Amount</th>
                    <th>Things to Bring</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="checkbox"><input type="checkbox" checked disabled></td>
                    <td>Massage Therapy</td>
                    <td>$50.00</td>
                    <td>Towel</td>
                </tr>
                <tr>
                    <td class="checkbox"><input type="checkbox" checked disabled></td>
                    <td>Facial Treatment</td>
                    <td>$30.00</td>
                    <td>Water Bottle</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total Amount</strong></td>
                    <td colspan="2">$80.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Section 5: Payment Details -->
    <div class="section">
        <h2>Payment Details</h2>
        <table>
            <tr>
                <td class="label">Paid Amount:</td>
                <td>$60.00</td>
                <td class="label">Due Amount:</td>
                <td>$20.00</td>
                <td class="label">Payment Type:</td>
                <td>Credit Card</td>
            </tr>
        </table>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <h3>Bring This receipt when you come with your list of things.</h3>
        <h3>Thank you for your visit!</h3>
        <p class="prepared-by">Prepared by: Jane Smith</p>
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
