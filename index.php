<?php

	require("config.php");
	include_once("views/header.php");

	$output .= "<section>";

	if(!isset($_GET['page']))
		include_once("controllers/home.php");
	elseif($_GET['page']=="map")
		include_once("controllers/map.php");
 
	$output .= "</section></body></html>";

	//print_r($Query->GetInfo());

	echo $output;
?> 