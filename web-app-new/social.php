<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Social</title>
    <?php include "./php/page-elements/header.php";?>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#nav-item-social").addClass("nav-active-item"); // highlight corresponding nav item in sidebar
          loadModule('social-profile-module.php');
      });
    </script>
  </head>
  <body>
    <?php include "./php/page-elements/sidebar.php";?>
    <?php include "./php/page-elements/notification-tray.php";?>
    <div class="content">
        <h1>Social</h1>
        <nav>
          <a onClick="highlightNavItem(this); loadModule('social-profile-module.php');" class="subnav-active-item">Profile</a>
          <a onClick="highlightNavItem(this); loadModule('social-friends-module.php');">Friends</a>
          <a onClick="highlightNavItem(this); loadModule('social-groups-module.php');">Groups</a>
        </nav>
        <div class="module-content">
          <!-- module content will load here automatically -->
        </div>
    </div>
  </body>
</html>