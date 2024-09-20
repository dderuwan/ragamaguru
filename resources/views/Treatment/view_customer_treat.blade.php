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

                                    <!-- Treatment History Table -->
                                    <label class="mt-2"><strong>Today Visit Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Visit Day</th>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Comments</th>
                                                <th style="color: black;">Things to bring</th>
                                                <th style="color: black;">Next Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($treatmentHistory)
                                            <tr>
                                                <td>{{$treatmentHistory->appointment->visitDay->name}}</td>
                                                <td>{{ \Carbon\Carbon::parse($treatmentHistory->added_date)->format('Y-m-d') }}</td>
                                                <td>{{ $treatmentHistory->comment ?? 'No Comments' }}</td>
                                                <td>{{ $treatmentHistory->things_to_bring ?? 'No Things' }}</td>
                                                <td>{{ $treatmentHistory->next_day ?? 'Not Added' }}</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td colspan="5" class="text-center" style="border-color: #000;">No Details</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <form action="{{ route('updateNextDay', $treatmentHistory->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <label><strong>Assign next date:</strong></label>
                                                <input type="date" class="form-control mb-3" id="nextDay" name="nextDay" required
                                                    value="{{ $treatmentHistory->next_day ?? '' }}">
                                                @error('nextDay')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('showCalendarSchedule') }}" type="button" class="btn btn-sm btn-success">View Schedule</a>
                                                    <button type="submit" class="btn btn-sm btn-primary">Save Date</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    @if ($haveTreatments)
                                    <form action="{{route("saveTreatPayment",$appointment->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$appointment->id}}">
                                        <label class="mt-2"><strong>Today Treatments:</strong></label>
                                        <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                            <thead style="background-color: #ccffcc;">
                                                <tr>
                                                    <th style="color: black;">Add</th>
                                                    <th style="color: black;">Name</th>
                                                    <th style="color: black;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($treatmentHistory && $treatmentHistory->treatments)
                                                @php
                                                $treatments = \App\Models\Treatment::whereIn('id', $treatmentHistory->treatments)->get();
                                                $selectedTreatments = $treatmentHistory->selected_treatments ?? [];
                                                $totalAmount = 0;
                                                @endphp
                                                @foreach($treatments as $treatment)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="treatment-checkbox" name="treatments[]" value="{{ $treatment->id }}"
                                                            data-amount="{{ $treatment->amount }}"
                                                            @if(empty($selectedTreatments) || in_array($treatment->id, $selectedTreatments)) checked @endif>
                                                    </td>
                                                    <td>{{ $treatment->name }}</td>
                                                    <td>{{ number_format($treatment->amount, 2) }}</td>
                                                </tr>
                                                @php
                                                $totalAmount += $treatment->amount;
                                                @endphp
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="3" style="border-color: #000;">No Treatments</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($haveTreatments)
                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <div class="card shadow">
                                <div class="card">
                                    <div class="card-header" style="background-color: #ADD8E6;">
                                        <strong>Payment Section</strong>
                                    </div>
                                    <div class="card-body">

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
                                                {{ isset($paymentDetails) ? 'readonly' : '' }} required>
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

                                        @if (isset($paymentDetails))
                                        <p class="text-info">Payment details have already been recorded for this treatment.</p>
                                        @endif
                                        <button type="submit" class="btn btn-primary btn-block">Save Payment</button>

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
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.treatment-checkbox');
        const totalAmountField = document.getElementById('totalAmount');
        const dueAmountField = document.getElementById('dueAmount');

        function calculateTotalAmount() {
            let total = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.getAttribute('data-amount'));
                }
            });
            totalAmountField.value = total.toFixed(2);
            const totalAmount = parseFloat(document.getElementById('totalAmount').value.replace(/,/g, ''));
            const paidAmount = parseFloat(document.getElementById('paidAmount').value);
            if (isNaN(paidAmount)) {
                paidAmount = 0;
            }
            const dueAmount = totalAmount - paidAmount;
            document.getElementById('dueAmount').value = dueAmount.toFixed(2);
        }

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', calculateTotalAmount);
        });

        calculateTotalAmount();
    });


    function calculateDueAmount() {
        const totalAmount = parseFloat(document.getElementById('totalAmount').value.replace(/,/g, ''));
        const paidAmount = parseFloat(document.getElementById('paidAmount').value);
        const dueAmount = totalAmount - paidAmount;
        document.getElementById('dueAmount').value = dueAmount.toFixed(2);
    }
</script>

@endsection