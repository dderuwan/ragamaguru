<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\OfferItems;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show($id)
    {

        $item = Item::findOrFail($id);
        $currentMonth = date('Y-m');
        $offer = OfferItems::where('item_id', $id)
                          ->where('month', $currentMonth)
                          ->where('status', 'active')
                          ->first();
    
        return view('products', compact('item', 'offer'));
    
    }

    
    
}

