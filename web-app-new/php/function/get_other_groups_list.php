<?php
	// echo all the groups that the user has NOT joined
	
	// Include session php file to start PHP session 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');

	// Include group_data php file to get user group data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/group_data.php');

	// display non-joined groups
	if(sizeof($search_non_joined_group_id)!=0)
	{
		for($i = 0; $i<sizeof($search_non_joined_group_id); $i++)
		{

			$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/groups/'.$search_non_joined_group_id[$i].'.jpg');
	        if($pic_status==true)
	        {?>
	        <li onClick="showGroup('<?php echo $search_non_joined_group_id[$i]; ?>', this);"><div class="group-image" style="background-image: url(/profile_img/groups/<?php echo $search_non_joined_group_id[$i]; ?>.jpg)"></div><p><?php echo $search_non_joined_group_name[$i]; ?></p></li>
	        <?php }
	        else
	        {?>
	    	<li onClick="showGroup('<?php echo $search_non_joined_group_id[$i]; ?>', this);"><div class="group-image" style="background-image: url(/profile_img/groups/group-default.jpg)"></div><p><?php echo $search_non_joined_group_name[$i]; ?></p></li>
	    	<?php } 
		}
	}
	elseif($total_joined_group_num==0)
	{
		for($i = 0; $i<sizeof($search_all_group_id); $i++)
		{

			$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/groups/'.$search_all_group_id[$i].'.jpg');
	        if($pic_status==true)
	        {?>
	        <li onClick="showGroup('<?php echo $search_all_group_id[$i]; ?>', this);"><div class="group-image" style="background-image: url(/profile_img/groups/<?php echo $search_all_group_id[$i]; ?>.jpg)"></div><p><?php echo $search_all_group_name[$i]; ?></p></li>
	        <?php }
	        else
	        {?>
	    	<li onClick="showGroup('<?php echo $search_all_group_id[$i]; ?>', this);"><div class="group-image" style="background-image: url(/profile_img/groups/group-default.jpg)"></div><p><?php echo $search_all_group_name[$i]; ?></p></li>
	    	<?php } 
		}	
	}

?>