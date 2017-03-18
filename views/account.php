<?php
	$output .="<div id=wholesection><div class=container>";
	if($userData){
		$output .= "<p>$userData->username</p>";
		$output .= "<p>$userData->email</p>";
		$output .= "<p><img src='$userData->mc_avatar' />$userData->mc_username</p>";
	}
	else{
		$output .= "<p class=error>Something weent wrong getting your account details.</p>";
	}


	# Build the position update form. 
	# If the $userMapShortcut variable is a string, it's not in the list.
	if(gettype($userMapShortcut) == "string"){ # $userMapShortcut[zoom]
		$userMapShortcut = ["name"=>"", "x_pos"=>"", "z_pos"=>"", "zoom"=>""]
	}
	$output .= "<form method=post><p>$userMapShortcut[name]'s home co-ordinates: 
	<label>X: </label><input type=number name=x_pos min=-4000 max=4000 size=5 value=$userMapShortcut[x_pos] /> 
	<label>Z: </label><input type=number name=z_pos min=-4000 max=4000 size=5 value=$userMapShortcut[z_pos] />
	<label>Zoom: </label><select name=zoom  />\n";
	
	$zoomLevels = ["Max", -1, -2, -3, -4, -5];
	foreach($zoomLevels as $level){
		if($level == $userMapShortcut["zoom"]) 
			$output .= "<option value=$level selected>$level</option>";
		else 
			$output .= "<option value=$level>$level</option>";
	}

	$output .= "</select>
	<input type=submit name=update_map_shortcut value='Go' /> 
	</p></form>";
	
	$output .= "</div></div>";
?>