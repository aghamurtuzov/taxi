<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerGroupRequest extends FormRequest
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
            'discount' => 'required|integer|min:0|max:100',
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
            'discount.required' => 'Endirim boş ola bilməz!',
            'discount.integer' => 'Endirim mətn ola bilməz!',
            'discount.min' => 'Endirim minimum 0 və maksimum 100 ola bilər!',
            'discount.max' => 'Endirim minimum 0 və maksimum 100 ola bilər!',
            'sort.required' => 'Siralama boş ola bilməz!',
            'sort.integer' => 'Siralama mətn ola bilməz!',
            'status.required' => 'Status boş ola bilməz!',

        ];
    }
}
