<?php
	// include session_start.php and connect.php so that the session function is working and database connection is connected
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include('connect.php');
	// getting user_id from the ajax request
	$friend_id = $_GET['friend_id'];
	// store session data name user_id into variable call user_id
	$user_id = $_SESSION['user_id']; 
	// move one friend_request data from friend_request table to friends table
	$add_query = "INSERT INTO friends SET user_id='$friend_id', friend_id='$user_id'";
	// delete one friend_request data
	$delete_query = "DELETE FROM friend_request WHERE user_id='$friend_id' AND request_friend_id='$user_id'";
	mysqli_query($dbconn, $add_query);
	mysqli_query($dbconn, $delete_query);
?>