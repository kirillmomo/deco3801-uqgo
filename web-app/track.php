<?php
	include('connect.php');
	session_start();

	//if user hasn't logged in, go back to login page
	if(!isset($_SESSION['username'])){
		header('Location: index.php');
	}

	if(!isset($_GET['id'])){

		$query = "SELECT latlng FROM route WHERE id = (SELECT MAX(id) FROM route) ";
		
	} else {
		$query = "SELECT latlng FROM route WHERE id = '".$_GET['id']."' ";
	}

	$result = mysqli_query($dbconn, $query);

	while($row = mysqli_fetch_array($result)){

		echo "
			<script>
				var latlng = ".json_encode($row['latlng']).";
				console.log(latlng);

			</script>
		";
	}

?>

<script>
	
</script>

<!DOCTYPE HTML>

<html>
	<head>
		<title>UQ GO | Track</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="js/Chart.js"></script>
		<script src="js/ajax.js"></script>
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
				<p class="select">Me</p>
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
				<div class="tag">
					<a href='homepage.php'><p>Overview</p></a>
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

				<div class="tag select">
					<p>Track</p>
				</div>
			</div>

			<div id="map-container">
				<div id="session">
					<form>
						<input id="search" type="search" placeholder="Search for a session" onkeyup="showSession();">
					</form>	


					<div id="session-content">
<?php
				$query_session = "SELECT id, date, time FROM route ORDER BY id DESC";
				$result_session = mysqli_query($dbconn, $query_session);

				$counter = 0;
				while($row = mysqli_fetch_array($result_session)){
					if(isset($_GET['id'])){
						if($row['id'] == $_GET['id']){
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag session-tag-select'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
						} else {
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
						}
					} else {
						if($counter == 0){
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag session-tag-select'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
							$counter++;
						} else {
							echo "
								<a href='track.php?id=".$row['id']."'><div class='session-tag'><p>".$row['date']." ".$row['time']."</p></div></a>
							";
						}
					}
				}
?>
					</div>
					
				</div>

				<div id="track-map">

				</div>
			</div>



		</div><!--main-->


		<script>
		//reload
		function reload(){
			window.location.reload();
		}


		var latlng_array = latlng.split('\n');
		var length = latlng_array.length-1;


		console.log(length);
		console.log(latlng_array);


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

			var map = new google.maps.Map(document.getElementById('track-map'));

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

		google.maps.event.addDomListener(window, 'load', initialize);
	   
		</script>
</body>