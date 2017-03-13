<?php

	include_once("views/header.php");
	$output .= "<section>";

	# Grab the database and user handler classes.
	require("models/KUserManager.class.php");

	# Start the user manager!
	$userCheck = new KUserManager($database, $_COOKIE["orion_user_session"]);

	# The user is updating their map co-ordinates
	if(isset($_POST['update_map_shortcut'])){
		# There was a fancy statement for this...
		# Statement takes 8 variables for 4 args. This is the easiest way of doing it...
		$database->query("updateMapShortcut", $_COOKIE["orion_user_session"], $_POST['x_pos'], $_POST['z_pos'], $_POST['zoom'], $_COOKIE["orion_user_session"], $_POST['x_pos'], $_POST['z_pos'], $_POST['zoom']);
		$output .= "<p>Your Overviewer co-ordinates were updated.</p>";
	}

	$userData = $userCheck->getUser($_COOKIE["orion_user_session"]);

	$userMapShortcut = $database->query("selectMapShortcut", $_COOKIE["orion_user_session"])->fetch(PDO::FETCH_ASSOC);

	include_once("views/account.php");

?>