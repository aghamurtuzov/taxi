<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Modules;
use App\Ut_banned_taxi;
use App\Ut_body;
use App\Ut_brand;
use App\Ut_city;
use App\Ut_colors;
use App\Ut_country;
use App\Ut_customer_group;
use App\Ut_district;
use App\Ut_driver_language;
use App\Ut_fuel;
use App\Ut_groups;
use App\Ut_model;
use App\Ut_object_category;
use App\Ut_options;
use App\Ut_region;
use App\Ut_special_object_category;
use App\Ut_tariff;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use App\Ut_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class InsertOrUpdateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        App::setLocale('az');
    }

    public static function insertBalance($id, $type)
    {
        DB::table('ut_accounts')->insert([
            'type' => $type,
            'destination' => $id,
            'balance' => 0,
        ]);
    }

    public static function postModuleEdit($data, $id = 0, $code, $message)
    {

        array_shift($data);
        App::setLocale('az');

        $module = Modules::where('code', $code)->value('table_name');
        $appPrefix = 'App';
        $modelName = $appPrefix . '\\' . ucfirst($module);

        if ($id >= 0) {
            if ($id == 0) {

                $id = DB::table($module)->insertGetId($data);

                Session::flash('success-message', $message . ' əlavə edildi');

                if ($modelName == 'App\Ut_taxi') {
                    self::insertBalance($id, 1);
                }
                if ($modelName == 'App\Ut_customer') {
                    self::insertBalance($id, 2);
                }
                if ($modelName == 'App\Ut_customer_group') {
                    self::insertBalance($id, 3);
                }


            } else if ($id > 0) {

                DB::table($module)
                    ->where('id', $id)
                    ->update($data);

                Session::flash('success-message', $message . 'na düzəliş edildi');

            }
        }

        if ($id < 0) {
            $id = abs($id);
            DB::table($module)
                ->where('id', $id)
                ->update([
                    'delete' => true
                ]);
        }

    }

    public function postModuleDelete(Request $request)
    {
        $id = $request->get('id');
        $code = $request->get('code');

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'error' => 'SomethingHaveWrong']);
        }

        $module = Modules::where('code', $code)->first();
        if (!$module) {
            return response()->json(['status' => 'false', 'error' => 'NotFoundModule']);
        }

        DB::table($module->table_name)
            ->where('id', $id)
            ->update([
                'delete' => true,
            ]);

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200]);
    }

    public function postModuleStatus(Request $request)
    {
        $date = Carbon::now();
        $id = $request->get('id');
        $code = $request->get('code');
        $status = $request->get('status');
        $column = $request->get('column');

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'code' => 'required|string',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'false', 'error' => 'SomethingHaveWrong']);
        }

        $module = Modules::where('code', $code)->first();
        if (!$module) {
            return response()->json(['status' => 'false', 'error' => 'NotFoundModule']);
        }
        if ($module->table_name == 'ut_banned_taxi') {
            DB::table($module->table_name)
                ->where('id', $id)
                ->update([
                    'end_time' => $date,
                ]);
        }
        DB::table($module->table_name)
            ->where('id', $id)
            ->update([
                $column => $status,
            ]);

        return response()->json(['status' => $status, 'error' => '', 'success' => 200]);
    }


    public function getModuleSearch(Request $request, $code, $viewMain, $view)
    {
        $data = $request->all();
//        return $data;
        $column_name = $request->get('column_name');
        $order_type = $request->get('order_type');

        //delete first element in data array
        array_shift($data);

        //delete perPage in data array
        $perPage = $data['perPage'];
        unset($data['perPage']);

        //get table name
        $module = Modules::where('code', $code)->first();
        $appPrefix = 'App';
        $modelName = $appPrefix . '\\' . ucfirst($module->table_name);

        $result = $modelName::where('delete', false);
        foreach ($data as $key => $value) {
            if ($key != 'column_name' & $key != 'order_type') {
                $result->$key($value);
            }
        }

        if ($column_name) {
            $result->column_name($column_name, $order_type);
        }

        $results = $result->orderBy('id', 'DESC')->paginate($perPage);


        $data = [
            'results' => $results,
            'module' => $module,
            'perPage' => $perPage,
        ];

        if ($modelName == 'App\Ut_sms' || $modelName == 'App\Ut_messages' || $modelName == 'App\Ut_transaction') {

            $users = Ut_users::where('active', true)->get();

            $data['users'] = $users;
        }
        if ($modelName == 'App\Ut_sms_template' || $modelName == 'App\Ut_message_template') {

            $templateName = $this->getTableNameWithCode($code);

            $data['templateName'] = $templateName;
        }
        if ($modelName == 'App\Ut_region') {

            $countries = Ut_country::where('delete', false)->get();

            $data['countries'] = $countries;
        }
        if ($modelName == 'App\Ut_city') {

            $countries = Ut_country::where('delete', false)->get();

            $regions = Ut_region::where('delete', false)->get();

            $data['countries'] = $countries;
            $data['regions'] = $regions;
        }
        if ($modelName == 'App\Ut_district') {

            $cities = Ut_city::where('delete', false)->get();

            $data['cities'] = $cities;
        }
        if ($modelName == 'App\Ut_special_objects') {

            $categories = Ut_special_object_category::where('delete', false)->get();

            $data['categories'] = $categories;
        }

        if ($modelName == 'App\Ut_customer') {

            $customerGroups = Ut_customer_group::where('delete', false)->get();

            $data['customerGroups'] = $customerGroups;
        }


        if ($modelName == 'App\Ut_taxi') {

            $colors = Ut_colors::where('delete', false)->get();

            $brands = Ut_brand::where('delete', false)->get();

            $models = Ut_model::where('delete', false)->get();

            $bodies = Ut_body::where('delete', false)->get();

            $fuels = Ut_fuel::where('delete', false)->get();

            $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

            $categories = Ut_taxi_categories::where('delete', false)->get();

            $driver_languages = Ut_driver_language::where('delete', false)->get();

            $options = Ut_options::where('delete', false)->get();

            $data['brands'] = $brands;
            $data['models'] = $models;
            $data['bodies'] = $bodies;
            $data['fuels'] = $fuels;
            $data['tariffs'] = $tariffs;
            $data['colors'] = $colors;
            $data['categories'] = $categories;
            $data['driver_languages'] = $driver_languages;
            $data['options'] = $options;
        }


        if ($modelName == 'App\Ut_model') {
            $marks = Ut_brand::where('delete', false)->get();
            $data['marks'] = $marks;
        }
        if ($modelName == 'App\Ut_subgroup') {
            $groups = Ut_groups::where('delete', false)->get();
            $data['groups'] = $groups;
        }
        if ($modelName == 'App\Ut_price_strategy' || $modelName == 'App\Ut_order') {
            $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();
            $data['tariffs'] = $tariffs;
        }

        if ($modelName == 'App\Ut_objects') {
            $districts = Ut_district::where('delete', false)->get();

            $regions = Ut_region::where('delete', false)->get();

            $cities = Ut_city::where('delete', false)->get();

            $types = Ut_object_category::where('delete', false)->get();

            $data['districts'] = $districts;
            $data['regions'] = $regions;
            $data['cities'] = $cities;
            $data['types'] = $types;

        }

        if ($modelName == 'App\Ut_banned_taxi') {

            $bannedTaxies = Ut_banned_taxi::get();

            $data['bannedTaxies'] = $bannedTaxies;
        }


        return view($viewMain . '.' . $view, $data);
    }

    public function getTableNameWithCode($code)
    {
        $m = Modules::where('code', $code)->first();

        if ($m->table_name == 'ut_sms_template') {
            $templateName = 'Sms';
        } else {
            $templateName = 'Mesaj';
        }

        return $templateName;
    }


}
