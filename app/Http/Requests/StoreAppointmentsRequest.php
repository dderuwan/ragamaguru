<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customer,id',
            'today_date' => 'required|date',
            'appointment_no' => 'required|string',
            'visit_type' => 'required|exists:visit_type,id',
            'ap_type' => 'required|exists:appointment_type,id',
            'totalAmount' => 'required|numeric|min:0',
            'paymentType' => 'required|exists:payment_types,id',
            'paidAmount' => 'required|numeric|min:0',
            'dueAmount' => 'nullable|numeric|min:0',

        ];
    }
}
