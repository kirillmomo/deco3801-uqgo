<?php
	include('connect.php');
	session_start();
	$error_msg="";
	//if user has logged in, go to index page
	if(isset($_SESSION['admin_id'])){
	header('Location: /v0-1/admin.php');
	// header('Location: /Beta/web-app-new/admin.php');
	}

	//Login Verification
	if(isset($_POST['login']))
	{

	    $username = $_POST['username'];
	    $password = $_POST['password'];
	    
	    $query = "SELECT * FROM admin WHERE admin_username='$username' and admin_password='$password'";
	    $data = mysql_query($query,$dbconn);
	    $num_data = mysql_num_rows($data);
	    if($num_data==0)
	    {
	    	$error_msg="Incorrect username or password.";
	    }
	    else
	    {
		    while($row = mysql_fetch_array($data))
		    {	    	
		    	$_SESSION['admin_id'] = $row['admin_id'];
		    	header('Location: /v0-1/admin.php');
				// header('Location: /Beta/web-app-new/admin.php');
		    }
		}
	}
?>