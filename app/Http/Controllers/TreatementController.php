<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Treatement;
use Illuminate\Http\Request;

class TreatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Treatements =Treatement::paginate(10);
        return view('Treatement.index', [
            'Treatements' => $Treatements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Treatement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        Treatement::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status == true ? 1:0,
        ]);

        return redirect('/Treatement')->with('status','Treatements Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Treatement $Treatement)
    {
        return view(' Treatement.show', compact('Treatement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Treatement $Treatement)
    {
        return view(' Treatement.edit', compact('Treatement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'status' => 'required|boolean',
    ]);

    $treatment = Treatement::findOrFail($id);
    $treatment->update([
        'name' => $request->name,
        'price' => $request->price,
        'status' => $request->status,
    ]);

    return redirect()->route('Treatement.index')->with('status', 'Treatment updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatement $Treatement)
    {
        $Treatement->delete();
        return redirect('/Treatement')->with('status','Treatement Deleted Successfully');
    }
}
