@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="row mb-2">
          <div class="col-md-6">
            <h2 class="page-title p-2">Update Customer</h2>
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
              <strong class="card-title">Update</strong>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('updatecustomer', $customer->id) }}">
                @csrf
                <div class="form-row">
                  <input id="id" type="hidden" name="id" value={{$customer->id}}>
                  <div class="form-group col-md-6">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{$customer->name}}">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputContact">Contact Number</label>
                    <input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact Number" readonly value="{{$customer->contact}}">
                    @error('contact')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address" value="{{$customer->address}}">
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-2">
                    <label class="form-label">Country Type</label>
                    <input type="hidden" name="country_type" value="{{ $customer->country_type_id }}">
                    <div class="mt-1">
                      <div class="form-check form-check-inline" readonly>
                        <input class="form-check-input" type="radio" name="country_type" id="local" value="1"
                          {{ $customer->country_type_id == 1 ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="local">Local</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="country_type" id="international" value="2"
                          {{ $customer->country_type_id == 2 ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="international">International</label>
                      </div>
                    </div>
                    @error('country_type')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  @if ($customer->country_type_id == 2)
                  <div class="form-group col-md-4" id="country-select" >
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
                  @endif
                  
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
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




      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


</main> <!-- main -->

<script>
$(document).ready(function() {
      var savedCountryId = "{{ $customer->country_id ?? '' }}"; // The saved country ID from the database

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

          if (savedCountryId) {
            countrySelect.val(savedCountryId); 
          }
        },
        error: function(error) {
          console.log("Error fetching country data: ", error);
        }
      });
    });
</script>

@endsection