<?php

namespace App\Http\Controllers;

use App\Events\NewOrderFuture;
use App\Events\OrderFutureRequest;
use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\Api\StaticController;
use App\Http\Requests\CustomerGroupRequest;
use App\Http\Requests\CustomerRequest;
use App\Jobs\SendReminderFutureOrder;
use App\Modules;
use App\Ut_account;
use App\Ut_banned_taxi;
use App\Ut_body;
use App\Ut_brand;
use App\Ut_city;
use App\Ut_country;
use App\Ut_customer;
use App\Ut_customer_group;
use App\Ut_district;
use App\Ut_driver_language;
use App\Ut_fuel;
use App\Ut_groups;
use App\Ut_messages;
use App\Ut_model;
use App\Ut_object_category;
use App\Ut_options;
use App\Ut_order;
use App\Ut_order_queue;
use App\Ut_order_status_history;
use App\Ut_order_taxi_temp;
use App\Ut_region;
use App\Ut_sms;
use App\Ut_special_object_category;
use App\Ut_tariff;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use App\Ut_transaction;
use App\Ut_users;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Timer\Timer;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
    }

    //////////////////////////////////////////////////////// Customer /////////////////////////////////////////////


    public function getCustomer()
    {
        $results = Ut_customer::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_customer')->first();

        $customerGroups = Ut_customer_group::where('delete', false)->get();

        return view('customer.customer', ['results' => $results, 'module' => $module, 'customerGroups' => $customerGroups]);
    }

    public function getCustomerEdit($id)
    {
        $result = Ut_customer::where('id', $id)->where('delete', false)->first();

        $customerGroups = Ut_customer_group::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_customer')->first();

        return view('customer.customer-edit', ['result' => $result, 'module' => $module, 'customerGroups' => $customerGroups]);
    }


    public function postCustomerEdit(CustomerRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Müştəri");

        return Redirect::back();
    }

    public function getCustomerView($id)
    {
        $result = Ut_customer::where('id', $id)->where('delete', false)->first();
        $transactionsFrom = [];
        $transactionsTo = [];

        $module = Modules::where('table_name', 'ut_customer')->first();

        $messages = Ut_messages::where('delete', false)->where('destination_id', $id)->where('destination_type', 2)->get();

        $smses = Ut_sms::where('delete', false)->where('destination_id', $id)->where('destination_type', 2)->get();

        $account = Ut_account::where('type', 1)->where('destination', $id)->first();
        if ($account) {
            $transactionsFrom = Ut_transaction::where('delete', false)->where('from_account', $account->id)->orderBy('id', 'DESC')->paginate(20);
            $transactionsTo = Ut_transaction::where('delete', false)->where('to_account', $account->id)->orderBy('id', 'DESC')->paginate(20);
        }


        return view('customer.customer-view', [
            'result' => $result,
            'module' => $module,
            'messages' => $messages,
            'smses' => $smses,
            'transactionsFrom' => $transactionsFrom,
            'transactionsTo' => $transactionsTo,
        ]);
    }


    //////////////////////////////////////////////////////// END Customer  /////////////////////////////////////////////


    //////////////////////////////////////////////////////// END Customer Group /////////////////////////////////////////////

    public function getCustomerGroup()
    {
        $results = Ut_customer_group::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_customer_group')->first();

        return view('customer.customer-group', ['results' => $results, 'module' => $module]);
    }

    public function getCustomerGroupEdit($id)
    {
        $result = Ut_customer_group::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_customer_group')->first();

        return view('customer.customer-group-edit', ['result' => $result, 'module' => $module]);
    }


    public function postCustomerGroupEdit(CustomerGroupRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Müştəri qrupu");

        return Redirect::back();
    }


    public function getCustomerGroupView($id)
    {
        //Qrup
        $result = Ut_customer_group::where('id', $id)->where('delete', false)->first();
        //Tarifler
        $tariffs = Ut_tariff::where('delete', false)->get();
        $module = Modules::where('table_name', 'ut_customer')->first();

        //sifarisler
        $customers = Ut_customer::where('delete', false)->where('group', $id)->pluck('id');
        $results = Ut_order::where('delete', false)->whereIn('customer', $customers)->paginate(20);

        //Emeliyyatlar
        $account = Ut_account::where('type', 3)->where('destination', $id)->first();
        $transactionsFrom = Ut_transaction::where('delete', false)->where('from_account', $account->id)->orderBy('id', 'DESC')->paginate(20);
        $transactionsTo = Ut_transaction::where('delete', false)->where('to_account', $account->id)->orderBy('id', 'DESC')->paginate(20);

        return view('customer.customer-group-view', [
            'result' => $result,
            'module' => $module,
            'results' => $results,
            'tariffs' => $tariffs,
            'customers' => $result->customers,
            'transactionsFrom' => $transactionsFrom,
            'transactionsTo' => $transactionsTo,
        ]);
    }


    public function getCustomerGroupOrdersSearch(Request $request, $id)
    {
        $result = Ut_customer_group::where('id', $id)->where('delete', false)->first();
        $tariffs = Ut_tariff::where('delete', false)->get();
        $module = Modules::where('table_name', 'ut_customer')->first();
        $customers = Ut_customer::where('delete', false)->where('group', $id)->pluck('id');

        $account = Ut_account::where('type', 3)->where('destination', $id)->first();
        $transactionsFrom = Ut_transaction::where('delete', false)->where('from_account', $account->id)->orderBy('id', 'DESC')->paginate(20);
        $transactionsTo = Ut_transaction::where('delete', false)->where('to_account', $account->id)->orderBy('id', 'DESC')->paginate(20);
////////////////////////////////


        $data = $request->all();

        //delete first element in data array
        array_shift($data);

        //get table name

        $result_ = Ut_order::where('delete', false)->whereIn('customer', $customers);
        foreach ($data as $key => $value) {
            if ($key != 'column_name' & $key != 'order_type') {
                $result_->$key($value);
            }
        }

        $results = $result_->orderBy('id', 'DESC')->paginate(20);


        return view('customer.customer-group-view',
            [
                'result' => $result,
                'module' => $module,
                'results' => $results,
                'tariffs' => $tariffs,
                'customers' => $result->customers,
                'transactionsFrom' => $transactionsFrom,
                'transactionsTo' => $transactionsTo,
            ]);
    }

//////////////////////////////////////////////////////// END Customer Group /////////////////////////////////////////////


}
