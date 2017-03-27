<?php

	# View stuff goes in here

	$output .= file_get_contents("views/templates/cache_ts3.html");

	# Iterate over ChannelList to get the list of channels.
	# Iterate over ClientList to get clients and their occupied channels.
	# Merge the things together.

?>