@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">All Treatments</h2>
                <p class="card-text"></p>
                <div class="card-header">

                    <button type="button" class="btn btn-primary float-end" onclick="window.location.href='{{ route('createTreatment') }}'">
                        Add Treatment
                    </button>
                </div>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>Treatment ID</th>
                                            <th>Treatment Name</th>
                                            <th>Status</th>
                                            <th>Action</th>


                                    </thead>
                                    <tbody>
                                        @foreach ($Treatments as $Treatment)
                                        <tr>
                                            <td>{{ $Treatment->id }}</td>
                                            <td>{{ $Treatment->name }}</td>

                                            <td>{{ $Treatment->status == 1 ? 'Active':'Inactive' }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('editTreatment', $Treatment->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>


                                                <!-- Delete Button -->

                                                 <button class="btn btn-danger" onclick="confirmDelete({{ $Treatment->id }})"><i class="fe fe-trash fe-16"></i></button>
                                                <form id="delete-form-{{ $Treatment->id }}" action="{{ route('deleteTreatment', $Treatment->id) }}" method="POST" style="display:none;">
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
