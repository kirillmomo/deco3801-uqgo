<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');
	include('connect.php');
	$user_id=$_SESSION['user_id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$dob_day = $_POST['dob_day'];
	$dob_month = $_POST['dob_month'];
	$dob_year = $_POST['dob_year'];
	$dob= $dob_year . "-" . $dob_month . "-" . $dob_day;


	if(isset($_POST['first_name']))
	{
	$update_user_query = "UPDATE user SET first_name='$first_name', last_name='$last_name', username='$username', user_email='$email', user_day_of_birth ='$dob' WHERE user_id='$user_id'";
	mysql_query($update_user_query);
	}

?>