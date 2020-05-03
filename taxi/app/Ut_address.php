<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_address extends Model
{
    protected $table = 'ut_address';
    protected $guarded = [];


    //get district
    public function districtName()
    {
        return $this->belongsTo('App\Ut_district', 'district');
    }

    //get street
    public function streetName()
    {
        return $this->belongsTo('App\Ut_street', 'street');
    }

    public function scopeStreet($query, $street)
    {
        if ($street != null) {
            $street_id = Ut_street::where('name', 'LIKE', '%' . $street . '%')->value('id');
            return $query->where('street',$street_id);
        } else {
            return $query;
        }
    }
    public function scopePage($query, $name)
    {
        return true;

    }
    public function scopeDistrict($query, $district)
    {
        if ($district != null) {
            $district_id = Ut_district::where('name', 'LIKE', '%' . $district . '%')->value('id');
            return $query->where('district',$district_id);
        } else {
            return $query;
        }
    }

    public function scopeNumber($query, $number)
    {
        if ($number != null) {
            return $query->where('number', $number);
        } else {
            return $query;
        }
    }

    public function scopePriority($query, $priority)
    {
        if ($priority != null) {
            return $query->where('priority', $priority);
        } else {
            return $priority;
        }
    }

    public function scopeSort($query, $sort)
    {
        if ($sort != null) {
            return $query->where('sort', $sort);
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


    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

}
