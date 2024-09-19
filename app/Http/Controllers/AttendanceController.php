<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Commission;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function show()
    {
        $attendance_list = Attendance::with('user')->get();
        $employees = User::all();
        return view('humanResources.attendance.attendance_list', compact('attendance_list', 'employees'));
    }

    public function attendanceReport()
    {
        $attendance_list = Attendance::with('user')->get();
        $employees = User::all();
        return view('humanResources.attendance.attendance_reports', compact('attendance_list', 'employees'));
    }


    

    public function update(Request $request, $id)
    {
        $request->validate([
            'emp_id' => 'required',
            'date' => 'required|date',
            'checkin' => 'nullable',
            'checkout' => 'nullable',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->emp_id = $request->input('emp_id');
        $attendance->date = $request->input('date');
        $attendance->sign_in = $request->input('checkin');
        $attendance->sign_out = $request->input('checkout');

        // Calculate stayed time
        if ($request->input('checkin') && $request->input('checkout')) {
            $checkin = Carbon::createFromFormat('h:i:s A', $request->input('checkin'));
            $checkout = Carbon::createFromFormat('h:i:s A', $request->input('checkout'));
            $stayedTime = $checkout->diff($checkin)->format('%H:%I:%S');
            $attendance->stayed_time = $stayedTime;
        } else {
            $attendance->stayed_time = null;
        }

        $attendance->save();

        return redirect()->route('attendance_list')->with('success', 'Attendance updated successfully');
        return redirect()->route('attendance_list');
    }

        
    

    public function checkIn(Request $request)
    {
        
        $request->validate([
            'emp_id' => 'required',
        ]);
        //dd($request);
        $attendance = new Attendance();
        $attendance->emp_id = $request->input('emp_id');
        $attendance->date = $request->input('date', now()->toDateString());       
        $attendance->sign_in = $request->input('sign_in', now()->format('h:i:s A'));      
        $attendance->save();
    
        return redirect()->back()->with('success', 'Check-in recorded successfully');
    }

    
    

    public function checkOut(Request $request)
{
    try {

        //dd($request);
        // Validate request
        $request->validate([
            'employee_id' => 'required',
        ]);
        //
        // Get the current time
        $currentTime = now()->format('h:i:s A');
        
        // Find the latest attendance record for the employee
        $attendance = Attendance::where('emp_id', $request->input('employee_id'))
            ->whereNull('sign_out') // Ensure we are updating the correct record (no previous check-out)
            ->latest() // Get the most recent record
            ->first();

        if ($attendance) {
            // Update the check-out time
            $attendance->sign_out = $currentTime;
            
            // Calculate the stayed time
            $signInTime = \Carbon\Carbon::createFromFormat('h:i:s A', $attendance->sign_in);
            $signOutTime = \Carbon\Carbon::createFromFormat('h:i:s A', $currentTime);
            $duration = $signInTime->diff($signOutTime); // Calculate stayed time in minutes
            
            $hours = $duration->h;
            $minutes = $duration->i;
            $stayedTime = "{$hours} : {$minutes} ";
            // Update the stayed time field
            $attendance->stayed_time = $stayedTime ;
            $attendance->save();

            return redirect()->back()->with('success', 'Check-in recorded successfully');
        } else {
            return redirect()->back()->with('success', 'No check-in record found for this employee');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('success', 'An error occurred');
    }
}

    


    
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if ($attendance) {
            $attendance->delete();
            return redirect()->route('manage_attendance_list')->with('success', 'deleted successfully');
        } else {
            return redirect()->route('manage_attendance_list')->with('error', 'not found.');
        }
    }


    public function commissionsList()
    {
        $commission = Commission::with('employee')->get();
        return view('humanResources.commissions', compact('commission'));
    }

    public function destroycommission($id)
    {
        $attendance = Commission::find($id);
        if ($attendance) {
            $attendance->delete();
            return redirect()->route('commissions-list')->with('success', 'deleted successfully');
        } else {
            return redirect()->route('commissions-list')->with('error', 'not found.');
        }
    }


    public function editcommission($id)
    {
        $commission = Commission::findOrFail($id);

        return view('humanResources.editcommission', compact('commission'));
    }

    

    public function updatecommission(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'employee_id' => 'required|exists:employee,id', // Ensure employee exists in the employee table
            'order_id' => 'required|string|max:255',
            'date' => 'required|date',
            'commission_amount' => 'required|numeric',
        ]);

        // Find the specific commission by ID
        $commission = Commission::findOrFail($id);

        // Update the commission details with the new data
        $commission->update([
            'employee_id' => $request->employee_id,
            'order_id' => $request->order_id,
            'date' => $request->date,
            'commission_amount' => $request->commission_amount,
        ]);

        // Redirect back with a success message
        return redirect()->route('commissions-list')->with('success', 'Commission updated successfully');
    }



    


}
