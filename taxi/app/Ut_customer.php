<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_customer extends Model
{
    protected $table = 'ut_customer';
    protected $guarded = [];
    public $timestamps = false;

    //get brand
    public function groupName()
    {
        return $this->belongsTo('App\Ut_customer_group', 'group');
    }

    //get account
    public function account()
    {
        return $this->belongsTo('App\Ut_account', 'id', 'destination');
    }

    public function scopeFirstname($query, $firstname)
    {
        if ($firstname != null) {
            return $query->where('firstname', 'LIKE', '%' . $firstname . '%');
        } else {
            return $query;
        }

    }

    public function scopePage($query, $data){
        return true;
    }
    public function scopeLastname($query, $lastname)
    {
        if ($lastname != null) {
            return $query->where('lastname', 'LIKE', '%' . $lastname . '%');
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

    public function scopePhone($query, $phone)
    {
        if ($phone != null) {
            return $query->where('phone', 'LIKE', '%' . $phone . '%');
        } else {
            return $query;
        }

    }

    public function scopeGroup_id($query, $group)
    {
        if ($group != null) {
            return $query->where('group', $group);
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

    public function scopeBanned($query, $banned)
    {
        if ($banned != null) {
            return $query->where('banned', $banned);
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

    public function fullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function fullNameWithNumber()
    {
        return $this->firstname . '' . $this->lastname . ' (' . $this->phone . ')';
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
