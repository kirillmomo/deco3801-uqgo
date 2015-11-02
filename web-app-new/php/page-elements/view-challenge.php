<?php
	// Include session php file to start PHP session 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	$challenge_id = $_GET['challenge_id']; // getting challenge_id from the ajax request,
	$_SESSION['challenge_id'] = $challenge_id;
	// Include challenge_data php file to get user challenge data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/button_status.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/challenge_data.php');
?>

<div class="section">
	<p class="profile-name"><?php echo $challenge_detail_name; ?></p>
	<!-- For the line below, depending on the goal, show it as either:
			*Complete 1000 steps in 7 days
			*Walk 1000km in 7 days
			*Burn 10000 calories in 7 days-->
	<p class="profile-detail challenge-description">Complete <?php echo $challenge_detail_goal; ?> <?php echo $challenge_detail_type; ?>  in <?php echo $challenge_detail_day_left; ?> days</p>
	<p class="profile-detail"><?php echo $total_user_join_num; ?> participants</p>
	<p class="profile-detail">Duration: <?php echo $challenge_detail_start_date; ?> - <?php echo $challenge_detail_end_date; ?></p>
	


	<?php
	if($challenge_button_status_condition == "joined")
		{?>
	<!-- If user is NOT in group, show Join button: -->
	<p><button class="button-primary" onClick="leaveChallenge('<?php echo $challenge_id?>', this)"><i class="fa fa-calendar-minus-o"></i> Leave Challenge</button></p>
	<?php
		}
	else if($challenge_button_status_condition == "not-joined")
		{?>
	<!-- Else, show Leave button: -->
	<p><button class="button-primary" onClick="joinChallenge('<?php echo $challenge_id?>', this)"><i class="fa fa-calendar-plus-o"></i> Join Challenge</button></p>
	<?php
		}?>
</div>
<div class="section">
	<p class="section-header">Progress</p>
	<div class="progress-left">
		<canvas id="progress-chart" width="200" height="200"></canvas>
	</div>
	<div class="progress-right">
		<div>
			<p><span class="goal-progress"><?php echo $challenge_detail_progress; ?></span>/<?php echo $challenge_detail_goal; ?></p>
			<p><?php echo $challenge_detail_type; ?> completed</p>
		</div>
	</div>
	<p class="challenge-days"><span class="challenge-days-passed"><?php echo $challenge_detail_duration_day_left; ?></span>/<?php echo $challenge_detail_day_left; ?> days passed</p>
	<div class="challenge-time">
		<p><?php echo $challenge_detail_start_date; ?></p>
		<div id="challenge-time-bar"></div>
		<p><?php echo $challenge_detail_end_date; ?></p>
	</div>
	<p class="challenge-days-remaining"><?php echo $challenge_detail_remaining_time_left?> days remaining</p>
</div>
<div class="section">
	<p class="section-header">Participants</p>
	<ul class="members-list">
		<!-- Echo group members in alphabetical order -->
		<?php
		for($i = 0; $i<sizeof($search_challenge_joined_user_id); $i++)
		{

			$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$search_challenge_joined_user_id[$i].'.jpg');
	        if($pic_status==true)
	        {?>
	        <li><div class="friend-image" style="background-image: url(/profile_img/users/<?php echo $search_challenge_joined_user_id[$i]?>.jpg)"></div><p><?php echo $search_challenge_joined_user_first_name[$i]?> <?php echo $search_challenge_joined_user_last_name[$i]?></p></li>
	        <?php }
	        else
	        {?>
	    	 <li><div class="friend-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div><p><?php echo $search_challenge_joined_user_first_name[$i]?> <?php echo $search_challenge_joined_user_last_name[$i]?></p></li>
	    <?php }
	    } 
		?>
	</ul>
</div>