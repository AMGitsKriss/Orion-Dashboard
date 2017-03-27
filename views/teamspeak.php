<?php

	# View stuff goes in here

	$output .= "<table class=players-table table-bordered table-striped>\n<thead>\n<tr>\n<th>Players</th>\n</tr>\n</thead>\n<tbody>\n";

	foreach($arr_ChannelList as $ts3_Channel){
		$room = $ts3_VirtualServer->channelGetByName("$ts3_Channel");
		$output .= "<tr>\n<td>$room</td>\n</tr>\n";
		foreach($room as $user){
			$userString = "".$user;
			if(!(strpos($userString, 'serveradmin') !== false)){
				$output .= "<tr>\n<td>&nbsp;-&nbsp;&nbsp;$userString</td>\n</tr>\n";
			}
		}
	}

	$output .= "</tbody>\n</table>";	
	# Iterate over ChannelList to get the list of channels.
	# Iterate over ClientList to get clients and their occupied channels.
	# Merge the things together.

?>