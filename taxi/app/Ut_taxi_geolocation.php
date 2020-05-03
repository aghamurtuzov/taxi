<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_taxi_geolocation extends Model
{
    protected $table = 'ut_taxi_geolocation';
    protected $guarded = [];
}
