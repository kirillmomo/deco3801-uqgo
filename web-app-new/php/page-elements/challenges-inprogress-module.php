<script type="text/javascript">
	setListHeight();
	$(window).resize(setListHeight);
	loadChallengesList();

	jQuery.expr[':'].Contains = function(a,i,m){
	    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	// Displays the completed challenges on the list
	function loadChallengesList() {
		$("#challenges-search-box").val("");
		$.ajax({
			url: "./php/function/get_challenges_list.php",
			dataType: "html",
			beforeSend: function() {
				$(".challenges-list").html("<p><i class='fa fa-circle-o-notch fa-spin'></i> Loading challenges");
			},
			success: function(data) {
				$(".challenges-list").html(data);
				// $(".challenges-list .fa-calendar").removeClass("fa-calendar").addClass("fa-calendar-check-o");
				console.log("Loaded challenges list success");
			},
			error: function(jqXHR, status, err) {
				$(".challenges-list").html("<p><i class='fa fa-exclamation-circle'></i> Error loading challenges. (" + status + ": " + err + ")</p>");
			}
		});
	}

	// Filters challenges
	function filterChallenges() {
		var filter = $("#challenge-search-box").val();
		if (filter) {
			$(".challenges-list").find(".list-challenge-name:not(:Contains(" + filter + "))").parent().slideUp(100, "swing");
			$(".challenges-list").find(".list-challenge-name:Contains(" + filter + ")").parent().slideDown(100, "swing");
		} else {
			$(".challenges-list").find("li").slideDown(100, "swing");
		}
	}

	// Displays the selected challenge information
	function showChallenge(challenge_id, item) {
		// We will use ajax to load challenge profiles
		$(".challenges-list > li").each(function() {
			$(this).removeClass("active-list-item");
		});
		$(item).addClass("active-list-item");
		$(".challenges-content").addClass("slide-in");
		$.ajax({
			url: "./php/page-elements/view-challenge.php",
			dataType: "html",
			data: "challenge_id=" + challenge_id,
			success: function(data) {
				$(".challenges-content").html(data);
				$(".challenges-content").removeClass("slide-in");
				retrieveProgressDays(challenge_id);
			},
			error: function(jqXHR, status, err) {
				$(".challenges-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading challenge information. (" + status + ": " + err + ")</p>");
				console.log("Error loading challenge info");
			}
		});
	}

	// Gets the challenge days passed/remaining
	function retrieveProgressDays(challenge_id) {
		$.ajax({
			url: "./php/function/get_challenge_progress.php",
			dataType: "json",
			data: "challenge_id=" + challenge_id,
			success: function(data) {
				console.log("Success retreiving challenge progress info: " + data);
				showProgressDays(data);
			},
			error: function(jqXHR, status, err) {
				console.log("Error loading challenge progress info");
			}
		});
	}

	// Displays the goal progress and duration
	function showProgressDays(progressData) {
		var goalProgress = progressData["goalProgress"];
		var goalAmount = progressData["goalAmount"];
		var daysProgressed = progressData["daysProgressed"];
		var daysDuration = progressData["daysDuration"];

		var doughnutOptions = {
			showTooltips: false,
			segmentShowStroke: false,
			onAnimationComplete: function() {
				//setup the font and center it's position
		        this.chart.ctx.font = 'Normal 24px Lato';
		        this.chart.ctx.fillStyle = '#000"';
		        this.chart.ctx.textAlign = 'center';
		        this.chart.ctx.textBaseline = 'middle';

		        //put the pabel together based on the given 'skilled' percentage
		        var valueLabel = (Math.round((goalProgress / goalAmount) * 100)) + '%';

		        //find the center point
		        var x = this.chart.canvas.clientWidth / 2;
		        var y = this.chart.canvas.clientHeight / 2;

		        //hack to center different fonts
		        var x_fix = 0;
		        var y_fix = 2;

		        //render the text
		        this.chart.ctx.fillText(valueLabel, x + x_fix, y + y_fix);
			}
		};

		var ctx = $("#progress-chart").get(0).getContext("2d");
		var data = [
			{
			        value: goalProgress,
			        color:doughnutProgressColour,
			        highlight: doughnutProgressColour,
			        label: "Completed"
		    },
		    {
			        value: goalAmount - goalProgress,
			        color: doughnutRemainingColour,
			        highlight: doughnutRemainingColour,
			        label: "Remaining"
		    }
		];

		var progressChart = new Chart(ctx).Doughnut(data, doughnutOptions);

		var line = new ProgressBar.Line('#challenge-time-bar', {
		    color: '#8AB800'
		});

		var lineProgress = (daysProgressed / daysDuration);
		line.animate(lineProgress);
	}

	// Invokes leave challenge function on server
	function leaveChallenge(challenge_id, button) {
		$.ajax({
			url: "./php/function/leave_challenge.php",
			dataType: "html",
			data: "challenge_id=" + challenge_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Left Challenge");
				$(button).prop("disabled", true);
				loadChallengesList();
				$(".challenges-content").addClass("slide-in");
			},
			error: function(jqXHR, status, err) {
				console.log("Error leaving challenge. (" + status + ": " + err + ")");
			}
		});
	}

	// Displays the challenge creator form
	function showCreate() {
		$(".challenges-content").addClass("slide-in");
		$.ajax({
			url: "./php/page-elements/create_challenge_form.php",
			dataType: "html",
			success: function(data) {
				$(".challenges-content").html(data);
				$(".challenges-content").removeClass("slide-in");
				$(".create-challenge-form").on('submit', function(e) {
					e.preventDefault();
					createChallenge();
				});
			},
			error: function(jqXHR, status, err) {
				$(".challenges-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading content. (" + status + ": " + err + ")</p>");
				console.log("Error loading challenge creator");
			}
		});
	}

	// Sends form data to server and invokes create challenge function on server
	function createChallenge() {
		$.ajax({
			type: "POST",
			url: "./php/function/create_challenge.php",
			data: $(".create-challenge-form").serialize(),
			success: function(data) {
				if (data) {
					console.log("Success creating challenge: " + data);
					$("#create-challenge-submit").html("<i class='fa fa-check'></i> Created");
					$("#create-challenge-submit").prop("disabled", true);
					$("#view-new-challenge").attr("onClick", "showChallenge('" + data + "')");
					$("#view-new-challenge").removeClass("slide-in");
					loadChallengesList();
				} else {
					console.log("Error creating challenge");
				}
			},
			error: function(jqXHR, status, err) {
				console.log("Error creating challenge: " + err);
			}
		});
	}
</script>

<div class="challenges-sidebar module-sidebar">
	<a id="create-challenge-button" onClick="showCreate();"><i class="fa fa-plus fa-fw"></i><span>Create challenge</span></a>
	<input id="challenge-search-box" type="search" placeholder="Filter challenges" onKeyup="filterChallenges();">
	<ul class="challenges-list">
		<!-- Challenges list will load here via ajax -->
	</ul>
</div>
<div class="challenges-content slide-in">
	<!-- Selected challenge profile will load here via ajax -->
</div>