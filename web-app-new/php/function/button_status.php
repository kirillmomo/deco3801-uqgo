<?php
		
	// Include connect php file
	include('connect.php');

	$button_status_condition="";
	$button_status_user_id=$_SESSION['user_id'];
	$button_status_friend_id=$_SESSION['friend_id'];
	$button_status_query1 = "SELECT * FROM friends WHERE user_id = $button_status_user_id AND friend_id = $button_status_friend_id";
	$button_status_query2 = "SELECT * FROM friends WHERE user_id = $button_status_friend_id AND friend_id = $button_status_user_id";
	$button_status_data1 = mysqli_query($dbconn, $button_status_query1);
	$button_status_data2 = mysqli_query($dbconn, $button_status_query2);
	$button_status1 = mysqli_fetch_array($button_status_data1);
	$button_status2 = mysqli_fetch_array($button_status_data2);

	if($button_status_friend_id!=null && $button_status_user_id!=null)
	{

		if ($button_status1==false && $button_status2==false) 
		{
			$button_status_condition="user";
		}
		else
		{
			$button_status_condition="friend";
		}
	}

	$group_button_status_condition="";
	$group_button_status_user_id=$_SESSION['user_id'];
	$group_button_status_group_id=$_SESSION['group_id'];
	$group_button_status_query1 = "SELECT * FROM group_member WHERE group_member_user_id = $group_button_status_user_id AND group_id = $group_button_status_group_id";
	$group_button_status_data1 = mysqli_query($dbconn, $group_button_status_query1);
	$group_button_status1 = mysqli_fetch_array($group_button_status_data1);

	if($group_button_status_user_id!=null && $group_button_status_group_id!=null)
	{

		if ($group_button_status1==false) 
		{
			$group_button_status_condition="not-joined";
		}
		else
		{
			$group_button_status_condition="joined";
		}
	}

	$challenge_button_status_condition="";
	$challenge_button_status_user_id=$_SESSION['user_id'];
	$challenge_button_status_challenge_id=$_SESSION['challenge_id'];
	$challenge_button_status_query1 = "SELECT * FROM challenge_member WHERE challenge_user_id = $challenge_button_status_user_id AND challenge_id = $challenge_button_status_challenge_id";
	$challenge_button_status_data1 = mysqli_query($dbconn, $challenge_button_status_query1);
	$challenge_button_status1 = mysqli_fetch_array($challenge_button_status_data1);

	if($challenge_button_status_user_id!=null && $challenge_button_status_challenge_id!=null)
	{

		if ($challenge_button_status1==false) 
		{
			$challenge_button_status_condition="not-joined";
		}
		else
		{
			$challenge_button_status_condition="joined";
		}
	}


?>