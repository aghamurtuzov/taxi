<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

Route::get('/login', 'OperatorController@getLogin')->name('getLogin');
Route::post('/login', 'OperatorController@postLogin')->name('postLogin');
Route::get('/logout', 'OperatorController@logout')->name('logout');

Route::middleware('custom')->group(function () {
//
//Route::get('/login', 'OperatorController@getLogin')->name('getLogin');
//Route::post('/login', 'OperatorController@postLogin')->name('postLogin');
//Auth::routes();


Route::get('/dashboard', 'OperatorController@getOperatorDashboard')->name('getDashboard');



//MODULES
Route::post('/module/delete', 'InsertOrUpdateController@postModuleDelete')->name('postModuleDelete');
Route::post('/module/status', 'InsertOrUpdateController@postModuleStatus')->name('postModuleStatus');
Route::get('/module/search/{code}/{viewMain}/{view}', 'InsertOrUpdateController@getModuleSearch')->name('getModuleSearch');
//END MODULES

//START TAXI
Route::get('/taxi', 'TaxiController@getTaxi')->name('getTaxi');
Route::get('/taxi/view/{id}', 'TaxiController@getTaxiView')->name('getTaxiView');
Route::get('/taxi/{id}', 'TaxiController@getTaxiEdit')->name('getTaxiEdit');
Route::post('/taxi/edit/{id}/{module}', 'TaxiController@postTaxiEdit')->name('postTaxiEdit');
Route::get('/taxi/driver-setting/{id}', 'TaxiController@getTaxiDriverSetting')->name('getTaxiDriverSetting');
Route::post('/taxi/driver-setting/{id}/{module}', 'TaxiController@postTaxiDriverSetting')->name('postTaxiDriverSetting');
Route::get('/taxi/driver-setting-standard/{id}', 'TaxiController@postTaxiDriverSettingStandard')->name('postTaxiDriverSettingStandard');
Route::post('/taxi/driver-setting-delete/{id}/{module}', 'TaxiController@postTaxiDriverSettingDelete')->name('postTaxiDriverSettingDelete');
Route::get('/taxi-map/{id?}', 'TaxiController@getTaxiMap')->name('getTaxiMap');
Route::post('/taxi/map', 'TaxiController@postTaxiMap')->name('postTaxiMap');
Route::post('/taxi_get_models', 'TaxiController@getModels')->name('getModels');
Route::post('/taxi/test', 'TaxiController@postTaxiTest')->name('postTaxiTest');

Route::get('/taxi-category', 'TaxiController@getTaxiCategory')->name('getTaxiCategory');
Route::get('/taxi-category/{id}', 'TaxiController@getTaxiCategoryEdit')->name('getTaxiCategoryEdit');
Route::post('/taxi-category/edit/{id}/{module}', 'TaxiController@postTaxiCategoryEdit')->name('postTaxiCategoryEdit');

Route::get('/taxi-characteristics', 'TaxiController@getTaxiCharacteristics')->name('getTaxiCharacteristics');
Route::get('/taxi-characteristics/{id}', 'TaxiController@getTaxiCharacteristicsEdit')->name('getTaxiCharacteristicsEdit');
Route::post('/taxi-characteristics/edit/{id}/{module}', 'TaxiController@postTaxiCharacteristicsEdit')->name('postTaxiCharacteristicsEdit');

Route::get('/taxi-blocked', 'TaxiController@getTaxiBlocked')->name('getTaxiBlocked');
Route::get('/taxi-blocked/{id}', 'TaxiController@getTaxiBlockedEdit')->name('getTaxiBlockedEdit');
Route::post('/taxi-blocked/edit', 'TaxiController@postTaxiBlockedEdit')->name('postTaxiBlockedEdit');
//END TAXI


//START CUSTOMER
Route::get('/customer', 'CustomerController@getCustomer')->name('getCustomer');
Route::get('/customer/{id}', 'CustomerController@getCustomerEdit')->name('getCustomerEdit');
Route::post('/customer/edit/{id}/{module}', 'CustomerController@postCustomerEdit')->name('postCustomerEdit');
Route::get('/customer-view/{id}', 'CustomerController@getCustomerView')->name('getCustomerView');

Route::get('/customer-group', 'CustomerController@getCustomerGroup')->name('getCustomerGroup');
Route::get('/customer-group/{id}', 'CustomerController@getCustomerGroupEdit')->name('getCustomerGroupEdit');
Route::post('/customer-group/edit/{id}/{module}', 'CustomerController@postCustomerGroupEdit')->name('postCustomerGroupEdit');
Route::get('/customer-group-view/{id}', 'CustomerController@getCustomerGroupView')->name('getCustomerGroupView');
Route::get('/customer-group-view-order-search/{id}', 'CustomerController@getCustomerGroupOrdersSearch')->name('getCustomerGroupOrdersSearch');

//END CUSTOMER


Route::get('/module/{page}', 'ModuleController@getModuleTable')->name('getModuleTable');

//CAR

//CAR MARK START
Route::get('/car-mark', 'CarController@getCarMark')->name('getCarMark');
Route::get('/car-mark/{id}', 'CarController@getCarMarkEdit')->name('getCarMarkEdit');
Route::post('/car-mark/edit/{id}/{module}', 'CarController@postCarMarkEdit')->name('postCarMarkEdit');
//CAR MARK END

//CAR model START
Route::get('/car-model', 'CarController@getCarModel')->name('getCarModel');
Route::get('/car-model/{id}', 'CarController@getCarModelEdit')->name('getCarModelEdit');
Route::post('/car-model/edit/{id}/{module}', 'CarController@postCarModelEdit')->name('postCarModelEdit');
//CAR model END


//CAR fuel START
Route::get('/car-fuel-type', 'CarController@getCarFuelType')->name('getCarFuelType');
Route::get('/car-fuel-type/{id}', 'CarController@getCarFuelTypeEdit')->name('getCarFuelTypeEdit');
Route::post('/car-fuel-type/edit/{id}/{module}', 'CarController@postCarFuelTypeEdit')->name('postCarFuelTypeEdit');
//CAR fuel END

//CAR ban type START
Route::get('/car-ban-type', 'CarController@getCarBanType')->name('getCarBanType');
Route::get('/car-ban-type/{id}', 'CarController@getCarBanTypeEdit')->name('getCarBanTypeEdit');
Route::post('/car-ban-type/edit/{id}/{module}', 'CarController@postCarBanTypeEdit')->name('postCarBanTypeEdit');
//CAR ban type END


//CAR driver language START
Route::get('/car-language', 'CarController@getCarLanguage')->name('getCarLanguage');
Route::get('/car-language/{id}', 'CarController@getCarLanguageEdit')->name('getCarLanguageEdit');
Route::post('/car-language/edit/{id}/{module}', 'CarController@postCarLanguageEdit')->name('postCarLanguageEdit');
//CAR driver language END


//CAR car-device language START
Route::get('/car-device', 'CarController@getCarDevice')->name('getCarDevice');
Route::get('/car-device/{id}', 'CarController@getCarDeviceEdit')->name('getCarDeviceEdit');
Route::post('/car-device/edit/{id}/{module}', 'CarController@postCarDeviceEdit')->name('postCarDeviceEdit');
//CAR device language END


//END CAR


//OPERATOR

Route::get('/operator', 'OperatorController@getOperator')->name('getOperator');
Route::post('/postSubGroups', 'OperatorController@postSubGroups')->name('postSubGroups');
Route::get('/operator/{id}', 'OperatorController@getOperatorEdit')->name('getOperatorEdit');
Route::post('/operator/edit/{id}/{module}', 'OperatorController@postOperatorEdit')->name('postOperatorEdit');
Route::get('/operator-view/{id}', 'OperatorController@getOperatorView')->name('getOperatorView');
Route::get('/operator-group', 'OperatorController@getOperatorGroup')->name('getOperatorGroup');

Route::get('/operator-subgroup', 'OperatorController@getOperatorSubGroup')->name('getOperatorSubGroup');
Route::get('/operator-subgroup/{id}', 'OperatorController@getOperatorSubgroupEdit')->name('getOperatorSubgroupEdit');
Route::post('/operator-subgroup/edit/{id}/{module}', 'OperatorController@postOperatorSubgroupEdit')->name('postOperatorSubgroupEdit');
Route::get('/operator-dashboard', 'OperatorController@getOperatorDashboard')->name('getOperatorDashboard');

//END OPERATOR

//SMS
Route::get('/sms', 'SmsMessageController@getSms')->name('getSms');
Route::get('/sms-new/{id}/{type}', 'SmsMessageController@getSmsNew')->name('getSmsNew');
Route::post('/sms/edit', 'SmsMessageController@postSmsEdit')->name('postSmsEdit');
Route::post('/destination/search', 'SmsMessageController@postDestinationSearch')->name('postDestinationSearch');
//END SMS

//SMS-MESSAGE TEMPLATE
Route::get('/sms-message-template/{type}', 'SmsMessageController@getSmsMessageTemplate')->name('getSmsMessageTemplate');
Route::get('/sms-message/template-new/{id}/{module}', 'SmsMessageController@getSmsMessageTemplateNew')->name('getSmsMessageTemplateNew');
Route::post('/sms-message/template-new/{id}/{module}', 'SmsMessageController@postSmsMessageTemplateEdit')->name('postSmsMessageTemplateEdit');
//END SMS-MESSAGE TEMPLATE

//Message
Route::get('/message', 'SmsMessageController@getMessage')->name('getMessage');
Route::get('/message-new/{id}/{type}', 'SmsMessageController@getMessageNew')->name('getMessageNew');
Route::post('/message/edit', 'SmsMessageController@postMessageEdit')->name('postMessageEdit');

//END Message

//Operation
Route::get('/operation', 'OperationController@getOperation')->name('getOperation');
Route::get('/operation-balance-increase', 'OperationController@getOperationBalanceIncrease')->name('getOperationBalanceIncrease');
Route::post('/operation-balance-increase/{id}/{code}', 'OperationController@postOperationBalanceIncreaseEdit')->name('postOperationBalanceIncreaseEdit');
Route::get('/operation-balance-punishment', 'OperationController@getOperationBalancePunishment')->name('getOperationBalancePunishment');
Route::post('/operation-balance-punishment/{id}/{code}', 'OperationController@postOperationBalancePunishmentEdit')->name('postOperationBalancePunishmentEdit');
Route::get('/operation-balance-cashing', 'OperationController@getOperationBalanceCashing')->name('getOperationBalanceCashing');
Route::post('/operation-balance-cashing/{id}/{code}', 'OperationController@postOperationBalanceCashingEdit')->name('postOperationBalanceCashingEdit');

//END Operation

//Priority
Route::get('/priority-operation', 'PriorityController@getPriorityOperation')->name('getPriorityOperation');
Route::get('/priority-operation-new/{id}', 'PriorityController@getPriorityOperationNew')->name('getPriorityOperationNew');
Route::post('/priority-operation/edit/{id}/{module}', 'PriorityController@postPriorityOperationEdit')->name('postPriorityOperationEdit');
Route::get('/priority-decrease', 'PriorityController@getPriorityDecrease')->name('getPriorityDecrease');
Route::post('/priority-decrease/edit', 'PriorityController@postPriorityDecreaseEdit')->name('postPriorityDecreaseEdit');
//END Priority

//Note
Route::get('/note', 'NoteController@getNote')->name('getNote');
Route::get('/note-new', 'NoteController@getNoteNew')->name('getNoteNew');
Route::get('/note-category', 'NoteController@getNoteCategory')->name('getNoteCategory');
//END Note

//Setting
Route::get('/setting-language', 'SettingController@getSettingLanguage')->name('getSettingLanguage');
Route::get('/setting-language/{id}', 'SettingController@getSettingLanguageEdit')->name('getSettingLanguageEdit');
Route::post('/setting-language/edit/{id}/{module}', 'SettingController@postSettingLanguageEdit')->name('postSettingLanguageEdit');
// SETTING LANGUAGE END HERE

//Setting
Route::get('/setting-tariff', 'SettingController@getSettingTariff')->name('getSettingTariff');
Route::get('/setting-tariff/{id}', 'SettingController@getSettingTariffEdit')->name('getSettingTariffEdit');
Route::post('/setting-tariff/edit/{id}/{module}', 'SettingController@postSettingTariffEdit')->name('postSettingTariffEdit');
// SETTING tariff END HERE
Route::get('/setting-pricing-strategy', 'SettingController@getSettingPricingStrategy')->name('getSettingPricingStrategy');
Route::get('/setting-pricing-strategy/{id}', 'SettingController@getSettingPricingStrategyEdit')->name('getSettingPricingStrategyEdit');
Route::post('/setting-pricing-strategy/edit/{id}/{module}', 'SettingController@postSettingPricingStrategyEdit')->name('postSettingPricingStrategyEdit');
// SETTING pricing strategy END HERE
Route::get('/setting-quickly-pricing-strategy', 'SettingController@getSettingQuicklyPricingStrategy')->name('getSettingQuicklyPricingStrategy');
Route::get('/setting-quickly-pricing-strategy/{id}', 'SettingController@getSettingQuicklyPricingStrategyEdit')->name('getSettingQuicklyPricingStrategyEdit');
Route::post('/setting-quickly-pricing-strategy/edit/{id}/{module}', 'SettingController@postSettingQuicklyPricingStrategyEdit')->name('postSettingQuicklyPricingStrategyEdit');
// SETTING FAST pricing strategy END HERE
Route::get('/setting-priority-strategy', 'SettingController@getSettingPriorityStrategy')->name('getSettingPriorityStrategy');
Route::get('/setting-priority-strategy/{id}', 'SettingController@getSettingPriorityStrategyEdit')->name('getSettingPriorityStrategyEdit');
Route::post('/setting-priority-strategy/edit/{id}/{module}', 'SettingController@postSettingPriorityStrategyEdit')->name('postSettingPriorityStrategyEdit');
// SETTING priority strategy END HERE
Route::get('/setting-punishment-strategy', 'SettingController@getSettingPunishmentStrategy')->name('getSettingPunishmentStrategy');
Route::get('/setting-punishment-strategy/{id}', 'SettingController@getSettingPunishmentStrategyEdit')->name('getSettingPunishmentStrategyEdit');
Route::post('/setting-punishment-strategy/edit/{id}/{module}', 'SettingController@postSettingPunishmentStrategyEdit')->name('postSettingPunishmentStrategyEdit');
// SETTING punish strategy END HERE
Route::get('/setting-reason-cancellation', 'SettingController@getSettingReasonCancellation')->name('getSettingReasonCancellation');
Route::get('/setting-reason-cancellation/{id}', 'SettingController@getSettingReasonCancellationEdit')->name('getSettingReasonCancellationEdit');
Route::post('/setting-reason-cancellation/edit/{id}/{module}', 'SettingController@postSettingReasonCancellationEdit')->name('postSettingReasonCancellationEdit');
// SETTING resault cancelation END HERE
Route::get('/setting-user-login-attemps', 'SettingController@getSettingUserLoginAttemps')->name('getSettingUserLoginAttemps');
Route::get('/setting-parameter', 'SettingController@getSettingParameter')->name('getSettingParameter');
Route::post('/setting-parameter', 'SettingController@postSettingParameterEdit')->name('postSettingParameterEdit');

Route::get('/area-pricing', 'SettingController@getSettingAreaPricing')->name('getSettingAreaPricing');
Route::get('/area-pricing-new', 'SettingController@getSettingAreaPricingNew')->name('getSettingAreaPricingNew');
Route::post('/area-pricing', 'SettingController@postSettingAreaPricing')->name('postSettingAreaPricing');
Route::get('/area-pricing-edit/{id}', 'SettingController@getSettingAreaPricingEdit')->name('getSettingAreaPricingEdit');
Route::post('/area-pricing-edit', 'SettingController@postSettingAreaPricingEdit')->name('postSettingAreaPricingEdit');

//END Setting

//Region

//Region

//Region country start
Route::get('/region-country', 'RegionController@getRegionCountry')->name('getRegionCountry');
Route::get('/region-country/{id}', 'RegionController@getRegionCountryEdit')->name('getRegionCountryEdit');
Route::post('/region-country/edit/{id}/{module}', 'RegionController@postRegionCountryEdit')->name('postRegionCountryEdit');
// Region country end
//Region all start
Route::get('/region-all', 'RegionController@getRegionAll')->name('getRegionAll');
Route::get('/region-all/{id}', 'RegionController@getRegionAllEdit')->name('getRegionAllEdit');
Route::post('/region-all/edit/{id}/{module}', 'RegionController@postRegionAllEdit')->name('postRegionAllEdit');
// Region all end
//Region city start
Route::get('/region-city', 'RegionController@getRegionCity')->name('getRegionCity');
Route::get('/region-city/{id}', 'RegionController@getRegionCityEdit')->name('getRegionCityEdit');
Route::post('/region-city/edit/{id}/{module}', 'RegionController@postRegionCityEdit')->name('postRegionCityEdit');
// Region city end
//Region district start
Route::get('/region-district', 'RegionController@getRegionDistrict')->name('getRegionDistrict');
Route::get('/region-district/{id}', 'RegionController@getRegionDistrictEdit')->name('getRegionDistrictEdit');
Route::post('/region-district/edit/{id}/{module}', 'RegionController@postRegionDistrictEdit')->name('postRegionDistrictEdit');
// Region district end
//Region object category start
Route::get('/region-object', 'RegionController@getRegionObject')->name('getRegionObject');
Route::get('/region-object/{id}', 'RegionController@getRegionObjectEdit')->name('getRegionObjectEdit');
Route::post('/region-object/edit/{id}/{module}', 'RegionController@postRegionObjectEdit')->name('postRegionObjectEdit');

Route::get('/region-object-category', 'RegionController@getRegionObjectCategory')->name('getRegionObjectCategory');
Route::get('/region-object-category/{id}', 'RegionController@getRegionObjectCategoryEdit')->name('getRegionObjectCategoryEdit');
Route::post('/region-object-category/edit/{id}/{module}', 'RegionController@postRegionObjectCategoryEdit')->name('postRegionObjectCategoryEdit');
// Region object category end
//Region special object start
Route::get('/region-special-object', 'RegionController@getRegionSpecialObject')->name('getRegionSpecialObject');
Route::get('/region-special-object/{id}', 'RegionController@getRegionSpecialObjectEdit')->name('getRegionSpecialObjectEdit');
Route::post('/region-special-object/edit/{id}/{module}', 'RegionController@postRegionSpecialObjectEdit')->name('postRegionSpecialObjectEdit');
Route::post('/region/address/search', 'RegionController@postDestinationSearchAddress')->name('postDestinationSearchAddress');

// Region special object end
//START region special object category
Route::get('/region-special-object-category', 'RegionController@getRegionSpecialObjectCategory')->name('getRegionSpecialObjectCategory');
Route::get('/region-special-object-category/{id}', 'RegionController@getRegionSpecialObjectCategoryEdit')->name('getRegionSpecialObjectCategoryEdit');
Route::post('/region-special-object-category/edit/{id}/{module}', 'RegionController@postRegionSpecialObjectCategoryEdit')->name('postRegionSpecialObjectCategoryEdit');
//END region special object category
//Region dangerous object start
Route::get('/region-dangerous-object', 'RegionController@getRegionDangerObject')->name('getRegionDangerousObject');
Route::get('/region-dangerous-object/{id}', 'RegionController@getRegionDangerObjectEdit')->name('getRegionDangerousObjectEdit');
Route::post('/region-danger-object/edit/{id}/{module}', 'RegionController@postRegionDangerObjectEdit')->name('postRegionDangerObjectEdit');
// Region dangerous object end
//Region street  start
Route::get('/region-street', 'RegionController@getRegionStreet')->name('getRegionStreet');
Route::get('/region-street/{id}', 'RegionController@getRegionStreetEdit')->name('getRegionStreetEdit');
Route::post('/region-street/edit/{id}/{module}', 'RegionController@postRegionStreetEdit')->name('postRegionStreetEdit');
// Region street  end
//Region turnstile-access  start
Route::get('/region-turnstile-access', 'RegionController@getRegionTurnstileAccess')->name('getRegionTurnstileAccess');
Route::get('/region-turnstile-access/{id}', 'RegionController@getRegionTurnstileAccessEdit')->name('getRegionTurnstileAccessEdit');
Route::post('/region-turnstile-acces/edit/{id}/{module}', 'RegionController@postRegionTurnstileAccessEdit')->name('postRegionTurnstileAccessEdit');
// Region turnstile-access  end

//Region address  start
Route::get('/region-address', 'RegionController@getRegionAddress')->name('getRegionAddress');
Route::get('/region-address-new/{id}', 'RegionController@getRegionAddressNew')->name('getRegionAddressNew');
Route::post('/region-address/edit/{id}/{module}', 'RegionController@postRegionAddressEdit')->name('postRegionAddressEdit');
Route::post('/street/destination/search', 'RegionController@postDestinationSearchStreet')->name('postDestinationSearchStreet');
// Region address  end

//END Region

//Quickly pricing strategy new
Route::get('/quickly-pricing-strategy-new', 'QuicklyPricingStrategyNewController@getQuicklyPricingStrategyNew')->name('getQuicklyPricingStrategyNew');
//END Quickly pricing strategy new

//ORDER
Route::get('/orders', 'OrderController@getOrders')->name('getOrders');
Route::get('/order/new', 'OrderController@getOrderNew')->name('getOrderNew');
Route::post('/order/new', 'OrderController@postOrderNew')->name('postOrderNew');
Route::post('/order/edit/{id}', 'OrderController@postOrderEdit')->name('postOrderEdit');
Route::get('/order/search/place', 'OrderController@getOrderSearchPlace')->name('getOrderSearchPlace');
Route::get('/order-view/{id}', 'OrderController@getOrderView')->name('getOrderView');

Route::post('/order/find/taxi', 'OrderController@postOrderFindTaxi')->name('postOrderFindTaxi');

Route::post('/order/price/calculate', 'OrderController@postOrderPriceCalculate')->name('postOrderPriceCalculate');

Route::post('/search/street-number', 'OrderController@postDestinationSearchStreetNumber')->name('postDestinationSearchStreetNumber');

Route::post('/find/taxi/test', 'OrderController@postFindTaxiTest')->name('postFindTaxiTest');

Route::post('/change/order/status', 'OrderController@postChangeOrderStatus')->name('postChangeOrderStatus');

Route::get('/order/update/{id}', 'OrderController@getOrderUpdate')->name('getOrderUpdate');

Route::post('/order/dispetcer/operator/cancel', 'OrderController@postOrderDispetcerOrOperatorCancel')->name('postOrderDispetcerOrOperatorCancel');

Route::post('/order_customer_name', 'OrderController@getCustomername')->name('getCustomername');

Route::post('/remove_order_taxi', 'OrderController@postOrderRemoveTaxi')->name('postOrderRemoveTaxi');
//END ORDER


});
