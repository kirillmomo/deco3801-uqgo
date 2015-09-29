<script type="text/javascript">
	var map;
	var routeLine;

	loadSessionsList();
	initMap();
	
	function initMap() {
	  map = new google.maps.Map(document.getElementById('map'), {
	    center: {lat: -27.495649, lng: 153.011923},
	    zoom: 16
	  });
	  console.log("Map initialised");
	}

	// Quick function to convert seconds to HH:MM:SS
	// REFERENCE: http://stackoverflow.com/a/6313008
	String.prototype.toHHMMSS = function () {
	    var sec_num = parseInt(this, 10);
	    var hours   = Math.floor(sec_num / 3600);
	    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
	    var seconds = sec_num - (hours * 3600) - (minutes * 60);

	    if (hours   < 10) {hours   = "0"+hours;}
	    if (minutes < 10) {minutes = "0"+minutes;}
	    if (seconds < 10) {seconds = "0"+seconds;}
	    var time    = hours+':'+minutes+':'+seconds;
	    return time;
	}

	function loadSessionsList() {
		var filterTime = $("#time-option").val();
		$.ajax({
			url: "./php/function/get_sessions_list.php",
			dataType: "html",
			data: "filterTime=" + filterTime,
			success: function(data) {
				$(".sessions-list").html(data);
				console.log("Loaded sessions list success, showing sessions for " + filterTime);
			},
			error: function(jqXHR, status, err) {
				console.log("Error loading session list: " + err);
				$(".sessions-list").html("<p><i class='fa fa-exclamation-circle'></i> There was an error showing your sessions, please try again.</p>");
			}
		});
	}

	function showSession(session_id, item) {
		$(".sessions-list > li").each(function() {
			$(this).removeClass("active-list-item");
		});
		$(item).addClass("active-list-item");
		$.ajax({
			url: "./php/function/get_session_info.php",
			dataType: "json",
			data: "session_id=" + session_id,
			success: function(data) {
				console.log("Success retrieving session info.");
				$(".session-name").text(data["session_name"]);
				$("#session-steps").text(data["steps"]);
				$("#session-distance").text(data["distance"]);
				$("#session-calories").text(data["calories"]);
				var duration = data["duration"]
				$("#session-duration").text(duration.toString().toHHMMSS());
				updateMap(data["routeLatLng"]);
			},
			error: function(jqXHR, status, err) {
				console.log("Error retrieving session info: " + err);
			}
		});
	}

	function updateMap(routeLatLng) {
		var latlng_array = routeLatLng.split('\n');
		var array_length = latlng_array.length;
		var routeCoords = [];

		// BUG: can't seem to clear existing polyline :(
		if (routeLine != null) {
			console.log("Clearing route Polyline");
			routeLine.setMap(null);
		}

		for (var i=0; i < array_length; i++) {
			latlng = latlng_array[i].replace('(', '');
			latlng = latlng.replace(')', '');
			lat = latlng.split(',')[0];
			lng = latlng.split(',')[1];

			// if(i == 0){
			// 	var start_lat = lat;
			// 	var start_lng = lng;
			// }

			// if(i == length){
			// 	var end_lat = lat;
			// 	var end_lng = lng;
			// }

			routeCoords.push(new google.maps.LatLng(lat, lng));
		}

		var routeLine = new google.maps.Polyline({
		  path: routeCoords,
		  geodesic: true,
		  strokeColor: '#49075E',
		  strokeOpacity: 0.75,
		  strokeWeight: 3
		});

		routeLine.setMap(map);
	}

</script>
<div class="sessions-sidebar">
	<select id="time-option" onChange="loadSessionsList();">
		<option value="today">Today</option>
		<option value="week" selected="selected">This week</option>
		<option value="month">This month</option>
		<option value="all">All sessions</option>
	</select>
	<ul class="sessions-list">
		<!-- Sessions list will load here via ajax -->
	</ul>
</div>
<div class="sessions-content">
	<!-- Selected session content will be injected below via ajax -->
	<p class="session-name">Session</p>
	<div class="session-info-bar">
		<div class="session-info">
			<p class="session-info-head">Steps</p>
			<p id="session-steps" class="session-info-data">-</p>
			<p class="session-info-unit">steps</p>
		</div>
		<div class="session-info">
			<p class="session-info-head">Distance</p>
			<p id="session-distance" class="session-info-data">-</p>
			<p class="session-info-unit">km</p>
		</div>
		<div class="session-info">
			<p class="session-info-head">Calories</p>
			<p id="session-calories" class="session-info-data">-</p>
			<p class="session-info-unit">kcal</p>
		</div>
		<div class="session-info">
			<p class="session-info-head">Duration</p>
			<p id="session-duration" class="session-info-data">-</p>
			<p class="session-info-unit">h:m:s</p>
		</div>
	</div>
	<div id="map"></div>
</div>