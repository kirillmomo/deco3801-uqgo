<?php
<<<<<<< HEAD

	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
	$search = $_GET['search']; // getting search term from ajax request
	$_SESSION["search"] = $search;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');
=======
	$search = $_GET['search']; // getting search term from ajax request

>>>>>>> bdc3d15577dc4d7790b537d3565d50108db168c9
	// Do a search for user's full names containing the search term
	// Ensure that list returned are not already friends with the user
?>

<!-- EXAMPLE RETURNED LIST - users should be echoed like below -->
<<<<<<< HEAD
for($i = 0; $i<sizeof($friend_list_display); $i++)
	{
	?>
	<li onClick="showProfile('<?php echo $friend_list_id[$i]; ?>', this);"><div class="friend-image"></div><p><?php echo $friend_list_display[$i]; ?></p></li>
	<?php
	}
?>
=======
<li onClick="showProfile('1', this);"><div class="friend-image"></div><p>Random Fella</p></li>
<li onClick="showProfile('2', this);"><div class="friend-image"></div><p>Another Fella</p></li>
<li onClick="showProfile('3', this);"><div class="friend-image"></div><p>Some Fellow</p></li>
<li onClick="showProfile('4', this);"><div class="friend-image"></div><p>Mellow Fellow</p></li>
>>>>>>> bdc3d15577dc4d7790b537d3565d50108db168c9
