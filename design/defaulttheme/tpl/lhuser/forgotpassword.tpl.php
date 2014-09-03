<h1><?=__t('user/forgotpassword','Password reminder')?></h1>

<hr />

<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>

<form method="post" action="<?=__url('user/forgotpassword')?>">
	
	<label><?=__t('user/forgotpassword','Email')?>:</label>
	<input type="text" name="Email" value="" />

	<input type="submit" name="Forgotpassword" class="button radius" value="<?=__t('system/button','Restore password')?>" />

</form>