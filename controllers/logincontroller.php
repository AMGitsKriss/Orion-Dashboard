<?php

	include_once("controllers/commoncontroller.php");
	
	$signin_error = "";
	# A Signed in user shouldn't be able to see this..
	if($loggedIn) {
		header("Location: $host");
	}

	# Check for a post request.
	if(isset($_POST['signin-form'])){
		# If accurate, sign in.
		$status = $loginCheck->loginCheck($_POST['username'], $_POST['password']);
		if($status){
			$loginCheck->setCookie($loginCheck->getUser($_POST['username'])->username);

			# Back to top
			# TODO - This might need refining for people who aren't 
			if($_GET['page'] == "login") 
				header("Location: $host");
		}
		elseif($status == false){
			$signin_error = "<p class=error>You account is pending.</p>";
		}
		# Else load the page with an error. 
		else{
			$signin_error = "<p class=error>Invalid username or password.</p>";
		}
	}

	require_once("views/loginview.php");
?>