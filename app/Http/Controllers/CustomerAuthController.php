<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.customer-login'); // Create a separate login view for customers
    }

    public function login(Request $request)
    {
        // Validate the login form inputs
        $credentials = $request->validate([
            'contact' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to log the customer in using the 'customer' guard
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Optional: Store additional customer data in the session
            $customer = Auth::guard('customer')->user();
            session(['customer_id' => $customer->id, 'customer_name' => $customer->name]);

            // Flash success message to the session
            return redirect()->route('home')->with('success', 'Login successful. Welcome back!');
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors([
            'contact' => 'The provided credentials do not match our records.',
        ])->withInput(); // Retain the old input for the form
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['customer_id', 'customer_name']);
        Auth::guard('customer')->logout();
        return redirect('/customer/login');
    }
}
