@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
<<<<<<< HEAD
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Add Item</h2>
        <p class="text-muted"></p>

        <div class="card-deck">
          <div class="card shadow mb-4 p-2">
            <div class="card-body">
             <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12 mt-4 mb-5">
                <div class="form-group row">
                  <label class="col-sm-1 col-form-label text-dark">Supplier<i class="text-danger">*</i></label>
                    <div class="col-sm-5">
                        <select class="js-example-basic-single js-states form-control" name="supplier_code">
                            <option value="">Select supplier</option>
                            <?php
                                $supplierCodes = \App\Models\Supplier::pluck('supplier_code')->toArray();
                                foreach ($supplierCodes as $supplierCode) {
                                    echo '<option value="' . $supplierCode . '">' . $supplierCode . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                  </div>
                </div>
        
              <table class="table table-bordered table-hover" id="purchaseTable">
                <thead>
                    <tr>
                        <th class="text-center" width="20%" style="color: black;">Name<i class="text-danger">*</i></th>
                        <th class="text-center" width="25%" style="color: black;">Description<i class="text-danger">* </i></th>
                        <th class="text-center" style="color: black;">Quantity</i></th>
                        <th class="text-center" style="color: black;">Image</th>
                        <th class="text-center" style="color: black;">Individual Item cost<i class="text-danger">*</th>
                        <th class="text-center" style="color: black;"></th>
=======
    <div class="container">
        <h1>Create Item</h1>
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="supplier_code">Supplier *</label>
                <select name="supplier_code" class="form-control" required>
                    <option value="">Select Supplier </option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_code }}">{{ $supplier->supplier_code }}-{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-bordered" id="items-table">
                <thead>
                    <tr>
                        <th>Item Name *</th>
                        <th>Description</th>
                        <th>Selling Price</th>
                        <th>Quentity</th>
                        <th>Image</th>
                        <th>Actions</th>
>>>>>>> kavidu
                    </tr>
                </thead>
                <tbody>
                    <tr>
<<<<<<< HEAD
                        <td class="span3">
                            <input type="text" name="item_name[]" required="" class="form-control product_name" placeholder="Item name" id="item_name" tabindex="5">   
                        </td>
                        <td class="span3">
                            <input type="text" name="item_description[]" required="" class="form-control product_name" placeholder="description" id="item_description" tabindex="5">   
                        </td>
                        <td class="span3">
                        <input type="text" name="item_quantity[]" class="form-control product_name" placeholder="Quantity" id="item_quantity" tabindex="5">
                        </td>
                        <td class="span3">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="item_image[]" accept="image/*" onchange="updateImageLabel(this)">
                          <label class="custom-file-label">Choose file</label>
                        </div>
                      </td>
                        <td class="span3">
                            <input type="text" name="item_price[]" required="" class="form-control product_name" placeholder="price" id="item_price" tabindex="5">   
                        </td>
                        <td>
                            <button class="btn btn-danger red text_align_right" type="button" value="Delete" onclick="deletePurchaseRow(this)" tabindex="8">Delete</button>
                        </td>
=======
                        <td><input type="text" name="items[0][item_name]" class="form-control" required></td>
                        <td><input type="text" name="items[0][item_description]" class="form-control" required></td>
                        <td><input type="text" name="items[0][quentity]" class="form-control" ></td>
                        <td><input type="text" name="items[0][unit_price]" class="form-control" required></td>
                        <td><input type="file" name="items[0][image]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
>>>>>>> kavidu
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" id="add-row">Add New Item</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</main>

<script>
    let rowIndex = 1;

    document.getElementById('add-row').addEventListener('click', function() {
        const table = document.getElementById('items-table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <tr>
                <td><input type="text" name="items[${rowIndex}][item_name]" class="form-control" required></td>
                <td><input type="text" name="items[${rowIndex}][item_description]" class="form-control" required></td>
                <td><input type="text" name="items[${rowIndex}][quentity]" class="form-control" ></td>
                <td><input type="text" name="items[${rowIndex}][unit_price]" class="form-control" required></td>
                <td><input type="file" name="items[${rowIndex}][image]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
            </tr>
        `;
        rowIndex++;
    });

    document.getElementById('items-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
