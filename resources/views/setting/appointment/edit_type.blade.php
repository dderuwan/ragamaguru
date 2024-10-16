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
                        <h2 class="page-title">Appointment Type Settings</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('apType.index') }}"><button type="button" class="btn btn-primary float-end">
                                Type List
                            </button></a>
                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <p class="card-text"></p>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="mb-2">Edit Appointment Type</h5>
                                <form method="POST" action="{{ route('apType.update', $type->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputType">Type</label>
                                            <input type="text" class="form-control" id="inputType" name="type" value="{{ $type->type }}" placeholder="Add Type">
                                            @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPrice">Price</label>
                                            <input type="text" class="form-control" id="inputPrice" name="price" value="{{ $type->price }}" placeholder="Add Price">
                                            @error('price')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStatus">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" {{ $type->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $type->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="forWhom">For Whom</label><br />
                                            <input type="checkbox" id="local" name="for_whom[]" value="local"
                                                {{ in_array('local', explode(',', $type->for_whom)) ? 'checked' : '' }}>
                                            <label for="local">Local</label><br />
                                            <input type="checkbox" id="international" name="for_whom[]" value="international"
                                                {{ in_array('international', explode(',', $type->for_whom)) ? 'checked' : '' }}>
                                            <label for="international">International</label><br />
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>

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

@endsection