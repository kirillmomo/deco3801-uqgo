<script type="text/javascript">
	$(".settings-body-form").on('submit', function(e) {
		e.preventDefault();
		submitForm();
	});

	$(".settings-body-form").on('change', function(e) {
		$("#settings-submit").html("Save Info");
	});

	function submitForm() {
		$.ajax({
			type: "POST",
			url: "./php/function/update_body_settings.php",
			data: $(".settings-body-form").serialize(),
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
<div class="section"><h3>Body info</h3>
	<form class="settings-body-form">
		<p><label for="settings-height">Height (cm)</label>
		<input id="settings-height" name="height" type="number" min="0" max="300" placeholder="optional"><p/>
		<p><label for="settings-weight">Weight (kg)</label>
		<input id="settings-weight" name="weight" type="number" min="0" placeholder="optional"><p/>
		<p><label>Gender</label><input id="settings-gender-male" type="radio" name="gender" value="male" required><label for="settings-gender-male" class="radio-label">Male</label><input id="settings-gender-female" type="radio" name="gender" value="female" required><label for="settings-gender-female" class="radio-label">Female</label></p>
		<button id="settings-submit" type="submit"class="button-primary">Save Info</buton>
	</form>
</div>