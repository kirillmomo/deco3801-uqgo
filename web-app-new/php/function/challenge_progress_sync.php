<?php
	session_start();
	include('connect.php');
	$search_all_challenge_data_query = "SELECT * FROM challenge WHERE challenge_finish_date >= DATE(NOW()) AND challenge_progress < challenge_goal ORDER BY challenge_name";
	$all_challenge_data = mysqli_query($dbconn, $search_all_challenge_data_query);
	while($all_challenge_row2 = mysqli_fetch_array($all_challenge_data))
		{
			$all_challenge_id = $all_challenge_row2['challenge_id'];
			$all_challenge_start_date = $all_challenge_row2['challenge_start_date'];
			$all_challenge_end_date = $all_challenge_row2['challenge_finish_date'];
			$all_challenge_goal_type = $all_challenge_row2['challenge_goal_type'];
			$all_challenge_member_query = "SELECT * FROM challenge_member WHERE challenge_id='$all_challenge_id'";
			$all_challenge_member_data = mysqli_query($dbconn, $all_challenge_member_query);
			$e=0;
			while($all_challenge_member_row = mysqli_fetch_array($all_challenge_member_data))
			{
				$challenge_member_id[$e]=$all_challenge_member_row['challenge_user_id'];
				$e++;
			}
			$all_challenge_member_id = implode(',', $challenge_member_id);
			$all_challenge_member_session_query = "SELECT * FROM session WHERE session_user_id IN ($all_challenge_member_id) AND session_date BETWEEN '$all_challenge_start_date' AND '$all_challenge_end_date'";
			$all_challenge_member_session_data = mysqli_query($dbconn, $all_challenge_member_session_query);
			$challenge_session_data=0;
			while($all_challenge_member_session_row = mysqli_fetch_array($all_challenge_member_session_data))
			{
				if($all_challenge_goal_type=="steps")
				{
					$challenge_session_data+=$all_challenge_member_session_row['session_steps'];
				}
				else if($all_challenge_goal_type=="distance")
				{
					$challenge_session_data+=$all_challenge_member_session_row['session_distance'];
				}
				else
				{
					if($all_challenge_member_session_row['user_gender']=="Male")
					{
						$BMR = 66 + (13.75 * $all_challenge_member_session_row['user_weight']) + (5 * $all_challenge_member_session_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($all_challenge_member_session_row['user_day_of_birth']))));
						$MET = 2;
						$challenge_cal = round(($BMR/24)*$MET*($all_challenge_member_session_row['session_time_length']/60));
						$challenge_session_data += $challenge_cal;
					}
					else
					{
						$BMR = 655 + (13.75 * $all_challenge_member_session_row['user_weight']) + (5 * $all_challenge_member_session_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($all_challenge_member_session_row['user_day_of_birth']))));
						$MET = 2;
						$challenge_cal = round(($BMR/24)*$MET*($all_challenge_member_session_row['session_time_length']/60));
						$challenge_session_data += $challenge_cal;
					}

				}
				$f++;
			}

			if($challenge_session_data>=$all_challenge_row2['challenge_goal'])
			{
				$challenge_goal = $all_challenge_row2['challenge_goal'];
				$add_challenge_session_data_query = "UPDATE challenge SET challenge_progress='$challenge_goal' WHERE challenge_id = '$all_challenge_id'";
		        mysqli_query($dbconn, $add_challenge_session_data_query);
			}
			else
			{
				$add_challenge_session_data_query = "UPDATE challenge SET challenge_progress='$challenge_session_data' WHERE challenge_id = '$all_challenge_id'";
		        mysqli_query($dbconn, $add_challenge_session_data_query);
			}				
		}

?>