<div class='signin-form'>
	<form method=post action=''>
	<p><input type=text name='username' placeholder='Username' required /></p>
	<p><input type=email name='email' placeholder='Email' required /></p>
	<p><input type=password name='password1' placeholder='Password' required /></p>
	<p><input type=password name='password2' placeholder='Repeat Password' required /></p>
	<p><input type=submit name='register-form' value='Register' required /></p>
	<?php echo $signin_error ?>
	</form>
</div>