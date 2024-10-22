<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treatment Bill</title>
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
            padding-bottom: 5px;
        }

        .header .logo {
            width: 100px;
        }

        .header .company-info {
            text-align: right
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 18px;
        }

        .header .company-info p {
            margin: 1px 0;
        }

        .section {
            margin-bottom: 10px;
        }

        .section h2 {
            font-size: 14px;
            text-decoration: underline;
            margin-bottom: 5px;
        }

        .section table {
            width: 100%;
            border-collapse: collapse;
        }

        .section table,
        .section table th,
        .section table td {
            border: 1px solid #000;
        }

        .section table th,
        .section table td {
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
            margin-top: 10px;
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
                <img src="{{ asset('images/logos/' . app(\App\Http\Controllers\CompanySettingController::class)->getCompanyLogo()) }}"
                style="width:auto; height:85px;"  alt="Company Logo">
            </div>
            <div class="company-info">
                <div class="logo2">
                    <img src="/images/logos/1723184027.png" style="width:auto; height:45px;" alt="Logo">
                </div>
                <p>{{$companyDetail->address ?? 'RagamaGuru'}}</p>
                <p>{{$companyDetail->contact ?? 'xxx-xxxxxxxx'}}</p>
            </div>
        </div>

        <!-- Date and Bill Number -->
        <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <p><span class="label">Date & Time:</span>{{$currentDateTime}}</p>
            <p><span class="label">Treat No:</span> {{$customerTreatment->id}}</p>
        </div>


        <!-- Section 1: Customer Details -->
        <div class="section">
            <h2>Personal Details</h2>
            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{$customer->name}}</td>
                    <td class="label">Contact:</td>
                    <td>{{$customer->contact}}</td>
                </tr>
                <tr>
                    <td class="label">Country Type:</td>
                    <td>{{$customer->countryType->name}}</td>
                    <td class="label">Country:</td>
                    <td>{{$countryName}}</td>
                </tr>
            </table>
        </div>

        <!-- Section 2: Appointment Details -->
        <div class="section">
            <h2>Appointment Details</h2>
            <table>
                <tr>
                    <td class="label">Visit Type:</td>
                    @if ($appointment->visitDay==null)
                    <td>Not Defined</td>
                    @else
                    <td>{{$appointment->visitDay->name}}</td>
                    @endif 
                    <td class="label">Visit Date:</td>
                    <td>{{$customerTreatment->added_date}}</td>
                    <td class="label">Appointment No:</td>
                    <td>{{$appointment->apNumber->number}}</td>
                </tr>
            </table>
        </div>

        <!-- Section 3: Comments and Things to Bring -->
        <div class="section">
            <h2>Comments</h2>
            <table>
                <tr>
                    <td class="label">Comments:</td>
                    <td>{{$customerTreatment->comment ?? 'No'}}</td>
                </tr>
                <tr>
                    <td class="label">Things to Bring:</td>
                    <td>{{$customerTreatment->things_to_bring ?? 'No'}}</td>
                </tr>
                <tr>
                    <td class="label">Next Visit Date:</td>
                    <td>{{$customerTreatment->next_day ?? 'No'}}</td>
                </tr>
            </table>
        </div>

        @if ($customerTreatment->treatments)
        <!-- Section 4: Treatments and Amounts -->
        <div class="section">
            <h2>Treatments & Amounts</h2>
            <table>
                <thead>
                    <tr>
                        <th>Your Selection</th>
                        <th>Given Treatments</th>
                        <th>Things to Bring</th>
                        <th>Amount (LKR)</th> 
                    </tr>
                </thead>
                <tbody>
                @foreach ($treatments as $treatment)
                <tr>
                    <td class="checkbox">
                        <input type="checkbox" 
                               @if(in_array($treatment->id, $selectedTreatmentIds)) checked @endif 
                               disabled>
                    </td>
                    <td>{{ $treatment->name }}</td>
                    <td>
                        @if(is_array(json_decode($treatment->things_to_bring)))
                            {{ implode(', ', json_decode($treatment->things_to_bring)) }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ number_format($treatment->amount, 2) }}</td>
                </tr>
            @endforeach

                    <tr>
                        <td colspan="3"><strong>Total Amount for Selected Treatments:</strong></td>
                        <td colspan="2">{{ number_format($customerTreatment->total_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>  
        @endif

        @if ($customerTreatment->total_amount)
        <!-- Section 5: Payment Details -->
        <div class="section">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td class="label">Paid Amount: (LKR)</td>
                    <td>{{ number_format($customerTreatment->paid_amount, 2) }}</td>
                    <td class="label">Due Amount: (LKR)</td>
                    <td>{{ number_format($customerTreatment->due_amount, 2) }}</td>
                    <td class="label">Payment Type:</td>
                    <td>{{$customerTreatment->paymentType->name}}</td>   
                </tr>
            </table>
        </div>
        @endif

        <!-- Footer Section -->
        <div class="footer">
            <p>Bring This receipt when you come with your list of things.</p>
            <!-- <p>Thank you for your visit!</p> --> 
            <p class="prepared-by">Prepared by: {{ $user->firstname }} {{ $user->lastname }}</p>
        </div>
    </div>


    <script>
        window.print(); // Automatically trigger print dialog

        // After printing, redirect to the appointments list
        window.onafterprint = function() {
            window.location.href = "{{ route('appointments.index') }}";
        };
    </script>

</body>

</html>