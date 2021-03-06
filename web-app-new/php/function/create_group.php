<?php
	// Include connect php file and session_start.php file
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include('connect.php');

	// Define variable
	$group_name = $_POST['group_name'];
	$group_user_id = $_SESSION['user_id'];
	$group_description = $_POST['group_description'];
	$group_friends_list = $_POST['inviteFriends']; // this will be received in the format: 1,2,3,.. WARNING: CAN ALSO BE NULL, so dont access it if it's null.
	$friend_id_array = explode(",", $group_friends_list); // this is the array of the friend's IDs to add to the group
	$add_groud_friend_array = implode(',', $friend_id_array);
	$new_group_id = 0;

	// grab create group page data from group module and store into database.
	// if there is no friend added in the create page then only register user that create the group into group member table in the database
	if ($group_friends_list==NULL) 
	{
		$create_group_query = "INSERT INTO `group` SET group_user_id='$group_user_id', group_desc='$group_description', group_name = '$group_name'";
		mysqli_query($dbconn, $create_group_query);
		$new_group_id=mysqli_insert_id($dbconn);

		$joining_group_query = "INSERT INTO group_member SET group_member_user_id='$group_user_id', group_id='$new_group_id'";
		mysqli_query($dbconn, $joining_group_query);

	}
	// store group and group member data into the database
	else
	{
		$create_group_query = "INSERT INTO `group` SET group_user_id='$group_user_id', group_desc='$group_description', group_name = '$group_name'";
		mysqli_query($dbconn, $create_group_query);
		$new_group_id=mysqli_insert_id($dbconn);

		$joining_group_query = "INSERT INTO group_member SET group_member_user_id='$group_user_id', group_id='$new_group_id'";
		mysqli_query($dbconn, $joining_group_query);

		for($i = 0; $i<sizeof($friend_id_array); $i++)
		{
		$joining_friend_to_group_query="INSERT INTO group_member SET group_member_user_id=$friend_id_array[$i], group_id='$new_group_id'";
		mysqli_query($dbconn, $joining_friend_to_group_query);
		}
		
	}
	// This is the upload group image function
	if(isset($_FILES['group_icon']))
		{

			$allowedExts = array("jpeg", "jpg", "png");
	        $temp = explode(".", $_FILES["group_icon"]["name"]);
	        $extension = end($temp);

	        if ((($_FILES["group_icon"]["type"] == "image/jpeg") || ($_FILES["group_icon"]["type"] == "image/jpg") || ($_FILES["group_icon"]["type"] == "image/pjpeg") || ($_FILES["group_icon"]["type"] == "image/x-png") || ($_FILES["group_icon"]["type"] == "image/png")) && in_array($extension, $allowedExts)) 
	        {
		        if ($_FILES["group_icon"]["error"] > 0) 
		        {
		            echo "Return Code: " . $_FILES["group_icon"]["error"] . "<br>";
		        } 
		        else 
		        {
		            move_uploaded_file($_FILES["group_icon"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/profile_img/groups/" . $new_group_id . ".jpg");
		        }
	        } 
		}

	echo $new_group_id // echo new group's id on success, echo nothing on failure
?>