<?php
	
	# The page's links.
	/*
	 *	where each row: [0] = Name, [1] = URL, [2] = Icon
	 */
	$links = [['<i class="fa fa-home" aria-hidden="true"></i> Home', $host],
		['<i class="fa fa-globe" aria-hidden="true"></i> Minecraft Map', $host."/map"]];

	$controls = [['<i class="fa fa-sign-in" aria-hidden="true"></i>', $host."/login"],
		['<i class="fa fa-github" aria-hidden="true"></i> Repo', "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank"]];

	$mapShortcuts = $database->getByOrder("map_shortcuts");

	// TODO - This is a bodge for the time being.
	if(isset($_COOKIE["orion_user_session"])) {
		$controls = [['<i class="fa fa-sign-out" aria-hidden="true"></i>', $host."/logout"], ['<i class="fa fa-user-circle-o" aria-hidden="true"></i>', $host."/account"], ['<i class="fa fa-github" aria-hidden="true"></i> Repo', "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank"]];

		$links[3] = ['<i class="fa fa-list-ul" aria-hidden="true"></i> Projects', "$host/projects"];
		$links[2] = ['<i class="fa fa-bookmark" aria-hidden="true"></i> My Links', "$host/links"];
	}

	require_once("views/headerview.php"); 
?>