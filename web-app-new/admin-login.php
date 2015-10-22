<?php

// Include connect and admin_login file.

// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/connect.php');
// include($_SERVER['DOCUMENT_ROOT'].'/Beta/web-app-new/php/function/admin_login.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/connect.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/admin_login.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO - Admin Login</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/skeleton.css">
    <link rel="stylesheet" href="./css/admin-login.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="./img/icon.png" rel="icon" type="image/png">
  </head>
  <body>
  	<div class='center-panel'>
        <h1>UQgo</h1>
        <h2>Admin Login</h2>
        <form id='login-form' method='POST' class='center'>
        <!-- Display login error message from admin_login file when login error -->
            <?php 
            if($num_data==0)
              {
                ?><p id="incorrect-message"><?php echo $error_msg ?></p><?php
              }
            ?>
          <input type='text' id='username' name='username' placeholder='Username' required>
          <input type='password' id='password' name='password' placeholder='Password' required>
          <input type='submit' id='login' name='login' value='Login' class='button-primary'>
        </form>
    </div>
    <div class="footer">
      <p class="footer-info"><?php include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/page-elements/footer-text.php');?></p>
      <nav>
        <a href="index.php">Back to login</a>
      </nav>
    </div>
  </body>
</html>