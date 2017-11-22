<?php

	include_once("controllers/commoncontroller.php");

	$viewData->page_title = "Active Issues:";
	$viewData->sidebar[0] = [["Overview", ""],
							 ["New Issue", ""],
							 ["All Issues", ""],
							 ["Configure Projects", ""]];

	require("models/IssuesRepo.class.php");
	$issuesRepo = new IssuesRepo("localhost", $db_name , $db_user, $db_pass);
	$viewData->content = $issuesRepo->getIssues($username);

	include_once("views/sidebarview.php");
	include_once("views/projects/projectview.php");
	
?> 