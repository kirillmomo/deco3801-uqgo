<?php
	session_start();
	session_destroy();
	header('Location: /v0-2/index.php');
	// header('Location: /Beta/web-app-new/index.php');
?>