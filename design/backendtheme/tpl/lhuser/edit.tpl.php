<div class="col-md-12">
	<div class="box box-primary">
		<form enctype="multipart/form-data" action="<?=__url('user/edit')?>/<?=$userData->id?>" method="post" autocomplete="off">
			<div class="box-body">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
				<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user_admin.tpl.php'));?>
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" name="saveAction" value="<?=__t('system/button','Save')?>"/>
				<input type="submit" class="btn btn-info" name="updateAction" value="<?=__t('system/button','Update')?>"/>
				<input type="submit" class="btn btn-default" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/>
			</div>
		</form>
	</div>
</div>