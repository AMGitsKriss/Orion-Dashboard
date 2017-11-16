<?php

	include_once("controllers/commoncontroller.php");

	$viewData->page_title = "Active Issues:";
	$viewData->sidebar[0] = [["A thing."]];

	$row = new stdClass();
	$row->id = "AB-1264";
	$row->name = "A thing";

	$viewData->content[0] = $row;

	include_once("views/sidebarview.php");
	include_once("views/projects/projectview.php");
	
?> 