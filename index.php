<?php

	require("config.php");

	# Is a user logged in?
	if(isset($_COOKIE["orion_user_session"])) {
		setcookie("orion_user_session", $_COOKIE["orion_user_session"], time() + (86400 * 30), "/"); // 86400 = 1 day
		echo "Signed in!";
	}

	#Page navigator
	$page = "";
	if(isset($_GET['page'])) $page = $_GET['page'];
	switch ($page){
		case "login":
			$site_title .= ": Sign In";
			include_once("controllers/login.php");
			break;

		default:
			$site_title .= ": Dashboard";
			include_once("controllers/home.php");
			break;
	}

 
	$output .= "</section></body></html>";

	//print_r($Query->GetInfo());

	echo $output;
?> 