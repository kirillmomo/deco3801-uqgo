// string list of Latlongs path of the run
var route = "";
// Geolocation watch settings
var geosettings = { timeout: 30000, enableHighAccuracy: true };

// Process location data
function geoSuccess(position) {
    // Format data for databse insertion
    var data = "(" + position.coords.latitude + "," + position.coords.longitude + ")";
    console.log('location: ' +data);
    // Append location to route string
    route+=data + ' ';
    console.log(route);
}

// Handle error with Geolocation
function geoError() {
    console.log("Geolocation Error occured");
}

function getLocation() {
    // Start watching the users location.
    geowatch = navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geosettings);
}