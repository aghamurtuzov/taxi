<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

//    private $id;
//
//    public function __construct($id)
//    {
//        $this->id = $id;
//    }

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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'company' => 'required|string',
            'phone' => 'required|integer',
            'username' => 'required|string|unique:ut_users,username,' . $this->id,
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
            'parent_group' => 'required|integer',
//            'sub_group' => 'required',
            'active' => 'required|integer',

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
            'first_name.required' => 'Ad boş ola bilməz!',
            'last_name.required' => 'Soyad boş ola bilməz!',
            'email.required' => 'Email boş ola bilməz!',
            'email.email' => 'Email düzgün qeyd edilməldir!',
            'company.required' => 'Şirkət boş ola bilməz!',
            'phone.required' => 'Telefon boş ola bilməz!',
            'username.required' => 'İstifadəçi adı boş ola bilməz!',
            'username.unique' => 'İstifadəçi adı artıq mövcuddur!',
            'password.required' => 'Şifrəni təsdiqlə boş ola bilməz!',
            'confirm_password.required' => 'Parol boş ola bilməz!',
            'password.same' => 'Şifrəni təsdiqlə sahəsi ilə Şifrə sahəsi uyğun gəlmir!',
            'parent_group.required' => 'Qrup sahəsi boş ola bilməz!',
            'parent_group.integer' => 'Qrup sahəsi boş ola bilməz!',
//            'sub_group.required' => 'Alt qrup sahəsi boş ola bilməz!',
            'active.required' => 'Status boş ola bilməz!',
        ];
    }
}
