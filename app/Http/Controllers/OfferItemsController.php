<?php

namespace App\Http\Controllers;

use App\Models\OfferItems;
use App\Http\Requests\StoreOfferItemsRequest;
use App\Http\Requests\UpdateOfferItemsRequest;
use App\Models\Item;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferItemsController extends Controller
{
   
    public function index()
    {
        $item_list = Item::all();

        $item_list = DB::table('offer_item')
            ->join('item', 'offer_item.item_id', '=', 'item.id')
            ->select('offer_item.id as offer_item_id', 'item.*', 'offer_item.*')
            ->get();

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
        return redirect()->route('offerIndex');
    }

    
    public function show(OfferItems $offerItems)
    {
        //
    }

    
    public function edit($id)
    {
        try {
            $offeritem = OfferItems::findOrFail($id);
            $item = Item::where('id', $offeritem->item_id)
                          ->first();
            return view('item.offeredit', compact('item', 'offeritem'));
        } catch (ModelNotFoundException $e) {
            return back()->withError('Item not found')->withInput();
        } catch (Exception $e) {  
            return back()->withError($e->getMessage())->withInput();
        }
    }

    
    public function update(UpdateOfferItemsRequest $request,$id)
    {
        $validated = $request->validated();

        $offeritem = OfferItems::where('id', $id)
                     ->first();

    if ($offeritem) {
        $offeritem->month = $validated['month_year'];
        $offeritem->offer_rate = $validated['offer_rate'];
        $offeritem->offer_price = $validated['offer_price'];
        $offeritem->status = $validated['status'];
        $offeritem->save();

        notify()->success('Offer updated successfully. ⚡️', 'Success');
        return redirect()->route('offerIndex');
    } else {
        notify()->error('Invalid details.. Please try again. ⚡️', 'Error');
        return redirect()->route('offerIndex');
    }
        // Update the offer item with new data
        
    }

    
    public function destroy(OfferItems $offerItems,$id)
    {
        $offeritem = OfferItems::find($id);
        if ($offeritem) {
            $offeritem->delete();
            
            notify()->success('Offer deleted successfully. ⚡️', 'Success');
            return redirect()->route('offerIndex');
        } else {
            return redirect()->route('offerIndex')->with('error', 'Offer not found.');
        }
    }
}
