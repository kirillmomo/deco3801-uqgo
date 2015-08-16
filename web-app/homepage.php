<?php
	include('connect.php');
	session_start();

	//if user hasn't logged in, go back to login page
	if(empty($_SESSION['user_id'])){
		// header('Location: index.php');
	}

	$user_id = $_SESSION['user_id'];

	$query = "SELECT * FROM route WHERE user_id = '$user_id'";
	$query1 = "SELECT * FROM user_information WHERE user_id = '$user_id'";
	$query2 = "SELECT * FROM personal_user_health_data WHERE user_id = '$user_id'";

	$data = mysql_query($query,$dbconn);
	$data1 = mysql_query($query1,$dbconn);
	$data2 = mysql_query($query2,$dbconn);

	$id;
	$num=0;
	while($row = mysql_fetch_array($data)){
		
		$id = $row['id'];

		echo "
			<script>
				var latlng = ".json_encode($row['latlng']).";
			</script>
		";
	}
	echo "
			<script>
				var step=[];
				var distance=[];
				var calorie=[];
			</script>
		";

	while($row2 = mysql_fetch_array($data2)){

		echo "
			<script>
				step[".json_encode($num)."] = ".json_encode($row2['steps']).";
				distance[".json_encode($num)."] = ".json_encode($row2['distance']).";
				calorie[".json_encode($num)."] = ".json_encode($row2['steps']/20).";
			</script>
		";
		$num++;
	}

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>UQ GO</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="js/Chart.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

		<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=en"></script>
	</head>

	<body>
		<!--left panel-->
		<div id="left-panel">
			<div id="logo">
				<img src="img/logo.png">
			</div>
			<!--Me-->
			<div class="panel-button panel-selected">
				<div class="panel-icon">
					<img src="img/left-panel-me-hover.png">
				</div>
				<?php while($row1 = mysql_fetch_array($data1)){ ?>
				<p class="select">
					<?php echo $row1['username']; ?>
				</p>
				<?php }
				?>
			</div>

			<!--Community-->
			<div class="panel-button">
				<div class="panel-icon">
					<img src="img/left-panel-community.png" onmouseover="this.src='img/left-panel-community-hover.png'" onmouseout="this.src='img/left-panel-community.png'">
				</div>
				<p>Community</p>
			</div>

			<!--Challenge-->
			<div class="panel-button">
				<div class="panel-icon">
					<img src="img/left-panel-challenge.png" onmouseover="this.src='img/left-panel-challenge-hover.png'" onmouseout="this.src='img/left-panel-challenge.png'">
				</div>
				<p>Challenge</p>
			</div>

			<!--Setting-->
			<div class="panel-button">
				<div class="panel-icon">
					<img src="img/left-panel-setting.png" onmouseover="this.src='img/left-panel-setting-hover.png'" onmouseout="this.src='img/left-panel-setting.png'">
				</div>
				<p>Setting</p>
			</div>
		</div>

		<!--top bar-->
		<div id="top-bar">
			<!--Logout-->

			<a href="logout.php"><div class="top-bar-button">
				<div class="top-bar-icon">
					<img src="img/top-bar-logout.png" onmouseover="this.src='img/top-bar-logout-hover.png'" onmouseout="this.src='img/top-bar-logout.png'">
				</div>
				<p>Logout</p>
			</div></a>

			<!--Notification-->
			<div class="top-bar-button">
				<div class="top-bar-icon">
					<img src="img/top-bar-notification.png" onmouseover="this.src='img/top-bar-notification-hover.png'" onmouseout="this.src='img/top-bar-notification.png'">
				</div>
				<p>Notification</p>
			</div>

			<!--Refresh-->
			<div class="top-bar-button">
				<div class="top-bar-icon" onclick="reload();">
					<img src="img/top-bar-refresh.png" onmouseover="this.src='img/top-bar-refresh-hover.png'" onmouseout="this.src='img/top-bar-refresh.png'">
				</div>
				<p>Refresh</p>
			</div>
		</div>

		<div id="main">
			<!--main top tag-->
			<div id="main-top-tag">
				<div class="tag select">
					<p>Overview</p>
				</div>

				<div class="tag">
					<p>Steps</p>
				</div>

				<div class="tag">
					<p>Distance</p>
				</div>

				<div class="tag">
					<p>Calorie</p>
				</div>

				<div class="tag">
					<a href='track.php'><p>Track</p></a>
				</div>
			</div>

			<!--main content-->
			<div class="tile">
				<div class="tile-top-bar">
					<div class="type">Steps</div>
					<div class="sort">Daily &#9660;</div>
				</div>

				<div class="tile-content">
					<div>
						<canvas id="steps" height="165" width="500"></canvas>
					</div>
				</div>
			</div>

			<div class="tile">
				<div class="tile-top-bar">
					<div class="type">Distance</div>
					<div class="sort">Daily &#9660;</div>
				</div>

				<div class="tile-content">
					<div>
						<canvas id="distance" height="165" width="500"></canvas>
					</div>
				</div>
			</div>

			<div class="tile">
				<div class="tile-top-bar">
					<div class="type">Calorie</div>
					<div class="sort">Daily &#9660;</div>
				</div>

				<div class="tile-content">
					<div>
						<canvas id="calorie" height="165" width="500"></canvas>
					</div>
				</div>
			</div>

			<div class="tile">
				<div class="tile-top-bar">
					<a href='track.php'><div class="type">Track</div></a>
					<div class="sort">Session <?php echo $id;?></div>
				</div>

				<div class="tile-content" id="map">
				</div>
			</div>


		</div>

		
		<script>
		//steps
		var randomScalingFactor = function(){ return Math.round(Math.random()*10000)};
		var randomColorFactor = function(){ return Math.round(Math.random()*255)};

		/*gradient*/
		var ctx = document.getElementById('steps').getContext("2d");
		var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    	gradient.addColorStop(0, 'rgba(238,181,102,1)');   
    	gradient.addColorStop(0.35, 'rgba(57,21,65,0)');

		var lineChartData = {
			labels : ["May.2","May.3","May.4","May.5","May.6","May.7","May.8", "May.9", "May.10", "May.11", "May.12", "May.13"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : gradient,
					strokeColor : "rgba(255,255,255,0.3)",
					pointColor : "rgba(238,181,102,0.6)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#eeb566",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : step
					
				}
			]

		}

		//distance
		var randomScalingFactor = function(){ return Math.round(Math.random()*10)};
		var randomColorFactor = function(){ return Math.round(Math.random()*255)};


		/*gradient*/
		var ctx_1 = document.getElementById('distance').getContext("2d");
		var gradient_1 = ctx_1.createLinearGradient(0, 0, 0, 400);
    	gradient_1.addColorStop(0, 'rgba(77,135,209,1)');   
    	gradient_1.addColorStop(0.35, 'rgba(57,21,65,0)');

		var lineChartData_1 = {
			labels : ["May.2","May.3","May.4","May.5","May.6","May.7","May.8", "May.9", "May.10", "May.11", "May.12", "May.13"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : gradient_1,
					strokeColor : "rgba(255,255,255,0.3)",
					pointColor : "rgba(77,135,209,0.6)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#4D87D1",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : distance
				}
			]

		}

		//calorie
		var randomScalingFactor = function(){ return Math.round(Math.random()*10000)};
		var randomColorFactor = function(){ return Math.round(Math.random()*255)};


		/*gradient*/
		var ctx_2 = document.getElementById('calorie').getContext("2d");
		var gradient_2 = ctx_2.createLinearGradient(0, 0, 0, 400);
    	gradient_2.addColorStop(0, 'rgba(180,29,2,0.5)');   
    	gradient_2.addColorStop(0.35, 'rgba(180,21,65,0)');

		var lineChartData_2 = {
			labels : ["May.2","May.3","May.4","May.5","May.6","May.7","May.8", "May.9", "May.10", "May.11", "May.12", "May.13"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : gradient_2,
					strokeColor : "rgba(255,255,255,0.3)",
					pointColor : "rgba(180,29,2,0.6)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#B41D02",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : calorie
				}
			]

		}

		window.onload = function(){

			initialize();

			var ctx = document.getElementById("steps").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true,
				bezierCurveTension : 0.1
			});

			var ctx_1 = document.getElementById("distance").getContext("2d");
			window.myLine_1 = new Chart(ctx_1).Line(lineChartData_1, {
				responsive: true,
				bezierCurveTension : 0.1
			});

			var ctx_2 = document.getElementById("calorie").getContext("2d");
			window.myLine_2 = new Chart(ctx_2).Line(lineChartData_2, {
				responsive: true,
				bezierCurveTension : 0
			});
		}

		$('#randomizeData').click(function(){
	    	lineChartData.datasets[0].fillColor = 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.3)';
	    	lineChartData.datasets[0].data = [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()];

	    	lineChartData.datasets[1].fillColor = 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.3)';
	    	lineChartData.datasets[1].data = [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()];

	    	window.myLine.update();
	    });
	    </script>


		<script>
		//reload
		function reload(){
			window.location.reload();
		}


		var latlng_array = latlng.split('\n');
		var length = latlng_array.length-1;


		// console.log(length);
		// console.log(latlng_array);


		function initialize() {

			//generate coordinates from database
			var	flightPlanCoordinates = [];
			var bounds = new google.maps.LatLngBounds();

			for (var i=0; i < length; i++){
				latlng_single = latlng_array[i].replace('(', '');
				latlng_single = latlng_single.replace(')', '');
				lat = latlng_single.split(',')[0];
				lng = latlng_single.split(',')[1];



				if(i == 0){
					var start_lat = lat;
					var start_lng = lng;
				}

				if(i == length-1){
					var end_lat = lat;
					var end_lng = lng;
				}

				flightPlanCoordinates.push(new google.maps.LatLng(lat, lng));
				bounds.extend(new google.maps.LatLng(lat, lng));
			}

			console.log(flightPlanCoordinates);

			var map = new google.maps.Map(document.getElementById('map'));

			//auto-resize
			map.fitBounds(bounds);

		  
			var flightPath = new google.maps.Polyline({
				path: flightPlanCoordinates,
				geodesic: true,
				strokeColor: '#49075E',
				strokeOpacity: 1.0,
				strokeWeight: 4
			});

			var image_start = 'img/marker_start.png';

			var marker_start = new google.maps.Marker({
			    position: new google.maps.LatLng(start_lat, start_lng),
			    icon: image_start
			});

			var image_end = 'img/marker_end.png';

			var marker_end = new google.maps.Marker({
			    position: new google.maps.LatLng(end_lat, end_lng),
			    icon: image_end
			});

			marker_start.setMap(map);
			marker_end.setMap(map);

			flightPath.setMap(map);
			
		}

		</script>



	</body>