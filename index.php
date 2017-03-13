<?php

	require("config.php");

	# Is a user logged in?
	if(isset($_COOKIE["orion_user_session"])) {
		setcookie("orion_user_session", $_COOKIE["orion_user_session"], time() + (86400 * 30), "/"); // 86400 = 1 day
	}

	#Page navigator
	$page = "";
	if(isset($_GET['page'])) $page = $_GET['page'];
	switch ($page){
		case "account":
			# If logged in, go to account. Else, skip to login page.
			if(isset($_COOKIE["orion_user_session"])){
				$site_title .= ": Account";
				include_once("controllers/account.php");
				break;
			}
		case "login":
			$site_title .= ": Sign In";
			include_once("controllers/login.php");
			break;
		case "logout":
			# Destroy the user session.
			$site_title .= ": Sign Out";
			include_once("controllers/logout.php");
			break;
		default:
			$site_title .= ": Dashboard";
			include_once("controllers/home.php");
			break;
	}

 
	$output .= "</section></body></html>";

	echo $output;
?> 