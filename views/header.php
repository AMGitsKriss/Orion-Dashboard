<?php

	# The page's links.
	/*
	 *	where each row: [0] = Name, [1] = URL, [2] = Icon
	 */
	$links = [["Home", $host, '<i class="fa fa-home" aria-hidden="true"></i>'],
		["Minecraft Map", $host."/map", '<i class="fa fa-globe" aria-hidden="true"></i>'],
		["Pathfinder", "http://www.d20pfsrd.com/' target='_blank", '<i class="fa fa-bookmark" aria-hidden="true"></i>']];
	$controls = [["", $host."/login", '<i class="fa fa-sign-in" aria-hidden="true"></i>'],
		["Repo", "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank", '<i class="fa fa-github" aria-hidden="true"></i>']];

	$mapShortcuts = $database->getByOrder("map_shortcuts");

	// TODO - This is a bodge for the time being.
	if(isset($_COOKIE["orion_user_session"])) {
		$controls[0] = ["", $host."/logout", '<i class="fa fa-sign-out" aria-hidden="true"></i>'];
		$controls[1] = ["", $host."/account", '<i class="fa fa-user-circle-o" aria-hidden="true"></i>'];
		$controls[2] = ["Repo", "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank", '<i class="fa fa-github" aria-hidden="true"></i>'];

		$links[3] = $links[2];
		$links[2] = ["My Links", "$host/links", '<i class="fa fa-bookmark" aria-hidden="true"></i>'];
	}

	# HTML Header
	$output = "<!DOCTYPE html>\n<html>\n<head>\n<title>$site_title</title>\n
	<meta property='og:image' content='http://qvvz.uk/images/0f00e3e818b461fb559a78f48ccbe285.gif' />
	<script src='https://use.fontawesome.com/15e142434c.js'></script>
	<link rel='stylesheet' type='text/css' href='css/default.css'>\n</head><body>";
	
	# Navbar
	$output .= "<header>";
	# Links (Left)
	foreach ($links as $row){
		# Spit out links
		# If this link is the map, print the shortcuts dropdown.
		if($row[0] == "Minecraft Map"){
			$output .= "\n<span class='dropdown'><a href='$row[1]'>$row[2] $row[0]</a><ul class='dropdown-content'>"; 
			foreach ($mapShortcuts as $point){
				$output .= "<li><a href='$host/map/#/$point[x_pos]/64/$point[z_pos]/$point[zoom]/0/0'>$point[name]</a></li>"; # <i class="fa fa-map-marker" aria-hidden="true"></i>
			}
			$output .= "</ul>";
			$output .= "</span>";
		}
		
		else{
			$output .= "\n<a href='$row[1]'>$row[2] $row[0]</a>";
		}
	}
	# Options (Right)
	foreach ($controls as $row){
		$output .= "<a class='options' href='$row[1]'>$row[2] $row[0]</a>";
	}
	$output .= "</header>";
?>