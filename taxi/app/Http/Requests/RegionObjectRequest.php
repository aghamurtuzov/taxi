<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionObjectRequest extends FormRequest
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
            'type' => 'required|integer',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'region' => 'required|integer',
            
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
            'type.required' => 'Kateqoriya boş ola bilməz!',
            'type.integer' => 'Kateqoriya mətn ola bilməz!',
            'latitude.required' => 'En boş ola bilməz!',
            'longitude.required' => 'Uzunluq boş ola bilməz!',
            'region.required' => 'Region boş ola bilməz!',
            'region.integer' => 'Region mətn ola bilməz!',

        ];
    }
}
