<?php

	# The page's links.
	$host = "http://qvvz.uk";
	$links = ["Home"=>$host, "Minecraft Map"=>$host."/map", "Pathfinder Wiki"=>"http://www.d20pfsrd.com/' target='_blank"];

	# HTML Header
	$output = "<!DOCTYPE html>\n<html>\n<head>\n<title>Welcome to Orion</title>\n
	<meta property='og:image' content='http://qvvz.uk/images/0f00e3e818b461fb559a78f48ccbe285.gif' />
	<link rel='stylesheet' type='text/css' href='css/default.css'>\n</head><body>";

	#<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto'>
	
	# Navbar
	$output .= "<header>";
	foreach ($links as $key => $value){
		$output .= "<a href='".$value."'><img src='images/home.png' /> ".$key."</a>";
	}
	$output .= "</header>";
?>