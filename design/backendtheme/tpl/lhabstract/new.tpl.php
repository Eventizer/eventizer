<div class="col-md-12">
	<div class="box box-primary">
		<form method="post" enctype="multipart/form-data" action="<?=__url('abstract/new')?>/<?=$identifier?>">
			<div class="box-body">	
				<?php include_once(erLhcoreClassDesign::designtpl('lhabstract/abstract_form.tpl.php'));?>
			</div>
	
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="SaveClient" value="<?=__t('system/button','Save')?>"/>
				<input type="submit" class="btn btn-info" name="UpdateClient" value="<?=__t('system/button','Update')?>"/>
				<input type="submit" class="btn btn-default" name="CancelAction" value="<?=__t('system/button','Cancel')?>"/>
			</div>
		</form>
	</div>
</div>