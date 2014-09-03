<div class="col-xs-12">
	<div class="box box-primary">
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
			

		<form action="<?=__url('permission/newrole')?>" method="post">
			<div class="box-body">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
				<div class="form-group">
			    	<label><?=__t('permission/newrole','Name')?></label>
			    	<input class="form-control" type="text" name="Name"  value="" />
			    </div>
			
					
					
				
			
			<div class="box-footer"> 
				<input type="submit" class="btn btn-primary" name="New_policy" value="<?=__t('system/button','New')?>"/>
				<input type="submit" class="btn btn-info" name="Save_role" value="<?=__t('system/button','Save')?>"/>
				<input type="submit" class="btn btn-default" name="Cancel_role" value="<?=__t('system/button','Cancel')?>"/>
			</div>
				
		</form>
	</div>
</div>