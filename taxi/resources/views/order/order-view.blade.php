@extends('main.layout')
@section('content')

    <!-- /page container -->
    <div class="page-container" style="min-height:68.32638549804688px">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default sidebar-separate" style="width: 280px;">
                <div class="sidebar-content">

                    <!-- User details -->
                    <div class="content-group">
                        <div class="panel-body bg-indigo-400 border-radius-top text-center"
                             style="background-image: url(http://otos.ru/assets/images/bg.png); background-size: contain;">
                            <div class="content-group-sm">
                                <h6 class="text-semibold no-margin-bottom">#{{ $id??'' }}</h6>
                            </div>

                        </div>

                        <div class="panel no-border-top no-border-radius-top">
                            <ul class="navigation">
{{--                                <li class="active"><a href="#order_all" data-toggle="tab"><i--}}
{{--                                            class="icon-files-empty"></i>Bütün</a></li>--}}
{{--                                <li><a href="#order" data-toggle="tab"><i class="icon-files-empty"></i>Məlumatlar</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="#order_detail" data-toggle="tab"><i class="icon-cart "></i> Sifariş--}}
{{--                                        dəyişiklikləri</a></li>--}}
{{--                                <li><a href="#order_status_history" data-toggle="tab"><i class="icon-coin-dollar"></i>--}}
{{--                                        Status dəyişiklikləri</a></li>--}}
{{--                                <li><a href="#xref_taxi_order" data-toggle="tab"><i class="icon-car2"></i> Taxi &amp;--}}
{{--                                        Sifariş münasibəti</a></li>--}}
{{--                                <li><a href="#cancel_order_request" data-toggle="tab"><i class="icon-alarm-cancel"></i>--}}
{{--                                        Ləğv etmə sorğuları</a></li>--}}
{{--                                <li><a href="#order_request" data-toggle="tab"><i class="icon-files-empty"></i> Sorğular</a>--}}
{{--                                </li>--}}
{{--                                <li><a href="#transaction" data-toggle="tab"><i class="icon-files-empty"></i> Pul--}}
{{--                                        əməliyyatları</a></li>--}}
{{--                                <li><a href="#priority_transaction" data-toggle="tab"><i class="icon-files-empty"></i>--}}
{{--                                        Prioritet əməliyyatları <span--}}
{{--                                            class="badge badge-danger pull-right">390</span></a></li>--}}
{{--                                <li><a href="#call" data-toggle="tab"><i class="icon-phone"></i> Zəng</a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <!-- /user details -->
                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Tab content -->
                <div class="tab-content">

                    <div class="tab-pane fade in active" id="order_all">

                        <!-- Available hours -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sifariş dəyişiklikləri<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Taxi</a></th>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Status</a></th>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Operator</a></th>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Tarix</a></th>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Müştəri</a></th>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Tarif</a></th>
                                            <th style="border: 1px solid #828282;">Timer</th>
                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    Mənbəyi</a></th>

                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    <i class="icon-coin-dollar"></i></a></th>

                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"> Ünvan
                                                    A</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"> Ünvan
                                                    Z</a></th>

                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    <i class="icon-road"></i></a></th>

                                            <th style="border: 1px solid #828282;"><a
                                                    href=""><i></i>
                                                    <i class="icon-hour-glass"></i></a></th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($results as $result)
                                            <tr>
                                                <td>{{$result->fullTaxiNameWithCodeAndNumber() }}</td>
                                                <td>{{$result->reason}}</td>
                                                <td>{{$result->fullUserName()}}</td>
                                                <td>{{$result->date}}</td>
                                                @if($result->status == 0 || $result->status == 15)
                                                    @php $detail = $result->status == 0 ? 'orderDetailNameFirst' : 'orderDetailName';  @endphp
                                                    <td>{!! $result->orderName->fullCustomerNameWithNumber() !!}</td>
                                                    <td>{{$result->orderName->$detail ? ($result->orderName->$detail->tariff ? $result->orderName->$detail->tariffName->name : '') : ''}}</td>
                                                    <td>-</td>
                                                    <td>{!!  $result->source ? '<i
                                                             class="icon-phone"></i>' : '<i
                                                             class="icon-mobile"></i>' !!}</td>
                                                    <td>{{$result->orderName->$detail->price}} AZN</td>
                                                    <td>{{$result->orderName->$detail->routeName()[0]}}</td>
                                                    <td>{{$result->orderName->$detail->routeName()[$result->orderName->$detail->routeName()['last']]}}</td>
                                                    <td>{{$result->orderName->$detail->order_value}}</td>
                                                    <td>{{$result->orderName->$detail->timeout}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    {{--                    <div class="tab-pane fade" id="order">--}}
                    {{--                        <!-- Profile info -->--}}
                    {{--                        <div class="panel panel-flat">--}}
                    {{--                            <div class="panel-heading">--}}
                    {{--                                <h6 class="panel-title">Info<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>--}}
                    {{--                                <div class="heading-elements">--}}
                    {{--                                    <ul class="icons-list">--}}
                    {{--                                        <li> <span class="label" style="background: #F44336">Ləğv edildi</span></li>--}}
                    {{--                                        <li><a href="http://otos.ru/az/administrator/order/update/1052485"><i class="icon-pencil7 position-left"></i></a></li>--}}
                    {{--                                    </ul>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                            <div class="panel-body">--}}
                    {{--                                <div class="form-group">--}}
                    {{--                                    <div class="row">--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Müştəri</label>--}}
                    {{--                                            <input type="text" value="{{$result->fullCustomerNameWithNumber()}}  " readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Taxi</label>--}}
                    {{--                                            <input type="text" value="{{$result->taxiName ? $result->fullTaxiNameWithCodeAndNumber() : 'Taksi təyin olunmayıb'}}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Operator</label>--}}
                    {{--                                            <input type="text" value="{{$result->orderDetailName->userName->first_name . ' ' . $result->orderDetailName->userName->last_name}}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}

                    {{--                                <div class="form-group">--}}
                    {{--                                    <div class="row">--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Qiymət</label>--}}
                    {{--                                            <input type="text" value="{{$result->orderDetailName->price}} AZN" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Sifarişin dəyəri</label>--}}
                    {{--                                            <input type="text" value="{{$result->orderDetailName->order_value}} km" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Gözləmə müddəti</label>--}}
                    {{--                                            <input type="text" value="{{$result->orderDetailName->timeout}}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}

                    {{--                                <div class="form-group">--}}
                    {{--                                    <div class="row">--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Tarif</label>--}}
                    {{--                                            <input type="text" value="{{$result->orderDetailName ? ($result->orderDetailName->tariff ? $result->orderDetailName->tariffName->name : '') : ''}}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Yaradılma tarixi</label>--}}
                    {{--                                            <input type="text" value="{{$result->created_at}}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Sifariş tarixi</label>--}}
                    {{--                                            <input type="text" value="{{$result->orderDetailName ? ($result->orderDetailName->order_date ? $result->orderDetailName->order_date: '') : ''}}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}

                    {{--                                <div class="form-group">--}}
                    {{--                                    <div class="row">--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Ödəmə</label>--}}
                    {{--                                            <input type="text" value="@if($result->orderDetailName->payment_method == 1) Nəğd @else Nəğdsiz   @endif" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Aqreqatlar</label>--}}
                    {{--                                            <input type="text" value="{!! $result->optionName() ? $result->optionName() : 'aa' !!}" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="col-md-4">--}}
                    {{--                                            <label>Mənbəyi</label>--}}
                    {{--                                            <input type="text" value="Zəng" readonly="" class="form-control">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <!-- /profile info -->--}}

                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-md-4">--}}
                    {{--                                <div class="panel panel-body border-top-info">--}}
                    {{--                                    <div class="text-center">--}}
                    {{--                                        <h6 class="no-margin text-semibold">Sifariş ünvanları</h6>--}}
                    {{--                                        <p class="content-group-sm text-muted">Gediləcək ünvanların siyahısı</p>--}}
                    {{--                                    </div>--}}

                    {{--                                    <div class="well">--}}
                    {{--                                        <ul class="list no-margin-bottom">--}}

                    {{--                                            @foreach($result->routeName() as $route)--}}
                    {{--                                            <li>{{$route->name}}</li>--}}
                    {{--                                            @endforeach--}}
                    {{--                                        </ul>--}}
                    {{--                                    </div>--}}
                    {{--                                    <br>--}}
                    {{--                                </div>--}}


                    {{--                            </div>--}}

                    {{--                            <div class="col-md-8">--}}
                    {{--                                <div class="panel panel-body border-top-info">--}}
                    {{--                                    <div id="map" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="position: relative;"><div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, -121px, 0px);"><div class="leaflet-pane leaflet-tile-pane"><div class="leaflet-layer " style="z-index: 1; opacity: 1;"><div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20922/12356.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(109px, 89px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20923/12356.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(365px, 89px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20922/12355.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(109px, -167px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20923/12355.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(365px, -167px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20922/12357.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(109px, 345px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20923/12357.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(365px, 345px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20921/12356.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(-147px, 89px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20924/12356.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(621px, 89px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20921/12355.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(-147px, -167px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20924/12355.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(621px, -167px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20921/12357.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(-147px, 345px, 0px); opacity: 1;"><img alt="" role="presentation" src="http://130.0.10.38:9080/hot/15/20924/12357.png" class="leaflet-tile" style="width: 256px; height: 256px; transform: translate3d(621px, 345px, 0px); opacity: 1;"></div></div></div><div class="leaflet-pane leaflet-shadow-pane"><img src="http://otos.ru/assets/leaflet/images/marker-shadow.png" class="leaflet-marker-shadow leaflet-zoom-animated" alt="" style="margin-left: -12px; margin-top: -41px; width: 41px; height: 41px; transform: translate3d(-349px, 1340px, 0px);"><img src="http://otos.ru/assets/leaflet/images/marker-shadow.png" class="leaflet-marker-shadow leaflet-zoom-animated" alt="" style="margin-left: -12px; margin-top: -41px; width: 41px; height: 41px; transform: translate3d(-562px, 1010px, 0px);"></div><div class="leaflet-pane leaflet-overlay-pane"></div><div class="leaflet-pane leaflet-marker-pane"><img src="http://otos.ru/assets/leaflet/images/marker-icon.png" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -12px; margin-top: -41px; width: 25px; height: 41px; transform: translate3d(-349px, 1340px, 0px); z-index: 1340;"><img src="http://otos.ru/assets/leaflet/images/marker-icon.png" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -12px; margin-top: -41px; width: 25px; height: 41px; transform: translate3d(-562px, 1010px, 0px); z-index: 1010;"></div><div class="leaflet-pane leaflet-tooltip-pane"></div><div class="leaflet-pane leaflet-popup-pane"></div><div class="leaflet-proxy leaflet-zoom-animated" style="transform: translate3d(5.35629e+06px, 3.16327e+06px, 0px) scale(16384);"></div></div><div class="leaflet-control-container"><div class="leaflet-top leaflet-left"><div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out">−</a></div></div><div class="leaflet-top leaflet-right"><div class="leaflet-routing-container leaflet-bar leaflet-control"><div class="leaflet-routing-alternatives-container"></div></div></div><div class="leaflet-bottom leaflet-left"></div><div class="leaflet-bottom leaflet-right"><div class="leaflet-control-attribution leaflet-control"><a href="http://ulduztaxi.az">ULDUZ TAXI *5000</a>, Software <a href="http://smarttaxi.cloud">SmartTaxi</a>, </div></div></div></div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}

                    {{--                        </div>--}}




                    {{--                    </div>--}}

                    <div class="tab-pane fade" id="order_detail">

                        <!-- Available hours -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sifariş dəyişiklikləri<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>Tarif</span></th>
                                            <th><span>Mənbəyi</span></th>
                                            <th><span>Operator</span></th>
                                            <th><span>Qiymət</span></th>
                                            <th><span>Ödəmə</span></th>
                                            <th><span>Sifarişin dəyəri</span></th>
                                            <th><span>Gözləmə müddəti</span></th>
                                            <th><span>Sifariş tarixi</span></th>
                                            <th><span>Redaktə tarixi</span></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        {{--                                        @foreach($order_changes as $och)--}}
                                        {{--                                        <tr>--}}
                                        {{--                                            <td>{{$result->orderDetailName ? ($result->orderDetailName->tariff ? $result->orderDetailName->tariffName->name : '') : ''}}</td>--}}
                                        {{--                                            <td>Zəng</td>--}}
                                        {{--                                            <td>{{$result->orderDetailName->userName->first_name . ' ' . $result->orderDetailName->userName->last_name}}</td>--}}
                                        {{--                                            <td>{{$result->orderDetailName->price}} AZN</td>--}}
                                        {{--                                            <td>{{$result->orderDetailName ? ($result->orderDetailName->order_date ? $result->orderDetailName->order_date: '') : ''}}</td>--}}
                                        {{--                                            <td>{{$result->orderDetailName->order_value}} km</td>--}}
                                        {{--                                            <td>{{$result->orderDetailName->timeout}}</td>--}}
                                        {{--                                            <td>{{$result->created_at}}</td>--}}
                                        {{--                                            <td>@if($result->orderDetailName->payment_method == 1) Nəğd @else Nəğdsiz   @endif</td>--}}
                                        {{--                                        </tr>--}}
                                        {{--                                        <tr>--}}
                                        {{--                                            <td colspan="9">--}}
                                        {{--                                                <div class="row">--}}
                                        {{--                                                    <div class="col-lg-6">--}}
                                        {{--                                                        <div class="well">--}}
                                        {{--                                                            <div class="text-center">--}}
                                        {{--                                                                <h6 class="no-margin text-semibold">Sifariş ünvanları</h6>--}}
                                        {{--                                                                <p class="content-group-sm text-muted">Gediləcək ünvanların siyahısı</p>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                            <ul class="list no-margin-bottom">--}}
                                        {{--                                                                @foreach($result->routeName() as $route)--}}
                                        {{--                                                                    <li>{{$route->name}}</li>--}}
                                        {{--                                                                @endforeach--}}
                                        {{--                                                            </ul>--}}
                                        {{--                                                        </div>--}}


                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-lg-6">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </td>--}}
                                        {{--                                        </tr>--}}
                                        {{--                                            @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="order_status_history">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Status dəyişiklikləri<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>Taxi</span></th>
                                            <th><span>İstifadəçi</span></th>
                                            <th><span>Status</span></th>
                                            <th><span>Səbəb</span></th>
                                            <th><span>Tarix</span></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--                                        @foreach($result->statusChanges as $status)--}}
                                        {{--                                        <tr>--}}
                                        {{--                                            <td><a href="http://otos.ru/az/administrator/taxi/profile/0"></a></td>--}}
                                        {{--                                            <td>{{$status->fullUserName()}}</td>--}}
                                        {{--                                            <td><span class="label" style="background: #F44336">{{$status->statusName()}}</span>--}}
                                        {{--                                            </td>--}}
                                        {{--                                            <td>{{$status->reason}}</td>--}}
                                        {{--                                            <td>{{$status->date}}</td>--}}
                                        {{--                                        </tr>--}}
                                        {{--                                        @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="xref_taxi_order">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Taxi &amp; Sifariş münasibəti<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>Taxi</span></th>
                                            <th><span>Status</span></th>
                                            <th><span>Sifarişin növü</span></th>
                                            <th><span>Səbəb</span></th>
                                            <th><span>Tarix</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="http://otos.ru/az/administrator/taxi/profile/762 - Elsad Meherlemov">762
                                                    - Elsad Meherlemov</a></td>
                                            <td><span class="label" style="background: #F44336">İmtina</span></td>
                                            <td>Sekine Haciyeva</td>
                                            <td></td>
                                            <td>2018-02-21 18:57:16</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="cancel_order_request">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sifarişin ləğv etmə sorğuları<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="transaction">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Pul əməliyyatları<a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="order_request">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Zəng<a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                </h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Taxi</th>
                                            <th>Prioritet</th>
                                            <th>Balans</th>
                                            <th>Status</th>
                                            <th>Məsafə</th>
                                        </tr>
                                        </thead>
                                        <tbody id="order_request_table">
                                        <tr>
                                            <td>762 - Elsad Meherlemov</td>
                                            <td>100</td>
                                            <td>6.58</td>
                                            <td><span class="label label-default">Offline</span><br>2018-02-22 20:10:35
                                            </td>
                                            <td>3.93</td>
                                        </tr>
                                        <tr>
                                            <td>55519 - Samir Ekber</td>
                                            <td>100</td>
                                            <td>0.08</td>
                                            <td><span class="label label-default">Offline</span><br>2018-02-22 10:52:25
                                            </td>
                                            <td>5.05</td>
                                        </tr>
                                        <tr>
                                            <td>445 - Elnur Ebilov</td>
                                            <td>100</td>
                                            <td>4.07</td>
                                            <td><span class="label label-success">Online</span><br>2018-02-22 20:12:11
                                            </td>
                                            <td>3.95</td>
                                        </tr>
                                        <tr>
                                            <td>445 - Elnur Ebilov</td>
                                            <td>100</td>
                                            <td>4.07</td>
                                            <td><span class="label label-success">Online</span><br>2018-02-22 20:12:11
                                            </td>
                                            <td>3.95</td>
                                        </tr>
                                        <tr>
                                            <td>1724 - Rovsen Kazimov</td>
                                            <td>100</td>
                                            <td>10.26</td>
                                            <td><span class="label label-default">Offline</span><br>2018-02-22 17:10:33
                                            </td>
                                            <td>3.51</td>
                                        </tr>
                                        <tr>
                                            <td>1724 - Rovsen Kazimov</td>
                                            <td>100</td>
                                            <td>10.26</td>
                                            <td><span class="label label-default">Offline</span><br>2018-02-22 17:10:33
                                            </td>
                                            <td>3.51</td>
                                        </tr>
                                        <tr>
                                            <td>1724 - Rovsen Kazimov</td>
                                            <td>100</td>
                                            <td>10.26</td>
                                            <td><span class="label label-default">Offline</span><br>2018-02-22 17:10:33
                                            </td>
                                            <td>3.51</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="call">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Zəng<a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                </h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <div>

                                        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

                                            <h4>A PHP Error was encountered</h4>

                                            <p>Severity: Notice</p>
                                            <p>Message: Undefined variable: calls</p>
                                            <p>Filename: order/view_view.php</p>
                                            <p>Line Number: 474</p>


                                            <p>Backtrace:</p>


                                            <p style="margin-left:10px">
                                                File:
                                                /home/otosru/public_html/application/views/administrator/order/view_view.php<br>
                                                Line: 474<br>
                                                Function: _error_handler </p>


                                            <p style="margin-left:10px">
                                                File: /home/otosru/public_html/application/core/MY_Controller.php<br>
                                                Line: 76<br>
                                                Function: view </p>


                                            <p style="margin-left:10px">
                                                File:
                                                /home/otosru/public_html/application/core/Administrator_Controller.php<br>
                                                Line: 23<br>
                                                Function: render </p>


                                            <p style="margin-left:10px">
                                                File:
                                                /home/otosru/public_html/application/controllers/administrator/Order.php<br>
                                                Line: 1725<br>
                                                Function: render </p>


                                            <p style="margin-left:10px">
                                                File: /home/otosru/public_html/index.php<br>
                                                Line: 315<br>
                                                Function: require_once </p>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>
                </div>
                <!-- /tab content -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

@endsection


@section('script')



@endsection
