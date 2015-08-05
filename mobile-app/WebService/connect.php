<?php
	//Connect to the phpmyadmin database
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "IHeBUDimybnos";
	$dbname = "TestBrian";
	$userstable = "users";
	
	$dbconn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if($dbconn->connect_errno > 0){
	
		die("Unable to connect to database [".$db->connect_error."]");
	
	} else {
		//echo "I am all good";
	}
	
/*	error_log("All ready to go");	
	
	$query=("SELECT * FROM `users`");
	$users =$dbconn->query($query);
*/

?>