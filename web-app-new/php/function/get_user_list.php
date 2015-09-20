<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
	$search = $_GET['search']; // getting search term from ajax request
	$_SESSION["search"] = $search;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');
	// Do a search for user's full names containing the search term
	// Ensure that list returned are not already friends with the user
?>

<!-- EXAMPLE RETURNED LIST - users should be echoed like below -->
for($i = 0; $i<sizeof($friend_list_display); $i++)
	{
	?>
	<li onClick="showProfile('<?php echo $friend_list_id[$i]; ?>', this);"><div class="friend-image"></div><p><?php echo $friend_list_display[$i]; ?></p></li>
	<?php
	}
?>