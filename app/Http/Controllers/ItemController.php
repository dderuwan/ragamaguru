<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreItemRequest;
use App\Models\Item; 
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemController extends Controller
{


    public function index()
    {
        $item_list = Item::all();
        return view('item.index', compact('item_list'));
    }


    public function create()
    {
        $suppliers = Supplier::all();
        return view('item.create', compact('suppliers'));
    }

    public function getSupplierCodes()
    {
        $supplierCodes = Supplier::pluck('supplier_code')->toArray(); // Fetch supplier_code as an array
        return response()->json($supplierCodes);
    }


    public function store(StoreItemRequest $request)
    {
        

        try {
            $request->validate([
                'supplier_code' => 'required',
                'items.*.item_name' => 'required',
                'items.*.item_description' => 'required',
                'items.*.unit_price' => 'nullable|numeric',
                'items.*.image' => 'nullable|image',
            ]);

            foreach ($request->items as $itemData) {
                $item = new Item();
                $item->item_code = $this->generateItemCode();
                $item->name = $itemData['item_name'];
                $item->description = $itemData['item_description'];
                $item->price = $itemData['unit_price'];
                $item->quantity = $itemData['quentity'];
                $item->supplier_code = $request->supplier_code;

                if (isset($itemData['image'])) {
                    $file = $itemData['image'];
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/items'), $filename);
                    $item->image = $filename;
                }

                $item->save();
            }

            return redirect()->route('item.index')->with('success', 'Items added successfully!');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    private function generateItemCode()
    {
        return 'ITEM-' . time() . '-' . rand(1000, 9999);
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

    public function edit($id)
    {
        try {
            $item = Item::findOrFail($id);
            $suppliers = Supplier::all(); // Get all suppliers
            return view('item.edit', compact('item', 'suppliers'));
        } catch (ModelNotFoundException $e) {
            return back()->withError('Item not found')->withInput();
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    // Update the specified item in storage
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'item_code' => 'required|unique:item,item_code,'.$id,
                'item_name' => 'required',
                'item_description' => 'required',
                'unit_price' => 'nullable|numeric',
                'supplier_code' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $item = Item::findOrFail($id);
            $item->item_code = $request->item_code;
            $item->name = $request->item_name;
            $item->description = $request->item_description;
            $item->price = $request->unit_price;
            $item->supplier_code = $request->supplier_code;

            if ($request->hasFile('image')) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/items'), $imageName);
                $item->image = $imageName;
            }

            $item->save();

            return redirect()->route('item.index')->with('success', 'Item updated successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->withError('Item not found')->withInput();
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
    
}
