<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriorityDecreaseRequest extends FormRequest
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
            'category' => 'required|integer',
            'discount' => 'required|integer|min:1|max:100'
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
            'category.required' => 'Kateqoriya sahəsi boş ola bilməz!',
            'category.integer' => 'Kateqoriya sahəsi mətn ola bilməz!',
            'discount.required' => 'Endirim sahəsi boş ola bilməz!',
            'discount.integer' => 'Endirim sahəsi mətn ola bilməz!',
            'discount.min' => 'Endirim sahəsi 1-dən kiçik ola bilməz!',
            'discount.max' => 'Endirim sahəsi 100-dən böyük ola bilməz!',
        ];
    }
}
