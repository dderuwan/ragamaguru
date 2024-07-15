<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderRequest;
use App\Models\OrderRequestItem;
use App\Models\Item;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Carbon; 

class OrderRequestContralller extends Controller
{
    public function index()
    {
        $orderRequests = OrderRequest::all();
        return view('OrderRequests.index', compact('orderRequests'));
    }

    public function create()
    {
        $items = Item::all();
        return view('OrderRequests.create', compact('items'));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_code' => 'required|string|max:255',
            'items.*.item_code' => 'required|string|max:255',
            'items.*.instock' => 'required|integer',
            'items.*.quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $orderRequest = OrderRequest::create([
            'order_request_code' => $this->generateOrderRequestCode(),
            'supplier_code' => $request->supplier_code,
            'date' => Carbon::today(),
            'status'=>'Processing',
        ]);
        
        foreach ($request->items as $item) {
            OrderRequestItem::create([
                'order_request_id' => $orderRequest->id,
                'item_code' => $item['item_code'],
                'instock' => $item['instock'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('allorderrequests')->with('success', 'Order Request created successfully.');
    }

    // Display the specified order request
    public function show($id)
    {
        $orderRequest = OrderRequest::with('items')->findOrFail($id);
        return view('OrderRequests.show', compact('orderRequest'));
    }

    // Remove the specified order request from storage
    public function destroy($id)
    {
        $orderRequest = OrderRequest::findOrFail($id);
        $orderRequest->delete();

        return redirect()->route('allorderrequests')->with('success', 'Order Request deleted successfully.');
    }

    // Fetch items by supplier code
    public function getItemsBySupplier($supplierCode)
    {
        $items = Item::where('supplier_code', $supplierCode)->get();
        return response()->json($items);
    }

    // Fetch stock of a specific item code
    public function getItemStock($itemCode)
    {
        $item = Item::where('item_code', $itemCode)->first();
        return response()->json(['quantity' => $item ? $item->quantity : 0]);
    }

    // Generate a unique order request code
    private function generateOrderRequestCode()
    {
        return 'ORDREQ-' . time() . '-' . rand(1000, 9999);
    }

}
