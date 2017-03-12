<?php

	require("config.php");
	include_once("views/header.php");

	$output .= "<section>";

	# Check for _POST requests

	#Page navigator
	$page = "";
	if(isset($_GET['page'])) $page = $_GET['page'];
	switch ($page){
		case "login":
			include_once("controllers/login.php");
			break;

		default:
			include_once("controllers/home.php");
			break;
	}

 
	$output .= "</section></body></html>";

	//print_r($Query->GetInfo());

	echo $output;
?> 