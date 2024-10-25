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
                        <h2 class="page-title">Medical Reason</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('reason.index') }}"><button type="button" class="btn btn-primary float-end">
                                Reason List
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
                                <h5 class="mb-2">Add Reason</h5>
                                <form method="post" action="{{route('reason.store')}}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputReason">Reason</label>
                                            <input type="text" class="form-control" id="inputReason" name="reason" placeholder="Add reason">
                                            @error('reason')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStatus">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
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