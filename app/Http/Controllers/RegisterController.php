<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegisterDetailsRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(StoreRegisterDetailsRequest $request)
    {
        $validatedData = $request->validated();

        $existingCustomer = Customer::where('contact', $validatedData['contact'])->first();

        if ($existingCustomer) {
            return redirect()->back()->with([
                'error' => 'This contact is already registered. Check your SMS for login details sent by Ragama Guru system.',
            ]);
        } else {

        // Store the customer data
        $customer = new Customer();
        $customer->name = $validatedData['full_name'];
        $customer->contact = $validatedData['contact'];
        $customer->address = $validatedData['address'];
        $customer->country_type_id = $validatedData['country_type'];
        $customer->password = bcrypt($validatedData['password']);
        $customer->customer_type_id = 1;
        $customer->isVerified = false;
        $customer->registered_time = now();
        $customer->save();

        return redirect()->route('register.index')->with('success', 'Customer registered successfully!');

        }
    }
}
