<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxiDriverRequest extends FormRequest
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
            'navigator' => 'required',
            'request_second' => 'required|integer',
            'order_radius' => 'required|integer',
            'public_order_radius' => 'required|integer',
            'future_order_radius' => 'required|integer',
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
            'navigator.required' => 'Naviqatorlar sahəsi boş ola bilməz!',
            'request_second.required' => 'İstək saniyəsi boş ola bilməz!',
            'request_second.integer' => 'İstək saniyəsi mətn ola bilməz!',
            'order_radius.required' => 'Sifarişin radiusu boş ola bilməz!',
            'order_radius.integer' => 'Sifarişin radiusu mətn ola bilməz!',
            'public_order_radius.required' => 'Açıq sifarişin götürə bilmə radiusu boş ola bilməz!',
            'public_order_radius.integer' => 'Açıq sifarişin götürə bilmə radiusu mətn ola bilməz!',
            'future_order_radius.required' => 'Ön sifarişin götürə bilmə radiusu boş ola bilməz!',
            'future_order_radius.integer' => 'Ön sifarişin götürə bilmə radiusu mətn ola bilməz!',
        ];
    }
}
