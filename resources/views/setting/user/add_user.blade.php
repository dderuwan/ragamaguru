@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center p-4">
      <div class="col-12">
        <div class="card shadow mb-4 p-2 pl-3">
          <div class="card-header">
            <h3><strong class="card-title">Add User</strong></h3>
          </div>
          <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="inputfirstname" class="col-sm-2 col-form-label" style="color:black;"> First Name <i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputfirstname" name="firstname" placeholder="First name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputlastname" class="col-sm-2 col-form-label" style="color:black;">Last Name<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputlastname" name="lastname" placeholder="Last name">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label" style="color:black;">Email<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputpassword" class="col-sm-2 col-form-label" style="color:black;">Password<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="inputpassword" name="password" placeholder="password">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputFile" class="col-sm-2 col-form-label" style="color:black;">Image<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputFile" name="image" accept="image/*" onchange="updateImageLabel(this)">
                    <label class="custom-file-label" for="inputFile">Choose file</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputAbout" class="col-sm-2 col-form-label" style="color:black;">About</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputAbout" name="about" placeholder="About">
                </div>
              </div>
              <div class="form-group row col-sm-2">
                <label for="inputuser_type" class="col-sm-2 col-form-label" style="color:black;">User Type</label>
                <div class="form-check">
                    <input type="radio" name="user_type" id="type_user" class="form-check-input" value="user" checked>
                    <label for="type_user" class="form-check-label">User</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="user_type" id="type_admin" class="form-check-input" value="admin">
                    <label for="type_admin" class="form-check-label">Admin</label>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;">Status</label>
                <div class="form-check">
                    <input type="radio" name="status" id="status_active" class="form-check-input" value="active" checked>
                    <label for="status_active" class="form-check-label">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="status" id="status_inactive" class="form-check-input" value="inactive">
                    <label for="status_inactive" class="form-check-label">Inactive</label>
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
