<?php
	// find detail.txt for SQL username and password and store in array
	$logindetail = array();
	$i=0;
	$file = fopen($_SERVER['DOCUMENT_ROOT']."/v0-2/detail.txt","r");

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
	// $dbuser = "root";
	// $dbpass = "";
	$dbname = "uq_go_db_v02";	
	$dbconn = mysql_connect($dbhost, $dbuser, $dbpass);
	
	// if unable connect to the database, show error
	if(! $dbconn )
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbname);
?>