<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	// Include connect php file
	include('connect.php');

	$challenge_user_id = $_SESSION['user_id'];
	$challenge_name = $_POST['challenge_name'];
	$challenge_goal_type = $_POST['challenge_goal_type'];
	$goal_amount = $_POST['goal_amount'];
	$challenge_duration = '+'. $_POST['challenge_duration'] .' days';
	$challenge_start_date = date("Y-m-d");
	$challenge_end_date = date("Y-m-d",strtotime($challenge_duration));

	$create_challenge_query = "INSERT INTO challenge SET challenge_user_id='$challenge_user_id', challenge_name='$challenge_name', challenge_goal_type = '$challenge_goal_type', challenge_goal = '$goal_amount', challenge_progress = 0, challenge_start_date = '$challenge_start_date', challenge_finish_date = '$challenge_end_date'";
	mysqli_query($dbconn, $create_challenge_query);
	$new_challenge_id=mysqli_insert_id($dbconn);

	$joining_challenge_query = "INSERT INTO challenge_member SET challenge_user_id='$challenge_user_id', challenge_id='$new_challenge_id'";
	mysqli_query($dbconn, $joining_challenge_query);


	echo $new_challenge_id; //echo back the new challenge's id
?>