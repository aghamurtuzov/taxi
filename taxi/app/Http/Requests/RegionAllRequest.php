<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionAllRequest extends FormRequest
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
            'sort.required' => 'Siralama boş ola bilməz!',
            'sort.integer' => 'Siralama mətn ola bilməz!',
            'status.required' => 'Status boş ola bilməz!',
            'status.integer' => 'Siralama mətn ola bilməz!',

        ];
    }
}
