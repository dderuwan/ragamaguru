@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Update Treatment</h2>
        <p class="text-muted"></p>

        <div class="card-deck">
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Update</strong>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('updateTreatment')}}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputName">Treatment Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputStatus">Treatment Status</label>
                    <select class="form-control" id="inputStatus" name="status">
                        <option value="1" {{ old('status', $treatment->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $treatment->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                </div>


                <button type="submit" class="btn btn-primary">update</button>
              </form>
            </div>
          </div>

        </div> <!-- / .card-desk-->






      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


</main> <!-- main -->
@endsection
