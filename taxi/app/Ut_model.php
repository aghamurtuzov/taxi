<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_model extends Model
{
    protected $table = 'ut_model';
    protected $guarded = [];

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

    public function markName(){
    	return $this->belongsTo('App\Ut_brand','brand');
    }

    public function scopePage($query,$data){
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

    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            return $query->where('status', $status);
        } else {
            return $query;
        }
    }


    public function scopeBrand($query, $mark)
    {
        if ($mark != null) {
            return $query->where('brand', $mark);
        } else {
            return $query;
        }
    }
}
