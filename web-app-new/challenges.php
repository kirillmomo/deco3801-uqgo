<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Challenges</title>
    <?php include "./php/page-elements/header.php";?>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#nav-item-challenges").addClass("nav-active-item"); // highlight corresponding nav item in sidebar
          loadModule('challenges-xxx-module.php');
      });
    </script>
  </head>
  <body>
    <?php include "./php/page-elements/sidebar.php";?>
    <?php include "./php/page-elements/notification-tray.php";?>
    <div class="content">
        <h1>Challenges</h1>
        <nav>
          <a onClick="highlightNavItem(this); loadModule('challenges-xxx-module.php');" class="subnav-active-item">Joined</a>
          <a onClick="highlightNavItem(this); loadModule('challenges-xxx-module.php');">Create</a>
          <a onClick="highlightNavItem(this); loadModule('challenges-xxx-module.php');">Discover</a>
        </nav>
        <div class="module-content">
          <!-- module content will load here automatically -->
        </div>
    </div>
  </body>
</html>