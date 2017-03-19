<?php
	$output .= "<div class=container id=links>";
	// output data of each row
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		$added = $row['added'];
		$linkName = stripslashes($row["name"]);
		//Only echo out the control options on entries that are the user's. I.E. Not public.
		//If logged in and entry owner is the user, OR the user is level 2 or higher...
		$output .= "<div class=link-container>
		<div class=link-date>$added</div>
		<div class=link-hash><a href='$host/$row[hash]'>$row[hash]</a></div>
		<div class=link-name>$linkName</div>
		<div class=link-link><a href='$row[url]' target='_blank'>$row[url]</a></div>
		<div class=link-controls>[&#9881;]<a href='#' onclick='deleteEntry(\"delete_entry\", $row[id] )'>[&#10060;]</a></div>
		</div>\n";
	}
	$output .= "</div>";
?>