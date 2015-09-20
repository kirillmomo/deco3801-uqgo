<?php

	// Include connect php file
	include('connect.php');

	// Define user variable
	$user_id = $_SESSION['user_id'];
	$friend_id=$_SESSION['friend_id'];
	$search_detail=$_SESSION['search'];
	$user_name="";
	$first_name="";
	$last_name="";
	$user_age=0;
	$user_member_date=0;
	$user_friend_number=0;
	$user_group_number=0;
	$user_challenges_number=0;
	$friend_list_display=array();
	$friend_list_id=array();
	$friend_name="";
	$friend_first_name="";
	$friend_last_name="";
	$friend_member_date = "";
	$friend_age=0;
	$search_user_id=array();
	$search_user_friend_id=array();
	$x=0;
	$y=0;
	$z=0;
	
	// SQL query
	$user_query = "SELECT * FROM user WHERE user_id = '$user_id'";	
	$friend_query = "SELECT * FROM user WHERE user_id = '$friend_id'";	
	$user_friend_query = "SELECT * FROM friends WHERE user_id = '$user_id' or friend_id = '$user_id'";
	$user_group_query = "SELECT * FROM group_member WHERE group_member_user_id = '$user_id'";
	$user_challenge_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$user_id'";
	$search_user_query ="SELECT * FROM user WHERE username LIKE '$search_detail%'";
	$user_data = mysql_query($user_query,$dbconn);
	$friend_data = mysql_query($friend_query,$dbconn);
	$user_friend_data = mysql_query($user_friend_query,$dbconn);
	$user_group_data = mysql_query($user_group_query,$dbconn);
	$user_challenge_data = mysql_query($user_challenge_query,$dbconn);
	$search_user_data = mysql_query($search_user_query,$dbconn);

	$user_group_number = mysql_num_rows($user_group_data);
	$user_challenges_number = mysql_num_rows($user_challenge_data);
	$user_friend_number = mysql_num_rows($user_friend_data);

	// Store user data into variable
	while($user_row = mysql_fetch_array($user_data))
		{
			$user_name = $user_row['username'];
			$first_name = $user_row['first_name'];
			$last_name = $user_row['last_name'];
			$user_age = date("Y") - date("Y",strtotime($user_row['user_day_of_birth']));
			$user_member_date = date("Y",strtotime($user_row['user_date_created']));
		}

		while($friend_row = mysql_fetch_array($friend_data))
		{
			$friend_name = $friend_row['username'];
			$friend_first_name = $friend_row['first_name'];
			$friend_last_name = $friend_row['last_name'];
			$friend_age = date("Y") - date("Y",strtotime($friend_row['user_day_of_birth']));
			$friend_member_date = date("Y",strtotime($friend_row['user_date_created']));
		}

	// Store user friends data into variable
	while($user_friend_row = mysql_fetch_array($user_friend_data))
		{
			$friend_user_id = $user_friend_row['user_id'];
			$friend_friend_id = $user_friend_row['friend_id'];

			// Check the friend list of the user
			if($friend_user_id==$user_id && $friend_friend_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_friend_id'";	
				$friend_data = mysql_query($friend_query,$dbconn);
				while($friend_row = mysql_fetch_array($friend_data))
				{
					$friend_list_display[$x] = $friend_row['username'];
					$friend_list_id[$x]=$friend_row['user_id'];
					$search_user_friend_id[$x]=$friend_row['user_id'];
				}
			}
			elseif($friend_friend_id==$user_id && $friend_user_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_user_id'";
				$friend_data = mysql_query($friend_query,$dbconn);
				while($friend_row = mysql_fetch_array($friend_data))
				{
					$friend_list_display[$x] = $friend_row['username'];
					$friend_list_id[$x]=$friend_row['user_id'];
					$search_user_friend_id[$x]=$friend_row['user_id'];
				}	
			}
			$x++;
		}

		var_dump($search_user_friend_id);

		unset($_SESSION["friend_id"]);
		unset($_SESSION["search"]);
?>