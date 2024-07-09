<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'item_name.*' => 'required|string|max:255',
            'item_description.*' => 'required|string',
            'item_quantity.*' => 'required|integer|min:1',
            'item_price.*' => 'required|numeric|min:0',
            'item_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'supplier_code' => 'required|string',
        ];
    }
}
