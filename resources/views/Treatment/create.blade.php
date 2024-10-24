@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Add Treatment</h2>
        <p class="text-muted"></p>

        <div class="card-deck">
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Add</strong>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('storeTreatment')}}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputName">Treatment Name:</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAmount">Treatment Amount:</label>
                    <input type="number" class="form-control" id="inputAmount" name="amount" placeholder="Amount">
                    @error('amount')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- Dynamic List of Things to Bring -->
                  <div class="form-group col-md-6">
                    <label for="inputThingsToBring">List of Things to Bring:</label>
                    <div id="thingsToBringList">
                      <!-- Initially empty -->
                    </div>
                    <button class="btn btn-success addItemBtn" type="button">+</button>
                    @error('things_to_bring')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputStatus">Treatment Status:</label>
                    <select class="form-control" id="inputStatus" name="status">
                      <option value="1" {{ old('status', $treatment->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ old('status', $treatment->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>

        </div> <!-- / .card-desk-->






      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


</main> <!-- main -->


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const addItemBtn = document.querySelector('.addItemBtn');
    addItemBtn.addEventListener('click', function() {
      const newItem = document.createElement('div');
      newItem.classList.add('input-group', 'mb-2');
      newItem.innerHTML = `
            <input type="text" class="form-control" name="things_to_bring[]" placeholder="List the item">
            <div class="input-group-append">
                <button class="btn btn-danger removeItemBtn" type="button">-</button>
            </div>`;
      document.getElementById('thingsToBringList').appendChild(newItem);

      newItem.querySelector('.removeItemBtn').addEventListener('click', function() {
        newItem.remove();
      });
    });

    document.getElementById('thingsToBringList').addEventListener('click', function(event) {
      if (event.target.classList.contains('removeItemBtn')) {
        event.target.closest('.input-group').remove();   
      }
    });
  });
</script>

@endsection