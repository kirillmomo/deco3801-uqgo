<form class="create-challenge-form">
	<p class="section-header">Create a new challenge</p>
	<label for="creator-challenge-name">Challenge name</label>
	<input type="text" id="creator-challenge-name" name="challenge_name" placeholder="Challenge name" required maxlength="40">
	<label>Choose a goal</label>
	<div class="radio-container"><input type="radio" name="challenge_goal_type" id="radio-steps" value="steps" checked><label for="radio-steps">Steps</label></div>
	<div class="radio-container"><input type="radio" name="challenge_goal_type" id="radio-distance" value="distance"><label for="radio-distance">Distance</label></div>
	<div class="radio-container"><input type="radio" name="challenge_goal_type" id="radio-calories" value="calories"><label for="radio-calories">Calories</label></div>
	<label for="creator-challenge-name">Goal amount</label>
	<input type="number" id="creator-challenge-amount" name="goal_amount" placeholder="Amount" required min="1000" max="50000">
	<label for="creator-challenge-start">Duration (days)</label>
	<input type="number" id="creator-challenge-duration" name="challenge_duration" placeholder="Days" required min="5" max="31" onChange="previewDate();"><br>
	<!-- <p>Challenge duration will be from today to <span class="date-preview">%date%</span></p> -->
	<button type="submit" class="button-primary" id="create-challenge-submit">Create Challenge</button>
	<button type="button" class="button slide-in" id="view-new-challenge">View Challenge <i class="fa fa-arrow-circle-right"></i></button>
</form>
