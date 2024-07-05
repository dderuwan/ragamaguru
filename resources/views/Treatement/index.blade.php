@extends('Treatement.layouts')

@section('content')

    <div class="container">
        <div class="row">
           <center><h1>All Treatements </h1></center>
            <div class="col-md-12">

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Treatement List
                            <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addTreatementModal">
                                Add Treatement
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Treatements as $Treatement)
                                <tr>
                                    <td>{{ $Treatement->id }}</td>
                                    <td>{{ $Treatement->name }}</td>
                                    <td>{{ $Treatement->price }}</td>
                                    <td>{{ $Treatement->status == 1 ? 'Active':'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('Treatement.edit', $Treatement->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('Treatement.show', $Treatement->id) }}" class="btn btn-info">Show</a>

                                        <form id="delete-form-{{ $Treatement->id }}" action="{{ route('Treatement.destroy', $Treatement->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $Treatement->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $Treatements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addTreatementModal" tabindex="-1" role="dialog" aria-labelledby="addTreatementModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTreatementModalLabel">Add Treatement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('Treatement') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" id="price" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure you want to delete this item?',
            text: "You won't be able to revert this!",
            width: '350px',
            height: '300px',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>





@endsection



