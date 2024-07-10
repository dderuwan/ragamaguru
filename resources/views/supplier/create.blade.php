@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title p-2">Add Supplier</h2>
        <p class="text-muted"></p>

        <div class="card-deck p-2">
          <div class="card shadow mb-4 p-3">
            <div class="card-header">
              <strong class="card-title">Register</strong>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('storesupplier')}}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputName" class="text-dark">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputContact" class="text-dark">Contact Number</label>
                    <input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact Number">
                    @error('contact')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress" class="text-dark">Address</label>
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

              </form>
            </div>
          </div>
        </div> <!-- / .card-desk-->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


</main> <!-- main -->
@endsection
