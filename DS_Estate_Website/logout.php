<?php 

	session_start();

	$_SESSION = array();

	// Delete session
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-86400, '/');
	}

	session_destroy();

	// Redirect the user to the login page
	header('Location: login.php?action=logout');

 ?>