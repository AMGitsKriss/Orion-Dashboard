<?php

	include_once("views/header.php");
	$output .= "<section>";

	$output .= "<h2>Aggregator</h2>";

	$sql = null;

	//Logged in as... 
	#include("views/heading.php");

	//Parsing the webpage
	require("models/KHTMLParser.class.php");
	$parser = new KHTMLParser();

	//loading the lists, depending on user elevation
	$result=$database->query("selectList", $_COOKIE["orion_user_session"]);

	include("views/mylinks.php");
	
?> 