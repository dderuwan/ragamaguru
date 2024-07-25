<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyHoliday;
use App\Models\Holiday;

class LeaveController extends Controller
{

    public function show()
    {
        $weeklyHoliday = WeeklyHoliday::all();
        return view('humanResources.leave.weekly_holiday', compact('weeklyHoliday'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'weekly_leave' => 'required|array',
            'weekly_leave.*' => 'in:Friday,Saturday,Sunday',
        ]);

        $selected_days = implode(', ', $request->input('weekly_leave'));

        WeeklyHoliday::updateOrCreate(
            ['id' => 1], 
            ['dayname' => $selected_days]
        );
        return redirect()->route('weekly_holiday')->with('success', 'Weekly leave days updated successfully');

    }



    public function storeHolidays(Request $request)
    {
        $request->validate([
            'holiday_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'number_of_days' => 'required|integer|min:1',
        ]);

        Holiday::create([
            'holiday_name' => $request->holiday_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'no_of_days' => $request->number_of_days,
        ]);

        return redirect()->back()->with('success', 'Holiday added successfully.');
    }


        public function showHolidays()
        {
            $holiday_list = Holiday::all();
            return view('humanResources.leave.holiday', compact('holiday_list'));
        }

        public function manageHolidays()
        {
            $holiday_list = Holiday::all();
            return view('humanResources.leave.manage_holiday', compact('holiday_list'));
        }


        public function destroy($id)
        {
            $holiday = Holiday::find($id);
            if ($holiday) {
                $holiday->delete();
                notify()->success('Deleted successfully. ⚡️', 'Success');
                return redirect()->route('manage_holiday');
            } else {
                return redirect()->route('manage_holiday')->with('error', 'not found.');
            }
        }


 
    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('humanResources.leave.update_holiday', compact('holiday'));
    }

    public function updateHoliday(Request $request, $id)
    {
        $request->validate([
            'holiday_name' => 'required|string|max:255',
            'datefrom' => 'required|date',
            'dateto' => 'required|date',
            'number_of_days' => 'required|integer',
        ]);

        $holiday = Holiday::findOrFail($id);
        $holiday->holiday_name = $request->input('holiday_name');
        $holiday->start_date = $request->input('datefrom');
        $holiday->end_date = $request->input('dateto');
        $holiday->no_of_days = $request->input('number_of_days');
        $holiday->save();

        notify()->success('Holiday updated successfully. ⚡️', 'Success');
        return redirect()->route('holiday');
    }

}


