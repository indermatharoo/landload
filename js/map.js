var infoWindow = new google.maps.InfoWindow({
    maxWidth: 280
});
var markers = [];
var myMap = null;

// geocode stuff
var myGeocoder = new google.maps.Geocoder();
var myGeocodes = [];
var myGeocodeTimer = null;

var bounds = new google.maps.LatLngBounds();
var fitToBounds = false;
var maxZoom = 10;

function initializeMap(lat, lng, zoom, type, zoomToBounds, maxBoundsZoom) {

    lat = typeof (lat) != 'undefined' ? lat : false;
    lng = typeof (lng) != 'undefined' ? lng : false;
    fitToBounds = typeof (zoomToBounds) != 'undefined' ? zoomToBounds : false;
    zoom = typeof (zoom) != 'undefined' ? zoom : 5;
    // set the max bounds zoom to the initial zoom level
    maxZoom = typeof (maxBoundsZoom) != 'undefined' ? maxBoundsZoom : false;

    if (lat && lng) {
        var latLng = new google.maps.LatLng(lat, lng);
    } else {
        var latLng = new google.maps.LatLng(0, 0);
    }

    var myOptions = {
        zoom: zoom,
        center: latLng,
        mapTypeId: type,
        scrollwheel: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        }
    };
    myMap = new google.maps.Map(document.getElementById("GMap"), myOptions);

}

function addMarker(details) {

    if (details['geocode']) {

        myGeocodes.push(details);
        if (myGeocodeTimer == null) {
            myGeocodeTimer = setInterval("addGeocodedMarker()", 500);
        }

    } else {

        var myLatLng = new google.maps.LatLng(details['lat'], details['lng']);
        if (details['icon']) {
            var myMarker = new google.maps.Marker({
                position: myLatLng,
                map: myMap,
                icon: details['icon'],
                size: {
                    width: details['icon_w'],
                    height: details['icon_h']
                }
            });
        } else {
            var myMarker = new google.maps.Marker({
                position: myLatLng,
                map: myMap
            });
        }

        if (details['title']) {
            myMarker.setTitle(details['title']);
        }

        markers.push(myMarker);
        bounds.extend(myMarker.getPosition());

        if (details['html']) {

            google.maps.event.addListener(myMarker, 'click', function () {
                infoWindow.close();
                myMap.panTo(myMarker.getPosition());
                var contentString = '<div class="mapInfo">' + details['html'] + '</div>';
                infoWindow.setContent(contentString);
                infoWindow.open(myMap, myMarker);

            });

        }

        if (fitToBounds && markers.length > 0) {
            myMap.fitBounds(bounds);
            if (maxZoom) {
                var listener = google.maps.event.addListener(myMap, "idle", function () {
                    if (myMap.getZoom() > maxZoom)
                        myMap.setZoom(maxZoom);
                    google.maps.event.removeListener(listener);
                });
            }
        }

        return myMarker;

    }

}

function addGeocodedMarker() {

    if (myGeocodes.length == 0) {

        clearInterval(myGeocodeTimer);

        if (fitToBounds && markers.length > 0) {
            myMap.fitBounds(bounds);
            if (maxZoom) {
                var listener = google.maps.event.addListener(myMap, "idle", function () {
                    if (myMap.getZoom() > maxZoom)
                        myMap.setZoom(maxZoom);
                    google.maps.event.removeListener(listener);
                });
            }
        }

        return;
    }
    var details = myGeocodes.pop();

    myGeocoder.geocode({
        address: details['address'],
        region: 'GB'
    }, function (results, status) {

        if (status == google.maps.GeocoderStatus.OK) {

            if (details['icon']) {
                var myMarker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: myMap,
                    icon: details['icon'],
                    size: {
                        width: details['icon_w'],
                        height: details['icon_h']
                    }
                });

                if (details['icon_shadow']) {
                    var shadow = new google.maps.MarkerImage(details['icon_shadow'], new google.maps.Size(details['icon_shadow_w'], details['icon_shadow_h']));
                    myMarker.setShadow(shadow);
                }

            } else {

                var myMarker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: myMap
                });

            }

            if (details['title']) {
                myMarker.setTitle(details['title']);
            }

            markers.push(myMarker);
            bounds.extend(myMarker.position);

            if (details['html']) {

                google.maps.event.addListener(myMarker, 'click', function () {
                    infoWindow.close();
                    myMap.panTo(myMarker.getPosition());
                    infoWindow.setContent('<div class="mapInfo">' + details['html'] + '</div>');
                    infoWindow.open(myMap, myMarker);

                });
            }

        } else {

            var errorMessage = 'Failed to find ' + details['address'];
            var statusMessage = '';
            switch (status) {
                case google.maps.GeocoderStatus.ERROR:
                    statusMessage = 'There was a problem contacting the Google servers.';
                    break;
                case google.maps.GeocoderStatus.INVALID_REQUEST:
                    statusMessage = 'The GeocoderRequest was invalid.';
                    break;
                case google.maps.GeocoderStatus.OVER_QUERY_LIMIT:
                    statusMessage = 'The webpage has gone over the requests limit in too short a period of time.';
                    break;
                case google.maps.GeocoderStatus.REQUEST_DENIED:
                    statusMessage = 'The webpage is not allowed to use the geocoder.';
                    break;
                case google.maps.GeocoderStatus.UNKNOWN_ERROR:
                    statusMessage = 'A geocoding request could not be processed due to a server error. The request may succeed if you try again.';
                    break;
                case google.maps.GeocoderStatus.ZERO_RESULTS:
                    statusMessage = 'No results were found.';
                    break;

            }

            if (window.console) {
                console.error(errorMessage);
                console.debug(statusMessage);
            }

        }
    });
}
