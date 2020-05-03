<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxiRequest extends FormRequest
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
            'number' => 'required|string',
            'tariff' => 'required',
            'brand' => 'required|integer',
            'color' => 'required|string',
            'year' => 'required|string',
            'body' => 'required|integer',
            'model' => 'required|integer',
//            'fuel' => 'required|integer',
//            'fuel_consumption' => 'required|string',
//            'transmission' => 'required|integer',
//            'passport' => 'required|string',
//            'pin_code' => 'required|string',
//            'driver_license' => 'required|string',
//            'technical_passport' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
//            'fathername' => 'required|string',
            'sex' => 'required|integer',
            'birthday' => 'required|date',
//            'address' => 'required|string',
            'phone_prefix' => 'required|string',
            'phone' => 'required|string',
//            'email' => 'required|string|email',
//            'device_marka' => 'required|integer',
//            'device_model' => 'required|string',
//            'distance' => 'required|string',
//            'status' => 'required|integer',
//            'option' => 'required',
//            'category' => 'required',
//            'language' => 'required',
            'code' => 'required|string|max:6|unique:ut_taxi,code,' . $this->id,
//            'free' => 'required|string',
//            'region_id' => 'required|string',
//            'is_company' => 'required|string',
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
            'number.required' => 'Nömrə nişanı boş ola bilməz!',
            'tariff.required' => 'Tarif boş ola bilməz!',
            'brand.required' => 'Marka boş ola bilməz!',
            'brand.integer' => 'Marka mətn ola bilməz!',
            'model.required' => 'Model boş ola bilməz!',
            'color.required' => 'Rəng boş ola bilməz!',
            'year.required' => 'İl boş ola bilməz!',
            'body.required' => 'Ban növü boş ola bilməz!',
//            'fuel.required' => 'Yanacaq növü boş ola bilməz!',
//            'fuel.integer' => 'Yanacaq növü mətn ola bilməz!',
//            'fuel_consumption.required' => 'Yanacaq sərfi boş ola bilməz!',
//            'transmission.required' => 'Sürət qutusu boş ola bilməz!',
//            'transmission.integer' => 'Sürət qutusu mətn ola bilməz!',
//            'passport.required' => 'Ş/V seriyası boş ola bilməz!',
//            'pin_code.required' => 'Ş/V fin kodu boş ola bilməz!',
//            'driver_license.required' => 'Sürücülük Vəsiqəsi boş ola bilməz!',
//            'technical_passport.required' => 'Texpasport boş ola bilməz!',
            'firstname.required' => 'Ad boş ola bilməz!',
            'lastname.required' => 'Soyad boş ola bilməz!',
//            'fathername.required' => 'Ata adı boş ola bilməz!',
            'sex.required' => 'Cins boş ola bilməz!',
            'sex.integer' => 'Cins mətn ola bilməz!',
            'birthday.required' => 'Doğum günü boş ola bilməz!',
            'birthday.date' => 'Doğum günü tarix formatında olmalıdır!',
//            'address.required' => 'Qeydiyyat ünvanı boş ola bilməz!',
            'phone_prefix.required' => 'Mobil prefiks boş ola bilməz!',
            'phone.required' => 'Mobil nömrə boş ola bilməz!',
//            'email.required' => 'E-mail boş ola bilməz!',
//            'email.email' => 'E-mail e-mail formatında olmalıdır!',
//            'device_marka.required' => 'Marka boş ola bilməz!',
//            'device_marka.integer' => 'Marka mətn ola bilməz!',
//            'device_model.required' => 'Model boş ola bilməz!',
//            'distance.required' => 'Sürücünün Km boş ola bilməz!',
//            'status.required' => 'Status boş ola bilməz!',
            'status.integer' => 'Status mətn ola bilməz!',
//            'option.required' => 'Aqreqatlar boş ola bilməz!',
//            'category.required' => 'Taksi categoriyaları boş ola bilməz!',
//            'language.required' => 'Bildiyi Dillər boş ola bilməz!',
            'code.required' => 'Kod boş ola bilməz!',
            'code.max' => 'Kod boş ola bilməz!',
            'code.unique' => 'Tabel nömrəsi başqa taksiyə aiddir.!',
//            'free.required' => 'Balanssız boş ola bilməz!',
//            'region_id.required' => 'Rayon boş ola bilməz!',
//            'is_company.required' => 'Kompaniya maşını? boş ola bilməz!',
        ];
    }
}
