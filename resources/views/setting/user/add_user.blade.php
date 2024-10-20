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
                  @error('firstname')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputlastname" class="col-sm-2 col-form-label" style="color:black;">Last Name<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputlastname" name="lastname" placeholder="Last name" required>
                  @error('lastname')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label" style="color:black;">Email<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
                  @error('email')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <!-- Contact Number -->
              <div class="form-group row">
                  <label for="inputContact" class="col-sm-2 col-form-label" style="color:black;">Contact Number<i class="text-danger">*</i></label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact Number" required>
                      @error('contact')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
              <div class="form-group row">
                <label for="inputpassword" class="col-sm-2 col-form-label" style="color:black;">Password<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="inputpassword" name="password" placeholder="password">
                  @error('password')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputFile" class="col-sm-2 col-form-label" style="color:black;">Image</label>
                <div class="col-sm-8">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputFile" name="image" accept="image/*" onchange="updateImageLabel(this)">
                    <label class="custom-file-label" for="inputFile">Choose file</label>
                  </div>
                  @error('image')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputAbout" class="col-sm-2 col-form-label" style="color:black;">About</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputAbout" name="about" placeholder="About">
                  @error('about')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputuser_type" class="col-sm-2 col-form-label" style="color:black;">User Type<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <div class="form-check">
                    <input type="radio" name="user_type" id="type_user" class="form-check-input" value="user" checked>
                    <label for="type_user" class="form-check-label">User</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="user_type" id="stype_admin" class="form-check-input" value="admin">
                    <label for="type_admin" class="form-check-label">Admin</label>
                  </div>
                  @error('user_type')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;">Status<i class="text-danger">*</i></label>
                <div class="col-sm-8">
                  <div class="form-check">
                    <input type="radio" name="status" id="status_active" class="form-check-input" value="active" checked>
                    <label for="status_active" class="form-check-label">Active</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" name="status" id="status_inactive" class="form-check-input" value="inactive">
                    <label for="status_inactive" class="form-check-label">Inactive</label>
                  </div>
                  @error('status')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
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
    const fileName = input.files[0] ? input.files[0].name : 'Choose file';
    input.nextElementSibling.innerText = fileName;
  }
</script>

@endSection