// Dynamically sets the list height based on viewport height (e.g. friends lists, etc)
function setListHeight() {
  var windowHeight = $(window).height();
  var subtractHeight = 200; // extra padding
  subtractHeight += $(".content > h1").outerHeight();
  subtractHeight += $(".content > nav").outerHeight();
  $(".module-sidebar").children(':not(:last-child)').each(function() {
      subtractHeight += $(this).outerHeight();
  });
  $(".module-sidebar > ul").height(windowHeight - subtractHeight);
}