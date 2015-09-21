<?php
		
	// Include connect php file
	include('connect.php');

	$button_status_condition="";
	$button_status_user_id=$_SESSION['user_id'];
	$button_status_friend_id=$_SESSION['friend_id'];
	$button_status_query1 = "SELECT * FROM friends WHERE user_id = $button_status_user_id AND friend_id = $button_status_friend_id";
	$button_status_query2 = "SELECT * FROM friends WHERE user_id = $button_status_friend_id AND friend_id = $button_status_user_id";
	$button_status_data1 = mysql_query($button_status_query1,$dbconn);
	$button_status_data2 = mysql_query($button_status_query2,$dbconn);
	$button_status1 = mysql_fetch_array($button_status_data1);
	$button_status2 = mysql_fetch_array($button_status_data2);

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

?>