<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerMedicalTreatments;
use App\Models\MedicalAppointments;
use App\Models\MedicalTreat;
use App\Models\PaymentTypes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MedicalTreatController extends Controller
{
    public function index()
    {

        $Treatments = MedicalTreat::all();
        return view('medicalTreat.index', [
            'Treatments' => $Treatments
        ]);
  
         
    }


    public function create()
    {
        return view('medicalTreat.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0|max:999999.99',
            'things_to_bring' => 'nullable|array',
            'status' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'amount' => $request->amount,
            'status' => $request->status == true ? 1 : 0,
        ];

        if ($request->has('things_to_bring') && !empty($request->things_to_bring)) {
            $data['things_to_bring'] = json_encode($request->things_to_bring);
        }

        MedicalTreat::create($data);

        notify()->success('Treatment created successfully. ⚡️', 'Success');
        return redirect()->route('medicalTreatment')->with('status', 'Treatments Created Successfully');
    }


    public function show(MedicalTreat $Treatment)
    {
        return view('medicalTreat.show', compact('Treatment'));
    }


    public function edit(MedicalTreat $Treatment, $id)
    {
        $treatment = MedicalTreat::find($id);
        return view('medicalTreat.edit', compact('treatment'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0|max:999999.99',
            'things_to_bring' => 'nullable|array',
            'status' => 'required|boolean',     
        ]);

        $treatment = MedicalTreat::findOrFail($id);

        $data = [
            'name' => $request->name,
            'amount' => $request->amount,
            'status' => $request->status,
        ];

        if ($request->has('things_to_bring') && !empty($request->things_to_bring)) {
            $data['things_to_bring'] = json_encode($request->things_to_bring);
        } else {
            $data['things_to_bring'] = null;
        }

        $treatment->update($data);

        notify()->success('Treatment updated successfully. ⚡️', 'Success');
        return redirect()->route('medicalTreatment')->with('status', 'Treatment updated successfully');
    }




    public function destroy($id)
    {
        $Treatment = MedicalTreat::find($id);
        if ($Treatment) {
            $Treatment->delete();
            //return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
            notify()->success(' Treatment deleted successfully. ⚡️', 'Success');
            return redirect()->route('medicalTreatment');
        } else {
            return redirect()->route('medicalTreatment')->with('error', 'Treatment not found.');
        }
    }



    public function customerTreat($id)
    {

        $appointment = MedicalAppointments::find($id);
        if ($appointment) {
            $visitDay = $appointment->visit_day;
            $customer = Customer::with('customerType', 'countryType', 'country')->find($appointment->customer_id);
            $treatment = MedicalTreat::all()->where('status', 1);
            $existingCustomerTreatment = CustomerMedicalTreatments::where('appointment_id', $appointment->id)->first();

            $treatmentHistory = CustomerMedicalTreatments::where('customer_medical_treatments.customer_id', $customer->id)
                ->with('appointment')
                ->get();


            return view('medicalTreat.add_customer_mtreat', compact(
                'appointment',
                'visitDay',
                'customer',
                'treatment',
                'existingCustomerTreatment',
                'treatmentHistory',
            ));
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }



    public function saveCustomerTreatments(Request $request, $id)
    {
        $appointment = MedicalAppointments::find($id);

        if ($appointment) {
            $customerTreatment = CustomerMedicalTreatments::updateOrCreate(
                ['appointment_id' => $id],
                [
                    'customer_id' => $appointment->customer_id,
                    'treatments' => $request->input('treatments'),
                    'free_treatments' => $request->input('free_treatments'),
                    'comment' => $request->input('comment'),
                    'things_to_bring' => $request->input('thingsToBring'),
                    'next_day' => $request->input('nextDay'),
                    'added_date' => now(),
                ]
            );

            notify()->success('Treatment saved successfully. ⚡️', 'Success');
            return redirect()->route('mAppointments.index');
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }

    public function viewCustomerTreat($id)
    {

        $appointment = MedicalAppointments::find($id);
        if ($appointment) {
            $visitDay = $appointment->visit_day;
            $customer = Customer::with('customerType', 'countryType', 'country')->find($appointment->customer_id);
            $treatmentHistory = CustomerMedicalTreatments::with('appointment')->where('appointment_id', $appointment->id)->first();
            if ($treatmentHistory) {
                $haveTreatments = $treatmentHistory->treatments; // Access the treatments property safely
            }
            $paymentTypes = PaymentTypes::all();

            $paymentDetails = CustomerMedicalTreatments::where('appointment_id', $appointment->id)
                ->whereNotNull('paid_amount')
                ->whereNotNull('total_amount')
                ->whereNotNull('due_amount')
                ->whereNotNull('payment_type_id')
                ->first();

            return view('medicalTreat.view_customer_mtreat', compact('customer', 'visitDay', 'treatmentHistory', 'paymentTypes', 'appointment', 'paymentDetails', 'haveTreatments'));
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }


    public function updateNextDay(Request $request, $id)
    {

        $request->validate([
            'nextDay' => 'required|date|after_or_equal:today',
        ]);

        $treatmentHistory = CustomerMedicalTreatments::findOrFail($id);
        $treatmentHistory->next_day = $request->input('nextDay');
        $treatmentHistory->save();

        notify()->success('Date updated successfully. ⚡️', 'Success');
        return redirect()->back();
    }


    public function saveTreatPayment(Request $request, $id)
    {

        $request->merge([
            'totalAmount' => str_replace(',', '', $request->totalAmount),
            'paidAmount' => str_replace(',', '', $request->paidAmount),
            'dueAmount' => str_replace(',', '', $request->dueAmount),
        ]);

        $request->validate([
            'totalAmount' => 'required|min:0|max:999999.99',
            'paidAmount' => 'required|numeric|min:0|max:' . $request->totalAmount,
            'dueAmount' => 'required|numeric|min:0|max:' . $request->totalAmount,
            'paymentType' => 'required|exists:payment_types,id',

        ]);

        $customerTreatment = CustomerMedicalTreatments::where('appointment_id', $id)->firstOrFail();

        $customerTreatment->update([
            'total_amount' => $request->totalAmount,
            'paid_amount' => $request->paidAmount,
            'due_amount' => $request->dueAmount,
            'payment_type_id' => $request->paymentType,
            'selected_treatments' => $request->treatments,
        ]);

        $customerTreatment->save();

        //notify()->success('Payment details updated successfully. ⚡️', 'Success');
        return redirect()->route('mtreatments.printPreview', ['cusTreatId' => $customerTreatment->id])
            ->with('success', 'Treatment and payment saved successfully.');
        //return redirect()->route('appointments.index')->with('status', 'Payment updated successfully');
    }


    public function printPreview($cusTreatId)
    {
        $customerTreatment = CustomerMedicalTreatments::findOrFail($cusTreatId);
        $treatments = null;
        $selectedTreatmentIds = null;
        if ($customerTreatment->treatments && $customerTreatment->selected_treatments) {
            $treatmentIds = $customerTreatment->treatments;
            $selectedTreatmentIds = $customerTreatment->selected_treatments;
            $treatments = MedicalTreat::whereIn('id', $treatmentIds)->get();
        }
        $ftreatments = null;
        if($customerTreatment->free_treatments){
            $ftreatmentIds = $customerTreatment->free_treatments;
            $ftreatments = MedicalTreat::whereIn('id', $ftreatmentIds)->get();
        }
        $appointment = MedicalAppointments::findOrFail($customerTreatment->appointment_id);
        $customer = Customer::findOrFail($customerTreatment->customer_id);
        $user = User::findOrFail(Auth::guard('admin')->id());
        $countryName = null;
        if ($customer->country_id) {
            $response = Http::get("https://restcountries.com/v3.1/alpha/{$customer->country_id}");

            if ($response->successful()) {
                $countryData = $response->json();
                $countryName = $countryData[0]['name']['common'];
            }
        } else {
            $countryName = 'Sri Lanka';         
        }
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        return view('medicalTreat.print', compact('customerTreatment', 'appointment', 'customer', 'countryName', 'treatments','ftreatments', 'selectedTreatmentIds', 'currentDateTime','user'));
    }


    public function viewDuePayment($id)
    {
        $customerTreatment = CustomerMedicalTreatments::find($id);

        if ($customerTreatment) {
            $customer = Customer::with('customerType', 'countryType', 'country')->find($customerTreatment->customer_id);
            $paymentTypes = PaymentTypes::all();
            return view('medicalTreat.make_due_mpayment', compact('customerTreatment', 'customer', 'paymentTypes'));
        }

        return redirect()->back()->with('error', 'Data not found.');
    }

    public function saveDuePayment(Request $request, $id)
    {
        //dd($request);
        $request->merge([
            'totalAmount' => str_replace(',', '', $request->totalAmount),
            'paidAmount' => str_replace(',', '', $request->paidAmount),
            'dueAmount' => str_replace(',', '', $request->dueAmount),
        ]);

        $request->validate([
            'paidAmount' => 'required|numeric|min:0|max:' . $request->totalAmount,
            'dueAmount' => 'required|numeric|min:0|max:' . $request->totalAmount,
            'paymentType' => 'required|exists:payment_types,id',
        ]);

        $customerTreatment = CustomerMedicalTreatments::where('id', $id)->firstOrFail();

        $tobepaid = $customerTreatment->due_amount;                 

        $paidAmount = $customerTreatment->paid_amount + $request->paidAmount;

        $customerTreatment->update([
            'paid_amount' => $paidAmount,
            'due_amount' => $request->dueAmount,
            'payment_type_id' => $request->paymentType,                  
        ]);

        $customerTreatment->save();

        $treatId = $customerTreatment->id;
        $pamount = $request->paidAmount;              
        $damount = $request->dueAmount;
        $ptype = PaymentTypes::find($request->paymentType);    
        $ptypename = $ptype->name;

        $user = User::findOrFail(Auth::guard('admin')->id());        

        notify()->success('Payment details updated successfully. ⚡️', 'Success');
        return view('treatment.duepay_print', compact('treatId', 'tobepaid', 'pamount', 'damount', 'ptypename','user'));
        //return redirect()->route('customer.index')->with('status', 'Payment updated successfully');
    }


    public function customerMData($id){
        return view('medicalAppointment.customer_mdata');
    }


    public function saveCustomerMData(Request $request, $id){

    }



}
