<?php

	require("config.php");

	# Check for _POST requests

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