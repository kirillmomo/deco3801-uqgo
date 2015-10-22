<?php

	// Include connect php file
	include('connect.php');

	// Define variable
	$track_session_user_id=$_SESSION['user_id'];
	$track_session_display_id=$_SESSION['session_id'];
	$track_session_filter=$_SESSION['filter_time'];
	$track_session_id=array();
	$track_session_time=array();
	$track_session_display_name = "";
	$track_session_display_steps = "";
	$track_session_display_distance = "";
	$track_session_display_calories = "";
	$track_session_display_duration = "";
	$track_session_display_latlng = "";
	$i=0;

	if ($track_session_filter=="today") 
	{
		$track_session_query = "SELECT * FROM session WHERE session_user_id = '$track_session_user_id' AND DATE(session_date) = CURDATE()";
		$track_session_data = mysqli_query($dbconn, $track_session_query);

		while($track_session_row = mysqli_fetch_array($track_session_data))
		{
			$track_session_id[$i] = $track_session_row['session_id']; 
			$track_session_time[$i] = date('m/d/Y h:i a', strtotime($track_session_row['session_date'])); 
			$i++;
		}
	}
	elseif ($track_session_filter=="week") 
	{
		$track_session_query = "SELECT * FROM session WHERE session_user_id = '$track_session_user_id' AND WEEK(session_date)= WEEK(NOW())";
		$track_session_data = mysqli_query($dbconn, $track_session_query);

		while($track_session_row = mysqli_fetch_array($track_session_data))
		{
			$track_session_id[$i] = $track_session_row['session_id']; 
			$track_session_time[$i] = date('m/d/Y h:i a', strtotime($track_session_row['session_date'])); 
			$i++;
		}
	}
	elseif ($track_session_filter=="month") 
	{
		$track_session_query = "SELECT * FROM session WHERE session_user_id = '$track_session_user_id' AND MONTH(session_date)= MONTH(NOW())";
		$track_session_data = mysqli_query($dbconn, $track_session_query);

		while($track_session_row = mysqli_fetch_array($track_session_data))
		{
			$track_session_id[$i] = $track_session_row['session_id'];
			$track_session_time[$i] = date('m/d/Y h:i a', strtotime($track_session_row['session_date'])); 
			$i++;
		}
	}
	else
	{
		$track_session_query = "SELECT * FROM session WHERE session_user_id = '$track_session_user_id'";
		$track_session_data = mysqli_query($dbconn, $track_session_query);

		while($track_session_row = mysqli_fetch_array($track_session_data))
		{
			$track_session_id[$i] = $track_session_row['session_id']; 
			$track_session_time[$i] = date('m/d/Y h:i a', strtotime($track_session_row['session_date'])); 
			$i++;
		}
	}

<<<<<<< HEAD
	$track_session_display_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_id = '$track_session_display_id'";
=======
	$track_session_display_query = "SELECT * FROM session WHERE session_id = '$track_session_display_id'";
>>>>>>> origin/beta
	$track_session_display_data = mysqli_query($dbconn, $track_session_display_query);

	while($track_session_display_row = mysqli_fetch_array($track_session_display_data))
		{
			$track_session_display_name = date('m/d/Y h:i a', strtotime($track_session_display_row['session_date']));
			$track_session_display_steps = $track_session_display_row['session_steps'];
			$track_session_display_distance = $track_session_display_row['session_distance'];
			if($track_session_display_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $track_session_display_row['user_weight']) + (5 * $track_session_display_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($track_session_display_row['user_day_of_birth']))));
						$MET = 2;
						$track_session_calories = round(($BMR/24)*$MET*($track_session_display_row['session_time_length']/3600));
						$track_session_display_calories = $track_session_calories + $track_session_display_calories;
					}
					else
					{
						$BMR = 655 + (13.75 * $track_session_display_row['user_weight']) + (5 * $track_session_display_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($track_session_display_row['user_day_of_birth']))));
						$MET = 2;
						$track_session_calories = round(($BMR/24)*$MET*($track_session_display_row['session_time_length']/3600));
						$track_session_display_calories = $track_session_calories + $track_session_display_calories;
					}
			$track_session_display_duration = $track_session_display_row['session_time_length'];
			$track_session_display_latlng = str_replace(" ","\n",$track_session_display_row['session_latlng']);	
		}

	// Delete friend and search session
	unset($_SESSION['session_id']);
	unset($_SESSION['filter_time']);
?>
