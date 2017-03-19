<?php

	$result = $database->query("selectURLHash", $_GET['link']);
	$url = $result->fetch(PDO::FETCH_ASSOC)['url'];
	header("Location: $url");
	echo "DERP! $url";

?>