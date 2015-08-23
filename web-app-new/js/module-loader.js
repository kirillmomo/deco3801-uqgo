function loadModule(module) {
	$.ajax({
		url: "./php/page-elements/" + module,
		success: function(data) {
			$(".module-content").html(data);
		},
		error: function(jqXHR, status, err) {
			$(".module-content").html("<p class='module-error'><i class='fa fa-exclamation-circle'></i> Module could not be loaded. (" + status + ": " + err + ")</p>");
		}
	});
}

function highlightNavItem(item) {
	$(".content > nav > a").each(function() {
		$(this).removeClass("subnav-active-item");
	})
	$(item).addClass("subnav-active-item");
}