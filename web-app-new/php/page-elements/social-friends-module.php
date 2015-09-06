<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/user_data.php');
?>

<div class="container friends">
	<div class="row">
		<div class="twelve columns">
			<div class="info-box">
				<p class="info-box-header">Friends</p>
				<ul class="friends-list">
				<?php
				for($i = 0; $i<sizeof($friend_list_display); $i++)
				{
				?>
				<li><?php echo $friend_list_display[$i]; ?></li>
				<?php
				}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>