<?php

	include_once("controllers/commoncontroller.php");
	
	

	$viewData->page_title = "Active Issues:";


	require("models/IssuesRepo.class.php");
	$issuesRepo = new IssuesRepo("localhost", $db_name , $db_user, $db_pass);
	$viewData->content = $issuesRepo->getIssues($username);
	$viewData->sidebar[0] = Array();
	$viewData->sidebarStruct[0] = "menu";

	$statement = $issuesRepo->query("getMenu", "projectsmenu");
	// Populate the sidebar
	while($value = $statement->fetch(PDO::FETCH_ASSOC)){
		$tmp = [$value["name"], $host.$value["url"]];
		array_push($viewData->sidebar[0], $tmp);
	}
	
	include_once("controllers/sidebarcontroller.php");
	include_once("views/projects/projectview.php");
	
?> 