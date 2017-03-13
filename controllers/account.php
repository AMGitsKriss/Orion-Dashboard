<?php

	include_once("views/header.php");
	$output .= "<section>";

	# Grab the database and user handler classes.
	require("models/KConnect.class.php");
	require("models/KUserManager.class.php");

	# Start those things up!
	$database = new KConnect("localhost", $db_name , $db_user, $db_pass);
	$userCheck = new KUserManager($database, $_COOKIE["orion_user_session"]);

	# The user is updating their map co-ordinates
	if(isset($_POST['update_map_shortcut'])){
		# There was a fancy statement for this...
		# Statement takes 8 variables for 4 args. This is the easiest way of doing it...
		$database->query("updateMapShortcut", $_COOKIE["orion_user_session"], $_POST['x_pos'], $_POST['z_pos'], $_POST['zoom'], $_COOKIE["orion_user_session"], $_POST['x_pos'], $_POST['z_pos'], $_POST['zoom']);
		$output .= "<p>Your Overviewer co-ordinates were updated.</p>";
	}

	$userData = $userCheck->getUser($_COOKIE["orion_user_session"]);

	if($userData){
		$output .= "<p>$userData->username</p>";
		$output .= "<p>$userData->email</p>";
		$output .= "<p>$userData->mc_username</p>";
		$output .= "<p>$userData->mc_avatar</p>";
	}
	else{
		$output .= "<p class=error>Something weent wrong getting your account details.</p>";
	}

	$userMapShortcut = $database->query("selectMapShortcut", $_COOKIE["orion_user_session"])->fetch(PDO::FETCH_ASSOC);

	# Build the position update form. 
	# TODO this needs to have the existing choice selected!
	if($userMapShortcut){ # $userMapShortcut[zoom]
		$output .= "<form method=post><p>$userMapShortcut[name]'s home co-ordinates: 
		<label>X: </label><input type=number name=x_pos min=-4000 max=4000 size=5 value=$userMapShortcut[x_pos] /> 
		<label>Z: </label><input type=number name=z_pos min=-4000 max=4000 size=5 value=$userMapShortcut[z_pos] />
		<label>Zoom: </label><select name=zoom  />
		<option value=max>Max</option>
		<option value=-1>-1</option>
		<option value=-2>-2</option>
		<option value=-3>-3</option>
		<option value=-4>-4</option>
		<option value=-5>-5</option>
		</select>
		<input type=submit name=update_map_shortcut value='Go' /> 
		</p></form>";

	}
	else{
		$output .= "<p class=error>Something weent wrong getting your map shortcut.</p>";
	}

?>