<?php

	include_once("controllers/commoncontroller.php");

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
		$result["struct"] = "table";
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
			$result = [["<div style='text-align:center; width:100%;'>Nobody's Online :(</div>",""]];
		}
		return $result;
	}

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

	$viewData->sidebar[0] = getUserList($host);
	$viewData->sidebar[1] = file_get_contents("views/templates/cache_ts3.html"); // Grab the user cache for TS3

	// If the ts3 online-users cache file is more than a minute old, we'll regenerate it before displaying it.
	if(time() - filemtime("views/templates/cache_ts3.html") > 60){
		try{
			updateTS3Cache($ts_username, $ts_password);
		}
		// We've flooded the query system and timed it out.
		catch (Exception $e) {

		}
	}

	# Ross Window
	$viewData->content = "Error: Failed to find any Ross Quotes.";
	$query = $database->query("selectRossQuotes", $username);
	if($query->rowCount() >= 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
		$viewData->content = $row['content'];
	}

	include_once("views/sidebarview.php");
	include_once("views/homeview.php");
?>