<h1><?=__t('user/new','New user')?></h1> 

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="<?=__url('user/new')?>" method="post" autocomplete="off" enctype="multipart/form-data">
	
	<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user.tpl.php'));?>

	<br />	

	<ul class="button-group radius">
		<li><input type="submit" class="button small" name="saveAction" value="<?=__t('system/button','Save')?>"/></li>
		<li><input type="submit" class="button small" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/></li>
	</ul>	
	
</form>