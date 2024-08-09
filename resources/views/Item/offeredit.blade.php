@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
    <div class="container">
        <h2>Edit Offer</h2>
        <form action="{{route('offerItemUpdate',$offeritem->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $offeritem->id }}">
            
            <div class="form-group">
                <label for="item_code">Item Code</label>
                <input type="text" name="item_code" id="item_code" class="form-control" value="{{ old('item_code', $item->item_code) }}" readonly>
            </div>

            <div class="form-group">
                <label for="item_name">Item Name</label> 
                <input type="text" name="item_name" id="item_name" class="form-control" value="{{ old('item_name', $item->name) }}" required readonly>
            </div>

            <div class="form-group">
                <label for="month_year">Month</label>
                <input type="month" class="form-control" id="month_year" name="month_year" placeholder="Select Month" value="{{ old('month', $offeritem->month) }}" required>
            </div>
            @error('month_year')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="normal_price">Normal Price</label>
                <input type="text" name="normal_price" id="normal_price" class="form-control" value="{{ old('normal_price', $offeritem->normal_price) }}" required readonly>
            </div>

            <div class="form-group">
                <label for="offer_rate">Offer Rate (%)</label>
                <input type="text" name="offer_rate" id="offer_rate" class="form-control" value="{{ old('offer_rate', $offeritem->offer_rate) }}" required>
            </div>
            @error('offer_rate')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="offer_price">Offer Price</label>
                <input type="text" name="offer_price" id="offer_price" class="form-control" value="{{ old('offer_price', $offeritem->offer_price) }}" required readonly>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    @if ($offeritem->status=='Active')
                    <option value="Active" selected>Active</option>
                    <option value="Inactive">Inactive</option>
                    @else
                    <option value="Active">Active</option>
                    <option value="Inactive" selected>Inactive</option>
                    @endif 
                </select>    
           </div>
           @error('status')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-primary">Update Offer</button>
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script>

document.addEventListener('DOMContentLoaded', function() {
    const normalPriceInput = document.getElementById('normal_price');
    const offerRateInput = document.getElementById('offer_rate');
    const offerPriceInput = document.getElementById('offer_price');

    offerRateInput.addEventListener('input', function() {
        const normalPrice = parseFloat(normalPriceInput.value) || 0;
        const offerRate = parseFloat(offerRateInput.value) || 0;
        const offerPrice = normalPrice - (normalPrice * (offerRate / 100));
        
        if (!isNaN(offerPrice)) {
            offerPriceInput.value = offerPrice.toFixed(2);
        }
    });
});


</script>

@endsection
