@extends('main.layout')
@section('content')

    <!-- Form horizontal -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Yeni taksi</h5>
            <div class="heading-elements">

            </div>
        </div>
        <div class="panel-body">
            @if(Session::has('success-message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success-message') }}</p>
            @endif
            @if ($errors->any())
                <ul class="alert alert-class alert-danger" style="padding-left: 60px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('postTaxiEdit',['id' => $result->id??'0','code' => $module->code]) }}"
                  class="form-horizontal"
                  method="post" accept-charset="utf-8">
                @csrf
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#basic-tab1" data-toggle="tab"><h6>AVTOMOBİL
                                    MƏLUMATLARI</h6></a>
                        </li>
                        <li><a href="#basic-tab2" data-toggle="tab"><h6>SƏNƏDLƏR</h6></a></li>
                        <li><a href="#basic-tab3" data-toggle="tab"><h6>ŞƏXSİ MƏLUMATLAR</h6></a></li>
{{--                        <li><a href="#basic-tab4" data-toggle="tab"><h6>DİGƏR</h6></a></li>--}}
                        <li><a href="#basic-tab5" data-toggle="tab"><h6>DİGƏR</h6></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="basic-tab1">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Nömrə nişanı <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="number" class="form-control"
                                                   data-mask="99-aa-999"
                                                   placeholder="10-AA-001" value="{{ old('number') }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Tarif <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <select name="tariff[]" class="form-control select-category"
                                                    multiple="multiple">
                                                @foreach($tariffs as $tariff)
                                                    <option @if(in_array($tariff->id,old('tariff')??[0] )) selected
                                                            @endif value="{{ $tariff->id }}">{{ $tariff->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Markası <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <select name="brand" class="form-control select-search">
                                                @foreach($brands as $brand)
                                                    <option @if(old('brand') == $brand->id) selected
                                                            @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Modeli <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <select name="model" class="form-control select-search">
                                                <option value="">Model seçin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Rəngi <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <select name="color" class="form-control">
                                                @foreach($colors as $color)
                                                    <option @if(old('color') == $color->id) selected
                                                            @endif value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">İli <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="year" class="form-control" minlength="4"
                                                   maxlength="4" value="{{ old('year') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Ban növü <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <select name="body" class="form-control">
                                                @foreach($bodies as $body)
                                                    <option @if(old('body') == $body->id) selected
                                                            @endif value="{{ $body->id }}">{{ $body->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Yanacaq növü </label>
                                        <div class="col-lg-9">
                                            <select name="fuel" class="form-control">
                                                @foreach($fuels as $fuel)
                                                    <option @if(old('fuel') == $fuel->id) selected
                                                            @endif value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Yanacaq sərfi</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="fuel_consumption" class="form-control"
                                                   value="{{old('fuel_consumption') }}"
                                                   placeholder="17" maxlength="2"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Sürət qutusu </label>
                                        <div class="col-lg-9">
                                            <select name="transmission" class="form-control">
                                                <option @if(old('transmission') == 1) selected
                                                        @endif value="1">Avtomatik
                                                </option>
                                                <option @if(old('transmission') == 2) selected
                                                        @endif value="2">Mexaniki
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="basic-tab2">
                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Ş/V seriyası </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="passport" class="form-control"
                                                   value="{{ old('passport') }}"
                                                   placeholder="16172520" minlength="8" maxlength="8"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Ş/V fin kodu </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="pin_code" class="form-control"
                                                   value="{{ old('pin_code') }}"
                                                   placeholder="2GV5BCP" minlength="7" maxlength="7"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Sürücülük Vəsiqəsi
                                            </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="driver_license" class="form-control"
                                                   value="{{ old('driver_license') }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Müqavilə №</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="contract" class="form-control"
                                                   value="{{ old('contract') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">VÖEN</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="tax" class="form-control"
                                                   placeholder="1602394702"
                                                   value="{{ old('tax') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Fərqlənmə nişanı</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="taxi_license" class="form-control"
                                                   placeholder="1602394702" value="{{ old('taxi_license') }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Bitmə tarixi </label>
                                        <div class="input-group col-lg-9">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                            <input type="text" name="taxi_license_expiry"
                                                   class="form-control taxi_license_expiry" placeholder=""
                                                   value="{{ old('taxi_license_expiry') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Texpasport</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="technical_passport" class="form-control"
                                                   placeholder="1602394702"
                                                   value="{{ old('technical_passport') }}">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="basic-tab3">
                            <fieldset class="content-group">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Adı <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="firstname" class="form-control"
                                                   placeholder="Müşviq" value="{{ old('firstname') }}"
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Soyadı <sup>*</sup></label>
                                        <div class="col-lg-9">
                                             <input type="text" name="lastname" class="form-control"
                                                   placeholder="Manaflı" value="{{ old('lastname') }}"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Ata adı </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="fathername" class="form-control"
                                                   placeholder="Mehman" value="{{ old('fathername') }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Cinsi <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <select name="sex" class="form-control">
                                                <option @if(old('sex') == 1) selected
                                                        @endif  value="1" selected="selected">Kişi
                                                </option>
                                                <option @if(old('sex') == 2) selected
                                                        @endif  value="2">Qadın
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Doğum günü <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="birthday"
                                                   class="form-control taxi_birthday"
                                                   value="{{ old('birthday') }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Qeydiyyat ünvanı
                                            </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="address" class="form-control"
                                                   placeholder="BAKI şəh., NİZAMİ ray., Q. QARAYEV PR, ev.57, m.88"
                                                   value="{{ old('address') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Mobil prefiks <sup>*</sup></label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="phone_prefix">
                                                <option value="">Seç</option>
                                                <option @if(old('phone_prefix') == 50) selected
                                                        @endif value="50">050
                                                </option>
                                                <option @if(old('phone_prefix') == 51) selected
                                                        @endif value="51">051
                                                </option>
                                                <option @if(old('phone_prefix') == 55) selected
                                                        @endif value="55">055
                                                </option>
                                                <option @if(old('phone_prefix') == 70) selected
                                                        @endif value="70">070
                                                </option>
                                                <option @if(old('phone_prefix') == 77) selected
                                                        @endif value="77">077
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="phone" class="form-control"
                                                   placeholder="9227710"
                                                   value="{{ old('phone') }}" maxlength="7"
                                                   minlength="7">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Mobil prefiks 2</label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="mobile_prefix">
                                                <option value="">Seç</option>
                                                <option @if(old('mobile_prefix') == 50) selected
                                                        @endif value="50">050
                                                </option>
                                                <option @if(old('mobile_prefix') == 51) selected
                                                        @endif value="51">051
                                                </option>
                                                <option @if(old('mobile_prefix') == 55) selected
                                                        @endif value="55">055
                                                </option>
                                                <option @if(old('mobile_prefix') == 70) selected
                                                        @endif value="70">070
                                                </option>
                                                <option @if(old('mobile_prefix') == 77) selected
                                                        @endif value="77">077
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="mobile" class="form-control"
                                                   placeholder="9227710"
                                                   value="{{ old('mobile') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">E-mail </label>
                                        <div class="col-lg-9">
                                            <input type="email" name="email" class="form-control"
                                                   placeholder="nadjafzadeh@gmail.com"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Qeyd</label>
                                        <div class="col-lg-9">
                                            <input type="text" name="description" class="form-control"
                                                   placeholder="Sürücü barədə əlavə qeyd"
                                                   value="{{ old('description') }}">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
{{--                        <div class="tab-pane" id="basic-tab4">--}}
{{--                            <fieldset class="content-group">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <label class="control-label col-lg-3">Marka <sup>*</sup></label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <select name="device_marka" class="form-control">--}}
{{--                                                @foreach($devices as $device)--}}
{{--                                                    <option @if(old('device_marka') == $device->id) selected--}}
{{--                                                            @endif value="{{ $device->id }}">{{ $device->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <label class="control-label col-lg-3">Model <sup>*</sup></label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <input type="text" name="device_model" class="form-control"--}}
{{--                                                   value="{{ old('device_model') }}" placeholder="SM-A710">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </fieldset>--}}
{{--                        </div>--}}
                        <div class="tab-pane" id="basic-tab5">
                            <fieldset>
                                <div class="row">
{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <label class="control-label col-lg-3">Sürücünün Km </label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <input type="text" id="distance" name="distance"--}}
{{--                                                   value="{{ old('distance') }}"--}}
{{--                                                   class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Status </label>
                                        <div class="col-lg-9">
                                            <select name="status" class="form-control">
                                                <option @if(old('status') == 1) selected
                                                        @endif value="1">Aktiv
                                                </option>
                                                <option @if(old('status') == 0) selected
                                                        @endif value="0">Deaktiv
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Cizhazınız təsdiq kodu<sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <input type="text" id="code" name="device_id" max=""
                                                   value="{{ old('device_id') }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Aqreqatlar </label>
                                        <div class="col-lg-9">
                                            <select name="option[]" class="form-control select-languages"
                                                    multiple="multiple">
                                                @foreach($options as $option)
                                                    <option  @if(in_array($option->id,old('option')??[0] )) selected
                                                            @endif value="{{ $option->id }}">{{ $option->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Taksi categoriyaları</label>
                                        <div class="col-lg-9">
                                            <select name="category" class="form-control select-languages"
                                                    required="required">
                                                @foreach($categories as $category)
                                                    <option @if(isset($result->category) && $result->category == $category->id) selected
                                                            @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Bildiyi Dillər
                                            </label>
                                        <div class="col-lg-9">
                                            <select name="language[]"
                                                    class="form-control select-languages"
                                                    multiple="multiple">
                                                @foreach($driver_languages as $driver_language)
                                                    <option @if(in_array($driver_language->id,old('language')??[0] )) selected
                                                            @endif value="{{ $driver_language->id }}">{{ $driver_language->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Tabel <sup>*</sup></label>
                                        <div class="col-lg-9">
                                            <input type="text" id="code" name="code" max="6"
                                                   value="{{ old('code') }}"
                                                   class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="control-label col-lg-3">Balanssız? </label>
                                        <div class="col-lg-9">
                                            <label class="radio-inline">
                                                <input @if(old('free') == 1) checked
                                                       @endif  type="radio" name="free" class="styled" value="1">BƏLİ
                                            </label>
                                            <label class="radio-inline">
                                                <input @if(old('free') == 0) checked
                                                       @endif type="radio" name="free" value="0" class="styled">
                                                XEYR </label>
                                        </div>
                                    </div>


{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <label class="control-label col-lg-3">Xüsusi faiz dərəcəsi </label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <input type="number" name="custom_fee" min="0" max="99"--}}
{{--                                                   value="{{ old('custom_fee') }}"--}}
{{--                                                   class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <label class="control-label col-lg-3">Rayon? </label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <label class="radio-inline">--}}
{{--                                                <input @if(old('region_id') == 1) checked--}}
{{--                                                       @endif type="radio" name="region_id" class="styled"--}}
{{--                                                       value="1">--}}
{{--                                                BƏLİ </label>--}}
{{--                                            <label class="radio-inline">--}}
{{--                                                <input @if(old('region_id') == 0) checked--}}
{{--                                                       @endif type="radio" name="region_id" class="styled"--}}
{{--                                                       value="0"--}}
{{--                                                       checked="checked">--}}
{{--                                                XEYR </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <label class="control-label col-lg-3">Kompaniya maşını?--}}
{{--                                            </label>--}}
{{--                                        <div class="col-lg-9">--}}
{{--                                            <label class="radio-inline">--}}
{{--                                                <input @if(old('is_company') == 1) checked--}}
{{--                                                       @endif type="radio" name="is_company" class="styled"--}}
{{--                                                       value="1">--}}
{{--                                                BƏLİ </label>--}}
{{--                                            <label class="radio-inline">--}}
{{--                                                <input @if(old('is_company') == 0) checked--}}
{{--                                                       @endif type="radio" name="is_company" class="styled"--}}
{{--                                                       value="0"--}}
{{--                                                       checked="checked">--}}
{{--                                                XEYR </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="row text-center">


                    <button type="submit" class="btn btn-success">Yeni taksi yarat</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript">


        $('select[name=\'marka\']').trigger('change');

        $('.select-category').select2();
        $('.select-languages').select2();

        $('.taxi_birthday').daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'YYYY-MM-DD'
            },
            minYear: '1900',
        });

        $('.taxi_license_expiry').daterangepicker({
            showDropdowns: true,
            singleDatePicker: true,
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

    </script>


    <script>
        $('select[name="brand"]').change(function(){
            var brand = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: "{{ route('getModels') }}",
                dataType: 'json',
                data: {
                    brand: brand,
                },
                success: function (data) {
                    if (data['success']) {

                        $('select[name="model"]').html('');
                        $.each(data['models'], function (index, value) {
                            $('select[name="model"]').append('<option value="'+ value.id +'">'+value.name+'</optionid>')
                        });
                    } else {

                    }
                }
            });
        });

        $(window).load(function(){
            let brand = $('select[name="brand"]').children("option:selected").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: "{{ route('getModels') }}",
                dataType: 'json',
                data: {
                    brand: brand,
                },
                success: function (data) {
                    if (data['success']) {

                        $('select[name="model"]').html('');
                        $.each(data['models'], function (index, value) {
                            if("{{ old('model') }}" == value.id){

                                $('select[name="model"]').append('<option selected value="'+ value.id +'">'+value.name+'</option>')
                            }
                            else{
                                $('select[name="model"]').append('<option value="'+ value.id +'">'+value.name+'</option>')
                            }
                        });
                    } else {

                    }
                }
            });
        });
    </script>
@endsection



