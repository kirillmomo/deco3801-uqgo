<?php 

//Start session 
session_start();

// If session is empty, return to admin login page
if(empty($_SESSION['admin_id'])){
    header('Location: /v0-5/admin-login.php');
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
              <tr>
                <td>Nigel Thornberry</td>
                <td>43</td>
                <td>Male</td>
                <td>180cm</td>
                <td>80kg</td>
                <td>8273</td>
                <td>82km</td>
                <td>1029kcal</td>
              </tr>
              <tr>
                <td>Arnold Schnitzel</td>
                <td>65</td>
                <td>Male</td>
                <td>188cm</td>
                <td>100kg</td>
                <td>12</td>
                <td>0.2km</td>
                <td>5kcal</td>
              </tr>
              <tr>
                <td>Nigel Thornberry</td>
                <td>43</td>
                <td>Male</td>
                <td>180cm</td>
                <td>80kg</td>
                <td>8273</td>
                <td>82km</td>
                <td>1029kcal</td>
              </tr>
              <tr>
                <td>Arnold Schnitzel</td>
                <td>65</td>
                <td>Male</td>
                <td>188cm</td>
                <td>100kg</td>
                <td>12</td>
                <td>0.2km</td>
                <td>5kcal</td>
              </tr>
              <tr>
                <td>Nigel Thornberry</td>
                <td>43</td>
                <td>Male</td>
                <td>180cm</td>
                <td>80kg</td>
                <td>8273</td>
                <td>82km</td>
                <td>1029kcal</td>
              </tr>
              <tr>
                <td>Arnold Schnitzel</td>
                <td>65</td>
                <td>Male</td>
                <td>188cm</td>
                <td>100kg</td>
                <td>12</td>
                <td>0.2km</td>
                <td>5kcal</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </body>
</html>