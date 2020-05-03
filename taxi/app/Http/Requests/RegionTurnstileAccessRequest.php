<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionTurnstileAccessRequest extends FormRequest
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
            'price' => 'required',

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
            'price.integer' => 'Qiymət mətn ola bilməz!',


        ];
    }
}
