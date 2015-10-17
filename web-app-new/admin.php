<?php 

//Start session 
session_start();

// If session is empty, return to admin login page
if(empty($_SESSION['admin_id'])){
    header('Location: /v0-5/admin-login.php');
  // header('Location: /Beta/web-app-new/admin-login.php');
  }    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Administrator</title>
    <?php include "./php/page-elements/header.php";?>
    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/Chart.js"></script>
  </head>
  <body class="admin">
    <div class="sidebar">
        <div class="user-display">
            <p>Administrator</p>
        </div>
        <nav>
            <a href="admin.php" id="nav-item-report" class="nav-active-item"><i class="fa fa-area-chart fa-fw"></i>&nbsp;Reports</a>
            <a href="./php/function/admin_logout.php" id="nav-item-logout"><i class="fa fa-close fa-fw"></i>&nbsp;Logout</a>
        </nav>
    </div>
    <?php include "./php/page-elements/notification-tray.php";?>
    <div class="content">
        <h1>Reports</h1>
        <div class="module-content">
          <!-- module content will load here automatically -->
        </div>
    </div>
  </body>
</html>