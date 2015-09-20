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
	<p><button class="button-primary"><i class="fa fa-remove"></i>
 Remove Friend</button></p>
</div>
<div class="section">
	<p class="section-header">Compare Stats</p>
	<p class="">1023</p>
	<p class="">1023</p>
	<p class="">1023</p>
</div>