@extends('layouts.main.master')

@section('content')
<style>
    /* Your styles */
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
                            <a href="{{route('showCalendarSchedule')}}"><button type="button" class="btn btn-primary">
                                    <i class="fa-regular fa-calendar-days"></i></button></a>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('customer.index')}}"><button type="button" class="btn btn-primary">
                                    <i class="fe fe-user fe-16"></i></button></a>
                        </div>
                    </div>

                    <!-- Appointment Type Tabs -->
                    <ul class="nav nav-tabs mb-3" id="appointmentTypeTabs" role="tablist">
                        @foreach($appointmentTypes as $index => $type)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="type-{{$type->id}}-tab"
                               data-toggle="tab" href="#type-{{$type->id}}" role="tab" aria-controls="type-{{$type->id}}"
                               aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                               onclick="loadAppointments({{ $type->id }})">{{ $type->type }}</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <label>Select Date:</label>
                                    <input type="date" class="form-control mb-3 col-md-6" id="appointmentDate"
                                           value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                                           onchange="loadAppointments(selectedType)">

                                    <!-- table -->
                                    <table class="table" id="">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Appointment Number</th>
                                                <th>Customer Name</th>
                                                <th>Contact Number</th>
                                                <th>Visit Day</th>
                                                <th>Status</th>
                                                <th>Treatment</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="appointmentsBody">
                                            <!-- Appointments will be loaded here -->
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
    let selectedType = null; // Default type will be set dynamically

    document.addEventListener("DOMContentLoaded", function () {
        // Get the first tab's ID dynamically from the appointment types list
        const firstTypeTab = document.querySelector('#appointmentTypeTabs .nav-link');
        if (firstTypeTab) {
            const firstTypeId = firstTypeTab.getAttribute('onclick').match(/\d+/)[0];
            selectedType = firstTypeId;
            loadAppointments(selectedType); // Load default type on page load
        }
    });

    function loadAppointments(type) {
        selectedType = type;
        const date = document.getElementById('appointmentDate').value;
        const url = `{{ route('appointments.byTypeAndDate', ['type' => ':type', 'date' => ':date']) }}`
            .replace(':type', type)
            .replace(':date', date);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const appointmentsBody = document.getElementById('appointmentsBody');
                appointmentsBody.innerHTML = '';

                data.forEach((appointment, index) => {
                    let visitDayText = '';
                    switch (appointment.visit_day) {
                        case '0':
                            visitDayText = 'Checking Visit';
                            break;
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
                            visitDayText = 'Not Defined';
                            break;
                    }

                    const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${appointment.ap_number}</td>   
                                <td>${appointment.customer_name}</td>
                                <td>${appointment.contact}</td>
                                <td>${visitDayText}</td>
                                <td>${appointment.status == 0 ? 'Canceled' : 'Active'}</td> 
                                <td>${appointment.haveTreat}</td>
                                <td>
                                    <div class="action-icons">
                                        <a href="{{ route('customerTreat', '') }}/${appointment.id}" class="btn btn-success"><i class="fe fe-plus-square fe-16"></i></i></a>
                                        ${appointment.haveTreat === "Done" ? `
                                        <a href="{{ route('viewCustomerTreat', '') }}/${appointment.id}" class="btn btn-warning">
                                            <i class="fe fe-eye fe-16"></i>
                                        </a>` : ''}
                                        <!-- .<a href="{{ route('appointments.printPreview', '') }}/${appointment.id}" class="btn btn-info"><i class="fa fa-print fe-16"></i></i></a> -->   
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
