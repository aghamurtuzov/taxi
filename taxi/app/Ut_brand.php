<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ut_brand extends Model
{
    protected $table = 'ut_brand';

    protected $guarded = [];


    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }



    public function scopeName($query, $name)
    {
        if ($name != null) {
            return $query->where('name', 'LIKE', '%' . $name . '%');
        } else {
            return $query;
        }

    }

    public function scopePage($query,$data){
        return true;
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



}
