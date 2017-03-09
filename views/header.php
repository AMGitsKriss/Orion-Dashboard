<?php

	# The page's links.
	$links = ["Home"=>$host, "Minecraft Map"=>$host."/map"];

	# HTML Header
	$output = "<!DOCTYPE html>\n<html'>\n<head>\n<title>Welcome to Orion</title>\n
	<link rel='stylesheet' type='text/css' href='css/default.css'>\n</head><body>";

	#<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto'>
	
	# Navbar
	$output .= "<header>";
	foreach ($links as $key => $value){
		$output .= "<a href='".$value."'><img src='images/home.png' /> ".$key."</a>";
	}
	$output .= "</header>";
?>