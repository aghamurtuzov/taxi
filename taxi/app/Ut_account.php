<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_account extends Model
{
    protected $table = 'ut_accounts';
    protected $guarded = [];
    public $timestamps = false;

    //get to taxi
    public function taxiName()
    {
        return $this->belongsTo('App\Ut_taxi', 'destination');
    }

    //get to customer
    public function customerName()
    {
        return $this->belongsTo('App\Ut_customer', 'destination');
    }

    //get to customer
    public function customerGroupName()
    {
        return $this->belongsTo('App\Ut_customer_group', 'destination');
    }

    //get to transations
    public function transactions()
    {
        return $this->hasMany('App\Ut_transaction', 'id', 'from_account');
    }

}
