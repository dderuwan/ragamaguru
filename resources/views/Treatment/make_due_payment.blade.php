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
                            <h2 class="page-title">Due Payment</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{route('customer.index')}}"><button type="button" class="btn btn-primary" data-toggle="modal">
                                    Customer List</button></a>
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
                                    <label class="mt-2"><strong>Payment Details:</strong></label>
                                    <table class="table table-bordered table-hover" style="background-color: #e6ffe6; color: #333;">
                                        <thead style="background-color: #ccffcc;">
                                            <tr>
                                                <th style="color: black;">Date</th>
                                                <th style="color: black;">Total Amount (LKR)</th>
                                                <th style="color: black;">Paid Amount (LKR)</th>
                                                <th style="color: black;">Due Amount (LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$customerTreatment->added_date}}</td>
                                                <td>{{$customerTreatment->total_amount}}</td>
                                                <td>{{$customerTreatment->paid_amount}}</td>
                                                <td style="color: red;">{{$customerTreatment->due_amount}}</td>
                                            </tr>
                                        </tbody>
                                    </table>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end mt-4">
                        <div class="col-md-5">
                            <div class="card shadow">
                                <div class="card">
                                    <div class="card-header" style="background-color: #ADD8E6;">
                                        <strong>Payment Section</strong>
                                    </div>
                                    <div class="card-body">
                                    <form action="{{route("saveDuePayment",$customerTreatment->id)}}" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <label for="totalAmount">Amount to be paid (LKR):</label>
                                            <input type="text" id="totalAmount" name="totalAmount" class="form-control" value="{{ number_format($customerTreatment->due_amount, 2) }}" readonly>
                                            @error('totalAmount')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                            <div class="form-group">
                                                <label for="paymentType">Payment Type:</label>
                                                <select id="paymentType" name="paymentType" class="form-control" required>
                                                    @foreach ($paymentTypes as $type )
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('paymentType')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="paidAmount">Paid Amount (LKR):</label>
                                                <input type="number" id="paidAmount" name="paidAmount" class="form-control" oninput="calculateDueAmount()" required>
                                                @error('paidAmount')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="dueAmount">Due Amount (LKR):</label>
                                                <input type="text" id="dueAmount" name="dueAmount" class="form-control" value="{{ number_format($customerTreatment->due_amount, 2) }}" readonly>
                                                @error('dueAmount')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">Save Payment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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