<?php if(isset($errors)): ?>
	<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		<ul>
			<?php foreach ($errors as $err): ?>
    			<li><?=htmlspecialchars($err)?></li>
			<?php endforeach;?>
		</ul>
			
	</div>
<?php endif;?>