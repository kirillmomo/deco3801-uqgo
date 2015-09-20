<?php
	$user_id = $_GET['userid']; // getting user_id from the ajax request, use this to get other info from db

	$first_name = "Test";
	$last_name = "Name";
	$user_age = "25";
	$user_member_date = "April 2015";
?>

<div class="section">
	<div class="profile-image"></div>
	<p class="profile-name"><?php echo $first_name; ?> <?php echo $last_name; ?></p>
	<p class="profile-detail"><?php echo $user_age; ?> years old</p>
	<p class="profile-detail">UQGO user since <?php echo $user_member_date; ?></p>
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
	<p>You must be friends with this user to see their stats.</p>


</div>