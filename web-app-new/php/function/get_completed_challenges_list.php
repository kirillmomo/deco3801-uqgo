<?php

	// Include session php file to start PHP session 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/session_start.php');

	// Include challenge_data php file to get user challenge data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/challenge_data.php');

	for($i = 0; $i<sizeof($search_complete_challenge_id); $i++)
	{?>
        <li onClick="showChallenge('<?php echo $search_complete_challenge_id[$i]; ?>', this);"></div><i class="fa fa-calendar fa-fw"></i><p class="list-challenge-name"><?php echo $search_complete_challenge_name[$i]; ?></p><p class="list-challenge-status"><?php echo $complete_challenge_percentage[$i]; ?>% completed, <?php echo $search_complete_challenge_remaining_time_left[$i]; ?> days left</p></li>
    <?php 
	}
?>