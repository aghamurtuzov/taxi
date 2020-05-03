<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiTaxiLoginRequest;
use App\Http\Requests\OperationBalanceIncreaseRequest;
use App\Modules;
use App\Ut_account;
use App\Ut_address;
use App\Ut_customer;
use App\Ut_messages;
use App\Ut_object_tourniquets;
use App\Ut_options;
use App\Ut_order;
use App\Ut_order_detail;
use App\Ut_order_status_history;
use App\Ut_tariff;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use App\Ut_transaction;
use App\Ut_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class FcmController extends Controller
{

    public static function notification($type, $token, $title, $body, $message = '')
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $type = (string)$type;
        $notification = [
            'title' => $title,
            'body' => $body,
            'type' => $type,
            'sound' => 'default',
            'message' => $message,
            'priority  ' => 'high',
        ];

        $fcmNotification = [
            'to' => $token, //single token
//            'notification' => $notification,
            'data' => $notification,
        ];

        $headers = [
            'Authorization: key=AAAACp_sasw:APA91bFRo_bOkfAnVuzKuhmL50O1ABfaKCwYB2-uP0YNcc3I42hTXjBOUVfhdGWrbNmHjbc68NguXBgpY4z3jVMGOF7TnUUFWHtVUSZeirj112neNopL83lUIfvnqRWRG9lAunR1RuSS',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
