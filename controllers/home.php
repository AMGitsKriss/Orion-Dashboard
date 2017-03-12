<?php
	# $output .= "<ul><li><a href='/map'>Minecraft Server Map</a></li><li><a href='/swn'>Stars Without Number Wiki</a></li>\n<li><a href='http://www.d20pfsrd.com/'>Pathfinder Rules (Wiki)</a></li>\n</ul>\n<p>";
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;
	
	function getUserList(){
		
		
		require('lib/MinecraftQuery.php');
		require('lib/MinecraftQueryException.php');

		$Query = new MinecraftQuery();

		try{
			$Query->Connect( "localhost", 25565, 1 );
		}
		catch( MinecraftQueryException $e ){
			$Exception = $e;
		}

		$result = Array();
		if( ( $Players = $Query->GetPlayers( ) ) !== false ){
			foreach( $Players as $Player ){
				array_push($result, [htmlspecialchars( $Player ), "lib/MinecraftFace.php?u=$Player&s=30"]);
			}
		}
		elseif(!$Query->GetInfo()){
			$result = [["<div style='color:red; font-weight:bold; text-align:center;'>SERVER OFFLINE</div>", ""]];
		}
		else{
			$result = [["<div style='text-align:center; width:100%;'>Nobody's Online ;(</div>",""]];
		}
		return $result;
	}

	# Ross Quotes
	$ross = file("ross_quotes.txt");

	# Sidebar
	$online_players = getUserList();
	include_once("views/sidebar.php");

	#Adsense
	$output .= "<div id='mainsection'><div class=container>".file_get_contents("views/templates/adsense_leaderboard.html")."</div>";

	$output .= "<div class=container><img src='images/0f00e3e818b461fb559a78f48ccbe285.gif'/>
	<p>".$ross[mt_rand(0, count($ross) - 1)]."</p></div>";

	#Bulk of page
	$output .= "\n</div>";
?>