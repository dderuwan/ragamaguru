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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Treatments as $index => $Treatment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $Treatment->name }}</td>
                                            <td>{{ $Treatment->status == 1 ? 'Active':'Inactive' }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('editTreatment', $Treatment->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $Treatment->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <form id="delete-form-{{ $Treatment->id }}" action="{{ route('deleteTreatment', $Treatment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this treatment?');">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $Treatment->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $Treatment->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $Treatment->id }}">Edit Treatment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('updateTreatment', $Treatment->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control" value="{{ $Treatment->name }}" required />
                                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label>Status</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="1" {{ $Treatment->status == 1 ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ $Treatment->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                    Are you sure you want to delete this treatment?
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
    function confirmDelete(id) {
        if(confirm('Are you sure you want to delete this treatment?')) {
            document.getElementById('deleteForm' + id).submit();
        }
    }
</script>
@endsection
