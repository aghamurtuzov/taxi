<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingLanguageRequest extends FormRequest
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
            'code' => 'required|string|max:20',
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
            'code.required' => 'Kod boş ola bilməz!',
            'code.max' => 'Kod maximum 20 simvol ola bilər!',
            'sort.integer' => 'Siralama mətn ola bilməz!',
            'status.required' => 'Status boş ola bilməz!',
            'status.integer' => 'Status mətn ola bilməz!',

        ];
    }
}
