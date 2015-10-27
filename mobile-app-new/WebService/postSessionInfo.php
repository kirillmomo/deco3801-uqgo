<?php
//This page is used to upload user's info and footstep posted from the app
date_default_timezone_set("Australia/Brisbane");
$response = array();
if (isset($_POST['steps'])) {
    // connecting to db
    include("mobileConnect.php");
    // Gather Info from tracking session
    $steps = $_POST['steps'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $route = $_POST['route'];
    $Date = date("Y-m-d H:i:s");

    //insert data to table
    $query = "INSERT INTO `session`(`session_user_id`, `session_date`, `session_time_length`, `session_steps`, `session_distance`, `session_latlng`) VALUES ('1','$Date','$duration','$steps','$distance','$route')";
    echo $query;
    $result = mysqli_query($dbconn, $query);

    if ($result) {  
        // successfully inserted into database
        $response["success"] = 1;
        echo "done";
    }
}
?>