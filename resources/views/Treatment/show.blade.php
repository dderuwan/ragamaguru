@extends('layouts.main.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Show Treatement Detail
                            <a href="{{ url('Treatement') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <p>
                                {{ $Treatement->name }}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>price</label>
                            <p>
                                {!! $Treatement->price !!}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <br/>
                            <p>
                                {{ $Treatement->status == 1 ? 'Active':'' }}
                                {{ $Treatement->status == 0 ? 'Inactive':'' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
