<div class="sidebar-container"> 
	<?php foreach( $content as $row ): ?>
		<p><a href='<?php echo $row[1]; ?>'><?php echo $row[0]; ?></a></p>
	<?php endforeach; ?>
</div>