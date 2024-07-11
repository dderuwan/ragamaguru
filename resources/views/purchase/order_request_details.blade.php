@extends('layouts.main.master')

@section('content')


<style>
.action-icons {
    display: flex;
    justify-content: left;
    align-items: left;
    height: 100%;
}

.action-icon {
    display: inline-block;
    width: 42px; 
    height: 42px; 
    line-height: 45px; 
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 5px; 
}

.action-icon i {
    font-size: 17px; /* Adjust font size of the icon */
}
.edit-icon {
    background-color: #f0f0f0; 
}
.delete-icon {
    background-color: #f8d7da; 
}
</style>

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11 my-4">
                <div class="card shadow p-4">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h2 class="page-title">Order Request Details</h2>
                                <div class="action-icons mb-3">
                                    @foreach ($purchase_list as $purchase)
                                    <a href="{{ route('purchase.purchaseOrder') }}" class="action-icon edit-icon" title="Back">
                                        <i class="fe fe-arrow-left-circle text-primary"></i>
                                    </a>
                                    <button class="action-icon delete-icon" onclick="confirmDelete('{{ $purchase->id }}')" title="Delete">
                                        <i class="fe fe-trash-2 text-danger"></i>
                                    </button>
                                    <form id="delete-form-{{ $purchase->id }}" action="{{ route('purchase.destroy', $purchase->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-2">
                            <div class="col-md-6">
                                <h6 class="card-text">Order Request Code: <span class="text-primary" style="font-size: 14px;">{{ $purchase->request_code }}</span></h6>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h6 class="card-text">Supplier Code: <span class="text-primary" style="font-size: 14px;">{{ $purchase->supplier_code }}</span></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-text">Date: <span class="text-primary" style="font-size: 14px;">{{ $purchase->date }}</span></h6>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h3 class="card-title">Items</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="color: black;">Item code</th>
                                                <th style="color: black;">In Stock</th>
                                                <th style="color: black;">Order Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchase_list as $purchase)
                                            <tr>
                                                <td>{{$purchase->item_code}}</td>
                                                <td>{{$purchase->inquantity}}</td>
                                                <td>{{$purchase->order_quantity}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Purchase order request?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script>
    function confirmDelete(purchaseId) {
        const deleteForm = document.getElementById('delete-form-' + purchaseId);
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');

        $('#deleteModal').modal('show');

        confirmDeleteButton.onclick = function() {
            deleteForm.submit();
        }
    }
</script>
@endsection
