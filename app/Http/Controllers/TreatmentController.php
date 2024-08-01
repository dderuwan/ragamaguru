<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Treatments =Treatment::paginate(10);
        return view('Treatment.index', [
            'Treatments' => $Treatments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Treatment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'status' => 'nullable',
        ]);

        Treatment::create([
            'name' => $request->name,

            'status' => $request->status == true ? 1:0,
        ]);
        notify()->success(' Treatment Created successfully. ⚡️', 'Success');
        return redirect('/Treatment')->with('status','Treatments Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $Treatment)
    {
        return view('Treatment.show', compact('Treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Treatment $Treatment,$id)
    {
        $Treatment = Treatment::find($id);
        return view('Treatment.edit', compact('Treatment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',

        'status' => 'required|boolean',
    ]);

    $treatment = Treatment::findOrFail($request->id);
    $treatment->update([
        'name' => $request->name,

        'status' => $request->status,
    ]);

    return redirect()->route('Treatment')->with('status', 'Treatment updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Treatment = Treatment::find($id);
        if ($Treatment) {
            $Treatment->delete();
            //return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
            notify()->success(' Treatment deleted successfully. ⚡️', 'Success');
            return redirect()->route('Treatment');
        } else {
            return redirect()->route('Treatment')->with('error', 'Treatment not found.');
        }
}
}
