function toggleNotificationTray() {
  if (!$(".notification-tray").hasClass("tray-visible")) {
    showNotificationTray();
  } else {
    hideNotificationTray();
  }
}

function showNotificationTray() {
  $(".notification-tray").addClass("tray-visible");
  $(".notification-darkness").stop().fadeIn(300, "swing");
}

function hideNotificationTray() {
  $(".notification-tray").removeClass("tray-visible");
  $(".notification-darkness").stop().fadeOut(300, "swing");
}