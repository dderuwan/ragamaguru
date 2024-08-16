@extends('layouts.main.master')

@section('content')
<style>
    .fc-event-custom.event {
        background-color: #27E151;
        border-color: #27E151;
    }

    .fc-time {
        padding: 0 0 0 2px;
        font-size: 12px;
    }

    .fc-title {
        display: block;
        padding: 0 0 0 2px;
        font-size: 12px;
    }

    .fc td,
    .fc th {
        border-left: 1px solid #ddd !important;
    }
</style>

<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row align-items-center my-3">
                        <div class="col">
                            <h2 class="page-title">Add Treatments</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('appointments.index')}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                    Appointment List</button></a>
                        </div>
                    </div>

                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">

                                    <!--customer details table -->
                                    <label><strong>Customer Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #fffbe6; color: #333;" id="">
                                        <thead style="background-color: #fff4cc;">
                                            <tr>
                                                <th style="color: black;">Name</th>
                                                <th style="color: black;">Contact Number</th>
                                                <th style="color: black;">Address</th>
                                                <th style="color: black;">Reg. Type</th>
                                                <th style="color: black;">Country</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <tr>
                                                <td>{{$customer->name}}</td>
                                                <td>{{$customer->contact}}</td>
                                                <td>{{$customer->address}}</td>
                                                <td>{{$customer->customerType->name}}</td>
                                                <td>{{$customer->countryType->name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Treatment History:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Treatments</th>
                                                <th style="color: black;">Notes</th>
                                                <th style="color: black;">Next Assign Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($treatmentHistory as $history)
                                            <tr>
                                                <td>
                                                    @if($history->appointment->visit_day == 1)
                                                    First Visit
                                                    @elseif($history->appointment->visit_day == 2)
                                                    Second Visit
                                                    @elseif($history->appointment->visit_day == 3)
                                                    Third Visit
                                                    @else
                                                    Other Visit
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($history->added_date)->format('Y-m-d') }}</td>
                                                <td>
                                                    @if($history->treatments)
                                                    @php
                                                    $treatmentNames = \App\Models\Treatment::whereIn('id', $history->treatments)->pluck('name')->toArray();
                                                    @endphp
                                                    @foreach($treatmentNames as $treatmentName)
                                                    {{ $treatmentName }}<br>
                                                    @endforeach
                                                    @else
                                                    No Treatments
                                                    @endif
                                                </td>
                                                <td>{{ $history->note ?? 'No Notes' }}</td>
                                                <td>{{ $history->next_day ? \Carbon\Carbon::parse($history->next_day)->format('Y-m-d') : 'Not yet' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No treatment history</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>


                                    <form action="{{ route('saveCustomerTreatments', $appointment->id) }}" method="POST">
                                        @csrf
                                        <!-- treatment details table -->
                                        <label class="mt-2"><strong>Add Treatments:</strong></label>
                                        <div class="row">
                                            <!-- First Table -->
                                            <div class="col-md-6">
                                                <table class="table table-bordered table-hover" style="background-color: #f9f9f9; color: #333;">
                                                    <thead style="background-color: #e2e2e2;">
                                                        <tr>
                                                            <th style="color: black;">No.</th>
                                                            <th style="color: black;">Treatment</th>
                                                            <th style="color: black;">Add</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($treatment->take(ceil($treatment->count() / 2)) as $index => $treat)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $treat->name }}</td>
                                                            <td>
                                                                <input type="checkbox" name="treatments[]" value="{{ $treat->id }}"
                                                                    {{ isset($existingCustomerTreatment) && in_array($treat->id, $existingCustomerTreatment->treatments) ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Second Table -->
                                            <div class="col-md-6">
                                                <table class="table table-bordered table-hover" style="background-color: #f9f9f9; color: #333;">
                                                    <thead style="background-color: #e2e2e2;">
                                                        <tr>
                                                            <th style="color: black;">No.</th>
                                                            <th style="color: black;">Treatment</th>
                                                            <th style="color: black;">Add</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($treatment->slice(ceil($treatment->count() / 2)) as $index => $treat)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $treat->name }}</td>
                                                            <td>
                                                                <input type="checkbox" name="treatments[]" value="{{ $treat->id }}"
                                                                    {{ isset($existingCustomerTreatment) && in_array($treat->id, $existingCustomerTreatment->treatments) ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="specialNote"><strong>Add Special Note:</strong></label>
                                            <textarea id="specialNote" name="specialNote" class="form-control" rows="3" placeholder="Enter your special note here...">{{ $existingCustomerTreatment->note ?? '' }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3">Save Treatments</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
</div> <!-- .wrapper -->



@endsection