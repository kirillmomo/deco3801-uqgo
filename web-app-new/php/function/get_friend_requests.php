<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/user_data.php');

	for($i = 0; $i<sizeof($search_friend_request_user_id); $i++)
	{
		?>
        <li>
			<p><?php echo $search_friend_request_first_name[$i]; ?> <?php echo $search_friend_request_last_name[$i]; ?> sent you a friend request.</p>
			<p><a class="button button-primary" onClick="acceptFriend('<?php echo $search_friend_request_user_id[$i]; ?>');">Accept</a><a class="button" onClick="declineFriend('<?php echo $search_friend_request_user_id[$i]; ?>');">Decline</a></p>
		</li>    
        <?php     	
	}
?>
