<?php
	// Include connect php file
	include('connect.php');

	$challenge_user_id = $_SESSION['user_id'];
	$challenge_challenge_id = $_SESSION['challenge_id'];
	$join_challenge_id = $_SESSION['join_challenge_id'];
	$leave_challenge_id = $_SESSION['leave_challange_id'];

	$challenge_user_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$challenge_user_id'";
	$challenge_joined_user_query = "SELECT * FROM challenge_member WHERE challenge_id = '$challenge_challenge_id'";
	$total_challenge_user_num_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$challenge_challenge_id'";
	$challenge_detail_query = "SELECT * FROM challenge WHERE challenge_id = '$challenge_challenge_id'";
	$search_all_challenge_data_query = "SELECT * FROM challenge WHERE challenge_finish_date >= DATE(NOW()) AND challenge_progress < challenge_goal ORDER BY challenge_name";

	$challenge_user_data = mysqli_query($dbconn, $challenge_user_query);
	$total_joined_challenge_data = mysqli_query($dbconn, $challenge_user_query);
	$challenge_joined_user_data = mysqli_query($dbconn, $challenge_joined_user_query);
	$total_challenge_user_num_data = mysqli_query($dbconn, $total_challenge_user_num_query);
	$challenge_detail_data = mysqli_query($dbconn, $challenge_detail_query);
	$all_challenge_data = mysqli_query($dbconn, $search_all_challenge_data_query);
	$total_joined_challenge_num = mysqli_num_rows($total_joined_challenge_data);

	$user_challenge_joined_data=array();
	$challenge_joined_user=array();
	$search_challenge_joined_user_id=array();
	$search_challenge_joined_user_first_name=array();
	$search_challenge_joined_user_last_name=array();
	$search_challenge_id=array();
	$search_challenge_name=array();
	$search_challenge_start_date = array();
	$search_challenge_end_date = array();
	$search_challenge_time_left = array();
	$search_challenge_duration_left = array();
	$search_challenge_day_left = array();
	$search_challenge_duration_day_left = array();
	$search_challenge_remaining_time_left = array();
	$total_challenge_user_num_id=array();
	$search_complete_challenge_id = array();
	$search_complete_challenge_name = array();
	$search_complete_challenge_start_date = array();
	$search_complete_challenge_end_date = array();
	$search_complete_challenge_time_left = array();
	$search_complete_challenge_duration_left = array();
	$search_complete_challenge_day_left = array();
	$search_complete_challenge_duration_day_left = array();
	$search_complete_challenge_remaining_time_left= array();
	$search_unjoined_challenge_id = array();
	$search_unjoined_challenge_name = array();
	$search_unjoined_challenge_start_date =array();
	$search_unjoined_challenge_end_date = array();
	$search_unjoined_challenge_time_left = array();
	$search_unjoined_challenge_duration_left =array();
	$search_unjoined_challenge_day_left = array();
	$search_unjoined_challenge_duration_day_left = array();
	$search_unjoined_challenge_remaining_time_left= array();
	$search_all_challenge_id = array();
	$search_all_challenge_name = array();
	$search_all_challenge_start_date = array();
	$search_all_challenge_end_date =array();
	$search_all_challenge_time_left = array();
	$search_all_challenge_duration_left = array();
	$search_all_challenge_day_left = array();
	$search_all_challenge_duration_day_left = array();
	$search_all_challenge_remaining_time_left= array();
	$complete_challenge_percentage = array();
	$all_challenge_percentage = array();
	$unjoined_challenge_percentage = array();
	$challenge_percentage = array();

	$total_user_join_num = 0;
	$challenge_detail_name = $challenge_detail_row['challenge_name'];
	$challenge_detail_start_date = "";
	$challenge_detail_end_date = "";
	$challenge_detail_type = "";
	$challenge_detail_goal="";
	$challenge_detail_progress = "";
	$challenge_detail_day_left ="";
	$challenge_detail_duration_left = "";
	$challenge_detail_duration_day_left = "";
	$challenge_detail_remaining_time_left="";
	$i=0;
	$y=0;
	$x=0;
	$z=0;
	$a=0;
	$b=0;
	$c=0;
	$d=0;

	while($total_challenge_user_num_row = mysqli_fetch_array($total_challenge_user_num_data))
		{
			$total_challenge_user_num_id[$a] = $total_challenge_user_num_row['challenge_id'];
			$a++;
		}

		$total_user_join_num=sizeof($total_challenge_user_num_id);

	while($challenge_joined_user_row = mysqli_fetch_array($challenge_joined_user_data))
		{
			$challenge_joined_user[$b] = $challenge_joined_user_row['challenge_user_id'];
			$b++;
		}

	$search_challenge_member_id_array = implode(',', $challenge_joined_user);
	$search_challenge_member_query = "SELECT * FROM user WHERE user_id IN ($search_challenge_member_id_array) ORDER BY first_name";
	$search_challenge_member_data = mysqli_query($dbconn, $search_challenge_member_query);
		
	while($search_challenge_member_row = mysqli_fetch_array($search_challenge_member_data))
		{
			$search_challenge_joined_user_id[$y] = $search_challenge_member_row['user_id'];
			$search_challenge_joined_user_first_name[$y] = $search_challenge_member_row['first_name'];
			$search_challenge_joined_user_last_name[$y] = $search_challenge_member_row['last_name'];
			$y++;
		}


	// Search user joined challenge data
	while($challenge_user_row = mysqli_fetch_array($challenge_user_data))
		{
			$user_challenge_joined_data[$i] = $challenge_user_row['challenge_id'];
			$i++;
		}
	$search_challenge_id_array = implode(',', $user_challenge_joined_data);
	$search_challenge_data_query = "SELECT * FROM challenge WHERE challenge_id IN ($search_challenge_id_array) AND challenge_finish_date >= DATE(NOW()) AND challenge_progress < challenge_goal ORDER BY challenge_name";
	$search_challenge_info_data = mysqli_query($dbconn, $search_challenge_data_query);
		
	while($challenge_member_row = mysqli_fetch_array($search_challenge_info_data))
		{
			$search_challenge_id[$z] = $challenge_member_row['challenge_id'];
			$search_challenge_name[$z] = $challenge_member_row['challenge_name'];
			$search_challenge_start_date[$z] = $challenge_member_row['challenge_start_date'];
			$search_challenge_end_date[$z] = $challenge_member_row['challenge_finish_date'];
			$search_challenge_time_left[$z] = strtotime($search_challenge_end_date[$z]) - strtotime($search_challenge_start_date[$z]);
			$search_challenge_duration_left[$z] = time() - strtotime($search_challenge_start_date[$z]);
			$search_challenge_day_left[$z] = round((($search_challenge_time_left[$z]/24)/60)/60);
			$search_challenge_duration_day_left[$z] = round((($search_challenge_duration_left[$z]/24)/60)/60);
			$search_challenge_remaining_time_left[$z]= $search_challenge_day_left[$z] - $search_challenge_duration_day_left[$z];
			$challenge_percentage[$z] = round(($challenge_member_row['challenge_progress']/$challenge_member_row['challenge_goal'])*100);
			$z++;
		}

	//Search unjoined challenge 
	$search_unjoined_challenge_id_array = implode(',', $user_challenge_joined_data);
	$search_unjoined_challenge_data_query = "SELECT * FROM challenge WHERE challenge_id NOT IN ($search_unjoined_challenge_id_array) AND challenge_finish_date >= DATE(NOW()) AND challenge_progress < challenge_goal ORDER BY challenge_name";
	$search_unjoined_challenge_info_data = mysqli_query($dbconn, $search_unjoined_challenge_data_query);
		
	while($challenge_unjoined_member_row = mysqli_fetch_array($search_unjoined_challenge_info_data))
		{
			$search_unjoined_challenge_id[$c] = $challenge_unjoined_member_row['challenge_id'];
			$search_unjoined_challenge_name[$c] = $challenge_unjoined_member_row['challenge_name'];
			$search_unjoined_challenge_start_date[$c] = $challenge_unjoined_member_row['challenge_start_date'];
			$search_unjoined_challenge_end_date[$c] = $challenge_unjoined_member_row['challenge_finish_date'];
			$search_unjoined_challenge_time_left[$c] = strtotime($search_unjoined_challenge_end_date[$c]) - strtotime($search_unjoined_challenge_start_date[$c]);
			$search_unjoined_challenge_duration_left[$c] = time() - strtotime($search_unjoined_challenge_start_date[$c]);
			$search_unjoined_challenge_day_left[$c] = round((($search_unjoined_challenge_time_left[$c]/24)/60)/60);
			$search_unjoined_challenge_duration_day_left[$c] = round((($search_unjoined_challenge_duration_left[$c]/24)/60)/60);
			$search_unjoined_challenge_remaining_time_left[$c]= $search_unjoined_challenge_day_left[$c] - $search_unjoined_challenge_duration_day_left[$c];
			$unjoined_challenge_percentage[$c] = round(($challenge_unjoined_member_row['challenge_progress']/$challenge_unjoined_member_row['challenge_goal'])*100);
			$c++;
		}

	while($all_challenge_row = mysqli_fetch_array($all_challenge_data))
		{
			$search_all_challenge_id[$d] = $all_challenge_row['challenge_id'];
			$search_all_challenge_name[$d] = $all_challenge_row['challenge_name'];
			$search_all_challenge_start_date[$d] = $all_challenge_row['challenge_start_date'];
			$search_all_challenge_end_date[$d] = $all_challenge_row['challenge_finish_date'];
			$search_all_challenge_time_left[$d] = strtotime($search_all_challenge_end_date[$d]) - strtotime($search_all_challenge_start_date[$d]);
			$search_all_challenge_duration_left[$d] = time() - strtotime($search_all_challenge_start_date[$d]);
			$search_all_challenge_day_left[$d] = round((($search_all_challenge_time_left[$d]/24)/60)/60);
			$search_all_challenge_duration_day_left[$d] = round((($search_all_challenge_duration_left[$d]/24)/60)/60);
			$search_all_challenge_remaining_time_left[$d]= $search_all_challenge_day_left[$d] - $search_all_challenge_duration_day_left[$d];
			$all_challenge_percentage[$d] = round(($all_challenge_row['challenge_progress']/$all_challenge_row['challenge_goal'])*100);
			$d++;
		}



	// display user joined challenge data
	while($challenge_detail_row = mysqli_fetch_array($challenge_detail_data))
		{
			$challenge_detail_name = $challenge_detail_row['challenge_name'];
			$challenge_detail_start_date = $challenge_detail_row['challenge_start_date'];
			$challenge_detail_end_date = $challenge_detail_row['challenge_finish_date'];
			$challenge_detail_type = $challenge_detail_row['challenge_goal_type'];
			$challenge_detail_goal = $challenge_detail_row['challenge_goal'];
			$challenge_detail_progress = $challenge_detail_row['challenge_progress'];
			$challenge_detail_time_left = strtotime($challenge_detail_end_date) - strtotime($challenge_detail_start_date);
			$challenge_detail_duration_left = time() - strtotime($challenge_detail_start_date);
			$challenge_detail_day_left = round((($challenge_detail_time_left/24)/60)/60);
			$challenge_detail_duration_day_left = round((($challenge_detail_duration_left/24)/60)/60);
			$challenge_detail_remaining_time_left= $challenge_detail_day_left - $challenge_detail_duration_day_left;
			if ($challenge_detail_duration_day_left>=$challenge_detail_day_left) 
			{
				$challenge_detail_duration_day_left=$challenge_detail_day_left;
			}

			if ($challenge_detail_remaining_time_left<=-1) 
			{
				$challenge_detail_remaining_time_left=0;
			}

			if ($challenge_detail_progress>=$challenge_detail_goal) 
			{
				$challenge_detail_progress=$challenge_detail_goal;
			}
		}

	// Search complete challenge data 

	$search_complete_challenge_id_array = implode(',', $user_challenge_joined_data);
	$search_complete_challenge_data_query = "SELECT * FROM challenge WHERE challenge_id IN ($search_complete_challenge_id_array) AND challenge_finish_date <= DATE(NOW()) OR challenge_id IN ($search_complete_challenge_id_array) AND challenge_progress >= challenge_goal";
	$search_complete_challenge_info_data = mysqli_query($dbconn, $search_complete_challenge_data_query);
		
	while($complete_challenge_member_row = mysqli_fetch_array($search_complete_challenge_info_data))
		{
			$search_complete_challenge_id[$x] = $complete_challenge_member_row['challenge_id'];
			$search_complete_challenge_name[$x] = $complete_challenge_member_row['challenge_name'];
			$search_complete_challenge_start_date[$x] = $complete_challenge_member_row['challenge_start_date'];
			$search_complete_challenge_end_date[$x] = $complete_challenge_member_row['challenge_finish_date'];
			$search_complete_challenge_time_left[$x] = strtotime($search_complete_challenge_end_date[$x]) - strtotime($search_complete_challenge_start_date[$x]);
			$search_complete_challenge_duration_left[$x] = time() - strtotime($search_complete_challenge_start_date[$x]);
			$search_complete_challenge_day_left[$x] = round((($search_complete_challenge_time_left[$x]/24)/60)/60);
			$search_complete_challenge_duration_day_left[$x] = round((($search_complete_challenge_duration_left[$x]/24)/60)/60);
			$search_complete_challenge_remaining_time_left[$x]= $search_complete_challenge_day_left[$x] - $search_complete_challenge_duration_day_left[$x];
			if ($complete_challenge_member_row['challenge_progress']>=$complete_challenge_member_row['challenge_goal']) 
			{
				$complete_challenge_percentage[$x] =  round(($complete_challenge_member_row['challenge_goal']/$complete_challenge_member_row['challenge_goal'])*100);
			}
			else
			{
				$complete_challenge_percentage[$x] =  round(($complete_challenge_member_row['challenge_progress']/$complete_challenge_member_row['challenge_goal'])*100);
			}
			

			if ($search_complete_challenge_remaining_time_left[$x]<=-1) 
			{
				$search_complete_challenge_remaining_time_left[$x]=0;
			}
			$x++;
		}

		$joining_challenge_query = "SELECT * FROM challenge_member WHERE challenge_id='$join_challenge_id' AND challenge_user_id = '$challenge_user_id'";
		$status_joining_challenge = mysqli_query($dbconn, $joining_challenge_query);
		$status_joining_challenge_row = mysqli_fetch_array($status_joining_challenge);

		if($join_challenge_id!=null)
			{

				if ($status_joining_challenge_row==false) 
				{
					$add_join_query = "INSERT INTO challenge_member SET challenge_user_id='$challenge_user_id', challenge_id='$join_challenge_id'";
		        	mysqli_query($dbconn, $add_join_query);
		        	unset($_SESSION['join_challenge_id']);
				}
				else
				{
					unset($_SESSION['join_challenge_id']);
				}
	    	}

	    $left_challenge_query = "SELECT * FROM challenge_member WHERE challenge_id='$leave_challenge_id' AND challenge_user_id = '$challenge_user_id'";
		$status_left_challenge_query = mysqli_query($dbconn, $left_challenge_query);
		$status_left_challenge_row = mysqli_fetch_array($status_left_challenge_query);
		if($leave_challenge_id!=null)
			{

				if ($status_left_challenge_row!=false) 
				{
					$leave_challenge_query = "DELETE FROM challenge_member WHERE  challenge_id='$leave_challenge_id' AND challenge_user_id = '$challenge_user_id'";
					mysqli_query($dbconn, $leave_challenge_query);
					$delete_challenge_query = "SELECT * FROM challenge WHERE  challenge_id='$leave_challenge_id' AND challenge_user_id = '$challenge_user_id'";
					$status_delete_challenge_query = mysqli_query($dbconn, $delete_challenge_query);
					$status_delete_challenge_row = mysqli_fetch_array($status_delete_challenge_query);
					if ($status_delete_challenge_row!=false) 
					{
						
						$delete_challenge_member_data_query = "DELETE FROM challenge_member WHERE challenge_id ='$leave_challenge_id'";
						mysqli_query($dbconn, $delete_challenge_member_data_query);
						$delete_challenge_data_query = "DELETE FROM challenge WHERE  challenge_id='$leave_challenge_id' AND challenge_user_id = '$challenge_user_id'";
						mysqli_query($dbconn, $delete_challenge_data_query);
					}
		
		        	
		        	unset($_SESSION["leave_challange_id"]);
				}
				else
				{
					unset($_SESSION["leave_challange_id"]);
				}
	    	}


?>