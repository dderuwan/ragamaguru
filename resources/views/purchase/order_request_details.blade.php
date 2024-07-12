@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11 my-4">
                <div class="card shadow p-4">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h2 class="page-title">Order Request Details</h2>
                                <div class="action-icons mb-3">
                                    <a href="{{ route('purchase.purchaseOrder') }}" class="action-icon edit-icon" title="Back">
                                        <i class="fe fe-arrow-left-circle text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>                      
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="card-text">
                                    <h6>Order Request Code: <span class="text-primary" style="font-size: 14px;">{{ $request_code }}</span></h6>
                                    <h6>Supplier Code: <span class="text-primary" style="font-size: 14px;">{{ $purchase->supplier_code }}</span></h6>
                                    <h6>Date: <span class="text-primary" style="font-size: 14px;">{{ $purchase->date }}</span></h6>
                                </div>
                            </div>
                        </div>                      
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h3 class="card-title">Items</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th style="color: black;">Item code</th>
                                                <th style="color: black;">In Stock</th>
                                                <th style="color: black;">Order Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($items as $item)
                                                <tr>
                                                    <td>{{ $item->item_code }}</td>
                                                    <td>{{ $item->inquantity }}</td>
                                                    <td>{{ $item->order_quantity }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No items found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
