<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Dashboard</title>
    <?php
    // include "./php/page-elements/header.php"; 
    include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/page-elements/header.php');
    ?>
    <script src="./js/Chart.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK9O0kWtRPAQe1ik_-8_O28b2OmxrQiZE"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#nav-item-dashboard").addClass("nav-active-item"); // highlight corresponding nav item in sidebar
          loadModule('dashboard-overview-module.php', "loadSummaryChart");
      });
    </script>
  </head>
  <body>
  <?php
  // include "./php/page-elements/sidebar.php"; 
  // include "./php/page-elements/notification-tray.php";
  include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/page-elements/sidebar.php');
  include($_SERVER['DOCUMENT_ROOT'].'/v0-3/php/page-elements/notification-tray.php');
  ?>
    <div class="content">
        <h1>Dashboard</h1>
        <nav>
          <a onClick="highlightNavItem(this); loadModule('dashboard-overview-module.php', 'switchChartMode');" class="subnav-active-item">Overview</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-steps-module.php', 'switchChartMode');">Steps</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-distance-module.php', 'switchChartMode');">Distance</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-calories-module.php', 'switchChartMode');">Calories</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-sessions-module.php');">Sessions</a>
        </nav>
        <div class="module-content">
          <!-- module content will load here automatically -->
        </div>
    </div>
  </body>
</html>