<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\FcmClientController;
use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\Api\StaticController;
use App\Http\Requests\OperationBalanceIncreaseRequest;
use App\Modules;
use App\Ut_account;
use App\Ut_address;
use App\Ut_area_pricing;
use App\Ut_call;
use App\Ut_customer;
use App\Ut_object_tourniquets;
use App\Ut_options;
use App\Ut_order;
use App\Ut_order_detail;
use App\Ut_order_queue;
use App\Ut_order_status_history;
use App\Ut_order_taxi_temp;
use App\Ut_price_strategy;
use App\Ut_setting;
use App\Ut_tariff;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use App\Ut_transaction;
use App\Ut_users;
use App\Ut_xref_taxi_order;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOrders()
    {
        $results = Ut_order::where('delete', false)->orderBy('sort', 'ASC')->get();

        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

        $module = Modules::where('table_name', 'ut_order')->first();

        $cancel_request_count = 0;

        if (count($results)) {
            foreach ($results as $r) {
                $last_status_history = Ut_order_status_history::where('order', $r->id)->get()->last();
                if ($last_status_history && $last_status_history->status == 40) {
                    $cancel_request_count++;
                }

                $start = Carbon::parse($last_status_history->date);
                $r->timer = Carbon::now()->diffInMinutes($start, true);

                $r->statusHistory = $last_status_history->status;
            }
        }
        return view('order.order', [
            'results' => $results,
            'tariffs' => $tariffs,
            'module' => $module,
            'cancel_request_count' => $cancel_request_count,
        ]);
    }

    public function getOrderView($id)
    {
        $results = Ut_order_status_history::where(['order' => $id])->orderBy('id', 'ASC')->get();

        return view('order.order-view', [
            'results' => $results,
            'id' => $id,
        ]);
    }

    public function getOrderNew()
    {
        $module = Modules::where('table_name', 'ut_order')->first();

        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

        $options = Ut_options::where('delete', false)->where('status', true)->get();

        return view('order.order-new', [
            'module' => $module,
            'tariffs' => $tariffs,
            'options' => $options
        ]);
    }

    public function getOrderUpdate($id)
    {
        $result = Ut_order::where('id', $id)->first();

        $module = Modules::where('table_name', 'ut_order')->first();

        $tariffs = Ut_tariff::where('delete', false)->where('status', true)->get();

        $options = Ut_options::where('delete', false)->where('status', true)->get();

        Ut_order::where('id', $id)
            ->update([
                'auto_search' => 0,
            ]);

//        return $result->routeNameEdit();

        return view('order.order-update', [
            'result' => $result,
            'tariffs' => $tariffs,
            'module' => $module,
            'options' => $options
        ]);
    }

    public function postOrderNew(Request $request)
    {
        try {

            date_default_timezone_set('Asia/Baku');

            $name = $request->get('customer_name');
            $number = $request->get('number');

            $tariff = $request->get('tariff');
            $orderType = $request->get('orderType');
            $payment_method = $request->get('payment_method');
            $options = $request->get('options');
            $timeout = $request->get('timeout');
            $km = $request->get('km');
            $price = $request->get('price');
            $operatorPrice = $request->get('operatorPrice') ?? 0;
            $orderDate = $request->get('orderDate');
            $orderWeekday = $request->get('orderWeekday');
            $route = $request->get('route');
            $description = $request->get('description');
            $destination_id = $request->get('destination_id');
            $destination_type = $request->get('destination_type');
            $lat = $request->get('lat');
            $lng = $request->get('lng');
            $tourniquet_price = $request->get('tourniquet_price');
            $tourniquet_type = $request->get('tourniquet_type');
            $tourniquet_will_pay = $request->get('tourniquet_will_pay');
            $number_street = $request->get('number_street');
            $auto_search = $request->get('auto_search') ? 1 : 0;
            $is_public = $request->get('is_public') ? 1 : 0;
            $taxi_id = $request->get('taxi_id') ?? 0;

            $errors = [];

            $tariff = Ut_tariff::where('id', $tariff)->where('status', true)->where('delete', false)->first();

            if (!$tariff) {
                $errors[] = 'Tariff tapilmadi';
            }

            $customer = Ut_customer::where(['delete' => false, 'status' => true, 'phone' => $number])->first();
            if ($customer) {
                $customer->update(['firstname' => $name]);
                $customer_id = $customer->id;
            } else {
                $customer_id = Ut_customer::insertGetId(['phone' => $number, 'firstname' => $name, 'date' => date('Y-m-d H:i:s')]);

                $account_id = Ut_account::insertGetId(['destination' => $customer_id, 'type' => 2]);
            }


            $routes = [];

            for ($i = 0; $i < count($destination_id); $i++) {
                $routes[] = [
                    'id' => $destination_id[$i],
                    'name' => $route[$i],
                    'type' => $destination_type[$i],
                    'lat' => $lat[$i],
                    'lng' => $lng[$i],
                    'price' => $tourniquet_price[$i] ? $tourniquet_price[$i] : '0',
                    'will_pay' => $tourniquet_will_pay[$i],
                    'street' => $number_street[$i]
                ];
            }

            $options = json_encode($options);
            $routes = json_encode($routes);


            $date = new DateTime();
            $date->modify("+30 minutes");

            if ($orderDate > $date) {
                $status = 700;
            } else {
                $status = 0;
            }


            $order_id = Ut_order::insertGetId([
                'taxi' => 0,
                'test' => false,
                'color' => $payment_method ? '' : '',
                'auto_search' => $auto_search,
                'public' => $is_public,
                'status' => $is_public ? 600 : $status,
                'customer' => $customer_id,
                'created_at' => date('Y-m-d H:i:s'),
                'user_id' => 13,
                'last_xref_id' => 2,
                'sort' => $is_public ? 1 : 0, //1-aciq , 0-adi
            ]);


            if ($order_id) {
                $order_detail_id = Ut_order_detail::insertGetId([
                    'order_id' => $order_id,
                    'route' => $routes,
                    'price' => $price,
                    'operator_price' => $operatorPrice,
                    'order_type' => 1,
                    'order_value' => $km,
                    'description' => $description,
                    'tariff' => $tariff->id,
                    'order_date' => $orderDate,
                    'user_id' => 13,
                    'payment_method' => $payment_method,
                    'timeout' => $timeout,
                    'option' => $options,
                    'date' => date('Y-m-d H:i:s'),
                ]);


                $location = json_encode(['latitude' => $lat[0], 'longitude' => $lng[0]]);


                $order_status_id = Ut_order_status_history::insertGetId([
                    'order' => $order_id,
                    'taxi' => $taxi_id,
                    'user_id' => 13,
                    'status' => 0,
                    'reason' => 'Sifariş yaradıldı ve taksi axtarır',
                    'date' => date('Y-m-d H:i:s'),
                    'location' => $location
                ]);

                $order_status_id = Ut_call::insertGetId([
                    'number' => $customer->phone,
                    'order_id' => $order_id,
                    'callid' => 1,
                    'date' => date('Y-m-d H:i:s'),
                ]);


                if ($status == 700) {
                    $order = StaticController::getTaxiOrderFuture();
                    FcmController::notification(700, '/topics/taxi', 'Basliq', 'Metn', $order);
                }

                if ($is_public) {
                    $orderOpens = StaticController::getTaxiOrderPublic();

                    FcmController::notification(600, '/topics/taxi', 'Basliq', 'Metn', $orderOpens);
                }

                if ($taxi_id) {
                    $order = Ut_order::where('id', $order_id)->get()->last();
                    $taxi = Ut_taxi::where('id', $taxi_id)->get()->last();
                    StaticController::findedTaxi($taxi, $order, $lat, $lng, 1);

                    //fcm ucun order and order detail
                    $order = StaticController::getResultFutureOrPublicOrListen($order);
                    FcmController::notification(1, $taxi->fcm_registered_id, 'Basliq', 'Metn', $order);
                }

                $order = Ut_order::where(['delete' => false, 'id' => $order_id])->first();
                $order = StaticController::getResultFutureOrPublicOrListen($order, 0);
                broadcast(new \App\Events\OrderEvent($order, 0));

                $this->postFindTaxiTest();

            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200]);
    }


    public function postOrderEdit(Request $request)
    {
        try {

            $order_id = $request->get('id');

            $tariff = $request->get('tariff');
            $orderType = $request->get('orderType');
            $payment_method = $request->get('payment_method');
            $options = $request->get('options');
            $timeout = $request->get('timeout');
            $km = $request->get('km');
            $price = $request->get('price');
            $operatorPrice = $request->get('operatorPrice') ?? 0;
            $orderDate = $request->get('orderDate');
            $orderWeekday = $request->get('orderWeekday');
            $route = $request->get('route');
            $description = $request->get('description');
            $destination_id = $request->get('destination_id');
            $destination_type = $request->get('destination_type');
            $lat = $request->get('lat');
            $lng = $request->get('lng');
            $tourniquet_price = $request->get('tourniquet_price');
            $tourniquet_type = $request->get('tourniquet_type');
            $tourniquet_will_pay = $request->get('tourniquet_will_pay');
            $number_street = $request->get('number_street');
            $auto_search = $request->get('auto_search') ? 1 : 0;
            $is_public = $request->get('is_public') ? 1 : 0;
            $taxi_id = $request->get('taxi_id') ?? 0;

            date_default_timezone_set('Asia/Baku');

            $errors = [];

            $tariff = Ut_tariff::where('id', $tariff)->where('status', true)->where('delete', false)->first();

            if (!$tariff) {
                $errors[] = 'Tariff tapilmadi';
            }

            $order = Ut_order::where('id', $order_id)->where('delete', false)->first();

            if (!$order) {
                return response()->json(['status' => 'false', 'error' => 'Sifaris tapilmadi']);
            }

            $taxi = Ut_taxi::where(['status' => true, 'id' => $taxi_id])->get()->last();

            $location = json_encode(['latitude' => $lat[0], 'longitude' => $lng[0]]);

            $date = new DateTime();
            $date->modify("+30 minutes");

            if ($orderDate > $date) {
                $status = 700;
            } else {
                $status = 0;
            }


            $routes = [];
            for ($i = 0; $i < count($destination_id); $i++) {
                $routes[] = [
                    'id' => $destination_id[$i],
                    'name' => $route[$i],
                    'type' => $destination_type[$i],
                    'lat' => $lat[$i],
                    'lng' => $lng[$i],
                    'price' => $tourniquet_price[$i] ? $tourniquet_price[$i] : '0',
                    'will_pay' => $tourniquet_will_pay[$i],
                    'street' => $number_street[$i]
                ];
            }

            $options = json_encode($options);
            $routes = json_encode($routes);


            $update_order = Ut_order::where('id', $order_id)
                ->update([
                    'test' => false,
                    'user_id' => 13,
                    'last_xref_id' => 2,
                    'auto_search' => $auto_search ? $auto_search : $order->auto_search,
                    'public' => $is_public,
                    'status' => $is_public ? 600 : $order->status,
                ]);

            $order_detail_id = Ut_order_detail::insertGetId([
                'order_id' => $order_id,
                'route' => $routes,
                'price' => $price,
                'operator_price' => $operatorPrice,
                'order_type' => 1,
                'order_value' => $km,
                'description' => $description,
                'tariff' => $tariff->id,
                'order_date' => $orderDate,
                'user_id' => 13,
                'payment_method' => $payment_method,
                'timeout' => $timeout,
                'option' => $options,
                'date' => date('Y-m-d H:i:s'),
            ]);


            $order_status_id = Ut_order_status_history::insertGetId([
                'order' => $order_id,
                'taxi' => $taxi_id,
                'user_id' => 13,
                'status' => 15,
                'reason' => 'Sifariş dəyişikliyi',
                'date' => date('Y-m-d H:i:s'),
                'location' => $location
            ]);

            if ($order->taxi) {
                FcmController::notification(15, $order->taxiName->fcm_registered_id, 'Basliq', 'Metn', $order = []);
            }

            if ($status == 700) {
                $order = StaticController::getTaxiOrderFuture();
                FcmController::notification(700, '/topics/taxi', 'Basliq', 'Metn', $order);
            }

            if ($is_public) {
                $orderOpens = StaticController::getTaxiOrderPublic();
                FcmController::notification(600, '/topics/taxi', 'Basliq', 'Metn', $orderOpens);
            }

            if ($taxi) {
                $order = Ut_order::where('id', $order_id)->get()->last();
                $taxi = Ut_taxi::where('id', $taxi_id)->get()->last();
                StaticController::findedTaxi($taxi, $order, $lat, $lng, 1);

                //fcm ucun order and order detail
                $order = StaticController::getResultFutureOrPublicOrListen($order);
                FcmController::notification(1, $taxi->fcm_registered_id, 'Basliq', 'Metn', $order);
            }


            $order = Ut_order::where(['delete' => false, 'id' => $order_id])->first();
            $order = StaticController::getResultFutureOrPublicOrListen($order, 0);
            broadcast(new \App\Events\OrderEvent($order, 1));


        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200]);
    }

    public function postDestinationSearchStreetNumber(Request $request)
    {

        try {

            $street_id = $request->get('id');

            $results = Ut_address::where('street', $street_id)->get();

        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'results' => $results]);

    }

    public function postOrderPriceCalculate(Request $request)
    {

        try {
            $customerPhone = $request->get('customer_phone');
            $tariff = $request->get('tariff');
            $orderType = $request->get('orderType');
            $options = $request->get('options');
            $timeout = $request->get('timeout');
            $km = $request->get('km');
            $destinations = $request->get('destinations');
            $tourniquetWillPays = $request->get('tourniquetWillPays');
            $tourniquetPrices = $request->get('tourniquetPrices');
            $orderDate = $request->get('orderDate');
            $orderWeekday = $request->get('orderWeekday');
            $orderTime = explode(' ', $request->get('orderDate'))[1];

            $date = date('Y-m-d H:i:s');
            $errors = [];

            $tariffPrice = Ut_tariff::where('id', $tariff)->where('status', true)->where('delete', false)->first();

            $customer = Ut_customer::where('phone', $customerPhone)->where('status', true)->where('delete', false)->first();

            if (!$tariffPrice) {
                return response()->json(['status' => 'false', 'error' => '', 'success' => 403, 'result' => 'Tariff tapilmadi']);
            }

            $price = 0;

            $plan_for_distance = json_decode($tariffPrice->plan_for_distance, true);

            $isPresentsInPlan = false;
            $planOrderDistance = $km; //km = 5.586
            foreach ($plan_for_distance as $plan) {
                if ($km >= $plan['start']) { // 23.373 > 0
                    $isPresentsInPlan = true;
                    if ($km >= $plan['end']) { // 23.373 >= 3
                        $tmpDistance = $plan['end'] - $plan['start']; // ilk => 3 - 0 = 3 // ikinci => 10 - 3 =7
                        $planOrderDistance -= $tmpDistance; // 5.586-3 = 2.86
                        if ($plan['fix']) $price += $plan['price']; // ilk => 0 + 3 = 3 //ikinci =>
                        else $price += $tmpDistance * $plan['price']; // 1 *5 = 5
                    } else {
                        if ($plan['fix']) $price += $plan['price'];
                        else $price += $planOrderDistance * $plan['price'];
                    }
                }
            }

            if (!$isPresentsInPlan) {
                if ($plan_for_distance[count($plan_for_distance) - 1]['fix']) $price += $plan_for_distance[count($plan_for_distance) - 1]['price'];
                else $price += $km * $plan_for_distance[count($plan_for_distance) - 1]['price'];
            }

            //eger nese kompaniya filan avrsa price ustune gelir
            $priceStrategy = Ut_price_strategy::where(['tariff_id' => $tariffPrice->id, 'delete' => false])
                ->where('date', $date)
                ->where('start_time', '<', $orderTime)
                ->where('end_time', '>', $orderTime)
                ->first();

            if ($priceStrategy) {
                if ($priceStrategy->is_fix_or_percent) {
                    $price -= ($price * $priceStrategy->discount) / 100;
                } else {
                    $price -= $price * $priceStrategy->discount;
                }
            }

            if ($customer && $customer->group == 1 && $customer->discount > 0) {
                if ($customer->is_increase_discount) {
                    $price += ($price * $customer->discount) / 100;
                } else {
                    $price -= ($price * $customer->discount) / 100;
                }
            }

            if ($customer && $customer->group != 1) {
                $customerGroup = $customer->groupName;
                if ($customerGroup && $customerGroup->discount > 0)
                    if ($customer->is_increase_discount) {
                        $price += ($price * $customerGroup->discount) / 100;
                    } else {
                        $price -= ($price * $customerGroup->discount) / 100;
                    }
            }


            if (count($destinations) - 2 > 0) $price += (count($destinations) - 2) * $tariffPrice->per_destination_fee;


            if ($options) {
                foreach ($options as $option) {
                    $optionPrice = Ut_options::where('id', $option)->where('status', true)->where('delete', false)->value('price');
                    $price += $optionPrice;
                }
            }

            //eger gozleme muddeti 10 deq artiqdirsa qalan deqiqeleri price ustune gelir
            if ($timeout && $timeout > 10) {
                $price += ($timeout - 10) * $tariffPrice->timeout_fee;
            }

            // eger turniket girisi varsa price ustune gelir
            for ($i = 0; $i < count($tourniquetWillPays); $i++) {
                $price += $tourniquetWillPays[$i] * $tourniquetPrices[$i];
            }

//            //eger cekilen eraziye dusurse
//            $areaPricings = Ut_area_pricing::where(['status' => true, 'delete' => false])->get();
//
//            if (count($areaPricings)) {
//                foreach ($areaPricings as $areaPricing) {
//
//                    $latitude = explode(',', $areaPricing->latitude);
//                    $longitude = explode(',', $areaPricing->longitude);
//
//                    $polySides = count($latitude); //how many corners the polygon has
//                    $polyX = $latitude;//horizontal coordinates of corners
//                    $polyY = $longitude;//vertical coordinates of corners
//                    $x = 3.5;
//                    $y = 13.5;//Outside
//                    //$y = 3.5;//Inside
//
//                    $check = $this->pointInPolygon($polySides, $polyX, $polyY, $x, $y);
//
//                    if ($check) {
//                        echo "Is in polygon!";
//                    } else {
//                        echo "Is not in polygon";
//                    }
//                }
//                $price += ($price * $priceStrategy->discount) / 100;
//            }
            $result = round($price, 2);


        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'result' => $result]);

    }

    private function pointInPolygon($polySides, $polyX, $polyY, $x, $y)
    {
        $j = $polySides - 1;
        $oddNodes = 0;
        for ($i = 0; $i < $polySides; $i++) {
            if ($polyY[$i] < $y && $polyY[$j] >= $y
                || $polyY[$j] < $y && $polyY[$i] >= $y) {
                if ($polyX[$i] + ($y - $polyY[$i]) / ($polyY[$j] - $polyY[$i]) * ($polyX[$j] - $polyX[$i]) < $x) {
                    $oddNodes = !$oddNodes;
                }
            }
            $j = $i;
        }

        return $oddNodes;
    }

    public function postOperationBalanceCashingEdit(OperationBalanceIncreaseRequest $request, $id = 0, $code)
    {
        $request->validated();

        $request->request->add([
            'user' => 1,
            'from_account_type' => 2,
            'to_account' => $request->get('destination'),
            'to_account_type' => 1,
            'type' => 5,
            'date' => date('Y-m-d H:i:s'),
            'amount' => -abs($request->get('amount')) * 100,
        ]);


        $request->request->remove('destination_name');
        $request->request->remove('destination');

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Balansı nağdlaşdırma");

        return Redirect::back();
    }

    public function getOrderSearchPlace()
    {
        return view('order.order-search-place');
    }

    public static function postOrderFindTaxi($order, $lat, $lng, $bannedTaxi = [], $taxi_id)
    {
        try {

            $lat = number_format($lat, 2, '.', "");
            $lng = number_format($lng, 2, '.', "");

            $datas = Ut_setting::get();

            foreach ($datas as $data) {
                $result[$data->setting_key] = $data->setting_value;
            }

            $km = $result['order_radius'] / 100;

            //ilk once 3 km erazide olan taxilar kateqoriya uzre en cox prioriteti olan (eger eynidirse en yaxinda olan) taxi
            $result_3_km = OrderController::searchTaxi($order, $km, $lat, $lng, $bannedTaxi, $taxi_id);

            if ($result_3_km['taxi']) {
                $result = $result_3_km;
            } else {
                // 3 km erazide taxi tapilmasa ,5 km erazide olan taxilar kateqoriya uzre en cox prioriteti olan (eger eynidirse en yaxinda olan) taxi
                $km = 0.05;
                $result_5_km = OrderController::searchTaxi($order, $km, $lat, $lng, $bannedTaxi, $taxi_id);
                if ($result_5_km['taxi']) {
                    $result = $result_5_km;
                } else {
                    //5 km erazide de taxi tapilmasa onda aciq sifarise dusur
                    Ut_order::where('id', $order->id)
                        ->update([
                            'status' => 600,
                            'public' => 1,
                            'sort' => 1 //aciq sifaris
                        ]);

                    $order = StaticController::getTaxiOrderPublic();

                    FcmController::notification(600, '/topics/taxi', 'Basliq', 'Metn', $order);

                    //eger aciq sifarise duserse customere fcm gedecek

                    if ($order && $order->customerName && $order->customerName->fcm_registered_id) {
                        FcmClientController::notification(600, $order->customerName->fcm_registered_id, 'Ulduz Taxi', '', '');
                    }


                    $result = 'Açıq sifariş';

                }
            }

        } catch
        (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return $result;
    }

    public static function searchTaxi($order, $km, $lat, $lng, $bannedTaxi = [], $taxi_future_id = false)
    {
        $away3LatMax = (number_format(($lat + $km), 2, '.', ""));
        $away3LatMin = (number_format(($lat - $km), 2, '.', ""));
        $away3LongMax = (number_format(($lng + $km), 2, '.', ""));
        $away3LongMin = (number_format(($lng - $km), 2, '.', ""));

        $price = $order->orderDetailName ? $order->orderDetailName->price + $order->orderDetailName->operator_price : 0; //4.27
        //tarifin faizi
        $distance_fee = $order->orderDetailName ? $order->orderDetailName->tariffName->distance_fee : 0; //10
        //cixilacaq mebleb
        $fee = round(($price * $distance_fee) / 100, 2); //0.472

        $taxi = [];
        $results = [];
        $categories = [];
        if ($taxi_future_id) {
            $taxi = Ut_taxi::where(['id' => $taxi_future_id])->first();
        } else {

            $fcm_taxies = DB::table('ut_taxi as ut_t')
                ->join('ut_accounts as ut_a', 'ut_t.id', 'ut_a.destination')
                ->where([
                    'ut_t.delete' => false,
                    'ut_t.status' => true,
                    'ut_t.action' => false,
                    'ut_t.live' => true,
                    'ut_a.type' => 1
                ])
                ->where('ut_a.balance', '<', $fee)
                ->whereNotIn('ut_t.id', $bannedTaxi)
                ->where(function ($q) use ($away3LatMax, $away3LatMin, $away3LongMax, $away3LongMin) {
                    $q->where(
                        [
                            ['ut_t.latitude', '<', $away3LatMax],
                            ['ut_t.latitude', '>', $away3LatMin],
                            ['ut_t.longitude', '<', $away3LongMax],
                            ['ut_t.longitude', '>', $away3LongMin]
                        ]);
                    $q->orWhere(
                        [
                            ['ut_t.fake_latitude', '<', $away3LatMax],
                            ['ut_t.fake_latitude', '>', $away3LatMin],
                            ['ut_t.fake_longitude', '<', $away3LongMax],
                            ['ut_t.fake_longitude', '>', $away3LongMin]
                        ]);
                })
                ->select('ut_t.*', 'ut_a.type', 'ut_a.balance')
                ->limit(20)->get();

            $results = DB::table('ut_taxi as ut_t')
                ->join('ut_accounts as ut_a', 'ut_t.id', 'ut_a.destination')
                ->where([
                    'ut_t.delete' => false,
                    'ut_t.status' => true,
                    'ut_t.action' => false,
                    'ut_t.live' => true,
                    'ut_a.type' => 1
                ])
                ->where('ut_a.balance', '>', $fee)
                ->whereNotIn('ut_t.id', $bannedTaxi)
                ->where(function ($q) use ($away3LatMax, $away3LatMin, $away3LongMax, $away3LongMin) {
                    $q->where(
                        [
                            ['ut_t.latitude', '<', $away3LatMax],
                            ['ut_t.latitude', '>', $away3LatMin],
                            ['ut_t.longitude', '<', $away3LongMax],
                            ['ut_t.longitude', '>', $away3LongMin]
                        ]);
                    $q->orWhere(
                        [
                            ['ut_t.fake_latitude', '<', $away3LatMax],
                            ['ut_t.fake_latitude', '>', $away3LatMin],
                            ['ut_t.fake_longitude', '<', $away3LongMax],
                            ['ut_t.fake_longitude', '>', $away3LongMin]
                        ]);
                })
                ->select('ut_t.*', 'ut_a.type', 'ut_a.balance')
                ->limit(20)->get();

            $resultsCollection = collect($results);

            $categories = Ut_taxi_categories::orderBy('sort', 'ASC')->get();

            if (count($results)) {
                foreach ($categories as $category) {
                    $filtered = $resultsCollection->where('category', $category->id);
                    if (count($filtered)) {
                        //priority si en cox olan taxi
                        $maxPriorityTaxi = $filtered->sortBy('priority')->values()->last();

                        // priority eyni olarsa
                        $samePriorityTaxies = $resultsCollection->filter(function ($value, $key) use ($maxPriorityTaxi) {
                            if ($value->priority == $maxPriorityTaxi->priority) {
                                return true;
                            }
                        });

                        $samePriorityTaxies->all();

                        if (count($samePriorityTaxies)) {
                            $maxKilometer = 0;
                            $maxKilometerTaxi = null;
                            //en yaxin olani secmek
                            foreach ($samePriorityTaxies as $samePriorityTaxy) {
                                $samePriorityTaxy->latitude = number_format($samePriorityTaxy->latitude, 2, '.', "");
                                $samePriorityTaxy->longitude = number_format($samePriorityTaxy->longitude, 2, '.', "");
                                $kilometer = number_format((sqrt(pow(abs($samePriorityTaxy->latitude - $lat), 2) + pow(abs($samePriorityTaxy->longitude - $lng), 2))), 2, '.', "");
                                if ($kilometer > $maxKilometerTaxi) {
                                    $maxKilometer = $kilometer;
                                    $maxKilometerTaxi = $samePriorityTaxy;
                                }
                                $taxi[$samePriorityTaxy->id]['taxi'] = $samePriorityTaxy;
                            }

                            $taxi = $maxKilometerTaxi;

                        } else {
                            $taxi = $maxPriorityTaxi;
                        }
                        break;
                    }
                }
            }
        }

        if ($taxi) {
            StaticController::findedTaxi($taxi, $order, $lat, $lng, 0);
            FcmController::notification(1, $taxi->fcm_registered_id, 'Basliq', 'Metn', $order);
        }

        //fcm gedecek pulu catmayan taxilere
        foreach ($fcm_taxies as $fcm_taxy) {
            FcmController::notification(5000, $fcm_taxy->fcm_registered_id, 'Ulduz taxi', 'Metn', $order);
        }


        return ['taxi' => $taxi, 'results' => $results, 'categories' => $categories];

    }

    public function postFindTaxiTest()
    {
        try {

            date_default_timezone_set('Asia/Baku');

            $datas = Ut_setting::get();

            foreach ($datas as $data) {
                $setting[$data->setting_key] = $data->setting_value;
            }

            $reached_time = $setting['reached_time'];

            $to = Carbon::now()->addMinutes($reached_time)->format('Y-m-d H:i:s');

            //eger taxinin teli sonuludurse onda sifaris havada qalmasin deye statusu yeniden 0 olub crona dusmelidir
            $to_find_taxi = Carbon::now()->format('Y-m-d H:i:s');

            $order_find_taxies = Ut_order::where(['status' => 1, 'delete' => 0, 'taxi' => 0, 'test' => 0])->get();
            foreach ($order_find_taxies as $of) {
                $order_find_taxi_history = Ut_order_status_history::where('order', $of->id)->get()->last();
                $duration = 30;
                $dateinsec = strtotime($order_find_taxi_history->date);
                $newdate = $dateinsec + $duration;
                $after_30_date = date('Y-m-d H:i:s', $newdate);

                if ($after_30_date < $to_find_taxi && $order_find_taxi_history->status == 1) {
                    Ut_order::where('id', $order_find_taxi_history->order)->update([
                        'status' => 0,
                        'taxi' => 0,
                        'refused_taxies' => $of->refused_taxies ? $of->refused_taxies . ',' . $order_find_taxi_history->taxi : $order_find_taxi_history->taxi,
                    ]);

                    Ut_taxi::where('id', $order_find_taxi_history->taxi)->update([
                        'action' => 0,
                    ]);
                }

            }

            $orders = Ut_order::join('ut_order_detail as utd', 'ut_order.id', 'utd.order_id')
                ->whereIn('ut_order.status', [0, 700])
                ->where('utd.order_date', '<', $to)
                ->where('ut_order.auto_search', true)
                ->where('ut_order.taxi', false)
                ->where('ut_order.delete', false)
                ->select('ut_order.*', 'utd.order_date')
                ->get();

            foreach ($orders as $order) {

                $taxi_future_id = false;

                if ($order->status == 700) {
                    $taxi_future_id = Ut_order_queue::where(['order_id' => $order->id, 'o' => true])->value('taxi_id');
                }

                DB::table('ut_order')->where('id', $order->id)->update(['status' => false]);

                $orderStatusBannedTaxi = explode(',', $order->refused_taxies);

                $location = json_decode($order->orderDetailName->route, true)[0];

                $result = OrderController::postOrderFindTaxi($order, $location['lat'], $location['lng'], $orderStatusBannedTaxi, $taxi_future_id);
            }

        } catch
        (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'result' => $result]);

    }

    public function postOrderDispetcerOrOperatorCancel(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'order_id' => 'required|integer',
                'is_balance_penalty' => 'required|integer',
                'is_priority_penalty' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'false', 'error' => 403, 'message' => $validator->errors()]);
            }

            $order = Ut_order::where('id', $request->get('order_id'))->first();
            if (!$order) {
                return response()->json(['status' => 'false', 'error' => 'Sifaris tapilmadi']);
            }

            $taxi = Ut_taxi::where(['status' => true, 'id' => $order->taxi])->get()->last();

            $is_balance_penalty = $request->get('is_balance_penalty');
            $is_priority_penalty = $request->get('is_priority_penalty');

            $order_status_id = Ut_order_status_history::insertGetId([
                'order' => $order->id,
                'taxi' => $taxi ? $taxi->id : 0,
                'user_id' => 13,
                'status' => 35,
                'reason' => 'Sifariş ləğv olundu',
                'date' => date('Y-m-d H:i:s'),
                'location' => $order->orderDetailName->locationName()
            ]);


            Ut_order::where('id', $order->id)
                ->update([
                    'status' => 35,
                    'sort' => 7,
                ]);

            if ($taxi) {
                Ut_taxi::where('id', $taxi->id)
                    ->update([
                        'action' => 0,
                    ]);

                if ($is_priority_penalty) {
                    StaticController::getPriorityRulesCheck($order->id, $taxi->id, 4, $order->orderDetailName->payment_method);
                }
                if ($is_balance_penalty) {
                    StaticController::getBalanceRulesCheck($order->id, $taxi->id, 4, $order->orderDetailName->payment_method);
                }

                FcmController::notification(35, $taxi->fcm_registered_id, 'Basliq', 'Metn', $order);
            }

            if ($order->public) {
                $orderOpens = StaticController::getTaxiOrderPublic();

                FcmController::notification(600, '/topics/taxi', 'Basliq', 'Metn', $orderOpens);
            }

        } catch
        (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'result' => true]);

    }

    public function getCustomername(Request $request)
    {
        try {
            $customer = Ut_customer::where("phone", $request->get('phone'))->first();
            if (!$customer) {
                return response()->json(['status' => 'false', 'message' => 'Customer is not found !']);
            }

            $orders = DB::table('ut_call as oc')
                ->leftJoin('ut_order_detail as od', 'od.order_id', 'oc.order_id')
                ->leftJoin('ut_order as o', 'oc.order_id', 'o.id')
                ->select('o.id', 'o.created_at', 'od.route as route', 'od.price as pr', 'od.operator_price as opr', 'oc.callid as callid')
                ->where('oc.number', $customer->phone)
                ->groupBy('o.id')
                ->get();


            if (!$orders) {
                return response()->json([
                    'status' => 'true',
                    'error' => '',
                    'success' => 200,
                    'customer_name' => $customer->firstname,
                    'orders' => '',
                ]);
            }
            return response()->json([
                'status' => 'true',
                'error' => '',
                'success' => 200,
                'group' => $customer->group,
                'groupName' => $customer ? $customer->groupName->name : '',
                'customer_name' => $customer->firstname,
                'orders' => $orders,
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

    }

    public function postOrderRemoveTaxi(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'code' => 'required|string',
                'order_id' => 'required|integer',
                'is_balance_penalty' => 'required|integer',
                'is_priority_penalty' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'false', 'error' => 403, 'message' => $validator->errors()]);
            }

            $order_id = $request->get('order_id');
            $order = Ut_order::where('id', $request->get('order_id'))->first();
            if (!$order) {
                return response()->json(['status' => 'false', 'error' => 'Sifaris tapilmadi']);
            }

            $car_code = $request->get('code');
            $taxi_id = Ut_taxi::where(['status' => true, 'code' => $car_code])->value('id');

            if (!$taxi_id) {
                return response()->json(['status' => 'false', 'error' => 403, 'message' => 'Taksi tapılmadı']);
            }

            $is_balance_penalty = $request->get('is_balance_penalty');
            $is_priority_penalty = $request->get('is_priority_penalty');


            FcmController::notification(45, $order->taxiName->fcm_registered_id, 'Basliq', 'Metn', $order);


            $order_status_id = Ut_order_status_history::insertGetId([
                'order' => $order->id,
                'taxi' => $taxi_id,
                'user_id' => 13,
                'status' => 45,
                'reason' => 'Taksi dispetçer tərəfində çıxarıldı',
                'date' => date('Y-m-d H:i:s'),
                'location' => $order->orderDetailName->locationName()
            ]);


            Ut_order::where('id', $order->id)
                ->update([
                    'status' => 0,
                    'taxi' => 0,
                    'refused_taxies' => $order->refused_taxies ? $order->refused_taxies . ',' . $taxi_id : $taxi_id,
                    'sort' => 0,
                ]);

            Ut_taxi::where('id', $taxi_id)
                ->update([
                    'action' => 0,
                ]);

            if ($is_priority_penalty) {
                StaticController::getPriorityRulesCheck($order->id, $taxi_id, 4, $order->orderDetailName->payment_method);
            }
            if ($is_balance_penalty) {
                StaticController::getBalanceRulesCheck($order->id, $taxi_id, 4, $order->orderDetailName->payment_method);
            }

            FcmClientController::notification(5, $order->customerName->fcm_registered_id, 'Ulduz Taxi', 'Taksi çıxarıldı', '');


        } catch
        (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json([
            'status' => 'true',
            'error' => '',
            'success' => 200,
            'order_id' => $order_id,
            'taxi_code' => $car_code,
        ]);
    }

}
