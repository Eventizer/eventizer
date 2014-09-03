<?php if(isset($alertSuccessAction) && $alertSuccessAction != false):?>
	<div class="alert alert-success fade in" role="alert">
		<?=htmlspecialchars($alertSuccessAction); ?>
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	</div>
<?php endif;?>