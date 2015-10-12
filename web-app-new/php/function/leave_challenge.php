<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');
	$challange_id = $_GET['challenge_id']; // getting group_id from the ajax request
	$_SESSION["leave_challange_id"] = $challange_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/challenge_data.php');
?>