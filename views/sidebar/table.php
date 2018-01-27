<div class="sidebar-container">
	<table table-bordered table-striped> 
		<?php $heading = array_shift($content); ?>
		<thead><tr><?php foreach( $heading as $col ): ?><th><?php echo $col; ?></th><?php endforeach; ?></tr></thead> 
		<tbody>
			<?php foreach( $content as $row ): ?>
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