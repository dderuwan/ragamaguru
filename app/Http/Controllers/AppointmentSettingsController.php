<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use App\Models\BookingInfo;
use App\Models\MedicalAppointmentTypes;
use App\Models\MedicalBookingInfo;
use Illuminate\Http\Request;

class AppointmentSettingsController extends Controller
{
    public function index()
    {
        $type_list = AppointmentType::all();
        $mtype_list = MedicalAppointmentTypes::all();
        return view('setting.appointment.type_list', compact('type_list','mtype_list'));
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
            'for_whom' => 'required|array',
            'for_whom.*' => 'in:local,international',
        ]);

        $forWhom = implode(',', $request->input('for_whom'));

        $appointmentType = new AppointmentType();
        $appointmentType->type = $validatedData['type'];
        $appointmentType->price = $validatedData['price'];
        $appointmentType->status = $validatedData['status'];
        $appointmentType->for_whom = $forWhom;

        $appointmentType->save();

        notify()->success('Appointment type added successfully.. ⚡️', 'Success');
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
            'for_whom' => 'required|array',
            'for_whom.*' => 'in:local,international',
        ]);
        
        $forWhom = implode(',', $request->input('for_whom'));

        $type = AppointmentType::findOrFail($id);
        $type->type = $validatedData['type'];
        $type->price = $validatedData['price'];
        $type->status = $validatedData['status'];
        $type->for_whom = $forWhom;
        $type->save();

        notify()->success('Appointment type updated successfully.. ⚡️', 'Success');
        return redirect()->route('apType.index');
    }




    public function destroy($id)
    {
        $user = AppointmentType::findOrFail($id);
        $user->delete();

        notify()->success('Appointment type deleted successfully.. ⚡️', 'Success');
        return redirect()->back();
    }


    public function addBookingInfo()
    {
        $bookingInfo = BookingInfo::first();
        $medicalBookingInfo = MedicalBookingInfo::first();
        return view('setting.appointment.add_booking_info', compact('bookingInfo','medicalBookingInfo'));
    }

    public function saveBookingInfo(Request $request)
    {
        // Validate the input
        $request->validate([
            'booking_info' => 'required|string',
        ]);

        // Retrieve the first (and only) record or create a new one
        $bookingInfo = BookingInfo::first() ?: new BookingInfo();

        // Update the info_text column with the new value
        $bookingInfo->info_text = $request->booking_info;

        // Save the information (insert or update)
        if ($bookingInfo->save()) {
            notify()->success('Booking information saved successfully. ⚡️', 'Success');
            return redirect()->back();
        } else {
            notify()->error('Failed to save booking information. ⚡️', 'Error');
            return redirect()->back();
        }
    }



    //medical

    public function mcreate()
    {
        return view('setting.appointment.add_m_type');
    }

    public function mstore(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'for_whom' => 'required|array',
            'for_whom.*' => 'in:local,international',
        ]);

        $forWhom = implode(',', $request->input('for_whom'));

        $appointmentType = new MedicalAppointmentTypes();
        $appointmentType->type = $validatedData['type'];
        $appointmentType->price = $validatedData['price'];
        $appointmentType->status = $validatedData['status'];
        $appointmentType->for_whom = $forWhom;

        $appointmentType->save();

        notify()->success('Medical appointment type added successfully.. ⚡️', 'Success');
        return redirect()->back();
    }


    public function medit($id)
    {
        $type = MedicalAppointmentTypes::findOrFail($id);
        return view('setting.appointment.edit_m_type', compact('type'));
    }

    public function mupdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'for_whom' => 'required|array',
            'for_whom.*' => 'in:local,international',
        ]);
        
        $forWhom = implode(',', $request->input('for_whom'));

        $type = MedicalAppointmentTypes::findOrFail($id);
        $type->type = $validatedData['type'];
        $type->price = $validatedData['price'];
        $type->status = $validatedData['status'];
        $type->for_whom = $forWhom;
        $type->save();

        notify()->success('Appointment type updated successfully.. ⚡️', 'Success');
        return redirect()->route('apType.index');
    }




    public function mdestroy($id)
    {
        $user = MedicalAppointmentTypes::findOrFail($id);
        $user->delete();

        notify()->success('Appointment type deleted successfully.. ⚡️', 'Success');
        return redirect()->back();
    }


    public function saveMedicalBookingInfo(Request $request)
    {
        // Validate the input
        $request->validate([
            'booking_info' => 'required|string',
        ]);

        // Retrieve the first (and only) record or create a new one
        $bookingInfo = MedicalBookingInfo::first() ?: new MedicalBookingInfo();

        // Update the info_text column with the new value
        $bookingInfo->info_text = $request->booking_info;

        // Save the information (insert or update)
        if ($bookingInfo->save()) {
            notify()->success('Booking information saved successfully. ⚡️', 'Success');
            return redirect()->back();
        } else {
            notify()->error('Failed to save booking information. ⚡️', 'Error');
            return redirect()->back();
        }
    }


}
