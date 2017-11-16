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
			<li> A | <?php echo $viewData->content[0]->id ?> | <?php echo $viewData->content[0]->name ?></li>
			<li> B | <?php echo $viewData->content[0]->id ?> | <?php echo $viewData->content[0]->name ?></li>
			<li> C | <?php echo $viewData->content[0]->id ?> | <?php echo $viewData->content[0]->name ?></li>
		</ol>
	</div>
</div>
