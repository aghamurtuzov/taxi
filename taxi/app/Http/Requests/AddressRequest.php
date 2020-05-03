<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'street' => 'required|integer',
            'street_name' => 'required|string',
            'number' => 'required',
            'priority' => 'required|integer',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'sort' => 'required|integer',
            'status' => 'required|integer',
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
            'street.required' => 'Küçə sahəsi boş ola bilməz!',
            'street_name.required' => 'Küçə sahəsi boş ola bilməz!',
            'number.required' => 'Nömrə sahəsi boş ola bilməz!',
            'priority.required' => 'Prioritet sahəsi boş ola bilməz!',
            'priority.integer' => 'Prioritet mətn ola bilməz!',
            'latitude.required' => 'En sahəsi boş ola bilməz!',
            'longitude.required' => 'Uzunluq sahəsi boş ola bilməz!',
            'sort.required' => 'Sıralama sahəsi boş ola bilməz!',
            'sort.integer' => 'Sıralama sahəsi mətn ola bilməz!',
            'status.required' => 'Status sahəsi boş ola bilməz!',
        ];
    }
}
