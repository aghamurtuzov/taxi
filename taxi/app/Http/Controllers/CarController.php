<?php

namespace App\Http\Controllers;

use App\Ut_options;
use App\Ut_order;
use App\Ut_tariff;
use Illuminate\Http\Request;
use App\Http\Requests\CarMarkRequest;
use App\Http\Requests\CarModelRequest;
use App\Http\Requests\CarFuelTypeRequest;
use App\Http\Requests\CarBanTypeRequest;
use App\Http\Requests\CarLanguageRequest;
use App\Http\Requests\CarDeviceRequest;
use App\simple_html_dom;

use App\User;
use App\Ut_brand;
use App\Ut_model;
use App\Ut_fuel;
use App\Ut_body;
use App\Ut_device;
use App\Ut_driver_language;
use App\Modules;

use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RegionTurnstileAccessRequest;

class CarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    // CAR MARK START HERE

    public function getCarMark()
    {

//        $href = 'https://turbo.az/autos/3384582-toyota-prado';
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($curl, CURLOPT_HEADER, false);
//        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
//        curl_setopt($curl, CURLOPT_URL, $href);
//        curl_setopt($curl, CURLOPT_REFERER, $href);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
//        $str = curl_exec($curl);
//        curl_close($curl);
//
//        $dom = new simple_html_dom();
//        $dom->load($str);
//        // sv for static values
//        $sv = $dom->find('div[class=product-properties-value]');
//
//        $images_div = $dom->find('div[class=product-photos]')[0];
//        $images = $images_div->find('img');
//        $image_urls = [];
//
//        $q = 0;
//        foreach($images as $im){
//            $image_urls[$q] = trim(($im)->src);
//            $q +=1;
//        }
//        // var_dump($image_urls);
//        $possible_folders = ['f460x343','f330x248','full','thumbnail','f352x352','f1010x323'];
//        $replace = 'f660x496';
//        $start_now = 0;
//        $final_images = [];
//        foreach($image_urls as $image_url){
//            if($start_now == 0){
//                $url = str_replace('/f330x248/', '/' . $replace . '/', $image_url);
//
//            }else {
//                $url = str_replace('/thumbnail/', '/' . $replace . '/', $image_url);
//            }
//            //    echo $url;
//            $final_images[$start_now] = $url;
//            $start_now += 1;
//            //    echo "<hr>";
//        }
//
//        @dd($final_images);
//
//        $city = trim(strip_tags($sv[0]));
//
//        @dd($city);
        $results = Ut_brand::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_brand')->first();

        return view('car.car-mark.car-mark', ['results' => $results, 'module' => $module]);
    }


    public function getCarMarkEdit($id)
    {
        $result = Ut_brand::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_brand')->first();

        return view('car.car-mark.car-mark-edit', ['result' => $result, 'module' => $module]);
    }

    public function postCarMarkEdit(CarMarkRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Marka ");

        return Redirect::back();
    }
    // CAR mark END HERE


// CAR model START HERE

    public function getCarModel()
    {
        $results = Ut_model::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $marks = Ut_brand::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_model')->first();

        return view('car.car-model.car-model', ['results' => $results, 'module' => $module, 'marks' => $marks]);
    }


    public function getCarModelEdit($id)
    {
        $result = Ut_model::where('id', $id)->where('delete', false)->first();

        $marks = Ut_brand::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_model')->first();

        return view('car.car-model.car-model-edit', ['result' => $result, 'module' => $module, 'marks' => $marks]);
    }

    public function postCarModelEdit(CarModelRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Model ");

        return Redirect::back();
    }
    // CAR model END HERE


    // CAR fuel START HERE

    public function getCarFuelType()
    {
        $results = Ut_fuel::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_fuel')->first();

        return view('car.car-fuel-type.car-fuel-type', ['results' => $results, 'module' => $module]);
    }


    public function getCarFuelTypeEdit($id)
    {
        $result = Ut_fuel::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_fuel')->first();

        return view('car.car-fuel-type.car-fuel-type-edit', ['result' => $result, 'module' => $module]);
    }

    public function postCarFuelTypeEdit(CarFuelTypeRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Yanacaq növü ");

        return Redirect::back();
    }
    // CAR fuel END HERE


    // CAR ban START HERE

    public function getCarBanType()
    {
        $results = Ut_body::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_body')->first();

        return view('car.car-ban-type.car-ban-type', ['results' => $results, 'module' => $module]);
    }


    public function getCarBanTypeEdit($id)
    {
        $result = Ut_body::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_body')->first();

        return view('car.car-ban-type.car-ban-type-edit', ['result' => $result, 'module' => $module]);
    }

    public function postCarBanTypeEdit(CarBanTypeRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Ban növü ");

        return Redirect::back();
    }
    // CAR ban END HERE


    // CAR Driver languages START HERE

    public function getCarDevice()
    {
        $results = Ut_device::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_device')->first();

        return view('car.car-device.car-device', ['results' => $results, 'module' => $module]);
    }


    public function getCarDeviceEdit($id)
    {
        $result = Ut_device::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_device')->first();

        return view('car.car-device.car-device-edit', ['result' => $result, 'module' => $module]);
    }

    public function postCarDeviceEdit(CarDeviceRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Sürücü Cihazı ");

        return Redirect::back();
    }
    // CAR languages END HERE


    // CAR device START HERE

    public function getCarLanguage()
    {
        $results = Ut_driver_language::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_driver_language')->first();

        return view('car.car-language.car-language', ['results' => $results, 'module' => $module]);
    }


    public function getCarLanguageEdit($id)
    {
        $result = Ut_driver_language::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_driver_language')->first();

        return view('car.car-language.car-language-edit', ['result' => $result, 'module' => $module]);
    }

    public function postCarLanguageEdit(CarLanguageRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Sürücü dili ");

        return Redirect::back();
    }

    // CAR device HERE



    public function getOrderUpdate($id)
    {
        $result = Ut_order::where('id', $id)->first();

        $tariffs = Ut_tariff::where('delete', false)->get();

        $options = Ut_options::where('delete', false)->get();

        return view('order.order-update', [
            'result' => $result,
            'tariffs' => $tariffs,
            'options' => $options,
        ]);
    }
}
