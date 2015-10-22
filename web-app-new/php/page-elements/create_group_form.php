<?php
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/user_data.php');
?>

<form class="create-group-form" enctype="multipart/form-data">
	<p class="section-header">Create a new group</p>
	<label for="creator-group-icon">Group picture (optional)</label>
	<input type="file" name="group_icon" id="creator-group-icon">
	<label for="creator-group-name">Group name</label>
	<input type="text" id="creator-group-name" name="group_name" placeholder="Group name" required maxlength="40">
	<label for="creator-group-description">Group description</label>
	<textarea id="creator-group-description" name="group_description" placeholder="What is your group about?" required maxlength="300"></textarea>
	<label for="creator-group-friends-list">Add friends to this group</label>
	<select name="group_friends_list" id="creator-group-friends-list" class="multi-select-box" multiple="multiple" style="width: 90%">
		<!--echo back the friends below in alphabetical order -->
	<?php
	for($i = 0; $i<sizeof($friend_group_id); $i++)
	{
	?>
	  <option value="<?php echo $friend_group_id[$i]; ?>"><?php echo $friend_group_firstname[$i]; ?> <?php echo $friend_group_lastname[$i]; ?></option>
	<?php 
	}
	?>
	</select>
	<button type="submit" class="button-primary" id="create-group-submit">Create Group</button>
	<button type="button" class="button slide-in" id="view-new-group">View Group <i class="fa fa-arrow-circle-right"></i></button>
</form>
