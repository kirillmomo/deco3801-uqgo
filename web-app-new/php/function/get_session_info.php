<?php
	$session_id = $_GET['session_id']; // getting selected session id from ajax request

	// retrieve session info from db using session_id ....
	// ....
	// ....

	// create array of session info, ensure duration is integer of seconds
	$session_info = array('session_name' => "Mon 28/09/2015 4:20PM", 'steps' => 546, 'distance' => 2.05, 'calories' => 106, 'duration' => 1976, 'routeLatLng' => "unimplemented for now");

	// return as json
	echo json_encode($session_info);
?>