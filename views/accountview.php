<div class=container>
	<?php if($userData): ?>
	<p><?php echo $userData->username ?></p>
	<p><?php echo $userData->email ?></p>
	<p><img src='<?php echo $userData->mc_avatar ?>' /><?php $userData->mc_username ?></p>
	<form method=post>
		<p><?php echo $userMapShortcut["name"]?>'s home co-ordinates: 
			<label>X: </label><input type=number name=x_pos min=-4000 max=4000 size=5 value=<?php echo $userMapShortcut["x_pos"]?> /> 
			<label>Z: </label><input type=number name=z_pos min=-4000 max=4000 size=5 value=<?php echo $userMapShortcut["z_pos"]?> />
			<label>Zoom: </label><select name=zoom  />
				<?php foreach($zoomLevels as $level): 
					if($level == $userMapShortcut["zoom"])
						echo"<option value=$level selected>$level</option>";
					else 
						echo "<option value=$level>$level</option>";
				endforeach;
				?>
				</select>
			<input type=submit name=update_map_shortcut value='Go' /> 
			</p>
		</form>
	<?php else: ?>
	<p class=error>Something weent wrong getting your account details.</p>
	<?php endif;?>
</div>