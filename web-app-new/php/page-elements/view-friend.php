<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
	$user_id = $_GET['userid']; // getting user_id from the ajax request, use this to get other info from db
	$_SESSION["friend_id"] = $user_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');

?>

<div class="section">
	<div class="profile-image"></div>
	<p class="profile-name"><?php echo $friend_first_name; ?> <?php echo $friend_last_name; ?></p>
	<p class="profile-detail"><?php echo $friend_age; ?> years old</p>
	<p class="profile-detail">UQGO user since <?php echo $friend_member_date;?></p>
	<!-- If user is friends, show Remove button: -->
	<p><button class="button-primary" onClick="removeFriend('echo $user_id here', this)"><i class="fa fa-user-times"></i> Remove Friend</button></p>
	<!-- Else, show Add button: -->
 	<p><button class="button-primary" onClick="addFriend('echo $user_id here', this)"><i class="fa fa-user-plus"></i> Add Friend</button></p>

</div>
<div class="section">
	<p class="section-header">Compare Stats</p>
	<!-- If user is friends, show stats -->
	<p class="">placeholder stat will be implemented</p>
	<p class="">placeholder stat will be implemented</p>
	<p class="">placeholder stat will be implemented</p>
	<!-- Else, show this notice: -->
	<p><i class="fa fa-info-circle"></i> You must be friends with this user to see their stats.</p>


</div>
