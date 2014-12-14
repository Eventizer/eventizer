<h1><?=__t('user/account','Logged user')?> - <?=htmlspecialchars($userData->name.' '.$userData->surname)?></h1>

<hr />

<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success_action.tpl.php'));?>
		
<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<div class="explain">
	<?=__t('user/account','Do not enter a password unless you want to change it')?>
</div>
	
<br />
	
<form action="<?=__url('user/account')?>" method="post" autocomplete="off">
	
	<div class="row">
	    <div class="columns large-12">
	    	<?php include_once(erLhcoreClassDesign::designtpl('lhuser/form/user.tpl.php'));?>
	    </div>
	</div>
	
	<input type="submit" name="updateAction" class="button small radius" value="<?=__t('system/button','Update')?>">
	
</form>