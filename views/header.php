<!DOCTYPE html>
<html lang='en'>

<head>
	<title><?php echo $viewData->site_title ?></title>

	<meta property='og:image' content='http://qvvz.uk/images/0f00e3e818b461fb559a78f48ccbe285.gif' />
	<script src='https://use.fontawesome.com/15e142434c.js'></script>
	<link rel='stylesheet' type='text/css' href='css/default.css'>
</head>

<body>
	<header>
		<?php foreach ($links as $row): 
			if($row[0] == "Minecraft Map"):
				echo "<span class='dropdown'><a href='$row[1]'>$row[2] $row[0]</a><ul class='dropdown-content'>\n";
				foreach ($mapShortcuts as $point): 
					echo "<li><a href='$host/map/#/$point[x_pos]/64/$point[z_pos]/$point[zoom]/0/0'>$point[name]</a></li>\n";
				endforeach;
				echo "</ul></span>\n";
			else:
				echo "<a href='$row[1]'>$row[2] $row[0]</a>\n";
			endif;
		endforeach; ?>
	</header>
