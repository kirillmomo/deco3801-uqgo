<?php
	session_start();
	session_destroy();
	header('Location: /v0-1/admin-login.php');
	// header('Location: /Beta/web-app-new/admin-login.php');
?>