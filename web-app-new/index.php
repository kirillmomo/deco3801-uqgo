<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UQGO</title>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/skeleton.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  </head>
  <body>
  	<div class='center-panel'>
        <h1>UQgo</h1>
        <form id='login-form' method='POST' class='center'>
            <p id="incorrect-message">Incorrect username or password.</p>
          <input type='text' id='username' name='username' placeholder='Username' required>
          <input type='password' id='password' name='password' placeholder='Password' required>
          <input type='submit' id='login' name='login' value='Login' class='button-primary'>
        </form>
    </div>
    <div class="new-user">
        <h2>New User?</h2>
        <p>Register using the UQGO app.</p>
    </div>
    <div class="login-options">
        <p><a href="admin-login.php">Are you an admin?</a></p>
    </div>
    <div class="footer-info">
        <p>UQ Wellness | Developed by Silversquad.</p>
    </div>
  </body>
</html>