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
              <form method="post" action="{{route('updateTreatment',$treatment->id)}}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputName">Treatment Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{$treatment->name}}">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputAmount">Treatment Amount</label>
                    <input type="number" class="form-control" id="inputAmount" name="amount" placeholder="Amount" value="{{$treatment->amount}}">
                    @error('amount')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- List of Things to Bring -->
                  <div class="form-group col-md-6">
                    <label for="inputThingsToBring">List of Things to Bring:</label>
                    <div id="thingsToBringList">
                      @if($treatment->things_to_bring)
                      @foreach(json_decode($treatment->things_to_bring, true) as $item)
                      <div class="input-group mb-2">
                        <input type="text" class="form-control" name="things_to_bring[]" value="{{ $item }}" placeholder="List the item">
                        <div class="input-group-append">
                          <button class="btn btn-danger removeItemBtn" type="button">-</button>
                        </div>
                      </div>
                      @endforeach
                      @endif
                      
                      <div class="input-group mb-2">
                        <div class="input-group-append">
                          <button class="btn btn-success addItemBtn" type="button">+</button>
                        </div>
                      </div>
                    </div>
                    @error('things_to_bring')
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



<script>
  document.addEventListener('DOMContentLoaded', function() {

    function addNewItem() {
      const newItem = document.createElement('div');
      newItem.classList.add('input-group', 'mb-2');
      newItem.innerHTML = `
            <input type="text" class="form-control" name="things_to_bring[]" placeholder="List the item">
            <div class="input-group-append">
                <button class="btn btn-danger removeItemBtn" type="button">-</button>
            </div>`;
      document.getElementById('thingsToBringList').appendChild(newItem);
    }

    document.getElementById('thingsToBringList').addEventListener('click', function(event) {
      if (event.target.classList.contains('addItemBtn')) {
        addNewItem();
      }
      if (event.target.classList.contains('removeItemBtn')) {
        event.target.closest('.input-group').remove();
      }
    });
  });
</script>








@endsection