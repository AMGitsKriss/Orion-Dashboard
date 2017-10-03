<?php

	include_once("views/header.php");
	$output .= "<section>";

	$userData = $loginCheck->getUser($username);

	# The user is updating their map co-ordinates
	if(isset($_POST['update_map_shortcut'])){
		# There was a fancy statement for this...
		# Statement takes 8 variables for 4 args. This is the easiest way of doing it...

		$xPos = $_POST['x_pos'];
		$zPos = $_POST['z_pos'];
		$zoom = $_POST['zoom'];

		//Verify that these values fit the world contstraints. It's a hack, but if it's outside the range, we'll just set it to 0.
		$xPos = ($xPos > 4000 || $xPos < -4000) ? $xPos : 0;
		$zPos = ($zPos > 4000 || $zPos < -4000) ? $zPos : 0;
		$zoom = ($zoom < -5 || $zoom > -1) ? $zPos : -3;

		$database->query("updateMapShortcut", $username, $xPos, $zPos, $zoom, $username, $xPos, $zPos, $zoom);
		$output .= "<p>Your Overviewer co-ordinates were updated.</p>";
	}

	$userMapShortcut = $database->query("selectMapShortcut", $username)->fetch(PDO::FETCH_ASSOC);

	include_once("views/account.php");

?>