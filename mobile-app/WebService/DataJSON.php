<?php

include("connect.php");

//This play is aim on retrieve data from user's table and display as JSON foromat.
// Therefore, the app can request data from database 
// array for JSON response
$response = array();

$response["UserInfo"] = array();


 $query = "SELECT * FROM session";
	$result = mysqli_query($dbconn, $query);

	while($row = mysqli_fetch_array($result)){
		$userid = $row['userid'];
		$steps = $row['steps'];
	}

	$query_info = "SELECT * FROM basicInfo WHERE id = ".$userid." ";
	$result_info = mysqli_query($dbconn, $query_info);
//building JSON data
	while($row = mysqli_fetch_array($result_info)){

        
        
		$newsJSON = array();
            $newsJSON["id"] = $row['id'];
            $newsJSON["Name"] = $row['Name'];
            $newsJSON["Height"] = $row['Height'];
            $newsJSON ["Steps"] = $steps;
            
            array_push($response["UserInfo"], $newsJSON);// join it as a JSON
    $response["success"] = 1;
	}
      

echo json_encode($response);// display JSON

?>


