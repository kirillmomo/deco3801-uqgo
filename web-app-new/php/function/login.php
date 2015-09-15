<?php
	include('connect.php');
	session_start();
	$error_msg="";
	//if user has logged in, go to dashboard page
	if(isset($_SESSION['user_id'])){
		header('Location: /v0-2/dashboard.php');
	// header('Location: /Beta/web-app-new/dashboard.php');
	}

	//Login Verification
	if(isset($_POST['login']))
	{

	    $username = $_POST['username'];
	    $password = $_POST['password'];
	    
	    $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
	    $data = mysql_query($query,$dbconn);
	    $num_data = mysql_num_rows($data);
	    //if username and password mismatch, display error message  
	    if($num_data==0)
	    {
	    	// error message show in the website
	    	$error_msg="Incorrect username or password.";
	    }
	    else
	    {
	    	//if username and password match, store admin_id and go to admin page   
		    while($row = mysql_fetch_array($data))
		    {	    	
		    	$_SESSION['user_id'] = $row['user_id'];
		    	header('Location: /v0-2/dashboard.php');
				// header('Location: /Beta/web-app-new/dashboard.php');
		    }
		}
	}
?>