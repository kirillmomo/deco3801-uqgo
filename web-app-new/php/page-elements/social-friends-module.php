<!--<?php
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/session_start.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/session_start.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/user_data.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-2/php/function/user_data.php');
?>-->

<script type="text/javascript">
	var friendView = true;

	jQuery.expr[':'].Contains = function(a,i,m){
	    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	function toggleFriendSearch() {
		if (friendView) {
			$("#add-friend-button").find('i').addClass("icon-rotate");
			$("#add-friend-button").find('span').fadeOut(100, "swing", function() {
				$("#add-friend-button").find('span').text("Back to friends list").fadeIn(300, "swing");
			});
			$("#friend-search-box").val("");
			$("#friend-search-box").attr("placeholder", "Find more people");
			$("#friend-search-box").attr("onKeyUp", "");
			$("#friend-search-box").attr("onKeyPress", "searchUsers(event);");
			$("#friend-search-box").focus();
			$(".friends-list").fadeOut(100, "swing", function() {
				$(".search-results").fadeIn(100, "swing");
			});
			friendView = false;
		} else {
			$("#add-friend-button").find('i').removeClass("icon-rotate");
			$("#add-friend-button").find('span').fadeOut(100, "swing", function() {
				$("#add-friend-button").find('span').text("Add Friend").fadeIn(300, "swing");
			});
			$("#friend-search-box").val("");
			$("#friend-search-box").attr("placeholder", "Filter friends");
			$("#friend-search-box").attr("onKeyPress", "");
			$("#friend-search-box").attr("onKeyUp", "filterFriendsList();");
			$(".search-results").fadeOut(100, "swing", function() {
				$(".friends-list").fadeIn(100, "swing");
			});
			//$(".friends-list").each().slideDown(100, "swing");
			friendView = true;
		}
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
		var searchInput = $("#friend-search-box").val();
		if (event.keyCode == 13 && searchInput) {
			console.log("searching");
			// we will use ajax to search users when user presses enter
		}
	}

	function showProfile(user_id, item) {
		// we will use ajax to load user profiles
		//$(".friends-content").text("test showing friend with ID: " + user_id);
		$(".friends-list > li").each(function() {
			$(this).removeClass("active-list-item")
		});
		$(item).addClass("active-list-item");
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
</script>

<div class="friends-sidebar">
	<a id="add-friend-button" onClick="toggleFriendSearch();"><i class="fa fa-plus"></i><span>Add Friend</span></a>
	<input id="friend-search-box" type="search" placeholder="Filter friends" onKeyup="filterFriendsList();">
	<ul class="friends-list">
	<?php
	for($i = 0; $i<sizeof($friend_list_display); $i++)
	{
	?>
	<li onClick="showProfile('echo user_id here');"><div class="friend-image"></div><p><?php echo $friend_list_display[$i]; ?></p></li>
	<?php
	}
	?>
		<!-- EXAMPLE FRIENDS LIST - friends should be echoed like below -->
		<!-- <li onClick="showProfile('1', this);"><div class="friend-image"></div><p>Johnson Carter</p></li>
		<li onClick="showProfile('2', this);"><div class="friend-image"></div><p>Johnson Jackson</p></li>
		<li onClick="showProfile('3', this);"><div class="friend-image"></div><p>Jenson Carter</p></li>
		<li onClick="showProfile('4', this);"><div class="friend-image"></div><p>Jenson Jackson</p></li> -->
	</ul>
	<ul class="search-results">
		<p>Type in a name and press Enter</p>
	</ul>
</div>
<div class="friends-content slide-in">
	%profile content%
</div>