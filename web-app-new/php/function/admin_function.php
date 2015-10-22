<?php
	
	// Include session_strat.php and connect.php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/session_start.php');
	include('connect.php');

	$min_age=(date("Y") - $_POST['min_age'])."-12-31";
	$max_age=(date("Y") - $_POST['max_age'])."-1-1";
	$gender=$_POST['gender'];
	$min_height=$_POST['min_height'];
	$max_height=$_POST['max_height'];
	$min_weight=$_POST['min_weight'];
	$max_weight=$_POST['max_weight'];
	$min_step=$_POST['min_step'];
	$max_step=$_POST['max_step'];
	$min_distance=$_POST['min_distance'];
	$max_distance=$_POST['max_distance'];
	$min_date=date("Y",strtotime($_POST['min_date']))."-".date("m",strtotime($_POST['min_date']))."-".date("d",strtotime($_POST['min_date']));
	$max_date=date("Y",strtotime($_POST['max_date']))."-".date("m",strtotime($_POST['max_date']))."-".date("d",strtotime($_POST['max_date']))." 23:59:59";
	$user_first_name = array();
	$user_last_name = array();
	$user_age = array();
	$user_gender= array();
	$user_height = array();
	$user_weight = array();
	$session_steps = array();
	$session_distance = array();
	$session_cal = array();
	$all_total_data = 0;
	$i=0;

	if($_POST['min_age']!=""&& $_POST['max_age']=="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_day_of_birth <= '$min_age'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}

	}
	else if($_POST['min_age']==""&& $_POST['max_age']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_day_of_birth >= '$max_age'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['session_id'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_age']!="" && $_POST['max_age']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_day_of_birth <= '$min_age' AND user_day_of_birth >= '$max_age'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST["gender"]!="")
	{
		if(in_array("Male",$_POST["gender"]))
		{
			$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_gender = 'Male'";
		}
		else if (in_array("Female",$_POST["gender"])) 
		{
			$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_gender = 'Female'";
		}
		else
		{
			$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id";
		}
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_height']!="" && $_POST['max_height']=="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_height >= '$min_height'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}

	}
	else if($_POST['min_height']=="" && $_POST['max_height']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_height <= '$max_height'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_height']!="" && $_POST['max_height']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_height >= '$min_height' AND user_height <= '$max_height'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}

	else if($_POST['min_weight']!=""&& $_POST['max_weight']=="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_weight >= '$min_weight'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}

	}
	else if($_POST['min_weight']==""&& $_POST['max_weight']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_weight <= '$max_weight'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_weight']!="" && $_POST['max_weight']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE user_weight >= '$min_weight' AND user_weight <= '$max_weight'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_step']!=""&& $_POST['max_step']=="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_steps >= '$min_step'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}

	}
	else if($_POST['min_step']==""&& $_POST['max_step']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_steps <= '$max_step'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_step']!="" && $_POST['max_step']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_steps >= '$min_step' AND session_steps <= '$max_step'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_distance']!=""&& $_POST['max_distance']=="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_distance >= '$min_distance'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}

	}
	else if($_POST['min_distance']==""&& $_POST['max_distance']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_distance <= '$max_distance'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_distance']!="" && $_POST['max_distance']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_distance >= '$min_distance' AND session_distance <= '$max_distance'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_date']!="" && $_POST['max_date']=="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_date >= '$min_date'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['first_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}

	}
	else if($_POST['min_date']=="" && $_POST['max_date']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_date <= '$max_date'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else if($_POST['min_date']!="" && $_POST['max_date']!="")
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id WHERE session_date >= '$min_date' AND session_date <= '$max_date'";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}	
	}
	else
	{
		$all_data_query = "SELECT * FROM user INNER JOIN session ON user.user_id = session.session_user_id ";
		$all_user_data = mysqli_query($dbconn, $all_data_query);
		while($all_user_row = mysqli_fetch_array($all_user_data))
			{
				$user_first_name[$i] = $all_user_row['first_name'];
				$user_last_name[$i] = $all_user_row['last_name'];
				$user_age[$i] = date("Y") - date("Y",strtotime($all_user_row['user_day_of_birth']));
				$user_gender[$i] = $all_user_row['user_gender'];
				$user_height[$i] = $all_user_row['user_height'];
				$user_weight[$i] = $all_user_row['user_weight'];
				$session_steps[$i] = $all_user_row['session_steps'];
				$session_distance[$i] = $all_user_row['session_distance'];
				if($user_gender[$i]=="Male")
				{
					$BMR = 66 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				else
				{
					$BMR = 655 + (13.75 * $user_weight[$i]) + (5 * $user_height[$i]) - (6.76 * $user_age[$i]);
					$MET = 2;
					$session_cal[$i] = round(($BMR/24)*$MET*$all_user_row['session_time_length']);
				}
				$i++;	
			}
	}
?>
