<?php 
session_start();

// If session is empty, return to admin login page
if(empty($_SESSION['admin_id'])){
    header('Location: /v0-6/admin-login.php');
  } 

  include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/admin_function.php');   
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
    <div class="content">
        <h1>Reports</h1>
        <div class="button-bar"><a href="admin.php" class="button button-primary"><i class="fa fa-arrow-circle-left"></i> New Report</a><button><i class="fa fa-file-pdf-o"></i> Export PDF</button><button><i class="fa fa-file-excel-o"></i> Export XLSX</button></div>
        <div class="module-content">
          <table class="report-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Steps</th>
                <th>Distance</th>
                <th>Calories</th>
              </tr>
            </thead>
            <tbody>
          <?php for($i = 0; $i<sizeof($user_first_name); $i++)
              {?>
              <tr>
                <td><?php echo $user_first_name[$i]; ?> <?php echo $user_last_name[$i]; ?></td>
                <td><?php echo $user_age[$i]; ?></td>
                <td><?php echo $user_gender[$i]; ?></td>
                <td><?php echo $user_height[$i]; ?></td>
                <td><?php echo $user_weight[$i]; ?></td>
                <td><?php echo $session_steps[$i]; ?></td>
                <td><?php echo $session_distance[$i]; ?> km</td>
                <td><?php echo $session_cal[$i]; ?> kcal</td>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </body>
</html>