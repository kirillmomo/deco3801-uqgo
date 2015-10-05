<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/session_start.php');
	// Include connect php file
	include('connect.php');

	$group_name = $_POST['group_name'];
	$group_user_id = $_SESSION['user_id'];
	$group_description = $_POST['group_description'];
	$group_friends_list = $_POST['group_friends_list']; // this will be received in the format: 1,2,3,.. WARNING: CAN ALSO BE NULL, so dont access it if it's null.
	$friend_id_array = explode(",", $group_friends_list); // this is the array of the friend's IDs to add to the group
	$add_groud_friend_array = implode(',', $friend_id_array);
	$new_group_id = 0;
	if ($group_friends_list==NULL) 
	{
		$create_group_query = "INSERT INTO `group` SET group_user_id='$group_user_id', group_desc='$group_description', group_name = '$group_name'";
		mysql_query($create_group_query);
		$new_group_id=mysql_insert_id();
		$joining_group_query = "INSERT INTO group_member SET group_member_user_id='$group_user_id', group_id='$new_group_id'";
		mysql_query($joining_group_query);
	}
	else
	{
		$create_group_query = "INSERT INTO `group` SET group_user_id='$group_user_id', group_desc='$group_description', group_name = '$group_name'";
		mysql_query($create_group_query);
		$new_group_id=mysql_insert_id();

		$joining_group_query = "INSERT INTO group_member SET group_member_user_id='$group_user_id', group_id='$new_group_id'";
		mysql_query($joining_group_query);

		for($i = 0; $i<sizeof($friend_id_array); $i++)
		{
		$joining_friend_to_group_query="INSERT INTO group_member SET group_member_user_id=$friend_id_array[$i], group_id='$new_group_id'";
		mysql_query($joining_friend_to_group_query);
		}
		
	}

	echo $new_group_id // echo new group's id on success, echo nothing on failure
?>