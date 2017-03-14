<?php

	include_once("views/header.php");
	$output .= "<section>";

	$signin_error = "";

	/* TODO
	# A Signed in user shouldn't be able to see this..
	if(isset($_COOKIE["orion_user_session"])) {
		header("Location: $host");
	}
	*/

	# Check for a post request.
	if(isset($_POST['signin-form'])){
		require("models/KUserManager.class.php");
		# Get user from the database
		$loginCheck = new KUserManager($database);
		# If accurate, sign in.
		if($loginCheck->loginCheck($_POST['username'], $_POST['password'])){
			setcookie("orion_user_session", $_POST['username'], time() + (86400 * 30), "/"); // 86400 = 1 day

			# Back to top
			# TODO - This might need refining for people who aren't 
			if($_GET['page'] == "login") 
				header("Location: $host");
		}
		# Else load the page with an error. 
		else{
			$signin_error = "<p class=error>Invalid username or password.</p>";
		}
	}
	require_once("views/login.php");
?>