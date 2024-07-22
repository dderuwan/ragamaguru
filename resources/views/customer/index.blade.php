@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">All Customers</h2>
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
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Address</th>
                                            <th>Registered Time</th>
                                            <th>User_ID</th>
                                            <th>Type</th>
                                            <th>Verify</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer_list as $customer)
                                        <tr>
                                            <td>{{$customer->id}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->contact}}</td>
                                            <td>{{$customer->address}}</td>
                                            <td>{{$customer->registered_time}}</td>
                                            <td>{{$customer->user_id}}</td>
                                            <td>{{$customer->customer_type}}</td>
                                            @if ($customer->isVerified)
                                            <td><span class="fe fe-15 fe-check"></span></td>
                                            @else
                                            <td><span class="fe fe-15 fe-x"></span></td>
                                            @endif
                                            <td>
                                                <button class="btn fe fe-24 fe-edit more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{route('editcustomer',$customer->id)}}">Edit</a>
                                                    <button class="dropdown-item text-danger" onclick="confirmDelete('{{ $customer->id }}')">Remove</button>
                                                    <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item text-success" href="#">Appointment</a>
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
                    Are you sure you want to delete this customer?
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
    function confirmDelete(customerId) {
        const deleteForm = document.getElementById('delete-form-' + customerId);
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');

        $('#deleteModal').modal('show');

        confirmDeleteButton.onclick = function() {
            deleteForm.submit();
        }
    }
</script>
@endsection
