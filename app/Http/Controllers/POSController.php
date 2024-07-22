<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Carbon; 
use PDF;

class POSController extends Controller
{
    public function showHomepage()
    {
        $items = Item::all();
        $customers = Customer::all();
        $orders = Order::all();
        $today = Carbon::today()->toDateString();
        return view('POS.homepage', compact('items','customers','orders','today'));

    }

    public function customerstore(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number_1' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $otp = rand(100000, 999999);
        
        try {
            $customer = new Customer();
            $customer->name = $validatedData['name'];
            $customer->contact = $validatedData['contact_number_1'];
            $customer->address = $validatedData['address'];
            $customer->otp = $otp;
            $customer->isVerified = false;
            $customer->user_id = 1;
            $customer->customer_type = 1;
            $customer->registered_time = now();
            $customer->save();
            
            notify()->success('Customer Registerd successfully. ⚡️', 'Success');
            return redirect()->route('pospage')->with('success', 'Customer Registerd successfully.');

        } catch (ModelNotFoundException $e) {

            notify()->success('Customer not Found. ⚡️', 'Fail');
            return redirect()->route('pospage')->withErrors(['error' => 'Customer not found.']);
        } catch (Exception $e) {
            
            notify()->success('Failed to update Customer. ⚡️', 'Fail');
            return redirect()->route('pospage')->withErrors(['error' => 'Failed to update Customer.']);
        }
    }

    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(),[
            'customer_code' => 'required',
            'items' => 'required|array',
            'item_code.*' => 'required',
            'item_name.*' => 'required',
            'quantity.*' => 'required|numeric',
            'total.*' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'vat' => 'nullable|numeric',
            'payment_type'=>'required|string',
            'paid_amount' => 'required|numeric',
            'change' => 'required|numeric',
            'grand_total' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //dd($request);


        $pos = Order::create([
            'order_code' => $this->generateOrderCode(),
            'customer_code' => $request->customer_code,
            'date' => Carbon::today(),
            'total_cost_payment' => $request->grand_total,
            'discount' => $request->discount,
            'vat' => $request->vat,
            'paid_amount' => $request->paid_amount,
            'change' => $request->change,
            'payment_type' =>$request->payment_type,
        ]);

        foreach ($request->items as $item) {
            OrderItems::create([
                'pos_id' => $pos->id,
                'item_code' => $item['item_code'],
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'total_cost' => $item['total'],
            ]);
        } 


       
        $order = Order::with('items')->find($pos->id);

        // Generate the PDF and save it to a temporary location
        $pdf = PDF::loadView('bill', compact('order'));
        $filePath = storage_path('app/public/orders/order_bill_' . $order->id . '.pdf');
        $pdf->save($filePath);

        // Notify and redirect
        notify()->success('Order created successfully. ⚡️', 'Success');
        return redirect()->route('pospage')->with([
            'success' => 'Order created successfully.',
            'order_id' => $order->id,
            'downloadLink' => $filePath
        ]);
    
    }

    private function generateOrderCode()
    {
        return 'ORD-'  . rand(1000, 9999);
    }

     // Display the specified order request
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('POS.show', compact('order'));
    }

    // Remove the specified order request from storage
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        notify()->success('Requested Order deleted successfully. ⚡️', 'Success');
        return redirect()->route('pospage')->with('success', 'Requested Order deleted successfully.');
    }

    public function downloadOrderPdf($fileName)
{
    $filePath = 'public/orders/' . $fileName;

    if (Storage::exists($filePath)) {
        return Storage::download($filePath);
    }

    return redirect()->route('pospage')->with('error', 'The requested file does not exist.');
}
}
