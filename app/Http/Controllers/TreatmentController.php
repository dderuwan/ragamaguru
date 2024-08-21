<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Customer;
use App\Models\CustomerTreatments;
use App\Models\PaymentTypes;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{

    public function index()
    {

        $Treatments = Treatment::all();
        return view('Treatment.index', [
            'Treatments' => $Treatments
        ]);
    }


    public function create()
    {
        return view('Treatment.create');
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

        Treatment::create($data);

        notify()->success('Treatment created successfully. ⚡️', 'Success');
        return redirect('/Treatment')->with('status', 'Treatments Created Successfully');
    }


    public function show(Treatment $Treatment)
    {
        return view('Treatment.show', compact('Treatment'));
    }


    public function edit(Treatment $Treatment, $id)
    {
        $treatment = Treatment::find($id);
        return view('Treatment.edit', compact('treatment'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0|max:999999.99',
            'things_to_bring' => 'nullable|array',
            'status' => 'required|boolean',
        ]);

        $treatment = Treatment::findOrFail($id);

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
        return redirect()->route('Treatment')->with('status', 'Treatment updated successfully');
    }




    public function destroy($id)
    {
        $Treatment = Treatment::find($id);
        if ($Treatment) {
            $Treatment->delete();
            //return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
            notify()->success(' Treatment deleted successfully. ⚡️', 'Success');
            return redirect()->route('Treatment');
        } else {
            return redirect()->route('Treatment')->with('error', 'Treatment not found.');
        }
    }


    public function customerTreat($id)
    {

        $appointment = Appointments::find($id);
        if ($appointment) {

            $customer = Customer::with('customerType', 'countryType', 'country')->find($appointment->customer_id);
            $treatment = Treatment::all()->where('status', 1);
            $existingCustomerTreatment = CustomerTreatments::where('appointment_id', $appointment->id)->first();
            $treatmentHistory = CustomerTreatments::with('appointment')->where('customer_id', $customer->id)->get();

            return view('treatment.customertreat', compact('appointment', 'customer', 'treatment', 'existingCustomerTreatment', 'treatmentHistory'));
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }



    public function saveCustomerTreatments(Request $request, $id)
    {
        $appointment = Appointments::find($id);

        if ($appointment) {
            $customerTreatment = CustomerTreatments::updateOrCreate(
                ['appointment_id' => $id],
                [
                    'customer_id' => $appointment->customer_id,
                    'treatments' => $request->input('treatments'),
                    'note' => $request->input('specialNote'),
                    'added_date' => now(),
                ]
            );

            notify()->success('Treatment saved successfully. ⚡️', 'Success');
            return redirect()->route('appointments.index');
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }


    public function viewCustomerTreat($id)
    {

        $appointment = Appointments::find($id);
        if ($appointment) {

            $customer = Customer::with('customerType', 'countryType', 'country')->find($appointment->customer_id);
            $treatmentHistory = CustomerTreatments::with('appointment')->where('appointment_id', $appointment->id)->get();
            $paymentTypes = PaymentTypes::all();

            $paymentDetails = CustomerTreatments::where('appointment_id', $appointment->id)
            ->whereNotNull('paid_amount')
            ->whereNotNull('total_amount')
            ->whereNotNull('due_amount')
            ->whereNotNull('payment_type_id')
            ->whereNotNull('next_day')
            ->first();

        return view('treatment.view_customer_treat', compact('customer', 'treatmentHistory', 'paymentTypes', 'appointment', 'paymentDetails'));
        }

        return redirect()->back()->with('error', 'Appointment not found.');
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
            'nextDay' => 'required|date|after_or_equal:today',
        ]);

        $customerTreatment = CustomerTreatments::where('appointment_id', $id)->firstOrFail();

        $customerTreatment->update([
            'total_amount' => $request->totalAmount,
            'paid_amount' => $request->paidAmount,
            'due_amount' => $request->dueAmount,
            'payment_type_id' => $request->paymentType,
            'next_day' => $request->nextDay,
        ]);
            
        $customerTreatment->save();

        notify()->success('Payment details and next appointment date updated successfully. ⚡️', 'Success');
        return redirect()->route('appointments.index')->with('status', 'Payment updated successfully');
    }
}
