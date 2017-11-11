<?php

	include_once("views/header.php");
	$output .= "<section>";

	$viewData = new stdClass();
	$viewData->site_title = "Projects Home : ".$site_title;
	$viewData->page_title = "Active Issues:";
	$viewData->sidebar = ["A thing."];
	$viewData->content = ["There's nothing here... Yet."];

	include("views/projects/projectview.php");
	
?> 