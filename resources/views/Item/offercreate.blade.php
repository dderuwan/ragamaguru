@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
    <div class="container">
        <h1>Create Offers</h1>
        <form action="{{ route('offerItemStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-4">
                    <label for="month_year">Month *</label>
                    <input type="month" class="form-control" id="month_year" name="month_year" required>
                </div>
            </div>

            <table class="table table-bordered" id="items-table">
                <thead>
                    <tr>
                        <th style="color: black;">Item Name *</th>
                        <th style="color: black;">Normal Price</th>
                        <th style="color: black;">Offer Rate (%)</th>
                        <th style="color: black;">Offer Price</th>
                        <th style="color: black;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][item_id]" class="form-control item-select" required>
                                <option value="">Select an item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                        {{ $item->item_code }} - {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="items[0][normal_price]" class="form-control item-price" required readonly></td>
                        <td><input type="text" name="items[0][offer_rate]" class="form-control offer-rate" required></td>
                        <td><input type="text" name="items[0][offer_price]" class="form-control offer-price" required readonly></td>
                        <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            @error('items.*.offer_rate')
                <p class="text-danger">Please check offer rate.</p>
            @enderror
            @error('month_year')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="button" class="btn btn-primary" id="add-row">Add New Item</button>
            <button type="submit" class="btn btn-success">Submit</button> 
        </form>
    </div>
</main>

<script>
    let rowIndex = 1;

    document.getElementById('add-row').addEventListener('click', function() {
        const table = document.getElementById('items-table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <tr>
                <td>
                    <select name="items[${rowIndex}][item_id]" class="form-control item-select" required>
                        <option value="">Select an item</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                {{ $item->item_code }} - {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="items[${rowIndex}][normal_price]" class="form-control item-price" required readonly></td>
                <td><input type="text" name="items[${rowIndex}][offer_rate]" class="form-control offer-rate" required></td>
                <td><input type="text" name="items[${rowIndex}][offer_price]" class="form-control offer-price" required readonly></td>
                <td><button type="button" class="btn btn-danger remove-row">Delete</button></td>
            </tr>
        `;
        rowIndex++;
    });

    document.getElementById('items-table').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.getElementById('items-table').addEventListener('change', function(e) {
        if (e.target.classList.contains('item-select')) {
            const select = e.target;
            const selectedOption = select.options[select.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const row = select.closest('tr');
            const priceInput = row.querySelector('.item-price');

            priceInput.value = price ? price : '';
            updateOfferPrice(row);
        } else if (e.target.classList.contains('offer-rate')) {
            const row = e.target.closest('tr');
            updateOfferPrice(row);
        }
    });

    function updateOfferPrice(row) {
        const normalPrice = parseFloat(row.querySelector('.item-price').value) || 0;
        const offerRate = parseFloat(row.querySelector('.offer-rate').value) || 0;
        const offerPriceInput = row.querySelector('.offer-price');

        if (normalPrice > 0 && offerRate >= 0) {
            const offerPrice = normalPrice - (normalPrice * (offerRate / 100));
            offerPriceInput.value = offerPrice.toFixed(2);
        } else {
            offerPriceInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const monthYearInput = document.getElementById('month_year');
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        const currentMonth = `${year}-${month}`;

        monthYearInput.value = currentMonth;
    });

</script>
@endsection
