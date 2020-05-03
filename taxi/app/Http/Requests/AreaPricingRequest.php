<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaPricingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'amount' => 'required|string',
            'amount_status' => 'required|string',
            'status' => 'required|integer',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Küçə sahəsi boş ola bilməz!',
            'amount.required' => 'Küçə sahəsi boş ola bilməz!',
            'amount_status.required' => 'Nömrə sahəsi boş ola bilməz!',
            'latitude.required' => 'En sahəsi boş ola bilməz!',
            'longitude.required' => 'Uzunluq sahəsi boş ola bilməz!',
            'status.required' => 'Status sahəsi boş ola bilməz!',
        ];
    }
}
