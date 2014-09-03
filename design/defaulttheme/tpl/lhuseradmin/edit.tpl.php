<h1><?=__t('user/account','User edit')?> - <?php echo $userData->name,' ',$userData->surname?></h1> 

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<div class="explain">
	<?=__t('user/account','Do not enter a password unless you want to change it')?>
</div>

<br />

<form action="<?=__url('useradmin/edit')?>/<?=$userData->id?>" method="post" autocomplete="off">

	<?php include_once(erLhcoreClassDesign::designtpl('lhuseradmin/form/user.tpl.php'));?>

	<br />

	<ul class="button-group radius">
		<li><input type="submit" class="button small" name="saveAction" value="<?=__t('system/button','Save')?>"/></li>
		<li><input type="submit" class="button small" name="updateAction" value="<?=__t('system/button','Update')?>"/></li>
		<li><input type="submit" class="button small" name="cancelAction" value="<?=__t('system/button','Cancel')?>"/></li>
	</ul>
	
</form>