<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_order_taxi_temp extends Model
{
    protected $table = 'ut_order_taxi_temp';
    protected $guarded = [];
}
