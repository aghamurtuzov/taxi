<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|date',
            'discount' => 'required|integer|min:0|max:100',
            'group' => 'required|integer',
            'gender' => 'required|integer',
            'email' => 'required|email|unique:ut_customer,email,' . $this->id,
            'phone' => 'required|string|unique:ut_customer,phone,' . $this->id,
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
            'firstname.required' => 'Ad boş ola bilməz!',
            'lastname.required' => 'Soyad boş ola bilməz!',
            'birthday.required' => 'Doğum tarixi boş ola bilməz!',
            'birthday.date' => 'Tarix formatında olmalıdır!',
            'discount.required' => 'Endirim boş ola bilməz!',
            'discount.integer' => 'Endirim mətn ola bilməz!',
            'discount.min' => 'Endirim minimum 0 və maksimum 100 ola bilər!',
            'discount.max' => 'Endirim minimum 0 və maksimum 100 ola bilər!',
            'group.required' => 'Qrup boş ola bilməz!',
            'group.integer' => 'Qrup mətn ola bilməz!',
            'gender.required' => 'Cins boş ola bilməz!',
            'gender.integer' => 'Cins mətn ola bilməz!',
            'email.required' => 'Poçt adresi mətn ola bilməz!',
            'email.unique' => 'Poçt adresi artıq mövcuddur!',
            'email.email' => 'Poçt adresi email tipində olmalıdır!',
            'phone.required' => 'Telefon boş ola bilməz!',
            'phone.unique' => 'Telefon artıq mövcuddur!',
            'status.required' => 'Status boş ola bilməz!',

        ];
    }
}
