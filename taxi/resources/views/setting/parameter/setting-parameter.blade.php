@extends('main.layout')
@section('content')





    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h6 class="panel-title">Parametrlər</h6>
                                <div class="heading-elements">
                                </div>
                            </div>
                            <div class="panel-body">
                                @if(Session::has('success-message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success-message') }}</p>
                                @endif
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <p class="alert alert-class alert-danger">{{ $error }}</p>
                                    @endforeach
                                @endif
                                <form action="{{ route('postSettingParameterEdit') }}"
                                      class="form-horizontal" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="tabbable nav-tabs-vertical nav-tabs-left">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li><a href="#tab1" data-toggle="tab"><i
                                                            class="icon-headset position-left"></i>Operator</a>
                                            </li>
                                            <li><a href="#tab2" data-toggle="tab"><i
                                                            class="icon-car2 position-left"></i>Sürücü</a>
                                            </li>
                                            <li><a href="#tab3" data-toggle="tab"><i
                                                            class="icon-user position-left"></i>Dispetçer</a>
                                            </li>
                                            <li><a href="#tab4" data-toggle="tab"><i
                                                            class="icon-envelop position-left"></i>Sms</a>
                                            </li>
                                            {{--<li><a href="#tab5" data-toggle="tab"><i--}}
                                                            {{--class="icon-cog7 position-left"></i>Məsafə--}}
                                                    {{--Serveri</a></li>--}}
                                            <li><a href="#tab6" data-toggle="tab"><i
                                                            class="icon-cog7 position-left"></i>Veb
                                                    Servis</a></li>
                                            <li><a href="#tab7" data-toggle="tab"><i
                                                            class="icon-cog7 position-left"></i>Tarif</a>
                                            </li>

                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <fieldset class="content-group">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Public Button For
                                                            Operator</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['public_button_for_operator'] ? 'checked' : '' }}
                                                                   name="public_button_for_operator"
                                                                   type="checkbox"
                                                                   class="switchery-primary11">
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <script type="text/javascript">
                                                    var primary = document.querySelector('.switchery-primary11');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                </script>
                                            </div>

                                            <div class="tab-pane" id="tab2">
                                                <fieldset class="content-group">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Qiyməti göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['show_price'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="show_price"
                                                                   class="switchery-primary1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Təyinatı göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['show_destination'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="show_destination"
                                                                   class="switchery-primary2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Naviqator</label>
                                                        <div class="col-lg-10 multi-select-full">
                                                            <select name="navigator[]" multiple="multiple"
                                                                    class="select">
                                                                <optgroup label="Naviqator">
                                                                    <option @if(in_array(1, $result['navigator'] )) selected
                                                                            @endif value="1">Waze
                                                                    </option>
                                                                    <option @if(in_array(2, $result['navigator'] )) selected
                                                                            @endif value="2">City Guide
                                                                    </option>
                                                                    <option @if(in_array(3, $result['navigator'] )) selected
                                                                            @endif value="3">GeoNet
                                                                    </option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">İstək saniyəsi</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="request_second"
                                                                   class="form-control"
                                                                   min="5" value={{ $result['request_second']??'' }}>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Sifarişin radiusu</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="order_radius"
                                                                   class="form-control"
                                                                   min="1" max="10"
                                                                   value="{{ $result['order_radius']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">İlkin təyin olunmuş
                                                            prioritet</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="default_priority" min="0"
                                                                   class="form-control"
                                                                   value="{{ $result['default_priority']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Ön sifarişin sorğulanma
                                                            radiusu</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="future_order_radius" min="0"
                                                                   class="form-control"
                                                                   value="{{ $result['future_order_radius']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Açıq sifarişin
                                                            radiusu</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="public_order_radius" min="0"
                                                                   class="form-control"
                                                                   value="{{ $result['public_order_radius']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Offline Lokasiya</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['offline_location'] ? 'checked' : '' }}  name="offline_location"
                                                                   type="checkbox"
                                                                   class="switchery-primary3">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Açıq sifarişin qiymətini
                                                            göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['public_order_show_price'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="public_order_show_price"
                                                                   class="switchery-primary4">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Açıq sifarişin başlanğıc
                                                            nöqtəsini göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['public_order_show_orign'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="public_order_show_orign"
                                                                   class="switchery-primary5">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Açıq sifarişin təyinat
                                                            nöqtələrini göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['public_order_show_destination'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="public_order_show_destination"
                                                                   class="switchery-primary6">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Ön sifarişin başlanğıc
                                                            nöqtəsini göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['future_order_show_orign'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="future_order_show_orign"
                                                                   class="switchery-primary7">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Ön sifarişin təyinat
                                                            nöqtəsini
                                                            göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['future_order_show_destination'] ? 'checked' : '' }}  type="checkbox"
                                                                   name="future_order_show_destination"
                                                                   class="switchery-primary8">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Ön sifarişin qiymətini
                                                            göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['future_order_show_price'] ? 'checked' : '' }}  name="future_order_show_price"
                                                                   type="checkbox"
                                                                   class="switchery-primary9">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Sifarişin içində qiyməti
                                                            göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['show_price_in_order'] ? 'checked' : '' }}  name="show_price_in_order"
                                                                   type="checkbox"
                                                                   class="switchery-primary10">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Sifarişin içində gediləcək
                                                            ünvanları göstər</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['show_destination_in_order'] ? 'checked' : '' }}   name="show_destination_in_order"
                                                                   type="checkbox"
                                                                   class="switchery-primary12">
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <script type="text/javascript">
                                                    var primary = document.querySelector('.switchery-primary1');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary2');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary3');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary4');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary5');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary6');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary7');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary8');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary9');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary10');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                    var primary = document.querySelector('.switchery-primary12');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                </script>
                                            </div>

                                            <div class="tab-pane" id="tab3">
                                                <fieldset class="content-group">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Çatma vaxtı (dəq)</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="reached_time"
                                                                   class="form-control"
                                                                   min="0" value="{{ $result['reached_time']??'' }}">
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <script type="text/javascript">
                                                    var primary = document.querySelector('.switchery-primary13');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                </script>

                                            </div>

                                            <div class="tab-pane" id="tab4">
                                                <fieldset class="content-group">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Təsdiqlənmə mesajı</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <textarea name="confirm_message" class="form-control"
                                                                      rows="5"
                                                                      id="comment">{{ $result['confirm_message']??'' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Çatdım mesajı</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <textarea name="reached_message" class="form-control"
                                                                      rows="5"
                                                                      id="comment">{{ $result['reached_message']??'' }}</textarea>
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </div>

                                            {{--<div class="tab-pane" id="tab5">--}}
                                                {{--<fieldset class="content-group">--}}

                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label col-lg-2">CityGuide--}}
                                                            {{--Server????????</label>--}}
                                                        {{--<div class="col-lg-10">--}}
                                                            {{--<select name="cityguide_routing_server"--}}
                                                                    {{--class="form-control select-search">--}}
                                                                {{--<option value="cityguide1-ulduz.smarttaxi.cloud">--}}
                                                                    {{--cityguide1-ulduz.smarttaxi.cloud--}}
                                                                {{--</option>--}}
                                                                {{--<option value="cityguide2-ulduz.smarttaxi.cloud">--}}
                                                                    {{--cityguide2-ulduz.smarttaxi.cloud--}}
                                                                {{--</option>--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}

                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label col-lg-2">OpenStreetMap Tile--}}
                                                            {{--Server???????????</label>--}}
                                                        {{--<div class="col-lg-10">--}}
                                                            {{--<select name="openstreetmap_tile_server"--}}
                                                                    {{--class="form-control select-search">--}}
                                                                {{--<option value="map1-ulduz.smarttaxi.cloud">--}}
                                                                    {{--map1-ulduz.smarttaxi.cloud--}}
                                                                {{--</option>--}}
                                                                {{--<option value="map2-ulduz.smarttaxi.cloud">--}}
                                                                    {{--map2-ulduz.smarttaxi.cloud--}}
                                                                {{--</option>--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}


                                                    {{--<div class="form-group">--}}
                                                        {{--<label class="control-label col-lg-2">OpenStreetMap Routing--}}
                                                            {{--Server??????????</label>--}}
                                                        {{--<div class="col-lg-10">--}}
                                                            {{--<select name="openstreetmap_routing_server"--}}
                                                                    {{--class="form-control select-search">--}}
                                                                {{--<option value="map1-ulduz.smarttaxi.cloud:5000">--}}
                                                                    {{--map1-ulduz.smarttaxi.cloud:5000--}}
                                                                {{--</option>--}}
                                                                {{--<option value="map2-ulduz.smarttaxi.cloud:5000">--}}
                                                                    {{--map2-ulduz.smarttaxi.cloud:5000--}}
                                                                {{--</option>--}}
                                                            {{--</select>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}


                                                {{--</fieldset>--}}
                                            {{--</div>--}}

                                            <div class="tab-pane" id="tab6">
                                                <fieldset class="content-group">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Ön sifarişin sorğulanma
                                                            müddəti</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="future_order_minute"
                                                                   class="form-control" min="0"
                                                                   value={{ $result['future_order_minute']??'' }}>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Sifariş saniyəsi</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="order_minute"
                                                                   class="form-control" min="0"
                                                                   value="{{ $result['order_minute']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Dövri sifarişin sorğulanma
                                                            müddəti</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="order_loop_minute"
                                                                   class="form-control" min="0"
                                                                   value="{{ $result['order_loop_minute']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Açıq sifarişin sorğulanma
                                                            saniyəsi</label>
                                                        <div class="col-lg-10">
                                                            <input type="number" name="public_order_request_time"
                                                                   class="form-control" min="0"
                                                                   value="{{ $result['public_order_request_time']??'' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Qiymət
                                                            strategiyası</label>
                                                        <div class="col-lg-10 checkbox checkbox-switcher">
                                                            <input {{ $result['price_strategy'] ? 'checked' : '' }} type="checkbox"
                                                                   name="price_strategy"
                                                                   class="switchery-primary13">
                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <script type="text/javascript">
                                                    var primary = document.querySelector('.switchery-primary13');
                                                    var switchery = new Switchery(primary, {color: '#2196F3'});
                                                </script>

                                            </div>

                                            <div class="tab-pane" id="tab7">

                                                <fieldset class="content-group">
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Tarifləri mobil tətbiqdə
                                                            göstər</label>
                                                        <div class="col-lg-10 multi-select-full">
                                                            <select name="show_tariff[]" multiple="multiple" class="select">
                                                                <optgroup label="Tariflər">
                                                                    @foreach($tariffs as $tariff)
                                                                        <option @if(in_array($tariff->id, $result['show_tariff'] )) selected
                                                                                @endif value="{{ $tariff->id }}">{{ $tariff->name }}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="text-right save-button-parameter">
                                                <button type="submit" class="btn btn-primary">Yadda saxla <i
                                                            class="icon-arrow-right14 position-right"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection