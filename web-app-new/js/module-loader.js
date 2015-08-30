/*	This script dynamically loads 'modules' for the main pages when the tabs are clicked.*/

//loads the specified module. callback must be a string.
function loadModule(module, callback) {
	//$(".module-content").fadeOut(100, "swing", function() {
		$.ajax({
			url: "./php/page-elements/" + module,
			dataType: "html",
			success: function(data) {
				$(".module-content").html(data);
				if (callback === undefined) {
					// no callback passed
					console.log("Module loaded successfully, no callback passed.")
				} else {
					console.log("Module loaded successfully, executing callback.")
					window[callback]();
				}
			},
			error: function(jqXHR, status, err) {
				$(".module-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Module could not be loaded. (" + status + ": " + err + ")</p>");
			}
		}).always(function() {
			//$(".module-content").fadeIn(250, "swing");
		});
	//});
}

//highlights active tab
function highlightNavItem(item) {
	$(".content > nav > a").each(function() {
		$(this).removeClass("subnav-active-item");
	})
	$(item).addClass("subnav-active-item");
}