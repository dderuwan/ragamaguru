@extends('layouts.main.master')

@section('content')

<style>
.action-icons {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.action-icon {
    display: inline-block;
    width: 36px; 
    height: 36px; 
    line-height: 36px; 
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 5px; 
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
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h2 class="page-title">All Items</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('createitem') }}"><button type="button" class="btn btn-primary float-end">
                            Add Item
                        </button></a>
                    </div>
                </div>
                <p class="card-text"></p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th style="color: black;">#</th>
                                            <th style="color: black;">Item code</th>
                                            <th style="color: black;">Image</th>
                                            <th style="color: black;">Name</th>
                                            <th style="color: black;">Description</th>
                                            <th style="color: black;">Quantity</th>
                                            <th style="color: black;">Individual Item cost</th>
                                            <th style="color: black;">Supplier</th>
                                            <th class="text-center" style="color: black;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item_list as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->item_code}}</td>
                                            <td> @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" 
                                                    alt="Item Image" style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>Rs. {{$item->price}}</td>
                                            <td>{{$item->supplier_code}}</td>
                                            <td>
                                                <div class="action-icons">
                                                    <a href="{{ route('edititem', $item->id) }}" class="action-icon edit-icon" title="Edit">
                                                        <i class="fe fe-edit text-primary"></i>
                                                    </a>
                                                    
                                                    <button class="action-icon delete-icon" onclick="confirmDelete('{{ $item->id }}')" title="Delete">
                                                        <i class="fe fe-trash-2 text-danger"></i>
                                                    </button>
                                                    
                                                    <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', $item->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>                                         
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
                    Are you sure you want to delete this Item?
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
    function confirmDelete(itemId) {
        const deleteForm = document.getElementById('delete-form-' + itemId);
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');

        $('#deleteModal').modal('show');

        confirmDeleteButton.onclick = function() {
            deleteForm.submit();
        }
    }
</script>
@endsection
