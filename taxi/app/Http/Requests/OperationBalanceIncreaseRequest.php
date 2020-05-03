<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperationBalanceIncreaseRequest extends FormRequest
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
            'destination' => 'required|integer',
            'amount' => 'required',
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
            'destination.required' => 'Qəbul edən sahəsi boş ola bilməz!',
            'destination.integer' => 'Qəbul edən sahəsi mətn ola bilməz!',
            'amount.required' => 'Məbləğ sahəsi boş ola bilməz!',
            'amount.integer' => 'Məbləğ sahəsi mətn ola bilməz!',
        ];
    }
}
