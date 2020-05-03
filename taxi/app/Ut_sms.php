<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_sms extends Model
{
    protected $table = 'ut_sms';
    protected $guarded = [];


    //get category
    public function userName()
    {
        return $this->belongsTo('App\Ut_users', 'user_id');
    }

    //get taxi
    public function taxiName()
    {
        return $this->belongsTo('App\Ut_taxi', 'destination_id');
    }

    //get customer
    public function customerName()
    {
        return $this->belongsTo('App\Ut_customer', 'destination_id');
    }

    public function fullName()
    {
        return $this->userName->first_name . ' ' . $this->userName->last_name;
    }


    public function getTaxiOrCustomerName($type)
    {
        if ($type == 1) {
            return $this->taxiName->code . '-' . $this->taxiName->firstname . ' ' . $this->taxiName->lastname;
        } else {
            return $this->customerName->firstname . ' ' . $this->customerName->lastname;
        }
    }

    public function scopeOrder_id($query, $order_id)
    {
        if ($order_id != null) {
            return $query->where('order_id', $order_id);
        } else {
            return $query;
        }

    }
    public function scopePage($query, $data)
    {
        return true;

    }
    public function scopeDestination_type($query, $des_type)
    {
        if ($des_type != null) {
            return $query->where('destination_type', $des_type);
        } else {
            return $query;
        }

    }

    public function scopeDestination_id($query, $destination_id)
    {
        if ($destination_id != null) {
            return $query->where('number', $destination_id);
        } else {
            return $query;
        }

    }

    public function scopeUser_id($query, $user_id)
    {
        if ($user_id != null) {
            return $query->where('user_id', $user_id);
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

    public function scopeFrom_date($query, $from_date)
    {
        if ($from_date != null) {
            return $query->where('date', '>', $from_date);
        } else {
            return $query;
        }

    }

    public function scopeTo_date($query, $to_date)
    {
        if ($to_date != null) {
            return $query->where('date', '=<', $to_date);
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

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

}
