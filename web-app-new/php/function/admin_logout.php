<?php
	// destroy all the stored session
	session_start();
	session_destroy();
	
	// redirect to admin login page
	header('Location: /v0-5/admin-login.php');
	// header('Location: /Beta/web-app-new/admin-login.php');
?>