<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_message_template extends Model
{
    protected $table = 'ut_message_template';
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
