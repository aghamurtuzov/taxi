<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\FcmController;
use App\Http\Requests\PriorityDecreaseRequest;
use App\Http\Requests\PriorityOperationRequest;
use App\Modules;
use App\Ut_priority_transactions;
use App\Ut_taxi;
use App\Ut_taxi_categories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PriorityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getPriorityOperation()
    {
        $results = Ut_priority_transactions::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_priority_transactions')->first();

        return view('priority.priority-operation', ['results' => $results, 'module' => $module]);
    }

    public function getPriorityOperationNew($id)
    {
        $result = Ut_priority_transactions::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_priority_transactions')->first();

        return view('priority.priority-operation-new', ['module' => $module, 'result' => $result]);
    }

    public function postPriorityOperationEdit(PriorityOperationRequest $request, $id, $code)
    {
        $request->validated();

        $date = Carbon::now();

        $priority = $request->get('priority');

        $taxi_id = $request->get('taxi_id');

        $taxi = Ut_taxi::where(['status' => true, 'id' => $taxi_id])->get()->last();

        if (!$taxi) {
            return Redirect::back();
        }

        $newPriority = $taxi->priority + $priority;

        Ut_taxi::where('id', $taxi_id)
            ->update([
                'priority' => $newPriority
            ]);

        $request->request->add(['type' => '0', 'date' => $date, 'description' => 'Prioritet əməliyyatı']);

        $request->request->remove('taxi');

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Prioritet");

        //artdi ya azaldi
        $increaseOrDecrease = $priority < 0 ? 'azaldı' : 'artdı';

        FcmController::notification(500, $taxi->fcm_registered_id, 'Ulduz Taxi', 'Metn', 'Prioritet ' . $priority . ' ' . $increaseOrDecrease);

        return Redirect::back();
    }

    public function getPriorityDecrease()
    {
        $taxiCategories = Ut_taxi_categories::where('delete', false)->get();

        return view('priority.priority-decrease', ['taxiCategories' => $taxiCategories]);
    }


    public function postPriorityDecreaseEdit(PriorityDecreaseRequest $request)
    {
        $request->validated();

        $category_id = $request->get('category');
        $discount = $request->get('discount');

        $taxis = Ut_taxi::where(['delete' => false, 'category' => $category_id])->get();

        if (!count($taxis)) {
            Session::flash('taxi-not-found-message', 'Taksi tapılmadı');
        } else {
            Session::flash('success-message', 'Prioritet endirimi edildi');
        }


        foreach ($taxis as $taxi) {
            DB::table('ut_taxi')
                ->where('id', $taxi->id)
                ->update([
                    'priority' => DB::raw('priority-((priority*' . $discount . ')/100)')
                ]);

            FcmController::notification(500, $taxi->fcm_registered_id, 'Ulduz Taxi', 'Metn', 'Prioritet ' . $discount . '% azaldı');
        }

        return Redirect::back();
    }

}
