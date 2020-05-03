<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_priority_strategy extends Model
{
    protected $table = 'ut_priority_strategy';
    protected $guarded = [];


    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }

   public function scopePriority($query, $priority)
    {
        if ($priority != null) {
            return $query->where('priority', $priority);
        } else {
            return $query;
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            return $query->where('status', $status);
        } else {
            return $query;
        }
    }

    public function scopeAction($query, $action)
    {
        if ($action != null) {
            return $query->where('action', $action);
        } else {
            return $query;
        }
    }

    public function scopeFrom_time($query, $from_time)
    {
        if ($from_time != null) {
            return $query->where('from_time','>=' ,$from_time);
        } else {
            return $query;
        }
    }

    public function scopeTo_time($query, $to_time)
    {
        if ($to_time != null) {
            return $query->where('to_time', '<=' ,$to_time);
        } else {
            return $query;
        }
    }
}
