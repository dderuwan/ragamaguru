<?php

namespace App\Http\Controllers;

use App\Models\ApNumbers;
use App\Models\Appointments;
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
use App\Models\AppointmentType;
use App\Models\Bookings;
use App\Models\Country;
use App\Models\CountryType;
use App\Models\Customer;
use App\Models\CustomerTreatments;
use App\Models\CustomerType;
use App\Models\PaymentTypes;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
            $customerTreat = CustomerTreatments::where('appointment_id', $appointment->id)->first();
            $haveTreat = "Pending";
            if ($customerTreat) {
                $haveTreat = "Done";
            }
            return [
                'id' => $appointment->id,
                'ap_number' => $appointment->apNumber->number ?? 'N/A',
                'customer_name' => $appointment->customer->name ?? 'N/A',
                'contact' => $appointment->customer->contact ?? 'N/A',
                'visit_day' => $appointment->visit_day,
                'haveTreat' => $haveTreat,
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

            $countryType = CountryType::where('id', $customer->country_type_id)->latest()->first();

            $country = Country::where('id', $customer->country_id)->latest()->first();

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
                } else if ($lastVisitDay == '4') {
                    $firstVisit = 'Done';
                    $secondVisit = 'Done';
                    $thirdVisit = 'Done';
                }
            } else {
                $firstVisit = 'Pending';
                $secondVisit = 'Pending';
                $thirdVisit = 'Pending';
            }

            // Check the last row in the customer_treatments table
            $lastCustomerTreatment = CustomerTreatments::where('customer_id', $id)->latest()->first();

            $paymentStatus = 'done';
            $nextDay = null;

            if ($lastCustomerTreatment) {
                $nextDay = $lastCustomerTreatment->next_day;
                if ($lastVisitDay == '1') {
                    if ($nextDay == null) {
                        $paymentStatus = 'not paid';
                    } else if ($nextDay != null && $lastCustomerTreatment->due_amount > 0.00) {
                        $paymentStatus = 'due';
                    }
                }
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
                'customerType',
                'countryType',
                'country',
                'lastCustomerTreatment',
                'paymentStatus',
                'nextDay'
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

            $appointmentId = DB::table('appointments')->insertGetId([
                'customer_id' => $validated['customer_id'],
                'date' => $validated['today_date'],
                'ap_numbers_id' => $apNumberRecord->id,
                'visit_day' => $validated['visit_type'],
                'added_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('appointments.printPreview', ['appointmentId' => $appointmentId])
                ->with('success', 'Appointment saved successfully.');
        }
    }


    public function show(Appointments $appointments) {}


    public function edit(Appointments $appointments) {}


    public function update(UpdateAppointmentsRequest $request, Appointments $appointments) {}


    public function destroy($id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            $appointment->delete();

            notify()->success('Appointment Deleted Succesfully. ⚡️', 'Success');
            return redirect()->back();
        }
        notify()->error('Appointment not found. ⚡️', 'Error');
        return redirect()->back();
    }

    public function cusAppointmentCreate()
    {
        //add user to session - id is 1
        Session::put('user_id', 28); //testing purpose 

        $logged_user_id = Session::get('user_id');

        if (empty($logged_user_id)) {
            return redirect()->back()->with('error', 'Please Login first');
        } else {
            $customer = Customer::findOrFail($logged_user_id);

            $countries = Country::all();

            $hasAppointment = $customer->appointments()->exists();

            $first_visit = $hasAppointment;

            $appointmentTypes = AppointmentType::where('status', 1)->get();
            $paymentTypes = PaymentTypes::all();

            return view('appointments', compact('customer', 'first_visit', 'countries','appointmentTypes','paymentTypes'));
        }
    }

    public function printPreview($appointmentId)
    {
        $appointment = Appointments::findOrFail($appointmentId);
        $apNumberRecord = ApNumbers::findOrFail($appointment->ap_numbers_id);
        $customer = Customer::findOrFail($appointment->customer_id);

        return view('appointment.print', [
            'appointment' => $appointment,
            'apNumberRecord' => $apNumberRecord,
            'customer' => $customer
        ]);
    }


    public function showCalendarSchedule()
    {
        $appointments = Appointments::select('id', 'visit_day')->get();
        $customerTreatments = CustomerTreatments::select('next_day', 'appointment_id', 'customer_id')->get();
        $customers = Customer::select('id', 'contact')->get();
        $bookings = Bookings::select('customer_id', 'booking_date')->get();

        $secondVisitDates = [];
        $thirdVisitDates = [];
        $onlineBookings = [];

        foreach ($customerTreatments as $treatment) {
            $appointment = $appointments->firstWhere('id', $treatment->appointment_id);
            $customer = $customers->firstWhere('id', $treatment->customer_id);

            if ($appointment && $customer) {
                $contact = $customer->contact;
                if ($appointment->visit_day == 1 && $treatment->next_day) {
                    $secondVisitDates[] = [
                        'date' => $treatment->next_day,
                        'title' => $contact,
                        'color' => '#b3d9ff'
                    ];
                } elseif ($appointment->visit_day == 2 && $treatment->next_day) {
                    $thirdVisitDates[] = [
                        'date' => $treatment->next_day,
                        'title' => $contact,
                        'color' => '#99ffbb'
                    ];
                }
            }
        }

        foreach ($bookings as $booking) {
            $customer = $customers->firstWhere('id', $booking->customer_id);
            if ($customer) {
                $contact = $customer->contact;
                $onlineBookings[] = [
                    'date' => $booking->booking_date,
                    'title' => $contact,
                    'color' => '#ffccb3'
                ];
            }
        }

        return view('appointment.calendar_schedule', compact('secondVisitDates', 'thirdVisitDates', 'onlineBookings'));
    }
}
