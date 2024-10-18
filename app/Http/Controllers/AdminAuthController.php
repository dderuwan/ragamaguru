<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login'); // Create a separate login view for admins
    }

    public function login(Request $request)
    {
        $credentials = $request->only('contact', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard'); 
        }

        return back()->withErrors([
            'contact' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
