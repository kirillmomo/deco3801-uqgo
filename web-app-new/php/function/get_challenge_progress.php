<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/session_start.php');

	// Include challenge_data php file to get user challenge data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/challenge_data.php');

	// create array of challenge progress info
	$challenge_progress_info = array('goalProgress' => $challenge_detail_progress, 'goalAmount' => $challenge_detail_goal, 'daysProgressed' => $challenge_detail_duration_day_left, 'daysDuration' => $challenge_detail_day_left);

	// return as json
	echo json_encode($challenge_progress_info);
?>