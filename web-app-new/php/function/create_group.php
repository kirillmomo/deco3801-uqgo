<?php
	$group_name = $_POST['group_name'];
	$group_description = $_POST['group_description'];
	$group_friends_list = $_POST['group_friends_list']; // this will be received in the format: 1,2,3,.. WARNING: CAN ALSO BE NULL, so dont access it if it's null.
	$friend_id_array = explode(",", $group_friends_list); // this is the array of the friend's IDs to add to the group

	// do your magic Kirill...

	echo "new group_id" // echo new group's id on success, echo nothing on failure
?>