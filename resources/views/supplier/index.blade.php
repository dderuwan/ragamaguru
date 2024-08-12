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
                        <h2 class="page-title">All Suppliers</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('createsupplier') }}"><button type="button" class="btn btn-primary float-end">
                            Add Supplier
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
                                            <th style="color: black;">Supplier code</th>
                                            <th style="color: black;">Name</th>
                                            <th style="color: black;">Contact No.</th>
                                            <th style="color: black;">Address</th>
                                            <th style="color: black;">Registered Time</th>
                                            <th class="text-center" style="color: black;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplier_list as $index=> $supplier)
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>{{$supplier->supplier_code}}</td>
                                            <td>{{$supplier->name}}</td>
                                            <td>{{$supplier->contact}}</td>
                                            <td>{{$supplier->address}}</td>
                                            <td>{{$supplier->registered_time}}</td>
                                            <td>
                                                <div class="action-icons">
                                                    <a href="{{ route('editsupplier', $supplier->id) }}" class="action-icon edit-icon" title="Edit">
                                                        <i class="fe fe-edit text-primary"></i>
                                                    </a>

                                                    <button class="action-icon delete-icon" onclick="confirmDelete('{{ $supplier->id }}')" title="Delete">
                                                        <i class="fe fe-trash-2 text-danger"></i>
                                                    </button>

                                                    <form id="delete-form-{{ $supplier->id }}" action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display: none;">
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


</main>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     function confirmDelete(supplierId) {
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
                document.getElementById('delete-form-' + supplierId).submit();
            }
        })
    }
</script>
@endsection
