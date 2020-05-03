<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxiCharacteristicsRequest extends FormRequest
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
            'price' => 'required|numeric',
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
            'name.required' => 'Ad boş ola bilməz!',
            'price.required' => 'Qiymət boş ola bilməz!',
            'sort.required' => 'Siralama boş ola bilməz!',
            'status.required' => 'Status boş ola bilməz!',
            'sort.integer' => 'Siralama mətn ola bilməz!',
            'price.numeric' => 'Qiymət mətn ola bilməz!',
        ];
    }
}
