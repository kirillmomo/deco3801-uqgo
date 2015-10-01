<?php
	$group_id = $_GET['group_id']; // getting group_id from the ajax request, use this to get other info from db
?>

<div class="section">
	<div class="profile-image"></div>
	<p class="profile-name">Group Name</p>
	<p class="profile-detail">420 members</p>
	<p class="profile-detail">Created in April 2015</p>
	<!-- If user is NOT in group, show Join button: -->
	<p><button class="button-primary" onClick="joinGroup('echo group id', this)"><i class="fa fa-plus"></i> Join Group</button></p>
	<!-- Else, show Leave button: -->
	<p><button class="button-primary" onClick="leaveGroup('echo group id', this)"><i class="fa fa-minus"></i> Leave Group</button></p>
</div>
<div class="section">
	stuff
</div>
