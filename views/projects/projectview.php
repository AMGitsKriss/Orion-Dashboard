<?php
	$output .= "<div id=sidebar><table class=players-table table-bordered table-striped>\n<thead>\n<tr>\n<th>".$viewData->sidebar[0]."</th>\n</tr>\n</thead>\n<tbody>\n";
	$output .= "<tr>\n<td>\nRow in the table. This is really fucking bad. This shouldn't be a thing.</td>\n</tr>\n";
	$output .= "</table></div>";
	$output .= "<div id='mainsection'><div class=container>";
	$output .= "<h2>".$viewData->page_title."</h2>";
	$output .= "<p>".$viewData->content[0]."</p>";
	$output .= "</div></div>";
?>
