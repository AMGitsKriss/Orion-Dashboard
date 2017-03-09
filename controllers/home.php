<?php
	include_once("views/header.php");

	$output .= "<div class=container>".file_get_contents("../adsense_leaderboard.html")."</div>";

	# $output .= "<ul><li><a href='/map'>Minecraft Server Map</a></li><li><a href='/swn'>Stars Without Number Wiki</a></li>\n<li><a href='http://www.d20pfsrd.com/'>Pathfinder Rules (Wiki)</a></li>\n</ul>\n<p>";

	include_once("views/players.php");
?>