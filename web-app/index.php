<?php
	include('connect.php');
	session_start();

	//if user has logged in, go to index page
	if(isset($_SESSION['username'])){
		header('Location: homepage.php');
	}

	//Login Verification
	if(isset($_POST['login'])){

	    $username = $_POST['username'];
	    $password = $_POST['password'];
	    
	    $query = 'SELECT * FROM user WHERE username="'.$username.'" and password="'.$password.'"';
	    $result = mysqli_query($dbconn,$query);

	    while($row = mysqli_fetch_array($result)){
	    	$_SESSION['username'] = $username;
	    	header('Location: homepage.php');
	    }
	    
	}
?>

<!DOCTYPE HTML5>

<html>
	<head>
		<title>UQ GO - Login</title>
		<link rel='stylesheet' type='text/css' href='css/login.css'>
		<meta charset='utf-8'>
	</head>

	<body>
		<h1>UQ GO</h1>
		<form id='login-form' method='POST' class='center'>
			<input type='text' id='username' name='username' class='login-input' placeholder='Username'>
			<input type='password' id='password' name='password' class='login-input' placeholder='Password'>
			<input type='submit' id='login' name='login' value='Login' class='login-submit'>
		</form>
		<h2>*Please be advised to use <a href='http://www.google.com/chrome/'>Google Chrome</a> as browser for best using experience</h2>
	</body>
</html>