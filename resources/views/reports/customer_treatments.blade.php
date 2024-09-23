@extends('layouts.main.master')

@section('title', 'Ragama Guru - Customer Treatments Report')

@section('content')
<main role="main" class="main-content">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h2>Customer Treatments Report</h2>
                    </div>
                </div>
                <p class="card-text"></p>
                <div class="row my-4">
                    <!-- Filter Section -->
                 
                    <!-- Customer Treatments Table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table id="mydata" class="table">
                                    <thead>
                                        <tr>
                                            <th style="color: black;">Treat ID</th>
                                            <th style="color: black;">Customer Name</th>
                                            <th style="color: black;">Customer Contact</th>
                                            <th style="color: black;">Visit Day</th>
                                            <th style="color: black;">Date</th>
                                            <th style="color: black;">Added Treatments</th>
                                            <th style="color: black;">Selected Treatments</th>
                                            <th style="color: black;">Comments</th>
                                            <th style="color: black;">Things to Bring</th>
                                            <th style="color: black;">Next Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($treatments as $treatment)
                                        <tr>
                                            <td>{{ $treatment->id }}</td>
                                            <td>{{ $treatment->customer->name }}</td>
                                            <td>{{ $treatment->customer->contact }}</td>
                                            <td>{{ $treatment->appointment->visitDay->name }}</td>
                                            <td>{{ $treatment->added_date }}</td>
                                            <td>
                                                @if($treatment->treatments)
                                                @php
                                                $treatmentNames = \App\Models\Treatment::whereIn('id', $treatment->treatments)->pluck('name')->toArray();
                                                @endphp
                                                @foreach($treatmentNames as $treatmentName)
                                                {{ $treatmentName }}<br>
                                                @endforeach
                                                @else
                                                No
                                                @endif
                                            </td>
                                            <td>
                                                @if($treatment->selected_treatments)
                                                @php
                                                $selectedTreatmentNames = \App\Models\Treatment::whereIn('id', $treatment->selected_treatments)->pluck('name')->toArray();
                                                @endphp
                                                @foreach($selectedTreatmentNames as $treatmentName)
                                                {{ $treatmentName }}<br>
                                                @endforeach
                                                @else
                                                No
                                                @endif
                                            </td>
                                            <td>{{ $treatment->comment ?? 'No' }}</td>
                                            <td>{{ $treatment->things_to_bring ?? 'No' }}</td>
                                            <td>{{ $treatment->next_day ? \Carbon\Carbon::parse($treatment->next_day)->format('Y-m-d') : 'No' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!-- <tfoot>
                                            <tr>
                                                <th colspan="10" style="text-align:right">Total:</th>
                                                <th id="totalAmount"></th>
                                                <th id="paidAmount"></th>
                                                <th id="dueAmount"></th>
                                            </tr>
                                        </tfoot> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    $(document).ready(function() {
        var table = $('#mydata').DataTable({
            dom: 'Bfrtip', // Layout for DataTables with Buttons
            buttons: [{
                    extend: 'copyHtml5',
                    footer: true
                },
                {
                    extend: 'excelHtml5',
                    footer: true
                },
                {
                    extend: 'csvHtml5',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    footer: true,
                    orientation: 'landscape', // Set orientation to landscape
                    customize: function(doc) {
                        doc.content[1].margin = [0, 0, 0, 20];
                    }
                },

                {
                    extend: 'print',
                    footer: true,
                    title: '',
                    customize: function(win) {
                        // Add custom styles for print
                        $(win.document.body).css('transform', 'rotate(90deg)'); // Rotate for landscape
                        $(win.document.body).css('width', '210mm'); // A4 height in landscape
                        $(win.document.body).css('height', '297mm'); // A4 width in landscape

                        $(win.document.head).append(`
                        <style>
                            @page {
                                size: A4 portraite;
                                margin: 0; /* Use to adjust margins */   
                            }
                            body {
                                margin: 10mm; /* Adjust as needed */
                            }
                        </style>
                    `);

                        $(win.document.body)
                            .prepend(`<div style="text-align: center; margin: 0 auto; width: 100%; page-break-after: avoid;">
                        <img src="/images/logos/1723184027.png" style="height: 50px; width: auto; display: block; margin: 0 auto;" />
                        <h2 style="margin-top: 10px; font-size: 24px; font-weight: bold; text-align: center;">Customer Treatments Report</h2>
                    </div>`);
                    }
                }


            ],
            // footerCallback: function (row, data, start, end, display) {
            //     var api = this.api();

            //     // Calculate total amounts
            //     var total = api.column(10).data().reduce(function (a, b) {
            //         return parseFloat(a) + parseFloat(b);
            //     }, 0);

            //     var paid = api.column(11).data().reduce(function (a, b) {
            //         return parseFloat(a) + parseFloat(b);
            //     }, 0);

            //     var due = api.column(12).data().reduce(function (a, b) {
            //         return parseFloat(a) + parseFloat(b);
            //     }, 0);

            //     // Update the footer
            //     $(api.column(10).footer()).html('LKR ' + total.toFixed(2));
            //     $(api.column(11).footer()).html('LKR ' + paid.toFixed(2));
            //     $(api.column(12).footer()).html('LKR ' + due.toFixed(2));
            // }
        });

        
    });
</script>
@endsection