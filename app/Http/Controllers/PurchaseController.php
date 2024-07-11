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
        return view('purchase.purchaseOrder', compact('purchase_list'));
    }

    
    public function viewDetails()
    {
        $purchase_list = Purchase::all();
        return view('purchase.order_request_details', compact('purchase_list'));
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
        $validatedData = $request->validated();

        try {
            foreach ($validatedData['item_name'] as $key => $value) {
                $purchase = new Purchase();
                $purchase->item_code = $validatedData['item_name'][$key];
                $purchase->supplier_code = $validatedData['supplier_code'][$key];
                $purchase->inquantity = $validatedData['inquantity'][$key] ?? null;
                $purchase->order_quantity = $validatedData['orderquantity'][$key];
                $purchase->status = 0; 
                $purchase->date = now(); 

                $purchase->save();
            }

            
            return redirect()->route('purchase.purchaseOrder')->with('success', 'Purchase orders added successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions if necessary
            return redirect()->back()->with('error', 'Failed to add purchase orders. Please try again.');
        }
    }




    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        if ($purchase) {
            $purchase->delete();
            notify()->success('Request Order deleted successfully. ⚡️', 'Success');
            return redirect()->route('purchase.purchaseOrder');
        } else {
            return redirect()->route('purchase.purchaseOrder')->with('error', 'Item not found.');
        }
    }


}
