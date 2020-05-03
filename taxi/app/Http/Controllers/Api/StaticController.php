<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiTaxiLoginRequest;
use App\Http\Requests\OperationBalanceIncreaseRequest;
use App\Modules;
use App\Ut_account;
use App\Ut_address;
use App\Ut_banned_taxi;
use App\Ut_customer;
use App\Ut_messages;
use App\Ut_object_tourniquets;
use App\Ut_options;
use App\Ut_order;
use App\Ut_order_detail;
use App\Ut_order_queue;
use App\Ut_order_status_history;
use App\Ut_order_taxi_temp;
use App\Ut_penalty_strategy;
use App\Ut_priority_strategy;
use App\Ut_priority_transactions;
use App\Ut_setting;
use App\Ut_special_object_category;
use App\Ut_special_objects;
use App\Ut_tariff;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use App\Ut_taxi_geolocation;
use App\Ut_transaction;
use App\Ut_users;
use App\Ut_xref_taxi_order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class StaticController extends Controller
{

    public static function findedTaxi($taxi, $order, $lat, $lng, $important)
    {
        DB::table('ut_taxi')->where('id', $taxi->id)
            ->update([
                'action' => 1,
            ]);

        Ut_order::where('id', $order->id)
            ->update([
                'status' => 1,
                'sort' => 2
            ]);

        $location = json_encode(['latitude' => $lat, 'longitude' => $lng]);

        date_default_timezone_set('Asia/Baku');

        $order_status_id = Ut_order_status_history::insertGetId([
            'order' => $order->id,
            'taxi' => $taxi->id,
            'user_id' => 13, //auth dan gelecek
            'status' => $important ? 50 : 1,
            'reason' => $important ? 'Taksi dispetçer tərəfindən məcburi təyin edildi' : 'Taksi tapdı',
            'date' => date('Y-m-d H:i:s'),
            'location' => $location
        ]);

        $order_temp_id = Ut_order_taxi_temp::insertGetId([
            'taxi_id' => $taxi->id,
            'order_id' => $order->id,
        ]);

    }

    public static function getTaxiOrderPublic()
    {
        try {

            $orders = Ut_order::join('ut_order_detail as utd', 'ut_order.id', 'utd.order_id')
                ->where('ut_order.status', 600)
                ->where('ut_order.taxi', false)
                ->where('ut_order.delete', false)
                ->select('ut_order.*', 'utd.order_date')
                ->groupBy('ut_order.id')
                ->get();

            $result = [];

            if (count($orders)) {
                foreach ($orders as $order) {
                    $result[] = self::getResultFutureOrPublicOrListen($order);
                }
            }

        } catch
        (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return ['status' => 'true', 'error' => '', 'success' => 200, 'result' => true, 'orders' => $result];

    }

    public static function getTaxiOrderFuture()
    {
        try {

            $orders = Ut_order::join('ut_order_detail as utd', 'ut_order.id', 'utd.order_id')
                ->where('ut_order.status', 700)
                ->where('ut_order.taxi', false)
                ->where('ut_order.delete', false)
                ->select('ut_order.*', 'utd.order_date')
                ->groupBy('ut_order.id')
                ->get();

            $result = [];

            if (count($orders)) {
                foreach ($orders as $order) {

                    $order_queue = Ut_order_queue::where('order_id', $order->id)->first();
                    if (!$order_queue) {
                        $result[] = self::getResultFutureOrPublicOrListen($order);
                    }
                }
            }

        } catch
        (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return ['status' => 'true', 'error' => '', 'success' => 200, 'result' => true, 'orders' => $result];

    }

    public static function getResultFutureOrPublicOrListen($order, $own = 0)
    {
        $route = $order->orderDetailName->route;

        $route = json_decode($route);

        if ($order->orderDetailName->payment_method == 1) {
            $payment_method = "Nəğd ödəniş";
            $payment_color = "FF010EFD";
        } elseif ($order->orderDetailName->payment_method == 2) {
            $payment_method = "Nəğdsiz ödəniş";
            $payment_color = "FFE0082C";
        }

        $start = Carbon::parse($order->statusChangesLast->date);
        $timer = Carbon::now()->diffInMinutes($start, true);

        $taxi = $order->taxiName ? $order->taxiName : false;
        if ($taxi) {
            $taxi->color = $order->taxiName->colorName->color_name;
            $taxi->brand = $order->taxiName->brandName->name;
            $taxi->model = $order->taxiName->modelName_->name;
        }


        $result = [
            'id' => $order->id,
            'taxi_object' => $taxi,
            'taxi' => $order->fullTaxiNameWithCodeAndNumber(),
            'taxi_code' => $order->taxiName ? $order->taxiName->code : 0,
            'status' => $order->status,
            'status_text' => $order->statusName(),
            'status_history' => $order->statusChangesLast->status,
            'color' => $order->colorName(),
            'customer_phone' => $order->customerName->phone,
            'full_customer_phone' => $order->customerName->firstname . ' ' . $order->customerName->lastname . ' (' . $order->customerName->phone . ')',
            'source' => $order->source,
            'full_user_name' => $order->orderDetailName->userName->first_name . ' ' . $order->orderDetailName->userName->last_name,
            'price' => number_format($order->orderDetailName->price + $order->orderDetailName->operator_price, 2, '.', ' '),
            'tariff_name' => $order->orderDetailName->tariffName->name,
            'orign_name' => $route[0]->name,
            'orign_lat' => $route[0]->lat,
            'orign_lng' => $route[0]->lng,
            'order_value' => number_format($order->orderDetailName->order_value, 2, '.', ' '),
            'order_type' => $order->orderDetailName->order_type,
            'date' => date('Y-m-d', strtotime($order->orderDetailName->order_date)),
            'time' => date('h:i', strtotime($order->orderDetailName->order_date)),
            'timeout' => $order->orderDetailName->timeout,
            'important' => $order->important,
            'description' => $order->orderDetailName->description,
            'payment_method' => $payment_method,
            'payment_color' => $payment_color,
            'own' => $own,
            'timer' => $timer,
        ];

        array_shift($route);

        $result['destination'] = $route;

        return $result;
    }

    public static function getPriorityRulesCheck($order_id, $taxi_id, $action, $payment_method)
    {
        $order = Ut_order::where('id', $order_id)->first();
        if (!$order) {
            return 403;
        }

        $taxi = Ut_taxi::where(['status' => true, 'id' => $taxi_id])->get()->last();

        if (!$taxi) {
            return 403;
        }

        $priorityRules = Ut_priority_strategy::where([
            'status' => 1,
            'action' => $action,
            'delete' => 0,
            'payment_method' => $payment_method
        ])
            ->where('from_time', '<=', date('H:i:00'))
            ->where('to_time', '>=', date('H:i:00'))
            ->get();


        foreach ($priorityRules as $pR) {
            if ($pR) {
                if ($action == 1) {
                    $description = $order->id . ' №-li sifarişi tamamladığı üçün';
                    $taxiPriority = $taxi->priority + $pR->priority;
                    $priorityTransanction = $pR->priority;
                    //status tarixcesi ucun
                    $taxiPriorityText = $priorityTransanction . ' prirotet artdı';
                } elseif ($action == 2) {
                    $description = $order->id . ' №-li sifarişi ləğv etdiyi üçün';
                    $taxiPriority = $taxi->priority - $pR->priority;
                    $priorityTransanction = '-' . $pR->priority;
                    $taxiPriorityText = $priorityTransanction . ' prirotet azaldı';
                } elseif ($action == 3) {
                    $description = $order->id . ' №-li sifarişi cavabsız qoyduğu üçün';
                    $taxiPriority = $taxi->priority - $pR->priority;
                    $priorityTransanction = '-' . $pR->priority;
                    $taxiPriorityText = $priorityTransanction . ' prirotet azaldı';
                } elseif ($action == 4) {
                    $description = $order->id . ' №-li sifarişi qəbul edib ləğv etdiyi üçün';
                    $taxiPriority = $taxi->priority - $pR->priority;
                    $priorityTransanction = '-' . $pR->priority;
                    $taxiPriorityText = $priorityTransanction . ' prirotet azaldı';
                } else {
                    $description = $order->id . ' №-li sifarişə qarşı naməlum hərəkət etdiyi üçün';
                    $taxiPriority = 0;
                    $priorityTransanction = 0;
                    $taxiPriorityText = $priorityTransanction . ' prirotet azaldı';
                }


                $transaction_id = Ut_priority_transactions::insertGetId([
                    'taxi_id' => $taxi->id,
                    'order_id' => $order->id,
                    'type' => 0,
                    'priority' => $priorityTransanction,
                    'description' => $description,
                    'date' => date('Y-m-d H:i:s')
                ]);

                Ut_order_status_history::insertGetId([
                    'order' => $order->id,
                    'taxi' => $taxi->id,
                    'user_id' => 13,
                    'status' => 20, //Prioritet artımı ve ya azalmasi
                    'reason' => $taxiPriorityText,
                    'date' => date('Y-m-d H:i:s'),
                    'location' => $order->orderDetailName->locationName()
                ]);


                Ut_taxi::where('id', $taxi->id)
                    ->update([
                        'priority' => $taxiPriority,
                    ]);

            }
        }

    }

    public static function getBalanceRulesCheck($order_id, $taxi_id, $action, $payment_method)
    {

        $order = Ut_order::where('id', $order_id)->first();
        if (!$order) {
            return 403;
        }

        $taxi = Ut_taxi::join('ut_accounts as a', 'ut_taxi.id', 'a.destination')
            ->where(['ut_taxi.status' => true, 'ut_taxi.id' => $taxi_id])
            ->select('ut_taxi.*', 'a.id as account_id', 'a.type', 'a.balance')
            ->first();


        $companyAccount = Ut_account::where(['type' => 0, 'destination' => 0])->get()->last();

        if (!$taxi) {
            return 403;
        }

        $penaltiesRules = Ut_penalty_strategy::where([
            'status' => 1,
            'action' => $action,
            'delete' => 0,
            'payment_method' => $payment_method
        ])
            ->where('from_time', '<=', date('H:i:00'))
            ->where('to_time', '>=', date('H:i:00'))
            ->get();

        foreach ($penaltiesRules as $pR) {
            if ($pR) {
                if ($action == 2) {
                    $description = $order->id . ' №-li sifarişi ləğv etdiyi üçün';
                } elseif ($action == 3) {
                    $description = $order->id . ' №-li sifarişi cavabsız qoyduğu üçün';
                } elseif ($action == 4) {
                    $description = $order->id . ' №-li sifarişi qəbul edib ləğv etdiyi üçün';
                } else {
                    $description = $order->id . ' №-li sifarişə qarşı naməlum hərəkət etdiyi üçün';
                }

                $taxiBalanceText = $pR->penalty . ' balansından çıxıldı';

                $transaction_id = Ut_transaction::insertGetId([
                    'user' => 0,
                    'from_account' => $taxi->account_id,
                    'from_account_type' => 1,
                    'to_account' => 1,
                    'to_account_type' => 0,
                    'order' => $order_id,
                    'type' => 3,
                    'amount' => "-" . $pR->penalty,
                    'description' => $description,
                    'date' => date('Y-m-d H:i:s')
                ]);

                $taxiBalance = $taxi->balance - $pR->penalty;
                Ut_account::where(['type' => 1, 'destination' => $taxi->id])
                    ->update([
                        'balance' => $taxiBalance,
                    ]);


                $companyBalance = $companyAccount->balance + $pR->penalty;
                Ut_account::where(['type' => 0, 'destination' => 0])
                    ->update([
                        'balance' => $companyBalance,
                    ]);

                Ut_order_status_history::insertGetId([
                    'order' => $order->id,
                    'taxi' => $taxi->id,
                    'user_id' => 13, //balans artımı
                    'status' => 30,
                    'reason' => $taxiBalanceText,
                    'date' => date('Y-m-d H:i:s'),
                    'location' => $order->orderDetailName->locationName()
                ]);


                FcmController::notification(3, $taxi->fcm_registered_id, 'Ulduz Taxi', 'Metn', $description . ' balansınızdan ' . $pR->penalty . ' AZN çıxıldı');

                FcmController::notification(500, $taxi->fcm_registered_id, 'Ulduz Taxi', '1', '');

            }
        }
    }


}
