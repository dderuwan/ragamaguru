<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_list = Customer::all();
        return view('customer.index', compact('customer_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $otp = rand(100000, 999999);

        $existingCustomer = Customer::where('contact', $request->contact)->first();

        if ($existingCustomer) {
            return redirect()->back()->with([
                'error' => 'This Customer Already Registered.',
            ]);
        } else {

            $customer = Customer::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'address' => $request->address,
                'otp' => $otp,
                'isVerified' => false,
                'user_id' => 1,
                'customer_type' => 1,
                'registered_time' => now(),
            ]);

            return redirect()->back()->with([
                'success' => 'Customer created successfully',
                'contactNo' => $customer->contact
            ]);
        }
    }


    public function verify(Request $request)
    {

        $customer = Customer::where('contact', $request->addedContact)
            ->where('otp', $request->otp)
            ->first();

        if ($customer) {
            $customer->isVerified = true;
            $customer->save();

            return redirect()->back()->with('success', 'Customer verified successfully.');
        } else {
            return redirect()->back()->with([
                'otp' => 'Invalid OTP. Please try again.',
                'contactNo' => $request->addedContact
            ]);
        }
    }


    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, $id)
    {

        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customerId = Customer::find($request->id);
        if ($customerId) {
            $updatedData = $request->all();
            $customerId->update($updatedData);
            return redirect()->back()->with('success', 'Customer updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            //return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
            notify()->success('Customer deleted successfully. ⚡️', 'Success');
            return redirect()->route('customer.index');
        } else {
            return redirect()->route('customer.index')->with('error', 'Customer not found.');
        }
    }


    public function reverify(Request $request){
        
        $customer = Customer::where('contact', $request->addedContact)
            ->where('otp', $request->otp)
            ->first();

        if ($customer) {
            $customer->isVerified = true;
            $customer->save();

            notify()->success('Customer verified successfully. ⚡️', 'Success');
            return redirect()->route('customer.index');
        } else {
            notify()->error('Invalid details.. Please try again. ⚡️', 'Error');
            return redirect()->route('customer.index');
        }
    }


    public function resendOtp(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|exists:customer,id',
        ]);

        $customer = Customer::findOrFail($request->customer_id);

        $otp = rand(100000, 999999);

        $customer->otp = $otp;
        $customer->save();

        return response()->json(['success' => 'OTP has been resent.']);
        
    }

    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'newAddress' => 'required|string|max:255',
        ]);

        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'User not found');
        }

        $customer->address = $request->input('newAddress');
        $customer->save();

        return redirect()->back()->with('success', 'Address updated successfully');
    }
}
