<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_object_tourniquets extends Model
{
    protected $table = 'ut_object_tourniquets';
    protected $guarded = [];

    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

    public function objectName(){
    	return $this->belongsTo('App\Ut_objects','object_id');
    }

    public function scopeName($query, $name)
    {
        if ($name != null) {
            return $query->where('name', 'LIKE', '%' . $name . '%');
        } else {
            return $query;
        }

    }

    public function scopeObject_name($query, $object)
    {
        if ($object != null) {
            $object_id = Ut_objects::where('name', 'LIKE', '%' . $object . '%')->value('id');
            return $query->where('object_id',$object_id);
        } else {
            return $query;
        }
    }
}
