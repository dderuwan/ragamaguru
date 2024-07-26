<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AppointmentController extends Controller
{
    public function showCustomers()
    {
        $customers = Customer::all();
        return view('appointment.new_appointment', compact('customers'));
    }


    public function getCustomerDetails($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            return response()->json([
                'name' => $customer->name,
                'contact' => $customer->contact,
                'address' => $customer->address,
            ]);
        }

        return response()->json([], 404);
    }


   

    public function storeAppointments(Request $request)
    {
    
        $request->validate([
            'customer_id' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'event_type' => 'nullable|string|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);
    
        $start_date = $request->start_date;
        $end_date = $request->end_date ? $request->end_date : null;
    
        // Convert times to 12-hour format with AM/PM
        $start_time = $request->start_time ? (new \DateTime($request->start_time))->format('h:i A') : null;
        $end_time = $request->end_time ? (new \DateTime($request->end_time))->format('h:i A') : null;
    
        Appointment::create([
            'customer_id' => $request->customer_id,
            'note' => $request->note,
            'event_type' => $request->event_type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
    
        return redirect()->back()->with('success', 'Appointment added successfully.');
    }
    
}
