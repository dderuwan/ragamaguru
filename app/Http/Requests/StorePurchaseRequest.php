<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'request_code' => 'required|string|unique:purchase_order,request_code',
            'item_code' => 'required|string',
            'supplier_code' => 'required|string',
            'inquantity' => 'nullable|integer',
            'order_quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:0,1', // Ensure status is either 0 or 1
        ];
    }
}
