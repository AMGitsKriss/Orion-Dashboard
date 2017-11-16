<!DOCTYPE html>
<html lang='en'>

<head>
	<title><?php echo $viewData->site_title ?></title>

	<meta property='og:image' content='http://qvvz.uk/images/0f00e3e818b461fb559a78f48ccbe285.gif' />
	<script src='https://use.fontawesome.com/15e142434c.js'></script>
	<link rel='stylesheet' type='text/css' href='css/default.css'>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script> <!-- TODO - Keep this locally -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- TODO - Keep this locally -->
</head>

<body>
	<header>
		<?php foreach ($links as $row): 
			if($row[0] == "Minecraft Map"):
				echo "<span class='dropdown'><a href='$row[1]'>$row[0]</a><ul class='dropdown-content'>\n";
				foreach ($mapShortcuts as $point): 
					echo "<li><a href='$host/map/#/$point[x_pos]/64/$point[z_pos]/$point[zoom]/0/0'>$point[name]</a></li>\n";
				endforeach;
				echo "</ul></span>\n";
			else:
				echo "<a href='$row[1]'>$row[0]</a>\n";
			endif;
		endforeach; ?>

		<?php foreach ($controls as $row): ?>
			<a class="options" href="<?php echo $row[1] ?>"><?php echo $row[0] ?></a>
		<?php endforeach; ?>
	</header>
	<section>