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

                                    @if(!$firstVisitHistory->isEmpty())
                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Visit Details:</strong></label>
                                    <!-- first visit -->
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
                                            @forelse($firstVisitHistory as $history)
                                            <tr>
                                                <td>First Visit</td>
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
                                                <td colspan="5" class="text-center">No visit history</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                    @if(!$secondVisitHistory->isEmpty()) 
                                    <!-- second visit -->
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comments</th>
                                                <th style="color: black;">Things to bring</th>
                                                <th style="color: black;">Next Assign Date</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @forelse($secondVisitHistory as $history)
                                            <tr>
                                                <td>Second Visit</td>
                                                <td>{{ \Carbon\Carbon::parse($history->added_date)->format('Y-m-d') }}</td>
                                                <td>{{ $history->second_visit_comment ?? 'No Comments' }}</td>
                                                <td>{{ $history->second_visit_things ?? 'No Items' }}</td>
                                                <td>{{ $history->next_day ? \Carbon\Carbon::parse($history->next_day)->format('Y-m-d') : 'Not yet' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No visit history</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                    @if(!$thirdVisitHistory->isEmpty()) 
                                    <!-- third visit -->
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @forelse($thirdVisitHistory as $history)
                                            <tr>
                                                <td>Third Visit</td>
                                                <td>{{ \Carbon\Carbon::parse($history->added_date)->format('Y-m-d') }}</td>
                                                <td>{{ $history->third_visit_comment ?? 'No Comments' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No visit history</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                    @if(!$otherVisitHistory->isEmpty()) 
                                    <!-- other visit -->
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @forelse($otherVisitHistory as $history)
                                            <tr>
                                                <td>Other Visit</td>
                                                <td>{{ \Carbon\Carbon::parse($history->added_date)->format('Y-m-d') }}</td>
                                                <td>{{ $history->other_visit_comment ?? 'No Comments' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No visit history</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                    @if ($visitDay=='1')
                                    <div id="firstVisit">
                                        <form action="{{ route('saveCustomerTreatments', $appointment->id) }}" method="POST">
                                            @csrf
                                            <!-- treatment details table -->
                                            <label class="mt-2"><strong>Add First Visit Treatments:</strong></label>
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
                                    @endif

                                    @if ($visitDay=='2')
                                    <div id="secondVisit">
                                        <form action="{{ route('saveSecondDayDetails', $appointment->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group mt-2">
                                                <label for="secondVisitComment"><strong>Add Second Visit Commnents</strong><i class="text-danger">*</i></label>
                                                <textarea id="secondVisitComment" name="secondVisitComment" class="form-control" rows="3" placeholder="Enter commnents here..." required>{{ $existingCustomerTreatment->second_visit_comment ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="thingsToBring"><strong>Add Things to Bring</strong></label>
                                                <textarea id="thingsToBring" name="thingsToBring" class="form-control" rows="3" placeholder="Enter things here...">{{ $existingCustomerTreatment->second_visit_things ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="nextDay"><strong>Add Third Visit Date</strong><i class="text-danger">*</i></label>
                                                <input type="date" class="form-control mb-3 col-md-6" id="nextDay" name="nextDay" value="{{ $existingCustomerTreatment->next_day ?? '' }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Save Details</button>
                                        </form>
                                    </div>
                                    @endif


                                    @if ($visitDay=='3')
                                    <div id="thirdVisit">
                                        <form action="{{ route('saveThirdDayDetails', $appointment->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group mt-2">
                                                <label for="thirdVisitComment"><strong>Add Third Visit Comment</strong><i class="text-danger">*</i></label>
                                                <textarea id="thirdVisitComment" name="thirdVisitComment" class="form-control" rows="3" placeholder="Enter commnents here..." required>{{ $existingCustomerTreatment->third_visit_comment ?? '' }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Save Details</button>
                                        </form>
                                    </div>
                                    @endif

                                    @if ($visitDay=='4')
                                    <div id="otherVisit">
                                        <form action="{{ route('saveOtherDayDetails', $appointment->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group mt-2">
                                                <label for="otherVisitComment"><strong>Add Other Visit Comment</strong><i class="text-danger">*</i></label>
                                                <textarea id="otherVisitComment" name="otherVisitComment" class="form-control" rows="3" placeholder="Enter commnents here..." required>{{ $existingCustomerTreatment->other_visit_comment ?? '' }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Save Details</button>
                                        </form>
                                    </div>
                                    @endif

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