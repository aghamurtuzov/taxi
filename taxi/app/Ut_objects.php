<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_objects extends Model
{
    protected $table = 'ut_objects';
    protected $guarded = [];

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

    public function scopePage($query, $name)
    {
        return true;

    }

    public function regionName()
    {
        return $this->belongsTo('App\Ut_region', 'region');
    }

    public function cityName()
    {
        return $this->belongsTo('App\Ut_city', 'city');
    }

    public function districtName()
    {
        return $this->belongsTo('App\Ut_district', 'district');
    }

    public function streetName()
    {
        return $this->belongsTo('App\Ut_street', 'street');
    }

    public function typeName()
    {
        return $this->belongsTo('App\Ut_object_category', 'type');
    }


    public function scopeName($query, $name)
    {
        if ($name != null) {
            return $query->where('name', 'LIKE', '%' . $name . '%');
        } else {
            return $query;
        }
    }

    public function scopeDistrict($query, $district)
    {
        if ($district != null) {
            return $query->where('district', $district);
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

    public function scopeStreet($query, $street)
    {
        if ($street != null) {
            $street_id = Ut_street::where('name', 'LIKE', '%' . $street . '%')->value('id');
            return $query->where('street', $street_id);
        } else {
            return $query;
        }
    }

    public function scopeCity($query, $city)
    {
        if ($city != null) {
            return $query->where('city', $city);
        } else {
            return $query;
        }
    }

    public function scopeRegion($query, $region)
    {
        if ($region != null) {
            return $query->where('region', $region);
        } else {
            return $query;
        }
    }


    public function scopeType($query, $type)
    {
        if ($type != null) {
            return $query->where('type', $type);
        } else {
            return $query;
        }
    }
}
