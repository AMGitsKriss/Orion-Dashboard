<?php

	include_once("controllers/commoncontroller.php");
	
	$signin_error = "";

	if($loggedIn){
		header("Location: $host");
	}
	# Check for a post request.
	if(isset($_POST['register-form'])){
		$signin_error = "<p class=error>Yeah... That doesn't work yet.</p>";

		# If there's invalid cahracters in the username...
		if(preg_match('/[^A-Za-z0-9]/', $_POST['username'])){
			$signin_error = "<p class=error>Forbidden characters in Username.</p>";
		}
		# If the password's match...
		else if($_POST["password1"] === $_POST['password2']){
			$status = $loginCheck->makeUser($_POST['username'], $_POST['email'], $_POST['password1']);
			if(gettype($status) == "string"){
				# Print the error
				$signin_error = "<p class=error>$status</p>";
			}
			else{
				# Otherwise all is good.
				$output.= "<script>alert(\"Thanks. We'll let you know when your account's been authorised.\");</script>";
				$signin_error = "<p class=error>Thanks. We'll let you know when your account's been authorised.</p>";
			}
		}
		else {
			$signin_error = "<p class=error>Those passwords didn't match.</p>";
		}
	}

	include_once("views/registerview.php");
?>