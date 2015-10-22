<?php

	// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	
	$user_id = $_GET['userid']; // getting user_id from the ajax request, use this to get other info from db
	$_SESSION["friend_id"] = $user_id;

	$rank_by = $_GET['rankBy']; // getting ranking option from the ajax request
	$_SESSION["rank_by"] = $rank_by;

	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/button_status.php');
	// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/user_data.php');

	for($i = 0; $i<sizeof($friend_list_display); $i++)
	{
		$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$friend_list_id[$i].'.jpg');
        if($pic_status==true)
        {?>
        <li onClick="showProfile('<?php echo $friend_list_id[$i]; ?>', this);"><div class="friend-image" style="background-image: url(/profile_img/users/<?php echo $friend_list_id[$i]; ?>.jpg)"></div><p><?php echo $friend_list_firstname[$i]; ?> <?php echo $friend_list_lastname[$i]; ?></p></li>
        <?php }
        else
        {?>
    	<li onClick="showProfile('<?php echo $friend_list_id[$i]; ?>', this);"><div class="friend-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div><p><?php echo $friend_list_firstname[$i]; ?> <?php echo $friend_list_lastname[$i]; ?></p></li>
    <?php } 
	}
?>
<!-- EXAMPLE FRIENDS LIST - friends should be echoed like below -->