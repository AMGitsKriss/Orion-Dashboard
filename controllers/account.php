<?php

	include_once("views/header.php");
	$output .= "<section>";

	$userData = $loginCheck->getUser($username);

	# The user is updating their map co-ordinates
	if(isset($_POST['update_map_shortcut'])){
		# There was a fancy statement for this...
		# Statement takes 8 variables for 4 args. This is the easiest way of doing it...
		$database->query("updateMapShortcut", $username, $_POST['x_pos'], $_POST['z_pos'], $_POST['zoom'], $username, $_POST['x_pos'], $_POST['z_pos'], $_POST['zoom']);
		$output .= "<p>Your Overviewer co-ordinates were updated.</p>";
	}

	$userMapShortcut = $database->query("selectMapShortcut", $username)->fetch(PDO::FETCH_ASSOC);

	include_once("views/account.php");

?>