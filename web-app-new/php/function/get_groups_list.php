<?php
	
	// Include session php file to start PHP session 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/session_start.php');

	// Include group_data php file to get user group data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/group_data.php');

	// echo a list of joined groups
	for($i = 0; $i<sizeof($search_group_id); $i++)
	{
	?>
	<li onClick="showGroup('<?php echo $search_group_id[$i]; ?>', this);"><div class="group-image" style="background-image: url(/profile_img/groups/1.jpg)"></div><p><?php echo $search_group_name[$i]; ?></p></li>
	<?php
	}
	
?>