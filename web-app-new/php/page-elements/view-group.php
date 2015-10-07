<?php
	//Include session php file
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/session_start.php');
	$group_id = $_GET['group_id']; // getting group_id from the ajax request,
	$_SESSION["group_id"] = $group_id;

	//Include group_data php file to get user join group data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/button_status.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-4/php/function/group_data.php');



?>

<div class="section">
	<div class="profile-image" style="background-image: url(/profile_img/groups/1.jpg)"></div>
	<p class="profile-name"><?php echo $display_group_name?></p>
	<p class="profile-detail"><?php echo $total_group_num?> members</p>
	<p class="profile-detail">Created in <?php echo $display_group_date?></p>
	
	<?php
	if($group_button_status_condition == "joined")
		{?>
	<!-- If user is NOT in group, show Join button: -->
	<p><button class="button-primary" onClick="leaveGroup('<?php echo $group_id?>', this)"><i class="fa fa-minus"></i> Leave Group</button></p>
	<?php
		}
	else if($group_button_status_condition == "not-joined")
		{?>
	<!-- Else, show Leave button: -->
	<p><button class="button-primary" onClick="joinGroup('<?php echo $group_id?>', this)"><i class="fa fa-plus"></i> Join Group</button></p>
	<?php
		}?>
		
</div>
<div class="section">
	<p class="section-header">About this group</p>
	<p><?php echo $display_group_desc?></p>
</div>
<div class="section">
	<p class="section-header">Activity this month</p>
	<p><?php echo $display_group_acti?></p>
</div>
<div class="section">
	<p class="section-header">Group members</p>
	<ul class="members-list">
		<!-- Echo group members in alphabetical order -->
		<?php
		for($i = 0; $i<sizeof($group_member_first_name); $i++)
		{
		?>
		<li><div class="friend-image"></div><p><?php echo $group_member_first_name[$i]?> <?php echo $group_member_last_name[$i]?></p></li>
		<?php
		}
		?>
	</ul>
</div>