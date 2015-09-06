<?php
	include('connect.php');

	//if user hasn't logged in, go back to login page
	if(empty($_SESSION['user_id'])){
		header('Location: /Beta/web-app-new/index.php');
	}

	$user_id = $_SESSION['user_id'];
	$user_name="";

	$user_query = "SELECT * FROM user WHERE user_id = '$user_id'";	
	$user_data = mysql_query($user_query,$dbconn);

	while($user_row = mysql_fetch_array($user_data))
		{
			$user_name = $user_row['username'];
		}

?>