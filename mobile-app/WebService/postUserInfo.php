<?php

//This page is used to upload user's info and footstep posted from the app
$response = array();
if (isset($_POST['Name'])) {
    // connecting to db
    include("connect.php");

    $Name = $_POST['Name'];
    $Height = $_POST['Height'];
    $Steps = $_POST['Steps'];
    //insert data to two table
    $query = "INSERT INTO `TestBrian`.`basicInfo` (`id`, `Name`, `Height`, `Icon`) VALUES (NULL, '$Name', '$Height', NULL);";
    $result = mysqli_query($dbconn, $query);

    $query = " INSERT INTO `TestBrian`.`session` ( `id`,`userid`,`steps` )SELECT  NULL, `id`, '$Steps' FROM  `basicInfo` WHERE `Name` = '$Name';";
    $result = mysqli_query($dbconn, $query);
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        echo "done";
    }
}
?>