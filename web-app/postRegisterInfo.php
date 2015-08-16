<?php

//This page is used to upload user's info and footstep posted from the app
$response = array();
if (isset($_POST['Username'])) {
    // connecting to db
    include("connect.php");

    $Name = $_POST['Username'];
    $Password = $_POST['Password'];
    //insert data to two table
    $query = "INSERT INTO `user`(`username`, `password`, `user_id`) VALUES ('$Name', '$Password', NULL);";
    $result = mysqli_query($dbconn, $query);

    if ($result) {  
        // successfully inserted into database
        $response["success"] = 1;
        echo "done";
    }
}
?>