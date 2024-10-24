@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title p-2">Update Supplier</h2>
        <p class="text-muted"></p>

        <div class="card-deck p-2">
          <div class="card shadow mb-4">
            
            <div class="card-body">
              <form method="POST" action="{{route('updatesupplier', $supplier->id)}}">
                @csrf
                <div class="form-row">
                <input id="id" type="hidden" name="id" value={{$supplier->id}}>
                  <div class="form-group col-md-6">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{$supplier->name}}" >
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputContact">Contact Number</label>
                    <input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact Number" readonly value="{{$supplier->contact}}" >
                    @error('contact')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address" value="{{$supplier->address}}" >
                  @error('address')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
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
@endsection