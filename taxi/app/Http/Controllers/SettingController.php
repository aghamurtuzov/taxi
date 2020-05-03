<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaPricingRequest;
use App\Http\Requests\SettingLanguageRequest;
use App\Http\Requests\SettingParameterRequest;
use App\Http\Requests\SettingPricingStrategyRequest;
use App\Http\Requests\SettingPriorityStrategyRequest;
use App\Http\Requests\SettingPunishmentStrategyRequest;
use App\Http\Requests\SettingQuicklyPricingStrategyRequest;
use App\Http\Requests\SettingReasonCancelationRequest;
use App\Http\Requests\SettingTariffRequest;
use App\Modules;
use App\Ut_area_pricing;
use App\Ut_cancel_reason;
use App\Ut_languages;
use App\Ut_penalty_strategy;
use App\Ut_price_strategy;
use App\Ut_price_strategy_fast;
use App\Ut_priority_strategy;
use App\Ut_setting;
use App\Ut_tariff;
use App\Ut_taxi_live_history;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    // Setting Language start here

    public function getSettingLanguage()
    {
        $results = Ut_languages::where('delete', false)->paginate(20);

        $module = Modules::where('table_name', 'ut_languages')->first();

        return view('setting.setting-language.setting-language', ['results' => $results, 'module' => $module]);
    }


    public function getSettingLanguageEdit($id)
    {
        $result = Ut_languages::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_languages')->first();

        return view('setting.setting-language.setting-language-edit', ['result' => $result, 'module' => $module]);
    }

    public function postSettingLanguageEdit(SettingLanguageRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Dil ");

        return Redirect::back();
    }
    // Setting Language end here


    // Setting Tariff start here

    public function getSettingTariff()
    {
        $results = Ut_tariff::where('delete', false)->paginate(20);

        $module = Modules::where('table_name', 'ut_tariff')->first();

        return view('setting.setting-tariff.setting-tariff', ['results' => $results, 'module' => $module]);
    }


    public function getSettingTariffEdit($id)
    {
        $result = Ut_tariff::where('id', $id)->where('delete', false)->first();

        if ($result) {
            $result->plan_for_time = json_decode($result->plan_for_time, true);
            $result->plan_for_distance = json_decode($result->plan_for_distance, true);
        }
        $module = Modules::where('table_name', 'ut_tariff')->first();

        return view('setting.setting-tariff.setting-tariff-edit', ['result' => $result, 'module' => $module]);
    }

    public function postSettingTariffEdit(SettingTariffRequest $request, $id, $code)
    {

        $plan_for_distance = [];

        $count = count($request->end);
        for ($i = 0; $i < $count; $i++) {
            array_push($plan_for_distance, [
                "start" => $request->start[$i],
                "end" => $request->end[$i],
                "price" => $request->price[$i],
                "fix" => isset($request->fix[$i]) ? 1 : 0,
            ]);

        }

        $request->request->remove('start');
        $request->request->remove('end');
        $request->request->remove('price');
        $request->request->remove('fix');

        $request->merge(['plan_for_distance' => json_encode($plan_for_distance)]);

        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Tarif ");

        return Redirect::back();
    }

    // Setting Tariff end here


    public function getSettingPricingStrategy()
    {
        $results = Ut_price_strategy::where('delete', false)->paginate(20);

        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

        $module = Modules::where('table_name', 'ut_price_strategy')->first();

        return view('setting.setting-pricing-strategy.setting-pricing-strategy', ['results' => $results, 'module' => $module, 'tariffs' => $tariffs]);
    }


    public function getSettingPricingStrategyEdit($id)
    {
        $result = Ut_price_strategy::where('id', $id)->where('delete', false)->first();

        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

        $module = Modules::where('table_name', 'ut_price_strategy')->first();

        return view('setting.setting-pricing-strategy.setting-pricing-strategy-edit', ['result' => $result, 'module' => $module, 'tariffs' => $tariffs]);
    }

    public function postSettingPricingStrategyEdit(SettingPricingStrategyRequest $request, $id, $code)
    {
        if (!empty($request->weekday)) {
            $request->merge([
                'weekday' => implode(',', $request->weekday)
            ]);
        }


        $request->validated();

        $request->request->remove('for');

        DB::table('ut_price_strategy')
            ->where('id', $id)
            ->update([
                'weekday' => null,
                'date' => null
            ]);


        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Qiymət strategiyası ");

        return Redirect::back();
    }

    // Setting PricingStrategy end here


    public function getSettingQuicklyPricingStrategy()
    {
        $results = Ut_price_strategy_fast::where('delete', false)->paginate(20);

        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

        $module = Modules::where('table_name', 'ut_price_strategy_fast')->first();

        return view('setting.setting-quickly-pricing-strategy.setting-quickly-pricing-strategy', ['results' => $results, 'module' => $module, 'tariffs' => $tariffs]);
    }


    public function getSettingQuicklyPricingStrategyEdit($id)
    {
        $result = Ut_price_strategy_fast::where('id', $id)->where('delete', false)->first();

        $tariffs = Ut_tariff::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_price_strategy_fast')->first();

        return view('setting.setting-quickly-pricing-strategy.setting-quickly-pricing-strategy-edit', ['result' => $result, 'module' => $module, 'tariffs' => $tariffs]);
    }

    public function postSettingQuicklyPricingStrategyEdit(SettingQuicklyPricingStrategyRequest $request, $id, $code)
    {
        $request->validated();
        if (!empty($request->tariff)) {
            $request->merge([
                'tariff' => implode(',', $request->tariff)
            ]);
        }


        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Sürətli qiymət strategiyası ");

        return Redirect::back();
    }

    // Setting Quickly PricingStrategy end here


    public function getSettingPriorityStrategy()
    {
        $results = Ut_priority_strategy::where('delete', false)->paginate(20);

        $module = Modules::where('table_name', 'ut_priority_strategy')->first();

        return view('setting.setting-priority-strategy.setting-priority-strategy', ['results' => $results, 'module' => $module]);
    }


    public function getSettingPriorityStrategyEdit($id)
    {
        $result = Ut_priority_strategy::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_priority_strategy')->first();

        return view('setting.setting-priority-strategy.setting-priority-strategy-edit', ['result' => $result, 'module' => $module]);
    }

    public function postSettingPriorityStrategyEdit(SettingPriorityStrategyRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Prioritet strategiyası ");

        return Redirect::back();
    }

    // Setting Priority Strategy end here


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSettingPunishmentStrategy()
    {
        $results = Ut_penalty_strategy::where('delete', false)->paginate(20);

        $module = Modules::where('table_name', 'ut_penalty_strategy')->first();

        return view('setting.setting-punishment-strategy.setting-punishment-strategy', ['results' => $results, 'module' => $module]);
    }

    public function getSettingPunishmentStrategyEdit($id)
    {
        $result = Ut_penalty_strategy::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_penalty_strategy')->first();

        return view('setting.setting-punishment-strategy.setting-punishment-strategy-edit', ['result' => $result, 'module' => $module]);
    }

    public function postSettingPunishmentStrategyEdit(SettingPunishmentStrategyRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Cərimə strategiyası ");

        return Redirect::back();
    }

    // Setting punishment Strategy end here

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSettingReasonCancellation()
    {
        $results = Ut_cancel_reason::where('delete', false)->paginate(20);

        $module = Modules::where('table_name', 'ut_cancel_reason')->first();

        return view('setting.setting-reason-cancellation.setting-reason-cancellation', ['results' => $results, 'module' => $module]);
    }

    public function getSettingReasonCancellationEdit($id)
    {
        $result = Ut_cancel_reason::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_cancel_reason')->first();

        return view('setting.setting-reason-cancellation.setting-reason-cancellation-edit', ['result' => $result, 'module' => $module]);
    }


    public function postSettingReasonCancellationEdit(SettingReasonCancelationRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Ləğv etmə səbəbi");

        return Redirect::back();
    }

    // Setting Reason Cancellation end here

    public function getSettingUserLoginAttemps()
    {
        return view('setting.setting-user-login-attemps');
    }


//////////////////////////////////////////////////////PARAMETER////////////////////////////////////////////


    public function getSettingParameter()
    {
        $result = [];
        $datas = Ut_setting::get();

        foreach ($datas as $data) {
            $result[$data->setting_key] = $data->setting_value;
        }

        //get navigator array
        $result['navigator'] = explode(',', $result['navigator']);

        //get tariff array
        $result['show_tariff'] = explode(',', $result['show_tariff']);

        //get all tarif
        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();


        return view('setting.parameter.setting-parameter', ['result' => $result, 'tariffs' => $tariffs]);
    }

    public function postSettingParameterEdit(SettingParameterRequest $request)
    {
        $request->validated();

        $request->merge([
            'navigator' => implode(',', $request->navigator),
            'show_tariff' => implode(',', $request->show_tariff),
            'public_button_for_operator' => $request->public_button_for_operator ? 1 : 0,
            'show_price' => $request->show_price ? 1 : 0,
            'show_destination' => $request->show_destination ? 1 : 0,
            'offline_location' => $request->offline_location ? 1 : 0,
            'public_order_show_destination' => $request->public_order_show_destination ? 1 : 0,
            'public_order_show_price' => $request->public_order_show_price ? 1 : 0,
            'public_order_show_orign' => $request->public_order_show_orign ? 1 : 0,
            'future_order_show_destination' => $request->future_order_show_destination ? 1 : 0,
            'future_order_show_price' => $request->future_order_show_price ? 1 : 0,
            'future_order_show_orign' => $request->future_order_show_orign ? 1 : 0,
            'show_price_in_order' => $request->show_price_in_order ? 1 : 0,
            'show_time' => $request->show_time ? 1 : 0,
            'show_destination_in_order' => $request->show_destination_in_order ? 1 : 0,
            'show_distance' => $request->show_distance ? 1 : 0,
            'price_strategy' => $request->price_strategy ? 1 : 0,
        ]);


//        return $request->all();


        foreach ($request->all() as $key => $req) {
            DB::table('ut_setting')
                ->where('setting_key', $key)
                ->update([
                    'setting_value' => $req
                ]);
        }


        return Redirect::back();
    }


//////////////////////////////////////////////////////END PARAMETER////////////////////////////////////////////

    public function getSettingAreaPricing()
    {
        $results = Ut_area_pricing::where('delete', false)->where('status', true)->paginate(20);

        $module = Modules::where('table_name', 'ut_area_pricing')->first();

        return view('setting.area-pricing.area-pricing', ['results' => $results, 'module' => $module]);
    }

    public function getSettingAreaPricingNew()
    {
        $module = Modules::where('table_name', 'ut_area_pricing')->first();

        return view('setting.area-pricing.area-pricing-new', ['module' => $module]);
    }

    public function postSettingAreaPricing(AreaPricingRequest $request)
    {
        $request->validated();

        $name = $request->get('name');
        $amount = $request->get('amount');
        $amountStatus = $request->get('amount_status');
        $status = $request->get('status');
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');

        $area_id = Ut_area_pricing::insertGetId([
            'name' => $name,
            'amount' => $amount,
            'amount_status' => $amountStatus,
            'status' => $status,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'date' => date('Y-m-d H:i:s')
        ]);

        Session::flash('success-message', 'Ərazi qiymətləndirmə əlavə edildi');

        return Redirect::back();
    }

    public function getSettingAreaPricingEdit($id)
    {
        $result = Ut_area_pricing::where(['id' => $id, 'status' => true, 'delete' => false])->first();

        $module = Modules::where('table_name', 'ut_area_pricing')->first();

        return view('setting.area-pricing.area-pricing-edit', ['result' => $result, 'module' => $module]);
    }


    public function postSettingAreaPricingEdit(AreaPricingRequest $request, $id)
    {
        $request->validated();

        $name = $request->get('name');
        $amount = $request->get('amount');
        $amountStatus = $request->get('amount_status');
        $status = $request->get('status');
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');

        Ut_area_pricing::where('id', $id)
            ->update([
                'name' => $name,
                'amount' => $amount,
                'amount_status' => $amountStatus,
                'status' => $status,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'date' => date('Y-m-d H:i:s')
            ]);

        Session::flash('success-message', 'Ərazi qiymətləndirməsinə düzəliş edildi');

        return Redirect::back();
    }


}
