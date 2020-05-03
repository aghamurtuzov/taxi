<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_xref_taxi_order extends Model
{
    protected $table = 'ut_xref_taxi_order';
    protected $guarded = [];
}
