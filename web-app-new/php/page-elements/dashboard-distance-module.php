<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/distance_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/distance_data.php');
?>
<!-- Module for Dashboard Distance -->
<div class="container">
	<div class="row">
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Distance Today</p>
				<p class="data-text"><?php echo $day_distance?></i></p>
				<p class="data-unit">km</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Distance This Week</p>
				<p class="data-text"><?php echo $week_distance?></i></p>
				<p class="data-unit">km</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Distance This Month</p>
				<p class="data-text"><?php echo $month_distance?></i></p>
				<p class="data-unit">km</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="eight columns">
			<div class="info-box">
				<p class="info-box-header">Distance Over Time<span id="switch-chart-modes"><a class="switch-active" onClick="switchChartMode(1)">Today</a><a onClick="switchChartMode(2)">This Week</a><a onClick="switchChartMode(3)">Monthly</a></span></p>
				<canvas id="distance-chart"></canvas>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Distance All Time</p>
				<p class="data-text"><?php echo $total_distance?></p>
				<p class="data-unit">km</p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var chart;

	// Loads distance chart data (day, week, monthly)
	function loadDistanceChart(mode) {
		// Clear previous chart
		if (chart === undefined) {
			console.log("no chart");
		} else {
			console.log("clearing chart");
			chart.clear();
			chart.destroy();
		}

		// Get canvas context
		var ctx = $("#distance-chart").get(0).getContext("2d");

		// Set chart data based on mode
		var data;
		switch (mode) {
			case 1:
				data = {
				    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
				    datasets: [
				        {
				            label: "Distance Today",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: [65, 59, 80, 81, 56, 55, 40]
				        }
				    ]
				};
				break;
			case 2:
				data = {
				    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
				    datasets: [
				        {
				            label: "Distance This Week",
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
				    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec" ],
				    datasets: [
				        {
				            label: "Distance This Month",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: month_graph_distance
				        }
				    ]
				};
		}
		chart = new Chart(ctx).Bar(data, chartOptions);
	}

	// Changes chart data and highlights active switch
	function switchChartMode(mode) {
		if (mode === undefined) {mode = 3} // set default mode
		$("#switch-chart-modes > a").each(function() {
			$(this).removeClass("switch-active");
		});
		$("#switch-chart-modes > a:nth-child(" + mode + ")").addClass("switch-active");
		loadDistanceChart(mode);
	}
</script>