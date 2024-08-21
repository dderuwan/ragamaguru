@extends('layouts.main.master')

@section('content')
<style>
    .fc-event-custom.event {
        background-color: #27E151;
        border-color: #27E151;
    }

    .fc-time {
        padding: 0 0 0 2px;
        font-size: 12px;
    }

    .fc-title {
        display: block;
        padding: 0 0 0 2px;
        font-size: 12px;
    }

    .fc td,
    .fc th {
        border-left: 1px solid #ddd !important;
    }
</style>

<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center my-3">
                        <div class="col">
                            <h2 class="page-title">All Appointments</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('customer.index')}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                    Customer List</button></a>
                        </div>
                        <!-- <div class="col-auto">
                            <a href=""><button type="button" class="btn btn-primary" data-toggle="modal">
                                    Online Bookings</button></a>
                        </div> -->
                    </div>

                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <label>Select Date:</label>
                                    <input type="date" class="form-control mb-3 col-md-6" id="appointmentDate" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" onchange="loadAppointments()">

                                    <!-- table -->
                                    <table class="table " id="">
                                        <thead>
                                            <tr>
                                                <th style="color: black;">#</th>
                                                <th style="color: black;">Appointment Number</th>
                                                <th style="color: black;">Customer Name</th>
                                                <th style="color: black;">Contact Number</th>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Treatment</th>
                                                <th class="text-center" style="color: black;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="appointmentsBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
</div> <!-- .wrapper -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        loadAppointments();
    });

    function loadAppointments() {
        const date = document.getElementById('appointmentDate').value;
        const url = `{{ route('appointments.date', ':date') }}`.replace(':date', date);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const appointmentsBody = document.getElementById('appointmentsBody');
                appointmentsBody.innerHTML = '';

                data.forEach((appointment, index) => {
                    let appointmentID = appointment.id;
                    let visitDayText = '';
                    switch (appointment.visit_day) {
                        case '1':
                            visitDayText = 'First Visit';
                            break;
                        case '2':
                            visitDayText = 'Second Visit';
                            break;
                        case '3':
                            visitDayText = 'Third Visit';
                            break;
                        default:
                            visitDayText = 'Other Visit';
                            break;
                    }

                    const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${appointment.ap_number}</td>   
                                <td>${appointment.customer_name}</td>
                                <td>${appointment.contact}</td>
                                <td>${visitDayText}</td>
                                <td>${appointment.haveTreat}</td>
                                <td>
                                    <div class="action-icons">
                                        <a href="{{ route('customerTreat', '') }}/${appointment.id}" class="btn btn-success"><i class="fe fe-plus-square fe-16"></i></i></a>
                                        ${appointment.haveTreat === "Done" ? `
                                        <a href="{{ route('viewCustomerTreat', '') }}/${appointment.id}" class="btn btn-warning">
                                            <i class="fe fe-eye fe-16"></i>
                                        </a>` : ''}
                                        <button class="btn btn-danger action-icon delete-icon" onclick="confirmDelete(${appointment.id})" title="Delete">
                                            <i class="fe fe-trash-2"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-${appointment.id}" action="{{ route('appointments.destroy', '') }}/${appointment.id}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>    
                                </td>
                            </tr>
                        `;
                    appointmentsBody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => console.error('Error fetching appointments:', error));
    }



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
                document.getElementById(`delete-form-${appointmentId}`).submit();
            }
        });
    }
</script>

@endsection