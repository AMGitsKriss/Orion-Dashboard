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


	// If the ts3 online-users cache file is more than a minute old, we'll regenerate it before displaying it.
	if(time() - filemtime("views/templates/cache_ts3.html") > 60){
		try{
			updateTS3Cache($ts_username, $ts_password);
		}
		// We've flooded the query system and timed it out.
		catch (TeamSpeak3_Adapter_ServerQuery_Exception $e) {

		}
	}

	include_once("views/sidebar.php");

	#Adsense
	$output .= "<div id='mainsection'><div class=container>".file_get_contents("views/templates/adsense_leaderboard.html")."</div>";

	$output .= "<div class=container><img src='images/0f00e3e818b461fb559a78f48ccbe285.gif'/>
	<p>".$ross[mt_rand(0, count($ross) - 1)]."</p></div>";

	#Bulk of page
	$output .= "\n</div>";

	function updateTS3Cache($ts_username, $ts_password){
		# Teamspeak people online...
		require_once("libraries/TeamSpeak3/TeamSpeak3.php");
		# Connect to the server as admin
		$ts3_VirtualServer = TeamSpeak3::factory("serverquery://$ts_username:$ts_password@192.168.0.23:10011/?server_port=9987");
	
		//Cache file location
		$ts3_cache_dir = "views/templates/cache_ts3.html";

		//Open the file for writing.
		$cache_file = fopen($ts3_cache_dir, "w");

		//Declare table
		fwrite($cache_file, "<table class=players-table table-bordered table-striped>\n<thead>\n<tr>\n<th title='&plusmn;1 min'>Teamspeak</th>\n</tr>\n</thead>\n<tbody>\n");

		// query channelist from virtual server
		foreach($ts3_VirtualServer->channelList() as $ts3_Channel){
			//Iterate over the list and get the users in each room
			$room = $ts3_VirtualServer->channelGetByName("$ts3_Channel");
			fwrite($cache_file, "<tr>\n<td>$room</td>\n</tr>\n");
			foreach($room as $user){
				$userString = "".$user;
				if(!(strpos($userString, 'serveradmin') !== false)){
					fwrite($cache_file, "<tr>\n<td>&nbsp;-&nbsp;&nbsp;$userString</td>\n</tr>\n");
				}
			}
		}
		// Close table
		fwrite($cache_file, "</tbody>\n</table>");	
	}
?>