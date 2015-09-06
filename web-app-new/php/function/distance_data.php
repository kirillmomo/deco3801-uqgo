<?php
	include('connect.php');

	//if user hasn't logged in, go back to login page
	if(empty($_SESSION['user_id'])){
		header('Location: /Beta/web-app-new/index.php');
	}

	echo "
		<script>
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
	$user_name="";

	$month_graph_distance_display=array();

	$total_distance = 0;

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

	$total_day_distance = 0;

	$total_week_distance = 0;

	$total_month_distance = 0;

	$total_query = "SELECT * FROM session WHERE user_id = '$user_id'";
	$day_query = "SELECT * FROM session WHERE user_id = '$user_id' AND date = CURDATE()";
	$week_query = "SELECT * FROM session WHERE user_id = '$user_id' AND WEEK(date)= WEEK(NOW())";
	$month_query = "SELECT * FROM session WHERE user_id = '$user_id' AND MONTH(date)= MONTH(NOW())";	

	$total_data = mysql_query($total_query,$dbconn);
	$day_data = mysql_query($day_query,$dbconn);
	$week_data = mysql_query($week_query,$dbconn);
	$month_data = mysql_query($month_query,$dbconn);
	$week_graph_distance_data = mysql_query($week_query,$dbconn);

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

	for ($x = 0; $x <= 11; $x++) 
	{
    $month_graph_distance_query = "SELECT * FROM session WHERE user_id = '$user_id' AND MONTH(date)=".$x."+1";
    $month_graph_distance_data = mysql_query($month_graph_distance_query,$dbconn);
    $month_graph_distance_display[$x] = 0;

		while($month_graph_distance_row = mysql_fetch_array($month_graph_distance_data))
		{
			$month_graph_distance_display[$x] = $month_graph_distance_display[$x]+$month_graph_distance_row['distance'];
		}

	echo "
			<script>
				month_graph_distance[".json_encode($x)."] = ".json_encode($month_graph_distance_display[$x]).";
			</script>
		";

	}

	while($total_row = mysql_fetch_array($total_data))
	{
		$total_total_distance = $total_total_distance+$total_row['distance'];
	}
	while($day_row = mysql_fetch_array($day_data))
	{
		$total_day_distance = $total_day_distance+$day_row['distance'];
	}
	while($week_row = mysql_fetch_array($week_data))
	{
		$total_week_distance = $total_week_distance+$week_row['distance'];
	}
	while($month_row = mysql_fetch_array($month_data))
	{
		$total_month_distance = $total_month_distance+$month_row['distance'];
	}

	$total_distance = $total_total_distance;
	$day_distance = $total_day_distance;
	$week_distance = $total_week_distance;
	$month_distance = $total_month_distance;
?>