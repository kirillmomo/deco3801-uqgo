<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/step_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-1/php/function/step_data.php');
?>
<!-- Module for Dashboard Steps -->
<div class="container">
	<div class="row">
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Steps Today</p>
				<p class="data-text"><?php echo $day_step?></p>
				<p class="data-unit">steps</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Steps This Week</p>
				<p class="data-text"><?php echo $week_step?></i></p>
				<p class="data-unit">steps</p>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Steps This Month</p>
				<p class="data-text"><?php echo $month_step?></p>
				<p class="data-unit">steps</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="eight columns">
			<div class="info-box">
				<p class="info-box-header">Steps Over Time<span id="switch-chart-modes"><a class="switch-active" onClick="switchChartMode(1)">Today</a><a onClick="switchChartMode(2)">This Week</a><a onClick="switchChartMode(3)">Monthly</a></span></p>
				<canvas id="steps-chart"></canvas>
			</div>
		</div>
		<div class="four columns">
			<div class="info-box">
				<p class="info-box-header">Steps All Time</p>
				<p class="data-text"><?php echo $total_step?></p>
				<p class="data-unit">steps</p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var chart;

	function loadStepsChart(mode) {
		if (chart === undefined) {
			console.log("no chart");
		} else {
			console.log("clearing chart");
			chart.clear();
			chart.destroy();
		}
		var ctx = $("#steps-chart").get(0).getContext("2d");
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
				            label: "Steps This Week",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: [mon_step,tue_step,wed_step,thu_step,fri_step,sat_step,sun_step]
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
				            label: "Steps This Month",
				            fillColor: chartFillColour,
				            strokeColor: "rgba(220,220,220,0.8)",
				            highlightFill: chartHighlightColour,
				            highlightStroke: "rgba(220,220,220,1)",
				            data: month_graph_step
				        }
				    ]
				};
		}
		chart = new Chart(ctx).Bar(data, chartOptions);
	}

	function switchChartMode(mode) {
		if (mode === undefined) {mode = 3} // set default mode
		$("#switch-chart-modes > a").each(function() {
			$(this).removeClass("switch-active");
		});
		$("#switch-chart-modes > a:nth-child(" + mode + ")").addClass("switch-active");
		loadStepsChart(mode);
	}
</script>