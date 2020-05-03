<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingQuicklyPricingStrategyRequest extends FormRequest
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
            'tariff' => 'required',
            'percent' => 'required|integer|max:100',
            'end_time' => 'required',
      
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
           
            'tariff.required' => 'Tarif boş ola bilməz!',
            'percent.required' => 'Faız(%) sahəsi boş ola bilməz!',
            'percent.integer' => 'Faız(%) sahəsi mətn ola bilməz!',
            'percent.max' => 'Faız(%) sahəsi 100-dən çox ola bilməz!',
            'end_time.required' => 'Bitmə Tarixi boş ola bilməz!',
            

        ];
    }
}
