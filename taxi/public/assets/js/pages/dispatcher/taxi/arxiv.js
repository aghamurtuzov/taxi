//Date format
$('input[name="date"]').daterangepicker({
    showDropdowns: true,
    singleDatePicker: true,
    applyClass: 'bg-slate-600',
    cancelClass: 'btn-default',
    locale: {
        format: 'YYYY-MM-DD'
    },
    minYear: '1900',
});

// Time format
$("#ion-moment-time").ionRangeSlider({
    grid: true,
    min: (new Date((new Date()).getFullYear(), (new Date()).getMonth(), (new Date()).getDate(), 0, 0, 0).getTime()/1000),
    max: (new Date((new Date()).getFullYear(), (new Date()).getMonth(), (new Date()).getDate(), 23, 59, 59).getTime()/1000),
    from: (new Date()).getTime()/1000,
    force_edges: true,
    prettify: function (num) {
        var timestamp = num*1000;
        return "0".repeat(2-((new Date(timestamp)).getHours()).toString().length)+(new Date(timestamp)).getHours()+":"+"0".repeat(2-((new Date(timestamp)).getMinutes()).toString().length)+(new Date(timestamp)).getMinutes();
    },
    onFinish : function(data){
        var timestamp = data.from*1000;
        time = "0".repeat(2-((new Date(timestamp)).getHours()).toString().length)+(new Date(timestamp)).getHours()+":"+"0".repeat(2-((new Date(timestamp)).getMinutes()).toString().length)+(new Date(timestamp)).getMinutes();

        doAjaxRequest = true;
        if(doAjaxRequest) {
            ajaxRequest();
        }
    }
});

$('input[name="date"]').on('change', function(){
    date = $('input[name="date"]').val();

    doAjaxRequest = true;
    if(doAjaxRequest) {
        ajaxRequest();
    }
})

$('select[name="taxi_category"]').on('change', function(){
    taxi_category = $('select[name="taxi_category"] option:selected').val();

    doAjaxRequest = true;
    if(doAjaxRequest) {
        ajaxRequest();
    }
})

//
/*
*
*
*
*
 */
var doAjaxRequest = true;

var date = $('input[name="date"]').val();
var time = "0".repeat(2-((new Date($('input[name="time"]').val()*1000)).getHours()).toString().length)+(new Date($('input[name="time"]').val()*1000)).getHours()+":"+"0".repeat(2-((new Date($('input[name="time"]').val()*1000)).getMinutes()).toString().length)+(new Date($('input[name="time"]').val()*1000)).getMinutes();
var taxi_category = $('select[name="taxi_category"] option:selected').val();

slider = $("#ion-moment-time").data("ionRangeSlider");

var tmpCode = null;
$('body').delegate('input[name="code"]', "keyup", function(){
    if(doAjaxRequest) ajaxRequest();
    else tmpCode = $(this).val();
});

var taxi_status = "";

$('body').delegate('.taxi_free, .taxi_not_free, .taxi_accepeted, .taxi_reached, .taxi_customer_reached, .taxi_all_taxi', 'click', function(){
    taxi_status = $(this).data('status');
    $('.taxi_free, .taxi_not_free, .taxi_accepeted, .taxi_reached, .taxi_customer_reached, .taxi_all_taxi').css('border', '1px solid #ddd');
    $(this).css('border', '1px solid brown');
    if(doAjaxRequest) ajaxRequest();
})

function ajaxRequest(){

    taxi_category = $('select[name="taxi_category"] option:selected').val();
    code = $('input[name="code"]').val();

    if(tmpCode!=null) {
        code = tmpCode;
        tmpCode = null;
    }

    $.ajax({
        url: baseUrl+"/api/track/map",
        method: 'get',
        data: {
            datetime : date+" "+time,
            taxi_category : taxi_category,
            code : code,
            taxi_status : taxi_status
        },
        dataType: 'json',
        success: function(data) {
            if (tmpCode != null) {
                ajaxRequest();
            }
            else{

                removeMarkers();

                if (data['success']) {

                    var accepeted = 0;
                    var reached = 0;
                    var customer_reached = 0;
                    var free = 0;
                    var not_free = 0;

                    var json_length = data['taxies'].length;
                    for (i = 0; i < json_length; i++) {
                        addMarkers(data['taxies'][i]);
                        if (data['taxies'][i]['order_status'] != null) {
                            switch (data['taxies'][i]['order_status']) {
                                case '2':
                                    accepeted += 1;
                                    break;
                                case '3':
                                    reached += 1;
                                    break;
                                case '8':
                                    customer_reached += 1
                                    break;
                            }
                        } else {
                            if (data['taxies'][i]['live'] == "1") {
                                free += 1;
                            } else {
                                not_free += 1;
                            }
                        }

                    }

                    $('input.taxi_accepeted').val(accepeted);
                    $('input.taxi_reached').val(reached);
                    $('input.taxi_customer_reached').val(customer_reached);
                    $('input.taxi_free').val(free);
                    $('input.taxi_not_free').val(not_free);
                    $('input.taxi_all_taxi').val(json_length);

                    console.log('accepeted: ' + accepeted + "reached:" + reached + "customer_reached:" + customer_reached + "free:" + free + "not_free:" + not_free);
                    console.log(data['taxies'].length)
                }

            }

            doAjaxRequest = true;
        }
    });

    doAjaxRequest = false;
}

/*
*
*
*
*
 */

var map;
var markers = new Array();
var latitude;
var longitude;
var directionsService;
var directionsDisplay;
function initialize() {
    var styledMapType = new google.maps.StyledMapType(
        [
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fffdf9"
                    },
                    {
                        "lightness": "-3"
                    },
                    {
                        "saturation": "-64"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffc4d1"
                    },
                    {
                        "lightness": "51"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#c35e89"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#7b2f4f"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#f2e5ff"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#beaecb"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "lightness": "42"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#29222e"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#eeeeee"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffe3e3"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ad7070"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#8e2727"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#cceaa2"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#316b49"
                    }
                ]
            },
            {
                "featureType": "poi.school",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fdf3c9"
                    }
                ]
            },
            {
                "featureType": "poi.sports_complex",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffe8e8"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#f0f6ff"
                    },
                    {
                        "lightness": "100"
                    },
                    {
                        "saturation": "-10"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#fbba49"
                    },
                    {
                        "saturation": "-23"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#11110e"
                    },
                    {
                        "saturation": "11"
                    },
                    {
                        "lightness": "42"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffd94e"
                    },
                    {
                        "lightness": "30"
                    },
                    {
                        "saturation": "100"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#b6872a"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#53021f"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#fff7f9"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ddf0fa"
                    },
                    {
                        "saturation": "-50"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#595440"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffecec"
                    },
                    {
                        "lightness": "24"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fbeaea"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "saturation": "100"
                    },
                    {
                        "lightness": "0"
                    },
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#e0dfdf"
                    },
                    {
                        "weight": "10.00"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#32dafe"
                    },
                    {
                        "lightness": "61"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#01a0c1"
                    }
                ]
            }
        ],
        {name: 'Ulduz Taxi *5000'});

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;

    var mapOptions = {
        zoom: 13,
        mapTypeControlOptions: {
            mapTypeIds: ['styled_map']
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(40.415613, 49.896340),
        gestureHandling: 'greedy'
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
}

function addMarkers(marker_data){

    if(marker_data.order_status == null){
        if(marker_data.live == 1) imageType = 'taxi_pin_green.png';
        else imageType = 'taxi_pin_black.png';
    }else{
        switch (marker_data.order_status){
            case '2':
                imageType = 'taxi_pin_blue.png';
                break;
            case '3':
                imageType = 'taxi_pin_purple.png';
                break;
            case '8':
                imageType = 'taxi_pin_cyan.png';
                break;
            default:
                imageType = 'taxi_pin_green.png';
        }
    }

    var icon_base_url = baseUrl.substring(0,baseUrl.length-3)+'/assets/images/taxi_codes/'+marker_data.code+'_'+imageType;

    var image = {
        url: icon_base_url,
        size: new google.maps.Size(40, 40),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 40)
    };
    var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(marker_data.latitude, marker_data.longitude),
        icon: image,
        title: marker_data.phone+' - '+marker_data.number

    });

    var contentString = marker_data.phone+' - '+marker_data.number;

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    markers.push(marker);
}

function removeMarkers(){
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
}

$.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyB2oPlgMNLui6Js_QKiLxbS82MFu7doonA&callback=initialize")
    .done(function( script, textStatus ) {

        $('.taxi_all_taxi').trigger('click');

    });