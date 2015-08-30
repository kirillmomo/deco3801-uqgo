<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Dashboard</title>
    <?php include "./php/page-elements/header.php";?>
    <script src="./js/Chart.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#nav-item-dashboard").addClass("nav-active-item"); // highlight corresponding nav item in sidebar
          loadModule('dashboard-overview-module.php', "loadSummaryChart");
      });
    </script>
  </head>
  <body>
    <?php include "./php/page-elements/sidebar.php";?>
    <?php include "./php/page-elements/notification-tray.php";?>
    <div class="content">
        <h1>Dashboard</h1>
        <nav>
          <a onClick="highlightNavItem(this); loadModule('dashboard-overview-module.php', 'loadSummaryChart');" class="subnav-active-item">Overview</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-steps-module.php');">Steps</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-distance-module.php');">Distance</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-calories-module.php');">Calories</a>
          <a onClick="highlightNavItem(this); loadModule('dashboard-map-module.php');">Map</a>
        </nav>
        <div class="module-content">
          <!-- module content will load here automatically -->
        </div>
    </div>
  </body>
</html>