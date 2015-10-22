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
	$total_query = "SELECT * FROM  user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_id'";
	$friend_total_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_friend_id'";
	$hour_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_id' AND DATE(session_date) = DATE(NOW())";
	$day_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_id' AND DATE(session_date) = DATE(NOW())";
	$week_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_id' AND WEEK(session_date)= WEEK(NOW())";
	$month_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_id' AND MONTH(session_date)= MONTH(NOW())";
	$friend_hour_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_friend_id' AND DATE(session_date) = DATE(NOW())";
	$friend_week_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_friend_id' AND WEEK(session_date)= WEEK(NOW())";

	$user_total_data = mysqli_query($dbconn, $user_total_query);
    $hour_data = mysqli_query($dbconn, $hour_query);
	$total_data = mysqli_query($dbconn, $total_query);
	$friend_total_data = mysqli_query($dbconn, $friend_total_query);
	$day_data = mysqli_query($dbconn, $day_query);
	$week_data = mysqli_query($dbconn, $week_query);
	$month_data = mysqli_query($dbconn, $month_query);
	$week_graph_step_data = mysqli_query($dbconn, $week_query);
	$friend_hour_data = mysqli_query($dbconn, $friend_hour_query);
	$friend_week_data = mysqli_query($dbconn, $friend_week_query);

	// Store and calculate total hours step and cal into array 	
	    while($hour_graph_step_row = mysqli_fetch_array($hour_data, MYSQLI_BOTH))
		{
			$time=date("H", strtotime($hour_graph_step_row['session_date']));

			if($time=="00")
				{
					$hour_graph_step_display[0] = $hour_graph_step_display[0] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[0] = $hour_graph_cal + $hour_graph_cal_display[0];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[0] = $hour_graph_cal + $hour_graph_cal_display[0];
					}
					
				}
			else if ($time=="01") 
				{
					$hour_graph_step_display[1] = $hour_graph_step_display[1] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[1] = $hour_graph_cal + $hour_graph_cal_display[1];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[1] = $hour_graph_cal + $hour_graph_cal_display[1];
					}
				}
			else if ($time=="02") 
				{
					$hour_graph_step_display[2] = $hour_graph_step_display[2] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[2] = $hour_graph_cal + $hour_graph_cal_display[2];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[2] = $hour_graph_cal + $hour_graph_cal_display[2];
					}
				}
			else if ($time=="03") 
				{
					$hour_graph_step_display[3] = $hour_graph_step_display[3] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[3] = $hour_graph_cal + $hour_graph_cal_display[3];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[3] = $hour_graph_cal + $hour_graph_cal_display[3];
					}
				}
			else if ($time=="04") 
				{
					$hour_graph_step_display[4] = $hour_graph_step_display[4] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[4] = $hour_graph_cal + $hour_graph_cal_display[4];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[4] = $hour_graph_cal + $hour_graph_cal_display[4];
					}
				}
			else if ($time=="05") 
				{
					$hour_graph_step_display[5] = $hour_graph_step_display[5] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[5] = $hour_graph_cal + $hour_graph_cal_display[5];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[5] = $hour_graph_cal + $hour_graph_cal_display[5];
					}
				}
			else if ($time=="06") 
				{
					$hour_graph_step_display[6] = $hour_graph_step_display[6] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[6] = $hour_graph_cal + $hour_graph_cal_display[6];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[6] = $hour_graph_cal + $hour_graph_cal_display[6];
					}
				}
			else if ($time=="07") 
				{
					$hour_graph_step_display[7] = $hour_graph_step_display[7] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[7] = $hour_graph_cal + $hour_graph_cal_display[7];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[7] = $hour_graph_cal + $hour_graph_cal_display[7];
					}
				}
			else if ($time=="08") 
				{
					$hour_graph_step_display[8] = $hour_graph_step_display[8] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[8] = $hour_graph_cal + $hour_graph_cal_display[8];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[8] = $hour_graph_cal + $hour_graph_cal_display[8];
					}
				}
			else if ($time=="09") 
				{
					$hour_graph_step_display[9] = $hour_graph_step_display[9] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[9] = $hour_graph_cal + $hour_graph_cal_display[9];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[9] = $hour_graph_cal + $hour_graph_cal_display[9];
					}
				}
			else if ($time=="10") 
				{
					$hour_graph_step_display[10] = $hour_graph_step_display[10] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[10] = $hour_graph_cal + $hour_graph_cal_display[10];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[10] = $hour_graph_cal + $hour_graph_cal_display[10];
					}
				}
			else if ($time=="11") 
				{
					$hour_graph_step_display[11] = $hour_graph_step_display[11] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[11] = $hour_graph_cal + $hour_graph_cal_display[11];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[11] = $hour_graph_cal + $hour_graph_cal_display[11];
					}
				}
			else if ($time=="12") 
				{
					$hour_graph_step_display[12] = $hour_graph_step_display[12] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[12] = $hour_graph_cal + $hour_graph_cal_display[12];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[12] = $hour_graph_cal + $hour_graph_cal_display[12];
					}
				}
			else if ($time=="13") 
				{
					$hour_graph_step_display[13] = $hour_graph_step_display[13] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[13] = $hour_graph_cal + $hour_graph_cal_display[13];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal_display[13] = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal_display[13] = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[13] = $hour_graph_cal + $hour_graph_cal_display[13];
					}
				}
			else if ($time=="14") 
				{
					$hour_graph_step_display[14] = $hour_graph_step_display[14] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[14] = $hour_graph_cal + $hour_graph_cal_display[14];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[14] = $hour_graph_cal + $hour_graph_cal_display[14];
					}
				}
			else if ($time=="15") 
				{
					$hour_graph_step_display[15] = $hour_graph_step_display[15] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[15] = $hour_graph_cal + $hour_graph_cal_display[15];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[15] = $hour_graph_cal + $hour_graph_cal_display[15];
					}
				}
			else if ($time=="16") 
				{
					$hour_graph_step_display[16] = $hour_graph_step_display[16] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[16] = $hour_graph_cal + $hour_graph_cal_display[16];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[16] = $hour_graph_cal + $hour_graph_cal_display[16];
					}
				}
			else if ($time=="17") 
				{
					$hour_graph_step_display[17] = $hour_graph_step_display[17] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[17] = $hour_graph_cal + $hour_graph_cal_display[17];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[17] = $hour_graph_cal + $hour_graph_cal_display[17];
					}
				}
			else if ($time=="18") 
				{
					$hour_graph_step_display[18] = $hour_graph_step_display[18] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[18] = $hour_graph_cal + $hour_graph_cal_display[18];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[18] = $hour_graph_cal + $hour_graph_cal_display[18];
					}
				}
			else if ($time=="19") 
				{
					$hour_graph_step_display[19] = $hour_graph_step_display[19] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[19] = $hour_graph_cal + $hour_graph_cal_display[19];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[19] = $hour_graph_cal + $hour_graph_cal_display[19];
					}
				}
			else if ($time=="20") 
				{
					$hour_graph_step_display[20] = $hour_graph_step_display[20] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[20] = $hour_graph_cal + $hour_graph_cal_display[20];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[20] = $hour_graph_cal + $hour_graph_cal_display[20];
					}
				}
			else if ($time=="21") 
				{
					$hour_graph_step_display[21] = $hour_graph_step_display[21] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[21] = $hour_graph_cal + $hour_graph_cal_display[21];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[21] = $hour_graph_cal + $hour_graph_cal_display[21];
					}
				}
			else if ($time=="22") 
				{
					$hour_graph_step_display[22] = $hour_graph_step_display[22] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[22] = $hour_graph_cal + $hour_graph_cal_display[22];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[22] = $hour_graph_cal + $hour_graph_cal_display[22];
					}
				}
			else if ($time=="23") 
				{
					$hour_graph_step_display[23] = $hour_graph_step_display[23] + $hour_graph_step_row['session_steps'];
					if($hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[23] = $hour_graph_cal + $hour_graph_cal_display[23];
					}
					else
					{
						$BMR = 655 + (13.75 * $hour_graph_step_row['user_weight']) + (5 * $hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$hour_graph_cal = round(($BMR/24)*$MET*($hour_graph_step_row['session_time_length']/3600));
=======
						$hour_graph_cal = round(($BMR/24)*$MET*$hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$hour_graph_cal_display[23] = $hour_graph_cal + $hour_graph_cal_display[23];
					}
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
	while($week_graph_step_row = mysqli_fetch_array($week_graph_step_data, MYSQLI_BOTH))
		{
			$date=date("D", strtotime($week_graph_step_row['session_date']));
			if($date=="Mon")
				{
					$mon_step_data = $mon_step_data + $week_graph_step_row['session_steps'];
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$mon_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$mon_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$mon_cal_data = $mon_cal + $mon_cal_data ;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$mon_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$mon_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$mon_cal_data = $mon_cal + $mon_cal_data ;
					}
				}
			else if ($date=="Tue") 
				{
					$tue_step_data = $tue_step_data + $week_graph_step_row['session_steps'];
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$tue_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$tue_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$tue_cal_data = $tue_cal + $tue_cal_data ;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$tue_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$tue_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$tue_cal_data = $tue_cal + $tue_cal_data ;
					}
				}
			else if ($date=="Wed") 
				{
					$wed_step_data = $wed_step_data + $week_graph_step_row['session_steps'];
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$wed_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$wed_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$wed_cal_data = $wed_cal + $wed_cal_data ;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$wed_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$wed_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$wed_cal_data = $wed_cal + $wed_cal_data ;
					}
				}
			else if ($date=="Thu") 
				{
					$thu_step_data = $thu_step_data + $week_graph_step_row['session_steps'];
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$thu_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$thu_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$thu_cal_data = $thu_cal + $thu_cal_data ;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$thu_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$thu_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$thu_cal_data = $thu_cal + $thu_cal_data ;
					}
				}
			else if ($date=="Fri") 
				{
					$fri_step_data = $fri_step_data + $week_graph_step_row['session_steps'];
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$fri_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$fri_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$fri_cal_data = $fri_cal + $fri_cal_data ;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$fri_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$fri_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$fri_cal_data = $fri_cal + $fri_cal_data ;
					}
				}
			else if ($date=="Sat") 
				{
					$sat_step_data = $sat_step_data + $week_graph_step_row['session_steps'];
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$sat_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$sat_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$sat_cal_data = $sat_cal + $sat_cal_data ;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$sat_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$sat_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$sat_cal_data = $sat_cal + $sat_cal_data ;
					}
				}
			else if ($date=="Sun") 
				{
					$sun_step_data = $sun_step_data + $week_graph_step_row['session_steps'];
					
					// Calculate cal and store week cal data into variable
					if($week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$sun_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$sun_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$sun_cal_data = $sun_cal_data + $sun_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $week_graph_step_row['user_weight']) + (5 * $week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$sun_cal = round(($BMR/24)*$MET*($week_graph_step_row['session_time_length']/3600));
=======
						$sun_cal = round(($BMR/24)*$MET*$week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$sun_cal_data = $sun_cal_data + $sun_cal;
					}
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
    $month_graph_step_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_id' AND MONTH(session_date)=".$x."+1";
    $month_graph_step_data = mysqli_query($dbconn, $month_graph_step_query);
    $month_graph_step_display[$x] = 0;
    $month_graph_cal_display[$x] = 0;
    	
    // Store and calculate total monthly step and cal into array 	
	    while($month_graph_step_row = mysqli_fetch_array($month_graph_step_data, MYSQLI_BOTH))
		{
			$month_graph_step_display[$x] = $month_graph_step_display[$x]+$month_graph_step_row['session_steps'];

			// Calculate cal and store week cal data into variable
			if($month_graph_step_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $month_graph_step_row['user_weight']) + (5 * $month_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($month_graph_step_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$month_graph_cal = round(($BMR/24)*$MET*($month_graph_step_row['session_time_length']/3600));
=======
				$month_graph_cal = round(($BMR/24)*$MET*$month_graph_step_row['session_time_length']);
>>>>>>> origin/beta
				$month_graph_cal_display[$x] = $month_graph_cal + $month_graph_cal_display[$x];
			}
			else
			{
				$BMR = 655 + (13.75 * $month_graph_step_row['user_weight']) + (5 * $month_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($month_graph_step_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$month_graph_cal = round(($BMR/24)*$MET*($month_graph_step_row['session_time_length']/3600));
=======
				$month_graph_cal = round(($BMR/24)*$MET*$month_graph_step_row['session_time_length']);
>>>>>>> origin/beta
				$month_graph_cal_display[$x] = $month_graph_cal + $month_graph_cal_display[$x];
			}
		}

	// Store month step and cal data into js array	
	echo "
			<script>
				month_graph_step[".json_encode($x)."] = ".json_encode($month_graph_step_display[$x]).";
				month_graph_cal[".json_encode($x)."] = ".json_encode($month_graph_cal_display[$x]).";
			</script>
		";

	}

	// Calculate all the data and store into variable
	while($total_row = mysqli_fetch_array($total_data, MYSQLI_BOTH))
	{
		$total_total_step = $total_total_step+$total_row['session_steps'];
		if($total_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $total_row['user_weight']) + (5 * $total_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($total_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$calories = round(($BMR/24)*$MET*($total_row['session_time_length']/3600));
=======
				$calories = round(($BMR/24)*$MET*$total_row['session_time_length']);
>>>>>>> origin/beta
				$total_calories = $calories + $total_calories;
			}
			else
			{
				$BMR = 655 + (13.75 * $total_row['user_weight']) + (5 * $total_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($total_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$calories = round(($BMR/24)*$MET*($total_row['session_time_length']/3600));
=======
				$calories = round(($BMR/24)*$MET*$total_row['session_time_length']);
>>>>>>> origin/beta
				$total_calories = $calories + $total_calories;
			}
	}
	while($friend_total_row = mysqli_fetch_array($friend_total_data))
	{
		$friend_total_total_step = $friend_total_total_step+$friend_total_row['session_steps'];
		if($friend_total_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $friend_total_row['user_weight']) + (5 * $friend_total_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_total_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$friend_calories = round(($BMR/24)*$MET*($friend_total_row['session_time_length']/3600));
=======
				$friend_calories = round(($BMR/24)*$MET*$friend_total_row['session_time_length']);
>>>>>>> origin/beta
				$friend_total_calories = $friend_calories + $friend_total_calories;
			}
			else
			{
				$BMR = 655 + (13.75 * $friend_total_row['user_weight']) + (5 * $friend_total_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_total_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$friend_calories = round(($BMR/24)*$MET*($friend_total_row['session_time_length']/3600));
=======
				$friend_calories = round(($BMR/24)*$MET*$friend_total_row['session_time_length']);
>>>>>>> origin/beta
				$friend_total_calories = $friend_calories + $friend_total_calories;
			}
	}
	while($day_row = mysqli_fetch_array($day_data))
	{
		$total_day_step = $total_day_step+$day_row['session_steps'];

		if($day_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $day_row['user_weight']) + (5 * $day_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($day_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$total_day_calories = round(($BMR/24)*$MET*($day_row['session_time_length']/3600));
=======
				$total_day_calories = round(($BMR/24)*$MET*$day_row['session_time_length']);
>>>>>>> origin/beta
				$day_calories = $total_day_calories + $day_calories;
			}
			else
			{
				$BMR = 655 + (13.75 * $day_row['user_weight']) + (5 * $day_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($day_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$total_day_calories = round(($BMR/24)*$MET*($day_row['session_time_length']/3600));
=======
				$total_day_calories = round(($BMR/24)*$MET*$day_row['session_time_length']);
>>>>>>> origin/beta
				$day_calories = $total_day_calories + $day_calories;
			}
	}
	while($week_row = mysqli_fetch_array($week_data))
	{
		$total_week_step = $total_week_step+$week_row['session_steps'];

		if($week_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $week_row['user_weight']) + (5 * $week_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$total_week_calories = round(($BMR/24)*$MET*($week_row['session_time_length']/3600));
=======
				$total_week_calories = round(($BMR/24)*$MET*$week_row['session_time_length']);
>>>>>>> origin/beta
				$week_calories = $total_week_calories + $week_calories;
			}
			else
			{
				$BMR = 655 + (13.75 * $week_row['user_weight']) + (5 * $week_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($week_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$total_week_calories = round(($BMR/24)*$MET*($week_row['session_time_length']/3600));
=======
				$total_week_calories = round(($BMR/24)*$MET*$week_row['session_time_length']);
>>>>>>> origin/beta
				$week_calories = $total_week_calories + $week_calories;
			}
	}
	while($month_row = mysqli_fetch_array($month_data))
	{
		$total_month_step = $total_month_step+$month_row['session_steps'];

		if($month_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $month_row['user_weight']) + (5 * $month_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($month_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$total_month_calories = round(($BMR/24)*$MET*($month_row['session_time_length']/3600));
=======
				$total_month_calories = round(($BMR/24)*$MET*$month_row['session_time_length']);
>>>>>>> origin/beta
				$month_calories = $total_month_calories + $month_calories;
			}
			else
			{
				$BMR = 655 + (13.75 * $month_row['user_weight']) + (5 * $month_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($month_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$total_month_calories = round(($BMR/24)*$MET*($month_row['session_time_length']/3600));
=======
				$total_month_calories = round(($BMR/24)*$MET*$month_row['session_time_length']);
>>>>>>> origin/beta
				$month_calories = $total_month_calories + $month_calories;
			}
	}

	// Store the data into variable for display 
	$total_step = $total_total_step;
	$friend_total_step = $friend_total_total_step;
	$day_step = $total_day_step;
	$week_step = $total_week_step;
	$month_step = $total_month_step;

	// Store and calculate friend hours step and cal into array 	
	    while($friend_hour_graph_step_row = mysqli_fetch_array($friend_hour_data, MYSQLI_BOTH))
		{
			$time=date("H", strtotime($friend_hour_graph_step_row['session_date']));

			if($time=="00")
				{
					$friend_hour_graph_step_display[0] = $friend_hour_graph_step_display[0] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[0] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[0];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[0] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[0];
					}
				}
			else if ($time=="01") 
				{
					$friend_hour_graph_step_display[1] = $friend_hour_graph_step_display[1] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[1] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[1];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[1] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[1];
					}
				}
			else if ($time=="02") 
				{
					$friend_hour_graph_step_display[2] = $friend_hour_graph_step_display[2] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[2] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[2];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[2] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[2];
					}
				}
			else if ($time=="03") 
				{
					$friend_hour_graph_step_display[3] = $friend_hour_graph_step_display[3] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[3] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[3];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[3] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[3];
					}
				}
			else if ($time=="04") 
				{
					$friend_hour_graph_step_display[4] = $friend_hour_graph_step_display[4] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[4] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[4];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[4] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[4];
					}
				}
			else if ($time=="05") 
				{
					$friend_hour_graph_step_display[5] = $friend_hour_graph_step_display[5] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[5] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[5];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[5] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[5];
					}
				}
			else if ($time=="06") 
				{
					$friend_hour_graph_step_display[6] = $friend_hour_graph_step_display[6] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[6] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[6];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[6] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[6];
					}
				}
			else if ($time=="07") 
				{
					$friend_hour_graph_step_display[7] = $friend_hour_graph_step_display[7] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[7] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[7];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[7] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[7];
					}
				}
			else if ($time=="08") 
				{
					$friend_hour_graph_step_display[8] = $friend_hour_graph_step_display[8] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[8] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[8];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[8] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[8];
					}
				}
			else if ($time=="09") 
				{
					$friend_hour_graph_step_display[9] = $friend_hour_graph_step_display[9] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[9] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[9];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[9] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[9];
					}
				}
			else if ($time=="10") 
				{
					$friend_hour_graph_step_display[10] = $friend_hour_graph_step_display[10] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[10] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[10];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[10] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[10];
					}
				}
			else if ($time=="11") 
				{
					$friend_hour_graph_step_display[11] = $friend_hour_graph_step_display[11] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[11] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[11];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[11] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[11];
					}
				}
			else if ($time=="12") 
				{
					$friend_hour_graph_step_display[12] = $friend_hour_graph_step_display[12] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[12] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[12];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[12] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[12];
					}
				}
			else if ($time=="13") 
				{
					$friend_hour_graph_step_display[13] = $friend_hour_graph_step_display[13] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[13] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[13];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[13] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[13];
					}
				}
			else if ($time=="14") 
				{
					$friend_hour_graph_step_display[14] = $friend_hour_graph_step_display[14] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[14] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[14];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[14] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[14];
					}
				}
			else if ($time=="15") 
				{
					$friend_hour_graph_step_display[15] = $friend_hour_graph_step_display[15] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[15] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[15];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[15] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[15];
					}
				}
			else if ($time=="16") 
				{
					$friend_hour_graph_step_display[16] = $friend_hour_graph_step_display[16] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[16] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[16];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[16] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[16];
					}
				}
			else if ($time=="17") 
				{
					$friend_hour_graph_step_display[17] = $friend_hour_graph_step_display[17] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[17] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[17];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[17] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[17];
					}
				}
			else if ($time=="18") 
				{
					$friend_hour_graph_step_display[18] = $friend_hour_graph_step_display[18] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[18] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[18];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[18] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[18];
					}
				}
			else if ($time=="19") 
				{
					$friend_hour_graph_step_display[19] = $friend_hour_graph_step_display[19] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[19] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[19];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[19] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[19];
					}
				}
			else if ($time=="20") 
				{
					$friend_hour_graph_step_display[20] = $friend_hour_graph_step_display[20] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[20] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[20];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[20] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[20];
					}
				}
			else if ($time=="21") 
				{
					$friend_hour_graph_step_display[21] = $friend_hour_graph_step_display[21] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[21] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[21];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[21] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[21];
					}
				}
			else if ($time=="22") 
				{
					$friend_hour_graph_step_display[22] = $friend_hour_graph_step_display[22] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[22] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[22];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[22] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[22];
					}
				}
			else if ($time=="23") 
				{
					$friend_hour_graph_step_display[23] = $friend_hour_graph_step_display[23] + $friend_hour_graph_step_row['session_steps'];
					if($friend_hour_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[23] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[23];
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_hour_graph_step_row['user_weight']) + (5 * $friend_hour_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_hour_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_hour_graph_cal = round(($BMR/24)*$MET*($friend_hour_graph_step_row['session_time_length']/3600));
=======
						$friend_hour_graph_cal = round(($BMR/24)*$MET*$friend_hour_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_hour_graph_cal_display[23] = $friend_hour_graph_cal + $friend_hour_graph_cal_display[23];
					}
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
	while($friend_week_graph_step_row = mysqli_fetch_array($friend_week_data, MYSQLI_BOTH))
		{
			$date=date("D", strtotime($friend_week_graph_step_row['session_date']));
			if($date=="Mon")
				{
					$friend_mon_step_data = $friend_mon_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_mon_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_mon_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_mon_cal_data = $friend_mon_cal_data + $friend_mon_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_mon_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_mon_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_mon_cal_data = $friend_mon_cal_data + $friend_mon_cal;
					}
				}
			else if ($date=="Tue") 
				{
					$friend_tue_step_data = $friend_tue_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_tue_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_tue_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_tue_cal_data = $friend_tue_cal_data + $friend_tue_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_tue_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_tue_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_tue_cal_data = $friend_tue_cal_data + $friend_tue_cal;
					}
				}
			else if ($date=="Wed") 
				{
					$friend_wed_step_data = $friend_wed_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_wed_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_wed_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_wed_cal_data = $friend_wed_cal_data + $friend_wed_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_wed_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_wed_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_wed_cal_data = $friend_wed_cal_data + $friend_wed_cal;
					}
				}
			else if ($date=="Thu") 
				{
					$friend_thu_step_data = $friend_thu_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_thu_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_thu_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_thu_cal_data = $friend_thu_cal_data + $friend_thu_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_thu_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_thu_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_thu_cal_data = $friend_thu_cal_data + $friend_thu_cal;
					}
				}
			else if ($date=="Fri") 
				{
					$friend_fri_step_data = $friend_fri_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_fri_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_fri_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_fri_cal_data = $friend_fri_cal_data + $friend_fri_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_fri_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_fri_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_fri_cal_data = $friend_fri_cal_data + $friend_fri_cal;
					}
				}
			else if ($date=="Sat") 
				{
					$friend_sat_step_data = $friend_sat_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_sat_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_sat_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_sat_cal_data = $friend_sat_cal_data + $friend_sat_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_sat_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_sat_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_sat_cal_data = $friend_sat_cal_data + $friend_sat_cal;
					}
				}
			else if ($date=="Sun") 
				{
					$friend_sun_step_data = $friend_sun_step_data + $friend_week_graph_step_row['session_steps'];
					if($friend_week_graph_step_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_sun_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_sun_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_sun_cal_data = $friend_sun_cal_data + $friend_sun_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $friend_week_graph_step_row['user_weight']) + (5 * $friend_week_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_week_graph_step_row['user_day_of_birth']))));
						$MET = 2;
<<<<<<< HEAD
						$friend_sun_cal = round(($BMR/24)*$MET*($friend_week_graph_step_row['session_time_length']/3600));
=======
						$friend_sun_cal = round(($BMR/24)*$MET*$friend_week_graph_step_row['session_time_length']);
>>>>>>> origin/beta
						$friend_sun_cal_data = $friend_sun_cal_data + $friend_sun_cal;
					}
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
    $friend_month_graph_step_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id = '$user_friend_id' AND MONTH(session_date)=".$b."+1";
    $friend_month_graph_step_data = mysqli_query($dbconn, $friend_month_graph_step_query);
    $friend_month_graph_step_display[$b] = 0;
    $friend_month_graph_cal_display[$b] = 0;
    	
    // Store and calculate friend total monthly step and cal into array 	
	    while($friend_month_graph_step_row = mysqli_fetch_array($friend_month_graph_step_data, MYSQLI_BOTH))
		{
			$friend_month_graph_step_display[$b] = $friend_month_graph_step_display[$b]+$friend_month_graph_step_row['session_steps'];

			if($friend_month_graph_step_row['user_gender']=="Male")
			{
				$BMR = 66 + (13.75 * $friend_month_graph_step_row['user_weight']) + (5 * $friend_month_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_month_graph_step_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$friend_month_graph_cal = round(($BMR/24)*$MET*($friend_month_graph_step_row['session_time_length']/3600));
=======
				$friend_month_graph_cal = round(($BMR/24)*$MET*$friend_month_graph_step_row['session_time_length']);
>>>>>>> origin/beta
				$friend_month_graph_cal_display[$b] = $friend_month_graph_cal + $friend_month_graph_cal_display[$x];
			}
			else
			{
				$BMR = 655 + (13.75 * $friend_month_graph_step_row['user_weight']) + (5 * $friend_month_graph_step_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($friend_month_graph_step_row['user_day_of_birth']))));
				$MET = 2;
<<<<<<< HEAD
				$friend_month_graph_cal = round(($BMR/24)*$MET*($friend_month_graph_step_row['session_time_length']/3600));
=======
				$friend_month_graph_cal = round(($BMR/24)*$MET*$friend_month_graph_step_row['session_time_length']);
>>>>>>> origin/beta
				$friend_month_graph_cal_display[$b] = $friend_month_graph_cal + $friend_month_graph_cal_display[$x];
			}
		}

	// Store friend month step and cal data into js array	
	echo "
			<script>
				friend_month_graph_step[".json_encode($b)."] = ".json_encode($friend_month_graph_step_display[$b]).";
				friend_month_graph_cal[".json_encode($b)."] = ".json_encode($friend_month_graph_cal_display[$b]).";
			</script>
		";

	}

	while($user_total_row = mysqli_fetch_array($user_total_data))
	{
		if($user_total_row['user_total_step']!=$total_step || $user_total_row['user_total_cal']!=$total_calories);
		{
			$user_add_query = "UPDATE user SET user_total_step ='$total_step', user_total_cal ='$total_calories' WHERE user_id = '$user_id'";
	        mysqli_query($dbconn, $user_add_query);
		}
	}
?>

<script>
				// alert(<?php echo $user_friend_id; ?>);
</script>