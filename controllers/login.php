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
		require("models/KConnect.class.php");
		require("models/KUserManager.class.php");
		# Load database
		$database = new KConnect("localhost", $db_name , $db_user, $db_pass);
		# Get user from the database
		$loginCheck = new KUserManager($database, $_POST['username'], $_POST['password']);
		# If accurate, sign in.
		if($loginCheck->loginCheck()){
			setcookie("orion_user_session", $_POST['username'], time() + (86400 * 30), "/"); // 86400 = 1 day
			# Kill the connection
			$database = null;
			# Back to top
			if($_GET['page'] == "login") 
				header("Location: $host");
		}
		# Else load the page with an error. 
		else{
			$signin_error = "<p class=error>Invalid username or password.</p>";
			# Kill the connection
			$database = null;
		}
	}
	if(!isset($_COOKIE["orion_user_session"])){
		$output.="<div class='signin-form'>
		<form method=post action=''>
		<p><input type=text name='username' placeholder='Username' /></p>
		<p><input type=password name='password' placeholder='&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;' /></p>
		<p><input type=submit name='signin-form' value='Sign In'/></p>
		$signin_error
		</form>
		</div>";
	}
?>