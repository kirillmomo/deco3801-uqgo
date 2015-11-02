<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	$group_id = $_GET['group_id']; // getting group_id from the ajax request
	// store group id into leave_groupid
	$_SESSION["leave_groupid"] = $group_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/group_data.php');
?>