<div id=sidebar>
	<?php foreach ($viewData->sidebar as $element): ?>
		<?php if (is_array($element)): ?>
		<div class="sidebar-container">
			<table table-bordered table-striped>
			<thead><tr><th>Minecraft</th></tr></thead>
			<tbody>
				<?php foreach( $element as $player ): ?>
					<tr><td>
						<img src='<?php echo $player[1]; ?>' /><?php echo $player[0]; ?>
					</td></tr>
				<?php endforeach; ?>
			</tbody>
			</table>
		</div>
		<?php elseif(is_string($element)): ?>
		<div class="sidebar-container"><?php echo $element; ?></div>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="sidebar-container">THINGS</div>
</div>