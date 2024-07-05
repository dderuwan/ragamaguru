@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Customer Registration</h2>
        <p class="text-muted"></p>

        <div class="card-deck">
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Register</strong>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('customer.store')}}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputContact">Contact Number</label>
                    <input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact Number">
                    @error('contact')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address">
                  @error('address')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
              </form>
            </div>
          </div>

        </div> <!-- / .card-desk-->

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
        @if (session('otp'))
        <div class="alert alert-danger">
          {{ session('otp') }}
        </div>
        @endif


        @if (session('contactNo'))
        <div class="card-deck">
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Verification</strong>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('customer.verify')}}">
                @csrf
                <div class="form-group">
                  <label for="addedContact">Registered Contact Number</label>
                  <input type="text" class="form-control" id="addedContact" name="addedContact" value="{{ session('contactNo') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="inputOTP">OTP</label>
                    <input type="text" class="form-control @error('otp') is-invalid @enderror" id="inputOTP" name="otp" placeholder="Type the OTP received on the mobile number..">
                    @error('otp')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Verify</button>
              </form>
            </div>
          </div>

        </div> <!-- / .card-desk-->
        @endif



      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


</main> <!-- main -->
@endsection