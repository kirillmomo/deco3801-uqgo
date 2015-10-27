<?php
//This page is used to upload user's info and footstep posted from the app
date_default_timezone_set("Australia/Brisbane");
$response = array();
if (isset($_POST['username'])) {
    // connecting to db
    include("mobileConnect.php");
    // Gather Info from register form
    $Name = $_POST['username'];
    $Email = $_POST['email'];
    $First = $_POST['first'];
    $Last = $_POST['last'];
    $Password = $_POST['password'];
    $Date = date("Y-m-d H:i:s");

    //insert data to table
    $query = "INSERT INTO `user`(`username`, `password`, `first_name`, `last_name`, `user_email`, `user_height`, `user_weight`, `user_gender`, `user_day_of_birth`, `user_date_created`) VALUES ('$Name','$Password','$First','$Last','$Email','175','80','Male', '1995-08-18', $Date')";
    $result = mysql_query($dbconn, $query);

    if ($result) {  
        // successfully inserted into database
        $response["success"] = 1;
        echo "done";
    }
}
?>