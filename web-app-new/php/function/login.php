<?php
	include('connect.php');
	session_start();
	$error_msg="";
	//if user has logged in, go to dashboard page
	if(isset($_SESSION['user_id'])){
		header('Location: /v0-6/dashboard.php');
	}
	// $search_all_challenge_data_query = "SELECT * FROM challenge WHERE challenge_finish_date >= DATE(NOW()) AND challenge_progress < challenge_goal ORDER BY challenge_name";
	// $all_challenge_data = mysqli_query($dbconn, $search_all_challenge_data_query);
	// while($all_challenge_row2 = mysqli_fetch_array($all_challenge_data))
	// 	{
	// 		$all_challenge_id = $all_challenge_row2['challenge_id'];
	// 		$all_challenge_start_date = $all_challenge_row2['challenge_start_date'];
	// 		$all_challenge_end_date = $all_challenge_row2['challenge_finish_date'];
	// 		$all_challenge_goal_type = $all_challenge_row2['challenge_goal_type'];
	// 		$all_challenge_member_query = "SELECT * FROM challenge_member WHERE challenge_id='$all_challenge_id'";
	// 		$all_challenge_member_data = mysqli_query($dbconn, $delete_challenge_data_query);
	// 		while($all_challenge_member_row = mysqli_fetch_array($all_challenge_member_data))
	// 		{
	// 			$challenge_member_id[$e]=$all_challenge_member_row['challenge_user_id'];
	// 			$e++;
	// 		}
	// 		$all_challenge_member_session_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_user_id IN ($search_challenge_id_array) AND DATE(session_date)<=$all_challenge_end_date AND DATE(session_date)>=$all_challenge_start_date";
	// 		$all_challenge_member_session_data = mysqli_query($dbconn, $all_challenge_member_session_query);
	// 		$challenge_session_data=0;
	// 		while($all_challenge_member_session_row = mysqli_fetch_array($all_challenge_member_session_data))
	// 		{
	// 			if($all_challenge_goal_type=="steps")
	// 			{
	// 				$challenge_session_data=$challenge_session_data+$all_challenge_member_session_row['session_steps'];
	// 			}
	// 			else if($all_challenge_goal_type=="distance")
	// 			{
	// 				$challenge_session_data=$challenge_session_data+$all_challenge_member_session_row['session_distance'];
	// 			}
	// 			else
	// 			{
	// 				if($all_challenge_member_session_row['user_gender']=="Male")
	// 				{
	// 					$BMR = 66 + (13.75 * $all_challenge_member_session_row['user_weight']) + (5 * $all_challenge_member_session_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($all_challenge_member_session_row['user_day_of_birth']))));
	// 					$MET = 2;
	// 					$hour_graph_cal = round(($BMR/24)*$MET*($all_challenge_member_session_row['session_time_length']/3600));
	// 					$challenge_session_data = $hour_graph_cal + $challenge_session_data;
	// 				}
	// 				else
	// 				{
	// 					$BMR = 655 + (13.75 * $all_challenge_member_session_row['user_weight']) + (5 * $all_challenge_member_session_row['user_height']) - (6.76 * (date("Y") - date("Y",strtotime($all_challenge_member_session_row['user_day_of_birth']))));
	// 					$MET = 2;
	// 					$hour_graph_cal = round(($BMR/24)*$MET*($all_challenge_member_session_row['session_time_length']/3600));
	// 					$challenge_session_data = $hour_graph_cal + $challenge_session_data;
	// 				}

	// 			}
	// 			$f++;
	// 		}

	// 		if($challenge_session_data>=$all_challenge_row2['challenge_goal'])
	// 		{
	// 			$challenge_goal = $all_challenge_row2['challenge_goal'];
	// 			$add_challenge_session_data_query = "UPDATE challenge SET challenge_progress='$challenge_goal' WHERE challenge_id = '$all_challenge_id'";
	// 	        mysqli_query($dbconn, $add_challenge_session_data_query);
	// 		}
	// 		else
	// 		{
	// 			$add_challenge_session_data_query = "UPDATE challenge SET challenge_progress='$challenge_session_data' WHERE challenge_id = '$all_challenge_id'";
	// 	        mysqli_query($dbconn, $add_challenge_session_data_query);
	// 		}					
	// 	}

	//Login Verification
	if(isset($_POST['login']))
	{

	    $username = $_POST['username'];
	    $password = hash('sha256', $_POST['password']);
	    
	    $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
	    $data = mysqli_query($dbconn, $query);
	    $num_data = mysqli_num_rows($data);

	    //if username and password mismatch, display error message  
	    if($num_data==0)
	    {
	    	// error message show in the website
	    	$error_msg="Incorrect username or password.";
	    }
	    else
	    {
	    	//if username and password match, store admin_id and go to admin page   
		    while($row = mysqli_fetch_array($data))
		    {	    	
		    	$_SESSION['user_id'] = $row['user_id'];
		    	header('Location: /v0-6/dashboard.php');
		    }
		}
	}
?>