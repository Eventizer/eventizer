<h1><?=__t('user/newgroup','New group')?></h1> 

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form action="<?=__url('useradmin/newgroup')?>" method="post" autocomplete="off">
	
	<?php include_once(erLhcoreClassDesign::designtpl('lhuseradmin/form/group.tpl.php'));?>
	
	<br />
	
	<ul class="button-group radius">
		<li><input type="submit" class="button small" name="saveAction" value="<?=__t('system/button','Save')?>"/></li>
		<li><input type="submit" class="button small" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/></li>
	</ul>
				
</form>