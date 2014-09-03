<h1><?=__t('user/registration','Registration')?></h1>

<hr />

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="<?=__url('user/registration')?>" method="post" autocomplete="off">
	
	<div class="row">
	    <div class="columns large-12">
	    	<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user.tpl.php'));?>
	    </div>
	</div>
	
	<input type="submit" class="button radius" name="registerAction" value="<?=__t('system/button','Confirm')?>"/>
	
</form>