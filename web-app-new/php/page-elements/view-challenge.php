<?php
	$challenge_id = $_GET['challenge_id']; // getting challenge_id from the ajax request,
?>

<div class="section">
	<p class="profile-name">Challenge Name</p>
	<!-- For the line below, depending on the goal, show it as either:
			*Complete 1000 steps in 7 days
			*Walk 1000km in 7 days
			*Burn 10000 calories in 7 days-->
	<p class="profile-detail challenge-description">Complete 1000 steps in 7 days</p>
	<p class="profile-detail">20 participants</p>
	<p class="profile-detail">Duration: 1/19/15 - 8/19/15</p>
	
		<!-- If user is NOT in group, show Join button: -->
	<p><button class="button-primary" onClick="joinChallenge('echo challenge_id here', this)"><i class="fa fa-calendar-plus-o"></i> Join Challenge</button></p>
		<!-- Else, show Leave button: -->
	<p><button class="button-primary" onClick="leaveChallenge('echo challenge_id here', this)"><i class="fa fa-calendar-minus-o"></i> Leave Challenge</button></p>
</div>
<div class="section">
	<p class="section-header">Progress</p>
	<div class="progress-left">
		<canvas id="progress-chart" width="200" height="200"></canvas>
	</div>
	<div class="progress-right">
		<div>
			<p><span class="goal-progress">400</span>/1000</p>
			<p>steps completed</p>
		</div>
	</div>
	<p class="challenge-days"><span class="challenge-days-passed">3</span>/7 days passed</p>
	<div class="challenge-time">
		<p>1/9/15</p>
		<div id="challenge-time-bar"></div>
		<p>8/9/15</p>
	</div>
	<p class="challenge-days-remaining">4 days remaining</p>
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