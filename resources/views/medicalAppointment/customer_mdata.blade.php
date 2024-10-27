@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center p-4">
      <div class="col-12">
        
        <div class="card shadow mb-4 p-2 pl-3">
          <div class="card-header">
            <h3><strong class="card-title">Add Customer Medical Data</strong></h3>
          </div>
          <div class="card-body">
            <form action="{{ route('saveCustomerMData',1) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-form-label" style="color:black;"> Title <i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title" value="" required>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-sm-10 mt-5">
                  <button type="submit" class="btn btn-primary">Save</button>
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

<script>
function updateImageLabel(input) {
    let fileName = input.files[0].name;
    input.nextElementSibling.innerText = fileName;  
}
</script>

@endsection
