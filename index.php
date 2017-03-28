<?php

	require("config.php");

	# database connection GO!
	require("models/KConnect.class.php");
	$database = new KConnect("localhost", $db_name , $db_user, $db_pass);

	// User manager class
	require("models/KUserManager.class.php");
	$loginCheck = new KUserManager($database);

	# Is a user logged in?
	$loggedIn = false;
	$username = null;
	if(isset($_COOKIE["orion_user_session"]) && $loginCheck->checkCookie($_COOKIE["orion_user_session"])) {
		$loggedIn = true;
		$username = $loginCheck->getUsernameFromCookie($_COOKIE['orion_user_session']);
		// Just to be sure we've got the case-correct username...
		$username = $loginCheck->getUser($username)->username;
	}

	## 
	#	The Main logic block. 
	#	Determine if we're handling a shortened url or a page. If neither, it must be a URL for the aggregator.
	##

	# Handling link codes.
	if(isset($_GET['link'])) include_once("controllers/shorturl.php");

	# Page navigator
	$page = "";
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}

	# Aggregator
	if($_SERVER['QUERY_STRING'] != "" && !isset($_GET['link']) && !isset($_GET['page'])){
		$page = "links";
		// Note: This will take ANY server query, so it has to go after every other query.
	}

	switch ($page){
		case "account":
			# If logged in, go to account. Else, skip to login page.
			if($loggedIn){
				$site_title .= ": Account";
				include_once("controllers/account.php");
				break;
			}
		case "links":
			# If logged in, go to account. Else, skip to login page.
			if($loggedIn){
				$site_title .= ": Links";
				include_once("controllers/mylinks.php");
				break;
			}
		case "login":
			$site_title .= ": Sign In";
			include_once("controllers/login.php");
			break;
		case "register":
			$site_title .= ": Register";
			include_once("controllers/register.php");
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