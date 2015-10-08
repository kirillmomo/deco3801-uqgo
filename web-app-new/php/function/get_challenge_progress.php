<?php
	$challenge_id = $_GET['challenge_id']; // getting challenge_id from the ajax request

	// create array of challenge progress info
	$challenge_progress_info = array('goalProgress' => 400, 'goalAmount' => 1000, 'daysProgressed' => 3, 'daysDuration' => 7);

	// return as json
	echo json_encode($challenge_progress_info);
?>