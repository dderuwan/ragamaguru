<?php

namespace App\Http\Controllers;

use App\Models\OfferItems;
use App\Http\Requests\StoreOfferItemsRequest;
use App\Http\Requests\UpdateOfferItemsRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class OfferItemsController extends Controller
{
   
    public function index()
    {
        $item_list = Item::all();
        return view('item.offerindex', compact('item_list'));
    }


    public function create()
    {
        $items = Item::all();
        return view('item.offercreate', compact('items'));
    }

   
    public function store(StoreOfferItemsRequest $request)
    {
        //dd($request->all());

        $data = $request->validated(); // Get validated data

        foreach ($data['items'] as $item) {
            OfferItems::create([
                'item_id' => $item['item_id'],
                'normal_price' => $item['normal_price'],
                'offer_rate' => $item['offer_rate'],
                'offer_price' => $item['offer_price'],
                'month' => $data['month_year'],
                'status' => 'active',
                'added_date' => now(),  
            ]);
        }

        notify()->success('Offers added successfully. ⚡️', 'Success');
        return redirect()->back()->with('success', 'Offer items saved successfully.');
    }

    
    public function show(OfferItems $offerItems)
    {
        //
    }

    
    public function edit(OfferItems $offerItems)
    {
        //
    }

    
    public function update(UpdateOfferItemsRequest $request, OfferItems $offerItems)
    {
        //
    }

    
    public function destroy(OfferItems $offerItems)
    {
        //
    }
}
