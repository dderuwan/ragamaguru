<?php

namespace App\Http\Controllers;

use App\Models\BlockedDate;
use Illuminate\Http\Request;

class BlockedDateController extends Controller
{

    public function index(){
        $blockedDates = BlockedDate::pluck('date')->toArray();
        return view('setting.appointment.block_dates', compact('blockedDates'));
    }

    public function blockDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        BlockedDate::firstOrCreate(['date' => $request->date]);

        return response()->json(['success' => true]);
    }

    public function unblockDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);
   
        BlockedDate::where('date', $request->date)->delete();

        return response()->json(['success' => true]);
    }
}
