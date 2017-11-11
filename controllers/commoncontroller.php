<?php
	
	# The page's links.
	/*
	 *	where each row: [0] = Name, [1] = URL, [2] = Icon
	 */
	$links = [["Home", $host, '<i class="fa fa-home" aria-hidden="true"></i>'],
		["Minecraft Map", $host."/map", '<i class="fa fa-globe" aria-hidden="true"></i>']];

	$controls = [["", $host."/login", '<i class="fa fa-sign-in" aria-hidden="true"></i>'],
		["Repo", "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank", '<i class="fa fa-github" aria-hidden="true"></i>']];

	$mapShortcuts = $database->getByOrder("map_shortcuts");

	// TODO - This is a bodge for the time being.
	if(isset($_COOKIE["orion_user_session"])) {
		$controls[0] = ["", $host."/logout", '<i class="fa fa-sign-out" aria-hidden="true"></i>'];
		$controls[1] = ["", $host."/account", '<i class="fa fa-user-circle-o" aria-hidden="true"></i>'];
		$controls[2] = ["Repo", "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank", '<i class="fa fa-github" aria-hidden="true"></i>'];

		$links[3] = ["Projects", "$host/projects", '<i class="fa fa-list-ul" aria-hidden="true"></i>'];
		$links[2] = ["My Links", "$host/links", '<i class="fa fa-bookmark" aria-hidden="true"></i>'];
	}

	require_once("views/header.php");
?>