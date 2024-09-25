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
use App\Models\VisitType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointmentTypes = AppointmentType::all();
        return view('appointment.index', compact('appointmentTypes'));
    }

    public function getAppointmentsByTypeAndDate($type, $date)
    {
        $appointments = Appointments::whereDate('date', $date)
            ->where('appointment_type_id', $type)  // Filter by type
            ->whereNotNull('visit_day')
            ->with('customer', 'apNumber')
            ->get();

        return response()->json($appointments->map(function ($appointment) {
            $customerTreat = CustomerTreatments::where('appointment_id', $appointment->id)->first();
            $haveTreat = $customerTreat ? 'Done' : 'Pending';

            return [
                'id' => $appointment->id,
                'ap_number' => $appointment->apNumber->number ?? 'N/A',
                'customer_name' => $appointment->customer->name ?? 'N/A',
                'contact' => $appointment->customer->contact ?? 'N/A',
                'ap_type' => $appointment->appointmentType->type ?? 'N/A',
                'visit_day' => $appointment->visit_day,
                'haveTreat' => $haveTreat,
                'status' => $appointment->status,
            ];
        }));
    }



    public function getAppointmentsByDate($date)
    {
        $appointments = Appointments::whereDate('date', $date)
            ->whereNotNull('visit_day')   
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
                'ap_type' => $appointment->appointmentType->type ?? 'N/A',
                'visit_day' => $appointment->visit_day,
                'haveTreat' => $haveTreat,
                'status' => $appointment->status,
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

            $bookings = Appointments::where('customer_id', $customer->id)
                ->whereDate('date', '>=', $today)
                ->where('is_booking', 1)
                ->where('status', 1)
                ->get();

            $visitTypes = VisitType::all();

            $paymentTypes = PaymentTypes::all();

            $appointmentTypes = AppointmentType::all();

            // Check the last row in the customer_treatments table
            $lastCustomerTreatment = CustomerTreatments::where('customer_id', $id)->latest()->first();

            $lastAppointment = null;
            $lastVisitDay = null;
            $lastVisitDate = null;

            $nextDay = null;

            if ($lastCustomerTreatment) {
                $nextDay = $lastCustomerTreatment->next_day;
                $lastAppointmentId = $lastCustomerTreatment->appointment_id;
                $lastAppointment = Appointments::where('id', $lastAppointmentId)->latest()->first();
            }

            $paymentStatus = 'done';

            if ($lastCustomerTreatment) {
                if ($lastCustomerTreatment->treatments !== null) {
                    if ($lastCustomerTreatment->selected_treatments == null && $lastCustomerTreatment->due_amount == null) {
                        $paymentStatus = 'not paid';
                    } else if ($lastCustomerTreatment->due_amount > 0) {
                        $paymentStatus = 'due';
                    }
                }
            }

            return view('appointment.create', compact(
                'customer',
                'appointment_numbers',
                'today',
                'todayAppointments',
                'lastAppointment',
                'onlinebooking',
                'customerType',
                'countryType',
                'country',
                'lastCustomerTreatment',
                'paymentStatus',
                'bookings',
                'visitTypes',
                'paymentTypes',
                'appointmentTypes',
                'nextDay'
            ));
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }


    public function checkAppointments(\Illuminate\Http\Request $request)
    {
        $selectedDate = $request->input('date');

        $todayAppointments = Appointments::whereDate('date', $selectedDate)
            ->pluck('ap_numbers_id')
            ->toArray();

        $appointment_numbers = ApNumbers::all();

        return response()->json([
            'todayAppointments' => $todayAppointments,
            'appointment_numbers' => $appointment_numbers,
        ]);
    }


    public function store(StoreAppointmentsRequest $request)
    {
        $validated = $request->validated();

        $apRecord = Appointments::where('customer_id', $validated['customer_id'])->where('date', $validated['today_date'])->first();

        $apNumberRecord = ApNumbers::where('number', $validated['appointment_no'])->first();

        if (!$apNumberRecord) {
            return redirect()->back()->with('error', 'Invalid appointment number.');
        }

        $appointmentDate = Carbon::parse($validated['today_date']);
        $today = Carbon::today();

        // Check if the appointment date is after today
        $isBooking = ($appointmentDate->gt($today)) ? '1' : null; // Set is_booking = 1 if the appointment date is after today


        $appointmentId = DB::table('appointments')->insertGetId([
            'customer_id' => $validated['customer_id'],
            'date' => $validated['today_date'],
            'ap_numbers_id' => $apNumberRecord->id,
            'visit_day' => $validated['visit_type'],
            'appointment_type_id' => $validated['ap_type'],
            'created_by' => 'Office',
            'created_user_id' => 1,
            'payment_method' => 'Office',
            'total_amount' => $validated['totalAmount'],
            'paid_amount' => $validated['paidAmount'],
            'due_amount' => $validated['dueAmount'],
            'payment_type_id' => $validated['paymentType'],
            'is_booking' => $isBooking,
            'status' => '1',
            'added_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('appointments.printPreview', ['appointmentId' => $appointmentId])
            ->with('success', 'Appointment saved successfully.');
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

            return view('appointments', compact('customer', 'first_visit', 'countries', 'appointmentTypes', 'paymentTypes'));
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
        $bookings = Appointments::select('customer_id', 'date')
            ->whereDate('date', '>=', Carbon::today())
            ->where('is_booking', 1) // Add this line to filter by is_booking
            ->get();

        $firstVisitDates = [];
        $secondVisitDates = [];
        $thirdVisitDates = [];
        $apBookings = [];

        foreach ($customerTreatments as $treatment) {
            $appointment = $appointments->firstWhere('id', $treatment->appointment_id);
            $customer = $customers->firstWhere('id', $treatment->customer_id);

            if ($appointment && $customer) {
                $contact = $customer->contact;
                if ($appointment->visit_day == '0' && $treatment->next_day) {
                    $firstVisitDates[] = [
                        'date' => $treatment->next_day,
                        'title' => $contact,
                        'color' => '#ffffb3'
                    ];
                } else if ($appointment->visit_day == '1' && $treatment->next_day) {
                    $secondVisitDates[] = [
                        'date' => $treatment->next_day,
                        'title' => $contact,
                        'color' => '#b3d9ff'
                    ];
                } elseif ($appointment->visit_day == '2' && $treatment->next_day) {
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
                $apBookings[] = [
                    'date' => $booking->date,
                    'title' => $contact,
                    'color' => '#ffccb3'
                ];
            }
        }

        return view('appointment.calendar_schedule', compact('firstVisitDates', 'secondVisitDates', 'thirdVisitDates', 'apBookings'));
    }


    public function viewBooking($id)
    {
        $bookings = Appointments::where('id', $id)->first();
        $visitTypes = VisitType::all();
        $paymentTypes = PaymentTypes::all();

        return view('appointment.booking', compact('bookings', 'visitTypes', 'paymentTypes'));
    }

    public function addAppointment($id)
    {
        // Get the request instance
        $request = Request::instance();

        // Create a validator instance with the request data
        $validator = Validator::make($request->all(), [
            'visit_type' => 'required|exists:visit_type,id',
            'paidAmount' => 'required|numeric|min:0',
            'paymentType' => 'required|exists:payment_types,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $booking = Appointments::findOrFail($id);

        $currentPaidAmount = $booking->paid_amount;

        $newPaidAmount = $currentPaidAmount + $request->input('paidAmount');

        $newDueAmount = $booking->total_amount - $newPaidAmount;

        $booking->update([
            'visit_day' => $request->input('visit_type'),
            'paid_amount' => $newPaidAmount,
            'due_amount' => $newDueAmount,
            'payment_method' => 'Office',
            'payment_type_id' => $request->input('paymentType'),
        ]);

        return redirect()->route('appointments.printPreview', ['appointmentId' => $id])
            ->with('success', 'Appointment saved successfully.');
    }
}
