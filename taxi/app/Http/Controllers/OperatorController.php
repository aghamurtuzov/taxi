<?php

namespace App\Http\Controllers;

use App\Ut_messages;
use App\Ut_order;
use App\Ut_sms;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorRequest;
use App\Http\Requests\OperatorSubgroupRequest;
use App\User;
use App\Ut_users;
use App\Ut_groups;
use App\Ut_users_groups;
use App\Ut_subgroup;
use App\Modules;
use Carbon\Carbon;

use Exception, DB, Auth, Hash, Validator;

class OperatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getLogin(Request $request){
        return view('auth.login');
    }

    public function postLogin(Request $request){

        $username = $request->get('username');

        $password = md5($request->get('password'));

        $result = Ut_users::where(['delete'=>false, 'active'=>true, 'username'=>$username, 'password'=>$password])->first();

        if(!$result){
            return redirect()->back();
        }
        else{
            $groups = Ut_users_groups::where(['user_id'=>$result->id])->first();

            session()->put('id', $result->id);

            session()->put('group', $groups->group_id);

            session()->put('name_surname', $result->first_name.' '.$result->last_name);

            return redirect()->route('getDashboard');
        }
    }
    public function logout(){
        session()->flush();
        return redirect()->route('welcome');
    }

    public function getOperator()
    {
        $results = DB::table('ut_users as u')
            ->join('ut_users_groups as ug', 'u.id', 'ug.user_id')
            ->join('ut_groups as g', 'ug.group_id', 'g.id')
            ->join('ut_subgroup as s', 'ug.subgroup_id', 's.id')
            ->select('u.*', 'g.name as group', 's.name as subgroup')
            ->where('g.delete', false)
            ->where('s.delete', false)
            ->where('u.delete', false)
            ->orderBy('u.id', 'DESC')
            ->paginate(20);


        $module = Modules::where('table_name', 'ut_users')->first();

        return view('operator.operator', ['results' => $results, 'module' => $module]);
    }

    public function postSubGroups(Request $request)
    {
        $subgroups = Ut_subgroup::where('delete', false)->where('group', $request->get('id'))->get();

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'subgroups' => $subgroups]);
    }

    public function getOperatorEdit($id)
    {
        $result = DB::table('ut_users as u')
            ->leftJoin('ut_users_groups as ug', 'u.id', 'ug.user_id')
            ->join('ut_subgroup as us', 'ug.subgroup_id', 'us.group')
            ->where('u.id', $id)
            ->where('u.delete', false)
            ->first();

        $groups = Ut_groups::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_users')->first();

        return view('operator.operator-edit', ['result' => $result, 'module' => $module, 'groups' => $groups]);
    }

    public function postOperatorEdit(OperatorRequest $request, $id, $code)
    {

        $request->validated();

        if ($id == 0) {
            if (!$request->password) {
                Session::flash('danger-message', 'Parol boş ola bilməz !');
                return Redirect::back();
            }

            $insertId = Ut_users::insertGetId([
                'ip_address' => $request->ip(),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'father_name' => $request->father_name,
                'email' => $request->email,
                'company' => $request->company,
                'password' => md5($request->password),
                'phone' => $request->phone,
                'username' => $request->username,
                'sip' => $request->sip,
                'sip_password' => $request->sip_password,
                'active' => $request->active,
                'created_on' => Carbon::now()->timestamp,
            ]);

            if ($insertId) {
                $insertUserGroup = Ut_users_groups::insertGetId([
                    'user_id' => $insertId,
                    'group_id' => $request->parent_group,
                    'subgroup_id' => $request->sub_group

                ]);
                if ($insertUserGroup) {
                    Session::flash('success-message', 'İstifadəçi əlavə edildi');
                    return Redirect::back();
                }
            }
        } else {

            DB::table('ut_users')->where('id', $id)
                ->update([
                    'ip_address' => $request->ip(),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'father_name' => $request->father_name,
                    'email' => $request->email,
                    'company' => $request->company,
                    'phone' => $request->phone,
                    'username' => $request->username,
                    'sip' => $request->sip,
                    'sip_password' => $request->sip_password,
                    'active' => $request->active,

                ]);

            if (!empty($request->password) && $request->password) {
                DB::table('ut_users')->where('id', $id)
                    ->update([
                        'password' => md5($request->password)
                    ]);
            }


            DB::table('ut_users_groups')->where('user_id', $id)
                ->update([
                    'user_id' => $id,
                    'group_id' => $request->parent_group,
                    'subgroup_id' => $request->sub_group

                ]);

            Session::flash('success-message', 'İstifadəçiyə düzəliş edildi');
        }

        return Redirect::back();

    }

    public function getOperatorView($id)
    {
        $result = Ut_users::where('id', $id)->where('delete', false)->first();;

        $module = Modules::where('table_name', 'ut_users')->first();

        $messages = Ut_messages::where('delete', false)->where('user_id', $id)->get();

        $smses = Ut_sms::where('delete', false)->where('user_id', $id)->get();

        return view('operator.operator-view', [
            'result' => $result,
            'module' => $module,
            'messages' => $messages,
            'smses' => $smses
        ]);
    }

    public function getOperatorGroup()
    {
        $results = Ut_groups::where('delete', false)->get();
        return view('operator.operator-group', ['results' => $results]);
    }

    public function getOperatorSubGroup()
    {
        $results = Ut_subgroup::where('delete', false)->limit(20)->get();

        $groups = Ut_groups::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_subgroup')->first();

        return view('operator.operator-subgroup', ['results' => $results, 'module' => $module, 'groups' => $groups]);
    }

    public function getOperatorSubGroupEdit($id)
    {

        $result = Ut_subgroup::where('id', $id)->where('delete', false)->first();


        $module = Modules::where('table_name', 'ut_subgroup')->first();

        $groups = Ut_groups::where('delete', false)->get();

        return view('operator.operator-subgroup-edit', ['result' => $result, 'module' => $module, 'groups' => $groups]);

    }

    public function postOperatorSubgroupEdit(OperatorSubgroupRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Alt qrup");

        return Redirect::back();
    }


    public function getOperatorDashboard(){
        $orders = Ut_order::where('user_id',13)->where('created_at','>',Carbon::now()->subDays(30))->count();
        $orders*=0.2;
        $fully = 100-$orders;
        return view('operator.dashboard',['orders'=>$orders,'fully'=>$fully]);
    }
}
