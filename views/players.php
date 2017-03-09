<?php
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;
	
	require('lib/MinecraftQuery.php');
	require('lib/MinecraftQueryException.php');

	$Query = new MinecraftQuery();

	try{
		$Query->Connect( "localhost", 25565, 1 );
	}
	catch( MinecraftQueryException $e ){
		$Exception = $e;
	}
	
	//Players table
	$output .= "<table class=players-table table-bordered table-striped>\n<thead>\n<tr>\n<th>Players</th>\n</tr>\n</thead>\n<tbody>\n";

	if( ( $Players = $Query->GetPlayers( ) ) !== false ){
		foreach( $Players as $Player ){
			$output .= "<tr>\n<td>\n<img src='lib/MinecraftFace.php?u=$Player&s=30' />" . htmlspecialchars( $Player ) . "</td>\n</tr>\n";
		}
	}
	else{
		$output .= "<tr>\n<td>No players online.</td\n></tr>\n";
		$output .= ($Query->GetInfo()) ? "<tr>\n<td style='color:green; font-weight:bold;'>ONLINE</td\n></tr>\n" : "<tr>\n<td style='color:red; font-weight:bold;'>OFFLINE</td\n></tr>\n" ;
	}

	$output .= "</tbody>\n</table>\n</div>";	
?>