<?php
	//Connect to the phpmyadmin database
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "IHeBUDimybnos";
	$dbname = "uq_go_db";
	$userstable = "user";
	
	$dbconn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if($dbconn->connect_errno > 0){
	
		die("Unable to connect to database [".$db->connect_error."]");
	
	} else {

	}
	
/*	error_log("All ready to go");	
	
	$query=("SELECT * FROM `users`");
	$users =$dbconn->query($query);
*/

?>