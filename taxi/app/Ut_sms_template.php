<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_sms_template extends Model
{
    protected $table = 'ut_sms_template';
    protected $guarded = [];


    public function scopeMessage($query, $message)
    {
        if ($message != null) {
            return $query->where('message', 'LIKE', '%' . $message . '%');
        } else {
            return $query;
        }

    }

}
