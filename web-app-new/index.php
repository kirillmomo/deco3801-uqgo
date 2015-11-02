<?php

// Include connect and login file.

include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/connect.php');
include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/function/login.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO</title>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/skeleton.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./resources/font-awesome-4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="./img/icon.png" rel="icon" type="image/png">
  </head>
  <body>
    <div class='center-panel'>
        <h1>UQgo</h1>
        <form id='login-form' method='POST' class='center'>
         <!-- Display login error message from user login file when login error -->
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
    <div class="new-user">
        <h2>New User?</h2>
        <p>Register using the UQGO app.</p>
    </div>
    <div class="footer">
      <p class="footer-info"><?php include($_SERVER['DOCUMENT_ROOT'].'/v0-6/php/page-elements/footer-text.php');?></p>
      <nav>
        <a href="help.php"><i class="fa fa-question-circle fa-fw"></i> Help</a>
        <a href="admin-login.php"><i class="fa fa-user fa-fw"></i> Admin Login</a>
      </nav>
    </div>
  </body>
</html>