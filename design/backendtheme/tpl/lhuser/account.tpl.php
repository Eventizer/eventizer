<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header">
	       <h3 class="box-title"><?=htmlspecialchars($userData->name.' '.$userData->surname)?></h3>
	     </div>
			
		<form enctype="multipart/form-data" action="<?=__url('user/account')?>" method="post" autocomplete="off">
			
			<div class="box-body">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
				
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
		
			
			    	<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user.tpl.php'));?>
			</div>
			<div class="box-footer">
            	  <input type="submit" name="updateAction" class="btn btn-primary" value="<?=__t('system/button','Update')?>">             
            </div>
			
		</form>
	</div>
</div>