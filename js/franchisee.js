/* For furthur reference please check following url
 * https://gist.github.com/ChrisLTD/5992716 
 */

var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(-39.92, 151.25),
    mapTypeId: google.maps.MapTypeId.ROADMAP
});

var infowindow = new google.maps.InfoWindow();

var marker, i;
var markers = new Array();
var image = document.location.origin+'/images/map.png';
for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'http://crm.checksample.co.uk/images/map.png',
    });

    markers.push(marker);

    google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function () {
            infowindow.setContent(locations[i][3]);
            infowindow.open(map, marker);
        }
    })(marker, i));
}

function AutoCenter() {
    //  Create a new viewpoint bound
    var bounds = new google.maps.LatLngBounds();
    //  Go through each...
    $.each(markers, function (index, marker) {
        bounds.extend(marker.position);
    });
    //  Fit these bounds to the map
    map.fitBounds(bounds);
}
AutoCenter();
