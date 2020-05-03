<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingParameterRequest extends FormRequest
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
            'request_second' => 'required|integer|min:0',
            'order_radius' => 'required|integer|min:0}max:10',
            'default_priority' => 'required|integer|min:0',
            'public_order_radius' => 'required|integer|min:0',
            'future_order_radius' => 'required|integer|min:0',
            'reached_time' => 'required|integer|min:0',
            'confirm_message' => 'required',
            'reached_message' => 'required',
            'future_order_minute' => 'required|integer|min:0',
            'order_minute' => 'required|integer|min:0',
            'order_loop_minute' => 'required|integer|min:0',
            'public_order_request_time' => 'required|integer|min:0',
            'show_tariff' => 'required',
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
            'request_second.min' => 'İstək saniyəsi 0-dan az ola bilməz!',
            'order_radius.required' => 'Sifarişin radiusu boş ola bilməz!',
            'order_radius.integer' => 'Sifarişin radiusu mətn ola bilməz!',
            'order_radius.min' => 'Sifarişin radiusu 0-dan az ola bilməz!',
            'order_radius.max' => 'Sifarişin radiusu 10-dan çox ola bilməz!',
            'default_priority.required' => 'İlkin təyin olunmuş prioritet boş ola bilməz!',
            'default_priority.integer' => 'İlkin təyin olunmuş prioritet mətn ola bilməz!',
            'default_priority.min' => 'İlkin təyin olunmuş prioritet 0-dan az ola bilməz!',
            'public_order_radius.required' => 'Açıq sifarişin götürə bilmə radiusu boş ola bilməz!',
            'public_order_radius.integer' => 'Açıq sifarişin götürə bilmə radiusu mətn ola bilməz!',
            'public_order_radius.min' => 'Açıq sifarişin götürə bilmə radiusu 0-dan az ola bilməz!',
            'future_order_radius.required' => 'Ön sifarişin götürə bilmə radiusu boş ola bilməz!',
            'future_order_radius.integer' => 'Ön sifarişin götürə bilmə radiusu mətn ola bilməz!',
            'future_order_radius.min' => 'Ön sifarişin götürə bilmə radiusuı 0-dan az ola bilməz!',
            'reached_time.required' => 'Çatma vaxtı boş ola bilməz!',
            'reached_time.integer' => 'Çatma vaxtı mətn ola bilməz!',
            'reached_time.min' => 'Çatma vaxtı 0-dan az ola bilməz!',
            'confirm_message.required' => 'Təsdiqlənmə mesajı boş ola bilməz!',
            'reached_message.required' => 'Çatdım mesajı boş ola bilməz!',
            'future_order_minute.required' => 'Çatma vaxtı boş ola bilməz!',
            'future_order_minute.integer' => 'Çatma vaxtı mətn ola bilməz!',
            'future_order_minute.min' => 'Çatma vaxtı 0-dan az ola bilməz!',
            'order_minute.required' => 'Çatma vaxtı boş ola bilməz!',
            'order_minute.integer' => 'Çatma vaxtı mətn ola bilməz!',
            'order_minute.min' => 'Çatma vaxtı 0-dan az ola bilməz!',
            'order_loop_minute.required' => 'Çatma vaxtı boş ola bilməz!',
            'order_loop_minute.integer' => 'Çatma vaxtı mətn ola bilməz!',
            'order_loop_minute.min' => 'Çatma vaxtı 0-dan az ola bilməz!',
            'public_order_request_time.required' => 'Çatma vaxtı boş ola bilməz!',
            'public_order_request_time.integer' => 'Çatma vaxtı mətn ola bilməz!',
            'public_order_request_time.min' => 'Çatma vaxtı 0-dan az ola bilməz!',
            'show_tariff.required' => 'Tarifləri mobil tətbiqdə göstər sahəsi boş ola bilməz!',
        ];
    }
}
