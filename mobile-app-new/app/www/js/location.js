// string list of Latlongs path of the run
var route = "";
// Geolocation watch settings
var geosettings = { timeout: 9500, enableHighAccuracy: true };

function geoSuccess(position) {
    // handle geolocation data
    var data = position.coords.latitude + ", " + position.coords.longitude;
    console.log('location: ' +data);
    route+=data + '\n';
    console.log(route);
    alert(route);
}

function geoError() {
    // handle geolocation error
    alert("Geolocation Error occured");
}

function getLocation() {
    // Start watching the users location.
    geowatch = navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geosettings);
}