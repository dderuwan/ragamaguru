@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
    <div class="container">
        <h1>Order Details</h1>
        <div class="mb-3">
            <a href="{{ route('onlineOrders') }}" class="btn btn-secondary"><i class="fe fe-arrow-left fe-16"></i></a>
            <button class="btn btn-danger" onclick="confirmDelete({{ $order->id }})"><i class="fe fe-trash fe-16"></i></button>
            <form id="delete-form-{{ $order->id }}" action="{{ route('orderreport.destroy', $order->id) }}" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
                <p><strong>Date:</strong> {{ $order->date }}</p>
                <p><strong>Customer Code:</strong> {{ $order->customer_code }}</p>
                <p><strong>Customer Name:</strong> {{ $order->customer->name }}</p>
                <p><strong>Customer Contact:</strong> {{ $order->customer->contact }} </p>
                <p><strong>Customer Address:</strong> {{ $order->customer->address }} </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <p><strong>Sub Total:</strong> {{ $order->sub_total }}</p>
                <p><strong>Shipping Cost:</strong> {{ $order->shipping_cost }}</p>
                <p><strong>Grand Total:</strong> {{ $order->total_cost_payment }}</p>
                <p><strong>Paid Amount:</strong> {{ $order->paid_amount }}</p>
                <p><strong>Payment Type:</strong> {{ $order->payment_type }}</p>
                <p><strong>Order Status:</strong> {{ $order->orderStatus->name }}</p>
                <button data-toggle="modal" data-target="#changeStatusModal" class="btn btn-sm btn-primary mb-3">Change Status</button>
            </div>
        </div>



        <h2>Items</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>

                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total_cost }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>



    <!--status Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('changeStatus', $order->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select mr-sm-2" id="status" name="status">
                                @foreach ($orderStatus as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Change</button>    
                    </form>

                </div>

            </div>
        </div>
    </div>



</main>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(orderId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + orderId).submit();
            }
        })
    }
</script>
@endsection