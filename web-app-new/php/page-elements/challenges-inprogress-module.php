<script type="text/javascript">
	// var showingJoined = true;
	setListHeight();
	$(window).resize(setListHeight);
	loadChallengesList();

	jQuery.expr[':'].Contains = function(a,i,m){
	    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	/*function toggleGroupSearch() {
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
	}*/

	function loadChallengesList() {
		$("#challenges-search-box").val("");
		$.ajax({
			url: "./php/function/get_challenges_list.php",
			dataType: "html",
			beforeSend: function() {
				$(".challenges-list").html("<p><i class='fa fa-circle-o-notch fa-spin'></i> Loading challenges");
			},
			success: function(data) {
				$(".challenges-list").html(data);
				console.log("Loaded challenges list success");
			},
			error: function(jqXHR, status, err) {
				$(".challenges-list").html("<p><i class='fa fa-exclamation-circle'></i> Error loading challenges. (" + status + ": " + err + ")</p>");
			}
		});
	}

/*	function loadOtherGroupsList() {
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
	}*/

	function filterChallenges() {
		var filter = $("#challenge-search-box").val();
		if (filter) {
			$(".challenges-list").find(".list-challenge-name:not(:Contains(" + filter + "))").parent().slideUp(100, "swing");
			$(".challenges-list").find(".list-challenge-name:Contains(" + filter + ")").parent().slideDown(100, "swing");
		} else {
			$(".challenges-list").find("li").slideDown(100, "swing");
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

	function showChallenge(challenge_id, item) {
		// We will use ajax to load challenge profiles
		$(".challenges-list > li").each(function() {
			$(this).removeClass("active-list-item");
		});
		$(item).addClass("active-list-item");
		$(".challenges-content").addClass("slide-in");
		$.ajax({
			url: "./php/page-elements/view-challenge.php",
			dataType: "html",
			data: "challenge_id=" + challenge_id,
			success: function(data) {
				$(".challenges-content").html(data);
				$(".challenges-content").removeClass("slide-in");
				updateProgressChart(challenge_id);
			},
			error: function(jqXHR, status, err) {
				$(".challenges-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading challenge information. (" + status + ": " + err + ")</p>");
				console.log("Error loading challenge info");
			}
		});
	}

	function updateProgressChart() {
		// some data will need to be retrieved via ajax again

		var ctx = $("#progress-chart").get(0).getContext("2d");
		var data = [
			{
			        value: 400,
			        color:doughnutProgressColour,
			        highlight: doughnutProgressColour,
			        label: "Completed"
		    },
		    {
			        value: 600,
			        color: doughnutRemainingColour,
			        highlight: doughnutRemainingColour,
			        label: "Remaining"
		    }
		];

		var progressChart = new Chart(ctx).Doughnut(data, doughnutOptions);
	}

/*	function joinGroup(group_id, button) {
		$.ajax({
			url: "./php/function/join_group.php",
			dataType: "html",
			data: "group_id=" + group_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Joined Group");
				$(button).prop("disabled", true);
				loadGroupsList();
			},
			error: function(jqXHR, status, err) {
				console.log("Error joining group. (" + status + ": " + err + ")");
			}
		});
	}*/

	function leaveChallenge(challenge_id, button) {
		$.ajax({
			url: "./php/function/leave_challenge.php",
			dataType: "html",
			data: "challenge_id=" + challenge_id,
			success: function(data) {
				$(button).html("<i class='fa fa-check'></i> Left Challenge");
				$(button).prop("disabled", true);
				loadChallengesList();
			},
			error: function(jqXHR, status, err) {
				console.log("Error leaving challenge. (" + status + ": " + err + ")");
			}
		});
	}

	function showCreate() {
		$(".challenges-content").addClass("slide-in");
		if (!showingJoined) {
			toggleGroupSearch();
		}
		$.ajax({
			url: "./php/page-elements/create_challenge_form.php",
			dataType: "html",
			success: function(data) {
				$(".challenges-content").html(data);
				$(".challenges-content").removeClass("slide-in");
				$(".create-challenge-form").on('submit', function(e) {
					e.preventDefault();
					createChallenge();
				});
				// initMultiSelector();
			},
			error: function(jqXHR, status, err) {
				$(".challenges-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Error loading content. (" + status + ": " + err + ")</p>");
				console.log("Error loading challenge creator");
			}
		});
	}

/*	function initMultiSelector() {
		$("#creator-group-friends-list").select2({
			placeholder: "Search or select friends to add"
		});

		console.log("Multi selector initialised");
	}*/

	function createChallenge() {
		// Need to manually serialise the form, the custom select box doesn't serialise properly when multiple values are selected
		/*var dataString = "group_name=" + $("#creator-group-name").val() + "&group_description=" + $("#creator-group-description").val() + "&group_friends_list=" + $("#creator-group-friends-list").val();
		$.ajax({
			type: "POST",
			url: "./php/function/create_group.php",
			data: dataString,
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
		});*/
	}
</script>

<div class="challenges-sidebar module-sidebar">
	<a id="create-challenge-button" onClick="showCreate();"><i class="fa fa-plus fa-fw"></i><span>Create challenge</span></a>
	<input id="challenge-search-box" type="search" placeholder="Filter challenges" onKeyup="filterChallenges();">
	<ul class="challenges-list">
		<!-- Challenges list will load here via ajax -->
	</ul>
</div>
<div class="challenges-content slide-in">
	<!-- Selected challenge profile will load here via ajax -->
</div>