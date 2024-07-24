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
            <h4><strong class="card-title">Update Holiday</strong></h4>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="inputfirstname" class="col-sm-2 col-form-label" style="color:black;">Holiday Name <i class="text-danger">*</i></label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="holidayName" name="holiday_name" placeholder="Enter Holiday Name" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputdatefrom" class="col-sm-2 col-form-label" style="color:black;">From<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputdatefrom" name="datefrom[]" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputdateto" class="col-sm-2 col-form-label" style="color:black;">To<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputdateto" name="dateto[]" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="numberOfDays" class="col-sm-2 col-form-label" style="color:black;">Number of Days<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                <input type="number" class="form-control" id="numberOfDays" name="number_of_days" placeholder="Enter Number of Days">
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
    flatpickr("#inputdatefrom", {
        dateFormat: "Y-m-d"
    });
    flatpickr("#inputdateto", {
        dateFormat: "Y-m-d"
    });
});
</script>


@endSection
