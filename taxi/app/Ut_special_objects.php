<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_special_objects extends Model
{
    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }
    protected $table = 'ut_special_objects';
    protected $guarded = [];

    public function categoryName(){
    	return $this->belongsTo('App\Ut_special_object_category','category_id');
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


    public function scopeCategory($query, $category)
    {
        if ($category != null) {
            return $query->where('category_id', $category);
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
