<?php
	// Include connect php file
	include('connect.php');

	$challenge_user_id = $_SESSION['user_id'];
	$challenge_challenge_id = $_SESSION['challenge_id'];

	$challenge_user_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$challenge_user_id'";
	$challenge_joined_user_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$challenge_challenge_id'";
	$total_challenge_user_num_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$challenge_challenge_id'";
	$challenge_detail_query = "SELECT * FROM challenge WHERE challenge_id = '$challenge_challenge_id'";

	$challenge_user_data = mysql_query($challenge_user_query,$dbconn);
	$challenge_joined_user_data = mysql_query($challenge_joined_user_query,$dbconn);
	$total_challenge_user_num_data = mysql_query($total_challenge_user_num_query,$dbconn);
	$challenge_detail_data = mysql_query($challenge_detail_query,$dbconn);

	$user_challenge_joined_data=array();
	$challenge_joined_user=array();
	$search_challenge_joined_user_id=array();
	$search_challenge_joined_user_first_name=array();
	$search_challenge_joined_user_last_name=array();
	$search_challenge_id=array();
	$search_challenge_name=array();
	$total_challenge_user_num_id=array();
	$total_user_join_num = 0;
	$challenge_inprogress_num = 0;
	$challenge_detail_name = $challenge_detail_row['challenge_name'];
	$challenge_detail_start_date = "";
	$challenge_detail_end_date = "";
	$challenge_detail_type = "";
	$challenge_detail_progress = "";
	$challenge_detail_day_left ="";
	$i=0;
	$y=0;
	$z=0;
	$a=0;
	$b=0;

	while($total_challenge_user_num_row = mysql_fetch_array($total_challenge_user_num_data))
		{
			$total_challenge_user_num_id[$a] = $total_challenge_user_num_row['challenge_id'];
			$a++;
		}

		$total_user_join_num=sizeof($total_challenge_user_num_id);

	while($challenge_joined_user_row = mysql_fetch_array($challenge_joined_user_data))
		{
			$challenge_joined_user[$b] = $challenge_joined_user_row['challenge_id'];
			$b++;
		}

	$search_challenge_member_id_array = implode(',', $challenge_joined_user);
	$search_challenge_member_query = "SELECT * FROM user WHERE user_id IN ($search_challenge_member_id_array) ORDER BY first_name";
	$search_challenge_member_data = mysql_query($search_challenge_member_query,$dbconn);
		
	while($search_challenge_member_row = mysql_fetch_array($search_challenge_member_data))
		{
			$search_challenge_joined_user_id[$y] = $search_challenge_member_row['user_id'];
			$search_challenge_joined_user_first_name[$y] = $search_challenge_member_row['first_name'];
			$search_challenge_joined_user_last_name[$y] = $search_challenge_member_row['last_name'];
			$y++;
		}


	// Search user joined challenge data
	while($challenge_user_row = mysql_fetch_array($challenge_user_data))
		{
			$user_challenge_joined_data[$i] = $challenge_user_row['challenge_id'];
			$i++;
		}
	$search_challenge_id_array = implode(',', $user_challenge_joined_data);
	$search_challenge_data_query = "SELECT * FROM challenge WHERE challenge_id IN ($search_challenge_id_array) ORDER BY challenge_name";
	$search_challenge_info_data = mysql_query($search_challenge_data_query,$dbconn);
		
	while($challenge_member_row = mysql_fetch_array($search_challenge_info_data))
		{
			$search_challenge_id[$z] = $challenge_member_row['challenge_id'];
			$search_challenge_name[$z] = $challenge_member_row['challenge_name'];
			$z++;
		}
	// Store user joined challenge data
	while($challenge_detail_row = mysql_fetch_array($challenge_detail_data))
		{
			$challenge_detail_name = $challenge_detail_row['challenge_name'];
			$challenge_detail_start_date = $challenge_detail_row['challenge_start_date'];
			$challenge_detail_end_date = $challenge_detail_row['challenge_finish_date'];
			$challenge_detail_type = $challenge_detail_row['challenge_goal_type'];
			$challenge_detail_progress = $challenge_detail_row['challenge_goal_progress'];
			$challenge_detail_time_left = strtotime($challenge_detail_end_date) - strtotime($challenge_detail_start_date);
			$challenge_detail_day_left = round((($challenge_detail_time_left/24)/60)/60);
		}


?>