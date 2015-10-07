<?php
	$challenge_id = $_GET['challenge_id']; // getting challenge_id from the ajax request,
?>

<div class="section">
	<p class="profile-name">Challenge Name</p>
	<!-- For the line below, depending on the goal, show it as either:
			*Complete 1000 steps in 7 days
			*Walk 1000km in 7 days
			*Burn 10000 calories in 7 days-->
	<p class="profile-detail">Complete 1000 steps in 7 days</p>
	<p class="profile-detail">20 participants</p>
	<p class="profile-detail">Duration: 1/19/15</p>
	
		<!-- If user is NOT in group, show Join button: -->
	<p><button class="button-primary" onClick="leaveChallenge('echo challenge_id here', this)"><i class="fa fa-minus"></i> Leave Challenge</button></p>
		<!-- Else, show Leave button: -->
	<p><button class="button-primary" onClick="joinChallenge('echo challenge_id here', this)"><i class="fa fa-plus"></i> Join Challenge</button></p>
</div>
<div class="section">
	<p class="section-header">Progress</p>
	<canvas id="progress-chart" width="200" height="200"></canvas>
</div>
<div class="section">
	<p class="section-header">Participants</p>
	<ul class="members-list">
		<!-- Echo group members in alphabetical order -->
		<li><div class="friend-image"></div><p>Viktor Reznov</p></li>
		<li><div class="friend-image"></div><p>Soap Mactavish</p></li>
		<li><div class="friend-image"></div><p>Captain Price</p></li>
	</ul>
</div>