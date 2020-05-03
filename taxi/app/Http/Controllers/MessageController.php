<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getMessage()
    {
        return view('message.message');
    }

    public function getMessageNew()
    {
        return view('message.message-new');
    }

    public function getMessageTemplate()
    {
        return view('message.message-template');
    }

    public function getCarBanType()
    {
        return view('car.car-ban-type');
    }

    public function getCarLanguage()
    {
        return view('car.car-language');
    }

    public function getCarDevice()
    {
        return view('car.car-device');
    }

}
