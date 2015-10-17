<?php

	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/session_start.php');
	include($_SERVER['DOCUMENT_ROOT'].'/v0-5/php/function/user_data.php');
	$pic_status = is_file($_SERVER['DOCUMENT_ROOT'].'/profile_img/users/'.$user_id.'.jpg');

?>

<script type="text/javascript">
	$(".settings-info-form").on('submit', function(e) {
		e.preventDefault();
		validateForm();
	});

	$(".settings-info-form").on('change', function(e) {
		$(".form-invalid-error").slideUp();
		$(".form-invalid-error").empty();
		$("#settings-submit").html("Save Info");
	});

	function validateForm() {
		var currentYear = new Date().getFullYear();
		var inputYear = $("#settings-dob-year").val();
		if (inputYear > currentYear) {
			$(".form-invalid-error").text("Invalid date of birth.");
			$(".form-invalid-error").slideDown();
			return;
		}
		submitForm();
	}

	function submitForm() {
		$.ajax({
			type: "POST",
			url: "./php/function/update_account_settings.php",
			data: $(".settings-info-form").serialize(),
			success: function(data) {
				console.log("Success saving settings");
				$("#settings-submit").html("<i class='fa fa-check'></i> Saved");
			},
			error: function(jqXHR, status, err) {
				console.log("Error saving settings: " + err);
			}
		});
	}
</script>
<div class="section"><h3>Profile image</h3>

	<?php 
        if($pic_status==true)
        {?>
    	<div class="settings-display-image" style="background-image: url(/profile_img/users/<?php echo $user_id ?>.jpg)"></div>
        <?php }
        else
        {?>
    	<div class="settings-display-image" style="background-image: url(/profile_img/users/user-default.jpg)"></div>
    <?php } ?>
	<form method="post" action="./php/function/upload_image.php" enctype="multipart/form-data"> 
	<input type="file" name="file">
	<input name="button" type="submit" value="Update Picture" class="button-primary">
	</form>
</div>
<div class="section"><h3>Personal info</h3>
	<form class="settings-info-form">
		<p><label for="settings-first-name">First name</label>
		<input id="settings-first-name" name="first_name" type="text" required value="<?php echo $first_name ?>"><p/>
		<p><label for="settings-last-name">Last name</label>
		<input id="settings-last-name" name="last_name" type="text" required value="<?php echo $last_name ?>"><p/>
		<p><label for="settings-username">Username</label>
		<input id="settings-username" name="username" type="text" required value="<?php echo $user_name ?>"><p/>
		<p><label for="settings-email">Email</label>
		<input id="settings-email" name="email" type="email" required value="<?php echo $user_email ?>"><p/>
		<p><label>Date of birth</label>
		<select id="settings-dob-day" name="dob_day" required>
			<option selected="selected" value="<?php echo $user_birth_day ?>"><?php echo $user_birth_day ?></option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>
		<select id="settings-dob-month" name="dob_month" required>
			<option selected="selected" value="<?php echo date("m",strtotime($user_birth_month)) ?>"><?php echo $user_birth_month ?></option>
			<option value="01">January</option>
			<option value="02">February</option>
			<option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
		</select>
		<input id="settings-dob-year" name="dob_year" type="number" value="<?php echo $user_birth_year ?>" required placeholder="Year"><p/>
		<p class="form-invalid-error"></p>
		<button id="settings-submit" type="submit"class="button-primary">Save Info</buton>
	</form>
</div>