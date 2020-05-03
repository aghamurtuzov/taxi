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
            background-color: #f5f5f5;
        }

    </style>

    <style>
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }
        #right-panel {
            margin: 20px;
            border-width: 2px;
            width: 20%;
            height: 400px;
            float: left;
            text-align: left;
            padding-top: 0;
        }
        #directions-panel {
            margin-top: 10px;
            background-color: #FFEE77;
            padding: 10px;
            overflow: scroll;
            height: 174px;
        }
    </style>



    <div class="page-container">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <label class="control-label col-lg-2">Ünvan A</label>
                        <input data-lat="40.3880362"
                               data-lng="49.838729"
                               id="address-1"
                               type="text" name="name"
                               value=""
                               class="address-1 form-control input-roundless addressInput"
                               autocomplete="off" onclick="this.select();">
                        <input type="hidden" name="latitude" value="" class="latitude">
                        <input type="hidden" name="longitude" value="" class="longitude">
                        <div class="form-control-feedback">
                            <i class="icon-pin-alt"></i>
                        </div>
                        <ul class="search_result"></ul>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <label class="control-label col-lg-2">Ünvan B</label>
                    <div class="col-lg-10">
                        <input data-lat="40.3880362"
                               data-lng="49.838729"
                               id="address-2"
                               type="text" name="name"
                               value=""
                               class="address-2 form-control input-roundless addressInput"
                               autocomplete="off" onclick="this.select();">
                        <input type="hidden" name="latitude" value="" class="lat">
                        <input type="hidden" name="longitude" value="" class="lng">
                        <div class="form-control-feedback">
                            <i class="icon-pin-alt"></i>
                        </div>
                        <ul class="search_result"></ul>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <label class="control-label col-lg-2">Ünvan C</label>
                    <div class="col-lg-10">
                        <input data-lat="40.3880362"
                               data-lng="49.838729"
                               id="address-2"
                               type="text" name="name"
                               value=""
                               class="address-3 form-control input-roundless addressInput"
                               autocomplete="off" onclick="this.select();">
                        <input type="hidden" name="latitude" value="" class="lat">
                        <input type="hidden" name="longitude" value="" class="lng">
                        <div class="form-control-feedback">
                            <i class="icon-pin-alt"></i>
                        </div>
                        <ul class="search_result"></ul>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 20px;">
                <div class="row">
                    <button id="cek">Cek</button>
                </div>
            </div>
            <div class="container" style="margin-top: 20px;">
                <div class="row">
                    <div id="map"></div>
                </div>
            </div>
            <div class="container" style="margin-top: 20px;">
                <div class="row">
                    <div id="right-panel">
                        <p>Total Distance: <span id="total"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCZWy2YH-P1SUd4wbCz4gteGoX3aXSd1c&libraries=places"></script>



    {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCZWy2YH-P1SUd4wbCz4gteGoX3aXSd1c"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/pages/jquery.googlemap.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            let text = $('.addressInput').val() ? $('.addressInput').val() : 'Hilal elektrik';
            let lat = $('.addressInput').attr('data-lat');
            let lng = $('.addressInput').attr('data-lng');

            initMap(text, lat, lng);
        });

        function initMap(text, lat, lng, parent) {
            var address = new google.maps.LatLng(lat, lng);

            infowindow = new google.maps.InfoWindow();

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

                    for (var i = 0; i < results.length; i++) {
                        createMarker(results[i], parent);
                    }

                    map.setCenter(results[0].geometry.location);
                }
            });
        }

        function createMarker(place, parent) {
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

        // function addressOrderSearch() {
            $('.addressInput').on('keyup', function (e) {
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
                                        html += "<li onclick='parseOrderDestinationStreet(this,parent);' data-type=" + result.type + "  data-lat=" + result.latitude + " data-lng=" + result.longitude + " data-id=" + result.id + ">" + result.name + "</li>";
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
        // }

        function parseOrderDestinationStreet(t, parent) {
            let text = $(t).text();
            let id = $(t).attr('data-id');
            let lat = $(t).attr('data-lat');
            let lng = $(t).attr('data-lng');


            $(parent).find('.addressInput').val(text);
            $(parent).find('.addressInput').attr('data-lat', lat);
            $(parent).find('.addressInput').attr('data-lng', lng);
            $(parent).find('.latitude').val(lat);
            $(parent).find('.longitude').val(lng);
            $(parent).find('.search_result').empty();
            $(parent).find('.search_result').hide();

            initMap(text, lat, lng, parent);

        }

        $('#cek').on('click', function (e) {
            e.preventDefault();
            let lat = [];
            let lng = [];

            $('.addressInput').each(function (index, value) {
                lat.push(value.getAttribute('data-lat'));
                lng.push(value.getAttribute('data-lng'));
            });


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
                } else {
                    alert('Could not display directions due to: ' + status);
                }
            });

        });


        function computeTotalDistance(result) {
            var total = 0;
            var myroute = result.routes[0];
            for (var i = 0; i < myroute.legs.length; i++) {
                total += myroute.legs[i].distance.value;
            }
            total = total / 1000;
            document.getElementById('total').innerHTML = total + ' km';
        }

        //////////////////////////ROUTE


    </script>





@endsection
