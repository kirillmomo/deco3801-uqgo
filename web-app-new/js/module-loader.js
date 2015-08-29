function loadModule(module, callback) {
	$(".module-content").fadeOut(100, "swing", function() {
		$.ajax({
			url: "./php/page-elements/" + module,
			success: function(data) {
				$(".module-content").html(data);
				if (callback === undefined) {
					// no callback passed
					console.log("Module loaded successfully, no callback passed.")
				} else {
					console.log("Module loaded successfully, executing callback.")
					callback();
				}
			},
			error: function(jqXHR, status, err) {
				$(".module-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Module could not be loaded. (" + status + ": " + err + ")</p>");
			}
		}).always(function() {
			$(".module-content").fadeIn(250, "swing");
		});
	});
}

function highlightNavItem(item) {
	$(".content > nav > a").each(function() {
		$(this).removeClass("subnav-active-item");
	})
	$(item).addClass("subnav-active-item");
}