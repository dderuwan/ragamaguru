@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h2 class="page-title p-2">All Customers</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('createcustomer') }}"><button type="button" class="btn btn-primary float-end">
                                Add Customer
                            </button></a>
                    </div>
                </div>
                <p class="card-text"></p>

                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Address</th>
                                            <th>Registered Time</th>
                                            <th>Reg. UserID</th>
                                            <th>Reg. Type</th>
                                            <th>Country Type</th>
                                            <th>Verify</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer_list as $index => $customer)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->contact}}</td>
                                            <td>
                                                @if ($customer->address)
                                                {{$customer->address}}
                                                @else
                                                No Address
                                                @endif
                                            </td>
                                            <td>{{$customer->registered_time}}</td> 
                                            <td>
                                                @if ($customer->user_id)
                                                {{$customer->user_id}}
                                                @else
                                                No User
                                                @endif 
                                            </td>
                                            <td>{{$customer->customerType->name}}</td>
                                            <td>{{$customer->countryType->name}}</td>
                                            @if ($customer->isVerified)
                                            <td><span class="fe fe-15 fe-check"></span></td>
                                            @else
                                            <td><span class="fe fe-15 fe-x"></span></td>
                                            @endif
                                            <td>
                                                <button class="btn btn-info fe fe-24 fe-edit more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if (!$customer->isVerified)
                                                    <button data-toggle="modal" data-target="#verifyModal"  class="dropdown-item" onclick="verifyModal('{{ $customer->id }}','{{ $customer->contact }}')">Verify</button>
                                                    @endif
                                                    <a class="dropdown-item" href="{{route('editcustomer',$customer->id)}}">Edit</a>
                                                    <button data-toggle="modal" data-target="#deleteModal" class="dropdown-item text-danger" onclick="confirmDelete('{{ $customer->id }}')">Remove</button>
                                                    <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item text-success" href="{{ route('appointments.create',$customer->id) }}">Appointment</a>
                                                    <a class="dropdown-item text-warning" href="{{ route('viewTreatmentHistory',$customer->id) }}">Treatments</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this customer?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- verify Modal -->
    <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('reverifycustomer')}}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="" readonly>
                            <label for="addedContact">Registered Contact Number</label>
                            <input type="text" class="form-control" id="addedContact" name="addedContact" value="" readonly>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="text-primary" id="otpsendmsg"></p>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-dark mb-3 resendotp">Resend OTP</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputOTP">OTP</label>
                            <input type="text" class="form-control @error('otp') is-invalid @enderror" id="inputOTP" name="otp" placeholder="Type the OTP received on the mobile number..">
                            @error('otp')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

@section('scripts')
<script>
    function confirmDelete(customerId) {
        const deleteForm = document.getElementById('delete-form-' + customerId);
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');

        //$('#deleteModal').modal('show');

        confirmDeleteButton.onclick = function() {
            deleteForm.submit();
        }
    }
</script>

<script>
    function verifyModal(customerId, contactNumber) {
        document.getElementById('customer_id').value = customerId;
        document.getElementById('addedContact').value = contactNumber;
        document.getElementById('otpsendmsg').innerText="";
        //$('#verifyModal').modal('show');
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.resendotp').addEventListener('click', function() {
            const customerId = document.getElementById('customer_id').value;
            var otpsendmsg = document.getElementById('otpsendmsg');
            fetch("{{ route('resendOtp') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        customer_id: customerId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        otpsendmsg.innerText=data.success;
                    } else {
                        otpsendmsg.innerText=data.success;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

@endsection