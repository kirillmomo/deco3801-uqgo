<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	$user_id = $_GET['userid']; // getting user_id from the ajax request
	$_SESSION['delete_userid'] = $user_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/user_data.php');
	// Remove the friend with the user_id
?>