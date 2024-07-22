@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Purchase Orders List</h2>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <a href="{{ route('OrderRequests.create') }}" class="btn btn-primary mb-3">Create New Order</a>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th style="color: black;">#</th>
                                            <th style="color: black;" width="200px">Order-Request-Code</th>
                                            <th style="color: black;">Supplier Code</th>
                                            <th style="color: black;">Date</th>
                                            <th style="color: black;">Status</th>
                                            <th style="color: black;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderRequests as $orderRequest)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $orderRequest->order_request_code }}</td>
                                                <td>{{ $orderRequest->supplier_code }}</td>
                                                <td>{{ $orderRequest->date }}</td>
                                                <td>{{ $orderRequest->status }}</td>
                                                <td>
                                                    <!-- Show Button -->
                                                    <a href="{{ route('OrderRequests.show', $orderRequest->id) }}" class="btn btn-secondary"><i class="fe fe-eye fe-16"></i></a>

                                                    <!-- Delete Button -->
                                                    <button class="btn btn-danger" onclick="confirmDelete({{ $orderRequest->id }})"><i class="fe fe-trash fe-16"></i></button>
                                                    <form id="delete-form-{{ $orderRequest->id }}" action="{{ route('OrderRequests.destroy', $orderRequest->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main> <!-- main -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(orderRequestId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + orderRequestId).submit();
            }
        })
    }
</script>
@endsection
