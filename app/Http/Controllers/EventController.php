<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $event_list = Event::all();
        return view('setting.newevents.event_index', compact('event_list'));
    }

    public function create()
    {
        return view('setting.newevents.event_create');
    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|array',                 // Ensure that 'date' is an array
            'starttime' => 'required|string',
            'endtime' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->location = $request->location;
        $event->dates = json_encode($request->date);
        $event->start_time = $request->starttime;
        $event->end_time = $request->endtime;
        $event->status = $request->status;
        $event->save();

        notify()->success('Event has been created successfully. ⚡️', 'Success');
        return redirect()->route('event.index');
    }


    public function edit($id)
    {
        $event = Event::findOrFail($id); 

        return view('setting.newevents.event_edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|array',  
            'starttime' => 'required|string',
            'endtime' => 'required|string',
            'status' => 'required|boolean',
        ]);
    
        $event = Event::findOrFail($id); 
        $event->name = $request->name;
        $event->location = $request->location;
        $event->dates = json_encode($request->date);  
        $event->start_time = $request->starttime;
        $event->end_time = $request->endtime;
        $event->status = $request->status;
        $event->save();
    
        notify()->success('Event has been updated successfully.⚡️', 'Success');
        return redirect()->route('event.index');
    }




    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();              

        notify()->success('Event deleted successfully.⚡️', 'Success');
        return redirect()->back();
    }

   
}
