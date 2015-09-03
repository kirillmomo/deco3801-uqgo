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
				<p class="info-box-header">Distance This Week</p>
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
				<p class="info-box-header">Weekly Summary <span id="switch-chart-modes"><a class="switch-active" onClick="switchChartMode(1)">Steps</a><a onClick="switchChartMode(2)">Distance</a><a onClick="switchChartMode(3)">Calories</a></span></p>
				<canvas id="weekly-summary-chart"></canvas>
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
				            data: [35, 49, 70, 32, 41, 65, 12]
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
				            data: [12, 43, 25, 52, 83, 27, 56]
				        }
				    ]
				};
		}
		summaryChart = new Chart(ctx).Bar(data, chartOptions);
	}

	function switchChartMode(mode) {
		if (mode === undefined) {mode = 3} // set default mode
		$("#switch-chart-modes > a").each(function() {
			$(this).removeClass("switch-active");
		});
		$("#switch-chart-modes > a:nth-child(" + mode + ")").addClass("switch-active");
		loadSummaryChart(mode);
	}
</script>