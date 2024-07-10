@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="page-title">Purchase Order Create</h2>
        <p class="text-muted"></p>

        <div class="card-deck">
          <div class="card shadow mb-4 p-2">
            <div class="card-body">
            <form method="POST" action="{{ route('get-items-by-supplier') }}">
                @csrf
                <div class="col-sm-12 mt-4 mb-5">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label text-dark">Supplier<i class="text-danger">*</i></label>
                        <div class="col-sm-5">
                            <?php
                            $supplierCodes = \App\Models\Supplier::pluck('supplier_code')->toArray();
                            $selectedSupplierCode = isset($supplierCode) ? $supplierCode : old('supplier_code');
                            ?>
                            <select class="js-example-basic-single js-states form-control" name="supplier_code" onchange="this.form.submit()">
                                <option value="">Select supplier</option>
                                <?php
                                foreach ($supplierCodes as $supplierCode) {
                                    echo '<option value="' . $supplierCode . '" ' . ($supplierCode == $selectedSupplierCode ? 'selected' : '') . '>' . $supplierCode . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
              <form method="POST" action="{{ route('storeOrder') }}">
                  @csrf
                  <table class="table table-bordered table-hover" id="purchaseTable">
                      <thead>
                          <tr>
                              <th class="text-center" width="30%" style="color: black;">Items<i class="text-danger">*</i></th>
                              <th class="text-center" style="color: black;">InStock Quantity</th>
                              <th class="text-center" style="color: black;">Order Quantity<i class="text-danger">*</i></th>
                              <th class="text-center" style="color: black;"></th>
                          </tr>
                      </thead>
                      <tbody id="addItem">
                          <tr>
                              <td class="span3">
                                  <div class="col-sm-12">
                                      <select class="js-example-basic-single js-states form-control" name="item_name[]" onchange="updateItemQuantity(this)">
                                          <option value="">Select Item</option>
                                          <?php
                                              if (isset($items)) {
                                                  foreach ($items as $item) {
                                                      echo '<option value="' . $item->id . '" data-quantity="' . $item->quantity . '">' . $item->name . '</option>';
                                                  }
                                              }
                                          ?>
                                      </select>
                                  </div>
                              </td>
                              <td class="span3">
                                  <input type="text" class="form-control text-center item-quantity" id="inputItemQuantity" name="item_quantity[]" placeholder="Quantity" readonly value="">
                              </td>
                              <td class="span3">
                                  <input type="text" name="item_orderquantity[]" required="" class="form-control product_name" placeholder="Order Quantity" id="item_orderquantity" tabindex="5">
                              </td>
                              <td class="text-center">
                                  <button class="btn btn-danger red" type="button" value="Delete" onclick="deletePurchaseRow(this)" tabindex="8">Delete</button>
                              </td>
                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                              <td colspan="5">
                                  <input type="button" id="add_invoice_item" class="btn btn-primary" name="add-invoice-item" onclick="addmore('addItem');" value="Add More item" tabindex="9">
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

      </main> <!-- main -->
      @endsection


      @section('scripts')
      <script>
      
      function initializeQuantityDisplay() {
          var firstRowSelect = document.querySelector('#addItem select[name="item_name[]"]');
          if (firstRowSelect) {
              updateItemQuantity(firstRowSelect); // Update quantity for the first row initially
          }
      }

    window.addEventListener('load', initializeQuantityDisplay);

    // Function to add more rows dynamically
    function addmore(containerId) {
        var container = document.getElementById(containerId);
        var newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td class="span3">
                <div class="col-sm-12">
                    <select class="js-example-basic-single js-states form-control" name="item_name[]" onchange="updateItemQuantity(this)">
                      <option value="">Select Item</option>
                          <?php
                              if (isset($items)) {
                              foreach ($items as $item) {
                                echo '<option value="' . $item->id . '" data-quantity="' . $item->quantity . '">' . $item->name . '</option>';
                                }
                              }
                          ?>
                    </select>
                </div>
            </td>
            <td class="span3">
                <input type="text" class="form-control text-center item-quantity" name="item_quantity[]" placeholder="Quantity" readonly>
            </td>
            <td class="span3">
                <input type="text" name="item_orderquantity[]" required class="form-control product_name" placeholder="Order Quantity" tabindex="5">
            </td>
            <td class="text-center">
                <button class="btn btn-danger red text_align_right" type="button" value="delete" onclick="deletePurchaseRow(this)" tabindex="8">Delete</button>
            </td>
        `;

        container.appendChild(newRow);
    }

    // Function to update item quantity based on selected option
    function updateItemQuantity(select) {
        var selectedOption = select.options[select.selectedIndex];
        var quantity = selectedOption.getAttribute('data-quantity');
        var quantityInput = select.closest('tr').querySelector('.item-quantity');
        if (quantityInput) {
            quantityInput.value = quantity;
        }
    }

    // Function to delete a row
    function deletePurchaseRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>


@endsection
