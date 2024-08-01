<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferItemsRequest extends FormRequest
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
            'month_year' => 'required|date_format:Y-m',
            'offer_rate' => 'required|numeric|min:0|max:100',
            'offer_price' => 'required|numeric|min:0',
            'status' => 'required|in:Active,Inactive',
        ];
    }
}
