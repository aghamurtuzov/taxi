<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_transaction extends Model
{
    protected $table = 'ut_transaction';
    protected $guarded = [];

    //get category
    public function userName()
    {
        if ($this->user) {
            return $this->belongsTo('App\Ut_users', 'user');
        } else {
            return false;
        }
    }

    //get from account
    public function accountFromName()
    {
        return $this->belongsTo('App\Ut_account', 'from_account');
    }

    //get to account
    public function accountToName()
    {
        return $this->belongsTo('App\Ut_account', 'to_account');
    }

    public function getAccountName($type)
    {
        if(!$this->$type){
            return '';
        }
        switch ($this->$type->type) {
            case 1:
                $account = $this->$type->taxiName->fullNameWithCodeAndNumber();
                break;
            case 2:
                $account = $this->$type->customerName->fullNameWithNumber();
                break;
            case 3:
                $account = $this->$type->customerGroupName->name;
                break;
            default:
                $account = '';
        }

        return $account;

    }

    //get customer
    public function customerName()
    {
        return $this->belongsTo('App\Ut_customer', 'destination_id');
    }

    //get type for operation
    public function typeName()
    {

        switch ($this->type) {
            case 1:
                $type = 'Sifariş';
                break;
            case 2:
                $type = 'Geri qayıtma';
                break;
            case 3:
                $type = 'Cərimə';
                break;
            case 4:
                $type = 'Balans';
                break;
            default:
                $type = '';
        }

        return $type;
    }

    //get account type for operation
    public function accountTypeName($accountType)
    {

        switch ($accountType) {
            case 1:
                $accountType = 'Nağd';
                break;
            case 2:
                $accountType = 'Elektron';
                break;
            case 3:
                $accountType = 'Bonus';
                break;
            default:
                $accountType = '';
        }

        return $accountType;
    }

//    SCOPE

    public function scopeSender_type($query, $sender_type)
    {
        if ($sender_type != null) {
            $type = Ut_account::where('type', $sender_type)->pluck('id');
            return $query->whereIn('from_account', $type);
        } else {
            return $query;
        }
    }

    public function scopeDestination_name($query, $destination_name)
    {
        return true;
    }


    public function scopeDestination($query, $destination)
    {
        if ($destination != null) {
            $type = Ut_account::where('destination', $destination)->pluck('id');
            return $query->whereIn('from_account', $type);
        } else {
            return $query;
        }
    }


    public function scopeReceiver_type($query, $receiver_type)
    {
        if ($receiver_type != null) {
            $type = Ut_account::where('type', $receiver_type)->pluck('id');
            return $query->whereIn('to_account', $type);
        } else {
            return $query;
        }
    }

    public function scopeDestination_2($query, $destination)
    {
        if ($destination != null) {
            $type = Ut_account::where('destination', $destination)->pluck('id');
            return $query->whereIn('to_account', $type);
        } else {
            return $query;
        }
    }

    public function scopeDestination_name_2($query, $destination_name)
    {
        return true;
    }

    public function scopeUser($query, $user)
    {
        if ($user != null) {
            return $query->where('user', $user);
        } else {
            return $query;
        }
    }


    public function scopeType($query, $type)
    {
        if ($type != null) {
            return $query->where('type', $type);
        } else {
            return $query;
        }
    }


    public function scopeMin_amount($query, $min_amount)
    {
        if ($min_amount != null) {
            return $query->where('amount', '>', $min_amount);
        } else {
            return $query;
        }

    }

    public function scopeMax_amount($query, $max_amount)
    {
        if ($max_amount != null) {
            return $query->where('amount', '<', $max_amount);
        } else {
            return $query;
        }
    }

    public function scopeOrder_id($query, $order_id)
    {
        if ($order_id != null) {
            return $query->where('order', $order_id);
        } else {
            return $query;
        }
    }

    public function scopeFrom_date($query, $from_date)
    {
        if ($from_date != null) {
            return $query->where('date', '>=', $from_date);
        } else {
            return $query;
        }

    }

    public function scopeTo_date($query, $to_date)
    {
        if ($to_date != null) {
            return $query->where('date', '<=', $to_date);
        } else {
            return $query;
        }

    }

    public function scopeFrom_date_submit($query, $from_date_submit)
    {
        return true;
    }

    public function scopeTo_date_submit($query, $to_date_submit)
    {
        return true;
    }


    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

//    END SCOPE

}
