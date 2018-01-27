<script type='text/javascript' src='scripts/functions.js'></script>
<h2><?php echo $viewData->page_title ?></h2>
<div class=container>
	<p> To add an entry, either prefix the url with 'qvvz.uk/?' (e.g. qvvz.uk/?google.com) or use the following field: </p>
	<form action='' method='post'>
		<label>URL:</label>
		<input id='name' name='url' size=50 type='text'>
		<input name='newlink' type='submit' value=' Add '>
	</form>
	<?php echo $postLinkMsg; ?>
	</div>
	<div class=container id=links>
	<?php // output data of each row 
	while($row = $viewData->content->fetch(PDO::FETCH_ASSOC)): 
		$added = $row['added'];
		$linkName = stripslashes($row["name"]);
		//Only echo out the control options on entries that are the user's. I.E. Not public.
		//If logged in and entry owner is the user, OR the user is level 2 or higher... ?>
		<div class=link-container>
		<div class=link-date><i class='fa fa-calendar' aria-hidden=true title='<?php  echo $added ?>'></i></div>
		<div class=link-hash><a href='<?php  echo $host/$row["hash"] ?>'><?php  echo $row["hash"] ?></a></div>
		<div class=link-name><?php echo $linkName ?></div>
		<div class=link-link><a href='<?php  echo $row["url"] ?>' target='_blank'><?php  echo $row["url"] ?></a></div>
		<div class=link-controls>
			<a href='#' onclick='deleteEntry("delete_entry", <?php  echo $row["id"] ?> )'>
				<i class='fa fa-times' aria-hidden=true></i>
			</a>
			<i class='fa fa-cog' aria-hidden=true></i>
		</div>
	</div>
	<?php endwhile; ?>
</div>
