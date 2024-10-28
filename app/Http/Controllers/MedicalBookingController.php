<?php

namespace App\Http\Controllers;

use App\Models\ApNumbers;
use App\Models\Appointments;
use App\Models\AppointmentType;
use App\Models\Bookings;
use App\Models\Customer;
use App\Models\MedicalAppointments;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MedicalBookingController extends Controller
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


        $bookingCount = DB::table('medical_appointments')
            ->whereDate('date', $bookingDate->format('Y-m-d'))
            ->where('status', 1)
            ->count();

        $maxBookingCount = 30;

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

        $bookedApNumbers = DB::table('medical_appointments')
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
            if ($customer->country_type_id == 2) {
               $this->sendWhatsappMessage($customer->contact, $msg);
            } else {
               $this->sendMessage($formattedContact, $msg);
            }


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
            'booking_type' => 'required|exists:medical_appointment_type,id',
            'medical_reason' => 'required|exists:medical_reason,id',
            'ap_number_id' => 'required',
        ]);

        $customer = Customer::find($validated['customer_id']);

        if ($customer) {

            $country = $request->country_id;
            if ($country) {
                $customer->country_id = $country;
                $customer->save();
            }

            $apType = DB::table('medical_appointment_type')
                ->where('id', $validated['booking_type'])
                ->first();

            $appointments = new MedicalAppointments();
            $appointments->customer_id = $validated['customer_id'];
            $appointments->ap_numbers_id = $validated['ap_number_id'];
            $appointments->date = $validated['booking_date'];
            $appointments->appointment_type_id = $validated['booking_type'];
            $appointments->created_by = 'Online';
            // $appointments->created_user_id = 1;
            $appointments->is_booking = '1';
            $appointments->status = '1';
            $appointments->total_amount = $apType->price;
            $appointments->paid_amount = 0;
            $appointments->due_amount = $apType->price;
            $appointments->payment_method = 'Office';
            $appointments->added_date = now();
            $appointments->medical_reason_id = $validated['medical_reason'];
            $appointments->save();

            $ap_date = $validated['booking_date'];

            $ap_numbers = DB::table('ap_numbers')
                ->where('id', $validated['ap_number_id'])
                ->first();

            $ap_number = $ap_numbers->number;

            $formattedContact = $this->formatContactNumber($customer->contact);

            $msg = "Booking Confirmation\nAppointment date: $ap_date\nAppointment number: $ap_number\nYou can get appointment number in reception on this date.\nThank You.\nFrom RagamaGuru Office";

            // Send appointment message
            if ($customer->country_type_id == 2) {
                $this->sendWhatsappMessage($customer->contact, $msg);
            } else {
                //$this->sendMessage($formattedContact, $msg);
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Customer not found']);
        }
    }

    

    




    public function medicalBookingsIndex()
    {
        return view('medicalAppointment.medicalbookings');
    }


    public function getMedicalBookingsByDate($date)
    {
        $bookings = MedicalAppointments::whereDate('date', $date)
            ->where('is_booking', 1)
            ->with('customer')
            ->get();

        return response()->json($bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'date' => $booking->date,
                'apNumber' => $booking->apNumber->number,
                'created_by' => $booking->created_by,
                'customer_name' => $booking->customer->name ?? 'N/A',
                'customer_id' => $booking->customer->id ?? 'N/A',   
                'contact' => $booking->customer->contact ?? 'N/A',
                'added_date' => $booking->added_date,
                'status' => $booking->status,
                'medical_reason' => $booking->medicalReason->reason ?? 'N/A',
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

    public function sendWhatsappMessage($recipient, $message)
    {
        $url = "https://wbot.chatbiz.net/api/send";
        $whatsappAccessToken = env('WHATSAPP_ACCESS_TOKEN');
        $whatsappInstanceId = env('WHATSAPP_INSTANCE_ID');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'instance_id'  => $whatsappInstanceId,
            'number'       => $recipient,
            'type'         => 'text',
            'message'      => $message,
            'access_token' => $whatsappAccessToken,
        ]);

        if ($response->successful()) {
            // echo "Message sent successfully!";
        } else {
            // echo "Failed to send message. Error: " . $response->body();
        }
    }

    public function cancel($id)
    {
        // Find the booking by ID
        $appointment = MedicalAppointments::findOrFail($id);

        // Update status to 0 (canceled)
        $appointment->status = 0;
        $appointment->save();

        $ap_date = $appointment->date;

        $ap_number = ApNumbers::findOrFail($appointment->ap_numbers_id);
        $apNumber = $ap_number->number;

        $customer = Customer::findOrFail($appointment->customer_id);

        $formattedContact = $this->formatContactNumber($customer->contact);

        $msg = "Booking Cancelled\nAppointment date: $ap_date\nAppointment number: $apNumber\nThis booking was canceled due to some reason. Contact the company for further details.\nSorry for the inconvenience.\nFrom RagamaGuru Office";

        // Send cancel message
        if ($customer->country_type_id == 2) {
            $this->sendWhatsappMessage($customer->contact, $msg);
        } else {
            $this->sendMessage($formattedContact, $msg);
        }

        return response()->json([
            'message' => 'Booking canceled successfully!'
        ]);
    }
}
