<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ut_order_detail extends Model
{
    protected $table = 'ut_order_detail';
    protected $guarded = [];


    //get tariff
    public function tariffName()
    {
        return $this->belongsTo('App\Ut_tariff', 'tariff');
    }

    //get route
    public function routeName()
    {
        $routes = [];
        $route = json_decode($this->route, true);

        foreach ($route as $r) {
            $routes[] = $r['name'];
        }

        $routes['last'] = count($routes) - 1;

        return $routes;

    }

    //get route
    public function locationName()
    {
        $route = json_decode($this->route, true)[0];

        $location = json_encode(['latitude' => $route['lat'], 'longitude' => $route['lng']]);

        return $location;
    }


    //get user
    public function userName()
    {
        return $this->belongsTo('App\Ut_users', 'user_id');
    }

}
