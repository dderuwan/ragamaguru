<?php

namespace App\Http\Controllers;

use App\Models\MedicalReason;
use Illuminate\Http\Request;

class MedicalReasonController extends Controller
{
    public function index()
    {
        $reason_list = MedicalReason::all();
        return view('setting.medical.medical_reason_index', compact('reason_list'));
    }

    public function create()
    {
        return view('setting.medical.medical_reason_create');
    }


    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'reason' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $medicalReason = new MedicalReason();
        $medicalReason->reason = $validatedData['reason'];
        $medicalReason->status = $validatedData['status'];

        $medicalReason->save();

        notify()->success('Medical Reason added successfully.. ⚡️', 'Success');
        return redirect()->back();
    }


    public function edit($id)
    {
        $reason = MedicalReason::findOrFail($id);
        return view('setting.medical.medical_reason_edit', compact('reason'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reason' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $reason = MedicalReason::findOrFail($id);
        $reason->reason = $validatedData['reason'];
        $reason->status = $validatedData['status'];
        $reason->save();

        notify()->success('Medical Reason updated successfully.. ⚡️', 'Success');
        return redirect()->route('reason.index');
    }




    public function destroy($id)
    {
        $reason = MedicalReason::findOrFail($id);
        $reason->delete();

        notify()->success('MedicalReason deleted successfully.. ⚡️', 'Success');
        return redirect()->back();
    }

}
