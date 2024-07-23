@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h2 class="page-title">Attendance List</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#checkInModal">
                            Single Check In
                        </button>
                        <a href="{{ route('manage_attendance_list')}}"><button type="button" class="btn btn-primary float-end">
                             Manage Attendance
                        </button></a>
                    </div>
                </div>
                <p class="card-text"></p>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables table-bordered" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th style="color: black; width:5%">SL</th>
                                            <th style="color: black; width:30%">Name</th>
                                            <th style="color: black;">Date</th>
                                            <th style="color: black; width:15%">Check In</th>
                                            <th style="color: black; width:15%">Check Out</th>
                                            <th style="color: black; width:15%">Stayed Time</th>
                                            <th class="text-center" style="color: black; width:15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="action-icons">
                                                    <button type="button" style="color:white; background-color:green;" class="btn checkOutButton" 
                                                    data-toggle="modal" data-target="#checkOutModal">
                                                        Check Out
                                                    </button>
                                                </div>
                                            </td>                                         
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Check In Modal -->
    <div class="modal fade" id="checkInModal" tabindex="-1" role="dialog" aria-labelledby="checkInModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkInModalLabel">Check In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="checkInForm">
                        <div class="form-group">
                            <label for="employeeName">Employee Name <i class="text-danger">*</i></label>
                            <select class="form-control" id="employeeName">
                                <option>Employee 1</option>
                                <option>Employee 2</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="signInButton">Sign In</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Check Out Modal -->
    <div class="modal fade" id="checkOutModal" tabindex="-1" role="dialog" aria-labelledby="checkOutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkOutModalLabel">Check Out</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center"><span id="currentTime"></span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmCheckOutButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Check In functionality
        $('#signInButton').on('click', function() {
            var employeeName = $('#employeeName').val();
            console.log('Employee checked in:', employeeName);

            $('#checkInModal').modal('hide');
        });
    });
</script>

<script>
    // Check Out functionality
    $(document).ready(function() {
        let timeInterval;

        $('.checkOutButton').on('click', function() {
            $('#checkOutModal').modal('show');

            function updateTime() {
                var currentTime = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
                $('#currentTime').text(currentTime);
            }
            if (timeInterval) {
                clearInterval(timeInterval);
            }
            updateTime();
            timeInterval = setInterval(updateTime, 1000);
        });

        $('#confirmCheckOutButton').on('click', function() {
            console.log('Employee checked out at:', $('#currentTime').text());

            $('#checkOutModal').modal('hide');
            if (timeInterval) {
                clearInterval(timeInterval);
            }
        });
    });
</script>

@endsection
