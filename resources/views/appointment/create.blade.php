@extends('layouts.main.master')

@section('content')
<style>
  #timeSlots {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #FAF9F9;
  }

  .time-slot {
    padding: 10px;
    margin: 5px;
    width: 100px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s;
    user-select: none;
  }

  /* .time-slot.bg-danger {
    background-color: #dc3545;
    color: #fff;
  } */

  .time-slot:hover {
    background-color: #f0f0f0;
    border-color: #999;
  }
</style>

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center pl-5 pr-5">
      <div class="col-12">
        <div class="row mb-2">
          <div class="col-md-6">
            <h2 class="page-title">New Appointment</h2>
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
        <div class="card shadow mb-4 p-2 pl-3">
          <div class="card-body">
            <form action="{{route('appointments.store')}}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="row mb-1">
                    <h6 class="px-3">Customer Details</h6>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <input id="customer_id" name="customer_id" value="{{$customer->id}}" type="hidden" />
                      <tbody>
                        <tr>
                          <th scope="row">Name</th>
                          <td>{{$customer->name}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Contact</th>
                          <td>{{$customer->contact}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Address</th>
                          <td>
                            @if ($customer->address)
                            {{$customer->address}}
                            @else
                            No Address
                            @endif
                          </td> 
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="row mb-1">
                    <h6 class="px-3">Visit Details</h6>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th scope="row">First Visit</th>
                          <td>{{$firstVisit}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Second Visit</th>
                          <td>{{$secondVisit}}</td>
                        </tr>
                        <tr>
                          <th scope="row">Third Visit</th>
                          <td>{{$thirdVisit}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="form-row mt-1">
                <div class="form-group col-md-12">
                  <label for="reg_type" style="color:black;">Registered Type:&nbsp; 
                  <strong>{{$customerType->name}}</strong></label>
                  </br>
                  <label for="country_type" style="color:black;">Country Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <strong>{{$countryType->name}}</strong></label>
                  </br>
                  @if ($country)
                  <label for="country" style="color:black;">Country:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <strong>{{$country->name}}</strong></label>
                  @endif
                </div>
              </div> 

              @if (!empty($onlinebooking))
              <div class="form-row mt-1">
                <div class="form-group col-md-6">
                  <label for="online_booking_date" style="color:blue;">Online Booking Date: <strong>{{$onlinebooking->booking_date}}</strong></label>
                </div>
              </div> 
              @endif

              <div class="form-row mt-1">
                <div class="form-group col-md-6">
                  <label for="today_date" style="color:black;">Date <i class="text-danger">*</i></label>
                  <input type="date" class="form-control" id="today_date" name="today_date" value="{{$today}}" required readonly>
                </div>
              </div>  


              <div id="timeSlots" class="mt-3">
                <label style="color:black;">Available Appointment Numbers</label>
                <div class="d-flex flex-wrap">
                  @foreach ($appointment_numbers as $ap_num)
                  <div class="bg-success text-white time-slot {{ in_array($ap_num->id, $todayAppointments) ? 'bg-danger text-white' : '' }}" {{ in_array($ap_num->id, $todayAppointments) ? 'style=pointer-events:none;opacity:0.6;' : '' }}>
                    {{$ap_num->number}}
                  </div>
                  @endforeach
                </div>
              </div>

              @error('appointment_no')
              <p class="text-danger m-1">Please select appointment number.</p>
              @enderror

              <div class="form-row mt-3">
                <div class="form-group col-md-6">
                  <label for="appointment_no" class="col-form-label" style="color:black;">Selected Appointment Number<i class="text-danger">*</i></label>
                  <input type="text" class="form-control" id="appointment_no" name="appointment_no" readonly>
                </div>
                <div class="form-group col-md-6 mt-1">
                  <label for="vist_type" style="color:black;">Visit Day</label>
                  <select class="form-control" id="visit_type" name="visit_type">
                    @if ($lastVisitDay==null)
                    <option value="1">First Visit</option>
                    <option value="4">Other Visit</option>
                    @endif
                    @if ($lastVisitDay=='1')
                    <option value="2">Second Visit</option>
                    <option value="4">Other Visit</option>
                    @endif
                    @if ($lastVisitDay=='2')
                    <option value="3">Third Visit</option>
                    <option value="4">Other Visit</option>
                    @endif
                    @if ($lastVisitDay=='3')
                    <option value="4">Other Visit</option>
                    @endif
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-10 mt-5">
                  <button type="submit" class="btn btn-primary">Save Appointment</button>
                </div>
              </div>
            </form>
          </div>
        </div>

       
      </div>
    </div>
  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    //display timeslots
    var timeSlots = document.querySelectorAll('.time-slot');
    var appointmentNoInput = document.getElementById('appointment_no');

    timeSlots.forEach(function(timeSlot) {
      timeSlot.addEventListener('click', function() {
        appointmentNoInput.value = timeSlot.textContent.trim();
      });
    });
  });
</script>
@endsection