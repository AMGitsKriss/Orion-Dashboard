<?php

	# The page's links.
	/*
	 *	where each row: [0] = Name, [1] = URL, [2] = Icon
	 */
	$host = "http://qvvz.uk";
	$links = [["Home", $host, '<i class="fa fa-home" aria-hidden="true"></i>'],
		["Minecraft Map", $host."/map", '<i class="fa fa-globe" aria-hidden="true"></i>'],
		["Pathfinder Wiki", "http://www.d20pfsrd.com/' target='_blank", '<i class="fa fa-bookmark" aria-hidden="true"></i>']];
	$controls = [["", "#", '<i class="fa fa-sign-in" aria-hidden="true"></i>'],
		["Repo", "https://github.com/AMGitsKriss/Orion-Dashboard' target='_blank", '<i class="fa fa-github" aria-hidden="true"></i>']];

	# HTML Header
	$output = "<!DOCTYPE html>\n<html>\n<head>\n<title>$site_title</title>\n
	<meta property='og:image' content='http://qvvz.uk/images/0f00e3e818b461fb559a78f48ccbe285.gif' />
	<script src='https://use.fontawesome.com/15e142434c.js'></script>
	<link rel='stylesheet' type='text/css' href='css/default.css'>\n</head><body>";
	
	# Navbar
	$output .= "<header>";
	# Links (Left)
	foreach ($links as $row){
		$output .= "<a href='$row[1]'>$row[2] $row[0]</a>";
	}
	# Options (Right)
	foreach ($controls as $row){
		$output .= "<a class='options' href='$row[1]'>$row[2] $row[0]</a>";
	}
	$output .= "</header>";

	function backgroundmanger($month ,$day ,$year){

        	# bool checkdate ( int $month , int $day , int $year )
        	# month - The month is between 1 and 12 inclusive.
        	# day - The day is within the allowed number of days for the given month. Leap years are taken into consideration.
        	# year -The year is between 1 and 32767 inclusive.
		
        	if (checkdate($month, $day, $year)) {
            	echo "<style>body {background: pink;}</style>";
        	}
    	}

    	try {
        	backgroundmanger(01, 01, 2050);
    	} catch (Exception $e) {
        	echo "Caught exception: ",  $e->getMessage(), "\n";
    	}
    
?>
