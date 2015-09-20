<?php
	$rank_by = $_GET['rankBy']; // getting ranking option from the ajax request
	for($i = 0; $i<sizeof($friend_list_display); $i++)
	{
	?>
	<li onClick="showProfile('echo user_id here', this);"><div class="friend-image"></div><p><?php echo $friend_list_display[$i]; ?></p></li>
	<?php
	}
?>

<!-- EXAMPLE FRIENDS LIST - friends should be echoed like below -->
<!-- <li onClick="showProfile('1', this);"><div class="friend-image"></div><p>Johnson Carter</p></li>
<li onClick="showProfile('2', this);"><div class="friend-image"></div><p>Johnson Jackson</p></li>
<li onClick="showProfile('3', this);"><div class="friend-image"></div><p>Jenson Carter</p></li>
<li onClick="showProfile('4', this);"><div class="friend-image"></div><p>Jenson Jackson</p></li> -->