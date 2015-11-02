<?php
	// include session_start.php and connect.php so that the session function is working
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	// getting user_id from the ajax request
	$user_id = $_GET['userid']; 
	// store user_id into session call add_userid
	$_SESSION["add_userid"] = $user_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/user_data.php');
?>