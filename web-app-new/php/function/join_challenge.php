<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	$joining_challenge_id = $_GET['challenge_id']; // getting group_id from the ajax request
	$_SESSION["join_challenge_id"] = $joining_challenge_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/challenge_data.php');
?>