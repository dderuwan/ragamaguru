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
                            <h2 class="page-title">Bookings - Local</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('customer.index')}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                    Customer List</button></a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('appointments.index')}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                    All Appointments</button></a>
                        </div>
                    </div>

                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <label>Select Date:</label>
                                    <input type="date" class="form-control mb-3 col-md-6" id="bookingDate" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" onchange="loadBookings()">

                                    <!-- table -->
                                    <table class="table " id="">
                                        <thead>
                                            <tr>
                                                <th style="color: black;">#</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">AP Number</th>
                                                <th style="color: black;">Customer Name</th>
                                                <th style="color: black;">Contact Number</th>
                                                <th style="color: black;">Booked By</th>
                                                <th style="color: black;">Added Date</th>
                                                <th style="color: black;">Status</th>
                                                <th style="color: black;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bookingsBody">

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        loadBookings();
    });

    function loadBookings() {
        const date = document.getElementById('bookingDate').value;
        const url = `{{ route('localbookings.date', ':date') }}`.replace(':date', date);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const appointmentsBody = document.getElementById('bookingsBody');
                appointmentsBody.innerHTML = '';

                data.forEach((booking, index) => {

                    const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${booking.date}</td>
                                <td>${booking.apNumber}</td>
                                <td>${booking.customer_name}</td>
                                <td>${booking.contact}</td>
                                <td>${booking.created_by}</td>
                                <td>${booking.added_date}</td>
                                <td>${booking.status == 0 ? 'Canceled' : 'Active'}</td> 
                                <td>
                                <a href="/appointments/add/${booking.customer_id}" class="btn btn-success">
                                        <i class="fas fa-calendar-check"></i> 
                                    </a>
                                    <a href="javascript:void(0)" 
                                        onclick="confirmCancel(${booking.id})" 
                                        class="btn btn-danger ${booking.status == 0 ? 'disabled' : ''}" 
                                        ${booking.status == 0 ? 'disabled' : ''}> 
                                        <i class="fa-solid fa-ban"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                    appointmentsBody.insertAdjacentHTML('beforeend', row);
                });
            })
            .catch(error => console.error('Error fetching appointments:', error));
    }


    function confirmCancel(bookingId) {
        Swal.fire({
            title: 'Are you sure cancel this booking?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                cancelBooking(bookingId);
            }
        });
    }

    function cancelBooking(bookingId) {
        $.ajax({
            url: `/bookings/cancel/${bookingId}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire(
                    'Canceled!',
                    'The booking has been canceled.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            },
            error: function(error) {
                Swal.fire(
                    'Error!',
                    'There was a problem canceling the booking.',
                    'error'
                );
            }
        });
    }
</script>

@endsection