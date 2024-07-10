<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreItemRequest;
use App\Models\Item; 
use Illuminate\Http\Request;

class ItemController extends Controller
{


    public function index()
    {
        $item_list = Item::all();
        return view('item.index', compact('item_list'));
    }


    public function create()
    {
        return view('item.create');
    }

    public function getSupplierCodes()
    {
        $supplierCodes = Supplier::pluck('supplier_code')->toArray(); // Fetch supplier_code as an array
        return response()->json($supplierCodes);
    }


    public function store(StoreItemRequest $request)
    {
        // Validate the incoming request data through StoreItemRequest
        $validatedData = $request->validated();
    
        try {
            // Loop through each item detail to store in the database
            foreach ($validatedData['item_name'] as $key => $value) {
                $item = new Item();
                $item->name = $validatedData['item_name'][$key];
                $item->description = $validatedData['item_description'][$key];
                $item->quantity = $validatedData['item_quantity'][$key];
                $item->price = $validatedData['item_price'][$key];
                $item->supplier_code = $validatedData['supplier_code']; // Single supplier code for all items
    
                // Handle image upload if required
                if ($request->hasFile('item_image') && $request->file('item_image')[$key]->isValid()) {
                    $item->image = $request->file('item_image')[$key]->store('items', 'public');
                }
    
                $item->save();
            }
    
            // Redirect back with success message
            return redirect()->route('item.index')->with('success', 'Items added successfully!');
        } catch (\Exception $e) {
            // Handle any exceptions if necessary
            return redirect()->back()->with('error', 'Failed to add items. Please try again.');
        }
    }
    

     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();
            notify()->success('Item deleted successfully. ⚡️', 'Success');
            return redirect()->route('item.index');
        } else {
            return redirect()->route('item.index')->with('error', 'Item not found.');
        }
    }
    
}
