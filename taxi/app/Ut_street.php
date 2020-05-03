<?php

namespace App;
use App\Ut_region;
use App\Ut_city;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_street extends Model
{
    protected $table = 'ut_street';
    protected $guarded = [];

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }
    public function regionName(){
    	return $this->belongsTo('App\Ut_region','region');
    }
    public function cityName(){
    	return $this->belongsTo('App\Ut_city','city');
    }
    public function addressName(){
        return $this->hasMany('App\Ut_address','steet');
    }
    public function scopePage($query, $name)
    {
        return true;

    }
    public function scopeName($query, $name)
    {
        if ($name != null) {
            return $query->where('name', 'LIKE', '%' . $name . '%');
        } else {
            return $query;
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
    public function scopeKeyword($query, $keyword)
    {
        if ($keyword != null) {
            return $query->where('keyword', $keyword);
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
    public function scopePriority($query, $priority)
    {
        if ($priority != null) {
            return $query->where('priority', $priority);
        } else {
            return $priority;
        }
    }

     public function scopeRegion($query, $region)
    {
        if ($region != null) {
            $region_id =  Ut_region::where('name', 'LIKE', '%' . $region . '%')->value('id');
            return $query->where('region',$region_id);
        } else {
            return $query;
        }

    }

    public function scopeCity($query, $city)
    {
        if ($city != null) {
            $city_id = Ut_city::where('name', 'LIKE', '%' . $city . '%')->value('id');
            return $query->where('city',$city_id);
        } else {
            return $query;
        }
    }
}
