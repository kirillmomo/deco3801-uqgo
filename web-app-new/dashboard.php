<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQgo</title>
    <?php include "./php/page-elements/header.php";?>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#nav-item-dashboard").addClass("nav-active-item"); // highlight corresponding nav item in sidebar
      });
    </script>
  </head>
  <body>
    <?php include "./php/page-elements/sidebar.php";?>
    <div class="notification-tray">
      <p>Hello there.</p>
    </div>
    <div class="notification-darkness" onClick="hideNotificationTray();">
    </div>
    <div class="content">
        <h1>Dashboard</h1>
        <p>contents here</p>
    </div>
  </body>
</html>