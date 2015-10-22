<?php

	// Include session php file to start PHP session 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/session_start.php');

	// Include group_data php file to get user group data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/challenge_data.php');

	if(sizeof($search_unjoined_challenge_id)!=0)
	{
		// echo a list of joined groups
		for($i = 0; $i<sizeof($search_unjoined_challenge_id); $i++)
		{

			?>
	    	<li onClick="showChallenge('<?php echo $search_unjoined_challenge_id[$i]; ?>', this);"></div><i class="fa fa-calendar fa-fw"></i><p class="list-challenge-name"><?php echo $search_unjoined_challenge_name[$i]; ?></p><p class="list-challenge-status"><?php echo $unjoined_challenge_percentage[$i]; ?>% completed, <?php echo $search_unjoined_challenge_remaining_time_left[$i]; ?> days left</p></li>
	    	<?php 
		}
	}
	elseif($total_joined_challenge_num==0)
	{
		for($i = 0; $i<sizeof($search_all_challenge_id); $i++)
		{

			?>
	    	<li onClick="showChallenge('<?php echo $search_all_challenge_id[$i]; ?>', this);"></div><i class="fa fa-calendar fa-fw"></i><p class="list-challenge-name"><?php echo $search_all_challenge_name[$i]; ?></p><p class="list-challenge-status"><?php echo $all_challenge_percentage[$i]; ?>% completed, <?php echo $search_all_challenge_remaining_time_left[$i]; ?> days left</p></li>
	    	<?php  
		}	
	}
?>
