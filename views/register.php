<?php
	if(!isset($_COOKIE["orion_user_session"])){
		$output.="<div class='signin-form'>
		<form method=post action=''>
		<p><input type=text name='username' placeholder='Username' /></p>
		<p><input type=text name='email' placeholder='Email' /></p>
		<p><input type=password name='password1' placeholder='Password' /></p>
		<p><input type=password name='password2' placeholder='Repeat Password' /></p>
		<p><input type=submit name='register-form' value='Register'/></p>
		$signin_error
		</form>
		</div>";
	}
?>