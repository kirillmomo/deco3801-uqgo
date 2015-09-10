<?php

// Include session_start and user_data file.

// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/user_data.php');
?>

<div class="container profile">
	<div class="row">
		<div class="four columns">
			<div class="profile-image">
			</div>
		</div>
		<div class="eight columns">
			<div class="">
				<p class="profile-name"><?php echo $first_name; ?> <?php echo $last_name; ?></p>
				<p class="profile-detail"><?php echo $user_age; ?> years old</p>
				<p class="profile-detail">UQGO user since <?php echo $user_member_date; ?></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Friends</p>
				<p class="data-text"><?php echo $user_friend_number?></i></p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Groups</p>
				<p class="data-text"><?php echo $user_group_number?></i></p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Challenges</p>
				<p class="data-text"><?php echo $user_challenges_number?></i></p>
			</div>
		</div>
	</div>
</div>