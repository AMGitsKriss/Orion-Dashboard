  <script>
  $( function() {
    $( ".sortable" ).sortable();
    $( ".sortable" ).disableSelection();
  } );
  </script>
  <div id='mainsection'>
	<div class="container">
		<h2><?php echo $viewData->page_title ?></h2>
		<ol class="sortable">
			<?php foreach($viewData->content as $row): ?>
			<li> <?php echo $row['IssueId'] ?> | <?php echo $row['Name'] ?> | Active: <?php echo $row['IsActive'] ?></li>
			<?php endforeach; ?>
		</ol>
	</div>
</div>
