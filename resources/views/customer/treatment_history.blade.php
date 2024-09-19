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
                            <h2 class="page-title">Treatment History</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('customer.index')}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                    Customer List</button></a>
                        </div>
                    </div>

                    <div class="row my-4">
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
                                                <th style="color: black;">Country Type</th>
                                                <th style="color: black;">Country</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <tr>
                                                <td>{{$customer->name}}</td>
                                                <td>{{$customer->contact}}</td>
                                                <td>
                                                    @if (empty($customer->address))
                                                    No Address
                                                    @else
                                                    {{$customer->address}}
                                                    @endif
                                                </td>
                                                <td>{{$customer->customerType->name}}</td>
                                                <td>{{$customer->countryType->name}}</td>
                                                <td>
                                                    @if (empty($customer->country->name))
                                                    Sri Lanka
                                                    @else
                                                    {{$customer->country->name}}
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Visit Details:</strong></label>
                                    <!-- first visit -->
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Added Treatments</th>
                                                <th style="color: black;">Selected Treatments</th>
                                                <th style="color: black;">Comments</th>
                                                <th style="color: black;">Things to bring</th>
                                                <th style="color: black;">Next Assigned Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($visitHistory as $history)
                                            <tr>
                                                <td>{{$history->appointment->visitDay->name}}</td>
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
                                                <td>
                                                    @if($history->selected_treatments)
                                                    @php
                                                    $selectedTreatmentNames = \App\Models\Treatment::whereIn('id', $history->selected_treatments)->pluck('name')->toArray();
                                                    @endphp
                                                    @foreach($selectedTreatmentNames as $treatmentName)
                                                    {{ $treatmentName }}<br>
                                                    @endforeach
                                                    @else
                                                    No Treatments
                                                    @endif
                                                </td>
                                                <td>{{ $history->comment ?? 'No Comment' }}</td>
                                                <td>{{ $history->things_to_bring ?? 'No Things' }}</td>
                                                <td>{{ $history->next_day ? \Carbon\Carbon::parse($history->next_day)->format('Y-m-d') : 'Not yet' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No visit history</td>
                                            </tr>
                                            @endforelse 
                                        </tbody>
                                    </table>

                                    



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