<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriorityOperationRequest extends FormRequest
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
            'taxi_id' => 'required|integer',
            'priority' => 'required|integer'
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
            'taxi_id.required' => 'Taksi sahəsi boş ola bilməz!',
            'taxi_id.integer' => 'Taksi sahəsi mətn ola bilməz!',
            'priority.required' => 'Prioritet sahəsi boş ola bilməz!',
            'priority.integer' => 'Prioritet sahəsi mətn ola bilməz!',
        ];
    }
}
