<?php

	$viewData = new stdClass();
	$viewData->site_title = $site_title;
	$viewData->page_title = "Active Issues:";
	$viewData->sidebar[0] = [["A thing."]];
	$viewData->content = ["There's nothing here... Yet."];

	include_once("controllers/commoncontroller.php");
	include_once("views/sidebarview.php");
	include_once("views/projects/projectview.php");
	
?> 