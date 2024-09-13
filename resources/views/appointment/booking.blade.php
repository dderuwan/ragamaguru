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
            <h2 class="page-title">Bookings</h2>
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
            <form action="{{route('addAppointment',$bookings->id)}}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row">
                <div class="col-md-12">
                  <div class="row mb-1">
                    <h6 class="px-3">Booking Details</h6>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered"> 
                      <input id="customer_id" name="customer_id" value="" type="hidden" />
                      <thead>
                        <tr>
                          <th style="color:black;">Date</th>
                          <th style="color:black;">Number</th>
                          <th style="color:black;">Type</th>
                          <th style="color:black;">Created By</th>
                          <th style="color:black;">Total Amount</th>
                          <th style="color:black;">Paid Amount</th>
                          <th style="color:black;">Due Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$bookings->date}}</td>
                          <td>{{$bookings->apNumber->number}}</td>
                          <td>{{$bookings->appointmentType->type}}</td>
                          <td>{{$bookings->created_by}}</td>
                          <td>{{$bookings->total_amount}}</td>
                          <td>{{$bookings->paid_amount}}</td>
                          @if ($bookings->due_amount>0 )
                          <td class="text-danger">{{$bookings->due_amount}}</td>
                          @else
                          <td>{{$bookings->due_amount}}</td>
                          @endif
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                

              </div>


              


              <div class="form-row mt-3">
                <div class="form-group col-md-6 mt-1">
                  <label for="vist_type" style="color:black;">Visit Day <i class="text-danger">*</i></label>
                  <select class="form-control" id="visit_type" name="visit_type">
                    @foreach ($visitTypes as $visitType)
                    <option value="{{$visitType->id}}">{{$visitType->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>



              <label class="mt-5" style="color:black;">Payment Section</label>
              <div class="col-md-6 mt-2" style="border: 1px solid #ccc;">

                <div class="form-group mt-1">
                  <label for="totalAmount">Amount to be paid (LKR):</label>
                  <input type="text" id="totalAmount" name="totalAmount" class="form-control"
                    value="{{$bookings->due_amount}}"
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
                    value="{{$bookings->due_amount}}" 
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


  


  
</script>

<script>
  

  function calculateDueAmount() {
    var totalAmount = parseFloat(document.getElementById('totalAmount').value) || 0;
    var paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
    var dueAmount = totalAmount - paidAmount;
    document.getElementById('dueAmount').value = dueAmount.toFixed(2);
  }
</script>

@endsection