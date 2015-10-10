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

			var friend_hour_graph_distance=[];
			var friend_month_graph_distance=[];

			var friend_mon_distance  = 0;
			var friend_tue_distance  = 0;
			var friend_wed_distance  = 0;
			var friend_thu_distance  = 0;
			var friend_fri_distance  = 0;
			var friend_sat_distance  = 0;
			var friend_sun_distance  = 0;
		</script>
	";

	$user_id = $_SESSION['user_id'];
	$user_friend_id = $_SESSION['friend_id'];
	$user_name="";
	
	$hour_graph_distance_display=array();
	$month_graph_distance_display=array();
	$friend_hour_graph_distance_display=array();
	$friend_month_graph_distance_display=array();

	$total_distance = 0;
	$friend_total_distance = 0;

	$mon_distance_data = 0;
	$tue_distance_data = 0;
	$wed_distance_data = 0;
	$thu_distance_data = 0;
	$fri_distance_data = 0;
	$sat_distance_data= 0;
	$sun_distance_data= 0;

	$friend_mon_distance_data = 0;
	$friend_tue_distance_data = 0;
	$friend_wed_distance_data = 0;
	$friend_thu_distance_data = 0;
	$friend_fri_distance_data = 0;
	$friend_sat_distance_data= 0;
	$friend_sun_distance_data= 0;

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
	$friend_hour_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id' AND DATE(session_date) = DATE(NOW()) AND HOUR(session_date)";
	$friend_week_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id' AND WEEK(session_date)= WEEK(NOW())";

	$total_data = mysql_query($total_query,$dbconn);
	$friend_total_data = mysql_query($friend_total_query,$dbconn);
	$hour_data = mysql_query($hour_query,$dbconn);
	$day_data = mysql_query($day_query,$dbconn);
	$week_data = mysql_query($week_query,$dbconn);
	$month_data = mysql_query($month_query,$dbconn);
	$week_graph_distance_data = mysql_query($week_query,$dbconn);
	$user_total_distance_data = mysql_query($user_total_distance_query,$dbconn);
	$friend_hour_data = mysql_query($friend_hour_query,$dbconn);
	$friend_week_data = mysql_query($friend_week_query,$dbconn);

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


	// Store and calculate friend total distance into array 	
	    while($friend_hour_graph_distance_row = mysql_fetch_array($friend_hour_data))
		{
		
			$time=date("H", strtotime($friend_hour_graph_distance_row['session_date']));

			if($time=="00")
				{
					$friend_hour_graph_distance_display[0] = $friend_hour_graph_distance_display[0] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="01") 
				{
					$friend_hour_graph_distance_display[1] = $friend_hour_graph_distance_display[1] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="02") 
				{
					$friend_hour_graph_distance_display[2] = $friend_hour_graph_distance_display[2] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="03") 
				{
					$friend_hour_graph_distance_display[3] = $friend_hour_graph_distance_display[3] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="04") 
				{
					$friend_hour_graph_distance_display[4] = $friend_hour_graph_distance_display[4] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="05") 
				{
					$friend_hour_graph_distance_display[5] = $friend_hour_graph_distance_display[5] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="06") 
				{
					$friend_hour_graph_distance_display[6] = $friend_hour_graph_distance_display[6] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="07") 
				{
					$friend_hour_graph_distance_display[7] = $friend_hour_graph_distance_display[7] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="08") 
				{
					$friend_hour_graph_distance_display[8] = $friend_hour_graph_distance_display[8] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="09") 
				{
					$friend_hour_graph_distance_display[9] = $friend_hour_graph_distance_display[9] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="10") 
				{
					$friend_hour_graph_distance_display[10] = $friend_hour_graph_distance_display[10] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="11") 
				{
					$friend_hour_graph_distance_display[11] = $friend_hour_graph_distance_display[11] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="12") 
				{
					$friend_hour_graph_distance_display[12] = $friend_hour_graph_distance_display[12] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="13") 
				{
					$friend_hour_graph_distance_display[13] = $friend_hour_graph_distance_display[13] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="14") 
				{
					$friend_hour_graph_distance_display[14] = $friend_hour_graph_distance_display[14] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="15") 
				{
					$friend_hour_graph_distance_display[15] = $friend_hour_graph_distance_display[15] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="16") 
				{
					$friend_hour_graph_distance_display[16] = $friend_hour_graph_distance_display[16] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="17") 
				{
					$friend_hour_graph_distance_display[17] = $friend_hour_graph_distance_display[17] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="18") 
				{
					$friend_hour_graph_distance_display[18] = $friend_hour_graph_distance_display[18] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="19") 
				{
					$friend_hour_graph_distance_display[19] = $friend_hour_graph_distance_display[19] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="20") 
				{
					$friend_hour_graph_distance_display[20] = $friend_hour_graph_distance_display[20] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="21") 
				{
					$friend_hour_graph_distance_display[21] = $friend_hour_graph_distance_display[21] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="22") 
				{
					$friend_hour_graph_distance_display[22] = $friend_hour_graph_distance_display[22] + $friend_hour_graph_distance_row['session_distance'];
				}
			else if ($time=="23") 
				{
					$friend_hour_graph_distance_display[23] = $friend_hour_graph_distance_display[23] + $friend_hour_graph_distance_row['session_distance'];
				}

		}

	// Store hour distance data into js array
	for($f=0; $f<=23; $f++)
	{	
	echo "
			<script>
				friend_hour_graph_distance[".json_encode($f)."] = ".json_encode($friend_hour_graph_distance_display[$f]).";
			</script>
		";
	}

	while($friend_week_graph_distance_row = mysql_fetch_array($friend_week_data))
	{
		$date=date("D", strtotime($friend_week_graph_distance_row['session_date']));
		if($date=="Mon")
			{
				$friend_mon_distance_data = $friend_mon_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
		else if ($date=="Tue") 
			{
				$friend_tue_distance_data = $friend_tue_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
		else if ($date=="Wed") 
			{
				$friend_wed_distance_data = $friend_wed_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
		else if ($date=="Thu") 
			{
				$friend_thu_distance_data = $friend_thu_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
		else if ($date=="Fri") 
			{
				$friend_fri_distance_data = $friend_fri_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
		else if ($date=="Sat") 
			{
				$friend_sat_distance_data = $friend_sat_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
		else if ($date=="Sun") 
			{
				$friend_sun_distance_data = $friend_sun_distance_data + $friend_week_graph_distance_row['session_distance'];
			}
	}

	echo "
		<script>
			friend_mon_distance = ".json_encode($friend_mon_distance_data).";
			friend_tue_distance = ".json_encode($friend_tue_distance_data).";
			friend_wed_distance = ".json_encode($friend_wed_distance_data).";
			friend_thu_distance = ".json_encode($friend_thu_distance_data).";
			friend_fri_distance = ".json_encode($friend_fri_distance_data).";
			friend_sat_distance = ".json_encode($friend_sat_distance_data).";
			friend_sun_distance = ".json_encode($friend_sun_distance_data).";
		</script>
	";

	for ($b = 0; $b <= 11; $b++) 
	{
    $friend_month_graph_distance_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id' AND MONTH(session_date)=".$b."+1";
    $friend_month_graph_distance_data = mysql_query($friend_month_graph_distance_query,$dbconn);
    $friend_month_graph_distance_display[$b] = 0;

		while($friend_month_graph_distance_row = mysql_fetch_array($friend_month_graph_distance_data))
		{
			$friend_month_graph_distance_display[$b] = $friend_month_graph_distance_display[$b]+$friend_month_graph_distance_row['session_distance'];
		}

	echo "
			<script>
				friend_month_graph_distance[".json_encode($b)."] = ".json_encode($friend_month_graph_distance_display[$b]).";
			</script>
		";

	}









	while($user_total_distance_row = mysql_fetch_array($user_total_distance_data))
	{
		if($user_total_distance_row['user_total_distance']!=$total_distance);
		{
			$user_distance_add_query = "UPDATE user SET user_total_distance ='$total_distance' WHERE user_id = '$user_id'";
	        mysql_query($user_distance_add_query);
		}
	}
?>