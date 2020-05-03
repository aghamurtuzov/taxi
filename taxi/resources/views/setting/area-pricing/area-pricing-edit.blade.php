@extends('main.layout')
@section('content')


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

        .page-container {
            margin-bottom: 30px;
            padding: 20px;
        }

        .add {
            margin-right: 40px;
        }
    </style>

    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <form action="{{ route('postSettingAreaPricingEdit') }}" class="form-horizontal"
                                              autocomplete="off"
                                              name="createForm" method="post" accept-charset="utf-8" id="form-order">
                                            @csrf
                                            @if(Session::has('success-message'))
                                                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success-message') }}</p>
                                            @endif
                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <p class="alert alert-class alert-danger">{{ $error }}</p>
                                                @endforeach
                                            @endif
                                            <fieldset class="content-group">
                                                <div class="form-group">
                                                    <label>Ad</label>
                                                    <input type="text" name="name" value="{{ $result->name }}"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Qiymət</label>
                                                    <input type="number" name="amount" value="{{ $result->amount }}"
                                                           class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Qiymət statusu</label>
                                                    <select name="amount_status" class="select-search form-control">
                                                        <option>-- Seç --</option>
                                                        <option @if( $result->amount_status == 1 ) selected
                                                                @endif value="1">Artım
                                                        </option>
                                                        <option @if( $result->amount_status == 0 ) selected
                                                                @endif value="0">Endirim
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="select-search form-control">
                                                        <option>-- Seç --</option>
                                                        <option @if( $result->status == 1 ) selected @endif value="1">
                                                            Aktiv
                                                        </option>
                                                        <option @if( $result->status == 0 ) selected @endif value="0">
                                                            Deaktiv
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="latitude" value="{{ $result->latitude }}"
                                                           class="form-control">
                                                    <input type="hidden" name="longitude"
                                                           value="{{ $result->longitude }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit"
                                                            class="btn btn-success col-lg-6 add">Əlavə
                                                        et
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-primary col-lg-5 reset">Təmizlə
                                                    </button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="map" class="col-md-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script>

        var map;


        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: {lat: 40.42384837383225, lng: 49.82015718883406},
            });


            let latitude = '{{ $result->latitude }}';
            let longitude = '{{ $result->longitude }}';
            let latLng = [];

            latitude = latitude.split(',');
            longitude = longitude.split(',');

            for (i = 0; i < latitude.length; i++) {
                latLng.push({lat:parseFloat(latitude[i]),lng:parseFloat(longitude[i])});
            }

            var triangleCoords = latLng;

            // Construct the polygon.
            var bermudaTriangle = new google.maps.Polygon({
                paths: triangleCoords,
                fillColor: '#94b8b8',
                fillOpacity: 0.4,
                strokeColor: '#000',
                strokeWeight: 3,
                clickable: false,
                editable: true,
                zIndex: 1
            });
            bermudaTriangle.setMap(map);
        }


    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCZWy2YH-P1SUd4wbCz4gteGoX3aXSd1c&libraries=drawing&callback=initMap"
        async defer></script>


@endsection
