<?php
	// Include connect php file
	include('connect.php');
	// Define variable
	$group_user_id = $_SESSION['user_id'];
	$group_id = $_SESSION['group_id'];
	$join_group_id = $_SESSION['join_groupid'];
	$left_group_id  = $_SESSION['leave_groupid'];
	$total_group_num = 0;
	$display_group_id = 0;
	$display_group_name = "";
	$display_group_date = "";
	$display_group_desc = "";
	$display_group_acti = "";
	$user_group_joined_data = array();
	$search_group_name = array();
	$search_group_id = array();
	$search_group_member_id = array();
	$group_member_first_name = array();
	$group_member_last_name = array();
	$non_joined_group_id = array();
	$search_non_joined_group_id = array();
	$search_non_joined_group_name = array();
	$search_all_group_id = array();
	$search_all_group_name = array();
	$i=0;
	$x=0;
	$z=0;
	$y=0;
	$a=0;
	$b=0;
	$c=0;

	// SQL query
	$group_user_query = "SELECT * FROM group_member WHERE group_member_user_id = '$group_user_id'";
	$group_detail_query = "SELECT * FROM `group` WHERE group_id = '$group_id'";
	$total_group_member_query = "SELECT * FROM group_member WHERE group_id = '$group_id'";
	$group_query = "SELECT * FROM `group` WHERE group_id IN ($search_group_id_array)";
	$non_joined_group_query = "SELECT * FROM group_member WHERE group_member_user_id = '$group_user_id'";
	$all_group_query = "SELECT * FROM `group`";
	$group_data = mysql_query($group_query,$dbconn);
	$group_detail_data = mysql_query($group_detail_query,$dbconn);
	$total_group_member_data = mysql_query($total_group_member_query,$dbconn);
	$group_user_data = mysql_query($group_user_query,$dbconn);
	$non_joined_group_data = mysql_query($non_joined_group_query,$dbconn);
	$all_group_data = mysql_query($all_group_query,$dbconn);
	$total_group_num = mysql_num_rows($total_group_member_data);

	//Search group detail
	while($group_detail_row = mysql_fetch_array($group_detail_data))
		{
			$display_group_id = $group_detail_row['group_id'];
			$display_group_name = $group_detail_row['group_name'];
			$display_group_date = date("F Y",strtotime($group_detail_row['group_created_date']));
			$display_group_desc = $group_detail_row['group_desc'];
			$display_group_acti = $group_detail_row['group_activ'];
		}

	//Search group member
	while($group_member_row = mysql_fetch_array($total_group_member_data))
		{
			$search_group_member_id[$x] = $group_member_row['group_member_user_id'];
			$x++;
		}

	// Search member detail
	$search_group_member_id_array = implode(',', $search_group_member_id);
	$search_group_member_query = "SELECT * FROM user WHERE user_id IN ($search_group_member_id_array) ORDER BY first_name";
	$search_group_member_data = mysql_query($search_group_member_query,$dbconn);
		
	while($search_group_member_row = mysql_fetch_array($search_group_member_data))
		{
			$group_member_first_name[$y] = $search_group_member_row['first_name'];
			$group_member_last_name[$y] = $search_group_member_row['last_name'];
			$y++;
		}

	//Search user joined group
	while($group_user_row = mysql_fetch_array($group_user_data))
		{
			$user_group_joined_data[$i] = $group_user_row['group_id'];
			$i++;
		}

	//Search user joined group 
	$search_group_id_array = implode(',', $user_group_joined_data);
	$search_group_data_query = "SELECT * FROM `group` WHERE group_id IN ($search_group_id_array)";
	$search_group_info_data = mysql_query($search_group_data_query,$dbconn);
		
	while($group_member_row = mysql_fetch_array($search_group_info_data))
		{
			$search_group_id[$z] = $group_member_row['group_id'];
			$search_group_name[$z] = $group_member_row['group_name'];
			$z++;
		}

	//Search user unjoined group
	while($non_joined_group_row = mysql_fetch_array($non_joined_group_data))
		{
			$non_joined_group_id[$b] = $non_joined_group_row['group_id'];
			$b++;
		}

	$search_non_joined_group_id_array = implode(',', $non_joined_group_id);
	$search_non_joined_group_data_query = "SELECT * FROM `group` WHERE group_id NOT IN ($search_non_joined_group_id_array)";
	$search_non_joined_group_info_data = mysql_query($search_non_joined_group_data_query,$dbconn);
		
	while($search_non_joined_group_row = mysql_fetch_array($search_non_joined_group_info_data))
		{
			$search_non_joined_group_id[$a] = $search_non_joined_group_row['group_id'];
			$search_non_joined_group_name[$a] = $search_non_joined_group_row['group_name'];
			$a++;
		}

	while($all_group_row = mysql_fetch_array($all_group_data))
		{
			$search_all_group_id[$c] = $all_group_row['group_id'];
			$search_all_group_name[$c] = $all_group_row['group_name'];
			$c++;
		}

	$joining_group_query = "SELECT * FROM group_member WHERE group_id='$join_group_id' AND group_member_user_id = '$group_user_id' ";
	$status_joining_group = mysql_query($joining_group_query);
	$status_joining_group_row = mysql_fetch_array($status_joining_group);

	if($join_group_id!=null)
		{

			if ($status_joining_group_row==false) 
			{
				$add_join_query = "INSERT INTO group_member SET group_member_user_id='$group_user_id', group_id='$join_group_id'";
	        	mysql_query($add_join_query);
	        	unset($_SESSION['join_groupid']);
			}
			else
			{
				unset($_SESSION['join_groupid']);
			}
    	}

    $left_group_query = "SELECT * FROM group_member WHERE group_id='$left_group_id' AND group_member_user_id = '$group_user_id'";
	$status_left_group_query = mysql_query($left_group_query);
	$status_left_group_row = mysql_fetch_array($status_left_group_query);
	if($left_group_id!=null)
		{

			if ($status_left_group_row!=false) 
			{
				$leave_group_query = "DELETE FROM group_member WHERE  group_id='$left_group_id' AND group_member_user_id = '$group_user_id'";
				mysql_query($leave_group_query);
				$delete_group_query = "SELECT * FROM `group` WHERE  group_id='$left_group_id' AND group_user_id = '$group_user_id'";
				$status_delete_group_query = mysql_query($delete_group_query);
				$status_delete_group_row = mysql_fetch_array($status_delete_group_query);
				var_dump($status_delete_group_row);
				if ($status_delete_group_row!=false) 
				{
					$delete_group_data_query = "DELETE * FROM `group` WHERE  group_id='$left_group_id' AND group_user_id = '$group_user_id'";
					$delete_group_member_data_query = "DELETE * FROM group_member WHERE  group_id='$left_group_id'";
				}
	
	        	
	        	unset($_SESSION["leave_groupid"]);
			}
			else
			{
				unset($_SESSION["leave_groupid"]);
			}
    	}
?>