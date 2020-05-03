<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_skat_addresses_filtered extends Model
{
    protected $table = 'ut_skat_addresses_filtered';
    protected $guarded = [];
}
