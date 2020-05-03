<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_priority_transactions extends Model
{
    protected $table = 'ut_priority_transactions';
    protected $guarded = [];

    //get taxi
    public function taxiName()
    {
        return $this->belongsTo('App\Ut_taxi', 'taxi_id');
    }

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

    public function scopeTaxi($query, $taxi)
    {
        return true;
    }

    public function scopeTaxi_id($query, $taxi_id)
    {
        if ($taxi_id != null) {
            return $query->where('taxi_id', $taxi_id);
        } else {
            return $query;
        }
    }

    public function scopeMin_priority($query, $min_priority)
    {
        if ($min_priority != null) {
            return $query->where('priority', '>', $min_priority);
        } else {
            return $query;
        }
    }

    public function scopeMax_priority($query, $max_priority)
    {
        if ($max_priority != null) {
            return $query->where('priority', '<', $max_priority);
        } else {
            return $query;
        }
    }


    public function scopeFrom_date($query, $from_date)
    {
        if ($from_date != null) {
            return $query->where('date', '>=', $from_date);
        } else {
            return $query;
        }

    }

    public function scopeTo_date($query, $to_date)
    {
        if ($to_date != null) {
            return $query->where('date', '<=', $to_date);
        } else {
            return $query;
        }

    }

    public function scopeFrom_date_submit($query, $from_date_submit)
    {
        if ($from_date_submit != null) {
            return $query->where('date', '>', $from_date_submit);
        } else {
            return $query;
        }
    }

    public function scopeTo_date_submit($query, $to_date_submit)
    {
        if ($to_date_submit != null) {
            return $query->where('date', '=<', $to_date_submit);
        } else {
            return $query;
        }
    }


}
