<div class="col-xs-12">
	<div class="box box-primary">
		<form action="<?=__url('useradmin/newgroup')?>" method="post" autocomplete="off">
			<div class="box-body">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				<?php include_once(erLhcoreClassDesign::designtpl('lhuseradmin/form/group.tpl.php'));?>
			</div>

			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="saveAction" value="<?=__t('system/button','Save')?>" /> 
				<input type="submit" class="btn btn-default" name="cancelAction" value="<?=__t('system/button','Cancel')?>" />
			</div>

		</form>
	</div>
</div>