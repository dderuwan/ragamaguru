<?php

namespace App\Http\Controllers;

use App\Models\ApNumbers;
use App\Models\Appointments;
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
use App\Models\Bookings;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('appointment.index');
    }


    public function getAppointmentsByDate($date)
    {
        $appointments = Appointments::whereDate('date', $date)
            ->with('customer', 'apNumber')
            ->get();

        return response()->json($appointments->map(function ($appointment) {
            return [
                'id' => $appointment->id,
                'ap_number' => $appointment->apNumber->number ?? 'N/A',
                'customer_name' => $appointment->customer->name ?? 'N/A',
                'contact' => $appointment->customer->contact ?? 'N/A',
                'visit_day' => $appointment->visit_day,
            ];
        }));
    }


    public function create(Request $request, $id)
    {

        $customer = Customer::find($id);

        if ($customer) {

            $appointment_numbers = ApNumbers::all();
            $today = Carbon::today()->format('Y-m-d');

            $todayAppointments = Appointments::whereDate('date', $today)->pluck('ap_numbers_id')->toArray();

            $latestAppointment = Appointments::where('customer_id', $id)->latest()->first();

            $onlinebooking = Bookings::where('customer_id', $id)->latest()->first();

            $customerType = CustomerType::where('id', $customer->customer_type_id)->latest()->first();

            $lastVisitDay = null;
            $firstVisit = null;
            $secondVisit = null;
            $thirdVisit = null;

            if ($latestAppointment) {
                $lastVisitDay = $latestAppointment->visit_day;
                if ($lastVisitDay == '1') {
                    $firstVisit = 'Done';
                    $secondVisit = 'Pending';
                    $thirdVisit = 'Pending';
                } else if ($lastVisitDay == '2') {
                    $firstVisit = 'Done';
                    $secondVisit = 'Done';
                    $thirdVisit = 'Pending';
                } else if ($lastVisitDay == '3') {
                    $firstVisit = 'Done';
                    $secondVisit = 'Done';
                    $thirdVisit = 'Done';
                }
            } else {
                $firstVisit = 'Pending';
                $secondVisit = 'Pending';
                $thirdVisit = 'Pending';
            }

            return view('appointment.create', compact(
                'customer',
                'appointment_numbers',
                'today',
                'todayAppointments',
                'lastVisitDay',
                'firstVisit',
                'secondVisit',
                'thirdVisit',
                'onlinebooking',
                'customerType'
            ));
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }


    public function store(StoreAppointmentsRequest $request)
    {
        $validated = $request->validated();

        $apRecord = Appointments::where('customer_id', $validated['customer_id'])->where('date', $validated['today_date'])->first();

        if ($apRecord) {
            notify()->error('Customer already booked an appointment today. ⚡️', 'Error');
            return redirect()->back();
        } else {

            $apNumberRecord = ApNumbers::where('number', $validated['appointment_no'])->first();

            if (!$apNumberRecord) {
                return redirect()->back()->with('error', 'Invalid appointment number.');
            }

            $appointment = new Appointments();
            $appointment->customer_id = $validated['customer_id'];
            $appointment->date = $validated['today_date'];
            $appointment->ap_numbers_id = $apNumberRecord->id;
            $appointment->visit_day = $validated['visit_type'];
            $appointment->added_date = now();
            $appointment->save();

            notify()->success('Appointment created succesfully. ⚡️', 'Success');
            return redirect()->back();
        }
    }


    public function show(Appointments $appointments)
    {
    }


    public function edit(Appointments $appointments)
    {
    }


    public function update(UpdateAppointmentsRequest $request, Appointments $appointments)
    {
    }


    public function destroy(Appointments $appointments)
    {
    }

    public function cusAppointmentCreate()
    {
        //add user to session - id is 1
        Session::put('user_id', 27); //testing purpose 

        $logged_user_id = Session::get('user_id');

        if (empty($logged_user_id)) {
            return redirect()->back()->with('error', 'Please Login first');
        } else {
            $customer = Customer::findOrFail($logged_user_id);

            $hasAppointment = $customer->appointments()->exists();

            $first_visit = $hasAppointment;

            return view('appointments', compact('customer', 'first_visit'));
        }
    }
}
