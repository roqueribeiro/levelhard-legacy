var MapApiLatLng = new Array(-23.3794370, -47.8515260);

function initMap() {

    var contentString = '<div class="_template_contact_map_info">' +
                        '<h4>Imprimil - Personalização de Frotas</h4>' +
                        '<p>Rua Teófilo Andrade Gama, 1509</p>' +
                        '<p>Jardim Rosa Garcia, 18275-630, Tatuí - SP</p>' +
                        '<p>Telefone: +55 (15) 3324-1477</p>' +
                        '<p>Celular: +55 (15) 9 7402-0960</p>' +
                        '<p>E-mail: <a href="mailto:contato@imprimil.com">contato@imprimil.com</a></p>' +
                        '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var mapOptions = {
        disableDefaultUI: true,
        zoom: 15,
        center: new google.maps.LatLng(MapApiLatLng[0] + 0.002000, MapApiLatLng[1]),
        styles: [
            {
                "featureType": "administrative",
                "elementType": "labels",
                "stylers": [
                    {
                        "color": "#FFFFFF"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "color": "#303030"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "color": "#FFFFFF"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "color": "#808080"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#FFFFFF"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#303030"
                    }
                ]
            }
        ]
    };

    var mapElement = document.getElementById("map");
    var map = new google.maps.Map(mapElement, mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(MapApiLatLng[0], MapApiLatLng[1]),
        map: map,
        title: "Imprimil"
    });

    infowindow.open(map, marker);
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });

}