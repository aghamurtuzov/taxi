<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\FcmController;
use App\Http\Requests\OperationBalanceIncreaseRequest;
use App\Modules;
use App\Ut_account;
use App\Ut_taxi;
use App\Ut_transaction;
use App\Ut_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OperationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOperation()
    {
        $users = Ut_users::where('active', true)->get();

        $results = Ut_transaction::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_transaction')->first();

        return view('operation.operation', ['results' => $results, 'module' => $module, 'users' => $users]);
    }

    public function getOperationBalanceIncrease()
    {
        $module = Modules::where('table_name', 'ut_accounts')->first();

        return view('operation.operation-balance-increase', ['module' => $module]);
    }

    public function postOperationBalanceIncreaseEdit(OperationBalanceIncreaseRequest $request, $id = 0, $code)
    {
        $request->validated();

        $date = Carbon::now();

        $amount = $request->get('amount');

        $destination = $request->get('destination'); //2370

        $type = $request->get('type'); //1

        $account = Ut_account::where(['type' => $type, 'destination' => $destination])->get()->last();

        if (!$account) {
            return Redirect::back();
        }

        DB::table('ut_transaction')
            ->insert([
                'user' => 1,
                'from_account' => 1,
                'from_account_type' => 0,
                'to_account' => $account->id,
                'to_account_type' => $type,
                'type' => 4,
                'amount' => $amount,
                'date' => $date,
                'description' => $request->get('description'),
            ]);

        $accountBalance = $account->balance + $amount;

        Ut_account::where(['type' => $type, 'destination' => $destination])
            ->update([
                'balance' => $accountBalance,
            ]);

        if ($type == 1) {
            $taxi = $account->taxiName;

            FcmController::notification(500, $taxi->fcm_registered_id, 'Ulduz Taxi', 'Metn', 'Balansınıza ' . $amount . ' AZN əlavə edildi');
        }

        Session::flash('success-message', 'Balans artırıldı');

        return Redirect::back();
    }


    public function getOperationBalancePunishment()
    {
        $module = Modules::where('table_name', 'ut_transaction')->first();

        return view('operation.operation-balance-punishment', ['module' => $module]);
    }

    public function postOperationBalancePunishmentEdit(OperationBalanceIncreaseRequest $request, $id = 0, $code)
    {
        $request->validated();

        $date = Carbon::now();

        $amount = $request->get('amount');

        $destination = $request->get('destination');

        $type = $request->get('type');

        $taxi = Ut_taxi::where(['id' => $destination])->get()->last();

        $companyAccount = Ut_account::where(['type' => 0, 'destination' => 0])->get()->last();

        if (!$taxi || !$taxi->account) {
            return Redirect::back();
        }

        $request->request->add([
            'user' => 1,
            'from_account' => $taxi->account->id,
            'from_account_type' => 1,
            'to_account' => 1,
            'to_account_type' => 0,
            'type' => 3,
            'date' => $date,
            'amount' => '-' . abs($amount),
        ]);


        $request->request->remove('destination_name');
        $request->request->remove('destination');

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Balansa cərimələ ");

        $accountBalance = $taxi->account->balance - $amount;

        $companyBalance = $companyAccount->balance + $amount;

        Ut_account::where(['type' => $type, 'destination' => $destination])
            ->update([
                'balance' => $accountBalance,
            ]);

        Ut_account::where(['type' => 0, 'destination' => 0])
            ->update([
                'balance' => $companyBalance,
            ]);


        FcmController::notification(500, $taxi->fcm_registered_id, 'Ulduz Taxi', 'Metn', 'Balansınızdan ' . $amount . ' AZN çıxıldı');


        return Redirect::back();
    }

    public function getOperationBalanceCashing()
    {
        $module = Modules::where('table_name', 'ut_transaction')->first();

        return view('operation.operation-balance-cashing', ['module' => $module]);
    }

    public function postOperationBalanceCashingEdit(OperationBalanceIncreaseRequest $request, $id = 0, $code)
    {
        $request->validated();

        $date = Carbon::now();

        $amount = $request->get('amount');

        $destination = $request->get('destination');

        $type = $request->get('type');

        $account = Ut_account::where(['type' => $type, 'destination' => $destination])->get()->last();

        if (!$account) {
            return Redirect::back();
        }

        $request->request->add([
            'user' => 1,
            'from_account' => $account->id,
            'from_account_type' => $type,
            'to_account' => $account->id,
            'to_account_type' => $type,
            'type' => 5,
            'date' => $date,
            'amount' => '-' . abs($amount),
        ]);


        $request->request->remove('destination_name');
        $request->request->remove('destination');

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Balansı nağdlaşdırma ");


        $accountBalance = $account->balance - $amount;

        Ut_account::where(['type' => $type, 'destination' => $destination])
            ->update([
                'balance' => $accountBalance,
            ]);

        if ($type == 1) {
            $taxi = $account->taxiName;

            FcmController::notification(500, $taxi->fcm_registered_id, 'Ulduz Taxi', 'Metn', 'Balansınızdan ' . $amount . ' AZN çıxıldı');

        }


        return Redirect::back();
    }

}
