<?php
	// Include connect php file and session_start.php file
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include('connect.php');
	$friend_id = $_GET['friend_id']; // getting user_id from the ajax request
	$user_id = $_SESSION['user_id'];
	// delete the friend request data if the user is declide to accept friend request
	$delete_query = "DELETE FROM friend_request WHERE user_id='$friend_id' AND request_friend_id='$user_id'";
	mysqli_query($dbconn, $delete_query);

?>