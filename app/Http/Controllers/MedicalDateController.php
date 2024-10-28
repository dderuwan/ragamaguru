<?php

namespace App\Http\Controllers;

use App\Models\MedicalDate;
use Illuminate\Http\Request;

class MedicalDateController extends Controller
{
    public function index()
    {
        // Fetch all medical dates and their statuses
        $dates = MedicalDate::all()->keyBy('day');  // Using 'day' as key (e.g., Monday, Tuesday)

        return view('setting.medical.medical_dates', compact('dates'));
    }

    public function toggleDate(Request $request)
    {
        $day = $request->input('day');
        
        // Find or create a record for the given day  
        $medicalDate = MedicalDate::firstOrCreate(['day' => $day]);

        // Toggle the status (0 = off, 1 = on)
        $medicalDate->status = !$medicalDate->status;
        $medicalDate->save();

        return response()->json(['status' => $medicalDate->status]);
    }
}
