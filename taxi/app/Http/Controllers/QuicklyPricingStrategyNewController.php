<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;

class QuicklyPricingStrategyNewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getQuicklyPricingStrategyNew()
    {
        return view('quickly-pricing-strategy.quickly-pricing-strategy-new');
    }

}
