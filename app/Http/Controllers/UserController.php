<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index()
    {
        $user_list = User::all();
        return view('setting.user.add_user', compact('user_list'));
    }


        public function store(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'about' => 'nullable|string|max:255',
                'user_type' => 'required|string|in:admin,user',
                'status' => 'required|string|in:active,inactive',
            ]);
        
            // Handle file upload
            $image = null;
            if ($request->hasFile('image')) {
                $image = file_get_contents($request->file('image')->getRealPath());
            }
        
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->image = $image;
            $user->about = $request->about;
            $user->user_type = $request->user_type;
            $user->status = $request->status;
            $user->save();
        
            return redirect()->back()->with('success', 'User details saved successfully.');
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error saving user: ' . $e->getMessage());
         
            // Return an error message to the user
            return redirect()->back()->with('error', 'Failed to save the user details.');
        }
    }

}
