<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/function/user_data.php');

?>

<script type="text/javascript">
	var friendView = true;
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
				$(button).html("<i class='fa fa-check'></i> Friend Added");
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
</div> module-sidebar