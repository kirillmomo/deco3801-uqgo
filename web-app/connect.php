<?php
	
	$logindetail = array();
	$i=0;
	$file = fopen("detail.txt","r");

	while(! feof($file))
	  {
	  $logindetail[$i] = trim(fgets($file));
	  $i++;
	  }

	fclose($file);

	//Connect to the phpmyadmin database
	$dbhost = "localhost";
	$dbuser = $logindetail[0];
	$dbpass = $logindetail[1];
	$dbname = "uq_go_db";	
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass);
	
	if(! $dbconn )
{
  die('Could not connect: ' . mysql_error());
}
	mysql_select_db($dbname);
	
/*	error_log("All ready to go");	
	
	$query=("SELECT * FROM `users`");
	$users =$dbconn->query($query);
*/

?>