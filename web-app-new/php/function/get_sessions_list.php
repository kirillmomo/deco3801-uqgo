<?php
	// Include Session php file to start PHP session 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	$filterTime = $_GET['filterTime']; //getting filter option from ajax request
	$_SESSION["filter_time"] = $filterTime;

	// Include session_data php file to get user track session data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_data.php');

	for($i = 0; $i<sizeof($track_session_id); $i++)
	{
	?>
	<li onClick="showSession('<?php echo $track_session_id[$i]; ?>', this);"><p><i class="fa fa-map-marker"></i><?php echo $track_session_time[$i]; ?></p></li>
	<?php
	}
?>