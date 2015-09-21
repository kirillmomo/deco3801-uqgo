<?php

	// include connect php file
	include('connect.php');

	// define variables for JS 
	echo "
		<script>
			var hour_graph_distance=[];
			var month_graph_distance=[];

			var mon_distance  = 0;
			var tue_distance  = 0;
			var wed_distance  = 0;
			var thu_distance  = 0;
			var fri_distance  = 0;
			var sat_distance  = 0;
			var sun_distance  = 0;
		</script>
	";

	$user_id = $_SESSION['user_id'];
	$user_friend_id = $_SESSION['friend_id'];
	$user_name="";
	
	$hour_graph_distance_display=array();
	$month_graph_distance_display=array();

	$total_distance = 0;
	$friend_total_distance = 0;

	$mon_distance_data = 0;
	$tue_distance_data = 0;
	$wed_distance_data = 0;
	$thu_distance_data = 0;
	$fri_distance_data = 0;
	$sat_distance_data= 0;
	$sun_distance_data= 0;

	$day_distance = 0;

	$week_distance = 0;

	$month_distance = 0;

	$total_total_distance = 0;
	$friend_total_total_distance = 0;

	$total_day_distance = 0;

	$total_week_distance = 0;

	$total_month_distance = 0;

	$total_query = "SELECT * FROM session WHERE session_user_id = '$user_id'";
	$friend_total_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id'";
	$hour_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND DATE(session_date) = DATE(NOW()) AND HOUR(session_date)";
	$day_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND DATE(session_date) = DATE(NOW())";
	$week_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND WEEK(session_date)= WEEK(NOW())";
	$month_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND MONTH(session_date)= MONTH(NOW())";	
	$user_total_distance_query = "SELECT * FROM user WHERE user_id = '$user_id'";

	$total_data = mysql_query($total_query,$dbconn);
	$friend_total_data = mysql_query($friend_total_query,$dbconn);
	$hour_data = mysql_query($hour_query,$dbconn);
	$day_data = mysql_query($day_query,$dbconn);
	$week_data = mysql_query($week_query,$dbconn);
	$month_data = mysql_query($month_query,$dbconn);
	$week_graph_distance_data = mysql_query($week_query,$dbconn);
	$user_total_distance_data = mysql_query($user_total_distance_query,$dbconn);

	// Store and calculate total distance into array 	
	    while($hour_graph_distance_row = mysql_fetch_array($hour_data))
		{
		
			$time=date("H", strtotime($hour_graph_distance_row['session_date']));

			if($time=="00")
				{
					$hour_graph_distance_display[0] = $hour_graph_distance_display[0] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="01") 
				{
					$hour_graph_distance_display[1] = $hour_graph_distance_display[1] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="02") 
				{
					$hour_graph_distance_display[2] = $hour_graph_distance_display[2] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="03") 
				{
					$hour_graph_distance_display[3] = $hour_graph_distance_display[3] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="04") 
				{
					$hour_graph_distance_display[4] = $hour_graph_distance_display[4] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="05") 
				{
					$hour_graph_distance_display[5] = $hour_graph_distance_display[5] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="06") 
				{
					$hour_graph_distance_display[6] = $hour_graph_distance_display[6] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="07") 
				{
					$hour_graph_distance_display[7] = $hour_graph_distance_display[7] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="08") 
				{
					$hour_graph_distance_display[8] = $hour_graph_distance_display[8] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="09") 
				{
					$hour_graph_distance_display[9] = $hour_graph_distance_display[9] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="10") 
				{
					$hour_graph_distance_display[10] = $hour_graph_distance_display[10] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="11") 
				{
					$hour_graph_distance_display[11] = $hour_graph_distance_display[11] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="12") 
				{
					$hour_graph_distance_display[12] = $hour_graph_distance_display[12] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="13") 
				{
					$hour_graph_distance_display[13] = $hour_graph_distance_display[13] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="14") 
				{
					$hour_graph_distance_display[14] = $hour_graph_distance_display[14] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="15") 
				{
					$hour_graph_distance_display[15] = $hour_graph_distance_display[15] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="16") 
				{
					$hour_graph_distance_display[16] = $hour_graph_distance_display[16] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="17") 
				{
					$hour_graph_distance_display[17] = $hour_graph_distance_display[17] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="18") 
				{
					$hour_graph_distance_display[18] = $hour_graph_distance_display[18] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="19") 
				{
					$hour_graph_distance_display[19] = $hour_graph_distance_display[19] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="20") 
				{
					$hour_graph_distance_display[20] = $hour_graph_distance_display[20] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="21") 
				{
					$hour_graph_distance_display[21] = $hour_graph_distance_display[21] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="22") 
				{
					$hour_graph_distance_display[22] = $hour_graph_distance_display[22] + $hour_graph_distance_row['session_distance'];
				}
			else if ($time=="23") 
				{
					$hour_graph_distance_display[23] = $hour_graph_distance_display[23] + $hour_graph_distance_row['session_distance'];
				}

		}

	// Store hour distance data into js array
	for($h=0; $h<=23; $h++)
	{	
	echo "
			<script>
				hour_graph_distance[".json_encode($h)."] = ".json_encode($hour_graph_distance_display[$h]).";
			</script>
		";
	}

	while($week_graph_distance_row = mysql_fetch_array($week_graph_distance_data))
	{
		$date=date("D", strtotime($week_graph_distance_row['session_date']));
		if($date=="Mon")
			{
				$mon_distance_data = $mon_distance_data + $week_graph_distance_row['session_distance'];
			}
		else if ($date=="Tue") 
			{
				$tue_distance_data = $tue_distance_data + $week_graph_distance_row['session_distance'];
			}
		else if ($date=="Wed") 
			{
				$wed_distance_data = $wed_distance_data + $week_graph_distance_row['session_distance'];
			}
		else if ($date=="Thu") 
			{
				$thu_distance_data = $thu_distance_data + $week_graph_distance_row['session_distance'];
			}
		else if ($date=="Fri") 
			{
				$fri_distance_data = $fri_distance_data + $week_graph_distance_row['session_distance'];
			}
		else if ($date=="Sat") 
			{
				$sat_distance_data = $sat_distance_data + $week_graph_distance_row['session_distance'];
			}
		else if ($date=="Sun") 
			{
				$sun_distance_data = $sun_distance_data + $week_graph_distance_row['session_distance'];
			}
	}

	echo "
		<script>
			mon_distance = ".json_encode($mon_distance_data).";
			tue_distance = ".json_encode($tue_distance_data).";
			wed_distance = ".json_encode($wed_distance_data).";
			thu_distance = ".json_encode($thu_distance_data).";
			fri_distance = ".json_encode($fri_distance_data).";
			sat_distance = ".json_encode($sat_distance_data).";
			sun_distance = ".json_encode($sun_distance_data).";
		</script>
	";

	for ($x = 0; $x <= 11; $x++) 
	{
    $month_graph_distance_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND MONTH(session_date)=".$x."+1";
    $month_graph_distance_data = mysql_query($month_graph_distance_query,$dbconn);
    $month_graph_distance_display[$x] = 0;

		while($month_graph_distance_row = mysql_fetch_array($month_graph_distance_data))
		{
			$month_graph_distance_display[$x] = $month_graph_distance_display[$x]+$month_graph_distance_row['session_distance'];
		}

	echo "
			<script>
				month_graph_distance[".json_encode($x)."] = ".json_encode($month_graph_distance_display[$x]).";
			</script>
		";

	}

	while($total_row = mysql_fetch_array($total_data))
	{
		$total_total_distance = $total_total_distance+$total_row['session_distance'];
	}
	while($friend_total_row = mysql_fetch_array($friend_total_data))
	{
		$friend_total_total_distance = $friend_total_total_distance+$friend_total_row['session_distance'];
	}
	while($day_row = mysql_fetch_array($day_data))
	{
		$total_day_distance = $total_day_distance+$day_row['session_distance'];
	}
	while($week_row = mysql_fetch_array($week_data))
	{
		$total_week_distance = $total_week_distance+$week_row['session_distance'];
	}
	while($month_row = mysql_fetch_array($month_data))
	{
		$total_month_distance = $total_month_distance+$month_row['session_distance'];
	}

	$total_distance = $total_total_distance;
	$friend_total_distance = $friend_total_total_distance;
	$day_distance = $total_day_distance;
	$week_distance = $total_week_distance;
	$month_distance = $total_month_distance;

	while($user_total_distance_row = mysql_fetch_array($user_total_distance_data))
	{
		if($user_total_distance_row['user_total_distance']!=$total_distance);
		{
			$user_distance_add_query = "UPDATE user SET user_total_distance ='$total_distance' WHERE user_id = '$user_id'";
	        mysql_query($user_distance_add_query);
		}
	}
?>