<?php

	# Updating cookie with a date that's passed. It should expire.
	setcookie("orion_user_session", $_COOKIE["orion_user_session"], time() - 86400, "/"); // 86400 = 1 day

	# Then go back to the root URL.
	header("Location: $host");
?>