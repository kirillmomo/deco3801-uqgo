<?php

//This page is used to upload user's info and footstep posted from the app
$response = array();
$response["UserCredentials"] = array();
if (isset($_POST['username'])) {
    // connecting to db
    include("connect.php");

    $username = $_POST['username'];
    $Password = $_POST['password'];

    //Query for user's data
    $query_info = "SELECT * FROM `user` WHERE `username`='".$Name."' AND `password`='".$Password."'";

    $result = mysql_query($dbconn, $query);

    while($row = mysql_fetch_array($result)){

        $newJSON = array();
            $newJSON["username"] = $row['username'];
            $newJSON["password"] = $row['password'];
            // join it as a JSON
            array_push($response["UserCredentials"], $newJSON);
    $response["success"] = 1;
    }
}
?>