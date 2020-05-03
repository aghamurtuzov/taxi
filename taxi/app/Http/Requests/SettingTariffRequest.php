<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingTariffRequest extends FormRequest
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
            'free_timeout' => 'required',
            'timeout_fee' => 'required',
            'per_destination_fee' => 'required',
            'status' => 'required|integer',
            'min_to_distance.*' => 'required',
            'min_distance_price.*' => 'required',
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

            'free_timeout.required' => 'Pulsuz gözləmə müddəti (dəq) boş ola bilməz!',
            'free_timeout.max' => 'Pulsuz gözləmə müddəti (dəq) 3 simvoldan simvol ola bilməz!',

            'timeout_fee.required' => 'Əlavə gözləməyə görə ödəniş (1 dəq) boş ola bilməz!',
            'timeout_fee.max' => 'Əlavə gözləməyə görə ödəniş (1 dəq) 3 simvoldan simvol olaa bilməz!',

            'per_destination_fee.required' => 'Əlavə gediş nöqtələrinə görə ödəniş sahəsi  boş ola bilməz!',

            'time_fee.required' => 'Vaxta görə xidmət haqqı (%) boş ola bilməz!',
            'time_fee.max' => 'Vaxta görə xidmət haqqı (%) 3 simvoldan simvol olaa bilməz!',


            'status.required' => 'Status boş ola bilməz!',
            'status.integer' => 'Status mətn ola bilməz!',

            'min_to_distance.*.required' => 'Məsafə boş ola bilməz!',

            'min_distance_price.*.required' => 'Məsafəyə görə qiymət boş ola bilməz!',


        ];
    }
}
