@extends('layouts.main.master')

@section('content')


<style>
    .action-icons {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .action-icon {
        display: inline-block;
        width: 36px;
        height: 36px;
        line-height: 36px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 5px;
    }

    .edit-icon {
        background-color: #f0f0f0;
    }

    .delete-icon {
        background-color: #f8d7da;
    }
</style>



<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h2 class="page-title">Event Settings</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('event.index') }}"><button type="button" class="btn btn-primary float-end">
                                Event List
                            </button></a>
                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <p class="card-text"></p>
                <div class="row my-4">

                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="mb-2">Add Event</h5>
                                <form method="post" action="{{ route('event.store') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputName">Event Name</label>
                                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Add Event Name">
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputLocation">Location</label>
                                            <input type="text" class="form-control" id="inputLocation" name="location" placeholder="Add Event Location">
                                            @error('location')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputDate">Dates</label>
                                            <input type="text" class="form-control" id="inputDate" name="date[]" placeholder="Add Dates">
                                            @error('date')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputTime">Time</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="starttime" name="starttime" placeholder="Add Start Time">
                                                    @error('starttime')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="endtime" name="endtime" placeholder="Add End Time">
                                                    @error('endtime')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="form-group col-md-6">
                                            <label for="inputStatus">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</main>

@endsection


@section('scripts')
<!-- Flatpickr CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- jQuery Timepicker CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Flatpickr for multiple date selection
        $("#inputDate").flatpickr({
            mode: "multiple",
            dateFormat: "Y-m-d", // Adjust the date format as needed
        });

        // Initialize timepicker for start and end time selection
        $("#starttime, #endtime").timepicker({
            timeFormat: 'h:mm p', // Adjust the time format as needed
            interval: 30,         // Interval between time options
            minTime: '6:00am',     // Minimum time
            maxTime: '11:30pm',    // Maximum time
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>



@endsection