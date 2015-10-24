<script type="text/javascript">
	var showingJoined = true;
	setListHeight();
	$(window).resize(setListHeight);
	loadJoinedGroupsList();

	jQuery.expr[':'].Contains = function(a,i,m){
	    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	function toggleGroupSearch() {
		if (showingJoined) {
			// Show nonjoined groups
			$("#discover-groups-button").find('i').fadeOut(100, "swing", function() {
				$("#discover-groups-button").find('i').removeClass("fa-search").addClass("fa-chevron-left").fadeIn(200, "swing");
			});
			$("#discover-groups-button").find('span').fadeOut(100, "swing", function() {
				$("#discover-groups-button").find('span').text("Back to my groups").fadeIn(200, "swing");
			});
			$("#group-search-box").val("");
			$("#group-search-box").focus();
			$(".groups-content").addClass("slide-in");
			showingJoined = false;
			loadOtherGroupsList();
			console.log("Showing nonjoined groups");
		} else {
			// Show joined groups
			$("#discover-groups-button").find('i').fadeOut(100, "swing", function() {
				$("#discover-groups-button").find('i').removeClass("fa-chevron-left").addClass("fa-search").fadeIn(200, "swing");
			});
			$("#discover-groups-button").find('span').fadeOut(100, "swing", function() {
				$("#discover-groups-button").find('span').text("Discover groups").fadeIn(200, "swing");
			});
			$("#group-search-box").val("");
			filterGroups();
			$(".groups-content").addClass("slide-in");
			$(".groups-list > li").each(function() {
				$(this).removeClass("active-list-item");
			});
			showingJoined = true;
			loadJoinedGroupsList();
			console.log("Showing joined groups");
		}
	}

	function loadJoinedGroupsList() {
		$("#group-search-box").val("");
		$.ajax({
			url: "./php/function/get_groups_list.php",
			dataType: "html",
			beforeSend: function() {
				$(".groups-list").html("<p><i class='fa fa-circle-o-notch fa-spin'></i> Loading your groups");
			},
			success: function(data) {
				$(".groups-list").html(data);
				console.log("Loaded groups list success");
			},
			error: function(jqXHR, status, err) {
				$(".groups-list").html("<p><i class='fa fa-exclamation-circle'></i> Error loading groups. (" + status + ": " + err + ")</p>");
			}
		});
	}

	function loadOtherGroupsList() {
		$("#group-search-box").val("");
		$.ajax({
			url: "./php/function/get_other_groups_list.php",
			dataType: "html",
			beforeSend: function() {
				$(".groups-list").html("<p><i class='fa fa-circle-o-notch fa-spin'></i> Loading groups");
			},
			success: function(data) {
				$(".groups-list").html(data);
				console.log("Loaded groups list success");
			},
			error: function(jqXHR, status, err) {
				$(".groups-list").html("<p><i class='fa fa-exclamation-circle'></i> Error loading groups. (" + status + ": " + err + ")</p>");
			}
		});
	}

	function filterGroups() {
		var filter = $("#group-search-box").val();
		if (filter) {
			$(".groups-list").find("p:not(:Contains(" + filter + "))").parent().slideUp(100, "swing");
			$(".groups-list").find("p:Contains(" + filter + ")").parent().slideDown(100, "swing");
		} else {
			$(".groups-list").find("li").slideDown(100, "swing");
		}
	}

	/*function searchGroups(event) {
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
	}*/

	function showGroup(group_id, item) {
		// We will use ajax to load group profiles
		$(".groups-list > li").each(function() {
			$(this).removeClass("active-list-item");
		});
		if (item != undefined) {
			$(item).addClass("active-list-item");
		}
		$(".groups-content").addClass("slide-in");
		$.ajax({
			url: "./php/page-elements/view-group.php",
			dataType: "html",
			data: "group_id=" + group_id,
			success: function(data) {
				$(".groups-content").html(data);
				$(".groups-content").removeClass("slide-in");
			},
			error: function(jqXHR, status, err) {
				$(".groups-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading group information. (" + status + ": " + err + ")</p>");
				console.log("Error loading group info");
			}
		});
	}

	function joinGroup(group_id, button) {
		$.ajax({
			url: "./php/function/join_group.php",
			dataType: "html",
			data: "group_id=" + group_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Joined Group");
				$(button).prop("disabled", true);
				toggleGroupSearch();
				showGroup(group_id);
			},
			error: function(jqXHR, status, err) {
				console.log("Error joining group. (" + status + ": " + err + ")");
			}
		});
	}

	function leaveGroup(group_id, button) {
		$.ajax({
			url: "./php/function/leave_group.php",
			dataType: "html",
			data: "group_id=" + group_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Left Group");
				$(button).prop("disabled", true);
				loadJoinedGroupsList();
				$(".groups-content").addClass("slide-in");
			},
			error: function(jqXHR, status, err) {
				console.log("Error leaving group. (" + status + ": " + err + ")");
			}
		});
	}

	function showCreate() {
		$(".groups-content").addClass("slide-in");
		if (!showingJoined) {
			toggleGroupSearch();
		}
		$.ajax({
			url: "./php/page-elements/create_group_form.php",
			dataType: "html",
			success: function(data) {
				$(".groups-content").html(data);
				$(".groups-content").removeClass("slide-in");
				$(".create-group-form").on('submit', function(e) {
					e.preventDefault();
					createGroup();
				});
				initMultiSelector();
			},
			error: function(jqXHR, status, err) {
				$(".groups-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading content. (" + status + ": " + err + ")</p>");
				console.log("Error loading group creator");
			}
		});
	}

	function initMultiSelector() {
		$("#creator-group-friends-list").select2({
			placeholder: "Search or select friends to add"
		});

		console.log("Multi selector initialised");
	}

	function createGroup() {
		// Need to manually serialise the form, the custom select box doesn't serialise properly when multiple values are selected
		// var dataString = "group_name=" + $("#creator-group-name").val() + "&group_description=" + $("#creator-group-description").val() + "&group_friends_list=" + $("#creator-group-friends-list").val();
		var inviteFriends = $("#creator-group-friends-list").val();
		var formData = new FormData($(".create-group-form").get(0));
		formData.append("inviteFriends", inviteFriends);
		console.log(formData);
		$.ajax({
			type: "POST",
			url: "./php/function/create_group.php",
			data: formData,
		    processData: false,
		    contentType: false,
		    beforeSend: function() {
				$("#create-group-submit").prop("disabled", true);
		    	$("#create-group-submit").html("<i class='fa fa-circle-o-notch fa-spin'></i> Creating Group");
		    },
			success: function(data) {
				if (data) {
					console.log("Success creating group: " + data);
					$("#create-group-submit").html("<i class='fa fa-check'></i> Group Created");
					$("#create-group-submit").prop("disabled", true);
					$("#view-new-group").attr("onClick", "showGroup('" + data + "')");
					$("#view-new-group").removeClass("slide-in");
					if (showingJoined) {
						loadJoinedGroupsList();
					}
				} else {
					console.log("Error creating group");
				}
			},
			error: function(jqXHR, status, err) {
				console.log("Error creating group: " + err);
			}
		});
	}
</script>

<div class="groups-sidebar module-sidebar">
	<a id="create-group-button" onClick="showCreate();"><i class="fa fa-plus fa-fw"></i><span>Create group</span></a>
	<a id="discover-groups-button" onClick="toggleGroupSearch();"><i class="fa fa-search fa-fw"></i><span>Discover groups</span></a>
	<input id="group-search-box" type="search" placeholder="Filter groups" onKeyup="filterGroups();">
	<ul class="groups-list">
		<!-- Groups list will load here via ajax -->
	</ul>
</div>
<div class="groups-content slide-in">
	<!-- Selected group profile will load here via ajax -->
</div>