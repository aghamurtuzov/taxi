<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_price_strategy extends Model
{
    protected $table = 'ut_price_strategy';
    protected $guarded = [];

    public function dataWeek()
    {
        $dataweek = explode(',', $this->weekday);
        

        return $dataweek;
    }

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }
    
    public function tariffName(){
    	return $this->belongsTo('App\Ut_tariff','tariff_id');
    }

    
    public function scopeName($query, $name)
    {
        if ($name != null) {
            return $query->where('name', 'LIKE', '%' . $name . '%');
        } else {
            return $query;
        }

    }

   
    public function scopeTariff($query, $tariff)
    {
        if ($tariff != null) {
            return $query->where('tariff_id', $tariff);
        } else {
            return $query;
        }
    }
}
