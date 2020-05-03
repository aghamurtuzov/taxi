<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_setting extends Model
{
    protected $table = 'ut_setting';
    protected $guarded = [];


    public function navigatorArray()
    {
        $navigator = explode(',', $this->navigator);

        return $navigator;
    }

}
