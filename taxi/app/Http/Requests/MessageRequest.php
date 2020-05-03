<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'title' => 'required|string',
            'destination_id' => 'required|integer',
            'message' => 'required',
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
            'title.required' => 'Başlıq sahəsi boş ola bilməz!',
            'destination_id.required' => 'Qəbul edən sahəsi boş ola bilməz!',
            'destination_id.integer' => 'Qəbul edən sahəsi mətn ola bilməz!',
            'message.required' => 'Mesaj sahəsi boş ola bilməz!',
        ];
    }
}
