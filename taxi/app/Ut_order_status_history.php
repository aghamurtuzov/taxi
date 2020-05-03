<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_order_status_history extends Model
{
    protected $table = 'ut_order_status_history';
    protected $guarded = [];
    public $timestamps = false;

    public function userName()
    {
        return $this->belongsTo('App\Ut_users', 'user_id');
    }

    //get order name
    public function orderName()
    {
        return $this->belongsTo('App\Ut_order', 'order');
    }


    //get customer full name
    public function fullUserName()
    {
        return $this->userName->first_name . ' ' . $this->userName->last_name;
    }

    public function statusName()
    {

        switch ($this->status) {
            case 0:
                $result = 'Sifarişə taksi axtarılır';
                break;
            case 1:
                $result = 'Sifarişə taksi tapıldı';
                break;
            case 2:
                $result = 'Taksi sifarişi götürdü';
                break;
            case 3:
                $result = 'Taksi müştəriyə çatdı';
                break;
            case 8:
                $result = 'Taksi müştərini götürdü';
                break;
            case 4:
                $result = 'Müştəri düşdü və sifariş tamamlandı';
                break;
            case 15:
                $result = 'Sifariş dəyişikliyi';
                break;
            case 20:
                $result = 'Prioritet artımı';
                break;
            case 25:
                $result = 'Sifarişi götürdükdən sonra taksi ləğv etdi';
                break;
            case 30:
                $result = 'Balans artımı';
                break;
            case 35:
                $result = 'Sifariş ləğv olundu';
                break;
            case 40:
                $result = 'Sifariş ləğv edilmə gözləyir';
                break;
            case 45:
                $result = 'Taksi dispetçer tərəfində çıxarıldı';
                break;
            default:
                $result = 'Sifarişə taksi axtarılır';
        }

        return $result;

    }

    //get taxi
    public function taxiName()
    {
        return $this->belongsTo('App\Ut_taxi', 'taxi');
    }

    //get taxi full name
    public function fullTaxiNameWithCodeAndNumber()
    {
        if ($this->taxiName) {
            return $this->taxiName->code . '-' . $this->taxiName->firstname . ' ' . $this->taxiName->lastname . ' (' . $this->taxiName->phone . ')';
        } else {
            return 'Taksi təyin olunmayıb';
        }
    }


}
