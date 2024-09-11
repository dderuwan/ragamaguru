<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\CustomerTreatments;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CustomerController extends Controller
{


    public function index()
    {
        $customer_list = Customer::with(['customerType', 'countryType', 'user'])->get();
        return view('customer.index', compact('customer_list'));
    }


    public function create()
    {
        return view('customer.create');
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

    public function store(StoreCustomerRequest $request)
    {
        $otp = rand(100000, 999999);

        $formattedContact = $this->formatContactNumber($request->contact);

        $existingCustomer = Customer::where('contact', $request->contact)->first();

        if ($existingCustomer) {
            return redirect()->back()->with([
                'error' => 'This Customer Already Registered.',
            ]);
        } else {

            // $password = Str::random(8);

            $customer = Customer::create([
                'name' => $request->name,
                'contact' => $request->contact,
                'address' => $request->address,
                'otp' => $otp,
                'isVerified' => false,
                'user_id' => 1,
                'customer_type_id' => 2,
                'country_type_id' => 1,
                'registered_time' => now(),
                // 'password' => bcrypt($password), //need to send password and contact through sms after verify
            ]);

            $msg = "Mobile number verification\nYour OTP code is: $otp\nFrom RagamaGuru Office";

            // Send OTP message
            $this->sendMessage($formattedContact, $msg);

            return redirect()->back()->with([
                'success' => 'Customer created successfully',
                'contactNo' => $customer->contact
            ]);
        }
    }





    public function verify(Request $request)
    {

        $customer = Customer::where('contact', $request->addedContact)
            ->where('otp', $request->otp)
            ->first();

        if ($customer) {

            $password = Str::random(8);

            $customer->isVerified = true;
            $customer->password = bcrypt($password);
            $customer->save();

            $contact = $request->addedContact;

            $formattedContact = $this->formatContactNumber($request->addedContact);

            $msg = "Your account has been verified.\nNow you can login RagamaGuru website using below details.\nMobile : " . $contact . "\nPassword : " . $password . "\nFrom RagamaGuru Office";

            // Send the message
            $this->sendMessage($formattedContact, $msg);

            return redirect()->back()->with('success', 'Customer verified successfully.');
        } else {
            return redirect()->back()->with([
                'otp' => 'Invalid OTP. Please try again.',
                'contactNo' => $request->addedContact
            ]);
        }
    }


    public function show(Customer $customer)
    {
        //
    }


    public function edit(Customer $customer, $id)
    {

        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }


    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customerId = Customer::find($request->id);
        if ($customerId) {
            $updatedData = $request->all();
            $customerId->update($updatedData);
            return redirect()->back()->with('success', 'Customer updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Customer not found.');
        }
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            //return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
            notify()->success('Customer deleted successfully. ⚡️', 'Success');
            return redirect()->route('customer.index');
        } else {
            return redirect()->route('customer.index')->with('error', 'Customer not found.');
        }
    }


    public function reverify(Request $request)
    {

        $customer = Customer::where('contact', $request->addedContact)
            ->where('otp', $request->otp)
            ->first();

        if ($customer) {

            $password = Str::random(8);

            $customer->isVerified = true;
            $customer->password = bcrypt($password);
            $customer->save();

            $contact = $request->addedContact;

            $formattedContact = $this->formatContactNumber($request->addedContact);

            $msg = "Your account has been verified.\nNow you can login RagamaGuru website using below details.\nMobile : " . $contact . "\nPassword : " . $password . "\nFrom RagamaGuru Office";

            // Send the message
            $this->sendMessage($formattedContact, $msg);

            notify()->success('Customer verified successfully. ⚡️', 'Success');
            return redirect()->route('customer.index');
        } else {
            notify()->error('Invalid details.. Please try again. ⚡️', 'Error');
            return redirect()->route('customer.index');
        }
    }


    public function resendOtp(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|exists:customer,id',
        ]);

        $customer = Customer::findOrFail($request->customer_id);

        $formattedContact = $this->formatContactNumber($customer->contact);

        $otp = rand(100000, 999999);

        $customer->otp = $otp;
        $customer->save();

        $msg = "Mobile number verification\nYour OTP code is: $otp\nFrom RagamaGuru Office";

        // Send OTP message
        $this->sendMessage($formattedContact, $msg);

        return response()->json(['success' => 'OTP has been resent.']);
    }

    public function updateAddress(Request $request, $id)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'line1' => 'required|string|max:255',
            'line2' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255'
        ]);

        $deliveryAddress = DeliveryAddress::where('customer_id', $id)->first();

        if ($deliveryAddress) {
            $deliveryAddress->update([
                'line1' => $validatedData['line1'],
                'line2' => $validatedData['line2'],
                'postal_code' => $validatedData['postal_code'],
                'city' => $validatedData['city'],
                'country' => $validatedData['country']
            ]);
        } else {
            DeliveryAddress::create([
                'customer_id' => $id,
                'line1' => $validatedData['line1'],
                'line2' => $validatedData['line2'],
                'postal_code' => $validatedData['postal_code'],
                'city' => $validatedData['city'],
                'country' => $validatedData['country']
            ]);
        }

        return redirect()->back()->with('success', 'Address updated successfully.');
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


    public function viewTreatmentHistory($id)
    {

        $customer = Customer::with('customerType', 'countryType', 'country')->find($id);
        if ($customer) {


            $firstVisitHistory = CustomerTreatments::where('customer_treatments.customer_id', $customer->id)
                ->whereHas('appointment', function ($query) {
                    $query->where('visit_day', 1);
                })
                ->with('appointment')
                ->get();

            $secondVisitHistory = CustomerTreatments::where('customer_treatments.customer_id', $customer->id)
                ->whereHas('appointment', function ($query) {
                    $query->where('visit_day', 2);
                })
                ->with('appointment')
                ->get();

            $thirdVisitHistory = CustomerTreatments::where('customer_treatments.customer_id', $customer->id)
                ->whereHas('appointment', function ($query) {
                    $query->where('visit_day', 3);
                })
                ->with('appointment')
                ->get();

            $otherVisitHistory = CustomerTreatments::where('customer_treatments.customer_id', $customer->id)
                ->whereHas('appointment', function ($query) {
                    $query->where('visit_day', 4);
                })
                ->with('appointment')
                ->get();

            return view('customer.treatment_history', compact(
                'customer',
                'firstVisitHistory',
                'secondVisitHistory',
                'thirdVisitHistory',
                'otherVisitHistory'
            ));
        }

        return redirect()->back()->with('error', 'customer not found');
    }
}
