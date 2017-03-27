<?php

	include_once("views/header.php");
	$output .= "<section>";

	$output .= "<h2>Aggregator</h2>";


	$postLinkMsg = "";
	if(isset($_POST['newlink'])){
		$postLinkMsg = "<p>POST REQUEST SUCCESSFUL</p>";
	}

	//Parsing the webpage
	require("models/KHTMLParser.class.php");
	$parser = new KHTMLParser();

	//loading the lists, depending on user elevation
	$result=$database->query("selectList", $_COOKIE["orion_user_session"]);

	include("views/mylinks.php");
	
?> 