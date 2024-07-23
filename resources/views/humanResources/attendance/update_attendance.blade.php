@extends('layouts.main.master')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center p-2">
      <div class="col-12">
        <div class="card shadow mb-4 p-2 pl-3">
          <div class="card-header">
            <h3><strong class="card-title">Attendance Update</strong></h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="inputfirstname" class="col-sm-2 col-form-label" style="color:black;">Employee Name <i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <select class="form-control" id="inputfirstname" name="firstname[]" required>
                    <option value="" disabled selected>Select Employee</option>
                    <!-- Dynamically populate this list from your database -->
                    <option value="1">John Doe</option>
                    <option value="2">Jane Smith</option>
                    <!-- Add more options as needed -->
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputdate" class="col-sm-2 col-form-label" style="color:black;">Date<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputdate" name="date[]" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputcheckin" class="col-sm-2 col-form-label" style="color:black;">Check In</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputcheckin" name="checkin">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputcheckout" class="col-sm-2 col-form-label" style="color:black;">Check Out</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputcheckout" name="checkout">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputstaytime" class="col-sm-2 col-form-label" style="color:black;">Stayed Time</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputstaytime" name="staytime">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10 mt-5">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        @if (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif

      </div>
    </div>
  </div>
</main>


<!-- Flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize flatpickr for date input
    flatpickr("#inputdate", {
        dateFormat: "Y-m-d"
    });

    // Initialize flatpickr for check-in and check-out
    flatpickr("#inputcheckin", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i:S K",
        time_24hr: false
    });

    flatpickr("#inputcheckout", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i:S K",
        time_24hr: false
    });
});
</script>


@endSection
