<?php
	// include connect php file
	include('connect.php');

	// define variables for JS 
	echo "
		<script>
			var month_graph_step=[];
			var month_graph_cal=[];
			var hour_graph_step=[];
			var hour_graph_cal=[];

			var mon_step  = 0;
			var tue_step  = 0;
			var wed_step  = 0;
			var thu_step  = 0;
			var fri_step  = 0;
			var sat_step  = 0;
			var sun_step  = 0;

			var mon_cal  = 0;
			var tue_cal  = 0;
			var wed_cal  = 0;
			var thu_cal  = 0;
			var fri_cal  = 0;
			var sat_cal  = 0;
			var sun_cal  = 0;

			var friend_month_graph_step=[];
			var friend_month_graph_cal=[];
			var friend_hour_graph_step=[];
			var friend_hour_graph_cal=[];

			var friend_mon_step  = 0;
			var friend_tue_step  = 0;
			var friend_wed_step  = 0;
			var friend_thu_step  = 0;
			var friend_fri_step  = 0;
			var friend_sat_step  = 0;
			var friend_sun_step  = 0;

			var friend_mon_cal  = 0;
			var friend_tue_cal  = 0;
			var friend_wed_cal  = 0;
			var friend_thu_cal  = 0;
			var friend_fri_cal  = 0;
			var friend_sat_cal  = 0;
			var friend_sun_cal  = 0;
		</script>
	";

	// define variables for PHP
	$user_id = $_SESSION['user_id'];
	$user_friend_id = $_SESSION['friend_id'];
	$user_name="";

	$month_graph_step_display=array();
	$month_graph_cal_display=array();
	$hour_graph_step_display=array();
	$hour_graph_cal_display=array();
	$friend_month_graph_step_display=array();
	$friend_month_graph_cal_display=array();
	$friend_hour_graph_step_display=array();
	$friend_hour_graph_cal_display=array();

	$total_step = 0;
	$total_calories = 0;
	$friend_total_step = 0;
	$friend_total_calories = 0;

	$mon_step_data = 0;
	$tue_step_data = 0;
	$wed_step_data = 0;
	$thu_step_data = 0;
	$fri_step_data = 0;
	$sat_step_data= 0;
	$sun_step_data= 0;

	$mon_cal_data = 0;
	$tue_cal_data = 0;
	$wed_cal_data = 0;
	$thu_cal_data = 0;
	$fri_cal_data = 0;
	$sat_cal_data= 0;
	$sun_cal_data= 0;

	$friend_mon_step_data = 0;
	$friend_tue_step_data = 0;
	$friend_wed_step_data = 0;
	$friend_thu_step_data = 0;
	$friend_fri_step_data = 0;
	$friend_sat_step_data= 0;
	$friend_sun_step_data= 0;

	$friend_mon_cal_data = 0;
	$friend_tue_cal_data = 0;
	$friend_wed_cal_data = 0;
	$friend_thu_cal_data = 0;
	$friend_fri_cal_data = 0;
	$friend_sat_cal_data= 0;
	$friend_sun_cal_data= 0;

	$day_step = 0;
	$day_calories = 0;

	$week_step = 0;
	$week_calories = 0;

	$month_step = 0;
	$month_calories = 0;

	$total_total_step = 0;
	$total_total_calories = 0;
	$friend_total_total_step = 0;
	$friend_total_total_calories = 0;

	$total_day_step = 0;
	$total_day_calories = 0;

	$total_week_step = 0;
	$total_week_calories = 0;

	$total_month_step = 0;
	$total_month_calories = 0;

	// Data SQL query
	$user_total_query = "SELECT * FROM user WHERE user_id = '$user_id'";
	$total_query = "SELECT * FROM session WHERE session_user_id = '$user_id'";
	$friend_total_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id'";
	$hour_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND DATE(session_date) = DATE(NOW()) AND HOUR(session_date)";
	$day_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND DATE(session_date) = DATE(NOW())";
	$week_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND WEEK(session_date)= WEEK(NOW())";
	$month_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND MONTH(session_date)= MONTH(NOW())";
	$friend_hour_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id' AND DATE(session_date) = DATE(NOW()) AND HOUR(session_date)";
	$friend_week_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id' AND WEEK(session_date)= WEEK(NOW())";

	$user_total_data = mysql_query($user_total_query,$dbconn);
    $hour_data = mysql_query($hour_query,$dbconn);
	$total_data = mysql_query($total_query,$dbconn);
	$friend_total_data = mysql_query($friend_total_query,$dbconn);
	$day_data = mysql_query($day_query,$dbconn);
	$week_data = mysql_query($week_query,$dbconn);
	$month_data = mysql_query($month_query,$dbconn);
	$week_graph_step_data = mysql_query($week_query,$dbconn);
	$friend_hour_data = mysql_query($friend_hour_query,$dbconn);
	$friend_week_data = mysql_query($friend_week_query,$dbconn);

	// Store and calculate total hours step and cal into array 	
	    while($hour_graph_step_row = mysql_fetch_array($hour_data))
		{
			$time=date("H", strtotime($hour_graph_step_row['session_date']));

			if($time=="00")
				{
					$hour_graph_step_display[0] = $hour_graph_step_display[0] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[0] = $hour_graph_step_display[0]/20;
				}
			else if ($time=="01") 
				{
					$hour_graph_step_display[1] = $hour_graph_step_display[1] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[1] = $hour_graph_step_display[1]/20;
				}
			else if ($time=="02") 
				{
					$hour_graph_step_display[2] = $hour_graph_step_display[2] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[2] = $hour_graph_step_display[2]/20;
				}
			else if ($time=="03") 
				{
					$hour_graph_step_display[3] = $hour_graph_step_display[3] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[3] = $hour_graph_step_display[3]/20;
				}
			else if ($time=="04") 
				{
					$hour_graph_step_display[4] = $hour_graph_step_display[4] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[4] = $hour_graph_step_display[4]/20;
				}
			else if ($time=="05") 
				{
					$hour_graph_step_display[5] = $hour_graph_step_display[5] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[5] = $hour_graph_step_display[5]/20;
				}
			else if ($time=="06") 
				{
					$hour_graph_step_display[6] = $hour_graph_step_display[6] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[6] = $hour_graph_step_display[6]/20;
				}
			else if ($time=="07") 
				{
					$hour_graph_step_display[7] = $hour_graph_step_display[7] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[7] = $hour_graph_step_display[7]/20;
				}
			else if ($time=="08") 
				{
					$hour_graph_step_display[8] = $hour_graph_step_display[8] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[8] = $hour_graph_step_display[8]/20;
				}
			else if ($time=="09") 
				{
					$hour_graph_step_display[9] = $hour_graph_step_display[9] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[9] = $hour_graph_step_display[9]/20;
				}
			else if ($time=="10") 
				{
					$hour_graph_step_display[10] = $hour_graph_step_display[10] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[10] = $hour_graph_step_display[10]/20;
				}
			else if ($time=="11") 
				{
					$hour_graph_step_display[11] = $hour_graph_step_display[11] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[11] = $hour_graph_step_display[11]/20;
				}
			else if ($time=="12") 
				{
					$hour_graph_step_display[12] = $hour_graph_step_display[12] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[12] = $hour_graph_step_display[12]/20;
				}
			else if ($time=="13") 
				{
					$hour_graph_step_display[13] = $hour_graph_step_display[13] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[13] = $hour_graph_step_display[13]/20;
				}
			else if ($time=="14") 
				{
					$hour_graph_step_display[14] = $hour_graph_step_display[14] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[14] = $hour_graph_step_display[14]/20;
				}
			else if ($time=="15") 
				{
					$hour_graph_step_display[15] = $hour_graph_step_display[15] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[15] = $hour_graph_step_display[15]/20;
				}
			else if ($time=="16") 
				{
					$hour_graph_step_display[16] = $hour_graph_step_display[16] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[16] = $hour_graph_step_display[16]/20;
				}
			else if ($time=="17") 
				{
					$hour_graph_step_display[17] = $hour_graph_step_display[17] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[17] = $hour_graph_step_display[17]/20;
				}
			else if ($time=="18") 
				{
					$hour_graph_step_display[18] = $hour_graph_step_display[18] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[18] = $hour_graph_step_display[18]/20;
				}
			else if ($time=="19") 
				{
					$hour_graph_step_display[19] = $hour_graph_step_display[19] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[19] = $hour_graph_step_display[19]/20;
				}
			else if ($time=="20") 
				{
					$hour_graph_step_display[20] = $hour_graph_step_display[20] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[20] = $hour_graph_step_display[20]/20;
				}
			else if ($time=="21") 
				{
					$hour_graph_step_display[21] = $hour_graph_step_display[21] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[21] = $hour_graph_step_display[21]/20;
				}
			else if ($time=="22") 
				{
					$hour_graph_step_display[22] = $hour_graph_step_display[22] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[22] = $hour_graph_step_display[22]/20;
				}
			else if ($time=="23") 
				{
					$hour_graph_step_display[23] = $hour_graph_step_display[23] + $hour_graph_step_row['session_steps'];
					$hour_graph_cal_display[23] = $hour_graph_step_display[23]/20;
				}

		}

	// Store hour step and cal data into js array
	for($h=0; $h<=23; $h++)
	{	
	echo "
			<script>
				hour_graph_step[".json_encode($h)."] = ".json_encode($hour_graph_step_display[$h]).";
				hour_graph_cal[".json_encode($h)."] = ".json_encode($hour_graph_cal_display[$h]).";
			</script>
		";
	}
	

	// Store and calculate user week step data into array 
	while($week_graph_step_row = mysql_fetch_array($week_graph_step_data))
		{
			$date=date("D", strtotime($week_graph_step_row['session_date']));
			if($date=="Mon")
				{
					$mon_step_data = $mon_step_data + $week_graph_step_row['session_steps'];
				}
			else if ($date=="Tue") 
				{
					$tue_step_data = $tue_step_data + $week_graph_step_row['session_steps'];
				}
			else if ($date=="Wed") 
				{
					$wed_step_data = $wed_step_data + $week_graph_step_row['session_steps'];
				}
			else if ($date=="Thu") 
				{
					$thu_step_data = $thu_step_data + $week_graph_step_row['session_steps'];
				}
			else if ($date=="Fri") 
				{
					$fri_step_data = $fri_step_data + $week_graph_step_row['session_steps'];
				}
			else if ($date=="Sat") 
				{
					$sat_step_data = $sat_step_data + $week_graph_step_row['session_steps'];
				}
			else if ($date=="Sun") 
				{
					$sun_step_data = $sun_step_data + $week_graph_step_row['session_steps'];
				}
		}

	// Store user week data into js variable
	echo "
			<script>
				mon_step = ".json_encode($mon_step_data).";
				tue_step = ".json_encode($tue_step_data).";
				wed_step = ".json_encode($wed_step_data).";
				thu_step = ".json_encode($thu_step_data).";
				fri_step = ".json_encode($fri_step_data).";
				sat_step = ".json_encode($sat_step_data).";
				sun_step = ".json_encode($sun_step_data).";
			</script>
		";

	// Calculate cal and store week cal data into variable
	$mon_cal_data = $mon_step_data / 20;
	$tue_cal_data = $tue_step_data / 20;
	$wed_cal_data = $wed_step_data / 20;
	$thu_cal_data = $thu_step_data / 20;
	$fri_cal_data = $fri_step_data / 20;
	$sat_cal_data = $sat_step_data / 20;
	$sun_cal_data = $sun_step_data / 20;

	// Calculate cal and store data into JS variable
	echo "
		<script>
			mon_cal = ".json_encode($mon_cal_data).";
			tue_cal = ".json_encode($tue_cal_data).";
			wed_cal = ".json_encode($wed_cal_data).";
			thu_cal = ".json_encode($thu_cal_data).";
			fri_cal = ".json_encode($fri_cal_data).";
			sat_cal = ".json_encode($sat_cal_data).";
			sun_cal = ".json_encode($sun_cal_data).";
		</script>
	";	

	// Define month range and SQL query
	for ($x = 0; $x <= 11; $x++) 
	{
    $month_graph_step_query = "SELECT * FROM session WHERE session_user_id = '$user_id' AND MONTH(session_date)=".$x."+1";
    $month_graph_step_data = mysql_query($month_graph_step_query,$dbconn);
    $month_graph_step_display[$x] = 0;
    $month_graph_cal_display[$x] = 0;
    	
    // Store and calculate total monthly step and cal into array 	
	    while($month_graph_step_row = mysql_fetch_array($month_graph_step_data))
		{
			$month_graph_step_display[$x] = $month_graph_step_display[$x]+$month_graph_step_row['session_steps'];
		}

		$month_graph_cal_display[$x] = $month_graph_step_display[$x]/20;

	// Store month step and cal data into js array	
	echo "
			<script>
				month_graph_step[".json_encode($x)."] = ".json_encode($month_graph_step_display[$x]).";
				month_graph_cal[".json_encode($x)."] = ".json_encode($month_graph_cal_display[$x]).";
			</script>
		";

	}

	// Calculate all the data and store into variable
	while($total_row = mysql_fetch_array($total_data))
	{
		$total_total_step = $total_total_step+$total_row['session_steps'];
	}
	while($friend_total_row = mysql_fetch_array($friend_total_data))
	{
		$friend_total_total_step = $friend_total_total_step+$friend_total_row['session_steps'];
	}
	while($day_row = mysql_fetch_array($day_data))
	{
		$total_day_step = $total_day_step+$day_row['session_steps'];
	}
	while($week_row = mysql_fetch_array($week_data))
	{
		$total_week_step = $total_week_step+$week_row['session_steps'];
	}
	while($month_row = mysql_fetch_array($month_data))
	{
		$total_month_step = $total_month_step+$month_row['session_steps'];
	}

	// Store the data into variable for display 
	$total_step = $total_total_step;
	$total_calories = $total_step/20;
	$friend_total_step = $friend_total_total_step;
	$friend_total_calories = $friend_total_step/20;
	$day_step = $total_day_step;
	$day_calories = $day_step/20;
	$week_step = $total_week_step;
	$week_calories = $week_step/20;
	$month_step = $total_month_step;
	$month_calories = $month_step/20;

	// Store and calculate friend hours step and cal into array 	
	    while($friend_hour_graph_step_row = mysql_fetch_array($friend_hour_data))
		{
			$time=date("H", strtotime($friend_hour_graph_step_row['session_date']));

			if($time=="00")
				{
					$friend_hour_graph_step_display[0] = $friend_hour_graph_step_display[0] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[0] = $friend_hour_graph_step_display[0]/20;
				}
			else if ($time=="01") 
				{
					$friend_hour_graph_step_display[1] = $friend_hour_graph_step_display[1] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[1] = $friend_hour_graph_step_display[1]/20;
				}
			else if ($time=="02") 
				{
					$friend_hour_graph_step_display[2] = $friend_hour_graph_step_display[2] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[2] = $friend_hour_graph_step_display[2]/20;
				}
			else if ($time=="03") 
				{
					$friend_hour_graph_step_display[3] = $friend_hour_graph_step_display[3] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[3] = $friend_hour_graph_step_display[3]/20;
				}
			else if ($time=="04") 
				{
					$friend_hour_graph_step_display[4] = $friend_hour_graph_step_display[4] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[4] = $friend_hour_graph_step_display[4]/20;
				}
			else if ($time=="05") 
				{
					$friend_hour_graph_step_display[5] = $friend_hour_graph_step_display[5] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[5] = $friend_hour_graph_step_display[5]/20;
				}
			else if ($time=="06") 
				{
					$friend_hour_graph_step_display[6] = $friend_hour_graph_step_display[6] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[6] = $friend_hour_graph_step_display[6]/20;
				}
			else if ($time=="07") 
				{
					$friend_hour_graph_step_display[7] = $friend_hour_graph_step_display[7] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[7] = $friend_hour_graph_step_display[7]/20;
				}
			else if ($time=="08") 
				{
					$friend_hour_graph_step_display[8] = $friend_hour_graph_step_display[8] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[8] = $friend_hour_graph_step_display[8]/20;
				}
			else if ($time=="09") 
				{
					$friend_hour_graph_step_display[9] = $friend_hour_graph_step_display[9] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[9] = $friend_hour_graph_step_display[9]/20;
				}
			else if ($time=="10") 
				{
					$friend_hour_graph_step_display[10] = $friend_hour_graph_step_display[10] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[10] = $friend_hour_graph_step_display[10]/20;
				}
			else if ($time=="11") 
				{
					$friend_hour_graph_step_display[11] = $friend_hour_graph_step_display[11] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[11] = $friend_hour_graph_step_display[11]/20;
				}
			else if ($time=="12") 
				{
					$friend_hour_graph_step_display[12] = $friend_hour_graph_step_display[12] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[12] = $friend_hour_graph_step_display[12]/20;
				}
			else if ($time=="13") 
				{
					$friend_hour_graph_step_display[13] = $friend_hour_graph_step_display[13] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[13] = $friend_hour_graph_step_display[13]/20;
				}
			else if ($time=="14") 
				{
					$friend_hour_graph_step_display[14] = $friend_hour_graph_step_display[14] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[14] = $friend_hour_graph_step_display[14]/20;
				}
			else if ($time=="15") 
				{
					$friend_hour_graph_step_display[15] = $friend_hour_graph_step_display[15] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[15] = $friend_hour_graph_step_display[15]/20;
				}
			else if ($time=="16") 
				{
					$friend_hour_graph_step_display[16] = $friend_hour_graph_step_display[16] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[16] = $friend_hour_graph_step_display[16]/20;
				}
			else if ($time=="17") 
				{
					$friend_hour_graph_step_display[17] = $friend_hour_graph_step_display[17] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[17] = $friend_hour_graph_step_display[17]/20;
				}
			else if ($time=="18") 
				{
					$friend_hour_graph_step_display[18] = $friend_hour_graph_step_display[18] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[18] = $friend_hour_graph_step_display[18]/20;
				}
			else if ($time=="19") 
				{
					$friend_hour_graph_step_display[19] = $friend_hour_graph_step_display[19] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[19] = $friend_hour_graph_step_display[19]/20;
				}
			else if ($time=="20") 
				{
					$friend_hour_graph_step_display[20] = $friend_hour_graph_step_display[20] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[20] = $friend_hour_graph_step_display[20]/20;
				}
			else if ($time=="21") 
				{
					$friend_hour_graph_step_display[21] = $friend_hour_graph_step_display[21] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[21] = $friend_hour_graph_step_display[21]/20;
				}
			else if ($time=="22") 
				{
					$friend_hour_graph_step_display[22] = $friend_hour_graph_step_display[22] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[22] = $friend_hour_graph_step_display[22]/20;
				}
			else if ($time=="23") 
				{
					$friend_hour_graph_step_display[23] = $friend_hour_graph_step_display[23] + $friend_hour_graph_step_row['session_steps'];
					$friend_hour_graph_cal_display[23] = $friend_hour_graph_step_display[23]/20;
				}

		}

	// Store friend hour step and cal data into js array
	for($f=0; $f<=23; $f++)
	{	
	echo "
			<script>
				friend_hour_graph_step[".json_encode($f)."] = ".json_encode($friend_hour_graph_step_display[$f]).";
				friend_hour_graph_cal[".json_encode($f)."] = ".json_encode($friend_hour_graph_cal_display[$f]).";
			</script>
		";
	}

	// Store and calculate friend week step data into array 
	while($friend_week_graph_step_row = mysql_fetch_array($friend_week_data))
		{
			$date=date("D", strtotime($friend_week_graph_step_row['session_date']));
			if($date=="Mon")
				{
					$friend_mon_step_data = $friend_mon_step_data + $friend_week_graph_step_row['session_steps'];
				}
			else if ($date=="Tue") 
				{
					$friend_tue_step_data = $friend_tue_step_data + $friend_week_graph_step_row['session_steps'];
				}
			else if ($date=="Wed") 
				{
					$friend_wed_step_data = $friend_wed_step_data + $friend_week_graph_step_row['session_steps'];
				}
			else if ($date=="Thu") 
				{
					$friend_thu_step_data = $friend_thu_step_data + $friend_week_graph_step_row['session_steps'];
				}
			else if ($date=="Fri") 
				{
					$friend_fri_step_data = $friend_fri_step_data + $friend_week_graph_step_row['session_steps'];
				}
			else if ($date=="Sat") 
				{
					$friend_sat_step_data = $friend_sat_step_data + $friend_week_graph_step_row['session_steps'];
				}
			else if ($date=="Sun") 
				{
					$friend_sun_step_data = $friend_sun_step_data + $friend_week_graph_step_row['session_steps'];
				}
		}

	// Store friend week data into js variable
	echo "
			<script>
				friend_mon_step = ".json_encode($friend_mon_step_data).";
				friend_tue_step = ".json_encode($friend_tue_step_data).";
				friend_wed_step = ".json_encode($friend_wed_step_data).";
				friend_thu_step = ".json_encode($friend_thu_step_data).";
				friend_fri_step = ".json_encode($friend_fri_step_data).";
				friend_sat_step = ".json_encode($friend_sat_step_data).";
				friend_sun_step = ".json_encode($friend_sun_step_data).";
			</script>
		";

	// Calculate cal and store week cal data into variable
	$friend_mon_cal_data = $friend_mon_step_data / 20;
	$friend_tue_cal_data = $friend_tue_step_data / 20;
	$friend_wed_cal_data = $friend_wed_step_data / 20;
	$friend_thu_cal_data = $friend_thu_step_data / 20;
	$friend_fri_cal_data = $friend_fri_step_data / 20;
	$friend_sat_cal_data = $friend_sat_step_data / 20;
	$friend_sun_cal_data = $friend_sun_step_data / 20;

	// Calculate cal and store data into JS variable
	echo "
		<script>
			friend_mon_cal = ".json_encode($friend_mon_cal_data).";
			friend_tue_cal = ".json_encode($friend_tue_cal_data).";
			friend_wed_cal = ".json_encode($friend_wed_cal_data).";
			friend_thu_cal = ".json_encode($friend_thu_cal_data).";
			friend_fri_cal = ".json_encode($friend_fri_cal_data).";
			friend_sat_cal = ".json_encode($friend_sat_cal_data).";
			friend_sun_cal = ".json_encode($friend_sun_cal_data).";
		</script>
	";	

	// Define month range and SQL query
	for ($b = 0; $b <= 11; $b++) 
	{
    $friend_month_graph_step_query = "SELECT * FROM session WHERE session_user_id = '$user_friend_id' AND MONTH(session_date)=".$b."+1";
    $friend_month_graph_step_data = mysql_query($friend_month_graph_step_query,$dbconn);
    $friend_month_graph_step_display[$b] = 0;
    $friend_month_graph_cal_display[$b] = 0;
    	
    // Store and calculate friend total monthly step and cal into array 	
	    while($friend_month_graph_step_row = mysql_fetch_array($friend_month_graph_step_data))
		{
			$friend_month_graph_step_display[$b] = $friend_month_graph_step_display[$b]+$month_graph_step_row['session_steps'];
		}

		$friend_month_graph_cal_display[$b] = $friend_month_graph_step_display[$b]/20;

	// Store friend month step and cal data into js array	
	echo "
			<script>
				friend_month_graph_step[".json_encode($b)."] = ".json_encode($friend_month_graph_step_display[$b]).";
				friend_month_graph_cal[".json_encode($b)."] = ".json_encode($friend_month_graph_cal_display[$b]).";
			</script>
		";

	}

	while($user_total_row = mysql_fetch_array($user_total_data))
	{
		if($user_total_row['user_total_step']!=$total_step || $user_total_row['user_total_cal']!=$total_calories);
		{
			$user_add_query = "UPDATE user SET user_total_step ='$total_step', user_total_cal ='$total_calories' WHERE user_id = '$user_id'";
	        mysql_query($user_add_query);
		}
	}
?>

<script>
				// alert(<?php echo $user_friend_id; ?>);
</script>