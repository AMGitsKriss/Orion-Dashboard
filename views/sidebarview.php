<div id=sidebar>
	<?php foreach ($viewData->sidebar as $element): ?>
		<?php if (is_array($element)): ?>
			<?php if (is_array($element)): ?>
			<div class="sidebar-container">
				<table table-bordered table-striped> 
					<?php $heading = array_shift($element); ?>
					<thead><tr><?php foreach( $heading as $col ): ?><th><?php echo $col; ?></th><?php endforeach; ?></tr></thead> 
					<tbody>
						<?php foreach( $element as $row ): ?>
							<tr>
								<?php foreach( $row as $col ): ?>
								<td>
									<?php echo $col; ?>
								</td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
		<?php elseif(is_string($element)): ?>
		<div class="sidebar-container"><?php echo $element; ?></div>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="sidebar-container">THINGS</div>
</div>