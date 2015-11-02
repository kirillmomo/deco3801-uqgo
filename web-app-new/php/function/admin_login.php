<?php
	// include the connect php file
	include('connect.php');
	// session start
	session_start();
	$error_msg="";
	//if user has logged in, go to admin page
	if(isset($_SESSION['admin_id'])){
	header('Location: /v0-6/admin.php');
	}

	//Login Verification
	if(isset($_POST['login']))
	{

	    $username = $_POST['username'];
	    $password = hash('sha256', $_POST['password']);
	    
	    $query = "SELECT * FROM admin WHERE admin_username='$username' and admin_password='$password'";
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
		    while($row = mysqli_fetch_array($data))
		    {	
		    	//if username and password match, store admin_id and go to admin page    	
		    	$_SESSION['admin_id'] = $row['admin_id'];
		    	header('Location: /v0-6/admin.php');
		    }
		}
	}
?>