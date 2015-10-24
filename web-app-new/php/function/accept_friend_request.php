<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include('connect.php');
	$friend_id = $_GET['friend_id']; // getting user_id from the ajax request
	$user_id = $_SESSION['user_id'];
	$add_query = "INSERT INTO friends SET user_id='$friend_id', friend_id='$user_id'";
	$delete_query = "DELETE FROM friend_request WHERE user_id='$friend_id' AND request_friend_id='$user_id'";
	mysqli_query($dbconn, $add_query);
	mysqli_query($dbconn, $delete_query);
?>