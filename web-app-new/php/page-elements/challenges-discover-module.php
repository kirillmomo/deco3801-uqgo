<script type="text/javascript">
	// var showingJoined = true;
	setListHeight();
	$(window).resize(setListHeight);
	loadChallengesList();

	jQuery.expr[':'].Contains = function(a,i,m){
	    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	function loadChallengesList() {
		$("#challenges-search-box").val("");
		$.ajax({
			url: "./php/function/get_other_challenges_list.php",
			dataType: "html",
			beforeSend: function() {
				$(".challenges-list").html("<p><i class='fa fa-circle-o-notch fa-spin'></i> Loading challenges");
			},
			success: function(data) {
				$(".challenges-list").html(data);
				$(".challenges-list .fa-calendar").removeClass("fa-calendar").addClass("fa-calendar-plus-o");
				console.log("Loaded challenges list success");
			},
			error: function(jqXHR, status, err) {
				$(".challenges-list").html("<p><i class='fa fa-exclamation-circle'></i> Error loading challenges. (" + status + ": " + err + ")</p>");
			}
		});
	}

	function filterChallenges() {
		var filter = $("#challenge-search-box").val();
		if (filter) {
			$(".challenges-list").find(".list-challenge-name:not(:Contains(" + filter + "))").parent().slideUp(100, "swing");
			$(".challenges-list").find(".list-challenge-name:Contains(" + filter + ")").parent().slideDown(100, "swing");
		} else {
			$(".challenges-list").find("li").slideDown(100, "swing");
		}
	}

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

	function joinChallenge(challenge_id, button) {
		$.ajax({
			url: "./php/function/join_challenge.php",
			dataType: "html",
			data: "challenge_id=" + challenge_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Joined Challenge");
				$(button).prop("disabled", true);
				loadChallengesList();
			},
			error: function(jqXHR, status, err) {
				console.log("Error joining challenge. (" + status + ": " + err + ")");
			}
		});
	}
</script>

<div class="challenges-sidebar module-sidebar">
	<input id="challenge-search-box" type="search" placeholder="Filter challenges" onKeyup="filterChallenges();">
	<ul class="challenges-list">
		<!-- Challenges list will load here via ajax -->
	</ul>
</div>
<div class="challenges-content slide-in">
	<!-- Selected challenge profile will load here via ajax -->
</div>