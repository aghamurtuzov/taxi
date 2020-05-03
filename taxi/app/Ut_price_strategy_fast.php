<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_price_strategy_fast extends Model
{
    protected $table = 'ut_price_strategy_fast';
    protected $guarded = [];

    public function tariffList()
    {
        $dataweek = explode(',', $this->tariff);
        

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
    	return $this->belongsTo('App\Ut_tariff','tariff');
    }

    
    public function scopeStart_time($query, $start_time)
    {
        if ($start_time != null) {
            return $query->where('start_time', 'LIKE', '%' . $start_time . '%');
        } else {
            return $query;
        }

    }

   
    public function scopeEnd_time($query, $end_time)
    {
        if ($end_time != null) {
            return $query->where('end_time', $end_time);
        } else {
            return $query;
        }
    }
}
