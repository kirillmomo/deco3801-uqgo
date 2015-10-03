<form class="create-group-form">
	<p class="section-header">Create a new group</p>
	<label for="creator-group-name">Group name</label>
	<input type="text" id="creator-group-name" name="group_name" placeholder="Group name" required maxlength="40">
	<label for="creator-group-description">Group description</label>
	<textarea id="creator-group-description" name="group_description" placeholder="What is your group about?" required maxlength="300"></textarea>
	<label for="creator-group-friends-list">Add friends to this group</label>
	<select name="group_friends_list" id="creator-group-friends-list" class="multi-select-box" multiple="multiple" style="width: 90%">
		<!-- KIRILL: echo back the friends below in alphabetical order -->
	  <option value="echo friend_id">Viktor Reznov</option>
	  <option value="echo friend_id">Jenson Jackson</option>
	  <option value="echo friend_id">James Ramirez</option>
	</select>
	<button type="submit" class="button-primary" id="create-group-submit">Create Group</button>
	<button type="button" class="button slide-in" id="view-new-group">View Group <i class="fa fa-arrow-circle-right"></i></button>
</form>