<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorSubgroupRequest extends FormRequest
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
            'group' => 'required|integer',
            'name' => 'required|string',
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
            'group.required' => 'Üst kateqoriya boş ola bilməz!',
            'name.required' => 'Ad boş ola bilməz!',  
            'status.required' => 'Status boş ola bilməz!',
            'status.integer' => 'Status mətn ola bilməz!',

        ];
    }
}
