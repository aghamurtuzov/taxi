<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_area_pricing extends Model
{
    protected $table = 'ut_area_pricing';
    protected $guarded = [];
    public $timestamps = false;


}
