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
                            <h2 class="page-title">Treatments</h2>
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

                                    @if ($visitDay=='1')
                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Today Visit Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Notes</th>
                                                <th colspan="2" style="color: black;">Treatment</th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="color: black;"></th>
                                                <th style="color: black;">Name</th>
                                                <th style="color: black;">Amount (LKR)</th>
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
                                                <td>{{ $history->note ?? 'No Notes' }}</td>
                                                <td colspan="2">
                                                    <table class="table table-bordered" style="margin-bottom: 0;">
                                                        @if($history->treatments)
                                                        @php
                                                        $treatments = \App\Models\Treatment::whereIn('id', $history->treatments)->get();
                                                        $totalAmount = 0;
                                                        @endphp
                                                        @foreach($treatments as $treatment)
                                                        <tr>
                                                            <td style="border-color: #000;">{{ $treatment->name }}</td>
                                                            <td style="border-color: #000;">{{ number_format($treatment->amount, 2) }}</td>
                                                        </tr>
                                                        @php
                                                        $totalAmount += $treatment->amount;
                                                        @endphp
                                                        @endforeach
                                                        <tr style="border-top: 2px solid #000;">
                                                            <td style="border-color: #000; font-weight: bold;">Total Amount</td>
                                                            <td style="border-color: #000; font-weight: bold;">{{ number_format($totalAmount, 2) }}</td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td colspan="2" style="border-color: #000;">No Treatments</td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center" style="border-color: #000;">No Details</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                    @if ($visitDay=='2')
                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Today Visit Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comment</th>
                                                <th style="color: black;">Things to bring</th>
                                                <th style="color: black;">Next Date</th>
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
                                                <td>{{ $history->second_visit_comment ?? 'No Comments' }}</td>
                                                <td>{{ $history->second_visit_things ?? 'No items' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($history->next_day)->format('Y-m-d') }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center" style="border-color: #000;">No Details</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary">Print</button>
                                    @endif

                                    @if ($visitDay=='3')
                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Today Visit Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comment</th>
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
                                                <td>{{ $history->third_visit_comment ?? 'No Comments' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center" style="border-color: #000;">No Details</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                    @if ($visitDay=='4')
                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Today Visit Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comment</th>
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
                                                <td>{{ $history->other_visit_comment ?? 'No Comments' }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center" style="border-color: #000;">No Details</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($visitDay=='1')
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <div class="card shadow">
                                <div class="card">
                                    <div class="card-header" style="background-color: #ADD8E6;">
                                        <strong>Payment Section</strong>
                                    </div>
                                    <div class="card-body">

                                        <form action="{{route("saveTreatPayment",$appointment->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$appointment->id}}">

                                            <div class="form-group">
                                                <label for="totalAmount">Total Amount (LKR):</label>
                                                <input type="text" id="totalAmount" name="totalAmount" class="form-control"
                                                    value="{{ isset($paymentDetails) ? number_format($paymentDetails->total_amount, 2) : number_format($totalAmount, 2) }}"
                                                    readonly>
                                                @error('totalAmount')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="paymentType">Payment Type:</label>
                                                <select id="paymentType" name="paymentType" class="form-control"
                                                    {{ isset($paymentDetails) ? 'disabled' : '' }} required>
                                                    @foreach ($paymentTypes as $type )
                                                    <option value="{{$type->id}}"
                                                        {{ isset($paymentDetails) && $paymentDetails->payment_type_id == $type->id ? 'selected' : '' }}>
                                                        {{$type->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('paymentType')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="paidAmount">Paid Amount (LKR):</label>
                                                <input type="number" id="paidAmount" name="paidAmount" class="form-control"
                                                    value="{{ isset($paymentDetails) ? $paymentDetails->paid_amount : '' }}"
                                                    {{ isset($paymentDetails) ? 'readonly' : '' }} oninput="calculateDueAmount()" required>
                                                @error('paidAmount')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="dueAmount">Due Amount (LKR):</label>
                                                <input type="text" id="dueAmount" name="dueAmount" class="form-control"
                                                    value="{{ isset($paymentDetails) ? number_format($paymentDetails->due_amount, 2) : number_format($totalAmount, 2) }}"
                                                    readonly>
                                                @error('dueAmount')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <label><strong>Assign next date:</strong></label>
                                            <input type="date" class="form-control mb-3 " id="nextDay" name="nextDay" required
                                                value="{{ $paymentDetails->next_day ?? '' }}"
                                                @if ($paymentDetails) disabled @endif>
                                            @error('nextDay')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            @if (!isset($paymentDetails))
                                            <button type="submit" class="btn btn-primary btn-block">Save Payment</button>
                                            @else
                                            <p class="text-info">Payment details have already been recorded for this treatment.</p>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    </main> <!-- main -->
</div> <!-- .wrapper -->

<script>
    function calculateDueAmount() {
        const totalAmount = parseFloat(document.getElementById('totalAmount').value.replace(/,/g, ''));
        const paidAmount = parseFloat(document.getElementById('paidAmount').value);
        const dueAmount = totalAmount - paidAmount;
        document.getElementById('dueAmount').value = dueAmount.toFixed(2);
    }
</script>

@endsection