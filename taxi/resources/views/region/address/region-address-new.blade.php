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
            cursor: pointer;
        }

        .search_result li:hover {
            background-color: #f5f5f5 !important;
        }

    </style>

    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Ünvan Yarat</h5>
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
                                <form action="{{ route('postRegionAddressEdit',['id' => $result->id??'0','code' => $module->code]) }}"
                                      class="form-horizontal"
                                      method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Küçə</label>
                                            <div class="col-lg-10">
                                                <input data-lat="{{ $result->latitude??'40.3880362' }}"
                                                       data-lng="{{ $result->longitude??'49.838729' }}"
                                                       id="street"
                                                       type="text" name="street_name"
                                                       value="{{ $result->streetName->name??'' }}"
                                                       class="form-control destinationIdInput"
                                                       autocomplete="off">
                                                <input type="hidden" name="street" value="{{ $result->street??'' }}"
                                                       class="form-control destinationIdInputHidden"
                                                       autocomplete="off" id="destination">
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Rayon</label>
                                            <div class="col-lg-10">
                                                <select name="district" class="form-control">
                                                    <option selected value="0">Boş</option>
                                                    @foreach($districts as $district)
                                                        <option @if($result->district??'' == $district->id) selected
                                                                @endif value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Nömrə</label>
                                            <div class="col-lg-10">
                                                <input name="number" type="text" class="form-control"
                                                       value="{{ $result->number??'' }}"
                                                       placeholder="Nömrə">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Prioritet</label>
                                            <div class="col-lg-10">
                                                <input name="priority" type="text" class="form-control"
                                                       value="{{ $result->priority??'' }}"
                                                       placeholder="Prioritet">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">En</label>
                                            <div class="col-lg-10">
                                                <input id="lat" name="latitude" type="text" class="form-control"
                                                       value="{{ $result->latitude??'' }}"
                                                       placeholder="En">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Uzunluğ</label>
                                            <div class="col-lg-10">
                                                <input id="lng" name="longitude" type="text" class="form-control"
                                                       value="{{ $result->longitude??'' }}"
                                                       placeholder="Uzunluğ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Sıralama</label>
                                            <div class="col-lg-10">
                                                <input name="sort" type="text" class="form-control"
                                                       value="{{ $result->sort??'' }}"
                                                       placeholder="Sıralama">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Status</label>
                                            <div class="col-lg-10">
                                                <select name="status" class="form-control">
                                                    <option @if(isset($result->status) && $result->status??'') selected
                                                            @endif value="1">Aktiv
                                                    </option>
                                                    <option @if(isset($result->status) && !$result->status??'') selected
                                                            @endif value="0">Deaktiv
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Yarat <i
                                                    class="icon-arrow-right14 position-right"></i></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>


        @endsection


        @section('script')

            <script>
                $(document).ready(function () {
                    let text = $('#street').val() ? $('#street').val() : 'Hilal elektrik';
                    let lat = $('#street').attr('data-lat');
                    let lng = $('#street').attr('data-lng');

                    initMap(text, lat, lng);
                });
            </script>
            <script>


                $('.destinationIdInput').on('keyup', function (e) {
                    e.preventDefault();

                    let text = $(this).val();

                    $('.search_result').empty();
                    $('.search_result').hide();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        type: 'post',
                        url: '{{ route('postDestinationSearchStreet') }}',
                        dataType: 'json',
                        data: {
                            text: text,
                        },
                        success: function (data) {
                            if (data.success !== false) {

                                $.each(data.results, function (v, result) {
                                        let html = '';
                                        html += "<li onclick='parseDestionation(this);' data-lat=" + result.latitude + "  data-lng=" + result.longitude + " data-id=" + result.id + ">" + result.name + "</li>";
                                        if (html != false) {
                                            $('.search_result').show();
                                            $('.search_result').append(html);
                                        }
                                    }
                                );
                            }
                        }
                    });


                })


            </script>

            <script type="text/javascript"
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCZWy2YH-P1SUd4wbCz4gteGoX3aXSd1c&libraries=places"></script>

            <script type="text/javascript">

                function parseDestionationStreet(t) {
                    let text = $(t).text();
                    let id = $(t).attr('data-id');

                    $('.destinationIdInput').val(text);
                    $('.search_result').empty();
                    $('.search_result').hide();
                    $('.destinationIdInputHidden').val(id);

                }


                function initMap(text, lat, lng) {
                    var sydney = new google.maps.LatLng(lat, lng);

                    infowindow = new google.maps.InfoWindow();

                    map = new google.maps.Map(
                        document.getElementById('map'), {center: sydney, zoom: 15});

                    var request = {
                        query: text,
                        fields: ['name', 'geometry'],
                    };

                    service = new google.maps.places.PlacesService(map);

                    service.findPlaceFromQuery(request, function (results, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {

                            for (var i = 0; i < results.length; i++) {
                                createMarker(results[i]);
                            }

                            map.setCenter(results[0].geometry.location);
                        }
                    });
                }

                function createMarker(place) {
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

                        document.getElementById("lat").value = event.latLng.lat();

                        document.getElementById("lng").value = event.latLng.lng();

                    });

                }

            </script>


@endsection
