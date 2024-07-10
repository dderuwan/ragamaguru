@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
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
                  <label class="col-sm-1 col-form-label">Supplier<i class="text-danger">*</i></label>
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
                        <th class="text-center" style="color: black;">Quantity<i class="text-danger">*</i></th>
                        <th class="text-center" style="color: black;">Image<i class="text-danger">*</th>
                        <th class="text-center" style="color: black;">Individual Item cost<i class="text-danger">*</th>
                        <th class="text-center" style="color: black;"></th>
                    </tr>
                </thead>
                <tbody id="addItem">
                    <tr>
                        <td class="span3">
                            <input type="text" name="item_name[]" required="" class="form-control product_name" placeholder="Item name" id="item_name" tabindex="5">   
                        </td>
                        <td class="span3">
                            <input type="text" name="item_description[]" required="" class="form-control product_name" placeholder="description" id="item_description" tabindex="5">   
                        </td>
                        <td class="span3">
                            <input type="text" name="item_quantity[]" required="" class="form-control product_name" placeholder="quantity" id="item_quantity" tabindex="5">   
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
                    </tr>
                </tbody>
                 <tfoot>
                    <tr>
                        <td colspan="5">
                          <input type="button" id="add_invoice_item" class="btn btn-primary" name="add-invoice-item" 
                            onclick="addmore('addItem');" value="Add More item" tabindex="9">
                              </td>
                          </tr>
                      </tfoot>
            </table>
            <input type="hidden" name="finyear" value="">
              <div class="form-group row">
                <div class="col-sm-6">
                 <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
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

              </form>
            </div>
          </div>
        </div> <!-- / .card-desk-->
      </div> <!-- .col-12 -->
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->


</main> <!-- main -->
@endsection

@section('scripts')
<script>


    
    function addmore(containerId) {
        var container = document.getElementById(containerId);
        var newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td class="span3 supplier">
                <input type="text" name="item_name[]" required="" class="form-control product_name" placeholder="Item name" tabindex="5">   
            </td>
            <td class="span3 supplier">
                <input type="text" name="item_description[]" required="" class="form-control product_name" placeholder="description" tabindex="5">   
            </td>
            <td class="span3 supplier">
                <input type="text" name="item_quantity[]" required="" class="form-control product_name" placeholder="quantity" tabindex="5">   
            </td>
            <td class="span3">
        <div class="custom-file">
          <input type="file" class="custom-file-input" name="item_image[]" accept="image/*" onchange="updateImageLabel(this)">
          <label class="custom-file-label">Choose file</label>
        </div>
      </td>
            <td class="span3 supplier">
                <input type="text" name="item_price[]" required="" class="form-control product_name" placeholder="price" tabindex="5">   
            </td>
            <td>
                <button class="btn btn-danger red text_align_right" type="button" value="delete" onclick="deletePurchaseRow(this)" tabindex="8">Delete</button>
            </td>
        `;

        container.appendChild(newRow);
    }

    function deletePurchaseRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }


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





@endsection
