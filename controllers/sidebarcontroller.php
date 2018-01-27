<?php
	//Common controller should already be loaded by this point.
	echo "<div id=sidebar>";
	//Loop over the sidebar and sidebarStruct values and do the business.
	for ($i = 0; $i < sizeof($viewData->sidebar); $i++) {
		$struct = $viewData->sidebarStruct[$i];
		$content = $viewData->sidebar[$i];
		assignView($struct, $content);
	}
	echo "</div>"; // TODO - The echoing here is a HUGE bidge. don't do it! FIX!

	//Which div block do we want?
	function assignView($struct, $content){
		switch($struct){
			case 'menu':
				include("views/sidebar/menu.php");
				break;

			case 'table':
				include("views/sidebar/table.php");
				break;

			case 'html': // Just grav the html straight from the string
				echo "<div class='sidebar-container'>".$content."</div>";
				break;

			default:
				break;
		}
	}
?>