<?php

//This page is used to upload user's info and footstep posted from the app
$response = array();
if (isset($_POST['username'])) {
    // connecting to db
    include("connect.php");
    // Gather Info from register form
    $Name = $_POST['username'];
    $Email = $_POST['email'];
    $First = $_POST['first'];
    $Last = $_POST['Last'];
    $Password = $_POST['password'];
    $Date = date("Y-m-d h:i:s");

    //insert data to table
    $query = "INSERT INTO `user`(`user_id`, `username`, `password`, `first_name`, `last_name`, `user_email`, `user_height`, `user_weight`, `user_gender`, `user_day_of_birth`, `user_icon`, `user_date_created`) VALUES (NULL,'$Name','$Password','$First','$Last','$Email','175','80','Male','1995-08-18','','$Date')";
    $query2 = "INSERT INTO `uq_go_db`.`user` (`user_id`, `username`, `password`, `first_name`, `last_name`, `user_email`, `user_height`, `user_weight`, `user_gender`, `user_day_of_birth`, `user_icon`, `user_date_created`) VALUES (NULL, 'Chum', 'respect', 'Chamath', 'Abey', 'chamath.abey', '175', '80', 'Male', '2015-09-02', '', CURRENT_TIMESTAMP)";
    $result = mysql_query($dbconn, $query2);

    if ($result) {  
        // successfully inserted into database
        $response["success"] = 1;
        echo "done";
    }
}
?>