<?php
// Include session_start, step_data, distance_data, user_data file.
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/step_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/distance_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/user_data.php');

?>

<script type="text/javascript">
	var friendView = true;
	var compareChart;
	setListHeight();
	$(window).resize(setListHeight);
	loadFriendsList();

	jQuery.expr[':'].Contains = function(a,i,m){
	    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	function toggleFriendSearch() {
		if (friendView) {
			// Switch to user search
			$("#add-friend-button").find('i').addClass("icon-rotate");
			$("#add-friend-button").find('span').fadeOut(100, "swing", function() {
				$("#add-friend-button").find('span').text("Back to friends list").fadeIn(300, "swing");
			});
			$("#friend-search-box").val("");
			$("#friend-search-box").attr("placeholder", "Find more people");
			$("#friend-search-box").attr("onKeyUp", "");
			$("#friend-search-box").attr("onKeyPress", "searchUsers(event);");
			$("#friend-search-box").focus();
			$("#rank-option").fadeOut(100, "swing");
			$(".friends-list").fadeOut(100, "swing", function() {
				$(".search-results").html("<p>Type in a name and press Enter</p>");
				$(".search-results").fadeIn(100, "swing");
			});
			$(".friends-content").addClass("slide-in");
			friendView = false;
		} else {
			// Switch to friend search
			$("#add-friend-button").find('i').removeClass("icon-rotate");
			$("#add-friend-button").find('span').fadeOut(100, "swing", function() {
				$("#add-friend-button").find('span').text("Add Friend").fadeIn(300, "swing");
			});
			$("#friend-search-box").val("");
			$("#friend-search-box").attr("placeholder", "Filter friends");
			$("#friend-search-box").attr("onKeyPress", "");
			$("#friend-search-box").attr("onKeyUp", "filterFriendsList();");
			$("#rank-option").fadeIn(100, "swing");
			$(".search-results").fadeOut(100, "swing", function() {
				$(".friends-list").fadeIn(100, "swing");
			});
			//$(".friends-list").each().slideDown(100, "swing");
			filterFriendsList();
			$(".friends-content").addClass("slide-in");
			$(".friends-list > li").each(function() {
				$(this).removeClass("active-list-item");
			});
			friendView = true;
		}
	}

	function loadFriendsList() {
		$("#friend-search-box").val("");
		var rankBy = $("#rank-option").val();
		$.ajax({
			url: "./php/function/get_friends_list.php",
			dataType: "html",
			data: "rankBy=" + rankBy,
			success: function(data) {
				$(".friends-list").html(data);
				console.log("Loaded friends list success, sorted by " + rankBy);
			},
			error: function(jqXHR, status, err) {
				$(".friends-list").html("<p><i class='fa fa-exclamation-circle'></i> Error loading user friends list. (" + status + ": " + err + ")</p>");
			}
		});
	}

	function filterFriendsList() {
		var filter = $("#friend-search-box").val();
		if (filter) {
			$(".friends-list").find("p:not(:Contains(" + filter + "))").parent().slideUp(100, "swing");
			$(".friends-list").find("p:Contains(" + filter + ")").parent().slideDown(100, "swing");
		} else {
			$(".friends-list").find("li").slideDown(100, "swing");
		}
	}

	function searchUsers(event) {
		// we will use ajax to search users when user presses enter
		var searchInput = $("#friend-search-box").val();
		if (event.keyCode == 13 && searchInput) {
			console.log("Searching for " + searchInput);
			$.ajax({
			url: "./php/function/get_user_list.php",
			dataType: "html",
			data: "search=" + searchInput,
			success: function(data) {
				$(".search-results").html(data);
			},
			error: function(jqXHR, status, err) {
				$(".search-results").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error searching for users. (" + status + ": " + err + ")</p>");
			}
		});
		}
	}

	function showProfile(user_id, item) {
		// We will use ajax to load user profiles
		var visibleList = friendView ? ".friends-list" : ".search-results";
		$(visibleList + " > li").each(function() {
			$(this).removeClass("active-list-item");
		});
		$(item).addClass("active-list-item");
		$(".friends-content").addClass("slide-in");
		$.ajax({
			url: "./php/page-elements/view-friend.php",
			dataType: "html",
			data: "userid=" + user_id,
			success: function(data) {
				$(".friends-content").html(data);
				$(".friends-content").removeClass("slide-in");
				updateChart();
			},
			error: function(jqXHR, status, err) {
				$(".friends-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading user information. (" + status + ": " + err + ")</p>");
			}
		});
	}

	function addFriend(user_id, button) {
		$.ajax({
			url: "./php/function/add_friend.php",
			dataType: "html",
			data: "userid=" + user_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Request Sent");
				$(button).prop("disabled", true);
				loadFriendsList();
			},
			error: function(jqXHR, status, err) {
				console.log("Error adding friend. (" + status + ": " + err + ")");
			}
		});
	}

	function removeFriend(user_id, button) {
		$.ajax({
			url: "./php/function/remove_friend.php",
			dataType: "html",
			data: "userid=" + user_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Friend Removed");
				$(button).prop("disabled", true);
				loadFriendsList();
			},
			error: function(jqXHR, status, err) {
				console.log("Error removing friend. (" + status + ": " + err + ")");
			}
		});
	}

	function updateChart() {
		if ($("#compare-chart")[0] == null) {
			console.log("Not displaying chart, user is not friend");
			return;
		}
		if (compareChart === undefined) {
			console.log("no chart");
		} else {
			console.log("clearing chart");
			compareChart.clear();
			compareChart.destroy();
		}
		var ctx = $("#compare-chart").get(0).getContext("2d");
		var compareMode = $("#compare-mode").val();
		var compareTime = $("#compare-time").val();
		var labels;
		var dataMe;
		var dataFriend;

		if (compareTime == "today") {
			labels = ["12AM", "1AM", "2AM", "3AM", "4AM", "5AM", "6AM", "7AM", "8AM", "9AM", "10AM", "11AM", "12PM", "1PM", "2PM", "3PM", "4PM", "5PM", "6PM", "7PM", "8PM", "9PM", "10PM", "11PM"];
			if (compareMode == "steps") {
				dataMe = hour_graph_step;
				dataFriend = friend_hour_graph_step;
			} else if (compareMode == "distance") {
				dataMe = hour_graph_distance;
				dataFriend = friend_hour_graph_distance;
			} else {
				dataMe = hour_graph_cal;
				dataFriend = friend_hour_graph_cal;
			}
		} else if (compareTime == "week") {
			labels = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
			if (compareMode == "steps") {
				dataMe = [mon_step,tue_step,wed_step,thu_step,fri_step,sat_step,sun_step];
				dataFriend = [friend_mon_step,friend_tue_step,friend_wed_step,friend_thu_step,friend_fri_step,friend_sat_step,friend_sun_step];
			} else if (compareMode == "distance") {
				dataMe = [mon_distance,tue_distance,wed_distance,thu_distance,fri_distance,sat_distance,sun_distance];
				dataFriend = [friend_mon_distance,friend_tue_distance,friend_wed_distance,friend_thu_distance,friend_fri_distance,friend_sat_distance,friend_sun_distance];
			} else {
				dataMe = [mon_cal,tue_cal,wed_cal,thu_cal,fri_cal,sat_cal,sun_cal];
				dataFriend = [friend_mon_cal,friend_tue_cal,friend_wed_cal,friend_thu_cal,friend_fri_cal,friend_sat_cal,friend_sun_cal];
			}
		} else {
			labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
			if (compareMode == "steps") {
				dataMe = month_graph_step;
				dataFriend = friend_month_graph_step;
			} else if (compareMode == "distance") {
				dataMe = month_graph_distance;
				dataFriend = friend_month_graph_distance;
			} else {
				dataMe = month_graph_cal;
				dataFriend = friend_month_graph_cal;
			}
		}

		var data = {
			labels: labels,
			datasets: [
			    {
			        label: "Me",
			        fillColor: chartFillColour,
			        strokeColor: "rgba(220,220,220,0.8)",
			        highlightFill: chartHighlightColour,
			        highlightStroke: "rgba(220,220,220,1)",
			        data: dataMe
			    },
			    {
			        label: "Friend",
			        fillColor: "#8AB800",
			        strokeColor: "rgba(220,220,220,0.8)",
			        highlightFill: "#A1C633",
			        highlightStroke: "rgba(220,220,220,1)",
			        data: dataFriend
			    }
			]
		};

		compareChart = new Chart(ctx).Bar(data, chartOptions);
	}
</script>

<div class="friends-sidebar module-sidebar">
	<a id="add-friend-button" onClick="toggleFriendSearch();"><i class="fa fa-plus"></i><span>Add Friend</span></a>
	<input id="friend-search-box" type="search" placeholder="Filter friends" onKeyup="filterFriendsList();">
	<select id="rank-option" onChange="loadFriendsList();">
		<option value="first_name" selected="selected">Rank by name</option>
		<option value="user_total_step">Rank by steps</option>
		<option value="user_total_distance">Rank by distance</option>
		<option value="user_total_cal">Rank by calories</option>
	</select>
	<ul class="friends-list">
		<!-- Friends list will load here via ajax -->
	</ul>
	<ul class="search-results">
		<!-- List will load here via ajax -->
	</ul>
</div>
<div class="friends-content slide-in">
	<!-- Selected profile will load here via ajax -->
</div> 