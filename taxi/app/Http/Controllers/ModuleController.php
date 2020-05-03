<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Exception, DB, Auth, Hash, Validator;

class ModuleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getModuleTable($module)
    {
        try {
            if ($module == 'taxi') {
                $columns = ['table', 'avtomabil', 'nomre', 'surucu'];
            } else if ($module == 'customer') {
                $columns = ['ad', 'soyad', 'dogum tarixi', 'qrup'];
            } else {
                $columns = [];
            }

            return view('module-table-page', ['columns' => $columns]);

        } catch (\Exception $exception) {
            return response()->json(['status' => 'error', 'exception' => $exception->getMessage()]);
        }
    }

}
