<?php 

// //Start session 
// session_start();

// // If session is empty, return to admin login page
// if(empty($_SESSION['admin_id'])){
//     header('Location: /v0-6/admin-login.php');
//   }    
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
        <div class="module-content">
          <form class="report-filter-form" method="post" action="./admin-report.php" enctype="multipart/form-data">
            <p><label>Age</label><input type="number" Name="min_age" placeholder="Mininum"><input type="number" Name="max_age" placeholder="Maximum"></p>
            <p><label>Gender</label><input type="checkbox" Name="gender[]" value="Male" id="radio-male"><label class="checkbox-label" for="radio-male">Male</label><input type="checkbox" Name="gender[]" value="Female" id="radio-female"><label class="checkbox-label" for="radio-female">Female</label></p>
            <p><label>Height</label><input type="number" Name="min_height" placeholder="Mininum"><input type="number" Name="max_height" placeholder="Maximum"></p>
           <p> <label>Weight</label><input type="number" Name="min_weight" placeholder="Mininum"><input type="number" Name="max_weight" placeholder="Maximum"></p>
            <p><label>Steps</label><input type="number" Name="min_step" placeholder="Mininum"><input type="number" Name="max_step" placeholder="Maximum"></p>
            <p><label>Distance</label><input type="number" Name="min_distance" placeholder="Mininum"><input type="number" Name="max_distance" placeholder="Maximum"></p>
            <p><label>Date</label><input type="date" Name="min_date" placeholder="From"><input type="date" Name="max_date" placeholder="To"></p>
            <input type="submit" value="Generate" class="button-primary"><input type="reset" value="Clear">
          </form>
        </div>
    </div>
  </body>
</html>