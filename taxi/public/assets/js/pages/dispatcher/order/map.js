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
        center: new google.maps.LatLng(40.415613, 49.896340)
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
}

function addMarkers(latitude, longitude){

    var icon_url = 'https://ulduz.smarttaxi.cloud/smarttaxi//assets/images/taxi_pin_black.png';

    var image = {
        url: icon_url,
        size: new google.maps.Size(40, 40),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 40)
    };

    var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(latitude, longitude),
        icon: image,
        title: '0001 - Taxi Kamran Nəcəfzadə - 10-AA-123'

    });

    var contentString = '0001 - Taxi Kamran Nəcəfzadə - 10-AA-123';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    map.setCenter(new google.maps.LatLng(latitude, longitude));
    markers.push(marker);
}

function removeMarkers(){
    for (var i = 0; i < markers.length; i++) {

        markers[i].setMap(null);
    }
}

function addFromMark(){

    longitude = $($('.longitude')[0]).val();
    latitude = $($('.latitude')[0]).val();

    if(latitude==''||longitude==''){
        latitude = '40.415613';
        longitude = '49.896340';
    }
    removeMarkers();
    addMarkers(latitude, longitude);
}