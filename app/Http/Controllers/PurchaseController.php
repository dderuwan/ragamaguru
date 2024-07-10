<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Purchase; 
use Illuminate\Http\Request;

class PurchaseController extends Controller
{


    public function index()
    {
        $purchase_list = Purchase::all();
        return view('purchase.index', compact('purchase_list'));
    }

    public function create()
    {
        return view('purchase.create');
    }

  
 
public function getItemsBySupplier(Request $request)
{
    $supplierCode = $request->input('supplier_code');
    $items = \App\Models\Item::where('supplier_code', $supplierCode)->get();
    $supplierCodes = \App\Models\Supplier::pluck('supplier_code')->toArray();
    return view('purchase.create', compact('items', 'supplierCodes', 'supplierCode'));
}


    /**
     * Store a newly created resource in storage.
     */
   
    
    public function store(StorePurchaseRequest $request)
    {
        // Validate the incoming request using StorePurchaseRequest
    
        // Retrieve validated data from the request
        $validatedData = $request->validated();
    
        // Process each item in the order
        foreach ($validatedData['item_name'] as $key => $item_id) {
            // Assuming $item_id is the ID of the selected item from the form
            $item = Item::findOrFail($item_id);
    
            // Create a new PurchaseOrder instance
            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->request_code = $validatedData['request_code'];
            $purchaseOrder->item_code = $item->item_code;
            $purchaseOrder->supplier_code = $validatedData['supplier_code'];
            $purchaseOrder->inquantity = $validatedData['inquantity']; 
            $purchaseOrder->order_quantity = $validatedData['item_orderquantity'][$key];
            $purchaseOrder->price = $validatedData['price'];
            $purchaseOrder->status = $validatedData['status'];
    
            // Save the PurchaseOrder instance
            $purchaseOrder->save();
        }
    
        // Redirect or return a response after successfully storing the data
        return redirect()->route('purchase_orders.index')->with('success', 'Purchase order has been created successfully.');
    }
    



}
