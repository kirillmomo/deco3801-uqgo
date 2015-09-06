<?php
	include('connect.php');

	//if user hasn't logged in, go back to login page

	$user_id = $_SESSION['user_id'];
	$user_name="";
	$first_name="";
	$last_name="";
	$user_age=0;
	$user_member_date=0;
	$user_friend_number=0;
	$user_group_number=0;
	$user_challenges_number=0;
	$friend_list_display=array();
	$x=0;

	$user_query = "SELECT * FROM user WHERE user_id = '$user_id'";	
	$user_friend_query = "SELECT * FROM friends WHERE user_id = '$user_id' or friend_id = '$user_id'";
	$user_group_query = "SELECT * FROM group_member WHERE group_member_user_id = '$user_id'";
	$user_challenge_query = "SELECT * FROM challenge_member WHERE challenge_user_id = '$user_id'";
	$user_data = mysql_query($user_query,$dbconn);
	$user_friend_data = mysql_query($user_friend_query,$dbconn);
	$user_group_data = mysql_query($user_group_query,$dbconn);
	$user_challenge_data = mysql_query($user_challenge_query,$dbconn);

	$user_group_number = mysql_num_rows($user_group_data);
	$user_challenges_number = mysql_num_rows($user_challenge_data);
	$user_friend_number = mysql_num_rows($user_friend_data);

	while($user_row = mysql_fetch_array($user_data))
		{
			$user_name = $user_row['username'];
			$first_name = $user_row['first_name'];
			$last_name = $user_row['last_name'];
			$user_age = date("Y") - date("Y",strtotime($user_row['user_day_of_birth']));
			$user_member_date = date("Y",strtotime($user_row['user_date_created']));
		}
	while($user_friend_row = mysql_fetch_array($user_friend_data))
		{
			$friend_user_id = $user_friend_row['user_id'];
			$friend_friend_id = $user_friend_row['friend_id'];

			if($friend_user_id==$user_id && $friend_friend_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_friend_id'";	
				$friend_data = mysql_query($friend_query,$dbconn);
				while($friend_row = mysql_fetch_array($friend_data))
				{
					$friend_list_display[$x] = $friend_row['username'];
				}
			}
			elseif($friend_friend_id==$user_id && $friend_user_id!=$user_id)
			{
				$friend_query = "SELECT * FROM user WHERE user_id = '$friend_user_id'";
				$friend_data = mysql_query($friend_query,$dbconn);
				while($friend_row = mysql_fetch_array($friend_data))
				{
					$friend_list_display[$x] = $friend_row['username'];
				}	
			}
			$x++;
		}
	// while($user_group_row = mysql_fetch_array($user_group_data))
	// 	{
	// 		$user_name = $user_group_row['username'];
	// 	}
	// while($user_challenge_row = mysql_fetch_array($user_challenge_data))
	// 	{
	// 		$user_name = $user_challenge_row['username'];
	// 	}
?>