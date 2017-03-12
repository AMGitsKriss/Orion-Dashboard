<?php

	include_once("views/header.php");
	$output .= "<section>";

	$signin_error = "";

	# Check for a post request.
	if(isset($_POST['signin-form'])){
		# Hash the password
		# Load database
		# Get things from the database
		# If accurate, sign in.
		# Else load the page with an error. 
		$signin_error = "<p class=error>That's not implemented yet...</p>";
	}

	$output.="<div class='signin-form'>
	<form method=post action=''>
	<p><input type=text name='username' placeholder='Username' /></p>
	<p><input type=password name='password' placeholder='&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;' /></p>
	<p><input type=submit name='signin-form' value='Sign In'/></p>
	$signin_error
	</form>
	</div>";
?>