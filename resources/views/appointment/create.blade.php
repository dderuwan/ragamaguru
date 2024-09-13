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
                <div class="col-md-12">
                  <div class="row mb-1">
                    <h6 class="px-3">Customer Details</h6>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered"> 
                      <input id="customer_id" name="customer_id" value="{{$customer->id}}" type="hidden" />
                      <thead>
                        <tr>
                          <th style="color:black;">Name</th>
                          <th style="color:black;">Contact</th>
                          <th style="color:black;">Address</th>
                          <th style="color:black;">Registered Type</th>
                          <th style="color:black;">Country Type</th>
                          @if ($customer->country_id)
                          <th style="color:black;">Country</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$customer->name}}</td>
                          <td>{{$customer->contact}}</td>
                          <td>
                            @if ($customer->address)
                            {{$customer->address}}
                            @else
                            No Address
                            @endif
                          </td>
                          <td>{{$customerType->name}}</td>
                          <td>{{$countryType->name}}</td>
                          @if ($customer->country_id)
                          <td id="countryName"></td>
                          @endif
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- <div class="col-sm-12 col-md-6">
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
                </div> -->

              </div>



              @if ($bookings->isNotEmpty())
              <div class="row mt-3">
                <div class="col-md-6">
                  <div class="row mb-1">
                    <h6 class="px-3 text-warning">Available Bookings</h6>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <input id="customer_id" name="customer_id" value="{{$customer->id}}" type="hidden" />
                      <thead>
                        <tr>
                          <th style="color:black;">Date</th>
                          <th style="color:black;">Number</th>
                          <th style="color:black;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($bookings as $booking)
                        <tr>
                          <td>{{$booking->date}}</td>
                          <td>{{$booking->apNumber->number}}</td>
                          <td>
                            <a href="{{route('viewBooking',$booking->id)}}" class="btn btn-primary btn-sm">
                              <i class="fas fa-edit"></i>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              @endif


              @if ($lastCustomerTreatment)
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th scope="row">Payment Status</th>
                          @if ($paymentStatus=='due')
                          <td class="text-danger">Not Completed &nbsp;&nbsp;<a href="{{route('viewDuePayment',$lastCustomerTreatment->id)}}" class="btn btn-sm btn-warning">PAY</a></td>
                          @endif
                          @if ($paymentStatus=='not paid')
                          <td class="text-danger">Not Paid &nbsp;&nbsp;<a href="{{route('viewCustomerTreat',$lastCustomerTreatment->appointment_id)}}" class="btn btn-sm btn-warning">PAY</a></td>
                          @endif
                          @if ($paymentStatus=='done')
                          <td>Completed</td>
                          @endif
                        </tr>
                        <tr>
                          <th scope="row">Assigned Next Date</th>
                          <td>
                            @if ($nextDay)
                            {{$nextDay}}
                            @else
                            Not Assigned
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              @endif


              <div class="form-row mt-3">
                <div class="form-group col-md-6 mt-1">
                  <label for="ap_type" style="color:black;">Appointment Type <i class="text-danger">*</i></label>
                  <select class="form-control" id="ap_type" name="ap_type" onchange="setTotalAmount()">
                    <option value="">Select Appointment Type </option>
                    @foreach ($appointmentTypes as $appointmentType)
                    <option value="{{$appointmentType->id}}" data-price="{{ $appointmentType->price }}">
                      {{$appointmentType->type}} - LKR {{$appointmentType->price}}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6 mt-1">
                  <label for="vist_type" style="color:black;">Visit Day <i class="text-danger">*</i></label>
                  <select class="form-control" id="visit_type" name="visit_type">
                    @foreach ($visitTypes as $visitType)
                    <option value="{{$visitType->id}}">{{$visitType->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="form-row mt-1">
                <div class="form-group col-md-6">
                  <label for="today_date" class="col-form-label" style="color:black;">Date <i class="text-danger">*</i></label>
                  <input type="date" class="form-control" id="today_date" name="today_date" value="{{$today}}" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="appointment_no" class="col-form-label" style="color:black;">Selected Appointment Number <i class="text-danger">*</i></label>
                  <input type="text" class="form-control" id="appointment_no" name="appointment_no" readonly>
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




              <label class="mt-5" style="color:black;">Payment Section</label>
              <div class="col-md-6 mt-2" style="border: 1px solid #ccc;">

                <div class="form-group mt-1">
                  <label for="totalAmount">Total Amount (LKR):</label>
                  <input type="text" id="totalAmount" name="totalAmount" class="form-control"
                    value=""
                    readonly>
                  @error('totalAmount')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="paymentType">Payment Type:</label>
                  <select id="paymentType" name="paymentType" class="form-control"
                    required>
                    @foreach ($paymentTypes as $type )
                    <option value="{{$type->id}}">
                      {{$type->name}}
                    </option>
                    @endforeach
                  </select>
                  @error('paymentType')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="paidAmount">Paid Amount (LKR):</label>
                  <input type="number" id="paidAmount" name="paidAmount" class="form-control"
                    value=""
                    oninput="calculateDueAmount()" required>
                  @error('paidAmount')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="dueAmount">Due Amount (LKR):</label>
                  <input type="text" id="dueAmount" name="dueAmount" class="form-control"
                    value=""
                    readonly>
                  @error('dueAmount')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-10 mt-5">
                  <button type="submit" class="btn btn-primary" >Save Appointment</button>
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


  $(document).ready(function() {
    var savedCountryId = '{{ $customer->country_id }}';

    if (savedCountryId) {
      $.ajax({
        url: 'https://restcountries.com/v3.1/all',
        method: 'GET',
        success: function(data) {
          var countryName = '';
          data.forEach(function(country) {
            if (country.cca2 === savedCountryId) {
              countryName = country.name.common;
            }
          });
          $('#countryName').text(countryName);
        },
        error: function(error) {
          console.log('Error fetching country data:', error);
        }
      });
    }
  });


  $(document).ready(function() {

    $('#today_date').on('change', function() {
      let selectedDate = $(this).val();

      $.ajax({
        url: "{{ route('checkAppointments') }}",
        method: "POST",
        data: {
          date: selectedDate,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          let todayAppointments = response.todayAppointments;

          $('#timeSlots').html('');
          let timeSlotsHtml = '<label style="color:black;">Available Appointment Numbers</label><div class="d-flex flex-wrap">';
          response.appointment_numbers.forEach(function(ap_num) {
            let disabledClass = todayAppointments.includes(ap_num.id) ? 'bg-danger text-white' : 'bg-success text-white';
            let pointerEvent = todayAppointments.includes(ap_num.id) ? 'pointer-events:none;opacity:0.6;' : '';

            timeSlotsHtml += '<div class="time-slot ' + disabledClass + '" style="' + pointerEvent + '">' + ap_num.number + '</div>';
          });
          timeSlotsHtml += '</div>';
          $('#timeSlots').html(timeSlotsHtml);
        }
      });
    });

    $('#timeSlots').on('click', '.time-slot', function() {
      var appointmentNoInput = $('#appointment_no');
      appointmentNoInput.val($(this).text().trim());
    });
  });
</script>

<script>
  function setTotalAmount() {
    var apTypeSelect = document.getElementById('ap_type');
    var selectedOption = apTypeSelect.options[apTypeSelect.selectedIndex];
    var selectedPrice = selectedOption.getAttribute('data-price');

    document.getElementById('totalAmount').value = selectedPrice;
    calculateDueAmount();
  }

  function calculateDueAmount() {
    var totalAmount = parseFloat(document.getElementById('totalAmount').value) || 0;
    var paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
    var dueAmount = totalAmount - paidAmount;
    document.getElementById('dueAmount').value = dueAmount.toFixed(2);
  }
</script>

@endsection