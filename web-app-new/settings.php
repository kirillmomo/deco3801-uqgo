<?php include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/update_account_settings.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Settings</title>
    <?php include "./php/page-elements/header.php";?>
    <script type="text/javascript">
      $(document).ready(function() {
          $("#nav-item-settings").addClass("nav-active-item"); // highlight corresponding nav item in sidebar
          loadModule('settings-account-module.php');
      });
    </script>
  </head>
  <body>
    <?php include "./php/page-elements/sidebar.php";?>
    <?php include "./php/page-elements/notification-tray.php";?>
    <div class="content">
        <h1>Settings</h1>
        <nav>
          <a onClick="highlightNavItem(this); loadModule('settings-account-module.php');" class="subnav-active-item">Account</a>
          <a onClick="highlightNavItem(this); loadModule('settings-bodyinfo-module.php');">Body Info</a>
        </nav>
        <div class="module-content">
          <!-- module content will load here automatically -->
        </div>
    </div>
  </body>
</html>