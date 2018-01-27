<div class='signin-form'>
	<form method=post action=''>
	<p><input type=text name='username' placeholder='Username' /></p>
	<p><input type=password name='password' placeholder='&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;' /></p>
	<p><input type=submit name='signin-form' value='Sign In'/></p>
	<p><a href='<?php echo $host ?>/register'><input type=button name='register-form' value='Register'/></a></p>
	<?php echo $signin_error ?>
	</form>
</div>