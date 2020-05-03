@extends('main.layout')
@section('content')


@section('script-app')

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

@endsection


<style>
    .search_result {
        width: 500px;
        display: block;
        position: absolute;
        z-index: 999;
        padding-left: 0;
        background: white;
        border: 1px solid #ddd;
        display: none;
    }

    .search_result li {
        list-style: none;
        padding: 10px;
    }

    .search_result li:hover {
        background-color: #f5f5f5;
    }

    .selected {
        background: #56b0ff;
    }

    .destination {
        padding: 10px 0;
        border: 1px dashed #bdb9b9;
        background: #f5f5f5;
        cursor: move;
    }
</style>

<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <fieldset class="content-group">
                                        <div class="row form-group">
                                            <label class="control-label col-md-3">Taksi Kateqoriyaları</label>
                                            <div class="col-md-9">
                                                <select name="taxi_category_id" class="select-search form-control">
                                                    <option value="0">-- Seç --</option>
                                                    @foreach($categories as $c)
                                                        <option @if(request()->input('category') == $c->id) selected
                                                                @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="control-label col-md-3">Taksi Xüsusiyyətləri</label>
                                            <div class="col-md-9">
                                                <select name="taxi_option_id" class="select-search form-control">
                                                    <option value="0">-- Seç --</option>
                                                    @foreach($options as $o)
                                                        <option @if(request()->input('option') == $o->id) selected
                                                                @endif value="{{ $o->id }}">{{ $o->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Taksi</label>
                                            <input data-map="1" data-type="1" type="text"
                                                   name="taxi"
                                                   value="{{ $taxi ? $taxi->fullNameWithCodeAndNumber() : '' }}"
                                                   class="form-control destinationIdInput"
                                                   autocomplete="off">
                                            <input type="hidden" name="taxi_id"
                                                   value="{{ $taxi ? $taxi->id : 0 }}"
                                                   class="form-control destinationIdInputHidden"
                                                   autocomplete="off" id="destination">
                                            <ul class="search_result"></ul>
                                        </div>
                                        <div class="form-group">
                                            <label>Tarix</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                <input name="date" type="text" class="form-control" id="anytime-time"
                                                       value="{{ $result->from_time??'' }}">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="panel panel-white">
                                <div class="panel-body">
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-md-7">Boş</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control taxi_free"
                                                       value=""
                                                       data-status="1" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-7">Xətdə deyil</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control taxi_not_free"
                                                       value=""
                                                       data-status="0" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-7">Sifarişi qəbul edən</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control taxi_accepted"
                                                       value=""
                                                       data-status="2" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-7">Müştəriyə çatan</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control taxi_reached"
                                                       value=""
                                                       data-status="3" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-7">Müştərini götürən</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control taxi_pickup"
                                                       value=""
                                                       data-status="3" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-7">Cəmi</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control taxi_all_taxi"
                                                       value=""
                                                       data-status="" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div id="map" class="col-md-9"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCZWy2YH-P1SUd4wbCz4gteGoX3aXSd1c&libraries=places&language=az"></script>

    <script>

        $("#anytime-time").AnyTime_picker({
            format: "%Y-%m-%d %H:%i"
        });

        $(document).ready(function () {
            initMap();
            getTaxies();
        });

        $('select[name="taxi_category_id"]').on('change', function () {
            getTaxies();
        });

        $('select[name="taxi_option_id"]').on('change', function () {
            getTaxies();
        });

        $('input[name="date"]').on('change', function () {
            getTaxies();
        });

        function getTaxies() {

            let taxi_category_id = $('select[name="taxi_category_id"] option:checked').val();
            let taxi_option_id = $('select[name="taxi_option_id"] option:checked').val();
            let taxi_id = $('input[name="taxi_id"]').val();

            if (taxi_id == "") {
                taxi_id = 0;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: "{{ route('postTaxiMap') }}",
                dataType: 'json',
                data: {
                    taxi_category_id: taxi_category_id,
                    taxi_option_id: taxi_option_id,
                    taxi_id: taxi_id
                },
                success: function (e) {
                    clearMarkers();
                    $.each(e.taxies, function (index, value) {
                        let lat = value.fake_latitude ? value.fake_latitude : value.latitude;
                        let lng = value.fake_longitude ? value.fake_longitude : value.longitude;
                        var position = new google.maps.LatLng(lat, lng);
                        createMarker(position, value);
                    });

                    $('.taxi_free').val(e.taxiInfo.taxi_free);
                    $('.taxi_not_free').val(e.taxiInfo.taxi_not_free);
                    $('.taxi_accepted').val(e.taxiInfo.taxi_accepted);
                    $('.taxi_reached').val(e.taxiInfo.taxi_reached);
                    $('.taxi_pickup').val(e.taxiInfo.taxi_pickup);
                    $('.taxi_all_taxi').val(e.taxiInfo.taxi_all_taxi);
                }
            });
        }


        function createMarker(position, taxi) {


            var infowindow = new google.maps.InfoWindow({
                content: "Tabel:" + taxi.code + " (" + taxi.phone + ")",
            });

            if (taxi.action == null || taxi.action == 0) {
                if (taxi.live == 1) imageType = 'taxi_pin_green.png';
                else imageType = 'taxi_pin_black.png';
            } else {
                switch (taxi.order_status) {
                    case 2:
                        imageType = 'taxi_pin_purple.png';//accepted
                        break;
                    case 3:
                        imageType = 'taxi_pin_blue.png';//reached
                        break;
                    case 8:
                        imageType = 'taxi_pin_cyan.png';//musteri goturulub
                        break;
                    default:
                        imageType = 'taxi_pin_green.png';//customer reached
                }
            }

            var icon_base_url = 'http://taxi.otos.ru/assets/images/taxi_codes/' + taxi.code + '_' + imageType;

            var image = {
                url: icon_base_url,
                size: new google.maps.Size(40, 40),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 40)
            };


            addMarkerWithTimeout(position, 200, image, taxi, infowindow);

        }

        var markers = [];
        var map;


        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 40.4123218, lng: 49.8614117}
            });
        }

        function addMarkerWithTimeout(position, timeout, image, taxi, infowindow) {
            window.setTimeout(function () {
                let marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP,
                    title: taxi,
                    draggable: false,
                    icon: image,
                });
                markers.push(marker);

                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
            }, timeout);


        }

        function clearMarkers() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }


    </script>


@endsection
