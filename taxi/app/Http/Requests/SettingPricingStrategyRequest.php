<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingPricingStrategyRequest extends FormRequest
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
            'priority' => 'required|integer',
            'discount' => 'required|integer|max:100',
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
            'priority.required' => 'Siralama boş ola bilməz!',
            'priority.integer' => 'Siralama mətn ola bilməz!',
            'discount.required' => 'Endirim boş ola bilməz!',
            'discount.integer' => 'Endirim mətn ola bilməz!',
            'discount.max' => 'Endirim 100 dən kiçik və ya bərabər ədəd olmalıdır!',

        ];
    }
}
