<?php
	session_start();
	$_SESSION['name'] = "gaurav";
	$_SESSION['regno'] = "134";
	print_r($_SESSION);
	session_destroy();
?>