<?php
	
	// Update user body status and gender
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include('connect.php');
	$user_id=$_SESSION['user_id'];
	$height = $_POST['height'];
	$weight = $_POST['weight'];
	$gender = $_POST['gender'];

	if(isset($_POST['height'])||isset($_POST['weight'])||isset($_POST['gender']))
	{
	$update_user_query = "UPDATE user SET user_height='$height', user_weight='$weight', user_gender='$gender' WHERE user_id='$user_id'";
	mysqli_query($dbconn, $update_user_query);
	}
?>