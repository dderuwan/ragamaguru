@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
<<<<<<< HEAD
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page- p-2">Update Item</h2>
        <p class="text-muted"></p>

        <div class="card-deck p-2">
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
=======
    <div class="container">
        <h2>Edit Item</h2>
        <form action="{{ route('updateitem', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $item->id }}">
            
            <div class="form-group">
                <label for="item_code">Item Code</label>
                <input type="text" name="item_code" id="item_code" class="form-control" value="{{ old('item_code', $item->item_code) }}" readonly>
            </div>

            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" name="item_name" id="item_name" class="form-control" value="{{ old('item_name', $item->name) }}" required>
            </div>

            <div class="form-group">
                <label for="item_description">Item Description</label>
                <input type="text" name="item_description" id="item_description" class="form-control" value="{{ old('item_description', $item->description) }}" required>
            </div>

            <div class="form-group">
                <label for="unit_price">Unit Price</label>
                <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', $item->price) }}" required>
            </div>

            <div class="form-group">
                <label for="supplier_code">Supplier Code</label>
                <select name="supplier_code" id="supplier_code" class="form-control" required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_code }}" {{ $supplier->supplier_code == $item->supplier_code ? 'selected' : '' }}>
                        {{ $supplier->supplier_code }}- {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Item Image</label>
                <input type="file" name="image" class="form-control">
                @if($item->image)
                    <img src="{{ asset('images/items/' . $item->image) }}" alt="{{ $item->item_name }}" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>
</main>
@endsection
>>>>>>> kavidu
