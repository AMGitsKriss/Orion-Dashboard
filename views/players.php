<?php
	
	//Players table
	$output .= "<table class=players-table table-bordered table-striped>\n<thead>\n<tr>\n<th>Minecraft</th>\n</tr>\n</thead>\n<tbody>\n";

	foreach( $online_players as $player ){
		$output .= "<tr>\n<td>\n<img src='$player[1]' />$player[0]</td>\n</tr>\n";
	}

	$output .= "</tbody>\n</table>";	
?>