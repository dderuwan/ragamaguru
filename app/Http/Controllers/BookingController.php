<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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

        $existingBooking = DB::table('bookings')
            ->whereDate('booking_date', $bookingDate->format('Y-m-d'))
            ->where('customer_id', $request->customer_id)
            ->first();

        if ($existingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'You already have a booking on this date.'
            ]);
        }


        $bookingCount = DB::table('bookings')
            ->whereDate('booking_date', $bookingDate->format('Y-m-d'))
            ->count();

        $maxBookingCount = 10;

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
            $this->sendMessage($formattedContact, $msg);


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

        $validated = $request->validate([
            'booking_date' => 'required|date',
            'customer_id' => 'required|exists:customer,id',
        ]);

        $customer = Customer::find($validated['customer_id']);

        if ($customer) {

            $country_id = $request->country;
            if ($country_id) {
                $customer->country_id = $country_id;
                $customer->save();
            }

            $bookings = new Bookings();
            $bookings->customer_id = $validated['customer_id'];
            $bookings->booking_date = $validated['booking_date'];
            $bookings->added_date = now();
            $bookings->save();

            $ap_date = $validated['booking_date'];

            $formattedContact = $this->formatContactNumber($customer->contact);
            
            $msg = "Booking Confirmation\nYour appointment date is: $ap_date\nYou can get appointment number in reception on this date.\nThank You.\nFrom RagamaGuru Office";

            // Send OTP message
            $this->sendMessage($formattedContact, $msg);

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
