<!-- Module for Dashboard Overview -->
<div class="container">
	<div class="row">
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Steps This Week</p>
				<p class="data-text"><i class="fa fa-circle-o-notch fa-spin"></i></p>
				<p class="data-unit">steps</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header"> Distance This Week</p>
				<p class="data-text"><i class="fa fa-circle-o-notch fa-spin"></i></p>
				<p class="data-unit">km</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Calories This Week</p>
				<p class="data-text"><i class="fa fa-circle-o-notch fa-spin"></i></p>
				<p class="data-unit">kcal</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<div class="info-box">
				<p class="info-box-header">Weekly Summary <span id="switch-summary"><a id="switch-summary-steps" class="switch-active" onClick="switchSummaryChart('steps')">Steps</a> <a id="switch-summary-distance" onClick="switchSummaryChart('distance')">Distance</a> <a id="switch-summary-calories" onClick="switchSummaryChart('calories')">Calories</a></span></p>
				<canvas id="weekly-summary-chart" width="650" height="350"></canvas>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var summaryChart;

	function loadSummaryChart(mode) {
		if (summaryChart === undefined) {
			console.log("no chart");
		} else {
			console.log("clearing chart");
			summaryChart.clear();
			summaryChart.destroy();
		}
		var ctx = $("#weekly-summary-chart").get(0).getContext("2d");
		if (mode === undefined || mode == "steps") {
			//Steps mode
			var data = {
			    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			    datasets: [
			        {
			            label: "Weekly Steps",
			            fillColor: chartFillColour,
			            strokeColor: "rgba(220,220,220,0.8)",
			            highlightFill: chartHighlightColour,
			            highlightStroke: "rgba(220,220,220,1)",
			            data: [65, 59, 80, 81, 56, 55, 40]
			        }
			    ]
			};
		} else if (mode == "distance") {
			//Distance mode
			var data = {
			    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			    datasets: [
			        {
			            label: "Weekly Distance",
			            fillColor: chartFillColour,
			            strokeColor: "rgba(220,220,220,0.8)",
			            highlightFill: chartHighlightColour,
			            highlightStroke: "rgba(220,220,220,1)",
			            data: [35, 49, 70, 32, 41, 65, 12]
			        }
			    ]
			};
		} else {
			//Calories mode (fallback)
			var data = {
			    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			    datasets: [
			        {
			            label: "Weekly Calories",
			            fillColor: chartFillColour,
			            strokeColor: "rgba(220,220,220,0.8)",
			            highlightFill: chartHighlightColour,
			            highlightStroke: "rgba(220,220,220,1)",
			            data: [12, 43, 25, 52, 83, 27, 56]
			        }
			    ]
			};
		}
		summaryChart = new Chart(ctx).Bar(data, {
				barShowStroke: false,
				responsive: false,
				scaleFontFamily: "'Raleway', 'Helvetica', 'Arial', sans-serif"
			});
	}

	function switchSummaryChart(mode) {
		$("#switch-summary > a").each(function() {
			$(this).removeClass("switch-active");
		});
		if (mode === undefined || mode == "steps") {
			$("#switch-summary-steps").addClass("switch-active");
			loadSummaryChart(mode);
		} else if (mode == "distance") {
			$("#switch-summary-distance").addClass("switch-active");
			loadSummaryChart(mode);
		} else {
			$("#switch-summary-calories").addClass("switch-active");
			loadSummaryChart(mode);
		}
	}
</script>