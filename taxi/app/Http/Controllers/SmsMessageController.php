<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\FcmController;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\SmsRequest;
use App\Http\Requests\SmsTemplateRequest;
use App\Modules;
use App\Ut_customer;
use App\Ut_customer_group;
use App\Ut_message_template;
use App\Ut_messages;
use App\Ut_sms;
use App\Ut_sms_template;
use App\Ut_taxi;
use App\Ut_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SmsMessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //return model name with App prefix for insert, update, select etc
    public function getModuleName($table_name)
    {
        $appPrefix = 'App';
        $modelName = $appPrefix . '\\' . ucfirst($table_name);

        return $modelName;
    }

    public function getSwitchSendSmsMessage($id, $type)
    {

        switch ($type) {
            case 1:
                $result = Ut_taxi::where('delete', false)->where('id', $id)->first();
                $result = [
                    'destination_type' => 1,
                    'destination' => $result->code . '-' . $result->fullName(),
                    'destination_id' => $result->id,
                ];
                break;
            case 2:
                $result = Ut_customer::where('delete', false)->where('id', $id)->first();
                $result = [
                    'destination_type' => 2,
                    'destination' => $result->phone,
                    'destination_id' => $result->id,
                ];
                break;
            default:
                $result = [];
        }

        return $result;
    }

    //////////////////////////////////////////////////////// SMS /////////////////////////////////////////////

    public function getSms()
    {
        $results = Ut_sms::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_sms')->first();

        $users = Ut_users::where('active', true)->get();

        return view('sms-message.sms', ['results' => $results, 'module' => $module, 'users' => $users]);
    }

    public function getSmsNew($id, $type)
    {
        $result = $this->getSwitchSendSmsMessage($id, $type);

        $smsTemplates = Ut_sms_template::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_sms')->first();

        return view('sms-message.sms-new', ['smsTemplates' => $smsTemplates, 'module' => $module, 'result' => $result, 'type' => $type]);
    }

    public function getSmsSearch(Request $request, $code, $viewMain, $view)
    {
        $data = $request->all();

        //delete first element in data array
        array_shift($data);

        //delete perPage in data array
        $perPage = array_pop($data);

        //get table name
        $module = Modules::where('code', $code)->first();
        $appPrefix = 'App';
        $modelName = $appPrefix . '\\' . ucfirst($module->table_name);

        $result = $modelName::where('delete', false);
        foreach ($data as $key => $value) {
            $result->$key($value);
        }

        $results = $result->orderBy('id', 'ASC')->limit($perPage)
            ->get();

        return view($viewMain . '.' . $view, ['results' => $results, 'module' => $module, 'perPage' => $perPage]);
    }

    public function postSmsEdit(SmsRequest $request)
    {
        $request->validated();

        $type = $request->get('destination_type');
        $destination_type = ($request->get('destination_type') == 1) ? 1 : (($request->get('destination_type') == 2) ? 2 : (($request->get('destination_type') == 3) ? 2 : 1));
        $tableName = ($request->get('destination_type') == 1) ? 'ut_taxi' : (($request->get('destination_type') == 2) ? 'ut_customer' : (($request->get('destination_type') == 3) ? 'ut_customer_group' : 'ut_taxi'));
        $destination_id = $request->get('destination_id');
        $message = $request->get('message');

        //get number from taxi or customer
        $data = [
            'destination_type' => $destination_type,
            'destination_id' => $destination_id,
            'message' => $message,
            'date' => Carbon::now(),
        ];


        $modelName = $this->getModuleName($tableName);

        $whoms = $modelName::where('delete', false);
        if ($destination_id) {
            $whoms->where('id', $destination_id);
        }
        $whoms = ($type == 3) ? $whoms->first()->customers : $whoms = $whoms->get();

        $this->insertSms($data, $whoms);

        Session::flash('success-message', 'Sms göndərildi');

        return Redirect::back();

    }

    private function insertSms($data, $whoms)
    {
        foreach ($whoms as $w) {
            DB::table('ut_sms')->insert([
                'destination_type' => $data['destination_type'],
                'destination_id' => $w->id,
                'user_id' => 13,
                'type' => 3,
                'number' => $w->phone,
                'date' => $data['date'],
                'message' => $data['message'],
            ]);
        }
    }

    //////////////////////////////////////////////////////// END SMS /////////////////////////////////////////////


    //////////////////////////////////////////////////////// SMS-MESSAGE TEMPLATE /////////////////////////////////////////////


    //check type name with type(sms-message,message etc.) and return table (db) and name
    public function checkType($type)
    {
        $table = ($type == 'sms') ? 'ut_sms_template' : ($type == 'message' ? 'ut_message_template' : false);
        $templateName = ($type == 'sms-message') ? 'Sms' : ($type == 'message' ? 'Push' : false);

        if (!$table) {
            return view('404');
        }

        return ['table' => $table, 'templateName' => $templateName];
    }

    //get table name with code
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

    public function getSmsMessageTemplate($type)
    {
        $tableName = $this->checkType($type)['table'];

        $modelName = $this->getModuleName($tableName);

        $results = $modelName::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', $tableName)->first();

        return view('sms-message.sms-message-template', ['results' => $results, 'module' => $module, 'templateName' => $this->checkType($type)['templateName']]);
    }

    public function getSmsMessageTemplateNew($id, $code)
    {
        $module = Modules::where('code', $code)->first();

        $modelName = $this->getModuleName($module->table_name);

        $templateName = $this->getTableNameWithCode($code);

        $result = $modelName::where('id', $id)->where('delete', false)->first();

        return view('sms-message.sms-message-template-new', ['result' => $result, 'module' => $module, 'templateName' => $templateName]);
    }

    public function postSmsMessageTemplateEdit(SmsTemplateRequest $request, $id, $code)
    {
        $request->validated();

        $templateName = $this->getTableNameWithCode($code);

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, $templateName . ' şablonu');

        return Redirect::back();
    }


    //////////////////////////////////////////////////////// END SMS-MESSAGE TEMPLATE /////////////////////////////////////////////


    //////////////////////////////////////////////////////// MESSAGE /////////////////////////////////////////////
    public function getMessage()
    {
        $results = Ut_messages::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_messages')->first();

        $users = Ut_users::where('active', true)->get();

        return view('sms-message.message', ['results' => $results, 'module' => $module, 'users' => $users]);
    }

    public function getMessageNew($id, $type)
    {
        $result = $this->getSwitchSendSmsMessage($id, $type);

        $messageTemplates = Ut_message_template::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_messages')->first();

        return view('sms-message.message-new', ['messageTemplates' => $messageTemplates, 'module' => $module, 'result' => $result]);
    }

    public function postMessageEdit(MessageRequest $request)
    {
        $request->validated();
        $type = $request->get('destination_type');
        $destination_type = ($request->get('destination_type') == 1) ? 1 : (($request->get('destination_type') == 2) ? 2 : (($request->get('destination_type') == 3) ? 2 : 1));
        $tableName = ($request->get('destination_type') == 1) ? 'ut_taxi' : (($request->get('destination_type') == 2) ? 'ut_customer' : (($request->get('destination_type') == 3) ? 'ut_customer_group' : 'ut_taxi'));
        $destination_id = $request->get('destination_id');
        $title = $request->get('title');
        $message = $request->get('message');

        //get number from taxi or customer

        $data = [
            'destination_type' => $destination_type,
            'destination_id' => $destination_id,
            'title' => $title,
            'message' => $message,
            'date' => Carbon::now(),
        ];


        $modelName = $this->getModuleName($tableName);

        $whoms = $modelName::where('delete', false);
        if ($destination_id) {
            $whoms->where('id', $destination_id);
        }
        $whoms = ($type == 3) ? $whoms->first()->customers : $whoms = $whoms->get();

        $this->insertMessage($data, $whoms);

        Session::flash('success-message', 'Mesaj göndərildi');


        return Redirect::back();

    }

    private function insertMessage($data, $whoms)
    {
        foreach ($whoms as $w) {
            $message_id = DB::table('ut_messages')->insertGetId([
                'destination_type' => $data['destination_type'],
                'destination_id' => $w->id,
                'user_id' => 13,
                'title' => $data['title'],
                'message' => $data['message'],
                'date' => $data['date'],
            ]);

            if ($data['destination_type'] == 1 || $data['destination_type'] == 2) {
                FcmController::notification(3, $w->fcm_registered_id, $data['title'], $message_id, $data['message']);
            }
        }
    }

    //////////////////////////////////////////////////////// END MESSAGE /////////////////////////////////////////////


    public function postDestinationSearch(Request $request)
    {
        $text = $request->get('text');
        $type = $request->get('type');

        switch ($type) {
            case $type == 1:
                $results = Ut_taxi::where('delete', false)->where('code', 'LIKE', '%' . $text . '%')->limit('8')->get();
                break;
            case $type == 2:
                $results = Ut_customer::where('delete', false)->where('phone', 'LIKE', '%' . $text . '%')->limit('8')->get();
                break;
            case $type == 3:
                $results = Ut_customer_group::where('delete', false)->where('name', 'LIKE', '%' . $text . '%')->limit('8')->get();
                break;
            default:
                $results = false;
        }

        if (!count($results)) {
            $results = false;
        }

        if (!$results) {
            return response()->json(['status' => 'false', 'error' => '', 'success' => false, 'results' => $results]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'results' => $results, 'type' => $type]);
    }


}
