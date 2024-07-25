<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier; 

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier_list = Supplier::all();
        return view('supplier.index', compact('supplier_list'));
    }

    public function create()
    {
        return view('supplier.create');
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        
        $existingSupplier = Supplier::where('contact', $request->contact)->first();

        if ($existingSupplier) {
            return redirect()->back()->with([
                'error' => 'This Supplier Already Registered.',
            ]);
        } else {

            $supplier = Supplier::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'address' => $request->address,
                'supplier_type' => 1,
                'registered_time' => now(),
            ]);

            

            return redirect()->route('allsuppliers')->with([
                'success' => 'Supplier added successfully',
            ]);
        }
    }



    public function edit(Supplier $supplier, $id)
    {

        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplierId = Supplier::find($request->id);
        if ($supplierId) {
            $updatedData = $request->all();
            $supplierId->update($updatedData);
            return redirect()->route('allsuppliers')->with('success', 'Supplier updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Supplier not found.');
        }
    }

  


     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->delete();
            //return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
            notify()->success('Supplier deleted successfully. ⚡️', 'Success');
            return redirect()->route('supplier.index');
        } else {
            return redirect()->route('supplier.index')->with('error', 'Supplier not found.');
        }
    }

}
