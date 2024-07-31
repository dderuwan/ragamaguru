<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferItemsRequest extends FormRequest
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
            'items.*.item_id' => 'required|exists:item,id',
            'items.*.normal_price' => 'required|numeric|min:0',
            'items.*.offer_rate' => 'required|numeric|min:0|max:100',
            'items.*.offer_price' => 'required|numeric|min:0',
            'month_year' => 'required|date_format:Y-m',
        ];
    }
}
