<?php
	$output .= "<div class=container>";
	$output .= "<p> To add an entry, either prefix the url with 'qvvz.uk/?' (e.g. qvvz.uk/?google.com) or use the following field: </p>";
	$output .= "<form action='' method='post'>\n<label>URL:</label>\n<input id='name' name='url' size=50 type='text'>\n<input name='newlink' type='submit' value=' Add '>\n</form>\n";
	$output .= $postLinkMsg;
	$output .= "</div>\n<div class=container id=links>";
	// output data of each row
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		$added = $row['added'];
		$linkName = stripslashes($row["name"]);
		//Only echo out the control options on entries that are the user's. I.E. Not public.
		//If logged in and entry owner is the user, OR the user is level 2 or higher...
		$output .= "<div class=link-container>
		<div class=link-date><i class='fa fa-calendar' aria-hidden=true title='$added'></i></div>
		<div class=link-hash><a href='$host/$row[hash]'>$row[hash]</a></div>
		<div class=link-name>$linkName</div>
		<div class=link-link><a href='$row[url]' target='_blank'>$row[url]</a></div>
		<div class=link-controls><a href='#' onclick='deleteEntry(\"delete_entry\", $row[id] )'><i class='fa fa-times' aria-hidden=true></i></a><i class='fa fa-cog' aria-hidden=true></i></div>
		</div>\n";
	}
	$output .= "</div>";
?>
