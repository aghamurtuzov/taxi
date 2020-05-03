@extends('main.layout')

@section('css')
    <style>
        .search_result, #search_result_taxi {
            background: #FFF;
            border: 1px #ccc solid;
            border-top: 0px;
            width: 400px;
            max-height: 581px;
            overflow-y: scroll;
            display: none;
            position: absolute;
            z-index: 999;
        }

        .search_result li, #search_result_taxi li {
            list-style: none;
            padding: 5px 10px;
            margin: 0 0 0 -25px;
            color: #0896D3;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: 0.3s;
        }

        .search_result li:hover, #search_result_taxi li:hover {
            background-color: #f5f5f5;
        }

        .selected {
            background: #f5f5f5;
        }

        .destination {
            padding: 10px 0;
            border: 1px dashed #bdb9b9;
            background: #f5f5f5;
            cursor: move;
        }

        .sweet-alert input {
            display: initial;
            width: auto;
            height: auto;
            margin: auto;
        }
    </style>

@endsection
@section('content')

    {{--    page container--}}

    <div class="page-container">
        <div class="page-content">
            <form id="form-order" action="#" class="form-horizontal"
                  method="post" accept-charset="utf-8">
                <div class="sidebar sidebar-main sidebar-default">
                    <div class="sidebar-content">

                        <div class="sidebar-category sidebar-category-visible">
                            <div class="sidebar-category">

                                <div class="category-title">
                                    <span>Tarif</span>
                                </div>

                                <div class="category-content">
                                    <div class="form-group">
                                        <select name="tariff" class="select">
                                            @foreach($tariffs as $tariff)
                                                <option
                                                    @if($result->orderDetailName->tariffName->id == $tariff->id) selected
                                                    @endif value="{{$tariff->id}}">{{$tariff->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
{{--                        <div class="sidebar-category sidebar-category-visible">--}}
{{--                            <div class="sidebar-category">--}}

{{--                                <div class="category-title">--}}
{{--                                    <span>Sifarişin növü</span>--}}
{{--                                </div>--}}

{{--                                <div class="category-content">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <select name="order_type" class="select">--}}
{{--                                            <option selected="selected" value="1">Adi</option>--}}
{{--                                            <option value="2">Vaxt</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="sidebar-category">

                                <div class="category-title">
                                    <span>Ödəmə</span>
                                </div>

                                <div class="category-content">
                                    <div class="form-group">
                                        <select name="payment_method" class="select">
                                            <option @if($result->orderDetailName->payment_method == 1) selected
                                                    @endif value="1">Nəğd
                                            </option>
                                            <option @if($result->orderDetailName->payment_method == 2) selected
                                                    @endif  value="2">Nəğdsiz
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="sidebar-category sidebar-category-visible">
                            <div class="sidebar-category">

                                <div class="category-title">
                                    <span>Xüsusiyyətlər</span>
                                </div>

                                <div class="category-content">
                                    <div class="form-group">
                                        <select name="options[]" class="select" multiple>

                                            @foreach($options as $option)
                                                <option
                                                    @if($result->optionToArray() && in_array($option->id,$result->optionToArray())) selected
                                                    @endif  value="{{$option->id}}"> {{$option->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <fieldset class="content-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label
                                                        class="control-label col-lg-1"><strong>Telefon</strong></label>
                                                    <div class="col-lg-3">
                                                        <input disabled type="text" name="customer_phone"
                                                               value="{{$result->customerName->phone}}"
                                                               id="customer_phone" class="form-control"
                                                               placeholder="994556985479" autocomplete="off"
                                                               required="required" maxlength="12" minlength="12"/>
                                                        <input disabled type="hidden" name="customer_id"
                                                               id="customer_id" class="form-control" value="22024"/>
                                                    </div>
                                                    <label class="control-label col-lg-1"><strong>Adı</strong></label>
                                                    <div class="col-lg-3">
                                                        <input disabled type="text" name="customer_name"
                                                               value="{{$result->customerName->firstname}}"
                                                               id="customer_name" class="form-control"
                                                               placeholder="Məmməd" autocomplete="new-password">
                                                    </div>
                                                    <label
                                                        class="control-label col-lg-1"><strong>Yaradılıb</strong></label>
                                                    <div class="col-lg-3">
                                                        <input type="text" value="{{$result->created_at}}"
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div id="destinations">
                                                    @foreach($result->routeNameEdit() as $route)
                                                        <div class="form-group destination">
                                                            <div class="col-lg-10 has-feedback has-feedback-left"
                                                                 @if($route["will_pay"]!=0 || $route["street"] != null) style="width: 58%" @endif>
                                                                <input x-required data-lat="{{$route["lat"]}}"
                                                                       data-lng="{{$route["lng"]}}"
                                                                       id="address-1"
                                                                       type="text" name="name"
                                                                       value="{{$route["name"]}}"
                                                                       class="address-1 form-control input-roundless addressInput"
                                                                       autocomplete="off" onclick="this.select();"
                                                                       data-destination-id="{{$route["id"]}}"
                                                                       data-type="{{$route["type"]}}"
                                                                       data-tourniquet-will-pay="{{$route["will_pay"]}}"
                                                                       data-tourniquet-type="{{$route["type"]}}"
                                                                       data-tourniquet-price="{{$route["price"]}}"
                                                                >
                                                                <input type="hidden" name="destination_id"
                                                                       value="{{$route["id"]}}"
                                                                       class="destination-id">
                                                                <input type="hidden" name="destination_type"
                                                                       value="{{$route["type"]}}"
                                                                       class="type">
                                                                <input type="hidden" name="latitude"
                                                                       value="{{$route["lat"]}}"
                                                                       class="latitude">
                                                                <input type="hidden" name="longitude"
                                                                       value="{{$route["lng"]}}"
                                                                       class="longitude">
                                                                <div class="form-control-feedback">
                                                                    <i class="icon-pin-alt"></i>
                                                                </div>
                                                                <ul class="search_result"></ul>
                                                            </div>
                                                            <div class="col-lg-3 number_street"
                                                                 @if($route["street"]==null) style="display: none" @endif>
                                                                <select name="number_street"
                                                                        class="form-control select-search">
                                                                    @if($route["street"]!=null)
                                                                        @foreach($result->addressName($route["id"]) as $street)
                                                                            <option
                                                                                @if($street->id == $route["street"]) selected
                                                                                @endif value="{{$street->id}}">{{$street->number}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select></div>
                                                            <div class="col-lg-3 object_tourniquet"
                                                                 @if(!$route["will_pay"]) style="display: none" @endif>
                                                                <div
                                                                    class="col-md-5 checkbox checkbox-switchery switchery-xs">
                                                                    <label> <input type="checkbox"
                                                                                   id="switchery_will_pay_689"
                                                                                   name="tourniquet_will_pay" value="1"
                                                                                   class="switchery-will-pay" checked=""
                                                                                   data-switchery="true"> </label>
                                                                </div>
                                                                <label class="tourniquet_price_label">Turniket
                                                                    (<span
                                                                        class="tourniquet-price-text">@if($route["will_pay"]) {{$route["price"]}}  @endif</span>)
                                                                </label>
                                                                <input type="hidden" name="tourniquet_price"
                                                                       value="@if($route["will_pay"]) {{$route["price"]}}  @endif"
                                                                       class="tourniquet_price"></div>
                                                            <div class="col-lg-2">
                                                                <button type="button"
                                                                        class="btn btn-block btn-danger deleteDestination">
                                                                    <i class="icon-trash"></i></button>
                                                                <input type="hidden" name="marker_index" value=""></div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <a id="createDestination"
                                                           class="btn btn-default btn-icon btn-block"><i
                                                                class="icon-plus3"></i> Başqa ünvan</a>
                                                        <button type="button" id="draw">Xəritədə yol</button>
                                                    </div>
                                                </div>
                                                <script> drop = dragula([document.getElementById('destinations')]);</script>

                                                <div class="form-group">
                                                    <div id="orderValue">
                                                        <label
                                                            class="control-label col-lg-2"><strong>Məsafə</strong></label>
                                                        <div class="col-lg-2">
                                                            <input type="text" name="order_value"
                                                                   value="{{$result->orderDetailName->order_value}}"
                                                                   id="new_distance" class="form-control"
                                                                   autocomplete="off" readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <label
                                                        class="control-label col-lg-2"><strong>Qiymət</strong></label>
                                                    <div class="col-lg-2">
                                                        <input type="text" name="price" required
                                                               value="{{$result->orderDetailName->price}}" id="price"
                                                               class="form-control" readonly autocomplete="off">
                                                    </div>
                                                    <label class="control-label col-lg-2"><strong>Gözləmə
                                                            Müddəti</strong></label>
                                                    <div class="col-lg-2">
                                                        <input type="text" name="timeout" required
                                                               value="{{$result->orderDetailName->timeout}}"
                                                               id="timeout" class="form-control" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class=col-lg-12>
                                                        <div class="col-lg-4">
                                                            <button id="add_new_price" class="btn btn-success"
                                                                    type="button">Qiyməti dəyiş
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input class="new_price form-control" type="text"
                                                                   name="new_price" class="form-control"
                                                                   autocomplete="off" style="display: none">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-lg-3"><strong>Vaxt</strong></label>
                                                    <div class="col-lg-2">
                                                        <div class="checkbox checkbox-switchery">
                                                            <label>
                                                                <input name="isCurrentTime" id="isCurrentTime"
                                                                       type="checkbox" class="switchery-date"
                                                                       @if($result->status == 700) checked @endif>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div id="futureOrderDate" style="display: none;" class="col-lg-7">
                                                        <div class="col-lg-6"><input type="text" name="order_date"
                                                                                     value="{{$result->orderDetailName->order_date}}"
                                                                                     placeholder="" id="order_date"
                                                                                     class="form-control"/></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2"><strong>Qeyd</strong></label>
                                                    <div class="col-lg-10">
                                                        <textarea name="description" rows="5" cols="5"
                                                                  class="form-control"
                                                                  placeholder="Qeyd ...">{{$result->orderDetailName->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3"><strong>Dispetçerə göndər</strong></label>
                                        <div class="col-lg-3">
                                            <div class="checkbox checkbox-switchery">
                                                <label>
                                                    <input type="checkbox" id="autoSearchChanger"
                                                           class="switchery-search">
                                                    <input type="hidden" name="auto_search" value="0">
                                                </label>
                                            </div>
                                        </div>
                                        <label class="control-label col-lg-3"><strong>Hərkəsə açıq</strong></label>
                                        <div class="col-lg-3">
                                            <div class="checkbox checkbox-switchery">
                                                <label>
                                                    <input @if($result->status == 600) disabled checked value="1" @else value="0" @endif type="checkbox" id="publicChanger" class="switchery-public">
                                                    <input type="hidden" name="is_public" >
                                                </label>
                                            </div>
                                        </div>
                                        <script>
                                            $('#publicChanger').on('change', function () {
                                                if ($('#publicChanger').is(':checked')) {
                                                    $('input[name="is_public"]').val('1')
                                                } else {
                                                    $('input[name="is_public"]').val('0')
                                                }
                                            });

                                            $('#autoSearchChanger').on('change', function () {
                                                if ($('#autoSearchChanger').is(':checked')) {
                                                    $('input[name="auto_search"]').val('0')
                                                } else {
                                                    $('input[name="auto_search"]').val('1')
                                                }
                                            });
                                        </script>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary col-lg-6"> Redaktə et <i
                                                class="icon-arrow-right14 position-right"></i></button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Xəritə</h5>
                                </div>
                                <div class="panel-body">
                                    <div id="map"></div>
                                </div>
                            </div>

                            <div id="taxi_panel" class="panel panel-white" style="display: block">
                                <div class="panel-heading current-taxi">
                                    <h5 class="panel-title">
                                        <br>
                                        <span class="pull-left">Taksi</span>
                                        @if(isset($result->taxiName))
                                            <span class="pull-right full_taxi_remove">{{$result->taxiName ? $result->taxiName->code .' '. $result->taxiName->firstname .' '. $result->taxiName->lastname : '' }} <span
                                                    class="remove_taxi btn btn-danger" data-toggle="modal" data-target="#myModal">X</span></span>
                                        @endif
                                        <br>
                                    </h5>
                                </div>
                                <div class="panel-body">

                                    <div id="taxiSection">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">
                                                <strong>Taksi</strong>
                                            </label>

                                            <div class="col-lg-10">
                                                <input id="taxi_input" @if(isset($result->taxiName)) readonly
                                                       @endif data-type="1" type="text"
                                                       name="taxi_name" value=""
                                                       class="form-control destinationIdInput"
                                                       autocomplete="off">
                                                <input type="hidden" name="taxi_id"
                                                       value=""
                                                       class="form-control destinationIdInputHidden"
                                                       autocomplete="off" id="destination">
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">ƏLAVƏLƏR</h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li class="active"><a href="#basic-justified-tab1" data-toggle="tab">SİFARİŞLƏRİN
                                                TARİXİ</a></li>
                                        <li><a href="#basic-justified-tab2" data-toggle="tab">ZƏNGLƏRİN TARİXİ</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="basic-justified-tab1">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tayinatı</th>
                                                    <th>Tarif/Dəyər</th>
                                                    <th>Qiymət</th>

                                                    <th>Əməliyyat</th>
                                                </tr>
                                                </thead>
                                                <tbody id="order_history_body">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="basic-justified-tab2">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Operator</th>
                                                    <th>Tarix</th>
                                                    <th>Oynat</th>
                                                </tr>
                                                </thead>
                                                <tbody id="call_history_body">
                                                <tr>
                                                    <th>Nergiz Cafarova - 1001</th>
                                                    <th>12-12-2017</th>
                                                    <th>
                                                        <button type="button" class="btn btn-primary col-lg-6"><i
                                                                class="icon-play4"></i></button>
                                                    </th>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--    page container--}}

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>{{$result->taxiName ? $result->taxiName->code : 0}} - nömrəli taksini ləğv etmək istədiyinizə əminsiniz?</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-6 text-center">
                        <h3 >Balans cərimələ: <Br>
                            <label class="switch">
                                <input name="is_balance_penalty" type="checkbox"  value="1">
                                <span class="slider round"></span>
                            </label>
                        </h3>
                    </div>
                    <div class="col-md-6 text-center">
                        <h3 >Prioritet cərimələ: <Br>
                            <label class="switch">
                                <input name="is_priority_penalty" type="checkbox"  value="1">
                                <span  class="slider round"></span>
                            </label>
                        </h3>
                    </div>



                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" id="remove_taxi" class="btn btn-success" data-dismiss="modal">Təsdiqlə</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Bağla</button>
                    </center>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('script')

    <script type="text/javascript">


        $('#findTaxiTest').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: "{{ route('postFindTaxiTest') }}",
                dataType: 'json',
                success: function (data) {
                    console.log(data.result);
                }
            });
        });


        $('body').delegate('.switchery-will-pay', "change", function () {
            if ($(this).is(':checked')) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        });

        $('select[name="tariff"]').on('change', function () {
            priceCalculate();
        });

        $('select[name="options[]"]').on('change', function () {
            priceCalculate();
        });

        $('#timeout').on('change', function () {
            priceCalculate();
        });

        $('body').delegate('.switchery-will-pay', 'change', function () {
            priceCalculate();
        });

        $('input[name="order_value"]').on('change', function () {
            priceCalculate();
        });

        $('input[name="order_date"]').on('change', function () {
            priceCalculate();
        });

        function priceCalculate() {

            tariff = $('select[name="tariff"] option:checked').val();
            orderType = $('select[name="order_type"] option:checked').val();

            var options = [];
            $('select[name="options[]"] option:checked').each(function () {
                options.push($(this).val());
            });

            timeout = $('input[name="timeout"]').val();

            km = $('input[name="order_value"]').val();

            customer_phone = $('input[name="customer_phone"]').val();

            if (!km) {
                return false;
            }

            destinations = [];
            $('.destination-id').each(function () {
                if ($(this).val() != "") destinations.push($(this).val());
            });

            tourniquetWillPays = [];
            $('.switchery-will-pay').each(function () {
                tourniquetWillPays.push($(this).val());
            });

            tourniquetPrices = [];
            $('.tourniquet_price').each(function () {
                if ($(this).val() != "") tourniquetPrices.push($(this).val());
                else tourniquetPrices.push(0);
            });

            isCurrentTime = $('input[name="isCurrentTime"]').is(':checked');

            if (!isCurrentTime) {
                date = new Date();
                orderDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes();
                orderWeekday = date.getDay();
            } else {
                orderDate = $('input[name="order_date"]').val();
                orderWeekday = (new Date(orderDate)).getDay();
            }

            if (true) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    type: 'post',
                    url: "{{ route('postOrderPriceCalculate') }}",
                    dataType: 'json',
                    data: {
                        customer_phone:customer_phone,
                        tariff: tariff,
                        orderType: orderType,
                        options: options,
                        timeout: timeout,
                        km: km,
                        destinations: destinations,
                        tourniquetWillPays: tourniquetWillPays,
                        tourniquetPrices: tourniquetPrices,
                        orderDate: orderDate,
                        orderWeekday: orderWeekday
                    },
                    success: function (data) {
                        if (data['success']) {
                            $('input[name="price"]').val(data['result']);
                        }
                    }
                });
            }
        }

        function formIsValid(form) {
            var ok = true;

            form.find('[x-required]').each(function () {
                $(this).css('border-color', '#ebedf2');

                var type = $(this).attr('type');


                if (type == 'text' || type == 'summernote' || type == 'password' || type == 'email' || type == 'date' || type == 'number' || type == 'file' || type == 'select') {
                    var value = $(this).val().trim();
                    if (!value.length) {
                        $(this).css('border-color', 'red');
                        let parent = $(this).parent();
                        parent.find('.select2-selection').css('border-color', 'red');
                        swal({
                            title: 'Bütün vacib sahələri doldurun!',
                            type: 'warning',
                            showConfirmButton: false,
                            timer: 1111
                        });

                        ok = false;
                    }
                }
            });

            return ok;
        }

        $('#form-order').on('submit', function (e) {
            e.preventDefault();

            var route = [],
                destination_id = [],
                destination_type = [],
                lat = [],
                lng = [],
                number_street = [],
                tourniquet_price = [],
                tourniquet_type = [],
                tourniquet_will_pay = [];

            $('.addressInput').each(function () {
                lat.push($(this).attr('data-lat'));
                lng.push($(this).attr('data-lng'));
                destination_id.push($(this).attr('data-destination-id'));
                destination_type.push($(this).attr('data-type'));
                tourniquet_will_pay.push($(this).attr('data-tourniquet-will-pay'));
                tourniquet_type.push($(this).attr('data-tourniquet-type'));
                tourniquet_price.push($(this).attr('data-tourniquet-price'));
                number_street.push($(this).attr('data-number-street'));
                route.push($(this).val());
            });

            var tariff = $('select[name="tariff"] option:checked').val();
            var orderType = $('select[name="order_type"] option:checked').val();
            var payment_method = $('select[name="payment_method"] option:checked').val();


            var number = $('#customer_phone').val();
            var customer_name = $('#customer_name').val();
            var description = $('[name="description"]').val();
            var price = $('#price').val();
            var taxi_id = $('input[name="taxi_id"]').val();

            if (taxi_id == undefined || taxi_id == '') {
                taxi_id = 0;
            }

            var options = [];
            $('select[name="options[]"] option:checked').each(function () {
                options.push($(this).val());
            });

            var timeout = $('input[name="timeout"]').val();

            var auto_search = $('input[name="auto_search"]').val();

            var is_public = $('input[name="is_public"]').val();

            var km = $('input[name="order_value"]').val();

            var new_price = $('input[name="new_price"]').val();

            var isCurrentTime = $('input[name="isCurrentTime"]').is(':checked');

            if (!isCurrentTime) {
                var date = new Date();
                var orderDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes();
                var orderWeekday = date.getDay();
            } else {
                var orderDate = $('input[name="order_date"]').val();
                var orderWeekday = (new Date(orderDate)).getDay();
            }

            if (!formIsValid($(this))) {
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: '{{ route('postOrderEdit',['id'=>$result->id]) }}',
                dataType: 'json',
                data: {
                    id: '{{$result->id}}',
                    operator_price: new_price,
                    lat: lat,
                    lng: lng,
                    destination_id: destination_id,
                    destination_type: destination_type,
                    tourniquet_price: tourniquet_price,
                    tourniquet_type: tourniquet_type,
                    tourniquet_will_pay: tourniquet_will_pay,
                    route: route,
                    number_street: number_street,
                    tariff: tariff,
                    orderType: orderType,
                    options: options,
                    timeout: timeout,
                    km: km,
                    description: description,
                    price: price,
                    orderDate: orderDate,
                    orderWeekday: orderWeekday,
                    number: number,
                    customer_name: customer_name,
                    payment_method: payment_method,
                    auto_search: auto_search,
                    is_public: is_public,
                    taxi_id: taxi_id
                },
                success: function (data) {
                    swal({
                        title: 'Sifariş dəyişildi!',
                        timer: 5000
                    });
                }
            });


        });

        function destinatonItemFunc(option = '', id = '', type = 1, latitude = '', longitude = '', price = 0) {

            if (type === 1) {
                nameCol = 10;
                numberStreetIsActive = 'none';
                numberStreetStr = '<option value=""></option>';
            } else {
                nameCol = 7;
                numberStreetIsActive = 'block';
                numberStreetStr = '';
            }

            switcheryRand = Math.ceil(Math.random() * 1000);

            if (price) {
                objectTourniquetIsActive = 'block';
            } else {
                objectTourniquetIsActive = 'none';
            }

            item =
                '                <div class="form-group destination">' +
                '                  <div class="col-lg-' + nameCol + ' has-feedback has-feedback-left">\n' +
                '                     <input data-lat="40.3880362" data-lng="49.838729" id="address-1" type="text" name="name" value="" class="address-1 form-control input-roundless addressInput" autocomplete="off" onclick="this.select();">' +
                '<input type="hidden" name="latitude" value="" class="latitude">' +
                '<input type="hidden" name="longitude" value="" class="longitude">' +
                '<div class="form-control-feedback">' +
                '<i class="icon-pin-alt"></i>' +
                '</div>' +
                '<ul class="search_result"></ul>' +
                '                  </div>\n' +
                '                  <div class="col-lg-3 number_street" style="display: ' + numberStreetIsActive + '">' +
                '                     <select name="number_street[]" class="form-control select-search">' +
                numberStreetStr +
                '                     </select>' +
                '                  </div>' +
                '                  <div class="col-lg-3 object_tourniquet" style="display: ' + objectTourniquetIsActive + '">' +
                '                     <div class="col-md-5 checkbox checkbox-switchery switchery-xs">\n' +
                '                         <label>' +
                '                            <input type="checkbox" id="switchery_will_pay_' + switcheryRand + '" name="tourniquet_will_pay[]" value="1" class="switchery-will-pay" checked>' +
                '                         </label>\n' +
                '                     </div>' +
                '                     <label class="tourniquet_price_label">' +
                'Turniket (' + (price / 100).toFixed(2) + ')' +
                '                     </label>\n' +
                '                     <input type="hidden" name="tourniquet_price[]" value="' + price + '" class="tourniquet_price">' +
                '                  </div>' +
                '                  <div class="col-lg-2">\n' +
                '                     <button type="button" class="btn btn-block btn-danger deleteDestination"><i class="icon-trash"></i></button>\n' +
                '                       <input type="hidden" name="marker_index[]" value="">' +
                '                  </div>' +
                '               </div>';

            $('#destinations').append(item);

            var primary = document.querySelector('#switchery_will_pay_' + switcheryRand);
            var switchery = new Switchery(primary, {color: '#2196F3'});

        }

        $('#order_date').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            locale: {
                format: 'YYYY-MM-DD H:mm'
            }
        });


        $('body').delegate('#createDestination', 'click', function () {
            destinatonItemFunc();
            var primary = document.querySelector('.switchery-will-pay');
            var switchery = new Switchery(primary, {color: '#2196F3'});
        });

        $('input[name="isCurrentTime"]').on('change', function () {
            if (!$('input[name="isCurrentTime"]').is(':checked')) {
                $('#futureOrderDate').hide();
            } else {
                $('#futureOrderDate').show();
            }

            priceCalculate();
        });
        if (!$('input[name="isCurrentTime"]').is(':checked')) {
            $('#futureOrderDate').hide();
        } else {
            $('#futureOrderDate').show();
        }


        var primary = document.querySelector('.switchery-date');
        var switchery = new Switchery(primary, {color: '#2196F3'});

        var primary = document.querySelector('.switchery-search');
        var switchery = new Switchery(primary, {color: '#2196F3'});

        var primary = document.querySelector('.switchery-public');
        var switchery = new Switchery(primary, {color: '#2196F3'});


        // $('#taxi_panel').show();


    </script>

    <script type="text/javascript">

        $(document).ready(function () {
            let text = $('.addressInput').val() ? $('.addressInput').val() : 'Hilal elektrik';
            let lat = $('.addressInput').attr('data-lat');
            let lng = $('.addressInput').attr('data-lng');

            initMap(text, lat, lng);
        });

        function initMap(text, lat, lng, parent) {
            var address = new google.maps.LatLng(lat, lng);

            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow();
            map = new google.maps.Map(
                document.getElementById('map'),
                {
                    center: address,
                    zoom: 13
                });

            var request = {
                query: text,
                fields: ['name', 'geometry'],
            };

            service = new google.maps.places.PlacesService(map);

            service.findPlaceFromQuery(request, function (results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    createMarker(results[0], parent);
                    map.setCenter(results[0].geometry.location);
                }
            });
        }

        function createMarker(place, parent) {

            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow();

            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location,
                draggable: true
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {

                $(parent).find('.lat').value = event.latLng.lat();

                $(parent).find('.lng').value = event.latLng.lng();

                $(parent).find('.addressInput').attr('data-lat', event.latLng.lat());

                $(parent).find('.addressInput').attr('data-lng', event.latLng.lng());

                var latlng = {lat: parseFloat(event.latLng.lat()), lng: parseFloat(event.latLng.lng())};
                geocoder.geocode({'location': latlng}, function (results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            var addressLocation = results[0].formatted_address;
                            $(parent).find('.addressInput').val(addressLocation);
                        } else {
                            alert('No results found');
                            return false;
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                        return false;
                    }
                });

                // $(parent).find('.addressInput').removeClass('addressInput');

            });

        }

        $(function () {
            // addressOrderSearch();
            $('.addressInput').trigger("keyup");
        });
        $('body').delegate('.addressInput', 'focusout', function () {
            $(this).parent().find(".search_result").fadeOut();
        });
        $('body').delegate('.addressInput', 'focusin', function () {
            $(this).trigger('keyup');
        });

        $('body').delegate('.deleteDestination', 'click', function () {
            $button = $(this);

            if ($('.destination').length > 1) {
                if ($button.next().val()) {
                    markers[$button.next().val()].setMap(null);
                }
                $(this).parent().parent().remove();
                addFromMark(false, false);
                if ($('select[name="order_type"] option:checked').val() == '1') distanceCalculate();
                priceCalculate();
            }

        });

        $('body').delegate('.addressInput', 'keyup', function (e) {
            e.preventDefault();

            parent = $(this).parent();

            let text = $(this).val();
            if (text.length < 4) {
                return false;
            }

            parent.find('.search_result').empty();
            parent.find('.search_result').hide();


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: '{{ route('postDestinationSearchAddress') }}',
                dataType: 'json',
                data: {
                    text: text,
                },
                success: function (data) {
                    if (data.success !== false) {
                        setTimeout(function () {
                            $.each(data.results, function (v, result) {
                                    let html = '';
                                    html += "<li onclick='parseOrderDestinationStreet(this,parent);' data-tourniquet_price=" + result.price + " data-tourniquet_type=" + result.tourniquet_type + " data-destionation_id=" + result.id + " data-type=" + result.type + "  data-lat=" + result.latitude + " data-lng=" + result.longitude + " data-id=" + result.id + ">" + result.name + "</li>";
                                    if (html != false) {
                                        parent.find('.search_result').show();
                                        parent.find('.search_result').append(html);
                                    }
                                }
                            );
                        }, 500);

                    }
                }
            });
        });

        $('#destinations .number_street').on('change', 'select', function () {

            lat = $(this).find('option:selected').attr('data-latitude');
            lng = $(this).find('option:selected').attr('data-longitude');
            //

            $(this).parent().parent().find('.addressInput').attr('data-lat', lat);
            $(this).parent().parent().find('.addressInput').attr('data-lng', lng);
            $(this).parent().parent().find('.latitude').val(lat);
            $(this).parent().parent().find('.longitude').val(lng);

        });

        function parseOrderDestinationStreet(t, parent) {
            let text = $(t).text();
            let id = $(t).attr('data-id');
            let lat = $(t).attr('data-lat');
            let lng = $(t).attr('data-lng');
            let type = $(t).attr('data-type');
            let tourniquet_type = $(t).attr('data-tourniquet_type');
            let tourniquet_price = $(t).attr('data-tourniquet_price');
            let tourniquet_will_pay = 0;

            parent.parent().find('.has-feedback-left').css('width', '83.33%');
            parent.parent().find('.number_street').hide();

            if (type == 2) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    type: 'post',
                    url: '{{ route('postDestinationSearchStreetNumber') }}',
                    dataType: 'json',
                    cache: false,
                    async: false,
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (data.success !== false) {
                            setTimeout(function () {
                                $.each(data.results, function (v, result) {
                                        let html = '';
                                        html += "<option data-id=" + result.id + " data-street=" + result.street + " data-number=" + result.number + " data-latitude=" + result.latitude + "  data-longitude=" + result.longitude + ">" + result.number + "</option>";
                                        if (html != false) {
                                            parent.parent().find('.has-feedback-left').css('width', '58%');
                                            parent.parent().find('.number_street select').append(html);
                                            parent.parent().find('.number_street').show();

                                        }
                                    }
                                );

                                parent.parent().find('.number_street select option:eq(1)').attr('selected', 'selected');

                                //get address lat,lng because not have lat and lng in street
                                lat = parent.parent().find('.number_street select option:eq(1)').attr('data-latitude');
                                lng = parent.parent().find('.number_street select option:eq(1)').attr('data-longitude');
                                //

                                $(parent).find('.addressInput').attr('data-lat', lat);
                                $(parent).find('.addressInput').attr('data-lng', lng);
                                $(parent).find('.latitude').val(lat);
                                $(parent).find('.longitude').val(lng);

                            }, 500);

                        }
                    }
                });
            }

            parent.parent().find('.object_tourniquet').hide();

            if (tourniquet_price > 0) {
                parent.parent().find('.object_tourniquet').show();
                parent.parent().find('.has-feedback-left').css('width', '58%');
                parent.parent().find('.tourniquet_price').val(tourniquet_price);
                parent.parent().find('.tourniquet-price-text').text((tourniquet_price / 100).toFixed(2));
                tourniquet_will_pay = 1;
            }

            $(parent).find('.addressInput').val(text);
            $(parent).find('.addressInput').attr('data-lat', lat);
            $(parent).find('.addressInput').attr('data-lng', lng);
            $(parent).find('.addressInput').attr('data-destination-id', id);
            $(parent).find('.addressInput').attr('data-type', type);
            $(parent).find('.addressInput').attr('data-tourniquet-will-pay', tourniquet_will_pay);
            $(parent).find('.addressInput').attr('data-tourniquet-type', tourniquet_type);
            $(parent).find('.addressInput').attr('data-tourniquet-price', tourniquet_price);

            $(parent).find('.latitude').val(lat);
            $(parent).find('.longitude').val(lng);
            $(parent).find('.destination-id').val(id);
            $(parent).find('.type').val(type);
            $(parent).find('.search_result').empty();
            $(parent).find('.search_result').hide();

            initMap(text, lat, lng, parent);

        }

        $('#draw').on('click', function (e) {
            e.preventDefault();
            let lat = [];
            let lng = [];
            var ok = true;


            $('.addressInput').each(function (index, value) {
                $(this).css('border-color', '#ddd');
                if (!value.value || value.value == "") {
                    $(this).css('border-color', 'red');
                    ok = false;
                }
                lat.push(value.getAttribute('data-lat'));
                lng.push(value.getAttribute('data-lng'));
            });

            if (!ok) {
                return false;
            }

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer({
                draggable: true,
                map: map,
                panel: document.getElementById('right-panel')
            });

            directionsRenderer.addListener('directions_changed', function () {
                computeTotalDistance(directionsRenderer.getDirections());
            });

            var address_start = new google.maps.LatLng(lat[0], lng[0]);
            var address_end = new google.maps.LatLng(lat[lat.length - 1], lng[lng.length - 1]);

            let address = [];
            for (var i = 0; i < lat.length; i++) {
                if (i != 0 && i != (lat.length - 1)) {
                    address.push({
                        location: new google.maps.LatLng(lat[i], lng[i]),
                        stopover: true
                    });
                }
            }

            var mapOptions = {
                zoom: 12,
                center: address_start,
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            directionsRenderer.setMap(map);

            var request = {
                origin: address_start,
                destination: address_end,
                waypoints: address,
                travelMode: 'DRIVING'
            };
            directionsService.route(request, function (response, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(response);
                    console.log('----' + response)
                } else {
                    alert('Could not display directions due to: ' + status);
                }
            });

            var circle = new google.maps.Circle({
                center: address_start,
                map: map,
                radius: 3000,          // IN METERS.
                fillColor: '#FF6600',
                fillOpacity: 0.3,
                strokeColor: "#FFF",
                strokeWeight: 0         // DON'T SHOW CIRCLE BORDER.
            });

        });

        function computeTotalDistance(result) {
            var total = 0;
            var myroute = result.routes[0];
            for (var i = 0; i < myroute.legs.length; i++) {
                total += myroute.legs[i].distance.value;
            }
            total = total / 1000;
            // document.getElementById('total').innerHTML = total + ' km';
            $('#new_distance').val(total);
            priceCalculate();
        }

        //////////////////////////ROUTE


    </script>


    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCZWy2YH-P1SUd4wbCz4gteGoX3aXSd1c&libraries=places&language=az"></script>

    <!-- Footer -->
    <div class="navbar navbar-default">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i
                        class="icon-circle-up2"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second">
            <div class="navbar-text">
                &copy; 2016-2019. <a href="#">Smart Taxi</a>
            </div>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="http://otos.ru/az/administrator/system_logs">System logs</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /footer -->
    <script type="text/javascript">
        $('button.btnPriceStrategy').click(function () {
            window.location.href = 'http://otos.ru/az/administrator/price_strategy_fast/create';
        });


        $("#add_new_price").click(function () {
            $(".new_price").toggle();
        });


        $('#remove_taxi').on('click', function (e) {
            e.preventDefault();
            $('input[name="is_balance_penalty"]').prop('checked',false);
            $('input[name="is_priority_penalty"]').prop('checked',false);
            $("#taxi_input").attr("readonly", false);
            var code = '{{$result->taxiName ? $result->taxiName->code : 0}}';
            var order_id = '{{$result->id}}';
            var is_balance_penalty = '';
            var is_balance_penalty = '';
            if($('input[name="is_balance_penalty"]').prop("checked") ){
                is_balance_penalty = 1;
            }
            else{
                is_balance_penalty = 0;
            }

            if($('input[name="is_priority_penalty"]').prop("checked")){
                is_priority_penalty = 1;
            }
            else{
                is_priority_penalty = 0;
            }


                $.ajax({

                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    type: 'post',
                    url: '{{ route('postOrderRemoveTaxi') }}',
                    dataType: 'json',
                    data: {
                        order_id: order_id,
                        code: code,
                        is_balance_penalty: is_balance_penalty,
                        is_priority_penalty: is_priority_penalty,
                    },

                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "Silindi",
                                type: "success",
                                confirmButtonColor: "#4CAF50"
                            });
                            $(".full_taxi_remove").hide();
                            console.log(data);
                        } else {
                            swal({
                                title: "Silə bilməzsiniz",
                                text: data['message'],
                                type: "error",
                                confirmButtonColor: "#F44336"
                            });
                        }
                    }
                });


        });




    </script>



@endsection


