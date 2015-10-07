<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');
	$joining_group_id = $_GET['group_id']; // getting group_id from the ajax request
	$_SESSION["join_groupid"] = $joining_group_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/group_data.php');
?>