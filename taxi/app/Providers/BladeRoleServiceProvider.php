<?php

namespace App\Providers;

use App\Ut_groups;
use App\Ut_users;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class BladeRoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::if('administrator',function(){
                if (session()->get('group')!="1"){
                    return true;
                }
            return false;
        });
        Blade::if('operator',function(){
            if (session()->get('group')!="2"){
                return true;
            }
            return false;
        });
        Blade::if('dispatcher',function(){
            if (session()->get('group')!="3"){
                return true;
            }
            return false;
        });
        Blade::if('accounting',function(){
            if (session()->get('group')!="4"){
                return true;
            }
            return false;
        });
        Blade::if('cashier',function(){
            if (session()->get('group')!="5"){
                return true;
            }
            return false;
        });
        Blade::if('taxipark',function(){
            if (session()->get('group')!="6"){
                return true;
            }
            return false;
        });
    }
}
