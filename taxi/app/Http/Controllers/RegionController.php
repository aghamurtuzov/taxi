<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\RegionCountryRequest;
use App\Http\Requests\RegionAllRequest;
use App\Http\Requests\RegionCityRequest;
use App\Http\Requests\RegionDistrictRequest;
use App\Http\Requests\RegionObjectCategoryRequest;
use App\Http\Requests\RegionObjectRequest;
use App\Http\Requests\RegionSpecialObjectCategoryRequest;
use App\Http\Requests\RegionSpecialObjectRequest;
use App\Http\Requests\RegionDangerObjectRequest;
use App\Http\Requests\RegionStreetRequest;
use App\Http\Requests\RegionTurnstileAccessRequest;
use App\User;
use App\Modules;
use App\Ut_address;
use App\Ut_country;
use App\Ut_region;
use App\Ut_city;
use App\Ut_district;
use App\Ut_object_category;
use App\Ut_skat_addresses_filtered;
use App\Ut_special_objects;
use App\Ut_danger_objects;
use App\Ut_special_object_category;
use App\Ut_street;
use App\Ut_objects;
use App\Ut_object_tourniquets;
use Illuminate\Http\Request;
use Exception, DB, Auth, Hash, Validator;
use Illuminate\Support\Facades\Redirect;


class RegionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

//////////////////////////////// START REGION COUNTRY///////////////////////////////////
    public function getRegionCountry()
    {
        $results = Ut_country::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_country')->first();


        return view('region.country.region-country', ['results' => $results, 'module' => $module]);
    }

    public function getRegionCountryEdit($id)
    {
        $result = Ut_country::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_country')->first();

        return view('region.country.region-country-edit', ['result' => $result, 'module' => $module]);
    }


    public function postRegionCountryEdit(RegionCountryRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Ölkə");

        return Redirect::back();
    }




////////////////////////////////// END REGION COUNTRY //////////////////////////////////////////////

////////////////////////////////// START REGION all //////////////////////////////////////////////
    public function getRegionAll()
    {
        $results = Ut_region::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_region')->first();

        $countries = Ut_country::where('delete', false)->get();

        return view('region.region.region-all', ['results' => $results, 'module' => $module, 'countries' => $countries]);
    }

    public function getRegionAllEdit($id)
    {
        $result = Ut_region::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_region')->first();

        $countries = Ut_country::where('delete', false)->get();

        return view('region.region.region-all-edit', ['result' => $result, 'module' => $module, 'countries' => $countries]);
    }

    public function postRegionAllEdit(RegionAllRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Region");

        return Redirect::back();
    }

////////////////////////////////// END REGION all //////////////////////////////////////////////

////////////////////////////////// start REGION city //////////////////////////////////////////////


    public function getRegionCity()
    {
        $results = Ut_city::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_city')->first();

        $countries = Ut_country::where('delete', false)->get();

        $regions = Ut_region::where('delete', false)->get();

        return view('region.city.region-city', ['results' => $results, 'module' => $module, 'countries' => $countries, 'regions' => $regions]);
    }


    public function getRegionCityEdit($id)
    {
        $result = Ut_city::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_city')->first();
        $countries = Ut_country::where('delete', false)->get();

        $regions = Ut_region::where('delete', false)->get();
        return view('region.city.region-city-edit', ['result' => $result, 'module' => $module, 'countries' => $countries, 'regions' => $regions]);
    }

    public function postRegionCityEdit(RegionCityRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Şəhər");

        return Redirect::back();
    }


    ////////////////////////////////// END REGION city //////////////////////////////////////////////


    public function getRegionDistrict()
    {
        $results = Ut_district::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_district')->first();

        $cities = Ut_city::where('delete', false)->get();


        return view('region.district.region-district', ['results' => $results, 'module' => $module, 'cities' => $cities]);
    }

    public function getRegionDistrictEdit($id)
    {
        $result = Ut_district::where('id', $id)->where('delete', false)->first();

        $cities = Ut_city::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_district')->first();

        return view('region.district.region-district-edit', ['result' => $result, 'module' => $module, 'cities' => $cities]);
    }

    public function postRegionDistrictEdit(RegionDistrictRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Küçə");

        return Redirect::back();
    }


    ////////////////////////////////// END REGION DISTRICT //////////////////////////////////////////////

    public function getRegionObjectCategory()
    {
        $results = Ut_object_category::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_object_category')->first();

        return view('region.objectCategory.region-object-category', ['results' => $results, 'module' => $module]);
    }

    public function getRegionObjectCategoryEdit($id)
    {
        $result = Ut_object_category::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_object_category')->first();

        return view('region.objectCategory.region-object-category-edit', ['result' => $result, 'module' => $module]);
    }

    public function postRegionObjectCategoryEdit(RegionObjectCategoryRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Obyekt Kategoriyası");

        return Redirect::back();
    }

    ////////////////////////////////// END REGION OBJECT CATEGORY //////////////////////////////////////////////

    ////////////////////////////////// START REGION SPECIAL OBJECT CATEGORY //////////////////////////////////////////////

    public function getRegionSpecialObjectCategory()
    {
        $results = Ut_special_object_category::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_special_object_category')->first();

        return view('region.special-object-category.region-special-object-category', ['results' => $results, 'module' => $module]);
    }

    public function getRegionSpecialObjectCategoryEdit($id)
    {
        $result = Ut_special_object_category::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_special_object_category')->first();

        return view('region.special-object-category.region-special-object-category-edit', ['result' => $result, 'module' => $module]);
    }

    public function postRegionSpecialObjectCategoryEdit(RegionSpecialObjectCategoryRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Xüsusi Obyekt Kategoriyası");

        return Redirect::back();
    }
    ////////////////////////////////// END REGION SPECIAL OBJECT CATEGORY //////////////////////////////////////////////


    ////////////////////////////////// START REGION SPECIAL OBJECT  //////////////////////////////////////////////
    public function getRegionSpecialObject()
    {
        $results = Ut_special_objects::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $categories = Ut_special_object_category::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_special_objects')->first();

        return view('region.special-object.region-special-object', ['results' => $results, 'module' => $module, 'categories' => $categories]);
    }

    public function getRegionSpecialObjectEdit($id)
    {
        $result = Ut_special_objects::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_special_objects')->first();

        $categories = Ut_special_object_category::where('delete', false)->get();

//        return $result;

        return view('region.special-object.region-special-object-edit', ['result' => $result, 'module' => $module, 'categories' => $categories]);
    }

    public function postRegionSpecialObjectEdit(RegionSpecialObjectRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Xüsusi Obyekt");

        return Redirect::back();
    }

    public function postDestinationSearchAddress(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'text' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'false', 'error' => 403, 'message' => $validator->errors()]);
            }

            $text = $request->get('text');

            $results = $this->getSearchAddressResult($text);
//            if (!count($results)) {
//                $results = false;
//            }

            if (!$results) {
                return response()->json(['status' => 'false', 'error' => '', 'success' => false, 'results' => $results]);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'results' => $results]);
    }

    public function replaceUtf8($text)
    {

        $a = array('E', 'İ', 'U', 'O', 'G', 'S', 'C', 'e', 'i', 'u', 'o', 'g', 's', 'c');

        $b = array('Ə', 'I', 'Ü', 'Ö', 'Ğ', 'Ş', 'Ç', 'ə', 'ı', 'ü', 'ö', 'ğ', 'ş', 'ç');

        return str_replace($a, $b, $text);
    }

    public function getSearchAddressResult($text)
    {
        $text_az = $this->replaceUtf8($text);

        $textArray = explode(' ', $text);

        $textAzArray = explode(' ', $text_az);

        $results = DB::select('
        
        SELECT
    ut_objects.id,
  CONCAT(ut_objects.name, IFNULL(CONCAT(\' \', ut_objects.street), \'\'), IFNULL(CONCAT(\' \', ut_objects.number), \'\'), IFNULL(CONCAT(\', \', ut_region.name), \'\'), IFNULL(CONCAT(\', \', ut_city.name),\'\'), IFNULL(CONCAT(\', \', ut_district.name),\'\')) as name,
  \'1\' as type,
  \'1\' as tourniquet_type,
  ut_objects.latitude,
  ut_objects.longitude,
  ut_object_tourniquets.price, 
  ut_objects.priority,
  ut_object_tourniquets.delete as del
FROM ut_objects
LEFT JOIN ut_region on ut_region.id=ut_objects.region
LEFT JOIN ut_city on ut_city.id=ut_objects.city
LEFT JOIN ut_district on ut_district.id=ut_objects.district
LEFT JOIN ut_object_tourniquets on ut_object_tourniquets.object_id=ut_objects.id
WHERE (ut_objects.name LIKE "%' . $textArray[0] . '%" AND ut_objects.name LIKE "%' . $textArray[count($textArray) - 1] . '%")
OR (ut_objects.name LIKE "%' . $textAzArray[0] . '%" AND ut_objects.name LIKE "%' . $textAzArray[count($textAzArray) - 1] . '%")


UNION ALL

SELECT
    ut_street.id,
  CONCAT(ut_street.name, IFNULL(CONCAT(\', -\', ut_region.name), \'\'), IFNULL(CONCAT(\', -\', ut_city.name),\'\')) as name,
  \'2\' as type,
  \'3\' as tourniquet_type,
  null as latitude,
  null as longitude,
  0 as price,
  ut_street.priority,
    2 as del
FROM ut_street
LEFT JOIN ut_region on ut_region.id=ut_street.region
LEFT JOIN ut_city on ut_city.id=ut_street.city
WHERE (ut_street.name LIKE "%' . $textArray[0] . '%" AND ut_street.name LIKE "%' . $textArray[count($textArray) - 1] . '%")
OR (ut_street.name LIKE "%' . $textAzArray[0] . '%" AND ut_street.name LIKE "%' . $textAzArray[count($textAzArray) - 1] . '%")

UNION ALL

SELECT
    ut_skat_addresses_filtered.id,
  CONCAT(ut_skat_addresses_filtered.name, IFNULL(CONCAT(\', \', ut_city.name),\'\')) as name,
  \'1\' as type,
  \'2\' as tourniquet_type,
  ut_skat_addresses_filtered.latitude,
  ut_skat_addresses_filtered.longitude,
  0 as price,
  ut_skat_addresses_filtered.priority,
    2 as del
FROM ut_skat_addresses_filtered
LEFT JOIN ut_city on ut_city.id=ut_skat_addresses_filtered.city_id
WHERE (ut_skat_addresses_filtered.name LIKE "%' . $textArray[0] . '%" AND ut_skat_addresses_filtered.name LIKE "%' . $textArray[count($textArray) - 1] . '%")
OR (ut_skat_addresses_filtered.name LIKE "%' . $textAzArray[0] . '%" AND ut_skat_addresses_filtered.name LIKE "%' . $textAzArray[count($textAzArray) - 1] . '%")


ORDER BY priority desc
LIMIT 30;
        
        
        ');

        return $results;


    }


    ////////////////////////////////// END REGION SPECIAL OBJECT  //////////////////////////////////////////////


    ////////////////////////////////// START REGION DANGER OBJECT  //////////////////////////////////////////////
    public function getRegionDangerObject()
    {
        $results = Ut_danger_objects::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_danger_objects')->first();

        return view('region.danger-objects.region-danger-objects', ['results' => $results, 'module' => $module]);
    }

    public function getRegionDangerObjectEdit($id)
    {
        $result = Ut_danger_objects::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_danger_objects')->first();

        return view('region.danger-objects.region-danger-objects-edit', ['result' => $result, 'module' => $module]);
    }


    public function postRegionDangerObjectEdit(RegionDangerObjectRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Təhlükəli Obyekt");

        return Redirect::back();
    }
    ////////////////////////////////// END REGION DANGER OBJECT  //////////////////////////////////////////////


    //////////////// START REGİON STREET //////////////////////

    public function getRegionStreet()
    {
        $results = Ut_street::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_street')->first();

        return view('region.street.region-street', ['results' => $results, 'module' => $module]);
    }

    public function getRegionStreetEdit($id)
    {
        $result = Ut_street::where('id', $id)->where('delete', false)->first();
        $cities = Ut_city::where('delete', false)->get();
        $regions = Ut_region::where('delete', false)->get();
        $module = Modules::where('table_name', 'ut_street')->first();

        return view('region.street.region-street-edit', ['result' => $result, 'module' => $module, 'cities' => $cities, 'regions' => $regions]);
    }

    public function postRegionStreetEdit(RegionStreetRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Küçə");

        return Redirect::back();
    }
    //////////////// END REGİON STREET //////////////////////


    //////////////// START REGİON STREET //////////////////////

    public function getRegionTurnstileAccess()
    {
        $results = Ut_object_tourniquets::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_object_tourniquets')->first();

        return view('region.turnstile-access.region-turnstile-access', ['results' => $results, 'module' => $module]);
    }

    public function getRegionTurnstileAccessEdit($id)
    {
        $result = Ut_object_tourniquets::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_object_tourniquets')->first();

        return view('region.turnstile-access.region-turnstile-access-edit', ['result' => $result, 'module' => $module]);
    }

    public function postRegionTurnstileAccessEdit(RegionTurnstileAccessRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Turniket girişi ");

        return Redirect::back();
    }

    //////////////// END REGİON STREET //////////////////////


    //////////////// REGİON Object //////////////////////

    public function getRegionObject()
    {
        $results = Ut_objects::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_objects')->first();

        $cities = Ut_city::where('delete', false)->get();

        $regions = Ut_region::where('delete', false)->get();

        $districts = Ut_district::where('delete', false)->get();

        $types = Ut_object_category::where('delete', false)->get();

        return view('region.object.region-object', ['results' => $results, 'module' => $module, 'cities' => $cities, 'regions' => $regions, 'districts' => $districts, 'types' => $types]);
    }

    public function getRegionObjectEdit($id)
    {
        $result = Ut_objects::where('id', $id)->where('delete', false)->first();

        $module = Modules::where('table_name', 'ut_objects')->first();

        $districts = Ut_district::where('delete', false)->get();

        $cities = Ut_city::where('delete', false)->get();

        $regions = Ut_region::where('delete', false)->get();

        $types = Ut_object_category::where('delete', false)->get();

        return view('region.object.region-object-edit', ['result' => $result, 'module' => $module, 'cities' => $cities, 'regions' => $regions, 'districts' => $districts, 'types' => $types]);
    }


    public function postRegionObjectEdit(RegionObjectRequest $request, $id, $code)
    {
        $request->validated();

        $request->request->remove('street_name');

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Obyekt");

        return Redirect::back();
    }

    //////////////// END REGİON Object //////////////////////

    public function getRegionAddress()
    {
        $results = Ut_address::where('delete', false)->orderBy('id', 'DESC')->paginate(20);

        $module = Modules::where('table_name', 'ut_address')->first();

        return view('region.address.region-address', ['results' => $results, 'module' => $module]);
    }

    public function getRegionAddressNew($id)
    {
        $result = Ut_address::where('id', $id)->where('delete', false)->first();

        $districts = Ut_district::where('delete', false)->get();

        $module = Modules::where('table_name', 'ut_address')->first();

        return view('region.address.region-address-new', ['result' => $result, 'module' => $module, 'districts' => $districts]);
    }


    public function postRegionAddressEdit(AddressRequest $request, $id, $code)
    {
        $request->validated();

        InsertOrUpdateController::postModuleEdit($request->all(), $id, $code, "Ünvan");

        return Redirect::back();
    }


    public function postDestinationSearchStreet(Request $request)
    {
        $text = $request->get('text');

        $results = Ut_street::where('delete', false)->where('name', 'LIKE', '%' . $text . '%')->limit('20')->get();

        if (!count($results)) {
            $results = false;
        }

        if (!$results) {
            return response()->json(['status' => 'false', 'error' => '', 'success' => false, 'results' => $results]);
        }

        return response()->json(['status' => 'true', 'error' => '', 'success' => 200, 'results' => $results]);
    }

}
