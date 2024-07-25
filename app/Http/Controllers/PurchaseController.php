<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePurchaseRequest;
use App\Models\Purchase; 
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{


    public function index()
    {
        $purchase_list = DB::table('purchase_order as po')
            ->select('po.id', 'po.request_code', 'po.supplier_code', 'po.date', 'po.status')
            ->join(DB::raw('(select max(id) as id from purchase_order group by request_code) as latest_po'), function($join) {
                $join->on('po.id', '=', 'latest_po.id');
            })
            ->get();
    
        return view('purchase.purchaseOrder', compact('purchase_list'));
    }

    
    public function purchaseOrder()
    {
        $purchase_list = Purchase::all();
        return view('purchase.purchaseOrder', compact('purchase_list'));
    }

    public function show($request_code)
    {
        try {
            $items = Purchase::where('request_code', $request_code)->get();
            
            $purchase = Purchase::where('request_code', $request_code)->firstOrFail();
    
            $data = [
                'items' => $items,
                'purchase' => $purchase,
                'request_code' => $request_code,
            ];
    
            return view('purchase.order_request_details', $data);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }


    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();

        return redirect()->route('purchase.purchaseOrder')->with('success', 'Purchase order deleted successfully.');
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
            DB::beginTransaction();
    
            
            $requestCode = 'ORDREQ-' . Str::random(10);
    
            $purchases = [];
    
            foreach ($validatedData['item_name'] as $key => $value) {
                $purchase = [
                    'item_code' => $value,
                    'supplier_code' => $validatedData['supplier_code'],
                    'inquantity' => $validatedData['inquantity'][$key] ?? null,
                    'order_quantity' => $validatedData['orderquantity'][$key],
                    'status' => 0, 
                    'date' => now(), 
                    'request_code' => $requestCode, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
    
                $purchases[] = $purchase;
            }
    
            DB::table('purchase_order')->insert($purchases);
    
            DB::commit();
    
            return redirect()->route('purchase.purchaseOrder')->with('success', 'Purchase orders added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding purchase order requests: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add purchase orders. Please try again.');
        }
    }

     



}
