<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
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
        $supplierCodes = Supplier::pluck('supplier_code')->toArray(); 
        return response()->json($supplierCodes);
    }


    public function store(StoreItemRequest $request)
    {
        
        $validatedData = $request->validated();
    
        try {
            
            foreach ($validatedData['item_name'] as $key => $value) {
                $item = new Item();
                $item->name = $validatedData['item_name'][$key];
                $item->description = $validatedData['item_description'][$key];
                $item->quantity = !empty($validatedData['item_quantity'][$key]) ? $validatedData['item_quantity'][$key] : 0;
                $item->price = $validatedData['item_price'][$key];
                $item->supplier_code = $validatedData['supplier_code']; 
    
                
                if ($request->hasFile('item_image') && $request->file('item_image')[$key]->isValid()) {
                    $item->image = $request->file('item_image')[$key]->store('items', 'public');
                }
    
                $item->save();
            }
    
           
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


        
        public function edit(Item $item, $id)
        {

            $item = Item::find($id);
            return view('item.edit', compact('item'));
        }
  
   
            /**
         * Update the specified resource in storage.
         */
        public function update(UpdateItemRequest $request, $id)
        {
            $item = Item::find($id);

            if ($item) {
                $item->supplier_code = $request->supplier_code;
                $item->name = $request->item_name;
                $item->description = $request->item_description;
                $item->quantity = $request->item_quantity;
                $item->price = $request->item_price;

                // Handle optional image upload
                if ($request->hasFile('item_image')) {
                    $request->validate([
                        'item_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                    $image = $request->file('item_image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public', $imageName);
                    $item->image = $imageName;
                }

                $item->save();

                return redirect()->route('item.index')->with('success', 'Item updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Item not found.');
            }
        }


    
}
