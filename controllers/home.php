<?php
	# $output .= "<ul><li><a href='/map'>Minecraft Server Map</a></li><li><a href='/swn'>Stars Without Number Wiki</a></li>\n<li><a href='http://www.d20pfsrd.com/'>Pathfinder Rules (Wiki)</a></li>\n</ul>\n<p>";
	use xPaw\MinecraftQuery;
	use xPaw\MinecraftQueryException;
	
	function getUserList($host){
		
		require('models/MinecraftQuery.class.php');
		require('models/MinecraftQueryException.class.php');

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
				# Check if we have the thumbnail cached. If not, get it.
				if(!file_exists("images/avatars/mc/$Player.png")){
					file_put_contents("images/avatars/mc/$Player.png", file_get_contents("$host/models/MinecraftFace.php?u=$Player&s=30"));
				}
				array_push($result, [htmlspecialchars( $Player ), "images/avatars/mc/$Player.png"]);
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

	include_once("views/header.php");
	$output .= "<section>";

	# Ross Quotes
	$ross = file("ross_quotes.txt");

	## Sidebar
	# Online Micnraft players
	$online_players = getUserList($host);

	# Teamspeak people online...
	require_once("libraries/TeamSpeak3/TeamSpeak3.php");
	# Connect to the server as admin
	$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$ts_username:$ts_password@192.168.0.23:10011/?server_port=9987");
	// query clientlist from virtual server
	$arr_ClientList = $ts3_VirtualServer->clientList();
	$arr_ChannelList = $ts3_VirtualServer->channelList();

	include_once("views/sidebar.php");

	#Adsense
	$output .= "<div id='mainsection'><div class=container>".file_get_contents("views/templates/adsense_leaderboard.html")."</div>";

	$output .= "<div class=container><img src='images/0f00e3e818b461fb559a78f48ccbe285.gif'/>
	<p>".$ross[mt_rand(0, count($ross) - 1)]."</p></div>";

	#Bulk of page
	$output .= "\n</div>";
?>