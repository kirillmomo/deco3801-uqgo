<?php

//This page is used to upload user's info and footstep posted from the app
$response = array();
$response["UserCredentials"] = array();
if (isset($_POST['username'])) {
    // connecting to db
    include("connect.php");

    $username = $_POST['username'];
    $Password = hash('sha256', $_POST['password']);

    //Query for user's data
    $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
    $data = mysqli_query($dbconn, $query);

    while($row = mysql_fetch_array($data)){

        $newJSON = array();
            $newJSON["userid"] = $row['user_id'];
            $newJSON["username"] = $row['username'];
            $newJSON["password"] = $row['password'];
            // join it as a JSON
            array_push($response["UserCredentials"], $newJSON);
    $response["success"] = 1;
    }
}
?>