<?php
//This page is used to upload geolocation(s) recorded from mobile app, send through http post and write in database   
$response = array();
//
$locationJSON = file_get_contents("php://input");//retreve the whole JSON from mobile app

include("connect_uq_go_db.php");
$location_list = JSON_Procressor($locationJSON);//break down JSON data into object and put it as a format in database
// location_list should be in this format: (the order are same as the route - 1st = start, last = end)
//(<lat>, <lng>)
//(<lat>, <lng>)
//(<lat>, <lng>)
//...
//
//generate current date and time
$date_value = date("Y/m/d"); 
$time_value = date("h:i"); 
//insert location, date and time to database. We hardcoded student ID since it is a prototype
$query = "INSERT INTO `route`(`Date`,`Time`,`stdID`, `latlng`) VALUES ('$date_value','$time_value','s1234','$location_list')";
$result = mysqli_query($dbconn, $query);
if ($result) {
    // successfully inserted into database
    $response["success"] = 1;
    echo "done";
}


function JSON_Procressor($json) {
//JSON data retrieve should be in this format:
//'[{"lat":<data>,"lng":<data>},{"lat":<data>,"lng":<data>}...]'; 

    $locationJSON = $json;
//remove '['and']' from JSON
    $uploadLocationList = "";
//spilt mutilple json
    $testAray = json_split_objects(substr($json, 1, -1));

//extract data and put in format (<lat>,<lng>)\n
    for ($x = 0; $x < count($testAray); $x+=2) {

        $decodedJSON = json_decode($testAray[$x]);
        $uploadLocationList = $uploadLocationList . "(" . $decodedJSON->{'lat'} . "," . $decodedJSON->{'lng'} . ")" . "\n";
    }
    return $uploadLocationList;
}

function json_split_objects($json) {
    $q = FALSE;
    $len = strlen($json);
    for ($l = $c = $i = 0; $i < $len; $i++) {
        $json[$i] == '"' && ($i > 0 ? $json[$i - 1] : '') != '\\' && $q = !$q;
        if (!$q && in_array($json[$i], array(" ", "\r", "\n", "\t"))) {
            continue;
        }
        in_array($json[$i], array('{', '[')) && !$q && $l++;
        in_array($json[$i], array('}', ']')) && !$q && $l--;
        (isset($objects[$c]) && $objects[$c] .= $json[$i]) || $objects[$c] = $json[$i];
        $c += ($l == 0);
    }
    return $objects;
}

?>