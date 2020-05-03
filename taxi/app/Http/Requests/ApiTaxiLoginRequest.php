<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiTaxiLoginRequest extends FormRequest
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
            'code' => 'required|string',
            'device_id' => 'required|string',
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
            'code.required' => 'Kod boş ola bilməz!',
            'device_id.required' => 'Qurğu boş ola bilməz!',
        ];

    }

//    public function filters()
//    {
//        return [
//            'email' => 'trim|lowercase',
//            'name' => 'trim|capitalize|escape'
//        ];
//    }


}
