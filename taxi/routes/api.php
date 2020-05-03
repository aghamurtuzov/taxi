<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/client')->group(function () {

    Route::get('/customer/detail', 'Api\ClientController@getCustomerDetail')->name('getCustomerDetail');

    Route::post('/login', 'Api\ClientController@postClientLogin')->name('postClientLogin');

    Route::post('/detail/update', 'Api\ClientController@postClientDetailUpdate')->name('postClientDetailUpdate');

    Route::get('/search/address', 'Api\ClientController@getClientSearchAddress')->name('getClientSearchAddress');

    Route::get('/calculate/price', 'Api\ClientController@getClientCalculatePrice')->name('getClientCalculatePrice');

    Route::post('/order', 'Api\ClientController@postClientOrder')->name('postClientOrder');

    Route::get('/taxi/coordinate', 'Api\ClientController@getClientTaxiCoordinate')->name('getClientTaxiCoordinate');

    Route::get('/fc', 'Api\ClientController@getFc')->name('getFc');

    Route::get('/nearly/taxies', 'Api\ClientController@getNearlyTaxies')->name('getNearlyTaxies');

    Route::post('/cancel/order', 'Api\ClientController@postCancelOrder')->name('postCancelOrder');
});

Route::prefix('/taxi')->group(function () {

    Route::post('/login', 'Api\TaxiController@postTaxiLogin')->name('postTaxiLogin');

    Route::get('/message', 'Api\TaxiController@getTaxiMessage')->name('getTaxiMessage');

    Route::post('/message/read', 'Api\TaxiController@postTaxiMessageRead')->name('postTaxiMessageRead');

    Route::get('/order-histories', 'Api\TaxiController@getTaxiOrderHistories')->name('getTaxiOrderHistories');

    Route::get('/balance-transactions', 'Api\TaxiController@getTaxiBalanceTransactions')->name('getTaxiBalanceTransactions');

    Route::get('/balance-histories', 'Api\TaxiController@getTaxiBalanceHistories')->name('getTaxiBalanceHistories');

    Route::get('/priority/list', 'Api\TaxiController@getTaxiPriorityList')->name('getTaxiPriorityList');

    Route::get('/priority-histories', 'Api\TaxiController@getTaxiPriorityHistories')->name('getTaxiPriorityHistories');

    Route::post('/coordinate', 'Api\TaxiController@postTaxiCoordinate')->name('postTaxiCoordinate');

    Route::get('/order/listen', 'Api\TaxiController@getTaxiOrderListen')->name('getTaxiOrderListen');

    Route::get('/detail', 'Api\TaxiController@getTaxiDetail')->name('getTaxiDetail');

    Route::post('/order/cancel', 'Api\TaxiController@postTaxiOrderCancel')->name('postTaxiOrderCancel');

    Route::post('/order/accept', 'Api\TaxiController@postTaxiOrderAccept')->name('postTaxiOrderAccept');

    Route::post('/order/apply', 'Api\TaxiController@postTaxiOrderApply')->name('postTaxiOrderApply');

    Route::post('/order/pickup', 'Api\TaxiController@postTaxiOrderPickup')->name('postTaxiOrderPickup');

    Route::post('/order/complete', 'Api\TaxiController@postTaxiOrderComplete')->name('postTaxiOrderComplete');

    Route::get('/order/future', 'Api\TaxiController@getTaxiOrderFuture')->name('getTaxiOrderFuture');

    Route::post('/order/future/request', 'Api\TaxiController@postTaxiOrderFutureRequest')->name('postTaxiOrderFutureRequest');

    Route::get('/order/public', 'Api\TaxiController@getTaxiOrderPublic')->name('getTaxiOrderPublic');

    Route::post('/order/public/request', 'Api\TaxiController@postTaxiOrderPublicRequest')->name('postTaxiOrderPublicRequest');

    Route::get('/regions', 'Api\TaxiController@getTaxiRegions')->name('getTaxiRegions');

    Route::get('/region/objects', 'Api\TaxiController@getTaxiRegionObjects')->name('getTaxiRegionObjects');

    Route::post('/order/cancel-request', 'Api\TaxiController@postTaxiOrderCancelRequest')->name('postTaxiOrderCancelRequest');

    Route::post('/order/fail', 'Api\TaxiController@postTaxiOrderFail')->name('postTaxiOrderFail');

    Route::post('/live', 'Api\TaxiController@postTaxiLive')->name('postTaxiLive');

    Route::post('/move/balance', 'Api\TaxiController@postTaxiMoveBalance')->name('postTaxiMoveBalance');

});

