<?php

// Include session_start, step_data and distance_data file.

// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/step_data.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/distance_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/step_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/distance_data.php');
?>
<!-- Module for Dashboard Overview -->
<div class="container">
	<div class="row">
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Steps This Week</p>
				<p class="data-text"><?php echo $week_step?></p>
				<p class="data-unit">steps</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Distance This Week</p>
				<p class="data-text"><?php echo $week_distance?></p>
				<p class="data-unit">km</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Calories This Week</p>
				<p class="data-text"><?php echo $week_calories?></p>
				<p class="data-unit">kcal</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="twelve columns">
			<div class="info-box">
				<p class="info-box-header">Weekly Summary <span id="switch-chart-modes"><a class="switch-active" onClick="switchChartMode(1)">Steps</a><a onClick="switchChartMode(2)">Distance</a><a onClick="switchChartMode(3)">Calories</a></span></p>
				<canvas id="weekly-summary-chart"></canvas>
			</div>
		</div>
	</div>
</div>

<!-- JS for dashboard overview chart -->
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
		var data;

		switch (mode) {
			case 1:
				data = {
				    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
				    datasets: [
				        {
				            label: "Steps Today",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: [mon_step,tue_step,wed_step,thu_step,fri_step,sat_step,sun_step]
				        }
				    ]
				};
				break;
			case 2:
				data = {
				    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
				    datasets: [
				        {
				            label: "Steps This Week",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: [mon_distance,tue_distance,wed_distance,thu_distance,fri_distance,sat_distance,sun_distance]
				        }
				    ]
				};
				break;
			case 3:
			default:
				data = {
				    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
				    datasets: [
				        {
				            label: "Steps This Month",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: [mon_cal,tue_cal,wed_cal,thu_cal,fri_cal,sat_cal,sun_cal]
				        }
				    ]
				};
		}
		summaryChart = new Chart(ctx).Bar(data, chartOptions);
	}

	function switchChartMode(mode) {
		if (mode === undefined) {mode = 1} // set default mode
		$("#switch-chart-modes > a").each(function() {
			$(this).removeClass("switch-active");
		});
		$("#switch-chart-modes > a:nth-child(" + mode + ")").addClass("switch-active");
		loadSummaryChart(mode);
	}
</script>