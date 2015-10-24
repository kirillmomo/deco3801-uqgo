<?php
	//Include session php file
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	$group_id = $_GET['group_id']; // getting group_id from the ajax request,
	$_SESSION["group_id"] = $group_id;

	//Include group_data php file to get user join group data 
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/button_status.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/group_data.php');
	$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/groups/'.$display_group_id.'.jpg');



?>

<div class="section">

	<?php 
        if($pic_status==true)
        {?>
    	<div class="profile-image" style="background-image: url(/profile_img/groups/<?php echo $display_group_id?>.jpg)"></div>
        <?php }
        else
        {?>
    	<div class="profile-image" style="background-image: url(/profile_img/groups/group-default.jpg)"></div>
    <?php } ?>

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
	<div class="group-activity-bar">
		<div class="activity-box">
			<p class="activity-header">Steps</p>
<<<<<<< Updated upstream
			<p class="activity-data">1024</p>
=======
			<p class="activity-data"><?php echo $group_activity_step?></p>
>>>>>>> Stashed changes
			<p class="activity-unit">steps</p>
		</div>
		<div class="activity-box">
			<p class="activity-header">Distance</p>
<<<<<<< Updated upstream
			<p class="activity-data">102</p>
=======
			<p class="activity-data"><?php echo $group_activity_distance?></p>
>>>>>>> Stashed changes
			<p class="activity-unit">km</p>
		</div>
		<div class="activity-box">
			<p class="activity-header">Calories</p>
<<<<<<< Updated upstream
			<p class="activity-data">12000</p>
=======
			<p class="activity-data"><?php echo $group_activity_cal?></p>
>>>>>>> Stashed changes
			<p class="activity-unit">kcal</p>
		</div>
	</div>
</div>
<div class="section">
	<p class="section-header">Group members</p>
	<ul class="members-list">
		<!-- Echo group members in alphabetical order -->
		<?php
		for($i = 0; $i<sizeof($group_member_first_name); $i++)
		{

			$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$group_member_id[$i].'.jpg');
	        if($pic_status==true)
	        {?>
	        <li><div class="friend-image" style="background-image: url(/profile_img/users/<?php echo $group_member_id[$i]?>.jpg)"></div><p><?php echo $group_member_first_name[$i]?> <?php echo $group_member_last_name[$i]?></p></li>
	        <?php }
	        else
	        {?>
	    	 <li><div class="friend-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div><p><?php echo $group_member_first_name[$i]?> <?php echo $group_member_last_name[$i]?></p></li>
	    <?php }
	    } 
		?>
	</ul>
</div>