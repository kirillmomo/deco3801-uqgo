<!-- Notification tray element -->
<div class="notification-tray">
  <ul class="notification-list">
  	No new notifications.
  </ul>
</div>
<div class="notification-darkness" onClick="hideNotificationTray();">
</div>
<script type="text/javascript">
	var pollTime = 10000; // Notification polling time
	var alreadyNotified = false;
	$("#notify").hide();
	getRequests();
	var requestTimer = setInterval(getRequests, pollTime);

	function updateNotifications() {
		var requestCount = $(".notification-list").children().length;
		var star = $("#notify");
		if (requestCount > 0 && !alreadyNotified) {
			// Reset star animation
			var newStar = star.clone(true);
			star.before(newStar);
			newStar.show();
			star.remove();
			alreadyNotified = true;
		} else if (requestCount == 0) {
			// Hide star
			$("#notify").hide();
			alreadyNotified = false;
			$(".notification-list").html("No new notifications.");
		}
	}

	function getRequests() {
		$.ajax({
			url: "./php/function/get_friend_requests.php",
			dataType: "html",
			success: function(data) {
				$(".notification-list").html(data);
				console.log("Success getting friend requests.");
				updateNotifications();
			},
			error: function(jqXHR, status, err) {
				console.log("Error getting friend requests. (" + status + ": " + err + ")");
			}
		});
	}

	function acceptFriend(friend_id) {
		$.ajax({
			url: "./php/function/accept_friend_request.php",
			dataType: "html",
			data: "friend_id=" + friend_id,
			success: function(data) {
				console.log("Success accepting friend request.");
				manuallyGetRequests();
			},
			error: function(jqXHR, status, err) {
				console.log("Error accepting friend request. (" + status + ": " + err + ")");
			}
		});
	}

	function declineFriend(friend_id) {
		$.ajax({
			url: "./php/function/decline_friend_request.php",
			dataType: "html",
			data: "friend_id=" + friend_id,
			success: function(data) {
				console.log("Success declining friend request.");
				manuallyGetRequests();
			},
			error: function(jqXHR, status, err) {
				console.log("Error declining friend request. (" + status + ": " + err + ")");
			}
		});
	}

	function manuallyGetRequests() {
		clearInterval(requestTimer);
		getRequests();
		requestTimer = setInterval(getRequests, pollTime);
	}
</script>