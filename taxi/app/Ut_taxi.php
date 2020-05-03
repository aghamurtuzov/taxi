<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ut_taxi extends Model
{
    protected $table = 'ut_taxi';
    protected $guarded = [];
    public $timestamps = false;

    //get banned taxi
    public function bannedTaxiName()
    {
        return $this->hasOne('App\Ut_banned_taxi', 'taxi_id')->orderBy('id','DESC');
    }

    //get setting
    public function settingName()
    {
        return $this->hasOne('App\Ut_driver_setting', 'taxi_id');
    }

    //get colors
    public function colorName()
    {
        return $this->belongsTo('App\Ut_colors', 'color');
    }


    //get brand
    public function brandName()
    {
        return $this->belongsTo('App\Ut_brand', 'brand');
    }

    //get model
    public function modelName_()
    {
        return $this->belongsTo('App\Ut_model', 'model');
    }


    //get models
    public function modelName()
    {
        return Ut_model::where('brand', $this->brandName->id)->get();
    }

    //get category
    public function categoryName()
    {
        return $this->belongsTo('App\Ut_taxi_categories', 'category');
    }

    //get account
    public function account()
    {
        return $this->belongsTo('App\Ut_account', 'id', 'destination');
    }

    //get tariff
    public function tariffName()
    {
        $tariff = explode(',', $this->tariff);
        $data = '';
        for ($i = 0; $i < count($tariff); $i++) {
            $data .= ',' . Ut_tariff::where('id', $tariff[$i])->value('name');
        }

        $data[0] = ' ';

        return $data;
    }

    public function tariffArray()
    {
        $tariff = explode(',', $this->tariff);

        return $tariff;
    }

    //get option
    public function optionName()
    {
        $option = explode(',', $this->option);
        $data = '';
        for ($i = 0; $i < count($option); $i++) {
            $data .= ',' . Ut_options::where('id', $option[$i])->value('name');
        }

        $data[0] = ' ';

        return $data;
    }

    public function optionArray()
    {
        $option = explode(',', $this->option);

        return $option;
    }

    public function languageArray()
    {
        $language = explode(',', $this->language);

        return $language;
    }

    public function car()
    {
        if($this->colorName){
            return $this->brandName->name . ' ' . $this->colorName->color_name . ' ' . $this->year;
        }
        return $this->brandName->name . ' ' . $this->color . ' ' . $this->year;
    }

    public function fullName()
    {
        return $this->firstname . ' ' . $this->lastname . ' ' . $this->fathername;
    }

    public function fullNameWithCodeAndNumber()
    {
        return $this->code . '-' . $this->firstname . ' ' . $this->lastname . ' (' . $this->phone . ')';
    }

    public function scopeNumber($query, $number)
    {
        if ($number != null) {
            return $query->where('number', 'LIKE', '%' . $number . '%');
        } else {
            return $query;
        }
    }

    public function scopePage($query, $data){
        return true;
    }
    public function scopeColor($query, $color)
    {
        if ($color != null) {
            return $query->where('color', 'LIKE', '%' . $color . '%');
        } else {
            return $query;
        }
    }


    public function scopeFrom_year($query, $from_year)
    {
        if ($from_year != null) {
            return $query->where('date', '>=', $from_year);
        } else {
            return $query;
        }

    }

    public function scopeTo_year($query, $to_year)
    {
        if ($to_year != null) {
            return $query->where('date', '<', $to_year);
        } else {
            return $query;
        }

    }

    public function scopeModel($query, $model)
    {
        if ($model != null) {
            return $query->where('model', $model);
        } else {
            return $query;
        }

    }

    public function scopeBrand($query, $brand)
    {
        if ($brand != null) {
            return $query->where('brand', $brand);
        } else {
            return $query;
        }

    }

    public function scopeBody($query, $body)
    {
        if ($body != null) {
            return $query->where('body', $body);
        } else {
            return $query;
        }

    }

    public function scopeTariff($query, $tariff)
    {
        if ($tariff != null) {
            return $query->where('tariff', 'LIKE', '%' . $tariff . '%');
        } else {
            return $query;
        }

    }

    public function scopeFuel($query, $fuel)
    {
        if ($fuel != null) {
            return $query->where('fuel', $fuel);
        } else {
            return $query;
        }

    }

    public function scopeCategory($query, $category)
    {
        if ($category != null) {
            return $query->where('category', $category);
        } else {
            return $query;
        }

    }

    public function scopeDriver_language($query, $driver_language)
    {
//        if ($driver_language != null) {
//            return $query->where('driver_language', $driver_language);
//        } else {
//            return $query;
//        }

        return true;

    }

    public function scopeOption($query, $option)
    {
        if ($option != null) {
            return $query->where('option', $option);
        } else {
            return $query;
        }

    }

    public function scopeFullname($query, $fullname)
    {
        if ($fullname != null) {
            if (strpos($fullname, ' ') !== false) {
                $exp = explode(' ', $fullname);
                return $query
                    ->where('firstname', 'LIKE', '%' . $exp[0] . '%')
                    ->where('lastname', 'LIKE', '%' . $exp[1] . '%');
            }
            return $query->where('firstname', 'LIKE', '%' . $fullname . '%')
                ->orWhere('lastname', 'LIKE', '%' . $fullname . '%');

        } else {
            return $query;
        }
    }

    public function scopeCode($query, $code)
    {
        if ($code != null) {
            return $query->where('code', 'LIKE', '%' . $code . '%');
        } else {
            return $query;
        }
    }

    public function scopePhone($query, $phone)
    {
        if ($phone != null) {
            return $query->where('phone', 'LIKE', '%' . $phone . '%');
        } else {
            return $query;
        }
    }


    public function scopeStatus($query, $status)
    {
        if ($status != null) {
            return $query->where('status', $status);
        } else {
            return $query;
        }
    }

    public function scopeFrom_date($query, $from_date)
    {
        if ($from_date != null) {
            return $query->where('date', '>', $from_date);
        } else {
            return $query;
        }

    }

    public function scopeTo_date($query, $to_date)
    {
        if ($to_date != null) {
            return $query->where('date', '=<', $to_date);
        } else {
            return $query;
        }

    }

    public function scopeFrom_date_submit($query, $from_date_submit)
    {
        return true;
    }

    public function scopeTo_date_submit($query, $to_date_submit)
    {
        return true;
    }


    public function scopeColumn_name($query, $column_name, $order_type = 'asc')
    {
        if ($column_name != null) {
            return $query->orderBy($column_name, $order_type);
        } else {
            return $query;
        }
    }


}
