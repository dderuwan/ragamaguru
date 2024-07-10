@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Update Item</h2>
        <p class="text-muted"></p>

        <div class="card-deck">
          <div class="card shadow mb-4">
            
            <div class="card-body p-4">
                <form method="POST" action="{{ route('updateitem', $item->id) }}"  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-row">
                      <input id="id" type="hidden" name="id" value="{{ $item->id }}">
                      <div class="col-sm-12 mt-1 mb-1">
                        <div class="form-group row">
                          <label class="col-sm-1 col-form-label text-dark">Item Code</i></label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="inputItemCode" name="item_code" placeholder="Item Code" readonly value="{{ $item->item_code }}">
                                @error('item_code')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                      </div>                  
                  </div>

                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="inputSupplier" class="text-dark">Supplier</label>
                          <select class="js-example-basic-single js-states form-control" name="supplier_code">
                              <option value="">Select supplier</option>
                              <?php
                                  $supplierCodes = \App\Models\Supplier::pluck('supplier_code')->toArray();
                                  foreach ($supplierCodes as $supplierCode) {
                                      $selected = ($supplierCode == $item->supplier_code) ? 'selected' : '';
                                      echo '<option value="' . $supplierCode . '" ' . $selected . '>' . $supplierCode . '</option>';
                                  }
                              ?>
                          </select>
                          @error('supplier_code')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>

                        <div class="form-group col-md-6">
                          <label for="inputName" class="text-dark">Name</label>
                          <input type="text" class="form-control" id="inputName" name="item_name" placeholder="Name" value="{{ $item->name }}">
                          @error('name')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </div>
                      
                        <div class="form-group col-md-6">
                          <label for="inputDescription" class="text-dark">Description</label>
                          <input type="text" class="form-control" id="inputDescription" name="item_description" placeholder="Description" value="{{ $item->description }}">
                          @error('item_description')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>

                      <div class="form-group col-md-6">
                          <label for="inputDescription" class="text-dark">Quantity</label>
                          <input type="text" class="form-control" id="inputQuantity" name="item_quantity" placeholder="Quantity" value="{{ $item->quantity }}">
                          @error('item_quantity')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>

                      <div class="form-group col-md-6">
                          <label for="inputImage" class="text-dark">Current Image</label>
                          <br>
                          <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail" style="max-width: 100px;">
                          <br>
                          <label for="inputNewImage" class="text-dark ">New Image (Optional)</label>
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputNewImage" name="item_image" accept="image/*" onchange="updateImageLabel(this)">
                              <label class="custom-file-label">Choose file</label>
                          </div>
                          @error('item_image')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>        

                        <div class="form-group col-md-6">
                          <label for="inputPrice" class="text-dark">Individual Item cost</label>
                          <input type="text" class="form-control" id="inputPrice" name="item_price" placeholder="Price" value="{{ $item->price }}">
                          @error('item_price')
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </div>

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

@section('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle file input change
        document.getElementById('Item_image').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var label = document.getElementById('imageLabel');
            label.textContent = fileName;
        });
    });
    function updateImageLabel(input) {
    var fileName = input.files[0].name;
    var label = input.parentNode.querySelector('.custom-file-label');
    label.textContent = fileName;
  }
   
   
</script>