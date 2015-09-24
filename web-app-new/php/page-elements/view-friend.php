<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/session_start.php');
	$user_id = $_GET['userid']; // getting user_id from the ajax request, use this to get other info from db
	$_SESSION["friend_id"] = $user_id;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/button_status.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/step_data.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/distance_data.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/user_data.php');

?>

<div class="section">
	<div class="profile-image"></div>
	<p class="profile-name"><?php echo $friend_first_name; ?> <?php echo $friend_last_name; ?></p>
	<p class="profile-detail"><?php echo $friend_age; ?> years old</p>
	<p class="profile-detail">UQGO user since <?php echo $friend_member_date;?></p>
	<!-- If user is friends, show Remove button: -->
	<?php
	if($button_status_condition == "friend")
		{?>
	<p><button class="button-primary" onClick="removeFriend('<?php echo $friend_id; ?>', this)"><i class="fa fa-user-times"></i> Remove Friend</button></p>
	<?php
		}
	else if($button_status_condition == "user")
		{?>
			<p><button class="button-primary" onClick="addFriend('<?php echo $friend_id; ?>', this)"><i class="fa fa-user-plus"></i> Add Friend</button></p>
	<?php
		}?>
	<!-- Else, show Add button: -->

</div>
<div class="section">
	<?php
	if($button_status_condition == "friend")
		{?>
			<p class="section-header">Compare Stats</p>
			<!-- If user is friends, show stats -->
			<p class="">Total Step     : <?php echo $friend_total_step?></p>
			<p class="">Total Distance : <?php echo $friend_total_distance?> KM</p>
			<p class="">Total Calories : <?php echo $friend_total_calories?></p>
	<?php
		}
	else if($button_status_condition == "user")
		{?>
	<!-- Else, show this notice: -->
	<p><i class="fa fa-info-circle"></i> You must be friends with this user to see their stats.</p>
	<?php
		}?>
</div>
