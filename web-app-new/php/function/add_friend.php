<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
	$user_id = $_GET['userid']; // getting user_id from the ajax request
	$_SESSION["add_userid"] = $user_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');

	// Add the friend with the user_id immediately, don't worry about "accepting friend requests" or notifications
?>