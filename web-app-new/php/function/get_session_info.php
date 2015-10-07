<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');	
	$track_session_id = $_GET['session_id']; // getting selected session id from ajax request
	$_SESSION['session_id'] = $track_session_id;
	// Include session_data php file to get user track session data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_data.php');
	
	// create array of session info, ensure duration is integer of seconds
	$session_info = array('session_name' => $track_session_display_name, 'steps' => $track_session_display_steps, 'distance' => $track_session_display_distance, 'calories' => $track_session_display_calories, 'duration' => $track_session_display_duration, 'routeLatLng' => $track_session_display_latlng);

	// return as json
	echo json_encode($session_info);
?>