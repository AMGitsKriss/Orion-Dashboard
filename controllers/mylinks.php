<?php

	include_once("views/header.php");
	$output .= "<script type='text/javascript' src='scripts/functions.js'></script>\n";
	$output .= "<section>";

	$output .= "<h2>Aggregator</h2>";

	//Parsing the webpage
	require("models/KHTMLParser.class.php");
	$parser = new KHTMLParser();
	$postLinkMsg = "";

	if(isset($_POST['delete_entry'])){
		//TODO - Delete that entry.
		$database->query("deletePost",$_POST['delete_entry'], $_COOKIE['orion_user_session']);
		$postLinkMsg = "<p>Link successfully deleted.</p>";
	}

	# If we're here with the query sting, and not another page, and the parser triggers successfully.
	if($_SERVER['QUERY_STRING'] != "" && !isset($_GET['link']) && !isset($_GET['page']) && $parser->handle($_SERVER['QUERY_STRING'], $database)){
		header("Location: $host/links");
	}

	else if(isset($_POST['newlink']) && $parser->handle($_POST['url'], $database)){
		header("Location: $host/links");
	}
	else if($page != "links") {
		$postLinkMsg = "<p>Error: Something went wrong adding that entry.</p>";
	}

	//loading the lists, depending on user elevation
	$result=$database->query("selectList", $_COOKIE["orion_user_session"]);

	include("views/mylinks.php");
	
?> 