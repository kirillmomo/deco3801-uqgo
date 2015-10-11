<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');
	$search = $_GET['search']; // getting search term from ajax request
	$_SESSION["search"] = $search;
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/button_status.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/user_data.php');
	// Do a search for user's full names containing the search term
	// Ensure that list returned are not already friends with the user

// EXAMPLE RETURNED LIST - users should be echoed like below

	if($error_msg!="")
	{
	?><p><?php echo $error_msg; ?></p><?php
	}
	
	if(sizeof($search_friend_id)!=0)
	{
		// echo a list of joined groups
		for($i = 0; $i<sizeof($search_friend_id); $i++)
		{
			$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$search_friend_id[$i].'.jpg');
			if($pic_status==true)
	        {?>
	        <li onClick="showProfile('<?php echo $search_friend_id[$i]; ?>', this);"><div class="friend-image" style="background-image: url(/profile_img/users/<?php echo $search_friend_id[$i]; ?>.jpg)"></div><p><?php echo $search_friend_firstname[$i]; ?> <?php echo $search_friend_lastname[$i]; ?></p></li>
	        <?php }
	        else
	        {?>
	    	<li onClick="showProfile('<?php echo $search_friend_id[$i]; ?>', this);"><div class="friend-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div><p><?php echo $search_friend_firstname[$i]; ?> <?php echo $search_friend_lastname[$i]; ?></p></li>
	    <?php } 
		}
	}	
	else if(sizeof($search_friend_id)==0 && sizeof($search_user_friend_id)==0)
	{
		for($i = 0; $i<sizeof($search_all_user_id); $i++)
		{

			$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$search_all_user_id[$i].'.jpg');
			if($pic_status==true)
	        {?>
	        <li onClick="showProfile('<?php echo $search_all_user_id[$i]; ?>', this);"><div class="friend-image" style="background-image: url(/profile_img/users/<?php echo $search_all_user_id[$i]; ?>.jpg)"></div><p><?php echo $search_all_user_firstname[$i]; ?> <?php echo $search_all_user_lastname[$i]; ?></p></li>
	        <?php }
	        else
	        {?>
	    	<li onClick="showProfile('<?php echo $search_all_user_id[$i]; ?>', this);"><div class="friend-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div><p><?php echo $search_all_user_firstname[$i]; ?> <?php echo $search_all_user_lastname[$i]; ?></p></li>
	    <?php }
		}
	}
?>