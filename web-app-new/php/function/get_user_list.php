<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/session_start.php');
	$search = $_GET['search']; // getting search term from ajax request
	$_SESSION["search"] = $search;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/button_status.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/user_data.php');
	// Do a search for user's full names containing the search term
	// Ensure that list returned are not already friends with the user

// EXAMPLE RETURNED LIST - users should be echoed like below

	if($error_msg!="")
	{
	?><p><?php echo $error_msg; ?></p><?php
	}
for($i = 0; $i<sizeof($search_friend_id); $i++)
	{
	?>
	<li onClick="showProfile('<?php echo $search_friend_id[$i]; ?>', this);"><div class="friend-image"></div><p><?php echo $search_friend_firstname[$i]; ?> <?php echo $search_friend_lastname[$i]; ?></p></li>
	<?php
	}
?>