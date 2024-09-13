<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\AppointmentType;
use App\Models\Bookings;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{

    public function checkDate(Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date',
            'customer_id' => 'required|integer'
        ]);

        $bookingDate = Carbon::parse($request->booking_date);
        $today = Carbon::today();

        if ($bookingDate->lt($today)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid date. The selected date is in the past.'
            ]);
        }

        // $existingBooking = DB::table('bookings')
        //     ->whereDate('booking_date', $bookingDate->format('Y-m-d'))
        //     ->where('customer_id', $request->customer_id)
        //     ->first();

        // if ($existingBooking) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'You already have a booking on this date.'
        //     ]);
        // }


        $bookingCount = DB::table('appointments')
            ->whereDate('date', $bookingDate->format('Y-m-d'))
            ->where('created_by', 'Online')
            ->count();

        $maxBookingCount = 5;

        if ($bookingCount >= $maxBookingCount) {
            return response()->json([
                'success' => false,
                'message' => 'The selected date has reached the maximum booking limit. Please choose another date.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Date is available.'
        ]);
    }

    public function getApNumber(Request $request)
    {
        $request->validate([
            'selected_date' => 'required|date',
        ]);

        $selectedDate = $request->input('selected_date');

        $bookedApNumbers = DB::table('appointments')
            ->whereDate('date', $selectedDate)
            ->pluck('ap_numbers_id');

        $availableApNumber = DB::table('ap_numbers')
            ->whereNotIn('id', $bookedApNumbers)  
            ->first();

        if ($availableApNumber) {
            return response()->json([
                'success' => true,
                'ap_number' => $availableApNumber->number,
                'ap_number_id' => $availableApNumber->id  
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No available appointment numbers for the selected date.'
            ]);
        }
    }

    public function generateOtp(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        if ($customer) {
            $otp = rand(100000, 999999);
            $customer->otp = $otp;
            $customer->save();

            $formattedContact = $this->formatContactNumber($customer->contact);

            $msg = "Mobile number verification\nYour OTP code is: $otp\nFrom RagamaGuru Office";

            // Send OTP message
            //$this->sendMessage($formattedContact, $msg);


            return response()->json(['success' => true, 'otp' => $otp]);
        } else {
            return response()->json(['success' => false, 'message' => 'Customer not found']);
        }
    }

    function formatContactNumber($contact)
    {
        // Remove any non-digit characters
        $contact = preg_replace('/\D/', '', $contact);

        // Check if the number starts with '0' and remove it
        if (strpos($contact, '0') === 0) {
            $contact = substr($contact, 1);
        }

        // Add the country code (94 for Sri Lanka)
        return '94' . $contact;
    }


    public function verifyOtp(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        if ($customer && $customer->otp == $request->otp) {
            // OTP is correct
            $customer->isVerified = true;
            $customer->save();
            return response()->json(['success' => true]);
        }

        // OTP is incorrect
        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }


    public function store(Request $request)
    {        
        //Log::info($request->all());

        $validated = $request->validate([
            'booking_date' => 'required|date',
            'customer_id' => 'required|exists:customer,id',
            'booking_type' => 'required|exists:appointment_type,id',
            'payment_method' => 'required',
            'ap_number_id' => 'required',
        ]);

        $customer = Customer::find($validated['customer_id']);

        if ($customer) {

            $country = $request->country_id;
            if ($country) {
                $customer->country_id = $country;
                $customer->save();
            }

            $apType = DB::table('appointment_type')
            ->where('id', $validated['booking_type'])  
            ->first();

            $appointments = new Appointments();
            $appointments->customer_id = $validated['customer_id'];
            $appointments->ap_numbers_id = $validated['ap_number_id'];
            $appointments->date = $validated['booking_date'];
            $appointments->appointment_type_id = $validated['booking_type'];
            $appointments->created_by = 'Online';
            $appointments->created_user_id = 1;
            $appointments->total_amount = $apType->price;
            $appointments->paid_amount = 0;
            $appointments->due_amount = $apType->price;
            $appointments->payment_method = $validated['payment_method'];
            $appointments->added_date = now();
            $appointments->save();

            $ap_date = $validated['booking_date'];

            $ap_numbers = DB::table('ap_numbers')
            ->where('id', $validated['ap_number_id'])  
            ->first();

            $ap_number = $ap_numbers->number;

            $formattedContact = $this->formatContactNumber($customer->contact);

            $msg = "Booking Confirmation\nAppointment date: $ap_date\nAppointment number: $ap_number\nYou can get appointment number in reception on this date.\nThank You.\nFrom RagamaGuru Office";

            // Send appointment message
            // $this->sendMessage($formattedContact, $msg);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Customer not found']);
        }
    }


    public function indexLocal()
    {
        return view('appointment.localbookings');
    }

    public function indexInternational()
    {
        return view('appointment.internationalbookings');
    }

    public function getLocalBookingsByDate($date)
    {
        $bookings = Bookings::whereDate('booking_date', $date)
            ->whereHas('customer', function ($query) {
                $query->where('country_type_id', 1);
            })
            ->with('customer')
            ->get();

        return response()->json($bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'customer_name' => $booking->customer->name ?? 'N/A',
                'contact' => $booking->customer->contact ?? 'N/A',
                'added_date' => $booking->added_date,
            ];
        }));
    }

    public function getIntBookingsByDate($date)
    {
        $bookings = Bookings::whereDate('booking_date', $date)
            ->whereHas('customer', function ($query) {
                $query->where('country_type_id', 2);
            })
            ->with(['customer', 'customer.country'])
            ->get();

        return response()->json($bookings->map(function ($booking) use ($date) {

            $hasAppointment = $booking->customer->appointments()
                ->whereDate('date', $date)
                ->exists();

            return [
                'id' => $booking->id,
                'customer_name' => $booking->customer->name ?? 'N/A',
                'customer_id' => $booking->customer->id ?? 'N/A',
                'contact' => $booking->customer->contact ?? 'N/A',
                'country' => $booking->customer->country->name ?? 'N/A',
                'appointment_status' => $hasAppointment ? 'Done' : 'Pending',
                'added_date' => $booking->added_date,
            ];
        }));
    }

    protected function sendMessage($contact, $msg)
    {
        $apiToken = env('RICHMO_API_TOKEN');
        $senderName = 'RagamaGuru';
        $message = $msg;

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiToken"
        ])->get('https://portal.richmo.lk/api/sms/send/', [
            'dst' => $contact,
            'from' => $senderName,
            'msg' => $message
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            //Log::info('SMS sent successfully:', $responseData);

            if ($responseData['message'] === 'success') {
                // SMS was sent successfully
            } else {
                //Log::warning('Unexpected response:', $responseData);
            }
        } else {
            $error = $response->json();
            //Log::error('SMS sending failed:', $error);
        }
    }
}
