<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_banned_taxi extends Model
{
    protected $table = 'ut_banned_taxi';
    protected $guarded = [];


    //get taxiName
    public function taxiName()
    {
        return $this->belongsTo('App\Ut_taxi', 'taxi_id') ? $this->belongsTo('App\Ut_taxi', 'taxi_id') : '';
    }

    public function taxiTabelAndFullName()
    {
        return $this->taxiName ? $this->taxiName->code . ' ' . $this->taxiName->firstname . ' ' . $this->taxiName->lastname : '';
    }

    public function scopeCode($query, $code)
    {
        if ($code != null) {
            $taxi_id = Ut_taxi::where('code', 'LIKE', '%' . $code . '%')->value('id');
            return $query->where('taxi_id', $taxi_id);
        } else {
            return $query;
        }
    }

    public function scopeStart_time($query, $start_time)
    {
        if ($start_time != null) {
            return $query->where('start_time','>' ,$start_time);
        } else {
            return $query;
        }

    }

    public function scopeEnd_time($query, $end_time)
    {
        if ($end_time != null) {
            return $query->where('end_time', '<' ,$end_time);
        } else {
            return $query;
        }

    }

    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            return $query->where('status', $status);
        } else {
            return $query;
        }
    }


    public function scopeStart_time_submit($query, $start_time_submit)
    {
        return true;
    }

    public function scopeEnd_time_submit($query, $end_time_submit)
    {
        return true;
    }


    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }



}
