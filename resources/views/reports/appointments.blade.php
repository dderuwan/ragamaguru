@extends('layouts.main.master')

@section('title', 'Ragama Guru - Appointments Report')

@section('content')
<main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h2>Appointment Report</h2>
                        </div>
                    </div>
                    <p class="card-text"></p>
                    <div class="row my-4">
                        <!-- Filter Section -->
                        <div class="col-md-12 mb-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row" id='filter-section'>
                                        <div class="col-md-6">
                                            <h5>Filter Section</h5>
                                        </div>
                                        <div class="col-md-12" id='fil'>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="start-date">From:</label>
                                                    <input type="date" id="start-date" class="form-control">
                                                </div>
                                                <div class="col-md-5">
                                                    <label for="end-date">To:</label>
                                                    <input type="date" id="end-date" class="form-control">
                                                </div>
                                                <div class="col-md-2 align-self-end">
                                                    <button class="btn btn-primary" id="filter-date-range">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table id="mydata" class="table">
                                        <thead>
                                            <tr>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Ap Number</th>
                                                <th style="color: black;">Customer Name</th>
                                                <th style="color: black;">Customer Contact</th>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Appointment Type</th>
                                                <th style="color: black;">Created By</th>
                                                <th style="color: black;">Created User ID</th>
                                                <th style="color: black;">Total Amount</th>
                                                <th style="color: black;">Paid Amount</th>
                                                <th style="color: black;">Due Amount</th>
                                                <th style="color: black;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->date }}</td>
                                                <td>{{ $appointment->apNumber->number }}</td>
                                                <td>{{ $appointment->customer->name }}</td>
                                                <td>{{ $appointment->customer->contact }}</td>
                                                <td>{{ $appointment->visitDay->name ?? 'Not Updated' }}</td>
                                                <td>{{ $appointment->appointmentType->type }}</td>
                                                <td>{{ $appointment->created_by }}</td>
                                                <td>{{ $appointment->created_user_id ?? 'No user'}}</td>
                                                <td>{{ $appointment->total_amount ?? '0'}}</td>
                                                <td>{{ $appointment->paid_amount ?? '0'}}</td>
                                                <td>{{ $appointment->due_amount ?? '0'}}</td>
                                                <td>
                                                    <!-- Show Button -->
                                                    <a href="{{route('appointments.printPreview',$appointment->id)}}" class="btn btn-secondary"><i class="fa-solid fa-print fe-12"></i></a>

                                                    <!-- Delete Button -->
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        
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
        dom: 'Bfrtip', 
        buttons: [
            {
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
                orientation: 'landscape',
                customize: function(doc) {
                    doc.content[1].margin = [0, 0, 0, 20];
                },
                exportOptions: {
                    columns: function(idx, data, node) {
                        return idx !== 11; 
                    }
                }
            },
            {
                extend: 'print',
                footer: true,
                title: '',
                customize: function(win) {
                    $(win.document.body)
                        .prepend(`
                        <div style="text-align: center; margin: 0 auto; width: 100%; page-break-after: avoid;">
                            <img src="/images/logos/1723184027.png" style="height: 50px; width: auto; display: block; margin: 0 auto;" />
                            <h2 style="margin-top: 10px; font-size: 24px; font-weight: bold; text-align: center;">Appointment Report</h2>
                        </div>
                    `);

                    $(win.document.body).find('table').find('th:eq(11), td:eq(11)').hide();

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
       
    });

    
});

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(appointmentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + appointmentId).submit();
            }
        });
    }
</script>

@endsection
