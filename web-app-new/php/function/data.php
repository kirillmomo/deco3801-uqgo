<?php
	// include connect php file
	include('connect.php');
	session_start();

	//if user hasn't logged in, go back to login page
	if(empty($_SESSION['user_id'])){
		header('Location: /Beta/web-app-new/index.php');
	}

	// define variables for JS 
	echo "
		<script>
			var month_graph_step=[];
			var month_graph_distance=[];
			var month_graph_cal=[];

			var mon_step  = 0;
			var tue_step  = 0;
			var wed_step  = 0;
			var thu_step  = 0;
			var fri_step  = 0;
			var sat_step  = 0;
			var sun_step  = 0;

			var mon_distance  = 0;
			var tue_distance  = 0;
			var wed_distance  = 0;
			var thu_distance  = 0;
			var fri_distance  = 0;
			var sat_distance  = 0;
			var sun_distance  = 0;

			var mon_cal  = 0;
			var tue_cal  = 0;
			var wed_cal  = 0;
			var thu_cal  = 0;
			var fri_cal  = 0;
			var sat_cal  = 0;
			var sun_cal  = 0;
		</script>
	";

	// define variables for PHP
	$user_id = $_SESSION['user_id'];
	$user_name="";

	$month_graph_step_display=array();
	$month_graph_distance_display=array();
	$month_graph_cal_display=array();

	$total_step = 0;
	$total_distance = 0;
	$total_calories = 0;

	$mon_step_data = 0;
	$tue_step_data = 0;
	$wed_step_data = 0;
	$thu_step_data = 0;
	$fri_step_data = 0;
	$sat_step_data= 0;
	$sun_step_data= 0;

	$mon_distance_data = 0;
	$tue_distance_data = 0;
	$wed_distance_data = 0;
	$thu_distance_data = 0;
	$fri_distance_data = 0;
	$sat_distance_data= 0;
	$sun_distance_data= 0;

	$mon_cal_data = 0;
	$tue_cal_data = 0;
	$wed_cal_data = 0;
	$thu_cal_data = 0;
	$fri_cal_data = 0;
	$sat_cal_data= 0;
	$sun_cal_data= 0;

	$day_step = 0;
	$day_distance = 0;
	$day_calories = 0;

	$week_step = 0;
	$week_distance = 0;
	$week_calories = 0;

	$month_step = 0;
	$month_distance = 0;
	$month_calories = 0;

	$total_total_step = 0;
	$total_total_distance = 0;
	$total_total_calories = 0;

	$total_day_step = 0;
	$total_day_distance = 0;
	$total_day_calories = 0;

	$total_week_step = 0;
	$total_week_distance = 0;
	$total_week_calories = 0;

	$total_month_step = 0;
	$total_month_distance = 0;
	$total_month_calories = 0;

	// All SQL query
	$total_query = "SELECT * FROM session WHERE user_id = '$user_id'";
	$user_query = "SELECT * FROM user WHERE user_id = '$user_id'";
	$day_query = "SELECT * FROM session WHERE user_id = '$user_id' AND date = CURDATE()";
	$week_query = "SELECT * FROM session WHERE user_id = '$user_id' AND WEEK(date)= WEEK(NOW())";
	$month_query = "SELECT * FROM session WHERE user_id = '$user_id' AND MONTH(date)= MONTH(NOW())";	

	$total_data = mysql_query($total_query,$dbconn);
	$user_data = mysql_query($user_query,$dbconn);
	$day_data = mysql_query($day_query,$dbconn);
	$week_data = mysql_query($week_query,$dbconn);
	$month_data = mysql_query($month_query,$dbconn);
	$week_graph_step_data = mysql_query($week_query,$dbconn);
	$week_graph_distance_data = mysql_query($week_query,$dbconn);

	// Store the user data into array
	while($user_row = mysql_fetch_array($user_data))
		{
			$user_name = $user_row['username'];
		}

	// Store user week step data into array 
	while($week_graph_step_row = mysql_fetch_array($week_graph_step_data))
		{
			$date=date("D", strtotime($week_graph_step_row['date']));
			if($date=="Mon")
				{
					$mon_step_data = $mon_step_data + $week_graph_step_row['steps'];
				}
			else if ($date=="Tue") 
				{
					$tue_step_data = $tue_step_data + $week_graph_step_row['steps'];
				}
			else if ($date=="Wed") 
				{
					$wed_step_data = $wed_step_data + $week_graph_step_row['steps'];
				}
			else if ($date=="Thu") 
				{
					$thu_step_data = $thu_step_data + $week_graph_step_row['steps'];
				}
			else if ($date=="Fri") 
				{
					$fri_step_data = $fri_step_data + $week_graph_step_row['steps'];
				}
			else if ($date=="Sat") 
				{
					$sat_step_data = $sat_step_data + $week_graph_step_row['steps'];
				}
			else if ($date=="Sun") 
				{
					$sun_step_data = $sun_step_data + $week_graph_step_row['steps'];
				}
		}
	// Store user week data into js array
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
		
	// Store user week step data into array 	
	while($week_graph_distance_row = mysql_fetch_array($week_graph_distance_data))
	{
		$date=date("D", strtotime($week_graph_distance_row['date']));
		if($date=="Mon")
			{
				$mon_distance_data = $mon_distance_data + $week_graph_distance_row['distance'];
			}
		else if ($date=="Tue") 
			{
				$tue_distance_data = $tue_distance_data + $week_graph_distance_row['distance'];
			}
		else if ($date=="Wed") 
			{
				$wed_distance_data = $wed_distance_data + $week_graph_distance_row['distance'];
			}
		else if ($date=="Thu") 
			{
				$thu_distance_data = $thu_distance_data + $week_graph_distance_row['distance'];
			}
		else if ($date=="Fri") 
			{
				$fri_distance_data = $fri_distance_data + $week_graph_distance_row['distance'];
			}
		else if ($date=="Sat") 
			{
				$sat_distance_data = $sat_distance_data + $week_graph_distance_row['distance'];
			}
		else if ($date=="Sun") 
			{
				$sun_distance_data = $sun_distance_data + $week_graph_distance_row['distance'];
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

	
	$mon_cal_data = $mon_step_data / 20;
	$tue_cal_data = $tue_step_data / 20;
	$wed_cal_data = $wed_step_data / 20;
	$thu_cal_data = $thu_step_data / 20;
	$fri_cal_data = $fri_step_data / 20;
	$sat_cal_data = $sat_step_data / 20;
	$sun_cal_data = $sun_step_data / 20;

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

	for ($x = 0; $x <= 11; $x++) 
	{
    $month_graph_step_query = "SELECT * FROM session WHERE user_id = '$user_id' AND MONTH(date)=".$x."+1";
    $month_graph_step_data = mysql_query($month_graph_step_query,$dbconn);
    $month_graph_distance_data = mysql_query($month_graph_step_query,$dbconn);
    $month_graph_step_display[$x] = 0;
    $month_graph_distance_display[$x] = 0;
    $month_graph_cal_display[$x] = 0;
    	
	    while($month_graph_step_row = mysql_fetch_array($month_graph_step_data))
		{
			$month_graph_step_display[$x] = $month_graph_step_display[$x]+$month_graph_step_row['steps'];
		}

		while($month_graph_distance_row = mysql_fetch_array($month_graph_distance_data))
		{
			$month_graph_distance_display[$x] = $month_graph_distance_display[$x]+$month_graph_distance_row['distance'];
		}

		$month_graph_cal_display[$x] = $month_graph_step_display[$x]/20;

	echo "
			<script>
				month_graph_step[".json_encode($x)."] = ".json_encode($month_graph_step_display[$x]).";
				month_graph_distance[".json_encode($x)."] = ".json_encode($month_graph_distance_display[$x]).";
				month_graph_cal[".json_encode($x)."] = ".json_encode($month_graph_cal_display[$x]).";
			</script>
		";

	}

	while($total_row = mysql_fetch_array($total_data))
	{
		$total_total_step = $total_total_step+$total_row['steps'];
		$total_total_distance = $total_total_distance+$total_row['distance'];
	}
	while($day_row = mysql_fetch_array($day_data))
	{
		$total_day_step = $total_day_step+$day_row['steps'];
		$total_day_distance = $total_day_distance+$day_row['distance'];
	}
	while($week_row = mysql_fetch_array($week_data))
	{
		$total_week_step = $total_week_step+$week_row['steps'];
		$total_week_distance = $total_week_distance+$week_row['distance'];
	}
	while($month_row = mysql_fetch_array($month_data))
	{
		$total_month_step = $total_month_step+$month_row['steps'];
		$total_month_distance = $total_month_distance+$month_row['distance'];
	}

	$total_step = $total_total_step;
	$total_distance = $total_total_distance;
	$total_calories = $total_step/20;
	$day_step = $total_day_step;
	$day_distance = $total_day_distance;
	$day_calories = $day_step/20;
	$week_step = $total_week_step;
	$week_distance = $total_week_distance;
	$week_calories = $week_step/20;
	$month_step = $total_month_step;
	$month_distance = $total_month_distance;
	$month_calories = $month_step/20;
?>