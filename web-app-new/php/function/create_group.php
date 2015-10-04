<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/session_start.php');
	$group_name = $_POST['group_name'];
	$group_user_id = $_SESSION['user_id'];
	$group_description = $_POST['group_description'];
	$group_friends_list = $_POST['group_friends_list']; // this will be received in the format: 1,2,3,.. WARNING: CAN ALSO BE NULL, so dont access it if it's null.
	$friend_id_array = explode(",", $group_friends_list); // this is the array of the friend's IDs to add to the group
	$array = implode(',', $friend_id_array);

	 $_SESSION['user_id1'] = $group_name;
	  $_SESSION['user_id2'] = $group_description;
	   $_SESSION['user_id3'] = $array;


		$create_group_query = "INSERT INTO `group` SET group_user_id=1";
		$_SESSION['user_id3']=$create_group_query;
		mysql_query($create_group_query);


	// do your magic Kirill...

	echo "new group_id" // echo new group's id on success, echo nothing on failure
?>