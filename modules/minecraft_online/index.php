<?php
	
	# Online Micnraft players
	$online_players = getUserList($host);

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
				if(!file_exists("module/minecraft_online/cache/$Player.png")){
					file_put_contents("module/minecraft_online/cache/$Player.png", file_get_contents("$host/mmodules/minecraft_online/models/MinecraftFace.php?u=$Player&s=30"));
				}
				array_push($result, [htmlspecialchars( $Player ), "module/minecraft_online/cache/$Player.png"]);
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
?>