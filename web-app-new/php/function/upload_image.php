<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');
	include('connect.php');
	$user_id=$_SESSION['user_id'];

	if(isset($_FILES['file']))
	{

		$allowedExts = array("jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png")) && in_array($extension, $allowedExts)) 
        {
          if ($_FILES["file"]["error"] > 0) 
          {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
          } 
          else 
          {
              var_dump(move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/profile_img/users/" . $user_id . ".jpg"));
              // header('Location: /v0-4/settings.php');
          }
        } 
	}


?>