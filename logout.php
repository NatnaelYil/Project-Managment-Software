<?php

	//insert code that points to the logout button

	session_start();

		//if user logged out, delete any session variables
		$_SESSION['userID'] = null;
		$_SESSION['canEdit'] = '0';

		//redirect to login page
		header('location:login.php');

?>
