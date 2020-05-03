<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_users extends Authenticatable
{
    protected $table = 'ut_users';
    protected $guarded = [];
    public $timestamps = false;

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'created_on';


    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAuthPassword()
    {
        return $this->passcode;
    }
    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

    // public function groupName(){
    // 	return $this->belongsTo('App\Ut_groups','group');
    // }

    public function scopeName($query, $fullname)
    {
        if ($fullname != null) {
            if (strpos($fullname, ' ') !== false) {
                $exp = explode(' ', $fullname);
                return $query
                    ->where('first_name', 'LIKE', '%' . $exp[0] . '%')
                    ->where('last_name', 'LIKE', '%' . $exp[1] . '%');
            }
            return $query->where('first_name', 'LIKE', '%' . $fullname . '%')
                ->orWhere('last_name', 'LIKE', '%' . $fullname . '%');

        } else {
            return $query;
        }

    }

    public function scopePage($query, $data){
        return true;
    }

    public function scopeUsername($query, $username)
    {
        if ($username != null) {
            return $query->where('username', $username);
        } else {
            return $query;
        }
    }

    public function scopePhone($query, $phone)
    {
        if ($phone != null) {
            return $query->where('phone', $phone);
        } else {
            return $query;
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            return $query->where('active', $status);
        } else {
            return $query;
        }
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
