@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="row mb-2">
          <div class="col-md-6">
            <h2 class="page-title p-2">Customer Registration</h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{ route('allcustomers') }}"><button type="button" class="btn btn-primary float-end">
                All Customers
              </button></a>
          </div>
        </div>

        <p class="text-muted"></p>

        <div class="card-deck p-2">
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Register</strong>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('storecustomer')}}">
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
                  <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address">
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-2">
                    <label class="form-label">Country Type</label>
                    <div class="mt-1">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country_type" id="local" value="1" >
                        <label class="form-check-label" for="local">Local</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country_type" id="international" value="2" >
                        <label class="form-check-label" for="international">International</label>
                      </div>
                    </div>
                    @error('country_type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-4" id="country-select" style="display: none;">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <select class="form-control" id="country" name="country_id">
                        <option value="" disabled selected>Select your country</option>
                        <!-- Add options dynamically here -->
                      </select>
                      @error('country_id')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
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
              <form method="post" action="{{route('verifycustomer')}}">
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

<script>
  $(document).ready(function() {
    // Function to toggle the country select dropdown
    function toggleCountrySelect() {
        if ($('#international').is(':checked')) {
            $('#country-select').show();  // Show the country select if "International" is selected
        } else {
            $('#country-select').hide();  // Hide it if "Local" is selected
        }
    }

    // Call the function on page load to check the initially selected value
    toggleCountrySelect();

    // Call the function whenever the radio buttons are changed
    $('input[name="country_type"]').on('change', function() {
        toggleCountrySelect();
    });
});


$(document).ready(function() {

      $.ajax({
        url: 'https://restcountries.com/v3.1/all',
        method: 'GET',
        success: function(data) {
          var countrySelect = $('#country');

          data.sort(function(a, b) {
            return a.name.common.localeCompare(b.name.common);
          });

          data.forEach(function(country) {
            countrySelect.append('<option value="' + country.cca2 + '">' + country.name.common + '</option>');
          });

        },
        error: function(error) {
          console.log("Error fetching country data: ", error);
        }
      });
    });

</script>

@endsection