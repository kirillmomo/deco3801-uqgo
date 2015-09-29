<?php
	$session_id = $_GET['session_id']; // getting selected session id from ajax request

	// retrieve session info from db using session_id ....
	// ....
	// ....

	// create array of session info, ensure duration is integer of seconds
	$session_info = array('session_name' => "Mon 28/09/2015 4:20PM", 'steps' => 546, 'distance' => 2.05, 'calories' => 106, 'duration' => 1976, 'routeLatLng' => "(-27.495649,153.011923)\n(-27.494493,153.011716)\n(-27.494945,153.012918)\n(-27.496492,153.013412)\n(-27.4994535,153.0144604)\n(-27.4994506,153.0144602)");

	// return as json
	echo json_encode($session_info);
?>