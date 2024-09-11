<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use Illuminate\Http\Request;

class AppointmentSettingsController extends Controller
{
    public function index()
    {
        $type_list = AppointmentType::all();
        return view('setting.appointment.type_list', compact('type_list'));
    }

    public function create()
    {
        return view('setting.appointment.add_type');
    }

    
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $appointmentType = new AppointmentType();
        $appointmentType->type = $validatedData['type'];
        $appointmentType->price = $validatedData['price'];
        $appointmentType->status = $validatedData['status']; 

        $appointmentType->save(); 

        notify()->success('Appointment type added successfully.. ⚡️', 'succcess');
        return redirect()->back();
    }


    public function edit($id)
{
    $type = AppointmentType::findOrFail($id);
    return view('setting.appointment.edit_type', compact('type'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'type' => 'required|string|max:255',
        'price' => 'required|numeric',
        'status' => 'required|boolean',
    ]);

    $type = AppointmentType::findOrFail($id);
    $type->type = $validatedData['type'];
    $type->price = $validatedData['price'];
    $type->status = $validatedData['status'];
    $type->save(); 

    notify()->success('Appointment type updated successfully.. ⚡️', 'succcess');
    return redirect()->route('apType.index');
}




    public function destroy($id)
    {
        $user = AppointmentType::findOrFail($id);
        $user->delete();

        notify()->success('Appointment type deleted successfully.. ⚡️', 'succcess');
        return redirect()->back();
    }
}
