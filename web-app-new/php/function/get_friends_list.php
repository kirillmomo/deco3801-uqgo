<?php

	// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
	// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');

	$rank_by = $_SESSION['rankBy']; // getting ranking option from the ajax request
	for($i = 0; $i<sizeof($friend_list_display); $i++)
	{
	?>
	<li onClick="showProfile('<?php echo $friend_list_id[$i]; ?>', this);"><div class="friend-image"></div><p><?php echo $friend_list_display[$i]; ?></p></li>
	<?php
	}
?>

<!-- EXAMPLE FRIENDS LIST - friends should be echoed like below -->